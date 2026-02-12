<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Controller extends CI_Controller
{
    public $provider;

    public function __construct()
    {
        parent::__construct();

        $this->load->library(['form_validation', 'session']);
        $this->load->helper(['url', 'form']);
        $this->load->model('general_model');

        $this->admin = $this->session->userdata('admin');
        $controller = strtolower((string) $this->router->fetch_class());

        $superadminOriginal = $this->session->userdata('superadmin_original');
        if (
            $controller === 'superadmin' &&
            !empty($superadminOriginal) &&
            (($this->admin['role'] ?? '') !== 'superadmin')
        ) {
            $this->admin = $superadminOriginal;
            $this->session->set_userdata('admin', $this->admin);
            $this->session->unset_userdata('is_impersonating_admin');
            $this->session->unset_userdata('impersonated_admin_id');
        }

        if ($this->admin && empty($this->admin['role'])) {
            $adminRow = $this->db->select('role, profile_image, business_name, name')
                ->where('id', $this->admin['user_id'])
                ->get('user_master')
                ->row();
            if ($adminRow) {
                $this->admin['role'] = $adminRow->role ?? 'admin';
                $this->admin['profile_image'] = $adminRow->profile_image ?? null;
                $this->admin['business_name'] = $adminRow->business_name ?? $this->admin['business_name'] ?? '';
                $this->admin['user_name'] = $adminRow->name ?? $this->admin['user_name'] ?? '';
                $this->session->set_userdata('admin', $this->admin);
            }
        }

        // echo "<pre>";
        // print_r($this->admin);
        // die;
        if (!$this->admin) {
            redirect('login');
        }
    }
}

