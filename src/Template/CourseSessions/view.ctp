<?php 
use Cake\Core\Configure;

//debug($course_session->isCompletable());
?>

<div class="course-session content">
    <?= $this->elementExists('CourseSessions/modal-help-view') ? $this->Element('CourseSessions/modal-help-view') : '' ?> 
    <h3><?= __('Sessione del corso') ?> <?= h($course_session->course->name)?> - <?= __('livello') ?> <?= h($course_session->course->course_level->name)?></h3>
    <?= $this->Html->link(__('Visualizza Corso').' '.h($course_session->course->name), ['controller' => 'Courses', 'action' => 'view', $course_session->course_id], ['class' => 'btn btn-primary']) ?>
    <hr>
    <table class="table vertical-table table-striped">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($course_session->id) ?></td>
        </tr> 
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($course_session->course_session_status->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Data e ora') ?></th>
            <td><?= $course_session->event->start_date->i18nFormat('dd/MM/YYYY')?> <?= __('dalle')?> <?=$course_session->event->start_date->i18nFormat('HH:mm')?> <?= __('alle')?> <?=$course_session->event->end_date->i18nFormat('HH:mm')?></td>
        </tr>
        <tr>
        	<th scope="row"><?= __('Istruttori Assegnati') ?></th>
        	<td>
        		<?php if (!empty($course_session->course_session_trainers)) : ?>
                    <ul>
                    <?php foreach($course_session->course_session_trainers as $trainer) : ?>
                        <li><?= h($trainer->user->username)?> <?= $this->Form->postLink(__('Rimuovi'), ['controlle' => 'CourseSessionTrainers', 'action' => 'removeTrainer', $course_session->id], ['class' => 'btn btn-sm btn-danger']); ?></li>
                    <?php endforeach; ?> 
                    </ul> 
        		<?php else : ?>
        			<?= __('Nessun istruttore assegnato') ?>
        		<?php endif ?>
                <hr>
        		<?= ( $course_session->isUpdatable() ? $this->Html->link(__('Assegna Istruttore'), ['controller' => 'CourseSessionTrainers', 'action' => 'addTrainer', $course_session->id], ['class' => 'btn btn-primary btn-sm']) : '') ?>
        	</td>
        </tr> 
        <tr>
            <th scope="row"><?= __('Atleti Presenti alla Sessione') ?></th>
            <td>
                <?php if (!empty($course_session->course_session_partecipants)) : ?>
                    <table class="table table-striped able-condensed">
                        <thead>
                            <tr>
                                <th scope="col"><?= __('Atleta') ?></th>
                                <th scope="col"><?= __('Presente') ?></th>
                                <th scope="col"><?= __('Noleggio Skateboard') ?></th>
                                <th scope="col"><?= __('Noleggio Casco') ?></th>
                                <th scope="col"><?= __('Noleggio Pads') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($course_session->course_session_partecipants as $partecipant) : ?>
                            <tr>
                                <td><?= $this->Html->link($partecipant->athlete->name.' '.$partecipant->athlete->surname, ['controller' => 'Athletes', 'action' => 'view', $partecipant->athlete_id]) ?></td>
                                <td><?= ($partecipant->is_present ? __('Sì') : __('No')) ?></td>
                                <td><?= ($partecipant->rent_skateboard ? __('Sì') : __('No')) ?></td>
                                <td><?= ($partecipant->rent_helmet ? __('Sì') : __('No')) ?></td>
                                <td><?= ($partecipant->rent_pads ? __('Sì') : __('No')) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= ( $course_session->isUpdatable() ? $this->Html->link(__('Gestisci Registro Presenze'), ['controller' => 'CourseSessionPartecipants', 'action' => 'edit', $course_session->id], ['class' => 'btn btn-primary btn-sm']) : '') ?>

                <?php else : ?>
                    <?= __('Nessun atleta presente') ?>
                    <?= $this->Html->link(__('Crea nuovo Registro Presenze'), ['controller' => 'CourseSessionPartecipants', 'action' => 'add', $course_session->id], ['class' => 'btn btn-primary btn-sm'])?>
                <?php endif; ?>
                <hr>
                
            </td>
        </tr>	
    </table>
    <hr>
    <?= ($course_session->isCompletable() ? $this->Form->postLink(__('Segna questa sessione come completata'), ['action' => 'complete', $course_session->id], ['confirm' => __('Segnare come completata la sessione?'), 'class' => 'btn btn-primary']) : ''); ?> 
    <?= ($course_session->isCancellable() ? $this->Form->postLink(__('Segna questa Sessione come Annullata'), ['action' => 'cancel', $course_session->id], ['confirm' => __('Annullare la sessione {0}?', $course_session->id), 'class' => 'btn btn-warning btn-sm']) : '') ?> 
    <?= ($course_session->isDeletable() ? $this->Form->postLink(__('Elimina'), ['action' => 'delete', $course_session->id], ['confirm' => __('Eliminare la sessione {0}?', $course_session->id), 'class' => 'btn btn-danger btn-sm']) : '') ?> 
</div>