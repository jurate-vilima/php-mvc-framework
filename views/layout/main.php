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
    <header class="header">
        <div class="header__container container">
            <div class="header__logo">
                HealSunc
                <!-- there must be an image -->
            </div>
            <div class="header__links">
                <ul class="header__list">
                    <li class="header__item">
                        <a href="" class="header__link">A</a>
                    </li>
                    <li class="header__item">
                        <a href="" class="header__link">A</a>
                    </li>
                    <li class="header__item">
                        <a href="" class="header__link">A</a>
                    </li>
                    <li class="header__item">
                        <a href="" class="header__link">A</a>
                    </li>
                </ul>
            </div>
            <div class="header__buttons">
                <div class="header__button button">Sign in</div>
                <div class="header__button button">Register</div>
            </div>
        </div>
    </header>
    
    <?= $content ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
