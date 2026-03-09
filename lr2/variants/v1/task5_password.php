<?php

require_once __DIR__ . '/layout.php';


function generateSecurePassword(int $length = 10): string
{
    $upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lower = 'abcdefghijklmnopqrstuvwxyz';
    $digits = '0123456789';
    $special = '!@#$%^&*()-_=+';
    $password = '';
    $password .= $upper[random_int(0, strlen($upper) - 1)];
    $password .= $lower[random_int(0, strlen($lower) - 1)];
    $password .= $digits[random_int(0, strlen($digits) - 1)];
    $password .= $special[random_int(0, strlen($special) - 1)];

    $all = $upper . $lower . $digits . $special;

    for ($i = strlen($password); $i < $length; $i++) {
        $password .= $all[random_int(0, strlen($all) - 1)];
    }

    return str_shuffle($password);
}

function evaluateStrength(string $password): array
{
    $criteria = [
            'length'  => ['label' => 'Довжина ≥ 8 символів', 'passed' => strlen($password) >= 8],
            'upper'   => ['label' => 'Велика літера (A-Z)', 'passed' => (bool)preg_match('/[A-Z]/', $password)],
            'lower'   => ['label' => 'Мала літера (a-z)', 'passed' => (bool)preg_match('/[a-z]/', $password)],
            'digit'   => ['label' => 'Цифра (0-9)', 'passed' => (bool)preg_match('/[0-9]/', $password)],
            'special' => ['label' => 'Спецсимвол (!@#$%^&*()-_=+)', 'passed' => (bool)preg_match('/[!@#$%^&*()\-_=+]/', $password)],
    ];

    $score = 0;
    foreach ($criteria as $item) {
        if ($item['passed']) $score++;
    }

    return [
            'score' => $score,
            'criteria' => $criteria,
            'label' => match($score) {
                5 => 'Дуже надійний',
                4 => 'Надійний',
                3 => 'Середній',
                2 => 'Слабкий',
                default => 'Дуже слабкий'
            }
    ];
}

$passwordLength = 10;
$currentPassword = $_POST['password'] ?? '';

if (isset($_POST['action']) && $_POST['action'] === 'generate') {
    $currentPassword = generateSecurePassword($passwordLength);
}

$analysis = $currentPassword ? evaluateStrength($currentPassword) : null;

ob_start();
?>
    <div class="demo-card">
        <h2>Завдання 5: Генератор паролів</h2>
        <p class="demo-subtitle">Довжина: 10 символів | 5 критеріїв захисту</p>

        <div style="display: flex; gap: 20px; align-items: flex-start;">
            <form method="post" style="flex: 1;">
                <input type="hidden" name="action" value="generate">
                <button type="submit" class="btn-submit" style="width: 100%; height: 50px; font-size: 1.1em;">
                    Згенерувати новий пароль
                </button>
            </form>

            <form method="post" style="flex: 1;">
                <input type="text" name="password" value="<?= htmlspecialchars($currentPassword) ?>"
                       placeholder="Або введіть свій для перевірки"
                       style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px;">
                <button type="submit" class="btn-submit" style="margin-top: 10px; background: #4a5568;">Перевірити мій</button>
            </form>
        </div>

        <?php if ($analysis): ?>
            <hr style="margin: 30px 0; border: 0; border-top: 1px solid #eee;">

            <div class="demo-result">
                <h3 style="margin-bottom: 5px;">Поточний пароль:</h3>
                <div style="font-family: monospace; font-size: 24px; color: #2d3748; background: #edf2f7; padding: 10px; border-radius: 6px; display: inline-block;">
                    <?= htmlspecialchars($currentPassword) ?>
                </div>

                <div style="margin-top: 15px;">
                    <strong>Оцінка: <?= $analysis['score'] ?>/5</strong> —
                    <span style="color: <?= $analysis['score'] === 5 ? '#2f855a' : ($analysis['score'] >= 3 ? '#d69e2e' : '#c53030') ?>; font-weight: bold;">
                    <?= $analysis['label'] ?>
                </span>
                </div>
            </div>



            <table class="demo-table" style="width: 100%; margin-top: 20px;">
                <tr style="background: #f8fafc;">
                    <th style="text-align: left; padding: 10px;">Критерій (Вимога)</th>
                    <th style="text-align: center; padding: 10px;">Статус</th>
                </tr>
                <?php foreach ($analysis['criteria'] as $c): ?>
                    <tr style="border-bottom: 1px solid #edf2f7;">
                        <td style="padding: 10px;"><?= $c['label'] ?></td>
                        <td style="text-align: center; padding: 10px;">
                            <?= $c['passed'] ? 'Так' : 'Ні' ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <div class="demo-code" style="margin-top: 20px;">
                <?= strlen($currentPassword) ?> <br>
            </div>
        <?php endif; ?>
    </div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 5');