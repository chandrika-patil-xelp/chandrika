<?php
global $config, $loader, $registry, $settings;
$store_id = $config->get('config_store_id');
$customisation_products = $config->get('customisation_products_store');

?>
<?php if (isset($left_column_number)) { ?>
<div class="panel-heading">
    <a data-toggle="collapse" class="collapsed" href="#<?php echo $type_of_slider; ?>23">
        <span class="arrow-down">+</span>
        <span class="arrow-up">-</span> <?php echo $heading_title; ?>
    </a>
</div>
<?php } else { ?>
<div class="pull-left vertical_title_outer title-sm  right-space">
    <div><span><?php echo $heading_title; ?></span></div>
</div>
<?php } ?>

<?php if (isset($left_column_number)) : ?><div id="<?php echo $type_of_slider; ?>23"  class="panel-collapse collapse"><?php endif; ?>
    <div class="<?php echo (isset($left_column_number) ? 'panel-body' : 'pull-left carousel_outer'); ?>">

        <div class="products-widget vertical">
            <div class="slides slick-style2">

                <?php
                $settings = $model_module->getModuleImage($products[0]['thumb']);
                $width_settings = $settings[0];
                $height_settings = $settings[1];

                $loader->model('tool/image');
                $model_resize = $registry->get('model_tool_image');


                foreach ($products as $product) :

                    $model_image = $registry->get('model_catalog_product');
                    $product_info = $model_image->getProduct($product['product_id']);

                    $popup2x = $model_resize->resize($product_info['image'], $width_settings*2, $height_settings*2);

                    ?>

                <div class="carousel-item">
                    <div class="product">
                        <div class="preview-image-outer">
                            <a href="<?php echo $product['href']; ?>" class="preview-image">
                                <img width="<?php echo $width_settings; ?>" height="<?php echo $height_settings; ?>" class="img-responsive product-retina" src="<?php echo $product['thumb']; ?>" data-image2x="<?php echo $popup2x; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>">
                            </a>
                        </div>
                        <p class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a> </p>

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

                    </div>
                </div>


                <?php endforeach; ?>

            </div>
        </div>
    </div>
<?php if (isset($left_column_number)) : ?></div><?php endif; ?>
