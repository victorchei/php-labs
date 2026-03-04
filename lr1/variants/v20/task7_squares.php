<?php
/**
 * Завдання 6.2: 20 зелених трикутників на сірому тлі (розмір зростає)
 */
require_once __DIR__ . '/layout.php';

function generateChessboard(int $rows, int $cols): string
{
    $cellSize = 40; // px
    $html = "<div class='shapes-container shapes-container--gray' style='display:inline-block;padding:16px;background:#f3f4f6;'>";
    $html .= "<div style='display:grid;grid-template-columns:repeat({$cols},{$cellSize}px);grid-auto-rows:{$cellSize}px;gap:0;'>";

    for ($r = 0; $r < $rows; $r++) {
        for ($c = 0; $c < $cols; $c++) {
            $isBlack = (($r + $c) % 2) === 0;
            $color = $isBlack ? '#111827' : '#ffffff';
            $html .= "<div style='width:{$cellSize}px;height:{$cellSize}px;background:{$color};'></div>";
        }
    }

    $html .= "</div></div>";
    return $html;
}

$rows = 5;
$cols = 10;
$board = generateChessboard($rows, $cols);

$content = $board . '
    <div class="circles-func">generateChessboard(' . $rows . ', ' . $cols . ')</div>
    <div class="circles-counter">♟ Клітин: ' . $rows . ' x ' . $cols . ' = ' . ($rows * $cols) . '</div>
    <p class="circles-info">Оновіть сторінку для повторної генерації (розташування статичне)</p>';

renderVariantLayout($content, 'Шахова таблиця 5x10', 'task7-squares-body');
