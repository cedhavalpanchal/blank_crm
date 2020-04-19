<?php /*
  @Description: Template add/edit page
  @Author: Mit Makwana
  @Date: 25-11-2016

 */ ?>
<?php
$viewname = $this->router->uri->segments[2];
$id = $this->router->uri->segments[3];
?>
<body class="login">
    <div id="wrapper">
        <div id="login-container">
            <div id="login">
                <div id="logo"> 
                    <img alt="Admin" src="<?=$this->config->item('base_url') . 'images/logo.jpg'?>"> 
                </div>
                <?php
                    if(!empty($is_forgot_password) && $is_forgot_password == '1')
                    {
                        ?>
                        <h3><?= $this->lang->line('reset_password'); ?></h3>
                        <?php 
                    } 
                ?>
                <!-- <h5>Please sign in to get access.</h5> -->
                <div id="div_msg">
                    <?php if (null !== ($this->session->flashdata('response')) && false !==$this->session->flashdata('response')) {
                        $flash = $this->session->flashdata('response');
                        if ($flash['status'] === 'failed') {
                            ?>
                            <div class="alert alert-danger">
                                <a href="javascript:void(0)" class="close close-message" aria-label="close" title="Close">&times;</a>
                                <?php echo $flash['message']; ?>
                            </div>
                        <?php } else { ?>
                            <div class="alert alert-success">
                                <a href="javascript:void(0)" class="close close-message" aria-label="close" title="Close">&times;</a>
                                <?php echo $flash['message']; ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

                <?php
                $flash = $this->session->flashdata('response');
                if(!empty($is_forgot_password) && $is_forgot_password == '1')
                {
                    ?>
                    <form class="form parsley-form" id="login-form" enctype="multipart/form-data" name="<?php echo $viewname; ?>" method="post" accept-charset="utf-8" action="<?php echo $this->config->item('base_url') . 'reset_password_mobile/change_password'; ?>" novalidate >
                        <div class="form-group">
                            <label for="login-username"><?= $this->lang->line('new_password'); ?></label>
                            <input id="txt_npassword" placeholder="<?= $this->lang->line('new_password'); ?>*" name="txt_npassword" class="form-control parsley-validated" type="password" data-required="true" data-type="passwordcheck">
                        </div>
                        <div class="form-group">
                            <label for="login-password"><?= $this->lang->line('new_co_password'); ?></label>
                            <input id="txt_cpassword" data-minlength="7" placeholder="<?= $this->lang->line('new_co_password'); ?>*" name="txt_cpassword" class="form-control parsley-validated" type="password" data-equalto="#txt_npassword" data-required="true">
                        </div>
                        <div class="form-group">
                            <input id="hiddan" name="id" type="hidden" value="<?= !empty($id) ? $id : ''; ?>" >
                            <button  type="submit" class="btn btn-primary btn-block" >Save</button>
                            
                        </div>
                    </form>
                    <?php
                }
                else // if($flash['is_expired'] != '1')
                {
                    ?>
                    <h3><?= $this->lang->line('link_expired'); ?></h3>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>

    
<script type="text/javascript">

    function CheckPassword(inputtxt)
    {
        var decimal=/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{7,15}$/;

        if(String(inputtxt).match(decimal))
        {
            //alert('Correct, try another...')
            //return true;
        }
        else
        {
            $.confirm({'title': 'Alert', 'message': "<strong><?= $this->lang->line('pass_validation_msg'); ?></strong>", 'buttons': {'ok': {'class': 'btn_center'}}});
            $('#txt_npassword').val('');
            return false;
        }
    }

     function reset_password()
        {
            
            var id = '<?php echo $this->uri->segment(4); ?>';
            var pass = $("#txt_npassword").val();
            if ($("#txt_npassword").val().trim() != '')
            {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() . 'reset_password/' . $viewname ?>/reset_password",
                    data: {
                        result_type: 'ajax', email_id: $("#email_to").val()
                    },
                    beforeSend: function() {
                        $('#home').block({message: 'Loading...'});
                    },
                    success: function(html) {
                        $(".com_div").html(html);
                        $('#home').unblock();
                    }
                });
            }
            else
            {
                $('.parsley-form').submit();
            }
            
        }

    $(document).ready(function () {
        setTimeout(function() {
            $('#div_msg').hide('slow');
        }, 5000);
    });

    $(document).on('click', '.close-message', function () {
        $('#div_msg').hide('slow');
    });

    </script>
