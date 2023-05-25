<?php


$title = 'Role list';
require_once ROOT_DIR . '/models/role/Role.php';
ob_start();

?>
<h1>Список ролей</h1>
<a href="/roles/create" class="btn btn-success">Создать роль</a>
<table class="table  table-dark">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Role name</th>
        <th scope="col">Role description</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($roles as $role): ?>
        <tr>
            <th scope="row"><?php echo $role['id']; ?></th>
            <td><?php echo $role['role_name']; ?></td>
            <td><?php echo $role['role_description']; ?></td>
            <td>
                <a href="/roles/edit/<?=$role['id']?>" class="btn btn-primary">Edit</a>
                <a href="/roles/delete/<?=$role['id']?>" class="btn btn-danger">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();
include ROOT_DIR . '/app/view/layout.php';

?>


