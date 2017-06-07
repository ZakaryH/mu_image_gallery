<?php
include '../admin/config.php';
include '../includes/header.php';
// show potential errors / feedback (from registration object)

?>
<div class="col-md-8 col-md-offset-2">
    <?php 
        if (isset($registration)) {
            if ($registration->errors) {
                echo '<div class="alert alert-danger">';
                foreach ($registration->errors as $error) {
                    echo $error;
                }
                echo '</div>';
            }
            if ($registration->messages) {
                echo '<div class="alert alert-info">';
                foreach ($registration->messages as $message) {
                    echo $message;
                }
                echo '</div>';
            }
        }
     ?>        
    <!-- register form -->
    <form method="post" action="register.php" name="registerform" enctype="multipart/form-data">

        <!-- the user name input field uses a HTML5 pattern check -->
        <div class="form-group">
            <label for="login_input_username">Username (only letters and numbers, 2 to 64 characters)</label>
            <input id="login_input_username" class="form-control" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />
        </div>
        <div class="form-group">
            <input class="inputfile form-control" id="image_file" type="file" name="image_file">
            <label for="image_file"><span>Choose an avatar image</span></label>
        </div>
        
        <div class="form-group">
            <!-- the email input field uses a HTML5 email type check -->
            <label for="login_input_email">User's email</label>
            <input id="login_input_email" class="form-control" type="email" name="user_email" required />
        </div>
        
        <div class="form-group">
            <label for="login_input_password_new">Password (min. 6 characters)</label>
            <input id="login_input_password_new" class="form-control" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
        </div>
        
        <div class="form-group">
            <label for="login_input_password_repeat">Repeat password</label>
            <input id="login_input_password_repeat" class="form-control" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
        </div>
        <input class="btn btn-ig" type="submit"  name="register" value="Register" />

    </form>
    
</div>

<!-- backlink -->
<!-- <a href="index.php">Back to Login Page</a> -->
<?php 
    include '../includes/footer.php';
 ?>