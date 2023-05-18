<?php
$title = 'Page list';
require_once ROOT_DIR . '/app/models/pages/Pages.php';
ob_start();
?>

<div class="bg-dark h-100">
    <div class="container">
        <h1>Create page</h1>
    </div>
    <form action="index.php?page=pages&action=store" method="post">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required />
        </div>
        <div class="form-group">
            <label for="slug">Slug </label>
            <input type="text" class="form-control" id="slug" name="slug" required />
        </div>
        <button type="submit" class="btn btn-primary mt-5">Create page</button>
    </form>
</div>



<?php
$content = ob_get_clean();
include ROOT_DIR . '/app/view/layout.php';
?>
