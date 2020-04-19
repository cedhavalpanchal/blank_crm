<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Verify your email address - Alamaaree APP</title>
<style>
.main { margin: 0 auto; width: 30%; padding-top: 150px; }

@media screen and (max-width: 767px) {
.main { width: 300px; padding-top: 50px; }
}
</style>
</head>

<body style="margin:0px; padding:0px; background:#ffffff; font-family:Arial;">
<div class="main">
  <table class="em_wrapper" align="center" border="0" cellpadding="0" cellspacing="0" style="padding:15px;width:100%;">
    <tbody>
      <tr>
        <td align="center" style="border-bottom:#ccc dotted 1px; padding-bottom:20px;"><a href="#"><img width="150px" src="<?= base_url('images/tops-infosolutions.svg') ?>"/></a></td>
      </tr>
      <tr>
        <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; text-align:left; padding-top:30px;" align="center" valign="top"> Hello <?=!empty($first_name) ? ucfirst($first_name) : ' ' ?> <?=!empty($last_name) ? ucfirst($last_name) : ' ' ?>,</td>
      </tr>
      <tr>
        <td style="line-height:0px; font-size:0px;" height="16">&nbsp;</td>
      </tr>
      <?php 
        if(!empty($flag) && $flag == 'success')
        {
      ?>
          <tr>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:22px; color:#349180; text-align:left;" align="center" valign="top"><?= !empty($message) ? $message : ''?></td>
          </tr>
      <?php 
        }
        elseif(!empty($flag) && $flag == 'fail')
        {
        ?>
          <tr>
            <td style="font-family:Arial, Helvetica, sans-serif; font-size:22px; color:#a32727; text-align:left;" align="center" valign="top"><?= !empty($message) ? $message : ''?></td>
          </tr>
        <?php 
        }
      ?>
      <tr>
        <td style="line-height:0px; font-size:0px;" height="16">&nbsp;</td>
      </tr>
    </tbody>
  </table>
</div>
</body>
</html>

<script type="text/javascript">
  setTimeout("window.close()", 5000);
</script>