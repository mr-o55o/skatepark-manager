<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Athlete $athlete
 */

use Cake\I18n\Time;

?>
<?php
$subscriptionExpired = false;
if ($athlete->asi_subscription_date->modify('+1 Year') < Time::now()) {
    $subscriptionExpired = true;
}
?>
<div class="content">
    <h3><?= __('Athletes Management') ?> - <?= __('View Athlete')?></h3>
    <hr>
    <div class="text-right">
        <?= $this->Html->link( __('Athletes'), ['action' => 'index'], ['class' => ['btn', 'btn-primary']]); ?>
        <?= $this->Html->link( __('Edit this Athlete'), ['action' => 'edit', $athlete->id], ['class' => ['btn', 'btn-primary']]); ?>
        <?= $this->Html->link(_('Book a Lesson Edition for this athlete'), ['controller' => 'LessonEditions', 'action' => 'add', $athlete->id ], ['class' => 'btn btn-primary']); ?>
        <?= ($countValidLessonEditionsBundles == 0 ? $this->Html->link(_('Buy a Lesson Editions Bundle for this athlete'), ['controller' => 'PurchasedLessonEditionsBundles', 'action' => 'buyFor', $athlete->id ], ['class' => 'btn btn-primary']): '') ?>
    </div>
    <hr>
    <table class="table table-striped">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($athlete->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($athlete->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Surname') ?></th>
            <td><?= h($athlete->surname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Asi Subscription Number') ?></th>
            <td><?= h($athlete->asi_subscription_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Asi Subscription Date') ?></th>
            <td class="<?= ($subscriptionExpired) ? 'text-danger' : '' ?>">
                <?= $athlete->asi_subscription_date ?>
                <?php if($subscriptionExpired) : ?>
                    <?= $this->Html->link(_('Renew ASI Subscription'), ['action' => 'renew_asi_subscription'], ['class' => 'btn btn-primary']) ?>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th scope="row"><?= __('Birthdate') ?></th>
            <td><?= $athlete->birthdate ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Responsible Person') ?></th>
            <td>
            <?php if ($athlete->has('responsible_person')) : ?>
                <ul class="list-unstyled">
                    <li><?= $this->Html->link($athlete->responsible_person->name . ' ' . $athlete->responsible_person->surname, ['controller' => 'ResponsiblePersons', 'action' => 'view', $athlete->responsible_person_id]) ?></li>
                    <li><?= __('Phone') ?>: <?= h($athlete->responsible_person->phone) ?></li>
                    <li><?= __('Email') ?>: <?= h($athlete->responsible_person->email) ?></li>
                </ul>
            <?php endif ?>
            </td>
        </tr>
    </table>
    <hr>
    <h4><?= __('Lessons Recap')?></h4>
    <h5><?= __('Lesson Editions') ?></h5>
    <table class="table">
        <thead>
            <tr>
                <th class="text-center" style="width: 20%;"><?= __('Booked') ?></th>
                <th class="text-center" style="width: 20%;"><?= __('Completed') ?></th>
                <th class="text-center" style="width: 20%;"><?= __('Cancelled by athlete request') ?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-right"><?= $this->Number->format($countBookedLessonEditions) ?></td>
                <td class="text-right"><?= $this->Number->format($countCompletedLessonEditions) ?></td>
                <td class="text-right"><?= $this->Number->format($countCancelledLessonEditions) ?></td>
                <td class="text-center"><?= $this->Html->link(__('View all lesson editions involving this athlete'), ['controller' => 'LessonEditions', 'action' => 'indexForAthlete', $athlete->id]) ?></td>
            </tr>
        </tbody>
    </table>
    
    
    <h5><?= __('Lesson Editions Bundles') ?></h5>
    <table class="table">
        <thead>
            <tr>
                <th class="text-center" style="width: 25%;"><?= __('Valid') ?></th>
                <th class="text-center" style="width: 25%;"><?= __('Purchased') ?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-right"><?= $this->Number->format($countValidLessonEditionsBundles) ?></td>
                <td class="text-right"><?= $this->Number->format($countPurchasedLessonEditionsBundles) ?></td>
                <td class="text-center"><?= $this->Html->link(__('View all Lesson Editions Bundles purchased by this athlete'), ['controller' => 'PurchasedLessonEditionsBundles', 'action' => 'indexForAthlete', $athlete->id]) ?></td>
            </tr>
        </tbody>
    </table>
</div>
