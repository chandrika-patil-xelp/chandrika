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

<div class="container search-page">
        <div class="row">

            <?php echo $content_top; ?>

            <div id="content" class="<?php echo ($customisation_products["product_listing_type"][$store_id] != 'small_without_column' && $customisation_products["product_listing_type"][$store_id] != 'slick_without_column' && $column_left ? $class.' content-center': ($slick_enable ? '' : 'col-sm-12')); ?>">
            <h1><?php echo $heading_title; ?></h1>
      <label class="control-label" for="input-search"><?php echo $entry_search; ?></label>
      <div class="row">
        <div class="col-sm-4">
          <input type="text" name="search" value="<?php echo $search; ?>" placeholder="<?php echo $text_keyword; ?>" id="input-search" class="form-control" />
        </div>
        <div class="col-sm-3">
          <select name="category_id" class="form-control">
            <option value="0"><?php echo $text_category; ?></option>
            <?php foreach ($categories as $category_1) { ?>
            <?php if ($category_1['category_id'] == $category_id) { ?>
            <option value="<?php echo $category_1['category_id']; ?>" selected="selected"><?php echo $category_1['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $category_1['category_id']; ?>"><?php echo $category_1['name']; ?></option>
            <?php } ?>
            <?php foreach ($category_1['children'] as $category_2) { ?>
            <?php if ($category_2['category_id'] == $category_id) { ?>
            <option value="<?php echo $category_2['category_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $category_2['category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
            <?php } ?>
            <?php foreach ($category_2['children'] as $category_3) { ?>
            <?php if ($category_3['category_id'] == $category_id) { ?>
            <option value="<?php echo $category_3['category_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $category_3['category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
            <?php } ?>
            <?php } ?>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
        <div class="col-sm-3">
          <label class="checkbox-inline">
            <?php if ($sub_category) { ?>
            <input type="checkbox" name="sub_category" value="1" checked="checked" />
            <?php } else { ?>
            <input type="checkbox" name="sub_category" value="1" />
            <?php } ?>
            <?php echo $text_sub_category; ?></label>
        </div>
      </div>
      <p>
        <label class="checkbox-inline">
          <?php if ($description) { ?>
          <input type="checkbox" name="description" value="1" id="description" checked="checked" />
          <?php } else { ?>
          <input type="checkbox" name="description" value="1" id="description" />
          <?php } ?>
          <?php echo $entry_description; ?></label>
      </p>
      <input type="button" value="<?php echo $button_search; ?>" id="button-search" class="btn btn-primary" />
      <h2><?php echo $text_search; ?></h2>

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
<script type="text/javascript"><!--
$('#button-search').bind('click', function() {
	url = 'index.php?route=product/search';
	
	var search = $('#content input[name=\'search\']').prop('value');
	
	if (search) {
		url += '&search=' + encodeURIComponent(search);
	}

	var category_id = $('#content select[name=\'category_id\']').prop('value');
	
	if (category_id > 0) {
		url += '&category_id=' + encodeURIComponent(category_id);
	}
	
	var sub_category = $('#content input[name=\'sub_category\']:checked').prop('value');
	
	if (sub_category) {
		url += '&sub_category=true';
	}
		
	var filter_description = $('#content input[name=\'description\']:checked').prop('value');
	
	if (filter_description) {
		url += '&description=true';
	}

	location = url;
});

$('#content input[name=\'search\']').bind('keydown', function(e) {
	if (e.keyCode == 13) {
		$('#button-search').trigger('click');
	}
});

$('select[name=\'category_id\']').on('change', function() {
	if (this.value == '0') {
		$('input[name=\'sub_category\']').prop('disabled', true);
	} else {
		$('input[name=\'sub_category\']').prop('disabled', false);
	}
});

$('select[name=\'category_id\']').trigger('change');
--></script> 
<?php echo $footer; ?> 