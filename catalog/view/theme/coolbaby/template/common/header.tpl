<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>

    <?php
        global $config, $loader, $registry;
        $store_id = $config->get('config_store_id');
        $lang = $config->get('config_language_id');
        $customisation_general = $config->get('customisation_general_store');
        $customisation_colors = $config->get('customisation_colors_store');
        $customisation_products = $config->get('customisation_products_store');
        $customisation_translation = $config->get('customisation_translation_store');

        $loader->model('custom/general');

        $model_layout = $registry->get('model_custom_general');
        $layout_id = $model_layout->getCurrentLayout();
    ?>

    <link href="//fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700" rel="stylesheet" type="text/css" />

    <link href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/stylesheet/common_styles.css" rel="stylesheet">


    <?php if (isset($customisation_colors["layout_skin"][$store_id]) && $customisation_colors["layout_skin"][$store_id] == 'tools') : ?>
    <link href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/stylesheet/coolbaby-tools.css" rel="stylesheet">
    <?php endif; ?>

    <!-- Custom styles for this template -->


<link href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/stylesheet/coolbaby.css" rel="stylesheet">
<?php if ($direction == 'rtl') : ?>
<link href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/stylesheet/coolbaby-rtl.css" rel="stylesheet">
<?php endif; ?>


<?php if (isset($customisation_colors["layout_skin"][$store_id]) && $customisation_colors["layout_skin"][$store_id] == 'marina') : ?>
    <link href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/stylesheet/coolbaby-marina.css" rel="stylesheet">
    <?php endif; ?>

    <?php if (isset($customisation_colors["layout_skin"][$store_id]) && $customisation_colors["layout_skin"][$store_id] == 'bio') : ?>
    <link href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/stylesheet/coolbaby-bio.css" rel="stylesheet">
    <?php endif; ?>

    <?php if (isset($customisation_colors["layout_skin"][$store_id]) && $customisation_colors["layout_skin"][$store_id] == 'lingerie') : ?>
    <link href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/stylesheet/coolbaby-lingerie.css" rel="stylesheet">
    <?php endif; ?>

    <?php if (isset($customisation_colors["layout_skin"][$store_id]) && $customisation_colors["layout_skin"][$store_id] == 'kids') : ?>
    <link href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/stylesheet/coolbaby-kids.css" rel="stylesheet">
    <?php endif; ?>

    <?php if (isset($customisation_colors["layout_skin"][$store_id]) && $customisation_colors["layout_skin"][$store_id] == 'tools') : ?>
    <link href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/stylesheet/coolbaby-tools.css" rel="stylesheet">
    <?php endif; ?>

    <?php if (isset($customisation_colors["layout_skin"][$store_id]) && $customisation_colors["layout_skin"][$store_id] == 'art') : ?>
    <link href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/stylesheet/coolbaby-art.css" rel="stylesheet">
    <?php endif; ?>

    <?php if (isset($customisation_colors["layout_skin"][$store_id]) && $customisation_colors["layout_skin"][$store_id] == 'bio') { ?>
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/rs-plugin/css/extralayers-bio.css" media="screen"/>
    <?php } elseif (isset($customisation_colors["layout_skin"][$store_id]) && $customisation_colors["layout_skin"][$store_id] == 'lingerie') { ?>
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/rs-plugin/css/extralayers-lingerie.css" media="screen"/>
    <?php } elseif (isset($customisation_colors["layout_skin"][$store_id]) && $customisation_colors["layout_skin"][$store_id] == 'kids') { ?>
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/rs-plugin/css/extralayers-kids.css" media="screen"/>
    <?php } elseif (isset($customisation_colors["layout_skin"][$store_id]) && $customisation_colors["layout_skin"][$store_id] == 'tools') { ?>
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/rs-plugin/css/extralayers-tools.css" media="screen"/>
    <?php } elseif (isset($customisation_colors["layout_skin"][$store_id]) && $customisation_colors["layout_skin"][$store_id] == 'art') { ?>
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/rs-plugin/css/extralayers-art.css" media="screen"/>
    <?php } else { ?>
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/rs-plugin/css/extralayers.css" media="screen"/>
    <?php } ?>

    <?php foreach ($styles as $style) { ?>
        <link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
    <?php } ?>

    <?php if (isset($customisation_general["css_file"][$store_id]) && $customisation_general["css_file"][$store_id] != 0) : ?>
    <link href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/stylesheet/custom.css" rel="stylesheet">
    <?php endif; ?>

    <?php if (isset($customisation_colors["captions_font"][$store_id]) && $customisation_colors["captions_font"][$store_id] != '-') : ?>
    <link href='//fonts.googleapis.com/css?family=<?php echo str_replace(' ', '+', $customisation_colors["captions_font"][$store_id]); ?>:200,300,400,500,600,700,800' rel='stylesheet' type='text/css'>
    <?php endif; ?>

<?php if (isset($customisation_colors["price_font"][$store_id]) && $customisation_colors["price_font"][$store_id] != '-') : ?>
<link href='//fonts.googleapis.com/css?family=<?php echo str_replace(' ', '+', $customisation_colors["price_font"][$store_id]); ?>:200,300,400,500,600,700,800' rel='stylesheet' type='text/css'>
<?php endif; ?>

<?php foreach ($analytics as $analytic) { ?>
<?php echo $analytic; ?>
<?php } ?>

    <!-- changing options from admin panel-->
<style type="text/css">
<?php if ((isset($customisation_colors["contentbg"][$store_id]) && $customisation_colors["contentbg"][$store_id] != '') || (isset($customisation_colors["general_bgcolor"][$store_id]) && $customisation_colors["general_bgcolor"][$store_id] != '')): ?>
body{background:<?php echo $customisation_colors["general_bgcolor"][$store_id]; ?> url(image/<?php echo $customisation_colors["contentbg"][$store_id]; ?>) <?php echo $customisation_colors["content_bg_mode"][$store_id]; ?> center center}
<?php endif; ?>


/*colors: theme colour */
<?php if (!empty($customisation_colors["general_themecolor"][$store_id])): ?>
.btn-primary:hover, .btn-default:hover, .btn:hover, .btn-primary.active, .btn-primary.focus,
.btn-primary:active, .btn-primary:focus, .btn-primary:hover, .open > .dropdown-toggle.btn-primary, .btn-info.active, .btn-info.focus,
.btn-info:active, .btn-info:focus, .btn-info:hover, .open>.dropdown-toggle.btn-info,
.btn-danger.active, .btn-danger.focus, .btn-danger:active, .btn-danger:focus,
.btn-danger:hover, .open>.dropdown-toggle.btn-danger,.products-nospace .product-preview .product-controls-list li a:hover .icon,.custom-block .item:hover .icon,
.btn-cool:hover, .products-land .item .btn-cool:hover, .products-land .item .filters-by-category li a:hover, .filters-by-category li .products-land .item a:hover, .products-list .banner .btn-cool:hover, .products-list .banner .filters-by-category li a:hover, .filters-by-category li .products-list .banner a:hover, .products-land .item:hover .btn-cool:hover, .products-land .item:hover .filters-by-category li a:hover, .filters-by-category li .products-land .item:hover a:hover, .products-land .item:hover .invert .btn-cool:hover, .products-land .item:hover .invert .filters-by-category li a:hover, .filters-by-category li .products-land .item:hover .invert a:hover, .products-list .banner:hover .btn-cool:hover, .products-list .banner:hover .filters-by-category li a:hover, .filters-by-category li .products-list .banner:hover a:hover, .products-list .banner:hover .invert .btn-cool:hover, .products-list .banner:hover .invert .filters-by-category li a:hover, .filters-by-category li .products-list .banner:hover .invert a:hover, .filters-by-category li a:hover, .filters-by-category li a.selected
{color:<?php echo $customisation_colors["general_themecolor"][$store_id]; ?> !important}

.btn-cool .icon:before, .filters-by-category li a .icon:before, .btn-cool .icon:after, .filters-by-category li a .icon:after,.product-view .close-view,
#newsLine .title .icon,.slick-prev, .slick-next,footer .footer-navbar .arrow,.custom-block .icon,
.btn-cool .icon:before, .filters-by-category li a .icon:before, .btn-cool .icon:after, .filters-by-category li a .icon:after,
.rating .fa-star, .rating .fa-star-o, .rating .fa-star + .fa-star-o,.cart .product-controls a,.filters-panel .view-mode a, .pagination a,
.product-preview .product-controls-list li a, .product-preview .product-controls-list-row li a, .product-preview .product-controls-list li a.hidden-xs, .product-preview .product-controls-list-row li a.hidden-xs
{color:<?php echo $customisation_colors["general_themecolor"][$store_id]; ?>}

.top-link .btn-shopping-cart .badge,.brands-carousel a .after{background:<?php echo $customisation_colors["general_themecolor"][$store_id]; ?>}

<?php endif; ?>

/*colors: general texts */
<?php if (!empty($customisation_colors["general_text"][$store_id])): ?>
#newsLine,#openSearch input.search-input,.shoppingcart-box,.navbar-main-menu-outer,.services-block,#content,.content-aside,.breadcrumb,
select,input,textarea,.navbar-welcome{color:<?php echo $customisation_colors["general_text"][$store_id]; ?>}
<?php endif; ?>

/*colors: general links */
<?php if (!empty($customisation_colors["general_link"][$store_id])): ?>
#newsLine a,.shoppingcart-box a,.navbar-main-menu-outer a,.services-block a,#content a,.content-aside a,.breadcrumb a,
.submenu-block .name,#menuScrollerWrapper .dropdown a{color:<?php echo $customisation_colors["general_link"][$store_id]; ?>}
<?php endif; ?>

/*colors: captions */
<?php if (!empty($customisation_colors["captions_font"][$store_id])): ?>
h1,h2,h3,h4,h5,h6,.subtitle div span,.services-block .title, .custom-block .title,.navbar-main-menu .item .btn-main, .sf-menu>li,#newsLine .title,.banner-circle .title span,.vertical_title_outer span,.accordion-simple .panel .panel-heading a,.btn-cool.btn-lg, .filters-by-category li a.btn-lg{font-family:<?php echo $customisation_colors["captions_font"][$store_id]; ?>}
<?php endif; ?>

<?php if (!empty($customisation_colors["captions_text"][$store_id])): ?>
h1,h2,h3,h4,h5,h6,.subtitle div span,.services-block .title, .custom-block .title,.navbar-main-menu .item .btn-main, .sf-menu>li,#newsLine .title,.banner-circle .title span,.vertical_title_outer span,.accordion-simple .panel .panel-heading a,.btn-cool.btn-lg, .filters-by-category li a.btn-lg{color:<?php echo $customisation_colors["captions_text"][$store_id]; ?>}
<?php endif; ?>

/*colors: header / general */
<?php if (!empty($customisation_colors["topline_bgcolor"][$store_id])): ?>
.str_wrap{background-color:<?php echo $customisation_colors["topline_bgcolor"][$store_id]; ?>}
<?php endif; ?>

<?php if (!empty($customisation_colors["topline_texts"][$store_id])): ?>
.dropdown-menu > form > .li_sub > a:focus, .dropdown-menu > form > .li_sub > a:hover,
.dropdown-menu > li > a:focus, .dropdown-menu > li > a:hover,
#header_type1 .navbar-welcome,#header_type2 .navbar-welcome,header .dropdown-menu > li > a,header .dropdown-menu > form > .li_sub > a{color:<?php echo $customisation_colors["topline_texts"][$store_id]; ?>}
<?php endif; ?>

<?php if (!empty($customisation_colors["header_icons_color"][$store_id])): ?>
.navbar-secondary-menu .icon{color:<?php echo $customisation_colors["header_icons_color"][$store_id]; ?>}
<?php endif; ?>

<?php if (!empty($customisation_colors["toolline_border"][$store_id])): ?>
#newsLine,.navbar-main-menu-outer{border-color:<?php echo $customisation_colors["toolline_border"][$store_id]; ?>}
<?php endif; ?>


/*colors: header / tooline */
<?php if (!empty($customisation_colors["toolline_bgcolor"][$store_id])): ?>
#newsLine,.str_wrap{background-color:<?php echo $customisation_colors["toolline_bgcolor"][$store_id]; ?>}
<?php endif; ?>

<?php if (!empty($customisation_colors["topline_texts"][$store_id])): ?>
#newsLine,#newsLine a{color:<?php echo $customisation_colors["topline_texts"][$store_id]; ?>}
<?php endif; ?>

<?php if (!empty($customisation_colors["toolline_icons"][$store_id])): ?>
#newsLine .title .icon,.top-link .btn-search .btn-xs .icon,.top-link .btn-shopping-cart .btn-default .icon,.slick-style1 .slick-next:before{color:<?php echo $customisation_colors["toolline_icons"][$store_id]; ?>}
<?php endif; ?>


/*colors: header / Top navigation */
<?php if (!empty($customisation_colors["top_menu_bgcolor"][$store_id])): ?>
.navbar-main-menu-outer{background-color:<?php echo $customisation_colors["top_menu_bgcolor"][$store_id]; ?>}
<?php endif; ?>

<?php if (!empty($customisation_colors["topmenu_items"][$store_id])): ?>
.navbar-main-menu .item .btn-main, .sf-menu > li{color:<?php echo $customisation_colors["topmenu_items"][$store_id]; ?>}
<?php endif; ?>

<?php if (!empty($customisation_colors["toopmenu_highlight"][$store_id])): ?>
.navbar-main-menu .with-sub .btn-main:hover{border-color:<?php echo $customisation_colors["toopmenu_highlight"][$store_id]; ?>}
<?php endif; ?>

<?php if (!empty($customisation_colors["topmenu_hot"][$store_id])): ?>
.label.label-sale::after, .label.label-hot::after, .label.label-newl::after{background-color:<?php echo $customisation_colors["topmenu_hot"][$store_id]; ?>}
<?php endif; ?>

<?php if (!empty($customisation_colors["topmenu_new"][$store_id])): ?>
.label.label-newl{background-color:<?php echo $customisation_colors["topmenu_new"][$store_id]; ?>}
<?php endif; ?>

/*colors: content / promo blocks */
<?php if (!empty($customisation_colors["promo_bg"][$store_id])): ?>
.services-block{background-color:<?php echo $customisation_colors["promo_bg"][$store_id]; ?>}
<?php endif; ?>

<?php if (!empty($customisation_colors["promo_texts"][$store_id])): ?>
.services-block .title{color:<?php echo $customisation_colors["promo_texts"][$store_id]; ?>}
<?php endif; ?>

<?php if (!empty($customisation_colors["circle_texts"][$store_id])): ?>
.banner-circle .title span{color:<?php echo $customisation_colors["circle_texts"][$store_id]; ?>}
<?php endif; ?>

/*colors: content / general */
<?php if (!empty($customisation_colors["container_bgcolor"][$store_id])): ?>
.container-widget,.content_top,.product_widget_wrapper,.subscribe_wrapper{background-color:<?php echo $customisation_colors["container_bgcolor"][$store_id]; ?>}
<?php endif; ?>


<?php if (!empty($customisation_colors["blog_bg"][$store_id]) && (isset($customisation_colors["blog_bg_image"][$store_id]) && $customisation_colors["blog_bg_image"][$store_id] != '' && $customisation_colors["blog_bg_mode"][$store_id] != 'none')) { ?>
.blog-widget{background:<?php echo $customisation_colors["blog_bg"][$store_id]; ?> url(image/catalog/<?php echo $customisation_colors["blog_bg_image"][$store_id]; ?>) <?php echo $customisation_colors["blog_bg_mode"][$store_id]; ?> center}
<?php } elseif (!empty($customisation_colors["blog_bg"][$store_id])) { ?>
.blog-widget{background:<?php echo $customisation_colors["blog_bg"][$store_id]; ?>}
<?php } elseif (isset($customisation_colors["blog_bg_image"][$store_id]) && $customisation_colors["blog_bg_image"][$store_id] != '' && $customisation_colors["blog_bg_mode"][$store_id] != 'none') { ?>
.blog-widget{background:url(image/catalog/<?php echo $customisation_colors["blog_bg_image"][$store_id]; ?>) <?php echo $customisation_colors["blog_bg_mode"][$store_id]; ?> center center}
<?php } elseif ($customisation_colors["blog_bg_mode"][$store_id] == 'none') { ?>
.blog-widget{background:none}
<?php } ?>


<?php if (!empty($customisation_colors["newsletter_wrapper_bg"][$store_id])): ?>
.subscribe_wrapper{color:<?php echo $customisation_colors["newsletter_wrapper_bg"][$store_id]; ?>}
<?php endif; ?>

/*colors: content / product listings */
<?php if (!empty($customisation_colors["listing_border"][$store_id])): ?>
.product-preview:hover{border-color:<?php echo $customisation_colors["listing_border"][$store_id]; ?>}
<?php endif; ?>

<?php if (!empty($customisation_colors["listing_regular_price"][$store_id])): ?>
.price.regular,.price,.product-view-compact .price.regular{color:<?php echo $customisation_colors["listing_regular_price"][$store_id]; ?>}
<?php endif; ?>

<?php if (!empty($customisation_colors["listing_old_price"][$store_id])): ?>
.price.old,.product-view .price.old{color:<?php echo $customisation_colors["listing_old_price"][$store_id]; ?>}
<?php endif; ?>

<?php if (!empty($customisation_colors["listing_special_price"][$store_id])): ?>
.price.new{color:<?php echo $customisation_colors["listing_special_price"][$store_id]; ?> !important}
<?php endif; ?>

<?php if (!empty($customisation_colors["price_font"][$store_id])): ?>
.price,.price.regular,.price.old,.price.new,.product-view .price.old,.product-view-compact .price.regular{font-family:<?php echo $customisation_colors["price_font"][$store_id]; ?>}
<?php endif; ?>

/*colors: footer / information block */
<?php if (!empty($customisation_colors["footerpopup_captions"][$store_id])): ?>
.animate-bg .subtitle div span::before, .animate-bg .subtitle div span::after,.animate-bg .subtitle div span{color:<?php echo $customisation_colors["footerpopup_captions"][$store_id]; ?>}
<?php endif; ?>

<?php if (!empty($customisation_colors["footerpopup_link"][$store_id])): ?>
.animate-bg,.animate-bg a,.testimonials-widget .text,.testimonials-widget .author{color:<?php echo $customisation_colors["footerpopup_link"][$store_id]; ?>}
<?php endif; ?>


<?php if (!empty($customisation_colors["footerpopup_image"][$store_id])): ?>
.animate-bg{background-image:url("image/catalog/<?php echo $customisation_colors["footerpopup_image"][$store_id]; ?>");background-repeat:no-repeat;background-position:center center}
<?php endif; ?>


<?php if (!empty($customisation_colors["footerpopup_bgcolor"][$store_id]) && (isset($customisation_colors["footerpopup_image"][$store_id]) && $customisation_colors["footerpopup_image"][$store_id] != '' && $customisation_colors["footerpopup_bg_mode"][$store_id] != 'none')) { ?>
.animate-bg{background:<?php echo $customisation_colors["footerpopup_bgcolor"][$store_id]; ?> url(image/catalog/<?php echo $customisation_colors["footerpopup_image"][$store_id]; ?>) <?php echo $customisation_colors["footerpopup_bg_mode"][$store_id]; ?> center}
<?php } elseif (!empty($customisation_colors["footerpopup_bgcolor"][$store_id])) { ?>
.animate-bg{background:<?php echo $customisation_colors["footerpopup_bgcolor"][$store_id]; ?>}
<?php } elseif (isset($customisation_colors["footerpopup_image"][$store_id]) && $customisation_colors["footerpopup_image"][$store_id] != '' && $customisation_colors["footerpopup_bg_mode"][$store_id] != 'none') { ?>
.animate-bg{background:url(image/catalog/<?php echo $customisation_colors["footerpopup_image"][$store_id]; ?>) <?php echo $customisation_colors["footerpopup_bg_mode"][$store_id]; ?> center center}
<?php } elseif ($customisation_colors["footerpopup_bg_mode"][$store_id] == 'none') { ?>
.animate-bg{background:none}
<?php } ?>


/*colors: footer / bottom info block */
<?php if (!empty($customisation_colors["newsletter_bg"][$store_id])): ?>
.subscribe{background-color:<?php echo $customisation_colors["newsletter_bg"][$store_id]; ?>}
<?php endif; ?>

 <?php if (!empty($customisation_colors["footerbottom_captions"][$store_id])): ?>
 footer .collapsed-block h3{color:<?php echo $customisation_colors["footerbottom_captions"][$store_id]; ?>}
 <?php endif; ?>

<?php if (!empty($customisation_colors["footerbottom_texts"][$store_id])): ?>
footer .footer-navbar .menu li, .menu.menu-icon li,footer .footer-navbar .menu li a,.socials.socials-lg a,.footer-bottom,.footer-bottom a{color:<?php echo $customisation_colors["footerbottom_texts"][$store_id]; ?>}
<?php endif; ?>

<?php if (!empty($customisation_colors["footerbottom_bg"][$store_id])): ?>
footer .footer-navbar,footer .footer-bottom{background-color:<?php echo $customisation_colors["footerbottom_bg"][$store_id]; ?>}
<?php endif; ?>

<?php if (!empty($customisation_colors["footerbottom_icons"][$store_id])): ?>
footer .open .footer-navbar .arrow,footer .footer-navbar .arrow,footer .footer-navbar .menu.menu-icon .icon, .menu.menu-icon .icon{color:<?php echo $customisation_colors["footerbottom_icons"][$store_id]; ?>}
<?php endif; ?>




</style>
    <!-- end changing options from admin panel-->



<?php if (isset($ajaxadvancesearch_status) && $ajaxadvancesearch_status){ ?>
<!--
/**
    *Ajax advanced search starts
    */
-->

<style type="text/css">

    #search .dropdown-menu li:nth-child(even){background: #<?php echo !empty($ajaxadvancedsearch_color_evenresult) ? $ajaxadvancedsearch_color_evenresult : 'FFFFFF';?>}
    #search .dropdown-menu li:nth-child(odd){background: #<?php echo !empty($ajaxadvancedsearch_color_oddresult) ? $ajaxadvancedsearch_color_oddresult : 'eee'; ?>;  border: 1px solid #fff;}
        /*<!-- 26-01-2014 starts -->*/
    <?php if($ajaxadvancedsearch_result_view!='default-view') { ?>
                                                                #search .dropdown-menu li:nth-child(even){background: #<?php echo !empty($ajaxadvancedsearch_color_evenresult) ? $ajaxadvancedsearch_color_evenresult : 'FFFFFF';?>;  border: none;}
                                                                #search .dropdown-menu li:nth-child(odd){background: #<?php echo !empty($ajaxadvancedsearch_color_oddresult) ? $ajaxadvancedsearch_color_oddresult : 'FFFFFF'; ?>;  border: none;}
                                                                #search .dropdown-menu a { border-bottom: 1px solid #cdcece; border-radius: 0; white-space: normal; }
    #search .dropdown-menu li:last-child a { border-bottom: none; }
    <?php } ?>
                    /** result area hover starts */
                    <?php if(!empty($ajaxadvancedsearch_color_resulthover)) { ?>
                    #search .dropdown-menu > li > a:hover, #search .dropdown-menu li:hover {
                                                                                              background: #<?php echo $ajaxadvancedsearch_color_resulthover; ?>;
                                                                                          }
    <?php } ?>
                    /** result area hover ends */
                    /** result area heading starts */
                    <?php if(!empty($ajaxadvancedsearch_color_heading)) { ?>
                    /** for heading color */
                    #search .dropdown-menu li a h3,
                                                                                      #search .dropdown-menu li a h4
                                                                                      { color: #<?php echo $ajaxadvancedsearch_color_heading; ?>; }
    <?php } ?>
                    <?php if(!empty($ajaxadvancedsearch_color_headinghover)) { ?>
                    /**for heading color on hover*/
                    #search .dropdown-menu li a:hover h3,
                                                                                           #search .dropdown-menu li a:hover h4
                                                                                           { color: #<?php echo $ajaxadvancedsearch_color_headinghover; ?>; }
    <?php } ?>
                    /** result area heading ends */
                    /** result area model starts */
                    <?php if(!empty($ajaxadvancedsearch_color_model)) { ?>
                    /** for model color */
                    #search .dropdown-menu li a .model,
                                                                                    #search .dropdown-menu li a .model
                                                                                    { color: #<?php echo $ajaxadvancedsearch_color_model; ?>; }
    <?php } ?>
                    <?php if(!empty($ajaxadvancedsearch_color_modelhover)) { ?>
                    /**for model color on hover*/
                    #search .dropdown-menu li a:hover .model,
                                                                                         #search .dropdown-menu li a:hover .model
                                                                                         { color: #<?php echo $ajaxadvancedsearch_color_modelhover; ?>; }
    <?php } ?>
                    /** result area model ends */
                    /** result area manufacturer starts */
                    <?php if(!empty($ajaxadvancedsearch_color_manufacturer)) { ?>
                    /** for manufacturer color */
                    #search .dropdown-menu li a .manufacturer,
                                                                                           #search .dropdown-menu li a .manufacturer
                                                                                           { color: #<?php echo $ajaxadvancedsearch_color_manufacturer; ?>; }
    <?php } ?>
                    <?php if(!empty($ajaxadvancedsearch_color_manufacturerhover)) { ?>
                    /**for manufacturer color on hover*/
                    #search .dropdown-menu li a:hover .manufacturer,
                                                                                                #search .dropdown-menu li a:hover .manufacturer
                                                                                                { color: #<?php echo $ajaxadvancedsearch_color_manufacturerhover; ?>; }
    <?php } ?>
                    /** result area manufacturer ends */
                    /** result area price starts */
                    <?php if(!empty($ajaxadvancedsearch_color_price)) { ?>
                    /** for price color */
                    #search .dropdown-menu li a .price,
                                                                                    #search .dropdown-menu li a .price
                                                                                    { color: #<?php echo $ajaxadvancedsearch_color_price; ?>; }
    <?php } ?>
                    <?php if(!empty($ajaxadvancedsearch_color_pricehover)) { ?>
                    /**for price color on hover*/
                    #search .dropdown-menu li a:hover .price,
                                                                                         #search .dropdown-menu li a:hover .price
                                                                                         { color: #<?php echo $ajaxadvancedsearch_color_pricehover; ?>; }
    <?php } ?>
                    /** result area price ends */
                    /** result area stockstatus starts */
                    <?php if(!empty($ajaxadvancedsearch_color_stockstatus)) { ?>
                    /** for stock_status color */
                    #search .dropdown-menu li a .stock_status,
                                                                                          #search .dropdown-menu li a .stock_status
                                                                                          { color: #<?php echo $ajaxadvancedsearch_color_stockstatus; ?>; }
    <?php } ?>
                    <?php if(!empty($ajaxadvancedsearch_color_stockstatushover)) { ?>
                    /**for stock_status color on hover*/
                    #search .dropdown-menu li a:hover .stock_status,
                                                                                               #search .dropdown-menu li a:hover .stock_status
                                                                                               { color: #<?php echo $ajaxadvancedsearch_color_stockstatushover; ?>; }
    <?php } ?>
                    /** result area stockstatus ends */
                    /** result area quantity starts */
                    <?php if(!empty($ajaxadvancedsearch_color_quantity)) { ?>
                    /** for quantity color */
                    #search .dropdown-menu li a .quantity,
                                                                                       #search .dropdown-menu li a .quantity
                                                                                       { color: #<?php echo $ajaxadvancedsearch_color_quantity; ?>; }
    <?php } ?>
                    <?php if(!empty($ajaxadvancedsearch_color_quantityhover)) { ?>
                    /**for quantity color on hover*/
                    #search .dropdown-menu li a:hover .quantity,
                                                                                            #search .dropdown-menu li a:hover .quantity
                                                                                            { color: #<?php echo $ajaxadvancedsearch_color_quantityhover; ?>; }
    <?php } ?>
                    /** result area quantity ends */
                    /** result area highlight starts */
                    <?php if(!empty($ajaxadvancedsearch_color_highlight)) { ?>
                    /** for highlight color */
                    #search .dropdown-menu li a .highlight,
                                                                                        #search .dropdown-menu li a .highlight
                                                                                        { color: #<?php echo $ajaxadvancedsearch_color_highlight; ?>; }
    <?php } else{ ?>
    #search .ajaxadvance li a .highlight {color: #f5003a; }
    <?php } ?>
                    <?php if(!empty($ajaxadvancedsearch_color_highlighthover)) { ?>
                    /**for highlight color on hover*/
                    #search .dropdown-menu li a:hover .highlight,
                                                                                             #search .dropdown-menu li a:hover .highlight
                                                                                             { color: #<?php echo $ajaxadvancedsearch_color_highlighthover; ?>; }
    <?php }else{ ?>
    #search .ajaxadvance li a:hover .highlight {color: #f5003a; }
    <?php } ?>
                /** result area highlight ends */

                /*<!-- 26-01-2014 ends -->*/
            #search .dropdown-menu a {border-radius: 0; white-space: normal; }
            #search .ajaxadvance { width: 100%; min-height: <?php echo (int)$ajaxadvancesearch_imageheight+ (int)$ajaxadvancesearch_imageheight*20/100;?>px; }
    #search .ajaxadvance .name { margin:0; }
    #search .ajaxadvance .image { display:inline-flex; float: left;width: <?php echo (int)$ajaxadvancesearch_imagewidth;?>px; }
    #search .ajaxadvance .content {margin-left:<?php echo (int)$ajaxadvancesearch_imagewidth + 10;?>px}
    #search .ajaxadvance .content > div { margin-top:5px;	}
    #search .ajaxadvance .price-old {color: #ff0000; text-decoration: line-through; }

</style>
<!--
/**
    *Ajax advanced search ends
    */
-->
<?php } ?>

</head>

<body class="<?php echo $class; ?> responsive <?php echo (isset($customisation_general["homepage_mode"][$store_id]) ? $customisation_general["homepage_mode"][$store_id] : ''); ?> <?php echo (isset($customisation_colors["layout_skin"][$store_id]) ? ($customisation_colors["layout_skin"][$store_id] == 'bio' ? 'marina' : $customisation_colors["layout_skin"][$store_id]) : ''); ?> layout_<?php echo $layout_id; ?> <?php echo ($direction == 'rtl' ? 'rtl' : ''); ?>">

<!--[if lt IE 9]>
<script src="catalog/view/theme/<?php echo $config->get('config_template'); ?>/js/html5shiv.js" type="text/javascript"></script>
<script src="catalog/view/theme/<?php echo $config->get('config_template'); ?>/js/respond.min.js" type="text/javascript"></script>
<![endif]-->

<script src="catalog/view/theme/<?php echo $config->get('config_template'); ?>/js/general_scripts.js" type="text/javascript"></script>

<?php if ($layout_id == 2) : ?>
<script src="catalog/view/theme/<?php echo $config->get('config_template'); ?>/js/cloudzoom.js" type="text/javascript"></script>
<?php endif; ?>

<script src="catalog/view/theme/<?php echo $config->get('config_template'); ?>/js/cloudzoom.js" type="text/javascript"></script>
<script src="catalog/view/theme/<?php echo $config->get('config_template'); ?>/js/coolbaby.js" type="text/javascript"></script>


<?php if (isset($customisation_colors["layout_skin"][$store_id]) && $customisation_colors["layout_skin"][$store_id] == 'tools') : ?>
<script src="catalog/view/theme/<?php echo $config->get('config_template'); ?>/js/jquery.smartmenus.min.js" type="text/javascript"></script>
<!-- SmartMenus jQuery init -->
<?php endif; ?>

<script src="catalog/view/javascript/common.js" type="text/javascript"></script>

<?php if (isset($ajaxadvancesearch_status) && $ajaxadvancesearch_status){ ?>
<!--
/**
    *Ajax advanced search starts
    */
-->
<script type="text/javascript"><!--
// Ajax advanced search starts
$(document).ready(function(){
    var afaxAdvancedSearch = $('#search input[name="search"]');
    var customAutocomplete = null , allRequest = null;
    afaxAdvancedSearch.autocomplete({
        delay: 500,
        responsea : function (items){
            if(typeof this.items=='undefined'){
                this.items = new Array();
            }
            if (items.length) {
                for (i = 0; i < items.length; i++) {
                    this.items[items[i]['value']] = items[i];
                }
            }
            var html='';
            if(items.length){
                $.each(items,function(key,item){
                    if(item.product_id!=0){
                        html += '<li data-value="' + item['value'] + '"><a href="#">';
                        html += '<div class="ajaxadvance">';
                        html += '<div class="image">';
                        if(item.image){
                            html += '<img title="'+item.name+'" src="'+item.image+'"/>';
                        }
                        html += '</div>';
                        html += '<div class="content">';
                        html += 	'<h4 class="name">'+item.label+'</h4>';

                        if(item.description){
                            html += 	'<div class="descr">';
                            html +=		item.description;
                            html +=		'</div>';
                        }

                        if(item.model){
                            html += 	'<div class="model">';
                            html +=		'<?php echo $ajaxadvancedsearch_model; ?> '+ item.model;
                            html +=		'</div>';
                        }
                        if(item.manufacturer){
                            html += 	'<div class="manufacturer">';
                            html +=		'<?php echo $ajaxadvancedsearch_manufacturer; ?> '+ item.manufacturer;
                            html +=		'</div>';
                        }
                        if(item.price){
                            html += 	'<div class="price"> <?php echo $ajaxadvancedsearch_price; ?> ';
                            if (!item.special) {
                                html +=			 '<span class="price-regular">'+ item.price +'</span>';
                            } else {
                                html +=			'<span class="price-old">'+ item.price +'</span> <span class="price-new">'+ item.special +'</span>';
                            }
                            html +=		'</div>';
                        }
                        if(item.stock_status){
                            html += 	'<div class="stock_status">';
                            html +=		'<?php echo $ajaxadvancedsearch_stock; ?><strong> '+ item.stock_status + '</strong>';
                            html +=		'</div>';
                        }
                        if(item.quantity){
                            html += 	'<div class="quantity">';
                            html +=		'<?php echo $ajaxadvancedsearch_quantity; ?> '+ item.quantity;
                            html +=		'</div>';
                        }
                        if (item.rating) {
                            html +=		'<div class="ratings"> <?php echo $ajaxadvancedsearch_rating; ?>';
                            for (var i = 1; i <= 5; i++) {
                                if (item.rating < i) {
                                    html +=		'<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>';
                                } else {
                                    html +=		'<span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>';
                                }
                            }
                            html +=		'</div>';
                        }
                        if(item.allresults){
                            html += '<div class="allresults">'+ allRequest.trim()+'</div>';
                        }
                        html +='</div>';
                        html += '</div></a></li>'
                    }
                });
            }

            if (html) {
                afaxAdvancedSearch.siblings('ul.dropdown-menu').show();
            } else {
                afaxAdvancedSearch.siblings('ul.dropdown-menu').hide();
            }

            $(afaxAdvancedSearch).siblings('ul.dropdown-menu').html(html);
        },
        source: function(request, response) {
            customAutocomplete = this;
            if(request.trim().length >= <?php echo $ajaxadvancesearch_charlimit ?>) {
                allRequest = request;
                $.ajax({
                    url: 'index.php?route=common/header/ajaxLiveSearch&filter_name=' +  encodeURIComponent(request.split('')),
                    dataType : 'json',
                    success : function(json) {
                        customAutocomplete.responsea($.map(json, function(item) {
                            return {
                                label: item.name,
                                name: item.name1,
                                value: item.product_id,
                                model: item.model,

                                description: item.description,

                                stock_status: item.stock_status,
                                quantity: item.quantity,
                                // seo friendly starts
                                url: item.url,
                                // seo friendly ends
                                image: item.image,
                                manufacturer: item.manufacturer,
                                price: item.price,
                                special: item.special,
                                category: item.category,
                                rating: item.rating,
                                allresults: item.allresults,
                                reviews: item.reviews,
                            }
                        }));
                    }
                });
            }
        },
        select : function (ui){
            return false;
        },
        selecta: function(ui) {
            if(ui.value){
                //location = 'index.php?route=product/product/&product_id='+ui.value;
                location = ui.url.replace('&amp;','&');
            }else{
                $('#search input[name=\'search\']').parent().find('button').trigger('click');
            }
            return false;
        },
        focus: function(event, ui) {
            return false;
        }
    });

    afaxAdvancedSearch.siblings('ul.dropdown-menu').delegate('a', 'click', function(){
        value = $(this).parent().attr('data-value');
        if (value && customAutocomplete.items[value]) {
            customAutocomplete.selecta(customAutocomplete.items[value]);
        }else{
            customAutocomplete.selecta(0);
        }
    });
});
//Ajax advanced search ends
//--></script>


<!--
/**
    *Ajax advanced search ends
    */
-->
<?php } ?>




<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
<!-- end default jquery -->

<?php if (!isset($customisation_general["preloader"][$store_id]) || $customisation_general["preloader"][$store_id] != 0) : ?>
<div class="loader">
    <div class="fond">
        <div class="contener_general">
            <div class="contener_mixte">
                <div class="ballcolor ball_1">&nbsp;</div>
            </div>
            <div class="contener_mixte">
                <div class="ballcolor ball_2">&nbsp;</div>
            </div>
            <div class="contener_mixte">
                <div class="ballcolor ball_3">&nbsp;</div>
            </div>
            <div class="contener_mixte">
                <div class="ballcolor ball_4">&nbsp;</div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if (isset($customisation_colors["layout_skin"][$store_id]) && $customisation_colors["layout_skin"][$store_id] == 'lingerie' && $layout_id == 1) : ?>
<?php if (isset($customisation_general["preloader_status"][$store_id]) && $customisation_general["preloader_status"][$store_id] != 0 && $customisation_general[$lang]["preloader_html"][$store_id] && $customisation_general[$lang]["preloader_html"][$store_id] != '') : ?>

<?php echo html_entity_decode($customisation_general[$lang]["preloader_html"][$store_id], ENT_QUOTES, 'UTF-8'); ?>
<script>
    jQuery(function($j) {
        function fullscreenFix() {
            var h = $j('body').height();
            if ($j("#preload-image .preloadText").innerHeight() <= h) {
                $j("#preload-image").addClass("not-overflow");
            };
        }
        function backgroundResize() {
            var windowH = $j(window).height();
            var path = $j("#preload-image");
            var contW = path.width();
            var contH = path.height();
            var imgW = path.attr("data-img-width");
            var imgH = path.attr("data-img-height");
            var ratio = imgW / imgH;
            var diff = parseFloat(path.attr("data-diff"));
            diff = diff ? diff : 0;
            var remainingH = 0;
            imgH = contH + remainingH + diff;
            imgW = imgH * ratio;
            if (contW > imgW) {
                imgW = contW;
                imgH = imgW / ratio;
            }
            path.data("resized-imgW", imgW);
            path.data("resized-imgH", imgH);
            path.css("background-size", imgW + "px " + imgH + "px");
        }

        $j(window).scrollTop(0);
        $j("html").addClass('noscroll');

        fullscreenFix();
        backgroundResize();

        $j('#goToSite').on("click", function(e) {
            e.preventDefault();
            $j("html").removeClass('noscroll');
            $j("#preload-image").fadeOut(500);
        })

        $j(window).resize(function() {
            if ($j("#preload-image").is(':visible')) {
                fullscreenFix();
                backgroundResize();
            }
        })
    })
</script>

<?php endif; ?>
<?php endif; ?>

<!--mobile menu-->

<!-- Off Canvas Menu -->
<div class="hidden">
<nav id="off-canvas-menu">
<span class="icon icon-xl flaticon-delete30" id="off-canvas-menu-close"></span>
<ul class="expander-list">


<?php if (!isset($customisation_general["homebutton"][$store_id]) || $customisation_general["homebutton"] != 0 ) : ?>
<li><span class="name"><a href="index.php"><?php echo $text_home; ?></a></span></li>
<?php endif; ?>

    <!-- Main menu -->
    <?php if ($categories) : ?>
        <?php foreach ($categories as $category) : ?>

            <li>
                <span class="name">
                    <?php if ($category['children']) : ?><span class="expander">-</span><?php endif; ?>
                    <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
                </span>
                <?php if ($category['children']) : ?>
                <ul>
                    <?php foreach ($category['children'] as $child): ?>

                    <?php
                    $loader->model('custom/general');
                    $model_category_id = $registry->get('model_custom_general');
                    $subcategory_id = $model_category_id->getSubCategoryId($child['href']);

                    $loader->model('catalog/category');
                    $model_sub = $registry->get('model_catalog_category');
                    $categories_sub_level_2 = $model_sub->getCategories($subcategory_id);
                    ?>

                    <li>
                        <span class="name">
                            <?php if ($categories_sub_level_2) : ?><span class="expander">-</span><?php endif; ?>
                            <a href="<?php echo $child['href']; ?>">
                                <span class="icon m-icon-dress"></span><?php echo $child['name']; ?>
                            </a>
                        </span>
                        <?php if ($categories_sub_level_2) : ?>
                            <ul>
                                <?php
                                    $loader->model('custom/general');
                                    $model_category_level_2_id = $registry->get('model_custom_general');
                                    foreach ($categories_sub_level_2 as $category_sub_level_2) :
                                    $category_sub_level_2_link = $model_category_level_2_id->getCategoryUrl($category_sub_level_2['category_id']);

                                    $link = (is_numeric($category_sub_level_2_link) ? $child['href'].'_'.$category_sub_level_2_link : HTTP_SERVER.$category_sub_level_2_link);
                                ?>
                                <li><span class="name"><a href="<?php echo $link; ?>"><?php echo $category_sub_level_2['name']; ?></a></span></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>




                </ul>
                <?php endif; ?>

            </li>

        <?php endforeach; ?>
    <?php endif; ?>
    <!-- end Main menu -->

    <!--pages link in top menu-->
<?php if (!isset($customisation_general["pages_status"][$store_id]) || $customisation_general["pages_status"][$store_id] != 0 ) :  ?>
   <li>
        <span class="name">
            <span class="expander">-</span>
            <a href="<?php if ($customisation_general["pages_link_url"][$store_id] !== '' ) {echo $customisation_general["pages_link_url"][$store_id];} else {echo '#';} ?>">
                <?php
                    if (isset($customisation_general[$lang]["pages_link_title"][$store_id]) && $customisation_general[$lang]["pages_link_title"][$store_id] !== '' ) {
                        echo $customisation_general[$lang]["pages_link_title"][$store_id];
                    } else {echo 'pages';}
                ?>
            </a>
        </span>

        <ul>
            <?php
            $loader->model('catalog/information');
            $model = $registry->get('model_catalog_information');
            $informations = $model->getInformations();

            if (isset($informations)) :
            foreach ($informations as $information) :
            global $url;
            $information_href = $url->link('information/information', 'information_id=' . $information['information_id']);

            if (isset($customisation_general["additional_page_status"])):
            ?>

            <?php

            foreach ($customisation_general["additional_page_status"] as $information_id => $information_status) :
            if ($information_id == $information['information_id'] && $information_status[$store_id] != 0) :
            ?>
            <li><span class="name"><a class="subcategory_item" href="<?php echo $information_href; ?>"><?php echo $information['title']; ?></a></span></li>
            <?php
                                                     endif;
                                                 endforeach;
                                    ?>
            <?php
                                             endif;
                                         endforeach;
                                    endif;
                                    ?>

            <?php if (!isset($customisation_general["additional_page_checkout_status"][$store_id]) || $customisation_general["additional_page_checkout_status"][$store_id] != 0 ) :  ?>
            <li><span class="name"><a href="<?php echo $checkout; ?>"><?php echo $text_checkout; ?></a></span></li>
            <?php endif; ?>
            <?php if (!isset($customisation_general["additional_page_account_status"][$store_id]) || $customisation_general["additional_page_account_status"][$store_id] != 0 ) :  ?>
            <li><span class="name"><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></span></li>
            <?php endif; ?>

        </ul>
   </li>
<?php endif; ?>
<!--end pages link in top menu-->






<!--blog link in top menu-->
    <?php if (isset($customisation_general["blog_link_status"][$store_id]) && $customisation_general["blog_link_status"][$store_id] == 1) :  ?>
    <li class="topmenu_blog_link">
         <span class="name">
             <a href="<?php if ($customisation_general["blog_link_url"][$store_id] !== '' ) {echo $customisation_general["blog_link_url"][$store_id];} else {echo 'index.php?route=blog/post';} ?>">
                 <?php
                     if (isset($customisation_general[$lang]["blog_link_title"][$store_id]) && $customisation_general[$lang]["blog_link_title"][$store_id] != '' ) :
                         echo $customisation_general[$lang]["blog_link_title"][$store_id];
                     endif;
                 ?>
             </a>
         </span>
    </li>
    <?php endif; ?>
    <!--end blog link in top menu-->


    <!--contact link in top menu-->
    <?php if (!isset($customisation_general["contact_map_status"][$store_id]) || $customisation_general["contact_map_status"][$store_id] != 0 ) :  ?>
    <li class="topmenu_contact_link">
        <span class="name">
        <?php $contact_link = 'index.php?route=information/contact'; ?>
            <a href="<?php echo $contact_link; ?>">
                <?php
                     if (isset($customisation_general[$lang]["contact_map_title"][$store_id]) && $customisation_general[$lang]["contact_map_title"][$store_id] !== '' ) {
                         echo $customisation_general[$lang]["contact_map_title"][$store_id];
                      } else {echo 'contact';}
                ?>
            </a>
        </span>
    </li>
    <?php endif; ?>
    <!--end contact link in top menu-->


    <!-- custom item in top menu-->
    <?php if (isset($customisation_general[$lang]["customitem_item_title1"][$store_id]) && $customisation_general[$lang]["customitem_item_title1"][$store_id] !== '' ): ?>
    <li class="topmenu_customitem_link">
          <span class="name">
              <a href="<?php if ($customisation_general["customitem_item_url1"][$store_id] !== '' ) {echo $customisation_general["customitem_item_url1"][$store_id];} else {echo 'index.php';} ?>">
              <?php echo $customisation_general[$lang]["customitem_item_title1"][$store_id]; ?>
              </a>
          </span>
      </li>
    <?php endif; ?>
    <!-- end custom item -->





</ul>
</nav>
</div>
<!-- //end Off Canvas Menu -->


<!--end mobile menu-->

<!--common wrappers-->
<div id="outer">
    <div id="outer-canvas">

    <header id="<?php echo ((!isset($customisation_general["header_type"][$store_id]) || $customisation_general["header_type"][$store_id] != 2) ? 'header_type1' : 'header_type2'); ?>" class="<?php echo ((!isset($customisation_general["service_buttons_type"][$store_id]) || $customisation_general["service_buttons_type"][$store_id] != 2) ? 'service_buttons_type1' : 'service_buttons_type2'); ?>">
        <!-- Search -->
        <?php echo $search; ?>
        <!-- //end Search -->

        <!--top line: news, cart, search-->
    <?php if (($loader->controller('common/content_blog')) || (!isset($customisation_general["search_block"][$store_id]) || $customisation_general["search_block"][$store_id] != 0) || (!isset($customisation_general["cart_button"][$store_id]) || $customisation_general["cart_button"][$store_id] != 0)) : ?>
    <div id="newsLine">
            <div class="container">
                <div class="row">
                    <?php echo $loader->controller('common/content_blog'); ?>

                    <div class="col-xs-5 col-sm-3 col-md-2 top-link pull-right">
                        <?php if (!isset($customisation_general["search_block"][$store_id]) || $customisation_general["search_block"][$store_id] != 0) : ?>
                        <div class="btn-outer btn-search">
                            <a class="btn btn-xs btn-default" data-toggle="dropdown"><span class="icon icon-lg flaticon-zoom45"></span></a>
                        </div>
                        <?php endif; ?>
                        <?php if (!isset($customisation_general["cart_button"][$store_id]) || $customisation_general["cart_button"][$store_id] != 0) : ?>
                        <?php echo $cart; ?>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    <?php endif; ?>
    <!--end top line: news, cart, search-->



        <!-- Back to top -->
        <?php if (!isset($customisation_general["back_top_status"][$store_id]) || $customisation_general["back_top_status"][$store_id] != 0) : ?>
        <div class="back-to-top">
            <?php if (!isset($customisation_general["back_top_arrow"][$store_id]) || $customisation_general["back_top_arrow"][$store_id] == '') { ?>
                <span class="arrow-up">
                    <img src="image/catalog/icon-scroll-arrow.png" width="35" height="19" alt="">
                </span>
            <?php } elseif ($customisation_general["back_top_arrow"][$store_id] != '') { ?>
                <span class="arrow-up">
                    <img src="image/catalog/<?php echo $customisation_general['back_top_arrow'][$store_id]; ?>" alt="">
                </span>
            <?php } ?>

            <?php if (!isset($customisation_general["back_top_mouse"][$store_id]) || $customisation_general["back_top_mouse"][$store_id] == '') { ?>
                 <img src="image/catalog/icon-scroll-mouse.png" width="35" height="60" alt="">
            <?php } elseif ($customisation_general["back_top_mouse"][$store_id] != '') { ?>
                 <img src="image/catalog/<?php echo $customisation_general['back_top_mouse'][$store_id]; ?>" alt="">
            <?php } ?>
        </div>
        <?php endif; ?>
        <!-- //end Back to top -->

        <section class="navbar">
        <h3 style="display:none">top menu</h3>
        <div class="background">
        <div class="container">
            <div class="row">
                <div class="header-left col-sm-5 col-md-8">
                    <div class="row">
                        <div class="navbar-welcome col-md-6 compact-hidden hidden-sm hidden-xs">
                            <?php if (!isset($customisation_general["phone_number"][$store_id]) || $customisation_general["phone_number"][$store_id] != 0) : ?>
                            <a href="<?php echo $contact; ?>"><i class="fa fa-phone"></i></a><?php echo $telephone; ?>&nbsp;
                            <?php endif; ?>
                            <?php echo (isset($customisation_general[$lang]["welcome_message"][$store_id]) && is_string($customisation_general[$lang]["welcome_message"][$store_id]) ? html_entity_decode($customisation_general[$lang]["welcome_message"][$store_id], ENT_QUOTES, 'UTF-8') : 'Default welcome msg!'); ?>
                        </div>

                        <!-- Mobile menu Button-->
                        <div class="col-xs-2 visible-xs">
                            <div class="expand-nav  compact-hidden">
                                <a href="#off-canvas-menu" id="off-canvas-menu-toggle"><span class="icon icon-xl flaticon-menu29"></span></a>
                            </div>
                        </div>
                        <!-- //end Mobile menu Button -->

                        <!-- Logo -->
                        <?php if ($logo) { ?>
                        <div class="navbar-logo col-xs-10 col-sm-10 col-md-6 text-center">
                            <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a>
                        </div>
                        <?php } else { ?>
                        <div class="navbar-logo col-xs-10 col-sm-10 col-md-6 text-center">
                            <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
                        </div>
                        <?php } ?>
                        <!-- //end Logo -->

                        <div class="clearfix visible-xs"></div>

                        <!-- Secondary menu -->
                        <?php if (!isset($customisation_general["cart_button"][$store_id]) || $customisation_general["cart_button"][$store_id] != 0) : ?>
                        <?php echo $loader->controller('common/cart_mobile'); ?>
                        <?php endif; ?>


                    </div>
                </div>
                <div class="navbar-secondary-menu col-sm-7 col-md-4 compact-hidden">
                    <?php if (!isset($customisation_general["header_service_buttons"][$store_id]) || $customisation_general["header_service_buttons"][$store_id] != 0) : ?>
                    <div class="btn-group service_buttons">
                        <a title="<?php echo $text_account; ?>" class="btn btn-xs btn-default dropdown-toggle"  data-toggle="dropdown">
                            <span class="icon icon-lg flaticon-business137"></span>
                            <span class="drop-title"><?php echo $text_account; ?></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a onClick="location.href='<?php echo $wishlist; ?>'" href="<?php echo $wishlist; ?>" id="wishlist-total" title="<?php echo $text_wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
                            <li><a onClick="location.href='<?php echo $shopping_cart; ?>'" href="<?php echo $shopping_cart; ?>" title="<?php echo $text_shopping_cart; ?>"><?php echo $text_shopping_cart; ?></a></li>
                            <li><a onClick="location.href='<?php echo $checkout; ?>'" href="<?php echo $checkout; ?>" title="<?php echo $text_checkout; ?>"><?php echo $text_checkout; ?></a></li>

                            <li class="divider"></li>
                            <?php if ($logged) { ?>
                                <li><a onClick="location.href='<?php echo $account; ?>'" href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
                                <li><a onClick="location.href='<?php echo $order; ?>'" href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
                                <li><a onClick="location.href='<?php echo $transaction; ?>'" href="<?php echo $transaction; ?>"><?php echo $text_transaction; ?></a></li>
                                <li><a onClick="location.href='<?php echo $download; ?>'" href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li>
                                <li><a onClick="location.href='<?php echo $logout; ?>'" href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
                            <?php } else { ?>
                                <li><a onClick="location.href='<?php echo $register; ?>'" href="<?php echo $register; ?>"><?php echo $text_register; ?></a></li>
                                <li><a onClick="location.href='<?php echo $login; ?>'" href="<?php echo $login; ?>"><?php echo $text_login; ?></a></li>
                            <?php } ?>

                        </ul>
                    </div>
                    <?php endif; ?>

                    <?php echo $language; ?>

                    <?php echo $currency; ?>
                </div>
            </div>
        </div>

        <!-- desktop Main menu -->
        <?php
        $menu_type_items = isset($customisation_general["top_menu_type"][$store_id]) ? $customisation_general["top_menu_type"][$store_id] : 1;
         $script = 1;

        if ($categories) :
        ?>

        <div class="navbar-main-menu-outer hidden-xs">
                <div class="container">
                    <dl class="navbar-main-menu">
                        <?php if (!isset($customisation_general["homebutton"][$store_id]) || $customisation_general["homebutton"] != 0 ) : ?>
                        <dt class="item"><a href="index.php" class="btn-main"><span class="icon icon-xl flaticon-home113"></span></a></dt>
                        <dd></dd>
                        <?php endif; ?>



                        <?php foreach ($categories as $category) : ?>

                        <?php
                            $model_category_id = $registry->get('model_custom_general');
                            $category_top_level = $model_category_id->getCategoryOptionById($category['href']);

                            $new_p_slider = $this->registry->get('model_custom_general')->getCategoryOptionHref($category['href'],'ctop');

                            $menu_type_db = $this->registry->get('model_custom_general')->getCategoryOptionHref($category['href'],'mtop');

                            $menu_type = isset($menu_type_db) ? $menu_type_db : 0;
                        ?>



                        <?php
                            if (isset($menu_type) && $menu_type == 1) {
                            if ($script == 1) :
                        ?>
                            <script src="catalog/view/theme/<?php echo $config->get('config_template'); ?>/js/simple_menu.js" type="text/javascript"></script>
                        <?php endif; $script = 0; ?>
                        <!--simple menu-->

                        <dt class="item">
                            <ul class="sf-menu">
                                <li>
                                    <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
                                    <?php if ($category['children']) : ?>
                                    <ul>
                                        <?php foreach ($category['children'] as $children) : ?>
                                            <li><a href="<?php echo $children['href']; ?>"><?php echo $children['name']; ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </dt>
                        <dd></dd>

                        <!--end simple menu-->

                        <!--begin advanced menu-->
                        <?php } else { ?>

                        <dt class="item">
                            <a href="<?php echo $category['href']; ?>" class="btn-main <?php echo (!isset($category['menu_class']) && ($category['children'] || (isset($category_top_level['html_top']) && $category_top_level['html_top'] != '') || (isset($category_top_level['html_right']) && $category_top_level['html_right'] != '') || (isset($category_top_level['html_bottom']) && $category_top_level['html_bottom'] != '')) ? 'line' : 'no-sub'); ?>">
                                <?php echo $category['name']; ?>
                            </a>
                            <!--main category promo-->
                            <?php echo (isset($category_top_level['promo']) && $category_top_level['promo'] != '' ? html_entity_decode($category_top_level['promo'], ENT_QUOTES, 'UTF-8') : ''); ?>
                            <!--main category promo-->

                        </dt>

                        <?php if ($category['children'] || (isset($category_top_level['html_top']) && $category_top_level['html_top'] != '') || (isset($category_top_level['html_right']) && $category_top_level['html_right'] != '') || (isset($category_top_level['html_bottom']) && $category_top_level['html_bottom'] != '')) { ?>

                            <?php if (!isset($category['menu_class']) && ((!isset($customisation_general['menu_type'][$store_id]) || $customisation_general['menu_type'][$store_id] != 2) && ($category['children'] || (isset($category_top_level['html_top']) && $category_top_level['html_top'] != '') || (isset($category_top_level['html_right']) && $category_top_level['html_right'] != '') || (isset($category_top_level['html_bottom']) && $category_top_level['html_bottom'] != '')))) { ?>

                                <dd class="item-content <?php //echo (count($category['column']) > 1 || (isset($category_top_level['html_top']) && $category_top_level['html_top'] != '') || (isset($category_top_level['html_right']) && $category_top_level['html_right'] != '') || (isset($category_top_level['html_bottom']) && $category_top_level['html_bottom'] != '') ? '' : 'content-small'); ?>">
                                    <div class="megamenuClose"></div>
                                    <div class="navbar-main-submenu">

                                        <!--custom blocks in dropdown for main category: top-->
                                        <?php echo ((isset($category_top_level['html_top']) && $category_top_level['html_top'] != '') ? html_entity_decode($category_top_level['html_top'], ENT_QUOTES, 'UTF-8') : ''); ?>
                                        <!--custom blocks in dropdown for main category: top-->

                                        <?php if ($category['children'] || (isset($category_top_level['html_top']) && $category_top_level['html_top'] != '') || (isset($category_top_level['html_right']) && $category_top_level['html_right'] != '') || (isset($category_top_level['html_bottom']) && $category_top_level['html_bottom'] != '')) : ?>
                                        <div class="wrapper-border">
                                            <div class="row">

                                                <!-- caregories -->
                                                <div class="<?php echo (isset($new_p_slider) && $new_p_slider == 1 && (isset($category_top_level['html_right']) && $category_top_level['html_right'] != '') ? 'col-xs-6 col-sm-6 col-md-7 col-lg-7' : 'col-sm-12 col-md-9'); ?>">
                                                    <div class="row <?php echo (count($category['column'] > 1) ? 'col-divider' : ''); ?>">

                                                        <?php for ($i = 0; $i < count($category['children']);) : ?>

                                                        <?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
                                                        <?php for (; $i < $j; $i++) : ?>
                                                        <?php if (isset($category['children'][$i])) : ?>

                                                        <?php
                                                            $column = $category["column"];
                                                            $cols = floor(12/$column);
                                                            $cols_1 = $cols + 1;
                                                            $cols_2 = $cols + 2;

                                                        $category_sub_level = $model_category_id->getSubCategoryOptionById($category['children'][$i]['href']);

                                                        ?>

                                                        <div class="<?php echo ((isset($category_top_level['html_right']) && $category_top_level['html_right'] != '')  ? 'col-xs-'.$cols_2.' col-md-'.$cols_1.' col-lg-'.$cols : 'col-xs-'.$cols_2.' col-md-'.$cols_1.' col-lg-'.$cols); ?> <?php echo (isset($customisation_general["category_divider"][$store_id]) && $customisation_general["category_divider"][$store_id] == 0 ? 'border_none' : ''); ?>">
                                                            <div class="submenu-block">
                                                                <!--custom icon for subcategory-->
                                                                <?php echo (isset($category_sub_level['icon']) && $category_sub_level['icon'] != '' ? '<span class="icon">'.html_entity_decode($category_sub_level['icon'], ENT_QUOTES, 'UTF-8').'</span>' : ''); ?>
                                                                <!--custom icon for subcategory-->


                                                                <a class="name" href="<?php echo $category['children'][$i]['href']; ?>"><?php echo $category['children'][$i]['name']; ?></a>

                                                                <!--custom promo for subcategory-->
                                                                <?php echo (isset($category_sub_level['promo']) && $category_sub_level['promo'] != '' ? html_entity_decode($category_sub_level['promo'], ENT_QUOTES, 'UTF-8') : ''); ?>
                                                                <!--custom promo for subcategory-->

                                                                <?php
                                                                $subcategory_id = $model_category_id->getSubCategoryId($category['children'][$i]['href']);

                                                                $loader->model('catalog/category');
                                                                $model = $registry->get('model_catalog_category');
                                                                $categories_sub_level_2 = $model->getCategories($subcategory_id);

                                                                if ($categories_sub_level_2) :
                                                                ?>

                                                                <ul class="<?php echo (isset($category_sub_level['icon']) && $category_sub_level['icon'] != '' ? '' : 'no_margin_left'); ?>">
                                                                    <?php
                                                                    $loader->model('custom/general');
                                                                    $model_category_level_2_id = $registry->get('model_custom_general');

                                                                    foreach ($categories_sub_level_2 as $category_sub_level_2) :

                                                                    $category_sub_level_2_link = $model_category_level_2_id->getCategoryUrl($category_sub_level_2['category_id']);


                                                                    $link = (is_numeric($category_sub_level_2_link) ? $category['children'][$i]['href'].'_'.$category_sub_level_2_link : HTTP_SERVER.$category_sub_level_2_link);



                                                                    ?>
                                                                    <li><a href="<?php echo $link; ?>"><?php echo $category_sub_level_2['name']; ?></a></li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>

                                                        <?php endif; ?>
                                                        <?php endfor; ?>
                                                        <?php endfor; ?>


                                                    </div>
                                                </div>
                                                <!-- //end caregories -->

                                            <!--if isset slider and right block-->
                                            <?php if (isset($new_p_slider) && $new_p_slider == 1) : ?>
                                            <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5">
                                                <div class="row">
                                            <?php endif; ?>

                                            <?php if (isset($new_p_slider) && $new_p_slider == 1) : ?>
                                            <!--slider with latest products from main category-->
                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                <?php
                                                $title = isset($customisation_translation[$lang]["dd_title"][$store_id]) && $customisation_translation[$lang]["dd_title"][$store_id] != '' ? $customisation_translation[$lang]["dd_title"][$store_id] : 'new products';
                                                $this->registry->get('model_custom_general')->renderProductsList($title,$category['href']);

                                                ?>
                                            </div>

                                            <!--end slider with latest products from main category-->
                                            <?php endif; ?>

                                            <!-- html block right -->
                                                <?php if (isset($category_top_level['html_right']) && $category_top_level['html_right'] != '') : ?>
                                                    <div class="<?php echo (isset($new_p_slider) && $new_p_slider == 1 ? 'col-xs-6 col-sm-6 col-md-6 col-lg-6' : 'col-md-3 hidden-sm hidden-xs'); ?> html_block_category_right">
                                                        <?php echo html_entity_decode($category_top_level['html_right'], ENT_QUOTES, 'UTF-8'); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <!-- //end html block right-->

                                                    <?php if (isset($new_p_slider) && $new_p_slider == 1) : ?>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                            <!--if isset slider and right block-->


                                        </div>
                                        </div>
                                        <?php endif; ?>

                                        <!--custom blocks in dropdown for main category: bottom-->
                                        <?php echo (isset($category_top_level['html_bottom']) && $category_top_level['html_bottom'] != '' ? html_entity_decode($category_top_level['html_bottom'], ENT_QUOTES, 'UTF-8') : ''); ?>
                                        <!--custom blocks in dropdown for main category: bottom-->
                                    </div>
                                </dd>


                                <?php } else { ?>
                                    <dd class="item-content content-small">
                                        <div class="megamenuClose"></div>
                                        <ul class="row-list">

                                            <?php for ($i = 0; $i < count($category['children']);) : ?>

                                            <?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
                                            <?php for (; $i < $j; $i++) : ?>
                                            <?php if (isset($category['children'][$i])) : ?>

                                            <li>
                                                <a href="<?php echo $category['children'][$i]['href']; ?>" class="btn-main <?php echo ($category['children'] ? 'line' : 'no-sub'); ?>">
                                                    <?php echo $category['children'][$i]['name']; ?>
                                                </a>
                                            </li>

                                            <?php endif; ?>
                                            <?php endfor; ?>
                                            <?php endfor; ?>


                                        </ul>
                                    </dd>
                                <?php }  ?>


                            <?php } else { ?>
                                <dd></dd>
                            <?php } ?>

                <?php }  ?>
                <!--end advanced menu-->



                <?php endforeach; ?>


                        <!--pages-->
                        <?php if (!isset($customisation_general["pages_status"][$store_id]) || $customisation_general["pages_status"][$store_id] != 0 ) :

                        if ($script == 1) :
        ?>
                <script src="catalog/view/theme/<?php echo $config->get('config_template'); ?>/js/simple_menu.js" type="text/javascript"></script>

                <?php
                 endif;

                if ($menu_type_items == 2) { ?>
                    <dt class="item">
                    <ul class="sf-menu">
                        <li>
                            <a href="<?php if ($customisation_general["pages_link_url"][$store_id] !== '' ) {echo $customisation_general["pages_link_url"][$store_id];} else {echo '#';} ?>">
                            <?php
                                     if (isset($customisation_general[$lang]["pages_link_title"][$store_id]) && $customisation_general[$lang]["pages_link_title"][$store_id] !== '' ) {
                                         echo $customisation_general[$lang]["pages_link_title"][$store_id];
                                     } else {echo 'pages';}
                                ?>
                            </a>
                            <ul>
                                <?php
                            $loader->model('catalog/information');
                                $model = $registry->get('model_catalog_information');
                                $informations = $model->getInformations();

                                if (isset($informations)) :
                                foreach ($informations as $information) :
                                global $url;
                                $information_href = $url->link('information/information', 'information_id=' . $information['information_id']);

                                if (isset($customisation_general["additional_page_status"])):
                                ?>

                                <?php

                                                 foreach ($customisation_general["additional_page_status"] as $information_id => $information_status) :
                                if ($information_id == $information['information_id'] && $information_status[$store_id] != 0) :
                                ?>
                                <li><a class="subcategory_item" href="<?php echo $information_href; ?>"><?php echo $information['title']; ?></a></li>
                                <?php
                                                     endif;
                                                 endforeach;
                                    ?>
                                <?php
                                             endif;
                                         endforeach;
                                    endif;
                                    ?>

                                <?php if (!isset($customisation_general["additional_page_checkout_status"][$store_id]) || $customisation_general["additional_page_checkout_status"][$store_id] != 0 ) :  ?>
                                <li><a href="<?php echo $checkout; ?>"><?php echo $text_checkout; ?></a></li>
                                <?php endif; ?>
                                <?php if (!isset($customisation_general["additional_page_account_status"][$store_id]) || $customisation_general["additional_page_account_status"][$store_id] != 0 ) :  ?>
                                <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
                                <?php endif; ?>

                            </ul>


                    </li>
                    </ul>
                    </dt>
                    <dd></dd>

                <?php } else { ?>

                    <dt class="item">
                        <a class="btn-main" href="<?php if ($customisation_general["pages_link_url"][$store_id] !== '' ) {echo $customisation_general["pages_link_url"][$store_id];} else {echo '#';} ?>">
                        <?php
                                     if (isset($customisation_general[$lang]["pages_link_title"][$store_id]) && $customisation_general[$lang]["pages_link_title"][$store_id] !== '' ) {
                                         echo $customisation_general[$lang]["pages_link_title"][$store_id];
                                     } else {echo 'pages';}
                                ?>
                        </a>
                    </dt>
                    <dd class="item-content content-small">
                        <div class="megamenuClose"></div>

                        <ul class="row-list">
                            <?php
                                $loader->model('catalog/information');
                                $model = $registry->get('model_catalog_information');
                                $informations = $model->getInformations();

                                if (isset($informations)) :
                                foreach ($informations as $information) :
                                global $url;
                                $information_href = $url->link('information/information', 'information_id=' . $information['information_id']);

                                if (isset($customisation_general["additional_page_status"])):
                            ?>

                            <?php

                                                 foreach ($customisation_general["additional_page_status"] as $information_id => $information_status) :
                            if ($information_id == $information['information_id'] && $information_status[$store_id] != 0) :
                            ?>
                            <li><a class="subcategory_item" href="<?php echo $information_href; ?>"><?php echo $information['title']; ?></a></li>
                            <?php
                                                     endif;
                                                 endforeach;
                                    ?>
                            <?php
                                             endif;
                                         endforeach;
                                    endif;
                                    ?>

                            <?php if (!isset($customisation_general["additional_page_checkout_status"][$store_id]) || $customisation_general["additional_page_checkout_status"][$store_id] != 0 ) :  ?>
                            <li><a href="<?php echo $checkout; ?>"><?php echo $text_checkout; ?></a></li>
                            <?php endif; ?>
                            <?php if (!isset($customisation_general["additional_page_account_status"][$store_id]) || $customisation_general["additional_page_account_status"][$store_id] != 0 ) :  ?>
                            <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
                            <?php endif; ?>

                        </ul>

                    </dd>

                <?php } ?>




                        <?php endif; ?>
                        <!--//pages-->

                        <!-- BLOG LINK -->
                        <?php if (isset($customisation_general["blog_link_status"][$store_id]) && $customisation_general["blog_link_status"][$store_id] == 1) :  ?>
                        <dt class="item">
                            <a class="btn-main" href="<?php if ($customisation_general["blog_link_url"][$store_id] !== '' ) {echo $customisation_general["blog_link_url"][$store_id];} else {echo 'index.php?route=blog/post';} ?>">
                            <?php
                                        if (isset($customisation_general[$lang]["blog_link_title"][$store_id]) && $customisation_general[$lang]["blog_link_title"][$store_id] != '' ) {
                                            echo $customisation_general[$lang]["blog_link_title"][$store_id];
                                        }
                                    ?>
                            </a>
                        </dt>
                        <dd></dd>

                        <?php endif; ?>
                        <!-- //BLOG LINK -->

                        <!--contact link in top menu-->
                        <?php if (!isset($customisation_general["contact_map_status"][$store_id]) || $customisation_general["contact_map_status"][$store_id] != 0 ) :  ?>
                        <dt class="item item-contact-desktop">
                            <?php $contact_link = 'index.php?route=information/contact'; ?>
                            <a class="btn-main" href="<?php echo $contact_link; ?>">
                                <?php
                                        if (isset($customisation_general[$lang]["contact_map_title"][$store_id]) && $customisation_general[$lang]["contact_map_title"][$store_id] !== '' ) {
                                           echo $customisation_general[$lang]["contact_map_title"][$store_id];
                                        } else {echo 'contact';}
                                    ?>
                            </a>
                        </dt>
                        <dd></dd>
                        <?php endif; ?>
                        <!--end contact link in top menu-->


                        <!-- custom item -->
                        <?php if (isset($customisation_general[$lang]["customitem_item_title1"][$store_id]) && $customisation_general[$lang]["customitem_item_title1"][$store_id] !== '' ): ?>
                        <dt class="item">
                            <a class="btn-main" href="<?php if ($customisation_general["customitem_item_url1"][$store_id] !== '' ) {echo $customisation_general["customitem_item_url1"][$store_id];} else {echo 'index.php';} ?>">
                            <?php echo $customisation_general[$lang]["customitem_item_title1"][$store_id]; ?>
                            </a>
                        </dt>
                        <dd></dd>
                        <?php endif; ?>
                        <!-- end custom item -->



                    </dl>
                </div>
            </div>

        <?php endif; ?>
        <!-- //end desktop Main menu -->

        </div>
        </section>

        <!-- Navbar height -->
        <div class="navbar-height"></div>
        <!-- Navbar height -->



    </header>
    <div id="notification"></div>


