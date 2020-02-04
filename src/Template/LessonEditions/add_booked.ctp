<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonEdition $lessonEdition
 */
use Cake\I18n\Time;
?>

<div class="lessonEditions content">
    <?= $this->elementExists('LessonEditions/modal-help-add') ? $this->Element('LessonEditions/modal-help-add') : '' ?> 

    <?php if (isset($athlete)) : ?>
        <h3><?= __('Prenotazione lezione individuale per') ?> <?= h($athlete->name) ?> <?= h($athlete->surname) ?></h3>
        <hr>
    <?php endif; ?>

    <?php if (count($lessonEditions) > 0) : ?>
        <h4><?= __('Lezioni Disponibili') ?></h4>
        <table class="table table-striped">
            <thead class="thead">
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= __('Tipo di lezione') ?></th>
                    <th scope="col"><?= __('Inizio') ?></th>
                    <th scope="col"><?= __('Istruttore') ?></th>
                    <th scope="col"><?= __('Atleta') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($lessonEditions as $lessonEdition) : ?>
                    <tr>
                        <td class="text-center">
                            <?= $this->Form->create($lessonEdition) ?>
                                <?= $this->Form->hidden('id', ['value' => $lessonEdition->id])?>
                                <?= $this->Form->submit(__('Prenota questa edizione')) ?>
                            <?= $this->Form->end() ?>  
                        </td>
                        <td><?= $this->Html->link($lessonEdition->lesson->name, ['controller' => 'Lessons', 'action' => 'view', $lessonEdition->lesson->id]) ?></td>
                        <td><?= $lessonEdition->has('event') ? h($lessonEdition->event->start_date->i18nFormat("EEEE dd MMMM YYYY @ H:mm")) : '' ?></td>
                        <td><?= $lessonEdition->has('user') ? $this->Html->link($lessonEdition->user->username, ['controller' => 'Users', 'action' => 'view', $lessonEdition->user->id]) : '' ?></td>
                        <td><?= $lessonEdition->has('athlete') ? $this->Html->link($lessonEdition->athlete->name . ' ' . $lessonEdition->athlete->surname, ['controller' => 'Athletes', 'action' => 'view', $lessonEdition->athlete->id]) : '' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- pagination -->
        <?= $this->Element('Pagination/paginator'); ?>
    <?php else : ?>
        <div class="alert alert-info"><?= __('Non ci sono lezioni con istruttore assegnato disponibili.') ?></div>
    <?php endif ?>


</div>


