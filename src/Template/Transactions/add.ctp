<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Transactions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="transactions form large-9 medium-8 columns content">
    <?= $this->Form->create($transaction) ?>
    <fieldset>
        <legend><?= __('Add Transaction') ?></legend>
        <?php
            echo $this->Form->control('original_price');
            echo $this->Form->control('converted_price');
            echo $this->Form->control('surge');
            echo $this->Form->control('surge_amount');
            echo $this->Form->control('currency_to_exchangerate');
            echo $this->Form->control('currency_from');
            echo $this->Form->control('currency_to');
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('editedby');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
