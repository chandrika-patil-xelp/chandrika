<?php
global $config, $loader, $registry;

$store_id = $config->get('config_store_id');
$lang = $config->get('config_language_id');
$customisation_translation = $config->get('customisation_translation_store');

$loader->model('custom/general');
$model_module = $registry->get('model_custom_general');

if (sizeof($banners)) {
    $settings = $model_module->getModuleImage($banners[0]['image']);
    $width_settings = $settings[0];
    $height_settings = $settings[1];
} else {
    $width_settings = 160;
    $height_settings = 65;
}





?>


<script type="text/javascript">
    jQuery(function ($) {
        "use strict";
        var brandsImg = $j(".brands-carousel img");
        $j(".brands-carousel a").append('<div class="after"></div>');

    });


    var brandsCarousel = $j(".brands-carousel .slides");

    brandsCarousel.slick({
        dots: false,
        infinite: true,
        autoplay: false,
        autoplaySpeed: 2000,
        speed: 500,
        slidesToShow: 7,
        slidesToScroll: 1,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 4
            }
        }, {
            breakpoint: 768,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 3
            }
        }, {
            breakpoint: 480,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 2
            }
        }]
    });
</script>