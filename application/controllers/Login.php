<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Login extends CI_Controller

{



    public function __construct()

    {

        parent::__construct();

        $this->load->library('session');

        $this->load->library('form_validation');



        $this->load->helper('url');

        $this->load->model('general_model');

        $this->form_validation->set_error_delimiters("<div class='error'>", "</div>");



        if ($this->session->userdata('admin')) {
            if ($this->router->fetch_method() != 'logout') {
                redirect('dashboard');
            }
        }

    }



   public function index()
    {
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|regex_match[/^[0-9]{10}$/]', [
            'regex_match' => 'Please enter a valid 10-digit mobile number.'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() === TRUE) {

            $mobile = $this->input->post('mobile');
            $password = md5($this->input->post('password'));

            $user = $this->db
                ->where(['mobile' => $mobile, 'password' => $password, 'isActive' => 1])
                ->get('user_master')
                ->row();

            if ($user) {
                $adminSession = [
                    'user_id'       => $user->id,
                    'user_name'     => $user->name,
                    'business_name' => $user->business_name,
                    'profile_image' => $user->profile_image ?? null,
                    'role'          => $user->role ?? 'admin',
                    'logged_in'     => TRUE
                ];

                $this->session->set_userdata('admin', $adminSession);
                $this->session->unset_userdata('superadmin_original');
                $this->session->unset_userdata('is_impersonating_admin');
                $this->session->unset_userdata('impersonated_admin_id');

                $this->session->set_flashdata('success', 'Login successful! Welcome back, ' . $user->name . '.');
                redirect(base_url('dashboard'));
            } else {
                $data['error'] = 'Invalid mobile or password. Please try again.';
                $this->load->view('login_view', $data);
            }
        } else {
            $this->load->view('login_view');
        }
    }
    public function register(){
        $this->load->view('register_view');

    }
  public function sign_up()
    {
        // ✅ Validation Rules
        $this->form_validation->set_rules('full_name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('business_name', 'Business Name', 'required|trim');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|regex_match[/^[0-9]{10}$/]', [
            'regex_match' => 'Please enter a valid 10-digit mobile number.'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        // ✅ If validation fails — reload same view with old data
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('register_view');
        } 
        else 
        {
            $mobile = $this->input->post('mobile');

            // ✅ Check if mobile already exists
            $exists = $this->db->get_where('user_master', ['mobile' => $mobile])->row();
            if ($exists) {
                $data['mobile_error'] = 'This mobile number is already registered. Please login instead.';
                $this->load->view('register_view', $data);
                return;
            }

            // ✅ Prepare data for insert
            $data = [
                'name'          => $this->input->post('full_name'),
                'business_name' => $this->input->post('business_name'),
                'mobile'        => $mobile,
                'email'         => $this->input->post('email'),
                'password'      => md5($this->input->post('password')),
                'normal_password' => $this->input->post('password'),

                'created_on'    => date('Y-m-d H:i:s'),
                'isActive'      => 1
            ];

            // ✅ Insert record
            if ($this->db->insert('user_master', $data)) {
                $user_id = $this->db->insert_id();

                // ✅ Set session
              $adminSession = [
    'user_id'       => $user_id,
    'user_name'     => $data['name'],
    'business_name' => $data['business_name'],
    'role'          => 'admin',
    'logged_in'     => TRUE
];

$this->session->set_userdata('admin', $adminSession);
$this->session->unset_userdata('superadmin_original');
$this->session->unset_userdata('is_impersonating_admin');
$this->session->unset_userdata('impersonated_admin_id');

                $this->session->set_flashdata('success', 'Registration successful! Welcome, ' . $data['name'] . '.');
                redirect(base_url('dashboard'));
            } else {
                $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
                $this->load->view('sign_up');
            }
        }
    }
	 public function logout() {

        // Clear session and redirect to login page

        $this->session->unset_userdata('admin');
        $this->session->unset_userdata('superadmin_original');
        $this->session->unset_userdata('is_impersonating_admin');
        $this->session->unset_userdata('impersonated_admin_id');

        $this->session->sess_destroy();

        redirect('login');

    }

}

