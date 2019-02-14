<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonEditionsBundle $lessonEditionsBundle
 */
?>
<div class="lessonEditionsBundles content">
     <h3>
      <?= __('Lessons Management') ?> - <?= __('View Lesson Editions Bundle') ?>
    </h3>
    <small><?= __('...') ?></small>    
    <hr>
    <table class="table table-striped">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($lessonEditionsBundle->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($lessonEditionsBundle->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?=$this->Text->autoParagraph(h($lessonEditionsBundle->description)) ?></td>
        </tr>        
        <tr>
            <th scope="row"><?= __('Lesson Edition Count') ?></th>
            <td><?= $this->Number->format($lessonEditionsBundle->lesson_edition_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($lessonEditionsBundle->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lesson') ?></th>
            <td><?= $lessonEditionsBundle->lesson->name ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Active') ?></th>
            <td><?= $lessonEditionsBundle->is_active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
