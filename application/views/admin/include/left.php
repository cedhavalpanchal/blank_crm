<?php
/*
  @Description: Left File
  @Author: Mit Makwana
  @Input:
  @Output:
  @Date: 25-11-2016
 */

$admin = $this->session->userdata($this->lang->line('business_crm_admin_session')); 
/*---------- Listing And Searching Session Destroy -------------*/
if($this->uri->segment(2)!= 'user_management'){
    $this->session->unset_userdata('admin_sortsearchpage_data');
}
if($this->uri->segment(2)!= 'to_do_management'){
    $this->session->unset_userdata('to_do_sortsearchpage_data');
}
if($this->uri->segment(2)!= 'contact_source'){
    $this->session->unset_userdata('lead_source_sortsearchpage_data');
}

/*----------End Session destroy-------------*/
?>
<div id="sidebar-wrapper" class="collapse sidebar-collapse">   
  <nav id="sidebar">
    <ul id="main-nav" class="open-active">
        <li<?php if($this->uri->segment(2)=='dashboard'){?> class="active" <?php } ?>> <a href="<?=base_url('admin/dashboard');?>"> <i class="fa fa-dashboard"></i>Dashboard</a> </li>      
        <li<?php if($this->uri->segment(2)=='user_management'){?> class="active" <?php } ?>> <a href="<?=base_url('admin/user_management');?>"> <i class="fa fa-user"></i>User Management</a> </li>
        <li<?php if($this->uri->segment(2)=='contact_source'){?> class="active" <?php } ?>> <a href="<?=base_url('admin/contact_source');?>"> <i class="fa fa-list-ul"></i>Lead Source</a> </li>
        <li<?php if($this->uri->segment(2)=='to_do_management'){?> class="active" <?php } ?>> <a href="<?=base_url('admin/to_do_management');?>"> <i class="fa fa-list-ul"></i>To do Management</a> </li>
        <li <?php if ($this->uri->segment(2) == 'change_password') { ?> class="active" <?php } ?>> <a href="<?= base_url('admin/change_password'); ?>"><i class="fa fa-key"></i>Change Password</a> </li>
        <li class="dropdown"><a href="javascript:void(0);" onclick="logout();"><i class="fa fa-sign-out"></i><span>Logout </span></a>
    </ul>
  </nav>
</div>
<script>
function logout()
{
  $.confirm({
    'title': 'Logout ','message': " <strong> <?= $this->lang->line('logout_confirm'); ?>",'buttons': {'Yes': {'class': '',
    'action': function(){
        window.location="<?= base_url('admin/logout') ?>";
      }},'No'	: {'class'	: 'special'}}});
}
</script>

<!--SIDEBAR MENU CUSTOM SCROLL : START-->
<script>
 var nicesx = $('#main-nav').niceScroll({touchbehavior:true,cursorcolor:"#7f44aa",cursoropacitymax:0.6,cursorwidth:8});
</script>

<script>
  function misqCalc() {
     var windowH = $(window).height();
     var topbarH = $('.header').outerHeight(true);
     var footerH = $('#footer').outerHeight(true);
     var calH = windowH - (topbarH + footerH);
     $('#main-nav').css('height',calH - 10);
     $('#content').css('min-height',calH);
  };
  misqCalc();
   $(window).load(function (){
    misqCalc();
  });
  $(window).resize(function (){
    misqCalc();
  });
  $(document).on('click', 'body', function(){
    misqCalc();
  });
</script>
<!--SIDEBAR MENU CUSTOM SCROLL : CLOSE-->