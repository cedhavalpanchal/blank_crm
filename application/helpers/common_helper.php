<?php

ob_start();

/*
@Description: Function for check admin login
@Author: Dhaval Panchal
@Input: -
@Output: - send email
@Date: 24-11-15
 */
function check_admin_login()
{
    $CI                = &get_instance(); //get instance, access the CI superobject
    $CI->admin_session = $CI->session->userdata($CI->lang->line('business_crm_admin_session'));
    $CI->load->model('common_function_model');
    $match        = array('id' => $CI->admin_session['id'], 'status' => 1);
    $exsting_user = '';
    $sq_data_all  = array
        (
        "table"     => 'admin_management',
        "condition" => $match,
    );
    $exsting_user = $CI->Common_function_model->getmultiple_tables($sq_data_all);

    if (empty($exsting_user)) {
        $CI->session->unset_userdata($CI->lang->line('business_crm_admin_session'));
    }

    $CI->session->set_userdata('current_url_session', current_url());
    $adminLogin = $CI->session->userdata($CI->lang->line('business_crm_admin_session'));

    (!empty($adminLogin['id'])) ? '' : redirect('admin/login');
}


function diff_in_hours($start_date = '', $end_date = '')
{
    $date1 = new DateTime($start_date);
    $date2 = new DateTime($end_date);
    $diff  = $date2->diff($date1);

    //return $diff->format('%h:%I');
    $hours = $diff->h;
    $hours = $hours + ($diff->days * 24);
    $min   = $diff->format('%I');
    $sec   = $diff->format('%S');

    return $time = $hours . ':' . $min . ':' . $sec;
}

function diff_in_hours_decimal($start_date, $end_date)
{
    $t1   = StrToTime($start_date);
    $t2   = StrToTime($end_date);
    $diff = $t1 - $t2;

    return $total_time = $diff / (60 * 60); // convert to hours
}

function date_difference($tCreatedDate)
{

    date_default_timezone_set("America/Chicago");
    $date = date('Y-m-d H:i:s');

    $delta = strtotime($date) - strtotime($tCreatedDate);
    //  return $delta;

    if ($delta < 1 * MINUTE) {
        return $delta == 1 ? "one second ago" : $delta . " seconds ago";
    }

    if ($delta < 2 * MINUTE) {
        return "a minute ago";
    }

    if ($delta < 45 * MINUTE) {
        return floor($delta / MINUTE) . " minutes ago";
    }

    if ($delta < 90 * MINUTE) {
        return "an hour ago";
    }

    if ($delta < 24 * HOUR) {
        return floor($delta / HOUR) . " hours ago";
    }

    if ($delta < 48 * HOUR) {
        return "yesterday";
    }

    if ($delta < 30 * DAY) {
        return floor($delta / DAY) . " days ago";
    }

    if ($delta < 12 * MONTH) {
        $months = floor($delta / DAY / 30);
        return $months <= 1 ? "one month ago" : $months . " months ago";
    } else {
        $years = floor($delta / DAY / 365);
        return $years <= 1 ? "one year ago" : $years . " years ago";
    }

    return date('F d', strtotime($tCreatedDate));
}

function date_difference_days($from_date, $to_date)
{
    $date1 = date_create($from_date);
    $date2 = date_create($to_date);
    $diff  = date_diff($date1, $date2);
    //$days_left = $diff->format("%R%a days");
    return $days_left = $diff->format("%a");
}

/*
@Description: Function for print array
@Author: Dhaval Panchal
@Input: -
@Output: - sort
@Date: 24-11-16
 */
function pr($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}

function prd($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    die;
}

function dateformat($date)
{
    //echo date("m/d/Y", strtotime($date));
    return date("m/d/Y", strtotime($date));
}

function dateformatmysql($date)
{
    return date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $date)));
}

function dateformatBoard($date)
{
    return date("F d,Y", strtotime($date));
}

function databasedateformat($date)
{
    return date("Y-m-d", strtotime($date));
}

function systemDateTime($date)
{
    return date("jS F Y - g:i:s A", strtotime($date));
}

function remove_special_characters($string)
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function per_page_array()
{
    $per_page = array(
        "10"  => "10",
        "25"  => "25",
        "50"  => "50",
        "100" => "100",
        "250" => "250",
        "500" => "500",
    );
    return $per_page;
}

function send_notification_iphone($deviceToken, $message, $json_data)
{
    $CI = &get_instance();
    // echo phpinfo();

    if (!empty($deviceToken) && $deviceToken != '(null)') {
        // Construct the notification payload
        $body = array();
        //$body['message']            = $message;
        $body['aps'] = array('alert' => $message);
        //$body['aps']['badge']       = $json_data['badge'];
        $body['aps']['alert'] = $message;
        //$body['aps']['ft']          = $message;
        $body['aps']['sound'] = 'default';
        $body['aps']['data']  = $json_data;
        //$body['data']               = $json_data['flag'];

        /* End of Configurable Items */
        //$gateway = 'ssl://gateway.push.apple.com:2195';
        $gateway = 'ssl://gateway.sandbox.push.apple.com:2195';
        $ctx     = stream_context_create();
        // Define the certificate to use
        stream_context_set_option($ctx, 'ssl', 'local_cert', PEM_FILE_PATH . 'apns-dev.pem');
        $fp = stream_socket_client($gateway, $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
        //prd($fp);

        if (!$fp) {
            $data['msgs'] = "Failed to connect $err $errstr \n";
        } else {
            $payload = json_encode($body);
            $msg     = chr(0) . pack("n", 32) . pack("H*", str_replace(" ", "", $deviceToken)) . pack("n", strlen($payload)) . $payload;
            $result  = fwrite($fp, $msg);

            if (!$result) {
                $data['msgs'] = 'Message not delivered';
            }
            //. PHP_EOL;
            else {
                $data['msgs'] = 'Success';
            }
            //. PHP_EOL;
            fclose($fp);
        }

        return $data;
    }
}

function send_notification_android($deviceToken, $message, $json_data)
{
    $CI           = &get_instance();
    $url          = 'https://fcm.googleapis.com/fcm/send';
    $server_key   = $CI->config->item('android_noti_key'); //'AIzaSyCAFDH4SZBemUzM0HdHarbUPs77RCoLUlo';
    $headers      = array('Content-Type:application/json', 'Authorization:key=' . $server_key);
    $notification = array('title' => $CI->config->item('project_name'),
        'text'                        => $message,
        'icon'                        => '@mipmap/ic_launcher_trns',
        'sound'                       => 'notification',
        'click_action'                => $json_data['click_action'],
        'color'                       => '#303F9F',
    );
    $json_data = array_merge($json_data, $notification);
    $fields    = array('data' => $json_data,
        //'notification'=> $notification,
        'to'                      => $deviceToken);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);

    if ($result === false) {
        die('FCM Send Error: ' . curl_error($ch));
    }

    curl_close($ch);
    //prd($result);
    return $result;
}

function convert_issue_id($id)
{
    return "RIS" . str_pad($id, 6, '0', STR_PAD_LEFT);
}
