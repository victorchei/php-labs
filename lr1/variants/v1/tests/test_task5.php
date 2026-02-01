<?php
/**
 * Тести для Завдання 5: Парне/Непарне
 */

require_once __DIR__ . '/../tasks/task5.php';

$tests = [
    'isEvenOrOdd' => [
        // Парні
        [
            'name' => 'Цифра 0 — парна',
            'input' => [0],
            'expected' => 'парна',
        ],
        [
            'name' => 'Цифра 2 — парна',
            'input' => [2],
            'expected' => 'парна',
        ],
        [
            'name' => 'Цифра 4 — парна',
            'input' => [4],
            'expected' => 'парна',
        ],
        [
            'name' => 'Цифра 6 — парна',
            'input' => [6],
            'expected' => 'парна',
        ],
        [
            'name' => 'Цифра 8 — парна',
            'input' => [8],
            'expected' => 'парна',
        ],
        // Непарні
        [
            'name' => 'Цифра 1 — непарна',
            'input' => [1],
            'expected' => 'непарна',
        ],
        [
            'name' => 'Цифра 3 — непарна',
            'input' => [3],
            'expected' => 'непарна',
        ],
        [
            'name' => 'Цифра 5 — непарна',
            'input' => [5],
            'expected' => 'непарна',
        ],
        [
            'name' => 'Цифра 7 — непарна',
            'input' => [7],
            'expected' => 'непарна',
        ],
        [
            'name' => 'Цифра 9 — непарна',
            'input' => [9],
            'expected' => 'непарна',
        ],
    ],
];

return $tests;
