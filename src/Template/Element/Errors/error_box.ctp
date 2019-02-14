<?php

?>
<?php if (isset($errors)) : ?>
    <h3 class="text-danger"><?= __('Errors detected during add operation:') ?></h3>
    <ul>
    <?php foreach($errors as $field): ?>
        <?php foreach($field as $error): ?>
            <li><?=$error?></li>
        <?php endforeach ?>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>