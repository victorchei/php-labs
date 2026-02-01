<?php
/**
 * Завдання 3: Конвертер валют (EUR → UAH)
 * Варіант 1
 *
 * Демонстрація: змінні, арифметичні операції, функції
 */

/**
 * Конвертує євро в гривні
 */
function convertEurToUah(float $eur, float $rate): int
{
    return (int) floor($eur * $rate);
}

/**
 * Форматує результат конвертації
 */
function formatConversionResult(float $eur, int $uah): string
{
    return "{$eur} євро = {$uah} грн";
}

// Вхідні дані (v1)
$eur = 250;
$rate = 45.20;

// Розрахунок
$uah = convertEurToUah($eur, $rate);
$result = formatConversionResult($eur, $uah);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 3 — Конвертер валют (v1)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            max-width: 400px;
            margin: 0 auto;
        }
        h2 { color: #333; margin-top: 0; }
        .result {
            font-size: 24px;
            color: #2d3748;
            background: #e2e8f0;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .info { color: #718096; font-size: 14px; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="card">
        <h2>💶 Конвертер EUR → UAH</h2>
        <p><strong>Курс:</strong> 1 EUR = <?= $rate ?> грн</p>
        <div class="result">
            <?= $result ?>
        </div>
        <p class="info">Функція: convertEurToUah(<?= $eur ?>, <?= $rate ?>) = <?= $uah ?></p>
    </div>
</body>
</html>
