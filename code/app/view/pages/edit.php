<?php
$title = 'Edit page';
require_once ROOT_DIR . '/app/models/pages/Pages.php';
ob_start();
?>

<div class="bg-dark h-100">
    <div class="container">
        <h1>Edit Page</h1>
    </div>
    <form action="index.php?page=pages&action=update" method="post">
        <input type="hidden" name="id" value="<?=$page['id'] ?>">
        <div class="form-group">
            <label for="title">Page title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?=$page['title'] ?>" required />
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="<?=$page['slug'] ?>" required/>
        </div>
        <button type="submit" class="btn btn-primary mt-5">Update Page</button>
    </form>
</div>



<?php
$content = ob_get_clean();
include ROOT_DIR . '/app/view/layout.php';
?>
