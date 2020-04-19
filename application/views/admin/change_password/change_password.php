<?php 
/*
  @Description: Change Password
  @Author: Dhaval Panchal
  @Date: 19-07-18
*/ 

$admin_type = $this->router->uri->segments[1];
$viewname = $this->router->uri->segments[2];
$session_data = $this->session->userdata('change_password_session');
?>


<div class="main-container">
    <div class="page-container">
        <div class="titlebar">
            <h1 class="orange-clr">Change Password</h1>
            <a class="btn btn-primary pull-right" title="<?= $this->lang->line('common_back_title')?>" href="<?= $this->config->item('admin_base_url').'dashboard'?>"><?= $this->lang->line('common_back_title')?></a>
        </div>
        <!-- add new user start -->

        <div class="card-block form-container">
            <div>
                <?php if (null !== ($this->session->userdata('change_password_session')) && false !== $this->session->userdata('change_password_session')){ ?>
                    <div class="text-center" id="div_msg">
                        <?php
                        $class = "";
                        $flash = $this->session->userdata('change_password_session');
                        if ($flash['status'] === 'failed') {
                            $class = "alert alert-danger";
                        } else {
                            $class = "alert alert-success";
                        }
                        ?>
                        <div class="<?= $class ?>">
                            <a href="javascript:void(0)" class="close close-message" aria-label="close" title="Close">&times;</a>
                        <?php echo $flash['message']; ?>
                        </div>
                        
                    </div>
                    <?php $this->session->unset_userdata('change_password_session'); }   ?>
            </div>
            <form class="form parsley-form" enctype="multipart/form-data" name="<?php echo $viewname; ?>" id="<?php echo $viewname; ?>" method="post" accept-charset="utf-8" action="<?= $this->config->item('admin_base_url') ?>change_password/admin_change_password" > 

                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group custom-group">
                            <label for="select-multi-input"><?php echo $this->lang->line('old_password');?><span style="color:#F00">*</span></label>
                            <input data-minlength="6" type="password" name="oldpassword" id="oldpassword" class="form-control " type="text" data-required="true"  placeholder="<?php echo $this->lang->line('old_password');?>"/>
                        </div>
                    </div>
                <!-- </div>
                <div class="row"> -->
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group custom-group">
                            <label for="select-multi-input"><?php echo $this->lang->line('new_password');?><span style="color:#F00">*</span></label>
                                    <input data-minlength="6" type="password" name="password" id="password" class="form-control " placeholder="<?php echo $this->lang->line('new_password');?>" type="text" data-required="true" />
                        </div>
                    </div>
                <!-- </div>
                <div class="row"> -->
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group custom-group">
                            <label for="select-multi-input"><?php echo $this->lang->line('new_co_password');?><span style="color:#F00">*</span></label>
                                    <input type="password" name="cpassword" placeholder="<?php echo $this->lang->line('new_co_password');?>" id="cpassword" class="form-control " type="text" data-required="true" data-equaltopass="#password" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-right">
                      <div class="button-grp">
                        <input type="hidden" name="id" value="<?= !empty($editRecord[0]['id']) ? $editRecord[0]['id'] : ''; ?>" />
                        <button type="submit" class="btn btn-primary" id="save" title="<?php echo $this->lang->line('save_record'); ?>" value="submitForm" name="save">Save</button>
                      </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- #content --> 
<script>
    
    $('#<?= $viewname ?>').validate({
          onkeyup:true,
          rules: {
                oldpassword: {
                    required: true,
                },
                password: {
                    required: true,
                    normalizer: function (value) {
                        return $.trim(value);
                    },
                    minlength:6,
                },
                cpassword:{
                    required: true,
                    normalizer: function (value) {
                        return $.trim(value);
                    },
                    equalTo: "#password",
                }
            },
            messages: {
                oldpassword: {
                    required: 'Old Password cannot be blank',
                },
                password: {
                    required: 'Password cannot be blank',
                    minlength: "Password must be at least 6 characters long ",
                },
                cpassword: {
                    required: 'Confirm Password cannot be blank',
                    equalTo: "Password and Confirm Password should be same.",
                },
            }
      });
</script>