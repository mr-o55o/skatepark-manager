    <h4 class="text-danger"><?= __('Errors detected during operation:') ?></h4>
    <ul>
    <?php foreach($errors as $error): ?>
        <?php foreach($error as $message): ?>
            <li><?=$message?></li>
        <?php endforeach ?>
    <?php endforeach; ?>
    </ul>