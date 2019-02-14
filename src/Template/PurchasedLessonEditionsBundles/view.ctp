<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchasedLessonEditionsBundle $purchasedLessonEditionsBundle
 */
?>
<div class="purchasedLessonEditionsBundles content">
    <h3><?= h($purchasedLessonEditionsBundle->id) ?></h3>

    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Athlete') ?></th>
            <td><?= $purchasedLessonEditionsBundle->has('athlete') ? $this->Html->link($purchasedLessonEditionsBundle->athlete->name, ['controller' => 'Athletes', 'action' => 'view', $purchasedLessonEditionsBundle->athlete->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lesson Editions Bundle') ?></th>
            <td><?= $purchasedLessonEditionsBundle->has('lesson_editions_bundle') ? $this->Html->link($purchasedLessonEditionsBundle->lesson_editions_bundle->name, ['controller' => 'LessonEditionsBundles', 'action' => 'view', $purchasedLessonEditionsBundle->lesson_editions_bundle->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($purchasedLessonEditionsBundle->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start Date') ?></th>
            <td><?= h($purchasedLessonEditionsBundle->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End Date') ?></th>
            <td><?= h($purchasedLessonEditionsBundle->end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Active') ?></th>
            <td><?= $purchasedLessonEditionsBundle->is_active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <?php if ($isValid) : ?>
        <div class="alert alert-success"><?= __('This Bundle is valid') ?></div>
    <?php else: ?>
        <div class="alert alert-danger"><?= __('This Bundle is not valid') ?></div>
    <?php endif; ?>
</div>
