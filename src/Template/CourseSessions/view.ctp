<?php 
use Cake\Core\Configure;
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
            <td><?= h($course_session->course_session_status->name) ?>
                &nbsp;
                <?php if ($course_session->course_session_status_id < Configure::read('course_session_statuses')['cancelled'] ) : ?>
                    <?= $this->Form->postLink(__('Annulla Sessione'), ['action' => 'cancel'],['class' => 'btn btn-warning', 'confirm' => _('Annullare la sessione?')]) ?>
                <?php endif; ?>
            </td>
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
        		<?= $this->Html->link(__('Assegna Istruttore'), ['controller' => 'CourseSessionTrainers', 'action' => 'addTrainer', $course_session->id], ['class' => 'btn btn-primary'])?>
        	</td>
        </tr> 
        <tr>
            <th scope="row"><?= __('Atleti Presenti alla Sessione') ?></th>
            <td>
                <?php if (!empty($course_session->course_session_partecipants)) : ?>
                <?php else : ?>
                    <?= __('Nessun atleta presente') ?>
                    <?= $this->Html->link(__('Crea nuovo Registro Presenze'), ['controller' => 'CourseSessionPartecipants', 'action' => 'add', $course_session->id], ['class' => 'btn btn-primary'])?>
                <?php endif; ?>
                <hr>
                
            </td>
        </tr>	
    </table>
</div>