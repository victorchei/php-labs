<?php
/**
 * Завдання 4: Голосний чи приголосний (switch)
 *
 * Символ 'р' → "приголосна"
 */
require_once __DIR__ . '/layout.php';

function isVowelOrConsonant(string $letter): string
{
    switch (strtolower($letter)) {
        case 'а':
        case 'е':
        case 'є':
        case 'и':
        case 'і':
        case 'ї':
        case 'о':
        case 'у':
        case 'ю':
        case 'я':
            return "голосна";
        default:
            return "приголосна";
    }
}

// Вхідні дані (варіант 30)
$letter = 'р';

$result = isVowelOrConsonant($letter);
$isVowel = $result === "голосна";

$color = $isVowel ? "#10b981" : "#8b5cf6";
$emoji = $isVowel ? "🔊" : "🔇";

$content = '<div class="card large">
    <div class="letter-display" style="color:' . $color . '">' . $letter . '</div>
    <div class="letter-emoji" style="color:' . $color . '">' . $emoji . '</div>
    <div class="letter-result">
        Літера <strong>\'' . $letter . '\'</strong> — <span style="color:' . $color . '">' . $result . '</span>
    </div>
    <p class="info">isVowelOrConsonant(\'' . $letter . '\') = "' . $result . '"</p>
</div>';

renderVariantLayout($content, 'Завдання 4', 'task5-body');
