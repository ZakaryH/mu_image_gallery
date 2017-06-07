<?php
include '../admin/config.php';
include '../includes/header.php';
// show potential errors / feedback (from login object)

?>
<div class="col-md-8 col-md-offset-2">
    <!-- login form box -->
        <?php 
            if (isset($login)) {
                if ($login->errors) {
                    echo '<div class="alert alert-danger">';
                    foreach ($login->errors as $error) {
                        echo $error;
                    }
                }
                if ($login->messages) {
                    echo '<div class="alert alert-info">';
                    foreach ($login->messages as $message) {
                        echo $message;
                    }
                    echo '</div>';
                }
            }
         ?>
    <form method="post" action="index.php" name="loginform">
    
        <div class="form-group">
            <label for="login_input_username">Username</label>
            <input id="login_input_username" class="form-control" type="text" name="user_name" required />
            
        </div>
        <div class="form-group">
            <label for="login_input_password">Password</label>
            <input id="login_input_password" class="form-control" type="password" name="user_password" autocomplete="off" required />
            
        </div>

        <input type="submit" class="btn btn-ig"  name="login" value="Log in" />

    </form>

    <a class="btn btn-ig" href="register.php">Register new account</a>
    
</div>

<?php 
    include '../includes/footer.php';
 ?>