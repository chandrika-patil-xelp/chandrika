<?php
global $config, $loader, $registry;

$store_id = $config->get('config_store_id');
$customisation_general = $config->get('customisation_general_store');

if (isset($customisation_general["slick_row"][$store_id]) && $customisation_general["slick_row"][$store_id] != ''&& $customisation_general["slick_row"][$store_id] != 0) {
    $array_count = $customisation_general["slick_row"][$store_id];
} else {
    $array_count = 8;
}

$loader->model('custom/general');
$model_module = $registry->get('model_custom_general');

$settings = $model_module->getModuleImage($products[0]['thumb']);
$width_settings = $settings[0];
$height_settings = $settings[1];

?>

<section class="container content">
    <h6 style="display:none">&nbsp;</h6>
    <div class="subtitle right-space">
        <div><span><?php echo $heading_title; ?></span></div>
    </div>
    <div class="slick-arrows">
        <button type="button" class="slick-prev" id="prevSlick" style="display: block;">Previous</button>
        <button type="button" class="slick-next" id="nextSlick" style="display: block;">Next</button>
    </div>

    <div class="products-nospace-outer row1">
        <div class="products-nospace">
            <div class="slides row1">
                <?php $key_count = 1; foreach(array_slice ($products, 0, $array_count) as $key => $product)  : ?>
                         <?php include('catalog/view/theme/slider_full_screen_listing.php'); ?>
                <?php $key_count ++; endforeach; ?>
            </div>
        </div>
    </div>
    <!-- product view ajax container -->
    <div class="product-view-ajax-container"></div>
    <!-- //end product view ajax container -->

    <?php if (count($products) > $array_count) : $count_last = count($products) - $array_count;  ?>
    <div class="products-nospace-outer row2">
        <div class="products-nospace">
            <div class="slides">
                <?php foreach(array_slice ($products, -$count_last, $count_last) as $product)  : ?>
                      <?php $key_count = false; include('catalog/view/theme/slider_full_screen_listing.php'); ?>
                <?php endforeach;  ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- product view ajax container -->
    <div class="product-view-ajax-container"></div>
    <!-- //end product view ajax container -->

    <!-- Product view compact -->
    <div class="product-view-ajax">
        <div class="layar"></div>
        <div class="product-view-container"></div>
    </div>
    <!-- //end Product view compact -->





</section>






