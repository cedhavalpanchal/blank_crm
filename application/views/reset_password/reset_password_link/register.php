<?php
/*
    @Description: Template add/edit page
    @Author: Mit Makwana
    @Date: 25-11-2016

*/?>

<?php 
$viewname = $this->router->uri->segments[1];
if(!empty($this->router->uri->segments[5]))
	$tabid = $this->router->uri->segments[5];
else
	$tabid = 1;
	
$formAction = !empty($editRecord)?'update_data':'insert_data'; 
if(isset($insert_data))
{
$formAction ='insert_data'; 
}
$path = $viewname.'/'.$formAction;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$this->config->item('sitename');?></title>
</head>

<body>
<div style="width:90%; height:auto; float:left; border:1px solid #00b050; ">

<div style="width:100%; height:auto; float:left; border-bottom:#00b050 solid 2px;  background: #00b050 none repeat scroll 0 0;">
<div style="width:100%; height:auto; float:left;margin:10px; color:#fff; font-weight:bold;">
<h1 id="site-logo"><img src="<?php echo $this->config->item('base_url');?>images/tops-infosolutions.svg" alt="<?=$this->config->item('sitename')?>" /></h1>
</div ><!--close logo-->
</div ><!--top head-->



<div style="width:100%; height:auto; float:left; ;">
<div style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#333; line-height:15px; text-align:justify; margin:10px;">
    <p>Hello <?=!empty($actdata['name'])?ucwords($actdata['name']):''?>,</p>
                  
<p>You have successfully redister with <?=$this->config->item('sitename')?> account.</p><p><a href="<?=$actdata['loginLink'];?>">Click here</a> to Login with your credentials.</p>
			
</div><!--close peregraph content-->

</div><!--close left side-->


<div style="width:100%; height:auto; float:left; background:#00b050; ">
<div style="font-family:Verdana, Geneva, sans-serif; font-size:10.5px; color:#fff; font-weight:bold; width:100%; height:auto; line-height:20px;margin:10px;">
Thank you,<br />
<?=$this->config->item('sitename');?><br />

</div><!--close title-->
</div ><!--top title-->


</div><!--close main div-->
</body>
</html>
