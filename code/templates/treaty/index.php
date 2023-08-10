<?php
/**
 * @var array $treaties
 * @var string $content
 * @var int $totalAmount
 * @var string $valueName
 * @var string $valueBin
 * @var string $valueRegion
 */
$limits = ['5', '10', '20', '30', '50', '100', '200', '500', '1000'];
$title = 'Treaties list';

$count = (int)($_GET['count'] ?? 30);
$totalPage = ceil($totalAmount / $count);
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

?>

<div class="mt-1 mb-1">
    <span style="font-size: 12px" class="badge bg-dark text-black float-center">Раздел в разработке</span>
</div>
<div class="w-100" style="margin-top: 20px;overflow-x: scroll;">
    <div class="flex-row d-flex w-100 justify-content-between">
        <div><h4>Список договоров</h4></div>
        <div>
            <a href="/treaties/create" class="btn" style="background: #3b8ad0; color: whitesmoke"><i
                        class="bi bi-plus-square-fill mx-1"></i>Создать договор</a>
        </div>
    </div>
    <div class="card mt-1 mb-2 mx-1 p-3">
        <form action="/treaties?page=1&&count=30" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="company_bin_filter" class="form-label">БИН</label>
                        <input name="company_bin_filter" value="<?= $valueBin ?>" class="form-control" type="text"
                               placeholder="Введите БИН" id="company_bin_filter">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="company_name_filter" class="form-label">Номер договора</label>
                        <input value="<?= $valueName ?>" class="form-control" type="text"
                               placeholder="введите название организации" name="company_name_filter"
                               id="company_name_filter">
                    </div>
                </div>
                <div class="col-2">
                    <button type="submit" class="mx-5 mt-3 btn bg-primary">Поиск</button>
                </div>
            </div> <!-- end row -->
        </form>
    </div>
    <div class="d-flex flex-row mt-4 mb-3">
        <div class="form-group d-flex flex-row align-items-center mr-10" style="width: 140px;">
            <label class="w-50" for="count">строки:</label>
            <div class="btn-group">
                <?php $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; ?>
                <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false"> <?= $count ?> <span class="caret"></span></button>
                <div class="dropdown-menu">
                    <?php foreach ($limits as $item): ?>
                        <?php
                        $next_page_url = http_build_query(array_merge($_GET, ['page' => 1, 'count' => $item]));
                        echo "<a class='dropdown-item' href='/treaties?$next_page_url'>" . $item . "</a>";
                        ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="my-1 px-1 d-flex flex-row mb-2 flex-wrap align-items-center">
            <?php
            echo "<a class='btn border-white mx-1 d-flex align-items-center justify-content-center' style='cursor:pointer;background: #494d4d; color: whitesmoke' href='/treaties?page=1&count=30'>all</a>";
            for ($btn = 1; $btn <= $totalPage; $btn++) {
                $next_page_url = http_build_query(array_merge($_GET, ['page' => $btn, 'count' => $count]));

                if ($btn == 1 && $currentPage !== $btn) {
                    echo "<a class='btn mx-1 d-flex align-items-center justify-content-center' style='cursor:pointer;background: #494d4d; color: whitesmoke' href='/treaties?$next_page_url'>$btn</a>";
                    if ($currentPage - 4 >= 1) {
                        echo "..";
                    }
                }

                if (($btn > $currentPage && ($btn - $currentPage) <= 3) && $btn != $totalPage && $btn !== 1 || ($btn < $currentPage && ($currentPage - $btn) <= 3 && $btn != $totalPage && $btn !== 1)) {
                    echo "<a class='btn mx-1 d-flex align-items-center justify-content-center' style='cursor:pointer;background: #494d4d; color: whitesmoke; width: fit-content;height: 30px;' href='/treaties?$next_page_url'>$btn</a>";
                }

                if ($currentPage === $btn) {
                    echo "<a class='btn border-white mx-1 d-flex align-items-center justify-content-center' style='cursor:pointer;background: #3b8ad0; color: black; font-weight: bold;' href='/treaties?$next_page_url'>$btn</a>";
                }
                if ($btn == $totalPage && $currentPage !== $btn) {
                    if (($totalPage - $currentPage) > 4) {
                        echo "..";
                    }
                    echo "<a class='btn mx-1 d-flex align-items-center justify-content-center' style='cursor:pointer;background: #494d4d; color: whitesmoke' href='/treaties?$next_page_url'>$btn</a>";
                }
            }
            ?>
        </div>
    </div>
    <div class="col-sm-12 col-md-5">
        <div class="dataTables_info" id="basic-datatable_info" role="status" aria-live="polite">Показать
            с <?= ((int)$currentPage - 1) * (int)$count + 1 ?>
            по <?= $count * ($currentPage) > $totalAmount ? $totalAmount : $count * ($currentPage) ?>
            из <?= $totalAmount ?> договоров
        </div>
    </div>
    <div>
        <table id="fixed-header-datatable" class="table dt-responsive nowrap table-striped w-100">
            <thead>
            <tr>
                <th>ID</th>
                <th>Номер</th>
                <th>Контрагент</th>
                <th>Инициатор</th>
                <th>Предмет договора</th>
                <th>Сумма</th>
                <th>Сумма анализа</th>
                <th>Doc</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($treaties as $key => $treaty): ?>
                <tr>
                    <th scope="row"><?php echo $treaty['id']; ?></th>
                    <td style="width: 140px">
                        <?php
                        echo "<span style='font-size: 14px;padding:0px 4px;background-color: #0d78b5 !important;' class='text-white float-center'> " . $treaty['number'] . "</span>";
                        ?>
                    </td>
                    <td style="width: 350px"><?php echo $treaty['contractor']; ?></td>
                    <td><?php echo $treaty['iniciator']; ?></td>
                    <td><?php echo $treaty['subject']; ?></td>
                    <td><?php echo $treaty['sum']; ?></td>
                    <td><?php echo $treaty['sum_service']; ?></td>
                    <td><?php echo $treaty['file_name']?? ''; ?></td>
                    <td>
                        <a href="/treaties/info/<?= $treaty['id'] . "?page=$currentPage&count=$count" ?>"
                           class="btn mx-1 item-action">
                            <i class="mdi mdi-information-off" style="font-size: 20px"></i>
                        </a>
                        <a href="/treaties/edit/<?= $treaty['id'] ?>" class="btn mx-1 item-action">
                            <i class="mdi mdi-lead-pencil" style="font-size: 20px"></i>
                        </a>
                        <a href="/treaties/delete/<?= $treaty['id'] ?>" class="btn mx-1 item-action">
                            <i class="mdi mdi-delete" style="font-size: 20px"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-sm-12 col-md-5">
                <div class="dataTables_info" id="basic-datatable_info" role="status" aria-live="polite">Показать
                    с <?= ((int)$currentPage - 1) * (int)$count + 1 ?>
                    по <?= $count * ($currentPage) > $totalAmount ? $totalAmount : $count * ($currentPage) ?>
                    из <?= $totalAmount ?> компаний
                </div>
            </div>
            <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="basic-datatable_paginate">
                    <ul class="pagination pagination-rounded">
                        <li class="paginate_button page-item previous disabled" id="basic-datatable_previous">
                            <a href="#" aria-controls="basic-datatable" data-dt-idx="0" tabindex="0" class="page-link">
                                <i class="mdi mdi-chevron-left"></i>
                            </a>
                        </li>
                        <?php
                        for ($btn = 1; $btn <= $totalPage; $btn++) {
                        $next_page_url = http_build_query(array_merge($_GET, ['page' => $btn, 'count' =>$count]));
                        if($btn == 1 && $currentPage !== $btn){
                        echo "
                        <li class='paginate_button page-item'>
                            <a href='/treaties?$next_page_url' aria-controls='basic-datatable' data-dt-idx='1'
                               tabindex='0' class='page-link'>$btn</a>
                        </li>";
                            if($currentPage-4>=1){echo "..";}
                        }

                        if(($btn > $currentPage && ($btn-$currentPage)<=3) && $btn != $totalPage && $btn !== 1|| ($btn <
                        $currentPage && ($currentPage-$btn)<=3 && $btn != $totalPage && $btn !== 1)){
                        echo "
                        <li class='paginate_button page-item'>
                            <a href='/treaties?$next_page_url' aria-controls='basic-datatable' data-dt-idx='1'
                               tabindex='0' class='page-link'>$btn</a>
                        </li>
                        ";}

                        if($currentPage === $btn){
                        echo "
                        <li class='paginate_button page-item active'>
                            <a href='/treaties?$next_page_url' aria-controls='basic-datatable' data-dt-idx='1'
                               tabindex='0' class='page-link'>$btn</a>
                        </li>
                        ";
                        }
                        if( $btn == $totalPage && $currentPage !== $btn){
                        if(($totalPage-$currentPage) > 4){ echo "..";}
                        echo "
                        <li class='paginate_button page-item'>
                            <a href='/treaties?$next_page_url' aria-controls='basic-datatable' data-dt-idx='1'
                               tabindex='0' class='page-link'>$btn</a>
                        </li>
                        ";
                        }
                        }
                        if($btn > $currentPage && ($btn-$currentPage)<3){
                        echo "
                        <li class='paginate_button page-item'>
                            <a href='/treaties?$next_page_url' aria-controls='basic-datatable' data-dt-idx='1'
                               tabindex='0' class='page-link'>$btn</a>
                        </li>
                        ";
                        }
                        if($btn < $currentPage && ($currentPage-$btn)<3){
                        echo "
                        <li class='paginate_button page-item'>
                            <a href='/treaties?$next_page_url' aria-controls='basic-datatable' data-dt-idx='1'
                               tabindex='0' class='page-link'>$btn</a>
                        </li>
                        ";
                        }
                        if($currentPage === $btn){
                        echo "
                        <li class='paginate_button page-item active'>
                            <a href='/treaties?$next_page_url' aria-controls='basic-datatable' data-dt-idx='1'
                               tabindex='0' class='page-link'>$btn</a>
                        </li>";}
                        if(($totalPage-$currentPage) > 4 && $btn == $totalPage){
                        echo "..";
                        echo "<li class='paginate_button page-item'>
                            <a href='/treaties?$next_page_url' aria-controls='basic-datatable' data-dt-idx='1'
                               tabindex='0' class='page-link'>$btn</a>
                        </li>";
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
    selElement.addEventListener('change', () => {
        window.location.search = `?page=1&count=${selElement.value}`
    })
</script>


