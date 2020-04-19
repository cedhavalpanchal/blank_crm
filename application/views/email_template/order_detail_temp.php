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
        
          <table width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#333;"> 
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;"> Hello <?= !empty($seller_name) ? ucfirst($seller_name) : ''  ?>,</td>
            </tr>
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;"></td>
            </tr>
            
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;"></td>
            </tr>
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;">Your Product <?= !empty($product_name) ? ucfirst($product_name) : ''  ?> has been Perchased by <?= !empty($buyer_name) ? ucfirst($buyer_name) : ''  ?></td>
            </tr>
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:18px; color:#333; color: #ffffff; background-color:#444444; padding-left:10px; border-radius:5px;">Order Detail</td>
            </tr>
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;">Order number:&nbsp;<?= !empty($order_number) ? ucfirst($order_number) : ''  ?></td>
            </tr>
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;">Transaction Id: &nbsp;<?= !empty($transaction_id) ? ucfirst($transaction_id) : ''  ?></td>
            </tr>
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;">User Name: &nbsp; <?= !empty($buyer_name) ? ucfirst($buyer_name) : ''  ?></td>
            </tr>
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;">User Email: &nbsp; <?= !empty($buyer_email) ? ucfirst($buyer_email) : ''  ?></td>
            </tr>
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;">Paypal Email: &nbsp; <?= !empty($paypal_email) ? ucfirst($paypal_email) : ''  ?></td>
            </tr>
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;">Delivery  Address: &nbsp; <?= !empty($delivery_address) ? ucfirst($delivery_address) : ''  ?></td>
            </tr>
          </table>
        
        
          <table width="100%" style="border-bottom:solid 1px; border-radius:0px; padding: 5px 0px 5px 10px; font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#797D7F;"> 
            <tr>
              <th style="font-family:Verdana, Geneva, sans-serif; font-size:15px; color:#333; float: left;">Product Detail :</th>
            </tr>
            <tr>
              <td style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;">&nbsp;</td>
            </tr>
            <tr>
              <th style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333; text-align: left;">Image</th>
              <th style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333; text-align: left;">Product</th>
              <th style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333; text-align: left;">Price </th>
              <th style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333; text-align: left;">Quantity </th>
            </tr>
            <tr>
              <td style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#333; text-align: left;"><img id="image_preview_" title="Image" class="img-responsive" src="<?php echo $image_url.$product_image;?>" style="width:80px !important;height:80px !important"></td>
              <td style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#333; text-align: left;"><?= !empty($product_name) ? ucfirst($product_name) : ''  ?></td>
              <td style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#333; text-align: left;"><?= !empty($price) ? ucfirst($price) : ''  ?></td>
              <td style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#333; text-align: left;"><?= !empty($qty) ? ucfirst($qty) : ''  ?> </td>
            </tr>
            <tr>
                <td style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#333;">&nbsp;</td>
                <td style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#333;">&nbsp;</td>
                <th style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#333; text-align: left;">Total Price</td>
                <th style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#333; text-align: left;"><?= !empty($total_price) ? ucfirst($total_price) : ''  ?></td>
            </tr>
          </table>
          
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
