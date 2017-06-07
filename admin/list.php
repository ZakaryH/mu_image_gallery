<?php 
	include "config.php";
	include "../includes/header.php";

	if (!isset($_SESSION['SESS_LOGGEDIN'])) {
		// if already logged in, go to the insert page
		header("Location: " . $config_basedir . "login/index.php");
		exit();
	}
	$sql = "SELECT * FROM images 
		WHERE author_id=" . $_SESSION['user_id'];
	$result = mysqli_query($connection, $sql);
	$numrows = mysqli_num_rows($result);
?>
<div class="panel manage-images col-md-8 col-md-offset-2">
	<div class="panel-body">
		<h3 class="text-center">Edit an Image</h3>
		<?php 
			if ($numrows ==0) {
				echo "<h2>No images found</h2>";
			} else {
				while ($row = mysqli_fetch_assoc($result)) {
					// TODO put thumbnails here
					echo "<div class='col-md-4 col-sm-6 text-center'>";
					echo "<a href='" . $config_basedir . "admin/edit.php?id=" . $row['p_id'] . "'>";
					echo "<img src='../uploads/thumbs200/" . $row['p_img'] . "'>";
					echo "</a>";
					echo "</div>";
				}
			}
		 ?>
	</div>
</div>
<?php
	include "../includes/footer.php";
 ?>