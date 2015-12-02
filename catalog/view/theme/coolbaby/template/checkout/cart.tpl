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
  <?php if ($attention) { ?>
  <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $attention; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <div class="row">
      <?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'container'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?> shopping_cart">
        <?php echo $content_top; ?>
        <h1 class="subtitle">
            <div>
                <span>
                    <?php echo $heading_title; ?>
                    <?php if ($weight) { ?>
                    &nbsp;(<?php echo $weight; ?>)
                    <?php } ?>
                </span>
            </div>
        </h1>

        <div class="rect-nohover">
            <div class="inside">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                    <table class="table-shop">
                        <thead>
                        <tr>
                            <th class="product-image">&nbsp;</th>
                            <th class="product-name"><?php echo $column_name; ?></th>
                            <th class="text-center"><?php echo $column_model; ?></th>
                            <th class="text-center">&nbsp;</th>
                            <th class="text-center product-column-price"><?php echo $column_price; ?></th>
                            <th class="text-center"><?php echo $column_quantity; ?></th>
                            <th class="text-center"><?php echo $column_total; ?></th>
                            <th class="text-center">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($products as $product) { ?>
                        <tr>
                            <td class="notitle">
                                <?php if ($product['thumb']) { ?>
                                    <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-thumbnail" /></a>
                                <?php } ?>
                            </td>
                            <td class="text-left">
                                <div class="th_title visible-xs"><?php echo $column_name; ?>:</div>
                                <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                                <?php if (!$product['stock']) { ?>
                                <span class="text-danger">***</span>
                                <?php } ?>
                                <?php if ($product['option']) { ?>
                                <?php foreach ($product['option'] as $option) { ?>
                                <br />
                                <small><?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
                                <?php } ?>
                                <?php } ?>
                                <?php if ($product['reward']) { ?>
                                <br />
                                <small><?php echo $product['reward']; ?></small>
                                <?php } ?>
                                <?php if ($product['recurring']) { ?>
                                <br />
                                <span class="label label-info"><?php echo $text_recurring_item; ?></span> <small><?php echo $product['recurring']; ?></small>
                                <?php } ?>
                            </td>
                            <td class="text-left"><div class="th_title visible-xs"><?php echo $column_model; ?>:</div><?php echo $product['model']; ?></td>

                            <td class="text-center notitle">
                                <button class="button-non-styled update-cart" type="submit" data-toggle="tooltip" title="<?php echo $button_update; ?>"><?php echo $button_update; ?></button>
                            </td>
                            <td class="text-center">
                                <div class="th_title visible-xs"><?php echo $column_price; ?>:</div>
                                <?php echo $product['price']; ?>
                            </td>
                            <td class="text-center">
                                <div class="th_title visible-xs input-label"><?php echo $column_quantity; ?>:</div>
                                <input type="text" name="quantity[<?php echo $product['cart_id']; ?>]" value="<?php echo $product['quantity']; ?>" size="1" class="form-control input-quantity" />
                            </td>
                            <td class="text-center">
                                <div class="th_title visible-xs"><?php echo $column_total; ?>:</div>
                                <?php echo $product['total']; ?>
                            </td>
                            <td class="text-center notitle">
                                <button type="button" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="button-non-styled icon icon-sm flaticon-recycle59 remove-from-cart" onclick="cart.remove('<?php echo $product['cart_id']; ?>');"></button>
                            </td>


                        </tr>
                        <?php } ?>
                        <?php foreach ($vouchers as $vouchers) { ?>
                        <tr>
                            <td></td>
                            <td class="text-left"><?php echo $vouchers['description']; ?></td>
                            <td class="text-left"></td>
                            <td class="text-left">
                                <div class="input-group btn-block" style="max-width: 200px;">
                                    <input type="text" name="" value="1" size="1" disabled="disabled" class="form-control" />
                                    <span class="input-group-btn">
                                        <button type="button" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger" onclick="voucher.remove('<?php echo $vouchers['key']; ?>');"><i class="fa fa-times-circle"></i></button>
                                    </span>
                                </div>
                            </td>
                            <td class="text-right"><?php echo $vouchers['amount']; ?></td>
                            <td class="text-right"><?php echo $vouchers['amount']; ?></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </form>

            </div>
        </div>

        <div class="divider divider-sm"></div>

        <div class="row">
            <div class="col-sm-12 col-md-8">
                <div class="rect-nohover">
                    <?php if ($coupon || $voucher || $reward || $shipping) { ?>
                    <h2><?php echo $text_next; ?></h2>
                    <p><?php echo $text_next_choice; ?></p>
                    <div class="panel-group" id="accordion"><?php echo $coupon; ?><?php echo $voucher; ?><?php echo $reward; ?><?php echo $shipping; ?></div>
                    <?php } ?>

                </div>
            </div>
            <div class="divider divider-sm visible-sm"></div>
            <div class="col-sm-12 col-md-4 ">
                <div class="rect-nohover">
                    <table class="table table-bordered">
                        <?php foreach ($totals as $total) { ?>
                        <tr>
                            <td class="text-right"><strong><?php echo $total['title']; ?>:</strong></td>
                            <td class="text-right"><?php echo $total['text']; ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>




        </div>



      <div class="buttons">
        <div class="pull-left"><a href="<?php echo $continue; ?>" class="btn-cool btn-md-sm"><?php echo $button_shopping; ?></a></div>
        <div class="pull-right"><a href="<?php echo $checkout; ?>" class="btn-cool btn-md-sm invert-color"><?php echo $button_checkout; ?></a></div>
      </div>

      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>