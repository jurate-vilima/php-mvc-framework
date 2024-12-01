<?php
/** @var $this \JurateVilima\MvcCore\View */

use JurateVilima\MvcCore\Application;
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= Application::$BASE_URL ?>/css/main.css">

</head>
<body>       
    <?= $content ?>
    
    <script type="module" src="<?= Application::$BASE_URL ?>/js/main.js"></script>
</body>
</html>
