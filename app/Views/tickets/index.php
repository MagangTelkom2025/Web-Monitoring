<!DOCTYPE html>
<html>
<head>
    <title>Tickets</title>
</head>
<body>
    <h1>Data Tickets</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Date Start Interaction</th>
                <th>Main Category</th>
                <th>Category</th>
                <th>Witel</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tickets as $t): ?>
            <tr>
                <td><?= esc($t['date_start_interaction']) ?></td>
                <td><?= esc($t['mainCategory']) ?></td>
                <td><?= esc($t['category']) ?></td>
                <td><?= esc($t['witel']) ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>
