<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $main_title;?></title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="<?php echo base_url() ?>assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>assets/css/animate.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>assets/css/admin.css" rel="stylesheet" type="text/css" />

</head>
<body class="light_theme  fixed_header left_nav_fixed">
<div class="wrapper">
  <!--\\\\\\\ wrapper Start \\\\\\-->
  
 <div class="row">
   
        <?php 
        
		$this->load->view($module.'/'.$view_file);
		
		 ?>
 

  </div>
</div>
<!--\\\\\\\ wrapper end\\\\\\-->
<script src="<?php echo base_url() ?>assets/js/jquery-2.1.0.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/common-script.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.slimscroll.min.js"></script>

</body>
</html>
