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
          <table width="70%" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#333;"> 
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;"> Welcome <?= !empty($partnerData['full_name']) ? ucfirst($partnerData['full_name']) : ''  ?>,</td>
            </tr>
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;"></td>
            </tr>
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;">You have been added as a employee of <?= $this->config->item('sitename')?>. </td>
            </tr>
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;"></td>
            </tr>
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;">Your account informations are as below, </td>
            </tr>
          </table>
          <table width="40%" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#333;"> 
            <tr>
              <td>Email : </td>
              <td><?= !empty($partnerData['email_id']) ? $partnerData['email_id'] : ''  ?> </td>
            </tr>
            <tr>
              <td>Password : </td>
              <td><?= !empty($partnerData['password']) ? $partnerData['password'] : ''  ?> </td>
            </tr>
          </table>
          <br>Please click the following link to login:
        </p>
        <a style="background: #67B4A6;border-radius: 5px;padding: 5px 10px;color: #fff;text-decoration: none;
    font-weight: normal;font-family: Arial,Helvetica,sans-serif;font-size: 20px;" href="<?php echo $login_link?>">Login here</a> 
        <p>&nbsp;</p>
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
