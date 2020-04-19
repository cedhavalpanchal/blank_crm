<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>404 Page Not Found</title>
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


            <link rel="stylesheet" href="<?= $this->config->item('css_path') ?>runtime.css" type="text/css">
            <link rel="stylesheet" href="<?= $this->config->item('css_path') ?>font-awesome.css" type="text/css">
            <link rel="stylesheet" href="<?= $this->config->item('css_path') ?>bootstrap.css" type="text/css">
            <link rel="stylesheet" href="<?= $this->config->item('css_path') ?>select2.css" type="text/css">
            <script type="text/javascript" src="<?= $this->config->item('js_path') ?>App.js"></script>


            <link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon">
            <link rel="icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon">
            <link rel="icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/icon">
            <style>

                body {
                    background-color: #fff;
                    margin: 40px;
                    font: 13px/20px normal Helvetica, Arial, sans-serif;
                    color: #4F5155;
                }

                a {
                    color: #003399;
                    background-color: transparent;
                    font-weight: normal;
                }

                h1 {
                    color: #444;
                    background-color: transparent;
                    font-size: 19px;
                    font-weight: normal;
                    margin: 0 0 14px 0;
                    padding: 14px 15px 10px 15px;
                }

                code {
                    font-family: Consolas, Monaco, Courier New, Courier, monospace;
                    font-size: 12px;
                    background-color: #f9f9f9;
                    border: 1px solid #D0D0D0;
                    color: #002166;
                    display: block;
                    margin: 14px 0 14px 0;
                    padding: 12px 10px 12px 10px;
                }

                #container {
                    margin: 10px;
                    border: 1px solid #D0D0D0;
                    -webkit-box-shadow: 0 0 8px #D0D0D0;
                }

                p {
                    margin: 12px 15px 12px 15px;
                }
            </style>
        </head>
        <body>
            <div id="wrapper">
                <h1 id="site-logo">
                    <a href="<?= base_url('admin'); ?>"> <img width="200px;" alt="<?php echo $this->config->item('project_name') ?>" src="<?php echo $this->config->item('base_url') ?>images/logo.png"></a>
                    
                </h1>
                <div class="container">
                <div class="page404">
                    <h1>Don't worry you will be back on track in some time!</h1>
                    <h2>404</h2>   
                    <p>
                        Page doesn't exist or some other error occured. Go to our <a href="<?= base_url(); ?>">homepage</a> or go back to <a href="javascript:history.go(-1);">previous page.</a>
                    </p>
                </div
                </div>
            </div>
            </div>

            <footer id="footer">
                <ul class="nav pull-right">
                    <li> Copyright © <?= date('Y'); ?> <?= !empty($this->config->item('sitename')) ? $this->config->item('sitename') : '' ?> . All rights reserved.</li>
                </ul>
            </footer>
            <a style="display: none;" href="#top" id="back-to-top"><i class="fa fa-chevron-up"></i></a>
        </body>
    </html>
