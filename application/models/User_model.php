<?php

class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'user_master';
    }

    /*
      @Description : Function to change password
      @Author      : Dhara
      @Input       : old password,new password
      @Output      :
      @Date        : 02-12-17
     */

    function change_password($id, $password, $new_password) {

        $field = array('id', 'email', 'password');
        $match = array('id' => $id);
        $sq_data_all = array("table" => 'user_master', "fields" => $field, "condition" => $match);
        $get_data = $this->common_function_model->getmultiple_tables_new($sq_data_all);
        if (password_verify($password, $get_data[0]['password'])) {
            $result = $get_data;
        } else {
            $result = array();
        }

        if (!empty($result) && count($result) > 0) {
            $cdata['password'] = password_hash($new_password, PASSWORD_BCRYPT);
            $match = array('id' => $id);
            $update = $this->common_function_model->update('user_master', $cdata, $match);

            $response['status'] = SUCCESS;
            $response['msg'] = $this->lang->line('password_change_success');
            $response['status_code'] = REST_Controller::HTTP_OK;
        } else {
            $response['status'] = SUCCESS;
            $response['msg'] = $this->lang->line('invalid_old_password');
            $response['errors'] = $this->lang->line('invalid_old_password');
            $response['status_code'] = REST_Controller::HTTP_OK;
        }

        return $response;
    }

    public function forgot_password($email1,$from=0){

        $result = $this->dbqueries->find('user_master',array('email'=>trim($email1),'status' => '1'),'id,email,CONCAT_WS(" ",first_name,last_name) as full_name');
        
        if (!empty($result)) 
        {
                $name = !empty($result->full_name) ? $result->full_name : '';
                $email = $result->email;
                $encBlastId = urlencode(base64_encode($result->id));

                if($from==1){
                    $loginLink = $this->config->item('base_url') . 'admin/reset_password/' . $encBlastId.'/1';
                    $pass_variable_activation = array('name' => $name, 'email' => $email1, 'loginLink' => $loginLink);
                    $data['actdata'] = $pass_variable_activation;
                    $data['main_content'] = "mail/include/reset_password";
                    $activation_tmpl = $this->load->view('mail/include/template', $data, true);
                    $email = $this->input->post('email');
                }else{
                    $loginLink = $this->config->item('base_url') . 'admin/reset_password/' . $encBlastId;
                    $pass_variable_activation = array('name' => $name, 'email' => $email1, 'password' => $password, 'loginLink' => $loginLink);
                    $data['actdata'] = $pass_variable_activation;
                    $activation_tmpl = $this->load->view('admin/reset_password/reset_password_link/list', $data, true);
                    $email1 = $this->input->post('forgot_email');
                }
                
                $sub = $this->config->item('sitename') . " : Admin Forgot Password";
                $from = $this->config->item('admin_email');
                $sendmail = $this->common_function_model->send_email($email1, $sub, $activation_tmpl, $from);


                $this->common_function_model->update("user_master", array('is_forgot_password' => '1'), array('id' => $result->id), '', '=');


                $response['status']=SUCCESS;
                $response['msg']= $this->lang->line('success_mail_sent');
                //$response['status_code'] = REST_Controller::HTTP_OK;
        } 
        else 
        {
            $response['status']=FAILED;
            $response['msg'] = $this->lang->line('error_incorrect_email');
            //$response['status_code'] = REST_Controller::HTTP_INTERNAL_SERVER_ERROR;
        }
        return $response;
    }
    
    public function get_gard3_data($machine_id,$option){
        
        $production_days = $this->get_days();
        $production_months = $this->get_month();
        $production_weeks =  $this->get_week();
        
        $usage_days = $this->get_days();
        $usage_months =  $this->get_month();
        $usage_weeks = $this->get_week();
        
        switch ($option){
            case 0:
                $where = "machine_id = '".$machine_id."' AND day BETWEEN (CURDATE() - INTERVAL 30 DAY) AND CURDATE()";
                $this->db->select("DATE_FORMAT(day, '%d-%m-%Y') as day,total_production as total,DAY(day) as date,DATEDIFF(CURDATE(),day) as num");
                $this->db->distinct();
                $this->db->order_by('num','DESC');
                $this->db->from("machine_daywise_production");
                $production = $this->db->where($where);
                $production = $production->get()->result_array(); 

                 if(!empty($production)){
                    foreach ($production as $key=>$pr){
                        $num  = 30-$pr['num'];
                        $production_days[$num]=$pr;
                    }
                 }else{
                     $production_days = (object)array();
                 }
                $this->db->select("DATE_FORMAT(day, '%d-%m-%Y') as day,total_power as total,DAY(day) as date,DATEDIFF(CURDATE(),day) as num");
                $this->db->distinct();
                $this->db->order_by('num','DESC');
                $this->db->from("machine_daywise_used_power");
                $usage = $this->db->where($where);
                $usage = $usage->get()->result_array();
                
                if(!empty($usage)){
                    foreach ($usage as $key=>$pr){
                        $num  = 30-$pr['num'];
                        $usage_days[$num]=$pr;
                    }
                }else{
                    $usage_days = (object)array();
                }
                
                return array('production'=>$production_days,'usage'=>$usage_days);
            case 1:
                $where = "machine_id = '".$machine_id."' AND  `day` > DATE_SUB(NOW(), INTERVAL 24 WEEK)";

                $this->db->select("DATE_FORMAT(DATE_ADD(day, INTERVAL(2-DAYOFWEEK(day)) DAY), '%d-%m-%Y') as day,(24 - (ROUND(DATEDIFF(CURDATE(), day)/7, 0))) as week,sum(`total_production`) as total");
                $this->db->distinct();
                $this->db->order_by('day','ASC');
                $this->db->group_by('week');
                $this->db->from("machine_daywise_production");
                $production = $this->db->where($where);
                $production = $production->get()->result_array(); 
               
                if(!empty($production)){
                foreach ($production as $key=>$pr){
                     $production_weeks[$pr['week']]=$pr;
                }}else{
                     $production_weeks = (object)array();
                }
                  
                $this->db->select("DATE_FORMAT(DATE_ADD(day, INTERVAL(2-DAYOFWEEK(day)) DAY), '%d-%m-%Y') as day,(24 - (ROUND(DATEDIFF(CURDATE(), day)/7, 0))) as week,sum(`total_power`) as total");
                $this->db->distinct();
                $this->db->order_by('day','ASC');
                $this->db->group_by('week');
                $this->db->from("machine_daywise_used_power");
                $usage = $this->db->where($where);
                $usage = $usage->get()->result_array();
                
                if(!empty($usage)){
                foreach ($usage as $key=>$pr){
                    $usage_weeks[$pr['week']]=$pr;
                }}else{
                    $usage_weeks = (object)array();
                }
                return array('production'=>$production_weeks,'usage'=>$usage_weeks);
            case 2:
                $where = "machine_id = '".$machine_id."' AND  `day` > DATE_SUB(NOW(), INTERVAL 12 MONTH)";

                $this->db->select("DATE_FORMAT(day, '%d-%m-%Y') as day,MONTH(`day`) as month,sum(`total_production`) as total");
                $this->db->distinct();
                $this->db->order_by('day','ASC');
                $this->db->group_by(' MONTH(`day`)');
                $this->db->from("machine_daywise_production");
                $production = $this->db->where($where);
                $production = $production->get()->result_array();

                if(!empty($production)){
                foreach ($production as $key=>$pr){
                    $production_months[$pr['month']]=$pr;
                }}else{
                     $production_months = (object)array();
                 }
                
                
                $this->db->select("DATE_FORMAT(day, '%d-%m-%Y') as day,MONTH(`day`) as month,sum(`total_power`) as total");
                $this->db->distinct();
                $this->db->order_by('day','ASC');
                $this->db->group_by('MONTH(`day`)');
                $this->db->from("machine_daywise_used_power");
                $usage = $this->db->where($where);
                $usage = $usage->get()->result_array();
                if(!empty($usage)){
                foreach ($usage as $key=>$pr){
                    $usage_months[$pr['month']]=$pr;
                }}else{
                     $usage_months = (object)array();
                 }
                return array('production'=>$production_months,'usage'=>$usage_months);
        }

    }

    public function get_oee_data($machine_id)
    {
        $match = array('machine_master.id' => $machine_id);
        $sq_data_all = array
            (
                "table" => 'machine_master',
                "fields" => array('machine_master.machine_name,machine_master.model_no,machine_master.image,machine_status.machine_id,machine_status.operation_mode,machine_status.target_production,machine_status.actual_production,machine_status.remain_production,machine_status.rejected_production,machine_status.cycle_time,machine_status.kwh_cycle'),
                "condition" => $match,
                "join_tables" => array("machine_status" => "machine_master.id = machine_status.machine_id"),
                "join_type" => 'Left'
            );
        $get_data = $this->common_function_model->getmultiple_tables_new($sq_data_all);
        //pr($get_data);exit;

        $return_array = array();
        if (!empty($get_data)) {

            // get performance and quality
            $match = array('machine_id' => $machine_id, 'machine_mode' => 'AUTOSTART');
            $prod_data = array
                (
                    "table" => 'machine_actual_production map',
                    "fields" => array('map.id,map.machine_id,map.csv_date,map.machine_mode,map.machine_mold_name,map.shot_time,
                        (SELECT min(cycle_time) from machine_production_log where machine_actual_production_id = map.id ) as min_cycle_time,
                        (SELECT cycle_time FROM machine_production_log WHERE machine_actual_production_id = map.id ORDER BY id DESC limit 1) as current_cycle_time'),
                    "condition" => $match,
                    "join_tables" => array("machine_production_log mpl" => "map.id = mpl.machine_actual_production_id"),
                    "join_type" => 'Left',
                    "orderby" => 'map.id',
                    "sort" => 'DESC',
                    "num" => '1',
                );

            $actual_prod_data = $this->common_function_model->getmultiple_tables_new($prod_data);
            
            // get system start time
            $sys_start_data = array
                (
                    "table" => 'machine_actual_production',
                    "fields" => array('id,machine_id,csv_date,machine_mode,machine_mold_name,shot_time'),
                    "condition" => array('machine_id' => $machine_id, 'machine_mode' => 'System Start'),
                    "orderby" => 'id',
                    "sort" => 'DESC',
                    "num" => '1',
                );
            $system_start_data = $this->common_function_model->getmultiple_tables_new($sys_start_data);
            $system_start_time = !empty($system_start_data) ? $system_start_data[0]['shot_time'] : date('Y-m-d H:i:s'); // system start time

            // get auto start time with last record of production
            $wherestring = '';
            if(!empty($system_start_data))
            {
                $wherestring = 'map.id > '.$system_start_data[0]['id'];
            }
            $aut_start_data = array
                (
                    "table" => 'machine_actual_production map',
                    "fields" => array('map.id,map.machine_id,map.csv_date,map.machine_mode,map.machine_mold_name,map.shot_time,mpl.id as log_id,mpl.shot_time as log_shot_time'),
                    "condition" => array('map.machine_id' => $machine_id, 'map.machine_mode' => 'AUTOSTART'),
                    "orderby" => 'map.id',
                    "wherestring"=>$wherestring,
                    "join_tables" => array("machine_production_log mpl" => "map.id = mpl.machine_actual_production_id AND mpl.id = (SELECT MAX(id) FROM machine_production_log z WHERE z.machine_actual_production_id = map.id)"),
                    "join_type" => 'Left',
                    "sort" => 'DESC',
                    "num" => '1',
                );
            $auto_start_data = $this->common_function_model->getmultiple_tables_new($aut_start_data);
            $auto_start_time = !empty($auto_start_data[0]['shot_time'])?$auto_start_data[0]['shot_time']:date('Y-m-d H:i:s'); // auto start time

            // get auto stop time
            $auto_stop_time = date('Y-m-d H:i:s');
            if(!empty($auto_start_data))
            {
                $aut_stop_data = array
                    (
                        "table" => 'machine_actual_production',
                        "fields" => array('id,machine_id,csv_date,machine_mode,machine_mold_name,shot_time'),
                        "condition" => array('machine_id' => $machine_id, 'machine_mode' => 'AUTOSTOP'),
                        "orderby" => 'id',
                        "wherestring"=>'id > '.$auto_start_data[0]['id'],
                        "sort" => 'DESC',
                        "num" => '1',
                    );
                $auto_stop_data = $this->common_function_model->getmultiple_tables_new($aut_stop_data);

                if(!empty($auto_stop_data))
                {
                    $auto_stop_time = $auto_stop_data[0]['shot_time']; // auto stop time
                }
                else
                {
                    $auto_stop_time = $auto_start_data[0]['log_shot_time']; // current record log time if auto stop not found
                }
            }

            // get system stop time
            $system_stop_time = date('Y-m-d H:i:s');
            if(!empty($auto_start_data))
            {
                $sys_stop_data = array
                    (
                        "table" => 'machine_actual_production',
                        "fields" => array('id,machine_id,csv_date,machine_mode,machine_mold_name,shot_time'),
                        "condition" => array('machine_id' => $machine_id, 'machine_mode' => 'System Stop'),
                        "orderby" => 'id',
                        "wherestring"=>'id > '.$auto_start_data[0]['id'],
                        "sort" => 'DESC',
                        "num" => '1',
                    );
                $system_stop_data = $this->common_function_model->getmultiple_tables_new($sys_stop_data);

                //echo $this->db->last_query();
                //pr($system_stop_data);exit;
                if(!empty($system_stop_data))
                {
                    $system_stop_time = $system_stop_data[0]['shot_time']; // auto stop time
                }
                else
                {
                    $system_stop_time = $auto_start_data[0]['log_shot_time']; // current record log time if auto stop not found
                }
            }

            // calculate total loss time
            $start_diff = (strtotime($auto_start_time) - strtotime($system_start_time))/3600;
            $stop_diff = (strtotime($system_stop_time) - strtotime($auto_stop_time))/3600;
            
            $loss_time = $start_diff + $stop_diff;

            $total_loss_time = sprintf('%02d Hours %02d Min', (int) $loss_time, fmod($loss_time, 1) * 60);
            /////

            // Calculate active time
            $total_time = (strtotime($system_stop_time) - strtotime($system_start_time))/3600;
            $run_time = (strtotime($auto_stop_time) - strtotime($auto_start_time))/3600;

            $availability = 0;
            if(!empty($run_time) && !empty($total_time))
            {
                $availability = $run_time / $total_time;
            }

            $availability_time = sprintf('%02d Hours %02d Min', (int) $availability, fmod($availability, 1) * 60);

            /////
            
            $performance = '1';
            if(!empty($actual_prod_data) && $actual_prod_data[0]['current_cycle_time'] != '' && $actual_prod_data[0]['min_cycle_time'] != '')
            {
                $performance = $actual_prod_data[0]['current_cycle_time'] / $actual_prod_data[0]['min_cycle_time'];
            }
            
            $quality = '';
            if(isset($get_data[0]['actual_production']) && isset($get_data[0]['rejected_production']))
            {
                $quality = $get_data[0]['actual_production'] / ($get_data[0]['actual_production'] - $get_data[0]['rejected_production']);
            }
            
            $oee = $availability * $quality * $performance;

            $return_array['preformance'] = round($performance,'2');
            $return_array['quality'] = round($quality,'2');
            $return_array['oee'] = round($oee,'2');

            //$return_array['availability'] = $availability_time;
            $return_array['availability'] = round($availability,'2');
            $return_array['total_time'] = diff_in_hours($system_start_time,$system_stop_time);
            $return_array['run_time'] = diff_in_hours($auto_start_time,$auto_stop_time);
            $return_array['loss_time'] = $total_loss_time;

            $return_array['total_run_time'] = $run_time;
            $return_array['total_loss_time'] = $loss_time;

        }

        return $return_array;


    }

    public function get_uptime_data($machine_id,$option){
        
        $uptime_days = array(1=>(object)[],2=>(object)[],3=>(object)[],4=>(object)[],5=>(object)[],6=>(object)[],7=>(object)[],8=>(object)[],9=>(object)[],10=>(object)[],11=>(object)[],12=>(object)[],13=>(object)[],14=>(object)[],15=>(object)[],
            16=>(object)[],17=>(object)[],18=>(object)[],19=>(object)[],20=>(object)[],21=>(object)[],22=>(object)[],23=>(object)[],24=>(object)[],25=>(object)[],26=>(object)[],27=>(object)[],28=>(object)[],29=>(object)[],30=>(object)[]);
        $uptime_months = array(1=>(object)[],2=>(object)[],3=>(object)[],4=>(object)[],5=>(object)[],6=>(object)[],7=>(object)[],8=>(object)[],9=>(object)[],10=>(object)[],11=>(object)[],12=>(object)[]);
        $uptime_weeks = array(1=>(object)[],2=>(object)[],3=>(object)[],4=>(object)[],5=>(object)[],6=>(object)[],7=>(object)[],8=>(object)[],9=>(object)[],10=>(object)[],11=>(object)[],12=>(object)[],13=>(object)[],14=>(object)[],15=>(object)[],
            16=>(object)[],17=>(object)[],18=>(object)[],19=>(object)[],20=>(object)[],21=>(object)[],22=>(object)[],23=>(object)[],24=>(object)[]);
        
        switch ($option){
            case 0:
                $where = "machine_id = '".$machine_id."' AND shot_time BETWEEN (CURDATE() - INTERVAL 30 DAY) AND CURDATE()";
                $this->db->select("id,machine_id,csv_date, DAY(shot_time) as date,DATEDIFF(CURDATE(),shot_time) as num");
                $this->db->distinct();
                $this->db->order_by('num','DESC');
                //$this->db->group_by('machine_id');
                $this->db->from("machine_actual_production");
                $production = $this->db->where($where);
                $production = $production->get()->result_array(); 

                echo $this->db->last_query();
                pr($production);exit;
                if(!empty($production)){
                    foreach ($production as $key=>$pr){
                        $num  = 31-$pr['num'];
                        $uptime_days[$num]=$pr;
                    }
                }else{
                    $uptime_days = (object)array();
                }
                
                
                return array('up_time'=>$uptime_days);
            case 1:
                $where = "machine_id = '".$machine_id."' AND  `day` > DATE_SUB(NOW(), INTERVAL 24 WEEK)";

                $this->db->select("DATE_ADD(day, INTERVAL(2-DAYOFWEEK(day)) DAY) as day,(24 - (ROUND(DATEDIFF(CURDATE(), day)/7, 0))) as week,sum(`total_production`) as total");
                $this->db->distinct();
                $this->db->order_by('day','ASC');
                $this->db->group_by('week');
                $this->db->from("machine_daywise_production");
                $production = $this->db->where($where);
                $production = $production->get()->result_array(); 

                if(!empty($production)){
                foreach ($production as $key=>$pr){
                     $production_weeks[$pr['week']]=$pr;
                }}else{
                     $production_weeks = (object)array();
                 }
                
                return array('up_time'=>$uptime_weeks);
            case 2:
                $where = "machine_id = '".$machine_id."' AND  `day` > DATE_SUB(NOW(), INTERVAL 12 MONTH)";

                $this->db->select("day,MONTH(`day`) as month,sum(`total_production`) as total");
                $this->db->distinct();
                $this->db->order_by('day','ASC');
                $this->db->group_by(' MONTH(`day`)');
                $this->db->from("machine_daywise_production");
                $production = $this->db->where($where);
                $production = $production->get()->result_array();

                if(!empty($production)){
                foreach ($production as $key=>$pr){
                    $production_months[$pr['month']]=$pr;
                }}else{
                     $production_months = (object)array();
                 }
                
                
                
                return array('up_time'=>$uptime_months);
        }
    }
   
    function get_days($flag='total',$is_dummy=0){
        $date = date('Y-m-d');
        $startdate = date('d-m-Y',strtotime('-30 days',strtotime($date)));
        $day = array();
        $total = "0";
           for($i=1;$i<=30;$i++){
                
                $day1 = array('day'=>date('d-m-Y',strtotime('+'.$i.' days',strtotime($startdate))),$flag=>$total,'date'=>date('d',strtotime('+'.$i.' days',strtotime($startdate))));
                $day[$i] = (object)$day1;
                if($is_dummy==1)
                    $total=$total+5;
            }
        return $day;
    }
    
    function get_month($flag='total',$is_dummy=0){
        $date = date('Y-m-d');
        $startdate = date('d-m-Y',strtotime('-12 months',strtotime($date)));
        $day = array();
        $total = "0";
           for($i=1;$i<=12;$i++){
                
                $m = date('d-m-Y',strtotime('+'.$i.' months',strtotime($startdate)));
                $day1 = array('day'=>$m,$flag=>$total,'month'=>date('m',strtotime($m)));
                $day[$i] = (object)$day1;
                if($is_dummy==1)
                    $total=$total+5;
            }
        return $day;
    }
    
    function get_week($flag='total',$is_dummy=0){
        $date = date('Y-m-d');
        $startdate = date('d-m-Y',strtotime('-6 months',strtotime($date)));
        $startdate = date('d-m-Y',strtotime('+15 days',strtotime($startdate)));
        $day = array();
           $total = "0";
           for($i=1;$i<=24;$i++){
                $m = date('d-m-Y',strtotime('+'.$i.' Week',strtotime($startdate)));
                $day1 = array('day'=>$m,$flag=>$total,'week'=>$i);
                $day[$i] = (object)$day1;
                if($is_dummy==1)
                    $total=$total+5;
            }
        return $day;
    }
    
    public function get_uptime($machine_id, $option){
        
        $production_days_green = $this->get_days('hour',1);
        $production_days_yellow = $this->get_days('hour',1);
        $production_days_black = $this->get_days('hour',1);

        $production_weeks_green =  $this->get_week('hour',1);
        $production_weeks_yellow =  $this->get_week('hour',1);
        $production_weeks_black =  $this->get_week('hour',1);

        $production_months_green =  $this->get_month('hour',1);
        $production_months_yellow =  $this->get_month('hour',1);
        $production_months_black =  $this->get_month('hour',1);
        
        switch ($option){
            case 0:

                $where = "machine_id = '".$machine_id."' AND date BETWEEN (CURDATE() - INTERVAL 30 DAY) AND CURDATE()";
                $this->db->select("DATE_FORMAT(date, '%d-%m-%Y') as day,total_production as total,no_production,system_down,DAY(date) as date,DATEDIFF(CURDATE(),date) as num");
                $this->db->distinct();
                $this->db->order_by('num','DESC');
                $this->db->from("machine_response_summary");
                $production = $this->db->where($where);
                $production = $production->get()->result_array();
                //echo $this->db->last_query();
                //pr($production);exit;
                if(!empty($production)) {
                    foreach ($production as $key=>$pr) {
                        $num  = 30-$pr['num'];
                        
                        $pr_data_green['day']=$pr['day'];
                        $pr_data_green['hour']=round($pr['total'],2);
                        $pr_data_green['date']=$pr['date'];
                        $production_days_green[$num]=$pr_data_green;

                        $pr_data_yellow['day']=$pr['day'];
                        $pr_data_yellow['hour']=round($pr['no_production'],2);
                        $pr_data_yellow['date']=$pr['date'];
                        $production_days_yellow[$num]=$pr_data_yellow;

                        $pr_data_black['day']=$pr['day'];
                        $pr_data_black['hour']=round($pr['system_down'],2);
                        $pr_data_black['date']=$pr['date'];
                        $production_days_black[$num]=$pr_data_black;

                    }
                } else {
                     $production_days_yellow = (object)array();
                     $production_days_green = (object)array();
                     $production_days_black = (object)array();
                }
                
                return array('yellow'=>$production_days_yellow,'green'=>$production_days_green,'black'=>$production_days_black);
                break;

            case 1:
                $where = "machine_id = '".$machine_id."' AND  `date` > DATE_SUB(NOW(), INTERVAL 24 WEEK)";

                $this->db->select("DATE_FORMAT(DATE_ADD(date, INTERVAL(2-DAYOFWEEK(date)) DAY), '%d-%m-%Y') as day,(24 - (ROUND(DATEDIFF(CURDATE(), date)/7, 0))) as week,sum(`total_production`) as total, sum(`no_production`) as no_production,sum(`system_down`) as system_down");
                $this->db->distinct();
                $this->db->order_by('date','ASC');
                $this->db->group_by('week');
                $this->db->from("machine_response_summary");
                $production = $this->db->where($where);
                $production = $production->get()->result_array(); 
                //pr($production);exit;
                if(!empty($production)){
                    foreach ($production as $key=>$pr){

                        $pr_data_green['day']=$pr['day'];
                        $pr_data_green['hour']=round($pr['total'],2);
                        $pr_data_green['date']=$pr['week'];
                        $production_weeks_green[$pr['week']]=$pr_data_green;

                        $pr_data_yellow['day']=$pr['day'];
                        $pr_data_yellow['hour']=round($pr['no_production'],2);
                        $pr_data_yellow['date']=$pr['week'];
                        $production_weeks_yellow[$pr['week']]=$pr_data_yellow;

                        $pr_data_black['day']=$pr['day'];
                        $pr_data_black['hour']=round($pr['system_down'],2);
                        $pr_data_black['date']=$pr['week'];
                        $production_weeks_black[$pr['week']]=$pr_data_black;

                        //$production_weeks[$pr['week']]=$pr;
                    }
                }else{
                    $production_weeks_green = (object)array();
                    $production_weeks_yellow = (object)array();
                    $production_weeks_black = (object)array();
                }

                return array('yellow'=>$production_weeks_yellow,'green'=>$production_weeks_green,'black'=>$production_weeks_black);
                break;

            case 2:
                $where = "machine_id = '".$machine_id."' AND  `date` > DATE_SUB(NOW(), INTERVAL 12 MONTH)";

                $this->db->select("DATE_FORMAT(date, '%d-%m-%Y') as day,MONTH(`date`) as month,sum(`total_production`) as total, sum(`no_production`) as no_production,sum(`system_down`) as system_down");
                $this->db->distinct();
                $this->db->order_by('date','ASC');
                $this->db->group_by(' MONTH(`date`)');
                $this->db->from("machine_response_summary");
                $production = $this->db->where($where);
                $production = $production->get()->result_array();
                //pr($production);exit;
                if(!empty($production)){
                    foreach ($production as $key=>$pr){

                        $pr_data_green['day']=$pr['day'];
                        $pr_data_green['hour']=round($pr['total'],2);
                        $pr_data_green['date']=$pr['month'];
                        $production_months_green[$pr['month']]=$pr_data_green;

                        $pr_data_yellow['day']=$pr['day'];
                        $pr_data_yellow['hour']=round($pr['no_production'],2);
                        $pr_data_yellow['date']=$pr['month'];
                        $production_months_yellow[$pr['month']]=$pr_data_yellow;

                        $pr_data_black['day']=$pr['day'];
                        $pr_data_black['hour']=round($pr['system_down'],2);
                        $pr_data_black['date']=$pr['month'];
                        $production_months_black[$pr['month']]=$pr_data_black;

                        //$production_months[$pr['month']]=$pr;
                    }
                }else{
                     //$production_months = (object)array();
                    $production_months_green = (object)array();
                    $production_months_yellow = (object)array();
                    $production_months_black = (object)array();
                }
                
                return array('yellow'=>$production_months_yellow,'green'=>$production_months_green,'black'=>$production_months_black);
                break;
        }
    }
}
