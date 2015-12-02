<?php
    global $config, $loader, $registry;
    $lang = $config->get('config_language_id');
    $store_id = $config->get('config_store_id');

    $customisation_general = $config->get('customisation_general_store');

?>
<!-- Subscribe -->
<div class="subscribe_wrapper">
    <?php if (!isset($customisation_general["newsletter_status"][$store_id]) || $customisation_general["newsletter_status"][$store_id] != 0) : ?>
    <section class="content container">
        <div class="subscribe">
            <div class="row collapsed-block">
                <?php
            $your_apikey = $customisation_general["apikey"][$store_id];
            $my_list_unique_id = $customisation_general["list_unique_id"][$store_id];

            if (isset($customisation_general["apikey"][$store_id]) && isset($customisation_general["list_unique_id"][$store_id]) && $customisation_general["apikey"][$store_id] != '' && $customisation_general["list_unique_id"][$store_id] != '') {
        ?>

                <?php if (!isset($customisation_general[$lang]["newsletter_title"][$store_id])) { ?>
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <h3>NEWSLETTER SIGNUP <a class="expander visible-sm visible-xs" href="#TabBlock-1">+</a></h3>
                </div>
                <?php } else { ?>
                <?php if ($customisation_general[$lang]["newsletter_title"][$store_id] != ''): ?>
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <h3><?php echo $customisation_general[$lang]["newsletter_title"][$store_id]; ?> <a class="expander visible-sm visible-xs" href="#TabBlock-1">+</a></h3>
                </div>
                <?php endif; ?>
                <?php } ?>

                <div class="col-sm-12 col-md-9 col-lg-9 tabBlock" id="TabBlock-1">
                    <?php $newsletter_placeholder = (isset($customisation_general[$lang]["newsletter_placeholder"][$store_id]) ? $customisation_general[$lang]["newsletter_placeholder"][$store_id] : 'Your E-mail...'); ?>

                    <form class="form-inline" id="signup" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                        <div class="row">
                            <div class="col-sm-5 col-md-5">
                                <input name="email" id="email" type="text" class="form-control pull-right"
                                       value="<?php echo $newsletter_placeholder; ?>"
                                       onblur="if (this.value == '') {this.value = '<?php echo $newsletter_placeholder; ?>';}"
                                       onfocus="if(this.value == '<?php echo $newsletter_placeholder; ?>') {this.value = '';}">
                                <input name="apikey" id="apikey" type="hidden" class="form-control" value="<?php echo $your_apikey; ?>" >
                                <input name="listid" id="listid" type="hidden" class="form-control" value="<?php echo $my_list_unique_id; ?>" >
                                <span id="response"></span>
                                <div class="divider divider-sm visible-xs"></div>
                            </div>
                            <div class="col-sm-2 col-md-2">
                                <button name="submit" type="submit" class="button btn-cool"><span class="icon flaticon-new78"></span>
                                    <?php echo (isset($customisation_general[$lang]["newsletter_button"][$store_id]) ? $customisation_general[$lang]["newsletter_button"][$store_id] : 'subscribe'); ?>
                                </button>
                                <div class="divider divider-sm visible-xs"></div>
                            </div>
                            <div class="col-sm-5  col-md-4">
                                <?php if (!isset($customisation_general[$lang]["newsletter_promo"][$store_id])) { ?>
                                <p>Enter your email and we'll send you a coupon with 10% off your next order.</p>
                                <?php } else { ?>
                                <?php if ($customisation_general[$lang]["newsletter_promo"][$store_id] != ''): ?>
                                <p><?php echo $customisation_general[$lang]["newsletter_promo"][$store_id]; ?></p>
                                <?php endif; ?>
                                <?php } ?>
                            </div>
                        </div>
                    </form>



                </div>
                <?php } else { ?>
                <h3 class="mailchimp_error">Enter API key and List ID for your Mailchimp account!</h3>
                <?php } ?>
            </div>
        </div>
    </section>
<?php endif; ?>
</div>

<!-- //end Subscribe -->


<!-- Footer -->
<footer>
    <div id="footer-collapsed" class="<?php echo (isset($customisation_general["footer_type"][$store_id]) && $customisation_general["footer_type"][$store_id] == 2 ? 'no-popup' : 'yes-popup'); ?>">

        <?php if (!isset($customisation_general["footerpopup"][$store_id]) || $customisation_general["footerpopup"][$store_id] != 0) : ?>
        <div class="footer-navbar">
                    <div class="container">
                        <div class="arrow link hidden-xs hidden-sm"><i class="icon flaticon-down14"></i></div>
                        <?php if ($informations) : ?>
                        <div class="collapsed-block">
                            <div class="inside">
                                <h3><span class="link"><?php echo $text_information; ?></span><a class="expander visible-sm visible-xs" href="#TabBlock-2">+</a></h3>
                                <div class="tabBlock" id="TabBlock-2">
                                    <ul class="menu">
                                        <?php foreach ($informations as $information) : ?>
                                            <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="collapsed-block">
                            <div class="inside">
                                <h3><span class="link"><?php echo $text_service; ?></span><a class="expander visible-sm visible-xs" href="#TabBlock-3">+</a></h3>
                                <div class="tabBlock" id="TabBlock-3">
                                    <ul class="menu">
                                        <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
                                        <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
                                        <li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
                                        <li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="collapsed-block">
                            <div class="inside">
                                <h3><span class="link"><?php echo $text_account; ?></span><a class="expander visible-sm visible-xs" href="#TabBlock-4">+</a></h3>
                                <div class="tabBlock" id="TabBlock-4">
                                    <ul class="menu">
                                        <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
                                        <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
                                        <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
                                        <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($customisation_general["socials_status"][$store_id]) && $customisation_general["socials_status"][$store_id] != 0) : ?>
                        <div class="collapsed-block">
                            <div class="inside">
                                <?php if (isset($customisation_general[$lang]["footer_socials_title"][$store_id]) && $customisation_general[$lang]["footer_socials_title"][$store_id] != '') : ?>
                                <h3><span class="link"><?php echo $customisation_general[$lang]["footer_socials_title"][$store_id]; ?></span><a class="expander visible-sm visible-xs" href="#TabBlock-5">+</a></h3>
                                <?php endif; ?>
                                <div class="tabBlock" id="TabBlock-5">
                                    <ul class="socials socials-lg">
                                        <?php echo (isset($customisation_general["socials"][$store_id]) && is_string($customisation_general["socials"][$store_id]) ? html_entity_decode($customisation_general["socials"][$store_id], ENT_QUOTES, 'UTF-8') : ''); ?>
                                    </ul>
                                    <div class="divider divider-sm visible-xs visible-sm"></div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if (isset($customisation_general["customblock_status"][$store_id]) && $customisation_general["customblock_status"][$store_id] != 0 && isset($customisation_general[$lang]["customblock_html"][$store_id]) && $customisation_general[$lang]["customblock_html"][$store_id] != '') : ?>
                        <div class="collapsed-block">
                            <div class="inside">
                                <?php if (isset($customisation_general[$lang]["custom_html_title"][$store_id]) && $customisation_general[$lang]["custom_html_title"][$store_id] != '') : ?>
                                <h3>
                                    <span class="link">
                                        <?php echo $customisation_general[$lang]["custom_html_title"][$store_id]; ?>
                                    </span>
                                    <a class="expander visible-sm visible-xs" href="#TabBlock-6">+</a>
                                </h3>
                                <?php endif; ?>

                                <div class="tabBlock" id="TabBlock-6">
                                     <?php echo (isset($customisation_general[$lang]["customblock_html"][$store_id]) && is_string($customisation_general[$lang]["customblock_html"][$store_id]) ? html_entity_decode($customisation_general[$lang]["customblock_html"][$store_id], ENT_QUOTES, 'UTF-8') : ''); ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>
        <?php endif; ?>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 copyright">
                        <?php echo (isset($customisation_general["footercopyright"][$store_id]) && is_string($customisation_general["footercopyright"][$store_id]) ? html_entity_decode($customisation_general["footercopyright"][$store_id], ENT_QUOTES, 'UTF-8') : $powered); ?>
                    </div>
                    <?php if (isset($customisation_general["footerpayment_status"][$store_id]) && $customisation_general["footerpayment_status"][$store_id] != 0) : ?>
                        <div class="col-md-4">
                            <ul class="payment-list pull-right">
                                <?php
                                    if (isset($customisation_general["footerpayment"][$store_id]) && $customisation_general["footerpayment"][$store_id] != '' && is_string($customisation_general["footerpayment"][$store_id])) {
                                        echo html_entity_decode($customisation_general["footerpayment"][$store_id], ENT_QUOTES, 'UTF-8');
                                    }
                                ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</footer>
<div id="outer-overlay"></div>
<!-- //end Footer -->
</div>


</div>
<!--end common wrappers-->



</body>
</html>