<?php
use JurateVilima\MvcCore\Application;
use JurateVilima\MvcCore\form\Form; 
?>

<div class="form form--login">
    <?php if($message = Application::$app->session->getFlash('login')): ?>
        <div class="alert alert-danger">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <?= $params['loginForm']->begin('', 'post') ?> 
        <?= $params['loginForm']->getFormName() ?>
        <?= $params['loginForm']->createField('email') ?>
        <?= $params['loginForm']->createField('password') ?>

        <button type="submit" class="form__button button">Ielogoties</button>
    <?= Form::end() ?>

    <div class="form__question">
        <span class="form__text">Jums vēl nav akaunta?</span>
        <a href="#" class="form__link">Reģistrēties</a>
    </div>

</div>