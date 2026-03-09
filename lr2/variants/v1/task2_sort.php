<?php

require_once __DIR__ . '/layout.php';

function sortCitiesAlphabetical(string $input): array
{
    $cities = array_filter(array_map('trim', explode(' ', $input)));

    sort($cities);

    return $cities;
}

$defaultCities = "Одеса Київ Харків Полтава Суми Чернівці Рівне Луцьк";
$input = $_POST['cities'] ?? $defaultCities;
$submitted = isset($_POST['cities']);

$sorted = sortCitiesAlphabetical($input);

ob_start();
?>
    <div class="demo-card">
        <h2>Завдання 2: Сортування міст</h2>
        <p class="demo-subtitle">Алфавітний порядок (від А до Я)</p>

        <form method="post" class="demo-form">
            <div>
                <label for="cities">Список міст (через пробіл)</label>
                <input type="text" id="cities" name="cities" value="<?= htmlspecialchars($input) ?>" class="form-control">
            </div>
            <button type="submit" class="btn-submit">Відсортувати за алфавітом</button>
        </form>

        <?php if (!empty($sorted)): ?>
            <div class="demo-result">
                <h3>Очікуваний результат:</h3>
                <div class="demo-result-value" style="background: #eef2ff; border-left: 4px solid #6366f1; padding: 15px;">
                    <?= htmlspecialchars(implode(', ', $sorted)) ?>
                </div>
            </div>

            <div class="demo-section" style="margin-top: 20px;">
                <h3>Візуалізація масиву:</h3>
                <div class="array-display">
                    <?php foreach ($sorted as $city): ?>
                        <span class="array-item" style="background: #e0e7ff; padding: 5px 10px; border-radius: 4px; margin: 2px; display: inline-block; border: 1px solid #c7d2fe;">
                    <?= htmlspecialchars($city) ?>
                </span>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="demo-code">
                [<?= implode(', ', array_map(fn($c) => "'$c'", $sorted)) ?>]
            </div>
        <?php endif; ?>
    </div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 2');