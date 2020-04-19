<?php
/*
    @Description        :Employee WS controller
    @Author             :Sanjay Rathod
    @Date               :23-06-2018
*/

if (!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
//require_once APPPATH . 'third_party/PaypalPayouts/PaypalPayouts.php';

class Employee_control extends REST_Controller {
    function __construct() {
        parent::__construct();
        
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        
        $this->load->model('Common_function_model');
        $this->load->model('Imageupload_model');
        $this->viewName = $this->router->uri->segments[2];
        $this->final_array = array();
        //error_reporting(E_ALL); exit;
        
    }

    function alpha_numeric_space($str) {
        return (!preg_match("/^[\S]+$/i", $str)) ? false : true;
    }

    /*
        @Description        :Employee Login
        @Author             :Sanjay Rathod
        @input              :email,password,device_token
        @Output             :User Login
        @Date               :23-06-2018
        @Webservices link   :
     */
    
    function employee_login_post()
    {
        $data = $this->post();
        $this->form_validation->set_rules('email', 'Email Id', 'trim|required|valid_email');
        $this->form_validation->set_rules('uuid', 'UUID', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|callback_alpha_numeric_space');
        $this->form_validation->set_message('alpha_numeric_space', 'spaces not allow.');
        
        if ($this->form_validation->run() == false) {
            $msg['MESSAGE'] = strip_tags(validation_errors());
            $msg['FLAG']    = FALSE;
        } else {

            $passwd = $this->Common_function_model->encrypt_script($data['password']);
            $params = array(
                    'table'=>'user_master',
                    'where'=>array('email' => "'".$data['email']."'",'user_type' => '2'),
                    'fields'=>array('id','password','email','profile_image','device_type','device_token','is_verify','status','user_type'),
                    'compare_type' => '='
                );
            $chkUser = $this->Common_function_model->getmultiple_tables($params);

            
            if (!empty($chkUser)) {
                
                if ($chkUser[0]['is_verify'] == 1 && $chkUser[0]['status'] == 1) {

                    if ($chkUser[0]['password'] == $passwd) {

                        $udata['device_type']   = !empty($data['device_type'])?$data['device_type']:'';
                        $udata['device_token']  = !empty($data['device_token'])?$data['device_token']:'';
                        $udata['uuid']          = !empty($data['uuid'])?$data['uuid']:'';
                        $where = array('id' => $chkUser[0]['id']);
                        $this->Common_function_model->update('user_master', $udata, $where);
                        
                        //$chkUser[0]['profile_image'] = $this->config->item("user_small_url") . $chkUser[0]['profile_image'];
                        $chkUser = $this->Common_function_model->getmultiple_tables($params);
                        if(!empty($chkUser[0]['profile_image']) && file_exists($this->config->item('user_big_path') . $chkUser[0]['profile_image']))
                        {
                            $chkUser[0]['profile_image'] = $this->config->item('user_big_url').$chkUser[0]['profile_image'];
                        }
                        else
                        {
                            $chkUser[0]['profile_image'] = '';
                        }

                        $msg['MESSAGE']         = "logged In Successfully";
                        $msg['FLAG']            = true;
                        unset($chkUser[0]['password']);
                        $msg['LOGIN_DETAILS']   = !empty($chkUser)?$chkUser:array();
                    
                    } else {
                        $msg['MESSAGE'] = $this->lang->line('invalid_pass');
                        $msg['FLAG']    = false;
                    }
                }
                else {
                    if($chkUser[0]['is_verify'] == 0)
                    {
                        $msg['FLAG']    = false;
                        $msg['MESSAGE'] = $this->lang->line('verify_email_address');
                    }
                    elseif($chkUser[0]['status'] == 0)
                    {
                        $msg['FLAG']    = false;
                        $msg['MESSAGE'] = $this->lang->line('account_not_activated');
                    }
                    else
                    {
                        $msg['FLAG']    = false;
                        $msg['MESSAGE'] = $this->lang->line('user_not_approve');
                    }
                }
            }
            else {
                $msg['FLAG']    = false;
                $msg['MESSAGE'] = $this->lang->line('user_not_registered');
            }
        }
        $this->response($msg, 200);
    }

    /*
        @Description        : Forget password send mail for new password
        @Author             : Sanjay Rathod
        @input              : email
        @Output             : forget password
        @Date               : 23-06-2018
        @Webservices link   :
    */
    function forget_password_post()
    {
        $data = $this->post();
        $this->form_validation->set_rules('email', 'Email Id', 'trim|required|valid_email');
        
        if ($this->form_validation->run() == FALSE) {
            $msg['MESSAGE']     = strip_tags(validation_errors());
            $msg['FLAG']        = FALSE;
        } else {
           
            $params = array(
                    'table'=>'user_master',
                    'where'=>array('email' => "'".$data['email']."'", 'user_type' => '2'),
                    'fields'=>array('id', 'email', 'password', 'first_name','status','is_verify','token'),
                    'compare_type' => '='
                );
            $chk_email = $this->Common_function_model->getmultiple_tables($params);
            
            if (count($chk_email) > 0 && $chk_email[0]['status'] == 1 && $chk_email[0]['is_verify'] == 1) 
            { 
                $token = (!empty($chk_email[0]['token']) ? $chk_email[0]['token'] : '');
                if (empty($token)) {
                    //create token
                    for ($i = 1; $i >= 0; $i++) {
                        $token = uniqid();
                        $token_result = $this->Common_function_model->getmultiple_tables(array('table'=>'user_master','wherestring' => "token = '".$token."'",'fields' => 'id'));
                        if (empty($token_result)) {
                            break;
                        }
                    }
                }
                
                $encBlastId = $token;
                $loginLink = $this->config->item('base_url') . 'reset_password_mobile/reset_password_template/' . $encBlastId;

                $pass_variable_activation = array('name' => $chk_email[0]['first_name'], 'loginLink' => $loginLink);
                $data['actdata'] = $pass_variable_activation;
                $activation_tmpl = $this->load->view('email_template/user_forget_password_link', $data, true);

                // SEND EMAIL
                $to     = !empty($chk_email[0]['email'])?$chk_email[0]['email']:'';
                $from   = $this->config->item('admin_email');
                $sub    = $this->config->item('sitename')." - Forgot Password";
                $this->Common_function_model->send_email($to, $sub, $activation_tmpl, $from);

                $this->Common_function_model->update("user_master", array('is_forgot_password' => '1','token' => $token), array('id' => $chk_email[0]['id']), '', '=');                

                $msg['MESSAGE']     = $this->lang->line('email_sent_successfully');
                $msg['FLAG']        = TRUE;
            }
            else 
            {
                $msg['FLAG']        = FALSE;
                if (isset($chk_email[0]['status']) && $chk_email[0]['status'] == '0')
                {
                    $msg['MESSAGE'] = $this->lang->line('account_not_activated');
                } 
                else if (isset($chk_email[0]['is_verify']) && $chk_email[0]['is_verify'] == '0')
                {
                    $msg['MESSAGE'] = $this->lang->line('unable_to_send_mail');
                } 
                else
                {
                    $msg['MESSAGE'] = $this->lang->line('mail_not_registered');
                }
            }
        }
        $this->response($msg, 200);
    }

    /*
        @Description        : Changes password send mail for new password
        @Author             : Sanjay Rathod
        @input              : email
        @Output             : forget password
        @Date               : 23-06-2018
        @Webservices link   :
    */
    
    function change_password_post() 
    {
        $data = $this->post();
        $this->form_validation->set_rules('id', 'Id', 'trim|required');
        $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|min_length[6]|callback_alpha_numeric_space');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[6]|callback_alpha_numeric_space');
        $this->form_validation->set_message('alpha_numeric_space', 'spaces not allow');
        if ($this->form_validation->run() == FALSE) {
            $msg['MESSAGE']     = strip_tags(validation_errors());
            $msg['FLAG']        = FALSE;
            
        } else {

            $params = array(
                    'table'=>'user_master',
                    'where'=>array('id' => $data['id']),
                    'fields'=>array('id','email', 'password', 'status','is_verify'),
                    'compare_type' => '='
                );
            $chk_data = $this->Common_function_model->getmultiple_tables($params);
            
            if (!empty($chk_data) && count($chk_data) > 0)
            {
                $old_password = $this->Common_function_model->encrypt_script($data['old_password']);
                if ($chk_data[0]['status'] == '0')
                {
                    $msg['MESSAGE']     = $this->lang->line('account_not_activated');
                    $msg['FLAG']        = FALSE;
                }
                elseif ($chk_data[0]['is_verify'] == '0')
                {
                    $msg['MESSAGE']     = $this->lang->line('unable_to_change_password');
                    $msg['FLAG']        = FALSE;
                }
                else if($old_password != $chk_data[0]['password'])
                {
                    $msg['MESSAGE']     = $this->lang->line('invalid_old_password');
                    $msg['FLAG']        = FALSE;
                }
                else 
                {
                    $new_passwd = $this->Common_function_model->encrypt_script($data['new_password']);

                    $this->Common_function_model->update("user_master", array('password' => $new_passwd), array('id' => $data['id']));

                    $msg['MESSAGE']     = $this->lang->line('password_change_succ');
                    $msg['FLAG']        = TRUE;
                }
            } 
            else 
            {
                $msg['MESSAGE']     = $this->lang->line('mail_not_registered');
                $msg['FLAG']        = FALSE;
            }
        }
        $this->response($msg, 200);
    }

    /*
        @Description        :User verify
        @Author             :Parag Joshi
        @input              :user_id, uuid
        @Output             :user Active/Inactive
        @Date               :27-06-2018
        @Webservices link   :
     */
    
    function user_verify_post()
    {
        $data = $this->post();
        $this->form_validation->set_rules('user_id', 'User Id', 'trim|required');
        $this->form_validation->set_rules('uuid', 'UUID', 'trim|required');
        
        if ($this->form_validation->run() == false) {
            $msg['MESSAGE'] = strip_tags(validation_errors());
            $msg['FLAG']    = FALSE;
        } else {

            $params = array(
                    'table'=>'user_master',
                    'where'=>array('id' => $data['user_id'],'user_type' => '2'),
                    'fields'=>array('id','email','device_type','device_token','is_verify','uuid','status','user_type'),
                    'compare_type' => '='
                );
            $chkUser = $this->Common_function_model->getmultiple_tables($params);
            
            if (!empty($chkUser)) {
                
                if ($chkUser[0]['is_verify'] == 1 && $chkUser[0]['status'] == 1) 
                {
                    if ($chkUser[0]['uuid'] == $data['uuid']) 
                    {
                        $msg['FLAG']    = true;
                        $msg['IS_ACTIVE'] = true;
                        $msg['MESSAGE'] = $this->lang->line('common_label_verified');

                    } else {
                        $msg['FLAG']    = false;
                        $msg['IS_ACTIVE'] = false;
                        $msg['MESSAGE'] = $this->lang->line('uuid_mismatch');
                    }
                }
                else 
                {
                    if($chkUser[0]['is_verify'] == 0)
                    {
                        $msg['FLAG']    = false;
                        $msg['IS_ACTIVE'] = false;
                        $msg['MESSAGE'] = $this->lang->line('verify_email_address');
                    }
                    elseif($chkUser[0]['status'] == 0)
                    {
                        $msg['FLAG']    = false;
                        $msg['IS_ACTIVE'] = false;
                        $msg['MESSAGE'] = $this->lang->line('account_not_activated');
                    }
                    else
                    {
                        $msg['FLAG']    = false;
                        $msg['IS_ACTIVE'] = false;
                        $msg['MESSAGE'] = $this->lang->line('user_not_approve');
                    }
                }
            }
            else 
            {
                $msg['FLAG']    = false;
                $msg['IS_ACTIVE'] = false;
                $msg['MESSAGE'] = $this->lang->line('user_not_registered');
            }
        }
        $this->response($msg, 200);
    }
}