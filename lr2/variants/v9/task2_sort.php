<?php
/**
 * Завдання 2: Сортування міст
 *
 * Варіант 9: sort — за алфавітом
 */
require_once __DIR__ . '/layout.php';

/**
 * Сортує міста в алфавітному порядку
 */
function sortCitiesAlphabetical(string $input): array
{
    // Розбиваємо рядок на масив по пробілу і прибираємо зайві пробіли
    $cities = array_filter(array_map('trim', explode(' ', $input)));

    // Сортуємо за алфавітом
    sort($cities);

    return $cities;
}

// Вхідні дані (варіант 9)
$input = $_POST['cities'] ?? '';
$submitted = isset($_POST['cities']);
$defaultCities = 'Кропивницький Луцьк Житомир Миколаїв Херсон Тернопіль Чернігів Мелітополь';

if (!$submitted) {
    $input = $defaultCities;
}

$sorted = sortCitiesAlphabetical($input);

ob_start();
?>
    <div class="demo-card">
        <h2>Сортування міст</h2>
        <p class="demo-subtitle">Введіть назви міст через пробіл — сортування від А до Я</p>

        <form method="post" class="demo-form">
            <div>
                <label for="cities">Міста (через пробіл)</label>
                <input type="text" id="cities" name="cities" value="<?= htmlspecialchars($input) ?>" placeholder="Київ Львів Одеса">
            </div>
            <button type="submit" class="btn-submit">Сортувати</button>
        </form>

        <?php if (!empty($sorted)): ?>
            <div class="demo-section">
                <h3>Вхідні дані</h3>
                <div class="array-display">
                    <?php foreach (array_filter(array_map('trim', explode(' ', $input))) as $city): ?>
                        <span class="array-item"><?= htmlspecialchars($city) ?></span>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="array-arrow">&#8595;</div>

            <div>
                <h3 class="demo-section-title-success">Відсортовані (А→Я)</h3>
                <div class="array-display">
                    <?php foreach ($sorted as $city): ?>
                        <span class="array-item array-item-unique"><?= htmlspecialchars($city) ?></span>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="demo-code">sortCitiesAlphabetical("<?= htmlspecialchars($input) ?>")
                // sort() — алфавітний порядок
                // Очікуваний результат: "<?= htmlspecialchars(implode(', ', $sorted)) ?>"</div>
        <?php endif; ?>
    </div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 2');