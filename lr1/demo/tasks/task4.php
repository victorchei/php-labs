<?php
/**
 * Завдання 4: Визначення пори року (if-else)
 *
 * Демонстрація використання if-else для визначення сезону.
 */

/**
 * Визначає пору року за номером місяця
 *
 * Правила:
 * - 3-5: "Весна"
 * - 6-8: "Літо"
 * - 9-11: "Осінь"
 * - 12, 1, 2: "Зима"
 *
 * @param int $month Номер місяця (1-12)
 * @return string Пора року ("Весна", "Літо", "Осінь", "Зима")
 */
function determineSeason(int $month): string
{
    if ($month >= 3 && $month <= 5) {
        return "Весна";
    } elseif ($month >= 6 && $month <= 8) {
        return "Літо";
    } elseif ($month >= 9 && $month <= 11) {
        return "Осінь";
    } else {
        return "Зима";
    }
}
