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
    // Load views
    $this->load->view('header');
    $this->load->view('dashboard_view', $data);
    $this->load->view('footer');
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

public function fetch_inquiries()
{
    header('Content-Type: application/json');

    $page   = intval($this->input->post("page")) ?: 1;
    $search = trim($this->input->post("search"));
    $limit  = 10;
    $offset = ($page - 1) * $limit;

    $admin_id = $this->admin['user_id'];

    $this->db->select("inquiries.*, 
                       users.name AS user_name,
                       sites.name,
                       plots.plot_number");
    $this->db->from("inquiries");
    $this->db->join("users", "users.id = inquiries.user_id", "left");
    $this->db->join("sites", "sites.id = inquiries.site_id", "left");
    $this->db->join("plots", "plots.id = inquiries.plot_id", "left");

    $this->db->where("inquiries.admin_id", $admin_id);
    $this->db->where("inquiries.isActive", 1); // <-- Only active inquiries

    if (!empty($search)) {
        $this->db->group_start();
        $this->db->like("users.name", $search);
        $this->db->or_like("sites.site_name", $search);
        $this->db->or_like("plots.plot_number", $search);
        $this->db->or_like("inquiries.customer_name", $search);
        $this->db->group_end();
    }

    $total = $this->db->count_all_results("", FALSE);

    $this->db->limit($limit, $offset);

    $data = $this->db->get()->result();

    echo json_encode([
        "status" => true,
        "data"   => $data,
        "total"  => $total,
        "limit"  => $limit,
        "page"   => $page
    ]);
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
    $limit  = 10;
    $offset = ($page - 1) * $limit;

    $admin_id = $this->admin['user_id'];

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

    $total = $this->db->count_all_results("", FALSE);
    $this->db->limit($limit, $offset);
    $data = $this->db->get()->result();

    echo json_encode([
        "status" => true,
        "data"   => $data,
        "total"  => $total,
        "limit"  => $limit,
        "page"   => $page
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


}  

?>
