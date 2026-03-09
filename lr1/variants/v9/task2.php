<?php
/**
 * Завдання 1: Форматований текст
 *
 * Вірш про художника з форматуванням: <b>, <i>, margin-left
 */
require_once __DIR__ . '/layout.php';

ob_start();
?>
<div class="poem">
    <?php
    echo "<p style='margin-left: 20px;'>Соняшники стоять як <b>вартові</b> в полі,</p>";
    echo "<p style='margin-left: 20px;'>Їхні голови <i>схилені</i> до землі,</p>";
    echo "<p style='margin-left: 20px;'>Бджоли збирають мед на волі,</p>";
    echo "<p style='margin-left: 20px;'>А хмари пливуть у далекій імлі.</p>";
    ?>
</div>
<?php
$content = ob_get_clean();

renderVariantLayout($content, 'Завдання 1', 'task2-body');
