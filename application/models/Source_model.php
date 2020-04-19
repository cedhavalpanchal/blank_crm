<?php

    /*
    @Description: Source model
    @Author: Mit Makwana
    @Input: 
    @Output: 
    @Date: 27-06-2018
    */

class Source_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table_name = 'sources';
    }

    /*
        @Description: Function for get source data
        @Author: Mit Makwana
        @Input: 
        @Output: 
        @Date: 27-06-2018
    */

    function get_source($id ='', $fields = '*') {

        $this->db->select($fields);
        $this->db->from($this->table_name);
        $this->db->where('status', '1');
        if(!empty($id))
        {
            $this->db->where('id', $id);
            
        }
        $this->db->order_by('name', 'ASC');
        $result = $this->db->get();
        return $result->result_array();
    }

    
}