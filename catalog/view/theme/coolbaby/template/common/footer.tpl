<?php
    global $config, $loader, $registry;
    $lang = $config->get('config_language_id');
    $store_id = $config->get('config_store_id');

    $customisation_general = $config->get('customisation_general_store');

?>
<!-- Subscribe -->


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