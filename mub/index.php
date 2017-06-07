<?php

include("includes/header.php");
session_start();

// $filter =(isset($_GET['filter'])) ? $_GET['filter'] : '';

// need to make sure the filter exists with some validation
if (isset($_GET['filter'])) {
	$filter = $_GET['filter'];
	$query_filter = "WHERE mubdata.author_id = $filter";
} else {
	$query_filter = '';
}


$sql = "SELECT * FROM mubdata 
	JOIN users 
	ON mubdata.author_id=users.user_id 
	$query_filter 
	ORDER BY blog_id 
	DESC";



$result = mysqli_query($con, $sql) or die(mysql_error());

 while($row = mysqli_fetch_array( $result )) {
 	// validation needs to go here in case nothing is found

	   $thisTitle = $row['title'];
	   $thisMessage = nl2br($row['message']);
	   $thisTimeDate =  $row['timedate'];
	   $blog_id =  $row['blog_id'];
	   $author_name = $row['user_name'];
	   $author_email = $row['user_email'];
	   $author_id = $row['user_id'];
	   echo "\n<div class=\"blogentry\">\n";
	   echo "<div class=\"blogtitle\">$thisTitle</div>\n";
		echo "<div class=\"blogmessage\">\n";
		echo  $thisMessage;
		echo "\n</div> <!-- close this message -->\n";
		echo "<div class=\"blogtimedate\">Posted on $thisTimeDate by  $author_name</div>\n";
		if (isset($_SESSION['user_name'])) {
			echo "<div class='blogtimedate'><p>$author_email</p></div>";
		}
		echo "<a href='" . $_SERVER['PHP_SELF'] ."?filter=$author_id'>All Posts by User</a>";
		echo "<div><a href='admin/comment.php?post_id=" . $blog_id ."'>View Post</a></div>";
		
		echo "</div> <!-- close this entry -->\n";
	
	}// close loop for outside query

include("includes/footer.php");

?>