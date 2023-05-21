<?php ?>
<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/app.css">
</head>
<body>
<div class="w-100 h-100 bg-dark m-auto d-flex flex-row">
    <div class="navbar navbar-expand-lg navbar-dark d-flex flex-column position-relative" style="width: 300px;height: 100vh; background: #34249252;">
        <a href="/" class="navbar-brand mb-2">CRM</a>
        <div class="collapse navbar-collapse align-items-baseline" id="navbarNav">
            <ul class="navbar-nav d-flex flex-column">
                <li class="nav-item item-menu-box">
                    <a href="/companies" class="nav-link">База компании</a>
                </li>
                <li class="nav-item item-menu-box">
                    <a href="/users" class="nav-link">Пользователи</a>
                </li>
                <li class="nav-item item-menu-box">
                    <a href="/roles" class="nav-link">Роли Пользователей</a>
                </li>
                <li class="nav-item item-menu-box">
                    <a href="/pages" class="nav-link">Страницы</a>
                </li>
                <li class="nav-item item-menu-box">
                    <a href="/regions" class="nav-link">Регионы</a>
                </li>
                <li class="nav-item item-menu-box">
                    <a href="/registration" class="nav-link">Регистрация</a>
                </li>
                <li class="nav-item item-menu-box">
                    <a href="/login" class="nav-link">Логин</a>
                </li>
                <li class="nav-item item-menu-box">
                    <a href="/logout" class="nav-link">Выход</a>
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
