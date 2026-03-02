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
        b.name AS buyer_name
    ');

        $this->db->from('plots p');
        $this->db->join('sites s', 's.id = p.site_id', 'left');
        // Pick only the latest active buyer row per plot to avoid duplicate plot rows.
        $this->db->join(
            'buyer b',
            'b.id = (SELECT MAX(b2.id) FROM buyer b2 WHERE b2.plot_id = p.id AND b2.isActive = 1)',
            'left'
        );

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

    public function buyer_details($plot_id)
    {
        // 1. Fetch Buyer
        $buyer = $this->db->get_where("buyer", [
            "plot_id" => $plot_id,
            "isActive" => 1
        ])->row();

        if (!$buyer) {
            show_404();
            return;
        }

        // 2. Fetch Payment Details
        $payment = $this->db->get_where("payment_details", [
            "plot_id" => $plot_id
        ])->row();
        // 3A. Calculate remaining amount (from cash logs)
        $total_paid = 0;

        $cash_logs = $this->db->get_where("cash_payment_logs", [
            "plot_id" => $plot_id,
            "status" => "approve"
        ])->result();

        foreach ($cash_logs as $log) {
            $total_paid += (float) $log->paid_amount;
        }

        // Fallback for older records where initial down payment is only in payment_details
        if ($total_paid <= 0 && $payment && isset($payment->down_payment)) {
            $total_paid = (float) $payment->down_payment;
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
            $emi = $this->db->order_by("month_no", "ASC")
                ->get_where("emi_logs", ["plot_id" => $plot_id])
                ->result();
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
            "remaining_amount" => $remaining_amount
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

        $this->db->from("emi_logs");
        $this->db->where("buyer_id", $buyer_id);
        if (!empty($payment_ids)) {
            $this->db->where_in("payment_id", $payment_ids);
        }
        $this->db->order_by("month_no", "ASC");
        $emi_logs = $this->db->get()->result();

        $merged_logs = [];

        foreach ($cash_logs as $log) {
            $log->log_source = "cash";
            $log->created_on = $log->created_on ?? ($log->created_at ?? null);
            $log->paid_amount = (float) ($log->paid_amount ?? 0);
            $merged_logs[] = $log;
        }

        foreach ($emi_logs as $emi) {
            $entry = new stdClass();
            $entry->id = $emi->id;
            $entry->log_source = "emi";
            $entry->buyer_id = $emi->buyer_id;
            $entry->plot_id = $emi->plot_id;
            $entry->paid_amount = (float) ($emi->emi_amount ?? 0);
            $entry->status = $emi->status ?? "pending";
            $entry->created_on = $emi->emi_date ?? ($emi->created_on ?? null);
            $entry->month_no = $emi->month_no ?? null;
            $entry->notes = "EMI installment" . (!empty($entry->month_no) ? (" #" . $entry->month_no) : "");
            $merged_logs[] = $entry;
        }

        // Summary cards data for payment_data view
        $total_installments = count($emi_logs);
        $approved_installments = 0;
        $pending_amount = 0.0;
        $receiving_amount = 0.0;

        foreach ($emi_logs as $emi) {
            $emi_status = strtolower((string) ($emi->status ?? "pending"));
            $emi_amount = (float) ($emi->emi_amount ?? 0);
            if ($emi_status === "approve") {
                $approved_installments++;
                $receiving_amount += $emi_amount;
            } else {
                $pending_amount += $emi_amount;
            }
        }

        foreach ($cash_logs as $cash) {
            $cash_status = strtolower((string) ($cash->status ?? "pending"));
            if ($cash_status === "approve") {
                $receiving_amount += (float) ($cash->paid_amount ?? 0);
            }
        }

        $remaining_installments = max(0, $total_installments - $approved_installments);

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

        usort($merged_logs, function ($a, $b) {
            $ta = strtotime((string) ($a->created_on ?? ""));
            $tb = strtotime((string) ($b->created_on ?? ""));

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
                "receiving_amount" => $receiving_amount
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
        $user = $this->db->select('business_name,email,mobile,profile_image')
            ->from('user_master')
            ->where('id', $admin_id)
            ->get()->row();


        // ---- Payment Logs ----
        $logs = $this->db->where('buyer_id', $buyer_id)
            ->where('status', 'approve')
            ->order_by('created_on', 'ASC')
            ->get('cash_payment_logs')
            ->result();


        $data = [
            'buyer' => $buyer,
            'user' => $user,
            'logs' => $logs
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
