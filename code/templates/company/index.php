<?php
/**
 * @var array $companies
 * @var string $content
 */
$limits = ['5','10','20','30','50','100','200','500','1000'];
$title = 'Company list';
$currentPage =isset($_GET['page'])?(int)$_GET['page'] : 1;
?>

<div class="mt-5 mb-5">
    <span style="font-size: 18px" class="badge bg-danger text-white float-center">Раздел в разработке</span>
    <span style="font-size: 18px" class="badge bg-info text-white float-center">сейчас этот раздел дорабатывается,технические работы...</span>
</div>
<div class="w-100" style="margin-top: 80px;overflow-x: scroll;">
    <div class="flex-row d-flex w-100 justify-content-between">
        <div><h4>Список компании</h4></div>
        <div>
            <a href="/companies/create" class="btn" style="background: #3b8ad0; color: whitesmoke"><i class="bi bi-plus-square-fill mx-1"></i>Создать компанию</a>
        </div>
    </div>
    <div class="shadow-grey mt-1 mb-2 mx-1 p-3 align-items-center" style="background: #2c3c4c!important;">
        <form action="/companies?page=1&&count=30" method="post" class="d-flex flex-row">
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
        <div class="form-group d-flex flex-row align-items-center mr-10" style="width: 140px;">
            <label class="w-50" for="count">строки:</label>
            <select name="count" id="count" class="form-control w-50 count-row-table" onchange="handleValue()" style="width: 120px;">
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
            $companyModel = new App\Models\company\Company();
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
    <div>
        <table id="fixed-header-datatable" class="table dt-responsive nowrap table-striped w-100">
            <thead>
            <tr>
                <th>ID</th>
                <th>БИН</th>
                <th>Наименование</th>
                <th>Адрес</th>
                <th>Телефон</th>
                <th>Регион</th>
                <th>Email</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($companies as $key => $company): ?>
                <tr>
                    <th scope="row"><?php echo $company['id']; ?></th>
                    <td ><?php echo $company['company_bin']; ?></td>
                    <td style="max-width: 230px"><?php echo $company['company_name']; ?></td>
                    <td><?php echo $company['address']; ?></td>
                    <td style="max-width: 100px"><?php echo $company['phone']; ?></td>
                    <td><?php echo $company['region']; ?></td>
                    <td><?php echo $company['email']; ?></td>
                    <td>
                        <a href="/companies/info/<?=$company['id']."?page=$currentPage&count=$count"?>" class="btn mx-1 item-action">
                            <i class="mdi mdi-information-off" style="font-size: 20px"></i>
                        </a>
                        <a href="/companies/edit/<?= $company['id'] ?>" class="btn mx-1 item-action">
                            <i class="mdi mdi-lead-pencil" style="font-size: 20px"></i>
                        </a>
                        <a href="/companies/delete/<?= $company['id'] ?>" class="btn mx-1 item-action">
                            <i class="mdi mdi-delete" style="font-size: 20px"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="row">
            <?php
            $companyModel = new App\Models\company\Company();
            $totalAmount = $companyModel->getCompaniesNumber();
            $count = (int)($_GET['count'] ?? 30);
            $totalPage = ceil($totalAmount / $count);
            $currentPage =isset($_GET['page'])?(int)$_GET['page'] : 1;
            ?>

            <div class="col-sm-12 col-md-5">
                <div class="dataTables_info" id="basic-datatable_info" role="status" aria-live="polite">Showing <?=(int)$currentPage*(int)$count?> to <?=$count*($currentPage+1)?> of <?=$totalAmount?> entries</div>
            </div>
            <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="basic-datatable_paginate">
                    <ul class="pagination pagination-rounded">
                        <li class="paginate_button page-item previous disabled" id="basic-datatable_previous">
                            <a href="#" aria-controls="basic-datatable" data-dt-idx="0" tabindex="0" class="page-link">
                                <i class="mdi mdi-chevron-left"></i>
                            </a>
                        </li>
                        <?php for ($btn = 1; $btn <= $totalPage; $btn++) {
                        if($currentPage >= 4 && $btn == 1){
                        echo "<li class='paginate_button page-item'>
                            <a href='/companies?page=$btn&count=$count' aria-controls='basic-datatable' data-dt-idx='1' tabindex='0' class='page-link'>$btn</a>
                        </li>";
                        echo "..";
                        }
                        if($btn > $currentPage && ($btn-$currentPage)<3){
                        echo "<li class='paginate_button page-item'>
                            <a href='/companies?page=$btn&count=$count' aria-controls='basic-datatable' data-dt-idx='1' tabindex='0' class='page-link'>$btn</a>
                        </li>";
                        }
                        if($btn < $currentPage && ($currentPage-$btn)<3){
                        echo "<li class='paginate_button page-item'>
                            <a href='/companies?page=$btn&count=$count' aria-controls='basic-datatable' data-dt-idx='1' tabindex='0' class='page-link'>$btn</a>
                        </li>";
                        }
                        if($currentPage === $btn){
                        echo "<li class='paginate_button page-item active'>
                            <a href='/companies?page=$btn&count=$count' aria-controls='basic-datatable' data-dt-idx='1' tabindex='0' class='page-link'>$btn</a>
                        </li>";
                        }
                        if(($totalPage-$currentPage) > 4 && $btn == $totalPage){
                        echo "..";
                        echo "<li class='paginate_button page-item'>
                            <a href='/companies?page=$btn&count=$count' aria-controls='basic-datatable' data-dt-idx='1' tabindex='0' class='page-link'>$btn</a>
                        </li>";
                        }
                        }
                        ?>
                        <li class="paginate_button page-item next" id="basic-datatable_next">
                            <a href="#" aria-controls="basic-datatable" data-dt-idx="7" tabindex="0" class="page-link">
                                <i class="mdi mdi-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
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


