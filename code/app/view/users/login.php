<?php
$title = 'Register';
require_once ROOT_DIR . '/app/models/User.php';
ob_start();
?>

<div class="bg-dark h-100">
    <div class="container">
        <h1>Authorization</h1>
    </div>
    <div class="row justify-content-center mt-5 col-lg-6 col-md-8 col-sm-10">
        <form action="index.php?page=auth&action=authenticate" method="post">
            <div class="form-group">
                <label for="email">Email address </label>
                <input type="email" class="form-control" id="email" name="email" required />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required />
            </div>
            <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember"/>
                <label for="remember" class="form-check-label">Remember me</label>
            </div>

            <button type="submit" class="btn btn-primary mt">Sign</button>
        </form>
        <div class="mt-4">
            <p>
                Already don't have an account? <a href="index.php?page=register">Register here</a>
            </p>
        </div>
    </div>
</div>



<?php
$content = ob_get_clean();
include ROOT_DIR . '/app/view/layout.php';
?>
