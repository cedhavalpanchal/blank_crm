<?php

/*
  @Description: User management controller
  @Author: Mit Makwana
  @Input:
  @Output:
  @Date: 26-07-2016

 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Verify_management_control extends CI_Controller {

    function __construct() {
       parent::__construct();
        $this->message_session = $this->session->flashdata('message_session');
        $this->load->model('Common_function_model');
        $this->viewName = $this->router->uri->segments[2];
    }

    /*
      @Description: Function for load mail page
      @Author: Mit Makwana
      @Input: - 
      @Output: - 
      @Date: 16-08-2016
     */
    
      function verify_user()
      {   
        $user_id = base64_decode($_REQUEST['id']);
        $params = array(
                    'table'=>'user_master',
                    'where'=>array('id' => $user_id),
                    'fields'=>array('id','first_name','last_name','username','is_verify','email','user_type'),
                    'compare_type' => '='
                );
        $check_user = $this->Common_function_model->getmultiple_tables($params);

        if(!empty($check_user))
        {
            $data['user_name']  = !empty($check_user[0]['username'])?$check_user[0]['username']:'';
            $data['first_name'] = !empty($check_user[0]['first_name'])?$check_user[0]['first_name']:'';
            $data['last_name']  = !empty($check_user[0]['last_name'])?$check_user[0]['last_name']:'';

            if($check_user[0]['is_verify'] == '1' && $check_user[0]['user_type'] == 1)
            {
               
                $data['message']    = "Email address is already verified!";
                $data['flag']       = 'fail';
                $this->load->view("verify_user_templete/success_verify1",$data);
                
            } 

            elseif(($check_user[0]['is_verify'] == '2') && ($check_user[0]['user_type'] == 0 ))
            {
                $data['message']    = "Email address is already verified!";
                $data['flag']       = 'fail';
                $this->load->view("verify_user_templete/success_verify1",$data);
                
            }
            elseif(($check_user[0]['is_verify'] == '1') && ($check_user[0]['user_type'] == 0 ))
            {
                $data['message']    = "Email address is already verified and approved by admin!";
                $data['flag']       = 'fail';
                $this->load->view("verify_user_templete/success_verify1",$data);
                
            } 
            elseif(($check_user[0]['is_verify'] == '0') && ($check_user[0]['user_type'] == 0))
            {
               
                $udata['is_verify'] = 2;
            }
            else
            {
                $udata['is_verify'] = 1;
                
            }

            if(!empty($udata)){
              $where = array('id' => $check_user[0]['id']);
              $this->Common_function_model->update('user_master', $udata, $where);

              $data['message']    = "You have successfully activated your account! !";
              $data['flag']       = 'success';
              $this->load->view("verify_user_templete/success_verify1",$data);
            }  
        }
        else
        {
            $data['success'] = "User does not exists";
            $data['flag']    = 'fail';
            $this->load->view("verify_user_templete/success_verify1",$data);
        }
    } 
}
