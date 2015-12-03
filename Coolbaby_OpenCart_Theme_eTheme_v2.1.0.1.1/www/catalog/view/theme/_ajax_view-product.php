<?php
if (isset($_GET['image_main'])){$image_main = $_GET['image_main'];}

if (isset($_GET['product_name'])){$product_name = $_GET['product_name'];}
if (isset($_GET['product_description_short'])){$product_description_short = $_GET['product_description_short'];}
if (isset($_GET['product_price'])){$product_price = $_GET['product_price'];}

if (isset($_GET['product_special']) && $_GET['product_special'] != 'none'){$product_special = $_GET['product_special'];} else {$product_special = 1;}

if (isset($_GET['view_details'])){$view_details = $_GET['view_details'];} else {$view_details = 'view details';}

if (isset($_GET['product_rating'])){$product_rating = $_GET['product_rating'];}
if (isset($_GET['product_href'])){$product_href = $_GET['product_href'];}
if (isset($_GET['product_id'])){
    $product_href = $product_href.'&amp;product_id='.$_GET['product_id'];
} else {
    $product_href = $_GET['product_href'];
}

if (isset($_GET['text_tax'])){$text_tax = $_GET['text_tax'];}
if (isset($_GET['product_tax'])){$product_tax = $_GET['product_tax'];}
if (isset($_GET['stock'])){$stock = $_GET['stock'];}

if (isset($_GET['symbol'])){$symbol = $_GET['symbol'];}



if (isset($_GET['share_f'])){$share_facebook = $_GET['share_f'];}
if (isset($_GET['share_t'])){$share_twitter = $_GET['share_t'];}
if (isset($_GET['share_g'])){$share_google = $_GET['share_g'];}
if (isset($_GET['share_pin'])){$share_pin = $_GET['share_pin'];}

?>



<div class="product-view product-view-compact row"><br /><br />


    <div class="col-sm-4 col-md-4 col-lg-4 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 ">
      <div class="large-image">
          <img src="<?php echo $image_main; ?>" class="img-responsive" alt="<?php echo $product_name; ?>" />
      </div>
      </div>
    <div class="info-cell col-sm-6 col-md-6 col-lg-6">
        <a class="close-view"><span class="icon flaticon-close19"></span></a>
        <h2><?php echo $product_name; ?></h2>

        <?php if ($product_special == 1) { ?>
        <span class="price regular"><?php echo $product_price; ?><?php echo $symbol; ?></span>
        <?php } else { ?>
        <span class="price old"><?php echo $product_price; ?></span>
        <span class="price new"><?php echo $product_special; ?></span>
        <?php } ?>

        <?php
        if ($product_rating > 0) : ?>
            <div class="rating">
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                <?php if ($product_rating < $i) { ?>
                    <span class="fa fa-stack">
                              <i class="fa fa-star-o fa-stack-1x"></i>
                          </span>
                    <?php } else { ?>
                    <span class="fa fa-stack">
                              <i class="fa fa-star fa-stack-1x"></i>
                              <i class="fa fa-star-o fa-stack-1x"></i>
                          </span>
                    <?php } ?>
                <?php } ?>
            </div>
        <?php endif; ?>

      <p><span><strong><?php echo $stock; ?></strong></span> <span><?php echo $text_tax.$product_tax; ?></span></p>
      <p class="product-info">
          <?php echo $product_description_short; ?>
      </p>

       <div class="form-inputs">
           <a href="<?php echo $product_href; ?>" class="btn btn-cool btn-lg">
              <i class="icon flaticon-shopping66"></i><?php echo $view_details; ?>
          </a>
       </div>

        <div class="social-buttons">
            <span class="pull-left">Share:&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <ul class="socials">
                <li><?php echo html_entity_decode($share_facebook, ENT_QUOTES, 'UTF-8'); ?></li>
                <li><?php echo html_entity_decode($share_twitter, ENT_QUOTES, 'UTF-8'); ?></li>
                <li><?php echo html_entity_decode($share_google, ENT_QUOTES, 'UTF-8'); ?></li>
                <li><?php echo html_entity_decode($share_pin, ENT_QUOTES, 'UTF-8'); ?></li>
            </ul>
        </div>

      </div>
    </div>
