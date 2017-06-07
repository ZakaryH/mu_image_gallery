<?php
	session_start();
	// reminder to change main.js location
	// change the basedir here too

	$connection = mysqli_connect("localhost", "username", "password", "dbname");
	$config_basedir = "http://localhost/mu_image_gallery/";

	function console_log( $data ){
	  echo '<script>';
	  echo 'console.log('. json_encode( $data ) .')';
	  echo '</script>';
	}


	// sql injection defense for POST
	foreach ($_POST as $key => $value) {
		$_POST[$key] = mysqli_real_escape_string($connection, $value);
	}

	// sql injection defense for GET
	foreach ($_GET as $key => $value) {
		$_GET[$key] = mysqli_real_escape_string($connection, $value);
	}

?>