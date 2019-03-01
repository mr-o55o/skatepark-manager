<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchasedLessonEditionsBundlesStatus $purchasedLessonEditionsBundlesStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $purchasedLessonEditionsBundlesStatus->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $purchasedLessonEditionsBundlesStatus->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Purchased Lesson Editions Bundles Statuses'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="purchasedLessonEditionsBundlesStatuses form large-9 medium-8 columns content">
    <?= $this->Form->create($purchasedLessonEditionsBundlesStatus) ?>
    <fieldset>
        <legend><?= __('Edit Purchased Lesson Editions Bundles Status') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
