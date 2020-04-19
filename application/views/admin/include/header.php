
<?php 
$module = $this->router->uri->segments[2];
$admin = $this->session->userdata($this->lang->line('business_crm_admin_session')); 
/*---------- Listing And Searching Session Destroy -------------*/
if($this->uri->segment(2)!= 'user_management'){
    $this->session->unset_userdata('admin_sortsearchpage_data');
}

$user_image = $admin['profile_pic'];
if(!empty($user_image)){

    $user_image_path = $this->config->item('admin_pic_thumb_url').$user_image;
    if(!file_exists($this->config->item('admin_pic_thumb_path').$user_image)){
        $user_image_path = $this->config->item('image_path').'avtar-img.jpg';
    }

}else{
    $user_image_path = $this->config->item('image_path').'avtar-img.jpg';
}   

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->

<html class=""><!--<![endif]-->

    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title><?php echo ucwords(!empty($this->page_title) ? $this->page_title : $this->config->item('project_name')); ?> - Admin</title>
        
        <meta name="description" content="${2}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="icon.png">

        <!-- css file -->
        <link rel="stylesheet" href="<?php echo $this->config->item('css_path') ?>bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $this->config->item('css_path') ?>fonts.css">
        <link rel="stylesheet" href="<?php echo $this->config->item('css_path') ?>dcalendar.picker.css">
        <link rel="stylesheet" href="<?php echo $this->config->item('css_path') ?>jquery.confirm.css" >
        <link rel="stylesheet" href="<?php echo $this->config->item('css_path') ?>main.css">
        <link rel="stylesheet" href="<?php echo $this->config->item('css_path') ?>responsive.css">

        <!-- Js file -->
        <script src="<?php echo $this->config->item('js_path') ?>jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="<?= $this->config->item('js_path') ?>common.js"></script>
        <script type="text/javascript" src="<?= $this->config->item('js_path') ?>jquery.blockUI.js"></script>
        <script type="text/javascript" src="<?= $this->config->item('js_path') ?>jquery.confirm.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>


        <script type="text/javascript">
            
            var Logout_url = '<?= $this->config->item('admin_base_url').'logout'; ?>';
            function logout(){

                $.confirm({
                    'title': 'ALERT','message': " <strong> <?= $this->lang->line('logout_confirm'); ?>",'buttons': {'Yes': {'class': '',
                    'action': function(){
                        location.href = Logout_url;
                    }},'No' : {'class'  : 'special'}}}); 

            }

        </script>
    </head>
  <body>


    <!-- Header start -->
    <nav class="navbar navbar-default cus-navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=base_url('admin/dashboard');?>"><img src="<?php echo $this->config->item('image_path') ?>/brand-logo.png" class="avtar-img" style="position: absolute;width: 100px;height: 90px;top: 0;"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="<?= ($module == 'dashboard') ? 'active':'' ?>" ><a href="<?=base_url('admin/dashboard');?>"><i class="nav-icon dashboard-icon"></i><span>Dashboard</span></a></li>
            <li class="<?= ($module == 'user_management') ? 'active':'' ?>"><a href="<?=base_url('admin/user_management');?>"><span><i class="nav-icon usr-icon"></i>Users</span></a></li>
          </ul>
     
          <ul class="nav navbar-nav navbar-right profile-dropdown">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo !empty($this->admin_session['name'])?ucwords(strtolower($this->admin_session['name'])):''; ?>  <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <?php if($this->admin_session['is_super'] == '1') { ?>
                <li><a href="<?=base_url('admin/admin_settings');?>">Settings</a></li>
                <?php } ?>
                <li><a href="<?=base_url('admin/change_password');?>">Change Password</a></li>
                <li><a onclick="logout();" href="javascript:void(0)">Logout</a></li>
              </ul>
            </li>
            <li><img src="<?php echo $user_image_path; ?>" class="avtar-img"></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <!-- Header close -->
