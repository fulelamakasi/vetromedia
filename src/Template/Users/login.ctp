<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Quick Links') ?></li>
        <li><?= $this->Html->link(__('Register'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Compare Rates'), ['controller' => 'Pages', 'action' => 'compareRatesNoneUser']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Login') ?></legend>
        <?php
            echo $this->Form->control('username', ['required' => true]);
            echo $this->Form->control('password', ['required' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
