<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Bookmarks Tag'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bookmarksTags index large-9 medium-8 columns content">
    <h3><?= __('Bookmarks Tags') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('bookmark_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tag_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookmarksTags as $bookmarksTag): ?>
            <tr>
                <td><?= $this->Number->format($bookmarksTag->bookmark_id) ?></td>
                <td><?= $this->Number->format($bookmarksTag->tag_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $bookmarksTag->bookmark_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bookmarksTag->bookmark_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bookmarksTag->bookmark_id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookmarksTag->bookmark_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
