<?php
$title = 'Category list';
ob_start();
?>

<div class="bg-dark h-100">
    <div class="container">
        <h1>Создание категорий</h1>
    </div>
    <form action="/todo/category/store" method="post">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required />
        </div>
        <div class="form-group">
            <label for="description">Описание категорий</label>
            <input type="text" class="form-control" id="description" name="description" required />
        </div>
        <button type="submit" class="btn btn-primary mt-5">Создать категорию</button>
    </form>
</div>



<?php
$content = ob_get_clean();
include ROOT_DIR . '/templates/layout.php';
?>
