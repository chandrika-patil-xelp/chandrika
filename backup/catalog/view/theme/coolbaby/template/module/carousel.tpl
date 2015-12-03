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
<section id="carousel<?php echo $module; ?>" class="container content brands-slider">
    <h6 style="display:none">&nbsp;</h6>
    <div class="subtitle right-space">
        <div><span><?php echo (!isset($customisation_translation[$lang]["brands_title"][$store_id]) ? 'BRANDS' : $customisation_translation[$lang]["brands_title"][$store_id]); ?></span></div>
    </div>
    <div class="brands-carousel">
        <div class="slides">
            <?php foreach ($banners as $banner) : ?>
            <div>
                <?php if ($banner['link']) : ?><a href="<?php echo $banner['link']; ?>"><?php endif; ?>
                    <img width="<?php echo $width_settings; ?>" height="<?php echo $height_settings; ?>" class="img-responsive" src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>">
                <?php if ($banner['link']) : ?></a><?php endif; ?>
            </div>

            <?php endforeach; ?>
        </div>
    </div>
</section>


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