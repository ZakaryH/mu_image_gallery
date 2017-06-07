<?php 
	include "config.php";
	include "functions.php";
	include "../includes/header.php";

	if (!isset($_SESSION['SESS_LOGGEDIN'])) {
		// if already logged in, go to the insert page
		header("Location: " . $config_basedir . "login/index.php");
		exit();
	}
	// TODO make sure the image author id matches the current user id

	$id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : $_POST['id'];

	// if ($id !== $_SESSION['user_id']) {
	// 	$id = $_SESSION['user_id'];
	// }

	// prepopulating query
	$sql = "SELECT * FROM images WHERE p_id=$id 
		AND author_id=" . $_SESSION['user_id'];
	$result = mysqli_query($connection, $sql);
	$numrows = mysqli_num_rows($result);

	if ($numrows == 0) {
		$current_description = '';
		$current_title = '';
		$current_file = '';
		$current_tags = '';
		// redirect back to list if tries to edit someone else's pics
		// or if that id doesnt match anything
		header("Location: $config_basedir" . "admin/list.php");
		exit();
	} else {
		$data = mysqli_fetch_assoc($result);
		$current_description = $data['p_description'];
		$current_title = $data['p_title'];
		$current_file = $data['p_img'];
		$current_tags = $data['p_tags'];
	}

	if (isset($_POST['submit'])) {
		// UPDATE query
		// make sure the file isn't empty
		// if it passes validation then make the query
		$new_title = $_POST['image_name'];
		$new_description = $_POST['image_description'];
		$new_tags = $_POST['image_tags'];

		if ( empty($_FILES['image_file']['name']) ) {
			// no new image uploaded
			$new_file = $_POST['existing_image_name'];
		} else {
			// new image upload
			$new_file = basename( $_FILES['image_file']['name'] );
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
					$uploadStatus = 0;
				}
			}
			else {
				// no file
				// echo "<p>No file selected</p>";
				$uploadStatus = 0;
			}

			if (empty($_POST['image_name'])) {
				// maybe use a filter here instead
			}

			// check if it's a new image
			if (file_exists($target_file)) {
				// echo "<p>File already exists</p>";
				$uploadStatus = 0;
			}

			// file size limit
			if ($_FILES['image_file']['size'] > 1000000) {
				// echo "<p>Your file is too large.</p>";
				$uploadStatus = 0;
			}

			// file is in a supported format
			if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
				// echo "<p>File must be of jpg, jpeg, png or gif format.</p>";
				$uploadStatus = 0;
			}

			createThumb($_FILES['image_file']['tmp_name'], "50");
			createThumb($_FILES['image_file']['tmp_name'], "100");
			createThumb($_FILES['image_file']['tmp_name'], "150");
			createThumb($_FILES['image_file']['tmp_name'], "200");
			createThumb($_FILES['image_file']['tmp_name'], "250");
			move_uploaded_file($_FILES['image_file']['tmp_name'], $target_file);

		}
			
		console_log($new_file);
		$updatesql = "UPDATE images SET
			p_img='$new_file',
			p_title='$new_title',
			p_description='$new_description',
			p_tags='$new_tags'
			WHERE p_id=$id";

		if( mysqli_query($connection, $updatesql) ) {
			header("Location: $config_basedir" . "includes/viewpost.php?id=$id");
			exit(); 
		} else {
			die(mysqli_error($connection));
		}
	}
?>
	<div class="col-md-6 col-md-offset-3 edit-single">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Edit a Post</h3>
			</div>
			<div class="panel-body">
				<div class="row text-center">
					<img src="../uploads/thumbs200/<?php echo $current_file; ?>" alt="">
				</div>
				<form class="col-md-12" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="image_name">
							Title
						</label>
							<input autocomplete="off" class="form-control" id='image_name' type="text" name="image_name" value="<?php echo $current_title; ?>">
					</div>
					<div class="form-group">
						<label for="image_description">
							Description
						</label>
							<input autocomplete="off" class="form-control" id='image_description' type="text" name="image_description" value="<?php echo $current_description; ?>">
					</div>
					<div class="form-group">
						<label for="image_tags">
							Tags
						</label>
							<input autocomplete="off" class="form-control" id='image_tags' type="text" name="image_tags" value="<?php echo $current_tags; ?>">
					</div>
					<div class="form-group">
						<input class="inputfile form-control" id="image_file" type="file" name="image_file">
						<label for="image_file"><span>Change File</span></label>
					</div>
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="hidden" name="existing_image_name" value="<?php echo $current_file; ?>">
					<div class="form-group">
						<input class="btn btn-block btn-ig" type="submit" value="Update Post" name="submit">
						<!-- <a href="" class="btn btn-block btn-danger">Change Image</a> -->
					</div>
					<div class="form-group">
						<span class="btn btn-block btn-primary" onclick="confirmDelete(<?php echo $id; ?>);">Delete Post</span>
						
					</div>
				</form>
			</div>
		</div>
	</div>
<?php
	include "../includes/footer.php";
 ?>