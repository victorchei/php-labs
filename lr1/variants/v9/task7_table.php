<?php
/**
 * Завдання 6.1: Смугаста таблиця 11x8
 */

require_once dirname(__DIR__, 3) . '/shared/helpers/dev_reload.php';

function generateStripedTable(int $rows, int $cols, string $color1, string $color2): string
{
    $html = "<table class='chessboard'>";
    for ($i = 0; $i < $rows; $i++) {
        $bgColor = ($i % 2 === 0) ? $color1 : $color2;
        $html .= "<tr>";
        for ($j = 0; $j < $cols; $j++) {
            $html .= "<td style='background-color:{$bgColor};'></td>";
        }
        $html .= "</tr>";
    }
    $html .= "</table>";
    return $html;
}

$rows = 11;
$cols = 8;
$color1 = '#6366f1';
$color2 = '#a5b4fc';

$table = generateStripedTable($rows, $cols, $color1, $color2);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 6.1 — Смугаста таблиця</title>
    <link rel="stylesheet" href="../../demo/demo.css">
</head>
<body class="task7-table-body body-with-header">
    <header class="header-fixed">
        <div class="header-left">
            <a href="/" class="header-btn">Головна</a>
            <a href="index.php" class="header-btn">← Варіант 30</a>
            <a href="/lr1/demo/task7_table.php?from=v30" class="header-btn header-btn-demo">Demo</a>
        </div>
        <div class="header-center"></div>
        <div class="header-right">В-30 / Завд. 6.1</div>
    </header>

    <h1>🎨 Смугаста таблиця <?= $rows ?>x<?= $cols ?></h1>
    <div class="params">generateStripedTable(<?= $rows ?>, <?= $cols ?>)</div>

    <?= $table ?>

    <?= devReloadScript() ?>
</body>
</html>
