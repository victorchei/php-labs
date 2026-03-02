<?php
/**
 * Завдання 6.1: Цикли
 * 15 червоних квадратів на чорному тлі (розмір зростає)
 */

require_once dirname(__DIR__, 3) . '/shared/helpers/dev_reload.php';

function generateGrowingSquares(int $n): string
{
    $html = "<div style='position:relative;width:100vw;height:100vh;background:#000000;overflow:hidden;'>";

    for ($i = 0; $i < $n; $i++) {
        $size = 20 + ($i * 10);
        $top = mt_rand(5, 85);
        $left = mt_rand(5, 85);
        $opacity = mt_rand(70, 100) / 100;

        $html .= "<div style='
            position:absolute;
            top:{$top}%;
            left:{$left}%;
            width:{$size}px;
            height:{$size}px;
            background-color:#ef4444;
            opacity:{$opacity};
        '></div>";
    }

    $html .= "</div>";
    return $html;
}

$n = 15;
$squares = generateGrowingSquares($n);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 6.2 — Червоні квадрати</title>
    <link rel="stylesheet" href="../../demo/demo.css">
</head>
<body class="task7-circles-body">
<header class="header-fixed">
    <div class="header-left">
        <a href="/" class="header-btn">Головна</a>
        <a href="index.php" class="header-btn">← Назад</a>
        <a href="/lr1/demo/task7_squares.php" class="header-btn header-btn-demo">Demo</a>
    </div>
    <div class="header-center"></div>
    <div class="header-right">Завдання 6</div>
</header>

<?= $squares ?>

<div class="circles-func">generateGrowingSquares(<?= $n ?>)</div>
<div class="circles-counter">Квадратів: <?= $n ?></div>
<p class="circles-info">Оновіть сторінку для нової композиції 🔄</p>

<?= devReloadScript() ?>
</body>
</html>