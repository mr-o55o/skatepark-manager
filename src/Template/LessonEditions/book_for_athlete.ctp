<?php 
$this->Form->unlockField('athlete_id');
?>
<?= $this->Form->create($lesson_edition) ?>
<div class="content">

    <?= ($lesson_edition->getErrors() ? $this->Element('Errors/error_box', [ 'errors' => $lesson_edition->getErrors() ]) : '' ) ?>
    
    <table class="table table-striped table-condensed">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $lesson_edition->id ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo') ?></th>
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
    </table>


    <h3><?= __('Selezione atleta') ?></h3>
    <div class="row">
        <div class="col">
            <?php if (!empty($lesson_edition->athlete)) : ?>
                <?= __('Atleta selezionato') ?>: <?= $lesson_edition->athlete->name . ' ' . $lesson_edition->athlete->surname ?>
                <?= $this->Form->hidden('athlete_id', ['value' => $lesson_edition->athlete_id]) ?>
            <?php else : ?>
                <div><label><?= __('Ricerca un atleta digitandone il cognome o una sua parte') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
                <?= $this->Form->input('athlete_surname', ['id' => 'athlete-surname', 'label' => false]) ?>
                <a id="search-athlete-button" class="btn btn-primary">Search Athlete</a>
                <div>
                <div id="target-athlete"></div>
            <?php endif; ?>
        </div>
    </div>
    <hr>
    <p><i class="fas fa-star fa-xs text-danger"></i> <?= __('Campo richiesto') ?></p>
	<?= $this->Form->submit('Prenota edizione'); ?>
<?= $this->Form->end() ?>

<?= $this->Element('LessonEditions/detail-menu', ['status' => $lesson_edition->lesson_edition_status_id]); ?>
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