<?php 
/*
  @Description: Change Password
  @Author: Dhaval Panchal
  @Date: 19-07-18
*/ 
$viewname = $this->router->uri->segments[2];
?>


<div class="main-container">
    <div class="page-container">
        <div class="titlebar">
            <h1 class="orange-clr">Change Password</h1>
            <a class="btn btn-primary pull-right" title="<?= $this->lang->line('common_back_title')?>" href="<?= $this->config->item('admin_base_url').'dashboard'?>"><?= $this->lang->line('common_back_title')?></a>
        </div>
        <!-- add new user start -->

        <div class="card-block form-container">
            <?php $this->load->view('admin/include/alert_message');  ?>
            <form class="form parsley-form" enctype="multipart/form-data" name="<?php echo $viewname; ?>" id="<?php echo $viewname; ?>" method="post" accept-charset="utf-8" action="<?= $this->config->item('admin_base_url') ?>change_password/admin_change_password" > 

                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group custom-group">
                            <label for="select-multi-input"><?php echo $this->lang->line('old_password');?><span style="color:#F00">*</span></label>
                            <input data-minlength="6" type="password" name="oldpassword" id="oldpassword" class="form-control " type="text"  placeholder="<?php echo $this->lang->line('old_password');?>"/>
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
