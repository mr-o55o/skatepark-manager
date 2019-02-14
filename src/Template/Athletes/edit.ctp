<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Athlete $athlete
 */
$this->Form->unlockField('responsible_person_id');
?>

<div class="athletes content">
    <h3><?= __('Athletes Management') ?> - <?= __('Edit Athlete')?></h3>
    <?= $this->Form->create($athlete) ?>
    <fieldset>
        <label><?= __('Anagraphical Data') ?></label>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('surname');
            echo $this->Form->control('birthdate');
        ?>
        <hr>
        <label><?= __('Asi Subscrition') ?></label>       
        <?php
            echo $this->Form->control('asi_subscription_number', ['label' => __('Number')]);
            echo $this->Form->control('asi_subscription_date', ['label' => __('Date'),'empty' => true]);
        ?>
        <hr>

        <label><?= __('Responsible Person (mandatory for Under 18 athletes)')?></label>
        <?php   if ($athlete->has('responsible_person')) : ?>
            <?= $this->Html->link($athlete->responsible_person->name . ' ' . $athlete->responsible_person->surname, ['controller' => 'ResponsiblePersons', 'action' => 'view', $athlete->responsible_person_id]) ?>
            <?= $this->Form->postLink(__('Remove'), ['action' => 'remove_responsible_person', $athlete->id], ['block' => true, 'confirm' => __('Are you sure to remove this the responsible person for this athlete?'), 'class' => 'btn btn-primary']) ?> 
            <hr>
        <?php else :?>
            <?= $this->Form->input('responsible_person_surname', ['id' => 'responsible-person-surname']) ?>
            <a id="search-responsible-person-button" class="btn btn-primary">Search Responsible Person</a>
            <div>
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
    <?php endif; ?> 



    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

    <?= $this->fetch('postLink'); ?>

</div>
