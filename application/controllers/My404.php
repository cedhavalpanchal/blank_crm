<?php 
class My404 extends CI_Controller 
{
 public function __construct() 
 {
    parent::__construct(); 
 } 

 public function index() 
 { 
    $this->output->set_status_header('404'); 

    if(!empty($this->uri->segment(1)) && $this->uri->segment(1) == 'ws')
    {
        header('Content-Type: application/json');
	    $msg['MESSAGE']     = $this->lang->line('page_not_found');
	    $msg['code']        = "404";
	    echo json_encode($msg);
    }
    else
    {
    	$this->load->view('errors/html/error_404');//loading in custom error view
    }
 } 
} 