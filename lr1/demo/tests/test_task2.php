<?php
/**
 * Тести для Завдання 2: Виведення форматованого тексту
 */

require_once __DIR__ . '/../tasks/task2.php';

$tests = [
    'generatePoem' => [
        [
            'name' => 'Вірш містить параграфи (<p>)',
            'input' => [],
            'validator' => function ($result) {
                return substr_count($result, '<p') >= 4;
            },
            'expected' => '4+ параграфів',
        ],
        [
            'name' => 'Слово "шовковистість" жирним',
            'input' => [],
            'validator' => function ($result) {
                return strpos($result, '<b>шовковистість</b>') !== false;
            },
            'expected' => '<b>шовковистість</b>',
        ],
        [
            'name' => 'Слово "взимку" курсивом',
            'input' => [],
            'validator' => function ($result) {
                return strpos($result, '<i>взимку</i>') !== false;
            },
            'expected' => '<i>взимку</i>',
        ],
        [
            'name' => 'Містить відступи (margin-left)',
            'input' => [],
            'validator' => function ($result) {
                return strpos($result, 'margin-left') !== false;
            },
            'expected' => 'margin-left стилі',
        ],
        [
            'name' => 'Містить текст "океану"',
            'input' => [],
            'validator' => function ($result) {
                return strpos($result, 'океану') !== false;
            },
            'expected' => 'Текст вірша',
        ],
    ],
    'hasBoldText' => [
        [
            'name' => 'Знаходить жирний текст',
            'input' => ['<p>Це <b>важливо</b></p>', 'важливо'],
            'expected' => true,
        ],
        [
            'name' => 'Не знаходить якщо немає',
            'input' => ['<p>Це текст</p>', 'важливо'],
            'expected' => false,
        ],
    ],
    'hasItalicText' => [
        [
            'name' => 'Знаходить курсивний текст',
            'input' => ['<p>Це <i>курсив</i></p>', 'курсив'],
            'expected' => true,
        ],
        [
            'name' => 'Не знаходить якщо немає',
            'input' => ['<p>Це текст</p>', 'курсив'],
            'expected' => false,
        ],
    ],
];

return $tests;
