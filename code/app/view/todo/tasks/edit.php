
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
            <label for="description">Описание задачи</label>
            <input type="text" class="form-control" id="description" name="description" value="<?=$task['description'] ?>" required/>
        </div>
        <div class="form-group mt-3">
            <label for="role">Status:</label>
            <select name="role" id="role" class="form-control">
                <?php foreach (['new','in_progress','completed','on_hold','canceled'] as $item): ?>
                    <option value="<?=$item;?>" <?php echo $item===$task['status'] ? 'selected': '' ;?>><?=$item;?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="role">Категория:</label>
            <select name="role" id="role" class="form-control">
                <?php foreach ($categories as $category): ?>
                    <option value="<?=$category['id'];?>" <?php echo $task['category_id']===$category['id'] ? 'selected': '' ;?>><?=$category['title'];?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="finish_date">Дата завершения</label>
            <input type="datetime-local" class="form-control" id="finish_date" name="finish_date"/>
        </div>
        <button type="submit" class="btn btn-primary">Обновить категорию</button>
    </form>
</div>



<?php
$content = ob_get_clean();
include ROOT_DIR . '/app/view/layout.php';
?>
