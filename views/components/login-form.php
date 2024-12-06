<?php
use JurateVilima\MvcCore\Application;
use JurateVilima\MvcCore\form\Form; 
?>

<div class="form form--login">
    <?= $params['loginForm']->begin('', 'post') ?> 
        <?= $params['loginForm']->getFormName() ?>

        <div class="form__message"></div>

        <?= $params['loginForm']->createField('email') ?>
        <?= $params['loginForm']->createField('password') ?>

        <button type="submit" class="form__button button">Ielogoties</button>
    <?= Form::end() ?>

    <div class="form__question">
        <span class="form__text">Jums vēl nav akaunta?</span>
        <a href="#" class="form__link">Reģistrēties</a>
    </div>

</div>