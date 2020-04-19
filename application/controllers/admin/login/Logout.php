<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
@Description: Logut controller
@Author: Dhaval Panchal
@Date: 24-11-2016
 */

class Logout extends CI_Controller
{
    public function index()
    {
        $admin_session = $this->session->userdata($this->lang->line('business_crm_admin_session'));

        if ($admin_session['active'] == true) {
            $this->session->unset_userdata($this->lang->line('business_crm_admin_session'));
            $this->session->unset_userdata($this->lang->line('admin_sortsearchpage_data'));
            $this->session->unset_userdata($this->lang->line('lead_sortsearchpage_data'));
            $this->session->unset_userdata($this->lang->line('to_do_sortsearchpage_data'));
            $this->session->unset_userdata($this->lang->line('lead_source_sortsearchpage_data'));
            $this->session->unset_userdata($this->lang->line('current_url_session'));
            $this->session->unset_userdata('name');
            $this->session->unset_userdata('id');
            $this->session->unset_userdata('useremail');
            $this->session->unset_userdata('active');
            $this->session->unset_userdata($this->lang->line('business_crm_admin_session'));
            redirect('admin/login');
        } else {
            redirect('admin/login');
        }
    }
}
