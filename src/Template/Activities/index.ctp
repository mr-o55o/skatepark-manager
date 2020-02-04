<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Activity[]|\Cake\Collection\CollectionInterface $activities
 */
use Cake\I18N\Time;
?>
<div class="activities index content">


    <?= $this->Element('Activities/page-header') ?>

    <div class="col"><?= $this->Element('Users/filter-form'); ?></div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id', ['label' => 'Id Attività']) ?></th>
                <th scope="col"><?= __('Data') ?></th>
                <th scope="col"><?= __('Durata') ?></th>
                <th scope="col"><?= __('Membri dello staff impegnati') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ActivityTypes.name', ['label' => 'Tipo Attività']) ?></th>
                <th scope="col"><?= __('Titolo Evento') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ActivityStatuses.name', ['label' => 'Stato Attività']) ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($activities as $activity): ?>
            <tr>
                <td><?= $this->Html->link($this->Number->format($activity->id), ['action' => 'view', $activity->id]) ?></td>
                <td><?= h($activity->event->start_date->i18nFormat('dd/MM/yyyy')) ?></td>
                <td><?= __('dalle') ?> <?= h($activity->event->start_date->i18nFormat('HH:mm')) ?> <?= __('alle') ?> <?= h($activity->event->end_date->i18nFormat('HH:mm')) ?></td>
                <td>
                    <?php if (count($activity->activity_users) > 0 ) : ?>
                        <ul>
                        <?php foreach($activity->activity_users as $activity_user) : ?>
                            <li><?= h($activity_user->user->username) ?> <?= $activity_user->has('task') ? '('.h($activity_user->task).')' : '' ?></li>
                        <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        <?= __('Nessun utente inserito.') ?>
                    <?php endif; ?>
                </td>
                <td><?= $activity->has('activity_type') ? h($activity->activity_type->name) : ' - ' ?></td>
                <td><?= h($activity->event->title) ?></td>
                <td><?= $this->element('ActivityStatuses/status-badge', ['statusId' => $activity->activity_status_id]); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
