<?php
use Cake\Core\Configure;

$weekdaysHelper = $this->loadHelper('Weekdays');
?>

<div class="courses index content">
    <?= $this->elementExists('Courses/modal-help-index') ? $this->Element('LCourses/modal-help-index') : '' ?> 
    <?= $this->Element('Courses/page-header'); ?>
    <?php if (count($courses) > 0) : ?>
        <table class="table table-striped">
            <thead class="thead">
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= __('Nome') ?></th>
                    <th scope='col'><?= __('Livello') ?></th>
                    <th scope='col'><?= __('Prezzo') ?></th>
                    <th scope="col"><?= __('Periodo') ?></th>
                    <th scope="col"><?= __('Cadenza Settimanale') ?></th>
                    <th scope="col"><?= __('Ora di inizio') ?></th>
                    <th scope="col"><?= __('Durata') ?></th>
                    <th scope="col"><?= __('Numero di Atleti Iscritti') ?></th>
                    <th scope="col"><?= __('Numero di Sessioni Definite') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $course): ?>
                <tr>
                    <td class="text-center"><?= $this->Html->link($course->id, ['action' => 'view', $course->id], ['class' => 'btn btn-primary btn-sm']) ?></td>
                    <td><?= h($course['name']) ?></td>
                    <td><?= h($course->course_level['name']) ?></td>
                    <td><?= $this->Number->currency($course->price, 'EUR') ?></td>
                    <td><?= $course['start_date'] ?> - <?= $course['end_date'] ?></td>
                    <td>
                    	<?php foreach ($course['week_days'] as $dayNumber) : ?>
                    		<?= $weekdaysHelper->int2str($dayNumber) ?>
                    	<?php endforeach; ?>
                    </td>
                    <td><?= $course['start_time']->i18nFormat('HH:mm') ?></td>
                    <td><?= $course['duration'] ?> <?= __('minuti') ?></td>
                    <td><?= count($course->course_subscriptions) ?></td>
                    <td>?= count($course->course_sessions) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- pagination -->
        <?= $this->Element('Pagination/paginator'); ?>
    <?php else : ?>
        <div class="alert alert-info"><?= __('No courses found :(') ?></div>
    <?php endif ?>
</div>