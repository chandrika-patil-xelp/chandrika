<?php global $config, $loader, $registry; ?>
<?php echo $header; ?>
<?php echo $loader->controller('common/top_promo'); ?>
<?php
    $loader->model('custom/general');
$model_breadcrumbs = $registry->get('model_custom_general');
$breadcrumbs = $model_breadcrumbs->getBreadcrumbs($breadcrumbs);
echo $breadcrumbs;
?>

<div class="container">
  <div class="row">
      <?php echo $content_top; ?>
      <div id="content" class="text-center col-sm-12">
        <div class="big-icon"><span class="icon flaticon-shopping185"></span></div>

          <div class="extra-big-icon"><span class="icon flaticon-404"></span></div>

      <h1><?php echo $heading_title; ?></h1>
      <span class="sub-header"><?php echo $text_error; ?></span>
      <div class="divider-lg"></div>
      <a href="<?php echo $continue; ?>" class="btn btn-cool btn-lg"><?php echo $button_continue; ?></a>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>