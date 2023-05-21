<?php
$title = 'Role list';
require_once ROOT_DIR . '/models/role/Role.php';
ob_start();
?>

<div class="bg-dark h-100">
    <div class="container">
        <h1>Создание роли пользователей</h1>
    </div>
    <form action="/roles/store" method="post">
        <div class="form-group">
            <label for="rolename">Роли пользователей</label>
            <input type="text" class="form-control" id="rolename" name="role_name" required />
        </div>
        <div class="form-group">
            <label for="role_description">Описание роли </label>
            <input type="text" class="form-control" id="role_description" name="role_description" required />
        </div>
        <button type="submit" class="btn btn-primary mt-5">Создать роль</button>
    </form>
</div>



<?php
$content = ob_get_clean();
include ROOT_DIR . '/app/view/layout.php';
?>
