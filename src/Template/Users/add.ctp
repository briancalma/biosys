
<?= $this->Form->create() ?>
<fieldset>
    <legend><?= __('Add User') ?></legend>
    <?php
        echo $this->Form->control('email');
        echo $this->Form->control('username');
        echo $this->Form->control('password');
        echo $this->Form->control('firstname');
        echo $this->Form->control('lastname');
        echo $this->Form->control('gender');
        echo $this->Form->control('address');
        echo $this->Form->control('profile_pic');
    ?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>

