<?php global $config, $loader, $registry; ?>
<?php echo $header; ?>
<?php echo $loader->controller('common/top_promo'); ?>
<?php
    $loader->model('custom/general');
$model_breadcrumbs = $registry->get('model_custom_general');
$breadcrumbs = $model_breadcrumbs->getBreadcrumbs($breadcrumbs);
echo $breadcrumbs;
?>

<div class="container content blog-page">
        <div class="row">
            <?php echo $content_top; ?>
            <div class="subtitle">
                <h1><span><?php echo $heading_title; ?></span></h1>
            </div>
            <?php if (isset($description)) : echo $description; endif;  ?>

            <?php echo $column_left; ?>
            <?php if ($column_left && $column_right) { ?>
            <?php $class = 'col-sm-6'; ?>
            <?php } elseif ($column_left || $column_right) { ?>
            <?php $class = 'col-sm-8 col-md-8 col-lg-9'; ?>
            <?php } else { ?>
            <?php $class = 'col-sm-12'; ?>
            <?php } ?>

            <div id="content" class="<?php echo $class; ?> <?php echo (!$articles ? 'min_height_null' : '') ; ?>">
                    <?php if ($articles) { ?>

                <div class="blog-posts">
                    <?php foreach($articles as $article) { ?>
                    <div class="blog-post ">
                        <a href="<?php echo $article['href']; ?>">
                            <?php if($article['image']) { ?>
                            <?php if($article['featured_found']) { ?>
                            <img src="<?php echo $article['image']; ?>" alt="<?php echo $article['article_title']; ?>" />
                            <?php } else { ?>
                            <img src="<?php echo $article['image']; ?>" alt="<?php echo $article['article_title']; ?>" />
                            <?php } ?>
                            <?php } ?>
                                <span class="info">
                                    <?php echo ucwords($article['article_title']); ?>
                                    <span class="date display_block">
                                        <?php echo $article['date_added']; ?>,
                                    </span>
                                    <a class="date" href="<?php echo $article['author_href']; ?>"><?php echo $article['author_name']; ?></a>,
                                    <?php if($article['allow_comment']) { ?>
                                    <a class="date" href="<?php echo $article['comment_href']; ?>#comment-section"><?php echo $article['total_comment']; ?></a>
                                    <?php } ?>


                                </span>
                        </a>


                        <?php if(!$article['featured_found']) { ?>
                        <div class="article-thumbnail-found"></div>
                        <?php } ?>
                    </div>
                    <?php } ?>

                </div>

                    <div class="row">
                        <div class="divider divider-lg"></div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-left"><?php echo $pagination; ?></div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right"><?php echo $results; ?></div>
                    </div>

                    <?php } else { ?>
                    <h3 class="text-center"><?php echo $text_no_found; ?></h3>
                    <?php } ?>


                <?php echo $content_bottom; ?>
            </div>

            <?php echo $column_right; ?>

        </div>
    </div>
<?php echo $footer; ?>