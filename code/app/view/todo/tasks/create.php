<?php
$title = 'Task create';
require_once ROOT_DIR . '/models/todo/tasks/TasksModel.php';
ob_start();
?>

<div class="bg-dark h-100">
    <div class="container">
        <h1>Создание задачи</h1>
    </div>
    <form action="/todo/tasks/store" method="post">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required />
        </div>
        <div class="form-group">
            <label for="description">Описание задачи</label>
            <input type="text" class="form-control" id="description" name="description" required />
        </div>
        <div class="form-group">
            <label for="category_id">Категория</label>
            <select class="form-control" name="category_id" id="category_id">
                <?php foreach ($categories as $category): ?>
                <option value="<?=$category['id'] ?>"><?=$category['title']; ?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label for="finish_date">Дата завершения</label>
            <input type="datetime-local" class="form-control" id="finish_date" name="finish_date"/>
        </div>
        <button type="submit" class="btn btn-primary mt-5">Создать задачу</button>
    </form>
</div>



<?php
$content = ob_get_clean();
include ROOT_DIR . '/app/view/layout.php';
?>
