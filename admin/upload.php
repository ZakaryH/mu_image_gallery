<?php
	include "config.php";
	include "functions.php";
	include "../includes/header.php";

	if (!isset($_SESSION['SESS_LOGGEDIN'])) {
		// if already logged in, go to the insert page
		header("Location: " . $config_basedir . "login/index.php");
		exit();
	}
	// once form is submitted
	if (isset($_POST['submit'])) {
		$description = mysqli_real_escape_string($connection, $_POST['image_description']);
		$tags = $_POST['image_tags'];
		$target_file = "../uploads/display/". basename($_FILES['image_file']['name']);
		// just storing the filename without a path provides the most
		// flexibility and control
		$upload_file = basename($_FILES['image_file']['name']);
		$uploadStatus = 1;
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
		$error_msg;

		// make sure a file was selected
		if ( $_FILES['image_file']['size'] > 0) {

			$check = getimagesize($_FILES['image_file']['tmp_name']);
			
			// check if it's an image
			if ($check !== false) {
				echo "<p>File is an image - " . $check['mime'] . ".</p>";
				// allows it to proceed later
				$uploadStatus = 1;
			}
			else {
				// not an image
				// echo "<p>File is not an image</p>";
				header("Location:" . $config_basedir . "admin/upload.php?error=filetype");
				exit();
				// $uploadStatus = 0;
			}
		}
		else {
			// no file
			// echo "<p>No file selected</p>";
			header("Location:" . $config_basedir . "admin/upload.php?error=empty");
			exit();
			// $uploadStatus = 0;
		}

		if (empty($_POST['image_name'])) {
			// maybe use a filter here instead
			header("Location:" . $config_basedir . "admin/upload.php?error=noname");
			exit();
		}

		// check if it's a new image
		if (file_exists($target_file)) {
			// echo "<p>File already exists</p>";
			// $uploadStatus = 0;
			header("Location:" . $config_basedir . "admin/upload.php?error=exists");
			exit();
		}

		// file size limit
		if ($_FILES['image_file']['size'] > 1000000) {
			// echo "<p>Your file is too large.</p>";
			// $uploadStatus = 0;
			header("Location:" . $config_basedir . "admin/upload.php?error=size");
			exit();
		}

		// file is in a supported format
		if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
			// echo "<p>File must be of jpg, jpeg, png or gif format.</p>";
			// $uploadStatus = 0;
			header("Location:" . $config_basedir . "admin/upload.php?error=extension");
			exit();
		}

		createThumb($_FILES['image_file']['tmp_name'], "50");
		createThumb($_FILES['image_file']['tmp_name'], "100");
		createThumb($_FILES['image_file']['tmp_name'], "150");
		createThumb($_FILES['image_file']['tmp_name'], "200");
		createThumb($_FILES['image_file']['tmp_name'], "250");



		// kind of redudant - the exits will prevent it from getting here anyways
		// TODO decide which method I like better
		// if ($uploadStatus == 0) {
		// 	echo "<p>Your file was not uploaded.</p>";
		// 	header("Location:" . $config_basedir . "admin/upload.php?error=" . $error_msg);
		// 	exit();
		// } 
		// else {
			// SQL query should go in here as well
			// passed all the checks, try to move the file
			if (move_uploaded_file($_FILES['image_file']['tmp_name'], $target_file)) {


				$file_name = $_POST['image_name'];
				$sql = "INSERT INTO `images` (p_img, p_title, p_description, author_id, p_tags) 
					VALUES ('$upload_file', '$file_name', '$description', " . $_SESSION['user_id'] . " ,'$tags')";
					
				if( !mysqli_query($connection, $sql)) {
					die(mysqli_error($connection));
				}
				// success message
				echo "<p>The file " . basename( $_FILES['image_file']['name']) . " was uploaded.</p>";
				// show the image
				echo "<div class='row text-center'>";
				echo "<img src='../uploads/thumbs200/" . basename( $_FILES['image_file']['name'] ) . "' alt='" . basename( $_FILES['image_file']['name'] ) . "'>";
				echo "</div>";
			}
			else {
				// error message
				echo "<p>An error occured while uploading your file.</p>";
			}
		// }
	}
	else {
		?>
	<div class='col-md-6 col-md-offset-3 image-upload'>
		<div class='panel panel-default'>
			<div class='panel-heading'>
				<h3 class='panel-title'>Upload an Image</h3>
			</div>
			<div class='panel-body'>
				<form class="col-md-12" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<input class="inputfile form-control" id="image_file" type="file" name="image_file">
						<label for="image_file"><span>Choose a file</span></label>
					</div>
					<div class="form-group">
						<label for="image_name">
							Title
						</label>
							<input class="form-control" id='image_name' type="text" name="image_name">
					</div>
					<div class="form-group">
						<label for="image_description">
							Description
						</label>
							<input class="form-control" id='image_description' type="text" name="image_description">
					</div>
					<div class="form-group">
						<label for="image_description">
							Tags
						</label>
							<input class="form-control" id='image_tags' type="text" name="image_tags">
					</div>
					<input class="btn btn-ig" type="submit" value="Upload Image" name="submit">
					<?php
						if (isset($_GET['error'])) {

							// error msg assignment
							switch ($_GET['error']) {
								case 'filetype':
									$error_msg = "File is not an image.";
									break;
									
								case 'empty':
									$error_msg = "No file selected.";
									break;

								case 'size':
									$error_msg = "File exceeds 1Mb size limit.";
									break;
								
								case 'extension':
									$error_msg = "Only jpg, jpeg, png, and gif formats are supported.";
									break;
														
								case 'exists':
									$error_msg = "The file already exists.";
									break;
																
								case 'noname':
									$error_msg = "Please give your image a title.";
									break;
								
								default:
									$error_msg = "An error occured.";
									break;
							}
							// console_log($_GET['error']);
							echo "<div class='error-msg'><strong>" . $error_msg . "</strong></div>";
						}
					?>
				</form>
			</div>
		</div>
	</div>
		<?php
	}

	include "../includes/footer.php";
?>