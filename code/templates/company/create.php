<?php
$title = 'User list';
?>

<div class="bg-dark h-100 w-50 mx-auto">
    <div class="container">
        <h1>Добавить компанию</h1>
    </div>
    <form action="/companies/store" method="post">
        <div class="form-group">
            <label for="company_name">Наименование компании</label>
            <input type="text" class="form-control" id="company_name" name="company_name" required />
        </div>
        <div class="form-group">
            <label for="company_bin">БИН Компании</label>
            <input type="number" class="form-control" id="company_bin" name="company_bin" required />
        </div>
        <div class="form-group">
            <label for="region">Регион регистрации</label>
            <input type="text" class="form-control" id="region" name="region" />
        </div>
        <div class="form-group">
            <label for="address">Адрес</label>
            <input type="text" class="form-control" id="address" name="address"  />
        </div>
        <div class="form-group">
            <label for="email">Email адрес </label>
            <input type="email" class="form-control" id="email" name="email"  />
        </div>
        <div class="form-group">
            <label for="phone">Телефон</label>
            <input type="number" class="form-control" id="phone" name="phone"  />
        </div>
        <div class="form-group">
            <label for="otrasl">Отрасль </label>
            <input type="text" class="form-control" id="otrasl" name="otrasl"  />
        </div>

        <button type="submit" class="btn btn-primary mt-3">Добавить компанию</button>
    </form>
</div>


