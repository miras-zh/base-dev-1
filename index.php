<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="csstyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>php web site</title>
</head>
<body class="text-bg-dark">
<?php   require "blocks/header.php";?>
<div class="container mt-5 mb-5">
    <h5>
        Наши посты
    </h5>
    <div class="d-flex flex-wrap">
        <?php for($i=0;$i < 5; $i++):?>
        <div class="card mb-4 rounded-3 shadow-sm text-bg-dark text-light border-light m-2">
            <div class="card-body">
                <img src="./img/<?php echo ($i+1);?>.jpeg" alt="">
                <ul class="list-unstyled mt-3 mb-4">
                    <li>10 users included</li>
                    <li>2 GB of storage</li>
                    <li>Email support</li>
                    <li>Help center access</li>
                </ul>
                <button type="button" class="w-100 btn btn-lg btn-outline-primary">
                    Подробнее
                </button>
            </div>
        </div>
        <?php endfor; ?>
    </div>
</div>
<?php   require "blocks/footer.php";?>
</body>
</html>