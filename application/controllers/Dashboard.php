<?php
require_once(APPPATH . 'core/My_Controller.php');
class Dashboard extends My_Controller

{



    public function __construct()

    {

        parent::__construct();

      

    }





   public function index()
{
    $admin_id = $this->admin['user_id'];

    // Current counts
    $data['sites_count'] = $this->general_model->getCount('sites', [
        'isActive' => 1, 'admin_id' => $admin_id
    ]);

    $data['plots_count'] = $this->general_model->getCount('plots', [
        'isActive' => 1, 'admin_id' => $admin_id
    ]);

    $data['users_count'] = $this->general_model->getCount('users', [
        'isActive' => 1, 'admin_id' => $admin_id
    ]);

    $data['Inquiry_count'] = $this->general_model->getCount('inquiries', [
        'isActive' => 1, 'admin_id' => $admin_id
    ]);


    // 🔥 GET LAST WEEK COUNTS
    $data['sites_last_week'] = $this->general_model->getCount('sites', [
        'admin_id' => $admin_id,
        'isActive' => 1,
        'created_at >=' => date('Y-m-d', strtotime("-7 days"))
    ]);

    $data['plots_last_week'] = $this->general_model->getCount('plots', [
        'admin_id' => $admin_id,
        'isActive' => 1,
        'created_at >=' => date('Y-m-d', strtotime("-7 days"))
    ]);

    $data['users_last_week'] = $this->general_model->getCount('users', [
        'admin_id' => $admin_id,
        'isActive' => 1,
        'created_at >=' => date('Y-m-d', strtotime("-7 days"))
    ]);

    $data['inquiry_last_week'] = $this->general_model->getCount('inquiries', [
        'admin_id' => $admin_id,
        'isActive' => 1,
        'created_at >=' => date('Y-m-d', strtotime("-7 days"))
    ]);
// -----------------
// -------------
// EXPENSE SUMMARY (CURRENT MONTH)
// ------------------------------
$current_month = date('m');
$current_year  = date('Y');
$this->db->select_sum('amount');
$this->db->where('admin_id', $admin_id);
$this->db->where('isActive', 1);
$this->db->where('MONTH(date)', $current_month);
$this->db->where('YEAR(date)', $current_year);
$data['total_expense'] = (float)$this->db->get('expenses')->row()->amount;

// APPROVED EXPENSE
$this->db->select_sum('amount');
$this->db->where('admin_id', $admin_id);
$this->db->where('status', 'approve');
$this->db->where('MONTH(date)', $current_month);
$this->db->where('YEAR(date)', $current_year);
$data['approved_expense'] = (float)$this->db->get('expenses')->row()->amount;

// PENDING EXPENSE
$this->db->select_sum('amount');
$this->db->where('admin_id', $admin_id);
$this->db->where('status', 'pending');
$this->db->where('MONTH(date)', $current_month);
$this->db->where('YEAR(date)', $current_year);
$data['pending_expense'] = (float)$this->db->get('expenses')->row()->amount;

$this->db->where('admin_id', $admin_id);
$this->db->where('status', 'pending');
$this->db->where('MONTH(attendance_time)', $current_month);
$this->db->where('YEAR(attendance_time)', $current_year);
$data['attendance_pending'] = $this->db->count_all_results('attendance');
$this->db->where('admin_id', $admin_id);
$this->db->where('MONTH(attendance_time)', $current_month);
$this->db->where('YEAR(attendance_time)', $current_year);
$data['attendance_total'] = $this->db->count_all_results('attendance');

// ⭐ 2. Total Approved (present + approve + rejected)
$this->db->where('admin_id', $admin_id);
$this->db->where_in('status', ['present', 'absent', 'rejected']);
$this->db->where('MONTH(attendance_time)', $current_month);
$this->db->where('YEAR(attendance_time)', $current_year);
$data['attendance_approved'] = $this->db->count_all_results('attendance');

    $this->db->from('sites');
    $this->db->where('admin_id', $admin_id);
    $this->db->where('isActive', 1);
    $data['maps_total'] = $this->db->count_all_results();

    $this->db->from('sites');
    $this->db->where('admin_id', $admin_id);
    $this->db->where('isActive', 1);
    $this->db->where('site_map IS NOT NULL', null, false);
    $this->db->where('site_map !=', '');
    $data['maps_uploaded'] = $this->db->count_all_results();
    $data['maps_pending'] = max(0, $data['maps_total'] - $data['maps_uploaded']);

    $role = $this->admin['role'] ?? 'admin';
    $data['is_superadmin'] = ($role === 'superadmin');
    if ($data['is_superadmin']) {
        // Global counts (all admins)
        $data['sites_count'] = $this->general_model->getCount('sites', ['isActive' => 1]);
        $data['plots_count'] = $this->general_model->getCount('plots', ['isActive' => 1]);
        $data['Inquiry_count'] = $this->general_model->getCount('inquiries', ['isActive' => 1]);
        $data['admins_count'] = $this->general_model->getCount('user_master', [
            'role' => 'admin',
            'isActive' => 1
        ]);

        $data['sites_last_week'] = $this->general_model->getCount('sites', [
            'isActive' => 1,
            'created_at >=' => date('Y-m-d', strtotime("-7 days"))
        ]);
        $data['plots_last_week'] = $this->general_model->getCount('plots', [
            'isActive' => 1,
            'created_at >=' => date('Y-m-d', strtotime("-7 days"))
        ]);
        $data['inquiry_last_week'] = $this->general_model->getCount('inquiries', [
            'isActive' => 1,
            'created_at >=' => date('Y-m-d', strtotime("-7 days"))
        ]);
        $data['admins_last_week'] = $this->general_model->getCount('user_master', [
            'role' => 'admin',
            'isActive' => 1,
            'created_on >=' => date('Y-m-d', strtotime("-7 days"))
        ]);

        $this->db->select_sum('amount');
        $this->db->where('isActive', 1);
        $this->db->where('MONTH(date)', $current_month);
        $this->db->where('YEAR(date)', $current_year);
        $data['total_expense'] = (float)$this->db->get('expenses')->row()->amount;

        $this->db->select_sum('amount');
        $this->db->where('status', 'approve');
        $this->db->where('MONTH(date)', $current_month);
        $this->db->where('YEAR(date)', $current_year);
        $data['approved_expense'] = (float)$this->db->get('expenses')->row()->amount;

        $this->db->select_sum('amount');
        $this->db->where('status', 'pending');
        $this->db->where('MONTH(date)', $current_month);
        $this->db->where('YEAR(date)', $current_year);
        $data['pending_expense'] = (float)$this->db->get('expenses')->row()->amount;

        $this->db->where('status', 'pending');
        $this->db->where('MONTH(attendance_time)', $current_month);
        $this->db->where('YEAR(attendance_time)', $current_year);
        $data['attendance_pending'] = $this->db->count_all_results('attendance');

        $this->db->where('MONTH(attendance_time)', $current_month);
        $this->db->where('YEAR(attendance_time)', $current_year);
        $data['attendance_total'] = $this->db->count_all_results('attendance');

        $this->db->where_in('status', ['present', 'absent', 'rejected']);
        $this->db->where('MONTH(attendance_time)', $current_month);
        $this->db->where('YEAR(attendance_time)', $current_year);
        $data['attendance_approved'] = $this->db->count_all_results('attendance');

        $this->db->from('sites');
        $this->db->where('isActive', 1);
        $data['maps_total'] = $this->db->count_all_results();

        $this->db->from('sites');
        $this->db->where('isActive', 1);
        $this->db->where('site_map IS NOT NULL', null, false);
        $this->db->where('site_map !=', '');
        $data['maps_uploaded'] = $this->db->count_all_results();
        $data['maps_pending'] = max(0, $data['maps_total'] - $data['maps_uploaded']);

        $this->db->from('sites');
        $this->db->where('isActive', 1);
        $this->db->where('site_images_status', 'pending');
        $data['image_requests_pending'] = $this->db->count_all_results();

        // Server-side data for super admin tables (fallback if JS fails)
        $data['super_admins'] = $this->db
            ->select('id, name, business_name, email, mobile, profile_image, created_on, isActive')
            ->where('role', 'admin')
            ->where('isActive', 1)
            ->order_by('id', 'DESC')
            ->get('user_master')
            ->result();

        foreach ($data['super_admins'] as &$admin) {
            $admin->sites_count = $this->db->where('admin_id', $admin->id)->where('isActive', 1)->count_all_results('sites');
            $admin->plots_count = $this->db->where('admin_id', $admin->id)->where('isActive', 1)->count_all_results('plots');
            $admin->users_count = $this->db->where('admin_id', $admin->id)->where('isActive', 1)->count_all_results('users');
        }
        unset($admin);

        $data['super_sites'] = $this->db
            ->select('s.id, s.name, s.location, s.total_plots, s.site_images, s.admin_id, um.name as admin_name')
            ->from('sites s')
            ->join('user_master um', 'um.id = s.admin_id', 'left')
            ->where('s.isActive', 1)
            ->order_by('s.id', 'DESC')
            ->get()
            ->result();

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
    }
    // Load role-wise dashboard view
    if (!empty($data['is_superadmin'])) {
        $this->load->view('superadmin/header');
        $this->load->view('superadmin/superadmin_dashboard_view', $data);
        $this->load->view('superadmin/footer');
    } else {
        $this->load->view('header');
        $this->load->view('dashboard_view', $data);
        $this->load->view('footer');
    }
}

public function get_admins()
{
    header('Content-Type: application/json');

    if (($this->admin['role'] ?? '') !== 'superadmin') {
        echo json_encode(['status' => false, 'message' => 'Unauthorized']);
        return;
    }

    $admins = $this->db
        ->select('id, name, business_name, email, mobile, profile_image, created_on, isActive')
        ->where('role', 'admin')
        ->where('isActive', 1)
        ->order_by('id', 'DESC')
        ->get('user_master')
        ->result();

    foreach ($admins as &$admin) {
        $admin->sites_count = $this->db->where('admin_id', $admin->id)->where('isActive', 1)->count_all_results('sites');
        $admin->plots_count = $this->db->where('admin_id', $admin->id)->where('isActive', 1)->count_all_results('plots');
        $admin->users_count = $this->db->where('admin_id', $admin->id)->where('isActive', 1)->count_all_results('users');
    }

    echo json_encode(['status' => true, 'data' => $admins]);
}

public function get_admin_detail($admin_id = null)
{
    header('Content-Type: application/json');

    if (($this->admin['role'] ?? '') !== 'superadmin') {
        echo json_encode(['status' => false, 'message' => 'Unauthorized']);
        return;
    }

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

    if (($this->admin['role'] ?? '') !== 'superadmin') {
        echo json_encode(['status' => false, 'message' => 'Unauthorized']);
        return;
    }

    $sites = $this->db
        ->select('s.id, s.name, s.location, s.total_plots, s.site_images, s.admin_id, um.name as admin_name')
        ->from('sites s')
        ->join('user_master um', 'um.id = s.admin_id', 'left')
        ->where('s.isActive', 1)
        ->order_by('s.id', 'DESC')
        ->get()
        ->result();

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

    echo json_encode(['status' => true, 'data' => $sites]);
}

public function get_site_detail($site_id = null)
{
    header('Content-Type: application/json');

    if (($this->admin['role'] ?? '') !== 'superadmin') {
        echo json_encode(['status' => false, 'message' => 'Unauthorized']);
        return;
    }

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

public function inquiry(){
    $this->load->view('header');
    $this->load->view('inquiry_view');
    $this->load->view('footer');
}

public function add_inquiry_web()
{
    header('Content-Type: application/json');
    
    $admin_id = $this->admin['user_id'];
    $user_id = $this->session->userdata('user_id'); // Current logged-in user
    
    $site_id = (int)$this->input->post('site_id');
    $customer_name = trim($this->input->post('customer_name'));
    $mobile = trim($this->input->post('mobile'));
    $address = trim($this->input->post('address'));
    $note = trim($this->input->post('note'));
    $status = trim($this->input->post('status')) ?: 'pending';
    
    $follow_up_date = null;
    $follow_up_time = null;
    $follow_up_remarks = null;

    if ($status === 'follow-up') {
        $follow_up_date = $this->input->post('follow_up_date') ? trim($this->input->post('follow_up_date')) : null;
        $follow_up_time = $this->input->post('follow_up_time') ? trim($this->input->post('follow_up_time')) : null;
        $follow_up_remarks = $this->input->post('follow_up_remarks') ? trim($this->input->post('follow_up_remarks')) : null;
    }
    
    // Validation
    if (empty($site_id) || empty($customer_name) || empty($mobile)) {
        echo json_encode([
            'status' => false,
            'message' => 'Site, customer name, and mobile are required'
        ]);
        return;
    }
    
    // Validate mobile
    if (!preg_match('/^[0-9]{10}$/', $mobile)) {
        echo json_encode([
            'status' => false,
            'message' => 'Please enter a valid 10-digit mobile number'
        ]);
        return;
    }
    
    // Check duplicate inquiry
    $exists = $this->db->get_where('inquiries', [
        'site_id' => $site_id,
        'mobile' => $mobile,
        'isActive' => 1
    ])->row();
    
    if ($exists) {
        echo json_encode([
            'status' => false,
            'message' => 'Inquiry for this site and mobile already exists'
        ]);
        return;
    }
    
    // Insert inquiry
    $data = [
        'admin_id' => $admin_id,
        'user_id' => $user_id,
        'site_id' => $site_id,
        'plot_id' => 0,
        'customer_name' => $customer_name,
        'mobile' => $mobile,
        'address' => $address,
        'note' => $note,
        'status' => $status,
        'follow_up_date' => $follow_up_date,
        'follow_up_time' => $follow_up_time,
        'follow_up_remarks' => $follow_up_remarks,
        'isActive' => 1,
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    if ($this->db->insert('inquiries', $data)) {
        echo json_encode([
            'status' => true,
            'message' => 'Inquiry added successfully'
        ]);
    } else {
        echo json_encode([
            'status' => false,
            'message' => 'Failed to add inquiry'
        ]);
    }
}

// Update inquiry function for web
public function update_inquiry_web()
{
    header('Content-Type: application/json');
    
    $admin_id = $this->admin['user_id'];
    $inquiry_id = (int)$this->input->post('inquiry_id');
    $site_id = (int)$this->input->post('site_id');
    $customer_name = trim($this->input->post('customer_name'));
    $mobile = trim($this->input->post('mobile'));
    $address = trim($this->input->post('address'));
    $note = trim($this->input->post('note'));
    $status = trim($this->input->post('status'));
    
    $follow_up_date = null;
    $follow_up_time = null;
    $follow_up_remarks = null;

    if ($status === 'follow-up') {
        $follow_up_date = $this->input->post('follow_up_date') ? trim($this->input->post('follow_up_date')) : null;
        $follow_up_time = $this->input->post('follow_up_time') ? trim($this->input->post('follow_up_time')) : null;
        $follow_up_remarks = $this->input->post('follow_up_remarks') ? trim($this->input->post('follow_up_remarks')) : null;
    }
    
    // Validation
    if (empty($inquiry_id) || empty($site_id) || empty($customer_name) || empty($mobile)) {
        echo json_encode([
            'status' => false,
            'message' => 'All required fields must be filled'
        ]);
        return;
    }
    
    // Check if inquiry exists
    $inquiry = $this->db->get_where('inquiries', [
        'id' => $inquiry_id,
        'admin_id' => $admin_id,
        'isActive' => 1
    ])->row();
    
    if (!$inquiry) {
        echo json_encode([
            'status' => false,
            'message' => 'Inquiry not found'
        ]);
        return;
    }
    
    // Check duplicate (exclude current inquiry)
    $this->db->where('site_id', $site_id);
    $this->db->where('mobile', $mobile);
    $this->db->where('id !=', $inquiry_id);
    $this->db->where('isActive', 1);
    $exists = $this->db->get('inquiries')->row();
    
    if ($exists) {
        echo json_encode([
            'status' => false,
            'message' => 'Another inquiry with same site and mobile already exists'
        ]);
        return;
    }
    
    // Update inquiry
    $data = [
        'site_id' => $site_id,
        'plot_id' => 0,
        'customer_name' => $customer_name,
        'mobile' => $mobile,
        'address' => $address,
        'note' => $note,
        'status' => $status,
        'follow_up_date' => $follow_up_date,
        'follow_up_time' => $follow_up_time,
        'follow_up_remarks' => $follow_up_remarks
    ];
    
    $this->db->where('id', $inquiry_id);
    if ($this->db->update('inquiries', $data)) {
        echo json_encode([
            'status' => true,
            'message' => 'Inquiry updated successfully'
        ]);
    } else {
        echo json_encode([
            'status' => false,
            'message' => 'Failed to update inquiry'
        ]);
    }
}

// Updated fetch_inquiries function with status filter
public function fetch_inquiries()
{
    header('Content-Type: application/json');

    $page   = intval($this->input->post("page")) ?: 1;
$search = trim($this->input->post("search") ?? '');
$month_filter = trim($this->input->post("month_filter") ?? '');
$status_filter = trim($this->input->post("status_filter") ?? '');
    $site_filter = intval($this->input->post("site_filter"));
   
    $limit  = 10;
    $offset = ($page - 1) * $limit;

    $admin_id = $this->admin['user_id'];
    $month = 0;
    $year = 0;
    if (!empty($month_filter) && preg_match('/^\d{4}-\d{2}$/', $month_filter)) {
        list($year_raw, $month_raw) = explode('-', $month_filter);
        $year = (int)$year_raw;
        $month = (int)$month_raw;
    } else {
        $month_filter = '';
    }

    $this->db->select("inquiries.*, 
                       users.name AS user_name,
                       sites.name,
                       plots.plot_number");
    $this->db->from("inquiries");
    $this->db->join("users", "users.id = inquiries.user_id", "left");
    $this->db->join("sites", "sites.id = inquiries.site_id", "left");
    $this->db->join("plots", "plots.id = inquiries.plot_id", "left");

    $this->db->where("inquiries.admin_id", $admin_id);
    $this->db->where("inquiries.isActive", 1);

    if (!empty($search)) {
        $this->db->group_start();
        $this->db->like("users.name", $search);
        $this->db->or_like("sites.name", $search);
        $this->db->or_like("plots.plot_number", $search);
        $this->db->or_like("inquiries.customer_name", $search);
        $this->db->or_like("inquiries.mobile", $search);
        $this->db->group_end();
    }
    if ($site_filter > 0) {
        $this->db->where("inquiries.site_id", $site_filter);
    }
    if (!empty($month_filter)) {
        $this->db->where("MONTH(inquiries.created_at)", $month);
        $this->db->where("YEAR(inquiries.created_at)", $year);
    }
    if (!empty($status_filter)) { // NEW
        $this->db->where("inquiries.status", $status_filter);
    }

    $total = $this->db->count_all_results("", FALSE);

    $this->db->limit($limit, $offset);
    $this->db->order_by("inquiries.id", "DESC");

    $data = $this->db->get()->result();

    $today = date('Y-m-d');
    $dayOfWeek = (int) date('N');
    $week_start = date('Y-m-d', strtotime('-' . ($dayOfWeek - 1) . ' days'));

    $applyInquiryScope = function () use ($admin_id, $search, $site_filter, $month_filter, $status_filter, $month, $year) {
        $this->db->from("inquiries");
        $this->db->join("users", "users.id = inquiries.user_id", "left");
        $this->db->join("sites", "sites.id = inquiries.site_id", "left");
        $this->db->join("plots", "plots.id = inquiries.plot_id", "left");
        $this->db->where("inquiries.admin_id", $admin_id);
        $this->db->where("inquiries.isActive", 1);

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("users.name", $search);
            $this->db->or_like("sites.name", $search);
            $this->db->or_like("plots.plot_number", $search);
            $this->db->or_like("inquiries.customer_name", $search);
            $this->db->or_like("inquiries.mobile", $search);
            $this->db->group_end();
        }
        if ($site_filter > 0) {
            $this->db->where("inquiries.site_id", $site_filter);
        }
        if (!empty($month_filter)) {
            $this->db->where("MONTH(inquiries.created_at)", $month);
            $this->db->where("YEAR(inquiries.created_at)", $year);
        }
        if (!empty($status_filter)) { // NEW
            $this->db->where("inquiries.status", $status_filter);
        }
    };

    $applyInquiryScope();
    $total_enquiries = (int) $this->db->count_all_results();

    $applyInquiryScope();
    $today_enquiries = (int) $this->db
        ->where("DATE(inquiries.created_at) = '{$today}'", NULL, FALSE)
        ->count_all_results();

    $applyInquiryScope();
    $week_enquiries = (int) $this->db
        ->where("DATE(inquiries.created_at) >= '{$week_start}'", NULL, FALSE)
        ->where("DATE(inquiries.created_at) <= '{$today}'", NULL, FALSE)
        ->count_all_results();

    $applyInquiryScope();
    $pending_enquiries = (int) $this->db
        ->where('inquiries.status', 'pending')
        ->count_all_results();

    // Site options
    $this->db->select("id, name");
    $this->db->from("sites");
    $this->db->where("admin_id", $admin_id);
    if ($this->db->field_exists('isActive', 'sites')) {
        $this->db->where("isActive", 1);
    }
    $this->db->order_by("name", "ASC");
    $site_options = $this->db->get()->result();

    echo json_encode([
        "status" => true,
        "data"   => $data,
        "total"  => $total,
        "limit"  => $limit,
        "page"   => $page,
        "stats"  => [
            "total_enquiries" => $total_enquiries,
            "today_enquiries" => $today_enquiries,
            "week_enquiries" => $week_enquiries,
            "pending_enquiries" => $pending_enquiries
        ],
        "site_options" => $site_options
    ]);
}

// Get plots by site
public function get_plots_by_site()
{
    header('Content-Type: application/json');
    
    $site_id = (int)$this->input->post('site_id');
    $admin_id = $this->admin['user_id'];
    
    if (empty($site_id)) {
        echo json_encode(['status' => false, 'data' => []]);
        return;
    }
    
    $this->db->select('id, plot_number');
    $this->db->from('plots');
    $this->db->where('site_id', $site_id);
    $this->db->where('isActive', 1);
    $this->db->order_by('plot_number', 'ASC');
    $plots = $this->db->get()->result();
    
    echo json_encode([
        'status' => true,
        'data' => $plots
    ]);
}

// Updated API add_inquiry with status
public function add_inquiry()
{
    header('Content-Type: application/json');

    $authHeader = $this->input->get_request_header('Authorization', TRUE);
    $token = null;
    if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
        $token = $matches[1];
    }

    $decoded = $this->verify_jwt($token);
    if (!$decoded || empty($decoded->data->id)) {
        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'status' => false,
                'code' => 400,
                'message' => 'Invalid token or user ID missing',
                'data' => null
            ]));
    }

    $user_id = (int) $decoded->data->id;

    $user = $this->db->select('admin_id')->where('id', $user_id)->get('users')->row();
    if (!$user) {
        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'status' => false,
                'code' => 400,
                'message' => 'User not found',
                'data' => null
            ]));
    }
    $admin_id = (int) $user->admin_id;

    $input = json_decode($this->input->raw_input_stream, true);
    $site_id = isset($input['site_id']) ? (int) $input['site_id'] : null;
    $plot_id = isset($input['plot_id']) ? (int) $input['plot_id'] : null;
    $customer_name = trim((string) ($input['customer_name'] ?? ''));
    $mobile = trim((string) ($input['mobile'] ?? ''));
    $address = trim((string) ($input['address'] ?? ''));
    $note = trim((string) ($input['note'] ?? ''));
    $status = isset($input['status']) ? trim($input['status']) : 'pending'; // NEW

    if (empty($site_id) || empty($plot_id) || $customer_name === '' || $mobile === '') {
        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'status' => false,
                'code' => 400,
                'message' => 'Site, plot, customer name, and mobile are required',
                'data' => null
            ]));
    }

    $site_belongs = $this->db->get_where('site_assignments', [
        'site_id' => $site_id,
        'user_id' => $user_id,
        'admin_id' => $admin_id
    ])->row();

    if (!$site_belongs) {
        return $this->output
            ->set_status_header(403)
            ->set_output(json_encode([
                'status' => false,
                'code' => 403,
                'message' => 'You are not assigned to this site',
                'data' => null
            ]));
    }

    $plot_exists = $this->db->get_where('plots', [
        'id' => $plot_id,
        'site_id' => $site_id,
        'isActive' => 1
    ])->row();

    if (!$plot_exists) {
        return $this->output
            ->set_status_header(404)
            ->set_output(json_encode([
                'status' => false,
                'code' => 404,
                'message' => 'Invalid plot ID or plot not found under this site',
                'data' => null
            ]));
    }

    $exists = $this->db->get_where('inquiries', [
        'site_id' => $site_id,
        'plot_id' => $plot_id,
        'mobile' => $mobile,
        'isActive' => 1
    ])->row();

    if ($exists) {
        return $this->output
            ->set_status_header(409)
            ->set_output(json_encode([
                'status' => false,
                'code' => 409,
                'message' => 'Inquiry for this plot and mobile already exists',
                'data' => null
            ]));
    }

    $data = [
        'admin_id' => $admin_id,
        'user_id' => $user_id,
        'site_id' => $site_id,
        'plot_id' => $plot_id,
        'customer_name' => $customer_name,
        'mobile' => $mobile,
        'address' => $address,
        'note' => $note,
        'status' => $status, // NEW
        'isActive' => 1,
        'created_at' => date('Y-m-d H:i:s')
    ];

    if ($this->db->insert('inquiries', $data)) {
        return $this->output
            ->set_status_header(200)
            ->set_output(json_encode([
                'status' => true,
                'code' => 200,
                'message' => 'Inquiry added successfully',
                'data' => $data
            ]));
    }

    return $this->output
        ->set_status_header(500)
        ->set_output(json_encode([
            'status' => false,
            'code' => 500,
            'message' => 'Failed to add inquiry',
            'data' => null
        ]));
}

// Updated API inquiry_list with status
public function inquiry_list()
{
    header('Content-Type: application/json');

    $authHeader = $this->input->get_request_header('Authorization', TRUE);
    $token = null;
    if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
        $token = $matches[1];
    }
    $decoded = $this->verify_jwt($token);
    if (!$decoded || empty($decoded->data->id)) {
        return $this->output->set_status_header(401)->set_output(json_encode([
            'status' => false,
            'code' => 401,
            'message' => 'Unauthorized user',
        ]));
    }

    $user_id = (int) $decoded->data->id;

    $inquiries = $this->db
        ->select('i.*, s.name, p.plot_number')
        ->from('inquiries i')
        ->join('sites s', 's.id = i.site_id', 'left')
        ->join('plots p', 'p.id = i.plot_id', 'left')
        ->where('i.user_id', $user_id)
        ->where('i.isActive', 1)
        ->order_by('i.id', 'DESC')
        ->get()
        ->result();

    if ($inquiries) {
        return $this->output->set_status_header(200)->set_output(json_encode([
            'status' => true,
            'code' => 200,
            'message' => 'Inquiries fetched successfully',
            'data' => $inquiries
        ]));
    } else {
        return $this->output->set_status_header(404)->set_output(json_encode([
            'status' => false,
            'code' => 404,
            'message' => 'No inquiries found',
            'data' => []
        ]));
    }
}
public function attedance(){
    $this->load->view('header');
    $this->load->view('attedance_view');
    $this->load->view('footer');
}

   public function delete_inquiry()
{
    $id = $this->input->post('id');

    if (!$id) {
        echo json_encode([
            "status" => false,
            "message" => "Invalid Inquiry ID"
        ]);
        return;
    }

    // Soft delete (Update isActive = 0)
    $update = $this->db->where("id", $id)->update("inquiries", [
        "isActive" => 0
    ]);

    if ($update) {
        echo json_encode([
            "status" => true,
            "message" => "Inquiry deleted successfully"
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Failed to delete inquiry"
        ]);
    }
}
public function fetch_attendance()
{
    header('Content-Type: application/json');

    $page   = intval($this->input->post("page")) ?: 1;
    $search = trim($this->input->post("search"));
    $date_filter = trim($this->input->post("date_filter"));
    $month_filter = trim($this->input->post("month_filter"));
    $status_filter = strtolower(trim($this->input->post("status_filter")));
    $limit  = 10;
    $offset = ($page - 1) * $limit;

    $admin_id = $this->admin['user_id'];
    $month = 0;
    $year = 0;
    if (!empty($month_filter) && preg_match('/^\d{4}-\d{2}$/', $month_filter)) {
        list($year_raw, $month_raw) = explode('-', $month_filter);
        $year = (int)$year_raw;
        $month = (int)$month_raw;
    } else {
        $month_filter = '';
    }

    $allowed_statuses = ['present', 'absent', 'pending', 'rejected', 'late'];
    if (!in_array($status_filter, $allowed_statuses, true)) {
        $status_filter = '';
    }

    $this->db->select("attendance.*, users.name AS user_name, users.mobile");
    $this->db->from("attendance");
    $this->db->join("users", "users.id = attendance.user_id", "left");
    $this->db->where("attendance.admin_id", $admin_id);
    $this->db->where("attendance.isActive", 1);

    if (!empty($search)) {
        $this->db->group_start();
        $this->db->like("users.name", $search);
        $this->db->or_like("users.mobile", $search);
        $this->db->group_end();
    }

    if (!empty($month_filter)) {
        $this->db->where("MONTH(attendance.attendance_time)", $month);
        $this->db->where("YEAR(attendance.attendance_time)", $year);
    } else if (!empty($date_filter)) {
        $this->db->where("DATE(attendance.attendance_time) =", $date_filter, false);
    }

    if (!empty($status_filter)) {
        $this->db->where("LOWER(attendance.status)", $status_filter);
    }

    $total = $this->db->count_all_results("", FALSE);
    $this->db->limit($limit, $offset);
    $this->db->order_by('attendance.id', 'DESC');
    $data = $this->db->get()->result();

    // Cards should follow the same active scope as the table (search + date/month),
    // but should not be restricted by status filter so distribution remains visible.
    $applyAttendanceScope = function () use ($admin_id, $search, $month_filter, $month, $year, $date_filter) {
        $this->db->from('attendance');
        $this->db->join("users", "users.id = attendance.user_id", "left");
        $this->db->where("attendance.admin_id", $admin_id);
        $this->db->where("attendance.isActive", 1);

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("users.name", $search);
            $this->db->or_like("users.mobile", $search);
            $this->db->group_end();
        }

        if (!empty($month_filter)) {
            $this->db->where("MONTH(attendance.attendance_time)", $month);
            $this->db->where("YEAR(attendance.attendance_time)", $year);
        } else if (!empty($date_filter)) {
            $this->db->where("DATE(attendance.attendance_time) =", $date_filter, false);
        }
    };

    $this->db->select('COUNT(DISTINCT attendance.user_id) AS total_users', false);
    $applyAttendanceScope();
    $total_employees = (int) ($this->db->get()->row()->total_users ?? 0);

    $applyAttendanceScope();
    $present_today = (int) $this->db
        ->where('LOWER(attendance.status)', 'present')
        ->count_all_results();

    $applyAttendanceScope();
    $late_arrivals = (int) $this->db
        ->group_start()
        ->where('LOWER(attendance.status)', 'pending')
        ->or_where('LOWER(attendance.status)', 'late')
        ->group_end()
        ->count_all_results();

    $applyAttendanceScope();
    $absent_today = (int) $this->db
        ->group_start()
        ->where('LOWER(attendance.status)', 'absent')
        ->or_where('LOWER(attendance.status)', 'rejected')
        ->group_end()
        ->count_all_results();

    echo json_encode([
        "status" => true,
        "data"   => $data,
        "total"  => $total,
        "limit"  => $limit,
        "page"   => $page,
        "stats" => [
            "total_employees" => $total_employees,
            "present_today" => $present_today,
            "late_arrivals" => $late_arrivals,
            "absent_today" => $absent_today
        ]
    ]);
}
public function delete_attendance()
{
    $id = $this->input->post("id");

    $this->db->where("id", $id);
    $this->db->update("attendance", ["isActive" => 0]);

    echo json_encode(["status" => true]);
}
public function update_status()
{
    $id = $this->input->post('id');
    $status = $this->input->post('status');

    // Validate inputs
    if (!$id || !$status) {
        echo json_encode([
            "status" => false,
            "message" => "Invalid request"
        ]);
        return;
    }

    // Custom SQL Query
    $sql = "UPDATE attendance SET status = ? WHERE id = ?";
    $updated = $this->db->query($sql, array($status, $id));

    if ($updated) {
        echo json_encode([
            "status" => true,
            "message" => "Attendance status updated successfully!"
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Failed to update status."
        ]);
    }
}

public function plans()
{
    $this->config->load('razorpay');
    $data['plans'] = $this->db->where('isActive', 1)->get('plans')->result();
    
    $this->load->view('header');
    $this->load->view('plans_view', $data);
    $this->load->view('footer');
}

public function verify_payment()
{
    $this->config->load('razorpay');
    $keyId = $this->config->item('razorpay_key_id');
    $keySecret = $this->config->item('razorpay_key_secret');

    $paymentId = $this->input->post('razorpay_payment_id');
    $planId = (int)$this->input->post('plan_id');

    if (empty($paymentId) || empty($planId)) {
        echo json_encode(['status' => false, 'message' => 'Missing parameter values.']);
        return;
    }

    // Fetch plan details
    $plan = $this->db->where(['id' => $planId, 'isActive' => 1])->get('plans')->row();
    if (!$plan) {
        echo json_encode(['status' => false, 'message' => 'Plan not found or inactive.']);
        return;
    }

    // Verify payment using Razorpay cURL API
    $url = 'https://api.razorpay.com/v1/payments/' . $paymentId;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERPWD, $keyId . ':' . $keySecret);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200) {
        $paymentData = json_decode($response, true);
        if (isset($paymentData['status']) && in_array($paymentData['status'], ['captured', 'authorized'])) {
            // Verify amount match (convert plan price to paise)
            $expectedAmount = round($plan->price * 100);
            if (intval($paymentData['amount']) >= $expectedAmount) {
                
                // Insert into user_subscriptions
                $sub_data = [
                    'user_id' => $this->admin['user_id'],
                    'plan_id' => $plan->id,
                    'plan_name' => $plan->name,
                    'price' => $plan->price,
                    'start_date' => date('Y-m-d'),
                    'end_date' => date('Y-m-d', strtotime('+' . $plan->duration_days . ' days')),
                    'payment_status' => 'success',
                    'razorpay_payment_id' => $paymentId,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('user_subscriptions', $sub_data);

                // Update session
                $days_left = (int) ceil((strtotime($sub_data['end_date']) - strtotime(date('Y-m-d'))) / 86400);
                $this->session->set_userdata('subscription_active', true);
                $this->session->set_userdata('subscription_days_left', $days_left);
                $this->session->set_userdata('subscription_plan_name', $sub_data['plan_name']);
                $this->session->set_userdata('subscription_end_date', $sub_data['end_date']);

                echo json_encode(['status' => true, 'message' => 'Subscription active!']);
                return;
            } else {
                echo json_encode(['status' => false, 'message' => 'Incorrect payment amount.']);
                return;
            }
        } else {
            echo json_encode(['status' => false, 'message' => 'Payment status is: ' . ($paymentData['status'] ?? 'unknown')]);
            return;
        }
    } else {
        echo json_encode(['status' => false, 'message' => 'Failed to verify payment with Razorpay. Code: ' . $httpCode]);
        return;
    }
}

}
?>
