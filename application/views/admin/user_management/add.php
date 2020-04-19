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
      <form action="<?= base_url().'admin/'.$path; ?>" method="post" id="<?= $viewname ?>" enctype="multipart/form-data">
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
<!-- #content --> 
<script type="text/javascript">
    $('#<?= $viewname ?>').validate({
          onkeyup:false,
          rules: {
              first_name: {
                  required: true,
                  maxlength: 100,
                  minlength: 2,
              },
              last_name: {
                  required: true,
                  maxlength: 100,
                  minlength: 2,
              },
              email: {
                  required: true
              },
              mobile: {
                  maxlength: 10,
                  minlength: 10,
              },
              password : {
                  required: true,
                  minlength : 6
              },
              npassword : {
                  required: true,
                  minlength : 6,
                  equalTo : "#password"
              }
          },
          messages: {
              first_name: {
                  required: 'First Name cannot be blank',
              },
              last_name: {
                  required: 'Last Name cannot be blank',
              },
              email: {
                  required: 'Email cannot be blank',
              },
              state: {
                  required: 'State cannot be blank',
              },
              mobile: {
                  maxlength: "Please enter 10 digit number.",
                  minlength: "Please enter 10 digit number.",
              },
              password : {
                  required: 'Password cannot be blank',
                  minlength : "Please enter minimum 6 digit.",
              },
              npassword : {
                  required: 'Confirm Password cannot be blank',
                  minlength : "Please enter minimum 6 digit.",
                  equalTo : "Confirm password should be match to password"
              }
          }
      });


    function setdefaultdata()
    {
        var flag = 1;
        var email = $('#email').val();
        var user_id = $('#exiting_id').val();

        if ($('#<?php echo $viewname ?>').parsley().isValid()) {
            $.ajax({
                type: "GET",
                url: "<?php echo $this->config->item('admin_base_url') . $viewname . '/check_email'; ?>",
                dataType: 'json',
                async: false,
                data: {'email': email, 'user_id': user_id},
                success: function(data)
                {

                    if (data == false)
                    {
                        $('#email').focus();
                        $('#save').attr('disabled', 'disabled');

                        $.confirm({'title': 'Alert', 'message': " <strong><?= $this->lang->line('existing_email') ?><strong></strong>", 'buttons': {'ok': {'class': 'btn_center alert_ok', 'action': function() {
                                        $('#email').focus();
                                        $('#save').removeAttr('disabled');
                                        $('#email').val('');
                                    }}}});
                        flag = 2;
                    }

                }
            });
        }
        $("#<?php echo $viewname ?>").parsley().destroy();
        $("#<?php echo $viewname ?>").parsley();
        if (flag == 2)
        {
            return false;
        }
        else
        {
            if ($('#<?php echo $viewname ?>').parsley().isValid())
            {
                $.blockUI({message: '<?= '<img src="' . base_url('images') . '/ajaxloader.gif" border="0" align="absmiddle"/>' ?> <?= $this->lang->line('loader_msg_proveedor'); ?>'});
            } else
            {
                $('#<?php echo $viewname ?>').submit();
            }
        }
    }

    var site_url = "<?php echo base_url(); ?>";

    function showimagepreview(input) 
    {
        var arr1    = input.files[0]['name'].split('.');
        var arr     = arr1[arr1.length-1].toLowerCase(); 

        if(arr == 'jpg' || arr == 'jpeg' || arr == 'png' || arr == 'gif')
        {
          var filerdr = new FileReader();
          filerdr.onload = function(e) {
          $('#uploadPreview1').attr('src', e.target.result);
          $('#uploadPreview1').show();
          $('#delete_btn').show();
          };
          filerdr.readAsDataURL(input.files[0]);
        }
        else
        {
          $.confirm({
              'title': 'CONFIRM','message': " <strong> Please upload jpg | jpeg | png | gif file only </strong>",
              'buttons': {
                'Ok': {'class': 'btn_center alert_ok',  
                    'action': function(){
                      $("#profile_pic").val('');
                      $old_image_name = $("#oldfile1").val();
                      if($old_image_name != '')
                      {
                        
                         $("#uploadPreview1").attr("src", "<?=$this->config->item('admin_pic_thumb_url')?>/"+$old_image_name);    
                      }else
                      {
                        $("#uploadPreview1").attr("src", "<?=base_url('images/no_image.jpg')?>");      
                      }

                      
                    }}
               }
          });
          return false;
        } 
    }
    
    function delete_image(id,image) 
    { 
        $.confirm({
        'title': 'DELETE','message': " <strong> <?= $this->lang->line('admin_delete_image_confirm'); ?>",'buttons': {'Yes': {'class': '',
        'action': function(){
            $("#profile_pic").val('');
            $("#uploadPreview1").attr("src", "<?=base_url('images/no_image.jpg')?>");
            $('#uploadPreview1').hide();
            $('#delete_btn').hide();
            $("#oldfile1").val('');
            return false;
        }},'No' : {'class'  : 'special'}}}); 
    }
    
</script>