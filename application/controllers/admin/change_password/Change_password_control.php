<?php

/*
@Description: Change Password
@Author: Dhaval Panchal
@Date: 14-04-17
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Change_password_control extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_admin_login();
        $this->admin_session = $this->session->userdata($this->lang->line('business_crm_admin_session'));
        $this->user_type     = 'admin';
        $this->viewName      = $this->router->uri->segments[2];
        $this->page_title    = $this->lang->line('cg_pwd');
        $this->load->model('Common_function_model');
    }

    /*
    @Description: Function for Get password
    @Author: Dhaval Panchal
    @Date: 14-04-17
     */

    public function index()
    {
        $data['main_content'] = "admin/" . $this->viewName . "/change_password";
        $data['foot_part_js'] = 'change_password';
        $this->load->view('admin/include/template', $data);
    }

    /*
    @Description: Function for Update password
    @Author: Dhaval Panchal
    @Input: - Update details of password
    @Output: - List with updated password details
    @Date: 14-04-2017
     */

    public function admin_change_password()
    {
        $this->load->library('form_validation');

        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post('save') === 'submitForm') {
            $this->form_validation->set_rules('oldpassword', 'Old password', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]');
            $this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required');

            if ($this->form_validation->run() == false) {
                $data['main_content'] = $this->user_type . '/' . $this->viewName . "/change_password";
                $this->load->view($this->user_type . '/include/template', $data);
            } else {
                $id       = $this->admin_session['id'];
                $password = $this->Common_function_model->encrypt_script($this->input->post('oldpassword'));

                $match       = array('id' => $id, 'password' => $password);
                $sq_data_all = array
                    (
                    "table"     => 'admin_management',
                    "condition" => $match,
                );
                $result = $this->Common_function_model->getmultiple_tables($sq_data_all);

                if (!empty($result) && count($result) > 0) {
                    $cdata['password'] = $this->Common_function_model->encrypt_script($this->input->post('password'));

                    $match  = array('id' => $id);
                    $update = $this->Common_function_model->update('admin_management', $cdata, $match);

                    $response = array(
                        "status"  => $this->lang->line('message_type_success'),
                        "message" => $this->lang->line('password_change_succ'),
                    );
                    $this->session->set_flashdata('message_session', $response);
                    redirect('admin/' . $this->viewName);
                } else {
                    $response = array(
                        "status"  => $this->lang->line('message_type_failed'),
                        "message" => $this->lang->line('invalid_old_password'),
                    );
                    $this->session->set_flashdata('message_session', $response);
                    redirect('admin/' . $this->viewName);
                }
            }
        } else {
            $response = array(
                "status"  => $this->lang->line('message_type_failed'),
                "message" => $this->lang->line('common_error_msg'),
            );
            $this->session->set_flashdata('change_password_session', $response);
            redirect($this->user_type . '/' . $this->viewName);
        }
    }
}
