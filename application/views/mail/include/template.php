<?php 
/*
    @Description: header / footer common tamplate
    @Author: Sanjay Rathod
    @Date: 16-10-2017
   */

$this->load->view('mail/include/header');  

//$this->load->view('include/left');  
$this->load->view($main_content);

$this->load->view('mail/include/footer');  
