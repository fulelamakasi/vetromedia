<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Forgot Password') ?></legend>
        <?php
            echo $this->Form->control('username', ['required' => true]);
            echo $this->Form->control('emailaddress', ['required' => true]);
            echo $this->Form->control('password', ['required' => true]);
            echo $this->Form->control('confirm_password', ['type' => 'password', 'required' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

