<?php
$title = 'Region list';
require_once ROOT_DIR . '/models/regions/RegionsModel.php';
ob_start();
?>

<div class="bg-dark h-100">
    <div class="container">
        <h1>Создание региона</h1>
    </div>
    <form action="/regions/store" method="post">
        <div class="form-group">
            <label for="region_name">Наименование региона</label>
            <input type="text" class="form-control" id="region_name" name="region_name" required />
        </div>
        <div class="form-group">
            <label for="region_description">Описание региона </label>
            <input type="text" class="form-control" id="region_description" name="region_description" required />
        </div>
        <button type="submit" class="btn btn-primary mt-5">Создать регион</button>
    </form>
</div>



<?php
$content = ob_get_clean();
include ROOT_DIR . '/app/view/layout.php';
?>
