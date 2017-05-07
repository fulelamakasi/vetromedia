<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Transaction'), ['action' => 'edit', $transaction->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Transaction'), ['action' => 'delete', $transaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $transaction->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Transactions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Transaction'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="transactions view large-9 medium-8 columns content">
    <h3><?= h($transaction->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $transaction->has('user') ? $this->Html->link($transaction->user->id, ['controller' => 'Users', 'action' => 'view', $transaction->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Editedby') ?></th>
            <td><?= h($transaction->editedby) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($transaction->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Original Price') ?></th>
            <td><?= $this->Number->format($transaction->original_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Converted Price') ?></th>
            <td><?= $this->Number->format($transaction->converted_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Surge') ?></th>
            <td><?= $this->Number->format($transaction->surge) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Surge Amount') ?></th>
            <td><?= $this->Number->format($transaction->surge_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency To Exchangerate') ?></th>
            <td><?= $this->Number->format($transaction->currency_to_exchangerate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency From') ?></th>
            <td><?= $this->Number->format($transaction->currency_from) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency To') ?></th>
            <td><?= $this->Number->format($transaction->currency_to) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($transaction->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($transaction->modified) ?></td>
        </tr>
    </table>
</div>
