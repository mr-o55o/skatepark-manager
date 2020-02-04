<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonEdition $lessonEdition
 */
?>
<div class="events content">
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
            <th scope="row"><?= __('Athlete') ?></th>
            <td>
            <?php if ($lesson_edition->athlete) : ?>
                <?= $this->Html->link(h($lesson_edition->athlete->name).' '.h($lesson_edition->athlete->surname), ['controller' => 'Athletes', 'action' => 'view', $lesson_edition->athlete->id])?> 
                <p><?= __('ASI Subscription data: ') ?> # <?= $lesson_edition->athlete->asi_subscription_number ?> - <?= __('Date') ?> <?= $lesson_edition->athlete->asi_subscription_date ?></p>
                <?php if ($lesson_edition->athlete->asi_subscription_date->modify('+ 1 year') < $lesson_edition->event->start_date) : ?>
                    <div class="alert alert-warning"><?= __('ASI Subscription is due to expire before the lesson edition starts') ?></div>
                <?php endif; ?>
             <?php endif; ?>   
            </td>    
        </tr>
       <tr>
            <th scope="row"><?= __('Istruttore') ?></th>
            <td><?= $lesson_edition->user ? $this->Html->link(h($lesson_edition->user->username), ['controller' => 'Users', 'action' => 'view', $lesson_edition->user->id]) : '-'?></td>    
        </tr>
    </table>
    <hr>

    <h3><?= __('Selezione istruttore') ?></h3>
    <?= $this->Form->create($lesson_edition); ?>
    <div class="row">
        <div class="col">
                <p><?= __('Sono elencati solo gli istruttori disponibili nel giorno della lezione e non impegnati in altre attività previste nel periodo di durata della lezione') ?></p>
                <?php if (!empty($available_trainers)) : ?>
                    <label><?= __('Selezione l\'istruttore') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
                    <?= $this->Form->control('user_id', ['required' => true, 'options' => $available_trainers, 'label' => false])?>
                <?php else : ?>
                    <div class="alert alert-warning"><?= __('Non ci sono istruttori disponibili.') ?></div>
                <?php endif; ?>         
        </div>
    </div>   

    <hr>
    <?= $this->Form->submit(__(_('Modifica'))); ?>
    <?= $this->Form->end() ?>
    <hr>
    <?= $this->Element('LessonEditions/detail-menu', ['status' => $lesson_edition->lesson_edition_status_id]); ?>

</div>
