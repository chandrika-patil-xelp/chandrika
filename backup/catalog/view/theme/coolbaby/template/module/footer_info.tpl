<?php
   global $config, $loader, $registry;
   $store_id = $config->get('config_store_id');
   $customisation_general = $config->get('customisation_general_store');
$customisation_colors = $config->get('customisation_colors_store');

$boxed_enable = isset($customisation_general["homepage_mode"][$store_id]) && $customisation_general["homepage_mode"][$store_id] == 'boxed';
?>
<?php if ($boxed_enable) : ?>
    <div class="container">
<?php endif; ?>

    <section class="content social-widget animate-bg hidden-xs">
        <h6 style="display:none">&nbsp;</h6>
        <?php if (!$boxed_enable) : ?><div class="container"><?php endif; ?>
            <div class="row">

                <?php while (list($key, $val) = each($blocks)) { ?>
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <div class="<?php echo ($val['key'] == 'testimonials' ? 'subtitle right-space' : 'subtitle'); ?>">
                        <div><span><?php echo $val["title"]; ?></span></div>
                    </div>
                    <div class="<?php echo ($val['key'] == 'facebook' ? 'widget-outer facebook-widget' : 'widget-outer'); ?>">
                        <?php if ($val['key'] == 'facebook') { ?>
                            <a href="catalog/view/theme/facebook.php?facebook_account=<?php echo $val['content']; ?>"></a>



                            <div class="loading text-center">
                                <div class="loader">
                                    <div class="fond">
                                        <div class="contener_general">
                                            <div class="contener_mixte">
                                                <div class="ballcolor ball_1">&nbsp;</div>
                                            </div>
                                            <div class="contener_mixte">
                                                <div class="ballcolor ball_2">&nbsp;</div>
                                            </div>
                                            <div class="contener_mixte">
                                                <div class="ballcolor ball_3">&nbsp;</div>
                                            </div>
                                            <div class="contener_mixte">
                                                <div class="ballcolor ball_4">&nbsp;</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } elseif ($val['key'] == 'twitter') {
                            if (isset($customisation_colors["layout_skin"][$store_id]) && $customisation_colors["layout_skin"][$store_id] == 'bio') {
                                $data_theme = 'light';
                                $data_link_color = "#000";
                            } elseif (isset($customisation_colors["layout_skin"][$store_id]) && $customisation_colors["layout_skin"][$store_id] == 'tools') {
                                $data_link_color = "#3d5e9b";
                                $data_theme = 'dark';
                            } elseif (isset($customisation_colors["layout_skin"][$store_id]) && $customisation_colors["layout_skin"][$store_id] == 'kids') {
                                $data_link_color = "#fff";
                                $data_theme = 'dark';
                            } else {
                                $data_theme = 'dark';
                                $data_link_color = "#c69c6d";
                            }
                        ?>
                        <div>
                                <a class="twitter-timeline" data-widget-id="375593032344563712"
                                   data-dnt="true"
                                   data-tweet-limit="1"
                                   data-theme="<?php echo $data_theme; ?>"
                                   data-link-color="<?php echo $data_link_color; ?>"
                                   data-screen-name="<?php echo $val['content']; ?>"
                                   data-aria-polite="assertive"
                                   data-chrome="noheader nofooter noborders noscrollbar transparent">
                                    &nbsp;
                                </a>
                            </div>
                        <?php } elseif ($val['key'] == 'testimonials') { ?>
                        <div class="testimonials-widget">
                            <div class="slides">
                                <?php echo $val['content']; ?>
                            </div>
                        </div>
                        <?php } else { ?>
                            <?php echo $val['content']; ?>
                        <?php } ?>

                    </div>
                </div>


                <?php } ?>

            </div>
        <?php if (!$boxed_enable) : ?></div><?php endif; ?>
    </section>
<?php if ($boxed_enable) : ?>
    </div>
<?php endif; ?>
