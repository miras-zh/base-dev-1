<?php
$title = 'User list';
ob_start();
?>

<div class="bg-dark h-100">
    <div class="container">
        <h1>Create User</h1>
    </div>
    <form action="/users/store" method="post">
        <div class="form-group">
            <label for="username">Login</label>
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
        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required />
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>



<?php
$content = ob_get_clean();
include ROOT_DIR . '/templates/layout.php';
?>
