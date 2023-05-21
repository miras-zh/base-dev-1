<?php
$title = 'Edit';
require_once ROOT_DIR . '/models/user/User.php';
ob_start();
?>

    <div class="bg-dark h-100">
        <div class="container">
            <h1>Edit User</h1>
        </div>
        <form action="/users/update/<?=$user['id'] ?>" method="post" class="w-50">
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
                    <?php foreach ($roles as $role): ?>
                    <option value="<?=$role['id'];?>" <?php echo $user['role']===$role['id'] ? 'selected': '' ;?>><?=$role['role_name'];?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Save changes</button>
        </form>
    </div>



<?php
$content = ob_get_clean();
include ROOT_DIR . '/app/view/layout.php';
?>
