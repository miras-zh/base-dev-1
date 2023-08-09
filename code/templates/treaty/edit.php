<?php
/**
 * @var $regions;
 * @var $countries;
 * @var $company;
 */
?>

<div class=" h-100">
    <div class="container">
        <h1>Редактирование записи</h1>
    </div>
    <form action="/treaties/update/<?=$treaty['id'] ?>" method="post" class="w-50">
        <div class="form-group mt-1">
            <label for="contractor">Контроагент:<?=htmlspecialchars($treaty['contractor']) ?></label>
            <input type="text" class="form-control" id="contractor" name="contractor" value="<?php echo htmlspecialchars($treaty['contractor']); ?>" />
        </div>
<!--        <div class="form-group mt-1">-->
<!--            <label for="company_bin">БИН компании:</label>-->
<!--            <input type="text" class="form-control" id="company_bin" name="company_bin" value="--><?php //=$treaty['company_bin']; ?><!--" />-->
<!--        </div>-->
        <div class="form-group mt-1">
            <label for="iniciator">Инициатор:</label>
            <input type="text" class="form-control" id="iniciator" name="iniciator" value="<?=$treaty['iniciator']; ?>"/>
        </div>
        <div class="form-group mt-1">
            <label for="subject">Предмет договора:</label>
            <input type="text" class="form-control" id="subject" name="subject" value="<?=$treaty['subject']; ?>"/>
        </div>
        <div class="form-group mt-1">
            <label for="sum">Сумма:</label>
            <input type="text" class="form-control" id="sum" name="sum" value="<?=$treaty['sum']; ?>"/>
        </div>
        <div class="form-group mt-1">
            <label for="sum_service">Сумма (сервис от втп):</label>
            <input type="text" class="form-control" id="sum_service" name="sum_service" value="<?=$treaty['sum_service']; ?>"/>
        </div>
        <div class="form-group mt-1">
            <label for="file_name">Файл договора:</label>
            <input disabled type="text" class="form-control" id="file_name" name="file_name" value="<?=$treaty['file_name']; ?>"/>
        </div>
        <div class="form-group mt-1">
<!--            <a href="data:--><?php //=$treaty['file_type']; ?><!--;base64,--><?php //=base64_encode($treaty['file_content']); ?><!--" target="_blank">показать файл</a>-->
            <a href="#" onclick="showFile('<?=$treaty['file_type']; ?>', '<?=base64_encode($treaty['file_content']); ?>')">показать файл</a>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Сохранить изменения</button>
    </form>
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

