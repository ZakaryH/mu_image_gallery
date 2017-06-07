<?php 
	include "../admin/config.php";
	include "header.php";
?>
	<div class="col-md-8 col-md-offset-2 individual-post">
<?php
	

		// SQL for single display
		$sql = "SELECT * FROM images 
			JOIN users 
			ON images.author_id = users.user_id 
			WHERE p_id =" . $_GET['id'];
		$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
		$numrows = mysqli_num_rows($result);


		if ($numrows == 0) {
			echo "<h2>No data for this id</h2>";
		} else {
			// single display row data
			$data = mysqli_fetch_assoc($result);

			$tags = explode(", ", $data['p_tags']);
			// SQL for previous
			$prev_sql = "SELECT * FROM images
				WHERE p_id < " . $data['p_id'] . "
				ORDER BY p_id
				DESC LIMIT 1";
			$prev_result = mysqli_query($connection, $prev_sql);
			$prev_data = mysqli_fetch_assoc($prev_result);

			// SQL to check for FIRST AKA no "prev" option
			$first_sql = "SELECT * FROM images ORDER BY p_id ASC LIMIT 1";
			$first_result = mysqli_query($connection, $first_sql);
			$first_data = mysqli_fetch_assoc($first_result);

			// SQL for next
			$next_sql = "SELECT * FROM images
				WHERE p_id > " . $data['p_id'] . "
				ORDER BY p_id
				ASC LIMIT 1";
			$next_result = mysqli_query($connection, $next_sql);
			$next_data = mysqli_fetch_assoc($next_result);

			// SQL to check for LAST AKA no "next" option
			$last_sql = "SELECT * FROM images ORDER BY p_id DESC LIMIT 1";
			$last_result = mysqli_query($connection, $last_sql);
			$last_data = mysqli_fetch_assoc($last_result);

			// output/display code
			echo "<h2>" . $data['p_title'] . "</h2>";
			echo "<div class='row'>";
			echo "<div class='col-md-12 image-controls'>";
			if ($data['p_id'] !== $first_data['p_id']) {
				echo "<a class='btn btn-ig' href='" . $config_basedir . "includes/viewpost.php?id=" . $prev_data['p_id'] . "'><span class='glyphicon glyphicon-chevron-left'></span>Previous</a>";
			}
			if ($data['p_id'] !== $last_data['p_id']) {
				echo "<a class='btn btn-ig float-right' href='" . $config_basedir . "includes/viewpost.php?id=" . $next_data['p_id'] . "'>Next<span class='glyphicon glyphicon-chevron-right'></span></a>";
			}
			echo "</div>";
			echo "</div>";
			echo "<img src='../uploads/display/" . $data['p_img'] . "'>";
			echo "<a href='user.php?id=" . $data['author_id'] . "' class='author-name'>" . $data['user_name'] . "</a>";
			echo "<p class='post-description'>" . $data['p_description'] . " ";
			
			// linked tags
			foreach ($tags as $value) {
				echo "<a href='" . $config_basedir ."?tag=$value'>#$value </a>";
			}
			echo "</p>";
			// $exif = exif_read_data('../uploads/' . $data['p_img'], 0, true);
			// echo "test2.jpg:<br />\n";
			// foreach ($exif as $key => $section) {
			//     foreach ($section as $name => $val) {
			//         echo "$key.$name: $val<br />\n";
			//     }
			// }
		}
		// -----------------------------------------------------Get comments
		$comment_sql = "SELECT * FROM image_comments 
			JOIN users 
			ON image_comments.commenter_id=users.user_id 
			WHERE post_id=" . $data['p_id'];
		$comment_result = mysqli_query($connection, $comment_sql) or die(mysqli_error($connection));
		$comment_num_rows = mysqli_num_rows($comment_result);

		if ($comment_num_rows > 0) {
			echo "<div class='post-comments-section'>";
			while ($comment_data = mysqli_fetch_assoc($comment_result)) {
				echo "<div class='comment'>";
				echo "<a href='user.php?id=" . $comment_data['commenter_id'] . "' class='author-name'>" . $comment_data['user_name'] . "</a>";
				echo "<span>" . $comment_data['comment'] . "</span>";
				echo "</div>";
			}
			echo "</div>";
		}

	

	if ( (isset($_GET['id'])) && isset($_SESSION['SESS_LOGGEDIN']) ) {
?>
		<div class="post-comment">
			<form name="commentform" id="commentform" postid="<?php echo $data['p_id']; ?>">
				<div class="form-group">
					<label for="comment">Comment</label>
					<textarea class="form-control" name="comment" id="comment"></textarea>
				</div>
				<input type="submit" name="submit" value="Post Comment" class="btn btn-ig">
			</form>
		</div>
	</div>
<?php
}
	include "footer.php";
 ?>