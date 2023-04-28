<?php
$title = 'User list';
require_once ROOT_DIR . '/app/models/User.php';
ob_start();
?>

<div class="bg-dark h-100">
    <div class="container">
        <h1>Create User</h1>
    </div>
    <form action="" method="post">
        <div class="form-group">
            <label for="login">Login</label>
            <input type="text" class="form-control" id="login" name="login" required />
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required />
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required />
        </div>
        <div class="form-group">
            <label for="admin">Admin</label>
            <select name="admin" id="admin" class="form-control">
                <option value="0">no</option>
                <option value="1">yes</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>



<?php
$content = ob_get_clean();
include ROOT_DIR . '/app/view/layout.php';
?>
