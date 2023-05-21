<?php
$title = 'Edit role';
require_once ROOT_DIR . '/models/role/Role.php';
ob_start();
?>

<div class="bg-dark h-100">
    <div class="container">
        <h1>Редактирование роли</h1>
    </div>
    <form action="/roles/update/<?=$role['id']?>" method="post">
        <input type="hidden" name="id" value="<?=$role['id'] ?>">
        <div class="form-group">
            <label for="role_name">Название роли</label>
            <input type="text" class="form-control" id="role_name" name="role_name" value="<?=$role['role_name'] ?>" required />
        </div>
        <div class="form-group">
            <label for="role_description">Описание роли</label>
            <input type="text" class="form-control" id="role_description" name="role_description" value="<?=$role['role_description'] ?>" required/>
        </div>
        <button type="submit" class="btn btn-primary">Обновить роль</button>
    </form>
</div>



<?php
$content = ob_get_clean();
include ROOT_DIR . '/app/view/layout.php';
?>
