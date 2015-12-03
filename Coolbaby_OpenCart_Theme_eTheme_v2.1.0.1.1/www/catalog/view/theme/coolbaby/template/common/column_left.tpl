<?php
if ($modules) :
    global $config, $loader, $registry;

    $loader->model('custom/general');
    $model = $registry->get('model_custom_general');
    $layout_id = $model->getCurrentLayout();

?>
<?php if ($layout_id != 9 && $layout_id != 1) : ?>
    <aside class="<?php echo ($layout_id < 4 ? 'col-sm-4 col-md-3 col-lg-2' : 'col-sm-3'); ?> content-aside">
<?php endif; ?>

<?php if ($layout_id != 9) : ?>
        <div id="column-left" class="panel-group accordion-simple <?php echo ($layout_id == 1 ? 'col-sm-3 col-md-3 col-lg-3' : ''); ?>">
<?php endif; ?>

                <?php foreach ($modules as $module) : ?>
                    <?php if ($layout_id != 1) { ?>
                        <?php echo '<div class="panel">'.$module.'</div>'; ?>
                    <?php } else { ?>
                        <?php echo $module; ?>
                    <?php } ?>
                <?php endforeach; ?>



<?php if ($layout_id != 9) : ?>
        </div>
<?php endif; ?>
<?php if ($layout_id != 9 && $layout_id != 1) : ?>
    </aside>
<?php endif; ?>

<?php endif; ?>
