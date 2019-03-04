<?php

?>
<div class="border border-info rounded p-2 mb-5">
<h5><?= __('Filter results by Athlete') ?></h5>
<?php
    echo $this->Form->create(null, ['valueSources' => 'query']);
    // Match the search param in your table configuration
    echo $this->Form->control('q', ['label' => __('Search for text in name or surname fields')]);
    echo $this->Form->button('Filter', ['type' => 'submit']);
    echo $this->Html->link('Reset', ['action' => $this->request->action]);
    echo $this->Form->end();
?>
</div>