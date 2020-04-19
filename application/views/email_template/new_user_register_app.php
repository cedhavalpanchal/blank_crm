<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>
  <?= $this->config->item('sitename'); ?>
  </title>
</head>
<body>
  <div style="width:90%; height:auto; float:left; border:1px solid #27aae1;">
    <div style="width:100%; height:auto; float:left;  border-bottom:1px solid #27aae1;">
      <div style="width:100%; height:auto; float:left;margin:10px; color:#27aae1; font-weight:bold;"> <img width="150px" src="<?= base_url() ?>images/logo.png"/> </div>
    </div >
    <div style="width:100%; height:auto; float:left;">
      <div style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#333; line-height:25px; margin:10px;">
        <p>
          Welcome <?= !empty($actdata['name']) ? ucfirst($actdata['name']) : '' ?>,
          <br>Thanks for signing up.Please click the following link to confirm your email address  & complete your registration:
        </p>
        <a style="background: #ADACAC;border-radius: 5px;padding: 7px 20px;color: #fff;text-decoration: none;
    font-weight: normal;font-family: Arial,Helvetica,sans-serif;font-size: 24px;" href="<?php echo $actdata['verify_link']?>">Confirm My Account</a> 
        <p>If you are unable to view or click the above button, please open the following URL in a browser window to verify: <a href="<?= $actdata['verify_link']?>" target="_blank"><?= $actdata['verify_link']?></a></br> Confirm My Account</p>
      </div>
    </div>
    <div style="width:100%; height:auto; float:left; background:#27aae1;">
      <div style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#fff; font-weight:bold; width:100%; height:auto; line-height:20px;margin:10px;"> Thank you,<br />
        <?= $this->config->item('sitename'); ?>
        <br />
      </div>
    </div >
  </div>
</body>
</html>