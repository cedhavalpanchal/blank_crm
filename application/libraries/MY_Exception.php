<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
	Extended the core Router class to allow for sub-sub-folders in the controllers directory.
*/
class MY_Exceptions extends CI_Exceptions {

    public function show_404()
    {
        $CI =& get_instance();
        $CI->load->view('views/errors/html/error_404');
        echo $CI->output->get_output();
        exit;
    }
}

/* End of file MY_Router.php */
/* Location: ./application/core/MY_Router.php */