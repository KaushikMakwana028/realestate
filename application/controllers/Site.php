<?php
require_once(APPPATH . 'core/My_Controller.php');
class Site extends My_Controller
{



    public function __construct()
    {

        parent::__construct();



    }





    public function index()
    {

        $this->load->view('header');

        $this->load->view('site_view');

        $this->load->view('footer');

    }
    public function get_sites()
    {
        header('Content-Type: application/json');

        $limit = 10;
        $page = (int) $this->input->get('page');
        $search = trim($this->input->get('search'));

        if ($page < 1)
            $page = 1;
        $offset = ($page - 1) * $limit;

        // Logged-in Admin ID
        $admin_id = $this->admin['user_id'];

        // ------------------------------
        // BASE QUERY FOR SITES
        // ------------------------------
    $this->db->from('sites');
    $this->db->where('admin_id', $admin_id);

        if (!empty($search)) {
            $this->db->group_start()
                ->like('name', $search)
                ->or_like('location', $search)
                ->group_end();
        }

        // COUNT RESULTS
        $total_records = $this->db->count_all_results('', FALSE);

        // ORDER & LIMIT
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);

        // FETCH SITES
        $sites = $this->db->get()->result();

        // Add plot counts + SITE-WISE EXPENSE LOGIC
        foreach ($sites as &$site) {

            // Total Plots
            $site->total_plots = $this->db
                ->where('site_id', $site->id)
                ->where('admin_id', $admin_id)
                ->where('isActive', 1)
                ->count_all_results('plots');

            // ----------------------------------
            // ⭐ SITE-WISE APPROVED EXPENSES
            // ----------------------------------
            $expense = $this->db
                ->select("SUM(amount) AS site_expense")
                ->from("expenses")
                ->where("admin_id", $admin_id)
                ->where("site_id", $site->id)
                ->where("status", "approve")
                ->get()
                ->row();

            $site->total_expenses = (float) ($expense->site_expense ?? 0);
        }

        // ------------------------------
        // ⭐ TOTAL APPROVED EXPENSES (ALL SITES)
        // ------------------------------
        $expense_row = $this->db
            ->select("SUM(amount) AS total_expense")
            ->from("expenses")
            ->where("admin_id", $admin_id)
            ->where("status", "approve")
            ->get()
            ->row();

        $total_expenses = $expense_row->total_expense ?? 0;

        // Pagination
        $total_pages = ceil($total_records / $limit);

        // RESPONSE
        echo json_encode([
            'status' => true,
            'code' => 200,
            'message' => 'Sites fetched successfully',
            'data' => $sites,
            'total_expenses' => (float) $total_expenses,   // TOTAL (all sites)

            'pagination' => [
                'current_page' => $page,
                'total_pages' => $total_pages,
                'total_records' => $total_records
            ]
        ]);
    }



    public function expenses()
    {
       

        $this->load->view('header');
        $this->load->view('expenses_view'); // ← Send it here
        $this->load->view('footer');
    }

    public function get_expenses()
    {
        $admin_id = $this->admin['user_id'];

        $page = $this->input->post('page') ?? 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $search = trim((string) $this->input->post('search'));
        $site_id = $this->input->post('site_id');
        $month_filter = trim((string) $this->input->post('month_filter'));
        if (!preg_match('/^\d{4}-\d{2}$/', $month_filter)) {
            $month_filter = '';
        }
        $search_like = $this->db->escape_like_str($search);

        /* ----------------------------------------------
           COUNT QUERY
        ---------------------------------------------- */
        $this->db->from('expenses');
        $this->db->join('sites', 'sites.id = expenses.site_id', 'left');
        $this->db->join('users', 'users.id = expenses.user_id', 'left');
        $this->db->join('user_master', 'user_master.id = expenses.admin_id', 'left');
        $this->db->where('expenses.admin_id', $admin_id);
        $this->db->where('expenses.isActive', 1);  // Only active

        if (!empty($site_id)) {
            $this->db->where('expenses.site_id', $site_id);
        }

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('expenses.description', $search);
            $this->db->or_like('sites.name', $search);
            $this->db->or_like('users.name', $search);
            $this->db->or_like('user_master.name', $search);
            $this->db->or_like('expenses.status', $search);
            $this->db->or_like('expenses.date', $search);
            $this->db->or_where("CAST(expenses.amount AS CHAR) LIKE '%{$search_like}%'", null, false);
            $this->db->group_end();
        }

        if ($month_filter !== '') {
            $safe_month = $this->db->escape($month_filter);
            $this->db->where(
                "(DATE_FORMAT(STR_TO_DATE(`date`, '%Y-%m-%d'), '%Y-%m') = {$safe_month} OR DATE_FORMAT(STR_TO_DATE(`date`, '%d-%m-%Y'), '%Y-%m') = {$safe_month})",
                null,
                false
            );
        }

        $total = $this->db->count_all_results();


        /* ----------------------------------------------
           DATA QUERY
        ---------------------------------------------- */
    $this->db->select('
        expenses.*, 
        sites.name AS site_name,
        expenses.expense_image AS expense_image,
        COALESCE(users.name, user_master.name) AS user_name
    ');
    $this->db->from('expenses');

    // joins
    $this->db->join('sites', 'sites.id = expenses.site_id', 'left');
    $this->db->join('users', 'users.id = expenses.user_id', 'left');
    $this->db->join('user_master', 'user_master.id = expenses.admin_id', 'left');

        // filters
        $this->db->where('expenses.admin_id', $admin_id);
        $this->db->where('expenses.isActive', 1); // Important fix

        if (!empty($site_id)) {
            $this->db->where('expenses.site_id', $site_id);
        }

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('expenses.description', $search);
            $this->db->or_like('sites.name', $search);
            $this->db->or_like('users.name', $search);
            $this->db->or_like('user_master.name', $search);
            $this->db->or_like('expenses.status', $search);
            $this->db->or_like('expenses.date', $search);
            $this->db->or_where("CAST(expenses.amount AS CHAR) LIKE '%{$search_like}%'", null, false);
            $this->db->group_end();
        }

        if ($month_filter !== '') {
            $safe_month = $this->db->escape($month_filter);
            $this->db->where(
                "(DATE_FORMAT(STR_TO_DATE(expenses.date, '%Y-%m-%d'), '%Y-%m') = {$safe_month} OR DATE_FORMAT(STR_TO_DATE(expenses.date, '%d-%m-%Y'), '%Y-%m') = {$safe_month})",
                null,
                false
            );
        }

        $this->db->order_by('expenses.id', 'DESC');
        $this->db->limit($limit, $offset);

        $records = $this->db->get()->result();

        $this->db->select('status, COUNT(*) AS total_count, COALESCE(SUM(amount), 0) AS total_amount');
        $this->db->from('expenses');
        $this->db->join('sites', 'sites.id = expenses.site_id', 'left');
        $this->db->join('users', 'users.id = expenses.user_id', 'left');
        $this->db->join('user_master', 'user_master.id = expenses.admin_id', 'left');
        $this->db->where('expenses.admin_id', $admin_id);
        $this->db->where('expenses.isActive', 1);

        if (!empty($site_id)) {
            $this->db->where('expenses.site_id', $site_id);
        }

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('expenses.description', $search);
            $this->db->or_like('sites.name', $search);
            $this->db->or_like('users.name', $search);
            $this->db->or_like('user_master.name', $search);
            $this->db->or_like('expenses.status', $search);
            $this->db->or_like('expenses.date', $search);
            $this->db->or_where("CAST(expenses.amount AS CHAR) LIKE '%{$search_like}%'", null, false);
            $this->db->group_end();
        }

        if ($month_filter !== '') {
            $safe_month = $this->db->escape($month_filter);
            $this->db->where(
                "(DATE_FORMAT(STR_TO_DATE(`date`, '%Y-%m-%d'), '%Y-%m') = {$safe_month} OR DATE_FORMAT(STR_TO_DATE(`date`, '%d-%m-%Y'), '%Y-%m') = {$safe_month})",
                null,
                false
            );
        }

        $this->db->group_by('status');
        $summaryRows = $this->db->get()->result();

        $summary = [
            'approved_count' => 0,
            'approved_amount' => 0,
            'pending_count' => 0,
            'pending_amount' => 0,
            'rejected_count' => 0,
            'rejected_amount' => 0
        ];

        foreach ($summaryRows as $s) {
            $status = strtolower((string) ($s->status ?? ''));
            if ($status === 'approve' || $status === 'approved') {
                $summary['approved_count'] = (int) ($s->total_count ?? 0);
                $summary['approved_amount'] = (float) ($s->total_amount ?? 0);
            } elseif ($status === 'pending') {
                $summary['pending_count'] = (int) ($s->total_count ?? 0);
                $summary['pending_amount'] = (float) ($s->total_amount ?? 0);
            } else if ($status === 'reject' || $status === 'rejected') {
                $summary['rejected_count'] = (int) ($s->total_count ?? 0);
                $summary['rejected_amount'] = (float) ($s->total_amount ?? 0);
            }
        }

        /* ----------------------------------------------
           RESPONSE
        ---------------------------------------------- */
        echo json_encode([
            "status" => true,
            "records" => $records,
            "total" => $total,
            "limit" => $limit,
            "page" => $page,
            "summary" => $summary
        ]);
    }



    // ➤ DELETE EXPENSE
    public function delete($id)
    {
        $this->db->where('id', $id)->update('expenses', [
            "isActive" => 0
        ]);

        echo json_encode(["status" => true]);
    }


    // ➤ UPDATE STATUS
    public function update_status()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');

        $this->db->where('id', $id)->update('expenses', [
            "status" => $status
        ]);

        echo json_encode(["status" => true]);
    }

    public function update_expense()
    {
        header('Content-Type: application/json');

        $admin_id = $this->admin['user_id'] ?? null;
        if (!$admin_id) {
            echo json_encode(['status' => false, 'message' => 'Unauthorized access']);
            return;
        }

        $id = (int) $this->input->post('id');
        $amount = trim((string) $this->input->post('price'));
        $desc = trim((string) $this->input->post('description'));
        $date = trim((string) $this->input->post('date'));

        if (empty($id) || $amount === '' || $desc === '' || $date === '') {
            echo json_encode(['status' => false, 'message' => 'All fields are required']);
            return;
        }

        $expense = $this->db
            ->where('id', $id)
            ->where('admin_id', $admin_id)
            ->where('isActive', 1)
            ->get('expenses')
            ->row();

        if (!$expense) {
            echo json_encode(['status' => false, 'message' => 'Expense not found']);
            return;
        }

        $update_data = [
            'amount' => $amount,
            'description' => $desc,
            'date' => $date
        ];

        if (!empty($_FILES['expense_image']['name'])) {
            $upload_path = FCPATH . 'uploads/expenses/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }

            $safe_name = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $_FILES['expense_image']['name']);
            $config = [
                'upload_path' => $upload_path,
                'allowed_types' => 'jpg|jpeg|png|webp',
                'max_size' => 4096,
                'file_name' => time() . '_' . $safe_name
            ];

            $this->load->library('upload');
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('expense_image')) {
                echo json_encode([
                    'status' => false,
                    'message' => $this->upload->display_errors('', '') ?: 'Expense image upload failed'
                ]);
                return;
            }

            $uploadData = $this->upload->data();
            $update_data['expense_image'] = 'uploads/expenses/' . $uploadData['file_name'];
        }

        $updated = $this->db
            ->where('id', $id)
            ->where('admin_id', $admin_id)
            ->update('expenses', $update_data);

        if ($updated) {
            echo json_encode(['status' => true, 'message' => 'Expense updated successfully']);
            return;
        }

        echo json_encode(['status' => false, 'message' => 'Failed to update expense']);
    }

    public function get_users()
{
    header('Content-Type: application/json');

    $admin_id = $this->input->get('admin_id'); // get admin id from ajax

    $this->db->select('id, name');
    $this->db->from('users');
    $this->db->where('isActive', 1);

    if (!empty($admin_id)) {
        $this->db->where('admin_id', $admin_id); // filter by admin
    }

    $users = $this->db->get()->result();

    echo json_encode([
        'status' => true,
        'data'   => $users
    ]);
}


    public function get_site_images()
    {
        header('Content-Type: application/json');
        $site_id = $this->input->post('site_id');
        if (empty($site_id)) {
            echo json_encode(['status' => false, 'images' => []]);
            return;
        }

        $admin_id = $this->admin['user_id'];
        $site = $this->db->select('site_images')
            ->where('id', $site_id)
            ->where('admin_id', $admin_id)
            ->get('sites')
            ->row();

        $images = [];
        if (!empty($site->site_images)) {
            $decoded = json_decode($site->site_images, true);
            if (is_array($decoded)) {
                $images = $decoded;
            }
        }

        echo json_encode(['status' => true, 'images' => $images]);
    }

    public function get_site_detail($site_id = null)
    {
        header('Content-Type: application/json');

        if (empty($site_id) || !is_numeric($site_id)) {
            echo json_encode(['status' => false, 'message' => 'Invalid site id']);
            return;
        }

        $admin_id = $this->admin['user_id'];

        $site = $this->db
            ->select('s.id, s.name, s.location, s.area, s.total_plots, s.site_images, s.site_map, s.listed_map, s.admin_id')
            ->from('sites s')
            ->where('s.id', $site_id)
            ->where('s.admin_id', $admin_id)
            ->where('s.isActive', 1)
            ->get()
            ->row();

        if (!$site) {
            echo json_encode(['status' => false, 'message' => 'Site not found']);
            return;
        }

        $site->has_map = ((int) ($site->listed_map ?? 0) === 1) || !empty($site->site_map);

        $images = [];
        if (!empty($site->site_images)) {
            $decoded = json_decode($site->site_images, true);
            if (is_array($decoded)) {
                $images = $decoded;
            }
        }

        $expenses = $this->db
            ->select('id, description, date, amount, status')
            ->from('expenses')
            ->where('site_id', $site_id)
            ->where('admin_id', $admin_id)
            ->where('isActive', 1)
            ->order_by('id', 'DESC')
            ->get()
            ->result();

        $plots = $this->db
            ->select('id, plot_number, size, dimension, facing, price, status')
            ->from('plots')
            ->where('site_id', $site_id)
            ->where('admin_id', $admin_id)
            ->where('isActive', 1)
            ->order_by('id', 'DESC')
            ->get()
            ->result();

        echo json_encode([
            'status' => true,
            'site' => $site,
            'images' => $images,
            'expenses' => $expenses,
            'plots' => $plots
        ]);
    }
    public function assign_site()
    {
        header('Content-Type: application/json');
        $site_id = $this->input->post('site_id');
        $user_id = $this->input->post('user_id');
        $admin_id = $this->input->post('admin_id');

        if (!$site_id || !$user_id) {
            echo json_encode(['status' => false, 'message' => 'Missing parameters']);
            return;
        }

        // ✅ Fetch admin_id if not provided in POST
        if (empty($admin_id)) {
            $site = $this->db->select('admin_id')->where('id', $site_id)->get('sites')->row();
            $admin_id = $site ? $site->admin_id : null;
        }

        if (!$admin_id) {
            echo json_encode(['status' => false, 'message' => 'Admin not found for this site']);
            return;
        }

        // ✅ Check if already assigned
        $exists = $this->db->where('site_id', $site_id)
            ->where('user_id', $user_id)
            ->get('site_assignments')
            ->row();

        if ($exists) {
            echo json_encode(['status' => false, 'message' => 'Already assigned']);
            return;
        }

        // ✅ Insert assignment
        $this->db->insert('site_assignments', [
            'site_id' => $site_id,
            'user_id' => $user_id,
            'admin_id' => $admin_id,
            'assigned_at' => date('Y-m-d H:i:s')
        ]);

        echo json_encode(['status' => true, 'message' => 'Site assigned successfully']);
    }





    public function add_site()
    {
        $this->load->view('header');

        $this->load->view('site_form');

        $this->load->view('footer');
    }

    public function save_site()
    {
        header('Content-Type: application/json');
        $response = ['status' => 'error', 'message' => 'Something went wrong'];

        // ✅ Check if admin is logged in
        $admin_id = $this->admin['user_id'];
        if (!$admin_id) {
            $response['message'] = 'Unauthorized access';
            echo json_encode($response);
            return;
        }

        // ✅ Get POST data
        $site_name = trim($this->input->post('site_name'));
        $location = trim($this->input->post('location'));
        $area = trim($this->input->post('area'));
        $total_plots = trim($this->input->post('total_plots'));

        // ✅ Validation
        if (empty($site_name) || empty($location) || empty($area) || empty($total_plots)) {
            $response['message'] = 'All fields are required';
            echo json_encode($response);
            return;
        }

        // ✅ Check if site already exists (optional duplicate check)
        $exists = $this->general_model->getOne('sites', ['name' => $site_name, 'location' => $location]);
        if ($exists) {
            $response['message'] = 'Site with this name and location already exists';
            echo json_encode($response);
            return;
        }

        // ✅ Prepare data
        $data = [
            'admin_id' => $admin_id,
            'name' => $site_name,
            'location' => $location,
            'area' => $area,
            'total_plots' => $total_plots,
            'listed_map' => 0,
            'isActive' => 1, // Default active
            'created_at' => date('Y-m-d')
        ];

        // ✅ Insert data
        $site_id = $this->general_model->insert('sites', $data);
        if ($site_id) {
            $upload = $this->handle_site_images_upload();
            if (!empty($upload['error'])) {
                $response['message'] = $upload['error'];
                echo json_encode($response);
                return;
            }
            if (!empty($upload['paths'])) {
                $this->append_pending_site_images($site_id, $upload['paths']);
            }
            $response = ['status' => 'success', 'message' => 'Site added successfully'];
        } else {
            $response['message'] = 'Failed to add site';
        }

        echo json_encode($response);
    }

    public function edit_site($id)
    {
        // Fetch site record
        $site = $this->db->where('id', $id)->get('sites')->row();
        $images = [];
        if (!empty($site->site_images)) {
            $decoded = json_decode($site->site_images, true);
            if (is_array($decoded)) {
                $images = $decoded;
            }
        }

        $pending_images = [];
        if (!empty($site->site_images_pending)) {
            $decoded_pending = json_decode($site->site_images_pending, true);
            if (is_array($decoded_pending)) {
                $pending_images = $decoded_pending;
            }
        }

        // Load view with data
        $this->load->view('header');
        $this->load->view('edit_site_form', [
            'site' => $site,
            'images' => $images,
            'pending_images' => $pending_images
        ]);
        $this->load->view('footer');
    }
    public function update_site($id)
    {
        $site = $this->db->select('site_images, site_images_pending')->where('id', $id)->get('sites')->row();
        $existing_images = [];
        if (!empty($site->site_images)) {
            $decoded = json_decode($site->site_images, true);
            if (is_array($decoded)) {
                $existing_images = $decoded;
            }
        }

        $data = [
            'name' => $this->input->post('site_name'),
            'location' => $this->input->post('location'),
            'area' => $this->input->post('area'),
            'total_plots' => $this->input->post('total_plots')
        ];

        // Only update isActive if it is explicitly posted
        $posted_isActive = $this->input->post('isActive');
        if ($posted_isActive !== null && $posted_isActive !== '') {
            $data['isActive'] = $posted_isActive;
        }

        // Optional: handle new site images
        $upload = $this->handle_site_images_upload();
        if (!empty($upload['error'])) {
            echo json_encode(['status' => false, 'message' => $upload['error']]);
            return;
        }

        if (!empty($upload['paths'])) {
            $this->append_pending_site_images($id, $upload['paths']);
        }

        $updated = $this->db->where('id', $id)->update('sites', $data);

        if ($updated) {
            echo json_encode(['status' => true, 'message' => 'Site updated successfully']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to update site']);
        }
    }

    private function handle_site_images_upload()
    {
        if (empty($_FILES['site_images']['name'][0])) {
            return ['error' => null, 'paths' => []];
        }

        $upload_path = FCPATH . 'uploads/sites/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        $config = [
            'upload_path' => $upload_path,
            'allowed_types' => 'jpg|jpeg|png|webp',
            'max_size' => 2048,
        ];

        $this->load->library('upload');

        $files = $_FILES['site_images'];
        $count = count($files['name']);
        $paths = [];

        for ($i = 0; $i < $count; $i++) {
            if (empty($files['name'][$i])) {
                continue;
            }

            $_FILES['site_image_single'] = [
                'name' => $files['name'][$i],
                'type' => $files['type'][$i],
                'tmp_name' => $files['tmp_name'][$i],
                'error' => $files['error'][$i],
                'size' => $files['size'][$i],
            ];

            $config['file_name'] = time() . '_' . $i . '_' . $files['name'][$i];
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('site_image_single')) {
                return ['error' => $this->upload->display_errors('', ''), 'paths' => []];
            }

            $uploadData = $this->upload->data();
            $paths[] = 'uploads/sites/' . $uploadData['file_name'];
        }

        return ['error' => null, 'paths' => $paths];
    }

    private function append_pending_site_images($site_id, array $paths)
    {
        if (empty($paths)) {
            return;
        }

        $site = $this->db->select('site_images_pending')->where('id', $site_id)->get('sites')->row();
        $pending = [];
        if (!empty($site->site_images_pending)) {
            $decoded = json_decode($site->site_images_pending, true);
            if (is_array($decoded)) {
                $pending = $decoded;
            }
        }

        $pending = array_values(array_merge($pending, $paths));

        $this->db->where('id', $site_id)->update('sites', [
            'site_images_pending' => json_encode($pending),
            'site_images_status' => 'pending',
            'site_images_reason' => null
        ]);
    }


    public function delete_site($id = null)
    {
        header('Content-Type: application/json');

        // ✅ Check if ID is valid
        if (empty($id) || !is_numeric($id)) {
            echo json_encode([
                'status' => false,
                'code' => 400,
                'message' => 'Invalid or missing site ID'
            ]);
            return;
        }

        // ✅ Check if site exists
        $site = $this->db->where('id', $id)->get('sites')->row();
        if (!$site) {
            echo json_encode([
                'status' => false,
                'code' => 400,
                'message' => 'Site not found'
            ]);
            return;
        }

        // ✅ Soft delete: set isActive = 0
        $this->db->where('id', $id);
        $this->db->update('sites', ['isActive' => 0]);

        if ($this->db->affected_rows() > 0) {
            echo json_encode([
                'status' => true,
                'code' => 200,
                'message' => 'Site deleted successfully'
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'code' => 400,
                'message' => 'Failed to delete site or already inactive'
            ]);
        }
    }

    public function add_expenses()
    {
        $data['sites'] = $this->general_model->getAll('sites', ['isActive' => '1']);

        $this->load->view('header');
        $this->load->view('add_expenses_form', $data);
        $this->load->view('footer');
    }

    public function save_exp()
    {
        header('Content-Type: application/json');
        $response = ['status' => 'error', 'message' => 'Something went wrong'];


        $admin_id = $this->admin['user_id'] ?? null;
        if (!$admin_id) {
            $response['message'] = 'Unauthorized access';
            echo json_encode($response);
            return;
        }

        $site_id = $this->input->post('site_id');
        $amount = trim($this->input->post('price'));
        $desc = trim($this->input->post('description'));
        $date = trim($this->input->post('date'));
        $expense_image = null;

        if (!empty($_FILES['expense_image']['name'])) {
            $upload_path = FCPATH . 'uploads/expenses/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }

            $safe_name = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $_FILES['expense_image']['name']);
            $config = [
                'upload_path' => $upload_path,
                'allowed_types' => 'jpg|jpeg|png|webp',
                'max_size' => 4096,
                'file_name' => time() . '_' . $safe_name
            ];

            $this->load->library('upload');
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('expense_image')) {
                echo json_encode([
                    'status' => 'error',
                    'message' => $this->upload->display_errors('', '') ?: 'Expense image upload failed'
                ]);
                return;
            }

            $uploadData = $this->upload->data();
            $expense_image = 'uploads/expenses/' . $uploadData['file_name'];
        }

        $data = [
            'admin_id' => $admin_id,
            'site_id' => $site_id,
            'amount' => $amount,
            'description' => $desc,
            'date' => $date,
            'expense_image' => $expense_image,
            'status' => 'approve',
            'isActive' => 1,
            'created_at' => date('Y-m-d')
        ];

        $insert_id = $this->general_model->insert('expenses', $data);

        if ($insert_id) {
            $response = [
                'status' => 'success',
                'message' => 'expense added successfully',

            ];

        } else {
            $response['message'] = 'Failed to add expense';
        }

        echo json_encode($response);
    }





}

?>
