<?php
/**
 * Завдання 6.2: Цикли
 * Таблиця 6x6 комірок різного кольору
 */

require_once dirname(__DIR__, 3) . '/shared/helpers/dev_reload.php';

function generateRandomColorTable(int $rows, int $cols): string
{
    $html = "<table class='chessboard'>";
    for ($i = 0; $i < $rows; $i++) {
        $html .= "<tr>";
        for ($j = 0; $j < $cols; $j++) {
            // Генеруємо випадковий HEX-колір
            $randomColor = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $html .= "<td style='background-color:{$randomColor};'></td>";
        }
        $html .= "</tr>";
    }
    $html .= "</table>";
    return $html;
}

$rows = 6;
$cols = 6;

$table = generateRandomColorTable($rows, $cols);

?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 6.1 — Таблиця різного кольору</title>
    <link rel="stylesheet" href="../../demo/demo.css">
</head>
<body class="task7-table-body body-with-header">
<header class="header-fixed">
    <div class="header-left">
        <a href="/" class="header-btn">Головна</a>
        <a href="index.php" class="header-btn">← Варіант 9</a>
        <a href="/lr1/demo/task7_table.php?from=v9" class="header-btn header-btn-demo">Demo</a>
    </div>
    <div class="header-center"></div>
    <div class="header-right">В-9 / Завд. 6</div>
</header>

<h1>🎨 Таблиця <?= $rows ?>x<?= $cols ?> (випадкові кольори)</h1>
<div class="params">generateRandomColorTable(<?= $rows ?>, <?= $cols ?>)</div>

<?= $table ?>

<?= devReloadScript() ?>
</body>
</html>