<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchasedLessonEditionsBundle $purchasedLessonEditionsBundle
 */
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
<div class="purchasedLessonEditionsBundles content">
    <?= $this->Form->create($purchasedLessonEditionsBundle) ?>
    <fieldset>
        <legend><?= __('Add Purchased Lesson Editions Bundle') ?></legend>
        <?php
            echo $this->Form->control('athlete_id', ['options' => $athletes]);
            echo $this->Form->control('lesson_editions_bundle_id', ['options' => $lessonEditionsBundles]);
            echo $this->Form->control('is_active');
            echo $this->Form->control('start_date');
            echo $this->Form->control('end_date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
