<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct();
       
        $this->load->helper('url');

        $this->load->model('general_model');

    }

    public function delete_account() 
    {
        $this->load->view('pages/delete_account');
    }

    public function terms_conditions()
    {
        $this->load->view('pages/terms_conditions');
    }

    public function privacy_policy()
    {
        $this->load->view('pages/privacy_policy');
    }
}
