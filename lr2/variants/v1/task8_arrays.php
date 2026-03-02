<?php

require_once __DIR__ . '/layout.php';

function createArray(): array
{
    $length = random_int(3, 7);
    $arr = [];
    for ($i = 0; $i < $length; $i++) {
        $arr[] = random_int(10, 20);
    }
    return $arr;
}

function processArrays(array $a, array $b): array
{
    $combined = array_merge($a, $b);
    $unique = array_unique($combined);
    sort($unique);
    return array_values($unique);
}

$arr1 = createArray();
$arr2 = createArray();
$result = processArrays($arr1, $arr2);

ob_start();
?>
    <div class="demo-card demo-card-wide">
        <h2>Завдання 8: Операції з масивами</h2>
        <p class="demo-subtitle">Об'єднання, видалення дублікатів та сортування (А-Я)</p>

        <form method="post" class="demo-form">
            <button type="submit" class="btn-submit">Згенерувати та обробити</button>
        </form>

        <div class="demo-section">
            <h3>Масив 1 (3-7 елементів, 10-20)</h3>
            <div class="array-display">
                <?php foreach ($arr1 as $v): ?>
                    <span class="array-item"><?= $v ?></span>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="demo-section">
            <h3>Масив 2 (3-7 елементів, 10-20)</h3>
            <div class="array-display">
                <?php foreach ($arr2 as $v): ?>
                    <span class="array-item"><?= $v ?></span>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="array-arrow">&#8595; Об'єднання + Унікальність + Сортування</div>

        <div>
            <h3 class="demo-section-title-success">Підсумковий масив</h3>
            <div class="array-display">
                <?php foreach ($result as $v): ?>
                    <span class="array-item array-item-unique"><?= $v ?></span>
                <?php endforeach; ?>
            </div>
        </div>



        <div class="demo-code">
            $combined = array_merge($a, $b);<br>
            $unique = array_unique($combined);<br>
            sort($unique);
        </div>
    </div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 8');