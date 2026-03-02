<?php

require_once __DIR__ . '/layout.php';

function generateAnimalName(array $syllables, int $syllablesCount = 2): string
{
    if (empty($syllables)) return '';

    $name = '';
    for ($i = 0; $i < $syllablesCount; $i++) {
        $name .= $syllables[array_rand($syllables)];
    }

    return mb_strtoupper(mb_substr($name, 0, 1)) . mb_substr($name, 1);
}

$defaultSyllables = "ба ко ри ша ло му ни те зу пі";
$targetNamesCount = 3;
$syllablesPerName = 2;

$syllablesInput = $_POST['syllables'] ?? $defaultSyllables;
$count = (int)($_POST['count'] ?? $targetNamesCount);
$syllablesCount = (int)($_POST['syllables_count'] ?? $syllablesPerName);

$syllables = array_filter(array_map('trim', explode(' ', $syllablesInput)));

$generatedNames = [];
if (!empty($syllables)) {
    for ($i = 0; $i < $count; $i++) {
        $generatedNames[] = generateAnimalName($syllables, $syllablesCount);
    }
}

ob_start();
?>
    <div class="demo-card">
        <h2>Завдання 7: Генератор імен тварин</h2>
        <p class="demo-subtitle">Створення кличок із заданих складів</p>

        <form method="post" class="demo-form">
            <div>
                <label for="syllables">Набір складів:</label>
                <input type="text" id="syllables" name="syllables" value="<?= htmlspecialchars($syllablesInput) ?>" class="form-control">
            </div>
            <div class="form-row" style="display: flex; gap: 10px; margin-top: 10px;">
                <div style="flex: 1;">
                    <label for="count">Кількість імен:</label>
                    <input type="number" id="count" name="count" value="<?= $count ?>" min="1" max="10">
                </div>
                <div style="flex: 1;">
                    <label for="syllables_count">Складів на імʼя:</label>
                    <input type="number" id="syllables_count" name="syllables_count" value="<?= $syllablesCount ?>" min="1" max="5">
                </div>
            </div>
            <button type="submit" class="btn-submit" style="margin-top: 15px;">Згенерувати клички</button>
        </form>

        <?php if (!empty($generatedNames)): ?>
            <div class="demo-result" style="margin-top: 25px;">
                <h3 style="color: #4a5568;">Результат генерації:</h3>
                <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-top: 10px;">
                    <?php foreach ($generatedNames as $name): ?>
                        <div style="background: #ebf8ff; border: 2px solid #90cdf4; color: #2c5282; padding: 10px 20px; border-radius: 50px; font-weight: bold; font-size: 1.2em; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                            🐾 <?= htmlspecialchars($name) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>



            <div class="demo-code" style="margin-top: 20px;">
                <br>
                <?= implode(', ', array_map(fn($s) => "'$s'", $syllables)) ?><br>
                <?= $count ?> | <?= $syllablesCount ?>
            </div>
        <?php endif; ?>
    </div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 7');