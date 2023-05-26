<?php
/**
 * @var string $title
 * @var string $content
 * @var array $tasks
 */

$title = 'tasks list';
require_once ROOT_DIR . '/models/todo/tasks/TasksModel.php';
ob_start();

?>
<h1>Список задач</h1>
<a href="/todo/tasks/create" class="btn btn-success">Создать задачу</a>
<table class="table  table-dark">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">title</th>
        <th scope="col">description</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tasks as $task): ?>
        <tr>
            <th scope="row"><?php echo $task['id']; ?></th>
            <td><?php echo $task['title']; ?></td>
            <td><?php echo $task['description']; ?></td>
            <td>
                <a href="/todo/tasks/edit/<?=$task['id']?>" class="btn btn-primary">Edit</a>
                <a href="/todo/tasks/delete/<?=$task['id']?>" class="btn btn-danger">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();
include ROOT_DIR . '/app/view/layout.php';

?>


