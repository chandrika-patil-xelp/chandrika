<?php
global $config, $loader, $registry;
$store_id = $config->get('config_store_id');
$lang = $config->get('config_language_id');

$config_product_description_length = $config->get('config_product_description_length');

$customisation_general = $config->get('customisation_general_store');
$customisation_products = $config->get('customisation_products_store');
$customisation_translation = $config->get('customisation_translation_store');

if (isset($type_category) && $type_category == 1) {
    $type_of_slider = 'category';
    $quick_view = !isset($customisation_products["quick_listing_type"][$store_id]) || ($customisation_products["quick_listing_type"][$store_id] != 2) ? 1 : 2;
} else {
    $quick_view = !isset($customisation_products["quick_sliders_slick_type"][$store_id]) || ($customisation_products["quick_sliders_slick_type"][$store_id] != 2) ? 1 : 2;
}
?>


<div class="carousel-item <?php echo ($key_count != false ? $key_count : ''); ?>">
    <div class="product-preview">

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
            <a href="<?php echo $product['href']; ?>" class="preview-image main-image-<?php echo $product['product_id']; ?>">
                <img width="<?php echo $width_settings; ?>" height="<?php echo $height_settings; ?>"  class="img-default product-retina img-responsive first-main-image first-main-image-<?php echo $product['product_id']; ?>" src="<?php echo $featured; ?>" data-image2x="<?php echo $featured2x; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>">
            </a>

            <?php } else { ?>
            <a href="<?php echo $product['href']; ?>" class="preview-image main-image-<?php echo $product['product_id']; ?>">
                <img width="<?php echo $width_settings; ?>" height="<?php echo $height_settings; ?>"  class="img-default img-responsive first-main-image first-main-image-<?php echo $product['product_id']; ?>" src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>">
            </a>
            <?php } ?>


            <?php if (!isset($customisation_products["sale_status"][$store_id]) || ($customisation_products["sale_status"][$store_id] != 0)) : ?>
                <?php if ($product['price'] && $product['special']) : ?>
                    <div class="label label-sale"><span><?php echo (isset($customisation_general[$lang]["sale_text"][$store_id]) ? $customisation_general[$lang]["sale_text"][$store_id] : 'SALE'); ?></span></div>
                <?php endif; ?>
            <?php endif; ?>

        <?php
        $loader->model('catalog/product');
        $model = $registry->get('model_catalog_product');
        $product_info = $model->getProduct($product['product_id']);

        ?>
            <?php if (!isset($customisation_products["discount_status"][$store_id]) || ($customisation_products["discount_status"][$store_id] != 0)) : ?>
                <?php if ($product['price'] && $product['special']) : ?>
                    <div class="label label-sale-percent"><span><?php echo ('-'.round((($product_info['price'] - $product_info['special'])/$product_info['price'])*100, 0).'%'); ?></span></div>
                <?php endif; ?>
            <?php endif; ?>



        <?php
                if (!isset($customisation_products["new_status"][$store_id]) || ($customisation_products["new_status"][$store_id] != 0)) :

                $day_range = 10;
                if ($customisation_products["days"][$store_id] == '') {
                    $days = $day_range;
                } else {
                    $days = $customisation_products["days"][$store_id];
                }
                $day_number_to_range = date( "Y-m-d" ,  strtotime("-$days day")  );
                    if ($product_info['date_available'] >= $day_number_to_range) :

            ?>

                <div class="label label-new"><span><?php echo (isset($customisation_general[$lang]["new_text"][$store_id]) ? $customisation_general[$lang]["new_text"][$store_id] : 'NEW'); ?></span></div>
            <?php
              endif;
            endif;
        ?>

        <div class="hover">
                <div class="inside">
                    <h3 class="title"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h3>

                    <?php if (!isset($customisation_products["product_catalog_mode"][$store_id]) || $customisation_products["product_catalog_mode"][$store_id] != 1) : ?>
                        <?php if ($product['price']) : ?>
                            <?php if (!$product['special']) { ?>
                                <span class="price regular"><?php echo $product['price']; ?> </span>
                                <?php } else { ?>
                                <span class="price new"><?php echo $product['special']; ?></span>
                                <span class="price old"><?php echo $product['price']; ?></span>
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
                        <li><a onclick="cart_theme.add('<?php echo $product['product_id']; ?>');" class="add-to-cart7 open-cart7" data-toggle="tooltip" title="<?php echo $button_cart; ?>"><span class="icon flaticon-shopping66"></span></a></li>

                        <?php if (!isset($customisation_products["quick_status"][$store_id]) || $customisation_products["quick_status"][$store_id] != 0) : ?>

                        <!--parameters to inline block-->
                        <?php
                        $view_details = urlencode(isset($customisation_translation[$lang]["view_details"][$store_id]) ? $customisation_translation[$lang]["view_details"][$store_id] : 'view details');
                        $image = urlencode($product['thumb']);

                        if ($product_info['quantity'] <= 0) {
                            $stock = urlencode($product_info['stock_status']);
                        } elseif ($config->get('config_stock_display')) {
                            $stock = $product_info['quantity'];
                        } else {
                            $stock = urlencode($product_info['stock_status']);
                        }

                        $decription = urlencode($product['description']);
                        $product_href = urlencode($product['href']);
                        $product_name = urlencode($product['name']);

                        if (isset($customisation_general["share_block1"][$store_id])) {
                            $share_f = urlencode($customisation_general["share_block1"][$store_id]);
                        } else {
                            $share_f = urlencode('<li><a href="https://www.facebook.com/"><span class="icon flaticon-facebook12"></span></a></li>');
                        }

                        if (isset($customisation_general["share_block2"][$store_id])) {
                            $share_t = urlencode($customisation_general["share_block2"][$store_id]);
                        } else {
                            $share_t = urlencode('<li><a href="https://twitter.com"><span class="icon flaticon-twitter20"></span></a></li>');
                        }

                        if (isset($customisation_general["share_block3"][$store_id])) {
                            $share_g = urlencode($customisation_general["share_block3"][$store_id]);
                        } else {
                            $share_g = urlencode('<li><a href="https://www.google.com/"><span class="icon flaticon-google10"></span></a></li>');
                        }
                        if (isset($customisation_general["share_block4"][$store_id])) {
                            $share_pin = urlencode($customisation_general["share_block4"][$store_id]);
                        } else {
                            $share_pin = urlencode('<li><a href="https://www.pinterest.com/"><span class="icon flaticon-pinterest9"></span></a></li>');
                        }

                        ?>
                        <!--parameters to inline block-->

                        <li>
                             <?php if ($quick_view == 2) { ?>
                                <a class="quick-view quickview fancybox" data-toggle="tooltip" title="<?php echo (isset($customisation_general[$lang]["quick_view_text"][$store_id]) ? $customisation_general[$lang]["quick_view_text"][$store_id] : 'Quick view'); ?>" onclick="quickBox('<?php echo $product['product_id']; ?>', '<?php echo $type_of_slider; ?>');" href="#quickview-<?php echo $product['product_id']; ?>-<?php echo $type_of_slider; ?>">

                            <?php } else { ?>

                                <?php if ($product['special']) { ?>
                                    <a class="quick-view" data-toggle="tooltip" title="<?php echo (isset($customisation_general[$lang]["quick_view_text"][$store_id]) ? $customisation_general[$lang]["quick_view_text"][$store_id] : 'Quick view'); ?>" href="catalog/view/theme/_ajax_view-product.php?product_href=<?php echo $product_href; ?>&amp;view_details=<?php echo $view_details; ?>&amp;image_main=<?php echo $image; ?>&amp;product_name=<?php echo $product_name; ?>&amp;product_price=<?php echo urlencode($product['price']); ?>&amp;product_special=<?php echo urlencode($product['special']); ?>&amp;product_rating=<?php echo urlencode($product['rating']); ?>&amp;product_description_short=<?php echo $decription; ?>&amp;product_tax=<?php echo urlencode($product['tax']); ?>&amp;text_tax=<?php echo urlencode($text_tax); ?>&amp;stock=<?php echo $stock; ?>&amp;share_f=<?php echo $share_f; ?>&amp;share_t=<?php echo $share_t; ?>&amp;share_g=<?php echo $share_g; ?>&amp;share_pin=<?php echo $share_pin; ?>">
                                <?php } else { ?>
                                    <a class="quick-view" data-toggle="tooltip" title="<?php echo (isset($customisation_general[$lang]["quick_view_text"][$store_id]) ? $customisation_general[$lang]["quick_view_text"][$store_id] : 'Quick view'); ?>" href="catalog/view/theme/_ajax_view-product.php?product_href=<?php echo $product_href; ?>&amp;view_details=<?php echo $view_details; ?>&amp;image_main=<?php echo $image; ?>&amp;product_name=<?php echo $product_name; ?>&amp;product_price=<?php echo urlencode($product['price']); ?>&amp;product_rating=<?php echo urlencode($product['rating']); ?>&amp;product_description_short=<?php echo $decription; ?>&amp;product_tax=<?php echo urlencode($product['tax']); ?>&amp;text_tax=<?php echo urlencode($text_tax); ?>&amp;stock=<?php echo $stock; ?>&amp;share_f=<?php echo $share_f; ?>&amp;share_t=<?php echo $share_t; ?>&amp;share_g=<?php echo $share_g; ?>&amp;share_pin=<?php echo $share_pin; ?>">
                                <?php } ?>

                            <?php } ?>
                                <span class="icon flaticon-view9"></span>
                            </a>
                        </li>

                        <!--quick box-->
                        <?php if ($quick_view == 2) : ?>
                            <script src="catalog/view/theme/<?php echo $config->get('config_template'); ?>/js/jquery.fancybox.pack.js"></script>

                            <script type="text/javascript">
                                function quickBox(product_id, slider) {
                                    jQuery('#quickview-'+product_id+'-'+slider+' .quickviewblock .large-image').html(jQuery('.main-image-'+product_id + ' .first-main-image-'+product_id+':first').clone());
                                    jQuery('#quickview-'+product_id+'-'+slider+' .quickviewblock .advanced_color').html(jQuery('.advanced_option-'+product_id).clone());

                                    jQuery('.fancybox').fancybox({
                                        "closeBtn": true,
                                        hideOnContentClick : false,
                                        //margin:0,
                                        //padding:0,
                                        autoDimensions: true,
                                        showTitle: false,
                                        scrolling: 'auto',
                                        maxWidth: 800,
                                        maxHeight: 800,
                                        fitToView: false,
                                        width: "84%",
                                        //height: "70%",
                                        //height:500,
                                        autoSize: false,
                                        closeClick: false,

                                        onComplete: function(){
                                            jQuery('.fancybox-default').load(function () {
                                                jQuery('.fancybox-default').height(jQuery(this).contents().height());
                                                jQuery.fancybox.resize();
                                            });
                                        }
                                    });
                                }

                            </script>
                            <div id="quickview-<?php echo $product['product_id']; ?>-<?php echo $type_of_slider; ?>" style="display: none;">
                                <div class="product-preview-popup quickviewblock">
                                    <div class="product-view product-view-compact">
                                        <a onclick="javascript:jQuery.fancybox.close();" class="close-view"><span class="icon-cancel-3"></span></a>
                                        <div class="container product-view">
                                            <div class="row">
                                                <div class="product-images-cell">
                                                    <div class="large-image">
                                                    </div>
                                                </div>
                                                <div class="product-info-cell">
                                                    <a class="close-view"><span class="icon-cancel-3"></span></a>
                                                    <h2><?php echo $product['name']; ?></h2>
                                                    <div class="quick_view_description"><?php echo $product['description']; ?></div>

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

                                                    <div class="advanced_color"></div>
                                                    <?php if (!isset($customisation_products["product_catalog_mode"][$store_id]) || $customisation_products["product_catalog_mode"][$store_id] != 1) : ?>
                                                    <div class="quick_view_price">
                                                        <?php if (!$product['special']) { ?>
                                                        <span class="price"><?php echo $product['price']; ?></span>
                                                        <?php } else { ?>
                                                        <span class="price-old price old"><?php echo $product['price']; ?></span>
                                                        <span class="price-new price new"><?php echo $product['special']; ?></span>
                                                        <?php } ?>
                                                    </div>
                                                    <?php endif; ?>

                                                    <div class="form-inputs">
                                                        <a href="<?php echo $product['href']; ?>" class="btn btn-cool btn-lg">
                                                            <i class="icon flaticon-shopping66"></i>
                                                            <?php echo (isset($customisation_translation[$lang]["view_details"][$store_id]) ? $customisation_translation[$lang]["view_details"][$store_id] : 'view details'); ?>
                                                        </a>
                                                    </div>
                                                    <div class="social-buttons">
                                                        <span class="pull-left">Share:&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                        <ul class="socials">
                                                            <li><?php echo html_entity_decode($customisation_general["share_block1"][$store_id], ENT_QUOTES, 'UTF-8'); ?></li>
                                                            <li><?php echo html_entity_decode($customisation_general["share_block2"][$store_id], ENT_QUOTES, 'UTF-8'); ?></li>
                                                            <li><?php echo html_entity_decode($customisation_general["share_block3"][$store_id], ENT_QUOTES, 'UTF-8'); ?></li>
                                                            <li><?php echo html_entity_decode($customisation_general["share_block4"][$store_id], ENT_QUOTES, 'UTF-8'); ?></li>
                                                        </ul>
                                                    </div>


                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                            </div>

                            <?php endif; ?>

                        <!--//end quick box-->



                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
</div>
