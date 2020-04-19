<?php

/*
@Description: Dashboard
@Author: Dhaval Panchal
@Date: 25-11-2016
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_admin_login();
        $this->load->model('common_function_model');
        $this->user_type     = 'admin';
        $this->admin_session = $this->session->userdata($this->lang->line('business_crm_admin_session'));
        if (empty($this->admin_session['active'])) {
            redirect('admin/logout');
        }
    }

    public function index()
    {
        $this->page_title  = $this->lang->line('dashboard');
        $data['main_content'] = "admin/home/dashboard";
        $this->load->view('admin/include/template', $data);
    }
}
