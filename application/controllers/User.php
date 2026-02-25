<?php
require_once(APPPATH . 'core/My_Controller.php');
class User extends My_Controller

{



    public function __construct()

    {

        parent::__construct();

      

    }





    public function index(){

        $this->load->view('header');

        $this->load->view('user_view');

        $this->load->view('footer');

    }
      public function add_user(){

        $this->load->view('header');

        $this->load->view('user_form');

        $this->load->view('footer');

    }
    public function add_upad() {
    $admin_id = $this->admin['user_id'];

    // Fetch user from users table
    $admin = $this->db->get_where("users", ["id" => $admin_id])->row();

    // Pass data to view
    $data = [
        "admin" => $admin
    ];

    $this->load->view('header');
    $this->load->view('upad_form', $data); 
    $this->load->view('footer');
}
public function save_upad()
{
    $admin_id = $this->admin['user_id'];

    $user_id = $this->input->post("user_id");
    $amount  = $this->input->post("amount");
    $notes   = $this->input->post("notes");

    if (!$user_id || !$amount) {
        echo json_encode([
            "status" => false,
            "message" => "User & Amount are required"
        ]);
        return;
    }

    $data = [
        "user_id"   => $user_id,
        "admin_id"  => $admin_id,
        "amount"    => $amount,
        "notes"     => $notes,
        "created_at" => date("Y-m-d H:i:s")
    ];

    if ($this->db->insert("upad_logs", $data)) {
        echo json_encode([
            "status" => true,
            "message" => "UPAD added successfully!"
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Something went wrong!"
        ]);
    }
}
public function view_upad($user_id)
{
    $data['user_id'] = $user_id; // pass user id

    $this->load->view('header');
    $this->load->view('upad_view', $data);
    $this->load->view('footer');
}
public function get_user_upads()
{
    $user_id  = $this->input->post("user_id");
    $admin_id = $this->admin['user_id'];

    if (!$user_id || !$admin_id) {
        echo json_encode(["status" => false, "message" => "Invalid Request"]);
        return;
    }

    $this->db->select("uup.*, users.name as user_name");
    $this->db->from("upad_logs uup");
    $this->db->join("users", "users.id = uup.user_id", "left");
    $this->db->where("uup.user_id", $user_id);
    $this->db->where("uup.admin_id", $admin_id);
    $this->db->order_by("uup.id", "DESC");

    $data = $this->db->get()->result();

    echo json_encode(["status" => true, "data" => $data]);
}
public function delete_upad()
{
    $id = $this->input->post("id");

    if (!$id) {
        echo json_encode(["status" => false, "message" => "Invalid request"]);
        return;
    }

    $this->db->where("id", $id);
    if ($this->db->delete("upad_logs")) {
        echo json_encode(["status" => true, "message" => "UPAD deleted successfully"]);
    } else {
        echo json_encode(["status" => false, "message" => "Failed to delete UPAD"]);
    }
}





    public function save_user() {
    $response = ['status' => 'error', 'message' => 'Something went wrong'];

    $admin_id = $this->admin['user_id'];
    if (!$admin_id) {
        $response['message'] = 'Unauthorized access';
        echo json_encode($response);
        return;
    }

    // Get POST data
    $user_name = trim($this->input->post('user_name'));
    $email = trim($this->input->post('email'));
    $mobile = trim($this->input->post('mobile'));
    $password = trim($this->input->post('password'));
    $daily_salary = trim($this->input->post('daily_salary'));   // ⭐ NEW FIELD

    // Validation
    if (empty($user_name) || empty($email) || empty($mobile) || empty($password) || empty($daily_salary)) {
        $response['message'] = 'All fields including daily salary are required';
        echo json_encode($response);
        return;
    }

    // Validate daily salary (must be number & > 0)
    if (!is_numeric($daily_salary) || $daily_salary <= 0) {
        $response['message'] = 'Daily salary must be a valid positive number';
        echo json_encode($response);
        return;
    }

    // Check duplicate email or mobile
    $exists = $this->general_model->getOne('users', array(
        'email' => $email,
        'mobile' => $mobile
    ));

    if ($exists) {
        $response['message'] = 'Email or mobile number already registered';
        echo json_encode($response);
        return;
    }

    // Handle image upload
    $profile_image = null;
    if (!empty($_FILES['profile_image']['name'])) {

        $config['upload_path'] = './uploads/users/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048;
        $config['file_name'] = time() . '_' . $_FILES['profile_image']['name'];

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('profile_image')) {
            $uploadData = $this->upload->data();
            $profile_image = 'uploads/users/' . $uploadData['file_name'];
        } else {
            $response['message'] = $this->upload->display_errors('', '');
            echo json_encode($response);
            return;
        }
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert user
    $data = [
        'admin_id'      => $admin_id,
        'name'          => $user_name,
        'email'         => $email,
        'mobile'        => $mobile,
        'daily_salary'  => $daily_salary,       // ⭐ NEW FIELD SAVED
        'profile_image' => $profile_image,
        'password'      => $hashed_password,
        'normal_password'      => $password,

        'isActive'      => 1,
        'created_at'    => date('Y-m-d H:i:s')
    ];

    if ($this->general_model->insert('users', $data)) {
        $response = ['status' => 'success', 'message' => 'User added successfully'];
    } else {
        $response['message'] = 'Failed to add user';
    }

    echo json_encode($response);
}


public function update_user()
{
    header('Content-Type: application/json');
    $response = ['status' => 'error', 'message' => 'Something went wrong'];

    // 🔐 Auth check
    $admin_id = $this->admin['user_id'] ?? null;
    if (!$admin_id) {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
        return;
    }

    // 🆔 User ID
   $id = (int) $this->input->post('id');
    // echo $id;
    // die;
    if (empty($id)) {
        echo json_encode(['status' => 'error', 'message' => 'User ID missing']);
        return;
    }

    // 📝 Inputs
    $user_name = trim($this->input->post('user_name'));
    $email = trim($this->input->post('email'));
    $mobile = trim($this->input->post('mobile'));
    $daily_salary = trim($this->input->post('daily_salary'));
    $password = trim($this->input->post('password')); // optional

    // 🧾 Required validation
    if (empty($user_name) || empty($email) || empty($mobile) || empty($daily_salary)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields except password are required']);
        return;
    }

    // Salary must be positive
    if (!is_numeric($daily_salary) || $daily_salary <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Daily salary must be a valid positive number']);
        return;
    }

    // 🔍 Duplicate email/mobile check (exclude current user)
    $this->db->where("id !=", $id, FALSE);
$this->db->group_start()
        ->where("email", $email)
        ->or_where("mobile", $mobile)
        ->group_end();
$duplicate = $this->db->get("users")->row();
// echo "<pre>";
// print_r($duplicate);
// die;

    if ($duplicate) {
        echo json_encode(['status' => 'error', 'message' => 'Email or mobile already exists']);
        return;
    }

    // 📷 IMAGE UPLOAD (optional)
    $profile_image = null;
    if (!empty($_FILES['profile_image']['name'])) {

        $config['upload_path'] = './uploads/users/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048;
        $config['file_name'] = time().'_'.$_FILES['profile_image']['name'];

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('profile_image')) {
            $uploadData = $this->upload->data();
            $profile_image = 'uploads/users/' . $uploadData['file_name'];
        } else {
            echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors('', '')]);
            return;
        }
    }

    // 🔐 Password update (optional)
    $update_pass = [];
    if (!empty($password)) {
        $update_pass = [
            "password" => password_hash($password, PASSWORD_BCRYPT),
            "normal_password" => $password
        ];
    }

    // 🛠 Update Data
    $data = [
        'name'         => $user_name,
        'email'        => $email,
        'mobile'       => $mobile,
        'daily_salary' => $daily_salary,
        // 'updated_at'   => date('Y-m-d H:i:s')
    ];

    if ($profile_image) {
        $data["profile_image"] = $profile_image;
    }

    $data = array_merge($data, $update_pass);

    // 📌 Update row
    $this->db->where("id", $id);
    $updated = $this->db->update("users", $data);

    if ($updated) {
        echo json_encode(['status' => 'success', 'message' => 'User updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update user']);
    }
}

public function get_users_ajax()
{
    $page   = $this->input->get('page') ? (int)$this->input->get('page') : 1;
    $search = trim($this->input->get('search'));
    $limit  = 10;
    $offset = ($page - 1) * $limit;

    $admin_id = $this->admin['user_id'] ?? null;
    if (!$admin_id) {
        echo json_encode([
            'status' => false,
            'message' => 'Unauthorized access',
            'data' => []
        ]);
        return;
    }

    // Fetch users
    $this->db->select('id, name, email, mobile, profile_image, daily_salary, isActive');
    $this->db->from('users');
    $this->db->where('admin_id', $admin_id);

    if (!empty($search)) {
        $this->db->group_start()
                 ->like('name', $search)
                 ->or_like('email', $search)
                 ->or_like('mobile', $search)
                 ->group_end();
    }

    $this->db->limit($limit, $offset);
    $users = $this->db->get()->result_array();

    // Salary Logic
    $month = date('m');
    $year  = date('Y');
    $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    foreach ($users as &$u) {

        $daily_salary = (float)$u['daily_salary'];

        // Count present days
        $this->db->from('attendance');
        $this->db->where('user_id', $u['id']);
        $this->db->where('admin_id', $admin_id);
        $this->db->where('status', 'present');
        $this->db->where('MONTH(attendance_time)', $month);
        $this->db->where('YEAR(attendance_time)', $year);

        $present_days = $this->db->count_all_results();

        // Actual Salary = full month salary (for display only)
        $actual_salary = $days_in_month * $daily_salary;

        // UPAD (total taken)
        $this->db->select_sum('amount');
        $upad = $this->db->get_where("upad_logs", [
            "user_id"  => $u['id'],
            "admin_id" => $admin_id
        ])->row()->amount ?? 0;

        $total_upad = (float)$upad;

        // PAYABLE = (present_days * daily_salary) - total_upad
        $present_based_salary = $present_days * $daily_salary;
        $payable_salary = $present_based_salary - $total_upad;

        // Don't allow negative payable (optional)
        if ($payable_salary < 0) $payable_salary = 0;

        // Send to frontend
        $u['present_days']   = $present_days;
        $u['actual_salary']  = $actual_salary;            // full month salary numeric
        $u['actual_salary_text'] = $actual_salary . " (" . $present_days . " days Present)"; // display
        $u['total_upad']     = $total_upad;
        $u['payable_salary'] = $payable_salary;
    }

    // Pagination
    $this->db->from('users');
    $this->db->where('admin_id', $admin_id);

    if (!empty($search)) {
        $this->db->group_start()
                 ->like('name', $search)
                 ->or_like('email', $search)
                 ->or_like('mobile', $search)
                 ->group_end();
    }

    $total_rows  = $this->db->count_all_results();
    $total_pages = ceil($total_rows / $limit);

    echo json_encode([
        'status' => true,
        'data' => $users,
        'pagination' => [
            'total_pages' => $total_pages,
            'current_page' => $page
        ]
    ]);
}






public function edit_user($id){
      $site = $this->db->where('id', $id)->get('users')->row();

    // Load view with data
    $this->load->view('header');
    $this->load->view('edit_user_form', ['user' => $site]);
    $this->load->view('footer');
}
public function delete_user($id){
      $updated = $this->db->where('id', $id)->update('users', ['isActive' => 0]);

    if ($updated) {
        echo json_encode(['status' => true, 'message' => 'User deleted successfully']);
    } else {
        echo json_encode(['status' => false, 'message' => 'Failed to delete User']);
    }
}

   

}  

?>