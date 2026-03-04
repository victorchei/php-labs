<?php
/**
 * Завдання 2: Конвертер валют (UAH → EUR)
 *
 * 48600 грн → долларів, курс 47.50, комісія 3%
 */
require_once __DIR__ . '/layout.php';

function convertUahToEur(float $uah, float $rate): float
{
    return round($uah / $rate, 2);
}

function applyCommission(float $amount, float $commissionPercent): float
{
    return round($amount * (1 - $commissionPercent / 100), 2);
}

// Вхідні дані (варіант 30)
$uah = 45000;
$rate = 40.00;
$commission = 3;

$eurBeforeCommission = convertUahToEur($uah, $rate);
$eurAfterCommission = applyCommission($eurBeforeCommission, $commission);

$content = '<div class="card">
    <h2>💶 Конвертер UAH → USD</h2>
    <p><strong>Курс:</strong> 1 USD = ' . $rate . ' грн</p>
    <p><strong>Комісія банку:</strong> ' . $commission . '%</p>
    <div class="result">' . $uah . ' грн = ' . $eurBeforeCommission . ' долларів</div>
    <div class="result mt-10 result-commission">Після комісії ' . $commission . '% — <strong>' . $eurAfterCommission . '</strong> долларів</div>
    <p class="info">convertUahToEur(' . $uah . ', ' . $rate . ') = ' . $eurBeforeCommission . '</p>
    <p class="info">applyCommission(' . $eurBeforeCommission . ', ' . $commission . ') = ' . $eurAfterCommission . '</p>
</div>';

renderVariantLayout($content, 'Завдання 2', 'task3-body');
