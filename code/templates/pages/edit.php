<?php
$title = 'Edit page';
ob_start();
?>

<div class="bg-dark h-100">
    <div class="container">
        <h1>Edit Page</h1>
    </div>
    <form action="/pages/update/<?=$page['id'] ?>" method="post">
        <input type="hidden" name="id" value="<?=$page['id'] ?>">
        <div class="form-group">
            <label for="title">Page title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?=$page['title'] ?>" required />
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="<?=$page['slug'] ?>" required/>
        </div>
        <div class="form-group mt-3 d-flex flex-column">
            <label for="role">Role:</label>
            <?php
            $page_roles = explode(',' ,$page['role']);
            ?>
            <?php foreach ($roles as $role): ?>
                <label class="mb-2 pointer-event">
                    <input class="form-check-input" type="checkbox" name="roles[]" value="<?=$role['id']; ?>"
                        <?php echo in_array($role['id'], $page_roles)?'checked':'';?>/>
                    <?=$role['role_name'];?>
                </label>
            <?php endforeach; ?>
        </div>
        <button type="submit" class="btn btn-primary mt-5">Update Page</button>
    </form>
</div>



<?php
$content = ob_get_clean();
include ROOT_DIR . '/templates/layout.php';
?>
