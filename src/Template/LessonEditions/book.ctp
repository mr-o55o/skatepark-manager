<?php
use Cake\Core\Configure;
?>

<div class="lessonEditions index content">
    <?php if (count($lessonEditions) > 0) : ?>
        <?= $this->Form->create($lesson_edition)?>
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
                <?php foreach ($lessonEditions as $lessonEdition): ?>
                <tr>
                    <td class="text-center"></td>
                    <td><?= $this->Html->link($lessonEdition->lesson->name, ['controller' => 'Lessons', 'action' => 'view', $lessonEdition->lesson->id]) ?></td>
                    <td><?= $lessonEdition->has('event') ? h($lessonEdition->event->start_date->i18nFormat("dd/MM/Y H:mm")) : '' ?></td>
                    <td><?= $lessonEdition->has('user') ? $this->Html->link($lessonEdition->user->username, ['controller' => 'Users', 'action' => 'view', $lessonEdition->user->id]) : '' ?></td>
                    <td><?= $lessonEdition->has('athlete') ? $this->Html->link($lessonEdition->athlete->name . ' ' . $lessonEdition->athlete->surname, ['controller' => 'Athletes', 'action' => 'view', $lessonEdition->athlete->id]) : '' ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- pagination -->
        <?= $this->Element('Pagination/paginator'); ?>
    <?php else : ?>
        <div class="alert alert-info"><?= __('No lesson editions found :(') ?></div>
    <?php endif ?>
    <?= $this->Form->end() ?> 
</div>