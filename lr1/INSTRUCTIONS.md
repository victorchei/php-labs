# Покрокова інструкція виконання ЛР1

[← README](README.md)

---

## ⚠️ Важливо перед початком

1. **Демо ≠ Варіант.** Код у папці `demo/` — це приклад реалізації, але він **не співпадає з вашим варіантом**. Ваші завдання відрізняються від демо, тому копіювання демо-коду не допоможе здати роботу.

2. **Перевіряйте код тестами.** Після реалізації кожної функції обов'язково запускайте тести:

   ```bash
   php run_tests.php          # Всі тести
   php run_tests.php task3    # Тести для конкретного завдання
   ```

3. **Візуальна перевірка через браузер.** Для завдань 7.1 та 7.2 (таблиці, кола) відкривайте результат у браузері, щоб переконатися, що все відображається правильно. Використовуйте вбудований PHP-сервер:

   ```bash
   php -S localhost:8000
   ```

   Потім відкрийте `http://localhost:8000/task7_table.php` або `http://localhost:8000/task7_circles.php`

---

## Крок 0: Теоретична підготовка

1. Перейдіть на [PHP Tutorial](https://www.w3schools.com/php/)
2. Ознайомтесь з розділами:
   - PHP Variables
   - PHP Data Types
   - PHP Operators
   - PHP if...else...elseif
   - PHP switch
   - PHP Loops

---

## Крок 1: Встановлення середовища

### Windows (WAMP)

1. Завантажте WAMP з [wampserver.com](https://www.wampserver.com/en/)
2. Встановіть Visual C++ Redistributable (якщо потрібно):
   - [Microsoft VC++ 2015-2022](https://learn.microsoft.com/en-us/cpp/windows/latest-supported-vc-redist)
3. Встановіть WAMP
4. Запустіть WAMP (іконка в треї має стати зеленою)
5. Перевірте: відкрийте http://localhost/ в браузері

### macOS / Linux

Використовуйте скрипт з папки `setup/`:
```bash
cd setup && chmod +x install.sh && ./install.sh
```

Або встановіть вручну PHP та запустіть вбудований сервер:
```bash
php -S localhost:8000
```

---

## Крок 2: Створення проєкту

### Windows (WAMP)
```
C:\wamp64\www\lr1\
```

### macOS / Linux
```
php-labs/lr1/demo/
```

---

## Крок 3: Завдання 2 — Виведення тексту

Створіть файл `task2.php`:

```php
<?php
echo "<p>Полину в мріях в купель океану,</p>";
echo "<p>Відчую <b>шовковистість</b> глибини,</p>";
echo "<p>Чарівні мушлі з дна собі дістану,</p>";
echo "<p style='margin-left: 20px;'>Щоб <i>взимку</i></p>";
echo "<p style='margin-left: 40px;'>тішили</p>";
echo "<p style='margin-left: 60px;'>мене</p>";
echo "<p style='margin-left: 80px;'>вони…</p>";
?>
```

**Перевірка:** відкрийте http://localhost/lr1/task2.php

---

## Крок 4: Завдання 3 — Конвертер валют

Створіть файл `task3.php`:

```php
<?php
$uah = 1500;        // Сума в гривнях
$rate = 41.5;       // Курс долара

$usd = floor($uah / $rate);

echo "$uah грн. можна обміняти на $usd долар";
?>
```

---

## Крок 5: Завдання 4 — Сезон за місяцем (if-else)

Створіть файл `task4.php`:

```php
<?php
$month = 7; // Номер місяця (1-12)

if ($month >= 3 && $month <= 5) {
    $season = "Весна";
} elseif ($month >= 6 && $month <= 8) {
    $season = "Літо";
} elseif ($month >= 9 && $month <= 11) {
    $season = "Осінь";
} else {
    $season = "Зима";
}

echo "Місяць $month — це $season";
?>
```

---

## Крок 6: Завдання 5 — Голосна/приголосна (switch)

Створіть файл `task5.php`:

```php
<?php
$letter = 'a';

switch (strtolower($letter)) {
    case 'a':
    case 'e':
    case 'i':
    case 'o':
    case 'u':
        echo "'$letter' — голосна";
        break;
    default:
        echo "'$letter' — приголосна";
}
?>
```

---

## Крок 7: Завдання 6 — Тризначне число

Створіть файл `task6.php`:

```php
<?php
$number = mt_rand(100, 999);

// Розбиваємо на цифри
$d1 = floor($number / 100);        // сотні
$d2 = floor(($number % 100) / 10); // десятки
$d3 = $number % 10;                // одиниці

// 1. Сума цифр
$sum = $d1 + $d2 + $d3;

// 2. Число в зворотному порядку
$reversed = $d3 * 100 + $d2 * 10 + $d1;

// 3. Найбільше можливе число
$digits = [$d1, $d2, $d3];
rsort($digits);
$max = $digits[0] * 100 + $digits[1] * 10 + $digits[2];

echo "Число: $number<br>";
echo "1. Сума цифр: $sum<br>";
echo "2. В зворотному порядку: $reversed<br>";
echo "3. Найбільше можливе: $max<br>";
?>
```

---

## Крок 8: Завдання 7.1 — Таблиця n×n

Створіть файл `task7_table.php`:

```php
<?php
function drawTable($rows, $cols) {
    echo "<table border='1' cellspacing='0'>";
    for ($i = 0; $i < $rows; $i++) {
        echo "<tr>";
        for ($j = 0; $j < $cols; $j++) {
            $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            echo "<td style='width:50px; height:50px; background:$color;'></td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

drawTable(5, 5);
?>
```

---

## Крок 9: Завдання 7.2 — Випадкові квадрати

Створіть файл `task7_squares.php`:

```php
<?php
function drawSquares($n) {
    echo "<div style='position:relative; width:100vw; height:100vh; background:black;'>";
    for ($i = 0; $i < $n; $i++) {
        $size = mt_rand(20, 100);
        $top = mt_rand(0, 90);
        $left = mt_rand(0, 90);
        echo "<div style='
            position: absolute;
            width: {$size}px;
            height: {$size}px;
            background: red;
            top: {$top}%;
            left: {$left}%;
        '></div>";
    }
    echo "</div>";
}

drawSquares(10);
?>
```

---

## Крок 10: Здача роботи

1. Створіть гілку `Back-End` у вашому репозиторії
2. Завантажте всі файли
3. Надайте доступ викладачу
4. Підготуйте звіт з скріншотами результатів

---

## Корисні посилання

- [PHP Manual](https://www.php.net/manual/en/)
- [W3Schools PHP](https://www.w3schools.com/php/)
- [PHP The Right Way](https://phptherightway.com/)
