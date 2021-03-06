<?php
use Cake\Core\Configure;
?>

<div class="activity content">
    <!-- Business Errors Recap-->
    <?= ($activity->getErrors() ? $this->Element('Errors/error_box', [ 'errors' => $activity->getErrors() ]) : '' ) ?>

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

        <?php if  (count($activity->activity_users) > 0 && $activity->activity_status_id < Configure::read('activity_statuses')['completed']) : ?>
                <table>
                <?php foreach ($activity->activity_users as $activity_user) : ?>
                    <tr>
                        <td><?= h($activity_user->user->username) ?></td>
                        <td><?= h($activity_user->task) ?></td>
                    </tr>
                <?php endforeach ?> 
                </table>
        <?php else :  ?>
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
        <tr>
            <th scope="row"><?= __('Info utili al completamento dell\'attività') ?></th>
            <td><?= h($activity->notes) ?></td>
        </tr>            
        <tr>
            <th scope="row"><?= __('Creato il') ?></th>
            <td><?= h($activity->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Aggiornato il') ?></th>
            <td><?= h($activity->modified) ?></td>
        </tr>
    </table>    
</div>