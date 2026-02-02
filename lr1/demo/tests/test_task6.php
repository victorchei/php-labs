<?php
/**
 * Тести для Завдання 6: Операції з тризначним числом
 */

require_once __DIR__ . '/../tasks/task6.php';

$tests = [
    'sumOfDigits' => [
        [
            'name' => 'Сума цифр 123 = 6',
            'input' => [123],
            'expected' => 6,
        ],
        [
            'name' => 'Сума цифр 100 = 1',
            'input' => [100],
            'expected' => 1,
        ],
        [
            'name' => 'Сума цифр 999 = 27',
            'input' => [999],
            'expected' => 27,
        ],
        [
            'name' => 'Сума цифр 456 = 15',
            'input' => [456],
            'expected' => 15,
        ],
    ],
    'reverseNumber' => [
        [
            'name' => 'Реверс 123 = 321',
            'input' => [123],
            'expected' => 321,
        ],
        [
            'name' => 'Реверс 100 = 1',
            'input' => [100],
            'expected' => 1,
        ],
        [
            'name' => 'Реверс 999 = 999',
            'input' => [999],
            'expected' => 999,
        ],
        [
            'name' => 'Реверс 120 = 21',
            'input' => [120],
            'expected' => 21,
        ],
    ],
    'maxFromDigits' => [
        [
            'name' => 'Макс з 123 = 321',
            'input' => [123],
            'expected' => 321,
        ],
        [
            'name' => 'Макс з 302 = 320',
            'input' => [302],
            'expected' => 320,
        ],
        [
            'name' => 'Макс з 987 = 987',
            'input' => [987],
            'expected' => 987,
        ],
        [
            'name' => 'Макс з 111 = 111',
            'input' => [111],
            'expected' => 111,
        ],
    ],
];

return $tests;
