<?php
/**
 * Тести для Завдання 7: Робота з циклами
 *
 * Примітка: ці тести перевіряють базову структуру HTML,
 * а не точний вигляд (кольори можуть бути випадковими)
 */

require_once __DIR__ . '/../tasks/task7.php';

$tests = [
    'generateChessboard' => [
        [
            'name' => 'Дошка 2×2 містить таблицю',
            'input' => [2],
            'validator' => function ($result) {
                return strpos($result, '<table') !== false
                    && strpos($result, '</table>') !== false;
            },
            'expected' => 'HTML з <table>',
        ],
        [
            'name' => 'Дошка 8×8 має 8 рядків (tr)',
            'input' => [8],
            'validator' => function ($result) {
                return substr_count($result, '<tr') === 8;
            },
            'expected' => '8 рядків <tr>',
        ],
        [
            'name' => 'Дошка 8×8 має 64 комірки (td)',
            'input' => [8],
            'validator' => function ($result) {
                return substr_count($result, '<td') === 64;
            },
            'expected' => '64 комірки <td>',
        ],
        [
            'name' => 'Дошка містить білий колір (#fff або white)',
            'input' => [8],
            'validator' => function ($result) {
                return stripos($result, '#fff') !== false
                    || stripos($result, 'white') !== false
                    || stripos($result, '#ffffff') !== false;
            },
            'expected' => 'Білий колір',
        ],
        [
            'name' => 'Дошка містить чорний колір (#000 або black)',
            'input' => [8],
            'validator' => function ($result) {
                return stripos($result, '#000') !== false
                    || stripos($result, 'black') !== false;
            },
            'expected' => 'Чорний колір',
        ],
    ],
    'generateRandomCircles' => [
        [
            'name' => '10 кіл — 10 div елементів',
            'input' => [10],
            'validator' => function ($result) {
                // Рахуємо div-и з border-radius (кола)
                return substr_count($result, 'border-radius') >= 10
                    || substr_count($result, '<div') >= 11; // 10 кіл + контейнер
            },
            'expected' => '10+ div елементів',
        ],
        [
            'name' => 'Кола мають жовтий колір',
            'input' => [5],
            'validator' => function ($result) {
                return stripos($result, 'yellow') !== false
                    || stripos($result, '#ff') !== false
                    || stripos($result, 'rgb(255') !== false;
            },
            'expected' => 'Жовтий колір',
        ],
        [
            'name' => 'Контейнер має синій фон',
            'input' => [5],
            'validator' => function ($result) {
                return stripos($result, '#0066cc') !== false
                    || stripos($result, 'blue') !== false
                    || stripos($result, '#00') !== false;
            },
            'expected' => 'Синій фон',
        ],
    ],
];

return $tests;
