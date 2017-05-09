<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('New User') ?></legend>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('password', ['required' => true]);
            echo $this->Form->control('confirm_password', ['type' => 'password', 'required' => true]);
            echo $this->Form->control('firstname');
            echo $this->Form->control('lastname');
            echo $this->Form->control('emailaddress');
            echo $this->Form->control('phonenumber');
            echo $this->Form->control('country_id', ['options' => $countries]);
            echo $this->Form->control('editedby', ['type' => 'hidden']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
