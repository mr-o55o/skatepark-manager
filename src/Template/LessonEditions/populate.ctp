<?php
$this->Form->unlockField('athlete_id');
?>
<h3>
  <?= __('Lesson Editions Management') ?> - <?= __('Book a lesson edition') ?>
</h3>
<label><?= __('Lesson edition data') ?></label>
<div>
	<p><?= __('Lesson') ?>: <?= h($lesson_edition->lesson->name)?></p>
	<p><?= __('Start date')?>: <?= $lesson_edition->event->start_date ?></p>
	<p><?= __('End date')?>: <?= $lesson_edition->event->end_date ?></p>
</div>
<hr>


<?= $this->Form->create($lesson_edition) ?>
	<?php if ($available_trainers) : ?>
		<?= $this->Form->control('user_id', ['options' => $available_trainers, 'label' => __('Select a trainer for this lesson')])?>
	<?php else : ?>
		<div class="alert alert-warning"><?= __('No free trainers for the selected timeframe') ?></div>
	<?php endif; ?>
    <hr>
    <?php if ($lesson_edition->athlete != null) : ?>
        <?= __('Currently selected Athlete') ?>: <?= $lesson_edition->athlete->name . ' ' . $lesson_edition->athlete->surname ?>
    <?php else : ?>
        <div><label><?= __('Search for an athlete') ?></label>
        <?= $this->Form->input('athlete_surname', ['id' => 'athlete-surname']) ?>
    	<a id="search-athlete-button" class="btn btn-primary">Search Athlete</a>
        <div>
        <div id="target-athlete"></div>
    <?php endif; ?>

    <hr>
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
                    $('#target-athlete').append('<input type="radio" name="athlete_id" value="' + value['id'] + '" /> ' + value['name'] + ' ' + value['surname'] + '<br>');
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
