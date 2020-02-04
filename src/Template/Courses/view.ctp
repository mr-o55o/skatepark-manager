<?php
use Cake\Core\Configure;
$weekdaysHelper = $this->loadHelper('Weekdays');
?>

<div class="course content">
    <?= $this->elementExists('Courses/modal-help-view') ? $this->Element('Courses/modal-help-view') : '' ?> 
    <h3><?= __('Caratteristiche del corso') ?></h3>
    <table class="table vertical-table table-striped">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($course->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome') ?></th>
            <td><?=h($course->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Livello') ?></th>
            <td><?= h($course->course_level->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($course->course_status->name) ?></td>
        </tr>
         <tr>
            <th scope="row"><?= __('Periodo') ?></th>
            <td><?= h($course->start_date) ?> - <?= h($course->end_date) ?></td>
        </tr>       
        <tr>
            <th scope="row"><?= __('Cadenza settimanale') ?></th>
            <td>
                <?php foreach ($course['week_days'] as $dayNumber) : ?>
                    <?= $weekdaysHelper->int2str($dayNumber) ?>
                <?php endforeach; ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ora di inizio') ?></th>
            <td><?= h($course->start_time->i18nFormat('HH:mm')) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Durata') ?></th>
            <td><?= h($course->duration) ?> <?= __('minuti') ?></td>
        </tr>
    </table>
    <hr>
    <h3><?= __('Atleti iscritti al Corso') ?></h3>
<?php if (!empty($course->course_subscriptions)) : ?>
    <table class="table table-condensed table-striped">
        <thead>
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Atleta') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($course->course_subscriptions as $subscription) : ?>
            <tr>
                <td><?= $subscription->id ?></td>
                <td><?= $subscription->athlete->name ?> <?= $subscription->athlete->surname ?> <?= ($course->course_status_id < 3 ? $this->Form->postLink(__('Elimina'), ['controller' => 'CourseSubscriptions', 'action' => 'delete', $subscription->id], ['class' => 'btn btn-danger', 'confirm' => __('Eliminare questa iscrizione?')]) : '') ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif ;?>
<?php if ($course->course_status_id <= 2 ) : ?>
    <?= $this->Html->link(__('Nuova iscrizione per questo Corso'), ['controller' => 'CourseSubscriptions', 'action' => 'subscribeCourse', $course->id], ['class' => 'btn btn-primary']) ?>
<?php endif; ?>
<hr>
<?php if (!empty($course->course_sessions)) : ?>
    <h3><?= __('Sessioni del corso') ?></h3>
    <table class="table table-condensed table-striped">
        <thead>
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Data e orario') ?></th>
                <th scope="col"><?= __('Istruttori assegnati') ?></th>
            </tr>
        </thead>

        <tbody>
        <?php foreach($course->course_sessions as $session) : ?>
            <tr>
                <td><?= $this->Html->link($session->id, ['controller' => 'CourseSessions', 'action' => 'view', $session->id]) ?></td>
                <td><?= __($session->course_session_status->name) ?></td>
                <td><?= $session->event->start_date->i18nFormat('dd/MM/YYYY')?> <?= __('dalle')?> <?=$session->event->start_date->i18nFormat('HH:mm')?> <?= __('alle')?> <?=$session->event->end_date->i18nFormat('HH:mm')?></td>
                <td>
                    <?php if (!empty($session->course_session_trainers)) : ?>
                        <ul>
                         <?php foreach($session->course_session_trainers as $trainer) : ?>
                            <li><?= h($trainer->user->username)?></li>
                        <?php endforeach; ?>                       
                        </ul>
                    <?php else : ?>
                        <?= __('Nessun Istruttore assegnato') ?>
                    <?php endif ; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <hr>
<?php endif; ?>

    <?= $this->elementExists('Courses/detail-menu') ? $this->Element('Courses/detail-menu', ['status' => $course->course_status_id]) : '' ?>
</div>