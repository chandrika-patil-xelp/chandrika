<?php global $config, $loader, $registry; ?>
<?php echo $header; ?>
<?php echo $loader->controller('common/top_promo'); ?>
<?php
    $loader->model('custom/general');
$model_breadcrumbs = $registry->get('model_custom_general');
$breadcrumbs = $model_breadcrumbs->getBreadcrumbs($breadcrumbs);
echo $breadcrumbs;
?>
<div class="container content contact_us_content" id="content">
        <div class="subtitle">
            <h1 class="subtitle"><span><?php echo $heading_title; ?></span></h1>
        </div>
        <?php echo $content_top; ?>
    <div class="row">
        <div class="divider-lg"></div>
        <div class="<?php echo ($column_right ? 'col-sm-8 col-md-8' : 'col-sm-4 col-md-4'); ?>">
            <div class="subtitle">
                <h3 class="div_subtitle"><span><?php echo $text_location; ?></span></h3>
            </div>
            <div class="row">
                <div class="<?php echo ($column_right ? 'col-md-4' : 'col-md-12'); ?>">
                    <?php if ($image) { ?>
                    <img src="<?php echo $image; ?>" alt="<?php echo $store; ?>" title="<?php echo $store; ?>" />
                    <?php } ?>
                    <div class="divider-sm"></div>
                    <ul class="menu menu-icon">
                        <li>
                            <span class="icon flaticon-home113"></span>
                            <address class="site_address"><?php echo $address; ?></address>
                        </li>
                        <li><span class="icon flaticon-phone163"></span><?php echo $telephone; ?></li>
                        <li>
                            <span class="icon icon-xs flaticon-new78"></span>
                            <a href="mailto:<?php echo $config->get('config_email'); ?>">
                                <?php echo $config->get('config_email'); ?>
                            </a>
                        </li>
                        <?php if ($fax) : ?><li><span class="icon flaticon-skype12"></span><?php echo $fax; ?></li><?php endif; ?>
                        <?php if ($geocode) { ?>
                            <li><a href="https://maps.google.com/maps?q=<?php echo urlencode($geocode); ?>&hl=en&t=m&z=15" target="_blank" class="btn btn-info"><i class="fa fa-map-marker"></i> <?php echo $button_map; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <?php if ($column_right) : echo '<div class="col-md-8">'.$column_right.'</div>'; endif; ?>
            </div>
        </div>

        <div class="<?php echo ($column_right ? 'col-sm-4 col-md-4' : 'col-sm-8 col-md-8'); ?> text-center">
            <div class="rect">
                <div class="animate scale icon-outer animated"><span class="icon flaticon-clock61"></span></div>
                <?php if ($open) : ?><h6><strong></strong><?php echo $text_open; ?></h6><?php endif; ?>
                <?php if ($comment) : ?><p><?php echo $comment; ?></p><?php endif; ?>
                <?php if ($open) : ?>
                <div class="line-divider"></div>
                <div class="divider-xs"></div>
                <h6><?php echo $open; ?></h6>
                <?php endif; ?>
            </div>
        </div>


    </div>
    <div class="divider-lg"></div>

      <?php if ($locations) { ?>
      <h3 class="div_subtitle"><?php echo $text_store; ?></h3>
      <div class="panel-group" id="accordion">
        <?php foreach ($locations as $location) { ?>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><a href="#collapse-location<?php echo $location['location_id']; ?>" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"><?php echo $location['name']; ?> <i class="fa fa-caret-down"></i></a></h4>
          </div>
          <div class="panel-collapse collapse" id="collapse-location<?php echo $location['location_id']; ?>">
            <div class="panel-body">
              <div class="row">
                <?php if ($location['image']) { ?>
                <div class="col-sm-3"><img src="<?php echo $location['image']; ?>" alt="<?php echo $location['name']; ?>" title="<?php echo $location['name']; ?>" class="img-thumbnail" /></div>
                <?php } ?>
                <div class="col-sm-3"><strong><?php echo $location['name']; ?></strong><br />
                  <address class="site_address">
                  <?php echo $location['address']; ?>
                  </address>
                  <?php if ($location['geocode']) { ?>
                  <a href="https://maps.google.com/maps?q=<?php echo urlencode($location['geocode']); ?>&hl=en&t=m&z=15" target="_blank" class="btn btn-info"><i class="fa fa-map-marker"></i> <?php echo $button_map; ?></a>
                  <?php } ?>
                </div>
                <div class="col-sm-3"> <strong><?php echo $text_telephone; ?></strong><br>
                  <?php echo $location['telephone']; ?><br />
                  <br />
                  <?php if ($location['fax']) { ?>
                  <strong><?php echo $text_fax; ?></strong><br>
                  <?php echo $location['fax']; ?>
                  <?php } ?>
                </div>
                <div class="col-sm-3">
                  <?php if ($location['open']) { ?>
                  <strong><?php echo $text_open; ?></strong><br />
                  <?php echo $location['open']; ?><br />
                  <br />
                  <?php } ?>
                  <?php if ($location['comment']) { ?>
                  <strong><?php echo $text_comment; ?></strong><br />
                  <?php echo $location['comment']; ?>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    <div class="divider-lg"></div>
    <?php } ?>


<div class="subtitle">
    <h3 class="div_subtitle"><span><?php echo $text_contact; ?></span></h3>
</div>

      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-inline contact-form">

          <div class="row">
              <div class="col-sm-5 col-md-4">
                  <input type="text" name="name" value="<?php echo $entry_name; ?>" id="input-name" class="form-control"  onblur="if (this.value == '') {this.value = '<?php echo $entry_name; ?>';}" onfocus="if(this.value == '<?php echo $entry_name; ?>') {this.value = '';}" />
                  <?php if ($error_name) { ?>
                    <div class="text-danger"><?php echo $error_name; ?></div>
                  <?php } ?>
                  <input type="text" name="email" value="<?php echo $entry_email; ?>" id="input-email" class="form-control" onblur="if (this.value == '') {this.value = '<?php echo $entry_email; ?>';}" onfocus="if(this.value == '<?php echo $entry_email; ?>') {this.value = '';}" />
                  <?php if ($error_email) { ?>
                    <div class="text-danger"><?php echo $error_email; ?></div>
                  <?php } ?>
                  <?php if ($site_key) { ?>
                         <div class="g-recaptcha" data-sitekey="<?php echo $site_key; ?>"></div>
                          <?php if ($error_captcha) { ?>
                            <div class="text-danger"><?php echo $error_captcha; ?></div>
                          <?php } ?>
                  <?php } ?>
              </div>
              <div class="col-sm-7 col-md-8">
                  <textarea name="enquiry" rows="10" id="input-enquiry" class="form-control" onblur="if (this.value == '') {this.value = '<?php echo $enquiry; ?>';}" onfocus="if(this.value == '<?php echo $enquiry; ?>') {this.value = '';}" ><?php echo $enquiry; ?></textarea>
                  <?php if ($error_enquiry) { ?>
                  <div class="text-danger"><?php echo $error_enquiry; ?></div>
                  <?php } ?>
              </div>

          </div>



          <div class="row">
              <div class="col-md-12">
                  <input class="button btn-cool btn-lg pull-right" type="submit" value="<?php echo $button_submit; ?>" />
              </div>
          </div>




      </form>
      <?php echo $content_bottom; ?>

</div>
<?php echo $footer; ?>
