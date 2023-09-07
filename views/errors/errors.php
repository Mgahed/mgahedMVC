<div>
    <h1 class="text-danger">Validation Errors</h1>
    <?php foreach ($errors as $key => $error) : ?>
        <h4><?= $key ?></h4>
        <ul>
            <?php foreach ($error as $e) : ?>
                <li><?= $e; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>
</div>