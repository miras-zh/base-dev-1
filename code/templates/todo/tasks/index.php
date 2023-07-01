<?php
/**
 * @var string $title
 * @var string $content
 * @var array $tasks
 */

$title = 'tasks list';
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
        <th scope="col">status</th>
        <th scope="col">category</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tasks as $task): ?>
        <tr>
            <th scope="row"><?php echo $task['id']; ?></th>
            <td><?php echo $task['title']; ?></td>
            <td><?php echo $task['description']; ?></td>
            <td><?php echo $task['status']; ?></td>
            <td><?php echo $task['category_id']; ?></td>
            <td>
                <a href="/todo/tasks/edit/<?= $task['id'] ?>" class="btn btn-primary">Edit</a>
                <a href="/todo/tasks/delete/<?= $task['id'] ?>" class="btn btn-danger">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class="container">
    <?php foreach ($tasks as $task): ?>
        <div class="accordion mb-2" id="accordionTask">
            <div class="accordion-item w-50 " style="background: #504c4c; color: whitesmoke;">
                <h2 class="accordion-header w-100" id="heading<?= $task['id'] ?>">
                    <button class="accordion-button w-100 mx-auto"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#<?= $task['id'] ?>"
                            aria-expanded="true"
                            aria-controls="<?= $task['id'] ?>"
                            style="background: #262626; color: whitesmoke;"
                    >
                        <span style="margin-right: 4px; font-size: 12px;"><?=$task['id'] ?></span>
                        <i class="bi bi-list-task mx-2" style="color: #5ad03e"></i>
                        <span class="col-4"><?= $task['title'] ?></span>
                        <span class="col-4 finish-date"><i
                                    class="bi bi-stopwatch" style="color: #5ad03e"></i><?= $task['finish_date'] ?></span>
                    </button>
                </h2>
                <div id="<?= $task['id'] ?>" class="accordion-collapse collapse"
                     aria-labelledby="heading<?= $task['id'] ?>"
                     data-bs-parent="#accordionTask"
                >
                    <div class="accordion-body">
                        <strong>This is the first item's accordion body.</strong>
                        <span><?= $task['category_id'] ?></span>
                        <span><?= $task['created_at'] ?></span>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php
$content = ob_get_clean();
include ROOT_DIR . '/templates/layout.php';

?>

<script>
    const valueTime = document.querySelector('.finish-date');
    console.log('valueElement:', valueTime)
</script>