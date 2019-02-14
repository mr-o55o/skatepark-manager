<?php

?>
<!-- -->
<div class="form-group">
    <label class="col-form-label"><?= $label ?></label>
    <input type="text" id="user_text_string" class="form-control"> <a id="search_user" class="btn btn-secondary text-white"><?= __('Search {0} by username', $label) ?></a>
    <div id="target_user"></div>
    <div>Selected <?= $label ?>: <span id="selected_user"><?= $selectedUser ?></span> </div>
    <?= $this->Form->text($event.'.user_id', ['id' => 'user_id', 'label' => __('User')]); ?>        
</div>

<!-- ajax script -->
<script language="javascript">
    $('#target_user').on('click', 'a' ,function() {
        id = this.id;
        console.log('Clicked on user '+ id);
        $('#user_id').val(id);
        $('#selected_user').html($('#target #' + id).clone());
    });

    $('#search_user').click(function() {
        $('#target_user').empty();
        var searchString = $('#user_text_string').val();
        var targeturl = '/Users/ajax-search.json?role=<?=$role?>&username='+searchString;
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
                    $('#target_user').append('<div class="user"><a value="'+ value['name'] + value['surname'] +'" id="' + value['id'] +'">' + value['name'] + ' ' + value['surname'] + '</a></div>');
                });                        
            },
            error: function(e) {
                alert("An error occurred: " + e.responseText.message);
                console.log(e);
            }
        });
    });
</script>