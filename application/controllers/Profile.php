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

    $name            = trim((string) $this->input->post('name'));
    $business_name   = trim((string) $this->input->post('business_name'));
    $email           = trim((string) $this->input->post('email'));
    $mobile          = trim((string) $this->input->post('mobile'));
    $address         = trim((string) $this->input->post('address'));
    $gst_number      = trim((string) $this->input->post('gst_number'));
    $facebook        = trim((string) $this->input->post('facebook'));
    $instagram       = trim((string) $this->input->post('instagram'));
    $bank_name       = trim((string) $this->input->post('bank_name'));
    $account_number  = trim((string) $this->input->post('account_number'));
    $ifsc_code       = trim((string) $this->input->post('ifsc_code'));

    if ($name === '' || $mobile === '' || $business_name === '') {
        echo json_encode([
            'status' => 422,
            'message' => 'Full Name, Phone and Business Name are required.'
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
        'name'           => $name,
        'business_name'  => $business_name,
        'email'          => $email,
        'mobile'         => $mobile,
        'address'        => $address,
        'gst_number'     => $gst_number ?: null,
        'facebook'       => $facebook ?: null,
        'instagram'      => $instagram ?: null,
        'bank_name'      => $bank_name ?: null,
        'account_number' => $account_number ?: null,
        'ifsc_code'      => $ifsc_code ?: null
    ];

    // Initialize Upload library once
    $this->load->library('upload');

    // ✅ Profile Image upload
    if (!empty($_FILES['profile_image']['name'])) {
        $config['upload_path']   = './uploads/profile/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048;
        $config['file_name']     = time() . '_' . $_FILES['profile_image']['name'];

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('profile_image')) {
            echo json_encode([
                'status' => 400,
                'message' => 'Profile Picture: ' . strip_tags($this->upload->display_errors())
            ]);
            return;
        }

        $uploadData = $this->upload->data();
        $updateData['profile_image'] = 'uploads/profile/' . $uploadData['file_name'];
    }

    // ✅ Signature upload
    if (!empty($_FILES['signature']['name'])) {
        $config_sig['upload_path']   = './uploads/signature/';
        $config_sig['allowed_types'] = 'jpg|jpeg|png';
        $config_sig['max_size']      = 2048;
        $config_sig['file_name']     = time() . '_sig_' . $_FILES['signature']['name'];

        if (!is_dir('./uploads/signature/')) {
            @mkdir('./uploads/signature/', 0755, true);
        }

        $this->upload->initialize($config_sig);

        if (!$this->upload->do_upload('signature')) {
            echo json_encode([
                'status' => 400,
                'message' => 'Signature: ' . strip_tags($this->upload->display_errors())
            ]);
            return;
        }

        $uploadDataSig = $this->upload->data();
        $updateData['signature'] = 'uploads/signature/' . $uploadDataSig['file_name'];
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
    $adminSession['business_name'] = $business_name;

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
