<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonEdition $lesson_edition
 */


?>
<div class="content">
    <div class="text-right"><?= $this->Element('LessonEditions/modal-help-add') ?></div>

    <?= ($lesson_edition->getErrors() ? $this->Element('Errors/error_box', [ 'errors' => $lesson_edition->getErrors() ]) : '' ) ?>
    <?= $this->Form->create($lesson_edition); ?>
    <table class="table table-striped">
        <tr>
            <th scope="row"><?= __('Tipo di lezione') ?></th>
            <td><?= $lesson_edition->has('lesson') ? $this->Html->link($lesson_edition->lesson->name, ['controller' => 'Lessons', 'action' => 'view', $lesson_edition->lesson->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Inizio') ?></th>
            <td><?= h($lesson_edition->event->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fine') ?></th>
            <td><?= h($lesson_edition->event->end_date) ?></td>
        </tr>
        <?php if ($lesson_edition->has('athlete')) : ?>
        <tr>
            <th scope="row"><?= __('Atleta') ?></th>
            <td><?= $this->Html->link($lesson_edition->athlete->name.' '.$lesson_edition->athlete->surname, ['controller' => 'Athletes', 'action' => 'view', $lesson_edition->athlete->id]) ?>
                <?php if ($lesson_edition->athlete->hasValidSubscriptions() === false) : ?>
                    <div class="alert alert-warning">
                        <p><?= __('L\'atleta non ha iscrizioni in corso di validità.') ?></p>
                        <?= $this->Html->link('Scarico di responsabilità', ['controller' => 'Athletes', 'action' => 'viewLiabilityDisclaimer', $lesson_edition->athlete->id]) ?>
                        <?= $this->Html->link(__('Gestione delle iscrizioni per questo atleta'), ['controller' => 'Athletes', 'action' => 'manageSubscriptions', $lesson_edition->athlete->id], ['class' => 'btn btn-primary btn-sm']) ?>
                    </div>
                <?php endif; ?>
                <?php if(isset($valid_bundle['0'])): ?>
                    <div class="alert alert-info">
                        <?= __('L\'atleta ha un pacchetto di lezioni valido, che verrà quindi aggiornato quando la lezione sarà completata.') ?>
                        <ul>
                            <li><?= __('Status')?>: <?= $valid_bundle[0]['purchased_lesson_editions_bundles_status']['name'] ?></li>
                            <li><?= __('Start date')?>: <?= $valid_bundle[0]['start_date'] ?></li>
                            <li><?= __('End date')?>: <?= $valid_bundle[0]['end_date'] ?></li>
                            <li><?= __('Charges') ?>: <?= $valid_bundle[0]['count'] ?></li>
                        </ul>
                    </div>
                <?php endif ?>
                <?php if (isset($busy_athlete_warning)) : ?>
                    <div class="alert alert-danger"><?= __('L\'atleta è impegnato in altre attività, impossibile salvare.') ?></div>
                <?php endif; ?>
            </td>
        </tr>
        <?php endif; ?>
        <tr>
            <th scope="row"><?= __('Istruttore') ?></th>
            <td><?= $lesson_edition->has('user') ? $this->Html->link($lesson_edition->user->username, ['controller' => 'Users', 'action' => 'view', $lesson_edition->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Noleggio attrezzatura') ?></th>
            <td>
                <ul class="list-unstyled">
                    <li><?= $this->Form->control('rent_skateboard', ['label' => 'Skateboard']); ?></li>
                    <li><?= $this->Form->control('rent_helmet', ['label' => 'Casco']); ?></li>
                    <li><?= $this->Form->control('rent_pads', ['label' => 'Protezioni']); ?></li>
                </ul>
            </td>
        </tr>
        <tr>
            <th scope="row"><?= __('Notes') ?></th>
            <td> 
                <label><?= __('Appunti per la lezione') ?></label>
                <?= $this->Form->textArea('notes'); ?>
            </td>
        </tr>
    </table>

    <?= $this->Html->link(__('Back'), $this->request->referer(), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->submit(__('Prenota Edizione'), ['disabled' => $lesson_edition->isBookable() ]); ?>
</div>
<?= $this->Form->end() ?>
