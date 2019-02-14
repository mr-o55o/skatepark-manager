<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Athlete $athlete
 */

use Cake\Core\Configure;
$this->Form->unlockField('responsible_person_id');
?>

<div class="athletes content">
    <h3>
      <?= __('Athletes Management') ?> - <?= __('Register a  new Athlete') ?>
    </h3> 
    <?= $this->Form->create($athlete) ?>
        <fieldset>
            <label><?= __('Name and surname') ?></label>
            <?= $this->Form->control('name', ['id' => 'athlete_name']); ?>
            <?= $this->Form->control('surname', ['id' => 'athlete_surnamename']); ?>
            <hr>
            <label><?= __('Birthdate') ?></label>
            <div class="row">
                <div class="col-sm-4 form-group required">
                    <?= __('Day') ?><?= $this->Form->day('birthdate'); ?>
                </div>
                <div class="col-sm-4 form-group required">
                    <?= __('Month') ?><?= $this->Form->month('birthdate'); ?>
                </div>
                <div class="col-sm-4 form-group required">
                    <?= __('Year') ?><?= $this->Form->year('birthdate', [ 'minYear' => Configure::read('Athletes')['birthdate_minYear'], 'maxYear' => date('Y') ]); ?>
                </div>
            </div>
            <hr>
            <label><?= __('ASI Subscription') ?></label>
            <?= $this->Form->control('asi_subscription_number', ['label' => __('Number')]); ?>
            <label><?= __('Date') ?></label>
            <div class="row">
                <div class="col-sm-4 form-group required">
                    <?= __('Day') ?><?= $this->Form->day('asi_subscription_date'); ?>
                </div>
                <div class="col-sm-4 form-group required">
                    <?= __('Month') ?><?= $this->Form->month('asi_subscription_date'); ?>
                </div>
                <div class="col-sm-4 form-group required">
                    <?= __('Year') ?><?= $this->Form->year('asi_subscription_date'); ?>
                </div>
            </div>
            <hr>
            <label><?= __('Responsible Person (mandatory for Under 18 athletes)')?></label>
            <?= $this->Form->input('responsible_person_surname', ['id' => 'responsible-person-surname']) ?>
            <a id="search-responsible-person-button" class="btn btn-primary text-white">Search Responsible Person</a>
            <div>
            <div id="target-responsible-person"></div> 
            <hr>         
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

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