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
        
    </section>
<?php if ($boxed_enable) : ?>
    </div>
<?php endif; ?>
