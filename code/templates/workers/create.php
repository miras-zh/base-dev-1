<?php
$title = 'Worker add';
ob_start();
?>

<div class=" h-100">
    <div class="container">
        <h1>Добавление сотрудника</h1>
    </div>
    <form action="/workers/store" method="post" class="w-50 flex-row justify-content-center">
        <div class="form-group">
            <label for="firstname">Имя</label>
            <input type="text" class="form-control" id="firstname" name="firstname" required />
        </div>
        <div class="form-group">
            <label for="lastname">Фамилие</label>
            <input type="text" class="form-control" id="lastname" name="lastname" required />
        </div>
        <div class="form-group">
            <label for="surname">Отчество</label>
            <input type="text" class="form-control" id="surname" name="surname" />
        </div>
        <div class="form-group">
            <label for="phone">телефон</label>
            <input type="number" class="form-control" id="phone" name="phone" />
        </div>
        <div class="form-group">
            <label for="email">Email address </label>
            <input type="email" class="form-control" id="email" name="email" />
        </div>


        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>



<?php
$content = ob_get_clean();
include ROOT_DIR . '/templates/layout.php';
?>
