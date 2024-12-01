<?php
use JurateVilima\MvcCore\Application;
?>
<section class="banner container">
    <div class="banner__info">
        <h1 class="banner__title">No Compromise</h1>
        <h2 class="banner__text">Connecting You</h2>
        <div class="banner__link">
            <a href="" class="banner__button button">Connecting You</a>
        </div>
    </div>

    <div class="banner__img">

        <div class="banner__img-container sphere">
            <div class="sphere__area">

                <div class="sphere__glare">
                    <svg class="sphere__svg svg" viewBox="0 0 107 138" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                        <path d="M0.0635298 130.039C14.1864 78.0027 46.0961 32.3319 90.4304 0.70185L106.592 22.6019C67.3737 50.5823 39.1459 90.9833 26.6526 137.015L0.0635298 130.039Z"/>
                    </svg>
                </div>
                    
            </div>
        </div>

        <svg class="banner__image-mask svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 120">
            <defs>
                <!-- Mask Definition -->
                <clipPath id="mask">
                    <!-- Flexible mask that adjusts to image dimensions -->
                    <path d="M0 0 H100 V70 A50 50 0 0 1 0 70 Z" />
                </clipPath>
            </defs>
        
            <!-- Image -->
            <image class="img"
                href="<?= Application::$BASE_URL ?>/images/banner-doctor.png" 
                clip-path="url(#mask)" 
                preserveAspectRatio="xMidYMid slice" />       
        </svg>

        <div class="banner__filter"></div>

    </div>       
</section>