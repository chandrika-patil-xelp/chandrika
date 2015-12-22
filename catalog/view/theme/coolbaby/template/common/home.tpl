<?php
    echo $header;

    global $config, $loader, $registry;
    $store_id = $config->get('config_store_id');
    $lang = $config->get('config_language_id');

$customisation_general = $config->get('customisation_general_store');

$loader->model('custom/general');
$model = $registry->get('model_custom_general');
$layout_id = $model->getCurrentLayout();

echo $loader->controller('common/top_promo');
?>



<?php if ($column_left || $column_right) : ?>
<div class="container content content-first container_columns">
    <div class="row">
        <?php echo $column_left; ?>
        <?php echo $column_right; ?>
    </div>
</div>
<?php endif; ?>




<?php
    echo $content_top;
    echo $content_bottom;

    echo $loader->controller('common/product_widget');
?>

<!-- Popup box -->
<?php if (!isset($customisation_general["newsletter_popup_status"][$store_id]) || $customisation_general["newsletter_popup_status"][$store_id] != 0) : ?>

<?php
    $your_apikey = $customisation_general["apikey"][$store_id];
    $my_list_unique_id = $customisation_general["list_unique_id"][$store_id];

$newsletter_placeholder = (isset($customisation_general[$lang]["newsletter_placeholder"][$store_id]) ? $customisation_general[$lang]["newsletter_placeholder"][$store_id] : 'Your E-mail...');
?>

<?php endif; ?>

<!-- //end Popup box -->

<?php echo $footer; ?>