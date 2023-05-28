
<?php
$title = 'Edit task';
require_once ROOT_DIR . '/models/todo/tasks/TasksModel.php';
ob_start();
?>

<div class="bg-dark h-100">
    <div class="container">
        <h1>Редактирование задачи</h1>
    </div>
    <form action="/todo/tasks/update/<?=$task['id']?>" method="post">
        <input type="hidden" name="id" value="<?=$task['id'] ?>">
        <div class="form-group">
            <label for="title">Название задачи</label>
            <input type="text" class="form-control" id="title" name="title" value="<?=$task['title'] ?>" required />
        </div>
        <div class="form-group">
            <label for="description">Описание категорий</label>
            <input type="text" class="form-control" id="description" name="description" value="<?=$task['description'] ?>" required/>
        </div>
        <div class="form-group mb-4">
            <label for="status">status</label>
            <input type="checkbox" class="form-check-label" id="status" name="status" value="1" <?=$task['status']?'checked':''; ?>/>
        </div>
        <button type="submit" class="btn btn-primary">Обновить категорию</button>
    </form>
</div>



<?php
$content = ob_get_clean();
include ROOT_DIR . '/app/view/layout.php';
?>
