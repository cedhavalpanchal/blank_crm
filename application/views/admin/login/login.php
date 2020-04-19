<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>:: Business CRM admin panel ::</title>
    <meta name="description" content="${2}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="icon.png">

    <link rel="stylesheet" href="<?php echo $this->config->item('css_path') ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('css_path') ?>fonts.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('css_path') ?>main.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('css_path') ?>responsive.css">
</head> 
<body>
<style type="text/css">
form .error {
  color: #ff0000;
}
</style>
<div class="login-section">
    <div class="login-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-5 col-xs-12 col-md-push-8 col-sm-push-7">
                    <div class="login-outer">
                        <div class="text-center"><img src="<?php echo $this->config->item('image_path') ?>/logo.png" alt=""></div>
                        <div id="div_msg">
                            <?php
                            if (null !== ($this->session->flashdata('response')) && false !== $this->session->flashdata('response')) {
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
                                $this->session->unset_userdata('response');
                            }
                            ?>
                        </div>
                        <form action="" method="post" name="registration" class="login-form">
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                            <!--  <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div> -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-blue text-white m-t-20">Login</button>
                            </div>
                        </form>
                        <!-- <div class="text-center">
                            <a href="#" class="forget-psw">Forgot Password?</a>
                            <a href="#" class="reset-psw">Click to reset Password.</a>
                        </div> -->
                    </div>
                </div>
                <div class="col-md-8 col-sm-7 col-xs-12 col-md-pull-4 col-sm-pull-5">
                    <div class="login-text">
                        <h1>Lorem ipsum dolor sit amet, cons ectetur adipisicing elit,</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incid idunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercit ation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
                    </div>
                </div>

            </div>
        </div>
    </div>   
</div>
    <script src="<?php echo $this->config->item('js_path') ?>jquery-3.2.1.min.js"></script>
    <script src="<?php echo $this->config->item('js_path') ?>bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script type="text/javascript">
        // Wait for the DOM to be ready
        $(function() {
          
            $("form[name='registration']").validate({
            
                rules: {
                
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                    }
                },
                messages: {
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    email: "Please enter a valid email address"
                },
            
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });

        $(document).ready(function () {
            setTimeout(function() {
                $('#div_msg').hide('slow');
            }, 5000);
        });
    </script>
</body>
</html>