<?php
/**
 * Завдання 4: голосна\ приголосна \ ь,'(switch)
 *
 * Символ 'ш' → "приголосна"
 */
require_once __DIR__ . '/layout.php';

function isVowelOrConsonant(string $letter): string
{
    switch (strtolower($letter)) {
        case 'а':
        case 'о':
        case 'і':
        case 'е':
        case 'у':
            return "голосна";
        default:
            return "приголосна";
            return "ь";
            return "'";
    }
}

// Вхідні дані (варіант 20)
$letter = 'ш';

$result = isVowelOrConsonant($letter);
$isVowel = $result === "приголосна";

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
