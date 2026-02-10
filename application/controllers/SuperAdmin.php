<?php
require_once(APPPATH . 'core/My_Controller.php');

class SuperAdmin extends My_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (($this->admin['role'] ?? '') !== 'superadmin') {
            redirect('dashboard');
        }
    }

    public function admins()
    {
        $limit = 3;
        $page = (int) ($this->input->get('page') ?? 1);
        $search = trim($this->input->get('search') ?? '');

        if ($page < 1)
            $page = 1;
        $offset = ($page - 1) * $limit;

        $this->db->from('user_master');
        $this->db->where('role', 'admin');
        $this->db->where('isActive', 1);

        if (!empty($search)) {
            $this->db->group_start()
                ->like('name', $search)
                ->or_like('business_name', $search)
                ->or_like('email', $search)
                ->or_like('mobile', $search)
                ->group_end();
        }

        $total_records = $this->db->count_all_results('', FALSE);

        $this->db->select('id, name, business_name, email, mobile, profile_image, created_on, isActive');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        $data['super_admins'] = $this->db->get()->result();

        foreach ($data['super_admins'] as &$admin) {
            $admin->sites_count = $this->db->where('admin_id', $admin->id)->where('isActive', 1)->count_all_results('sites');
            $admin->plots_count = $this->db->where('admin_id', $admin->id)->where('isActive', 1)->count_all_results('plots');
            $admin->users_count = $this->db->where('admin_id', $admin->id)->where('isActive', 1)->count_all_results('users');
        }

        $data['admins_total_pages'] = (int) ceil($total_records / $limit);
        $data['admins_current_page'] = $page;
        $data['admin_start_index'] = $offset + 1;
        $data['admin_search'] = $search;   // ✅ IMPORTANT

        $this->load->view('header');
        $this->load->view('superadmin/admins_view', $data);
        $this->load->view('footer');
    }




    public function sites()
    {
        $limit = 5;
        $page = (int) ($this->input->get('page') ?? 1);
        $search = trim($this->input->get('search') ?? '');

        if ($page < 1)
            $page = 1;
        $offset = ($page - 1) * $limit;

        $this->db->from('sites s');
        $this->db->join('user_master um', 'um.id = s.admin_id', 'left');
        $this->db->where('s.isActive', 1);

        if (!empty($search)) {
            $this->db->group_start()
                ->like('s.name', $search)
                ->or_like('s.location', $search)
                ->or_like('um.name', $search)
                ->group_end();
        }

        $total_records = $this->db->count_all_results('', FALSE);

        $this->db->select('s.id, s.name, s.location, s.total_plots, s.site_images, s.site_images_pending, s.site_images_status, s.site_images_reason, s.site_map, s.admin_id, um.name as admin_name');
        $this->db->order_by('s.id', 'DESC');
        $this->db->limit($limit, $offset);
        $data['super_sites'] = $this->db->get()->result();

        foreach ($data['super_sites'] as &$site) {
            $expense = $this->db
                ->select("SUM(amount) AS site_expense")
                ->from("expenses")
                ->where("site_id", $site->id)
                ->where("status", "approve")
                ->get()
                ->row();
            $site->total_expenses = (float) ($expense->site_expense ?? 0);
        }

        $data['sites_total_pages'] = (int) ceil($total_records / $limit);
        $data['sites_current_page'] = $page;
        $data['site_start_index'] = $offset + 1;
        $data['site_search'] = $search;   // ✅ IMPORTANT

        $this->load->view('header');
        $this->load->view('superadmin/sites_view', $data);
        $this->load->view('footer');
    }



    public function get_admins()
    {
        header('Content-Type: application/json');

        $limit = 10;
        $page = (int) ($this->input->get('page') ?? $this->input->post('page') ?? 1);
        $search = trim((string) ($this->input->get('search') ?? $this->input->post('search') ?? ''));

        if ($page < 1) {
            $page = 1;
        }
        $offset = ($page - 1) * $limit;

        $this->db->from('user_master');
        $this->db->where('role', 'admin');
        $this->db->where('isActive', 1);
        if (!empty($search)) {
            $this->db->group_start()
                ->like('name', $search)
                ->or_like('business_name', $search)
                ->or_like('email', $search)
                ->or_like('mobile', $search)
                ->group_end();
        }
        $total_records = $this->db->count_all_results('', FALSE);

        $this->db->select('id, name, business_name, email, mobile, profile_image, created_on, isActive');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        $admins = $this->db->get()->result();

        foreach ($admins as &$admin) {
            $admin->sites_count = $this->db->where('admin_id', $admin->id)->where('isActive', 1)->count_all_results('sites');
            $admin->plots_count = $this->db->where('admin_id', $admin->id)->where('isActive', 1)->count_all_results('plots');
            $admin->users_count = $this->db->where('admin_id', $admin->id)->where('isActive', 1)->count_all_results('users');
        }
        unset($admin);

        echo json_encode([
            'status' => true,
            'data' => $admins,
            'pagination' => [
                'current_page' => $page,
                'total_pages' => (int) ceil($total_records / $limit),
                'total_records' => $total_records
            ]
        ]);
    }

    public function get_admin_detail($admin_id = null)
    {
        header('Content-Type: application/json');

        if (empty($admin_id) || !is_numeric($admin_id)) {
            echo json_encode(['status' => false, 'message' => 'Invalid admin id']);
            return;
        }

        $admin = $this->db
            ->select('id, name, business_name, email, mobile, profile_image, created_on, isActive')
            ->where('id', $admin_id)
            ->where('role', 'admin')
            ->get('user_master')
            ->row();

        if (!$admin) {
            echo json_encode(['status' => false, 'message' => 'Admin not found']);
            return;
        }

        $sites = $this->db
            ->select('id, name, location, area, total_plots, site_images, isActive, created_at')
            ->where('admin_id', $admin_id)
            ->where('isActive', 1)
            ->order_by('id', 'DESC')
            ->get('sites')
            ->result();

        foreach ($sites as &$site) {
            $images = [];
            if (!empty($site->site_images)) {
                $decoded = json_decode($site->site_images, true);
                if (is_array($decoded)) {
                    $images = $decoded;
                }
            }
            $site->images = $images;
            $site->plots = $this->db
                ->select('id, plot_number, size, dimension, facing, price, status')
                ->where('site_id', $site->id)
                ->where('isActive', 1)
                ->order_by('id', 'DESC')
                ->get('plots')
                ->result();
        }

        echo json_encode([
            'status' => true,
            'admin' => $admin,
            'sites' => $sites
        ]);
    }

    public function get_all_sites()
    {
        header('Content-Type: application/json');

        $limit = 5;
        $page = (int) ($this->input->get('page') ?? 1);
        $search = trim((string) ($this->input->get('search') ?? ''));

        if ($page < 1)
            $page = 1;
        $offset = ($page - 1) * $limit;

        // -------- COUNT TOTAL RECORDS (clean query) --------
        $this->db->from('sites s');
        $this->db->join('user_master um', 'um.id = s.admin_id', 'left');
        $this->db->where('s.isActive', 1);

        if (!empty($search)) {
            $this->db->group_start()
                ->like('s.name', $search)
                ->or_like('s.location', $search)
                ->or_like('um.name', $search)
                ->group_end();
        }

        $total_records = $this->db->count_all_results(); // ✅ CLEAN COUNT

        // -------- GET PAGINATED DATA (new fresh query) --------
        $this->db->select('s.id, s.name, s.location, s.total_plots, 
                       s.site_images, s.site_images_pending, s.site_images_status, s.site_images_reason, s.site_map, s.admin_id, 
                       um.name as admin_name');
        $this->db->from('sites s');
        $this->db->join('user_master um', 'um.id = s.admin_id', 'left');
        $this->db->where('s.isActive', 1);

        if (!empty($search)) {
            $this->db->group_start()
                ->like('s.name', $search)
                ->or_like('s.location', $search)
                ->or_like('um.name', $search)
                ->group_end();
        }

        $this->db->order_by('s.id', 'DESC');
        $this->db->limit($limit, $offset);
        $sites = $this->db->get()->result();

        // -------- ADD EXPENSES TO EACH SITE --------
        foreach ($sites as &$site) {
            $expense = $this->db
                ->select("SUM(amount) AS site_expense")
                ->from("expenses")
                ->where("site_id", $site->id)
                ->where("status", "approve")
                ->get()
                ->row();

            $site->total_expenses = (float) ($expense->site_expense ?? 0);
        }
        unset($site);

        echo json_encode([
            'status' => true,
            'data' => $sites,
            'pagination' => [
                'current_page' => $page,
                'total_pages' => (int) ceil($total_records / $limit),
                'total_records' => $total_records
            ]
        ]);
    }


    public function get_site_detail($site_id = null)
    {
        header('Content-Type: application/json');

        if (empty($site_id) || !is_numeric($site_id)) {
            echo json_encode(['status' => false, 'message' => 'Invalid site id']);
            return;
        }

        $site = $this->db
            ->select('s.id, s.name, s.location, s.area, s.total_plots, s.site_images, s.site_map, s.admin_id, um.name as admin_name')
            ->from('sites s')
            ->join('user_master um', 'um.id = s.admin_id', 'left')
            ->where('s.id', $site_id)
            ->where('s.isActive', 1)
            ->get()
            ->row();

        if (!$site) {
            echo json_encode(['status' => false, 'message' => 'Site not found']);
            return;
        }

        $site->has_map = !empty($site->site_map);

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
            ->where('isActive', 1)
            ->order_by('id', 'DESC')
            ->get()
            ->result();

        $plots = $this->db
            ->select('id, plot_number, size, dimension, facing, price, status')
            ->from('plots')
            ->where('site_id', $site_id)
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

    public function upload_site_map()
    {
        header('Content-Type: application/json');

        if (($this->admin['role'] ?? '') !== 'superadmin') {
            echo json_encode(['status' => false, 'message' => 'Unauthorized']);
            return;
        }

        $site_id = $this->input->post('site_id');
        if (empty($site_id) || !is_numeric($site_id)) {
            echo json_encode(['status' => false, 'message' => 'Invalid site id']);
            return;
        }

        if (empty($_FILES['site_map']['name'])) {
            echo json_encode(['status' => false, 'message' => 'Map file is required']);
            return;
        }

        $upload_path = FCPATH . 'uploads/sitemap/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }
        if (!is_writable($upload_path)) {
            echo json_encode(['status' => false, 'message' => 'Upload directory is not writable']);
            return;
        }

        $safe_name = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $_FILES['site_map']['name']);
        $config = [
            'upload_path' => $upload_path,
            'allowed_types' => 'json|geojson',
            'max_size' => 10240,
            'file_name' => time() . '_' . $safe_name,
            'overwrite' => TRUE
        ];

        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('site_map')) {
            $error = $this->upload->display_errors('', '');
            echo json_encode(['status' => false, 'message' => $error ?: 'Upload failed']);
            return;
        }

        $uploadData = $this->upload->data();
        $path = 'uploads/sitemap/' . $uploadData['file_name'];

        $updated = $this->db->where('id', $site_id)->update('sites', [
            'site_map' => $path
        ]);

        if (!$updated) {
            echo json_encode(['status' => false, 'message' => 'Failed to update site map']);
            return;
        }

        echo json_encode(['status' => true, 'message' => 'Map uploaded successfully', 'path' => $path]);
    }

    public function site_images_pending()
    {
        header('Content-Type: application/json');

        if (($this->admin['role'] ?? '') !== 'superadmin') {
            echo json_encode(['status' => false, 'message' => 'Unauthorized']);
            return;
        }

        $site_id = $this->input->post('site_id');
        if (empty($site_id) || !is_numeric($site_id)) {
            echo json_encode(['status' => false, 'message' => 'Invalid site id']);
            return;
        }

        $site = $this->db->select('site_images_pending, site_images_status, site_images_reason')
            ->where('id', $site_id)
            ->get('sites')
            ->row();

        $pending = [];
        if (!empty($site->site_images_pending)) {
            $decoded = json_decode($site->site_images_pending, true);
            if (is_array($decoded)) {
                $pending = $decoded;
            }
        }

        echo json_encode([
            'status' => true,
            'pending_images' => $pending,
            'image_status' => $site->site_images_status ?? '',
            'image_reason' => $site->site_images_reason ?? ''
        ]);
    }

    public function site_images_action()
    {
        header('Content-Type: application/json');

        if (($this->admin['role'] ?? '') !== 'superadmin') {
            echo json_encode(['status' => false, 'message' => 'Unauthorized']);
            return;
        }

        $site_id = $this->input->post('site_id');
        $action = $this->input->post('action');
        $reason = trim((string) $this->input->post('reason'));

        if (empty($site_id) || !is_numeric($site_id)) {
            echo json_encode(['status' => false, 'message' => 'Invalid site id']);
            return;
        }

        if (!in_array($action, ['approve', 'reject'], true)) {
            echo json_encode(['status' => false, 'message' => 'Invalid action']);
            return;
        }

        $site = $this->db->select('site_images, site_images_pending')
            ->where('id', $site_id)
            ->get('sites')
            ->row();

        $approved = [];
        if (!empty($site->site_images)) {
            $decoded = json_decode($site->site_images, true);
            if (is_array($decoded)) {
                $approved = $decoded;
            }
        }

        $pending = [];
        if (!empty($site->site_images_pending)) {
            $decoded = json_decode($site->site_images_pending, true);
            if (is_array($decoded)) {
                $pending = $decoded;
            }
        }

        if ($action === 'approve') {
            $merged = array_values(array_merge($approved, $pending));
            $this->db->where('id', $site_id)->update('sites', [
                'site_images' => json_encode($merged),
                'site_images_pending' => null,
                'site_images_status' => 'approve',
                'site_images_reason' => null
            ]);
            echo json_encode(['status' => true, 'message' => 'Images approved']);
            return;
        }

        $this->db->where('id', $site_id)->update('sites', [
            'site_images_pending' => null,
            'site_images_status' => 'reject',
            'site_images_reason' => $reason ?: 'Rejected by super admin'
        ]);

        echo json_encode(['status' => true, 'message' => 'Images rejected']);
    }
}
