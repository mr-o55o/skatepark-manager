<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchasedLessonEditionsBundle $purchasedLessonEditionsBundle
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $purchasedLessonEditionsBundle->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $purchasedLessonEditionsBundle->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Purchased Lesson Editions Bundles'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Athletes'), ['controller' => 'Athletes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Athlete'), ['controller' => 'Athletes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Lesson Editions Bundles'), ['controller' => 'LessonEditionsBundles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Lesson Editions Bundle'), ['controller' => 'LessonEditionsBundles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="purchasedLessonEditionsBundles form large-9 medium-8 columns content">
    <?= $this->Form->create($purchasedLessonEditionsBundle) ?>
    <fieldset>
        <legend><?= __('Edit Purchased Lesson Editions Bundle') ?></legend>
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
