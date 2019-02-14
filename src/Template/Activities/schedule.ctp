<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonEdition $lessonEdition
 */
?>
<div class="activities content">
    <?= $this->Form->create($activity) ?>
    <fieldset>
        <legend><?= __('Schedule Activity') ?></legend>
        <?= $this->Form->control('activity_type_id', ['options' => $activity_types]); ?>

        <label><?= __('Day') ?></label>
        <?= $this->Form->year('event.start_date', [
            'minYear' => date('Y'),
        ]) ;?>
        <?= $this->Form->month('event.start_date', [
        ]) ;?>
        <?= $this->Form->day('event.start_date', [
        ]) ;?>

        <label><?= __('Time') ?></label>
        <?= $this->Form->time('event.start_date', [
            'interval' => 15,
        ]); ?>

        <?= $this->Form->hours('duration', [
        ]) ;?>       
        <hr>
        <div class="form-group">
            <label class="col-form-label"><?= _('Trainer') ?></label>
            <input type="text" id="trainer_surname" class="form-control"> <a id="search_trainer" class="btn btn-secondary text-white"><?= __('Search Trainers by surname') ?></a>
            <div id="target_trainer"></div>
            <div>Selected Trainer: <span id="selected_trainer">None</span> </div>
            <?php echo $this->Form->text('user_id', ['id' => 'trainer_id', 'label' => __('Trainer')]); ?>        
        </div>

    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<script language="javascript">

    $('#target_trainer').on('click', 'a' ,function() {
        id = this.id;
        console.log('Clicked on athlete '+ id);
        $('#trainer_id').val(id);
        $('#selected_trainer').html($('#target #' + id).clone());
    });

    $('#search_trainer').click(function() {
        $('#target_trainer').empty();
        var searchString = $('#trainer_surname').val();
        var targeturl = '/Users/ajax-search-trainer.json?surname='+searchString;
        $.ajax({
            type: 'get',
            url: targeturl,
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/json');
            },
            success: function(response) {
                console.log('Displaying search results');

                $.each(response.users, function( index, value ) {
                    console.log(index + ": "+ value['name']);
                    $('#target_trainer').append('<div class="trainer"><a value="'+ value['name'] + value['surname'] +'" id="' + value['id'] +'">' + value['name'] + ' ' + value['surname'] + '</a></div>');
                });                        
            },
            error: function(e) {
                alert("An error occurred: " + e.responseText.message);
                console.log(e);
            }
        });
    });
</script>