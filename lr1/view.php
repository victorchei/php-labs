<?php
/**
 * Перегляд результатів у браузері — Спільний файл
 *
 * Запуск з папки lr1/:
 *   php -S localhost:8000
 *   Відкрити: http://localhost:8000/view.php
 *
 * Параметри:
 *   ?variant=demo    — демонстрація
 *   ?variant=v1      — варіант 1
 *   ?variant=v2      — варіант 2
 *   ...
 *   ?task=task2      — конкретне завдання
 */

// Визначаємо варіант
$variant = $_GET['variant'] ?? 'menu';
$task = $_GET['task'] ?? 'menu';

// Перевіряємо чи існує варіант
$validVariants = ['demo'];
for ($i = 1; $i <= 15; $i++) {
    $validVariants[] = "v$i";
}

$variantPath = null;
$variantName = 'Виберіть варіант';
$variantColor = '#9E9E9E';

if ($variant === 'demo' && is_dir(__DIR__ . '/demo/tasks')) {
    $variantPath = __DIR__ . '/demo';
    $variantName = 'Demo (Приклад)';
    $variantColor = '#4CAF50';
} elseif (preg_match('/^v(\d+)$/', $variant, $m) && is_dir(__DIR__ . "/variants/$variant/tasks")) {
    $variantPath = __DIR__ . "/variants/$variant";
    $variantName = "Варіант {$m[1]}";
    $variantColor = '#2196F3';
}

// Підключаємо файли з функціями якщо варіант вибрано
$tasksLoaded = false;
if ($variantPath) {
    $task2File = "$variantPath/tasks/task2.php";
    $task7File = "$variantPath/tasks/task7.php";

    if (file_exists($task2File)) {
        require_once $task2File;
    }
    if (file_exists($task7File)) {
        require_once $task7File;
    }
    $tasksLoaded = true;
}

// Отримуємо список доступних варіантів
$availableVariants = [];
if (is_dir(__DIR__ . '/demo/tasks')) {
    $availableVariants['demo'] = 'Demo';
}
for ($i = 1; $i <= 15; $i++) {
    if (is_dir(__DIR__ . "/variants/v$i/tasks")) {
        $availableVariants["v$i"] = "Варіант $i";
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ЛР1 — <?= htmlspecialchars($variantName) ?></title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
            background: #f5f5f5;
        }
        .header {
            background: <?= $variantColor ?>;
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .header h1 { margin: 0 0 10px 0; font-size: 1.5em; }
        .nav {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }
        .nav a, .nav select {
            background: rgba(255,255,255,0.2);
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        .nav a:hover { background: rgba(255,255,255,0.3); }
        .nav a.active { background: white; color: <?= $variantColor ?>; }
        .nav select { background: white; color: #333; }
        .content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .content h2 { margin-top: 0; color: #333; }
        .variant-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 10px;
            margin-top: 20px;
        }
        .variant-card {
            background: #f0f0f0;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            text-decoration: none;
            color: #333;
            transition: all 0.2s;
        }
        .variant-card:hover { background: #e0e0e0; transform: translateY(-2px); }
        .variant-card.demo { background: #E8F5E9; }
        .variant-card.demo:hover { background: #C8E6C9; }
        table { border-collapse: collapse; }
        td { padding: 0; }
        .warning {
            background: #FFF3E0;
            border-left: 4px solid #FF9800;
            padding: 15px;
            margin: 15px 0;
            border-radius: 0 8px 8px 0;
        }
        pre {
            background: #333;
            color: #0f0;
            padding: 15px;
            border-radius: 8px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🧪 Лабораторна робота №1 — <?= htmlspecialchars($variantName) ?></h1>

        <?php if ($variantPath): ?>
        <div class="nav">
            <select onchange="location.href='?variant=<?= $variant ?>&task='+this.value">
                <option value="menu" <?= $task === 'menu' ? 'selected' : '' ?>>📋 Меню</option>
                <option value="task2" <?= $task === 'task2' ? 'selected' : '' ?>>📝 Завдання 2</option>
                <option value="task7a" <?= $task === 'task7a' ? 'selected' : '' ?>>🎨 Завдання 7.1</option>
                <option value="task7b" <?= $task === 'task7b' ? 'selected' : '' ?>>🔵 Завдання 7.2</option>
            </select>
            <a href="?variant=menu">← Всі варіанти</a>
        </div>
        <?php endif; ?>
    </div>

    <div class="content">
        <?php if (!$variantPath && $variant !== 'menu'): ?>
            <h2>❌ Варіант не знайдено</h2>
            <p>Варіант <strong><?= htmlspecialchars($variant) ?></strong> не існує або не має структури TDD.</p>
            <p><a href="?variant=menu">← Повернутися до списку варіантів</a></p>

        <?php elseif ($variant === 'menu' || !$variantPath): ?>
            <h2>📚 Виберіть варіант для перегляду</h2>

            <div class="warning">
                <strong>⚠️ Увага:</strong> Demo — це приклад реалізації.
                Ваш варіант має <strong>інші дані</strong>, тому копіювання демо-коду не допоможе!
            </div>

            <div class="variant-grid">
                <?php foreach ($availableVariants as $vKey => $vName): ?>
                    <a href="?variant=<?= $vKey ?>" class="variant-card <?= $vKey === 'demo' ? 'demo' : '' ?>">
                        <?= $vKey === 'demo' ? '📚' : '📝' ?><br>
                        <?= htmlspecialchars($vName) ?>
                    </a>
                <?php endforeach; ?>

                <?php if (empty($availableVariants)): ?>
                    <p>Немає доступних варіантів. Перевірте структуру папок.</p>
                <?php endif; ?>
            </div>

            <h3 style="margin-top: 30px;">🚀 Як користуватися</h3>
            <ol>
                <li>Виберіть свій варіант зі списку вище</li>
                <li>Перегляньте візуальні завдання (task2, task7)</li>
                <li>Запустіть тести: <code>php run_tests.php</code></li>
            </ol>

        <?php elseif ($task === 'menu'): ?>
            <h2>👋 <?= htmlspecialchars($variantName) ?></h2>

            <?php if ($variant === 'demo'): ?>
            <div class="warning">
                <strong>📚 Це демонстраційний приклад!</strong><br>
                Код тут <strong>відрізняється</strong> від вашого варіанту.
            </div>
            <?php endif; ?>

            <h3>📋 Завдання для перегляду:</h3>
            <ul>
                <li><a href="?variant=<?= $variant ?>&task=task2"><strong>Завдання 2</strong></a> — Виведення форматованого тексту (вірш)</li>
                <li><a href="?variant=<?= $variant ?>&task=task7a"><strong>Завдання 7.1</strong></a> — Таблиця/дошка</li>
                <li><a href="?variant=<?= $variant ?>&task=task7b"><strong>Завдання 7.2</strong></a> — Випадкові фігури</li>
            </ul>

            <h3>🧪 Запуск тестів:</h3>
            <pre>cd <?= $variant === 'demo' ? 'demo' : "variants/$variant" ?>

php run_tests.php          # Всі тести
php run_tests.php task2    # Тести для завдання 2</pre>

        <?php elseif ($task === 'task2'): ?>
            <h2>📝 Завдання 2: Виведення форматованого тексту</h2>
            <p><em>Вірш з форматуванням (жирний, курсив, відступи)</em></p>

            <?php if (function_exists('generatePoem')): ?>
                <div style="background:#f9f9f9; padding:20px; border-radius:8px; margin-top:15px;">
                    <?= generatePoem() ?>
                </div>
            <?php else: ?>
                <div class="warning">
                    <strong>⚠️ Функція generatePoem() не реалізована!</strong><br>
                    Відкрийте файл <code>tasks/task2.php</code> та реалізуйте функцію.
                </div>
            <?php endif; ?>

        <?php elseif ($task === 'task7a'): ?>
            <h2>🎨 Завдання 7.1: Таблиця / Дошка</h2>

            <?php
            // Визначаємо яку функцію викликати
            $func7a = null;
            if (function_exists('generateColorTable')) $func7a = 'generateColorTable';
            elseif (function_exists('generateChessboard')) $func7a = 'generateChessboard';

            if ($func7a):
                $size = $variant === 'demo' ? 5 : 8;
                echo "<p><em>" . ($func7a === 'generateChessboard' ? "Шахова дошка {$size}×{$size}" : "Кольорова таблиця {$size}×{$size}") . "</em></p>";
                echo $func7a($size);
            else: ?>
                <div class="warning">
                    <strong>⚠️ Функція не реалізована!</strong><br>
                    Відкрийте файл <code>tasks/task7.php</code> та реалізуйте функцію.
                </div>
            <?php endif; ?>

        <?php elseif ($task === 'task7b'): ?>
            <h2>🔵 Завдання 7.2: Випадкові фігури</h2>

            <?php
            // Визначаємо яку функцію викликати
            $func7b = null;
            if (function_exists('generateRandomSquares')) $func7b = 'generateRandomSquares';
            elseif (function_exists('generateRandomCircles')) $func7b = 'generateRandomCircles';

            if ($func7b):
                $count = $variant === 'demo' ? 10 : 12;
                $shape = $func7b === 'generateRandomCircles' ? 'кіл' : 'квадратів';
                echo "<p><em>$count $shape</em></p>";
                echo "<div style='width:100%; height:400px; position:relative; overflow:hidden; border-radius:8px;'>";
                echo $func7b($count);
                echo "</div>";
            else: ?>
                <div class="warning">
                    <strong>⚠️ Функція не реалізована!</strong><br>
                    Відкрийте файл <code>tasks/task7.php</code> та реалізуйте функцію.
                </div>
            <?php endif; ?>

        <?php endif; ?>
    </div>
</body>
</html>
