<?= $this->extend('layout/app/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h1 class="h3 mb-4">Ticket</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date Start Interaction</th>
                <th>Main Category</th>
                <th>Category</th>
                <th>Witel</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($tickets)): ?>
                <?php foreach ($tickets as $t): ?>
                    <tr>
                        <td><?= esc($t['date_start_interaction']) ?></td>
                        <td><?= esc($t['mainCategory']) ?></td>
                        <td><?= esc($t['category']) ?></td>
                        <td><?= esc($t['witel']) ?></td>
                        
                    </tr>
                <?php endforeach ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data</td>
                </tr>
            <?php endif ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
