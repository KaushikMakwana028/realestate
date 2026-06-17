<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Controller extends CI_Controller
{
    public $provider;
    public $admin;

    public function __construct()
    {
        parent::__construct();

        $this->load->library(['form_validation', 'session']);
        $this->load->helper(['url', 'form']);
        $this->load->model('general_model');
        $this->load->database();

        $this->admin = $this->session->userdata('admin');
        $controller = strtolower((string) $this->router->fetch_class());
        $method = strtolower((string) $this->router->fetch_method());

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

        if (!$this->admin) {
            // Allow login and registration related controllers
            if ($controller !== 'login' && $controller !== 'api') {
                redirect('login');
            }
        } else {
            // Admin is logged in, verify subscription
            if (($this->admin['role'] ?? '') !== 'superadmin') {
                // Get latest active subscription
                $sub = $this->db->where('user_id', $this->admin['user_id'])
                    ->group_start()
                        ->where('payment_status', 'success')
                        ->or_where('payment_status', 'active')
                    ->group_end()
                    ->order_by('end_date', 'DESC')
                    ->get('user_subscriptions')
                    ->row();

                if (!$sub) {
                    // Auto-trial seed for existing user
                    $free_plan = $this->db->where('price', 0)->where('isActive', 1)->get('plans')->row();
                    if ($free_plan) {
                        $sub_data = [
                            'user_id' => $this->admin['user_id'],
                            'plan_id' => $free_plan->id,
                            'plan_name' => $free_plan->name,
                            'price' => $free_plan->price,
                            'start_date' => date('Y-m-d'),
                            'end_date' => date('Y-m-d', strtotime('+' . $free_plan->duration_days . ' days')),
                            'payment_status' => 'success',
                            'created_at' => date('Y-m-d H:i:s')
                        ];
                        $this->db->insert('user_subscriptions', $sub_data);
                        $sub = (object) $sub_data;
                    }
                }

                if ($sub) {
                    $days_left = (int) ceil((strtotime($sub->end_date) - strtotime(date('Y-m-d'))) / 86400);
                    $active = ($days_left >= 0);
                    $this->session->set_userdata('subscription_active', $active);
                    $this->session->set_userdata('subscription_days_left', $days_left);
                    $this->session->set_userdata('subscription_plan_name', $sub->plan_name);
                    $this->session->set_userdata('subscription_end_date', $sub->end_date);

                    if (!$active) {
                        // Redirect if not on allowed routes
                        $allowed = false;
                        if ($controller === 'login') $allowed = true;
                        if ($controller === 'api') $allowed = true;
                        if ($controller === 'dashboard' && in_array($method, ['plans', 'verify_payment'])) $allowed = true;

                        if (!$allowed) {
                            $this->session->set_flashdata('error', 'Your subscription plan has expired. Please choose a plan to continue.');
                            redirect('dashboard/plans');
                        }
                    }
                } else {
                    $this->session->set_userdata('subscription_active', false);
                    $this->session->set_userdata('subscription_days_left', -1);

                    $allowed = false;
                    if ($controller === 'login') $allowed = true;
                    if ($controller === 'api') $allowed = true;
                    if ($controller === 'dashboard' && in_array($method, ['plans', 'verify_payment'])) $allowed = true;

                    if (!$allowed) {
                        redirect('dashboard/plans');
                    }
                }
            }
        }
    }
}

