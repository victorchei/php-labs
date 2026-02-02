<?php
/**
 * Перегляд результатів у браузері — Demo
 *
 * Запуск:
 *   php -S localhost:8000
 *   Відкрити: http://localhost:8000/view.php
 */

// Підключаємо файли з функціями
require_once 'tasks/task2.php';
require_once 'tasks/task7.php';

// Вибираємо що показати
$task = $_GET['task'] ?? 'menu';
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ЛР1 — Demo</title>
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
            background: #4CAF50;
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .header h1 { margin: 0 0 10px 0; }
        .menu {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .menu a {
            background: rgba(255,255,255,0.2);
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
        }
        .menu a:hover { background: rgba(255,255,255,0.3); }
        .menu a.active { background: white; color: #4CAF50; }
        .content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .content h2 { margin-top: 0; color: #333; }
        .badge {
            display: inline-block;
            background: #4CAF50;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 12px;
            margin-left: 10px;
        }
        table { border-collapse: collapse; }
        td { padding: 0; }
    </style>
</head>
<body>
    <div class="header">
        <h1>📚 Лабораторна робота №1 — Demo <span class="badge">Приклад</span></h1>
        <div class="menu">
            <a href="?task=menu" <?= $task === 'menu' ? 'class="active"' : '' ?>>📋 Меню</a>
            <a href="?task=task2" <?= $task === 'task2' ? 'class="active"' : '' ?>>📝 Завдання 2</a>
            <a href="?task=task7_table" <?= $task === 'task7_table' ? 'class="active"' : '' ?>>🎨 Завдання 7.1</a>
            <a href="?task=task7_squares" <?= $task === 'task7_squares' ? 'class="active"' : '' ?>>🟥 Завдання 7.2</a>
        </div>
    </div>

    <div class="content">
        <?php
        switch ($task) {
            case 'task2':
                echo "<h2>Завдання 2: Виведення форматованого тексту</h2>";
                echo "<p><em>Вірш з форматуванням (жирний, курсив, відступи)</em></p>";
                echo "<div style='background:#f9f9f9; padding:20px; border-radius:8px;'>";
                echo generatePoem();
                echo "</div>";
                break;

            case 'task7_table':
                echo "<h2>Завдання 7.1: Кольорова таблиця 5×5</h2>";
                echo "<p><em>Таблиця з випадковими кольорами</em></p>";
                echo generateColorTable(5);
                break;

            case 'task7_squares':
                echo "<h2>Завдання 7.2: Випадкові квадрати</h2>";
                echo "<p><em>10 червоних квадратів на чорному тлі</em></p>";
                echo "<div style='width:100%; height:400px; position:relative; overflow:hidden;'>";
                echo generateRandomSquares(10);
                echo "</div>";
                break;

            default:
                echo "<h2>👋 Ласкаво просимо до Demo!</h2>";
                echo "<p>Це демонстраційний приклад виконання лабораторної роботи.</p>";
                echo "<p><strong>⚠️ Увага:</strong> Демо-код <strong>відрізняється</strong> від вашого варіанту!</p>";
                echo "<h3>📋 Демо-завдання:</h3>";
                echo "<ul>";
                echo "<li><strong>Завдання 2</strong> — Вірш \"Полину в мріях...\"</li>";
                echo "<li><strong>Завдання 7.1</strong> — Кольорова таблиця (не шахова!)</li>";
                echo "<li><strong>Завдання 7.2</strong> — Червоні квадрати (не жовті кола!)</li>";
                echo "</ul>";
                echo "<h3>🧪 Запуск тестів:</h3>";
                echo "<pre style='background:#333; color:#0f0; padding:15px; border-radius:8px;'>";
                echo "php run_tests.php          # Всі тести\n";
                echo "php run_tests.php task2    # Тести для завдання 2\n";
                echo "</pre>";
        }
        ?>
    </div>
</body>
</html>
