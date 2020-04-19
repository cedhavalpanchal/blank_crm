<?php

/*
@Description: common function Model
@Author: Dhaval Panchal
@Input:
@Output:
@Date: 11-12-15*/

class Common_function_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /*
    @Description: generate string
    @Author: Dhaval Panchal
    @Input: length of string
    @Output: generate string in uppercase
    @Date: 11-12-15*/

    public function randr($j = 8)
    {
        $string = "";

        for ($i = 0; $i < $j; $i++) {
            srand((double) microtime() * 1234567);
            $x = mt_rand(0, 2);

            switch ($x) {
                case 0:
                    $string .= chr(mt_rand(97, 122));
                    break;
                case 1:
                    $string .= chr(mt_rand(65, 90));
                    break;
                case 2:
                    $string .= chr(mt_rand(48, 57));
                    break;
            }
        }

        return strtoupper($string);
    }
   

    /**
     * @Description : common function Model for encrypt Script
     * @date : 17-Apr-2017
     * @Input : $plain_text - String
     * @OutPut : String
     * @author : Megha Shah <megha.shah@tops-int.com>
     */
    public function encrypt_script($string)
    {
        $CI             = &get_instance();
        $key            = $CI->config->item('encryption_key');
        $encrypt_method = "AES-256-CBC";
        $iv             = substr(hash('sha256', $key), 0, 16);
        return base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    }

    /**
     * @Description : common function Model for decrypt Script
     * @date : 17-Apr-2017
     * @Input : $encrypted_string - String
     * @OutPut : String
     * @author : Megha Shah <megha.shah@tops-int.com>
     */
    public function decrypt_script($string)
    {
        $CI             = &get_instance();
        $key            = $CI->config->item('encryption_key');
        $encrypt_method = "AES-256-CBC";
        $iv             = substr(hash('sha256', $key), 0, 16);
        return openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    /*
    @Description: function to send email
    @Author: Dhaval Panchal
    @Input:
    @Output:
    @Date: 24-11-2016
     */
    public function send_email($to = '', $subject = '', $message = '', $from = '', $cc = '', $bcc = '', $data = '')
    {

        $this->load->library('email');
        $config = array(
            'protocol'     => $this->config->item('protocol'),
            'smtp_host'    => $this->config->item('smtp_host'),
            'smtp_port'    => $this->config->item('smtp_port'),
            'smtp_user'    => $this->config->item('smtp_user'),
            'smtp_pass'    => $this->config->item('smtp_pass'),
            'smtp_timeout' => $this->config->item('smtp_timeout'),
            'mailtype'     => 'html',
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
        //        {
        //            foreach($data['attachment_email'] as $row_attachment)
        //                            $this->email->attach("uploads/attachment_file/".$row_attachment['attachment']);
        //            //$this->email->attach("uploads/attachment_temp/".$data['attachment']);
        //        }

        if (!empty($data['attachment'])) {
            $this->email->attach($data['file_path'] . $data['attachment']);
        }

        $this->email->send();
        //echo $this->email->print_debugger(); die;
        $this->email->clear(true);
    }

    /*
    @Description: Function for Date Formate Changes
    @Author: Dhaval Panchal
    @Input: Date (E.g MM/DD/YYYY)
    @Output: Date  (E.g YYYY/MM/DD)
    @Date: 24-11-2016
     */
    public function date_formate($date_con)
    {
        //return date('Y-m-d', strtotime(str_replace('-', '/', $date_con)));
        return date('Y-m-d', strtotime(str_replace('/', '-', $date_con)));
    }

    public function datetime_formate($date_con)
    {
        return date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $date_con)));
    }

    /*
    @Description: Function for Insert Data
    @Author     : Dhaval Panchal
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
    @Author     : Dhaval Panchal
    @Input      : Update id
    @Output     :
    @Date       : 24-11-2016
     */
    public function update($table, $data, $where = '', $wherestring = '')
    {

        if (!empty($where)) {
            $this->db->where($where);
        }

        if (!empty($wherestring)) {
            $this->db->where($wherestring, null, false);
        }

        $this->db->update($table, $data);
    }

    /*********************************************************************
    @Description    : Function for update mls details in table
    @Author         : Dhaval Panchal
    @Input          : mls details for Update into DB
    @Output         :
    @Date           : 01-08-2015
     **********************************************************************/
    public function update_batch($data, $table_name, $update_id)
    {
        $query = $this->db->update_batch($table_name, $data, $update_id);
    }

    /*
    @Description: Function for Delete Data
    @Author     : Dhaval Panchal
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
    @Author: Dhaval Panchal
    @Input: Fieldl list(id,name..), match value(id=id,..), condition(and,or),compare type(=,like),count,limit per page, starting row number
    @Output: Records list
    @Date: 24-11-2016
     */
    public function getmultiple_tables($query_data)
    {
        extract($query_data);

        if (!empty($fields)) {
            foreach ($fields as $coll => $value) {
                $this->db->select($value, false);
            }
        }

        $this->db->from($table, null, false);

        if (!empty($join_tables)) {
            foreach ($join_tables as $coll => $value) {
                $colldata = explode('jointype', $coll);

                $coll = trim($colldata[0]);

                if (!empty($colldata[1])) {
                    $join_type1 = trim($colldata[1]);

                    if ($join_type1 == 'direct') {
                        $join_type1 = '';
                    }
                }

                if (isset($join_type1)) {
                    $this->db->join($coll, $value, $join_type1);
                } else {
                    $this->db->join($coll, $value, $join_type);
                }

                unset($join_type1);
            }
        }

        if (!empty($condition) && $condition != null) {
            $this->db->where($condition, false);
        }

        if (!empty($wherestring) && $wherestring != '') {
            $this->db->where($wherestring, null, false);
        }

        if (!empty($where_in)) {
            foreach ($where_in as $key => $value) {
                $this->db->where_in($key, $value);
            }
        }

        if (!empty($or_where)) {
            foreach ($or_where as $key => $value) {
                $this->db->or_where($key, $value);
            }
        }

        if (!empty($group_by) && $group_by != null) {
            $this->db->group_by($group_by);
        }

        if (!empty($having) && $having != null) {
            $this->db->having($having, null, false);
        }

        if (!empty($having_str) && $having_str != null) {
            $this->db->having($having_str, null, false);
        }

        if (!empty($orderby)) {
            if ($orderby != null && $sort != null && !empty($sort)) {
                $this->db->order_by($orderby, $sort);
            } elseif ($orderby != null) {
                $this->db->order_by($orderby);
            }
        }

        if (!empty($where) && !empty($match_values) && $match_values != null && !empty($compare_type) && $compare_type != null) {
            $wherestr = '';

            foreach ($where as $key => $val) {
                $wherestr .= $key . " = '" . $val . "' AND ";
            }

            $wherestr .= '(';

            foreach ($match_values as $key => $val) {
                $wherestr .= $key . " " . $compare_type . " '%" . $val . "%' OR ";
            }

            $wherestr = rtrim($wherestr, 'OR ');

            $wherestr .= ')';

            $this->db->where($wherestr, null, false);
        } else {

            if (!empty($where)) {
                $this->db->where($where, null, false);
            }

            if (!empty($match_values) && $match_values != null && !empty($compare_type) && $compare_type != null) {
                $this->db->or_like($match_values, $compare_type);
            }
        }

        if (!empty($offset) && $offset != null && !empty($num) && $num != null) {
            $this->db->limit($num, $offset);
        } elseif (!empty($num) && $num != null);
        $this->db->limit($num);

        $query_FC = $this->db->get();

        if (!empty($totalrow)) {
            return $query_FC->num_rows();
        } else {
            return $query_FC->result_array();
        }
    }
}
