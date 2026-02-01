<?php
/**
 * Тести для Завдання 3: Конвертер валют
 */

require_once __DIR__ . '/../tasks/task3.php';

$tests = [
    'convertEurToUah' => [
        [
            'name' => 'Конвертація 250 EUR за курсом 45.20',
            'input' => [250, 45.20],
            'expected' => 11300,
        ],
        [
            'name' => 'Конвертація 100 EUR за курсом 45.00',
            'input' => [100, 45.00],
            'expected' => 4500,
        ],
        [
            'name' => 'Конвертація 1 EUR за курсом 45.50',
            'input' => [1, 45.50],
            'expected' => 45,
        ],
        [
            'name' => 'Округлення вниз (33 EUR × 45.20 = 1491.6 → 1491)',
            'input' => [33, 45.20],
            'expected' => 1491,
        ],
    ],
    'formatConversionResult' => [
        [
            'name' => 'Форматування 250 EUR = 11300 UAH',
            'input' => [250, 11300],
            'expected' => '250 євро = 11300 грн',
        ],
        [
            'name' => 'Форматування 100 EUR = 4500 UAH',
            'input' => [100, 4500],
            'expected' => '100 євро = 4500 грн',
        ],
    ],
];

return $tests;
