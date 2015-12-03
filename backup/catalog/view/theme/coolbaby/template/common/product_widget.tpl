<?php if ($modules) : ?>
<div class="product_widget_wrapper">
    <section class="container content">
        <h6 style="display:none">&nbsp;</h6>
        <div class="row" id="mobileAccord">
            <?php foreach ($modules as $k => $module) { ?>
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 accord-panel <?php echo ($k == 3 ? 'hidden-xs' : ''); ?>">
                <?php echo $module; ?>
            </div>
            <?php } ?>
        </div>
    </section>
</div>
<?php endif; ?>
