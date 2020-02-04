<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsersAvailability $usersAvailability
 */

use Cake\I18n\Time;
?>

<div class="usersAvailability content">
<?php if (isset($userAvailabilities)) : ?>
    <?php foreach($userAvailabilities as $availability) : ?>
        <p><?= $availability->user_id ?> - <?= $availability->start_date ?></p>
    <?php endforeach; ?>
<?php endif; ?>

    <?= $this->Form->create($usersAvailability) ?>
        <label><?= __('Selezionare un membro dello staff per cui inserire le disponibilità giornaliere') ?></label>
        <?= $this->Form->control('user_id', ['options' => $users, 'label' => false]); ?>
        <hr>
        <label><?= __('Fissare un periodo non superiore a 30 giorni') ?></label><br>
        <label><?= __('Da') ?></label>
        <?= $this->Form->date('from', ['value' => Time::now(), 'minYear' => '2019' ]); ?>
        <label><?= __('A') ?></label>
        <?= $this->Form->date('to', ['value' => Time::now()->modify('+ 30 days'), 'minYear' => '2019' ]); ?>
        <hr>
        <label><?= __('Scegliere i giorni della settimana in cui l\'utente selezionato è disponibile nel periodo scelto.') ?></label>
        <?= $this->Form->input('week_days', ['multiple' => 'checkbox', 'options' => [1 => __('Lunedì'), 2 => __('Martedì'), 3 => __('Mercoledì'), 4 => __('Giovedì'), 5 => __('Venerdì'), 6 => __('Sabato'), 7 => __('Domenica')]]) ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
