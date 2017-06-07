<?php
// INSERT.PHP
// comment.php?post_id=5

// on index of the blogs include a link using a query sting to choose blog to lookup
// use login script
require_once("../login/classes/Login.php");
$varMessage = '';
$login = new Login();

if ($login->isUserLoggedIn() == true) {
    $user_name = $_SESSION['user_name'];
    $user_id = $_SESSION['user_id'];
} else {
   // echo "not logged in";
	header("Location: ../login/index.php");
	exit();
}


if (isset($_GET['post_id'])) {
	$post_id = $_GET['post_id'];
} else {
	$post_id = '';
}

include("adminheader.php");
echo "<h2>Single Blog Post</h2>";
echo "<strong> You are logged in as: $user_name</strong>"; 
echo "<p><a href='" . $_SERVER['PHP_SELF'] ."?logout'>Logout</a></p>
";

// ---------------------------------------GRAB BLOG DATA
$blog_sql = "SELECT * FROM mubdata
	WHERE blog_id='$post_id'";

$blog_result = mysqli_query($con, $blog_sql) or die(mysqli_error($con));

if (mysqli_num_rows($blog_result) > 0) {
	$blog_data = mysqli_fetch_assoc($blog_result);
} else {
	$blog_data = array(
		"message" => "Invalid ID",
		"title" => "Invalid ID"
		);
}

// -------------------------------------GRAB BLOG DATA
$comment_sql = "SELECT * FROM mubcomments
	JOIN users
	ON mubcomments.commentor_id=users.user_id 
	WHERE post_id='$post_id'";

$comment_result = mysqli_query($con, $comment_sql) or die(mysqli_error($con));

// needs to be added for newer versions of php
if (isset($_POST['submit'])) {
	$comment_body = trim($_POST['comment']);
}
// echo $blogTitle . " | ". $blogEntry;

if(isset($_POST['submit']) && ($comment_body != "")){
	
	$insert_sql = "INSERT INTO mubcomments 
		(comment, commentor_id, post_id) 
		VALUES 
		('$comment_body', 
		'" . $_SESSION['user_id'] . "', 
		'$post_id')";

	$result = mysqli_query($con,$insert_sql);
		if (!$result) {    
			die('Invalid query: ' . mysqli_error($con));
		}else{
	  		echo "<h2>Comment Added to DB\n</h2>". $varMessage;
			
	  }
}


?>
<div class="blogentry	">
	<h3 class="blogtitle"><?php echo $blog_data['title'];?></h3>
	<p class="blogmessage"><?php echo $blog_data['message'];?></p>
	<p class="blogtimedate"><?php echo $blog_data['timedate'];?></p>
</div>
<div class="blogentry">
	<?php 
		if (mysqli_num_rows($comment_result) > 0) {
			while ($row = mysqli_fetch_assoc($comment_result)) {
				echo "<pre class='blogmessage'>" . $row['comment'] . "</pre>";
				echo "<strong>" . $row['user_name'] . "</strong>";
			}
		}
	 ?>
</div>
<!-- comment form -->

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="commentform" id="commentform">
	<p><label for="comment">Comment: </label>
	<textarea name="comment" id="comment"></textarea></p>
	<p>
	<input type="submit" name="submit" id="submit" /></p>
	
</form>
<br style="clear:both" />
<?php
include("adminfooter.php");
?>
