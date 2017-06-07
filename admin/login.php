<?php 
	include "config.php";
	include "../includes/header.php";

	if (isset($_SESSION['SESS_LOGGEDIN'])) {
		// if already logged in, go to the insert page
		header("Location: upload.php");
		exit();
	}
	// form submitted
	if (isset($_POST['submit'])) {
		// input values
		$username = $_POST['username'];
		$pass = $_POST['password'];

		// valid login credenials
		$login_info = array(
			'admin' => 'passvord' 
			);

		// only bother to check the password if the username is right
		if ( $login_info[$username] ) {
			// check password value for the username against input
			if  ( $login_info[ $username ] == $pass ) {
				// sucessful login, set session vars
				$_SESSION[ 'SESS_USERNAME' ] = $username;
				$_SESSION[ 'SESS_ADMLOGGEDIN' ] = true;
				$_SESSION[ 'SESS_LOGGEDIN' ] = true;
				// redirect
				header( "Location: $config_basedir");
				exit();
			} else {
				// unsucessful - right username, wrong password
				header("Location:" . $_SERVER['PHP_SELF'] . "?error=1");
				exit();
			}
			
		} else {
			// unsucessful - wrong username
			header("Location:" . $_SERVER['PHP_SELF'] . "?error=1");
			exit();
		}
	} else {
	?>
		<!-- display the form -->
<section class="login col-md-6 col-md-offset-3">
	
				<form class="horizontal-form" method="POST" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
					<fieldset>
					  <h2>Log In</h2>
					  <?php 
					  if ( isset( $_GET['error'] ) ) { 
					  	echo "<strong>Incorrect username/password</strong>";
					   } ?>
					   <div class="form-group">
						  <label for="username">
						  	Username
						  </label>
						  	<input class="form-control" autocomplete="off" type="text" id="username" name="username">
					   	
					   </div>
					  <div class="form-group">
						  <label for="password">
						  	Password
						  </label>
						  	<input class="form-control" type="password" name="password" id="password">
					  	
					  </div>
					  	<div class="form-group">
						  <input class="btn btn-info" type="submit" name="submit" value="Submit">
					  		
					  	</div>
			      </fieldset>
				</form>
</section>
	<?php
	}
	include "../includes/footer.php";
 ?>