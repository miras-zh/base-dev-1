<?php
$title = 'Edit';
require_once ROOT_DIR . '/app/models/User.php';
ob_start();
?>

    <div class="bg-dark h-100">
        <div class="container">
            <h1>Edit User</h1>
        </div>
<!--        <pre>-->
        <?php var_dump($user);?>
<!--        </pre>-->
        <form action="index.php?page=users&action=update&id=<?=$user['id'] ?>" method="post" class="w-50">
            <div class="form-group mt-1">
                <label for="login">Login</label>
                <input type="text" class="form-control" id="login" name="login" value="<?=$user['login']; ?>" required />
            </div>
            <div class="form-group mt-3">
                <label for="admin">Admin</label>
                <select name="admin" id="admin" class="form-control">
                    <option value="0" <?php if(!$user['is_admin']){echo 'selected';}?>>user role</option>
                    <option value="1" <?php if($user['is_admin']){echo 'selected';}?>>admin role</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Save</button>
        </form>
    </div>



<?php
$content = ob_get_clean();
include ROOT_DIR . '/app/view/layout.php';
?>
