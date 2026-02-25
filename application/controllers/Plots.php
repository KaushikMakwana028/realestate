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

        // 🔍 Duplicate check (Exclude current row)
        $this->db->where('site_id', $site_id);
        $this->db->where('plot_number', $plot_number);
        $this->db->where('id !=', $id);
        $exists = $this->db->get('plots')->row();

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

    public function import_plots()
    {
        header('Content-Type: application/json');

        $admin_id = $this->admin['user_id'] ?? null;
        if (!$admin_id) {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
            return;
        }

        $site_id = (int) $this->input->post('site_id');
        $rows_json = $this->input->post('rows');

        if ($site_id <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid site id']);
            return;
        }

        if (empty($rows_json)) {
            echo json_encode(['status' => 'error', 'message' => 'No import data found']);
            return;
        }

        $rows = json_decode($rows_json, true);
        if (!is_array($rows) || empty($rows)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid import data format']);
            return;
        }

        $existing_rows = $this->db->select('plot_number')
            ->from('plots')
            ->where('site_id', $site_id)
            ->where('isActive', 1)
            ->get()
            ->result();

        $existing_plot_numbers = [];
        foreach ($existing_rows as $existing) {
            $plot_number = trim((string) ($existing->plot_number ?? ''));
            if ($plot_number !== '') {
                $existing_plot_numbers[strtolower($plot_number)] = true;
            }
        }

        $insert_rows = [];
        $skipped_duplicates = 0;
        $skipped_empty = 0;

        foreach ($rows as $row) {
            if (!is_array($row)) {
                $skipped_empty++;
                continue;
            }

            $plot_number = $this->import_field($row['plot_number'] ?? null);
            $size = $this->import_field($row['size'] ?? null);
            $dimension = $this->import_field($row['dimension'] ?? null);
            $facing = $this->import_field($row['facing'] ?? null);
            $price = $this->import_number_field($row['price'] ?? null);
            $status = $this->normalize_import_status($row['status'] ?? null);

            if (
                $plot_number === null &&
                $size === null &&
                $dimension === null &&
                $facing === null &&
                $price === null
            ) {
                $skipped_empty++;
                continue;
            }

            if ($plot_number !== null) {
                $plot_key = strtolower($plot_number);
                if (isset($existing_plot_numbers[$plot_key])) {
                    $skipped_duplicates++;
                    continue;
                }
                $existing_plot_numbers[$plot_key] = true;
            }

            $insert_rows[] = [
                'admin_id' => $admin_id,
                'site_id' => $site_id,
                'plot_number' => $plot_number,
                'size' => $size,
                'dimension' => $dimension,
                'facing' => $facing,
                'price' => $price,
                'status' => $status,
                'isActive' => 1,
                'created_at' => date('Y-m-d')
            ];
        }

        if (empty($insert_rows)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'No valid rows to import',
                'inserted' => 0,
                'skipped_duplicates' => $skipped_duplicates,
                'skipped_empty' => $skipped_empty
            ]);
            return;
        }

        $this->db->trans_start();

        $chunks = array_chunk($insert_rows, 200);
        foreach ($chunks as $chunk) {
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
                'status' => 'error',
                'message' => 'Import failed. Please check the data format and try again.'
            ]);
            return;
        }

        echo json_encode([
            'status' => 'success',
            'message' => 'Plots imported successfully',
            'inserted' => count($insert_rows),
            'skipped_duplicates' => $skipped_duplicates,
            'skipped_empty' => $skipped_empty,
            'site_value' => $total_value
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
            return 'available';
        }

        $status = strtolower($clean);
        if ($status === 'sold') {
            return 'sold';
        }
        if ($status === 'booked' || $status === 'reserved' || $status === 'pending') {
            return 'booked';
        }

        return 'available';
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
        s.name AS site_name,
        b.id   AS buyer_id,
        b.name AS buyer_name
    ');

    $this->db->from('plots p');
    $this->db->join('sites s', 's.id = p.site_id', 'left');
    $this->db->join('buyer b', 'b.plot_id = p.id AND b.isActive = 1', 'left');

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
        elseif ($key == 'booked') $status_counts['booked'] += $row->total_count;
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
            'total_records'=> $total_records
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
            "plot_id" => $plot_id
        ])->result();

        foreach ($cash_logs as $log) {
            $total_paid += (float) $log->paid_amount;
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
        if ($payment && $payment->payment_mode == "EMI") {
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

        // 4. Fetch Payment Logs
        $this->db->from("cash_payment_logs");
        $this->db->where("buyer_id", $buyer_id);

        // Search
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("buyer_name", $search);
            $this->db->or_like("user_name", $search);
            $this->db->group_end();
        }

        $total_rows = $this->db->count_all_results("", false);
        $this->db->limit($limit, $offset);

        $logs = $this->db->get()->result();

        // Fallback: if no cash_payment_logs, show initial payment from payment_details
        if (empty($logs)) {
            $payment_details = $this->db->get_where("payment_details", [
                "buyer_id" => $buyer_id
            ])->row();

            if ($payment_details) {
                $logs = [
                    (object) [
                        "id" => null,
                        "paid_amount" => $payment_details->down_payment ?? 0,
                        "created_on" => $payment_details->created_on ?? $payment_details->created_at ?? date('Y-m-d'),
                        "status" => "approve",
                    ]
                ];

                $total_rows = 1;
                $page = 1;
            }
        }

        echo json_encode([
            "status" => true,
            "buyer" => $buyer,
            "user" => $user,
            "plot" => $plot,
            "logs" => $logs,
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

        if (!$log_id || !$status) {
            echo json_encode(["status" => false, "message" => "Invalid request"]);
            return;
        }

        // 1. Fetch payment log
        $log = $this->db->get_where("cash_payment_logs", ["id" => $log_id])->row();
        if (!$log) {
            echo json_encode(["status" => false, "message" => "Payment log not found"]);
            return;
        }

        // 2. Update status in log table
        $this->db->where("id", $log_id);
        $this->db->update("cash_payment_logs", ["status" => $status]);

        // 3. Only update site values if status is 'approve'
        if ($status === "approve") {
            // Get plot_id from log
            $plot_id = $log->plot_id;

            // Get site_id from plots table
            $plot = $this->db->get_where("plots", ["id" => $plot_id])->row();
            if ($plot) {
                $site_id = $plot->site_id;

                // Get current site values
                $site = $this->db->get_where("sites", ["id" => $site_id])->row();
                if ($site) {
                    // Add paid_amount to collected_value
                    $new_collected_value = (float) $site->collected_value + (float) $log->paid_amount;

                    // Subtract paid_amount from site_value
                    $new_site_value = (float) $site->site_value - (float) $log->paid_amount;

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

}
