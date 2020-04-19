<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class=""><!--<![endif]-->

    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title><?php echo ucwords(!empty($this->page_title) ? $this->page_title : $this->config->item('project_name')); ?> - Admin</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <script type="text/javascript" src="<?= $this->config->item('js_path') ?>jquery-1.9.1.js"></script>
        <script type="text/javascript" src="<?= $this->config->item('js_path') ?>jquery.blockUI.js"></script>
        <script type="text/javascript" src="<?= $this->config->item('js_path') ?>jquery.confirm.js"></script>
        <script type="text/javascript" src="<?= $this->config->item('js_path') ?>bootstrap.js"></script>
        <script type="text/javascript" src="<?= $this->config->item('js_path') ?>parsley.js"></script>
        <script type="text/javascript" src="<?= $this->config->item('js_path') ?>App.js"></script>

        <link rel="stylesheet" href="<?= $this->config->item('css_path') ?>css.css" type="text/css">
        <link rel="stylesheet" href="<?= $this->config->item('css_path') ?>runtime.css" type="text/css">
        <link rel="stylesheet" href="<?= $this->config->item('css_path') ?>font-awesome.css" type="text/css">
        <link rel="stylesheet" href="<?= $this->config->item('css_path') ?>bootstrap.css" type="text/css">
        <link rel="stylesheet" href="<?= $this->config->item('css_path') ?>App.css" type="text/css">
        <link rel="stylesheet" href="<?= $this->config->item('css_path') ?>buttons.css" type="text/css">
        <link rel="stylesheet" href="<?= $this->config->item('css_path') ?>select2.css" type="text/css">
        <link rel="stylesheet" href="<?= $this->config->item('css_path') ?>jquery.confirm.css" type="text/css">

        <link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/icon">
    </head>

<style>
#content{
            
    margin-left: 31px !important;
    margin-right: 20px !important;
    margin-top: 50px !important;
}
</style>
    <body>
        <div id="wrapper">
            <h1 id="site-logo">
            </h1>
            