<?php

?>

<div class="border border-info rounded p-2 mb-5">
<h5><?= __('Filter by Users') ?></h5>
<?php
    echo $this->Form->create(null, ['valueSources' => 'query']);
    // Match the search param in your table configuration
    echo $this->Form->input('q', ['label' => false, 'placeholder' => __('Type some text to search for in user details')]);
    echo $this->Form->button('Search', ['type' => 'submit']);
    echo $this->Html->link('Reset', ['action' => $this->request->action]);
    echo $this->Form->end();
?>
</div>