<?php
if ($modules) :

    global $config, $loader, $registry;

    $loader->model('custom/general');
    $model = $registry->get('model_custom_general');
    $layout_id = $model->getCurrentLayout();

?>
<?php if ($layout_id != 2 && $layout_id != 8 && $layout_id != 1) : ?>
<aside id="column-right" class="<?php echo (isset($layout_id) && $layout_id == 2 ? 'col-sm-12 col-md-3 col-lg-3' : 'col-sm-4 col-md-4 col-lg-3'); ?> column-right content-aside">
    <div class="panel-group accordion-simple">
    <?php endif; ?>

        <?php if ($layout_id == 1) : ?>
            <div class="col-sm-9 col-md-9 col-lg-9">
        <?php endif; ?>

                <?php foreach ($modules as $module) : ?>
                    <?php if ($layout_id != 1) { ?>
                        <?php echo '<div class="panel">'.$module.'</div>'; ?>
                    <?php } else { ?>
                        <?php echo $module; ?>
                    <?php } ?>
                <?php endforeach; ?>

        <?php if ($layout_id == 1) : ?>
            </div>
        <?php endif; ?>

<?php if ($layout_id != 2 && $layout_id != 8 && $layout_id != 1) : ?>
    </div>
</aside>
<?php endif; ?>

<?php endif; ?>
