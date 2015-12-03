<?php
global $config, $loader, $registry;
$store_id = $config->get('config_store_id');

$lang = $config->get('config_language_id');

$customisation_general = $config->get('customisation_general_store');
$customisation_products = $config->get('customisation_products_store');
$customisation_translation = $config->get('customisation_translation_store');
$customisation_colors = $config->get('customisation_colors_store');

$loader->model('catalog/product');

if (isset($type_category) && $type_category == 1) {
    $type_of_slider = 'category';
    $quick_view = !isset($customisation_products["quick_listing_type"][$store_id]) || ($customisation_products["quick_listing_type"][$store_id] != 2) ? 1 : 2;
} else {
   $quick_view = !isset($customisation_products["quick_sliders_type"][$store_id]) || ($customisation_products["quick_sliders_type"][$store_id] != 2) ? 1 : 2;
}
?>

<!--for sliders only1-->
<?php if (!isset($type_category) || $type_category != 1) : ?>

<section class="container content slider-products <?php echo $type_of_slider; ?>">
    <h6 style="display:none">&nbsp;</h6>
    <?php if (isset($upsells)) : ?>
    <h3><?php echo $upsells_promo; ?></h3>
    <div class="dotted-line right-space"></div>
<?php endif; ?>
<div class="dotted-line right-space"></div>

<div class="pull-left vertical_title_outer right-space">
    <div><span><?php echo $heading_title; ?></span></div>
</div>

<div class="pull-left carousel_outer">
<div class="product-carousel">

<?php endif; ?>
<!--end for sliders only1-->


<?php
$loader->model('custom/general');
$model_module = $registry->get('model_custom_general');

$settings = $model_module->getModuleImage($products[0]['thumb']);
$width_settings = $settings[0];
$height_settings = $settings[1];


if (file_exists('catalog/model/module/advanced_colors.php')) {
    $this->model('module/advanced_colors');
}

foreach ($products as $product) :

    $model = $registry->get('model_catalog_product');
        $product_info = $model->getProduct($product['product_id']);

    $options = $model->getProductOptions($product['product_id']);

    $additional_images = $model->getProductImages($product['product_id']);

    if ($additional_images) :
        if (!isset($type_category)) {
            if (isset($related)) {
                $width_settings = $config->get('config_image_related_width');
                $height_settings = $config->get('config_image_related_height');
            }

        } else {
            $width_settings = $config->get('config_image_product_width');
            $height_settings = $config->get('config_image_product_height');
        }

        $first = true;

        foreach ($additional_images as $additional_image) {

            if (isset($additional_image["default_of_color"])) : $default_of_color = $additional_image["default_of_color"]; endif;

            if ($first) {
                $loader->model('tool/image');
                $model_resize = $registry->get('model_tool_image');

                $popup = $model_resize->resize($additional_image['image'], $width_settings, $height_settings);
                $popup2x = $model_resize->resize($additional_image['image'], $width_settings*2, $height_settings*2);
                $first = false;
            }
        }
    endif;
        if ($product['special']): $special_end_date = $model_module->getDateEnd($product['product_id']);  endif;


    $option_color = (sizeof($options) > 0 && file_exists('catalog/model/module/advanced_colors.php') && isset($default_of_color) && $default_of_color != 0) ? true : false;



        ?>



    <div class="<?php echo (isset($type_category) && $type_category == 1 ? 'product-preview-outer' : 'carousel-item'); ?>">
        <div class="product-preview">
            <div class="preview">
                <?php if (!isset($customisation_products["sale_status"][$store_id]) || ($customisation_products["sale_status"][$store_id] != 0)) : ?>
                    <?php if ($product['price'] && $product['special']) : ?>
                        <div class="label label-sale"><span><?php echo (isset($customisation_general[$lang]["sale_text"][$store_id]) ? $customisation_general[$lang]["sale_text"][$store_id] : 'SALE'); ?></span></div>
                    <?php endif; ?>
                <?php endif; ?>

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


                <div class="preview-image-outer">
                    <a href="<?php echo $product['href']; ?>" class="preview-image main-image-<?php echo $product['product_id']; ?>">
                        <?php if ($option_color) { ?>
                            <img id="product-img-<?php echo $product['product_id']; ?>" width="<?php echo $width_settings; ?>" height="<?php echo $height_settings; ?>" class="img-responsive product-retina first-main-image first-main-image-<?php echo $product['product_id']; ?>" src="<?php echo $product['thumb']; ?>" data-image2x="<?php echo $popup2x; ?>" alt="<?php echo $product['name']; ?>">
                        <?php } else { ?>
                            <img id="product-img-<?php echo $product['product_id']; ?>" width="<?php echo $width_settings; ?>" height="<?php echo $height_settings; ?>" class="first-main-image first-main-image-<?php echo $product['product_id']; ?> img-responsive <?php echo ($additional_images ? 'img-default' : ''); ?> product-retina" src="<?php echo $product['thumb']; ?>" data-image2x="<?php echo $popup2x; ?>" alt="<?php echo $product['name']; ?>">
                        <?php if ($additional_images) : ?>
                            <img width="<?php echo $width_settings; ?>" height="<?php echo $height_settings; ?>" class="img-responsive img-second product-retina" src="<?php echo $popup; ?>" data-image2x="<?php echo $popup2x; ?>" alt="<?php echo $product['name']; ?>">
                            <?php endif; ?>
                        <?php } ?>
                    </a>
                </div>
            <!--out of stock label-->
                <?php if (isset($type_category) && $type_category == 1 && $product_info['quantity'] <= 0) : ?>
                <div class="out-of-stock"><?php echo $product_info['stock_status']; ?></div>
                <?php endif; ?>
            <!--end out of stock label-->
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

            <?php if ($quick_view == 2) { ?>
                      <a class="quick-view quickview fancybox" onclick="quickBox('<?php echo $product['product_id']; ?>', '<?php echo $type_of_slider; ?>');" href="#quickview-<?php echo $product['product_id']; ?>-<?php echo $type_of_slider; ?>">

            <?php } else { ?>
                <?php if ($product['special']) { ?>
                      <a class="quick-view" href="catalog/view/theme/_ajax_view-product.php?product_href=<?php echo $product_href; ?>&amp;view_details=<?php echo $view_details; ?>&amp;image_main=<?php echo $image; ?>&amp;product_name=<?php echo $product_name; ?>&amp;product_price=<?php echo urlencode($product['price']); ?>&amp;product_special=<?php echo urlencode($product['special']); ?>&amp;product_rating=<?php echo urlencode($product['rating']); ?>&amp;product_description_short=<?php echo $decription; ?>&amp;product_tax=<?php echo urlencode($product['tax']); ?>&amp;text_tax=<?php echo urlencode($text_tax); ?>&amp;stock=<?php echo $stock; ?>&amp;share_f=<?php echo $share_f; ?>&amp;share_t=<?php echo $share_t; ?>&amp;share_g=<?php echo $share_g; ?>&amp;share_pin=<?php echo $share_pin; ?>">
                <?php } else { ?>
                      <a class="quick-view" href="catalog/view/theme/_ajax_view-product.php?product_href=<?php echo $product_href; ?>&amp;view_details=<?php echo $view_details; ?>&amp;image_main=<?php echo $image; ?>&amp;product_name=<?php echo $product_name; ?>&amp;product_price=<?php echo urlencode($product['price']); ?>&amp;product_rating=<?php echo urlencode($product['rating']); ?>&amp;product_description_short=<?php echo $decription; ?>&amp;product_tax=<?php echo urlencode($product['tax']); ?>&amp;text_tax=<?php echo urlencode($text_tax); ?>&amp;stock=<?php echo $stock; ?>&amp;share_f=<?php echo $share_f; ?>&amp;share_t=<?php echo $share_t; ?>&amp;share_g=<?php echo $share_g; ?>&amp;share_pin=<?php echo $share_pin; ?>">
                <?php } ?>
            <?php } ?>
                           <span><?php echo (isset($customisation_general[$lang]["quick_view_text"][$store_id]) ? $customisation_general[$lang]["quick_view_text"][$store_id] : 'Quick view'); ?></span>
                      </a>





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

    <!--countdown box-->
                <?php
                if (!isset($customisation_products["countdown_status"][$store_id]) || ($customisation_products["countdown_status"][$store_id] != 0)) :
                    if ($product['special']) :
                        if ($special_end_date) :
                            $full_date = explode("-", $special_end_date);
                            $year_end = $full_date[0];
                            if($full_date[1] < 10) {
                                $month_end = (int)$full_date[1];
                            } else {
                                $month_end = $full_date[1];
                            }
                            $day_end = $full_date[2];
                            if ($day_end !== 0 && $year_end !==0 && $month_end !== 0) :


                                if (isset($customisation_translation[$lang]["countdown_title_day"][$store_id]) && $customisation_translation[$lang]["countdown_title_day"][$store_id] != ''){
                                    $label_day = $customisation_translation[$lang]["countdown_title_day"][$store_id];
                                } else {
                                    $label_day = 'Day';
                                }

                                if (isset($customisation_translation[$lang]["countdown_title_hour"][$store_id]) && $customisation_translation[$lang]["countdown_title_hour"][$store_id] != ''){
                                    $label_hour = $customisation_translation[$lang]["countdown_title_hour"][$store_id];
                                } else {
                                    $label_hour = 'Hour';
                                }
                                if (isset($customisation_translation[$lang]["countdown_title_minute"][$store_id]) && $customisation_translation[$lang]["countdown_title_minute"][$store_id] != ''){
                                    $label_minute = $customisation_translation[$lang]["countdown_title_minute"][$store_id];
                                } else {
                                    $label_minute = 'Min';
                                }
                                if (isset($customisation_translation[$lang]["countdown_title_second"][$store_id]) && $customisation_translation[$lang]["countdown_title_second"][$store_id] != ''){
                                    $label_second = $customisation_translation[$lang]["countdown_title_second"][$store_id];
                                } else {
                                    $label_second = 'Sec';
                                }
                                ?>
                                <?php if (isset($type_category) && $type_category == 1) : ?>
                                <div class="countdown_box">
                                    <div class="countdown_inner">
                                        <div class="title"><?php echo (isset($customisation_translation[$lang]["countdown_title"][$store_id]) && $customisation_translation[$lang]["countdown_title"][$store_id] != '' ? $customisation_translation[$lang]["countdown_title"][$store_id] : 'This limited  offer ends in:'); ?></div>
                                        <script type="text/javascript"><!--
                                        jQuery(function () {
                                            var austDay = new Date(<?php echo $year_end; ?>, <?php echo $month_end; ?> - 1, <?php echo $day_end; ?>);
                                            jQuery('.defaultCountdown-<?php echo $product['product_id']; ?>').countdown({
                                                description: '',
                                                until: austDay,
                                                labels: ['Year', 'Month', 'Week', '<?php echo $label_day; ?>', '<?php echo $label_hour; ?>', '<?php echo $label_minute; ?>', '<?php echo $label_second; ?>']
                                            });
                                        });
                                        //--></script>
                                        <div class="defaultCountdown-<?php echo $product['product_id']; ?>"></div>
                                    </div>
                                </div>
                                 <?php endif; ?>
                                <?php
                            endif;
                        endif;
                    endif;
                endif;

                ?>

                <!--end countdown box-->

            </div>

            <!--countdown box-->
            <?php
                if (!isset($customisation_products["countdown_status"][$store_id]) || ($customisation_products["countdown_status"][$store_id] != 0)) :
                    if ($product['special']) :
                        if ($special_end_date) :

                            if ($day_end !== 0 && $year_end !==0 && $month_end !== 0) :
                                ?>

                            <div class="countdown_box">
                                <div class="countdown_inner">
                                    <div class="title"><?php echo (isset($customisation_translation[$lang]["countdown_title"][$store_id]) && $customisation_translation[$lang]["countdown_title"][$store_id] != '' ? $customisation_translation[$lang]["countdown_title"][$store_id] : 'This limited  offer ends in:'); ?></div>
                                    <script type="text/javascript"><!--
                                    jQuery(function () {
                                        var austDay = new Date(<?php echo $year_end; ?>, <?php echo $month_end; ?> - 1, <?php echo $day_end; ?>);
                                        jQuery('.defaultCountdown-<?php echo $product['product_id']; ?>').countdown({
                                            description: '',
                                            until: austDay,
                                            labels: ['Year', 'Month', 'Week', '<?php echo $label_day; ?>', '<?php echo $label_hour; ?>', '<?php echo $label_minute; ?>', '<?php echo $label_second; ?>']
                                        });
                                    });
                                    //--></script>
                                    <div class="defaultCountdown-<?php echo $product['product_id']; ?>"></div>
                                </div>
                            </div>
                                <?php
                            endif;
                        endif;
                    endif;
                endif;

                ?>

            <!--end countdown box-->

            <h3 class="title"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h3>

            <?php if ($option_color){
                echo '<div class="advanced_option-'.$product['product_id'].'">';
                $this->registry->get('model_module_advanced_colors')->renderListPage($product['product_id'],$width_settings,$height_settings);
                echo '</div>';
            } ?>

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


            <ul class="product-controls-list">
                <li><a onclick="wishlist_theme.add('<?php echo $product['product_id']; ?>');" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>"><span class="icon flaticon-heart68"></span></a></li>
                <li><a onclick="compare_theme.add('<?php echo $product['product_id']; ?>');" data-toggle="tooltip" title="<?php echo $button_compare; ?>"><span class="icon flaticon-bars34"></span></a></li>

                <?php if (!isset($customisation_products["product_catalog_mode"][$store_id]) || $customisation_products["product_catalog_mode"][$store_id] != 1) : ?>
                <li><a onclick="cart_theme.add('<?php echo $product['product_id']; ?>');" class="add-to-cart open-cart7" data-toggle="tooltip" title="<?php echo $button_cart; ?>"><span class="icon flaticon-shopping66"></span></a></li>
               <?php endif; ?>
            </ul>

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

            <?php if (isset($type_category) && $type_category == 1) : ?>
                <div class="info"><?php echo $product['description']; ?></div>
                <ul class="product-controls-list-row">
                    <li><a onclick="wishlist_theme.add('<?php echo $product['product_id']; ?>');" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>"><span class="icon flaticon-heart68"></span></a></li>
                    <li><a onclick="compare_theme.add('<?php echo $product['product_id']; ?>');" data-toggle="tooltip" title="<?php echo $button_compare; ?>"><span class="icon flaticon-bars34"></span></a></li>
                    <?php if (!isset($customisation_products["product_catalog_mode"][$store_id]) || $customisation_products["product_catalog_mode"][$store_id] != 1) : ?>
                    <li><a onclick="cart_theme.add('<?php echo $product['product_id']; ?>');" class="add-to-cart open-cart7" data-toggle="tooltip" title="<?php echo $button_cart; ?>"><span class="icon flaticon-shopping66"></span></a></li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>


        </div>
    </div>
<?php endforeach; ?>

<!--for sliders only2-->
<?php if (!isset($type_category) || $type_category != 1) : ?>

</div>

<div class="product-view-ajax-container"></div>

</div>
<div class="clearfix"></div>
</section>

<?php endif; ?>
<!--end for sliders only2-->

<!--for listing only-->
<?php if (isset($type_category) && $type_category == 1 || isset($related) || isset($customisation_colors["layout_skin"][$store_id]) && $customisation_colors["layout_skin"][$store_id] == 'bio') : ?>

<div class="product-view-ajax-container"></div>

<div class="product-view-ajax">
    <div class="layar"></div>
    <div class="product-view-container"></div>
</div>

<?php endif; ?>
<!--for listing only-->
