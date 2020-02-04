<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonEdition $lessonEdition
 */
use Cake\Core\Configure;

?>

<div class="lesson_edition content">
    <?= $this->elementExists('LessonEditions/modal-help-view') ? $this->Element('LessonEditions/modal-help-view') : '' ?> 
    <table class="table vertical-table table-striped">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $lesson_edition->id ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipoe') ?></th>
            <td><?= $this->Html->link(h($lesson_edition->lesson->name), ['controller' => 'lessons', 'action' => 'view', $lesson_edition->lesson->id]) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Inizio') ?></th>
            <td><?= h($lesson_edition->event->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fine') ?></th>
            <td><?= h($lesson_edition->event->end_date) ?></td>
        </tr>      
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->element('LessonEditionStatuses/status-badge', ['statusId' => $lesson_edition->lesson_edition_status_id]); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Istruttore') ?></th>
            <td><?= $lesson_edition->user ? $this->Html->link(h($lesson_edition->user->username), ['controller' => 'Users', 'action' => 'view', $lesson_edition->user->id]) : __('Istruttore non assegnato') ?> <?=$lesson_edition->lesson_edition_status_id <= Configure::read('lesson_edition_statuses')['booked'] ? $this->Html->link(__('Aggiungi/Cambia Istruttore'), ['action' => 'changeTrainer', $lesson_edition->id], ['class' => 'btn btn-primary btn-sm']) : '' ?> <?=$lesson_edition->lesson_edition_status_id <= Configure::read('lesson_edition_statuses')['trainer-assigned'] && $lesson_edition->has('user') ? $this->Form->postLink(__('Rimuovi istruttore'), ['action' => 'removeTrainer', $lesson_edition->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Rimuovere l\'istruttore? La lezione verrà riportata allo stato di bozza') ]) : '' ?>

            </td>    
        </tr>
        <tr>
            <th scope="row"><?= __('Atleta') ?></th>
            <td>
            <?php if ($lesson_edition->athlete) : ?>
                <?= $this->Html->link(h($lesson_edition->athlete->name).' '.h($lesson_edition->athlete->surname), ['controller' => 'Athletes', 'action' => 'view', $lesson_edition->athlete->id])?> 
                <?php if ($lesson_edition->athlete->hasValidSubscriptions($lesson_edition->event->start_date) === false) : ?>
                    <div class="alert alert-warning">
                        <p><?= __('L\'atleta non ha iscrizioni in corso di validità alla data di inizio di questa lezione.') ?></p>
                        <?= $this->Html->link('Scarico di responsabilità', ['controller' => 'Athletes', 'action' => 'viewLiabilityDisclaimer', $lesson_edition->athlete->id]) ?>
                        <?= $this->Html->link(__('Gestione iscrizioni per questo atleta'), ['controller' => 'Athletes', 'action' => 'manageSubscriptions', $lesson_edition->athlete->id], ['class' => 'btn btn-primary btn-sm']) ?>
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <?php if ($lesson_edition->isBookableForAthlete() === true) : ?>
                    <?= $this->Html->link(__('Prenota per un Atleta'), ['action' => 'bookForAthlete', $lesson_edition->id], ['class' => 'btn btn-primary btn-sm']) ?>
                <?php endif; ?>
            <?php endif; ?>   
            </td>    
        </tr>
        <tr>
            <th scope="row"><?= __('Noleggio attrezzatura') ?></th>
            <td>
                <ul class="list-unstyled">
                    <li><?= __('Skateboard') ?>: <?= $lesson_edition->rent_skateboard ? __('Sì') : __('No') ?></li>
                    <li><?= __('Casco') ?>: <?= $lesson_edition->rent_helmet ? __('Sì') : __('No') ?></li>
                    <li><?= __('Protezioni per gomiti e ginocchia') ?>: <?= $lesson_edition->rent_pads ? __('Sì') : __('No') ?></li>
                </ul>
                <?php if ($lesson_edition->lesson_edition_status_id == Configure::read('lesson_edition_statuses')['booked']) : ?>
                    <?= $this->HTml->link(__('Gestisci noleggio attrezzatura'), ['action' => 'manageEquipRental', $lesson_edition->id], ['class' => 'btn btn-primary btn-sm']) ?>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th scope="row"><?= __('Notes')?></th>
            <td><?= $this->Text->autoParagraph(h($lesson_edition->notes)); ?></td>
        </tr>
    </table>
    <?= $this->Element('LessonEditions/detail-menu', ['status' => $lesson_edition->lesson_edition_status_id]); ?>
</div>
