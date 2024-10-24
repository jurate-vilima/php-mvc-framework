<h1>Home page</h1>

<?php

use JurateVilima\MvcCore\Application;

 if(isset($_SESSION['flash']['success'])): ?>
    <div class="alert alert-success"><?= Application::$app->session->getFlash('success') ?></div>
<?php endif; ?>