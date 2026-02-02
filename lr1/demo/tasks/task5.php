<?php
/**
 * Завдання 5: Голосна/приголосна (switch)
 *
 * Демонстрація використання switch для класифікації літер.
 */

/**
 * Визначає чи є літера голосною чи приголосною
 *
 * Голосні: a, e, i, o, u
 * Інші англійські літери — приголосні
 *
 * @param string $letter Англійська літера (a-z)
 * @return string "голосна" або "приголосна"
 */
function isVowelOrConsonant(string $letter): string
{
    switch (strtolower($letter)) {
        case 'a':
        case 'e':
        case 'i':
        case 'o':
        case 'u':
            return "голосна";
        default:
            return "приголосна";
    }
}
