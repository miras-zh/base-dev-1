<?php
$title = 'Login';
require_once ROOT_DIR . '/models/user/User.php';
?>
<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<div class="bg-dark w-100 mx-auto container d-flex" style="height: 100vh">
    <div class="row justify-content-center col-lg-6 col-md-8 col-sm-10 mx-auto my-auto">
        <h1>Authorization</h1>
        <form action="/auth/authenticate" method="post">
            <div class="form-group">
                <label for="email">Email address </label>
                <input type="email" class="form-control" id="email" name="email" required/>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required/>
            </div>
            <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember"/>
                <label for="remember" class="form-check-label">Remember me</label>
            </div>

            <button type="submit" class="btn btn-primary mt">Sign</button>
        </form>
        <div class="mt-4">
            <p>
                Already don't have an account? <a href="/auth/register">Register here</a>
            </p>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>
</html>
