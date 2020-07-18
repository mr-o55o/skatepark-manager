<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Athlete $athlete
 */


use Cake\I18n\Time;

$this->Form->unlockField('responsible_person_id');

?>

<div class="athletes content">
    <nav class="nav text-white rounded mb-4 justify-content-center">
        <?= $this->Html->link( __('Visualizza atleta'), ['action' => 'view', $athlete->id], ['class' => ['nav-link']]); ?>
    </nav>
        <!-- Contextual Help -->
    <div class="text-right"><?= $this->Element('Athletes/modal-help-edit') ?></div>

    <?= ($athlete->getErrors() ? $this->Element('Errors/error_box', [ 'errors' => $athlete->getErrors() ]) : '' ) ?>

    <?= $this->Form->create($athlete) ?>
    <h3><?= __('Dati Anagrafici') ?></h3>
    <diiv class="row">
        <div class="col"><label><?= __('Nome e Cognome') ?>:</label> <?= h($athlete->name) ?> <?= h($athlete->surname) ?></div>
        <div class="col"><label><?= __('Sesso') ?>:</label> <?= h($athlete->sex) ?></div>
        <div class="col"><label><?= __('Data e luogo di nascita') ?>:</label> <?= h($athlete->birth_city) ?> (<?= h($athlete->birth_province_code) ?>) <?= __('il') ?> <?=$athlete->birthdate->i18nFormat('dd/MM/YYYY')?></div>
        <div class="col"><label><?= __('Codice fiscale') ?>:</label> <?= h($athlete->fiscal_code) ?></div>
    </diiv>
    <hr>
    <h3><?= __('Attività dell\'atleta') ?></h3>
    <div class="row">
        <div class="col"><?= $this->Form->control('disabled_person', ['label' => __('Disabile') ]) ?></div>
        <div class="col"><?= $this->Form->control('competitive', ['label' => __('Svolge attività agonistica')]) ?></div>
        <div class="col"><?= $this->Form->control('athlete_rank_id', ['options' => $athleteRanks, 'label' => __('Livello') ]) ?></div>
    </div>
    <hr>
    <h3><?= __('Domicilio') ?></h3>
    <div class="row">
        <div class="col-3">
            <label><?= __('Via / Piazza') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
            <?= $this->Form->input('address', ['label' => false]) ?>
        </div>
        <div class="col-3">
            <label><?= __('CAP') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
            <?= $this->Form->input('postal_code', ['label' => false]) ?>
        </div>
        <div class="col-3">
            <label><?= __('Città') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
            <?= $this->Form->input('city', ['label' => false]) ?>
        </div>
        <div class="col-3">
            <label><?= __('Provincia') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
            <?= $this->Form->control('birth_province_code', [ 'options' => $provinces, 'label' => false, 'required' => true, 'empty' => __('Selezionare una provincia o scegliere Stato Estero') ]);?>
        </div>
    </div>
    <hr>
    <!-- ASI Subscription-->
    <h3><?= __('Iscrizione alle federazioni') ?></h3>
    <h4><?= __('A.S.I.') ?></h4>
    <div class="row">
        <div class="col form-group required">
            <label><?= __('Giorno') ?></label>
            <?= $this->Form->day('asi_subscription_date'); ?>
        </div>
        <div class="col form-group required">
            <label><?= __('Mese') ?></label>
            <?= $this->Form->month('asi_subscription_date'); ?>
        </div>
        <div class="col form-group required">
            <label><?= __('Anno') ?></label>
            <?= $this->Form->year('asi_subscription_date'); ?>
        </div>
    </div>
    <div>
        <label><?= __('Numero') ?></label>
        <?= $this->Form->control('asi_subscription_number', ['label' => false]); ?>
    </div>
    <h4><?= __('F.I.S.R.') ?></h4>
    <div class="row">
        <div class="col form-group required">
            <label><?= __('Giorno') ?></label>
            <?= $this->Form->day('fisr_subscription_date'); ?>
        </div>
        <div class="col form-group required">
            <label><?= __('Mese') ?></label>
            <?= $this->Form->month('fisr_subscription_date'); ?>
        </div>
        <div class="col form-group required">
            <label><?= __('Anno') ?></label>
            <?= $this->Form->year('fisr_subscription_date'); ?>
        </div>
    </div>
    <div>
        <label><?= __('Numero') ?></label>
        <?= $this->Form->control('fisr_subscription_number', ['label' => false]); ?>
    </div>
    <hr>
    <h3><?= __('Persona Responsabile (per atleti minori di 18 anni)') ?></h3>
    <?php  if ($athlete->has('responsible_person')) : ?>
        <div class="row">
            <div class="col-12">
                <?= h($athlete->responsible_person->name) ?> <?= h($athlete->responsible_person->surname) ?> 
                <?php if ($athlete->birthdate->diffInYears(Time::now()) < 18 ) : ?>
                    <?= $this->Html->link(__('Cambia'), ['action' => 'change_responsible_person', $athlete->id], ['block' => true, 'class' => 'btn btn-primary btn-sm']) ?> 
                <?php else : ?>
                    <?= $this->Form->postLink(__('Remove'), ['action' => 'remove_responsible_person', $athlete->id], ['block' => true, 'confirm' => __('Are you sure to remove this the responsible person for this athlete?'), 'class' => 'btn btn-danger btn-sm']) ?> 
                <?php endif; ?>
            </div>
        </div>
    <?php else : ?>
        <div class="row">
            <div class="col-12">
                <?= $this->Form->input('responsible_person_surname', ['id' => 'responsible-person-surname']) ?>
                <a id="search-responsible-person-button" class="btn btn-primary">Search Responsible Person</a>
                <div id="target-responsible-person"></div> 

                <script language="javascript">
                    $('#search-responsible-person-button').click(function() {
                        $('#target-responsible-person').empty();
                        var searchString = $('#responsible-person-surname').val();
                        var targeturl = '/responsible-persons/ajax-search.json?surname=' + searchString;
                        $.ajax({
                            type: 'get',
                            url: targeturl,
                            beforeSend: function(xhr) {
                                xhr.setRequestHeader('Content-type', 'application/json');
                            },
                            success: function(response) {
                                console.log('Displaying search results');
                                $('#target-responsible-person').append('<label><?=__('Select a responsible person')?></label><br>');
                                $.each(response.responsible_persons, function( index, value ) {
                                    console.log(index + ": "+ value['name']);
                                    $('#target-responsible-person').append('<input type="radio" name="responsible_person_id" value="' + value['id'] + '" /> ' + value['name'] + ' ' + value['surname'] + '<br>');
                                });                        
                            },
                            error: function(e) {
                                alert("An error occurred: " + e.responseText.message);
                                console.log(e);
                            }
                        });
                    });
                </script> 
            </div>
        </div>
    <?php endif; ?>   
    <hr>
    <h3><?= __('Contatti') ?></h3>
    <div class="row">
        <div class="col"><label><?= __('Telefono') ?></label><?= $this->Form->input('phone', ['label' => false]) ?></div>
        <div class="col"><label><?= __('Email') ?></label><?= $this->Form->input('email', ['label' => false]) ?></div>
        <div class="col"><label><?= __('Account Twitter') ?></label><?= $this->Form->input('twitter_account', ['label' => false]) ?></div>
        <div class="col"><label><?= __('Account Instagram') ?></label><?= $this->Form->input('instagram_account', ['label' => false]) ?></div>
    </div>
    <hr>
    <label><i class="fas fa-star fa-xs text-danger"></i> <?= __('Campi richiesti') ?></label>
    <div class="text-center"><?= $this->Form->button(__('Aggiorna dati atleta')) ?></div>
    <?= $this->Form->end() ?>

    <?= $this->fetch('postLink'); ?>

</div>
