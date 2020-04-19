<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Automated Inspection</title>
<style>

body{margin:0px; padding:0px; background:url(<?= base_url() . 'images/mailer_image/splash-image.png' ?>) no-repeat fixed center top / cover ; }
h1 { margin: 0; padding: 0; font-family:Arial, Helvetica, sans-serif; font-size:20px; line-height:25px; color:#575757; }
.information{font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:25px; color:#575757; text-align:left;  border: 1px solid #ccc; 
padding:5px;}

@media only screen and (min-width:481px) and (max-width:599px) {
table[class="em_main_table"] { width: 100% !important; text-align: center !important; }
table[class="em_wrapper"] { width: 100% !important; }
td[class="em_spacer"] { width: 10px !important; }
td[class="em_title"] { font-size: 24px !important; line-height: 36px !important; }
td[class="em_hide"], table[class="em_hide"], span[class="em_hide"], br[class="em_hide"] { display: none !important; width: 0px; max-height: 0px; overflow: hidden; }
img[class="em_full_img"] { width: 100% !important; height: auto !important; }
img[class="em_full_img1"] { width: 45% !important; height: auto !important; }
img[class="em_full_img1"] { width: 37% !important; height: auto !important; text-align:center }
td[class="em_txt_center"] { text-align: center !important; }
}

/*Stylesheed for the devices width between 0px to 480px*/
@media only screen and (max-width:480px) {
table[class="em_main_table"] { width: 100% !important; background-image: none !important; }
table[class="em_wrapper"] { width: 100% !important; }
td[class="em_spacer"] { width: 10px !important; }
td[class="em_hide"], table[class="em_hide"], span[class="em_hide"], br[class="em_hide"] { display: none !important; width: 0px; max-height: 0px; overflow: hidden; }

img[class="em_full_img1"] { width: 45% !important; height: auto !important; }
img[class="em_full_img1"] { width: 37% !important; height: auto !important; text-align:center !important; }
td[class="em_title"] { font-size: 20px !important; line-height: 36px !important; }
td[class="em_height"] { height: 30px !important; }
td[class="em_txt_center"] { text-align: center !important; }
}
</style>

</head>
<?php
$site_name = $this->config->item('sitename');
?>
<body>
<table align="center"  border="0" cellpadding="0" cellspacing="0" width="100%">
<!--first row-->
<tbody>
<tr>
<td align="center" valign="top">
<table class="em_main_table" style="   border-top: 5px solid #f9b81f; margin:auto;background-color:#ffffff;" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
<!--first row-->
<tbody>
<tr>
<td align="left" bgcolor="#1F2533" valign="top">
<table class="em_main_table" align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="600">
<tbody>

<tr>
<td style="background:#F1F1F1;" align="center" bgcolor="#F1F1F1" valign="top">
    <table class="em_main_table" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tbody><tr>

                <td align="center" valign="top">
                    <table class="em_wrapper" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                        <tbody><tr>
                                <td align="left" valign="top">
                                    <table class="em_wrapper" align="left" border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#f1f1f1">
                                        <tbody>
                                            <tr>
                                                <td style="line-height:0px; font-size:0px;" height="15">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                 <td align="center" valign="top"><a target="_blank" href="<?= base_url() ?>">
                                                    <img alt="<?= $this->config->item('sitename'); ?>" src="<?= !empty($this->site_info[0]['site_logo']) && file_exists($this->config->item('image_site_logo') . $this->site_info[0]['site_logo']) ? $this->config->item('image_site_logo_url') . $this->site_info[0]['site_logo'] : $this->config->item('base_url') . 'images/tops-infosolutions.svg' ?>" class="em_full_img" /></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="line-height:0px; font-size:0px;" height="15">&nbsp;</td>
                                            </tr>
                                        </tbody></table> 
                                </td>
                            </tr>
                        </tbody></table>
                </td> 
            </tr>
        </tbody></table>  
</td>
</tr> 
<!---->               
<tr>
<td style="background:#ffffff;" align="left" bgcolor="#ffffff" valign="top">
    <table class="em_main_table" align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border:1px solid #f1f1f1;">
        <tbody>


            <tr>
                <td style="background:#ffffff;" align="center" bgcolor="#ffffff" valign="top">
                    <table class="em_main_table" align="center" border="0" cellpadding="0" cellspacing="0" width="598">
                        <tbody><tr>

                                <td style="line-height:0px; font-size:0px; width:10px;" align="left" valign="top" width="10"></td>
                                <td align="center" valign="top">
                                    <table class="em_wrapper" align="center" border="0" cellpadding="0" cellspacing="0" width="540">
                                        <tbody>
                                            <tr>
                                                <td style="line-height:0px; font-size:0px;" height="20">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="top">

                                                    <table width="98%" border="0" align="left" cellpadding="8" cellspacing="2">
                                                        <tbody class="information" bgcolor="#f5f5f5 ">


                                                            <tr>
                                                                <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; background: #fff !important;" valign="top">
                                                                    Hello <?= !empty($actdata['name']) ? $actdata['name'] . ',' : '' ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; background: #fff !important;" valign="top">
                                                                    You have requested to reset password for <?= $this->config->item('sitename') ?> account.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; background: #fff !important;" valign="top">
                                                                    <a href="<?= $actdata['loginLink']; ?>">Click here</a> to Reset Password.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#575757; background: #fff !important;" valign="top">
                                                                    Thank you,
                                                                    <br>
                                                                    <?= $this->config->item('sitename'); ?>
                                                                    </br>
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td> 

                            </tr>

                        </tbody></table>  
                </td>
            </tr>
        </tbody></table>
</td>
</tr>

<tr>

</tr>

<tr>
</tr>
<tr>
<td style="line-height:0px; font-size:0px; background:#f1f1f1;" height="1" bgcolor="f1f1f1"></td>
</tr>


<tr>
<td style="line-height:0px; font-size:0px;" height="10">&nbsp;</td>
</tr>

<tr>
<td class="em_txt_center" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#323232; text-align:center;" align="center" valign="top">Copyright © <?= date('Y'); ?> <?= !empty($site_name) ? $site_name : '' ?> . All rights reserved.</td>                              
</tr>
<tr>
<td style="line-height:0px; font-size:0px;" height="20">&nbsp;</td>
</tr>

</tbody></table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</body>
</html>
