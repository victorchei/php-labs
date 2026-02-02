<?php
/**
 * Тести для Завдання 3: Конвертер валют (USD → UAH)
 */

require_once __DIR__ . '/../tasks/task3.php';

$tests = [
    'convertUsdToUah' => [
        [
            'name' => 'Конвертація 100 USD за курсом 41.50',
            'input' => [100, 41.50],
            'expected' => 4150,
        ],
        [
            'name' => 'Конвертація 50 USD за курсом 41.00',
            'input' => [50, 41.00],
            'expected' => 2050,
        ],
        [
            'name' => 'Конвертація 1 USD за курсом 41.75',
            'input' => [1, 41.75],
            'expected' => 41,
        ],
        [
            'name' => 'Округлення вниз (33 USD × 41.50 = 1369.5 → 1369)',
            'input' => [33, 41.50],
            'expected' => 1369,
        ],
    ],
    'formatConversionResult' => [
        [
            'name' => 'Форматування 100 USD = 4150 UAH',
            'input' => [100, 4150],
            'expected' => '100 долар = 4150 грн',
        ],
        [
            'name' => 'Форматування 50 USD = 2050 UAH',
            'input' => [50, 2050],
            'expected' => '50 долар = 2050 грн',
        ],
    ],
];

return $tests;
