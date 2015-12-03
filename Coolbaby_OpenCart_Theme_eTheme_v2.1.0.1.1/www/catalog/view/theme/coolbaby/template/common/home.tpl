<?php
    echo $header;

    global $config, $loader, $registry;
    $store_id = $config->get('config_store_id');
    $lang = $config->get('config_language_id');

$customisation_general = $config->get('customisation_general_store');

$loader->model('custom/general');
$model = $registry->get('model_custom_general');
$layout_id = $model->getCurrentLayout();

echo $loader->controller('common/top_promo');
?>



<?php if ($column_left || $column_right) : ?>
<div class="container content content-first container_columns">
    <div class="row">
        <?php echo $column_left; ?>
        <?php echo $column_right; ?>
    </div>
</div>
<?php endif; ?>




<?php
    echo $content_top;
    echo $content_bottom;

    echo $loader->controller('common/product_widget');
?>

<div style="display:none;">
    Developed by TonyTemplates - eCommerce theme provider. Check our <a href="http://www.tonytemplates.com/">store</a> for more OpenCart themes.
</div>

<!-- Popup box -->
<?php if (!isset($customisation_general["newsletter_popup_status"][$store_id]) || $customisation_general["newsletter_popup_status"][$store_id] != 0) : ?>

<?php
    $your_apikey = $customisation_general["apikey"][$store_id];
    $my_list_unique_id = $customisation_general["list_unique_id"][$store_id];

$newsletter_placeholder = (isset($customisation_general[$lang]["newsletter_placeholder"][$store_id]) ? $customisation_general[$lang]["newsletter_placeholder"][$store_id] : 'Your E-mail...');
?>

<div id="popup-box-outer">
    <div id="popup-box">
         <h2>
             <?php if (!isset($customisation_general[$lang]["newsletter_title"][$store_id])) { ?>
             Newsletter signup
             <?php } elseif ($customisation_general[$lang]["newsletter_title"][$store_id] != '') { ?>
             <?php echo $customisation_general[$lang]["newsletter_title"][$store_id]; ?>
             <?php } ?>
         </h2>

        <?php if (!isset($customisation_general[$lang]["newsletter_promo"][$store_id])) { ?>
            <p>Enter your email and we'll send you a coupon with 10% off your next order.</p>
        <?php } else { ?>
        <?php if ($customisation_general[$lang]["newsletter_promo"][$store_id] != ''): ?>
            <p><?php echo $customisation_general[$lang]["newsletter_promo"][$store_id]; ?></p>
        <?php endif; ?>
        <?php } ?>

        <div class="divider-sm"></div>
        <form class="form-inline" id="signup1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
            <div class="form-group input-control">
                <input name="email1" id="email1" type="text" class="form-control"
                       value="<?php echo $newsletter_placeholder; ?>"
                       onblur="if (this.value == '') {this.value = '<?php echo $newsletter_placeholder; ?>';}"
                       onfocus="if(this.value == '<?php echo $newsletter_placeholder; ?>') {this.value = '';}">
                <input name="apikey1" id="apikey1" type="hidden" class="form-control" value="<?php echo $your_apikey; ?>" >
                <input name="listid1" id="listid1" type="hidden" class="form-control" value="<?php echo $my_list_unique_id; ?>" >
                <div id="response1"></div>
                <div class="divider-sm"></div>

                <button name="submit" type="submit" class="btn-cool invert">
                    <span class="icon flaticon-new78"></span>
                    <?php echo (isset($customisation_general[$lang]["newsletter_button"][$store_id]) ? $customisation_general[$lang]["newsletter_button"][$store_id] : 'subscribe'); ?>
                </button>

                <div class="divider-xl"></div>

                <div>
                    <input id="donot_show_checkbox" type="checkbox" value="">
                    <span class="inline">
                        <?php if (!isset($customisation_general[$lang]["newsletter_close"][$store_id])) { ?>
                        &nbsp;&nbsp;Don't show this popup again
                        <?php } else { ?>
                        <?php echo '&nbsp;&nbsp;'.$customisation_general[$lang]["newsletter_close"][$store_id]; ?>
                        <?php } ?>
                    </span>
                </div>

            </div>
        </form>
    </div>
</div>
<?php endif; ?>

<!-- //end Popup box -->

<?php echo $footer; ?>