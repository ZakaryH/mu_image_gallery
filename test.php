<?php 

/*****************
This file demo's how you can include the Login script and test whether or not the user has logged in.
Also, we can get the User ID.

***********************/



require_once('login/classes/Login.php'); // must path to the Login class

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

/*echo "<pre>";
print_r($_SESSION);
echo "</pre>";*/

// ... ask if we are logged in here:

if ($login->isUserLoggedIn() == true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
    echo "Logged in as ". ($_SESSION['user_name']) . " -  ID is ". ($_SESSION['user_id']);
	

} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
   echo "not logged in";

}


?>