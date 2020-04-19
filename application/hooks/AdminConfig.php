<?php

function admin_configuration()
{
    $CI = &get_instance(); //get instance, access the CI superobject
    $CI->load->model('common_function_model');
    $sq_data_all = array
        (
        "table" => 'settings_master',

    );
    $adminConfig = $CI->Common_function_model->getmultiple_tables($sq_data_all);

    if (!empty($adminConfig)) {
        $smtp_pass = $CI->Common_function_model->decrypt_script($adminConfig[0]['smtp_pass']);
    }

    $CI->config->set_item('sitename', $adminConfig[0]['sitename']);
    $CI->config->set_item('project_name', $adminConfig[0]['sitename']);
    $CI->config->set_item('admin_email', $adminConfig[0]['admin_email']);
    $CI->config->set_item('company_email', $adminConfig[0]['admin_email']);
    $CI->config->set_item('smtp_host', $adminConfig[0]['smtp_host']);
    $CI->config->set_item('smtp_user', $adminConfig[0]['smtp_user']);
    $CI->config->set_item('smtp_pass', $adminConfig[0]['smtp_pass']);
    $CI->config->set_item('protocol', $adminConfig[0]['protocol']);
    $CI->config->set_item('smtp_port', $adminConfig[0]['smtp_port']);
    $CI->config->set_item('smtp_timeout', $adminConfig[0]['smtp_timeout']);
    $CI->config->set_item('current_version', $adminConfig[0]['current_version']);

    //echo '<pre>'; print_r($CI->config);
}
