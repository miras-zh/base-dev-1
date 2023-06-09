<?php
/**
 * @var array $companies
 * @var string $content
 */

$title = 'Company list';
require_once ROOT_DIR . '/models/company/Company.php';
require_once ROOT_DIR . '/controllers/company/CompanyController.php';
ob_start();
?>
<div class="flex-row d-flex w-100 justify-content-between">
    <div><h1>Компании</h1></div>
    <div>
        <a href="/companies/create" class="btn" style="background: #3b8ad0; color: whitesmoke"><i class="bi bi-plus-square-fill mx-1"></i>Создать компанию</a>
    </div>
</div>
<div class="shadow-grey mt-1 mb-2 mx-1 p-3 align-items-center">
    <form action="/companies" method="post" class="d-flex flex-row">
        <div class="form-group mx-2">
            <label for="company_bin_filter">БИН:</label>
            <input type="text" class="form-control" id="company_bin_filter" name="company_bin_filter"
                   value="<?= $valueBin ?>">
        </div>
        <div class="form-group mx-2">
            <label for="company_name_filter">Наименование:</label>
            <input type="text" class="form-control" id="company_name_filter" name="company_name_filter"
                   value="<?= $valueName ?>">
        </div>
        <div class="form-group mx-2">
            <label for="company_region_filter">Регион:</label>
            <input type="text" class="form-control" id="company_region_filter" name="company_region_filter"
                   value="<?= $valueRegion ?>">
        </div>
        <button type="submit" class="mx-5 mt-3 btn" style="padding: 4px; font-size: 14px; height: 40px;background: #818080; color: whitesmoke">Фильтр
        </button>
    </form>
</div>
<div class="my-1 px-1 d-flex flex-row mb-2">
    <?php
    $companyModel = new \models\company\Company();
    $totalAmount = $companyModel->getCompaniesNumber();
    $totalPage = ceil($totalAmount / 5);

    echo "<a class='btn border-white mx-1' style='cursor:pointer;background: #494d4d; color: whitesmoke' href='/companies'>all</a>";
    for ($btn = 1; $btn <= $totalPage; $btn++) {
        echo "<a class='btn border-white mx-1' style='cursor:pointer;background: #494d4d; color: whitesmoke' href='/companies?page=$btn'>$btn</a>";
    }
    ?>
</div>
<div class="shadow-grey">
    <table class="table">
        <thead style='background: #494d4d; color: whitesmoke'>
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
        <tbody style="background: #313131">
        <?php foreach ($companies as $company): ?>
            <tr>
                <th scope="row"><?php echo $company['id']; ?></th>
                <td ><?php echo $company['company_bin']; ?></td>
                <td style="max-width: 230px"><?php echo $company['company_name']; ?></td>
                <td><?php echo $company['address']; ?></td>
                <td style="max-width: 100px"><?php echo $company['phone']; ?></td>
                <td><?php echo $company['region']; ?></td>
                <td><?php echo $company['email']; ?></td>
                <td>
                    <a href="/companies/edit/<?= $company['id'] ?>" class="btn mx-2" style='background: #494d4d; color: whitesmoke'>
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <a href="/companies/delete/<?= $company['id'] ?>" class="btn" style='background: #494d4d; color: whitesmoke'>
                        <i class="bi bi-trash3-fill"></i>
                    </a>
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


