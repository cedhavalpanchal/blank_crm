<?php

function log_queries() {
    $CI =& get_instance();
    $times = $CI->db->query_times;
    foreach ($CI->db->queries as $key=>$query) {
        log_message('debug', "Query: ".$query." | ".$times[$key]);
    	$CI->output->_display();
    }
}
