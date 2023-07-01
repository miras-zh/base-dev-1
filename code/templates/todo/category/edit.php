<?php
$title = 'Edit role';
ob_start();
?>

<div class="bg-dark h-100">
    <div class="container">
        <h1>Редактирование категорий</h1>
    </div>
    <form action="/todo/category/update/<?=$category['id']?>" method="post">
        <input type="hidden" name="id" value="<?=$category['id'] ?>">
        <div class="form-group">
            <label for="title">Название категорий</label>
            <input type="text" class="form-control" id="title" name="title" value="<?=$category['title'] ?>" required />
        </div>
        <div class="form-group">
            <label for="description">Описание категорий</label>
            <input type="text" class="form-control" id="description" name="description" value="<?=$category['description'] ?>" required/>
        </div>
        <div class="form-group mb-4">
            <label for="usability">usability</label>
            <input type="checkbox" class="form-check-label" id="usability" name="usability" value="1" <?=$category['usability']?'checked':''; ?>/>
        </div>
        <button type="submit" class="btn btn-primary">Обновить категорию</button>
    </form>
</div>



<?php
$content = ob_get_clean();
include ROOT_DIR . '/templates/layout.php';
?>
