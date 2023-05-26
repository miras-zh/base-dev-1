<?php


$title = 'Company list';
require_once ROOT_DIR . '/models/company/Company.php';
ob_start();
?>
<h1>Компании</h1>
<a href="/companies/create" class="btn btn-success">Создать компанию</a>
<div class="shadow-grey mt-5 mb-4 d-flex flex-row mx-1 p-3 align-items-center">
    <div class="form-group mx-2">
        <label for="company-bin-filter">БИН:</label>
        <input type="text" class="form-control" id="company-bin-filter">
    </div>
    <div class="form-group mx-2">
        <label for="company-name-filter">Наименование:</label>
        <input type="text" class="form-control" id="company-name-filter">
    </div>
    <div class="form-group mx-2">
        <label for="company-region-filter">Регион:</label>
        <input type="text" class="form-control" id="company-region-filter">
    </div>
    <button class="mx-5 btn btn-primary" style="padding: 4px; font-size: 14px; height: 40px">Фильтр</button>
</div>
<div class="shadow-grey">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">БИН</th>
            <th scope="col">Наименование</th>
            <th scope="col">Адрес</th>
            <th scope="col">Телефон</th>
            <th scope="col">Регион</th>
            <th scope="col">Email</th>
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
                <td><?php echo $company['email']; ?></td>
                <td>
                    <a href="/companies/edit/<?=$company['id']?>" class="btn btn-primary mx-2">Редактировать</a>
                    <a href="/companies/delete/<?=$company['id']?>" class="btn btn-danger">Удалить</a>
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


