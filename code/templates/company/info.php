<?php
/**
 * @var array $companies
 * @var string $content
 * @var array $company
 */

$count = (int)($_GET['count'] ?? 30);
$currentPage =isset($_GET['page'])?(int)$_GET['page'] : 1;
?>
<div class="w-100" style="margin-top: 80px;">
    <div class="flex-row d-flex w-100 justify-content-between">
        <a href="/companies?page=<?="$currentPage&count=$count";?>" class="btn" style="background: #3b8ad0; color: whitesmoke"><i class="bi bi-arrow-left-short"></i>Назад</a>
        <div><h4>Информация о компании</h4></div>
        <a href="/companies/edit/<?=$company['id'] ?>" class="btn" style="background: #3b8ad0; color: whitesmoke"><i class="bi bi-pencil-square"></i>Редактировать</a>
    </div>


    <div class="shadow-grey mt-5 text-white">
        <div>
            Наименование компании:<span style="font-size: 18px; font-weight: 500;"> <?php echo $company['company_name'] ?? 'company info here*'; ?></span>
        </div>
        <div>
            БИН:<span style="font-size: 18px; font-weight: 500;"> <?php echo $company['company_bin'] ?? 'no bin'; ?></span>
        </div>
        <div>
            Адрес:<span style="font-size: 18px; font-weight: 500;"> <?php echo $company['address'] ?? 'no address'; ?></span>
        </div>
        <div>
            Регион:<span style="font-size: 18px; font-weight: 500;"> <?php echo $company['region'] ?? 'no region'; ?></span>
        </div>
    </div>
    <div class="shadow-grey mt-2 text-white">
        <div>
            Сотрудник:<span style="font-size: 18px; font-weight: 500;"> <?php echo $company['employee'] ?? 'no employe*'; ?></span>
        </div>
        <div>
            Телефон:<span style="font-size: 18px; font-weight: 500;"> <?php echo $company['phone'] ?? 'no phone'; ?></span>
        </div>
        <div>
            Email:<span style="font-size: 18px; font-weight: 500;"> <?php echo $company['email'] ?? 'no email'; ?></span>
        </div>
        <div>
            Сайт:<span style="font-size: 18px; font-weight: 500;"> <?php echo $company['website'] ?? 'no website'; ?></span>
        </div>
    </div>
</div>


