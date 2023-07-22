<?php
/**
 * @var array $sessions
 * @var string $content
 */
$limits = ['5','10','20','30','50','100','200','500','1000'];
$title = 'Session list';
//$currentPage =isset($_GET['page'])?(int)$_GET['page'] : 1;

function formattedDate(string $date): void
{
    $timestamp = strtotime($date);
    $formattedDate = date("d F Y H:i:s", $timestamp);
    echo $formattedDate;
}
?>

<div class="w-100" style="margin-top: 80px;overflow-x: scroll;">
    <div class="flex-row d-flex w-100 justify-content-between">
        <div><h4>Журнал авторизаций</h4></div>

    </div>
    <div>
        <table id="fixed-header-datatable" class="table dt-responsive nowrap table-striped w-100">
            <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Email</th>
                <th>Time</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($sessions as $key => $session): ?>
                <tr>
                    <th scope="row"><?php echo $session['id']; ?></th>
                    <td ><?php echo $session['user_name']; ?></td>
                    <td style="max-width: 230px"><?php echo $session['email']; ?></td>
                    <td><?php formattedDate($session['created_at']); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
<!--        <div class="row">-->
<!--            --><?php
//            $companyModel = new App\Models\company\Company();
//            $totalAmount = $companyModel->getCompaniesNumber();
//            $count = (int)($_GET['count'] ?? 30);
//            $totalPage = ceil($totalAmount / $count);
//            $currentPage =isset($_GET['page'])?(int)$_GET['page'] : 1;
//            ?>
<!---->
<!--            <div class="col-sm-12 col-md-5">-->
<!--                <div class="dataTables_info" id="basic-datatable_info" role="status" aria-live="polite">Showing --><?php //=(int)$currentPage*(int)$count?><!-- to --><?php //=$count*($currentPage+1)?><!-- of --><?php //=$totalAmount?><!-- entries</div>-->
<!--            </div>-->
<!--            <div class="col-sm-12 col-md-7">-->
<!--                <div class="dataTables_paginate paging_simple_numbers" id="basic-datatable_paginate">-->
<!--                    <ul class="pagination pagination-rounded">-->
<!--                        <li class="paginate_button page-item previous disabled" id="basic-datatable_previous">-->
<!--                            <a href="#" aria-controls="basic-datatable" data-dt-idx="0" tabindex="0" class="page-link">-->
<!--                                <i class="mdi mdi-chevron-left"></i>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        --><?php //for ($btn = 1; $btn <= $totalPage; $btn++) {
//                        if($currentPage >= 4 && $btn == 1){
//                        echo "<li class='paginate_button page-item'>
//                            <a href='/companies?page=$btn&count=$count' aria-controls='basic-datatable' data-dt-idx='1' tabindex='0' class='page-link'>$btn</a>
//                        </li>";
//                        echo "..";
//                        }
//                        if($btn > $currentPage && ($btn-$currentPage)<3){
//                        echo "<li class='paginate_button page-item'>
//                            <a href='/companies?page=$btn&count=$count' aria-controls='basic-datatable' data-dt-idx='1' tabindex='0' class='page-link'>$btn</a>
//                        </li>";
//                        }
//                        if($btn < $currentPage && ($currentPage-$btn)<3){
//                        echo "<li class='paginate_button page-item'>
//                            <a href='/companies?page=$btn&count=$count' aria-controls='basic-datatable' data-dt-idx='1' tabindex='0' class='page-link'>$btn</a>
//                        </li>";
//                        }
//                        if($currentPage === $btn){
//                        echo "<li class='paginate_button page-item active'>
//                            <a href='/companies?page=$btn&count=$count' aria-controls='basic-datatable' data-dt-idx='1' tabindex='0' class='page-link'>$btn</a>
//                        </li>";
//                        }
//                        if(($totalPage-$currentPage) > 4 && $btn == $totalPage){
//                        echo "..";
//                        echo "<li class='paginate_button page-item'>
//                            <a href='/companies?page=$btn&count=$count' aria-controls='basic-datatable' data-dt-idx='1' tabindex='0' class='page-link'>$btn</a>
//                        </li>";
//                        }
//                        }
//                        ?>
<!--                        <li class="paginate_button page-item next" id="basic-datatable_next">-->
<!--                            <a href="#" aria-controls="basic-datatable" data-dt-idx="7" tabindex="0" class="page-link">-->
<!--                                <i class="mdi mdi-chevron-right"></i>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
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


