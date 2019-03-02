<?php

?>
<?php if (isset($errors)) : ?>
    <h3 class="text-danger"><?= __('Errors detected during operation:') ?></h3>
    <p>
    <?php foreach($errors as $field): ?>
    	<?= key($errors) ?>
        <?php foreach($field as $error): ?>
            <p><?=$error?></p>
        <?php endforeach ?>
    <?php endforeach; ?>
    </p>
<?php endif; ?>