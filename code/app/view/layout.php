<?php

/**
 * @var string $title
 * @var string $content
 */
$currentPath = $_SERVER['REQUEST_URI'];
function is_active($path,$currentPath): string
{
    return $path == $currentPath ? 'active':'';
}
?>
<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<div class="w-100 h-100 bg-dark m-auto d-flex flex-row">
    <div style="width: 285px">

    </div>
    <div class="navbar navbar-expand-lg navbar-dark d-flex flex-column position-relative position-fixed" style="width: 242px;height: 100vh; background: #34249252;">
        <a href="/" class="navbar-brand mb-2">CRM</a>
        <div class="collapse navbar-collapse align-items-baseline" id="navbarNav">
            <ul class="navbar-nav d-flex flex-column">
                <h6 class="mx-2">To Do</h6>
                <li class="nav-item item-menu-box <?php echo is_active('/todo/category',$currentPath);?>">
                    <a href="/todo/category" class="nav-link">Category</a>
                </li>
                <li class="nav-item item-menu-box <?php echo is_active('/todo/tasks',$currentPath);?>">
                    <a href="/todo/tasks" class="nav-link">Tasks</a>
                </li>
                <hr/>
                <li class="nav-item item-menu-box mt-2 <?php echo is_active('/companies',$currentPath);?>">
                    <a href="/companies" class="nav-link">База компании</a>
                </li>
                <li class="nav-item item-menu-box <?= is_active('/users',$currentPath);?>">
                    <a href="/users" class="nav-link">Пользователи</a>
                </li>
                <li class="nav-item item-menu-box <?= is_active('/roles',$currentPath)?>">
                    <a href="/roles" class="nav-link">Роли Пользователей</a>
                </li>
                <li class="nav-item item-menu-box <?= is_active('/pages',$currentPath)?>">
                    <a href="/pages" class="nav-link">Страницы</a>
                </li>
                <li class="nav-item item-menu-box <?= is_active('/regions',$currentPath)?>">
                    <a href="/regions" class="nav-link">Регионы</a>
                </li>
                <hr/>
                <li class="nav-item item-menu-box">
                    <a href="/auth/register" class="nav-link">Регистрация</a>
                </li>
                <li class="nav-item item-menu-box">
                    <a href="/auth/login" class="nav-link">Логин</a>
                </li>
                <li class="nav-item item-menu-box">
                    <a href="/auth/logout" class="nav-link">Выход</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="w-100 mt-4 m-auto px-4 py-4">
        <?php  echo $content; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
