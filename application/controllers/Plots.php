<?php
require_once(APPPATH . 'core/My_Controller.php');

use Dompdf\Dompdf;
use Dompdf\Options;

class Plots extends My_Controller
{



    public function __construct()
    {

        parent::__construct();
    }





    public function index($id = null)
    {
        $this->data['id'] = $id ?? '';

        // ✅ Fetch site details using site id
        if (!empty($id)) {
            $site = $this->general_model->getOne('sites', ['id' => $id]);

            // Pass site name to view
            $this->data['site_name'] = $site->name ?? '';
        } else {
            $this->data['site_name'] = '';
        }

        $this->load->view('header');
        $this->load->view('plot_view', $this->data);
        $this->load->view('footer');
    }


    public function add_plot()
    {

        $data['sites'] = $this->general_model->getAll('sites', ['isActive' => '1']);

        $this->load->view('header');

        $this->load->view('plot_form', $data);

        $this->load->view('footer');
    }

    public function save_plot()
    {
        header('Content-Type: application/json');
        $response = ['status' => 'error', 'message' => 'Something went wrong'];

        // ✅ Check admin login
        $admin_id = $this->admin['user_id'] ?? null;
        if (!$admin_id) {
            $response['message'] = 'Unauthorized access';
            echo json_encode($response);
            return;
        }
        // echo "<pre>";
        // print_r($_POST);
        // die;

        // ✅ Get POST data
        $site_id = $this->input->post('site_id');
        $plot_number = trim($this->input->post('plot_number'));
        $size = trim($this->input->post('size'));
        $dimension = trim($this->input->post('dimension'));
        $facing = trim($this->input->post('facing'));
        $price = trim($this->input->post('price'));

        // ✅ Validation
        if (empty($site_id) || empty($plot_number) || empty($size) || empty($dimension) || empty($facing) || empty($price)) {
            $response['message'] = 'All fields are required';
            echo json_encode($response);
            return;
        }

        // ❗ OPTIONAL: Avoid duplicate plot number inside same site
        $exists = $this->general_model->getOne('plots', [
            'site_id' => $site_id,
            'plot_number' => $plot_number
        ]);

        if ($exists) {
            $response['message'] = 'Plot number already exists for this site';
            echo json_encode($response);
            return;
        }

        // ✅ Insert Data
        $data = [
            'admin_id' => $admin_id,
            'site_id' => $site_id,
            'plot_number' => $plot_number,
            'size' => $size,
            'dimension' => $dimension,
            'facing' => $facing,
            'price' => $price,
            'status' => 'available', // 🔥 IMPORTANT
            'isActive' => 1,
            'created_at' => date('Y-m-d')
        ];


        $insert_id = $this->general_model->insert('plots', $data);

        if ($insert_id) {

            // -------------------------------------------------------
            // ✅ STEP 2: RECALCULATE TOTAL SITE VALUE AFTER INSERT
            // -------------------------------------------------------

            $total_value = $this->db->select_sum('price')
                ->from('plots')
                ->where('site_id', $site_id)
                ->where('isActive', 1)
                ->get()
                ->row()
                ->price;

            // If no plots found, set 0
            $total_value = $total_value ? $total_value : 0;

            // -------------------------------------------------------
            // ✅ STEP 3: UPDATE THE SITES TABLE
            // -------------------------------------------------------
            $this->db->where('id', $site_id)
                ->update('sites', ['site_value' => $total_value]);

            $response = [
                'status' => 'success',
                'message' => 'Plot added successfully and site value updated',
                'site_value' => $total_value
            ];
        } else {
            $response['message'] = 'Failed to add plot';
        }

        echo json_encode($response);
    }

    public function update_plot()
    {
        header('Content-Type: application/json');
        $response = ['status' => 'error', 'message' => 'Something went wrong'];

        // 🔐 Auth check
        $admin_id = $this->admin['user_id'] ?? null;
        if (!$admin_id) {
            $response['message'] = 'Unauthorized access';
            echo json_encode($response);
            return;
        }

        // 🆔 Plot ID
        $id = $this->input->post('id');
        if (empty($id)) {
            $response['message'] = 'Plot ID missing';
            echo json_encode($response);
            return;
        }

        // 📝 Inputs
        $site_id = $this->input->post('site_id');
        $plot_number = trim($this->input->post('plot_number'));
        $size = trim($this->input->post('size'));
        $dimension = trim($this->input->post('dimension'));
        $facing = trim($this->input->post('facing'));
        $price = trim($this->input->post('price'));
        $status = trim($this->input->post('status'));

        // 🧾 Required validation
        if (
            empty($site_id) || empty($plot_number) || empty($size) ||
            empty($dimension) || empty($facing) || empty($price) || empty($status)
        ) {

            $response['message'] = 'All fields are required';
            echo json_encode($response);
            return;
        }

        // 🔍 Duplicate check (Exclude current row, active records only, normalized plot number)
        $normalized_plot_number = strtolower(trim($plot_number));
        $this->db->from('plots');
        $this->db->where('site_id', $site_id);
        $this->db->where('id !=', $id);
        $this->db->where('isActive', 1);
        $this->db->where(
            "LOWER(TRIM(plot_number)) = " . $this->db->escape($normalized_plot_number),
            null,
            false
        );
        $exists = $this->db->get()->row();

        if ($exists) {
            $response['message'] = 'Plot number already exists for this site';
            echo json_encode($response);
            return;
        }

        // 🛠 Update Data
        $data = [
            'site_id' => $site_id,
            'plot_number' => $plot_number,
            'size' => $size,
            'dimension' => $dimension,
            'facing' => $facing,
            'price' => $price,
            'status' => $status
            // 'updated_at'  => date('Y-m-d H:i:s')
        ];

        // 📌 Update Row
        $this->db->where('id', $id);
        $updated = $this->db->update('plots', $data);

        if ($updated) {
            $response = [
                'status' => 'success',
                'message' => 'Plot updated successfully'
            ];
        } else {
            $response['message'] = 'Failed to update plot';
        }

        echo json_encode($response);

        $total_value = $this->db->select_sum('price')
            ->from('plots')
            ->where('site_id', $site_id)
            ->where('isActive', 1)
            ->get()
            ->row()
            ->price ?? 0;

        $this->db->where('id', $site_id)
            ->update('sites', ['site_value' => $total_value]);
    }

    public function import()
    {
        header('Content-Type: application/json');

        $admin_id = $this->admin['user_id'] ?? null;
        $site_id  = (int) $this->input->post('site_id');
        $rows     = json_decode($this->input->post('rows'), true);

        $errors = [];
        $insert_data = [];
        $excel_plot_numbers = [];
        $max_error_messages = 200;

        if (!$admin_id || !$site_id) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
            return;
        }

        if (!is_array($rows) || empty($rows)) {
            echo json_encode(['status' => 'error', 'message' => 'No rows found for import']);
            return;
        }

        // Guardrail for extremely large payloads.
        if (count($rows) > 10000) {
            echo json_encode(['status' => 'error', 'message' => 'Too many rows. Please import up to 10,000 rows per file.']);
            return;
        }

        // Allow large imports to complete instead of timing out.
        if (function_exists('set_time_limit')) {
            @set_time_limit(300);
        }

        // Selected site must belong to current admin.
        $site = $this->db
            ->where('id', $site_id)
            ->where('admin_id', $admin_id)
            ->get('sites')
            ->row();

        if (!$site) {
            echo json_encode(['status' => 'error', 'message' => 'This Site Not Found.']);
            return;
        }

        // Build admin site-name map once (O(1) lookup during validation).
        $admin_sites = $this->db
            ->select('id, name')
            ->where('admin_id', $admin_id)
            ->get('sites')
            ->result();

        $admin_site_name_map = [];
        foreach ($admin_sites as $admin_site) {
            $name_key = strtolower(trim((string) ($admin_site->name ?? '')));
            if ($name_key !== '') {
                $admin_site_name_map[$name_key] = (int) $admin_site->id;
            }
        }

        // Load all site names once to avoid per-row queries while validating ownership.
        $all_sites = $this->db
            ->select('admin_id, name')
            ->where('isActive', 1)
            ->get('sites')
            ->result();

        $global_site_owner_map = [];
        foreach ($all_sites as $s) {
            $key = strtolower(trim((string) ($s->name ?? '')));
            if ($key === '') {
                continue;
            }
            if (!isset($global_site_owner_map[$key])) {
                $global_site_owner_map[$key] = [];
            }
            $global_site_owner_map[$key][(int) $s->admin_id] = true;
        }

        // Load existing plot numbers once to avoid N queries.
        $existing_plots = $this->db
            ->select('plot_number')
            ->where('admin_id', $admin_id)
            ->where('site_id', $site_id)
            ->where('isActive', 1)
            ->get('plots')
            ->result();

        $db_plot_numbers = [];
        foreach ($existing_plots as $p) {
            $k = strtolower(trim((string) ($p->plot_number ?? '')));
            if ($k !== '') {
                $db_plot_numbers[$k] = true;
            }
        }

        foreach ($rows as $index => $row) {
            $line = $index + 2; // Excel header is row 1.
            $row_errors = [];

            $site_name   = $this->import_field($row['Site Name'] ?? ($row['site_name'] ?? ($row['site'] ?? null)));
            $plot_number = $this->import_field($row['Plot Number'] ?? ($row['plot_number'] ?? ($row['plot'] ?? null)));
            $size        = $this->import_field($row['Size'] ?? ($row['size'] ?? null));
            $dimension   = $this->import_field($row['Dimension'] ?? ($row['dimension'] ?? null));
            $facing      = $this->import_field($row['Facing'] ?? ($row['facing'] ?? null));
            $price       = $this->import_number_field($row['Price'] ?? ($row['price'] ?? null));
            $raw_status  = $this->import_field($row['Status'] ?? ($row['status'] ?? null));
            $status      = $this->normalize_import_status($raw_status);
            $site_name_key = strtolower(trim((string) ($site_name ?? '')));

            // Required fields.
            if (!$site_name)      $row_errors[] = "Line $line: Site Name is missing";
            if (!$plot_number)    $row_errors[] = "Line $line: Plot Number is missing";
            if (!$size)           $row_errors[] = "Line $line: Plot Size is missing";
            if (!$dimension)      $row_errors[] = "Line $line: Dimension is missing";
            if (!$facing)         $row_errors[] = "Line $line: Facing is missing";
            if ($price === null)  $row_errors[] = "Line $line: Price is missing";
            if (!$raw_status)     $row_errors[] = "Line $line: Status is missing";

            // Site ownership + selected-site match checks.
            if ($site_name) {
                if (!isset($admin_site_name_map[$site_name_key])) {
                    $owners = $global_site_owner_map[$site_name_key] ?? [];
                    $has_other_admin_owner = !empty($owners) && !isset($owners[(int) $admin_id]);
                    if ($has_other_admin_owner) {
                        $row_errors[] = "Line $line: Site Name '{$site_name}' belongs to another admin";
                    } else {
                        $row_errors[] = "Line $line: Site Name '{$site_name}' is not found for this admin";
                    }
                } elseif ((int) $admin_site_name_map[$site_name_key] !== $site_id) {
                    $row_errors[] = "Line $line: Site Name '{$site_name}' does not match selected site '{$site->name}'";
                }
            }

            // Status checks.
            if ($raw_status && $status === null) {
                $row_errors[] = "Line $line: Invalid Status '{$raw_status}' (allowed: available, pending)";
            }
            if ($status === 'sold') {
                $row_errors[] = "Line $line: Sold plots cannot be imported. Use only available or pending";
            }

            // Duplicate inside Excel file.
            if ($plot_number) {
                $plot_key = strtolower($plot_number);
                if (isset($excel_plot_numbers[$plot_key])) {
                    $row_errors[] = "Line $line: Duplicate Plot Number inside Excel file";
                } else {
                    $excel_plot_numbers[$plot_key] = true;
                }
            }

            // Duplicate in database for current admin+site (in-memory lookup).
            if ($plot_number) {
                $plot_key = strtolower($plot_number);
                if (isset($db_plot_numbers[$plot_key])) {
                    $row_errors[] = "Line $line: Plot Number already exists";
                }
            }

            if (!empty($row_errors)) {
                $errors = array_merge($errors, $row_errors);
                if (count($errors) >= $max_error_messages) {
                    break;
                }
                continue;
            }

            // Reserve key immediately so same-file later rows are treated duplicate.
            $db_plot_numbers[strtolower($plot_number)] = true;

            $insert_data[] = [
                'admin_id'    => $admin_id,
                'site_id'     => $site_id,
                'plot_number' => $plot_number,
                'size'        => $size,
                'dimension'   => $dimension,
                'facing'      => $facing,
                'price'       => $price,
                'status'      => $status,
                'isActive'    => 1,
                'created_at'  => date('Y-m-d')
            ];
        }

        if (!empty($errors)) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Import failed. Please fix the row errors.',
                'errors'  => $errors,
                'error_count' => count($errors)
            ]);
            return;
        }

        if (empty($insert_data)) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'No valid rows found to import'
            ]);
            return;
        }

        $this->db->trans_start();
        foreach (array_chunk($insert_data, 500) as $chunk) {
            $this->db->insert_batch('plots', $chunk);
        }

        $total_value = $this->db->select_sum('price')
            ->from('plots')
            ->where('site_id', $site_id)
            ->where('isActive', 1)
            ->get()
            ->row()
            ->price;
        $total_value = $total_value ? $total_value : 0;

        $this->db->where('id', $site_id)
            ->update('sites', ['site_value' => $total_value]);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Import failed while saving data'
            ]);
            return;
        }

        echo json_encode([
            'status'   => 'success',
            'inserted' => count($insert_data)
        ]);
    }

    private function import_field($value)
    {
        if ($value === null) {
            return null;
        }

        if (is_array($value) || is_object($value)) {
            return null;
        }

        $clean = trim((string) $value);
        if ($clean === '') {
            return null;
        }

        $lower = strtolower($clean);
        if ($lower === 'null' || $lower === 'na' || $lower === 'n/a' || $lower === '-') {
            return null;
        }

        return $clean;
    }

    private function import_number_field($value)
    {
        $clean = $this->import_field($value);
        if ($clean === null) {
            return null;
        }

        $number = preg_replace('/[^0-9.\-]/', '', $clean);
        if ($number === '' || $number === '-' || $number === '.' || $number === '-.') {
            return null;
        }

        return (float) $number;
    }

    private function normalize_import_status($value)
    {
        $clean = $this->import_field($value);
        if ($clean === null) {
            return null;
        }

        $status = strtolower($clean);
        if ($status === 'sold') {
            return 'sold';
        }
        if ($status === 'booked' || $status === 'reserved' || $status === 'pending') {
            return 'pending';
        }
        if ($status === 'available') {
            return 'available';
        }

        return null;
    }
    public function get_plots_ajax()
    {
        header('Content-Type: application/json');

        $limit   = 10;
        $page    = (int) $this->input->get('page');
        $search  = trim($this->input->get('search'));
        $site_id = (int) $this->input->get('site_id');

        if ($page < 1) $page = 1;
        $offset = ($page - 1) * $limit;

        // -------------------------------
        // MAIN QUERY (WITH BUYER)
        // -------------------------------
        $this->db->select('
        p.id,
        p.plot_number,
        p.size,
        p.dimension,
        p.facing,
        p.price,
        p.status,
        p.isActive,
        s.name AS site_name,
        b.id   AS buyer_id,
        b.name AS buyer_name,
        (
            SELECT COUNT(*)
            FROM cash_payment_logs cpl
            WHERE cpl.buyer_id = b.id
              AND LOWER(COALESCE(cpl.status, "")) = "pending"
              AND LOWER(COALESCE(cpl.notes, "")) LIKE "%emi%"
        ) AS pending_installment_requests
    ');

        $this->db->from('plots p');
        $this->db->join('sites s', 's.id = p.site_id', 'left');
        // Pick only the latest active buyer row per plot to avoid duplicate plot rows.
        $this->db->join(
            'buyer b',
            'b.id = (SELECT MAX(b2.id) FROM buyer b2 WHERE b2.plot_id = p.id AND b2.isActive = 1)',
            'left'
        );
        $this->db->order_by('id', 'DESC');

        $this->db->where('p.isActive', 1);

        if ($site_id > 0) {
            $this->db->where('p.site_id', $site_id);
        }

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('p.plot_number', $search);
            $this->db->or_like('s.name', $search);
            $this->db->or_like('b.name', $search); // search buyer also
            $this->db->group_end();
        }

        // Count
        $total_records = $this->db->count_all_results('', FALSE);

        // Pagination
        $this->db->order_by('p.id', 'DESC');
        $this->db->limit($limit, $offset);

        $plots = $this->db->get()->result();

        // Hard safety filter: only active plots should be returned to plot_view.
        $plots = array_values(array_filter($plots, function ($plot) {
            return isset($plot->isActive) ? ((int) $plot->isActive === 1) : true;
        }));

        // -------------------------------
        // STATUS COUNTS
        // -------------------------------
        $this->db->select('LOWER(TRIM(status)) as status_key, COUNT(*) as total_count');
        $this->db->from('plots');
        $this->db->where('isActive', 1);

        if ($site_id > 0) {
            $this->db->where('site_id', $site_id);
        }

        $this->db->group_by('LOWER(TRIM(status))');
        $status_rows = $this->db->get()->result();

        $status_counts = [
            'available' => 0,
            'booked'    => 0,
            'sold'      => 0
        ];

        foreach ($status_rows as $row) {
            $key = strtolower(trim($row->status_key));
            if ($key == 'sold') $status_counts['sold'] += $row->total_count;
            elseif ($key == 'booked' || $key == 'pending') $status_counts['booked'] += $row->total_count;
            else $status_counts['available'] += $row->total_count;
        }

        // -------------------------------
        // RESPONSE
        // -------------------------------
        echo json_encode([
            'status' => true,
            'data'   => $plots,
            'status_counts' => $status_counts,
            'pagination' => [
                'current_page'  => $page,
                'total_pages'  => ceil($total_records / $limit),
                'total_records' => $total_records
            ]
        ]);
    }




    public function delete_plot($id)
    {
        $updated = $this->db->where('id', $id)->update('plots', ['isActive' => 0]);

        if ($updated) {
            echo json_encode(['status' => true, 'message' => 'Plot deleted successfully']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to delete plot']);
        }
    }
    public function edit_plot($id)
    {
        $data['plots'] = $this->db->where('id', $id)->get('plots')->row();
        $data['sites'] = $this->db->get('sites')->result(); // for dropdown

        $this->load->view('header');
        $this->load->view('edit_plot_form', $data);
        $this->load->view('footer');
    }

    public function buyer_details($id)
    {
        $id = (int) $id;
        if ($id <= 0) {
            show_404();
            return;
        }

        // 1) Prefer exact buyer id (correct link behavior).
        $buyer = $this->db->get_where("buyer", [
            "id" => $id,
            "isActive" => 1
        ])->row();

        // 2) Backward compatibility for old links that may pass plot_id.
        if (!$buyer) {
            $buyer = $this->db->order_by("id", "DESC")
                ->get_where("buyer", [
                    "plot_id" => $id,
                    "isActive" => 1
                ])->row();
        }

        if (!$buyer) {
            show_404();
            return;
        }

        $buyer_id = (int) $buyer->id;
        $plot_id = (int) $buyer->plot_id;

        // 2. Fetch Payment Details
        $payment = $this->db->order_by("id", "DESC")
            ->get_where("payment_details", [
                "buyer_id" => $buyer_id
            ])->row();

        if (!$payment) {
            $payment = $this->db->order_by("id", "DESC")
                ->get_where("payment_details", [
                    "plot_id" => $plot_id
                ])->row();
        }
        // 3A. Calculate remaining amount (from cash logs)
        $total_paid = 0;
        $down_payment_in_logs = false;
        $payment_down_payment = (float) ($payment->down_payment ?? 0);

        $cash_logs = $this->db->get_where("cash_payment_logs", [
            "buyer_id" => $buyer_id,
            "status" => "approve"
        ])->result();

        foreach ($cash_logs as $log) {
            $paid_amount = (float) ($log->paid_amount ?? 0);
            $total_paid += $paid_amount;

            // Detect whether down payment is already represented in approved cash logs.
            $note = strtolower((string) ($log->notes ?? ""));
            if ($payment_down_payment > 0) {
                if (strpos($note, "down") !== false || abs($paid_amount - $payment_down_payment) < 0.01) {
                    $down_payment_in_logs = true;
                }
            }
        }

        // Include configured down payment if it is not present in approved cash logs.
        if ($payment_down_payment > 0 && !$down_payment_in_logs) {
            $total_paid += $payment_down_payment;
        }

        $remaining_amount = 0;
        if ($payment && $payment->total_price > 0) {
            $remaining_amount = $payment->total_price - $total_paid;
            if ($remaining_amount < 0) {
                $remaining_amount = 0; // prevent negative
            }
        }


        // 3. Fetch EMI logs (if EMI)
        $emi = [];
        if ($payment && strtoupper((string) $payment->payment_mode) === "EMI") {
            $payment_id = (int) ($payment->id ?? 0);
            if ($payment_id > 0) {
                $emi = $this->db->order_by("month_no", "ASC")
                    ->get_where("emi_logs", ["payment_id" => $payment_id])
                    ->result();
            } else {
                $emi = $this->db->order_by("month_no", "ASC")
                    ->get_where("emi_logs", ["buyer_id" => $buyer_id])
                    ->result();
            }
        }

        $total_emi_installments = 0;
        $paid_emi_installments = 0;
        $remaining_emi_installments = 0;
        if ($payment && strtoupper((string) ($payment->payment_mode ?? "")) === "EMI") {
            $duration = (int) ($payment->emi_duration ?? 0);
            $total_emi_installments = $duration > 0 ? $duration : count($emi);
            foreach ($emi as $emi_row) {
                if (strtolower((string) ($emi_row->status ?? "pending")) === "approve") {
                    $paid_emi_installments++;
                }
            }
            if ($paid_emi_installments > $total_emi_installments) {
                $paid_emi_installments = $total_emi_installments;
            }
            $remaining_emi_installments = max(0, $total_emi_installments - $paid_emi_installments);
        }

        // 4. Fetch plot details + site name
        $this->db->select('plots.*, sites.name AS site_name');
        $this->db->from('plots');
        $this->db->join('sites', 'sites.id = plots.site_id', 'left');
        $this->db->where('plots.id', $plot_id);
        $plot = $this->db->get()->row();

        $data = [
            "buyer" => $buyer,
            "payment" => $payment,
            "emi" => $emi,
            "plot" => $plot,
            "remaining_amount" => $remaining_amount,
            "total_emi_installments" => $total_emi_installments,
            "paid_emi_installments" => $paid_emi_installments,
            "remaining_emi_installments" => $remaining_emi_installments
        ];
        // echo "<pre>";
        // print_r($data);
        // die;

        $this->load->view('header');
        $this->load->view('buyer_details', $data);
        $this->load->view('footer');
    }

    public function payment_data($id)
    {
        $data = [
            "buyer_id" => $id
        ];

        $this->load->view('header');
        $this->load->view('payment_data_view', $data);
        $this->load->view('footer');
    }
    public function payment_data_api()
    {
        $buyer_id = $this->input->post("buyer_id");
        $page = $this->input->post("page") ?? 1;
        $search = $this->input->post("search") ?? "";
        $limit = 10;
        $offset = ($page - 1) * $limit;

        if (!$buyer_id) {
            echo json_encode(["status" => false, "message" => "Buyer ID required"]);
            return;
        }

        // 1. Fetch Buyer
        $buyer = $this->db->get_where("buyer", ["id" => $buyer_id])->row();

        if (!$buyer) {
            echo json_encode(["status" => false, "message" => "Buyer not found"]);
            return;
        }

        $user_id = $buyer->user_id;
        $plot_id = $buyer->plot_id;

        // 2. Fetch User Name
        $user = $this->db->get_where("users", ["id" => $user_id])->row();

        // 3. Fetch Plot + Site
        $this->db->select("plots.plot_number, sites.name as site_name");
        $this->db->from("plots");
        $this->db->join("sites", "sites.id = plots.site_id", "left");
        $this->db->where("plots.id", $plot_id);
        $plot = $this->db->get()->row();

        // Ensure an initial cash log exists for old records with only payment_details.down_payment
        $cash_logs = $this->db->order_by("id", "DESC")
            ->get_where("cash_payment_logs", ["buyer_id" => $buyer_id])
            ->result();

        if (empty($cash_logs)) {
            $payment_details = $this->db->get_where("payment_details", [
                "buyer_id" => $buyer_id
            ])->row();

            if ($payment_details) {
                $down_payment = (float) ($payment_details->down_payment ?? 0);
                if ($down_payment > 0) {
                    $total_price = (float) ($payment_details->total_price ?? 0);
                    $remaining_amount = max(0, $total_price - $down_payment);
                    $created_on = $payment_details->created_on ?? $payment_details->created_at ?? date('Y-m-d H:i:s');

                    $columns = $this->db->list_fields("cash_payment_logs");
                    $allowed = array_flip($columns);

                    $candidate = [
                        "admin_id" => $this->admin['user_id'] ?? null,
                        "user_id" => $user_id,
                        "buyer_id" => $buyer_id,
                        "plot_id" => $plot_id,
                        "buyer_name" => $buyer->name ?? null,
                        "user_name" => $user->name ?? null,
                        "paid_amount" => $down_payment,
                        "remaining_amount" => $remaining_amount,
                        "total_price" => $total_price,
                        "status" => "approve",
                        "notes" => "Initial down payment",
                        "created_on" => $created_on,
                    ];

                    $insert_data = [];
                    foreach ($candidate as $field => $value) {
                        if (isset($allowed[$field])) {
                            $insert_data[$field] = $value;
                        }
                    }

                    if (!empty($insert_data)) {
                        $this->db->insert("cash_payment_logs", $insert_data);
                        $cash_logs = $this->db->order_by("id", "DESC")
                            ->get_where("cash_payment_logs", ["buyer_id" => $buyer_id])
                            ->result();
                    }
                }
            }
        }

        // Fetch EMI logs strictly for this buyer/payment (include full EMI schedule).
        $payment_ids = $this->db->select("id")
            ->from("payment_details")
            ->where("buyer_id", $buyer_id)
            ->get()
            ->result_array();
        $payment_ids = array_map("intval", array_column($payment_ids, "id"));

        $payment_installment_map = [];
        $payment_meta_map = [];
        $total_installments_expected = 0;
        if (!empty($payment_ids)) {
            $payment_fields = $this->db->list_fields("payment_details");
            $installment_col = null;
            if (in_array("installment_amount", $payment_fields, true)) {
                $installment_col = "installment_amount";
            } elseif (in_array("insatallment_amount", $payment_fields, true)) {
                $installment_col = "insatallment_amount";
            }

            $select_cols = "id, buyer_id, plot_id, emi_duration, emi_start_date, remaining_amount, total_price, down_payment";
            if ($installment_col !== null) {
                $select_cols .= ", {$installment_col} AS installment_amount";
            }

            $payment_rows = $this->db->select($select_cols)
                ->from("payment_details")
                ->where_in("id", $payment_ids)
                ->get()
                ->result();

            foreach ($payment_rows as $p) {
                $duration = (int) ($p->emi_duration ?? 0);
                $installment_amount = 0.0;
                if ($installment_col !== null) {
                    $installment_amount = (float) ($p->installment_amount ?? 0);
                }
                if ($installment_amount <= 0 && $duration > 0) {
                    $remaining_amount = (float) ($p->remaining_amount ?? 0);
                    if ($remaining_amount > 0) {
                        $installment_amount = round($remaining_amount / $duration, 2);
                    }
                }
                if ($installment_amount <= 0 && $duration > 0) {
                    $total_price = (float) ($p->total_price ?? 0);
                    $down_payment = (float) ($p->down_payment ?? 0);
                    $balance = max(0, $total_price - $down_payment);
                    if ($balance > 0) {
                        $installment_amount = round($balance / $duration, 2);
                    }
                }

                $payment_installment_map[(int) $p->id] = $installment_amount;
                $payment_meta_map[(int) $p->id] = [
                    "buyer_id" => (int) ($p->buyer_id ?? $buyer_id),
                    "plot_id" => (int) ($p->plot_id ?? $plot_id),
                    "duration" => $duration,
                    "start_date" => (string) ($p->emi_start_date ?? ""),
                    "installment_amount" => $installment_amount,
                ];

                if ($duration > $total_installments_expected) {
                    $total_installments_expected = $duration;
                }
            }
        }

        $this->db->from("emi_logs");
        if (!empty($payment_ids)) {
            // Primary key for EMI linkage should be payment_id.
            // Some legacy rows may carry incorrect buyer_id, so do not over-filter here.
            $this->db->where_in("payment_id", $payment_ids);
        } else {
            // Fallback when payment_details is missing.
            $this->db->where("buyer_id", $buyer_id);
        }
        $this->db->order_by("month_no", "ASC");
        $emi_logs = $this->db->get()->result();

        // Deduplicate accidental repeated EMI rows: keep one row per payment_id + month_no.
        $emi_unique = [];
        $status_rank = function ($status) {
            $s = strtolower((string) $status);
            if ($s === "approve") {
                return 4;
            }
            if ($s === "pending" || $s === "requested") {
                return 3;
            }
            if ($s === "reject") {
                return 2;
            }
            return 1;
        };

        foreach ($emi_logs as $emi) {
            $payment_id_key = (int) ($emi->payment_id ?? 0);
            $month_no_key = (int) ($emi->month_no ?? 0);
            if ($month_no_key > 0) {
                $key = "pm:{$payment_id_key}:m:{$month_no_key}";
            } else {
                $date_key = (string) ($emi->emi_date ?? $emi->created_on ?? $emi->id ?? "");
                $key = "pm:{$payment_id_key}:d:{$date_key}";
            }

            $existing = $emi_unique[$key] ?? null;
            if ($existing === null) {
                $emi_unique[$key] = $emi;
                continue;
            }

            $cur_amount = (float) ($emi->emi_amount ?? 0);
            $old_amount = (float) ($existing->emi_amount ?? 0);
            $cur_rank = $status_rank($emi->status ?? "");
            $old_rank = $status_rank($existing->status ?? "");

            $replace = false;
            if ($cur_amount > $old_amount) {
                $replace = true;
            } elseif ($cur_amount === $old_amount && $cur_rank > $old_rank) {
                $replace = true;
            } elseif ($cur_amount === $old_amount && $cur_rank === $old_rank && (int) ($emi->id ?? 0) > (int) ($existing->id ?? 0)) {
                $replace = true;
            }

            if ($replace) {
                $emi_unique[$key] = $emi;
            }
        }

        $emi_logs = array_values($emi_unique);

        // Ensure full EMI schedule is visible even if emi_logs rows are missing/incomplete.
        if (!empty($payment_meta_map)) {
            $existing_month_keys = [];
            foreach ($emi_logs as $emi) {
                $existing_month_keys[(int) ($emi->payment_id ?? 0) . ":" . (int) ($emi->month_no ?? 0)] = true;
            }

            foreach ($payment_meta_map as $pid => $meta) {
                $duration = (int) ($meta["duration"] ?? 0);
                $start_date = (string) ($meta["start_date"] ?? "");
                $installment_amount = (float) ($meta["installment_amount"] ?? 0);
                if ($duration <= 0 || empty($start_date) || $installment_amount <= 0) {
                    continue;
                }

                for ($m = 1; $m <= $duration; $m++) {
                    $k = $pid . ":" . $m;
                    if (isset($existing_month_keys[$k])) {
                        continue;
                    }

                    $emi_date = date("Y-m-d", strtotime($start_date . " +" . ($m - 1) . " month"));
                    $virtual = new stdClass();
                    $virtual->id = 0;
                    $virtual->payment_id = $pid;
                    $virtual->buyer_id = (int) ($meta["buyer_id"] ?? $buyer_id);
                    $virtual->plot_id = (int) ($meta["plot_id"] ?? $plot_id);
                    $virtual->month_no = $m;
                    $virtual->emi_date = $emi_date;
                    $virtual->emi_amount = $installment_amount;
                    $virtual->status = "pending";
                    $virtual->created_on = $emi_date . " 00:00:00";
                    $emi_logs[] = $virtual;
                }
            }
        }
        usort($emi_logs, function ($a, $b) {
            $ma = (int) ($a->month_no ?? 0);
            $mb = (int) ($b->month_no ?? 0);
            if ($ma !== $mb) {
                return $ma <=> $mb;
            }
            $ta = strtotime((string) ($a->emi_date ?? $a->created_on ?? ""));
            $tb = strtotime((string) ($b->emi_date ?? $b->created_on ?? ""));
            return $ta <=> $tb;
        });

        $merged_logs = [];
        $effective_emi_rows = [];
        $today_ts = strtotime(date("Y-m-d"));

        // Split EMI-cash requests so they map into installment slots, not as extra rows.
        $emi_cash_requests = [];
        $other_cash_logs = [];
        foreach ($cash_logs as $log) {
            $log_amount = (float) ($log->paid_amount ?? 0);
            $log_notes = strtolower((string) ($log->notes ?? ""));
            $is_emi_cash = ($log_amount > 0 && strpos($log_notes, "emi") !== false);
            if ($is_emi_cash) {
                $emi_cash_requests[] = $log;
            } else {
                $other_cash_logs[] = $log;
            }
        }

        usort($emi_cash_requests, function ($a, $b) {
            $ta = strtotime((string) ($a->created_on ?? $a->created_at ?? ""));
            $tb = strtotime((string) ($b->created_on ?? $b->created_at ?? ""));
            if ($ta === $tb) {
                return ((int) ($a->id ?? 0)) <=> ((int) ($b->id ?? 0));
            }
            return $ta <=> $tb;
        });

        $request_idx = 0;
        $requests_by_month = [];
        $unmapped_requests = [];
        foreach ($emi_cash_requests as $req) {
            $notes = (string) ($req->notes ?? "");
            if (preg_match('/\[EMI:(\d+):(\d+)\]/i', $notes, $m)) {
                $k = ((int) $m[1]) . ':' . ((int) $m[2]);
                if (!isset($requests_by_month[$k])) {
                    $requests_by_month[$k] = [];
                }
                $requests_by_month[$k][] = $req;
            } else {
                $unmapped_requests[] = $req;
            }
        }

        foreach ($emi_logs as $emi) {
            $emi_amount = (float) ($emi->emi_amount ?? 0);
            if ($emi_amount <= 0) {
                $p_id = (int) ($emi->payment_id ?? 0);
                if ($p_id > 0 && isset($payment_installment_map[$p_id])) {
                    $emi_amount = (float) $payment_installment_map[$p_id];
                }
            }

            $entry = new stdClass();
            $entry->month_no = $emi->month_no ?? null;
            $entry->notes = "EMI installment" . (!empty($entry->month_no) ? (" #" . $entry->month_no) : "");
            $entry->paid_amount = $emi_amount;

            $req = null;
            $k = ((int) ($emi->payment_id ?? 0)) . ':' . ((int) ($emi->month_no ?? 0));
            if (!empty($requests_by_month[$k])) {
                $req = array_shift($requests_by_month[$k]);
            } elseif (isset($unmapped_requests[$request_idx])) {
                $req = $unmapped_requests[$request_idx++];
            }

            if ($req !== null) {
                // Early payment request consumes the next installment slot.
                $entry->id = $req->id;
                $entry->log_source = "cash";
                $entry->buyer_id = $req->buyer_id ?? $emi->buyer_id;
                $entry->plot_id = $req->plot_id ?? $emi->plot_id;
                $entry->paid_amount = (float) ($req->paid_amount ?? $emi_amount);
                $entry->status = $req->status ?? "pending";
                $entry->created_on = $req->created_on ?? ($req->created_at ?? ($emi->emi_date ?? $emi->created_on ?? null));
                $entry->notes = $req->notes ?? $entry->notes;
                $entry->is_requested = 1;
                $entry->scheduled_on = $emi->emi_date ?? ($emi->created_on ?? null);

                // Backfill/sync EMI status with mapped cash request (for old data too).
                $emi_id = (int) ($emi->id ?? 0);
                if ($emi_id > 0) {
                    $mapped_status = strtolower((string) ($req->status ?? "pending"));
                    $current_status = strtolower((string) ($emi->status ?? "pending"));
                    $mapped_amount = (float) ($req->paid_amount ?? $emi_amount);
                    $current_amount = (float) ($emi->emi_amount ?? 0);
                    if ($mapped_status !== $current_status || $mapped_amount !== $current_amount) {
                        $this->db->where("id", $emi_id)->update("emi_logs", [
                            "status" => $mapped_status,
                            "emi_amount" => $mapped_amount
                        ]);
                        // Keep in-memory row consistent for summary calculations below.
                        $emi->status = $mapped_status;
                        $emi->emi_amount = $mapped_amount;
                    }
                }
            } else {
                $entry->id = $emi->id;
                $entry->log_source = "emi";
                $entry->buyer_id = $emi->buyer_id;
                $entry->plot_id = $emi->plot_id;
                $entry->status = $emi->status ?? "pending";
                $entry->created_on = $emi->emi_date ?? ($emi->created_on ?? null);
                $entry->is_requested = 0;
                $entry->scheduled_on = $emi->emi_date ?? ($emi->created_on ?? null);
            }

            $merged_logs[] = $entry;
            $effective_emi_rows[] = $entry;
        }

        foreach ($other_cash_logs as $log) {
            $log->log_source = "cash";
            $log->created_on = $log->created_on ?? ($log->created_at ?? null);
            $log->paid_amount = (float) ($log->paid_amount ?? 0);
            $log->is_requested = 0;
            $merged_logs[] = $log;
        }

        // Skip invalid/legacy rows that carry no payable value.
        $merged_logs = array_values(array_filter($merged_logs, function ($row) {
            return (float) ($row->paid_amount ?? 0) > 0;
        }));

        // Summary cards data for payment_data view (based on effective installment rows).
        $total_installments = $total_installments_expected > 0 ? $total_installments_expected : count($effective_emi_rows);
        $approved_installments = 0;
        $progress_installments = 0;
        $pending_amount = 0.0;
        $receiving_amount = 0.0;
        $next_installment = null;

        foreach ($effective_emi_rows as $emi_row) {
            $emi_status = strtolower((string) ($emi_row->status ?? "pending"));
            $emi_amount = (float) ($emi_row->paid_amount ?? 0);
            $is_requested = (int) ($emi_row->is_requested ?? 0) === 1;
            $emi_ts = strtotime((string) ($emi_row->scheduled_on ?? $emi_row->created_on ?? ""));

            if ($emi_status === "approve") {
                $approved_installments++;
                $progress_installments++;
                $receiving_amount += $emi_amount;
            } else {
                if ($is_requested) {
                    // Buyer already requested/paid this installment (awaiting approval),
                    // so move progression forward but do not add to received amount yet.
                    $progress_installments++;
                } else {
                    $pending_amount += $emi_amount;
                    if ($emi_ts !== false) {
                        if ($next_installment === null || $emi_ts < (int) $next_installment["ts"]) {
                            $next_installment = [
                                "date" => date("Y-m-d", $emi_ts),
                                "amount" => $emi_amount,
                                "ts" => $emi_ts
                            ];
                        }
                    }
                }
            }
        }

        foreach ($other_cash_logs as $cash) {
            $cash_status = strtolower((string) ($cash->status ?? "pending"));
            $cash_amount = (float) ($cash->paid_amount ?? 0);
            if ($cash_status === "approve") {
                $receiving_amount += $cash_amount;
            }
        }

        $remaining_installments = max(0, $total_installments - $progress_installments);

        // Search in merged records
        if (!empty($search)) {
            $q = strtolower(trim($search));
            $merged_logs = array_values(array_filter($merged_logs, function ($row) use ($q, $buyer, $user, $plot) {
                $haystack = implode(" ", [
                    strtolower((string) ($buyer->name ?? "")),
                    strtolower((string) ($user->name ?? "")),
                    strtolower((string) ($plot->site_name ?? "")),
                    strtolower((string) ($plot->plot_number ?? "")),
                    strtolower((string) ($row->status ?? "")),
                    strtolower((string) ($row->notes ?? "")),
                    strtolower((string) ($row->created_on ?? "")),
                    strtolower((string) ($row->paid_amount ?? "")),
                ]);
                return strpos($haystack, $q) !== false;
            }));
        }

        usort($merged_logs, function ($a, $b) use ($today_ts) {
            $ta = strtotime((string) ($a->created_on ?? ""));
            $tb = strtotime((string) ($b->created_on ?? ""));
            $sa = strtolower((string) ($a->status ?? ""));
            $sb = strtolower((string) ($b->status ?? ""));
            $src_a = strtolower((string) ($a->log_source ?? ""));
            $src_b = strtolower((string) ($b->log_source ?? ""));
            $notes_a = strtolower((string) ($a->notes ?? ""));
            $notes_b = strtolower((string) ($b->notes ?? ""));

            $is_cash_emi_req_a = $src_a === "cash" && $sa === "pending" && strpos($notes_a, "emi") !== false;
            $is_cash_emi_req_b = $src_b === "cash" && $sb === "pending" && strpos($notes_b, "emi") !== false;
            if ($is_cash_emi_req_a !== $is_cash_emi_req_b) {
                return $is_cash_emi_req_a ? -1 : 1; // buyer-requested installment first
            }

            $is_upcoming_a = $src_a === "emi" && $sa !== "approve" && $ta !== false && $ta >= $today_ts;
            $is_upcoming_b = $src_b === "emi" && $sb !== "approve" && $tb !== false && $tb >= $today_ts;

            if ($is_upcoming_a !== $is_upcoming_b) {
                return $is_upcoming_a ? -1 : 1; // upcoming installment first
            }

            if ($is_upcoming_a && $is_upcoming_b) {
                if ($ta === $tb) {
                    return ((int) ($a->month_no ?? 0)) <=> ((int) ($b->month_no ?? 0));
                }
                return $ta <=> $tb; // nearest upcoming first
            }

            if ($ta === $tb) {
                return ((int) ($b->id ?? 0)) <=> ((int) ($a->id ?? 0));
            }
            return $tb <=> $ta;
        });

        $total_rows = count($merged_logs);
        $logs = array_slice($merged_logs, $offset, $limit);

        echo json_encode([
            "status" => true,
            "buyer" => $buyer,
            "user" => $user,
            "plot" => $plot,
            "logs" => $logs,
            "summary" => [
                "total_installments" => $total_installments,
                "remaining_installments" => $remaining_installments,
                "pending_amount" => $pending_amount,
                "receiving_amount" => $receiving_amount,
                "next_installment_date" => $next_installment["date"] ?? null,
                "next_installment_amount" => (float) ($next_installment["amount"] ?? 0)
            ],
            "pagination" => [
                "current_page" => $page,
                "total_rows" => $total_rows,
                "per_page" => $limit,
                "total_pages" => ceil($total_rows / $limit)
            ]
        ]);
    }
    public function update_payment_status()
    {
        $log_id = $this->input->post("id");
        $status = $this->input->post("status");
        $source = strtolower((string) ($this->input->post("source") ?? "cash"));

        if (!$log_id || !$status) {
            echo json_encode(["status" => false, "message" => "Invalid request"]);
            return;
        }

        $table = $source === "emi" ? "emi_logs" : "cash_payment_logs";
        $amount_field = $source === "emi" ? "emi_amount" : "paid_amount";

        // 1. Fetch payment log
        $log = $this->db->get_where($table, ["id" => $log_id])->row();
        if (!$log) {
            echo json_encode(["status" => false, "message" => "Payment log not found"]);
            return;
        }

        $old_status = strtolower((string) ($log->status ?? ""));
        $new_status = strtolower((string) $status);
        $amount = (float) ($log->{$amount_field} ?? 0);

        // 2. Update status in log table
        $this->db->where("id", $log_id);
        $this->db->update($table, ["status" => $status]);

        // If this is a cash EMI request, sync matching EMI schedule row status too.
        if ($source !== "emi") {
            $cash_notes = (string) ($log->notes ?? "");
            if (preg_match('/\[EMI:(\d+):(\d+)\]/i', $cash_notes, $m)) {
                $payment_id = (int) $m[1];
                $month_no = (int) $m[2];
                if ($payment_id > 0 && $month_no > 0) {
                    $emi_row = $this->db->order_by("id", "DESC")->get_where("emi_logs", [
                        "payment_id" => $payment_id,
                        "buyer_id" => (int) ($log->buyer_id ?? 0),
                        "plot_id" => (int) ($log->plot_id ?? 0),
                        "month_no" => $month_no
                    ])->row();

                    if ($emi_row) {
                        $this->db->where("id", (int) $emi_row->id)->update("emi_logs", [
                            "status" => $status,
                            "emi_amount" => (float) ($log->paid_amount ?? ($emi_row->emi_amount ?? 0))
                        ]);
                    }
                }
            }
        }

        // 3. Keep site values in sync only when approval state changes
        if ($old_status !== $new_status && $amount > 0) {
            // Get plot_id from log
            $plot_id = $log->plot_id;

            // Get site_id from plots table
            $plot = $this->db->get_where("plots", ["id" => $plot_id])->row();
            if ($plot) {
                $site_id = $plot->site_id;

                // Get current site values
                $site = $this->db->get_where("sites", ["id" => $site_id])->row();
                if ($site) {
                    $delta = 0;
                    if ($new_status === "approve" && $old_status !== "approve") {
                        $delta = $amount;
                    } elseif ($old_status === "approve" && $new_status !== "approve") {
                        $delta = -$amount;
                    }

                    $new_collected_value = (float) $site->collected_value + $delta;
                    $new_site_value = (float) $site->site_value - $delta;

                    // Update site table
                    $this->db->where("id", $site_id);
                    $this->db->update("sites", [
                        "collected_value" => $new_collected_value,
                        "site_value" => $new_site_value
                    ]);
                }
            }
        }


        echo json_encode(["status" => true, "message" => "Payment status updated successfully"]);
    }


    public function download_pdf($buyer_id)
    {

        if (!$buyer_id) {
            log_message('error', 'Invalid Buyer ID');
            show_error('Invalid Buyer');
        }

        $admin_id = $this->session->userdata('admin')['user_id'];

        // ---- Buyer ----
        $buyer = $this->db->get_where('buyer', ['id' => $buyer_id])->row();

        // ---- User ----
        $user = $this->db->select('name,business_name,email,mobile,address,profile_image')
            ->from('user_master')
            ->where('id', $admin_id)
            ->get()->row();


        // ---- Payment Logs ----
        $logs = $this->db->where('buyer_id', $buyer_id)
            ->where('status', 'approve')
            ->order_by('created_on', 'ASC')
            ->get('cash_payment_logs')
            ->result();

        // ---- Payment Details (for fallback down payment row) ----
        $payment = $this->db->order_by('id', 'DESC')
            ->get_where('payment_details', ['buyer_id' => $buyer_id])
            ->row();

        if ($payment) {
            $down_payment = (float) ($payment->down_payment ?? 0);
            $total_price = (float) ($payment->total_price ?? 0);
            if ($down_payment > 0) {
                $has_down_payment_in_logs = false;
                foreach ($logs as $lg) {
                    $paid = (float) ($lg->paid_amount ?? 0);
                    $note = strtolower((string) ($lg->notes ?? ''));
                    if (abs($paid - $down_payment) < 0.01 && strpos($note, 'down') !== false) {
                        $has_down_payment_in_logs = true;
                        break;
                    }
                }

                if (!$has_down_payment_in_logs) {
                    $entry = new stdClass();
                    $entry->id = 0;
                    $entry->buyer_id = $buyer_id;
                    $entry->plot_id = (int) ($payment->plot_id ?? 0);
                    $entry->paid_amount = $down_payment;
                    $entry->remaining_amount = max(0, $total_price - $down_payment);
                    $entry->total_price = $total_price;
                    $entry->notes = 'Initial down payment';
                    $entry->status = 'approve';
                    $entry->created_on = $payment->created_on ?? date('Y-m-d H:i:s');
                    $logs[] = $entry;
                }
            }
        }

        usort($logs, function ($a, $b) {
            $ta = strtotime((string) ($a->created_on ?? ''));
            $tb = strtotime((string) ($b->created_on ?? ''));
            if ($ta === $tb) {
                return ((int) ($a->id ?? 0)) <=> ((int) ($b->id ?? 0));
            }
            return $ta <=> $tb;
        });


        $data = [
            'buyer' => $buyer,
            'user' => $user,
            'logs' => $logs,
            'payment' => $payment
        ];


        // ---- Load View ----
        $html = $this->load->view('buyer_statement', $data, true);



        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'DejaVu Sans');

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');



        $dompdf->render();



        $dompdf->stream(
            "Buyer_Statement_{$buyer_id}.pdf",
            ["Attachment" => true]
        );
    }

    public function download_sample_format()
    {
        if (ob_get_length()) {
            ob_end_clean();
        }
        ob_start();

        require_once FCPATH . 'vendor/autoload.php';

        $admin_id = $this->admin['user_id'] ?? null;
        $site_id = (int) $this->input->get('site_id');
        $sample_site_name = 'Your Site Name';

        if ($admin_id && $site_id > 0) {
            $site = $this->db
                ->select('name')
                ->where('id', $site_id)
                ->where('admin_id', $admin_id)
                ->get('sites')
                ->row();

            if ($site && !empty($site->name)) {
                $sample_site_name = $site->name;
            }
        }

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'Site Name',
            'Plot Number',
            'Size',
            'Dimension',
            'Facing',
            'Price',
            'Status'
        ];

        $sheet->fromArray($headers, NULL, 'A1');

        $sheet->fromArray([
            $sample_site_name,
            'Plot 101',
            '1200',
            '30x40',
            'East',
            '500000',
            'available'
        ], NULL, 'A2');

        $filename = "plot_import_template.xlsx";

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Expires: 0');
        header('Pragma: public');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');

        exit;
    }
}
