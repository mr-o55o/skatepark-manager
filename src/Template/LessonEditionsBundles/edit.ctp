<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonEditionsBundle $lessonEditionsBundle
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $lessonEditionsBundle->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $lessonEditionsBundle->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Lesson Editions Bundles'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Purchased Lesson Editions Bundles'), ['controller' => 'PurchasedLessonEditionsBundles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purchased Lesson Editions Bundle'), ['controller' => 'PurchasedLessonEditionsBundles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="lessonEditionsBundles form large-9 medium-8 columns content">
    <?= $this->Form->create($lessonEditionsBundle) ?>
    <fieldset>
        <legend><?= __('Edit Lesson Editions Bundle') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('description');
            echo $this->Form->control('lesson_edition_count');
            echo $this->Form->control('is_active');
            echo $this->Form->control('price');
            echo $this->Form->control('lesson_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
