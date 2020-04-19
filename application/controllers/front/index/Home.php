<?php
/*
  @Description: Home Controller
  @Author: 
  @Date: 10-08-2016
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->model('common_function_model');
        $this->message_session = $this->session->userdata('message_session');
    }

    /*
      @Description: Function to display main page
      @Author: 
      @Date: 10-08-2016
     */
    public function index() {
      //echo 'Here Home page index';die;
      $this->load->view('front/include/header');
      $this->load->view('front/home/index');
      $this->load->view('front/include/footer');
    }
}