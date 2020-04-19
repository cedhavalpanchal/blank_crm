<?php
/*
@Description: cron controller
@Author: Dhaval Panchal
@Date: 11-01-2016

 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cron_control extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        error_reporting(1);
        $this->load->model('Common_function_model');
        $this->obj       = $this->Common_function_model;
        $this->viewName  = $this->router->uri->segments[2];
        $this->user_type = 'admin';
    }

    public function index()
    {
    }

    public function array_random($arr, $num = 1)
    {
        shuffle($arr);

        $r = array();

        for ($i = 0; $i < $num; $i++) {
            $r[] = $arr[$i];
        }

        return $num == 1 ? $r[0] : $r;
    }

    public function check_plan_detail()
    {
        /*$user_params = array(
        'table'=>'user_subscription_plan_details usp',
        'join_tables' => array('user_master um'=>'usp.user_id=um.id'),
        'join_type' => 'direct',
        'where'=>array('usp.expire_date < ' => "'".date('Y-m-d H:i:s')."'"),
        'fields'=>array('um.id'),
        'compare_type' => '='
        );
        $user_detail = $this->Common_function_model->getmultiple_tables($user_params);*/

        $query       = $this->db->query("SELECT m1.* FROM user_subscription_plan_details m1 LEFT JOIN user_subscription_plan_details m2 ON (m1.user_id = m2.user_id AND m1.id < m2.id) WHERE m2.id IS NULL");
        $user_detail = $query->result_array();

        //pr($user_detail);
        //exit;

        if (!empty($user_detail)) {
            foreach ($user_detail as $key => $value) {
                $expired_date = date("Y-m-d", strtotime($value['expire_date']));
                $today_date   = date('Y-m-d');

                if ($expired_date < $today_date) {
                    $where[] = $value['user_id'];
                }
            }

            if (!empty($where)) {
                $this->Common_function_model->update('product_master', array('status' => '0'), '', 'created_by IN (' . implode(',', $where) . ')');
                echo "Success";
            } else {
                echo "Expired records not found.";
            }
        }
    }
}
