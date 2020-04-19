<?php
/*
    @Description: Deep-linking Controller
    @Author: Mit Makwana
    @Date: 27-11-2017
*/
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invitation extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->model('common_function_model');
    }

    public function index() 
    {
        $this->load->view('front/include/header');
      	$this->load->view('front/home/deep_link');
        $this->load->view('front/include/footer');
    }
}