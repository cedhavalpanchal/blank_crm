<?php

/*
  @Description: Reset Password
  @Author: Mit Makwana
  @Input:
  @Output:
  @Date: 25-11-2016

 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reset_password_control extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->admin_session = $this->session->userdata($this->lang->line('business_crm_admin_session'));
        $this->message_session = $this->session->flashdata('message_session');
        $this->load->model('Common_function_model');
        $this->viewname = $this->router->uri->segments[2];
    }

    /*
      @Description: Function for Get All Template
      @Author: Mit Makwana
      @Input: - load templated
      @Output: -
      @Date: 25-11-2016
     */

    public function index() {

        $data['main_content'] = 'reset_password/' . $this->viewname . "/list";
        $this->load->view('reset_password/include/template', $data);
    }

    /*
      @Description: Function Load Reset Password Template
      @Author: Mit Makwana
      @Input: - Forgot Password
      @Output: - Send Email Template
      @Date: 25-11-2016
     */

    public function reset_password_template() {

        $id = $this->router->uri->segments[3];
        $admin_id = base64_decode(urldecode($id));
        if (!empty($admin_id)) {
            
            $fields = array('id,CONCAT_WS(" ",first_name,last_name) as name,email,is_forgot_password');
            $match = array('id' => $admin_id);
            $sq_data_all = array
                (
                    "table" => 'admin_management',
                    "fields" => $fields,
                    "condition" => $match
                   );
            $exist_email = $this->Common_function_model->getmultiple_tables($sq_data_all);


            if(!empty($exist_email))
            {
                $data['is_forgot_password'] = $exist_email[0]['is_forgot_password'];
                $data['main_content'] = "reset_password/reset_password_link/add";
                $this->load->view('reset_password/include/template', $data);
                
            }else
            {
                $msg = $this->lang->line('wrong_data_error');
                $status = $this->lang->line('message_type_failed');
            
                 $response = array(
                        "status" => $status,
                        "message" => $msg
                    );
                $this->session->set_flashdata('response', $response);
                redirect('admin');
            }
        }else
        {
            $msg = $this->lang->line('wrong_data_error');
            $status = $this->lang->line('message_type_failed');
            
                 $response = array(
                        "status" => $status,
                        "message" => $msg
                    );
                $this->session->set_flashdata('response', $response);
                redirect('admin');
        }
      
    }
    /*
      @Description: Function Load Reset Password
      @Author: Mit Makwana
      @Input: - Forgot Password in Add New password
      @Output: - login Admin/user
      @Date: 25-11-2016
     */

    public function change_password() {
        
        $id = $this->input->post('id');
        $admin_id = base64_decode(urldecode($id));
        $password = $this->input->post('txt_npassword');
        $reset_pass['password'] = $this->Common_function_model->encrypt_script($password);
        $reset_pass['id'] = $admin_id;
        $reset_pass['is_forgot_password'] = '0';
        $reset_pass['modified_date'] = date('Y-m-d: H-m-i');
        if (!empty($admin_id)) {
            $fields = array('id,CONCAT_WS(" ",first_name,last_name) as name,email');
            $match = array('id' => $admin_id);
            $sq_data_all = array
                (
                    "table" => 'admin_management',
                    "fields" => $fields,
                    "condition" => $match
                   );
            $exist_email = $this->Common_function_model->getmultiple_tables($sq_data_all);
        } else {

            $msg = $this->lang->line('mail_not_registered');
            $status = $this->lang->line('message_type_failed');
            
                 $response = array(
                        "status" => $status,
                        "message" => $msg
                    );
                $this->session->set_flashdata('response', $response);
                redirect('admin');
        }
        
        
        if (!empty($exist_email)) {
            $this->Common_function_model->update('admin_management',$reset_pass,array('id'=>$admin_id));
            
            $msg = $this->lang->line('password_change_succ');
            $status = $this->lang->line('message_type_success');
            $response = array(
                   "status" => $status,
                   "message" => $msg
               );
            
           $this->session->set_flashdata('response', $response);
           redirect('reset_password/reset_password_template/'.$id);
           
        } else {
            $msg = $this->lang->line('password_not_change');
            $status = $this->lang->line('message_type_failed');
            
                 $response = array(
                        "status" => $status,
                        "message" => $msg
                    );
                $this->session->set_flashdata('response', $response);
                redirect('admin');
        }
    }
}
