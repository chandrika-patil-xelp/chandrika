<?php
if (isset($products) && sizeof($products) > 0) :

   global $config, $loader, $registry, $settings;
   $type_of_slider = 'upsells';

   $store_id = $config->get('config_store_id');

$customisation_slider = $config->get('customisation_slider_store');

$loader->model('custom/general');
$model_module = $registry->get('model_custom_general');
$setting = $model_module->getModuleSettings($type_of_slider);

$layout_id = $model_module->getCurrentLayout();
$related = 1;
$upsells = 1;
include('catalog/view/theme/slider_horizontal_carousel.php');



endif;
?>