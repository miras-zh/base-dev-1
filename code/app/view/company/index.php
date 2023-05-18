<?php


$title = 'Company list';
require_once ROOT_DIR . '/app/models/company/Company.php';
ob_start();
?>
<h1>Компании</h1>
<a href="index.php?page=companies&action=create" class="btn btn-success">Создать компанию</a>
<div class="shadow-grey mt-5">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">БИН</th>
            <th scope="col">Наименование</th>
            <th scope="col">Адрес</th>
            <th scope="col">Телефон</th>
            <th scope="col">Регион</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($companies as $company): ?>
            <tr>
                <th scope="row"><?php echo $company['id']; ?></th>
                <td><?php echo $company['company_bin']; ?></td>
                <td><?php echo $company['company_name']; ?></td>
                <td><?php echo $company['address']; ?></td>
                <td><?php echo $company['phone']; ?></td>
                <td><?php echo $company['region']; ?></td>
                <td>
                    <a href="index.php?page=companies&action=edit&id=<?=$company['id']?>" class="btn btn-primary mx-2">Редактировать</a>
                    <a href="index.php?page=companies&action=delete&id=<?=$company['id']?>" class="btn btn-danger">Удалить</a>
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


