<?php
$this->Form->unlockField('athlete_id');
?>
<table class="table table-striped">
    <tr>
        <th><?= __('Lesson') ?></th>
        <td><?= h($lesson_edition->lesson->name)?></td>
    </tr>
    <tr>
        <th><?= __('Lesson Duration') ?></th>
        <td><?= h($lesson_edition->lesson->duration) ?> <?= __('minutes') ?></td>
    </tr>
    <tr>
        <th><?= __('Lesson starts at') ?></th>
        <td><?= $lesson_edition->event->start_date->I18nFormat('EEEE d MMMM Y') ?> @ <?= $lesson_edition->event->start_date->I18nFormat('HH:mm') ?></td>
    </tr>
</table>
<hr>


<?= $this->Form->create($lesson_edition) ?>
	<?php if ($available_trainers) : ?>
        <label><?= __('Select a Trainer among the free ones') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
		<?= $this->Form->control('user_id', ['options' => $available_trainers, 'label' => false])?>
	<?php else : ?>
		<div class="alert alert-warning"><?= __('No free trainers for the selected timeframe') ?></div>
	<?php endif; ?>
    <hr>
    <?php if ($lesson_edition->athlete != null) : ?>
        <?= __('Currently selected Athlete') ?>: <?= $lesson_edition->athlete->name . ' ' . $lesson_edition->athlete->surname ?>
        <?= $this->Form->hidden('athlete_id', ['value' => $lesson_edition->athlete_id]) ?>
    <?php else : ?>
        <div><label><?= __('Select an athlete by searching for his surname or part of it') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
        <?= $this->Form->input('athlete_surname', ['id' => 'athlete-surname']) ?>
    	<a id="search-athlete-button" class="btn btn-primary">Search Athlete</a>
        <div>
        <div id="target-athlete"></div>
    <?php endif; ?>
    <hr>
    <p><i class="fas fa-star fa-xs text-danger"></i> <?= __('Required field') ?></p>
    <?= $this->Html->link(__('Back'), $ref, ['class' => 'btn btn-primary']) ?>
	<?= $this->Form->submit('Proceed to final review'); ?>
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
