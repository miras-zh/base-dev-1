

<div class="h-100">
    <div class="container">
        <h1>Создание записи договора</h1>
    </div>
    <form action="/treaties/store" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="number_treties">Номер договора</label>
            <input type="text" class="form-control" id="number_treties" name="number_treties" />
        </div>
        <div class="form-group">
            <label for="contractor">Контроагент </label>
            <input type="text" class="form-control" id="contractor" name="contractor"  />
        </div>
        <div class="form-group">
            <label for="iniciator">Инициатор </label>
            <input type="text" class="form-control" id="iniciator" name="iniciator"  />
        </div>
        <div class="form-group">
            <label for="subject">Объект </label>
            <input type="text" class="form-control" id="subject" name="subject"  />
        </div>
        <div class="form-group">
            <label for="sum">Сумма договора </label>
            <input type="text" class="form-control" id="sum" name="sum"  />
        </div>
        <div class="form-group">
            <label for="sum_service">сумма анализа (сервис) </label>
            <input type="text" class="form-control" id="sum_service" name="sum_service"  />
        </div>
        <div class="form-group">
            <label for="created_at">Дата заключения договора </label>
            <input type="text" class="form-control" id="created_at" name="created_at"  />
        </div>

        <div class="form-group mt-2">
            <div class="fallback">
                <input name="file" type="file" multiple />
            </div>
            <div class="dz-message needsclick">
                <i class="h1 text-muted ri-upload-cloud-2-line"></i>
                <h3>Перетащите файл договора или просто кликните</h3>
            </div>
        </div>



        <button type="submit" class="btn btn-primary mt-5">Создать реестр записи</button>
    </form>
</div>
