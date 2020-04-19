<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo ucwords(!empty($this->page_title)?$this->page_title:$this->config->item('project_name')); ?></title>

<!-- Favicon Icon -->
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/icon">

<!-- Logout confirm -->
<link rel="stylesheet" type="text/css" href="<?=$this->config->item('css_path')?>jquery.confirm.css"/>
<link href="<?php echo $this->config->item('css_path'); ?>bootstrap.css" rel="stylesheet">

<link href="<?php echo $this->config->item('front_css_path'); ?>main.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?= $this->config->item('css_path') ?>App.css" type="text/css">

<script type="text/javascript" src="<?=$this->config->item('js_path')?>jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?=$this->config->item('js_path')?>jquery.datetimepicker.js"></script>
<script src="<?=$this->config->item('js_path')?>jquery.blockUI.js" type="text/javascript"></script>
<!--confirm box css-->
<script type="text/javascript" src="<?=$this->config->item('js_path')?>jquery.confirm.js"></script> 
<script type="text/javascript" src="<?=$this->config->item('js_path')?>common.js"></script>


<script type="text/javascript" src="<?=$this->config->item('js_path')?>/multiselect/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=$this->config->item('js_path')?>/multiselect/jquery.multiselect.js"></script>
<script type="text/javascript" src="<?=$this->config->item('js_path')?>/multiselect/jquery.multiselect.filter.js"></script>
</head>
<body class="kuloni_main-page">
<div class="main">
<header class="navbar navbar-light navbar-sticky header">
            <div class="container-fluid">
                <a href="<?php echo $this->config->item('employee_base_url');?>" class="site-logo">
                    <img alt="Sequin Closet" class="logo-default" src="<?= !empty($this->site_info[0]['site_logo']) && file_exists($this->config->item('image_site_logo') . $this->site_info[0]['site_logo']) ? $this->config->item('image_site_logo_url') . $this->site_info[0]['site_logo'] : $this->config->item('base_url') . 'images/tops-infosolutions.svg' ?>" width="200px">
                    
                </a>
                <!-- <h4 class="pull-right admin-portal  top-btn-mrg"><a href="<?= $this->config->item('employee_base_url') ?>">Employee Portal</a></h4> -->
                <h4 class="pull-right admin-portal  top-btn-mrg"><a href="<?= base_url('admin') ?>">Admin Portal</a></h4>
                   
            </div>
            </div>
        </header>

        <script>
        $( window ).on( 'scroll', function () {
            var $navbar = $( '.navbar-sticky' );
            if ( $( window ).scrollTop() > 80 ) {
                $navbar.addClass( 'stuck' );
            } else {
                $navbar.removeClass( 'stuck' );
            }
        } );
</script>
<!-- <header>
  <div class="container">
    <nav class="navbar navbar-default">
        Brand and toggle get grouped for better mobile display
        <div class="row" style="margin: 10px;">
          <a href="<?=base_url();?>" alt="<?php echo $this->config->item('project_name')?>">
          <img alt="Admin" src="<?=!empty($this->site_info[0]['site_logo']) && file_exists($this->config->item('image_site_logo').$this->site_info[0]['site_logo'])?$this->config->item('image_site_logo_url').$this->site_info[0]['site_logo']:$this->config->item('base_url').'images/mft_demo_logo.gif'?>"/> 
             
          </a>
          <h4 class="pull-right"><a href="<?= base_url('admin') ?>">Admin Portal</a></h4>
        /.navbar-collapse 
    </nav>
  </div>
</header> -->