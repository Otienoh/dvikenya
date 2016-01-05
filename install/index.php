<?php

error_reporting(0); //Setting this to E_ALL showed that that cause of not redirecting were few blank lines added in some php files.

$db_config_path = '../application/config/database.php';

// Only load the classes in case the user submitted the form
if($_POST) {

	// Load the classes and create the new objects
	require_once('includes/core_class.php');
	require_once('includes/database_class.php');

	$core = new Core();
	$database = new Database();


	// Validate the post data
	if($core->validate_post($_POST) == true)
	{

		// First create the database, then create tables, then write config file
		if($database->create_database($_POST) == false) {
			$message = $core->show_message('error',"The database could not be created, please verify your settings.");
		} else if ($database->create_tables($_POST) == false) {
			$message = $core->show_message('error',"The database tables could not be created, please verify your settings.");
		} else if ($core->write_config($_POST) == false) {
			$message = $core->show_message('error',"The database configuration file could not be written, please chmod application/config/database.php file to 777");
		}

		// If no errors, redirect to registration page
		if(!isset($message)) {
		  $redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
      $redir .= "://".$_SERVER['HTTP_HOST'];
      $redir .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
      $redir = str_replace('install/','',$redir); 
			header( 'Location: ' . $redir . '' ) ;
		}

	}
	else {
		$message = $core->show_message('error','Not all fields have been filled in correctly. The host, username, password, and database name are required.');
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Install | DVI KENYA</title>
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <link href="../assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/animate.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/admin.css" rel="stylesheet" type="text/css" />
  </head>
  <style>
.lock_content {
    margin: 18px auto 0px;
    position: relative;
    text-align: center;
    width: 600px;
    border: 2px solid #CCC;
    border-radius: 5px;
    padding: 20px;
    background-color: #FFF;
}
  </style>
  <body class="light_theme  fixed_header left_nav_fixed">
    <div class="wrapper">
     <div class="lock_page">
      <div class="lock_content">
       <?php if(is_writable($db_config_path)){?>

		  <?php if(isset($message)) {echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>' . $message . ' </b></div>';}?>
<h2>Initial Setup</h2>
      <div class="lock_image"><img src="../assets/images/coat_of_arms.png" alt="lock" /><br><b>Database Configurations</b></div>	
        
         <form id="install_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" role="form" class="form-horizontal">
          <div class="form-group">

            <div class="col-sm-10">
              <input type="text" id="hostname" value="localhost" autocomplete="off" placeholder="Enter Database Hostname" class="form-control" name="hostname" />
            </div>
          </div>
          <div class="form-group">

            <div class="col-sm-10">
              <input type="text" id="username" class="form-control" autocomplete="off" placeholder="Enter Database User" name="username" />
            </div>
          </div>
          <div class="form-group">

            <div class="col-sm-10">
              <input type="password" id="password"  placeholder="Enter Database Password" class="form-control" name="password" />
            </div>
          </div>
          <div class="form-group">

            <div class="col-sm-10">
              <input type="text" id="database" autocomplete="off" placeholder="Enter Database Name" class="form-control" name="database" />
            </div>
          </div>
          <div class="form-group">
            <div class=" col-sm-10">
              <div class="checkbox checkbox_margin">

                  <button type="submit" id="submit" class="btn btn-danger btn-icon pull-right"> Install <i class="fa fa-cog"></i> </button>
                </div>
              </div>
            </div>
<?php } else { ?>
<div class="alert alert-success fade in">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
 <strong>Oh snap!</strong> Please make the application/config/database.php file writable. <strong>Example</strong>:<br /><code>chmod 777 application/config/database.php</code> 
 </div>
<?php } ?>


          </form>
          <p class="red_text"><em>Please delete the install directory after setup.</em></p>
        </div>
  </div> 
</div>
<script src="../assets/js/jquery-2.1.0.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/common-script.js"></script>
<script src="../assets/js/jquery.slimscroll.min.js"></script>
</body>
</html>
