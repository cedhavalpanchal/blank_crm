<?php
/*
    @Description: View of Admin Settings
    @Author: Nishant Rathod
    @Date: 04-08-2016
*/
?>
<?php 
$viewname       = $this->router->uri->segments[2];
$formAction     = 'update_data';
$path           = $viewname.'/'.$formAction;
?>

<div class="main-container">
    <div class="page-container">
        <div class="titlebar">
            <h1 class="orange-clr">Settings</h1>
            <a class="btn btn-primary pull-right" href="<?= base_url('admin/dashboard');?>" title="Back">Back</a>  
        </div>
        <div class="card-block form-container">
            <?php $this->load->view('admin/include/alert_message');  ?>
            <form class="form" enctype="multipart/form-data" name="<?php echo $viewname;?>" id="<?php echo $viewname;?>" method="post" accept-charset="utf-8" action="<?= $this->config->item('admin_base_url')?><?php echo $path?>">
                <div style="border:2px solid grey;padding:18px;">
                <div class="row">
                    <div class="col-sm-6 form-group custom-group">
                        <label for="select-multi-input"><?= $this->lang->line('project_name');?><span style="color:#F00">*</span></label>
                        <input id="sitename" name="sitename" class="form-control" type="text" value="<?= !empty($editRecord[0]['sitename'])?$editRecord[0]['sitename']:'';?>" placeholder="<?= $this->lang->line('project_name');?>">
                    </div>

                    <div class="col-sm-6 form-group custom-group">
                        <label for="select-multi-input"><?= $this->lang->line('admin_email');?><span style="color:#F00">*</span></label>
                        <input name="admin_email" id="admin_email" class="form-control" type="email" value="<?= !empty($editRecord[0]['admin_email'])?$editRecord[0]['admin_email']:'';?>" placeholder="<?= $this->lang->line('admin_email');?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 form-group custom-group">
                        <label for="select-multi-input"><?= $this->lang->line('add_line_1');?><span style="color:#F00">*</span></label>
                        <input name="address1" id="address1" class="form-control" type="text" value="<?= !empty($editRecord[0]['address1'])?$editRecord[0]['address1']:'';?>" placeholder="<?= $this->lang->line('add_line_1');?>">
                    </div>

                    <div class="col-sm-6 form-group custom-group">
                        <label for="select-multi-input"><?= $this->lang->line('add_line_2');?></label>
                        <input name="address2" id="address2" class="form-control" type="text" value="<?= !empty($editRecord[0]['address2'])?$editRecord[0]['address2']:'';?>" placeholder="<?= $this->lang->line('add_line_2');?>">
                    </div>
                </div>

                <div class="row">    
                    <div class="col-sm-6 form-group custom-group">
                        <label for="select-multi-input"><?= $this->lang->line('contact_no');?><span style="color:#F00">*</span></label>
                        <input name="contact_number" id="contact_number" minlength="10" maxlength="10" class="form-control"  class="form-control"  data-type="digits" value="<?= !empty($editRecord[0]['contact_number'])?$editRecord[0]['contact_number']:'';?>" placeholder="<?= $this->lang->line('contact_no');?>" onkeypress="return isNumberKey(event);">
                    </div>

                    <div class="col-sm-6 form-group custom-group">
                          <label for="select-multi-input"><?= $this->lang->line('contact_email');?><span style="color:#F00">*</span></label>
                          <input name="contact_email" id="contact_email" class="form-control" type="email" value="<?= !empty($editRecord[0]['contact_email'])?$editRecord[0]['contact_email']:'';?>" placeholder="<?= $this->lang->line('contact_email');?>">
                    </div>
                    
                </div>
            </div>
            <br>

            
            <h5 style="color:grey;font-weight:bold;">Version</h5>
            <div style="border:2px solid grey;padding:18px;">
                <div class="row">
                    <div class="col-sm-6 form-group custom-group">
                        <label for="select-multi-input"><?= $this->lang->line('current_version');?></label>
                        <input name="current_version" id="current_version" class="form-control" type="text" value="<?= !empty($editRecord[0]['current_version'])?$editRecord[0]['current_version']:'';?>" placeholder="<?= $this->lang->line('current_version');?>">
                    </div>
                </div>
            </div>
            <br>

            <h5 style="color:grey;font-weight:bold;">Enter the details of the email account to be used to send the mails <i class="fa fa-envelope" aria-hidden="true"></i></h5>
            <div style="border:2px solid grey;padding:18px;">
                <div class="row">
                    <div class="col-sm-6 form-group custom-group">
                        <label for="select-multi-input"><?= $this->lang->line('smtp_host');?><span style="color:#F00">*</span></label>
                        <input name="smtp_host" id="smtp_host" class="form-control" type="text"  value="<?= !empty($editRecord[0]['smtp_host'])?$editRecord[0]['smtp_host']:'';?>" placeholder="<?= $this->lang->line('smtp_host');?>">
                    </div>

                    <div class="col-sm-6 form-group custom-group">
                        <label for="select-multi-input"><?= $this->lang->line('smtp_email');?><span style="color:#F00">*</span></label>
                        <input name="smtp_user" id="smtp_user" class="form-control" type="email"  value="<?= !empty($editRecord[0]['smtp_user'])?$editRecord[0]['smtp_user']:'';?>" placeholder="<?= $this->lang->line('smtp_email');?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 form-group custom-group">
                        <label for="select-multi-input"><?= $this->lang->line('smtp_pass');?><span style="color:#F00">*</span></label>
                        <input name="smtp_pass" id="smtp_pass" class="form-control" type="password"  value="<?= !empty($editRecord[0]['smtp_pass'])?$editRecord[0]['smtp_pass']:'';?>" placeholder="<?= $this->lang->line('smtp_pass');?>">
                    </div>

                    <div class="col-sm-6 form-group custom-group">
                        <label for="select-multi-input"><?= $this->lang->line('protocol');?><span style="color:#F00">*</span></label>
                        <input name="protocol" id="protocol" class="form-control" type="text"  value="<?= !empty($editRecord[0]['protocol'])?$editRecord[0]['protocol']:'';?>" placeholder="<?= $this->lang->line('protocol');?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 form-group custom-group">
                        <label for="select-multi-input"><?= $this->lang->line('smtp_port');?><span style="color:#F00">*</span></label>
                        <input name="smtp_port" id="smtp_port" class="form-control" type="text"  value="<?= !empty($editRecord[0]['smtp_port'])?$editRecord[0]['smtp_port']:'';?>" placeholder="<?= $this->lang->line('smtp_port');?>">
                    </div>

                    <div class="col-sm-6 form-group custom-group">
                        <label for="select-multi-input"><?= $this->lang->line('smtp_timeout');?><span style="color:#F00">*</span></label>
                        <input name="smtp_timeout" id="smtp_timeout" class="form-control" type="text"  value="<?= !empty($editRecord[0]['smtp_timeout'])?$editRecord[0]['smtp_timeout']:'';?>" placeholder="<?= $this->lang->line('smtp_timeout');?>">
                    </div>
                </div>
            </div>
            <br>

            <div class="form-group text-right">
                <input type="hidden" name="id" value="<?= !empty($editRecord[0]['id'])?$editRecord[0]['id']:'';?>" />
                <button type="submit" class="btn btn-primary" id="save">Save</button>
              <a type="button" class="btn btn-primary" href="<?php echo base_url('admin/dashboard'); ?>" id="cancel">Cancel</a>
            </div>
            </form>

        </div>
    </div>
</div>
