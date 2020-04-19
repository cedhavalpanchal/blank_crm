<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?= $this->config->item('sitename'); ?></title>
    </head>
    <body>
        <div style="width:90%; height:auto; float:left; border:1px solid #27aae1;">

            <div style="width:100%; height:auto; float:left;  background:#FFFFFF;border-bottom:1px solid #27aae1;">
                <div style="width:100%; height:auto; float:left;margin:10px; color:#0a579f; font-weight:bold;">
                    <img width="150px" src="<?= base_url() ?>images/logo.jpg"/>
                </div>
            </div>
            <div style="width:100%; height:auto; float:left; ;">
                <div style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#333; line-height:25px; text-align:justify; margin:10px;">
                    <p>Hello <?= !empty($actdata['name']) ? $actdata['name'] : '' ?>,</p>
                    <p> You have requested to reset password for <?= $this->config->item('sitename') ?> account.</p>
                    <!-- <p> Email: <a name="test"><?= $actdata['email']; ?></a></p> -->
                    <p> <a href="<?= $actdata['loginLink']; ?>">Click here</a> to Reset Password.</p>
                    
                </div>
            </div>
            <div style="width:100%; height:auto; float:left; background:#27aae1; ">
                <div style="font-family:Verdana, Geneva, sans-serif; font-size:10.5px; color:#fff; font-weight:bold; width:100%; height:auto; line-height:20px;margin:10px;">
                    Thank you,<br />
                    <?= $this->config->item('sitename'); ?><br />
                </div>
               </div >
        </div>
    </body>
</html>
