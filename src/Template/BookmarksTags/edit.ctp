<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $bookmarksTag->bookmark_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $bookmarksTag->bookmark_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Bookmarks Tags'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="bookmarksTags form large-9 medium-8 columns content">
    <?= $this->Form->create($bookmarksTag) ?>
    <fieldset>
        <legend><?= __('Edit Bookmarks Tag') ?></legend>
        <?php
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
