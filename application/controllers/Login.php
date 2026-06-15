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

    // ─── LOGIN: Step 1 — Show mobile form ───────────────────────────
    public function index()
    {
        $this->load->view('login_view');
    }

    // ─── LOGIN: Step 2 — Validate mobile & send OTP ─────────────────
    public function send_login_otp()
    {
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|regex_match[/^[0-9]{10}$/]', [
            'regex_match' => 'Please enter a valid 10-digit mobile number.'
        ]);

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('login_view');
            return;
        }

        $mobile = $this->input->post('mobile');

        $user = $this->db
            ->where(['mobile' => $mobile, 'isActive' => 1])
            ->get('user_master')
            ->row();

        if (!$user) {
            $data['error'] = 'No account found with this mobile number.';
            $this->load->view('login_view', $data);
            return;
        }

        $otp = rand(100000, 999999);
        $this->session->set_userdata('login_otp', $otp);
        $this->session->set_userdata('login_mobile', $mobile);

        $sms_sent = $this->_send_otp_via_sms($mobile, $otp);

        if (!$sms_sent) {

            $data['error'] = 'Failed to send OTP. Please try again.';
            $this->load->view('login_view', $data);
            return;
        }

        $data['masked_mobile'] = '*******' . substr($mobile, -4);
        $data['otp_type']      = 'login';
        $this->load->view('otp_view', $data);
    }

    // ─── LOGIN: Step 3 — Verify OTP & set session ───────────────────
    public function resend_otp($type = 'login')
    {
        $type = ($type === 'register') ? 'register' : 'login';

        if ($type === 'register') {
            $form_data = $this->session->userdata('register_form_data');

            if (!$form_data || empty($form_data['mobile'])) {
                $this->session->set_flashdata('error', 'Session expired. Please register again.');
                redirect('register');
                return;
            }

            $mobile = $form_data['mobile'];
            $session_key = 'register_otp';
        } else {
            $mobile = $this->session->userdata('login_mobile');

            if (!$mobile) {
                $this->session->set_flashdata('error', 'Session expired. Please try again.');
                redirect('login');
                return;
            }

            $session_key = 'login_otp';
        }

        $otp = rand(100000, 999999);
        $this->session->set_userdata($session_key, $otp);

        $data['masked_mobile'] = '*******' . substr($mobile, -4);
        $data['otp_type']      = $type;

        if ($this->_send_otp_via_sms($mobile, $otp)) {
            $data['success'] = 'A new OTP has been sent.';
        } else {
            $data['error'] = 'Failed to resend OTP. Please try again.';
        }

        $this->load->view('otp_view', $data);
    }

    public function verify_login_otp()
    {
        $entered_otp  = $this->input->post('otp');
        $session_otp  = $this->session->userdata('login_otp');
        $mobile       = $this->session->userdata('login_mobile');

        if (!$mobile || !$session_otp) {
            $this->session->set_flashdata('error', 'Session expired. Please try again.');
            redirect('login');
            return;
        }

        if ((string)$entered_otp !== (string)$session_otp) {
            $data['error']         = 'Invalid OTP. Please try again.';
            $data['masked_mobile'] = '*******' . substr($mobile, -4);
            $data['otp_type']      = 'login';
            $this->load->view('otp_view', $data);
            return;
        }

        $user = $this->db
            ->where(['mobile' => $mobile, 'isActive' => 1])
            ->get('user_master')
            ->row();

        if (!$user) {
            $this->session->set_flashdata('error', 'Account not found.');
            redirect('login');
            return;
        }

        $adminSession = [
            'user_id'       => $user->id,
            'user_name'     => $user->name,
            'business_name' => $user->business_name,
            'profile_image' => $user->profile_image ?? null,
            'role'          => $user->role ?? 'admin',
            'logged_in'     => TRUE
        ];

        $this->session->set_userdata('admin', $adminSession);
        $this->session->unset_userdata('login_otp');
        $this->session->unset_userdata('login_mobile');
        $this->session->unset_userdata('superadmin_original');
        $this->session->unset_userdata('is_impersonating_admin');
        $this->session->unset_userdata('impersonated_admin_id');

        $this->session->set_flashdata('success', 'Welcome back, ' . $user->name . '!');
        redirect('dashboard');
    }

    // ─── REGISTER: Step 1 — Show register form ──────────────────────
    public function register()
    {
        $this->load->view('register_view');
    }

    // ─── REGISTER: Step 2 — Validate form & send OTP ────────────────
    public function sign_up()
    {
        $this->form_validation->set_rules('full_name',     'Full Name',      'required|trim');
        $this->form_validation->set_rules('business_name', 'Business Name',  'required|trim');
        $this->form_validation->set_rules('mobile',        'Mobile',         'required|regex_match[/^[0-9]{10}$/]', [
            'regex_match' => 'Please enter a valid 10-digit mobile number.'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('register_view');
            return;
        }

        $mobile = $this->input->post('mobile');
        $email  = trim((string) $this->input->post('email'));

        if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $data['email_error'] = 'Please enter a valid email address.';
            $this->load->view('register_view', $data);
            return;
        }

        $exists = $this->db->get_where('user_master', ['mobile' => $mobile])->row();
        if ($exists) {
            $data['mobile_error'] = 'This mobile number is already registered. Please login instead.';
            $this->load->view('register_view', $data);
            return;
        }

        // Store form data in session — insert ONLY after OTP verified
        $this->session->set_userdata('register_form_data', [
            'name'             => $this->input->post('full_name'),
            'business_name'    => $this->input->post('business_name'),
            'mobile'           => $mobile,
            'email'            => $email,
            'address'          => trim((string) $this->input->post('address')),
            'password'         => md5($this->input->post('password')),
            'normal_password'  => $this->input->post('password'),
            'created_on'       => date('Y-m-d H:i:s'),
            'isActive'         => 1
        ]);

        $otp = rand(100000, 999999);
        $this->session->set_userdata('register_otp', $otp);

        $sms_sent = $this->_send_otp_via_sms($mobile, $otp);

        if (!$sms_sent) {
            $data['error'] = 'Failed to send OTP. Please try again.';
            $this->load->view('register_view', $data);
            return;
        }

        $data['masked_mobile'] = '*******' . substr($mobile, -4);
        $data['otp_type']      = 'register';
        $this->load->view('otp_view', $data);
    }

    // ─── REGISTER: Step 3 — Verify OTP & insert user ────────────────
    public function verify_register_otp()
    {
        $entered_otp  = $this->input->post('otp');
        $session_otp  = $this->session->userdata('register_otp');
        $form_data    = $this->session->userdata('register_form_data');

        if (!$form_data || !$session_otp) {
            $this->session->set_flashdata('error', 'Session expired. Please register again.');
            redirect('register');
            return;
        }

        if ((string)$entered_otp !== (string)$session_otp) {
            $data['error']         = 'Invalid OTP. Please try again.';
            $data['masked_mobile'] = '*******' . substr($form_data['mobile'], -4);
            $data['otp_type']      = 'register';
            $this->load->view('otp_view', $data);
            return;
        }

        // OTP verified → now insert user
        $this->db->insert('user_master', $form_data);
        $user_id = $this->db->insert_id();

        $adminSession = [
            'user_id'       => $user_id,
            'user_name'     => $form_data['name'],
            'business_name' => $form_data['business_name'],
            'role'          => 'admin',
            'logged_in'     => TRUE
        ];

        $this->session->set_userdata('admin', $adminSession);
        $this->session->unset_userdata('register_otp');
        $this->session->unset_userdata('register_form_data');
        $this->session->unset_userdata('superadmin_original');
        $this->session->unset_userdata('is_impersonating_admin');
        $this->session->unset_userdata('impersonated_admin_id');

        $this->session->set_flashdata('success', 'Registration successful! Welcome, ' . $form_data['name'] . '.');
        redirect('dashboard');
    }

    // ─── FORGOT PASSWORD (unchanged) ────────────────────────────────
    public function forgot_password()
    {
        $data = [];

        if ($this->input->method() === 'post') {
            $step = $this->input->post('step');

            if ($step === 'verify') {
                $this->form_validation->set_rules('identifier', 'Email or Mobile', 'required|trim');

                if ($this->form_validation->run() === TRUE) {
                    $identifier = trim($this->input->post('identifier'));
                    $user = $this->db->group_start()->where('email', $identifier)->or_where('mobile', $identifier)->group_end()->get('user_master')->row();

                    if ($user) {
                        $data['verified_user_id'] = $user->id;
                        $data['identifier']        = $identifier;
                        $data['success']           = 'Account found. Please enter your new password.';
                    } else {
                        $data['error'] = 'No account found with this email or mobile number.';
                    }
                }
            } elseif ($step === 'reset') {
                $this->form_validation->set_rules('user_id',          'User',             'required|integer');
                $this->form_validation->set_rules('identifier',       'Email or Mobile',  'required|trim');
                $this->form_validation->set_rules('new_password',     'New Password',     'required|min_length[6]');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

                if ($this->form_validation->run() === TRUE) {
                    $user_id    = (int) $this->input->post('user_id');
                    $identifier = trim($this->input->post('identifier'));
                    $new_pass   = $this->input->post('new_password');

                    $user = $this->db->where('id', $user_id)->group_start()->where('email', $identifier)->or_where('mobile', $identifier)->group_end()->get('user_master')->row();

                    if (!$user) {
                        $data['error'] = 'Invalid reset request.';
                    } else {
                        $updated = $this->db->where('id', $user_id)->update('user_master', [
                            'password'        => md5($new_pass),
                            'normal_password' => $new_pass
                        ]);

                        if ($updated) {
                            $this->session->set_flashdata('success', 'Password updated successfully. Please login.');
                            redirect('login');
                            return;
                        }

                        $data['error']            = 'Unable to update password. Try again.';
                        $data['verified_user_id'] = $user_id;
                        $data['identifier']        = $identifier;
                    }
                } else {
                    $data['verified_user_id'] = (int) $this->input->post('user_id');
                    $data['identifier']        = trim($this->input->post('identifier'));
                }
            }
        }

        $this->load->view('forgot_password_view', $data);
    }

    // ─── LOGOUT ─────────────────────────────────────────────────────
    public function logout()
    {
        $this->session->unset_userdata('admin');
        $this->session->unset_userdata('superadmin_original');
        $this->session->unset_userdata('is_impersonating_admin');
        $this->session->unset_userdata('impersonated_admin_id');
        $this->session->sess_destroy();
        redirect('login');
    }

    // ─── PRIVATE: Send OTP via SMS ──────────────────────────────────
    public function _send_otp_via_sms($mobileNo, $otp)
    {

        $message = "Hi $mobileNo\n\nYour Verification OTP is $otp Do not share this OTP with anyone for security reasons.\n\nRegards\nOMKARENT";



        $params = [

            'user' => 'Fitcketsp',

            'key' => '81a6b2f99cXX',

            'mobile' => '91' . $mobileNo,

            'message' => $message,

            'senderid' => 'OENTER',

            'accusage' => '1',

            'entityid' => '1401487200000053882',

            'tempid' => '1407168611506367587'

        ];



        $url = 'http://mobicomm.dove-sms.com/submitsms.jsp?' . http_build_query($params);



        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);



        if (curl_errno($ch)) {

            log_message('error', 'OTP SMS cURL Error: ' . curl_error($ch));

            curl_close($ch);

            return false;
        }



        curl_close($ch);

        log_message('info', "OTP sent to $mobileNo. Response: $response");

        // echo "<pre>";

        // print_r($response);

        // exit;

        // redirect('provider/dashboard');



        return $response;
    }
}
