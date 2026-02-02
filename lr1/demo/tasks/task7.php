<?php
/**
 * Завдання 7: Робота з циклами
 *
 * Демонстрація використання циклів для генерації HTML.
 */

/**
 * Завдання 7.1: Генерує HTML таблицю n×n з випадковими кольорами
 *
 * @param int $n Розмір таблиці (кількість рядків = кількість стовпців)
 * @return string HTML-код таблиці
 */
function generateColorTable(int $n): string
{
    $html = "<table border='1' cellspacing='0'>";

    for ($i = 0; $i < $n; $i++) {
        $html .= "<tr>";
        for ($j = 0; $j < $n; $j++) {
            $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $html .= "<td style='width:50px; height:50px; background:$color;'></td>";
        }
        $html .= "</tr>";
    }

    $html .= "</table>";
    return $html;
}

/**
 * Завдання 7.2: Генерує HTML з випадковими квадратами
 *
 * Створює n червоних квадратів на чорному тлі.
 * Кожен квадрат має випадковий розмір (20-100px) та позицію (0-90%).
 *
 * @param int $n Кількість квадратів
 * @return string HTML-код з квадратами
 */
function generateRandomSquares(int $n): string
{
    $html = "<div style='position:relative; width:100vw; height:100vh; background:black;'>";

    for ($i = 0; $i < $n; $i++) {
        $size = mt_rand(20, 100);
        $top = mt_rand(0, 90);
        $left = mt_rand(0, 90);
        $html .= "<div style='position:absolute; width:{$size}px; height:{$size}px; background:red; top:{$top}%; left:{$left}%;'></div>";
    }

    $html .= "</div>";
    return $html;
}
