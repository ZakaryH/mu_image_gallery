<?php 
// session_start();
include "config.php";


if (!isset($_SESSION['SESS_LOGGEDIN'])) {
	// if not logged in, redirect
	header("Location: $config_basedir");
	exit();
}
// make sure the thing we're trying to delete exists
$sql1 = "SELECT * FROM images WHERE p_id = " . htmlspecialchars( $_GET['id'] );
$result1 = mysqli_query($connection, $sql1) or die(mysqli_error($connection));
// $result1 = $mysqli->query($sql1) or die($mysqli->error);
// $numrows = $result1->num_rows;
$numrows = mysqli_num_rows($result1);

// not found
if ($numrows == 0) {
	header("Location:$config_basedir");
	exit();
} else {
	$row = mysqli_fetch_assoc($result1);
	// TODO optimize this with a loop or function?
	// delete ALL the images from uploads
	unlink("../uploads/display/" . $row['p_img']);
	unlink("../uploads/thumbs50/" . $row['p_img']);
	unlink("../uploads/thumbs100/" . $row['p_img']);
	unlink("../uploads/thumbs150/" . $row['p_img']);
	unlink("../uploads/thumbs200/" . $row['p_img']);
	// remove the data from the table for that image
	$sql2 = "DELETE FROM images WHERE p_id = " . htmlspecialchars( $_GET['id'] );
	if ( mysqli_query($connection, $sql2) ) {
		header("Location:$config_basedir" . "?success=delete");
		exit();
	} else {
		die(mysqli_error($connection));
	}
}
 ?>
