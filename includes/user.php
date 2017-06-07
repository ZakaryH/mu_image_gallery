<?php 
	include "../admin/config.php";
	include "header.php";

	// this only works if there's images, otherwise it can't find where to join
	// might need an initial query to find the name and if theres images
	if (isset($_GET['id'])) {
		$sql = "SELECT * FROM users 
			LEFT JOIN images 
			ON users.user_id=images.author_id  
			WHERE user_id=" . $_GET['id'];

		$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
		$num_rows = mysqli_num_rows($result);
		$all_rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
	} else {
		// no id in query string
		header("Location: $config_basedir");
		exit();
	}

	if ( ($num_rows == 0) || (is_null( $all_rows[0]['p_img']) ) ) {
		$has_pics = false;
	} else {
		$has_pics = true;
	}
 ?>
<div class="col-md-10 col-md-offset-1 user-album">
	<div class="album-header row">
		<div class="col-md-3">
			<img src="../uploads/thumbs150/<?php echo $all_rows[0]['user_avatar']; ?>" class="user-avatar" alt="">
		</div>
		<div class="col-md-9">
			<h3 class="album-user-name">
				<?php  echo $all_rows[0]['user_name']; ?>
			</h3>
			<div class="user-post-count">
				<span>
				<?php
				if ($has_pics) {
					echo "<b>$num_rows</b> posts"; 
				 } else {
				 	echo "<b>No posts</b>";
				 } 
				?>
				</span>
			</div>
			
		</div>
	</div>
	<div class="albums-container">
		<div class="row">
			<?php 
				if ($has_pics) {
					foreach ($all_rows as $key => $row) {
						echo "<div class='col-md-4'>";
						// echo "<img src='../uploads/thumbs200/" . $row['p_img'] . "'>";
						echo "<a href='../uploads/display/" . $row['p_img'] . "' data-lightbox='" . $row['p_title'] . "' data-title='" . $row['p_title'] . "'>";
						echo "<img src='../uploads/thumbs200/" . $row['p_img'] . "' alt='" . $row['p_title'] . "' title='" . $row['p_title'] . "' ></a>";
						echo "</div>";
					}
				}
			 ?>
		</div>
	</div>
</div>
<?php 

	include "footer.php";
 ?>