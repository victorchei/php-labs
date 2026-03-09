<?php
require_once __DIR__ . '/layout.php';

function sortByName(array $people): array
{
    ksort($people);
    return $people;
}

function sortByAge(array $people): array
{
    asort($people);
    return $people;
}

$people = [
        "Олена" => 28,
        "Дмитро" => 34,
        "Марія" => 22,
        "Сергій" => 45,
        "Ірина" => 31,
        "Богдан" => 19,
        "Катерина" => 53,
];

$sortBy = $_POST['sort'] ?? $_GET['sort'] ?? 'name';
$sorted = $sortBy === 'age' ? sortByAge($people) : sortByName($people);

ob_start();
?>
    <div class="demo-card">
        <h2>Асоціативний масив</h2>
        <p class="demo-subtitle">Сортування за іменем або за віком</p>

        <div class="flex-buttons">
            <form method="post">
                <input type="hidden" name="sort" value="name">
                <button type="submit" class="<?= $sortBy === 'name' ? 'btn-submit' : 'btn-secondary' ?>">За іменем</button>
            </form>
            <form method="post">
                <input type="hidden" name="sort" value="age">
                <button type="submit" class="<?= $sortBy === 'age' ? 'btn-submit' : 'btn-secondary' ?>">За віком</button>
            </form>
        </div>

        <div class="demo-section">
            <h3>Вхідні дані</h3>
            <div class="demo-code">$people = [
                <?php foreach ($people as $name => $age): ?>
                    "<?= $name ?>" => <?= $age ?>,
                <?php endforeach; ?>
                ];</div>
        </div>

        <div class="demo-section">
            <h3>Відсортовано: <span class="demo-tag demo-tag-primary"><?= $sortBy === 'age' ? 'за віком' : 'за іменем' ?></span></h3>
            <table class="demo-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Ім'я <?= $sortBy === 'name' ? '&#8593;' : '' ?></th>
                    <th>Вік <?= $sortBy === 'age' ? '&#8593;' : '' ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; foreach ($sorted as $name => $age): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= htmlspecialchars($name) ?></td>
                        <td><span class="demo-tag demo-tag-success"><?= $age ?> р.</span></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="demo-code"><?= $sortBy === 'age' ? 'sortByAge' : 'sortByName' ?>($people);
            // <?= $sortBy === 'age' ? 'asort($people)' : 'ksort($people)' ?></div>
    </div>
<?php
$content = ob_get_clean();
renderVariantLayout($content, 'Завдання 9');