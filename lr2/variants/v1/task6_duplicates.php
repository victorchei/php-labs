<?php

require_once __DIR__ . '/layout.php';
function findDuplicates(array $arr): array
{
    $counts = array_count_values($arr);

    $duplicates = array_filter($counts, function($count) {
        return $count > 1;
    });

    return array_keys($duplicates);
}

$inputString = $_POST['array'] ?? '3, 7, 2, 3, 5, 8, 7, 1, 9, 2, 5';
$submitted = isset($_POST['array']);

$arr = array_map('trim', explode(',', $inputString));
$arr = array_filter($arr, fn($v) => $v !== '');

$duplicates = findDuplicates($arr);

ob_start();
?>
    <div class="demo-card">
        <h2>Завдання 6: Пошук дублікатів</h2>
        <p class="demo-subtitle">Виявлення елементів, що зустрічаються в масиві більше одного разу</p>

        <form method="post" class="demo-form">
            <div>
                <label for="array">Масив (через кому):</label>
                <input type="text" id="array" name="array" value="<?= htmlspecialchars($inputString) ?>" class="form-control">
            </div>
            <button type="submit" class="btn-submit">Знайти дублікати</button>
        </form>

        <?php if (!empty($arr)): ?>
            <div class="demo-section" style="margin-top: 25px;">
                <h3>Вхідний масив:</h3>
                <div class="array-display" style="display: flex; gap: 8px; flex-wrap: wrap;">
                    <?php foreach ($arr as $item): ?>
                        <?php
                        $isDuplicate = in_array($item, $duplicates);
                        ?>
                        <span class="array-item" style="padding: 8px 12px; border-radius: 6px; border: 1px solid #ddd; <?= $isDuplicate ? 'background: #fff5f5; border-color: #feb2b2; color: #c53030; font-weight: bold;' : 'background: #f7fafc;' ?>">
                    <?= htmlspecialchars($item) ?>
                </span>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="demo-result" style="margin-top: 25px; border-top: 2px solid #edf2f7; padding-top: 20px;">
                <h3 style="color: #c53030;">Знайдені дублікати:</h3>
                <div class="demo-result-value" style="font-size: 22px; background: #fff5f5; padding: 15px; border-radius: 8px; border-left: 5px solid #fc8181;">
                    [<?= implode(', ', $duplicates) ?>]
                </div>
                <p style="font-size: 0.9em; color: #718096; margin-top: 10px;">
                    * Очікуваний результат був: [3, 7, 2, 5]
                </p>
            </div>



            <div class="demo-code" style="margin-top: 20px; background: #2d3748; color: #fff; padding: 15px; border-radius: 8px;">
                <br>
                $counts = array_count_values($arr);<br>
                $result = array_filter($counts, fn($n) => $n > 1);
            </div>
        <?php endif; ?>
    </div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 6');