<?php
require_once(APPPATH . 'core/My_Controller.php');
class Profile extends My_Controller

{



    public function __construct()

    {

        parent::__construct();

      

    }





    public function index(){
 $admin_id = $this->admin['user_id'];

    // Fetch user from users table
    $admin = $this->db->get_where("user_master", ["id" => $admin_id])->row();

    // Pass data to view
    $data = [
        "admin" => $admin,
        "role"  => $admin->role
    ];
// echo "<pre>";
// print_r($data);
// die;
        $isSuperAdmin = (($admin->role ?? '') === 'superadmin');

        if ($isSuperAdmin) {
            $this->load->view('superadmin/header');
            $this->load->view('superadmin/profile_view', $data);
            $this->load->view('superadmin/footer');
            return;
        }

        $this->load->view('header');
        $this->load->view('profile_view',$data);
        $this->load->view('footer');

    }
    public function update_profile()
{
    header('Content-Type: application/json');

    $adminSession = $this->session->userdata('admin');

    if (empty($adminSession['user_id'])) {
        echo json_encode([
            'status' => 401,
            'message' => 'Unauthorized'
        ]);
        return;
    }

    $admin_id = $adminSession['user_id'];

    $name     = trim((string) $this->input->post('name'));
    $email    = trim((string) $this->input->post('email'));
    $mobile   = trim((string) $this->input->post('mobile'));
    $address  = trim((string) $this->input->post('address'));
    $password = $this->input->post('password');

    if ($name === '' || $mobile === '') {
        echo json_encode([
            'status' => 422,
            'message' => 'Full Name and Phone are required.'
        ]);
        return;
    }

    if (!preg_match('/^[0-9]{10}$/', $mobile)) {
        echo json_encode([
            'status' => 422,
            'message' => 'Please enter a valid 10-digit mobile number.'
        ]);
        return;
    }

    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            'status' => 422,
            'message' => 'Please enter a valid email address.'
        ]);
        return;
    }

    $updateData = [
        'name'   => $name,
        'email'  => $email,
        'mobile' => $mobile,
        'address' => $address
    ];

    // ✅ Update password only if provided
    if (!empty($password)) {
        $updateData['password'] = md5($password);
        $updateData['normal_password'] = $password;
    }

    // ✅ Image upload
    if (!empty($_FILES['profile_image']['name'])) {

        $config['upload_path']   = './uploads/profile/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048;
        $config['file_name']     = time() . '_' . $_FILES['profile_image']['name'];

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('profile_image')) {
            echo json_encode([
                'status' => 400,
                'message' => strip_tags($this->upload->display_errors())
            ]);
            return;
        }

        $uploadData = $this->upload->data();
        $updateData['profile_image'] = 'uploads/profile/' . $uploadData['file_name'];
    }

    // ✅ Update DB
    $this->db->where('id', $admin_id);
    if (!$this->db->update('user_master', $updateData)) {
        echo json_encode([
            'status' => 400,
            'message' => 'Failed to update profile'
        ]);
        return;
    }

    // ✅ Update ONLY required session fields
    $adminSession['user_name'] = $name;

    if (!empty($updateData['profile_image'])) {
        $adminSession['profile_image'] = $updateData['profile_image'];
    }

    $this->session->set_userdata('admin', $adminSession);

    echo json_encode([
        'status' => 200,
        'message' => 'Profile updated successfully'
    ]);
}

}
