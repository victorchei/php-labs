<?php
/**
 * Завдання 1: Форматований текст
 *
 * Вірш про художника з форматуванням: <b>, <i>, margin-left
 */
require_once __DIR__ . '/layout.php';

ob_start();

?>
<div class="poem" >
    <?php
    echo "<p style='margin-left: 10px;'>Бабусина <b>хата</b> пахне пирогами,</p>";
    echo "<p class='poem-indent-2'>Кіт муркоче <i>ледачо</i> на печі,</p>";
    echo "<p class='poem-indent-3'>За вікном вишневий сад цвіте рясно,</p>";
    echo "<p class='poem-indent-4'>І джмелі гудуть від ранку до ночі.</p>";
    ?>
</div>
<?php
$content = ob_get_clean();

renderVariantLayout($content, 'Завдання 1', 'task2-body');