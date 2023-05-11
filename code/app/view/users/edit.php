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
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?=$user['username']; ?>" required />
            </div>
            <div class="form-group mt-1">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?=$user['email']; ?>" required/>
            </div>
            <div class="form-group mt-3">
                <label for="role">Role:</label>
                <select name="role" id="role" class="form-control">
                    <option value="1" <?php echo $user['role'] ? 'selected': ''; ?>>User</option>
                    <option value="2" <?php echo $user['role'] ? 'selected': ''; ?>>Content creator</option>
                    <option value="3" <?php echo $user['role'] ? 'selected': '' ;?>>Editor</option>
                    <option value="4" <?php echo $user['role'] ? 'selected': '' ;?>>Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Save changes</button>
        </form>
    </div>



<?php
$content = ob_get_clean();
include ROOT_DIR . '/app/view/layout.php';
?>
