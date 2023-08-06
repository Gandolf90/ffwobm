<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')) ?>
        <title><?= h($this->fetch('title')) ?></title>

        <base href="<?= dirname($_SERVER['PHP_SELF']) ?>">
        <?= $this->Html->meta('icon') ?>
        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">

        <?= $this->Html->css(['custom.css' , 'bootstrap-5.3.1-dist/css/bootstrap.min.css', 'login.css']) ?>
        <?= $this->Html->script(['bootstrap-5.3.1-dist/js/bootstrap.bundle.min.js']) ?>


        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
    </head>
    <body class="gray-bg">
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <?= $this->Form->create() ?>
                        <div class="mb-md-5 mt-md-4 pb-5">

                        <h2 class="fw-bold mb-2 text-uppercase"><?= __('Login'); ?></h2>
                        <p class="text-white-50 mb-5"><?= __('Please enter your login and password!'); ?></p>

                        <div class="form-outline form-white mb-4">
                            <?= $this->Form->control('email', ['label' => 'Email','labelOptions' => ['class' => 'form-label '], 'class' => 'form-control form-control-lg']) ?>
                        </div>

                        <div class="form-outline form-white mb-4">
                            <?= $this->Form->control('password', ['label' => 'Password','labelOptions' => ['class' => 'form-label '], 'type' => 'password', 'class' => 'form-control form-control-lg']) ?>
                        </div>

                        <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!"><?= __('Forgot password?'); ?> </a></p>

                        <?= $this->Form->submit('Login', ['class' => 'btn btn-outline-light btn-lg px-5']) ?>

                        </div>

                        <div>
                        <p class="mb-0"><?= __('Don\'t have an account?'); ?> <a href="#!" class="text-white-50 fw-bold"><?= __('Sign Up'); ?></a></p>
                        </p>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
    </body>
</html>
