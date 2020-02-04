<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonEdition $lessonEdition
 */
use Cake\I18n\Time;
$weekdaysHelper = $this->loadHelper('Weekdays');
$this->Form->unlockField('athlete_id');
?>

<div class="course-subscriptions content">
    <?= $this->elementExists('CourseSubscriptions/modal-help-add') ? $this->Element('CoursesSubscriptions/modal-help-add') : '' ?> 

    <div class="container">
    <?= $this->Element('Errors/error-box', ['errors' => $course_subscription->errors()])?>


    <h3><?= __('Caratteristiche del corso') ?></h3>
    <table class="table vertical-table table-striped">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($course->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome') ?></th>
            <td><?=h($course->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Livello') ?></th>
            <td><?= h($course->course_level->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($course->course_status->name) ?></td>
        </tr>
         <tr>
            <th scope="row"><?= __('Periodo') ?></th>
            <td><?= h($course->start_date) ?> - <?= h($course->end_date) ?></td>
        </tr>       
        <tr>
            <th scope="row"><?= __('Cadenza settimanale') ?></th>
            <td>
                <?php foreach ($course['week_days'] as $dayNumber) : ?>
                    <?= $weekdaysHelper->int2str($dayNumber) ?>
                <?php endforeach; ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ora di inizio') ?></th>
            <td><?= h($course->start_time->i18nFormat('HH:mm')) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Durata') ?></th>
            <td><?= h($course->duration) ?> <?= __('minuti') ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Numero di atleti attualmente iscritti') ?></th>
            <td><?= count($course->course_subscriptions) ?></td>
        </tr>        
    </table>
    <hr>
	    <?= $this->Form->create($course_subscription) ?>
    	<h3><?= __('Selezione atleta') ?></h3>
	    <div class="row">
	        <div class="col">
	            <?php if ($course_subscription->athlete != null) : ?>
	                <?= __('Atleta selezionato') ?>: <?= $course_subscription->athlete->name . ' ' . $course_subscription->athlete->surname ?>
	                <?= $this->Form->hidden('athlete_id', ['value' => $course_subscription->athlete_id]) ?>
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
	    <?= $this->Form->button(__('Submit')) ?>
	    <?= $this->Form->end() ?>
    </div>

</div>

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