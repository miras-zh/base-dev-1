<?php

if ($_SERVER['REQUEST_URI'] === '/index.php') {
    header("Location: /");
    exit();
}

$title = 'User list';
ob_start();
$companyModel = new App\Models\company\Company();
$totalAmount = $companyModel->getCompaniesNumber();
?>
    <!-- Start Content-->

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form class="d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-light" id="dash-daterange">
                                <span class="input-group-text bg-primary border-primary text-white">
                                                    <i class="mdi mdi-calendar-range font-13"></i>
                                                </span>
                            </div>
                            <a href="javascript: void(0);" class="btn btn-primary ms-2">
                                <i class="mdi mdi-autorenew"></i>
                            </a>
                            <a href="javascript: void(0);" class="btn btn-primary ms-1">
                                <i class="mdi mdi-filter-variant"></i>
                            </a>
                        </form>
                    </div>
                    <h4 class="page-title">Аналитика</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-5 col-lg-6">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Customers">База количество компаний</h5>
                                <h3 class="mt-3 mb-3"><?= chunk_split($totalAmount, 3, ' ')?></h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 5.27%</span>
                                    <span class="text-nowrap">добавлено</span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-sm-6">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-cart-plus widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Заявки форс-мажоры</h5>
                                <h3 class="mt-3 mb-3">56</h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 28%</span>
                                    <span class="text-nowrap">за текущий месяц</span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row -->

                <div class="row">
                    <div class="col-sm-6">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-currency-usd widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Доход</h5>
                                <h3 class="mt-3 mb-3">$6,254</h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 7.00%</span>
                                    <span class="text-nowrap">за текущий месяц</span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-sm-6">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-pulse widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Growth">Меропрития</h5>
                                <h3 class="mt-3 mb-3">+7</h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 4.87%</span>
                                    <span class="text-nowrap">за текущий месяц</span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row -->

            </div> <!-- end col -->

            <div class="col-xl-7 col-lg-6">
                <div class="card card-h-100">
                    <div class="d-flex card-header justify-content-between align-items-center">
                        <h4 class="header-title">Прогнозы Vs Фактов</h4>
                        <div class="dropdown">
                            <a href="index.html#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div dir="ltr">
                            <div id="high-performing-product" class="apex-charts" data-colors="#727cf5,#91a6bd40"></div>
                        </div>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->

            </div> <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="d-flex card-header justify-content-between align-items-center">
                        <h4 class="header-title">Доход</h4>
                        <div class="dropdown">
                            <a href="index.html#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Отчет</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Экспорт</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Выгода</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Действия</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="chart-content-bg">
                            <div class="row text-center">
                                <div class="col-sm-6">
                                    <p class="text-muted mb-0 mt-3">Текущая неделя</p>
                                    <h2 class="fw-normal mb-3">
                                        <small class="mdi mdi-checkbox-blank-circle text-primary align-middle me-1"></small>
                                        <span>$58,254</span>
                                    </h2>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted mb-0 mt-3">Следующая неделя</p>
                                    <h2 class="fw-normal mb-3">
                                        <small class="mdi mdi-checkbox-blank-circle text-success align-middle me-1"></small>
                                        <span>$69,524</span>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <div class="dash-item-overlay d-none d-md-block" dir="ltr">
                            <h5>Today's Earning: $2,562.30</h5>
                            <p class="text-muted font-13 mb-3 mt-2">Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui.
                                Etiam rhoncus...</p>
                            <a href="javascript: void(0);" class="btn btn-outline-primary">View Statements
                                <i class="mdi mdi-arrow-right ms-2"></i>
                            </a>
                        </div>
                        <div dir="ltr">
                            <div id="revenue-chart" class="apex-charts mt-3" data-colors="#727cf5,#0acf97"></div>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

            <div class="col-lg-4">
                <div class="card">
                    <div class="d-flex card-header justify-content-between align-items-center">
                        <h4 class="header-title">Доход по локации</h4>
                        <div class="dropdown">
                            <a href="index.html#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        <div class="mb-4 mt-3">
                            <div id="world-map-markers" style="height: 217px"></div>
                        </div>

                        <h5 class="mb-1 mt-0 fw-normal">New York</h5>
                        <div class="progress-w-percent">
                            <span class="progress-value fw-bold">72k </span>
                            <div class="progress progress-sm">
                                <div class="progress-bar" role="progressbar" style="width: 72%;" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <h5 class="mb-1 mt-0 fw-normal">San Francisco</h5>
                        <div class="progress-w-percent">
                            <span class="progress-value fw-bold">39k </span>
                            <div class="progress progress-sm">
                                <div class="progress-bar" role="progressbar" style="width: 39%;" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <h5 class="mb-1 mt-0 fw-normal">Sydney</h5>
                        <div class="progress-w-percent">
                            <span class="progress-value fw-bold">25k </span>
                            <div class="progress progress-sm">
                                <div class="progress-bar" role="progressbar" style="width: 39%;" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <h5 class="mb-1 mt-0 fw-normal">Singapore</h5>
                        <div class="progress-w-percent mb-0">
                            <span class="progress-value fw-bold">61k </span>
                            <div class="progress progress-sm">
                                <div class="progress-bar" role="progressbar" style="width: 61%;" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-6 col-lg-12 order-lg-2 order-xl-1">
                <div class="card">
                    <div class="d-flex card-header justify-content-between align-items-center">
                        <h4 class="header-title">Мероприятия</h4>
                        <a href="javascript:void(0);" class="btn btn-sm btn-light">Export <i class="mdi mdi-download ms-1"></i></a>
                    </div>

                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <tbody>
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Кантонская ярмарка «Canton Fair»</h5>
                                        <span class="text-muted font-13">15 Апрель 2023</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">$7905.49</h5>
                                        <span class="text-muted font-13">Доходы</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">$2835.00</h5>
                                        <span class="text-muted font-13">Расходы</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">822</h5>
                                        <span class="text-muted font-13">Участников</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">74</h5>
                                        <span class="text-muted font-13">Договора</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">КАЗАХСТАНСКО-УКРАИНСКИЙ БИЗНЕС ФОРУМ</h5>
                                        <span class="text-muted font-13">21 Февраль 2023</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">$3905.49</h5>
                                        <span class="text-muted font-13">Доходы</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">$1835.00</h5>
                                        <span class="text-muted font-13">Расходы</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">200</h5>
                                        <span class="text-muted font-13">Участников</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">90</h5>
                                        <span class="text-muted font-13">Договора</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Бизнес-миссия закупочных предприятий</h5>
                                        <span class="text-muted font-13">6 Июня 2023</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">$100000.00</h5>
                                        <span class="text-muted font-13">Доходы</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">$11000.00</h5>
                                        <span class="text-muted font-13">Расходы</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">950</h5>
                                        <span class="text-muted font-13">Участников</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">400</h5>
                                        <span class="text-muted font-13">Договора</span>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

            <div class="col-xl-3 col-lg-6 order-lg-1">
                <div class="card">
                    <div class="d-flex card-header justify-content-between align-items-center">
                        <h4 class="header-title">Приход</h4>
                        <div class="dropdown">
                            <a href="index.html#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        <div id="average-sales" class="apex-charts mb-4 mt-2"
                             data-colors="#727cf5,#0acf97,#fa5c7c,#ffbc00"></div>


                        <div class="chart-widget-list">
                            <p>
                                <i class="mdi mdi-square text-primary"></i> Direct
                                <span class="float-end">$300.56</span>
                            </p>
                            <p>
                                <i class="mdi mdi-square text-danger"></i> Affilliate
                                <span class="float-end">$135.18</span>
                            </p>
                            <p>
                                <i class="mdi mdi-square text-success"></i> Sponsored
                                <span class="float-end">$48.96</span>
                            </p>
                            <p class="mb-0">
                                <i class="mdi mdi-square text-warning"></i> E-mail
                                <span class="float-end">$154.02</span>
                            </p>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

            <div class="col-xl-3 col-lg-6 order-lg-1">
                <div class="card">
                    <div class="d-flex card-header justify-content-between align-items-center">
                        <h4 class="header-title">Recent Activity</h4>
                        <div class="dropdown">
                            <a href="index.html#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body py-0 mb-3" data-simplebar style="max-height: 403px;">
                        <div class="timeline-alt py-0">
                            <div class="timeline-item">
                                <i class="mdi mdi-upload bg-info-lighten text-info timeline-icon"></i>
                                <div class="timeline-item-info">
                                    <a href="javascript:void(0);" class="text-info fw-bold mb-1 d-block">You sold an item</a>
                                    <small>Paul Burgess just purchased “Hyper - Admin Dashboard”!</small>
                                    <p class="mb-0 pb-2">
                                        <small class="text-muted">5 minutes ago</small>
                                    </p>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <i class="mdi mdi-airplane bg-primary-lighten text-primary timeline-icon"></i>
                                <div class="timeline-item-info">
                                    <a href="javascript:void(0);" class="text-primary fw-bold mb-1 d-block">Product on the Bootstrap Market</a>
                                    <small>Dave Gamache added
                                        <span class="fw-bold">Admin Dashboard</span>
                                    </small>
                                    <p class="mb-0 pb-2">
                                        <small class="text-muted">30 minutes ago</small>
                                    </p>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <i class="mdi mdi-microphone bg-info-lighten text-info timeline-icon"></i>
                                <div class="timeline-item-info">
                                    <a href="javascript:void(0);" class="text-info fw-bold mb-1 d-block">Robert Delaney</a>
                                    <small>Send you message
                                        <span class="fw-bold">"Are you there?"</span>
                                    </small>
                                    <p class="mb-0 pb-2">
                                        <small class="text-muted">2 hours ago</small>
                                    </p>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <i class="mdi mdi-upload bg-primary-lighten text-primary timeline-icon"></i>
                                <div class="timeline-item-info">
                                    <a href="javascript:void(0);" class="text-primary fw-bold mb-1 d-block">Audrey Tobey</a>
                                    <small>Uploaded a photo
                                        <span class="fw-bold">"Error.jpg"</span>
                                    </small>
                                    <p class="mb-0 pb-2">
                                        <small class="text-muted">14 hours ago</small>
                                    </p>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <i class="mdi mdi-upload bg-info-lighten text-info timeline-icon"></i>
                                <div class="timeline-item-info">
                                    <a href="javascript:void(0);" class="text-info fw-bold mb-1 d-block">You sold an item</a>
                                    <small>Paul Burgess just purchased “Hyper - Admin Dashboard”!</small>
                                    <p class="mb-0 pb-2">
                                        <small class="text-muted">16 hours ago</small>
                                    </p>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <i class="mdi mdi-airplane bg-primary-lighten text-primary timeline-icon"></i>
                                <div class="timeline-item-info">
                                    <a href="javascript:void(0);" class="text-primary fw-bold mb-1 d-block">Product on the Bootstrap Market</a>
                                    <small>Dave Gamache added
                                        <span class="fw-bold">Admin Dashboard</span>
                                    </small>
                                    <p class="mb-0 pb-2">
                                        <small class="text-muted">22 hours ago</small>
                                    </p>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <i class="mdi mdi-microphone bg-info-lighten text-info timeline-icon"></i>
                                <div class="timeline-item-info">
                                    <a href="javascript:void(0);" class="text-info fw-bold mb-1 d-block">Robert Delaney</a>
                                    <small>Send you message
                                        <span class="fw-bold">"Are you there?"</span>
                                    </small>
                                    <p class="mb-0 pb-2">
                                        <small class="text-muted">2 days ago</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- end timeline -->
                    </div> <!-- end slimscroll -->
                </div>
                <!-- end card-->
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

<?php
$content = ob_get_clean();
include ROOT_DIR . '/templates/layout.php';
?>


