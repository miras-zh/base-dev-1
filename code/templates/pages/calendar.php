<?php
/**
 * @var string $title
 * @var string $content
 * @var array $tasks
 */

$title = 'calendar';
ob_start();
?>

calendar

<?php
$content = ob_get_clean();
include ROOT_DIR . '/templates/layout.php';

?>
