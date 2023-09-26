<?php
/**
 * @var array $workers ;
 */
$title = 'Workers list';
ob_start();

use App\Models\user\User;

?>
<h1>Отдел кадров: Список сотрудников</h1>
<?php
$userModel = new User();
$userObj = $userModel->read($_SESSION['user_id']);
    if ($userObj['email'] === 'mikos.zh8@gmail.com') {
        echo "<a href='/workers/create' class='btn btn-success'>Создать запись</a>";
    }
?>
<table class="table  table-dark">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">ФИО</th>
        <th scope="col">год рождения</th>
        <th scope="col">адрес</th>
        <th scope="col">резюме</th>
        <th scope="col">телефон</th>
        <th scope="col">Email</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($workers as $worker): ?>
        <tr>
            <th scope="row"><?php echo $worker['id']; ?></th>
            <td><?php echo $worker['firstname'] . ' ' . $worker['lastname'] . ' ' . $worker['surname']; ?></td>
            <td><?php echo $worker['email']; ?></td>
            <td><?php echo $worker['email']; ?></td>
            <td><?php echo $worker['email']; ?></td>
            <td><?php echo $worker['email']; ?></td>
            <td><?php echo $worker['email']; ?></td>

        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();
include ROOT_DIR . '/templates/layout.php';
?>


