<?php
/**
 * Завдання 3: Конвертер валют (USD → UAH)
 *
 * Демонстрація конвертації доларів у гривні.
 */

/**
 * Конвертує долари в гривні
 *
 * @param float $usd Сума в доларах
 * @param float $rate Курс (1 USD = X UAH)
 * @return int Сума в гривнях (ціле число, округлене вниз)
 */
function convertUsdToUah(float $usd, float $rate): int
{
    return (int) floor($usd * $rate);
}

/**
 * Форматує результат конвертації для виводу
 *
 * @param float $usd Сума в доларах
 * @param int $uah Сума в гривнях
 * @return string Форматований рядок
 */
function formatConversionResult(float $usd, int $uah): string
{
    return "$usd долар = $uah грн";
}
