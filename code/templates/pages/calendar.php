<?php
/**
 * @var string $title
 * @var string $content
 * @var array $tasks
 */

$title = 'calendar';
ob_start();
?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Сервисы</a></li>
                    <li class="breadcrumb-item active">Календарь</li>
                </ol>
            </div>
            <h4 class="page-title">Календарь</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="d-grid">
                            <button class="btn btn-lg font-16 btn-danger" id="btn-new-event">
                                <i class="mdi mdi-plus-circle-outline"></i> Создать событие
                            </button>
                        </div>
                        <div id="external-events" class="mt-3">
                            <p class="text-muted">Перенесите событие </p>
                            <div class="external-event bg-success-lighten text-success" data-class="bg-success"><i class="mdi mdi-checkbox-blank-circle me-2 vertical-middle"></i>Новая тема</div>
                            <div class="external-event bg-info-lighten text-info" data-class="bg-info"><i class="mdi mdi-checkbox-blank-circle me-2 vertical-middle"></i>Мое событие</div>
                            <div class="external-event bg-warning-lighten text-warning" data-class="bg-warning"><i class="mdi mdi-checkbox-blank-circle me-2 vertical-middle"></i>Встреча</div>
                            <div class="external-event bg-danger-lighten text-danger" data-class="bg-danger"><i class="mdi mdi-checkbox-blank-circle me-2 vertical-middle"></i>Создать тему</div>
                        </div>


                    </div> <!-- end col-->

                    <div class="col-lg-9">
                        <div class="mt-4 mt-lg-0">
                            <div id="calendar"></div>
                        </div>
                    </div> <!-- end col -->

                </div> <!-- end row -->
            </div> <!-- end card body-->
        </div> <!-- end card -->

        <!-- Add New Event MODAL -->
        <div class="modal fade" id="event-modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="needs-validation" name="event-form" id="form-event" novalidate>
                        <div class="modal-header py-3 px-4 border-bottom-0">
                            <h5 class="modal-title" id="modal-title">Событие</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-4 pb-4 pt-0">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="control-label form-label">Название события</label>
                                        <input class="form-control" placeholder="Insert Event Name" type="text" name="title" id="event-title" required />
                                        <div class="invalid-feedback">Please provide a valid event name</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="control-label form-label">Категория</label>
                                        <select class="form-select" name="category" id="event-category" required>
                                            <option value="bg-danger" selected>Danger</option>
                                            <option value="bg-success">Success</option>
                                            <option value="bg-primary">Primary</option>
                                            <option value="bg-info">Info</option>
                                            <option value="bg-dark">Dark</option>
                                            <option value="bg-warning">Warning</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a valid event category</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-danger" id="btn-delete-event">Удалить</button>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Закрыть</button>
                                    <button type="submit" class="btn btn-success" id="btn-save-event">Сохранить</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> <!-- end modal-content-->
            </div> <!-- end modal dialog-->
        </div>
        <!-- end modal-->
    </div>
    <!-- end col-12 -->
</div>
<!-- Fullcalendar js -->

<?php
$content = ob_get_clean();
include ROOT_DIR . '/templates/layout.php';

?>
