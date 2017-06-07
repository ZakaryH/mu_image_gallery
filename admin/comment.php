<?php
	include "config.php";

	if ( !isset($_SESSION['SESS_LOGGEDIN']) ) { 
		header("Location:" . $config_basedir);
		exit();
	}

	if (isset($_POST['comment'])) {
		$comment_body = trim($_POST['comment']);
	}


	if ( isset($_POST['post']) && ($comment_body !== '')) {
		$insert_sql = "INSERT INTO image_comments 
		(comment, commenter_id, post_id) 
		VALUES 
		('$comment_body', 
		'" . $_SESSION['user_id'] . "', 
		'" . $_POST['post'] . "')";

		$insert_result = mysqli_query($connection, $insert_sql) or die(mysqli_error($connection));
		echo "<div class='comment'><a href='user.php?id='" . $_SESSION['user_id'] . "' class='author-name'>" . $_SESSION['user_name'] . "</a><span>" . $comment_body . "</span></div>";
	} else {
		echo "Comment cannot be empty";
	}

echo $_POST['comment'];
echo $_POST['post'];