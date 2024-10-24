<?php 
use JurateVilima\MvcCore\Application;
use JurateVilima\MvcCore\form\Form; 
?>

<?php if($message = Application::$app->session->getFlash('contact')): ?>
	<div class="alert alert-success" role="alert">
		<?= $message ?>
	</div>
<?php endif; ?>

<h2>Contacts</h2>

<?= Form::begin('', 'post') ?>
	<?= $params['form']->createField('firstname') ?>
	<?= $params['form']->createField('lastname') ?>
	<?= $params['form']->createField('tel', 'input', 'tel') ?>
	<?= $params['form']->createField('message', "textarea") ?>

	<button type="submit" class="btn btn-primary">Submit</button>
<?= Form::end() ?>