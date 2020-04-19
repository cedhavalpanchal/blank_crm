<?php
/*
    @Description: View of Admin Settings
    @Author: Nishant Rathod
    @Date: 04-08-2016
*/
?>
<?php 
$viewname       = $this->router->uri->segments[2];
$formAction     = !empty($editRecord)?'update_data':'update_data'; 
$path           = $viewname.'/'.$formAction;
?>

<div class="main-container">
    <div class="page-container">
        <div class="titlebar">
            <h1 class="orange-clr">Settings</h1>
            <a class="btn btn-primary pull-right" href="<?= base_url('admin/dashboard');?>" title="Back">Back</a>  
        </div>
        <div class="card-block form-container">
            <div class="text-center" id="div_msg">
                <?php
                    if (null !== ($this->session->flashdata('message_session')) && false !== $this->session->flashdata('message_session')) {
                        $flash = $this->session->flashdata('message_session');
                        if ($flash['status'] === 'failed') {
                            ?>
                            <div class="alert alert-danger">
                                <a href="javascript:void(0)" class="close close-message" aria-label="close" title="Close">&times;</a>
                            <?php echo $flash['message']; ?>
                            </div>
                        <?php } else { ?>
                            <div class="alert alert-success">
                                <a href="javascript:void(0)" class="close close-message" aria-label="close" title="Close">&times;</a>  <?php echo $flash['message']; ?>
                            </div>
                        <?php
                    }
                }
                ?>
            </div>
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

<!-- #content --> 
<script type="text/javascript">

    $('#<?= $viewname ?>').validate({
          onkeyup:false,
          rules: {
              sitename: {
                  required: true
              },
              admin_email: {
                  required: true
              },
              address1: {
                required: true
              },
              contact_number : {
                  required: true,
                  minlength : 10,
                  maxlength : 10,
              },
              contact_email: {
                  required: true
              },
              smtp_host: {
                  required: true
              },
              smtp_user: {
                  required: true
              },
              smtp_pass: {
                  required: true
              },
              protocol: {
                  required: true
              },
              smtp_port: {
                  required: true
              },
              smtp_timeout: {
                  required: true
              },
          },
          messages: {
              first_name: {
                  required: 'First Name cannot be blank',
              },
              sitename: {
                  required: 'Sitename cannot be blank',
              },
              admin_email: {
                  required: 'Admin Email cannot be blank',
              },
              address1: {
                  required: 'Address cannot be blank',
              },
              contact_number : {
                  required: 'Contact Number cannot be blank',
                  minlength : 10,
                  maxlength : 10,
              },
              contact_email: {
                  required: 'Contact Email cannot be blank',
              },
              smtp_host: {
                  required: 'SMTP Host cannot be blank',
              },
              smtp_user: {
                  required: 'SMPT User cannot be blank',
              },
              smtp_pass: {
                  required: 'SMTP Password cannot be blank',
              },
              protocol: {
                  required: 'Protocol cannot be blank',
              },
              smtp_port: {
                  required: 'SMTP Port cannot be blank',
              },
              smtp_timeout: {
                  required: 'SMPT Timout cannot be blank',
              },
          }
      });

</script>
