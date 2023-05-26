<?php
/**
 * @var string $title
 * @var string $content
 * @var array $categories
 */

$title = 'category list';
require_once ROOT_DIR . '/models/todo/category/TodoCategoryModel.php';
ob_start();

?>
<h1>Список todo категорий</h1>
<a href="/todo/category/create" class="btn btn-success">Создать категорию</a>
<table class="table  table-dark">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">title</th>
        <th scope="col">description</th>
        <th scope="col">usability</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($categories as $cat): ?>
        <tr>
            <th scope="row"><?php echo $cat['id']; ?></th>
            <td><?php echo $cat['title']; ?></td>
            <td><?php echo $cat['description']; ?></td>
            <td><?php echo $cat['usability']==1?'yes':'no'; ?></td>
            <td>
                <a href="/todo/category/edit/<?=$cat['id']?>" class="btn btn-primary">Edit</a>
                <a href="/todo/category/delete/<?=$cat['id']?>" class="btn btn-danger">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();
include ROOT_DIR . '/app/view/layout.php';

?>


