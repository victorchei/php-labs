<?php

require_once __DIR__ . '/layout.php';

function extractFilename(string $path): string
{
    return pathinfo($path, PATHINFO_FILENAME);
}

function extractExtension(string $path): string
{
    return pathinfo($path, PATHINFO_EXTENSION);
}

function extractDirectory(string $path): string
{
    return pathinfo($path, PATHINFO_DIRNAME);
}

$defaultPath = "D:\Projects\WebApp\index.php";
$path = $_POST['path'] ?? $defaultPath;

$filename = extractFilename($path);
$extension = extractExtension($path);
$directory = extractDirectory($path);

ob_start();
?>
    <div class="demo-card">
        <h2>Завдання 3: Аналіз шляху до файлу</h2>
        <p class="demo-subtitle">Розбір повного шляху на компоненти</p>

        <form method="post" class="demo-form">
            <div>
                <label for="path">Введіть повний шлях до файлу:</label>
                <input type="text" id="path" name="path" value="<?= htmlspecialchars($path) ?>" class="form-control" style="width: 100%;">
            </div>
            <button type="submit" class="btn-submit" style="margin-top: 10px;">Розібрати шлях</button>
        </form>

        <div class="demo-result" style="margin-top: 25px;">
            <h3>Результат обробки:</h3>

            <div class="demo-section">
                <table class="demo-table" style="width: 100%; border-collapse: collapse;">
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 10px; font-weight: bold; color: #555;">Директорія:</td>
                        <td style="padding: 10px; color: #2d3748;">"<?= htmlspecialchars($directory) ?>"</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 10px; font-weight: bold; color: #555;">Імʼя файлу:</td>
                        <td style="padding: 10px; color: #2d3748;">"<?= htmlspecialchars($filename) ?>"</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; font-weight: bold; color: #555;">Розширення:</td>
                        <td style="padding: 10px; color: #2d3748;">"<?= htmlspecialchars($extension) ?>"</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="demo-code" style="margin-top: 20px; background: #f8fafc; padding: 15px; border-radius: 8px; font-family: monospace; font-size: 0.85em;">
            <br>
            $info = pathinfo("<?= addslashes($path) ?>");<br>
            // Filename: <?= htmlspecialchars($filename) ?><br>
            // Extension: <?= htmlspecialchars($extension) ?><br>
            // Dirname: <?= htmlspecialchars($directory) ?>
        </div>
    </div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 3');