<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchasedLessonEditionsBundle $purchasedLessonEditionsBundle
 */
use Cake\I18n\Time;
use CAke\Core\Configure;
?>
<div class="purchasedLessonEditionsBundles content">
    <h3>
        <?= __('Lesson Management -View purchased lesson editions bundle') ?>
        <br><span class="small"><?= __('Lesson Editions Bundle details.') ?></span>

    </h3>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($purchasedLessonEditionsBundle->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Owner') ?></th>
            <td><?= $purchasedLessonEditionsBundle->has('athlete') ? $this->Html->link($purchasedLessonEditionsBundle->athlete->name . ' '. $purchasedLessonEditionsBundle->athlete->surname, ['controller' => 'Athletes', 'action' => 'view', $purchasedLessonEditionsBundle->athlete->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bundle type') ?></th>
            <td><?= $purchasedLessonEditionsBundle->has('lesson_editions_bundle') ? $this->Html->link($purchasedLessonEditionsBundle->lesson_editions_bundle->name, ['controller' => 'LessonEditionsBundles', 'action' => 'view', $purchasedLessonEditionsBundle->lesson_editions_bundle->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Element('PurchasedLessonEditionsBundleStatuses/status-badge', ['statusId' => $purchasedLessonEditionsBundle->status]) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Charges Remaining') ?></th>
            <td><?= $this->Number->format($purchasedLessonEditionsBundle->count) ?></td>
        </tr>        
        <tr>
            <th scope="row"><?= __('Start Date') ?></th>
            <td><?= h($purchasedLessonEditionsBundle->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End Date') ?></th>
            <td><?= h($purchasedLessonEditionsBundle->end_date) ?></td>
        </tr>
    </table>
    <?php if ($purchasedLessonEditionsBundle->end_date < Time::now() && $purchasedLessonEditionsBundle->status <= Configure::read('purchased_lesson_editions_bundle_statuses')['purchased']) : ?>
        <div class="alert alert-warning"><?= __('This Bundle has reached its end date, you can expire or extend it.') ?>:<br>
        <?= $this->Html->Link(__('Expire'), ['action' => 'expire'], ['class' => 'btn btn-danger']) ?> 
        <?= $this->Html->Link(__('Extend'), ['action' => 'extend', $purchasedLessonEditionsBundle->id], ['class' => 'btn btn-primary']) ?>
        </div>
    <?php endif; ?>
</div>
