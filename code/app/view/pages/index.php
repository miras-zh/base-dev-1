<?php


$title = 'Pages list';
require_once ROOT_DIR . '/app/models/pages/Pages.php';
ob_start();
?>
<h1>Страницы</h1>
<a href="index.php?page=pages&action=create" class="btn btn-success">Создать страницу</a>
<div class="shadow-grey mt-5">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($pages as $page): ?>
            <tr>
                <th scope="row"><?php echo $page['id']; ?></th>
                <td><?php echo $page['title']; ?></td>
                <td><?php echo $page['slug']; ?></td>
                <td>
                    <a href="index.php?page=pages&action=edit&id=<?=$page['id']?>" class="btn btn-primary mx-2">Редактировать</a>
                    <a href="index.php?page=pages&action=delete&id=<?=$page['id']?>" class="btn btn-danger">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
$content = ob_get_clean();
include ROOT_DIR . '/app/view/layout.php';
?>


