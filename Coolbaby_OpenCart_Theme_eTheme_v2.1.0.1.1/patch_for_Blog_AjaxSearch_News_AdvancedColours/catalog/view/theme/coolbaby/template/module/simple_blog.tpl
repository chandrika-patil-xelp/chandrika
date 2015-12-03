<?php if($articles) : ?>
<?php
        global $config, $loader, $registry;
        $store_id = $config->get('config_store_id');

$customisation_general = $config->get('customisation_general_store');
$boxed_enable = isset($customisation_general["homepage_mode"][$store_id]) && $customisation_general["homepage_mode"][$store_id] == 'boxed';

$loader->model('custom/general');
$model_module = $registry->get('model_custom_general');
$settings = $model_module->getModuleImage($articles[0]['image']);
$width_settings = $settings[0];
$height_settings = $settings[1];

?>

<?php if ($boxed_enable) : ?>
    <div class="container">
<?php endif; ?>

<?php if (isset($module_type) && $module_type != '0') { ?>

    <div class="blog-widget parallax">
            <div class="<?php echo ($boxed_enable ? '' : 'container'); ?> content">
                <div class="posts">

                        <div class="subtitle">
                            <div><span><?php echo $heading_title;?></span></div>
                        </div>
                            <div class="slides slick-style3">
                                <?php foreach ($articles as $article) : ?>
                                    <div class="carousel-item">

                                        <a href="<?php echo $article['href'];?>">
                                            <?php if ($article['image']): ?>
                                                <img class="product-retina img-responsive" width="<?php echo $width_settings; ?>" height="<?php echo $height_settings; ?>" src="<?php echo $article['image']; ?>"  data-image2x="<?php echo $article['image2x']; ?>" alt="<?php echo $article['article_title']; ?>">
                                            <?php endif; ?>

                                            <span class="info">
                                                <?php echo $article['article_title']; ?>
                                                <span class="date">
                                                    <?php echo $article['date_added'];?>&nbsp;
                                                    <?php if ($article['author_name']) : ?>
                                                    <span class="separator"> |   &nbsp;</span>
                                                    <span class="comment_count"><?php echo $article['total_comment'];?></span>
                                                    <?php endif; ?>
                                                </span>
                                            </span>
                                        </a>

                                    </div>
                                <?php endforeach; ?>
                            </div>

                </div>
            </div>

        </div>

<?php } else { ?>
    <div class="pull-left vertical_title_outer title-sm  right-space">
        <div><span><?php echo $heading_title;?></span></div>
    </div>
    <div class="pull-left carousel_outer">
        <div class="blog-widget-small vertical">
            <div class="slides slick-style2">
                <?php foreach ($articles as $article) : ?>
                <div class="carousel-item">
                    <div class="post">
                        <div class="image">
                            <a href="<?php echo $article['href'];?>" class="preview-image">
                                <?php if ($article['image']): ?>
                                    <img class="img-responsive" src="<?php echo $article['image']; ?>" alt="<?php echo $article['article_title']; ?>">
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="text">
                            <div class="text">
                                <p class="name">
                                    <a href="<?php echo $article['href'];?>"><?php echo $article['article_title']; ?></a>
                                </p>
                                <span>
                                    <?php if ($article['author_name']) :  echo '<a href="'.$article['author_href'].'">'.$article['author_name'].'</a>'; endif; ?><br>
                                    <?php echo $article['date_added'];?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

<?php } ?>

<?php if ($boxed_enable) : ?>
    </div>
<?php endif; ?>


<?php endif; ?>