<?php
/**
 * Завдання 6: Пошук дублікатів
 *
 * Варіант 9: пошук дублікатів
 * Масив: [4, 15, 7, 22, 4, 15, 11, 7, 30, 22, 15] → [4, 15, 7, 22]
 */
require_once __DIR__ . '/layout.php';

/**
 * Знаходить дублікати в масиві
 * Повертає масив елементів, які зустрічаються більше 1 разу
 */
function findDuplicates(array $arr): array
{
    if (empty($arr)) {
        return [];
    }

    // Рахуємо частоту кожного елемента в масиві
    $counts = array_count_values($arr);

    // Залишаємо тільки ті елементи, кількість яких більша за 1
    $duplicatesMap = array_filter($counts, fn($count) => $count > 1);

    // array_keys поверне нам самі числа (які стали ключами в масиві частот),
    // при цьому зберігаючи порядок їх першої появи в оригінальному масиві
    return array_keys($duplicatesMap);
}

// Обробка форми (варіант 9)
$input = $_POST['array'] ?? '4, 15, 7, 22, 4, 15, 11, 7, 30, 22, 15';
$submitted = isset($_POST['array']);

// Розбиваємо рядок на масив і чистимо від зайвих пробілів
$arr = array_map('trim', explode(',', $input));
$arr = array_filter($arr, fn($v) => $v !== '');

$duplicates = findDuplicates($arr);

ob_start();
?>
    <div class="demo-card">
        <h2>Пошук дублікатів</h2>
        <p class="demo-subtitle">Повертає масив елементів, які повторюються у вхідному масиві</p>

        <form method="post" class="demo-form">
            <div>
                <label for="array">Масив (через кому)</label>
                <input type="text" id="array" name="array" value="<?= htmlspecialchars($input) ?>" placeholder="4, 15, 7, 22...">
            </div>
            <button type="submit" class="btn-submit">Знайти дублікати</button>
        </form>

        <?php if (!empty($arr)): ?>
            <div class="demo-section">
                <h3>Вхідний масив</h3>
                <div class="array-display">
                    <?php foreach ($arr as $item): ?>
                        <span class="array-item <?= in_array(trim($item), $duplicates) ? 'array-item-unique' : '' ?>"><?= htmlspecialchars($item) ?></span>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="demo-result">
                <h3>Знайдені дублікати</h3>
                <div class="demo-result-value">[<?= htmlspecialchars(implode(', ', $duplicates)) ?>]</div>
            </div>

            <div class="demo-section">
                <h3>Деталі (частота елементів)</h3>
                <table class="demo-table">
                    <thead>
                    <tr>
                        <th>Елемент</th>
                        <th>Кількість</th>
                        <th>Статус</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $counts = array_count_values($arr);
                    foreach ($counts as $value => $count):
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($value) ?></td>
                            <td><?= $count ?></td>
                            <td>
                                <?php if ($count > 1): ?>
                                    <span class="demo-tag demo-tag-error">Дублікат</span>
                                <?php else: ?>
                                    <span class="demo-tag demo-tag-success">Унікальний</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="demo-code">findDuplicates([<?= htmlspecialchars(implode(', ', $arr)) ?>])
                // Результат: [<?= htmlspecialchars(implode(', ', $duplicates)) ?>]</div>
        <?php endif; ?>
    </div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 6');