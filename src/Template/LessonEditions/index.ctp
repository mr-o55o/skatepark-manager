<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonEdition[]|\Cake\Collection\CollectionInterface $lessonEditions
 */
?>
<div class="lessonEditions index content">
    <h3>
        <?= __('Lesson Management') ?> - <?= __('All Editions') ?>
        <br><small><?= __('...') ?></small>
    </h3>
    <?php echo $this->element('LessonEditions/lesson-editions-index-menu'); ?>
    <hr>
    <?php echo $this->element('LessonEditions/lesson-editions-table'); ?>
</div>
