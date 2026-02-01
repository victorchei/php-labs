#!/usr/bin/env php
<?php
/**
 * Test Runner — Запуск тестів для варіанту v1
 *
 * Використання:
 *   php run_tests.php           — запустити всі тести
 *   php run_tests.php task3     — запустити тести тільки для task3
 *   php run_tests.php task4 task5 — запустити тести для task4 і task5
 */

// Кольори для терміналу
define('GREEN', "\033[32m");
define('RED', "\033[31m");
define('YELLOW', "\033[33m");
define('RESET', "\033[0m");
define('BOLD', "\033[1m");

/**
 * Запускає тести з файлу
 */
function runTestFile(string $testFile): array
{
    $results = ['passed' => 0, 'failed' => 0, 'errors' => []];

    if (!file_exists($testFile)) {
        $results['errors'][] = "Файл не знайдено: $testFile";
        return $results;
    }

    $tests = require $testFile;

    foreach ($tests as $functionName => $testCases) {
        echo "\n" . BOLD . "  Функція: $functionName" . RESET . "\n";

        foreach ($testCases as $test) {
            $testName = $test['name'];

            try {
                if (!function_exists($functionName)) {
                    echo RED . "    ✗ $testName" . RESET . "\n";
                    echo "      Функція '$functionName' не існує\n";
                    $results['failed']++;
                    continue;
                }

                $result = call_user_func_array($functionName, $test['input']);

                // Перевірка через validator або пряме порівняння
                if (isset($test['validator'])) {
                    $passed = $test['validator']($result);
                } else {
                    $passed = $result === $test['expected'];
                }

                if ($passed) {
                    echo GREEN . "    ✓ $testName" . RESET . "\n";
                    $results['passed']++;
                } else {
                    echo RED . "    ✗ $testName" . RESET . "\n";
                    echo "      Очікувалось: " . var_export($test['expected'], true) . "\n";
                    echo "      Отримано:    " . var_export($result, true) . "\n";
                    $results['failed']++;
                }
            } catch (Throwable $e) {
                echo RED . "    ✗ $testName" . RESET . "\n";
                echo "      Помилка: " . $e->getMessage() . "\n";
                $results['failed']++;
            }
        }
    }

    return $results;
}

// Головна функція
function main(array $argv): int
{
    echo "\n" . BOLD . "╔══════════════════════════════════════╗" . RESET . "\n";
    echo BOLD . "║  🧪 Test Runner — Варіант 1 (v1)     ║" . RESET . "\n";
    echo BOLD . "╚══════════════════════════════════════╝" . RESET . "\n";

    $testsDir = __DIR__ . '/tests';
    $totalPassed = 0;
    $totalFailed = 0;

    // Визначаємо які тести запускати
    $specificTasks = array_slice($argv, 1);

    $testFiles = glob("$testsDir/test_*.php");

    if (empty($testFiles)) {
        echo RED . "\nТести не знайдено в папці tests/" . RESET . "\n";
        return 1;
    }

    foreach ($testFiles as $testFile) {
        $taskName = basename($testFile, '.php');
        $taskName = str_replace('test_', '', $taskName);

        // Якщо вказані конкретні завдання — пропускаємо інші
        if (!empty($specificTasks) && !in_array($taskName, $specificTasks)) {
            continue;
        }

        echo "\n" . YELLOW . "━━━ " . strtoupper($taskName) . " ━━━" . RESET;

        $results = runTestFile($testFile);
        $totalPassed += $results['passed'];
        $totalFailed += $results['failed'];
    }

    // Підсумок
    echo "\n\n" . BOLD . "═══════════════════════════════════════" . RESET . "\n";
    echo BOLD . "РЕЗУЛЬТАТИ:" . RESET . "\n";
    echo GREEN . "  ✓ Пройдено: $totalPassed" . RESET . "\n";

    if ($totalFailed > 0) {
        echo RED . "  ✗ Провалено: $totalFailed" . RESET . "\n";
    }

    $total = $totalPassed + $totalFailed;
    $percentage = $total > 0 ? round(($totalPassed / $total) * 100) : 0;

    echo "\n  Загалом: $totalPassed/$total ($percentage%)\n";
    echo BOLD . "═══════════════════════════════════════" . RESET . "\n\n";

    return $totalFailed > 0 ? 1 : 0;
}

exit(main($argv));
