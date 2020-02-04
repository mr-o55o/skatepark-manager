<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Activity $activity
 */

use Cake\Core\Configure;
?>

<div class="activity content">
    <?= $this->Form->create($activity); ?>
    <table class="table table-striped">
        <tr>
            <th scope="row"><?= __('Id Attività') ?></th>
            <td><?=$activity->id ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo Attività') ?></th>
            <td><?= $activity->has('activity_type') ? h($activity->activity_type->name) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Titolo Evento') ?></th>
            <td>
                <?= $activity->event->title ?>
            </td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $activity->has('activity_status') ?  h($activity->activity_status->name): '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Inizio') ?></th>
            <td><?= h($activity->event->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fine') ?></th>
            <td><?= h($activity->event->end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Staff Assegnato') ?></th>
            <td>
                <?php if  (count($activity->activity_users) > 0) : ?>
                    <table>
                    <?php foreach ($activity->activity_users as $activity_user) : ?>
                        <tr>
                            <td><?= h($activity_user->user->username) ?></td>
                            <td><?= h($activity_user->task) ?></td>
                        </tr>
                    <?php endforeach ?> 
                    </table>
                <?php endif; ?>
            </td>
        </tr>            
    </table>
    <h3><?= __('Note') ?></h3>
    <div class="row">
        <div class="col">
            <label><?= __('Info utili al completamento dell\'attività') ?></label>
            <?= h($activity->notes) ?> <?= $this->Form->textArea('notes') ?>
        </tr> 
        </div>
    </div>
    <hr>
    <?= $this->Form->button('Completa attività', ['confirm' => __('Completare l\'attività').' '.$activity->id]) ?>
    <?= $this->Form->end(); ?>
    <?= $this->Element('Activities/detail-menu', ['status' => $activity->activity_status_id]); ?>
</div>
