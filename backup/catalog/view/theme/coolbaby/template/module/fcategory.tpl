<?php
global $config, $loader, $registry;

$customisation_products = $config->get('customisation_products_store');
$store_id = $config->get('config_store_id');
$lang = $config->get('config_language_id');

?>

<section class="content">
<div class="subtitle">
    <div><span><?php echo  ($heading_title) ? $heading_title : ''; ?></span></div>
</div>

  
  <!-- Filtered Products -->
      <section class="filters-by-category clearfix">
        <div class="container">
          <div class="row">
            <div class="text-center">
              <ul class="option-set" data-option-key="filter">
                <li><a href="#filter" data-option-value="*" class="">all</a></li>
				<?php foreach ($categories as $category) : ?>
                <li><a href="#filter" data-option-value=".category<?php echo $category['category_id']; ?>" class=""><?php echo $category['name']; ?></a></li>
				<?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>
      </section>
      <!-- //end Filters -->

    <div class="products-nospace-outer gallery">
        <div class="products-nospace products-isotope">

            <?php shuffle($products); foreach ($products as $product) : ?>
            <div class="product-preview category<?php echo $product['category_id']; ?>">
                <img src="<?php echo $product['thumb']; ?>" data-image2x="<?php echo $product['thumb2x']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" />
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
                            <?php if (!isset($customisation_products["product_catalog_mode"][$store_id]) || $customisation_products["product_catalog_mode"][$store_id] != 1) : ?>
                                <li><a onclick="cart_theme.add('<?php echo $product['product_id']; ?>');" class="add-to-cart7 open-cart7" data-toggle="tooltip" title="<?php echo $button_cart; ?>"><span class="icon flaticon-shopping66"></span></a></li>
                            <?php endif; ?>
                        </ul>

                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>

  </section>


