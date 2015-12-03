<?php global $config, $loader, $registry; ?>
<?php echo $header; ?>
<?php echo $loader->controller('common/top_promo'); ?>
<?php
    $loader->model('custom/general');
$model_breadcrumbs = $registry->get('model_custom_general');
$breadcrumbs = $model_breadcrumbs->getBreadcrumbs($breadcrumbs);
echo $breadcrumbs;
?>
<div class="container">
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <h2><?php echo $heading_title; ?></h2>
      <?php if ($products) { ?>
        <div class="rect-nohover">
            <div class="inside">
                <table class="table-shop">
                    <thead>
                    <tr>
                        <th class="text-center"><?php echo $column_image; ?></th>
                        <th class="text-center product-name"><?php echo $column_name; ?></th>
                        <th class="text-center"><?php echo $column_model; ?></th>
                        <th class="text-center"><?php echo $column_stock; ?></th>
                        <th class="text-center"><?php echo $column_price; ?></th>
                        <th class="text-center"><?php echo $column_action; ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($products as $product) { ?>
                    <tr>
                        <td class="notitle text-center"><?php if ($product['thumb']) { ?>
                            <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
                            <?php } ?></td>
                        <td class="text-center"><div class="th_title visible-xs"><?php echo $column_name; ?>:</div><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></td>
                        <td class="text-center"><div class="th_title visible-xs"><?php echo $column_model; ?>:</div><?php echo $product['model']; ?></td>
                        <td class="text-center"><div class="th_title visible-xs"><?php echo $column_stock; ?>:</div><?php echo $product['stock']; ?></td>
                        <td class="text-center"><?php if ($product['price']) { ?>
                            <div class="th_title visible-xs"><?php echo $column_price; ?>:</div>
                            <div class="price">
                                <?php if (!$product['special']) { ?>
                                <?php echo $product['price']; ?>
                                <?php } else { ?>
                                <b class="price new"><?php echo $product['special']; ?></b> <s class="price old"><?php echo $product['price']; ?></s>
                                <?php } ?>
                            </div>
                            <?php } ?></td>
                        <td class="text-center notitle"><button type="button" onclick="cart_theme.add('<?php echo $product['product_id']; ?>');" data-toggle="tooltip" title="<?php echo $button_cart; ?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i></button>
                            <a href="<?php echo $product['remove']; ?>" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-times"></i></a></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
      <?php } else { ?>
      <p><?php echo $text_empty; ?></p>
      <?php } ?>
      <div class="buttons clearfix">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>