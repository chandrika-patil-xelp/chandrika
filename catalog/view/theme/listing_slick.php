<?php
global $config, $loader, $registry;
$store_id = $config->get('config_store_id');
$lang = $config->get('config_language_id');

$customisation_general = $config->get('customisation_general_store');
$customisation_products = $config->get('customisation_products_store');
$customisation_translation = $config->get('customisation_translation_store');

$loader->model('catalog/product');

$model = $registry->get('model_catalog_product');

$loader->model('custom/general');
$model_module = $registry->get('model_custom_general');


$width_settings = $config->get('config_image_product_width');
$height_settings = $config->get('config_image_product_height');

?>

<div class="products-nospace-outer products-list">
<div class="products-nospace products-isotope">

<?php
    foreach ($products as $product) :

        $product_info = $model->getProduct($product['product_id']);



        if ($product['special']): $special_end_date = $model_module->getDateEnd($product['product_id']);  endif;


        if (isset($slick_enable) && $slick_enable == 1) {
            $loader->model('custom/general');
            $model_product = $registry->get('model_custom_general');

            $slick_use = $model_product->getProductOptionSlick($product['product_id'], 'slick_status');


            if ($slick_use != 0):
                $slick_block = $model_product->getProductOption($product['product_id'], 'slick_block', '1');
            endif;

        }

        if ($slick_use != 0 && isset($slick_enable) && $slick_enable == 1 && isset($slick_block)&& $slick_block != '') {
                echo '<div class="product_'.$product['product_id'].' banner '.$slick_use.'">'.$slick_block.'</div>';
            } else {


    ?>

        <div class="product-preview">
            <a href="<?php echo $product['href']; ?>" class="preview-image">

                <?php
            $loader->model('custom/general');
            $model_product = $registry->get('model_custom_general');
            $featured_image = $model_product->getProductOptionSlick($product['product_id'], 'fimage');
            $featured_status = $model_product->getProductOptionSlick($product['product_id'], 'featured');

            if ($featured_status != 0 && $featured_image != '') {
                $loader->model('tool/image');
                $model_resize = $registry->get('model_tool_image');

                $featured = $model_resize->resize($featured_image, $width_settings, $height_settings);
                $featured2x = $model_resize->resize($featured_image, $width_settings*2, $height_settings*2);
                ?>

                <img class="img-default product-retina img-responsive" src="<?php echo 'image/'.$featured_image; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>">
<?php
            } else { ?>
                <img class="img-responsive img-default" src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>">
                <?php } ?>

            </a>
            <div class="hover">
                <div class="inside">
                    <h3 class="title"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h3>
                    <?php if (!isset($customisation_products["product_catalog_mode"][$store_id]) || $customisation_products["product_catalog_mode"][$store_id] != 1) : ?>
                    <?php if ($product['price']) : ?>
                        <?php if (!$product['special']) { ?>
                            <span class="price regular"><?php echo $product['price']; ?></span>
                            <?php } else { ?>
                            <span class="price old"><?php echo $product['price']; ?></span>
                            <span class="price new"><?php echo $product['special']; ?></span>
                            <?php } ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if ($product['rating']) : ?>
                    <div class="rating">
                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                        <?php if ($product['rating'] < $i) { ?>
                            <span class="fa fa-stack">
                          <i class="fa fa-star-o fa-stack-1x"></i>
                      </span>
                            <?php } else { ?>
                            <span class="fa fa-stack">
                          <i class="fa fa-star fa-stack-1x"></i>
                          <i class="fa fa-star-o fa-stack-1x"></i>
                      </span>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <?php endif; ?>


                    <ul class="product-controls-list">
                        <li><a onclick="wishlist_theme.add('<?php echo $product['product_id']; ?>');" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>"><span class="icon flaticon-heart68"></span></a></li>
                        <li><a onclick="compare_theme.add('<?php echo $product['product_id']; ?>');" data-toggle="tooltip" title="<?php echo $button_compare; ?>"><span class="icon flaticon-bars34"></span></a></li>
                        <li><a onclick="cart_theme.add('<?php echo $product['product_id']; ?>', '<?php echo $product['minimum']; ?>');" class="add-to-cart open-cart7" data-toggle="tooltip" title="<?php echo $button_cart; ?>"><span class="icon flaticon-shopping66"></span></a></li>
                    </ul>


                </div>
            </div>



        </div>
        <?php } ?>

        <?php endforeach; ?>



</div>
</div>

