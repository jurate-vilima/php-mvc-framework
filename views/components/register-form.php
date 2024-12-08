<?php
use JurateVilima\MvcCore\Application;
use JurateVilima\MvcCore\form\Form; 
?>

<div class="form form--register">
    <?= $params['registerForm']->begin('', 'post') ?> 
        <?= $params['registerForm']->getFormName() ?>

        <div class="form__message"></div>
        
        <?= $params['registerForm']->createField('email') ?>
        <?= $params['registerForm']->createField('password') ?>
        <?= $params['registerForm']->createField('confirmPassword') ?>

        <button type="submit" class="form__button button">Reģistrēties</button>
    <?= Form::end() ?>

    <div class="form__question">
        <span class="form__text">Jums jau ir akaunts?</span>
        <a href="#" class="form__link">Ielogoties</a>
    </div>

</div>