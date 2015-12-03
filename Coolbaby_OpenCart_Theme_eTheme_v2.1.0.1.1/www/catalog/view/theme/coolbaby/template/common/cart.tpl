<?php
    $text_items_full = explode(" ", $text_items);
    $text_items_number = $text_items_full[0];
?>
<div class="cart btn-group btn-outer btn-shopping-cart">
    <a href="#drop-shopcart" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-xs btn-default open-cart" data-toggle="dropdown">
        <span class="icon icon-md flaticon-shopping66"></span>
        <span class="badge cart-total-number"><?php echo $text_items_number; ?></span>
    </a>
    <ul id="drop-shopcart" class="shoppingcart-box tab-content content dropdown-menu pull-right shoppingcart-box" role="menu">
    <?php if ($products || $vouchers) { $item = 0; ?>
        <li>
            <div class="list animate-delay-outer7">
                <?php foreach ($products as $product) { $item++; ?>
                <div class="item item<?php echo $item; ?> fadeInRight">
                    <?php if ($product['thumb']) : ?>
                    <div class="image">
                        <a class="preview-image" href="<?php echo $product['href']; ?>">
                            <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" />
                        </a>
                    </div>
                    <?php endif; ?>
                    <div class="description">
                        <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                        <?php if ($product['option']) { ?>
                        <?php foreach ($product['option'] as $option) { ?>
                        <br />
                        - <small><?php echo $option['name']; ?> <?php echo $option['value']; ?></small>
                        <?php } ?>
                        <?php } ?>
                        <?php if ($product['recurring']) { ?>
                        <br />
                        - <small><?php echo $text_recurring; ?> <?php echo $product['recurring']; ?></small>
                        <?php } ?>
                        <strong class="price"><?php echo $product['quantity']; ?> x <?php echo $product['total']; ?></strong>
                    </div>
                    <div class="buttons">
                        <a href="<?php echo $product['href']; ?>" class="icon icon-sm flaticon-write13"></a>
                        <a onclick="cart_theme.remove('<?php echo $product['cart_id']; ?>', '<?php echo $item; ?>');" title="<?php echo $button_remove; ?>" class="icon icon-sm flaticon-recycle59 remove-from-cart7"></a>
                    </div>
                </div>
                <?php } ?>
                <?php foreach ($vouchers as $voucher) { ?>
                <div>
                    <div class="text-center"></div>
                    <div class="text-left"><?php echo $voucher['description']; ?></div>
                    <div class="text-right">x&nbsp;1</div>
                    <div class="text-right"><?php echo $voucher['amount']; ?></div>
                    <div class="text-center text-danger"><button type="button" onclick="voucher.remove('<?php echo $voucher['key']; ?>');" title="<?php echo $button_remove; ?>" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></div>
                </div>
                <?php } ?>
            </div>
        </li>

        <li>
                <div class="totals">
                    <?php foreach ($totals as $total) { ?>
                    <div class="total">
                        <span class="text-right"><strong><?php echo $total['title']; ?></strong></span>
                        <span class="text-right"><?php echo $total['text']; ?></span>
                    </div>
                    <?php } ?>
                </div>
            <div id="empty_cart"><?php echo $text_empty; ?></div>
            <div class="cart_buttons">
                <a href="<?php echo $checkout; ?>" class="btn btn-cool"><?php echo $text_checkout; ?></a>
                <div class="view-link">
                    <a href="<?php echo $cart; ?>"><?php echo $text_cart; ?></a>
                </div>
            </div>

        </li>
        <?php } else { ?>
        <li>
            <p class="text-center empty"><?php echo $text_empty; ?></p>
        </li>
        <?php } ?>
    </ul>
</div>
