<!-- <div class="container">
	<div class="jumbotron">
	  <h1>Instaswole</h1>
	  <p>The #1 place to post all your best gym selfies</p>
	  <p><a class="btn btn-warning btn-lg" href="<?php echo $config_basedir; ?>admin/upload.php" role="button">Upload Now</a></p>
		
	</div>
</div> -->
	<div class="col-md-6 col-md-offset-3 main-posts">
		
<?php
	// make a bunch of posts
	if (isset($_GET['tag'])) {
		$sql = "SELECT * FROM images 
			JOIN users 
			ON images.author_id=users.user_id 
			WHERE p_tags 
			LIKE '%" .$_GET['tag'] ."%' 
			ORDER BY images.date_time DESC";
	} else {
		$sql = "SELECT * FROM images
			JOIN users 
			ON images.author_id=users.user_id 
			ORDER BY images.date_time DESC";
	}
	$result = mysqli_query($connection, $sql);
	$num_rows = mysqli_num_rows($result);



	if ($num_rows == 0) {
		echo "<h2>No posts found</h2>";
	}

	while ($row = mysqli_fetch_array($result)) {

		// ------------------------------------ grab comments
		$comment_sql = "SELECT * FROM image_comments 
			JOIN users 
			ON image_comments.commenter_id=users.user_id 
			WHERE post_id=" . $row['p_id'];

		$comment_result = mysqli_query($connection, $comment_sql) or die(mysqli_error($connection));


		$tags = explode(", ", $row['p_tags']);

		echo "<div class='post-container'>";
		// post heading
		echo "<div class='post-heading'>";
		echo "<img src='uploads/thumbs50/" . $row['user_avatar'] . "' class='user-avatar'>";
		// TODO make a link to a user's page with their posts
		echo "<a href='includes/user.php?id=" . $row['author_id'] ."' class='author-name'>" . $row['user_name'] . "</a>";

		echo "</div>";
		// post body
		// echo "<a href='uploads/display/" . $row['p_img'] . "' data-lightbox='" . $row['p_title'] . "' data-title='" . $row['p_title'] . "'>";
		echo "<a href='includes/viewpost.php?id=" . $row['p_id'] . "'>";
		echo "<img src='uploads/display/" . $row['p_img'] . "' alt='" . $row['p_title'] . "' title='" . $row['p_title'] . "' ></a>";
		// post footer
		echo "<div class='post-footer'>";
		echo "<div class='row'>";
		echo "<div class='col-md-12 post-info'>";
		echo "<a href='includes/user.php?id=" . $row['author_id'] ."' class='author-name'>" . $row['user_name'] . "</a>";
		echo "<span class='post-title'>" . $row['p_title'] . "</span>";
		foreach ($tags as $value) {
			echo "<a class='post-tag' href='" . $config_basedir . "?tag=$value'>#$value</a> ";
		}
		// echo "<span>2</span>";
		// echo "<span>Likes</span>";
		// echo "<div class='post-description'><p>" . $row['p_description'] . "</p></div>";
		echo "</div>";
		// echo "<span class='glyphicon glyphicon-heart'></span>";
		// echo "<div class='col-md-6'>";
		// echo "<a class='float-right' href='" .$config_basedir . "includes/viewpost.php?id=" . $row['p_id'] . "'>View post</a>";
		// echo "<span class='glyphicon glyphicon-picture'></span>";
		// echo "</div>"; // close column
		echo "</div>"; // close row
		if (mysqli_num_rows($comment_result) > 0) {
			echo "<div class='row comments-section'>";
			while ($comment_data = mysqli_fetch_assoc($comment_result)) {
				echo "<div class='col-md-12'>";
				echo "<a href='includes/user.php?id=" . $comment_data['user_id'] . "' class='author-name'>" . $comment_data['user_name'] . "</a>";
				echo "<span>" . $comment_data['comment'];
				echo "</span>";
				echo "</div>";
			}

			echo "</div>"; //close comments row
		}
		echo "</div>"; // close footer
		echo "</div>"; // close post
	}
?>
