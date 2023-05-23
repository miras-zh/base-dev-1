<?php
$title = 'Register';
require_once ROOT_DIR . '/models/user/User.php';
ob_start();
?>

<div class="bg-dark h-100">
    <div class="container">
        <h1>Register User</h1>
    </div>
    <div class="row justify-content-center mt-5 col-lg-6 col-md-8 col-sm-10">
        <form action="/auth/store" method="post">
            <div class="form-group">
                <label for="username">User name</label>
                <input type="text" class="form-control" id="username" name="username" required />
            </div>
            <div class="form-group">
                <label for="email">Email address </label>
                <input type="email" class="form-control" id="email" name="email" required />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required />
            </div>
            <div class="form-group mb-2">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required />
            </div>
            <button type="submit" class="btn btn-primary mt">Register</button>
        </form>
        <div class="mt-4">
            <p>
                Already have an account? <a href="/auth/login">Login here</a>
            </p>
        </div>
    </div>
</div>



<?php
$content = ob_get_clean();
include ROOT_DIR . '/app/view/layout.php';
?>
