<?php
/**
 * Завдання 2: Виведення форматованого тексту
 *
 * Демонстрація виведення HTML з форматуванням.
 */

/**
 * Генерує HTML з віршем та форматуванням
 *
 * Вірш:
 * Полину в мріях в купель океану,
 * Відчую шовковистість глибини,
 * Чарівні мушлі з дна собі дістану,
 * Щоб взимку тішили мене вони…
 *
 * Вимоги:
 * - Слово "шовковистість" — жирним (<b>)
 * - Слово "взимку" — курсивом (<i>)
 * - Кожен рядок в окремому <p>
 * - Останні слова "Щоб взимку тішили мене вони…" з відступами
 *
 * @return string HTML-код вірша
 */
function generatePoem(): string
{
    $html = "";
    $html .= "<p>Полину в мріях в купель океану,</p>";
    $html .= "<p>Відчую <b>шовковистість</b> глибини,</p>";
    $html .= "<p>Чарівні мушлі з дна собі дістану,</p>";
    $html .= "<p style='margin-left: 20px;'>Щоб <i>взимку</i></p>";
    $html .= "<p style='margin-left: 40px;'>тішили</p>";
    $html .= "<p style='margin-left: 60px;'>мене</p>";
    $html .= "<p style='margin-left: 80px;'>вони…</p>";
    return $html;
}

/**
 * Перевіряє чи містить HTML жирний текст
 *
 * @param string $html HTML-код
 * @param string $text Текст що має бути жирним
 * @return bool
 */
function hasBoldText(string $html, string $text): bool
{
    return strpos($html, "<b>$text</b>") !== false;
}

/**
 * Перевіряє чи містить HTML курсивний текст
 *
 * @param string $html HTML-код
 * @param string $text Текст що має бути курсивом
 * @return bool
 */
function hasItalicText(string $html, string $text): bool
{
    return strpos($html, "<i>$text</i>") !== false;
}
