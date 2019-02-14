<?php

?>

<div class="form-group">
    <label class="col-form-label"><?= _('Athlete') ?></label>
    <input type="text" id="athlete_surname" class="form-control"> <a id="search_athlete" class="btn btn-secondary text-white"><?= __('Search Athletes by surname') ?></a>
    <div id="target_athlete"></div>
    <div>Selected Athlete: <span id="selected_athlete"><?= $selectedAthlete ?></span> </div>
    <?php echo $this->Form->text('lesson_edition.athlete_id', ['id' => 'athlete_id']); ?> 
</div>

<script language="javascript">
    $('#target_athlete').on('click', 'a' ,function() {
        id = this.id;
        console.log('Clicked on athlete '+ id);
        $('#athlete_id').val(id);
        $('#selected_athlete').html($('#target_athlete #' + id).clone());
    });

    $('#search_athlete').click(function() {
        $('#target_athlete').empty();
        var searchString = $('#athlete_surname').val();
        var targeturl = '/Athletes/ajax-search-active.json?surname=' + searchString;
        $.ajax({
            type: 'get',
            url: targeturl,
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/json');
            },
            success: function(response) {
                console.log('Displaying search results');
                $.each(response.athletes, function( index, value ) {
                    console.log(index + ": "+ value['name']);
                    $('#target_athlete').append('<div class="athlete"><a value="'+ value['name'] + value['surname'] +'" id="' + value['id'] +'">' + value['name'] + ' ' + value['surname'] + ' - ' + value['asi_subscription_number'] + ' - ' + value['asi_subscription_date'] + '</a></div>');
                });                        
            },
            error: function(e) {
                alert("An error occurred: " + e.responseText.message);
                console.log(e);
            }
        });
    });
</script>