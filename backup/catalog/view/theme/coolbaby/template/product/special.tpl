<?php
    global $config, $loader, $registry;
    $loader->model('custom/general');
$customisation_products = $config->get('customisation_products_store');

$model = $registry->get('model_custom_general');
$class = $model->getCssClass($column_left,$column_right);

$category_id = $model->getCurrentCategoryId();


$html_description = $model->getCategoryOption($category_id,"html_description");

$store_id = $config->get('config_store_id');

$slick_enable = isset($customisation_products["product_listing_type"][$store_id]) && ($customisation_products["product_listing_type"][$store_id] == 'slick_without_column');
?>

<?php echo $header; ?>
<?php echo $loader->controller('common/top_promo'); ?>

<?php
$loader->model('custom/general');
$model_breadcrumbs = $registry->get('model_custom_general');
$breadcrumbs = $model_breadcrumbs->getBreadcrumbs($breadcrumbs);
echo $breadcrumbs;
?>
<div class="container special-page">
    <div class="row">
        <?php echo $content_top; ?>

        <?php
        if ($column_left && !isset($customisation_products["product_listing_type"][$store_id]) || ($customisation_products["product_listing_type"][$store_id] != 'small_without_column' && $customisation_products["product_listing_type"][$store_id] != 'slick_without_column')):
            echo $column_left;
        endif;
      ?>

        <div id="content" class="<?php echo ($customisation_products["product_listing_type"][$store_id] != 'small_without_column' && $customisation_products["product_listing_type"][$store_id] != 'slick_without_column' && $column_left ? $class.' content-center': ($slick_enable ? '' : 'col-sm-12')); ?>">
        <h2><?php echo $heading_title; ?></h2>
      <?php if ($products) { ?>

        <!--filters-->
        <div class="filters-panel">
            <div class="row">
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
            </div>
        </div>
        <!--end filters-->
        <p><a href="<?php echo $compare; ?>" id="compare-total"><?php echo $text_compare; ?></a></p>


        <!--listing code-->
        <div class="products-list">
         <?php
            $type_category = 1;
            include('catalog/view/theme/slider_horizontal_carousel.php');
        ?>
        </div>

        <!--end listing code-->

        <div class="row">
            <?php if ($pagination) : ?><div class="col-sm-6 text-left"><?php echo $pagination; ?></div><?php endif; ?>
            <?php if ($results) : ?><div class="col-sm-6 text-right"><?php echo $results; ?></div><?php endif; ?>
        </div>
      <?php } else { ?>
      <p><?php echo $text_empty; ?></p>
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
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