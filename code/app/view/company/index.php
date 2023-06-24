<?php
/**
 * @var array $companies
 * @var string $content
 */
$limits = ['5','10','20','30','50','100'];
$title = 'Company list';
$currentPage =isset($_GET['page'])?(int)$_GET['page'] : 1;
require_once ROOT_DIR . '/models/company/Company.php';
require_once ROOT_DIR . '/controllers/company/CompanyController.php';
ob_start();
?>

<div class="w-100" style="margin-top: 80px;overflow-x: scroll;">
    <div class="flex-row d-flex w-100 justify-content-between">
        <div><h4>Список компании</h4></div>
        <div>
            <a href="/companies/create" class="btn" style="background: #3b8ad0; color: whitesmoke"><i class="bi bi-plus-square-fill mx-1"></i>Создать компанию</a>
        </div>
    </div>
    <div class="shadow-grey mt-1 mb-2 mx-1 p-3 align-items-center" style="background: #2c3c4c!important;">
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
    <div class="d-flex flex-row mt-4 mb-3">
        <div class="form-group d-flex flex-row align-items-center mr-10" style="width: 120px;">
            <label class="w-50" for="count">строки:</label>
            <select name="count" id="count" class="form-control w-50 count-row-table" onchange="handleValue()">
                <?php foreach ($limits as $item): ?>
<!--                    <?php //echo $item===(string)$_GET['count'] ? 'selected': '';?>-->
                    <option value="<?=$item;?>">
                        <?php $currentPage =isset($_GET['page'])?(int)$_GET['page'] : 1; echo "<a href='/companies?page=$currentPage&count=$item'>$item</a>";?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="my-1 px-1 d-flex flex-row mb-2 flex-wrap">
            <?php
            $companyModel = new \models\company\Company();
            $totalAmount = $companyModel->getCompaniesNumber();
            $count = (int)($_GET['count'] ?? 30);
            $totalPage = ceil($totalAmount / $count);
            $currentPage =isset($_GET['page'])?(int)$_GET['page'] : 1;


            echo "<a class='btn border-white mx-1' style='cursor:pointer;background: #494d4d; color: whitesmoke' href='/companies'>all</a>";
            for ($btn = 1; $btn <= $totalPage; $btn++) {
                if($currentPage >= 4 && $btn == 1){
                    echo "<a class='btn border-white mx-1' style='cursor:pointer;background: #494d4d; color: whitesmoke' href='/companies?page=$btn&count=$count'>$btn</a>";
                    echo "..";
                }
                if($btn > $currentPage && ($btn-$currentPage)<3){
                    echo "<a class='btn border-white mx-1' style='cursor:pointer;background: #494d4d; color: whitesmoke' href='/companies?page=$btn&count=$count'>$btn</a>";
                }
                if($btn < $currentPage && ($currentPage-$btn)<3){
                    echo "<a class='btn border-white mx-1' style='cursor:pointer;background: #494d4d; color: whitesmoke' href='/companies?page=$btn&count=$count'>$btn</a>";
                }
                if($currentPage === $btn){
                    echo "<a class='btn border-white mx-1' style='cursor:pointer;background: #83b7aa; color: black; font-weight: bold;' href='/companies?page=$btn&count=$count'>$btn</a>";
                }
                if(($totalPage-$currentPage) > 4 && $btn == $totalPage){
                    echo "..";
                    echo "<a class='btn border-white mx-1' style='cursor:pointer;background: #494d4d; color: whitesmoke' href='/companies?page=$btn&count=$count'>$btn</a>";
                }
            }
            ?>
        </div>
    </div>
    <div class="shadow-grey">
        <table class="table">
            <thead style='background: #494d4d; color: whitesmoke'>
            <tr>
                <th scope="col">#</th>
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
            <?php foreach ($companies as $key => $company): ?>
                <tr>
                    <th scope="row"><?php echo ($currentPage*$count-$count)+($key+1); ?></th>
                    <th scope="row"><?php echo $company['id']; ?></th>
                    <td ><?php echo $company['company_bin']; ?></td>
                    <td style="max-width: 230px"><?php echo $company['company_name']; ?></td>
                    <td><?php echo $company['address']; ?></td>
                    <td style="max-width: 100px"><?php echo $company['phone']; ?></td>
                    <td><?php echo $company['region']; ?></td>
                    <td><?php echo $company['email']; ?></td>
                    <td>
                        <a href="/companies/info/<?=$company['id']."?page=$currentPage&count=$count"?>" class="btn mx-1 item-action">
                            <i class="bi bi-postcard"></i>
                        </a>
                        <a href="/companies/edit/<?= $company['id'] ?>" class="btn mx-1 item-action">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="/companies/delete/<?= $company['id'] ?>" class="btn mx-1 item-action">
                            <i class="bi bi-trash3-fill"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    const selElement = document.querySelector('.count-row-table');
    const urlParams = new URLSearchParams(window.location.search);
    selElement.value = urlParams.get('count');
    selElement.addEventListener('change',()=>{
        window.location.search = `?page=1&count=${selElement.value}`
    })
</script>
<?php
$content = ob_get_clean();
include ROOT_DIR . '/app/view/layout.php';
?>


