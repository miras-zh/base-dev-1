<?php
/**
 * @var array $treaty
 * @var string $content
 * @var array $company
 */

$count = (int)($_GET['count'] ?? 30);
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
?>
<div class="w-100" style="margin-top: 80px;">
    <div class="flex-row d-flex w-100 justify-content-between">
        <a href="/treaties?page=<?= "$currentPage&count=$count"; ?>" class="btn"
           style="background: #3b8ad0; color: whitesmoke"><i class="bi bi-arrow-left-short"></i>Назад</a>
        <div><h4>Информация о реестре</h4></div>
        <a href="/companies/edit/<?= $treaty['id'] ?>" class="btn" style="background: #3b8ad0; color: whitesmoke"><i
                    class="bi bi-pencil-square"></i>Редактировать</a>
    </div>

    <div class="mt-5 text-white">
        <div class="form-group mt-1">
            <span>Инициатор:</span><?= $treaty['iniciator']; ?>
        </div>
        <div class="form-group mt-1">
            <span>Предмет договора:</span><?= $treaty['subject']; ?>
        </div>
        <div class="form-group mt-1">
            <span>Сумма:</span>:<?= $treaty['sum']; ?>
        </div>
        <div class="form-group mt-1">
            <span>Сумма (сервис от втп):</span><?= $treaty['sum_service']; ?>
        </div>
    </div>
    <div class=" mt-2 text-white">
        <div class="form-group mt-1">
            <span>Файл договора:</span><?= isset($treaty['file_name']) && $treaty['file_name'] !== ''?$treaty['file_name']:'no file'; ?>
        </div>
        <div class="form-group mt-1">
            <?php if($treaty['file_name']):?>
            <a href="#"
               onclick="showFile('<?= $treaty['file_type']; ?>', '<?= base64_encode($treaty['file_content']); ?>')">показать
                файл</a>
            <?php endif;?>
        </div>

    </div>
</div>
<script>
    function showFile(fileType, fileContent) {
        console.log('show file')
        var blob = new Blob([base64ToArrayBuffer(fileContent)], { type: fileType });
        var url = URL.createObjectURL(blob);
        window.open(url);
    }

    function base64ToArrayBuffer(base64) {
        var binaryString = window.atob(base64);
        var bytes = new Uint8Array(binaryString.length);
        for (var i = 0; i < binaryString.length; i++) {
            bytes[i] = binaryString.charCodeAt(i);
        }
        return bytes.buffer;
    }
</script>

