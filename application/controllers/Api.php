<?php

defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;

use \Firebase\JWT\Key;

require_once FCPATH . 'vendor/autoload.php';



class Api extends CI_Controller
{

    private $jwt_secret = 'a0d5f8e9c2b7a6d1c4e3f98b19d2a4f6c9f7a31bc9e2d6f81d845a47b8f92c4e';




    public function __construct()
    {

        parent::__construct();


        $this->load->model('general_model');

        $this->load->library(['session']);

        $this->load->helper(['url', 'form']);


        header("Access-Control-Allow-Origin: *");

        // header("Content-Type: application/json; charset=UTF-8");
        $this->load->library('email');
        $this->load->library(['form_validation']);
    }
    public function login()
    {
        header('Content-Type: application/json');

        $input_data = json_decode($this->input->raw_input_stream, true);
        $mobile = trim($input_data['mobile'] ?? '');
        $password = trim($input_data['password'] ?? '');

        if (empty($mobile) || empty($password)) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Mobile and password are required',
                    'data' => null
                ]));
        }

        $user = $this->db->get_where('users', ['mobile' => $mobile])->row();

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

        if ($user->isActive == 0) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Your account is not active. Please contact admin.',
                    'data' => null
                ]));
        }

        // 🔐 PASSWORD CHECK (Supports old plain passwords too)
        $passwordMatched = false;

        // Case 1: Already hashed
        if (password_verify($password, $user->password)) {
            $passwordMatched = true;
        }

        // Case 2: Old plain password
        elseif ($password === $user->password) {

            $passwordMatched = true;

            // Auto convert to hash
            $newHash = password_hash($password, PASSWORD_BCRYPT);

            $this->db->where('id', $user->id)
                ->update('users', ['password' => $newHash]);
        }

        if (!$passwordMatched) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Invalid password',
                    'data' => null
                ]));
        }

        // Profile Image
        $profile_image = !empty($user->profile_image)
            ? (strpos($user->profile_image, 'uploads/') === false
                ? base_url('uploads/users/' . $user->profile_image)
                : base_url($user->profile_image))
            : base_url('uploads/users/default.png');

        $token = $this->generate_jwt($user);

        return $this->output
            ->set_status_header(200)
            ->set_output(json_encode([
                'status' => true,
                'code' => 200,
                'message' => 'Login successful',
                'data' => [
                    'token' => $token,
                    'user' => [
                        'id' => $user->id,
                        'admin_id' => $user->admin_id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'mobile' => $user->mobile,
                        'location' => $user->location,
                        'bio' => $user->bio,
                        'daily_salary' => $user->daily_salary,
                        'isActive' => $user->isActive,
                        'created_at' => $user->created_at,
                        'profile_image' => $profile_image
                    ]
                ]
            ]));
    }


    public function logout()
    {
        $authHeader = $this->input->get_request_header('Authorization', TRUE);
        $token = null;

        if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        }

        $decoded = $this->verify_jwt($token);
        if (!$decoded || empty($decoded->data->id)) {
            $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Invalid token or user ID missing',
                    'data' => null
                ]));
            return;
        }

        $expiry = date('Y-m-d H:i:s', $decoded->exp);
        $this->db->insert('token_blacklist', [
            'token' => $token,
            'expires_at' => $expiry
        ]);

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => true,
                'code' => 200,
                'message' => 'Logout successful — token invalidated',
                'data' => null
            ]));
    }

    public function dashboard()
    {
        header('Content-Type: application/json');

        // ---------------------- 1. VERIFY JWT ----------------------
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


        // ---------------------- 2. GET USER admin_id ----------------------
        $user = $this->db->select('admin_id')
            ->where('id', $user_id)
            ->get('users')
            ->row();

        if (!$user) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'User not found',
                    'data' => []
                ]));
        }

        $admin_id = (int) $user->admin_id;



        // -----------------------------------------------------------
        // 3. FETCH ALL SITE IDs ASSIGNED TO THIS LOGIN USER
        // -----------------------------------------------------------
        $assigned_sites = $this->db->select('site_id')
            ->where('user_id', $user_id)
            ->where('admin_id', $admin_id)
            ->get('site_assignments')
            ->result_array();

        if (!empty($assigned_sites)) {
            $site_ids = array_column($assigned_sites, 'site_id');
        } else {
            $site_ids = []; // user has no site assigned
        }


        // -----------------------------------------------------------
        // 4. TOTAL SITES FOR THIS USER (only assigned sites)
        // -----------------------------------------------------------
        if (!empty($site_ids)) {
            $this->db->where_in('id', $site_ids);
            $this->db->where('admin_id', $admin_id);
            $this->db->where('isActive', 1);
            $total_sites = $this->db->count_all_results('sites');
        } else {
            $total_sites = 0;
        }


        // -----------------------------------------------------------
        // 5. TOTAL PLOTS FOR THESE SITES
        // -----------------------------------------------------------
        if (!empty($site_ids)) {
            $this->db->where_in('site_id', $site_ids);
            $this->db->where('admin_id', $admin_id);
            $this->db->where('isActive', 1);
            $total_plots = $this->db->count_all_results('plots');
        } else {
            $total_plots = 0;
        }


        // -----------------------------------------------------------
        // 6. TOTAL EXPENSES ADDED BY THIS LOGIN USER
        // -----------------------------------------------------------
        $this->db->where('admin_id', $admin_id);
        $this->db->where('user_id', $user_id);
        $this->db->where('isActive', 1);
        $total_expenses = $this->db->count_all_results('expenses');


        // -----------------------------------------------------------
        // 7. TOTAL INQUIRIES ADDED BY THIS LOGIN USER
        // -----------------------------------------------------------
        $this->db->where('admin_id', $admin_id);
        $this->db->where('user_id', $user_id);
        $this->db->where('isActive', 1);
        $total_inquiries = $this->db->count_all_results('inquiries');



        // -----------------------------------------------------------
        // 8. RESPONSE
        // -----------------------------------------------------------
        return $this->output
            ->set_status_header(200)
            ->set_output(json_encode([
                'status' => true,
                'code' => 200,
                'message' => 'Dashboard data fetched successfully',
                'data' => [
                    'total_sites' => $total_sites,
                    'total_plots' => $total_plots,
                    'total_expenses' => $total_expenses,
                    'total_inquiries' => $total_inquiries
                ]
            ]));
    }





    public function get_sites()
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

        // Get admin_id
        $user = $this->db->select('admin_id')->where('id', $user_id)->get('users')->row();
        if (!$user) {
            echo json_encode([
                'status' => false,
                'code' => 400,
                'message' => 'User not found',
                'data' => []
            ]);
            return;
        }

        $admin_id = (int) $user->admin_id;

        // Fetch active sites
        $this->db->select('s.id, s.name, s.location, s.area, s.isActive, s.site_map, s.listed_map, s.created_at');
        $this->db->from('sites s');
        $this->db->join('site_assignments sa', 'sa.site_id = s.id', 'inner');
        $this->db->where('sa.user_id', $user_id);
        $this->db->where('s.admin_id', $admin_id);
        $this->db->where('sa.admin_id', $admin_id);
        $this->db->where('s.isActive', 1);
        $this->db->group_by('s.id');
        $this->db->order_by('s.id', 'DESC');
        $sites = $this->db->get()->result();


        if (!empty($sites)) {

            $site_list = [];
            $grand_total_plots = 0;
            $grand_sold = 0;
            $grand_available = 0;

            foreach ($sites as $site) {

                $site_id = (int) $site->id;

                // Total plots (except pending)
                $this->db->where('site_id', $site_id)
                    ->where('admin_id', $admin_id)
                    ->where_in('status', ['available', 'sold']);
                $total_plots = $this->db->count_all_results('plots');

                // SOLD plots
                $this->db->where('site_id', $site_id)
                    ->where('admin_id', $admin_id)
                    ->where('status', 'sold');
                $sold_plots = $this->db->count_all_results('plots');

                // AVAILABLE plots
                $this->db->where('site_id', $site_id)
                    ->where('admin_id', $admin_id)
                    ->where('status', 'available');
                $available_plots = $this->db->count_all_results('plots');

                // Totals count
                $grand_total_plots += $total_plots;
                $grand_sold += $sold_plots;
                $grand_available += $available_plots;

                $listed_map = ((int) ($site->listed_map ?? 0) === 1) || !empty($site->site_map);

                $site_list[] = [
                    'id' => $site->id,
                    'name' => $site->name,
                    'location' => $site->location,
                    'area' => $site->area,
                    'isActive' => $site->isActive,
                    'created_at' => $site->created_at,
                    'total_plots' => $total_plots,
                    'available_plots' => $available_plots,
                    'sold_plots' => $sold_plots,
                    'listed_map' => $listed_map ? 1 : 0,
                    'site_map' => !empty($site->site_map)
                        ? base_url($site->site_map)
                        : null,

                ];
            }

            $summary = [
                'total_plots' => $grand_total_plots,
                'sold_plots' => $grand_sold,
                'available_plots' => $grand_available
            ];

            echo json_encode([
                'status' => true,
                'code' => 200,
                'message' => 'Sites fetched successfully',
                'summary' => $summary,
                'data' => $site_list
            ]);
            return;
        }

        echo json_encode([
            'status' => false,
            'code' => 400,
            'message' => 'No active sites assigned to this user',
            'summary' => [
                'total_plots' => 0,
                'sold_plots' => 0,
                'available_plots' => 0
            ],
            'data' => []
        ]);
    }


    public function search_sites()
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
        $search = $this->input->get('search', TRUE);

        // ✅ Get admin_id
        $user = $this->db->select('admin_id')->where('id', $user_id)->get('users')->row();
        if (!$user) {
            echo json_encode([
                'status' => false,
                'code' => 400,
                'message' => 'User not found',
                'data' => []
            ]);
            return;
        }

        $admin_id = (int) $user->admin_id;

        // ✅ Search only active sites
        $this->db->select('s.id, s.name, s.location, s.area, s.isActive, s.site_map, s.listed_map, s.created_at');
        $this->db->from('sites s');
        $this->db->join('site_assignments sa', 'sa.site_id = s.id', 'inner');
        $this->db->where('sa.user_id', $user_id);
        $this->db->where('s.admin_id', $admin_id);
        $this->db->where('sa.admin_id', $admin_id);
        $this->db->where('s.isActive', 1); // ✅ Only active sites

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('s.name', $search);
            $this->db->or_like('s.location', $search);
            $this->db->group_end();
        }

        $this->db->group_by('s.id');
        $this->db->order_by('s.id', 'DESC');
        $sites = $this->db->get()->result();

        if (!empty($sites)) {
            $site_list = [];

            foreach ($sites as $site) {
                $site_id = (int) $site->id;

                $this->db->where('site_id', $site_id);
                $this->db->where('admin_id', $admin_id);
                $total_plots = (int) $this->db->count_all_results('plots');

                $available_plots = 123;
                $sold_plots = 123;

                $listed_map = ((int) ($site->listed_map ?? 0) === 1) || !empty($site->site_map);

                $site_list[] = [
                    'id' => $site->id,
                    'name' => $site->name,
                    'location' => $site->location,
                    'area' => $site->area,
                    'isActive' => $site->isActive,
                    'created_at' => $site->created_at,
                    'total_plots' => $total_plots,
                    'available_plots' => $available_plots,
                    'sold_plots' => $sold_plots,
                    'listed_map' => $listed_map ? 1 : 0,
                    'site_map' => !empty($site->site_map)
                        ? base_url($site->site_map)
                        : null
                ];
            }

            echo json_encode([
                'status' => true,
                'code' => 200,
                'message' => 'Sites fetched successfully',
                'data' => $site_list
            ]);
            return;
        }

        echo json_encode([
            'status' => false,
            'code' => 400,
            'message' => 'No active sites found for this search',
            'data' => []
        ]);
    }




    public function get_plots($site_id = null)
    {
        header('Content-Type: application/json');

        // 1️⃣ Check site_id
        if (empty($site_id) || !is_numeric($site_id)) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Missing or invalid site_id in URL',
                    'data' => []
                ]));
        }

        // 2️⃣ Validate Token
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

        // 3️⃣ Get admin_id of user
        $user = $this->db->select('admin_id')
            ->where('id', $user_id)
            ->get('users')
            ->row();

        if (!$user) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'User not found',
                    'data' => []
                ]));
        }

        $admin_id = (int) $user->admin_id;

        // 4️⃣ Fetch plots
        $this->db->select('
        p.id,
        p.plot_number,
        p.size,
        p.dimension,
        p.facing,
        p.price,
        p.status,
        p.isActive,
        p.created_at,
        s.name AS site_name
    ');
        $this->db->from('plots p');
        $this->db->join('sites s', 's.id = p.site_id', 'inner');
        $this->db->join('site_assignments sa', 'sa.site_id = s.id', 'inner');
        $this->db->where([
            'sa.user_id' => $user_id,
            'p.site_id' => $site_id,
            'p.admin_id' => $admin_id,
            's.admin_id' => $admin_id,
            'sa.admin_id' => $admin_id,
            'p.isActive' => 1
        ]);
        $this->db->order_by('p.id', 'DESC');

        $plots = $this->db->get()->result_array();

        // ---------------- NEW LOGIC START ----------------
        foreach ($plots as &$plot) {

            // Default values
            $plot['is_sold_by_login_user'] = false;
            $plot['sold_by_user_name'] = null;

            if (strtolower($plot['status']) === 'sold') {

                // Fetch buyer
                $buyer = $this->db
                    ->where('plot_id', $plot['id'])
                    ->where('isActive', 1)
                    ->get('buyer')
                    ->row_array();

                if (!empty($buyer)) {

                    // Check sold by login user
                    if ((int)$buyer['user_id'] === $user_id) {
                        $plot['is_sold_by_login_user'] = true;
                    } else {

                        // Fetch user name who sold
                        $sold_user = $this->db
                            ->select('name')
                            ->where('id', $buyer['user_id'])
                            ->get('users')
                            ->row();

                        $plot['sold_by_user_name'] = $sold_user->name ?? 'Unknown';
                    }
                }
            }
        }
        // ---------------- NEW LOGIC END ----------------

        // 5️⃣ Fetch site details
        $this->db->select('s.id, s.name, s.location, s.area, s.isActive, s.site_map, s.listed_map, s.created_at');
        $this->db->from('sites s');
        $this->db->join('site_assignments sa', 'sa.site_id = s.id', 'inner');
        $this->db->where([
            's.id' => $site_id,
            'sa.user_id' => $user_id,
            's.admin_id' => $admin_id,
            'sa.admin_id' => $admin_id
        ]);
        $site_row = $this->db->get()->row();

        // 6️⃣ Build site counts
        $site = null;
        if ($site_row) {

            $this->db->where('site_id', $site_id)
                ->where('admin_id', $admin_id)
                ->where_in('status', ['available', 'sold']);
            $total_plots = (int) $this->db->count_all_results('plots');

            $this->db->where('site_id', $site_id)
                ->where('admin_id', $admin_id)
                ->where('status', 'sold');
            $sold_plots = (int) $this->db->count_all_results('plots');

            $this->db->where('site_id', $site_id)
                ->where('admin_id', $admin_id)
                ->where('status', 'available');
            $available_plots = (int) $this->db->count_all_results('plots');

            $listed_map = ((int) ($site_row->listed_map ?? 0) === 1) || !empty($site_row->site_map);

            $site = [
                'id' => $site_row->id,
                'name' => $site_row->name,
                'location' => $site_row->location,
                'area' => $site_row->area,
                'isActive' => $site_row->isActive,
                'created_at' => $site_row->created_at,
                'total_plots' => $total_plots,
                'available_plots' => $available_plots,
                'sold_plots' => $sold_plots,
                'listed_map' => $listed_map ? 1 : 0,
                'site_map' => !empty($site_row->site_map)
                    ? base_url($site_row->site_map)
                    : null
            ];
        }

        // 7️⃣ Response
        if (!empty($plots)) {
            return $this->output
                ->set_status_header(200)
                ->set_output(json_encode([
                    'status' => true,
                    'code' => 200,
                    'message' => 'Plots fetched successfully',
                    'site' => $site,
                    'data' => $plots
                ]));
        } else {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'No plots found for this site',
                    'site' => $site,
                    'data' => []
                ]));
        }
    }



    public function plot_details($plot_id = null)
    {
        header('Content-Type: application/json');

        // ----------------- 1. Validate plot_id -----------------
        if (empty($plot_id) || !is_numeric($plot_id)) {
            return $this->output->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Missing or invalid plot_id in URL',
                    'data' => []
                ]));
        }

        // ----------------- 2. Verify Token ----------------------
        $authHeader = $this->input->get_request_header('Authorization', TRUE);
        $token = null;

        if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        }

        $decoded = $this->verify_jwt($token);
        if (!$decoded || empty($decoded->data->id)) {
            return $this->output->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Invalid or missing token',
                    'data' => null
                ]));
        }

        $user_id = (int) $decoded->data->id;

        // ----------------- 3. Get Admin ID -----------------------
        $user = $this->db->select('admin_id')
            ->where('id', $user_id)
            ->get('users')
            ->row();

        if (!$user) {
            return $this->output->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'User not found',
                    'data' => []
                ]));
        }

        $admin_id = (int) $user->admin_id;

        // ----------------- 4. Fetch Plot Details -----------------
        $this->db->select('p.*, s.name AS site_name');
        $this->db->from('plots p');
        $this->db->join('sites s', 's.id = p.site_id', 'inner');
        $this->db->join('site_assignments sa', 'sa.site_id = s.id', 'inner');
        $this->db->where('p.id', $plot_id);
        $this->db->where('p.admin_id', $admin_id);
        $this->db->where('s.admin_id', $admin_id);
        $this->db->where('sa.admin_id', $admin_id);
        $this->db->where('sa.user_id', $user_id);
        $this->db->where('p.isActive', 1);

        $plot = $this->db->get()->row_array();

        if (!$plot) {
            return $this->output->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'No plot found with this ID or access denied',
                    'data' => []
                ]));
        }

        // Default boolean
        $plot['is_sold_by_login_user'] = false;
        // $plot['sold_by_user_name'] = null;

        // ----------------- 5. If Plot SOLD -----------------
        if (strtolower($plot['status']) === 'sold') {

            // -------- Buyer Details --------
            $buyer = $this->db
                ->where('plot_id', $plot_id)
                ->where('isActive', 1)
                ->get('buyer')
                ->row_array();

            if (!empty($buyer)) {

                // Check sold by login user
                if ((int)$buyer['user_id'] === $user_id) {
                    $plot['is_sold_by_login_user'] = true;
                }

                // Get Sold By User Name
                $sold_user = $this->db
                    ->select('name')
                    ->where('id', $buyer['user_id'])
                    ->get('users')
                    ->row();
            }

            // -------- Payment Details --------
            $payment = $this->db
                ->where('plot_id', $plot_id)
                ->get('payment_details')
                ->row_array();

            $cash_logs = [];
            $emi_logs  = [];

            if (!empty($payment)) {

                // ===== CASH MODE =====
                if ($payment['payment_mode'] === "CASH") {

                    $cash_logs = $this->db
                        ->where('plot_id', $plot_id)
                        ->order_by('id', 'ASC')
                        ->get('cash_payment_logs')
                        ->result_array();
                }

                // ===== EMI MODE =====
                if ($payment['payment_mode'] === "EMI") {

                    $emi_logs = $this->db
                        ->where('payment_id', $payment['id'])
                        ->order_by('month_no', 'ASC')
                        ->get('emi_logs')
                        ->result_array();
                }
            }

            // Attach data (keep your structure)
            $plot['buyer_details'] = $buyer ?? null;
            $plot['payment_details'] = $payment ?? null;
            $plot['cash_payment_logs'] = $cash_logs ?? [];
            $plot['emi_logs'] = $emi_logs ?? [];
        }

        // ----------------- 6. Success Response -----------------
        return $this->output->set_status_header(200)
            ->set_output(json_encode([
                'status' => true,
                'code' => 200,
                'message' => 'Plot details fetched successfully',
                'data' => $plot
            ]));
    }



    public function change_plot_status()
    {
        header('Content-Type: application/json');

        // ✅ 1. Verify JWT Token
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

        // ✅ 2. Get admin_id of user
        $user = $this->db->select('admin_id')->where('id', $user_id)->get('users')->row();
        if (!$user) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'User not found',
                    'data' => []
                ]));
        }

        $admin_id = (int) $user->admin_id;

        // ✅ 3. Get JSON payload
        $input = json_decode($this->input->raw_input_stream, true);
        $plot_id = isset($input['id']) ? (int) $input['id'] : 0;
        $status = isset($input['status']) ? strtolower(trim($input['status'])) : '';

        // ✅ 4. Validate input
        $allowed_status = ['available', 'sold', 'pending'];

        if (empty($plot_id) || empty($status)) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Plot ID and status are required',
                    'data' => []
                ]));
        }

        if (!in_array($status, $allowed_status)) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Invalid status value. Allowed: available, sold, pending',
                    'data' => []
                ]));
        }

        // ✅ 5. Check if plot exists and belongs to same admin
        $plot = $this->db->where('id', $plot_id)
            ->where('admin_id', $admin_id)
            ->get('plots')
            ->row();

        if (!$plot) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Plot not found or access denied',
                    'data' => []
                ]));
        }

        // ✅ 6. Update status
        $this->db->where('id', $plot_id);
        $this->db->update('plots', ['status' => $status]);

        if ($this->db->affected_rows() > 0) {
            // ✅ Return updated plot data
            $updated = $this->db->select('p.*, s.name AS site_name')
                ->from('plots p')
                ->join('sites s', 's.id = p.site_id', 'left')
                ->where('p.id', $plot_id)
                ->get()
                ->row();

            return $this->output
                ->set_status_header(200)
                ->set_output(json_encode([
                    'status' => true,
                    'code' => 200,
                    'message' => 'Plot status updated successfully',
                    'data' => $updated
                ]));
        } else {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Failed to update plot status',
                    'data' => []
                ]));
        }
    }


    public function add_buyer()
    {
        header('Content-Type: application/json');

        // ---------------------- 1. AUTH -----------------------
        $authHeader = $this->input->get_request_header('Authorization', TRUE);
        if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            return $this->respond(false, 400, "Missing or invalid authorization header");
        }

        $decoded = $this->verify_jwt($matches[1]);
        if (!$decoded || empty($decoded->data->id)) {
            return $this->respond(false, 400, "Invalid token or user ID missing");
        }

        $user_id = (int) $decoded->data->id;

        // ---------------------- GET ADMIN ---------------------
        $user = $this->db->get_where('users', ['id' => $user_id])->row();
        if (!$user || !$user->admin_id) {
            return $this->respond(false, 400, "Something went wrong");
        }

        $admin_id = $user->admin_id;

        // --------------------- 2. INPUT -----------------------
        $input = json_decode($this->input->raw_input_stream, true);
        if (empty($input)) {
            return $this->respond(false, 400, "Invalid or missing input data");
        }

        // Required main fields
        $main_required = ['plot_id', 'plot_number', 'site_id', 'total_price'];
        foreach ($main_required as $field) {
            if (empty($input[$field])) {
                return $this->respond(false, 400, "$field is required");
            }
        }

        // Buyer fields
        $buyer = $input['buyer'];
        $buyer_required = ['name', 'mobile', 'email', 'address', 'aadhar'];
        foreach ($buyer_required as $field) {
            if (empty($buyer[$field])) {
                return $this->respond(false, 400, "Buyer $field is required");
            }
        }

        $payment = $input['payment'];

        // --------------------- 3. PLOT CHECK ------------------
        $plot = $this->db->get_where('plots', ['id' => $input['plot_id']])->row();
        if (!$plot) {
            return $this->respond(false, 400, "Plot not found");
        }

        // ❗ If plot is already SOLD — stop entry
        if (strtolower($plot->status) === 'sold') {
            return $this->respond(false, 400, "This plot is already sold");
        }

        // --------------------- 4. DUPLICATE BUYER -------------
        $this->db->where('plot_id', $input['plot_id']);
        $this->db->group_start()
            ->where('aadhar', $buyer['aadhar'])
            ->or_where('mobile', $buyer['mobile'])
            ->group_end();

        $existing = $this->db->get('buyer')->row();

        if ($existing) {
            return $this->respond(false, 400, "Buyer already exists for this plot");
        }

        // --------------------- 5. INSERT BUYER ----------------
        $buyerData = [
            'user_id' => $user_id,
            'admin_id' => $admin_id,
            'plot_id' => $input['plot_id'],
            'name' => $buyer['name'],
            'mobile' => $buyer['mobile'],
            'email' => $buyer['email'],
            'address' => $buyer['address'],
            'aadhar' => $buyer['aadhar'],
            'isActive' => 1,
            'created_on' => date('Y-m-d H:i:s'),
        ];

        $this->db->insert('buyer', $buyerData);
        $buyer_id = $this->db->insert_id();

        if (!$buyer_id) {
            return $this->respond(false, 400, "Failed to insert buyer");
        }

        // --------------------- 6. INSERT PAYMENT DETAILS ------
        $paymentData = [
            'user_id'          => $user_id,
            'buyer_id'         => $buyer_id,
            'plot_id'          => $input['plot_id'],
            'admin_id'         => $admin_id,
            'total_price'      => $input['total_price'],
            'payment_mode'     => $payment['payment_mode'], // cash or emi
            'down_payment'     => $payment['down_payment']      ?? 0,
            'remaining_amount' => $payment['remaining_amount']  ?? 0,
            'notes'            => $payment['notes']             ?? null,
            'created_on'       => date('Y-m-d H:i:s'),
        ];

        // Add EMI-specific fields only if EMI mode
        if (strtolower($payment['payment_mode']) === 'emi') {
            $paymentData['emi_duration']        = $payment['emi_duration']        ?? null; // e.g. 12
            $paymentData['emi_start_date']      = date('Y-m-d', strtotime($payment['emi_start_date']));
            $paymentData['installment_amount']  = $payment['insatallment_amount'] ?? null; // fix typo in DB col name
        }

        $this->db->insert('payment_details', $paymentData);
        $payment_id = $this->db->insert_id();

        if (!$payment_id) {
            return $this->respond(false, 400, "Failed to insert payment details");
        }

        // --------------------- CASH LOG -------------------------
        if (strtolower($payment['payment_mode']) === 'cash') {
            $cashLog = [

                'buyer_id'         => $buyer_id,
                'plot_id'          => $input['plot_id'],
                'paid_amount'      => $payment['down_payment'],
                'remaining_amount' => $payment['remaining_amount'],
                'total_price'      => $input['total_price'],
                'status'           => 'pending',
                'notes'            => $payment['notes'] ?? null,
                'created_on'       => date('Y-m-d H:i:s'),
            ];
            $this->db->insert('cash_payment_logs', $cashLog);
        }

        // --------------------- EMI LOGS -------------------------
        $emiRows = [];

        if (strtolower($payment['payment_mode']) === 'emi') {

            // Validate required EMI fields
            if (
                empty($payment['emi_start_date']) ||
                empty($payment['emi_duration']) ||
                empty($payment['insatallment_amount'])
            ) {
                return $this->respond(false, 400, "emi_start_date, emi_duration and insatallment_amount are required for EMI mode");
            }

            $start_date   = date('Y-m-d', strtotime($payment['emi_start_date']));
            $months       = (int) $payment['emi_duration'];        // e.g. 12
            $monthly_emi  = (float) $payment['insatallment_amount']; // e.g. 1000

            for ($i = 1; $i <= $months; $i++) {
                // Each EMI date is i months after start date
                $emi_date = date('Y-m-d', strtotime("+$i month", strtotime($start_date)));

                $emiRows[] = [
                    'payment_id' => $payment_id,
                    'buyer_id'   => $buyer_id,
                    'plot_id'    => $input['plot_id'],
                    // 'admin_id'   => $admin_id,
                    'month_no'   => $i,
                    'emi_date'   => $emi_date,
                    'emi_amount' => $monthly_emi,
                    'status'     => 'pending',
                    'created_on' => date('Y-m-d H:i:s'),
                ];
            }

            $this->db->insert_batch('emi_logs', $emiRows);
        }

        // --------------------- UPDATE PLOT STATUS → SOLD --------
        $this->db->where('id', $input['plot_id']);
        $this->db->update('plots', ['status' => 'sold']);

        // --------------------- SUCCESS --------------------------
        return $this->respond(true, 200, "Buyer & payment saved successfully", [
            "buyer"     => $buyerData,
            "payment"   => $paymentData,
            "emi_rows"  => $emiRows,
        ]);
    }


    private function respond($status, $code, $message, $data = null)
    {
        return $this->output
            ->set_status_header($code)
            ->set_output(json_encode([
                "status" => $status,
                "code" => $code,
                "message" => $message,
                "data" => $data
            ]));
    }

    public function payment_log()
    {
        header('Content-Type: application/json');

        // ---------------------- 1. AUTH -----------------------
        $authHeader = $this->input->get_request_header('Authorization', TRUE);
        if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            return $this->respond(false, 400, "Missing or invalid authorization header");
        }

        $decoded = $this->verify_jwt($matches[1]);
        if (!$decoded || empty($decoded->data->id)) {
            return $this->respond(false, 400, "Invalid token or user ID missing");
        }

        $user_id = (int) $decoded->data->id;

        // ---------------------- GET ADMIN ---------------------
        $user = $this->db->get_where('users', ['id' => $user_id])->row();
        if (!$user || !$user->admin_id) {
            return $this->respond(false, 400, "Something went wrong");
        }

        $admin_id = $user->admin_id;

        // ---------------------- 2. INPUT -----------------------
        $input = json_decode($this->input->raw_input_stream, true);
        if (empty($input)) {
            return $this->respond(false, 400, "Invalid or missing input data");
        }

        // Required fields
        $required = ['plot_id', 'buyer_id', 'total_price', 'amount', 'remaining_amount', 'payment_mode'];
        foreach ($required as $field) {
            if (!isset($input[$field])) {
                return $this->respond(false, 400, "$field is required");
            }
        }



        // ---------------------- 3. INSERT CASH LOG ----------------
        $cashLog = [
            'admin_id' => $admin_id,
            'user_id' => $user_id,
            'buyer_id' => $input['buyer_id'],
            'plot_id' => $input['plot_id'],
            'paid_amount' => $input['amount'],
            'remaining_amount' => $input['remaining_amount'],
            'total_price' => $input['total_price'],
            'status' => 'pending', // default status
            'notes' => $input['notes'] ?? null,
            'created_on' => date('Y-m-d H:i:s'),
        ];

        $this->db->insert('cash_payment_logs', $cashLog);
        $log_id = $this->db->insert_id();

        if (!$log_id) {
            return $this->respond(false, 400, "Failed to create cash payment log");
        }

        return $this->respond(true, 200, "Cash payment log created successfully", $cashLog);
    }

    public function add_expenses()
    {
        header('Content-Type: application/json');

        // VERIFY JWT (same as yours)
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

        // ---------------------- GET ADMIN ---------------------
        $user = $this->db->select('admin_id')
            ->where('id', $user_id)
            ->get('users')
            ->row();

        if (!$user || !$user->admin_id) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Admin not found for this user',
                    'data' => null
                ]));
        }

        $admin_id = (int) $user->admin_id;

        // ---------------------- READ FORM-DATA (NOT JSON)
        $site_id = (int) $this->input->post('site_id');
        $description = trim($this->input->post('description'));
        $date = $this->input->post('date');
        $amount = $this->input->post('amount');

        //  Validate
        if (!$site_id || empty($description) || empty($date) || empty($amount)) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'site_id, description, date and amount are required',
                    'data' => null
                ]));
        }

        // Check site assignment (your logic unchanged)
        $assigned_site = $this->db
            ->select('s.id')
            ->from('sites s')
            ->join('site_assignments sa', 'sa.site_id = s.id', 'inner')
            ->where([
                'sa.user_id' => $user_id,
                's.admin_id' => $admin_id,
                'sa.admin_id' => $admin_id,
                's.id' => $site_id,
                's.isActive' => 1
            ])
            ->get()
            ->row();

        if (!$assigned_site) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'This site is not assigned to you',
                    'data' => null
                ]));
        }

        // HANDLE IMAGE UPLOAD
        $image_path = null;

        if (isset($_FILES['expense_image']) && $_FILES['expense_image']['error'] == 0) {

            $upload_dir = FCPATH . 'uploads/expenses/';

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            $config = [
                'upload_path'   => $upload_dir,
                'allowed_types' => 'jpg|jpeg|png|pdf',
                'max_size'      => 2048,
                'file_name'     => 'EXP_' . time() . '_' . $user_id,
                'overwrite'     => false
            ];

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('expense_image')) {

                echo $this->upload->display_errors();
                exit;
            }

            $upload_data = $this->upload->data();

            $image_path = 'uploads/expenses/' . $upload_data['file_name'];
        }

        // Prepare data for DB
        $expense_data = [
            'user_id' => $user_id,
            'admin_id' => $admin_id,
            'site_id' => $site_id,
            'description' => $description,
            'date' => $date,
            'amount' => $amount,
            'expense_image' => $image_path,
            'status' => 'pending',
            'isActive' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Insert
        if ($this->db->insert('expenses', $expense_data)) {

            $expense_data['image_url'] = $image_path
                ? base_url($image_path)
                : null;

            return $this->output
                ->set_status_header(200)
                ->set_output(json_encode([
                    'status' => true,
                    'code' => 200,
                    'message' => 'Expense added successfully',
                    'data' => $expense_data
                ]));
        }

        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'status' => false,
                'code' => 400,
                'message' => 'Failed to add expense',
                'data' => null
            ]));
    }


    public function get_expenses()
    {
        header('Content-Type: application/json');

        // ✅ 1. Verify JWT Token
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

        // ✅ 2. Get admin_id
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

        // ✅ 3. Get filter, site_id, and month/year
        $filter_input = $this->input->get('filter');

        if (!empty($filter_input) && is_string($filter_input)) {
            $filter = strtolower($filter_input);
        } else {
            $filter = null;
        }


        $site_id = $this->input->get('site_id');

        // ⭐ Month filter (default → current month)
        $month_input_raw = $this->input->get('month');

        $month_input = (!empty($month_input_raw) && is_string($month_input_raw))
            ? strtolower($month_input_raw)
            : null;

        $month_number = null;

        if (!empty($month_input)) {

            if (is_numeric($month_input) && $month_input >= 1 && $month_input <= 12) {
                $month_number = (int) $month_input;
            } else {
                $month_number = date('n', strtotime($month_input));
            }
        } else {
            $month_number = date('n'); // current month
        }

        // ⭐ Year filter (default → current year)
        $year_input = $this->input->get('year');
        $year_number = !empty($year_input) ? (int) $year_input : (int) date('Y');


        // ✅ 4. Optional site check
        if (!empty($site_id)) {
            $check_site = $this->db->get_where('site_assignments', [
                'site_id' => $site_id,
                'user_id' => $user_id,
                'admin_id' => $admin_id
            ])->row();

            if (!$check_site) {
                return $this->output
                    ->set_status_header(400)
                    ->set_output(json_encode([
                        'status' => false,
                        'code' => 400,
                        'message' => 'You are not assigned to this site',
                        'data' => null
                    ]));
            }
        }

        // ✅ 5. Base query
        $this->db->select('id, admin_id, site_id, description, date, amount, status, isActive, created_at, expense_image');
        $this->db->from('expenses');
        $this->db->where('user_id', $user_id);
        $this->db->where('admin_id', $admin_id);
        $this->db->where('isActive', 1);

        if (!empty($site_id)) {
            $this->db->where('site_id', $site_id);
        }

        // 🎯 ALWAYS APPLY MONTH/YEAR FILTER
        $this->db->where('MONTH(date)', $month_number);
        $this->db->where('YEAR(date)', $year_number);

        // ⭐ Additional filters
        if ($filter === 'today') {
            $this->db->where('DATE(date)', date('Y-m-d'));
        }

        if ($filter === 'this_week') {
            $this->db->where('YEARWEEK(date, 1) = YEARWEEK(CURDATE(), 1)', NULL, FALSE);
        }

        // Note: "all" still means all records within selected month.


        // ✅ 7. Fetch data
        $this->db->order_by('id', 'DESC');
        $expenses = $this->db->get()->result();

        foreach ($expenses as $e) {
            if (!empty($e->expense_image)) {
                $e->image_url = base_url($e->expense_image);
            } else {
                $e->image_url = null;
            }
        }


        // ✅ 8. Handle no records
        if (empty($expenses)) {
            return $this->output
                ->set_status_header(200)
                ->set_output(json_encode([
                    'status' => true,
                    'code' => 200,
                    'message' => 'No expenses found',
                    'month' => $month_number,
                    'year' => $year_number,
                    'total_expenses' => 0,
                    'total_amount' => 0,
                    'total_pending' => 0,
                    'total_approved' => 0,
                    'data' => []
                ]));
        }

        // ✅ 9. Calculate totals
        $total_amount = 0;
        $pending_count = 0;
        $approved_count = 0;

        foreach ($expenses as $e) {
            $total_amount += (float) $e->amount;
            if ($e->status === 'pending')
                $pending_count++;
            if ($e->status === 'approve')
                $approved_count++;
        }

        // ✅ 10. Success response
        return $this->output
            ->set_status_header(200)
            ->set_output(json_encode([
                'status' => true,
                'code' => 200,
                'message' => 'Expenses fetched successfully',
                'month' => $month_number,
                'year' => $year_number,
                'total_expenses' => count($expenses),
                'total_amount' => $total_amount,
                'total_pending' => $pending_count,
                'total_approved' => $approved_count,
                'data' => $expenses
            ]));
    }

    public function get_profile()
    {
        header('Content-Type: application/json');

        // ✅ 1. Verify JWT Token
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

        // ✅ 2. Fetch user profile
        $user = $this->db
            ->select('id, admin_id, name, profile_image, email, mobile, location, bio, isActive')
            ->where('id', $user_id)
            ->get('users')
            ->row();

        // ✅ 3. If user not found
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

        // ✅ 4. Build full image URL
        $base_url = base_url('uploads/profile_images/');
        if (!empty($user->profile_image) && file_exists(FCPATH . 'uploads/profile_images/' . $user->profile_image)) {
            $user->profile_image = $base_url . $user->profile_image;
        } else {
            $user->profile_image = base_url('uploads/default.png'); // Default fallback image
        }

        // ✅ 5. Success Response
        return $this->output
            ->set_status_header(200)
            ->set_output(json_encode([
                'status' => true,
                'code' => 200,
                'message' => 'Profile fetched successfully',
                'data' => $user
            ]));
    }

    public function get_sallary()
    {
        header('Content-Type: application/json');

        // ---------------------- 1. Verify JWT ------------------------
        $authHeader = $this->input->get_request_header('Authorization', TRUE);
        if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {

            return $this->output->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Missing or invalid token'
                ]));
        }

        $token = $matches[1];
        $decoded = $this->verify_jwt($token);

        if (!$decoded || empty($decoded->data->id)) {

            return $this->output->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Invalid token or user ID missing'
                ]));
        }

        $user_id = (int) $decoded->data->id;

        // ---------------------- 2. Fetch User ------------------------
        $user = $this->db->get_where("users", [
            "id" => $user_id,
            "isActive" => 1
        ])->row();

        if (!$user) {
            return $this->output->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'User not found'
                ]));
        }

        $daily_salary = (float) $user->daily_salary;

        // ---------------------- 3. Attendance Counts (Current Month) ------------------------

        // Present count
        $present = $this->db->where('user_id', $user_id)
            ->where('status', 'present')
            ->where('MONTH(created_at) = MONTH(NOW())')
            ->where('YEAR(created_at) = YEAR(NOW())')
            ->count_all_results('attendance');

        // Absent count
        $absent = $this->db->where('user_id', $user_id)
            ->where('status', 'absent')
            ->where('MONTH(created_at) = MONTH(NOW())')
            ->where('YEAR(created_at) = YEAR(NOW())')
            ->count_all_results('attendance');

        // Total days counted
        $total_days = $present + $absent;

        // ---------------------- 4. Salary Calculation ------------------------
        $total_salary = $present * $daily_salary;

        // ---------------------- 5. SUCCESS RESPONSE ------------------------
        return $this->output->set_status_header(200)
            ->set_output(json_encode([
                'status' => true,
                'code' => 200,
                'message' => 'Salary fetched successfully',
                'data' => [
                    'total_present_days' => $present,
                    'total_absent_days' => $absent,
                    'total_days' => $total_days,
                    'total_salary' => $total_salary
                ]
            ]));
    }

    public function update_profile()
    {
        header('Content-Type: application/json');

        // ✅ 1. Verify JWT Token
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

        // ✅ 2. Get Form Data
        $name = trim($this->input->post('name'));
        $email = trim($this->input->post('email'));
        $mobile = trim($this->input->post('mobile'));
        $location = trim($this->input->post('location'));
        $bio = trim($this->input->post('bio'));

        // ✅ 3. Validate
        if (empty($name) || empty($email) || empty($mobile)) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Name, email, and mobile are required',
                    'data' => null
                ]));
        }

        // ✅ 4. Handle Profile Image Upload (optional)
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
                return $this->output
                    ->set_status_header(400)
                    ->set_output(json_encode([
                        'status' => false,
                        'code' => 400,
                        'message' => $this->upload->display_errors('', ''),
                        'data' => null
                    ]));
            }
        }

        // ✅ 5. Prepare Update Data
        $updateData = [
            'name' => $name,
            'email' => $email,
            'mobile' => $mobile,
            'location' => $location,
            'bio' => $bio,
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($profile_image) {
            $updateData['profile_image'] = $profile_image;
        }

        // ✅ 6. Update User Record
        $updated = $this->db->where('id', $user_id)->update('users', $updateData);

        if ($updated) {
            // Fetch updated data
            $user = $this->db->select('id, name, email, mobile, location, bio, profile_image, isActive')
                ->where('id', $user_id)
                ->get('users')
                ->row();

            // Add full URL for profile image
            if (!empty($user->profile_image)) {
                $user->profile_image = base_url($user->profile_image);
            }

            return $this->output
                ->set_status_header(200)
                ->set_output(json_encode([
                    'status' => true,
                    'code' => 200,
                    'message' => 'Profile updated successfully',
                    'data' => $user
                ]));
        } else {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Failed to update profile',
                    'data' => null
                ]));
        }
    }
    public function upload_document()
    {
        header('Content-Type: application/json');

        // 🔐 Verify JWT
        $authHeader = $this->input->get_request_header('Authorization', TRUE);
        $token = null;

        if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        }

        $decoded = $this->verify_jwt($token);
        if (!$decoded || empty($decoded->data->id)) {
            return $this->output->set_status_header(400)
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
        $admin_id = (int) $user->admin_id; // ⭐ Add admin id inside JWT

        // 🔍 Safe get document_name
        $document_name = $this->input->post('document_name');
        $document_name = $document_name !== null ? trim($document_name) : '';

        if ($document_name === '') {
            return $this->output->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'document_name is required',
                    'data' => null
                ]));
        }

        // 📁 Check file
        if (empty($_FILES['document']['name'])) {
            return $this->output->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'No document file uploaded',
                    'data' => null
                ]));
        }

        // 📤 Upload config
        $config['upload_path'] = './uploads/documents/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size'] = 4096;
        $config['file_name'] = 'DOC_' . $user_id . '_' . time();

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('document')) {
            return $this->output->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => $this->upload->display_errors('', ''),
                    'data' => null
                ]));
        }

        $uploadData = $this->upload->data();
        $document_path = 'uploads/documents/' . $uploadData['file_name'];

        // 📝 Insert in documents table
        $insert = $this->db->insert('documents', [
            'admin_id' => $admin_id,
            'user_id' => $user_id,
            'document_name' => $document_name,
            'document_path' => $document_path,
            'created_at' => date('Y-m-d H:i:s'),
            'isActive' => 1
        ]);

        if ($insert) {
            return $this->output->set_status_header(200)
                ->set_output(json_encode([
                    'status' => true,
                    'code' => 200,
                    'message' => 'Document uploaded successfully',
                    'data' => [
                        'document_name' => $document_name,
                        'document_path' => base_url($document_path)
                    ]
                ]));
        }

        return $this->output->set_status_header(400)
            ->set_output(json_encode([
                'status' => false,
                'code' => 400,
                'message' => 'Failed to save document',
                'data' => null
            ]));
    }



    public function get_document()
    {
        header('Content-Type: application/json');

        // 🔐 Verify JWT
        $authHeader = $this->input->get_request_header('Authorization', TRUE);
        $token = null;

        if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        }

        $decoded = $this->verify_jwt($token);
        if (!$decoded || empty($decoded->data->id)) {
            return $this->output->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Invalid token or user ID missing',
                    'data' => null
                ]));
        }

        $user_id = (int) $decoded->data->id;

        // 📌 Get all documents
        $documents = $this->db
            ->where('user_id', $user_id)
            ->where('isActive', 1)
            ->get('documents')
            ->result();

        if (empty($documents)) {
            return $this->output->set_status_header(200)
                ->set_output(json_encode([
                    'status' => true,
                    'code' => 200,
                    'message' => 'No documents found',
                    'data' => []
                ]));
        }

        // 🌐 Add full URL
        foreach ($documents as $doc) {
            $doc->document_path = base_url($doc->document_path);
        }

        return $this->output->set_status_header(200)
            ->set_output(json_encode([
                'status' => true,
                'code' => 200,
                'message' => 'Documents fetched successfully',
                'data' => $documents
            ]));
    }


    public function add_inquiry()
    {
        header('Content-Type: application/json');

        // ✅ 1. Verify JWT Token
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

        // ✅ 2. Get admin_id
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

        // ✅ 3. Read Input
        $input = json_decode($this->input->raw_input_stream, true);
        $site_id = isset($input['site_id']) ? (int) $input['site_id'] : null;
        $plot_id = isset($input['plot_id']) ? (int) $input['plot_id'] : null;
        $customer_name = trim((string) ($input['customer_name'] ?? ''));
        $mobile = trim((string) ($input['mobile'] ?? ''));
        $address = trim((string) ($input['address'] ?? ''));
        $note = trim((string) ($input['note'] ?? ''));

        // ✅ 4. Validation
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

        // ✅ 5. Check if site belongs to user
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

        // ✅ 6. Check if plot exists under the same site
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

        // ✅ 7. Prevent duplicate inquiry (same site + plot + mobile)
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

        // ✅ 8. Insert Inquiry
        $data = [
            'admin_id' => $admin_id,
            'user_id' => $user_id,
            'site_id' => $site_id,
            'plot_id' => $plot_id,
            'customer_name' => $customer_name,
            'mobile' => $mobile,
            'address' => $address,
            'note' => $note,
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

        // ✅ 9. Fallback Error
        return $this->output
            ->set_status_header(500)
            ->set_output(json_encode([
                'status' => false,
                'code' => 500,
                'message' => 'Failed to add inquiry',
                'data' => null
            ]));
    }


    public function inquiry_list()
    {
        header('Content-Type: application/json');

        // ✅ Verify JWT
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

    public function inquiry_search()
    {
        header('Content-Type: application/json');

        // ✅ Verify JWT
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
        $keyword = trim($this->input->get('query'));

        $this->db->select('i.*, s.name, p.plot_number')
            ->from('inquiries i')
            ->join('sites s', 's.id = i.site_id', 'left')
            ->join('plots p', 'p.id = i.plot_id', 'left')
            ->where('i.user_id', $user_id);

        if (!empty($keyword)) {
            $this->db->group_start()
                ->like('i.customer_name', $keyword)
                ->or_like('i.mobile', $keyword)
                ->or_like('s.name', $keyword)
                ->or_like('p.plot_number', $keyword)
                ->group_end();
        }

        $results = $this->db->get()->result();

        return $this->output->set_status_header(200)->set_output(json_encode([
            'status' => true,
            'code' => 200,
            'message' => 'Search results',
            'data' => $results
        ]));
    }

    public function add_attendance()
    {
        header('Content-Type: application/json');

        // ✅ 1. Verify JWT Token
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

        // ✅ 2. Get admin_id
        $user = $this->db->select('admin_id')->where('id', $user_id)->get('users')->row();
        if (!$user) {
            return $this->output
                ->set_status_header(404)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 404,
                    'message' => 'User not found',
                    'data' => null
                ]));
        }

        $admin_id = (int) $user->admin_id;

        // ✅ 3. Handle image upload (form-data)
        if (empty($_FILES['attendance_image']['name'])) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Attendance image is required',
                    'data' => null
                ]));
        }

        $upload_path = FCPATH . 'uploads/attendance/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // 2 MB
        $config['file_name'] = 'attendance_' . time() . '_' . $user_id;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('attendance_image')) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => $this->upload->display_errors('', ''),
                    'data' => null
                ]));
        }

        $upload_data = $this->upload->data();
        $image_path = base_url('uploads/attendance/' . $upload_data['file_name']);

        // ✅ 4. Insert attendance with current date/time and default status = pending
        $current_time = date('Y-m-d H:i:s');

        $data = [
            'admin_id' => $admin_id,
            'user_id' => $user_id,
            'image_path' => $image_path,
            'attendance_time' => $current_time, // ⏰ New field for current date & time
            'status' => 'pending',
            'isActive' => 1,
            'created_at' => $current_time
        ];

        if ($this->db->insert('attendance', $data)) {
            return $this->output
                ->set_status_header(200)
                ->set_output(json_encode([
                    'status' => true,
                    'code' => 200,
                    'message' => 'Attendance submitted successfully. Waiting for admin approval.',
                    'data' => $data
                ]));
        }

        // ✅ 5. Fallback Error
        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'status' => false,
                'code' => 400,
                'message' => 'Failed to submit attendance',
                'data' => null
            ]));
    }


    public function get_attendance()
    {
        header('Content-Type: application/json');

        // ✅ 1. Verify JWT Token
        $authHeader = $this->input->get_request_header('Authorization', TRUE);
        $token = null;

        if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        }

        $decoded = $this->verify_jwt($token);
        if (!$decoded || empty($decoded->data->id)) {
            return $this->output
                ->set_status_header(401)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 401,
                    'message' => 'Invalid or missing token',
                    'data' => null
                ]));
        }

        $user_id = (int) $decoded->data->id;

        // ✅ 2. Get month filter (example: ?month=November)
        $month_param = $this->input->get('month');
        $year = date('Y'); // current year

        if (empty($month_param)) {
            // ✅ No month passed — use current month
            $month_num = date('m');
            $month_name = date('F'); // Full month name
        } else {
            // ✅ Normalize month name and convert safely
            $month_name = ucfirst(strtolower($month_param));
            $timestamp = strtotime("1 " . $month_name . " " . $year);

            if (!$timestamp) {
                return $this->output
                    ->set_status_header(400)
                    ->set_output(json_encode([
                        'status' => false,
                        'code' => 400,
                        'message' => 'Invalid month name provided',
                        'data' => null
                    ]));
            }

            $month_num = date('m', $timestamp);
        }

        // ✅ 3. Build date range
        $start_date = date('Y-m-01', strtotime("$year-$month_num-01"));
        $end_date = date("Y-m-t", strtotime($start_date));

        // ✅ 4. Fetch attendance for the month
        $attendance = $this->db
            ->select('id, image_path, status, attendance_time, created_at')
            ->where('user_id', $user_id)
            ->where('attendance_time >=', $start_date)
            ->where('attendance_time <=', $end_date)
            ->order_by('attendance_time', 'DESC')
            ->get('attendance')
            ->result();

        // ✅ 5. Add full image URL
        $base_url = base_url('uploads/attendance/');
        foreach ($attendance as $row) {
            $row->image_path = $row->image_path ? $base_url . basename($row->image_path) : null;
        }

        // ✅ 6. Return response
        if (empty($attendance)) {
            return $this->output
                ->set_status_header(200)
                ->set_output(json_encode([
                    'status' => true,
                    'code' => 200,
                    'message' => "No attendance records found for $month_name",
                    'data' => []
                ]));
        }

        return $this->output
            ->set_status_header(200)
            ->set_output(json_encode([
                'status' => true,
                'code' => 200,
                'message' => "Attendance records fetched successfully for $month_name",
                'data' => $attendance
            ]));
    }



    private function verify_jwt($token)
    {
        if (empty($token)) {
            $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Authorization header missing or invalid',
                    'data' => null
                ]))
                ->_display();
            exit;
        }

        try {
            $decoded = JWT::decode($token, new Key($this->jwt_secret, 'HS256'));

            $query = $this->db->get_where('token_blacklist', ['token' => $token]);
            if ($query->num_rows() > 0) {
                $this->output
                    ->set_status_header(400)
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'status' => false,
                        'code' => 400,
                        'message' => 'Token has been invalidated. Please log in again.',
                        'data' => null
                    ]))
                    ->_display();
                exit;
            }

            return $decoded;
        } catch (Exception $e) {
            $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Invalid token: ' . $e->getMessage(),
                    'data' => null
                ]))
                ->_display();
            exit;
        }
    }

    private function generate_jwt($user)
    {
        $payload = [
            'iss' => base_url(),
            'iat' => time(),
            'exp' => time() + (10 * 365 * 24 * 60 * 60), // ✅ Valid for 10 years
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email ?? '',
                'mobile' => $user->mobile,
                'profile_image' => $user->profile_image ?? '',
            ]
        ];

        return JWT::encode($payload, $this->jwt_secret, 'HS256');
    }
}
