<?php
    $text_items_full = explode(" ", $text_items);
    $text_items_number = $text_items_full[0];
?>
<div class="top-link pull-right compact-visible">
    <div class="btn-outer btn-shopping-cart">
        <a href="#drop-shopcart" class="btn btn-xs btn-default open-cart" data-toggle="dropdown">
            <span class="icon icon-md flaticon-shopping66"></span>
            <span class="badge cart-total-number"><?php echo $text_items_number; ?></span>
        </a>
    </div>
</div>
