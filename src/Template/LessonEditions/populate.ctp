<?php
$this->Form->unlockField('athlete_id');
?>

<div class="content">
    <div class="text-right"><?= $this->Element('LessonEditions/modal-help-add') ?></div>
<table class="table table-striped">
    <tr>
        <th><?= __('Tipo di lezione') ?></th>
        <td><?= h($lesson_edition->lesson->name)?></td>
    </tr>
    <tr>
        <th><?= __('Durata') ?></th>
        <td><?= h($lesson_edition->lesson->duration) ?> <?= __('minuti') ?></td>
    </tr>
    <tr>
        <th><?= __('Inizio lezione') ?></th>
        <td><?= $lesson_edition->event->start_date->I18nFormat('EEEE d MMMM Y') ?> @ <?= $lesson_edition->event->start_date->I18nFormat('HH:mm') ?></td>
    </tr>
</table>
<hr>


<?= $this->Form->create($lesson_edition) ?>
    <h3><?= __('Selezione istruttore') ?></h3>
    <div class="row">
        <div class="col">
            <p><?= __('Sono elencati solo gli istruttori disponibili nel giorno della lezione e non impegnati in altre attività previste nel periodo di durata della lezione') ?></p>
            <?php if (count($available_trainers) > 0) : ?>
                <label><?= __('Selezione l\'istruttore') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
                <?= $this->Form->control('user_id', ['options' => $available_trainers, 'label' => false])?>
            <?php else : ?>
                <div class="alert alert-warning"><?= __('Non ci sono istruttori disponibili.') ?></div>
            <?php endif; ?>           
        </div>
    </div>
    <hr>
    <h3><?= __('Selezione atleta') ?></h3>
    <div class="row">
        <div class="col">
            <?php if ($lesson_edition->athlete != null) : ?>
                <?= __('Atleta selezionato') ?>: <?= $lesson_edition->athlete->name . ' ' . $lesson_edition->athlete->surname ?>
                <?= $this->Form->hidden('athlete_id', ['value' => $lesson_edition->athlete_id]) ?>
            <?php else : ?>
                <div><label><?= __('Ricerca un atleta digitandone il nome il cognome o una loro parte') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
                <?= $this->Form->input('athlete_surname', ['id' => 'athlete-surname']) ?>
                <a id="search-athlete-button" class="btn btn-primary">Search Athlete</a>
                <div>
                <div id="target-athlete"></div>
            <?php endif; ?>
        </div>
    </div>
    <hr>
    <p><i class="fas fa-star fa-xs text-danger"></i> <?= __('Campo richiesto') ?></p>
    <?= $this->Html->link(__('Back'), $ref, ['class' => 'btn btn-primary']) ?>
	<?= $this->Form->submit('Procedi alla revisione finale'); ?>
<?= $this->Form->end() ?>

<script language="javascript">
    /*
    $('#target-athlete').on('click', 'a' ,function() {
        id = this.id;
        console.log('Clicked on athlete '+ id);
        $('#selected-athlete').val(id);
        $('#selected-athlete').html($('#target_athlete #' + id).clone());
    });
    */

    $('#search-athlete-button').click(function() {
        $('#target-athlete').empty();
        var searchString = $('#athlete-surname').val();
        var targeturl = '/athletes/ajax-search.json?surname=' + searchString;
        $.ajax({
            type: 'get',
            url: targeturl,
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/json');
            },
            success: function(response) {
                console.log('Displaying search results');
                $('#target-athlete').append('<label><?=__('Select an athlete')?></label><br>');
                $.each(response.athletes, function( index, value ) {
                    console.log(index + ": "+ value['name']);
                    $('#target-athlete').append('<input type="radio" name="athlete_id" value="' + value['id'] + '" required /> ' + value['name'] + ' ' + value['surname'] + '<br>');
                    //$('#target-athlete').append('<div class="athlete"><a value="'+ value['name'] + value['surname'] +'" id="' + value['id'] +'">' + value['name'] + ' ' + value['surname'] + ' - ' + value['asi_subscription_number'] + ' - ' + value['asi_subscription_date'] + '</a></div>');
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
