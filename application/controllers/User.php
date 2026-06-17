<?php
require_once(APPPATH . 'core/My_Controller.php');
class User extends My_Controller

{



    public function __construct()

    {

        parent::__construct();
    }





    public function index()
    {

        $this->load->view('header');

        $this->load->view('user_view');

        $this->load->view('footer');
    }
    public function salary()
    {
        $this->load->view('header');
        $this->load->view('salary_view');
        $this->load->view('footer');
    }
    public function add_user()
    {

        $this->load->view('header');

        $this->load->view('user_form');

        $this->load->view('footer');
    }
    public function add_upad($user_id = null)
    {
        $admin_id = $this->admin['user_id'] ?? null;
        if (!$admin_id) {
            show_error('Unauthorized access', 401);
            return;
        }

        $users = $this->db
            ->select('id, name')
            ->from('users')
            ->where('admin_id', $admin_id)
            ->where('isActive', 1)
            ->order_by('name', 'ASC')
            ->get()
            ->result();

        $data = [
            "users" => $users,
            "selected_user_id" => $user_id
        ];

        $this->load->view('header');
        $this->load->view('upad_form', $data);
        $this->load->view('footer');
    }
    public function save_upad()
    {
        $admin_id = $this->admin['user_id'] ?? null;

        $user_id = (int) $this->input->post("user_id");
        $amount  = (float) $this->input->post("amount");
        $notes   = $this->input->post("notes");

        if (!$admin_id || !$user_id || $amount <= 0) {
            echo json_encode([
                "status" => false,
                "message" => "Valid user and amount are required"
            ]);
            return;
        }

        $valid_user = $this->db
            ->where('id', $user_id)
            ->where('admin_id', $admin_id)
            ->where('isActive', 1)
            ->get('users')
            ->row();

        if (!$valid_user) {
            echo json_encode([
                "status" => false,
                "message" => "Selected user does not belong to your account"
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
        $month_year = $this->input->post("month_year");

        if (!$user_id || !$admin_id) {
            echo json_encode(["status" => false, "message" => "Invalid Request"]);
            return;
        }

        $this->db->select("uup.*, users.name as user_name");
        $this->db->from("upad_logs uup");
        $this->db->join("users", "users.id = uup.user_id", "left");
        $this->db->where("uup.user_id", $user_id);
        $this->db->where("uup.admin_id", $admin_id);

        if (!empty($month_year)) {
            $parts = explode("-", $month_year);
            if (count($parts) === 2) {
                $year = intval($parts[0]);
                $month = intval($parts[1]);
                $this->db->where("YEAR(uup.created_at)", $year);
                $this->db->where("MONTH(uup.created_at)", $month);
            }
        }

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





    public function save_user()
    {
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
        $this->db->where('email', $email);
        $this->db->or_where('mobile', $mobile);
        $exists = $this->db->get('users')->row();

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
            $config['file_name'] = time() . '_' . $_FILES['profile_image']['name'];

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






    public function edit_user($id)
    {
        $site = $this->db->where('id', $id)->get('users')->row();

        // Load view with data
        $this->load->view('header');
        $this->load->view('edit_user_form', ['user' => $site]);
        $this->load->view('footer');
    }
    public function delete_user($id)
    {
        $updated = $this->db->where('id', $id)->update('users', ['isActive' => 0]);

        if ($updated) {
            echo json_encode(['status' => true, 'message' => 'User deleted successfully']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to delete User']);
        }
    }

    public function buyers()
    {
        $this->load->view('header');
        $this->load->view('buyers_view');
        $this->load->view('footer');
    }

    public function get_buyers_ajax()
    {
        header('Content-Type: application/json');

        $admin_id = $this->admin['user_id'] ?? null;
        if (!$admin_id) {
            echo json_encode([
                'status' => false,
                'message' => 'Unauthorized access',
                'data' => []
            ]);
            return;
        }

        // Query active buyers with site and plot info
        $this->db->select('b.*, p.plot_number, s.name as site_name');
        $this->db->from('buyer b');
        $this->db->join('plots p', 'p.id = b.plot_id', 'left');
        $this->db->join('sites s', 's.id = p.site_id', 'left');
        $this->db->where('s.admin_id', $admin_id);
        $this->db->where('b.isActive', 1);
        $buyers_raw = $this->db->get()->result_array();

        $grouped_buyers = [];
        foreach ($buyers_raw as $b) {
            $mobile = trim($b['mobile']);
            if (empty($mobile)) {
                $mobile = 'no-mobile-' . $b['id'];
            }
            
            if (!isset($grouped_buyers[$mobile])) {
                $grouped_buyers[$mobile] = [
                    'name' => $b['name'],
                    'mobile' => $b['mobile'],
                    'email' => $b['email'],
                    'address' => $b['address'],
                    'aadhar' => $b['aadhar'],
                    'plots' => [],
                    'total_investment' => 0,
                    'total_paid' => 0,
                    'total_remaining' => 0,
                ];
            }
            
            // Financial calculations for this specific buyer_id (plot purchase)
            $buyer_id = (int) $b['id'];
            
            // 1. payment_details
            $payment = $this->db->order_by("id", "DESC")
                ->get_where("payment_details", ["buyer_id" => $buyer_id])
                ->row();
                
            $total_price = $payment ? (float) $payment->total_price : 0;
            $payment_down_payment = $payment ? (float) $payment->down_payment : 0;
            
            // 2. approved cash logs
            $total_paid = 0;
            $down_payment_in_logs = false;
            
            $cash_logs = $this->db->get_where("cash_payment_logs", [
                "buyer_id" => $buyer_id,
                "status" => "approve"
            ])->result();
            
            foreach ($cash_logs as $log) {
                $paid_amount = (float) ($log->paid_amount ?? 0);
                $total_paid += $paid_amount;
                
                $note = strtolower((string) ($log->notes ?? ""));
                if ($payment_down_payment > 0) {
                    if (strpos($note, "down") !== false || abs($paid_amount - $payment_down_payment) < 0.01) {
                        $down_payment_in_logs = true;
                    }
                }
            }
            
            if ($payment_down_payment > 0 && !$down_payment_in_logs) {
                $total_paid += $payment_down_payment;
            }
            
            $remaining_amount = 0;
            if ($total_price > 0) {
                $remaining_amount = $total_price - $total_paid;
                if ($remaining_amount < 0) {
                    $remaining_amount = 0;
                }
            }
            
            $plot_info = [
                'buyer_id' => $buyer_id,
                'plot_id' => $b['plot_id'],
                'plot_number' => $b['plot_number'],
                'site_name' => $b['site_name'],
                'total_price' => $total_price,
                'total_paid' => $total_paid,
                'remaining_amount' => $remaining_amount
            ];
            
            $grouped_buyers[$mobile]['plots'][] = $plot_info;
            $grouped_buyers[$mobile]['total_investment'] += $total_price;
            $grouped_buyers[$mobile]['total_paid'] += $total_paid;
            $grouped_buyers[$mobile]['total_remaining'] += $remaining_amount;
        }

        // Filter by search query
        $search = trim($this->input->get('search'));
        if (!empty($search)) {
            $search_lower = strtolower($search);
            $grouped_buyers = array_filter($grouped_buyers, function($gb) use ($search_lower) {
                return (strpos(strtolower($gb['name'] ?? ''), $search_lower) !== false) ||
                       (strpos(strtolower($gb['mobile'] ?? ''), $search_lower) !== false) ||
                       (strpos(strtolower($gb['email'] ?? ''), $search_lower) !== false) ||
                       (strpos(strtolower($gb['address'] ?? ''), $search_lower) !== false) ||
                       (strpos(strtolower($gb['aadhar'] ?? ''), $search_lower) !== false);
            });
        }

        // Pagination
        $page = $this->input->get('page') ? (int) $this->input->get('page') : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $total_rows = count($grouped_buyers);
        $total_pages = ceil($total_rows / $limit);

        // Slice array for the current page
        $paginated_buyers = array_slice(array_values($grouped_buyers), $offset, $limit);

        echo json_encode([
            'status' => true,
            'data' => $paginated_buyers,
            'pagination' => [
                'total_pages' => $total_pages,
                'current_page' => $page,
                'total_rows' => $total_rows
            ]
        ]);
    }

    public function get_user_documents()
    {
        header('Content-Type: application/json');
        $user_id = (int)$this->input->post('user_id');
        $admin_id = $this->admin['user_id'] ?? null;

        if (!$admin_id || !$user_id) {
            echo json_encode(['status' => false, 'message' => 'Invalid Request', 'data' => [], 'sites' => []]);
            return;
        }

        $documents = $this->db
            ->where('user_id', $user_id)
            ->where('isActive', 1)
            ->get('documents')
            ->result();

        foreach ($documents as $doc) {
            $doc->document_path = base_url($doc->document_path);
        }

        // Fetch assigned sites
        $sites = $this->db
            ->select('sa.*, s.name as site_name')
            ->from('site_assignments sa')
            ->join('sites s', 's.id = sa.site_id', 'left')
            ->where('sa.user_id', $user_id)
            ->where('sa.admin_id', $admin_id)
            ->get()
            ->result();

        echo json_encode([
            'status' => true, 
            'data' => $documents,
            'sites' => $sites
        ]);
    }

    public function delete_buyer($id)
    {
        header('Content-Type: application/json');
        $id = (int)$id;
        $admin_id = $this->admin['user_id'] ?? null;
        if (!$admin_id) {
            echo json_encode(['status' => false, 'message' => 'Unauthorized']);
            return;
        }

        $buyer = $this->db->select('b.*, p.id as plot_id')
            ->from('buyer b')
            ->join('plots p', 'p.id = b.plot_id', 'left')
            ->join('sites s', 's.id = p.site_id', 'left')
            ->where('b.id', $id)
            ->where('s.admin_id', $admin_id)
            ->get()
            ->row();

        if (!$buyer) {
            echo json_encode(['status' => false, 'message' => 'Buyer not found']);
            return;
        }

        // Deactivate buyer
        $this->db->where('id', $id)->update('buyer', ['isActive' => 0]);
        // Also update plot status back to available since buyer is removed
        $this->db->where('id', $buyer->plot_id)->update('plots', ['status' => 'available']);

        echo json_encode(['status' => true, 'message' => 'Buyer deleted successfully']);
    }
}
