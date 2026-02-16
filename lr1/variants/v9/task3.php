<?php
/**
 * Завдання 2: Конвертер валют (UAH → USD)
 * * Варіант 9: 50000 грн → долар, курс 40.15
 */
require_once __DIR__ . '/layout.php';

// Функція конвертації
function convertUahToUsd(float $uah, float $rate): float
{
    return round($uah / $rate, 2);
}

// Вхідні дані (Варіант 9)
$uah = 50000;
$rate = 40.15;

// Виконуємо розрахунок (результат записуємо у змінну $usd)
$usd = convertUahToUsd($uah, $rate);

// Формуємо HTML (використовуємо правильні змінні!)
$content = '<div class="card" style="padding: 20px;">
    <h2>💵 Конвертер UAH → USD</h2>
    <p><strong>Вхідні дані:</strong></p>
    <ul><li>Сума: ' . $uah . ' грн</li>
        <li>Курс: 1 долар = ' . $rate . ' грн</li>
    </ul>
    <div class="result"> ' . $uah . ' грн. можна обміняти на <strong>' . $usd . '</strong> долар
    </div>
</div>';

// Виводимо сторінку
renderVariantLayout($content, 'Завдання 2', 'task3-body');