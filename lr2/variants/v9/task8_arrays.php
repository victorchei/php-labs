<?php
/**
 * Завдання 8: Операції з масивами
 *
 * Варіант 9: array_merge + array_unique + sort ascending
 * createArray(): довжина 3-7, значення 10-20
 */
require_once __DIR__ . '/layout.php';

/**
 * Створює масив випадкової довжини (3-7) з випадковими значеннями (10-20)
 */
function createArray(): array
{
    $length = random_int(3, 7);
    $arr = [];
    for ($i = 0; $i < $length; $i++) {
        $arr[] = random_int(10, 20);
    }
    return $arr;
}

/**
 * Об'єднує два масиви, видаляє дублікати та сортує за зростанням
 */
function mergeUniqueSorted(array $a, array $b): array
{
    // 1. Об'єднати два масиви
    $merged = array_merge($a, $b);

    // 2. Видалити дублікати
    $unique = array_unique($merged);

    // 3. Сортувати за зростанням
    sort($unique);

    return $unique;
}

// Генеруємо масиви (варіант 9)
$arr1 = createArray();
$arr2 = createArray();

$result = mergeUniqueSorted($arr1, $arr2);

ob_start();
?>
    <div class="demo-card demo-card-wide">
        <h2>Операції з масивами</h2>
        <p class="demo-subtitle">createArray(), об'єднання, видалення дублікатів, сортування за зростанням</p>

        <form method="post" class="demo-form">
            <button type="submit" name="regenerate" class="btn-submit">Згенерувати нові масиви</button>
        </form>

        <div class="demo-section">
            <h3>Масив 1</h3>
            <div class="array-display">
                <?php foreach ($arr1 as $v): ?>
                    <span class="array-item"><?= $v ?></span>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="demo-section">
            <h3>Масив 2</h3>
            <div class="array-display">
                <?php foreach ($arr2 as $v): ?>
                    <span class="array-item"><?= $v ?></span>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="array-arrow">&#8595; Об'єднання → Видалення дублікатів → Сортування</div>

        <div>
            <h3 class="demo-section-title-success">Результат (відсортований, без дублікатів)</h3>
            <?php if (!empty($result)): ?>
                <div class="array-display">
                    <?php foreach ($result as $v): ?>
                        <span class="array-item array-item-unique"><?= $v ?></span>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="demo-subtitle">Масив порожній</p>
            <?php endif; ?>
        </div>

        <div class="demo-code">$a = createArray(); // [<?= implode(', ', $arr1) ?>]
            $b = createArray(); // [<?= implode(', ', $arr2) ?>]
            mergeUniqueSorted($a, $b);
            // array_merge → array_unique → sort
            // Результат: [<?= implode(', ', $result) ?>]</div>
    </div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 8');