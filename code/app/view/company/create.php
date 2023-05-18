<?php
$title = 'User list';
require_once ROOT_DIR . '/app/models/company/Company.php';
ob_start();
?>

<div class="bg-dark h-100 w-50 mx-auto">
    <div class="container">
        <h1>Добавить компанию</h1>
    </div>
    <form action="index.php?page=companies&action=store" method="post">
        <div class="form-group">
            <label for="company_name">Наименование компании</label>
            <input type="text" class="form-control" id="company_name" name="company_name" required />
        </div>
        <div class="form-group">
            <label for="company_bin">БИН Компании</label>
            <input type="number" class="form-control" id="company_bin" name="company_bin" required />
        </div>
        <div class="form-group">
            <label for="company_bin">Регион регистрации</label>
            <input type="text" class="form-control" id="company_bin" name="region" required />
        </div>
        <div class="form-group">
            <label for="address">Адрес</label>
            <input type="text" class="form-control" id="address" name="address" required />
        </div>
        <div class="form-group">
            <label for="email">Email адрес </label>
            <input type="email" class="form-control" id="email" name="email" required />
        </div>
        <div class="form-group">
            <label for="phone">Телефон</label>
            <input type="number" class="form-control" id="phone" name="phone" required />
        </div>
        <div class="form-group">
            <label for="otrasl">Отрасль </label>
            <input type="text" class="form-control" id="otrasl" name="otrasl" required />
        </div>

        <button type="submit" class="btn btn-primary mt-3">Добавить компанию</button>
    </form>
</div>



<?php
$content = ob_get_clean();
include ROOT_DIR . '/app/view/layout.php';
?>
