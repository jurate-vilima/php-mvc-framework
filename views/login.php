<?php
use JurateVilima\MvcCore\Application;
use JurateVilima\MvcCore\form\Form; 
?>

<h1>Login</h1>

<?php if($message = Application::$app->session->getFlash('login')): ?>
	<div class="alert alert-danger" role="alert">
		<?= $message ?>
	</div>
<?php endif; ?>

<?= Form::begin('', 'post') ?>
	<?= $params['form']->createField('email') ?>
	<?= $params['form']->createField('password') ?>

	<button type="submit" class="btn btn-primary">Submit</button>
<?= Form::end() ?>