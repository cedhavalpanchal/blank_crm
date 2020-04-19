<?php
/*
@Description: Function to view the system settings
@Author: Dhaval Panchal
@Date: 20-04-2017
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admin_settings_control extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_admin_login();
        $this->admin_session   = $this->session->userdata('business_crm_admin_session');
        $this->message_session = $this->session->flashdata('message_session');
        $this->viewName        = $this->router->uri->segments[2];
        $this->user_type       = 'admin';
        $this->table_name      = 'settings_master';
        $this->page_title      = $this->lang->line('system_configuration');
        $this->load->model('Common_function_model');
    }

    /*
    @Description: Function to edit the system settings
    @Author: Dhaval Panchal
    @Date: 20-04-2017
     */
    public function index()
    {
        $params = array
            (
            "table" => $this->table_name,
        );
        $data['editRecord'] = $this->Common_function_model->getmultiple_tables($params);

        if (!empty($data['editRecord'][0]['smtp_pass'])) {
            $data['editRecord'][0]['smtp_pass'] = $this->Common_function_model->decrypt_script($data['editRecord'][0]['smtp_pass']);
        }

        $data['main_content'] = "admin/" . $this->viewName . "/add";
        $data['foot_part_js'] = 'setting';
        $this->load->view('admin/include/template', $data);
    }

    /*
    @Description: Function to update system settings
    @Author: Dhaval Panchal
    @Date: 20-04-2017
     */
    public function update_data()
    {
        $id = $this->input->post('id');

        $cdata['sitename']        = trim($this->input->post('sitename'));
        $cdata['address1']        = trim($this->input->post('address1'));
        $cdata['address2']        = trim($this->input->post('address2'));
        $cdata['contact_number']  = trim($this->input->post('contact_number'));
        $cdata['contact_email']   = trim($this->input->post('contact_email'));
        $cdata['admin_email']     = trim($this->input->post('admin_email'));
        $cdata['smtp_host']       = trim($this->input->post('smtp_host'));
        $cdata['smtp_user']       = trim($this->input->post('smtp_user'));
        $cdata['protocol']        = trim($this->input->post('protocol'));
        $cdata['smtp_port']       = trim($this->input->post('smtp_port'));
        $cdata['smtp_timeout']    = trim($this->input->post('smtp_timeout'));
        $cdata['smtp_pass']       = $this->Common_function_model->encrypt_script(trim($this->input->post('smtp_pass')));
        $cdata['current_version'] = trim($this->input->post('current_version'));

        $this->Common_function_model->update('settings_master', $cdata, array('id' => $id));
        //$msg = $this->lang->line('common_edit_success_msg');
        //$this->session->set_flashdata('message_session', $msg);

        $response = array(
            "status"  => $this->lang->line('message_type_success'),
            "message" => $this->lang->line('common_edit_success_msg'),
        );
        $this->session->set_flashdata('message_session', $response);

        redirect('admin/' . $this->viewName);
    }
}
