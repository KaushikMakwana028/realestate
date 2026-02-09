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
        $limit = 10;
        $page = 1;
        $offset = 0;

        $this->db->from('user_master');
        $this->db->where('role', 'admin');
        $this->db->where('isActive', 1);
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
        unset($admin);
        $data['admins_total_pages'] = (int) ceil($total_records / $limit);
        $data['admins_current_page'] = $page;

        $this->load->view('header');
        $this->load->view('superadmin/admins_view', $data);
        $this->load->view('footer');
    }

    public function sites()
    {
        $limit = 10;
        $page = 1;
        $offset = 0;

        $this->db->from('sites s');
        $this->db->join('user_master um', 'um.id = s.admin_id', 'left');
        $this->db->where('s.isActive', 1);
        $total_records = $this->db->count_all_results('', FALSE);

        $this->db->select('s.id, s.name, s.location, s.total_plots, s.site_images, s.admin_id, um.name as admin_name');
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
        unset($site);
        $data['sites_total_pages'] = (int) ceil($total_records / $limit);
        $data['sites_current_page'] = $page;

        $this->load->view('header');
        $this->load->view('superadmin/sites_view', $data);
        $this->load->view('footer');
    }

    public function get_admins()
    {
        header('Content-Type: application/json');

        $limit = 10;
        $page = (int) $this->input->get('page');
        $search = trim($this->input->get('search'));

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
                'total_pages' => ceil($total_records / $limit),
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

        $limit = 10;
        $page = (int) $this->input->get('page');
        $search = trim($this->input->get('search'));

        if ($page < 1) {
            $page = 1;
        }
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

        $this->db->select('s.id, s.name, s.location, s.total_plots, s.site_images, s.admin_id, um.name as admin_name');
        $this->db->order_by('s.id', 'DESC');
        $this->db->limit($limit, $offset);
        $sites = $this->db->get()->result();

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
                'total_pages' => ceil($total_records / $limit),
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
            ->select('s.id, s.name, s.location, s.area, s.total_plots, s.site_images, s.admin_id, um.name as admin_name')
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
}
