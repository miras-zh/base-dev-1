<?php
$title = 'Role list';
require_once ROOT_DIR . '/app/models/role/Role.php';
ob_start();
?>

<div class="bg-dark h-100">
    <div class="container">
        <h1>Create Role</h1>
    </div>
    <form action="index.php?page=roles&action=store" method="post">
        <div class="form-group">
            <label for="rolename">Role</label>
            <input type="text" class="form-control" id="rolename" name="role_name" required />
        </div>
        <div class="form-group">
            <label for="role_description">Role description </label>
            <input type="text" class="form-control" id="role_description" name="role_description" required />
        </div>
        <button type="submit" class="btn btn-primary mt-5">Create role</button>
    </form>
</div>



<?php
$content = ob_get_clean();
include ROOT_DIR . '/app/view/layout.php';
?>
