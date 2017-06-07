
<!DOCTYPE html>
<html class="no-js">
<head>
	<title>ImageGallery</title>
	<!-- Bootstrap -->
	<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel='shortcut icon' type='image/x-icon' href='/favicon.ico' />
	<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/simplex/bootstrap.min.css" rel="stylesheet" integrity="sha384-C0X5qw1DlkeV0RDunhmi4cUBUkPDTvUqzElcNWm1NI2T4k8tKMZ+wRPQOhZfSJ9N" crossorigin="anonymous">
	<!-- fonts -->
	<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
	<!-- lightbox styles -->
	<link rel="stylesheet" href="<?php echo $config_basedir; ?>assets/js/lightbox2-master/dist/css/lightbox.min.css">
	<!-- Custom styles -->
	<link rel="stylesheet" href="<?php echo $config_basedir; ?>assets/css/style.css">

	<script>
		// removes no-js class from html using JS, pretty clever
		(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);
	</script>
</head>
<body>
	<nav id="top" class="navbar navbar-default">
	  <div class="container">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <a class="navbar-brand" href="<?php echo $config_basedir; ?>">
	    	<span class="glyphicon glyphicon-camera"></span>
	      	ImageGallery
	      	</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	<!--       <ul class="nav navbar-nav navbar-left">

	      </ul> -->

	    	<ul class="nav navbar-nav navbar-right">
<!-- 		        <li><a title="Upload" href="<?php echo $config_basedir; ?>admin/upload.php">
		        	<span class="glyphicon glyphicon-upload"></span>
		        </a></li> -->
	    		<?php
	    			if (isset($_SESSION['SESS_LOGGEDIN'])) {
	    				echo "<li><a title='Upload' href='" . $config_basedir . "admin/upload.php'><span class='glyphicon glyphicon-upload'></span></a></li>";
	    				echo "<li><a title='Manage' href='" . $config_basedir . "admin/list.php'><span class='glyphicon glyphicon-th'></span></a></li>";
	    				echo "<li><a title='Log Out' href='" . $config_basedir . "login/index.php?logout'><span class='glyphicon glyphicon-log-out'></span></a></li>";
	    			} else {
	    				echo "<li><a title='Log In' href='" . $config_basedir . "login/index.php'><span class='glyphicon glyphicon-log-in'></span></a></li>";

	    			}
	    		?>
	    	</ul>
	  </div><!-- /.container-fluid -->
	</nav>

	<div class="container">
		<div class="row">
						
