<?php
/**
 * Тести для Завдання 7: Робота з циклами
 */

require_once __DIR__ . '/../tasks/task7.php';

$tests = [
    'generateColorTable' => [
        [
            'name' => 'Таблиця 3×3 містить <table>',
            'input' => [3],
            'validator' => function ($result) {
                return strpos($result, '<table') !== false
                    && strpos($result, '</table>') !== false;
            },
            'expected' => 'HTML з <table>',
        ],
        [
            'name' => 'Таблиця 5×5 має 5 рядків (tr)',
            'input' => [5],
            'validator' => function ($result) {
                return substr_count($result, '<tr') === 5;
            },
            'expected' => '5 рядків <tr>',
        ],
        [
            'name' => 'Таблиця 5×5 має 25 комірок (td)',
            'input' => [5],
            'validator' => function ($result) {
                return substr_count($result, '<td') === 25;
            },
            'expected' => '25 комірок <td>',
        ],
        [
            'name' => 'Таблиця містить кольори (background)',
            'input' => [3],
            'validator' => function ($result) {
                return stripos($result, 'background') !== false;
            },
            'expected' => 'CSS background',
        ],
    ],
    'generateRandomSquares' => [
        [
            'name' => '10 квадратів — 10+ div елементів',
            'input' => [10],
            'validator' => function ($result) {
                return substr_count($result, '<div') >= 11; // 10 квадратів + контейнер
            },
            'expected' => '11+ div елементів',
        ],
        [
            'name' => 'Квадрати мають червоний колір',
            'input' => [5],
            'validator' => function ($result) {
                return stripos($result, 'red') !== false
                    || stripos($result, '#ff0000') !== false;
            },
            'expected' => 'Червоний колір',
        ],
        [
            'name' => 'Контейнер має чорний фон',
            'input' => [5],
            'validator' => function ($result) {
                return stripos($result, 'black') !== false
                    || stripos($result, '#000') !== false;
            },
            'expected' => 'Чорний фон',
        ],
    ],
];

return $tests;
