<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo ucwords(!empty($this->page_title)?$this->page_title:$this->config->item('project_name')); ?></title>

<!-- Favicon Icon -->
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/icon">


<link href="<?php echo $this->config->item('css_path'); ?>bootstrap.css" rel="stylesheet">
<link href="<?php echo $this->config->item('front_css_path'); ?>main.css" rel="stylesheet" type="text/css">


</head>
<body>
<div class="main">




<div class="container text-center" style="min-height: 400px">
  <h3>Welcome to <?php echo $this->config->item('project_name') ?> Term and Condition</h3>
  	<?php 
  		if(!empty($cms_details[0]['description']))
  		{
  			echo $cms_details[0]['description'];
  		}
  		else
  		{
  			?>
  				<h3>No Term and Condition Found</h3>
  			<?php 
  		}
  	?>
</div>


<div class="footer" id="footer">
  <div class="container">
    <div class="row pull-right">
    <p></p>
    </div>
  </div>
</div>
</body>
</html>
    