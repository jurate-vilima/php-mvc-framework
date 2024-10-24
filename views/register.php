<?php 
use JurateVilima\MvcCore\form\Form;
?>

<h1>Register</h1>

<?= Form::begin('', 'post'); ?>
  <div class="row">
    <?= $params['form']->createField('firstname') ?>
    <?= $params['form']->createField('lastname') ?>
  </div>
  <?= $params['form']->createField('email') ?>
  <?= $params['form']->createField('password') ?>
  <?= $params['form']->createField('confirmPassword') ?>
  
  <button type="submit" class="btn btn-primary">Submit</button>
<?= Form::end(); ?>