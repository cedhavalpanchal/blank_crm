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
          <table width="100%" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#333;"> 
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;"> Hello <?= !empty($issueData['full_name']) ? ucfirst($issueData['full_name']) : ''  ?>,</td>
            </tr>
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;"></td>
            </tr>
            
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;"></td>
            </tr>
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-weight: 900; font-size:14px; color:#333; ">Admin comment</td>
            </tr>
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;"><?= !empty($issueData['comment']) ? $issueData['comment'] : ''  ?></td>
            </tr>
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:18px; color:#333; color: #ffffff; background-color:#444444; padding-left:10px; border-radius:5px;">Reported issue number: <?= !empty($issueData['issue_id']) ? $issueData['issue_id'] : ''  ?> </td>
            </tr>
          </table>
        </p>
        <p>
          <table width="100%" style="border-top:solid 1px; border-bottom:solid 1px; border-radius:0px; padding: 5px 0px 5px 10px; font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#797D7F;"> 
            
            <tr>
              <td><?=$this->lang->line('issue_type')?> : </td>
              <td>
                <?php 
                    if($issueData['issue_type'] == 1)
                        echo $type_msg = "Location";
                    elseif($issueData['issue_type'] == 2)
                        echo $type_msg = "Damage";   
                    elseif($issueData['issue_type'] == 3)
                        echo $type_msg = "Technical issue";   
                    elseif($issueData['issue_type'] == 4)
                        echo $type_msg = "Stolen";   
                    elseif($issueData['issue_type'] == 5)
                        echo $type_msg = "Missing";   
                    elseif($issueData['issue_type'] == 6)
                        echo $type_msg = "Other";   
                ?>
              </td>
            </tr>
            <tr>
              <td><?=$this->lang->line('order_no')?> : </td>
              <td><?= !empty($issueData['order_id']) ? convert_order_id($issueData['order_id']) : ''  ?> </td>
            </tr>
            <tr>
              <td><?=$this->lang->line('common_label_desc')?> : </td>
              <td><?= !empty($issueData['description']) ? $issueData['description'] : ''  ?></td>
            </tr>
            <tr>
              <td><?=$this->lang->line('report_time')?> : </td>
              <td>
                <?= !empty($issueData['created_date'])?systemDateTime($issueData['created_date']):''; ?>
              </td>
            </tr>
            
          </table>
          
        </p>
        
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
