<?php
   global $config, $loader, $registry, $settings;
   $type_of_slider = 'special';

   $store_id = $config->get('config_store_id');

    $customisation_slider = $config->get('customisation_slider_store');

    $loader->model('custom/general');
    $model_module = $registry->get('model_custom_general');
    $setting = $model_module->getModuleSettings($type_of_slider);

    $layout_id = $model_module->getCurrentLayout();

    if ($layout_id == 3) {
        $left_column_number = 1;
        include('catalog/view/theme/slider_vertical.php');
    } else {
        if (!isset($customisation_slider[$type_of_slider.'_type'][$store_id]) || $customisation_slider[$type_of_slider.'_type'][$store_id] == 'vertical') {
        include('catalog/view/theme/slider_vertical.php');
        } elseif ($customisation_slider[$type_of_slider.'_type'][$store_id] == 'horizontal') {
        include('catalog/view/theme/slider_horizontal_carousel.php');
        } else {
        include('catalog/view/theme/slider_slick.php');
        }
    }
?>
