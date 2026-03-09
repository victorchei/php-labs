<?php

require_once __DIR__ . '/layout.php';

function findAndReplace(string $text, string $find, string $replace): string
{
    if ($find === '') {
        return $text;
    }
    return str_replace($find, $replace, $text);
}

$text = $_POST['text'] ?? "Весняний вітер приніс із собою аромат квітучих садів та теплі промені сонця що зігрівали землю після довгої зими";
$find = $_POST['find'] ?? "і";
$replace = $_POST['replace'] ?? "ї";

$result = '';
$submitted = isset($_POST['text']) || isset($_GET['run']);

if ($find !== '') {
    $result = findAndReplace($text, $find, $replace);
}

ob_start();
?>
    <div class="demo-card">
        <h2>Завдання 1: Пошук та заміна</h2>
        <p class="demo-subtitle">Заміна символів «і» на «ї» у весняному тексті</p>

        <form method="post" class="demo-form">
            <div>
                <label for="text">Текст для обробки</label>
                <textarea id="text" name="text" rows="3" class="form-control"><?= htmlspecialchars($text) ?></textarea>
            </div>

            <div class="form-row">
                <div>
                    <label for="find">Знайти</label>
                    <input type="text" id="find" name="find" value="<?= htmlspecialchars($find) ?>">
                </div>
                <div>
                    <label for="replace">Замінити на</label>
                    <input type="text" id="replace" name="replace" value="<?= htmlspecialchars($replace) ?>">
                </div>
            </div>

            <button type="submit" class="btn-submit">Виконати заміну</button>
        </form>

        <?php if ($find !== ''): ?>
            <div class="demo-result">
                ### Результат роботи програми:
                <div class="demo-result-value" style="background: #f0fff4; border-left: 4px solid #48bb78; padding: 15px; margin-top: 10px;">
                    <?= htmlspecialchars($result) ?>
                </div>
            </div>

            <div class="demo-code">
                <strong>Логіка:</strong> str_replace("<?= htmlspecialchars($find) ?>", "<?= htmlspecialchars($replace) ?>", text)
            </div>
        <?php endif; ?>

        <div style="margin-top: 20px; font-size: 0.9em; color: #666;">
            <strong>Очікуваний результат:</strong><br>
            <small>Весняний вїтер прїнїс їз собою аромат квїтучих садїв та теплї променї сонця що зїгрївали землю пїсля довгої зими</small>
        </div>
    </div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 1');