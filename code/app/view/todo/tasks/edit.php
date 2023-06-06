<?php
/**
 * @var array $task ;
 * @var array $categories ;
 * @var $tags ;
 */
$title = 'Edit task';
require_once ROOT_DIR . '/models/todo/tasks/TasksModel.php';
ob_start();
?>

<div class="bg-dark h-100 container w-50">
    <div class="container">
        <h1>Редактирование задачи</h1>
    </div>
    <form action="/todo/tasks/update/<?= $task['id'] ?>" method="post">
        <input type="hidden" name="id" value="<?= $task['id'] ?>">
        <div class="form-group">
            <label for="title">Название задачи</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $task['title'] ?>" required/>
        </div>
        <div class="form-group">
            <label for="description">Описание задачи</label>
            <input type="text" class="form-control" id="description" name="description"
                   value="<?= $task['description'] ?>" required/>
        </div>
        <div class="form-group mt-3">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control">
                <?php foreach (['new', 'in_progress', 'completed', 'on_hold', 'canceled'] as $item): ?>
                    <option value="<?= $item; ?>" <?php echo $item === $task['status'] ? 'selected' : ''; ?>><?= $item; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="priority">Priority:</label>
            <select name="priority" id="priority" class="form-control">
                <?php foreach (['low', 'medium', 'high', 'urgent'] as $item): ?>
                    <option value="<?= $item; ?>" <?php echo $item === $task['priority'] ? 'selected' : ''; ?>><?= $item; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="role">Категория:</label>
            <select name="role" id="role" class="form-control">
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id']; ?>" <?php echo $task['category_id'] === $category['id'] ? 'selected' : ''; ?>><?= $category['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="finish_date">Finish date</label>
            <input type="datetime-local" class="form-control" id="finish_date" name="finish_date"
                   value="<?= $task['finish_date'] !== null ? htmlspecialchars(str_replace(' ', 'T', $task['finish_date'])) : '' ?>">
        </div>
        <div class="form-group">
            <label for="reminder_at">Reminder at:</label>
            <select class="form-control" name="reminder_at" id="reminder_at">
                <option value="30_min">30_min</option>
                <option value="60_min">60_min</option>
                <option value="120_min">120_min</option>
                <option value="12_h">12_h</option>
                <option value="24_h">24_h</option>
                <option value="7_days">7_days</option>
            </select>
        </div>
        <div>
            <label for="tags"></label>
            <div class="tt">
                <div class="tags-container">
                    <?php
                    $tagNames = array_map(function ($tag) {
                        return $tag['name'];
                    }, $tags ?? []);
                    foreach ($tagNames as $tagName) {
                        echo "<div class='tag'><span>$tagName</span><button type='button'>x</button></div>";
                    }
                    ?>
                <input type="text" id="tag-input" class="form-control">
                </div>
            </div>
            <input class="form-control" type="hidden" name="tags" id="hidden-tags"
                   value="<?= htmlspecialchars(implode(', ', $tagNames ?? [])) ?>">
        </div>
        <button type="submit" class="btn btn-primary mt-5">Обновить задачу</button>
    </form>
</div>
<script>
    const tagInput = document.querySelector('#tag-input')
    const tagsContainer = document.querySelector('.tags-container')
    const hiddenTags = document.querySelector('#hidden-tags')
    const existingTags = "<?= htmlspecialchars(isset($task['tags']) ? $task['tags'] : '')?>";


    function createTag(text) {
        const tag = document.createElement('div');
        tag.classList.add('tag');
        const tagText = document.createElement('span');
        tagText.textContent = text;
        const closeBtn = document.createElement('button');
        closeBtn.innerHTML = '&times;';

        closeBtn.addEventListener('click', () => {
            tagsContainer.removeChild(tag);
            updateHidenTags();
        })

        tag.appendChild(tagText);
        tag.appendChild(closeBtn);
        return tag;
    }

    function updateHidenTags() {
        const tags = tagsContainer.querySelectorAll('.tag span');
        const tagText = Array.from(tags).map((tag) => tag.textContent)
        hiddenTags.value = tagText.join(',')
    }

    tagInput.addEventListener('input',(e)=>{
        if(e.target.value.includes(',')){
            const tagText = e.target.value.slice(0,-1).trim();
            if(tagText.length > 0){
                const tag = createTag(tagText);
                tagsContainer.insertBefore(tag, tagInput)
                updateHidenTags();
            }
            e.target.value = '';
        }
    })

    tagsContainer.querySelectorAll('.tag button').forEach((button)=>{
        button.addEventListener('click',()=>{
            tagsContainer.removeChild(button.parentElement);
            updateHidenTags();
        })
    })
</script>


<?php
$content = ob_get_clean();
include ROOT_DIR . '/app/view/layout.php';
?>
