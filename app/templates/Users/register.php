<h2>Login</h2>
<?= $this->Form->create() ?>
    <?= $this->Form->control('username', ['label' => 'Username']) ?>
    <?= $this->Form->control('email', ['label' => 'Email']) ?>
    <?= $this->Form->control('password', ['label' => 'Password', 'type' => 'password']) ?>
    <?= $this->Form->submit('Login') ?>
<?= $this->Form->end() ?>