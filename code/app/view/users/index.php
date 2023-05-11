<?php


$title = 'User list';
require_once ROOT_DIR . '/app/models/User.php';
ob_start();

?>
    <h1>User list</h1>
    <a href="index.php?page=users&action=create" class="btn btn-success">Create User</a>
    <table class="table  table-dark">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Email verification</th>
            <th scope="col">is admin</th>
            <th scope="col">role</th>
            <th scope="col">is active</th>
            <th scope="col">last login</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <th scope="row"><?php echo $user['id']; ?></th>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['email_verification']?'Yes':'No'; ?></td>
                <td><?php echo $user['is_admin'] == 1 ? 'Yes' : 'no'; ?></td>
                <td><?php echo $user['role']; ?></td>
                <td><?php echo $user['is_active']; ?></td>
                <td><?php echo $user['last_login']; ?></td>
                <td>
                    <!--                <a href="index.php?page=users&action=edit&id=-->
                    <?php //echo $user['id'];?><!--" class="btn btn-primary">Edit</a>-->
                    <!--                <a href="index.php?page=users&action=delete&id=-->
                    <?php //echo $user['id'];?><!--" class="btn btn-danger">Delete</a>-->
                    <a href="index.php?page=users&action=edit&id=<?=$user['id']?>" class="btn btn-primary">Edit</a>
                    <a href="index.php?page=users&action=delete&id=<?=$user['id']?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php
$content = ob_get_clean();
include ROOT_DIR . '/app/view/layout.php';


echo '<div class="container border-1 bg-black border-white font-monospace">';
var_dump($users);
echo '</div>';
?>


