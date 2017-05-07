<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Country'), ['action' => 'edit', $country->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Country'), ['action' => 'delete', $country->id], ['confirm' => __('Are you sure you want to delete # {0}?', $country->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Countries'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Country'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="countries view large-9 medium-8 columns content">
    <h3><?= h($country->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($country->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Code') ?></th>
            <td><?= h($country->code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency') ?></th>
            <td><?= h($country->currency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency Code') ?></th>
            <td><?= h($country->currency_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Editedby') ?></th>
            <td><?= h($country->editedby) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($country->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Surge') ?></th>
            <td><?= $this->Number->format($country->surge) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($country->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($country->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($country->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Username') ?></th>
                <th scope="col"><?= __('Firstname') ?></th>
                <th scope="col"><?= __('Lastname') ?></th>
                <th scope="col"><?= __('Emailaddress') ?></th>
                <th scope="col"><?= __('Phonenumber') ?></th>
                <th scope="col"><?= __('Is Emailverified') ?></th>
                <th scope="col"><?= __('Country Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Editedby') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($country->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->username) ?></td>
                <td><?= h($users->firstname) ?></td>
                <td><?= h($users->lastname) ?></td>
                <td><?= h($users->emailaddress) ?></td>
                <td><?= h($users->phonenumber) ?></td>
                <td><?= h($users->is_emailverified) ?></td>
                <td><?= h($users->country_id) ?></td>
                <td><?= h($users->created) ?></td>
                <td><?= h($users->modified) ?></td>
                <td><?= h($users->editedby) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
