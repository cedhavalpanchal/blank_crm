<?php /*
  @Description: Admin Add/Edit
  @Author: Dhaval Panchal
  @Date: 25-11-2016

 */ ?>
<?php
$viewname = $this->router->uri->segments[2];
$formAction = !empty($editRecord) ? 'update_data' : 'insert_data';
$path = $viewname . '/' . $formAction;
$is_edit = !empty($editRecord) ? "Edit user" : "Add User";
$edit_data = !empty($editRecord) ? '1' : '';
?>

<div class="main-container">
    <div class="page-container">
      <div class="titlebar">
        <h1 class="orange-clr"><?= $is_edit ?></h1>
        <a class="btn btn-primary pull-right" href="<?= base_url('admin/').$viewname;?>" title="Back">Back</a>  
      </div>
      <!-- add new user start -->
      <form action="<?= base_url().'admin/'.$path; ?>" class="form" method="post" id="<?= $viewname ?>" enctype="multipart/form-data" accept-charset="utf-8">
      <div class="card-block form-container">
        <div class="row">
          <div class="col-md-3 col-sm-4">

            <label class="custom-file" ><!-- "change-picture" class added when uploaded and img as profile picture -->
            <?php if(empty($editRecord)) { ?>
            <img id="uploadPreview1" class="prev-img" src="" width="100" height="100" style="display:none;"/>
            <?php } else { ?>
            <?php if(empty($editRecord[0]['profile_pic'])) { ?>
            <img id="uploadPreview1" class="prev-img" src=""  width="100"  height="100" style="display: none;" />
            
            <?php } else { if(!file_exists($this->config->item('admin_pic_thumb_path').$editRecord[0]['profile_pic'])){ ?>
            <img id="uploadPreview1" class="prev-img" src=""  width="100" style="display: none;"/>
            <?php } else { ?>
            <img id="uploadPreview1" class="prev-img" src="<?=$this->config->item('admin_pic_thumb_url').$editRecord[0]['profile_pic'] ?>"  width="100"  height="100" />
            <?php } } } ?>


            <input type="file" name="profile_pic" id="profile_pic" onchange="showimagepreview(this);  " class="file_input_hidden"/>

            <input class="image_upload" type="hidden" data-bvalidator="extension[jpg:png:jpeg:bmp:gif]" data-bvalidator-msg="Please upload jpg | jpeg | png | bmp | gif file only" name="hiddenFile" id="hiddenFile" value="" />
            <input type="hidden" name="oldfile" id="oldfile" value="<?=(!empty($editRecord[0]['profile_pic'])?$editRecord[0]['profile_pic']:'');?>" />
            <input type="hidden" name="oldfile1" id="oldfile1" value="<?=(!empty($editRecord[0]['profile_pic'])?$editRecord[0]['profile_pic']:'');?>" />

            <span id="delete_btn" style="<?php echo !empty($editRecord) ? empty($editRecord[0]['profile_pic']) ? 'display:none' : '' : 'display:none' ?>"> <a title="Delete Image" class="btn btn-xs btn-primary mar_top_con_my delete_food_div_button1" onclick="return delete_image('<?=!empty($editRecord[0]['id'])?$editRecord[0]['id']:''?>','<?=!empty($editRecord[0]['profile_pic'])?$editRecord[0]['profile_pic']:''?>');"> <i class="fa fa-times"></i> </a></span> 
          </label>
          <p class="instruction">To get best resolution preferred <br>image size is 200 X 200.</p>
        </div>
        <div class="col-md-9 col-sm-8">
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <div class="form-group custom-group">
                <label for="">First Name</label><span style="color:#F00">*</span>
                <input id="first_name" name="first_name" minlength="2" maxlength="100" placeholder="<?= $this->lang->line('common_label_first_name') ?>" class="form-control" type="text"  value="<?php echo!empty(set_value('first_name')) ? set_value('first_name') : (!empty($editRecord[0]['first_name']) ? $editRecord[0]['first_name'] : ''); ?>">
                <?php echo form_error('first_name'); ?>
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="form-group custom-group">
                <label for="">Last Name</label><span style="color:#F00">*</span>
                <input id="last_name" name="last_name" minlength="2" maxlength="100" placeholder="<?= $this->lang->line('common_label_last_name') ?>" class="form-control" type="text"  value="<?php echo!empty(set_value('last_name')) ? set_value('last_name') : (!empty($editRecord[0]['last_name']) ? $editRecord[0]['last_name'] : ''); ?>">
                <?php echo form_error('last_name'); ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <div class="form-group custom-group">
                <label for="">Email</label><span style="color:#F00">*</span>
                <input id="email" placeholder="Email" class="form-control" type="email"   name="email" value="<?php echo!empty(set_value('email')) ? set_value('email') : (!empty($editRecord[0]['email']) ? $editRecord[0]['email'] : ''); ?>" <?= !empty($editRecord) ? 'readonly' : '' ?> >
                <?php echo form_error('Email'); ?>
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="form-group custom-group">
                <label for="">Mobile</label>
                <input id="mobile" name="mobile" maxlength="<?=MOBILE_NO_LENGTH?>" placeholder="<?= $this->lang->line('common_label_mobile') ?>" class="form-control" type="text" value="<?php echo!empty(set_value('mobile')) ? set_value('mobile') : (!empty($editRecord[0]['mobile']) ? $editRecord[0]['mobile'] : ''); ?>" onkeypress="return mobile_valid(event,'mobile')">
              </div>
            </div>
          </div>
          <?php if (empty($editRecord[0]['id'])) { ?>                            
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <div class="form-group custom-group">
                <label for="">Password</label>
                <input id="password" name="password" minlength="6" placeholder="Password" class="form-control" type="password" >
                <?php echo form_error('password'); ?>
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="form-group custom-group">
                <label for="">Confirm Password</label>
                <input type="password" class="form-control" minlength="6" data-equalto="#password" placeholder="Confirm Password" name="npassword" id="npassword" />
                <?php echo form_error('npassword'); ?>
              </div>
            </div>
          </div>
          <?php }  ?> 
          <div class="row">
            <div class="col-md-12 text-right">
              <div class="button-grp">
                <input type="hidden" name="id" id="id" value="<?= (!empty($editRecord)) ? $editRecord[0]['id'] : ""; ?>">
                <?php if(!empty($editRecord)) { ?>
                  <button type="submit" value="submitForm" name="save" class="btn btn-blue">Update</button>
                <?php } else { ?>
                  <button type="submit" value="submitForm" name="save" class="btn btn-blue">Create User</button>
                  <button class="btn btn-gray">Reset</button>
                <?php }?>
              </div>
            </div>
          </div>
        </div>
      </div>
      </form>
    </div>
    <!-- add new user end -->
  </div>
</div>
