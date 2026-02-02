<?php
/**
 * Скрипт валідації готовності лабораторної роботи
 *
 * Перевіряє:
 * 1. Структуру demo та всіх варіантів (v1-v15)
 * 2. Однакову кількість завдань
 * 3. Наявність тестів
 * 4. Демо-тести проходять
 * 5. Варіанти НЕ проходять тести (заглушки)
 * 6. Демо НЕ проходить тести варіантів
 *
 * Використання: php validate_lab.php
 */

define('VARIANTS_COUNT', 15);
define('COLOR_GREEN', "\033[32m");
define('COLOR_RED', "\033[31m");
define('COLOR_YELLOW', "\033[33m");
define('COLOR_RESET', "\033[0m");

$errors = [];
$warnings = [];
$passed = 0;
$failed = 0;

function printStatus($message, $status, $details = null) {
    global $passed, $failed;

    if ($status === 'pass') {
        echo COLOR_GREEN . "✓ " . COLOR_RESET . $message . "\n";
        $passed++;
    } elseif ($status === 'fail') {
        echo COLOR_RED . "✗ " . COLOR_RESET . $message . "\n";
        if ($details) {
            echo "  " . COLOR_YELLOW . $details . COLOR_RESET . "\n";
        }
        $failed++;
    } elseif ($status === 'warn') {
        echo COLOR_YELLOW . "⚠ " . COLOR_RESET . $message . "\n";
        if ($details) {
            echo "  " . $details . "\n";
        }
    } else {
        echo "  " . $message . "\n";
    }
}

function printHeader($title) {
    echo "\n" . COLOR_YELLOW . "═══ " . $title . " ═══" . COLOR_RESET . "\n\n";
}

function getTaskFiles($dir) {
    $tasksDir = $dir . '/tasks';
    if (!is_dir($tasksDir)) {
        return [];
    }
    $files = glob($tasksDir . '/task*.php');
    return array_map('basename', $files);
}

function getTestFiles($dir) {
    $testsDir = $dir . '/tests';
    if (!is_dir($testsDir)) {
        return [];
    }
    $files = glob($testsDir . '/test_task*.php');
    return array_map('basename', $files);
}

function runTests($dir) {
    $runTestsFile = $dir . '/run_tests.php';
    if (!file_exists($runTestsFile)) {
        return ['success' => false, 'output' => 'run_tests.php not found', 'passed' => 0, 'failed' => 0];
    }

    $cwd = getcwd();
    chdir($dir);

    ob_start();
    $output = shell_exec('php run_tests.php 2>&1');
    ob_end_clean();

    chdir($cwd);

    // Parse output to determine pass/fail counts
    $passed = 0;
    $failed = 0;

    // Match "Пройдено: 47" or "Passed: 47"
    if (preg_match('/Пройдено:\s*(\d+)/u', $output, $matches)) {
        $passed = (int)$matches[1];
    } elseif (preg_match('/Passed:\s*(\d+)/', $output, $matches)) {
        $passed = (int)$matches[1];
    }

    // Match "Провалено: 0" or "Failed: 0"
    if (preg_match('/Провалено:\s*(\d+)/u', $output, $matches)) {
        $failed = (int)$matches[1];
    } elseif (preg_match('/Failed:\s*(\d+)/', $output, $matches)) {
        $failed = (int)$matches[1];
    }

    // Also try to parse "Загалом: 47/47 (100%)"
    if ($passed === 0 && preg_match('/Загалом:\s*(\d+)\/(\d+)/u', $output, $matches)) {
        $passed = (int)$matches[1];
        $total = (int)$matches[2];
        $failed = $total - $passed;
    }

    // Check if all tests passed
    $allPassed = ($passed > 0 && $failed === 0) ||
                 (strpos($output, '100%') !== false && strpos($output, 'Провалено') === false);

    return [
        'success' => $allPassed,
        'output' => $output,
        'passed' => $passed,
        'failed' => $failed
    ];
}

// ============================================
// Start validation
// ============================================

echo "\n";
echo COLOR_YELLOW . "╔════════════════════════════════════════════════════════╗\n";
echo "║     ВАЛІДАЦІЯ ГОТОВНОСТІ ЛАБОРАТОРНОЇ РОБОТИ          ║\n";
echo "╚════════════════════════════════════════════════════════╝" . COLOR_RESET . "\n";

$labDir = __DIR__;
$demoDir = $labDir . '/demo';
$variantsDir = $labDir . '/variants';

// ============================================
// 1. Check demo structure
// ============================================
printHeader("1. Перевірка структури Demo");

if (is_dir($demoDir)) {
    printStatus("Папка demo/ існує", 'pass');
} else {
    printStatus("Папка demo/ не існує", 'fail');
    exit(1);
}

$demoTasks = getTaskFiles($demoDir);
$demoTests = getTestFiles($demoDir);

if (count($demoTasks) > 0) {
    printStatus("Demo містить " . count($demoTasks) . " завдань: " . implode(', ', $demoTasks), 'pass');
} else {
    printStatus("Demo не містить завдань у tasks/", 'fail');
}

if (count($demoTests) > 0) {
    printStatus("Demo містить " . count($demoTests) . " тестів: " . implode(', ', $demoTests), 'pass');
} else {
    printStatus("Demo не містить тестів у tests/", 'fail');
}

if (file_exists($demoDir . '/run_tests.php')) {
    printStatus("Demo містить run_tests.php", 'pass');
} else {
    printStatus("Demo не містить run_tests.php", 'fail');
}

// ============================================
// 2. Check variants structure
// ============================================
printHeader("2. Перевірка структури варіантів (v1-v15)");

$variantTaskCounts = [];
$missingVariants = [];

for ($i = 1; $i <= VARIANTS_COUNT; $i++) {
    $variantDir = $variantsDir . '/v' . $i;

    if (!is_dir($variantDir)) {
        $missingVariants[] = "v$i";
        continue;
    }

    $tasks = getTaskFiles($variantDir);
    $tests = getTestFiles($variantDir);
    $variantTaskCounts["v$i"] = count($tasks);

    if (count($tasks) === 0) {
        printStatus("v$i: немає завдань у tasks/", 'fail');
    }
    if (count($tests) === 0) {
        printStatus("v$i: немає тестів у tests/", 'fail');
    }
    if (!file_exists($variantDir . '/run_tests.php')) {
        printStatus("v$i: немає run_tests.php", 'fail');
    }
}

if (empty($missingVariants)) {
    printStatus("Всі 15 варіантів існують", 'pass');
} else {
    printStatus("Відсутні варіанти: " . implode(', ', $missingVariants), 'fail');
}

// ============================================
// 3. Check equal task counts
// ============================================
printHeader("3. Перевірка однакової кількості завдань");

$demoTaskCount = count($demoTasks);
$allEqual = true;
$taskCountDetails = ["demo: $demoTaskCount"];

foreach ($variantTaskCounts as $variant => $count) {
    $taskCountDetails[] = "$variant: $count";
    if ($count !== $demoTaskCount) {
        $allEqual = false;
    }
}

if ($allEqual && $demoTaskCount > 0) {
    printStatus("Однакова кількість завдань ($demoTaskCount) у demo та всіх варіантах", 'pass');
} else {
    printStatus("Різна кількість завдань", 'fail', implode(', ', $taskCountDetails));
}

// ============================================
// 4. Run demo tests
// ============================================
printHeader("4. Перевірка тестів Demo (мають ПРОХОДИТИ)");

$demoResult = runTests($demoDir);

if ($demoResult['success']) {
    printStatus("Демо-тести проходять (passed: {$demoResult['passed']})", 'pass');
} else {
    printStatus("Демо-тести НЕ проходять", 'fail', "Passed: {$demoResult['passed']}, Failed: {$demoResult['failed']}");
}

// ============================================
// 5. Run variant tests (should FAIL with stubs)
// ============================================
printHeader("5. Перевірка тестів варіантів (мають НЕ ПРОХОДИТИ - заглушки)");

$variantsWithPassingTests = [];

for ($i = 1; $i <= VARIANTS_COUNT; $i++) {
    $variantDir = $variantsDir . '/v' . $i;

    if (!is_dir($variantDir)) {
        continue;
    }

    $result = runTests($variantDir);

    if ($result['success'] && $result['passed'] > 0 && $result['failed'] === 0) {
        $variantsWithPassingTests[] = "v$i";
        printStatus("v$i: тести ПРОХОДЯТЬ (це помилка - заглушки мають давати FAIL)", 'fail');
    } else {
        printStatus("v$i: тести не проходять (очікувано для заглушок)", 'pass');
    }
}

if (empty($variantsWithPassingTests)) {
    printStatus("Всі варіанти мають тести що не проходять (заглушки)", 'pass');
}

// ============================================
// 6. Cross-validation: demo code vs variant tests
// ============================================
printHeader("6. Крос-валідація: демо-код НЕ має проходити тести варіантів");

// This is a more complex check - we'd need to copy demo tasks to variant and run tests
// For now, we'll just note this as a manual check or implement a simplified version

printStatus("Крос-валідація потребує ручної перевірки або додаткової реалізації", 'warn',
    "Переконайтесь що дані в demo відрізняються від даних у варіантах");

// ============================================
// Summary
// ============================================
printHeader("ПІДСУМОК");

$total = $passed + $failed;
$percentage = $total > 0 ? round(($passed / $total) * 100) : 0;

echo "Пройдено: " . COLOR_GREEN . $passed . COLOR_RESET . " / $total ($percentage%)\n";
echo "Провалено: " . COLOR_RED . $failed . COLOR_RESET . "\n\n";

if ($failed === 0) {
    echo COLOR_GREEN . "╔════════════════════════════════════════════════════════╗\n";
    echo "║          ✓ ЛАБОРАТОРНА ГОТОВА ДО ВИКОРИСТАННЯ          ║\n";
    echo "╚════════════════════════════════════════════════════════╝" . COLOR_RESET . "\n\n";
    exit(0);
} else {
    echo COLOR_RED . "╔════════════════════════════════════════════════════════╗\n";
    echo "║     ✗ ЛАБОРАТОРНА НЕ ГОТОВА - ВИПРАВТЕ ПОМИЛКИ        ║\n";
    echo "╚════════════════════════════════════════════════════════╝" . COLOR_RESET . "\n\n";
    exit(1);
}
