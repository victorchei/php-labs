<?php

require_once __DIR__ . '/layout.php';

function dateDifference(string $date1, string $date2): int
{
    $d1 = DateTime::createFromFormat('d-m-Y', $date1);
    $d2 = DateTime::createFromFormat('d-m-Y', $date2);

    if (!$d1 || !$d2) return 0;

    $interval = $d1->diff($d2);
    return (int)$interval->format('%a');
}

function getWeekdayUkrainian(string $date): string
{
    $days = [
            'Monday' => 'понеділок', 'Tuesday' => 'вівторок', 'Wednesday' => 'середа',
            'Thursday' => 'четвер', 'Friday' => 'п\'ятниця', 'Saturday' => 'субота', 'Sunday' => 'неділя',
    ];
    $d = DateTime::createFromFormat('d-m-Y', $date);
    return $d ? $days[$d->format('l')] : '';
}

$date1_input = $_POST['date1'] ?? "15-03-2023";
$date2_input = $_POST['date2'] ?? "28-07-2024";

$diffDays = dateDifference($date1_input, $date2_input);

ob_start();
?>
    <div class="demo-card">
        <h2>Завдання 4: Різниця дат</h2>
        <p class="demo-subtitle">Обчислення інтервалу між заданими датами</p>

        <form method="post" class="demo-form">
            <div class="form-row">
                <div>
                    <label for="date1">Дата 1 (ДД-ММ-РРРР)</label>
                    <input type="text" id="date1" name="date1" value="<?= htmlspecialchars($date1_input) ?>">
                </div>
                <div>
                    <label for="date2">Дата 2 (ДД-ММ-РРРР)</label>
                    <input type="text" id="date2" name="date2" value="<?= htmlspecialchars($date2_input) ?>">
                </div>
            </div>
            <button type="submit" class="btn-submit">Обчислити різницю</button>
        </form>

        <div class="demo-result" style="margin-top: 20px;">
            <h3>Результат:</h3>
            <div class="demo-result-value" style="font-size: 24px; color: #2d3748; padding: 20px; background: #f0f4f8; border-radius: 12px; text-align: center; border: 2px dashed #cbd5e0;">
                <strong><?= $diffDays ?></strong> днів
            </div>
        </div>

        <div class="demo-section">
            <table class="demo-table" style="width: 100%; margin-top: 15px;">
                <tr>
                    <td style="padding: 8px;"><strong>Початкова дата:</strong></td>
                    <td><?= htmlspecialchars($date1_input) ?> (<?= getWeekdayUkrainian($date1_input) ?>)</td>
                </tr>
                <tr>
                    <td style="padding: 8px;"><strong>Кінцева дата:</strong></td>
                    <td><?= htmlspecialchars($date2_input) ?> (<?= getWeekdayUkrainian($date2_input) ?>)</td>
                </tr>
            </table>
        </div>

        <div class="demo-code" style="background: #fffaf0; border-left: 4px solid #ed8936;">
            <br>
        </div>
    </div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 4');