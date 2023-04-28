<?php


$title = 'User list';
require_once ROOT_DIR . '/app/models/User.php';
ob_start();

?>
    <h1>User list</h1>
    <a href="#" class="btn btn-success">Create User</a>
    <table class="table  table-dark">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Login</th>
            <th scope="col">Admin</th>
            <th scope="col">Created</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <th scope="row"><?php echo $user['id']; ?></th>
                <td><?php echo $user['login']; ?></td>
                <td><?php echo $user['is_admin']; ?></td>
                <td><?php echo $user['created_at']; ?></td>
                <td>
                    <!--                <a href="index.php?page=users&action=edit&id=-->
                    <?php //echo $user['id'];?><!--" class="btn btn-primary">Edit</a>-->
                    <!--                <a href="index.php?page=users&action=delete&id=-->
                    <?php //echo $user['id'];?><!--" class="btn btn-danger">Delete</a>-->
                    <a href="#" class="btn btn-primary">Edit</a>
                    <a href="#" class="btn btn-danger">Delete</a>
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


