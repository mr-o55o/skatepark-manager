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
                    <th scope='col'><?= __('Stato') ?></th>
                    <th scope='col'><?= __('Inizio / Fine') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $course): ?>
                <tr>
                    <td class="text-center"><?= $this->Html->link($course->id, ['action' => 'view', $course->id], ['class' => 'btn btn-primary btn-sm']) ?></td>
                    <td><?= h($course['name']) ?></td>
                    <td><?= ($this->elementExists('CourseStatuses/status-badge') ? $this->element('CourseStatuses/status-badge', ['statusId' => $course->course_status_id]) : '') ?></td>
                    <td><?= $course->start_date->i18nFormat('dd/MM/YYYY') ?> / <?= $course->end_date->i18nFormat('dd/MM/YYYY') ?></td>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- pagination -->
        <?= $this->Element('Pagination/paginator'); ?>
    <?php else : ?>
        <div class="alert alert-info"><?= __('No courses found :(') ?></div>
    <?php endif ?>
</div>