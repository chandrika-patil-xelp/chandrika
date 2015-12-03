<?php
    global $config, $loader, $registry;
    $loader->model('custom/general');
    $customisation_products = $config->get('customisation_products_store');
$customisation_general = $config->get('customisation_general_store');

$model = $registry->get('model_custom_general');
    $class = $model->getCssClass($column_left,$column_right);

    $category_id = $model->getCurrentCategoryId();


    $html_description = $model->getCategoryOption($category_id,"html_description");

    $store_id = $config->get('config_store_id');

$slick_enable = isset($customisation_products["product_listing_type"][$store_id]) && ($customisation_products["product_listing_type"][$store_id] == 'slick_without_column');

$slick_full_enable = isset($customisation_products["product_listing_type"][$store_id]) && ($customisation_products["product_listing_type"][$store_id] == 'slick_without_column' || $customisation_products["product_listing_type"][$store_id] == 'slick_with_column') ;
?>

<?php echo $header; ?>
<?php echo $loader->controller('common/top_promo'); ?>

<?php
$loader->model('custom/general');
$model_breadcrumbs = $registry->get('model_custom_general');
$breadcrumbs = $model_breadcrumbs->getBreadcrumbs($breadcrumbs);
echo $breadcrumbs;
?>
<div class="<?php echo ($slick_enable ? ($customisation_general["homepage_mode"][$store_id] == 'boxed' ? 'container' : '') : 'container'); ?> category-page">
<div class="<?php echo ($slick_enable  ? '' : 'row'); ?>">

    <div id="content" class="<?php echo ($customisation_products["product_listing_type"][$store_id] != 'small_without_column' && $customisation_products["product_listing_type"][$store_id] != 'slick_without_column' ? $class.' content-center': ($slick_enable ? 'content' : 'col-sm-12')); ?>">
    <?php if (!$slick_full_enable) : ?><h1><?php echo $heading_title; ?></h1><?php endif; ?>

    <!--if slick-->
    <?php if ($slick_enable && $customisation_general["homepage_mode"][$store_id] != 'boxed') : ?>
    <div class="container">
        <div class="row">
    <?php endif; ?>

            <?php if ($html_description) : echo html_entity_decode($html_description, ENT_QUOTES, 'UTF-8'); endif; ?>
            <?php echo $content_top; ?>



            <?php if ($description) :  echo '<div class="divider divider-sm"></div>'.$description; endif; ?>


            <!-- Categories -->
        <?php if (!$slick_full_enable) : ?>
            <?php if ($categories) : ?>

            <div class="row">
                <?php


                foreach ($categories as $category) :
                $sub_category_info = $model->getSubCategoryOptionById($category['href']);

                $loader->model('tool/image');
                $model_resize = $registry->get('model_tool_image');

                $image = $model_resize->resize($sub_category_info['image'], $config->get('config_image_category_width'), $config->get('config_image_category_height'));
                $image2x = $model_resize->resize($sub_category_info['image'], $config->get('config_image_category_width')*2, $config->get('config_image_category_height')*2);
                ?>
                <div class="col-xs-6 col-sm-3">
                    <div class="category">
                        <?php if ($sub_category_info['image']) : ?>
                        <a href="<?php echo $category['href']; ?>">
                            <img class="product-retina" src="<?php echo $image; ?>" data-image2x="<?php echo $image2x; ?>" alt="" />
                        </a>
                        <?php endif; ?>
                        <h4><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></h4>
                    </div>
                </div>
                <?php //if(++$i == 3) break; ?>

                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        <?php endif; ?>
            <!-- //end Categories -->

            <?php if ($products) { ?>

            <!--filters-->
            <div class="filters-panel">
                <div class="row">
                    <?php if (!isset($customisation_products["product_listing_type"][$store_id]) || ($customisation_products["product_listing_type"][$store_id] != 'slick_without_column' && $customisation_products["product_listing_type"][$store_id] != 'slick_with_column')) { ?>
                    <div class="col-sm-3 col-md-3 col-lg-4 hidden-xs">
                        <div class="view-mode">
                            <a class="view-grid icon flaticon-tiles" data-toggle="tooltip" title="<?php echo $button_grid; ?>"></a>
                            <a class="view-list active icon flaticon-menu29" data-toggle="tooltip" title="<?php echo $button_list; ?>"></a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-4 hidden-xs">
                        <?php echo $text_sort; ?>
                        <div class="btn-group btn-select perpage-select">
                            <select id="input-sort" class="btn btn-default dropdown-toggle" onchange="location = this.value;">
                                <?php foreach ($sorts as $sorts) { ?>
                                <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
                                <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-5 col-lg-4">
                        <div class="limit pull-right"><?php echo $text_limit; ?>
                            <div class="btn-group btn-select perpage-select">
                                <select class="btn btn-default btn-xs dropdown-toggle" onchange="location = this.value;">
                                    <?php foreach ($limits as $limits) { ?>
                                    <?php if ($limits['value'] == $limit) { ?>
                                    <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php } else { ?>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 pull-right">
                        <div class="pagination pull-right text-right">
                            <?php foreach ($limits as $limits) { ?>
                            <a href="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></a>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
            <!--end filters-->
        <?php if (!$slick_full_enable) : ?><p><a href="<?php echo $compare; ?>" id="compare-total"><?php echo $text_compare; ?></a></p><?php endif; ?>

    <?php if ($slick_enable && $customisation_general["homepage_mode"][$store_id] != 'boxed') : ?>

        </div>
    </div>
    <?php endif; ?>

    <!--end///if slick-->

        <?php
            $type_category = 1;
            $slick_enable = 1;

            if (!isset($customisation_products["product_listing_type"][$store_id]) || ($customisation_products["product_listing_type"][$store_id] != 'slick_with_column' && $customisation_products["product_listing_type"][$store_id] != 'slick_without_column')) {
        ?>
            <div class="products-list">
        <?php
            include('catalog/view/theme/slider_horizontal_carousel.php');
        ?>
            </div>
        <?php
        } else {
            include('catalog/view/theme/listing_slick.php');
        }
        ?>

    <!--if slick-->
    <?php
     $slick_enable = isset($customisation_products["product_listing_type"][$store_id]) && ($customisation_products["product_listing_type"][$store_id] == 'slick_without_column');
    if ($slick_enable && $customisation_general["homepage_mode"][$store_id] != 'boxed') :
    ?>
    <div class="container">
        <div class="row">
    <?php endif; ?>

    <div class="row">
        <?php
         $pagination1 = str_replace("&gt;|", "<span class='icon flaticon-play45 pagination-next'></span>", $pagination);
        $pagination2 = str_replace("|&lt;", "<span class='icon flaticon-left33 pagination-prev'></span>", $pagination1);
        ?>
        <div class="col-sm-6 text-left"><?php echo $pagination2; ?></div>
        <?php if ($results) : ?><div class="col-sm-6 text-right"><?php echo $results; ?></div><?php endif; ?>
    </div>

    <!--if slick-->
    <?php if ($slick_enable && $customisation_general["homepage_mode"][$store_id] != 'boxed') : ?>
            </div>
                </div>
    <?php endif; ?>


    <?php } elseif (!$categories && !$products) { ?>
        <p><?php echo $text_empty; ?></p>
        <div class="buttons">
            <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-cool"><?php echo $button_continue; ?></a></div>
        </div>
    <?php } elseif (!$categories) { ?>
        <p><?php echo $text_empty; ?></p>
        <div class="buttons">
            <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-cool"><?php echo $button_continue; ?></a></div>
        </div>
    <?php } else { ?>
        <p><?php echo $text_empty; ?></p>
        <div class="buttons">
            <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-cool"><?php echo $button_continue; ?></a></div>
        </div>
    <?php } ?>




    <?php echo $content_bottom; ?>
</div>
    <?php
        if (!isset($customisation_products["product_listing_type"][$store_id]) || ($customisation_products["product_listing_type"][$store_id] != 'small_without_column' && $customisation_products["product_listing_type"][$store_id] != 'slick_without_column')):
            echo $column_left;
        endif;
      ?>

    <?php echo $column_right; ?>
</div>

</div>

<?php echo $footer; ?>
