<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Convert Currency') ?></legend>
        <?php
            echo $this->Form->control('amount', ['required' => true]);
            echo $this->Form->control('countryfrom', ['options' => $countryfrom]);
            echo $this->Form->control('countryto', ['options' => $countryto]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

