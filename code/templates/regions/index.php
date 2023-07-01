<?php

/**
 * @var $regions
 */
$title = 'Regions list';
ob_start();

?>
<h1>Список регионов</h1>
<a href="/regions/create" class="btn btn-success">Создать регион</a>
<table class="table  table-dark">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">region name</th>
        <th scope="col">region description</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($regions as $region): ?>
        <tr>
            <th scope="row"><?php echo $region['id']; ?></th>
            <td><?php echo $region['region_name']; ?></td>
            <td><?php echo $region['region_description']; ?></td>
            <td>
                <a href="/regions/edit/<?=$region['id']?>" class="btn btn-primary">Edit</a>
                <a href="/regions/delete/<?=$region['id']?>" class="btn btn-danger">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();
include ROOT_DIR . '/templates/layout.php';

?>


