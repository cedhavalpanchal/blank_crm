<?php

/*
    @Description: common function Model
    @Author: Mit Makwana	
    @Input: 
    @Output: 
    @Date: 11-12-15*/

class Common_function_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
	/*
    @Description: generate string 
    @Author: Mit Makwana
    @Input: length of string
    @Output: generate string in uppercase
    @Date: 11-12-15*/

    public function randr($j = 8)
    {
        $string = "";
        for($i=0;$i < $j;$i++)
        {
            srand((double)microtime()*1234567);
            $x = mt_rand(0,2);
            switch($x)
            {
                case 0:$string.= chr(mt_rand(97,122));break;
                case 1:$string.= chr(mt_rand(65,90));break;
                case 2:$string.= chr(mt_rand(48,57));break;
            }
        }
        return strtoupper($string);
    }

   
	/*
    @Description: common function Model for encrypt Script
    @Author: Mit Makwana
    @Input: 
    @Output: 
    @Date: 11-12-15 */
	
	/*function encrypt_script($string)
	{
		$key = $this->config->item('encryption_key');
		
		$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
		
		return $encrypted;
	}*/
	
	/*
	@Description: common function Model for decrypt Script
	@Author: Mit Makwana
	@Input: 
	@Output: 
	@Date: 11-12-15
	*/
	
	/*function decrypt_script($string)
	{
		$key = $this->config->item('encryption_key');
		
		$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
		
		return $decrypted;
	}*/

    /**
     * @Description : common function Model for encrypt Script
     * @author : Megha Shah <megha.shah@tops-int.com>
     * @date : 17-Apr-2017
     * @Input : $plain_text - String
     * @OutPut : String
     */
    function encrypt_script($string) {
        $CI = & get_instance();
        $key = $CI->config->item('encryption_key');
        $encrypt_method = "AES-256-CBC";
        $iv = substr(hash('sha256', $key), 0, 16);
        return base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    }

    /**
     * @Description : common function Model for decrypt Script
     * @author : Megha Shah <megha.shah@tops-int.com>
     * @date : 17-Apr-2017
     * @Input : $encrypted_string - String
     * @OutPut : String
     */
    function decrypt_script($string) {
        $CI = & get_instance();
        $key = $CI->config->item('encryption_key');
        $encrypt_method = "AES-256-CBC";
        $iv = substr(hash('sha256', $key), 0, 16);
        return openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
	
	/*
	@Description: function to send email
	@Author: Mit Makwana
	@Input: 
	@Output: 
	@Date: 24-11-2016
	*/
	function send_email($to = '', $subject = '', $message = '', $from = '', $cc = '',$bcc ='',$data='')
    {
       
        $this->load->library('email');
        $config = Array(
            'protocol' => $this->config->item('protocol'),
            'smtp_host' => $this->config->item('smtp_host'),
            'smtp_port' => $this->config->item('smtp_port'),
            'smtp_user' => $this->config->item('smtp_user'),
            //'smtp_pass' => $this->config->item('smtp_pass'),
            'smtp_pass' => $this->Common_function_model->decrypt_script($this->config->item('smtp_pass')),
            'smtp_timeout' => $this->config->item('smtp_timeout'),
            'mailtype' => 'html',
        );
       // pr($config); exit;
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->set_priority(1);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->from($from, $this->config->item('sitename'));
        $this->email->to($to);
        $this->email->cc($cc);
        $this->email->bcc($bcc); 
            //        if(!empty($data['attachment_email']))
            //		{
            //			foreach($data['attachment_email'] as $row_attachment)
            //                            $this->email->attach("uploads/attachment_file/".$row_attachment['attachment']);
            //			//$this->email->attach("uploads/attachment_temp/".$data['attachment']);
            //		}
        if(!empty($data['attachment']))
        {
            $this->email->attach($data['file_path'].$data['attachment']);
        } 
        $this->email->send();
        //echo $this->email->print_debugger(); die;
        $this->email->clear(TRUE);
    }

	
        
     	/*
        @Description: Function for Date Formate Changes
        @Author: Mit Makwana
        @Input: Date (E.g MM/DD/YYYY)
        @Output: Date  (E.g YYYY/MM/DD)
        @Date: 24-11-2016
    */   
    function date_formate($date_con)
    {
        //return date('Y-m-d', strtotime(str_replace('-', '/', $date_con)));
        return date('Y-m-d', strtotime(str_replace('/', '-', $date_con)));
    }

    function datetime_formate($date_con)
    {
        return date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $date_con)));
    }
     
    /*
        @Description: Function for Insert Data
        @Author     : Mit Makwana
        @Input      : Insert data
        @Output     : 
        @Date       : 24-11-2016
    */   
    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function insert_batch($table, $data)
    {
        $this->db->insert_batch($table, $data);
        
    }

    /*
        @Description: Function for Update Data
        @Author     : Mit Makwana
        @Input      : Update id
        @Output     : 
        @Date       : 24-11-2016
    */   
    public function update($table, $data, $where='', $wherestring='')
    {
        if(!empty($where))
            $this->db->where($where);
        if(!empty($wherestring))
            $this->db->where($wherestring, NULL, FALSE);
        $this->db->update($table, $data);
    }

    /*********************************************************************
        @Description    : Function for update mls details in table
        @Author         : Mit makwana
        @Input          : mls details for Update into DB
        @Output         : 
        @Date           : 01-08-2015
    **********************************************************************/
    public function update_batch($data,$table_name,$update_id)
    {
       $query = $this->db->update_batch($table_name,$data,$update_id);      
    }

     /*
        @Description: Function for Delete Data
        @Author     : Mit Makwana
        @Input      : Delete id
        @Output     : 
        @Date       : 24-11-2016
    */   
    public function delete($table, $where)
    {
        
        $this->db->where($where);
        $this->db->delete($table);
    }

    /*
        @Description: Function for get Records Lists Multiple tables
        @Author: Mit Makwana
        @Input: Fieldl list(id,name..), match value(id=id,..), condition(and,or),compare type(=,like),count,limit per page, starting row number
        @Output: Records list
        @Date: 24-11-2016
    */
    function getmultiple_tables($query_data)
    {
        extract($query_data);
        if (!empty($fields))
        {
            foreach ($fields as $coll => $value)
            {
                $this->db->select($value, FALSE);
            }
        }

        $this->db->from($table, NULL, FALSE);
        
        if (!empty($join_tables))
        {
            foreach ($join_tables as $coll => $value) {
                $colldata = explode('jointype', $coll);
                 
                $coll = trim($colldata[0]);
                if (!empty($colldata[1])) {
                    $join_type1 = trim($colldata[1]);
                    if ($join_type1 == 'direct')
                        $join_type1 = '';
                }
                
                if (isset($join_type1))
                    $this->db->join($coll, $value, $join_type1);
                else
                    $this->db->join($coll, $value, $join_type);

                unset($join_type1);
            }
        }

        if (!empty($condition) && $condition != null)
        {
            $this->db->where($condition, FALSE);
        }
            
        if (!empty($wherestring) && $wherestring != '')
        {
            $this->db->where($wherestring, NULL, FALSE);
        }
            
        if (!empty($where_in))
        {
            foreach ($where_in as $key => $value)
            {
                $this->db->where_in($key, $value);
            }
        }

        if (!empty($or_where))
        {
            foreach ($or_where as $key => $value)
            {
                $this->db->or_where($key, $value);
            }
        }

        if (!empty($group_by) && $group_by != null)
        {
            $this->db->group_by($group_by);
        }
            
        if (!empty($having) && $having != null)
        {
            $this->db->having($having, NULL, FALSE);
        }
            
        if (!empty($having_str) && $having_str != null)
        {
            $this->db->having($having_str, NULL, FALSE);
        }
            
        if(!empty($orderby))
        {
            if ($orderby != null && $sort != null && !empty($sort))
            {
                $this->db->order_by($orderby, $sort);
            }                
            else if ($orderby != null)
            {
                $this->db->order_by($orderby);
            }
        }
        
        if (!empty($where) && !empty($match_values) && $match_values != null && !empty($compare_type) && $compare_type != null)
        {
            $wherestr = '';

            foreach ($where as $key => $val)
            {
                $wherestr .= $key . " = '" . $val . "' AND ";
            }

            $wherestr .= '(';

            foreach ($match_values as $key => $val)
            {
                $wherestr .= $key . " " . $compare_type . " '%" . $val . "%' OR ";
            }

            $wherestr = rtrim($wherestr, 'OR ');

            $wherestr .= ')';

            $this->db->where($wherestr, NULL, FALSE);
        }
        else
        {
            if (!empty($where))
                $this->db->where($where, NULL, FALSE);

            if (!empty($match_values) && $match_values != null && !empty($compare_type) && $compare_type != null)
                $this->db->or_like($match_values, $compare_type);
        }

        if (!empty($offset) && $offset != null && !empty($num) && $num != null)
            $this->db->limit($num, $offset);
        elseif (!empty($num) && $num != null)
            $this->db->limit($num);

        $query_FC = $this->db->get();
        if (!empty($totalrow))
            return $query_FC->num_rows();
        else
            return $query_FC->result_array();
    }

    function check_device_uuid($id,$uuid)
    {
        $this->db->select('uuid');
        $this->db->from('user_master');
        $where = array('id' => $id,);
        $this->db->where($where);
        $query = $this->db->get()->result_array();
        if(!empty($query))
        {
            if($query[0]['uuid'] == $uuid)
            {
                return 'true';
            }
            else
            {
                return 'false';
            }
        }
        else
        {
            return 'false';
        }
    }

    function product_available_qty($user_id,$product_id)
    {
        $query = $this->db->query("SELECT pm.id,pm.quantity,ct.id as cart_id,ct.quantity as cart_qty,(pm.quantity - ct.quantity) AS reamining_quantity
            FROM product_master AS pm
            LEFT JOIN cart_temp AS ct ON pm.id = ct.product_id AND ct.user_id = $user_id
            WHERE pm.id = $product_id");
        if($query->num_rows() > 0){
            $data = $query->result_array();
            return $data;
        }
    }

    /*
        @Description: Function for payment
        @Author: Mit Makwana
        @Input: Fieldl list(id,name..), match value(id=id,..), condition(and,or),compare type(=,like),count,limit per page, starting row number
        @Output: Records list
        @Date: 24-11-2016
    */

    function payment()
    {

    }
}