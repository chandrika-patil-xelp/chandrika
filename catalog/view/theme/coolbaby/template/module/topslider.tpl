<?php
   global $config, $loader, $registry;
   $store_id = $config->get('config_store_id');
$customisation_general = $config->get('customisation_general_store');
$customisation_colors = $config->get('customisation_colors_store');

$boxed_enable = isset($customisation_general["homepage_mode"][$store_id]) && $customisation_general["homepage_mode"][$store_id] == 'boxed';
?>

<?php if ($boxed_enable) : ?>
    <div class="container<?php echo (isset($customisation_colors["layout_skin"][$store_id]) && $customisation_colors["layout_skin"][$store_id] == 'kids' ? ' content content-first' : ''); ?>">
<?php endif; ?>
        <section id="slider">
            <?php if ($heading_title) { echo '<h2>'.$heading_title.'</h2>'; } else {echo '<h6 style="display:none">&nbsp;</h6>';} ?>
            <div class="tp-banner-container hidden-xs">
                <div class="tp-banner">
                    <?php echo $html; ?>
                </div>
            </div>
        </section>
<?php if ($boxed_enable) : ?>
    </div>
<?php endif; ?>



