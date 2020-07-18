<?php
use Cake\Core\Configure;
$weekdaysHelper = $this->loadHelper('Weekdays');
//debug($course->isActivable());
?>

<div class="course content container">
    <div class="text-right"><?= $this->elementExists('Courses/modal-help-view') ? $this->Element('Courses/modal-help-view') : '' ?></div> 
    <h3><?= __('Corso') ?> <?=h($course->name) ?> [<?= __('Id corso') ?>: <?= h($course->id) ?>]</h3>


    <table class="table vertical-table table-striped">
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($course->course_status->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Inizio / Fine') ?></th>
            <td><?= $course->start_date->i18nFormat('dd/MM/YYYY') ?> / <?= $course->end_date->i18nFormat('dd/MM/YYYY') ?></td>
        </tr>
    </table>
    <hr>

    <div class="row">
        <div class="col pb-5">
            <h3><?= __('Abbonamenti associati al Corso') ?></h3>
            <?php if (!empty($course->course_subscriptions)) : ?>
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Id Abbonamento') ?></th>
                            <th scope="col"><?= __('Tipo Abbonamento') ?></th>
                            <th scope="col"><?= __('Atleta') ?></th>
                            <th scope="col"><?= __('Pagato') ?></th>
                            <th scope="col"><?= __('Edizioni Corso Previste') ?></th>
                            <th scope="col"><?= __('Data sottoscrizione Abbonamento') ?></th>
                            <th scope="col"><?= __('Data associazione Abbonamento a Corso') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($course->course_subscriptions as $course_subscription) : ?>
                        <tr>
                            <td><?= $this->Html->link($course_subscription->subscription->id, ['controller' => 'CourseSubscriptions', 'action' => 'edit', $course_subscription->subscription->id], ['class' => 'btn btn-primary btn-sm']) ?></td>
                            <td><?= h($course_subscription->subscription->subscription_type->name) ?></td>
                            <td>
                                <?= $this->Html->link( h($course_subscription->subscription->athlete->name.' '.$course_subscription->subscription->athlete->surname), ['controller' => 'Athletes', 'action' => 'view', $course_subscription->subscription->athlete->id]) ?> <?= ($course_subscription->subscription->athlete->hasValidSubscriptions ? '' : '<span class="bg-warning text-dark">'.__('Iscrzioni ASI / FISR non valide.').'</span>' ) ?>

                            </td>
                            <td><?= ($course_subscription->subscription->is_paid ? __('Sì') : __('No') ) ?></td>
                            <td>
                                <ul>
                                <?php foreach($course_subscription->subscription->selected_course_editions as $selectedCourseEdition) : ?>
                                    <li><?= h($selectedCourseEdition->course_edition->name) ?></li>
                                <?php endforeach; ?>
                                </ul>
                            </td>
                            <td><?= $course_subscription->subscription->created->i18nFormat('dd/MM/yyyy HH:mm') ?></td>
                            <td><?= $course_subscription->created->i18nFormat('dd/MM/yyyy HH:mm') ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <div class="alert alert-warning"><?= __('Questo Corso non ha Abbonamenti.') ?></div>
            <?php endif ;?>
            <?= $this->Html->link(__('Associa Abbonamenti a questo Corso'), ['controller' => 'CourseSubscriptions', 'action' => 'add'], ['class' => 'btn btn-primary btn-sm'] ) ?>
        </div>
        <div class="col">
            <h3><?= __('Classi del corso') ?></h3>
            <?php if (!empty($course->course_classes)) : ?>
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Id Classe') ?></th>
                            <th scope="col"><?= __('Status') ?></th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php foreach($course->course_classes as $class) : ?>
                        <tr>
                            <td><?= $this->Html->link($class->id, ['controller' => 'CourseClasses', 'action' => 'view', $class->id], ['class' => 'btn btn-primary btn-sm']) ?></td>
                            <td><?= $this->element('CourseClassStatuses/status-badge', ['statusId' => $class->course_session_status_id])?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-warning"><?=__('Questo Corso non ha Classi.') ?></div>
            <?php endif; ?>

        </div>
    </div>
</div>