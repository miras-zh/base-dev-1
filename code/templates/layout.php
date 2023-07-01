<?php

/**
 * @var string $title
 * @var string $content
 */
$currentPath = $_SERVER['REQUEST_URI'];
function is_active($path, $currentPath): string
{
    return $path == $currentPath ? 'active' : '';
}

?>
<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link href="/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .top-bar-main {
            height: 40px;
            background: #34249252;
            width: 100%;
            top: 0;
        }

        .item-menu-box {
            background: #59498f4d;
            width: 180px;
            border-radius: 4px;
            padding-left: 10px;
            color: white !important;
            margin-bottom: 7px;
        }

        .item-menu-box:hover {
            background: #4e369e80;
        }

        .item-menu-box a:hover {
            color: white;
        }

        .item-menu-box a {
            color: white;
        }

        .shadow-grey {
            box-shadow: 1px 1px 11px -3px rgba(147, 148, 148, 0.2);
        }

        .active {
            background: rgba(176, 194, 255, 0.84);
        }

        .active .icon-nav-item {
            color: black;
        }

        .active a {
            color: #3f3e3e;
            font-weight: 600;
        }

        .active a:hover {
            color: #3f3e3e;
            font-weight: 600;
        }

        .active:hover {
            background: #84a3b0 !important;
        }

        .mr-10 {
            margin-right: 10px;
        }

        .icon-nav-item {
            color: #c1c1c1c4;
            font-size: 19px;
        }
    </style>
</head>
<body>
<header class="topbar position-fixed w-100" data-navbarbg="skin5" style="min-height: 60px;background: #2c3c4c!important;border-bottom: 1px solid #ffffff8f;">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark w-100 d-flex align-items-center">
        <div id="toggle-sidebar" class="position-relative" style="cursor: pointer; margin-top: 5px;"><i class="bi bi-list" style="font-size: 25px; margin-left: 20px"></i></div>
    </nav>
</header>
<!--<div class="position-fixed top-bar-main px-2 d-flex flex-row align-items-center">-->
<!--    <ul class="d-flex flex-row align-items-center">-->
<!--        <li>-->
<!--            <a href="#"><i class="bi bi-calendar3"></i></a>-->
<!--        </li>-->
<!--    </ul>-->
<!--</div>-->
<div class="w-100 h-100 m-auto d-flex flex-row">
    <div style="width: 285px">

    </div>
    <div id="sidebar" class="navbar navbar-expand-lg navbar-dark d-flex flex-column position-relative position-fixed sidebar"
         style="top: 60px;width: 242px;height: 100vh; background: #2c3c4c!important;">
        <a href="/" class="navbar-brand mb-2">CRM</a>
        <div class="collapse navbar-collapse align-items-baseline" id="navbarNav">
            <ul class="navbar-nav d-flex flex-column">
                <h6 class="mx-2 title-item-block">To Do</h6>
                <li class="nav-item item-menu-box <?php echo is_active('/todo/category', $currentPath); ?>">
                    <a href="/todo/category" class="nav-link"><i class="bi bi-journals mr-10 icon-nav-item"></i>Категории</a>
                </li>
                <li class="nav-item item-menu-box <?php echo is_active('/todo/tasks', $currentPath); ?>">
                    <a href="/todo/tasks" class="nav-link"><i class="bi bi-list-task mr-10 icon-nav-item"></i>Задачи</a>
                </li>
                <hr/>
                <li class="nav-item item-menu-box mt-2 <?php echo is_active('/companies', $currentPath); ?>">
                    <a href="/companies?page=1&count=30" class="nav-link"><i class="bi bi-card-heading mr-10 icon-nav-item"></i>База
                        компании</a>
                </li>
                <li class="nav-item item-menu-box <?= is_active('/users', $currentPath); ?>">
                    <a href="/users" class="nav-link"><i class="bi bi-people-fill mr-10 icon-nav-item"></i>Пользователи</a>
                </li>
                <li class="nav-item item-menu-box <?= is_active('/roles', $currentPath) ?>">
                    <a href="/roles" class="nav-link"><i class="bi bi-person-vcard mr-10 icon-nav-item"></i>Роли</a>
                </li>
                <li class="nav-item item-menu-box <?= is_active('/pages', $currentPath) ?>">
                    <a href="/pages" class="nav-link"><i class="bi bi-body-text mr-10 icon-nav-item"></i>Страницы</a>
                </li>
                <li class="nav-item item-menu-box <?= is_active('/regions', $currentPath) ?>">
                    <a href="/regions" class="nav-link"><i class="bi bi-globe-asia-australia mr-10 icon-nav-item"></i>Регионы</a>
                </li>
                <hr/>
                <li class="nav-item item-menu-box">
                    <a href="/auth/register" class="nav-link"><i class="bi bi-pencil-square mr-10 icon-nav-item"></i>Регистрация</a>
                </li>
                <li class="nav-item item-menu-box">
                    <a href="/auth/login" class="nav-link"><i class="bi bi-box-arrow-in-right mr-10 icon-nav-item"></i>Логин</a>
                </li>
                <li class="nav-item item-menu-box">
                    <a href="/auth/logout" class="nav-link"><i class="bi bi-door-open mr-10 icon-nav-item"></i>Выход</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="w-100 mt-4 m-auto py-4">
        <div class="px-4 py-4 ">
            <?php echo $content; ?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous">
</script>
<script>
    const toggle = document.querySelector('#toggle-sidebar');
    const sidebar = document.querySelector('#sidebar');
    toggle.addEventListener('click',()=>{
        sidebar.classList.toggle('toggle');
    })
</script>
</body>
</html>
