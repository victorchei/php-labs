<?php
/**
 * Завдання 6: Операції з тризначним числом
 *
 * Демонстрація операцій з цифрами числа.
 */

/**
 * Обчислює суму цифр тризначного числа
 *
 * @param int $number Тризначне число (100-999)
 * @return int Сума всіх цифр
 */
function sumOfDigits(int $number): int
{
    $d1 = (int) floor($number / 100);
    $d2 = (int) floor(($number % 100) / 10);
    $d3 = $number % 10;

    return $d1 + $d2 + $d3;
}

/**
 * Повертає число в зворотному порядку
 *
 * @param int $number Тризначне число (100-999)
 * @return int Число з цифрами у зворотному порядку
 */
function reverseNumber(int $number): int
{
    $d1 = (int) floor($number / 100);
    $d2 = (int) floor(($number % 100) / 10);
    $d3 = $number % 10;

    return $d3 * 100 + $d2 * 10 + $d1;
}

/**
 * Повертає найбільше можливе число з цифр даного числа
 *
 * @param int $number Тризначне число (100-999)
 * @return int Найбільше число з тих самих цифр
 */
function maxFromDigits(int $number): int
{
    $d1 = (int) floor($number / 100);
    $d2 = (int) floor(($number % 100) / 10);
    $d3 = $number % 10;

    $digits = [$d1, $d2, $d3];
    rsort($digits);

    return $digits[0] * 100 + $digits[1] * 10 + $digits[2];
}
