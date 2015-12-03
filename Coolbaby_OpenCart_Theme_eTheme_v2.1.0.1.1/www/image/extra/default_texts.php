ALTER TABLE `oc_product_description` ADD short_description TEXT COLLATE utf8_bin NOT NULL  AFTER `name`;
ALTER TABLE `oc_product` ADD slick_status tinyint(1) NOT NULL DEFAULT '1' AFTER `model`;
ALTER TABLE `oc_product` ADD product_page tinyint(1) NOT NULL DEFAULT '1' AFTER `model`;
ALTER TABLE `oc_product` ADD fimage TEXT COLLATE utf8_bin NOT NULL AFTER `image`;
ALTER TABLE `oc_product` ADD featured tinyint(1) NOT NULL DEFAULT '0' AFTER `image`;

UPDATE `oc_product_description` SET  `video1` =  'https://www.youtube.com/watch?v=jaWvdJBVBSc';
UPDATE `oc_product` SET  `product_page_type` =  0 WHERE  `PRODUCT_id` = 107;

UPDATE `oc_product_description` SET  `short_description` =  'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus.';

ALTER TABLE `oc_category` ADD ctop tinyint(1) NOT NULL AFTER `image`;
ALTER TABLE `oc_category` ADD mtop tinyint(1) NOT NULL AFTER `image`;

<!--megamenu--------------------------------------------blocks-->


<!--Men, Electronics top custom block-->
<ul class="exclusive top">
    <li><span class="icon flaticon-gift1"></span><a href="index.php">Gifts exclusive</a></li>
    <li><span class="icon flaticon-coin11"></span><a href="index.php">Offers</a></li>
</ul>

<!--Men, Electronics bottom custom block-->
<ul class="exclusive bottom">
    <li><span class="icon flaticon-like"></span> <a href="index.php">SPECIAL OFFER</a></li>
    <li><span class="icon flaticon-outlined3"></span> <a href="index.php">UP TO 50% OFF DISCOUNTS</a></li>
</ul>

<!--Men right custom block-->
<div class="img-fullheight"><img class="img-responsive" src="image/catalog/blocks/menu-img-right-men.png" width="265" height="" alt="789"> </div>

<!--woman right custom block-->
<div class="img-fullheight"><img class="img-responsive" src="image/catalog/blocks/menu-img-right-woman.png" width="282" height="789" alt=""> </div>

<!--woman top custom block-->
<div>Maecenas eu enim in lorem scelerisq ue auctor. Ut non erat. Suspendisse tesque sagittis. Morbi quam. Nullam
    ac nisi non eros gravida venenatis. Ut eu dictum justo urna et mi. Integer dictum est vitae sem. </div>

<!--men bottom custom block-->
<div class="bottom_custom_block">
    <div class="col-xs-3"><img src="image/catalog/blocks/logo-light.png" width="218" height="63" class="img-responsive" alt=""></div>
    <div class="col-xs-9">
        <h5>ABOUT US</h5>
        <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas eu
            enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate
            nibh egestas orci. Aliquam lectus. Morbi eget dolor ullamcorper massa pellentesque sagittis. Morbi
            sit amet quam labore diam nonumy. Nullam ac nisi non eros gravida venenatis. Ut eu dictum justo urna
            et mi. Integer dictum est vitae sem.</p>
    </div>
</div>

<!--woman right custom block-->
<a href="index.php"><img src="image/catalog/blocks/banner.jpg" width="228" height="243" class="img-responsive" alt=""></a>


<!--images to subcategories-->
<img src="image/catalog/blocks/subcategories_icons/icon-category1.png" alt="">

<!--promo text for main category-->
<div class="label label-hot">HOT</div>
<div class="label label-newl">NEW</div>

<!--promo text for subcategory-->
<span class="label label-cool">-15%</span>


<!--end --------------------------------------megamenu-->

&copy; 2015 <a href="index.php">Coolbaby</a>. All Rights Reserved.

<!--footer payment icons block-->
<li><img src="image/catalog/blocks/icon-payment-01.png" width="36" height="22" alt=""></li>
<li><img src="image/catalog/blocks/icon-payment-02.png" width="36" height="22" alt=""></li>
<li><img src="image/catalog/blocks/icon-payment-03.png" width="36" height="22" alt=""></li>
<li><img src="image/catalog/blocks/icon-payment-04.png" width="36" height="22" alt=""></li>
<li><img src="image/catalog/blocks/icon-payment-05.png" width="36" height="22" alt=""></li>

<!--footer social  block-->
<li><a href="index.php"><span class="icon flaticon-facebook12"></span></a></li>
<li><a href="index.php"><span class="icon flaticon-twitter20"></span></a></li>
<li><a href="index.php"><span class="icon flaticon-google10"></span></a></li>
<li><a href="index.php"><span class="icon flaticon-pinterest9"></span></a></li>
<li><a href="index.php"><span class="icon flaticon-linkedin11"></span></a></li>
<li><a href="index.php"><span class="icon flaticon-youtube18"></span></a></li>
<li><a href="index.php"><span class="icon flaticon-instagram"></span></a></li>
<li><a href="index.php"><span class="icon flaticon-skype12"></span></a></li>

<!--footer custom html  block-->
<ul class="menu menu-icon">
    <li><span class="icon flaticon-home113"></span>7563 St. Vincent Place, Glasgow</li>
    <li><span class="icon flaticon-phone163"></span>321321321, 321321321</li>
    <li><span class="icon icon-xs flaticon-new78"></span><a href="mailto:info@mydomain.com">info@mydomain.com</a></li>
    <li><span class="icon flaticon-skype12"></span><a href="index.php">shop.test</a></li>
</ul>

<!--Default theme Revolution Top Slider-->
            <ul>
                <li id="slide1" data-transition="zoomout" data-slotamount="7" data-masterspeed="500" data-title="First Slide" data-link="index.php">
                    <img src="image/catalog/dummy.png" width="10" height="10" alt="slide1" data-lazyload="image/catalog/sliders/slide1.png">
                    <div class="tp-caption fadein fadeout  rs-parallaxlevel-1"
                         data-x="500"
                         data-y="0"
                         data-speed="1000"
                         data-start="500"
                         data-easing="Power3.easeInOut"
                         data-elementdelay="0.1"
                         data-endelementdelay="0.1"
                         style="z-index: 4;">
                        <img src="image/catalog/sliders/slide1-1.png" width="271" height="504" alt="">
                    </div>
                    <div class="tp-caption lfl fadeout  rs-parallaxlevel-2"
                         data-x="200"
                         data-y="0"
                         data-speed="1000"
                         data-start="1000"
                         data-easing="Power3.easeInOut"
                         data-elementdelay="0.1"
                         data-endelementdelay="0.1"
                         style="z-index: 4;">
                        <img src="image/catalog/sliders/slide1-2.png" width="344" height="504" alt="">
                    </div>
                    <div class="tp-caption lfr fadeout  rs-parallaxlevel-3"
                         data-x="700"
                         data-y="0"
                         data-speed="1200"
                         data-start="1600"
                         data-easing="Power3.easeInOut"
                         data-elementdelay="0.1"
                         data-endelementdelay="0.1"
                         style="z-index: 4;">
                        <img src="image/catalog/sliders/slide1-3.png" width="317" height="504" alt="">
                    </div>
                    <div class="tp-caption text0 fadeout"
                         data-x="1050"
                         data-y="140"
                         data-speed="800"
                         data-start="2500"
                         data-easing="Power3.easeInOut"
                         data-splitout="none"
                         data-elementdelay="0.1"
                         data-endelementdelay="0.1"
                         data-endspeed="300"
                         style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;"> &#8220;
                    </div>
                    <div class="tp-caption text1 fadeout"
                         data-x="1080"
                         data-y="150"
                         data-speed="800"
                         data-start="3000"
                         data-easing="Power3.easeInOut"
                         data-splitout="none"
                         data-elementdelay="0.1"
                         data-endelementdelay="0.1"
                         data-endspeed="300"
                         style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;">Clothes make<br>
                        the man.
                    </div>
                    <div class="tp-caption text2 fadeout"
                         data-x="1080"
                         data-y="255"
                         data-speed="500"
                         data-start="3500"
                         data-easing="Power3.easeInOut"
                         data-splitout="none"
                         data-elementdelay="0.1"
                         data-endelementdelay="0.1"
                         data-endspeed="300"
                         style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">Naked people have
                        little<br>
                        or no influenceon society.
                    </div>
                    <div class="tp-caption text3 fadeout"
                         data-x="1080"
                         data-y="305"
                         data-speed="1000"
                         data-start="4000"
                         data-easing="Power3.easeInOut"
                         data-splitin="none"
                         data-splitout="none"
                         data-elementdelay="0.1"
                         data-endelementdelay="0.1"
                         data-endspeed="300"
                         style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;">Mark Twain </div>
                </li>
                <li id="slide2" data-transition="zoomout" data-slotamount="7" data-masterspeed="500" data-title="Second Slide" data-link="index.php">
                    <img src="image/catalog/dummy.png" width="10" height="10" alt="slide2" data-lazyload="image/catalog/sliders/slide2.jpg">
                    <div class="tp-caption fadein fadeout  rs-parallaxlevel-1"
                         data-x="750"
                         data-y="0"
                         data-speed="1000"
                         data-start="500"
                         data-easing="Power3.easeInOut"
                         data-elementdelay="0.1"
                         data-endelementdelay="0.1"
                         style="z-index: 4;">
                        <img src="image/catalog/sliders/slide2.gif" width="421" height="504" alt="">
                    </div>
                    <div class="tp-caption text0 fadeout"
                         data-x="380"
                         data-y="210"
                         data-speed="800"
                         data-start="1000"
                         data-easing="Power3.easeInOut"
                         data-splitout="none"
                         data-elementdelay="0.1"
                         data-endelementdelay="0.1"
                         data-endspeed="300"
                         style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;"> &#8220;
                    </div>
                    <div class="tp-caption text1 fadeout"
                         data-x="410"
                         data-y="220"
                         data-speed="800"
                         data-start="1000"
                         data-easing="Power3.easeInOut"
                         data-splitout="none"
                         data-elementdelay="0.1"
                         data-endelementdelay="0.1"
                         data-endspeed="300"
                         style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;">The most
                        beautiful<br>
                        clothes
                    </div>
                    <div class="tp-caption text2 fadeout"
                         data-x="410"
                         data-y="325"
                         data-speed="500"
                         data-start="1500"
                         data-easing="Power3.easeInOut"
                         data-splitout="none"
                         data-elementdelay="0.1"
                         data-endelementdelay="0.1"
                         data-endspeed="300"
                         style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">that can dress a
                        woman are<br>
                        the arms of the man she loves.
                    </div>
                    <div class="tp-caption text3 fadeout"
                         data-x="410"
                         data-y="375"
                         data-speed="1000"
                         data-start="2000"
                         data-easing="Power3.easeInOut"
                         data-splitin="none"
                         data-splitout="none"
                         data-elementdelay="0.1"
                         data-endelementdelay="0.1"
                         data-endspeed="300"
                         style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;">Yves Saint-Laurent
                    </div>
                </li>
            </ul>
<!--end Default theme Revolution Top Slider-->

<!--Bio theme Revolution Top Slider-->
<ul>
    <li id="slide1" data-transition="papercut" data-masterspeed="500" data-title="First Slide">
        <img src="image/catalog/dummy.png" alt="slide1" data-lazyload="image/catalog/skin_bio/slide1.jpg">
        <div class="tp-caption text1 sfr"
             data-x="850"
             data-y="200"
             data-speed="800"
             data-start="1000"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;">Non-GMO</div>
        <div class="tp-caption text2 sfr"
             data-x="850"
             data-y="320"
             data-speed="550"
             data-start="1500"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">foods 15% extra savings</div>
        <div class="tp-caption text3 sfr"
             data-x="850"
             data-y="365"
             data-speed="550"
             data-start="1800"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 4; max-width: 50%; max-height: auto; white-space: nowrap;">Enjoy Life, Pro Bar & more</div>
        <div class="tp-caption randomrotate"
             data-x="850"
             data-y="400"
             data-speed="550"
             data-start="2000"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;"><a href="index.php" class="btn btn-cool btn-lg">SHOP NOW</a></div>
    </li>
    <li id="slide2" data-transition="papercut" data-masterspeed="500" data-title="Second Slide">
        <img src="image/catalog/dummy.png" alt="slide1" data-lazyload="image/catalog/skin_bio/slide2.jpg">
        <div class="tp-caption text1 sfl"
             data-x="150"
             data-y="100"
             data-speed="800"
             data-start="1000"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;">QUALITY</div>
        <div class="tp-caption text2 sfl"
             data-x="150"
             data-y="220"
             data-speed="550"
             data-start="1500"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">FROM SEED TO SUPPLEMENT</div>
        <div class="tp-caption text3 sfl"
             data-x="150"
             data-y="280"
             data-speed="550"
             data-start="1800"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">For more than 85 years, Standard Process has formulated supplements <br>made with whole food ingredients that fill the gaps of less-than-perfect <br>diets. Discover just how resilient your body can be when given the<br> proper nutrition.</div>
        <div class="tp-caption randomrotate"
             data-x="150"
             data-y="400"
             data-speed="550"
             data-start="2000"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;"><a href="index.php" class="btn btn-cool btn-lg">SHOP NOW</a></div>
    </li>
</ul>
<!--end Bio theme Revolution Top Slider-->

<!--Lingerie theme Revolution Top Slider-->
<ul>
    <li id="slide1" data-transition="fade" data-masterspeed="500" data-title="First Slide" data-link="listing.html">
        <img src="image/catalog/dummy.png" alt="slide1" data-lazyload="image/catalog/skin_lingerie/slide1.png">
        <div class="tp-caption fadein fadeout  rs-parallaxlevel-1"
             data-x="150"
             data-y="0"
             data-speed="1000"
             data-start="500"
             data-easing="Power3.easeInOut"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             style="z-index: 4;">
            <img src="image/catalog/skin_lingerie/slide1-1.png" alt="">
        </div>
        <div class="tp-caption fadein fadeout  rs-parallaxlevel-2"
             data-x="1050"
             data-y="0"
             data-speed="1000"
             data-start="1000"
             data-easing="Power3.easeInOut"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             style="z-index: 4;">
            <img src="image/catalog/skin_lingerie/slide1-2.png" alt="">
        </div>
        <div class="tp-caption text1 fadeout"
             data-x="600"
             data-y="100"
             data-speed="800"
             data-start="1500"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;">Discover <br>
            the world<br>
            of exclusive <br>
            lingerie</div>
        <div class="tp-caption text2 fadeout"
             data-x="650"
             data-y="300"
             data-speed="550"
             data-start="2000"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">Spring’s best basics</div>
        <div class="tp-caption text3 fadeout"
             data-x="700"
             data-y="380"
             data-speed="1000"
             data-start="2500"
             data-easing="Power3.easeInOut"
             data-splitin="none"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;">Shop Now</div>
    </li>
    <li id="slide2" data-transition="fade" data-masterspeed="500" data-title="Second Slide" data-link="listing.html">
        <img src="image/catalog/dummy.png" alt="slide2" data-lazyload="image/catalog/skin_lingerie/slide2.jpg">
        <div class="tp-caption fadein fadeout"
             data-x="900"
             data-y="50"
             data-speed="1000"
             data-start="1000"
             data-easing="Power3.easeInOut"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             style="z-index: 1;">
            <img src="image/catalog/skin_lingerie/slide2-text.png" alt="">
        </div>
        <div class="tp-caption text3 fadeout"
             data-x="1050"
             data-y="300"
             data-speed="1000"
             data-start="1500"
             data-easing="Power3.easeInOut"
             data-splitin="none"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 2; max-width: auto; max-height: auto; white-space: nowrap;">Shop Now
        </div>
    </li>
</ul>
<!--end Lingerie theme Revolution Top Slider-->

<!--Kids theme Revolution Top Slider-->
<ul>
    <li id="slide1" data-transition="papercut" data-masterspeed="500" data-title="First Slide">
        <img src="image/catalog/dummy.png" alt="slide1" data-lazyload="image/catalog/skin_kids/slide1.jpg">
        <div class="tp-caption text1 sfl"
             data-x="150"
             data-y="80"
             data-speed="800"
             data-start="1000"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;">The Newborn <br>
            Checklist
        </div>
        <div class="tp-caption text2 sfl"
             data-x="150"
             data-y="250"
             data-speed="550"
             data-start="1500"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">From bibs to blankets, Everything you <br>
            need to Welcome them home
        </div>
        <div class="tp-caption text3 sfr"
             data-x="150"
             data-y="320"
             data-speed="550"
             data-start="1800"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">Shop now  ›››
        </div>
    </li>
    <li id="slide2" data-transition="papercut" data-masterspeed="500" data-title="Second Slide">
        <img src="image/catalog/dummy.png" alt="slide1" data-lazyload="image/catalog/skin_kids/slide2.jpg">
        <div class="tp-caption text1 sfl"
             data-x="800"
             data-y="80"
             data-speed="800"
             data-start="1000"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;">Sweetly <br>
            Spring
        </div>
        <div class="tp-caption text2 sfl"
             data-x="800"
             data-y="250"
             data-speed="550"
             data-start="1500"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">Oh so adorable baby clothes<br>
            starting at $9.99
        </div>
        <div class="tp-caption text3 sfr"
             data-x="800"
             data-y="320"
             data-speed="550"
             data-start="1800"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">Shop now  ›››</div>
    </li>
</ul>
<!--end Kids theme Revolution Top Slider-->

<!--Tools theme Revolution Top Slider-->
<ul>
    <li id="slide1" data-transition="curtain-1" data-masterspeed="500" data-title="First Slide">
        <img src="image/catalog/dummy.png" alt="slide1" data-lazyload="image/catalog/skin_tools/slide1.jpg">
        <div class="tp-caption text1 fadeout"
             data-x="100"
             data-y="200"
             data-speed="800"
             data-start="1000"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;">Power <br>& Versatility
        </div>
        <div class="tp-caption text2 fadeout"
             data-x="100"
             data-y="330"
             data-speed="550"
             data-start="1500"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">within reach
        </div>
        <div class="tp-caption fadeout"
             data-x="100"
             data-y="370"
             data-speed="550"
             data-start="2000"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;"><a href="1" class="btn btn-cool btn-lg">BUY NOW</a>
        </div>
    </li>
    <li id="slide2" data-transition="curtain-1" data-masterspeed="500" data-title="Second Slide">
        <img src="image/catalog/dummy.png" alt="slide2" data-lazyload="image/catalog/skin_tools/slide2.jpg">
        <div class="tp-caption text1 fadeout"
             data-x="300"
             data-y="200"
             data-speed="800"
             data-start="1000"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;">Power tools <br>that won't quit
        </div>
        <div class="tp-caption text2 fadeout"
             data-x="300"
             data-y="350"
             data-speed="550"
             data-start="1500"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">Feel the power
        </div>
        <div class="tp-caption fadeout"
             data-x="300"
             data-y="400"
             data-speed="550"
             data-start="2000"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;"><a href="1" class="btn btn-cool btn-lg">BUY NOW</a>
        </div>
    </li>
</ul>
<!--end Tools theme Revolution Top Slider-->

<!--Art theme Revolution Top Slider-->
<ul>
    <li id="slide1" data-transition="boxslide" data-masterspeed="500" data-title="First Slide" data-link="listing.html">
        <img src="image/catalog/dummy.png" alt="slide1" data-lazyload="image/catalog/skin_art/slide1.jpg">
        <div class="tp-caption text1 fadeout"
             data-x="700"
             data-y="100"
             data-speed="800"
             data-start="1000"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;">A picture&nbsp;&nbsp;</div>
        <div class="tp-caption text2 fadeout"
             data-x="700"
             data-y="300"
             data-speed="550"
             data-start="1500"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">is a poem without words.</div>
    </li>
    <li id="slide2" data-transition="boxslide" data-masterspeed="500" data-title="Second Slide" data-link="listing.html">
        <img src="image/catalog/dummy.png" alt="slide2" data-lazyload="image/catalog/skin_art/slide2.jpg">
        <div class="tp-caption text3 fadeout"
             data-x="700"
             data-y="200"
             data-speed="800"
             data-start="1000"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;">Vision&nbsp;&nbsp;</div>
        <div class="tp-caption text4 fadeout"
             data-x="750"
             data-y="350"
             data-speed="550"
             data-start="1500"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">is the art of seeing</div>
        <div class="tp-caption text4 fadeout"
             data-x="800"
             data-y="400"
             data-speed="550"
             data-start="2000"
             data-easing="Power3.easeInOut"
             data-splitout="none"
             data-elementdelay="0.1"
             data-endelementdelay="0.1"
             data-endspeed="300"
             style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">what is invisible to others.</div>
    </li>
</ul>
<!--end Art theme Revolution Top Slider-->

<!--default theme block under Top Slider: Services -->
            <div class="col-xs-12 col-sm-4 col-lg-4">
                <a href="index.php" class="item anim-icon">
                    <span class="icon"><img src="image/catalog/blocks/anim-icon-1.gif" width="45" height="45" data-hover="image/catalog/blocks/anim-icon-1-hover.gif" alt=""/></span>
                    <span class="title">Free shipping on orders over $200</span>
                </a>
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-4">
                <a href="index.php" class="item anim-icon">
                    <span class="icon"><img src="image/catalog/blocks/anim-icon-2.gif" width="45" height="45" data-hover="image/catalog/blocks/anim-icon-2-hover.gif" alt=""/></span>
                    <span class="title">30-day returns</span>
                </a>
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-4">
                <a href="index.php" class="item anim-icon">
                    <span class="icon"><img src="image/catalog/blocks/anim-icon-3.gif" width="45" height="45" data-hover="image/catalog/blocks/anim-icon-3-hover.gif" alt=""/></span>
                    <span class="title">24/7 Support </span>
                </a>
            </div>
<!--end default theme block under Top Slider: Services -->

<!--Lingerie theme block under Top Slider: Services -->
<div>
    <div class="col-xs-12 col-sm-4 col-lg-4">
        <a href="index.php" class="item"><span
        class="icon"><img src="image/catalog/skin_lingerie/icon-1.gif" alt=""/></span><span class="title">Free shipping on orders over $200</span> </a>
    </div>
    <div class="col-xs-12 col-sm-4 col-lg-4">
        <a href="index.php" class="item"><span
        class="icon"><img src="image/catalog/skin_lingerie/icon-2.gif" alt=""/></span><span class="title">30-day returns</span></a>
    </div>
    <div class="col-xs-12 col-sm-4 col-lg-4">
        <a href="index.php" class="item"><span
        class="icon"><img src="image/catalog/skin_lingerie/icon-3.gif" alt=""/></span><span class="title">24/7 Support </span></a>
    </div>
</div>
<!--end Lingerie theme block under Top Slider: Services -->

<!--Kids theme block under Top Slider: Services -->
    <div class="col-xs-12 col-sm-4 col-lg-4 service_item item1">
        <a href="index.php" class="item"><span
            class="icon"><img src="image/catalog/skin_kids/icon-1.png" alt=""/></span><span class="title">Free shipping on orders over $200</span> </a>
    </div>
    <div class="col-xs-12 col-sm-4 col-lg-4 service_item item2">
        <a href="index.php" class="item"><span
            class="icon"><img src="image/catalog/skin_kids/icon-2.png" alt=""/></span><span class="title">30-day returns moneyback guarantee</span></a>
    </div>
    <div class="col-xs-12 col-sm-4 col-lg-4 service_item item3">
        <a href="index.php" class="item"><span
            class="icon"><img src="image/catalog/skin_kids/icon-3.png" alt=""/></span><span class="title">24/7 Support online consultation</span></a>
    </div>
<!--end Kids theme block under Top Slider: Services -->

<!--Tools theme block under Top Slider: Services -->
<div class="col-xs-12 col-sm-4 col-lg-4">
    <a href="index.php" class="item"><span
        class="icon"><img src="image/catalog/skin_tools/icon-1.png" alt=""/></span><span class="title">Free shipping on orders over $200</span> </a>
</div>
<div class="col-xs-12 col-sm-4 col-lg-4">
    <a href="index.php" class="item"><span
        class="icon"><img src="image/catalog/skin_tools/icon-2.png" alt=""/></span><span class="title">30-day returns</span></a>
</div>
<div class="col-xs-12 col-sm-4 col-lg-4">
    <a href="index.php" class="item"><span
        class="icon"><img src="image/catalog/skin_tools/icon-3.png" alt=""/></span><span class="title">24/7 Support</span></a>
</div>
<!--end Tools theme block under Top Slider: Services -->

<!--Art theme block under Top Slider: Services -->
<div class="col-xs-12 col-sm-4 col-lg-4">
    <a href="index.php" class="item"><span
        class="icon"><img src="image/catalog/skin_art/icon-1.png" alt=""/></span><span class="title">Free shipping on orders over $200</span> </a>
</div>
<div class="col-xs-12 col-sm-4 col-lg-4">
    <a href="index.php" class="item"><span
        class="icon"><img src="image/catalog/skin_art/icon-2.png" alt=""/></span><span class="title">30-day returns</span></a>
</div>
<div class="col-xs-12 col-sm-4 col-lg-4">
    <a href="index.php" class="item"><span
        class="icon"><img src="image/catalog/skin_art/icon-3.png" alt=""/></span><span class="title">24/7 Support</span></a>
</div>
<!--end Art theme block under Top Slider: Services -->

<!--  Circle Banners Row -->
<div class="container content circle_banners slick-style2">
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
            <div class="banner-circle animate fadeInDown" onclick="location.href='index.php'">
                <div class="image"><img src="image/catalog/blocks/img1.jpg" alt=""  class="animate-scale"></div>
                <div class="title"><span>New Arrivals</span></div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
            <div class="banner-circle animate fadeInDown" onclick="location.href='index.php'">
                <div class="image"><img src="image/catalog/blocks/img2.jpg" alt=""  class="animate-scale"></div>
                <div class="title"><span>Summer Sale</span></div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
            <div class="banner-circle animate fadeInDown" onclick="location.href='index.php'">
                <div class="image"><img src="image/catalog/blocks/img3.jpg" alt=""  class="animate-scale"></div>
                <div class="title"><span>Fur Clothing</span></div>
            </div>
        </div>
    </div>
</div>
<!-- //end  Circle Banners Row -->

<!-- Bio Layout Circle Banners Row-->
<div class="container content circle_banners">
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <div class="banner-circle animate fadeInDown" onclick="location.href='index.php'">
                <div class="image"><img src="image/catalog/skin_bio/img1.jpg" alt=""  class="animate-scale"></div>
                <div class="title"><span>New Arrivals</span></div>
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <div class="banner-circle animate fadeInDown" onclick="location.href='index.php'">
                <div class="image"><img src="image/catalog/skin_bio/img2.jpg" alt=""  class="animate-scale"></div>
                <div class="title"><span>Summer Sale</span></div>
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <div class="banner-circle animate fadeInDown" onclick="location.href='index.php'">
                <div class="image"><img src="image/catalog/skin_bio/img3.jpg" alt=""  class="animate-scale"></div>
                <div class="title"><span>Fur Clothing</span></div>
            </div>
        </div>
    </div>
</div>
<!-- //end Bio Layout Circle Banners Row-->

<!-- Lingerie Layout Circle Banners Row-->
<div class="container content circle_banners">
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <div class="banner-circle animate fadeInDown" onclick="location.href='index.php'">
                <div class="image"><img src="image/catalog/skin_lingerie/img1.jpg" alt=""  class="animate-scale"></div>
                <div class="title"><span>New Arrivals</span></div>
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <div class="banner-circle animate fadeInDown" onclick="location.href='index.php'">
                <div class="image"><img src="image/catalog/skin_lingerie/img2.jpg" alt=""  class="animate-scale"></div>
                <div class="title"><span>Summer Sale</span></div>
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <div class="banner-circle animate fadeInDown" onclick="location.href='index.php'">
                <div class="image"><img src="image/catalog/skin_lingerie/img3.jpg" alt=""  class="animate-scale"></div>
                <div class="title"><span>Fur Clothing</span></div>
            </div>
        </div>
    </div>
</div>

<!-- //end Lingerie Layout Circle Banners Row-->

<!-- Kids Layout Circle Banners Row-->
<div class="container content circle_banners">
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <div class="banner-circle animate fadeInDown" onclick="location.href='index.php'">
                <div class="image"><img src="image/catalog/skin_kids/img1.jpg" alt=""  class="animate-scale"></div>
                <div class="title"><span>New Arrivals</span></div>
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <div class="banner-circle animate fadeInDown" onclick="location.href='index.php'">
                <div class="image"><img src="image/catalog/skin_kids/img2.jpg" alt=""  class="animate-scale"></div>
                <div class="title"><span>Summer Sale</span></div>
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <div class="banner-circle animate fadeInDown" onclick="location.href='index.php'">
                <div class="image"><img src="image/catalog/skin_kids/img3.jpg" alt=""  class="animate-scale"></div>
                <div class="title"><span>Fur Clothing</span></div>
            </div>
        </div>
    </div>
</div>

<!-- //end Kids Layout Circle Banners Row-->

<!-- About us content for Footer info module -->
<p><img src="image/catalog/blocks/img-about.jpg" width="261" height="132" alt="" class="img-responsive"></p>
<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas eu
    enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce
    vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor ullamcorper massa pellentesque
    sagittis. Morbi sit amet quam labore diam nonumy. </p>

<!-- //end About us content for Footer info module -->

<!-- Testimonials content for Footer info module -->
<div class="carousel-item">
    <div class="text">Maecenas eu enim in lorem scelerisq ue auctor. Ut non erat.
        Suspendisse tesque sagittis. Morbi quam.
        <div class="arrow"></div>
    </div>
    <div class="author">Andrea Willson</div>
</div>
<div class="carousel-item">
    <div class="text">Maecenas eu enim in lorem scelerisq ue auctor. Ut non erat.
        Suspendisse tesque sagittis. Morbi quam. Nullam ac nisi non eros gravida venenatis.
        Ut eu dictum justo urna et mi. Integer dictum est vitae sem. Ut euis, turpis
        lobortis.
        <div class="arrow"></div>
    </div>
    <div class="author">Mark Donovan</div>
</div>
<div class="carousel-item">
    <div class="text">Maecenas eu enim in lorem scelerisq ue auctor. Ut non erat.
        Suspendisse tesque sagittis. Morbi quam.
        <div class="arrow"></div>
    </div>
    <div class="author">Andrea Willson</div>
</div>
<div class="carousel-item">
    <div class="text">Maecenas eu enim in lorem scelerisq ue auctor. Ut non erat.
        Suspendisse tesque sagittis. Morbi quam. Nullam ac nisi non eros gravida venenatis.
        Ut eu dictum justo urna et mi. Integer dictum est vitae sem. Ut euis, turpis
        lobortis.
        <div class="arrow"></div>
    </div>
    <div class="author">Mark Donovan</div>
</div>
<!-- //end Testimonials content for Footer info module -->

<!--Share buttons in Product Quick view-->
<span class="pull-left">Share:&nbsp;&nbsp;&nbsp;&nbsp;</span>
<ul class="socials">
    <li><a href="https://www.facebook.com/"><span class="icon flaticon-facebook12"></span></a></li>
    <li><a href="https://twitter.com/"><span class="icon flaticon-twitter20"></span></a></li>
    <li><a href="https://www.google.com/"><span class="icon flaticon-google10"></span></a></li>
    <li><a href="https://www.pinterest.com/"><span class="icon flaticon-pinterest9"></span></a></li>
</ul>


<!--blog: post description-->
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor sagittis. Morbi sit amet quam. Nulla libero. </p>
<p>Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. </p>
<div class="blockquote">
    <div class="inside">
        <p>Curabitur convallis facilisis lorem. Vivamus euismod nulla vel nunc. Fusce tincidunt, justo congue egestas molestie, tortor tortor blandit erat, et scelerisque metus metus at ipsum. Maecenas tincidunt adipiscing tellus. Nunc tristique pede. Ut condimentum mattis est. Duis sit amet augue. </p>
    </div>
</div>
<!--blog: post additional description-->
<div class="text">
    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor sagittis. Morbi sit amet quam. Nulla libero. </p>
    <p>Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. </p>
    <div class="divider divider-sm"></div>
    <ul class="tags">
        <li><a href="index.php">Web Design</a></li>
        <li><a href="index.php">Wordpress</a></li>
        <li><a href="index.php">Animation</a></li>
    </ul>
    <div class="clearfix"></div>
    <div class="divider divider-lg"></div>
</div>
<!--blog: left column Custom text block-->
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor sagittis. Morbi sit amet quam.</p>
<!--blog: left column tags-->
<ul class="tags">
    <li><a href="index.php">Web Design </a></li>
    <li><a href="index.php">Wordpress</a></li>
    <li><a href="index.php"> Animation </a></li>
    <li><a href="index.php">Collection </a></li>
    <li><a href="index.php">Fall </a></li>
    <li><a href="index.php"> Retail </a></li>
    <li><a href="index.php">Sale </a></li>
    <li><a href="index.php">Spring </a></li>
    <li><a href="index.php">Summer </a></li>
    <li><a href="index.php"> Winter</a></li>
    <li><a href="index.php">Discount</a></li>
</ul>
<div class="clearfix"></div>

<!--blog flicker widget-->
<h3>Flickr photos</h3>
<div class="flickr">
    <div id="flickr_badge_wrapper">
        <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=9&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=52617155@N08"></script>
        <center><small>Created with <a href="http://www.flickrbadge.com">flickr badge</a>.</small></center>
    </div>
    <div class="text-center flickr"><a class="btn-cool" href="https://www.flickr.com/photos/we-are-envato"> more photos </a></div>
</div>
<!--end flicker widget-->



<!--flicker widget-->
<div class="pull-left vertical_title_outer title-sm flickr">
    <div><span>Flickr photos</span></div>
</div>

<!--default Flick content-->
<div class="pull-left padding-left flickr">
    <div id="flickr_badge_wrapper">
    <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=9&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=52617155@N08"></script>
    </div>
    <div class="text-center flickr"><a class="btn-cool" href="https://www.flickr.com/photos/we-are-envato"> more photos </a></div>
</div>
<!--end default Flick content-->

<!--replace Flick-->
<div class="pull-left padding-left flickr">
    <div class="small-photos">
        <a href="https://www.flickr.com/photos/we-are-envato"><img src="image/catalog/blocks/flick/flickr-photo-1.jpg" width="66" height="66" alt="" /></a>
        <a href="https://www.flickr.com/photos/we-are-envato"><img src="image/catalog/blocks/flick/flickr-photo-2.jpg" width="66" height="66" alt="" /></a>
        <a href="https://www.flickr.com/photos/we-are-envato"><img src="image/catalog/blocks/flick/flickr-photo-3.jpg" width="66" height="66" alt="" /></a>
        <a href="https://www.flickr.com/photos/we-are-envato"><img src="image/catalog/blocks/flick/flickr-photo-4.jpg" width="66" height="66" alt="" /></a>
        <a href="https://www.flickr.com/photos/we-are-envato"><img src="image/catalog/blocks/flick/flickr-photo-5.jpg" width="66" height="66" alt="" /></a>
        <a href="https://www.flickr.com/photos/we-are-envato"><img src="image/catalog/blocks/flick/flickr-photo-6.jpg" width="66" height="66" alt="" /></a>
        <a href="https://www.flickr.com/photos/we-are-envato"><img src="image/catalog/blocks/flick/flickr-photo-7.jpg" width="66" height="66" alt="" /></a>
        <a href="https://www.flickr.com/photos/we-are-envato"><img src="image/catalog/blocks/flick/flickr-photo-8.jpg" width="66" height="66" alt="" /></a>
        <a href="https://www.flickr.com/photos/we-are-envato"><img src="image/catalog/blocks/flick/flickr-photo-9.jpg" width="66" height="66" alt="" /></a>
    </div>
    <div class="text-center flickr">
        <a class="btn-cool" href="https://www.flickr.com/photos/we-are-envato"> more photos </a>
    </div>
</div>
<!--replace Flick-->

<!--category description: simple banners-->
<div class="row category-banners">
    <div class="col-xs-6"><a href="index.php" title="category"><img src="image/catalog/blocks/category-banner1.jpg" alt="" class="img-responsive"></a></div>
    <div class="col-xs-6"><a href="index.php" title="category"><img src="image/catalog/blocks/category-banner2.jpg" alt="" class="img-responsive"></a></div>
</div>

<!--category description: slider-->
<div class="category-slider slick-style5">
    <div class="carousel-item"><img src="image/catalog/blocks/category-banner3.jpg" alt=""></div>
    <div class="carousel-item"><img src="image/catalog/blocks/category-banner4.jpg" alt=""></div>
</div>

<!--content for Slick listing 01-->
    <img src="image/catalog/blocks/products/product25.jpg" alt="">
    <div class="hover"></div>
    <div class="info top-left text-center">
        <div class="inside">
            <h6>NEW</h6>
            <h2 class="underline">ARRIVALS</h2>
            <h4>MEN CLOTHING</h4>
            <a href="index.php" class="btn-cool btn-transparent">Shop now</a>
        </div>
    </div>

<!--content for Slick listing 02-->
    <img src="image/catalog/blocks/products/product17.jpg" alt="">
    <div class="hover"></div>
    <div class="info top-right text-center">
        <div class="inside">
            <h6>get discount</h6>
            <h2>Shoes for life</h2>
            <a href="index.php" class="btn-cool btn-transparent">Shop now</a>
        </div>
    </div>


<!--social buttons on Product page-->
<span class="pull-left">Share:&nbsp;&nbsp;&nbsp;&nbsp;</span>
<ul class="socials">
    <li><a href="https://www.facebook.com/"><span class="icon flaticon-facebook12"></span></a></li>
    <li><a href="https://twitter.com/"><span class="icon flaticon-twitter20"></span></a></li>
    <li><a href="https://www.google.com"><span class="icon flaticon-google10"></span></a></li>
    <li><a href="https://www.pinterest.com/"><span class="icon flaticon-pinterest9"></span></a></li>
</ul>

<!--custom right block on Product page-->
<h3>CUSTOM HTML BLOCK</h3>
You can add your content here, like promotions or some additional info
<div class="custom-block">
    <a href="index.php" class="item">
        <span class="icon flaticon-outlined3"></span>
        <span class="text">
            <span class="title">Special Offer 1+1=3</span>
            <span class="description">Get a gift!</span>
        </span>
    </a>
    <a href="index.php" class="item">
        <span class="icon flaticon-credit22"></span>
        <span class="text"><span class="title">FREE REWARD CARD</span> <span class="description">Worth 10$, 50$, 100$</span> </span>
    </a>
    <a href="index.php" class="item">
        <span class="icon flaticon-business137"></span>
        <span class="text"> <span class="title">Join Our Club</span> </span>
    </a>
    <a href="index.php" class="item">
        <span class="icon flaticon-global10"></span>
        <span class="text"><span class="title">Free Shipping</span></span>
    </a>
</div>

<!--contact us social block-->
<p><strong>Vestibulum justo. Nulla mauris ipsum, convallis ut, vestibulum eu, tincidunt vel, nisi.
    Pellentesque adipiscing nisi.</strong></p>
<p>Nulla facilisi. Mauris lacinia lectus sit amet felis. Aliquam erat volutpat. Nulla porttitor tortor at nisl. Nam lectus nulla, bibendum pretium, dictum a, mattis nec, dolor. Nullam id justo enim sem ut tum ut, turpis. Mauris et ligula quis erat dignissim imperdiet. Integer ligula magna, dictum et, pulvinar non, ultricies ac, nibh. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. </p>
<ul class="socials socials-lg">
    <li><a href="index.php"><span class="icon flaticon-facebook12"></span></a></li>
    <li><a href="index.php"><span class="icon flaticon-twitter20"></span></a></li>
    <li><a href="index.php"><span class="icon flaticon-google10"></span></a></li>
    <li><a href="index.php"><span class="icon flaticon-pinterest9"></span></a></li>
    <li><a href="index.php"><span class="icon flaticon-linkedin11"></span></a></li>
    <li><a href="index.php"><span class="icon flaticon-youtube18"></span></a></li>
    <li><a href="index.php"><span class="icon flaticon-instagram"></span></a></li>
    <li><a href="index.php"><span class="icon flaticon-skype12"></span></a></li>
</ul>
<!--end contact us social block-->

<!--site map-->
<img class="img-responsive animate scale" src="image/catalog/blocks/sitemap-img.png" alt="">
<!--end site map-->

<!-- Layout: Boxed Landing page-->
<div class="container">
    <div class="products-land row">
        <div class="products-land-row">
            <div class="item col1">
                <img src="image/catalog/skin_landing/product-boxed-land1.jpg" alt="">
                <div class="hover"></div>
                <div class="info middle-left text-center">
                    <div class="inside">
                        <div class="fsize18">party dress<br> trending</div>
                        <div class="fsize30">2015</div>
                        <div class="fsize10">Shop arrivals!</div>
                        <br>
                        <a href="index.php" class="btn-cool btn-transparent btn-small">Shop now</a></div>
                </div>
            </div>
            <div class="item col10">
                <a href="index.php"><img src="image/catalog/skin_landing/image-boxed-land-1.jpg" alt=""></a>
            </div>
            <div class="item col1">
                <img src="image/catalog/skin_landing/product-boxed-land2.jpg" alt="">
                <div class="hover"></div>
                <div class="info middle-left text-center">
                    <div class="inside">
                        <div><span class="fsize50">40</span><span class="fsize16">%off</span></div>
                        <div class="fsize18"> on entire categories</div>
                        <div class="line"></div>
                        <div class="fsize10">start from $10</div>
                        <br>
                        <a href="index.php" class="btn-cool btn-transparent btn-small">Shop now</a></div>
                </div>
            </div>
        </div>
        <div class="products-land-row">
            <div class="item col3">
                <img src="image/catalog/skin_landing/product-boxed-land3.jpg" alt="">
                <div class="hover"></div>
                <div class="info middle-right text-center">
                    <div class="inside">
                        <div class="fsize24">SUMMER 2015 </div>
                        <div class="fsize50">FASHION TRENDS</div>
                        <a href="index.php" class="btn-cool btn-transparent btn-small">Shop now</a></div>
                </div>
            </div>
            <div class="item col4">
                <img src="image/catalog/skin_landing/product-boxed-land4.jpg" alt="">
                <div class="hover"></div>
                <div class="info top-right text-center">
                    <div class="inside">
                        <div class="fsize24">Must Have</div>
                        <div class="fsize18">Looks</div>
                        <br>
                        <a href="index.php" class="btn-cool btn-transparent btn-small">Shop now</a></div>
                </div>
            </div>
            <div class="item col2 pull-top-1 video-item">
                <div class="video-poster"><a href="index.php"><img src="image/catalog/skin_landing/video/video-women1.jpg" alt=""></a></div>
                <div class="product-video">
                    <video autoplay="" preload="auto" loop="">
                        <source src="image/catalog/skin_landing/video/video-women1.mp4" type="video/mp4">
                        <source src="image/catalog/skin_landing/video/video-women1.ogv" type="video/ogg">
                        <a href="index.php"><img src="image/catalog/skin_landing/video/video-women1.jpg" alt=""></a>
                    </video>
                </div>
            </div>
        </div>
        <div class="products-land-row">
            <div class="item col6 video-item">
                <div class="video-poster"><a href="index.php"><img src="image/catalog/skin_landing/video/video-women2.jpg" alt=""></a></div>
                <div class="product-video">
                    <video autoplay="" preload="auto" loop="">
                    <source src="image/catalog/skin_landing/video/video-women2.mp4" type="video/mp4">
                    <source src="image/catalog/skin_landing/video/video-women2.ogv" type="video/ogg">
                        <a href="index.php"><img src="image/catalog/skin_landing/video/video-women2.jpg" alt=""></a>
                    </video>
                </div>
            </div>
            <div class="item col7">
                <img src="image/catalog/skin_landing/product-boxed-land5.jpg" alt="">
                <div class="hover"></div>
                <div class="info middle-left text-center">
                    <div class="inside">
                        <div class="fsize28">Falls<br> Fashion</div>
                        <div class="fsize18">2015</div>
                        <br>
                        <a href="index.php" class="btn-cool btn-transparent btn-small">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="item col8 pull-top-2">
                <a href="index.php"><img src="image/catalog/skin_landing/image-boxed-land-2.jpg" alt=""></a>
            </div>
            <div class="pull-left pull-top-3 col col9">
                <div class="item">
                    <img src="image/catalog/skin_landing/product-boxed-land6.jpg" alt="">
                    <div class="hover"></div>
                    <div class="info bottom-center text-center">
                        <div class="inside">
                            <div class="fsize18">hottest, trending, reclaimed  luxury product</div><br>
                            <a href="index.php" class="btn-cool btn-transparent btn-small">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="image/catalog/skin_landing/product-boxed-land7.jpg" alt="">
                    <div class="hover"></div>
                    <div class="info top-left text-center">
                        <div class="inside">
                            <div class="fsize21">MID SEASON</div>
                            <div class="fsize40 text-white">SALE</div>
                            <div class="fsize16">up to 70% off</div>
                            <a href="index.php" class="btn-cool btn-transparent btn-small">Shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end Layout: Boxed Landing page-->

<!-- Layout: Landing Banners page-->
<div>
    <div class="products-land">
        <div class="item">
            <img src="image/catalog/skin_landing/image-land-01.jpg" alt="">
            <div class="hover"></div>
            <div class="info top-left text-center">
                <div class="inside">
                    <h6>Shop arrivals!</h6>
                    <h2 class="border">POPULAR BAGS</h2>
                    <h4>hottest, trending, reclaimed
                        luxury product</h4>
                    <a href="index.php" class="btn-cool btn-light">Shop now</a>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="image/catalog/skin_landing/image-land-02.jpg" alt="">
            <div class="hover"></div>
            <div class="stamp top-right">
                <div class="inside">UP<span>50%</span>TO</div>
            </div>
            <div class="info bottom-center text-center">
                <div class="inside">
                    <h6>anniversary event</h6>
                    <h2 class="border">exclusive jewelry</h2>
                    <h4>Special Pricing on all
                        jewelry designers</h4>
                    <a href="index.php" class="btn-cool btn-light">Shop now</a>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="image/catalog/skin_landing/image-land-03.jpg" alt="">
            <div class="hover"></div>
            <div class="info invert top-right text-center">
                <div class="inside">
                    <h6>NOW TRENDING</h6>
                    <h2 class="border">LADIES’ WATCHES</h2>
                    <h4>ESIGNS OF THE YEAR<br>
                        2015</h4>
                    <a href="index.php" class="btn-cool btn-light">Shop now</a>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="image/catalog/skin_landing/image-land-04.jpg" alt="">
            <div class="hover"></div>
            <div class="inside">
                <div class="info bottom-center text-right">
                    <h2 class="quote">Elegance<br>
                        is the only beauty<br>
                        that never fades</h2>
                    <h4>— Audrey Hepburn</h4>
                    <a href="index.php" class="btn-cool btn-dark">Shop now</a>
                </div>
            </div>
        </div>
        <div class="item double-width">
            <img src="image/catalog/skin_landing/image-land-05.jpg" alt="">
            <div class="hover"></div>
            <div class="stamp bottom-left">
                <div class="inside">UP<span>25%</span>TO</div>
            </div>
            <div class="info top-right text-center">
                <div class="inside">
                    <h6>For Men Only</h6>
                    <h2 class="border">Special weekend discounts</h2>
                    <h4>Featured Men's Suits and Fashion<br>
                        Accessories</h4>
                    <a href="index.php" class="btn-cool btn-white">Shop now</a>
                </div>
            </div>
        </div>
        <div class="item double-width">
            <img src="image/catalog/skin_landing/image-land-06.jpg" alt="">
            <div class="hover"></div>
            <div class="info middle-right invert text-center">
                <div class="inside">
                    <h6>crazy deal: only monday & tuesday</h6>
                    <h2 class="border">girls SUMMER COLLECTIONS</h2>
                    <h4>Save 20-40% at our shop<br>
                        and get free shippng</h4>
                    <a href="index.php" class="btn-cool btn-light">Shop now</a>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="image/catalog/skin_landing/image-land-07.jpg" alt="">
            <div class="hover"></div>
            <div class="info middle-left text-center">
                <div class="inside">
                    <div class="stamp">
                        <div class="inside">UP<span>50%</span>TO</div>
                    </div>
                    <h2 class="underline">FALL FASHION</h2>
                    <h4>mini style, big brands,<br>
                        always 50% oFF<br>
                        or less</h4>
                    <a href="index.php" class="btn-cool btn-dark">Shop now</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end Layout: Landing Banners page-->

<!--About Page Content-->
<div>
    <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-4">
            <img class="img-responsive animate scale" src="image/catalog/blocks/about-us-image.jpg" alt="">
        </div>
        <div class="divider-md visible-xs"></div>
        <div class="col-sm-8 col-md-8 col-lg-8">
            <h2>Who We Are?</h2>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor sagittis. Morbi sit amet quam. Nulla libero. </p>
            <p>Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. </p>
            <a href="index.php" class="btn btn-cool btn-lg">GET STARTED NOW!</a>
        </div>
    </div>
    <div class="divider-xl"></div>
    <div class="row">
        <div class="col-sm-6 col-md-3 col-lg-3 text-center">
            <div class="rect">
                <div class="animate scale icon-outer"><span class="icon flaticon-attachment13"></span></div>
                <h6><strong>Ut sit amet turpis</strong></h6>
                <p>In est arcu vitae sollicitudin eu, vehicula venenatis est tempor diam</p>
            </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 text-center">
            <div class="rect">
                <div class="animate scale icon-outer"><span class="icon flaticon-shopping155"></span></div>
                <h6><strong>Ut sit amet turpis</strong></h6>
                <p>In est arcu vitae sollicitudin eu, vehicula venenatis est tempor diam</p>
            </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 text-center">
            <div class="rect">
                <div class="animate scale icon-outer"><span class="icon flaticon-settings9"></span></div>
                <h6><strong>Ut sit amet turpis</strong></h6>
                <p>Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse</p>
            </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 text-center">
            <div class="rect">
                <div class="animate scale icon-outer"><span class="icon flaticon-global10"></span></div>
                <h6><strong>Ut sit amet turpis</strong></h6>
                <p>In est arcu vitae sollicitudin eu, vehicula venenatis est tempor diam</p>
            </div>
        </div>
    </div>

    <div class="divider-xl"></div>
    <div class="subtitle">
        <div><span>OUR TEAM</span></div>
    </div>
    <div class="images-gallery four-columns">
        <div class="images-nospace team-gallery">
            <div class="image-thumbnail">
                <img src="image/catalog/blocks/team-member-01.jpg" alt="">
                <div class="hover">
                    <div class="inside">
                        <h4>Mike Williams</h4>
                        <h5>Manager </h5>
                        <ul class="socials socials-lg">
                            <li><a href="index.php"><span class="icon flaticon-facebook12">&nbsp;</span></a></li>
                            <li><a href="index.php"><span class="icon flaticon-twitter20">&nbsp;</span></a></li>
                            <li><a href="index.php"><span class="icon flaticon-google10">&nbsp;</span></a></li>
                            <li><a href="index.php"><span class="icon flaticon-pinterest9">&nbsp;</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="image-thumbnail">
                <img src="image/catalog/blocks/team-member-02.jpg" alt="">
                <div class="hover">
                    <div class="inside">
                        <h4>Matthew Davies </h4>
                        <h5>Manager </h5>
                        <ul class="socials socials-lg">
                            <li><a href="index.php"><span class="icon flaticon-facebook12">&nbsp;</span></a></li>
                            <li><a href="index.php"><span class="icon flaticon-twitter20">&nbsp;</span></a></li>
                            <li><a href="index.php"><span class="icon flaticon-google10">&nbsp;</span></a></li>
                            <li><a href="index.php"><span class="icon flaticon-pinterest9">&nbsp;</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="image-thumbnail">
                <img src="image/catalog/blocks/team-member-03.jpg" alt="">
                <div class="hover">
                    <div class="inside">
                        <h4>Ryan Thomas </h4>
                        <h5>Manager </h5>
                        <ul class="socials socials-lg">
                            <li><a href="index.php"><span class="icon flaticon-facebook12">&nbsp;</span></a></li>
                            <li><a href="index.php"><span class="icon flaticon-twitter20">&nbsp;</span></a></li>
                            <li><a href="index.php"><span class="icon flaticon-google10">&nbsp;</span></a></li>
                            <li><a href="index.php"><span class="icon flaticon-pinterest9">&nbsp;</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="image-thumbnail">
                <img src="image/catalog/blocks/team-member-04.jpg" alt="">
                <div class="hover">
                    <div class="inside">
                        <h4>Emma Smith</h4>
                        <h5>Manager </h5>
                        <ul class="socials socials-lg">
                            <li><a href="index.php"><span class="icon flaticon-facebook12">&nbsp;</span></a></li>
                            <li><a href="index.php"><span class="icon flaticon-twitter20">&nbsp;</span></a></li>
                            <li><a href="index.php"><span class="icon flaticon-google10">&nbsp;</span></a></li>
                            <li><a href="index.php"><span class="icon flaticon-pinterest9">&nbsp;</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- //end About Page Content -->

<!-- 02 Infographic Page Content -->
<div>
    <div class="subtitle">
        <div><span>BIG rectangle NON-ACTIVE</span></div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-3 col-lg-3 text-center">
            <div class="rect">
                <div class="animate scale icon-outer"><span class="icon flaticon-airplane70"></span></div>
                <h6><strong>Free shipping</strong></h6>
                <p>In est arcu vitae sollicitudin eu, vehicula venenatis est tempor diam</p>
            </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 text-center">
            <div class="rect">
                <div class="animate scale icon-outer"><span class="icon flaticon-shopping155"></span></div>
                <h6><strong>24/7 Support</strong></h6>
                <p>In est arcu vitae sollicitudin eu, vehicula venenatis est tempor diam</p>
            </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 text-center"><div class="rect">
            <div class="animate scale icon-outer"><span class="icon icon-lg flaticon-hand129"></span></div>
            <h6><strong>30-day returns</strong></h6>
            <p>Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse</p>
        </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 text-center"><div class="rect">
            <div class="animate scale icon-outer"><span class="icon icon-xxl flaticon-credit3"></span></div>
            <h6><strong>Free shipping</strong></h6>
            <p>In est arcu vitae sollicitudin eu, vehicula venenatis est tempor diam</p>
        </div>
        </div>
    </div>
    <div class="divider-lg"></div>
    <div class="subtitle">
        <div><span>BIG rectangle ACTIVE</span></div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-3 col-lg-3 text-center">
            <div class="rect active">
                <div class="animate scale icon-outer"><span class="icon flaticon-airplane70"></span></div>
                <h6><strong>Free shipping</strong></h6>
                <p>In est arcu vitae sollicitudin eu, vehicula venenatis est tempor diam</p>
            </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 text-center">
            <div class="rect active">
                <div class="animate scale icon-outer"><span class="icon flaticon-shopping155"></span></div>
                <h6><strong>24/7 Support</strong></h6>
                <p>In est arcu vitae sollicitudin eu, vehicula venenatis est tempor diam</p>
            </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 text-center"><div class="rect active">
            <div class="animate scale icon-outer"><span class="icon icon-lg flaticon-hand129"></span></div>
            <h6><strong>30-day returns</strong></h6>
            <p>Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse</p>
        </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 text-center"><div class="rect active">
            <div class="animate scale icon-outer"><span class="icon icon-xxl flaticon-credit3"></span></div>
            <h6><strong>Free shipping</strong></h6>
            <p>In est arcu vitae sollicitudin eu, vehicula venenatis est tempor diam</p>
        </div>
        </div>
    </div>
    <div class="divider-lg"></div>
    <div class="subtitle">
        <div><span>Small rectangle NON-ACTIVE</span></div>
    </div>
    <div class="divider-sm"></div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="rect-sm">
                <div class="animate scale icon-outer"><span class="icon flaticon-airplane70"></span></div>
            </div>
            <h4>Free shipping</h4>
            <p>Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. </p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="rect-sm"><div class="animate scale icon-outer"><span class="icon icon-xl flaticon-shopping155"></span></div></div>
            <h4>24/7 Support </h4>
            <p>Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. </p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="rect-sm"><div class="animate scale icon-outer"><span class="icon icon-lg flaticon-hand129"></span></div></div>
            <h4>30-day returns</h4>
            <p>Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. </p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="rect-sm"><div class="animate scale icon-outer"><span class="icon icon-xxl flaticon-credit3"></span></div></div>
            <h4>cash on delivery</h4>
            <p>Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. </p>
        </div>
    </div>
    <div class="divider-lg"></div>
    <div class="subtitle">
        <div><span>Small rectangle NON-ACTIVE</span></div>
    </div>
    <div class="divider-sm"></div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="rect-sm active"><div class="animate scale icon-outer"><span class="icon flaticon-airplane70"></span></div></div>
            <h4>Free shipping</h4>
            <p>Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. </p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="rect-sm active"><div class="animate scale icon-outer"><span class="icon icon-xl flaticon-shopping155"></span></div></div>
            <h4>24/7 Support </h4>
            <p>Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. </p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="rect-sm active"><div class="animate scale icon-outer"><span class="icon icon-lg flaticon-hand129"></span></div></div>
            <h4>30-day returns</h4>
            <p>Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. </p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="rect-sm active"><div class="animate scale icon-outer"><span class="icon icon-xxl flaticon-credit3"></span></div></div>
            <h4>cash on delivery</h4>
            <p>Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. </p>
        </div>
    </div>
    <div class="divider-lg"></div>
    <div class="subtitle">
        <div><span>Social icons</span></div>
    </div>
    <div class="divider-xs"></div>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <ul class="socials socials-xl">
                <li><a href="index.php"><span class="icon icon-xl flaticon-facebook12"></span></a></li>
                <li><a href="index.php"><span class="icon icon-xl flaticon-twitter20"></span></a></li>
                <li><a href="index.php"><span class="icon icon-xl flaticon-google10"></span></a></li>
                <li><a href="index.php"><span class="icon icon-xl flaticon-pinterest9"></span></a></li>
                <li><a href="index.php"><span class="icon icon-xl flaticon-linkedin11"></span></a></li>
                <li><a href="index.php"><span class="icon icon-xl flaticon-youtube18"></span></a></li>
                <li><a href="index.php"><span class="icon icon-xl flaticon-instagram"></span></a></li>
                <li><a href="index.php"><span class="icon icon-xl flaticon-global10"></span></a></li>
                <li><a href="index.php"><span class="icon icon-xl flaticon-skype12"></span></a></li>
                <li><a href="index.php"><span class="icon icon-xl flaticon-link23"></span></a></li>
            </ul>
        </div>
        <div class="divider-sm visible-sm visible-xs"></div>
        <div class="col-xs-12 col-md-6">
            <ul class="socials socials-xl">
                <li><a href="index.php" class="active"><span class="icon icon-xl flaticon-facebook12"></span></a></li>
                <li><a href="index.php" class="active"><span class="icon icon-xl flaticon-twitter20"></span></a></li>
                <li><a href="index.php" class="active"><span class="icon icon-xl flaticon-google10"></span></a></li>
                <li><a href="index.php" class="active"><span class="icon icon-xl flaticon-pinterest9"></span></a></li>
                <li><a href="index.php" class="active"><span class="icon icon-xl flaticon-linkedin11"></span></a></li>
                <li><a href="index.php" class="active"><span class="icon icon-xl flaticon-youtube18"></span></a></li>
                <li><a href="index.php" class="active"><span class="icon icon-xl flaticon-instagram"></span></a></li>
                <li><a href="index.php" class="active"><span class="icon icon-xl flaticon-global10"></span></a></li>
                <li><a href="index.php" class="active"><span class="icon icon-xl flaticon-skype12"></span></a></li>
                <li><a href="index.php" class="active"><span class="icon icon-xl flaticon-link23"></span></a></li>
            </ul>
        </div>
    </div>
    <div class="divider-xl"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="subtitle">
                <div><span>WEB APPLICATION ICONS</span></div>
            </div>
            <section class="icons-set"> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-31"> </span>&nbsp;flaticon-31 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-32"> </span>&nbsp;flaticon-32 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-404"> </span>&nbsp;flaticon-404 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-add133"> </span>&nbsp;flaticon-add133 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-add139"> </span>&nbsp;flaticon-add139 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-airplane70"> </span>&nbsp;flaticon-airplane70 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-attachment13"> </span>&nbsp;flaticon-attachment13 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-bars34"> </span>&nbsp;flaticon-bars34 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-big58"> </span>&nbsp;flaticon-big58 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-black302"> </span>&nbsp;flaticon-black302 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-brief"> </span>&nbsp;flaticon-brief </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-business"> </span>&nbsp;flaticon-business </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-business137"> </span>&nbsp;flaticon-business137 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-calculator30"> </span>&nbsp;flaticon-calculator30 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-calendar53"> </span>&nbsp;flaticon-calendar53 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-cellphone5"> </span>&nbsp;flaticon-cellphone5 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-check34"> </span>&nbsp;flaticon-check34 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-check35"> </span>&nbsp;flaticon-check35 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-checklist3"> </span>&nbsp;flaticon-checklist3 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-clock61"> </span>&nbsp;flaticon-clock61 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-close19"> </span>&nbsp;flaticon-close19 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-coin11"> </span>&nbsp;flaticon-coin11 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-correct8"> </span>&nbsp;flaticon-correct8 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-credit22"> </span>&nbsp;flaticon-credit22 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-credit3"> </span>&nbsp;flaticon-credit3 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-cup38"> </span>&nbsp;flaticon-cup38 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-delete30"> </span>&nbsp;flaticon-delete30 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-dollar144"> </span>&nbsp;flaticon-dollar144 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-down13"> </span>&nbsp;flaticon-down13 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-down14"> </span>&nbsp;flaticon-down14 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-email27"> </span>&nbsp;flaticon-email27 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-envelope4"> </span>&nbsp;flaticon-envelope4 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-facebook12"> </span>&nbsp;flaticon-facebook12 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-garbage4"> </span>&nbsp;flaticon-garbage4 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-gift1"> </span>&nbsp;flaticon-gift1 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-global10"> </span>&nbsp;flaticon-global10 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-globe5"> </span>&nbsp;flaticon-globe5 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-google10"> </span>&nbsp;flaticon-google10 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-group41"> </span>&nbsp;flaticon-group41 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-hand129"> </span>&nbsp;flaticon-hand129 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-heart15"> </span>&nbsp;flaticon-heart15 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-heart68"> </span>&nbsp;flaticon-heart68 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-home113"> </span>&nbsp;flaticon-home113 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-idea12"> </span>&nbsp;flaticon-idea12 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-instagram"> </span>&nbsp;flaticon-instagram </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-left33"> </span>&nbsp;flaticon-left33 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-left37"> </span>&nbsp;flaticon-left37 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-left65"> </span>&nbsp;flaticon-left65 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-like"> </span>&nbsp;flaticon-like </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-link23"> </span>&nbsp;flaticon-link23 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-linkedin11"> </span>&nbsp;flaticon-linkedin11 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-lock26"> </span>&nbsp;flaticon-lock26 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-machine2"> </span>&nbsp;flaticon-machine2 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-menu29"> </span>&nbsp;flaticon-menu29 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-new78"> </span>&nbsp;flaticon-new78 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-news"> </span>&nbsp;flaticon-news </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-open7"> </span>&nbsp;flaticon-open7 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-outlined3"> </span>&nbsp;flaticon-outlined3 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-oval33"> </span>&nbsp;flaticon-oval33 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-pencil43"> </span>&nbsp;flaticon-pencil43 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-phone16"> </span>&nbsp;flaticon-phone16 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-phone163"> </span>&nbsp;flaticon-phone163 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-piggy10"> </span>&nbsp;flaticon-piggy10 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-piggy8"> </span>&nbsp;flaticon-piggy8 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-pinterest9"> </span>&nbsp;flaticon-pinterest9 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-plane15"> </span>&nbsp;flaticon-plane15 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-play45"> </span>&nbsp;flaticon-play45 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-player3"> </span>&nbsp;flaticon-player3 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-price1"> </span>&nbsp;flaticon-price1 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-profile8"> </span>&nbsp;flaticon-profile8 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-rectangular25"> </span>&nbsp;flaticon-rectangular25 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-recycle59"> </span>&nbsp;flaticon-recycle59 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-round41"> </span>&nbsp;flaticon-round41 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-round43"> </span>&nbsp;flaticon-round43 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-round8"> </span>&nbsp;flaticon-round8 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-search8"> </span>&nbsp;flaticon-search8 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-settings9"> </span>&nbsp;flaticon-settings9 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-shopping155"> </span>&nbsp;flaticon-shopping155 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-shopping185"> </span>&nbsp;flaticon-shopping185 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-shopping2"> </span>&nbsp;flaticon-shopping2 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-shopping66"> </span>&nbsp;flaticon-shopping66 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-shopping9"> </span>&nbsp;flaticon-shopping9 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-skype12"> </span>&nbsp;flaticon-skype12 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-social19"> </span>&nbsp;flaticon-social19 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-special"> </span>&nbsp;flaticon-special </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-star129"> </span>&nbsp;flaticon-star129 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-tag31"> </span>&nbsp;flaticon-tag31 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-tag43"> </span>&nbsp;flaticon-tag43 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-tags"> </span>&nbsp;flaticon-tags </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-talk8"> </span>&nbsp;flaticon-talk8 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-text45"> </span>&nbsp;flaticon-text45 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-text46"> </span>&nbsp;flaticon-text46 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-three1"> </span>&nbsp;flaticon-three1 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-tiles"> </span>&nbsp;flaticon-tiles </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-twitter20"> </span>&nbsp;flaticon-twitter20 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-two125"> </span>&nbsp;flaticon-two125 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-up21"> </span>&nbsp;flaticon-up21 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-up22"> </span>&nbsp;flaticon-up22 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-user91"> </span>&nbsp;flaticon-user91 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-view9"> </span>&nbsp;flaticon-view9 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-welldone"> </span>&nbsp;flaticon-welldone </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-write13"> </span>&nbsp;flaticon-write13 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-youtube18"> </span>&nbsp;flaticon-youtube18 </span> <span class="col-xs-6 col-sm-3 col-md-3 col-lg-3"> <span class="flaticon-zoom45"> </span>&nbsp;flaticon-zoom45 </span> </section>
        </div>
    </div>
</div>
<!-- //end Infographic Page Content -->

<!-- 03 Typography Page Content-->
<div>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="subtitle">
                <div><span>SIZES OF TITLES</span></div>
            </div>
            <h1>H1 Heading. Lorem ipsum dolor </h1>
            <h2> H2 Heading. Lorem ipsum dolor </h2>
            <h3>H3 Heading. Lorem ipsum dolor </h3>
            <h4>H4 Heading. Lorem ipsum dolor </h4>
            <h5>H5 Heading. Lorem ipsum dolor </h5>
            <h6>H6 Heading. Lorem ipsum dolor </h6>
            <br>
            <br>
            <div class="subtitle">
                <div><span>Paragraphs</span></div>
            </div>
            <p>Vestibulum eget consequat viverra ipsum, sed placerat ligula aliquam eu. Nam placerat quis felis. Nunc elementum dolor quis arcuege tistique viverra. Integer amet turpis vulputate aliquet.</p>
            <p>Morbi nec suscipit lacust. Vestibulum ante ipsum primis in faucibus orci luctus et hendrerit egets porttitor. Aliquam nusl ultricien lamcorper vulputate volutpat ipsum hendrerit sed neque sed sapien rutrum erat eget tempor mauris laoreet justo ultrices. In pellentesque lorem condimentum dui morbi pulvinar dui vulputate diam quis ornare malesuada. Vivamus pulvinar sapien sapien rutrum erat eget tempor mauris laoreet justo.</p>
            <br>
            <br>
            <div class="subtitle">
                <div><span>Dropcaps</span></div>
            </div>
            <p> <span class="dropcap"><strong>A</strong></span> Morbi nec suscipit lacust. Vestibulum ante ipsum primis in faucibus orci luctus et hendrerit egets porttitor. Aliquam nusl per erat sed nonumy diam nibh sit vulputate aliquet labore sed. Onec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcullamcorper massa pellentesque sagittis. Morbi sit amet quam. </p>
            <br>
            <p> <span class="dropcap color"><strong>A</strong></span>Morbi nec suscipit lacust. Vestibulum ante ipsum primis in faucibus orci luctus et hendrerit egets porttitor. Aliquam nusl per erat sed nonumy diam nibh sit vulputate aliquet labore sed. Onec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcullamcorper massa pellentesque sagittis. Morbi sit amet quam. </p>
            <br>
            <br>
            <div class="subtitle">
                <div><span>List</span></div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <p><strong>Unordered</strong></p>
                    <ul class="styled-list">
                        <li>Lorem ipsum dolor amet</li>
                        <li>Consectetur adipiscing elit </li>
                        <li>Integer molestie lorem massa </li>
                        <li>Facilisis in pretium nisl aliquet
                            <ul class="circle">
                                <li>Nulla volutpat aliquam velit </li>
                                <li>Phasellus iaculis neque </li>
                                <li>Purus sodales ultricies </li>
                                <li>Vestibulum laot porttitor sem </li>
                            </ul>
                        </li>
                        <li>Ac tristique libero volutpat at </li>
                        <li>Faucibus porta lacingilla vel </li>
                        <li>Eget porttitor lorem </li>
                        <li>Integer vel nibh sit amet </li>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-6">
                    <p><strong>Ordered</strong> </p>
                    <ul class="styled-list decimal">
                        <li>Lorem ipsum dolor amet</li>
                        <li>Consectetur adipiscing elit </li>
                        <li>Integer molestie lorem massa </li>
                        <li>Facilisis in pretium nisl aliquet </li>
                        <li>Nulla volutpat aliquam velit </li>
                        <li>Phasellus iaculis neque </li>
                        <li>Purus sodales ultricies </li>
                        <li>Vestibulum laot porttitor sem </li>
                        <li>Ac tristique libero volutpat at </li>
                        <li>Faucibus porta lacingilla vel </li>
                        <li>Eget porttitor lorem </li>
                        <li>Integer vel nibh sit amet </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="subtitle">
                <div><span>Heading Helper Classes</span></div>
            </div>
            <p><span class="color_mark">&nbsp;Heads up!&nbsp;</span> &nbsp;Mauris aliquet ultricies ante, non faucibus ante gravida sed. <span class="mark">Sed ultrices pellentesque purus</span>, vulputate volutpat ipsum hendrerit sed <a href="index.php" class="color underline">neque sed sapien</a> rutrum. Morbi nec suscipit lacust. Vestibulum ante ipsum primis in faucibus orci luctus et hen augue tincidunt rhoncus in <a href="index.php" class="underline">aliquet ornare malesuada</a>. Vivamus pulvinar sapien labore diam nonumy.</p>
            <div class="subtitle">
                <div><span>blockquote</span></div>
            </div>
            <div class="blockquote">
                <div class="inside">
                    <p>Curabitur convallis facilisis lorem. Vivamus euismod nulla vel nunc. Fusce tincidunt, justo congue egestas molestie, tortor tortor blandit erat, et scelerisque metus metus at ipsum. Maecenas tincidunt adipiscing tellus. Nunc tristique pede. Ut condimentum mattis est. Duis sit amet augue.  Mauris et ligula quis erat dignissim imperdiet. Integer ligula magna, senectus et netus et malesuada fames ac turpis egestas. Sed in velit et lacus ullamcorper imperdiet. Curabitur quis tortor. Proin ac risus.</p>
                </div>
            </div>
            <div class="subtitle">
                <div><span>testimonials</span></div>
            </div>
            <div class="testimonials">
                <div class="inside">
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. Mauris et ligula quis erat dignissim imperdiet. Integer ligula magna, dictum et, pulvinar non, ultricies ac, nibh. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Ut in nibh. Pellentesque habitant morbi tristique imperdiet. Curabitur quis tortor. Proin ac risus.</p>
                    <p> <strong>Matua Mohammed </strong></p>
                </div>
            </div>
            <div class="subtitle">
                <div><span>INFO BOX</span></div>
            </div>
            <div class="infobox">
                <div class="inside">
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. Mauris et ligula quis erat dignissim imperdiet. Integer ligula magna, dictum felis magna nonummy eros, quis ultrices odio lorem quis urna. Mauris sem sapien, mollis vel, cursus et, pulvinar non, ultricies ac, nibh. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Ut in nibh. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed in velit et lacus ullamcorper imperdiet. Curabitur quis tortor. Proin ac risus. </p>
                </div>
            </div>
            <br>
            <br>
            <div class="subtitle">
                <div><span>Tables</span></div>
            </div>
            <h5>Striped Table</h5>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">&nbsp; </th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name </th>
                    <th scope="col">Username</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Mark </td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Jacob </td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Larry </td>
                    <td> the Bird</td>
                    <td>@twitter</td>
                </tr>
                </tbody>
            </table>
            <br>
            <h5>Bordered Table</h5>
            <table class="table table-bordered">
                <tr>
                    <th scope="col">&nbsp; </th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name </th>
                    <th scope="col">Username</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Mark </td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Jacob </td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Larry </td>
                    <td> the Bird</td>
                    <td>@twitter</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="divider-xl"></div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="subtitle">
                <div><span>GRID</span></div>
            </div>
        </div>
        <div class="col-lg-12">
            <h5>1 COLUMN</h5>
            <p>Mauris aliquet ultricies ante, non faucibus ante gravida sed. Sed ultrices pellenlaoreet justo ultrices. In pellentesque lorem condimentum dui morbi pulvinar dui non quam pretium ut lacinia tortor. Fusce lacinia tempor malesuada. Fringilla penatibus orci est non mollit, suspendisse pulvinar egestas a donec. Vulputate mi dui suscipit, molestie vulputate libero fusce iaculis suscipit. Sapien pede libero. Maecenas lacus aliquet et nisl nunc, per sed sed maecenas.Lectus tincidunt pellentesque augue urna sit sed, arcu sed ante ac montes pellentesque consectetuer, neque magnis penatibus laoreet vehicula nulla orci, a malesuada justo laoreet ipsum, in ac fusce. At sapien neque sollicitudin lacus, dolor semper in laoreet, magnis convallis posuere adipiscing, dapibus suspendisse nonummy pellentesque consequat interdum odio.</p>
        </div>
    </div>
    <div class="divider-md"></div>
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6">
            <h5>1/2 COLUMNS</h5>
            <p>Mauris aliquet ultricies ante, non faucibus ante gravida sed. Sed ultrices pellenlaoreet justo ultrices. In pellentesque lorem condimentum dui morbi pulvinar dui non quam pretium ut lacinia tortor. Fusce lacinia tempor malesuada. Fringilla penatibus orci est non mollit, suspendisse pulvinar egestas a donec. Vulputate mi dui suscipit, molestie vulputate libero fusce iaculis suscipit. Sapien pede libero. Maecenas lacus aliquet et nisl nunc, per sed sed maecenas.Lectus tincidunt pellentesque augue urna sit sed, arcu sed ante ac montes pellentesque consectetuer, neque magnis penatibus laoreet vehicula nulla orci, a malesuada justo laoreet ipsum, in ac fusce. At sapien neque sollicitudin lacus, dolor semper in laoreet, magnis convallis posuere adipiscing, dapibus suspendisse nonummy pellentesque consequat interdum odio.</p>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6">
            <h5>1/2 COLUMNS</h5>
            <p>Mauris aliquet ultricies ante, non faucibus ante gravida sed. Sed ultrices pellenlaoreet justo ultrices. In pellentesque lorem condimentum dui morbi pulvinar dui non quam pretium ut lacinia tortor. Fusce lacinia tempor malesuada. Fringilla penatibus orci est non mollit, suspendisse pulvinar egestas a donec. Vulputate mi dui suscipit, molestie vulputate libero fusce iaculis suscipit. Sapien pede libero. Maecenas lacus aliquet et nisl nunc, per sed sed maecenas.Lectus tincidunt pellentesque augue urna sit sed, arcu sed ante ac montes pellentesque consectetuer, neque magnis penatibus laoreet vehicula nulla orci, a malesuada justo laoreet ipsum, in ac fusce. At sapien neque sollicitudin lacus, dolor semper in laoreet, magnis convallis posuere adipiscing, dapibus suspendisse nonummy pellentesque consequat interdum odio.</p>
        </div>
    </div>
    <div class="divider-md"></div>
    <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-4">
            <h5>1/3 COLUMNS</h5>
            <p>Mauris aliquet ultricies ante, non faucibus ante gravida sed. Sed ultrices pellenlaoreet justo ultrices. In pellentesque lorem condimentum dui morbi pulvinar dui non quam pretium ut lacinia tortor. Fusce lacinia tempor malesuada. Fringilla penatibus orci est non mollit, suspendisse pulvinar egestas a donec. </p>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <h5>1/3 COLUMNS</h5>
            <p>Mauris aliquet ultricies ante, non faucibus ante gravida sed. Sed ultrices pellenlaoreet justo ultrices. In pellentesque lorem condimentum dui morbi pulvinar dui non quam pretium ut lacinia tortor. Fusce lacinia tempor malesuada. Fringilla penatibus orci est non mollit, suspendisse pulvinar egestas a donec. </p>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <h5>1/3 COLUMNS</h5>
            <p>Mauris aliquet ultricies ante, non faucibus ante gravida sed. Sed ultrices pellenlaoreet justo ultrices. In pellentesque lorem condimentum dui morbi pulvinar dui non quam pretium ut lacinia tortor. Fusce lacinia tempor malesuada. Fringilla penatibus orci est non mollit, suspendisse pulvinar egestas a donec. </p>
        </div>
    </div>
    <div class="divider-md"></div>
    <div class="row">
        <div class="col-sm-8 col-md-8 col-lg-8">
            <h5>2/3 COLUMNS</h5>
            <p>Mauris aliquet ultricies ante, non faucibus ante gravida sed. Sed ultrices pellenlaoreet justo ultrices. In pellentesque lorem condimentum dui morbi pulvinar dui non quam pretium ut lacinia tortor. Fusce lacinia tempor malesuada. Fringilla penatibus orci est non mollit, suspendisse pulvinar egestas a donec. Vulputate mi dui suscipit, molestie vulputate libero fusce iaculis suscipit. Sapien pede libero. Maecenas lacus aliquet et nisl nunc, per sed sed maecenas.Lectus tincidunt pellentesque augue urna sit sed, arcu sed ante ac montes pellentesque consectetuer, neque magnis penatibus laoreet magnis convallis posuere adipiscing, dapibus suspendisse nonummy pellentesque consequat interdum odio.</p>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <h5>1/3 COLUMNS</h5>
            <p>Mauris aliquet ultricies ante, non faucibus ante gravida sed. Sed ultrices pellenlaoreet justo ultrices. In pellentesque lorem condimentum dui morbi pulvinar dui non quam pretium ut lacinia tortor. Fusce lacinia tempor malesuada. Fringilla penatibus orci est non mollit, suspendisse pulvinar egestas a donec. </p>
        </div>
    </div>
    <div class="divider-md"></div>
    <div class="row">
        <div class="col-sm-6 col-md-3 col-lg-3">
            <h5>1/4 COLUMNS</h5>
            <p>Mauris aliquet ultricies ante, non ante gravida sed. Sed ultrices pel lenlao reet justo ultrices. In pellentesque lorem con dimentum dui morbi pulvinar dui non quam pretium ut lacinia suspe ndisse pulvinar donec labore diam. </p>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3">
            <h5>1/4 COLUMNS</h5>
            <p>Mauris aliquet ultricies ante, non ante gravida sed. Sed ultrices pel lenlao reet justo ultrices. In pellentesque lorem con dimentum dui morbi pulvinar dui non quam pretium ut lacinia suspe ndisse pulvinar donec labore diam. </p>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3">
            <h5>1/4 COLUMNS</h5>
            <p>Mauris aliquet ultricies ante, non ante gravida sed. Sed ultrices pel lenlao reet justo ultrices. In pellentesque lorem con dimentum dui morbi pulvinar dui non quam pretium ut lacinia suspe ndisse pulvinar donec labore diam. </p>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3">
            <h5>1/4 COLUMNS</h5>
            <p>Mauris aliquet ultricies ante, non ante gravida sed. Sed ultrices pel lenlao reet justo ultrices. In pellentesque lorem con dimentum dui morbi pulvinar dui non quam pretium ut lacinia suspe ndisse pulvinar donec labore diam. </p>
        </div>
    </div>
    <div class="divider-md"></div>
    <div class="row">
        <div class="col-sm-9 col-md-9 col-lg-9">
            <h5>3/4 COLUMNS</h5>
            <p>Nam ac ipsum dui, a sollicitudin massa. Pellentesque semper ligula ut eros dapibus sit amet vehicula nisi tempus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eget urna sit amet sapien vestibulum auctor ac blandit erat. Sed sagittis volutpat urna nec lobortis. Aser velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in anim id est laborum. Asunt in anim uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in anim id est laborum. Allamco laboris nisi ut aliquip ex ea commodo consequat. Aser velit esse cillum dolore eu fugiat nulla pariatur.</p>
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3">
            <h5>1/4 COLUMNS</h5>
            <p>Mauris aliquet ultricies ante, non ante gravida sed. Sed ultrices pel lenlao reet justo ultrices. In pellentesque lorem con dimentum dui morbi pulvinar dui non quam pretium ut lacinia suspe ndisse pulvinar donec labore diam. </p>
        </div>
    </div>
    <div class="divider-md"></div>
    <div class="row">
        <div class="col-sm-6 col-md-2 col-lg-2">
            <h5>1/6 COLUMNS</h5>
            <p>Mauris aliquet ultrics ant, ultrices pel lenlao rejusto sed ultrices. In pellesque pretium utlore lacini et ndisse pulvinar donec labore diam. </p>
        </div>
        <div class="col-sm-6 col-md-2 col-lg-2">
            <h5>1/6 COLUMNS</h5>
            <p>Mauris aliquet ultrics ant, ultrices pel lenlao rejusto sed ultrices. In pellesque pretium utlore lacini et ndisse pulvinar donec labore diam. </p>
        </div>
        <div class="col-sm-6 col-md-2 col-lg-2">
            <h5>1/6 COLUMNS</h5>
            <p>Mauris aliquet ultrics ant, ultrices pel lenlao rejusto sed ultrices. In pellesque pretium utlore lacini et ndisse pulvinar donec labore diam. </p>
        </div>
        <div class="col-sm-6 col-md-2 col-lg-2">
            <h5>1/6 COLUMNS</h5>
            <p>Mauris aliquet ultrics ant, ultrices pel lenlao rejusto sed ultrices. In pellesque pretium utlore lacini et ndisse pulvinar donec labore diam. </p>
        </div>
        <div class="col-sm-6 col-md-2 col-lg-2">
            <h5>1/6 COLUMNS</h5>
            <p>Mauris aliquet ultrics ant, ultrices pel lenlao rejusto sed ultrices. In pellesque pretium utlore lacini et ndisse pulvinar donec labore diam. </p>
        </div>
        <div class="col-sm-6 col-md-2 col-lg-2">
            <h5>1/6 COLUMNS</h5>
            <p>Mauris aliquet ultrics ant, ultrices pel lenlao rejusto sed ultrices. In pellesque pretium utlore lacini et ndisse pulvinar donec labore diam. </p>
        </div>
    </div>
    <div class="divider-md"></div>
    <div class="row">
        <div class="col-sm-8 col-md-10 col-lg-10">
            <h5>5/6 COLUMNS</h5>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis part urient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor ullamcorper massa pellentesque sagittis. Morbi sit amet quam sed felis. Quisque vest ibulum massa. Nulla ornare. Nulla libero. Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. Integer dictum est vitae sem. </p>
        </div>
        <div class="col-sm-4 col-md-2 col-lg-2">
            <h5>1/6 COLUMNS</h5>
            <p>Mauris aliquet ultrics ant, ultrices pel lenlao rejusto sed ultrices. In pellesque pretium utlore lacini et ndisse pulvinar donec labore diam. </p>
        </div>
    </div>
</div>
</div>
<!-- //end Typography Page Content -->

<!--05 FAQ Page Content-->
<div>
    <div class="panel-group accordion-faq" id="faq-accordion">
        <div class="panel">
            <div class="panel-heading"> <a data-toggle="collapse" data-parent="#faq-accordion" href="#question1"> <span class="arrow-down">+</span> <span class="arrow-up">&#8211;</span> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. </a> </div>
            <div id="question1" class="panel-collapse collapse in">
                <div class="panel-body">
                    <p>Fusce eu dui. Integer vel nibh sit amet turpis vulputate aliquet. Phasellus id nisi vitae odio pretium aliquam. Pellentesque a leo. Donec consequat lectus sed felis. Quisque vestibulum massa. Nulla ornare. Nulla libero. Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. Integer dictum est vitae sem.  Vestibulum justo. Nulla mauris ipsum, convallis ut, vestibulum eu, tincidunt vel, nisi. </p>
                    <p>Curabitur molestie euismod erat. Proin eros odio, mattis rutrum, pulvinar et, egestas vitae, magna. Integer semper, velit ut interdum malesuada, diam dolor pellentesque lacus, vitae commodo orci nec, dolor. Nullam id justo sed diam aliquam tincidunt. Duis sollicitudin, dui ac commodo iaculis, mi risus sagittis odio, vel ultrices enim sem ut pede. Aenean quam. Nulla neque purus, ullamcorper nec, eleifend at, fermentum ut, turpis. Mauris et ligula quis erat dignissim imperdiet. Integer ligula magna, dictum et, pulvinar non, ultricies ac, nibh. </p>
                </div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-heading"> <a data-toggle="collapse" data-parent="#faq-accordion" href="#question2" class="collapsed"> <span class="arrow-down">+</span> <span class="arrow-up">&#8211;</span> Vestibulum justo. Nulla mauris ipsum, pulvinar non, ultricies ac, nibh convallis ut, vestibulum eu, tincidunt vel, nisi.</a> </div>
            <div id="question2" class="panel-collapse collapse">
                <div class="panel-body"> Vestibulum justo. Nulla mauris ipsum, convallis ut, vestibulum eu, tincidunt vel, nisi. Curabitur molestie euismod erat. Proin eros odio, mattis rutrum, pulvinar et, egestas vitae, magna. Integer semper, velit ut interdum malesuada, diam dolor pellentesque lacus, vitae commodo orci nisi et sem. Pellentesque adipiscing nisi. Nulla facilisi. Mauris lacinia lectus sit amet felis. Aliquam erat volutpat. Nulla porttitor tortor at nisl. Nam lectus nulla, bibendum pretium, dictum a, mattis nec, dolor. Nullam id justo sed diam aliquam tincidunt. Duis sollicitudin, dui ac commodo iaculis, mi risus sagittis odio, vel ultrices enim sem ut pede. Aenean quam. Nulla neque purus, ullamcorper nec, eleifend at, fermentum ut, turpis. Mauris et ligula quis erat dignissim imperdiet. Integer ligula magna, dictum et, pulvinar non, ultricies ac, nibh.
                </div>
            </div>
        </div><div class="panel">
        <div class="panel-heading"> <a data-toggle="collapse" data-parent="#faq-accordion" href="#question3" class="collapsed"> <span class="arrow-down">+</span> <span class="arrow-up">&#8211;</span> Fusce eu dui. Integer vel nibh sit amet turpis vulputate aliquet. Phasellus id nisi vitae odio pretium aliquam. Pellentesque a leo. Donec consequat lectus sed felis. Quisque vestibulum massa. Nulla ornare.</a> </div>
        <div id="question3" class="panel-collapse collapse">
            <div class="panel-body"> Vestibulum justo. Nulla mauris ipsum, convallis ut, vestibulum eu, tincidunt vel, nisi. Curabitur molestie euismod erat. Proin eros odio, mattis rutrum, pulvinar et, egestas vitae, magna. Integer semper, velit ut interdum malesuada, diam dolor pellentesque lacus, vitae commodo orci nisi et sem. Pellentesque adipiscing nisi. Nulla facilisi. Mauris lacinia lectus sit amet felis. Aliquam erat volutpat. Nulla porttitor tortor at nisl. Nam lectus nulla, bibendum pretium, dictum a, mattis nec, dolor. Nullam id justo sed diam aliquam tincidunt. Duis sollicitudin, dui ac commodo iaculis, mi risus sagittis odio, vel ultrices enim sem ut pede. Aenean quam. Nulla neque purus, ullamcorper nec, eleifend at, fermentum ut, turpis. Mauris et ligula quis erat dignissim imperdiet. Integer ligula magna, dictum et, pulvinar non, ultricies ac, nibh.
            </div>
        </div>
    </div><div class="panel">
        <div class="panel-heading"> <a data-toggle="collapse" data-parent="#faq-accordion" href="#question4" class="collapsed"> <span class="arrow-down">+</span> <span class="arrow-up">&#8211;</span> Curabitur convallis facilisis lorem. Vivamus euismod nulla vel nunc. Fusce tincidunt, justo congue egestas molestie, tortor tortor blandit erat, et scelerisque metus metus at ipsum.</a> </div>
        <div id="question4" class="panel-collapse collapse">
            <div class="panel-body"> Vestibulum justo. Nulla mauris ipsum, convallis ut, vestibulum eu, tincidunt vel, nisi. Curabitur molestie euismod erat. Proin eros odio, mattis rutrum, pulvinar et, egestas vitae, magna. Integer semper, velit ut interdum malesuada, diam dolor pellentesque lacus, vitae commodo orci nisi et sem. Pellentesque adipiscing nisi. Nulla facilisi. Mauris lacinia lectus sit amet felis. Aliquam erat volutpat. Nulla porttitor tortor at nisl. Nam lectus nulla, bibendum pretium, dictum a, mattis nec, dolor. Nullam id justo sed diam aliquam tincidunt. Duis sollicitudin, dui ac commodo iaculis, mi risus sagittis odio, vel ultrices enim sem ut pede. Aenean quam. Nulla neque purus, ullamcorper nec, eleifend at, fermentum ut, turpis. Mauris et ligula quis erat dignissim imperdiet. Integer ligula magna, dictum et, pulvinar non, ultricies ac, nibh.
            </div>
        </div>
    </div><div class="panel">
        <div class="panel-heading"> <a data-toggle="collapse" data-parent="#faq-accordion" href="#question5" class="collapsed"> <span class="arrow-down">+</span> <span class="arrow-up">&#8211;</span> Ut in nibh. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed in velit et lacus ullamcorper imperdiet. Curabitur quis tortor. Proin ac risus.</a> </div>
        <div id="question5" class="panel-collapse collapse">
            <div class="panel-body"> Vestibulum justo. Nulla mauris ipsum, convallis ut, vestibulum eu, tincidunt vel, nisi. Curabitur molestie euismod erat. Proin eros odio, mattis rutrum, pulvinar et, egestas vitae, magna. Integer semper, velit ut interdum malesuada, diam dolor pellentesque lacus, vitae commodo orci nisi et sem. Pellentesque adipiscing nisi. Nulla facilisi. Mauris lacinia lectus sit amet felis. Aliquam erat volutpat. Nulla porttitor tortor at nisl. Nam lectus nulla, bibendum pretium, dictum a, mattis nec, dolor. Nullam id justo sed diam aliquam tincidunt. Duis sollicitudin, dui ac commodo iaculis, mi risus sagittis odio, vel ultrices enim sem ut pede. Aenean quam. Nulla neque purus, ullamcorper nec, eleifend at, fermentum ut, turpis. Mauris et ligula quis erat dignissim imperdiet. Integer ligula magna, dictum et, pulvinar non, ultricies ac, nibh.
            </div>
        </div>
    </div><div class="panel">
        <div class="panel-heading"> <a data-toggle="collapse" data-parent="#faq-accordion" href="#question6" class="collapsed"> <span class="arrow-down">+</span> <span class="arrow-up">&#8211;</span>Cras pellentesque. Fusce ullamcorper, pede eget pellentesque venenatis, felis magna nonummy eros, quis ultrices odio lorem quis urna. Mauris sem sapien, mollis vel, cursus vitae, ornare in, dolor. Sed semper tortor.</a> </div>
        <div id="question6" class="panel-collapse collapse">
            <div class="panel-body"> Vestibulum justo. Nulla mauris ipsum, convallis ut, vestibulum eu, tincidunt vel, nisi. Curabitur molestie euismod erat. Proin eros odio, mattis rutrum, pulvinar et, egestas vitae, magna. Integer semper, velit ut interdum malesuada, diam dolor pellentesque lacus, vitae commodo orci nisi et sem. Pellentesque adipiscing nisi. Nulla facilisi. Mauris lacinia lectus sit amet felis. Aliquam erat volutpat. Nulla porttitor tortor at nisl. Nam lectus nulla, bibendum pretium, dictum a, mattis nec, dolor. Nullam id justo sed diam aliquam tincidunt. Duis sollicitudin, dui ac commodo iaculis, mi risus sagittis odio, vel ultrices enim sem ut pede. Aenean quam. Nulla neque purus, ullamcorper nec, eleifend at, fermentum ut, turpis. Mauris et ligula quis erat dignissim imperdiet. Integer ligula magna, dictum et, pulvinar non, ultricies ac, nibh.
            </div>
        </div>
    </div>  <div class="panel">
        <div class="panel-heading"> <a data-toggle="collapse" data-parent="#faq-accordion" href="#question7" class="collapsed"> <span class="arrow-down">+</span> <span class="arrow-up">&#8211;</span>Donec consequat lectus sed felis. Quisque vestibulum massa. Nulla ornare. Nulla libero. Donec et mi eu massa ultrices scelerisque.</a> </div>
        <div id="question7" class="panel-collapse collapse">
            <div class="panel-body"> Vestibulum justo. Nulla mauris ipsum, convallis ut, vestibulum eu, tincidunt vel, nisi. Curabitur molestie euismod erat. Proin eros odio, mattis rutrum, pulvinar et, egestas vitae, magna. Integer semper, velit ut interdum malesuada, diam dolor pellentesque lacus, vitae commodo orci nisi et sem. Pellentesque adipiscing nisi. Nulla facilisi. Mauris lacinia lectus sit amet felis. Aliquam erat volutpat. Nulla porttitor tortor at nisl. Nam lectus nulla, bibendum pretium, dictum a, mattis nec, dolor. Nullam id justo sed diam aliquam tincidunt. Duis sollicitudin, dui ac commodo iaculis, mi risus sagittis odio, vel ultrices enim sem ut pede. Aenean quam. Nulla neque purus, ullamcorper nec, eleifend at, fermentum ut, turpis. Mauris et ligula quis erat dignissim imperdiet. Integer ligula magna, dictum et, pulvinar non, ultricies ac, nibh.
            </div>
        </div>
    </div>
    </div>
</div>
<!--// end 05 FAQ Page Content-->

<!--06 Prices Page Content-->
<div>
    <div class="row noGutter">
        <div class="col-sm-6 col-md-3">
            <div class="price-table">
                <div class="price-table-title">FREE</div>
                <div class="price-table-price">$19 </div>
                <ul class="price-table-info">
                    <li>512 mb</li>
                    <li>Vestibulum justo. Nulla mauris ipsum convallis
                        ut, vestibulum eu, tincidunt euismod erat</li>
                </ul> <button class="btn btn-cool btn-md" onclick="location.href='index.php';">BUY NOW</button>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="price-table">
                <div class="price-table-title">ECONOM</div>
                <div class="price-table-price">$29 </div>
                <ul class="price-table-info">
                    <li>1 gb</li>
                    <li>Vestibulum justo. Nulla mauris ipsum convallis
                        ut, vestibulum eu, tincidunt euismod erat</li>
                </ul> <button class="btn btn-cool btn-md" onclick="location.href='index.php';">BUY NOW</button>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="price-table active">
                <div class="price-table-title">PREMIUM</div>
                <div class="price-table-price">$59 </div>
                <ul class="price-table-info">
                    <li>2 gb</li>
                    <li>Vestibulum justo. Nulla mauris ipsum convallis
                        ut, vestibulum eu, tincidunt euismod erat</li>
                </ul> <button class="btn btn-cool btn-md" onclick="location.href='index.php';">BUY NOW</button>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="price-table">
                <div class="price-table-title">ADVANCED</div>
                <div class="price-table-price">$79 </div>
                <ul class="price-table-info">
                    <li>4 gb</li>
                    <li>Vestibulum justo. Nulla mauris ipsum convallis
                        ut, vestibulum eu, tincidunt euismod erat</li>
                </ul> <button class="btn btn-cool btn-md" onclick="location.href='index.php';">BUY NOW</button>
            </div>
        </div>
    </div>
    <div class="subtitle">
        <div><span>SEPARATE BLOCKS</span></div>
    </div>
    <div class="divider divider-sm"></div>
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="price-table">
                <div class="price-table-title">FREE</div>
                <div class="price-table-price">$19 </div>
                <ul class="price-table-info">
                    <li>512 mb</li>
                    <li>Vestibulum justo. Nulla mauris convallis<br>
                        ut, vestibulum eu, tincidunt euismod</li>
                </ul> <button class="btn btn-cool btn-md" onclick="location.href='index.php';">BUY NOW</button>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="price-table active">
                <div class="price-table-title">ECONOM</div>
                <div class="price-table-price">$29 </div>
                <ul class="price-table-info">
                    <li>1 gb</li>
                    <li>Vestibulum justo. Nulla mauris convallis<br>
                        ut, vestibulum eu, tincidunt euismod</li>
                </ul> <button class="btn btn-cool btn-md" onclick="location.href='index.php';">BUY NOW</button>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="price-table">
                <div class="price-table-title">PREMIUM</div>
                <div class="price-table-price">$59 </div>
                <ul class="price-table-info">
                    <li>2 gb</li>
                    <li>Vestibulum justo. Nulla mauris convallis<br>
                        ut, vestibulum eu, tincidunt euismod</li>
                </ul> <button class="btn btn-cool btn-md" onclick="location.href='index.php';">BUY NOW</button>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="price-table">
                <div class="price-table-title">ADVANCED</div>
                <div class="price-table-price">$79 </div>
                <ul class="price-table-info">
                    <li>4 gb</li>
                    <li>Vestibulum justo. Nulla mauris convallis<br>
                        ut, vestibulum eu, tincidunt euismod</li>
                </ul> <button class="btn btn-cool btn-md" onclick="location.href='index.php';">BUY NOW</button>
            </div>
        </div>
    </div>
</div>
<!-- //end 06 Prices Content -->

<!--07 Our office Page Content-->
<div>
    <section>
        <img src="image/catalog/blocks/img-our-office.jpg" alt="" class="animate scale full-width text-center">
    </section>
    <section class="container content">
        <div class="divider-sm"></div><div class="row">
        <div class="col-sm-4 col-md-4 col-lg-4">
            <iframe style="width:100%; height: 270px; margin: 0; border: 0; overflow:hidden;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d28038.165053806308!2d-81.36288248825763!3d28.546613186851783!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf3846176f3dff5ed!2sLa+Aurora!5e0!3m2!1sen!2sus!4v1416911810902"></iframe>
        </div>
        <div class="divider-md visible-xs"></div>
        <div class="col-sm-8 col-md-8 col-lg-8">
            <h2>ABOUT OUR OFFICE</h2>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros   tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit   amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor   vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque   penatibus et magnis dis parturient montes, nascetur ridiculus mus.   Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse   fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam   lectus. Morbi eget dolor sagittis. Morbi sit amet quam. Nulla libero. <br>
            </p>
            <p class="upper">Donec et mi eu massa ultrices scelerisque. </p>
            <p class="upper">Nullam ac nisi non eros gravida venenatis sollicitudin lobortis </p>
            <p class="upper">Curabitur convallis facilisis lorem. Vivamus euismod nulla vel nunc </p>
            <p class="upper">Fusce tincidunt, justo congue egestas</p>
            <p>Donec et mi eu massa ultrices scelerisque. Nullam ac nisi   non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis   pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. </p>
        </div>
    </div><div class="divider-xl"></div>
        <div class="subtitle">
            <div><span>OUR TEAM</span></div>
        </div>

    </section><div class="images-gallery four-columns">
    <div class="images-nospace team-gallery">
        <div class="image-thumbnail"><img src="image/catalog/blocks/team-member-01.jpg" alt="">
            <div class="hover">
                <div class="inside">
                    <h4>Mike Williams </h4>
                    <h5>Manager </h5>
                    <ul class="socials socials-lg">
                        <li><a href="index.php"><span class="icon flaticon-facebook12"></span></a></li>
                        <li><a href="index.php"><span class="icon flaticon-twitter20"></span></a></li>
                        <li><a href="index.php"><span class="icon flaticon-google10"></span></a></li>
                        <li><a href="index.php"><span class="icon flaticon-pinterest9"></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="image-thumbnail"> <img src="image/catalog/blocks/team-member-02.jpg" alt="">
            <div class="hover"><div class="inside">
                <h4>Matthew Davies </h4>
                <h5>Manager </h5>
                <ul class="socials socials-lg">
                    <li><a href="index.php"><span class="icon flaticon-facebook12"></span></a></li>
                    <li><a href="index.php"><span class="icon flaticon-twitter20"></span></a></li>
                    <li><a href="index.php"><span class="icon flaticon-google10"></span></a></li>
                    <li><a href="index.php"><span class="icon flaticon-pinterest9"></span></a></li>
                </ul>
            </div></div>
        </div>
        <div class="image-thumbnail"> <img src="image/catalog/blocks/team-member-03.jpg" alt="">
            <div class="hover"><div class="inside">
                <h4>Ryan Thomas </h4>
                <h5>Manager </h5>
                <ul class="socials socials-lg">
                    <li><a href="index.php"><span class="icon flaticon-facebook12"></span></a></li>
                    <li><a href="index.php"><span class="icon flaticon-twitter20"></span></a></li>
                    <li><a href="index.php"><span class="icon flaticon-google10"></span></a></li>
                    <li><a href="index.php"><span class="icon flaticon-pinterest9"></span></a></li>
                </ul>
            </div></div>
        </div>
        <div class="image-thumbnail"><img src="image/catalog/blocks/team-member-04.jpg" alt="">
            <div class="hover"><div class="inside">
                <h4>Emma Smith</h4>
                <h5>Manager </h5>
                <ul class="socials socials-lg">
                    <li><a href="index.php"><span class="icon flaticon-facebook12"></span></a></li>
                    <li><a href="index.php"><span class="icon flaticon-twitter20"></span></a></li>
                    <li><a href="index.php"><span class="icon flaticon-google10"></span></a></li>
                    <li><a href="index.php"><span class="icon flaticon-pinterest9"></span></a></li>
                </ul>
            </div></div>
        </div>
    </div>
</div>

</div>
<!--// end 07 Our office Page Content-->

<!--08 Our story Page Content-->
<div class="content">
    <div class="subtitle">
        <div><span>Our story</span></div>
    </div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6115.684863819771!2d-82.9719195443651!3d39.96727545833253!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf3846176f3dff5ed!2sLa+Aurora!5e0!3m2!1sen!2sus!4v1416911994304" class="google-map"></iframe>      <div class="row">
    <div class="divider-lg"></div>
    <div class="col-sm-6 col-md-6">
        <div class="subtitle">
            <div><span>aBOUT OUR STORE</span></div>
        </div>
        <p><strong>Vestibulum justo. Nulla mauris ipsum, convallis ut, vestibulum eu, tincidunt vel, nisi. Curabitur molestie euismod erat. Proin eros odio, mattis rutrum, pulvinar et, egestas vitae, magna. Integer semper, velit ut interdum malesuada. </strong></p>
        <p>Pellentesque adipiscing nisi. Nulla facilisi. Mauris lacinia lectus sit amet felis. Aliquam erat volutpat. Nulla porttitor tortor at nisl. Nam lectus nulla, bibendum pretium, dictum a, mattis nec, dolor. Nullam id justo enim sem ut pede. Aenean quam. Nulla neque purus, ullamcorper nec, eleifend at, fermentum ut, turpis. Mauris et ligula quis erat dignissim imperdiet. Integer ligula magna, dictum et, pulvinar non, ultricies ac, nibh. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. </p>
        <p>Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis parturient montes.</p>
        <p></p>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="subtitle">
            <div><span>SPECIAL INFORMATION</span></div>
        </div>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor sagittis. Morbi sit amet quam. Nulla libero. </p>
        <p class="upper">Donec et mi eu massa ultrices scelerisque. </p>
        <p class="upper">Nullam ac nisi non eros gravida venenatis sollicitudin lobortis </p>
        <p class="upper">Curabitur convallis facilisis lorem. Vivamus euismod nulla vel nunc</p>
        <p class="upper">Fusce tincidunt, justo congue egestas</p>
    </div>
</div>
    <div class="divider-xl"></div>
    <div class="row">
        <div class="col-sm-3 col-md-3 col-lg-3"> <img class="img-responsive animate scale" src="image/catalog/blocks/img-our-store.jpg" alt=""> </div>
        <div class="divider-md visible-xs"></div>
        <div class="col-sm-5 col-md-6 col-lg-6">
            <h3>Lorem ipsum dolor</h3>
            <p>Vestibulum justo. Nulla mauris ipsum, convallis ut, vestibulum eu, tincidunt vel, nisi. Curabitur molestie euismod erat. Proin eros odio, mattis rutrum, pulvinar et, porttitor tortor at nisl. Nam Nullam id justo sed diam aliquam tincidunt. Duis sollicitudin, dui ac commodo iaculis tincidunt.<br>
                Aenean quam. Nulla neque purus, ullamcorper nec, eleifend at, fermentum ut, turpis. Mauris et magna, dictum et, pulvinar non, ultricies ac, nibh. <br>
            </p>
            <p class="upper">Donec et mi eu massa ultrices scelerisque. </p>
            <p class="upper">Nullam ac nisi non eros gravida venenatis sollicitudin lobortis </p>
            <p class="upper">Curabitur convallis facilisis lorem. Vivamus euismod nulla vel nunc</p>
            <p class="upper">Fusce tincidunt, justo congue egestas </p>
            <p>Vestibulum justo. Nulla mauris ipsum, convallis ut, vestibulum eu, tincidunt vel, nisi. Curabitur molestie euismod erat. Proin eros odio, mattis rutrum, pulvinar et, egestas vitae, magna. Integer semper, velit ut interdum malesuada.  Pellentesque adipiscing nisi. Nulla facilisi. Mauris lacinia lectus sit amet felis. Aliquam erat volutpat.</p>
            <br>
            <p><a href="index.php" class="btn btn-lg btn-cool">GET STARTED NOW!</a> </p>
        </div>
        <div class="divider-md visible-xs"></div>
        <div class="col-sm-4 col-md-3 col-lg-3 text-center">
            <div class="rect">
                <div class="animate scale icon-outer"><span class="icon flaticon-clock61"></span></div>
                <h6><strong></strong>OPENING TIME</h6>
                <p>Vestibulum justo. Nulla mauris ipsum, convallis ut, vestibulum eu, tincidunt vel, nisi. Curabitur molestie euismod erat. Proin eros odio, mattis rutrum, </p>
                <div class="line-divider"></div>
                <div class="divider-xs"></div>
                <h6>Mon-Sat: 10am-8pm<br>
                    Sun: 11.30am-5pm</h6>
            </div>
        </div>
    </div>
</div>

<!-- //end 08 Our story  Page Content -->

<!--09 our team Page Content-->
<div>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="row">
                        <div class="col-xs-4 col-sm-6 col-md-6 col-lg-7"><img src="image/catalog/blocks/team-member-02.jpg" alt="" class="img-responsive animate scale"></div>
                        <div class="col-xs-8 col-sm-6 col-md-6 col-lg-5">
                            <h2>Mike Williams<span class="sub-header">Manager</span></h2>
                            <p>Maecenas eu enim in lorem scelerisq
                                ue auctor. Ut non erat. Suspendisse fermentum posuere lectus vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor pellentesque, libero massa dapibus dui, eu.</p>
                            <p class="upper">Donec et mi eu massa ultrices <br>
                                Nullam ac nisi non eros gravida <br>
                                Curabitur convallis facilisis lor<br>
                                Fusce tincidunt to congue </p>
                            <ul class="socials socials-lg space">
                                <li><a href="index.php"><span class="icon flaticon-facebook12"></span></a></li>
                                <li><a href="index.php"><span class="icon flaticon-twitter20"></span></a></li>
                                <li><a href="index.php"><span class="icon flaticon-google10"></span></a></li>
                                <li><a href="index.php"><span class="icon flaticon-pinterest9"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="divider-sm visible-sm visible-xs"></div>
                <div class="col-sm-12 col-md-6">
                    <div class="row">
                        <div class="col-xs-4 col-sm-6 col-md-6 col-lg-7"><img src="image/catalog/blocks/team-member-04.jpg" alt="" class="img-responsive animate scale"></div>
                        <div class="col-xs-8 col-sm-6 col-md-6 col-lg-5">
                            <h2>Mike Williams<span class="sub-header">Manager</span></h2>
                            <p>Maecenas eu enim in lorem scelerisq
                                ue auctor. Ut non erat. Suspendisse fermentum posuere lectus vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor pellentesque, libero massa dapibus dui, eu.</p>
                            <p class="upper">Donec et mi eu massa ultrices <br>
                                Nullam ac nisi non eros gravida <br>
                                Curabitur convallis facilisis lor<br>
                                Fusce tincidunt to congue </p>
                            <ul class="socials socials-lg space">
                                <li><a href="index.php"><span class="icon flaticon-facebook12"></span></a></li>
                                <li><a href="index.php"><span class="icon flaticon-twitter20"></span></a></li>
                                <li><a href="index.php"><span class="icon flaticon-google10"></span></a></li>
                                <li><a href="index.php"><span class="icon flaticon-pinterest9"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <div class="divider-xl"></div>
        <div class="grey-container">
            <div class="container">
                <div class="col-lg-9">
                    <p><strong>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. </strong></p>
                    <p>Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. Cras pellentesque. Fusce sed molestie molestie, enim urna vehicula magna, eu venenatis velit nunc eget justo. Aenean dapibus, pede ac blandit tincidunt, ante nisi viverra libero, sit amet iaculis nisi tortor non orci. Ut in nibh.</p>
                </div>
                <div class="col-lg-3"> <a href="index.php" class="btn btn-cool btn-lg">GET STARTED NOW!</a></div>
            </div>
        </div>
        <div class="divider-md"></div>
        <div class="container"></div>
    <div class="images-gallery four-columns">
        <div class="images-nospace team-gallery">
            <div class="image-thumbnail"><img src="image/catalog/blocks/team-member-01.jpg" alt="">
                <div class="hover">
                    <div class="inside">
                        <h4>Mike Williams </h4>
                        <h5>Manager </h5>
                        <ul class="socials socials-lg">
                            <li><a href="index.php"><span class="icon flaticon-facebook12"></span></a></li>
                            <li><a href="index.php"><span class="icon flaticon-twitter20"></span></a></li>
                            <li><a href="index.php"><span class="icon flaticon-google10"></span></a></li>
                            <li><a href="index.php"><span class="icon flaticon-pinterest9"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="image-thumbnail"> <img src="image/catalog/blocks/team-member-02.jpg" alt="">
                <div class="hover">
                    <div class="inside">
                        <h4>Matthew Davies </h4>
                        <h5>Manager </h5>
                        <ul class="socials socials-lg">
                            <li><a href="index.php"><span class="icon flaticon-facebook12"></span></a></li>
                            <li><a href="index.php"><span class="icon flaticon-twitter20"></span></a></li>
                            <li><a href="index.php"><span class="icon flaticon-google10"></span></a></li>
                            <li><a href="index.php"><span class="icon flaticon-pinterest9"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="image-thumbnail"> <img src="image/catalog/blocks/team-member-03.jpg" alt="">
                <div class="hover">
                    <div class="inside">
                        <h4>Ryan Thomas </h4>
                        <h5>Manager </h5>
                        <ul class="socials socials-lg">
                            <li><a href="index.php"><span class="icon flaticon-facebook12"></span></a></li>
                            <li><a href="index.php"><span class="icon flaticon-twitter20"></span></a></li>
                            <li><a href="index.php"><span class="icon flaticon-google10"></span></a></li>
                            <li><a href="index.php"><span class="icon flaticon-pinterest9"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="image-thumbnail"><img src="image/catalog/blocks/team-member-04.jpg" alt="">
                <div class="hover">
                    <div class="inside">
                        <h4>Emma Smith</h4>
                        <h5>Manager </h5>
                        <ul class="socials socials-lg">
                            <li><a href="index.php"><span class="icon flaticon-facebook12"></span></a></li>
                            <li><a href="index.php"><span class="icon flaticon-twitter20"></span></a></li>
                            <li><a href="index.php"><span class="icon flaticon-google10"></span></a></li>
                            <li><a href="index.php"><span class="icon flaticon-pinterest9"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- //end 09 our team Page Content -->

<!--11 delivery Page Content-->
<div>
    <section class="container content">
        <div class="subtitle">
            <div><span>Delivery</span></div>
        </div>
        <div class="row">
            <div class="col-sm-5 col-md-4 col-lg-4"> <img class="img-responsive animate scale" src="image/catalog/blocks/img-delivery.jpg" alt=""> </div>
            <div class="divider-md visible-xs"></div>
            <div class="col-sm-7 col-md-8 col-lg-8">
                <h2>ORder CONFIRMATION</h2>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor sagittis. Morbi sit amet quam. Nulla libero. <br>
                </p>
                <p class="upper">Donec et mi eu massa ultrices scelerisque. </p>
                <p class="upper">Nullam ac nisi non eros gravida venenatis sollicitudin lobortis </p>
                <p class="upper">Curabitur convallis facilisis lorem. Vivamus euismod nulla vel nunc </p>
                <p>Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. </p>
            </div>
        </div>
    </section>
    <section class="container content">
        <div class="row">
            <div class="col-sm-6 col-md-6">        <div class="subtitle">
                <div><span>ORder CONFIRMATION</span></div>
            </div>
                <p><strong>Free Delivery. </strong><br>
                    Vestibulum justo. Nulla mauris ipsum, convallis ut, vestibulum eu, tincidunt vel, nisi. Curabitur molestie euismod erat. Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui.
                </p>
                <p><strong>Standard Mainland Delivery. </strong><br>
                    Proin eros odio, mattis rutrum, pulvinar et, egestas vitae, magna. Integer semper, velit ut interdum maletudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. </p>
                <p><strong>Express Delivery. </strong><br>
                    Mauris lacinia lectus sit amet felis. Aliquam erat volutpat. Nulla porttitor tortor at nisl. Nam lectus nulla, bibendum pretium, dictum a, mattis nec, dolor.</p>
                <p><a href="index.php" class="btn btn-cool">more info</a> </p>


            </div><div class="col-sm-6 col-md-6">        <div class="subtitle">
            <div><span>RETURNS AND EXCHANGES</span></div>
        </div>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor sagittis. Morbi sit amet quam. Nulla libero. </p>
            <p class="upper">Donec et mi eu massa ultrices scelerisque. </p>
            <p class="upper">Nullam ac nisi non eros gravida venenatis sollicitudin lobortis </p>
            <p class="upper">Curabitur convallis facilisis lorem. Vivamus euismod nulla vel nunc</p>
            <p class="upper">Fusce tincidunt, justo congue egestas</p>
        </div></div>
    </section>

</div>
<!-- //end 11 delivery Page Content -->

<!--12 Services Page Content-->
<div>
        <div class="grey-container">
            <div class="container">
                <div class="col-lg-9">
                    <p><strong>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. </strong></p>
                    <p>Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. Cras pellentesque. Fusce sed molestie molestie, enim urna vehicula magna, eu venenatis velit nunc eget justo. Aenean dapibus, pede ac blandit tincidunt, ante nisi viverra libero, sit amet iaculis nisi tortor non orci. Ut in nibh.</p>
                </div>
                <div class="col-lg-3"> <a href="index.php" class="btn btn-cool btn-lg">GET STARTED NOW!</a></div>
            </div>
        </div>
        <div class="divider-md"></div>
            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-4 text-center">
                    <div class="rect-noborder">
                        <div class="animate scale">
                            <div class="number icon-outer"><span class="icon  icon-xl flaticon-welldone"></span>254</div>
                        </div>
                        <h6><strong>Happy Customers</strong></h6>
                        <p>Aliquam lectus. Morbi eget massa dapibus dui, urna et mi. Cras pellentesque. Fusce sed molestie molestie, enim urna vehicula magna, eu venenatis velit nunc eget justo. </p>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4 text-center">
                    <div class="rect-noborder">
                        <div class="animate scale">
                            <div class="number icon-outer"><span class="icon flaticon-brief"></span>&nbsp;42</div>
                        </div>
                        <h6><strong>Amazing Works</strong></h6>
                        <p>Aliquam lectus. Morbi eget massa dapibus dui, urna et mi. Cras pellentesque. Fusce sed molestie molestie, enim urna vehicula magna, eu venenatis velit nunc eget justo. </p>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4 text-center">
                    <div class="rect-noborder">
                        <div class="animate scale">
                            <div class="number icon-outer"><span class="icon flaticon-group41"></span>1842</div>
                        </div>
                        <h6><strong>Followers</strong></h6>
                        <p>Aliquam lectus. Morbi eget massa dapibus dui, urna et mi. Cras pellentesque. Fusce sed molestie molestie, enim urna vehicula magna, eu venenatis velit nunc eget justo. </p>
                    </div>
                </div>
            </div>
    <div class="line-divider"></div>
    <div class="divider-sm"></div>
    <section class="content">
        <div class="row">
            <div class="col-sm-5 col-md-5 col-lg-5"> <img class="img-responsive animate scale" src="image/catalog/blocks/img-services.jpg" alt=""> </div>
            <div class="divider-md visible-xs"></div>
            <div class="col-sm-7 col-md-7 col-lg-7">
                <h2>lorem ipsum dolor</h2>
                <p><strong>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. </strong></p>
                <p>Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. Cras pellentesque. Fusce sed molestie molestie, enim urna vehicula magna, eu venenatis velit nunc eget justo. Aenean dapibus, pede ac blandit tincidunt, ante nisi viverra libero, sit amet iaculis nisi tortor non orci. Ut in nibh.</p>
                <p class="upper">Donec et mi eu massa ultrices scelerisque. </p>
                <p class="upper">Nullam ac nisi non eros gravida venenatis sollicitudin lobortis </p>
                <p class="upper">Curabitur convallis facilisis lorem. Vivamus euismod nulla vel nunc </p>
                <p><a href="index.php" class="btn btn-cool">more info</a> </p>
            </div>
        </div>
        <div class="divider-xl"></div>
        <div class="row">
            <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="overflow">
                    <div class="chart-outer"> <span class="chart" data-percent="86">67%</span></div>
                    <h6><strong>WEBDESIGN</strong></h6>
                    <p>In est arcu vitae sollicitudin eu, vehicula venenatis est ante ipsum primis in faucibus orci luctus</p>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="overflow">
                    <div class="chart-outer"> <span class="chart" data-percent="31">31%</span></div>
                    <h6><strong>Illustration</strong></h6>
                    <p>In est arcu vitae sollicitudin eu, vehicula venenatis est ante ipsum primis in faucibus orci luctus</p>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="overflow">
                    <div class="chart-outer"> <span class="chart" data-percent="11">11%</span></div>
                    <h6><strong>Polygraphy</strong></h6>
                    <p>In est arcu vitae sollicitudin eu, vehicula venenatis est ante ipsum primis in faucibus orci luctus</p>
                </div>
            </div>
        </div>
        <div class="divider-md"></div>
        <div class="row">
            <div class="col-sm-6 col-md-3 col-lg-3 text-center">
                <div class="rect">
                    <div class="animate scale icon-outer"><span class="icon flaticon-attachment13"></span></div>
                    <h6><strong>Ut sit amet turpis</strong></h6>
                    <p>In est arcu vitae sollicitudin eu, vehicula venenatis est tempor diam</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 text-center">
                <div class="rect">
                    <div class="animate scale icon-outer"><span class="icon flaticon-shopping155"></span></div>
                    <h6><strong>Ut sit amet turpis</strong></h6>
                    <p>In est arcu vitae sollicitudin eu, vehicula venenatis est tempor diam</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 text-center">
                <div class="rect">
                    <div class="animate scale icon-outer"><span class="icon flaticon-settings9"></span></div>
                    <h6><strong>Ut sit amet turpis</strong></h6>
                    <p>Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 text-center">
                <div class="rect">
                    <div class="animate scale icon-outer"><span class="icon flaticon-global10"></span></div>
                    <h6><strong>Ut sit amet turpis</strong></h6>
                    <p>In est arcu vitae sollicitudin eu, vehicula venenatis est tempor diam</p>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- //end 12 Services  Page Content -->

<!--13 video Page Content-->
<div>
        <div class="grey-container">
            <div class="container">
                <div class="col-lg-9">
                    <p><strong>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. </strong></p>
                    <p>Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. Cras pellentesque. Fusce sed molestie molestie, enim urna vehicula magna, eu venenatis velit nunc eget justo. Aenean dapibus, pede ac blandit tincidunt, ante nisi viverra libero, sit amet iaculis nisi tortor non orci. Ut in nibh.</p>
                </div>
                <div class="col-lg-3"> <a href="index.php" class="btn btn-cool btn-lg">GET STARTED NOW!</a></div>
            </div>
        </div>

        <div class="videoWrapperFull">
            <div class="video-hover"></div>
            <div class="video-hover-color"></div>
            <div class="video-text">
                <div class="title">SECTIONS WITH VIDEO BACKGROUND </div>
                Fusce eu dui. Integer vel nibh sit amet turpis vulputate aliquet.
                Phasellus id nisi vitae odio pretium aliquam. Pellentesque a leo. Donec consequat lectus sed felis. <br>
                Quisque vestibulum massa. Nulla ornare. </div>
            <video controls="controls" preload="auto" loop="1" autoplay="1" class="video-autoplay">
                <source src="image/catalog/skin_landing/video/video.mp4">
            </video>
        </div>
    <section class="content">
        <div class="row">
            <div class="col-sm-6 col-md-3 col-lg-3 text-center">
                <div class="rect">
                    <div class="animate scale icon-outer"><span class="icon flaticon-attachment13"></span></div>
                    <h6><strong>Ut sit amet turpis</strong></h6>
                    <p>In est arcu vitae sollicitudin eu, vehicula venenatis est tempor diam</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 text-center">
                <div class="rect">
                    <div class="animate scale icon-outer"><span class="icon flaticon-shopping155"></span></div>
                    <h6><strong>Ut sit amet turpis</strong></h6>
                    <p>In est arcu vitae sollicitudin eu, vehicula venenatis est tempor diam</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 text-center">
                <div class="rect">
                    <div class="animate scale icon-outer"><span class="icon flaticon-settings9"></span></div>
                    <h6><strong>Ut sit amet turpis</strong></h6>
                    <p>Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 text-center">
                <div class="rect">
                    <div class="animate scale icon-outer"><span class="icon flaticon-global10"></span></div>
                    <h6><strong>Ut sit amet turpis</strong></h6>
                    <p>In est arcu vitae sollicitudin eu, vehicula venenatis est tempor diam</p>
                </div>
            </div>
        </div>
        <div class="divider-lg"></div>

        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="subtitle">
                <div><span>ORder CONFIRMATION</span></div>
            </div>
                <p><strong>Free Delivery. </strong><br>
                    Vestibulum justo. Nulla mauris ipsum, convallis ut, vestibulum eu, tincidunt vel, nisi. Curabitur molestie euismod erat. Donec et mi eu massa ultrices scelerisque. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui.
                </p>
                <p><strong>Standard Mainland Delivery. </strong><br>
                    Proin eros odio, mattis rutrum, pulvinar et, egestas vitae, magna. Integer semper, velit ut interdum maletudin lobortis pellentesque, libero massa dapibus dui, eu dictum justo urna et mi. </p>
                <p><strong>Express Delivery. </strong><br>
                    Mauris lacinia lectus sit amet felis. Aliquam erat volutpat. Nulla porttitor tortor at nisl. Nam lectus nulla, bibendum pretium, dictum a, mattis nec, dolor.</p>
                <p><a href="index.php" class="btn btn-cool">more info</a> </p>


            </div><div class="col-sm-6 col-md-6">
            <div class="subtitle">
            <div><span>RETURNS AND EXCHANGES</span></div>
        </div>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, laoreet sit amet, nunc. Ut sit amet turpis. In est arcu, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas eu enim in lorem scelerisque auctor. Ut non erat. Suspendisse fermentum posuere lectus. Fusce vulputate nibh egestas orci. Aliquam lectus. Morbi eget dolor sagittis. Morbi sit amet quam. Nulla libero. </p>
            <p class="upper">Donec et mi eu massa ultrices scelerisque. </p>
            <p class="upper">Nullam ac nisi non eros gravida venenatis sollicitudin lobortis </p>
            <p class="upper">Curabitur convallis facilisis lorem. Vivamus euismod nulla vel nunc</p>
            <p class="upper">Fusce tincidunt, justo congue egestas</p>
        </div>
        </div>
    </section>

</div>

<!-- //end 13 video Page Content -->


<!-- Lingerie preloader Content -->
<div id="preload-image" style="background-image:url('image/catalog/skin_lingerie/preload-image.jpg');" data-img-width="1280" data-img-height="920">
    <div class="preloadText">
        <div class="inside">
            <img src="image/catalog/skin_lingerie/logo-invert.png" alt=""/>
            <div>Premium responsive theme</div><br><br><br><br>
            <div><a id="goToSite" class="btn">GET STARTED NOW</a>
            </div>
        </div>
    </div>
</div>
<!-- end Lingerie preloader Content -->

<!--Collections on category page-->
<div class="category_collection">
    <div class="subtitle">
        <div><span>Collections</span></div>
    </div>
    <div class="divider divider-md"></div>
    <div class="row">
        <div class="col-sm-5">
            <div class="collection-banner">
                <div class="image text-center"> <a href="index.php"><img src="image/catalog/collection/collection-banner-01.png" class="img-responsive" alt=""/></a>
                    <div class="stamp top-right">
                        <div class="inside">UP TO<span>50%</span>OFF</div>
                    </div>
                </div>
                <div class="text text-center">
                    <h5 class="title">FALL FASHION</h5>
                    <p class="upper">mini style, big brands, always 50% oFF or less</p>
                    <p><a href="listing.html" class="btn-cool btn-md">VIEW COLLECTION</a> </p>
                </div>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="collection-banner">
                <div class="image text-center hover-squared">
                    <a href="index.php"><img src="image/catalog/collection/collection-banner-02.jpg" class="img-responsive" alt=""/></a>
                    <div class="stamp bottom-right">
                        <div class="inside">UP TO<span>50%</span>OFF</div>
                    </div>
                    <div class="info top-right text-center">
                        <div class="inside">
                            <h6>For Men Only</h6>
                            <h2>Featured<br>
                                Men's Suits and Fashion<br>
                                Accessories</h2>
                        </div>
                    </div>
                    <div class="caption"></div>
                </div>
                <div class="text text-center">
                    <h5 class="title">Special weekend discounts</h5>
                    <p class="upper">hottest, trending, reclaimed luxury product</p>
                    <p><a href="listing.html" class="btn-cool btn-md">VIEW COLLECTION</a> </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="collection-banner">
                <div class="image-bg" style="background-image:url(image/catalog/collection/banner-03-bg.jpg);">
                    <div class="image text-center hover-squared"><a href="index.php"><img src="image/catalog/collection/collection-banner-03.jpg" class="img-responsive" alt=""/></a>
                        <div class="info middle-right invert text-center">
                            <div class="inside">
                                <h4>crazy deal: only monday &amp; tuesday</h4>
                                <h2>Save 20-40% at our shop<br>
                                    and get free shippng</h2>
                            </div>
                        </div>
                        <div class="caption"></div>
                    </div>
                </div>
                <div class="text text-center">
                    <h5 class="title">girls SUMMER COLLECTIONS</h5>
                    <p><a href="listing.html" class="btn-cool btn-md">VIEW COLLECTION</a> </p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="collection-banner">
                <div class="image text-center"> <a href="index.php"><img src="image/catalog/collection/collection-banner-04.png" alt="" class="img-responsive" /></a></div>
                <div class="text text-center">
                    <h5 class="title">POPULAR BAGS</h5>
                    <p class="upper">hottest, trending, reclaimed luxury product</p>
                    <p><a href="listing.html" class="btn-cool btn-md">VIEW COLLECTION</a> </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end Collections on category page-->


<!--layout item for mobile menu-->
<li>
        <span class="name">
            <span class="expander">-</span>
            <a>lAYOUT</a>
        </span>
    <ul>
        <li><a href="http://oc-cb-store1.tonytemplates.com">Default</a></li>
        <li><a href="http://oc-cb-store7.tonytemplates.com/">Simple</a></li>
        <li><a href="http://oc-cb-store6.tonytemplates.com/">Gallery</a></li>
        <li><a href="http://oc-cb-store5.tonytemplates.com/">Land</a></li>
        <li><a href="http://oc-cb-store3.tonytemplates.com/">Boxed</a></li>
        <li><a href="http://oc-cb-store4.tonytemplates.com/">Boxed-Land</a></li>
        <li><a href="http://oc-cb-store2.tonytemplates.com/">Marina Grey</a></li>
        <li><a href="http://oc-cb-store8.tonytemplates.com/">Bio Product</a></li>
        <li><a href="http://oc-cb-store10.tonytemplates.com/">Kids</a></li>
        <li><a href="http://oc-cb-store9.tonytemplates.com/">Art Gallery</a></li>
        <li><a href="http://oc-cb-store11.tonytemplates.com/">Lingerie</a></li>
        <li><a href="http://oc-cb-store12.tonytemplates.com/">Tools</a></li>
    </ul>

</li>
<li>
        <span class="name"><span class="expander">-</span>
            <a href="http://oc-cb-store1.tonytemplates.com/index.php?route=product/category&amp;path=24">Listing </a>
        </span>
    <ul>
        <li><span class="name"><a href="http://oc-cb-store6.tonytemplates.com/index.php?route=product/category&amp;path=296">With Left Column</a></span></li>
        <li><span class="name"><a href="http://oc-cb-store7.tonytemplates.com/index.php?route=product/category&amp;path=76">No Left Column</a></span></li>
        <li><span class="name"><a href="http://oc-cb-store4.tonytemplates.com/index.php?route=product/category&amp;path=302">Gallery Listing With Left Column</a></span></li>
        <li><span class="name"><a href="http://oc-cb-store3.tonytemplates.com/index.php?route=product/category&path=318">Gallery Listing No Left Column</a></span></li>
        <li><span class="name"><a href="http://oc-cb-store3.tonytemplates.com/index.php?route=product/category&amp;path=111">Listing With Collections Block</a></span></li>
        <li><span class="name"><a href="http://oc-cb-store6.tonytemplates.com/index.php?route=product/category&amp;path=297">Only Categories</a></span></li>
    </ul>
</li>
<li>
        <span class="name">
            <span class="expander">-</span>
            <a href="http://oc-cb-store1.tonytemplates.com/index.php?route=product/product&amp;product_id=82">Product</a>
        </span>
    <ul>
        <li><span class="name"><a href="http://oc-cb-store1.tonytemplates.com/index.php?route=product/product&amp;product_id=110">Classic</a></span></li>
        <li><span class="name"><a href="http://oc-cb-store1.tonytemplates.com/index.php?route=product/product&amp;product_id=82">Creative</a></span></li>
    </ul>
</li>

<!--end layout item for mobile menu-->

<!--layout item-->
<?php if ($store_id == 7) { ?>
<dt class="item">
<ul class="sf-menu">
    <li>
        <a>lAYOUT</a>
        <ul>
            <li><a href="http://oc-cb-store1.tonytemplates.com">Default</a></li>
            <li><a href="http://oc-cb-store7.tonytemplates.com/">Simple</a></li>
            <li><a href="http://oc-cb-store6.tonytemplates.com/">Gallery</a></li>
            <li><a href="http://oc-cb-store5.tonytemplates.com/">Land</a></li>
            <li><a href="http://oc-cb-store3.tonytemplates.com/">Boxed</a></li>
            <li><a href="http://oc-cb-store4.tonytemplates.com/">Boxed-Land</a></li>
            <li><a href="http://oc-cb-store2.tonytemplates.com/">Marina Grey</a></li>
            <li><a href="http://oc-cb-store8.tonytemplates.com/">Bio Product</a></li>
            <li><a href="http://oc-cb-store10.tonytemplates.com/">Kids</a></li>
            <li><a href="http://oc-cb-store9.tonytemplates.com/">Art Gallery</a></li>
            <li><a href="http://oc-cb-store11.tonytemplates.com/">Lingerie</a></li>
            <li><a href="http://oc-cb-store12.tonytemplates.com/">Tools</a></li>
        </ul>
    </li>
</ul>
</dt>
<dd></dd>
<dt class="item">
<ul class="sf-menu">
    <li>
        <a>Listing</a>
        <ul>
            <li><a href="http://oc-cb-store6.tonytemplates.com/index.php?route=product/category&amp;path=296">With Left Column</a></li>
            <li><a href="http://oc-cb-store7.tonytemplates.com/index.php?route=product/category&amp;path=76">No Left Column</a></li>
            <li><a href="http://oc-cb-store4.tonytemplates.com/index.php?route=product/category&amp;path=302">Gallery Listing With Left Column</a></li>
            <li><a href="http://oc-cb-store3.tonytemplates.com/index.php?route=product/category&amp;path=318">Gallery Listing No Left Column</a></li>
            <li><a href="http://oc-cb-store5.tonytemplates.com/index.php?route=product/category&amp;path=111">Listing With Collections Block</a></li>
            <li><a href="http://oc-cb-store6.tonytemplates.com/index.php?route=product/category&amp;path=297">Only Categories</a></li>
        </ul>
    </li>
</ul>
</dt>
<dd></dd>
<dt class="item">
<ul class="sf-menu">
    <li>
        <a>Product</a>
        <ul>
            <li><a href="http://oc-cb-store6.tonytemplates.com/index.php?route=product/category&amp;path=296">With Left Column</a></li>
            <li><a href="http://oc-cb-store7.tonytemplates.com/index.php?route=product/category&amp;path=76">No Left Column</a></li>
            <li><a href="http://oc-cb-store4.tonytemplates.com/index.php?route=product/category&amp;path=302">Gallery Listing With Left Column</a></li>
            <li><a href="http://oc-cb-store3.tonytemplates.com/index.php?route=product/category&amp;path=318">Gallery Listing No Left Column</a></li>
            <li><a href="http://oc-cb-store5.tonytemplates.com/index.php?route=product/category&amp;path=111">Listing With Collections Block</a></li>
            <li><a href="http://oc-cb-store6.tonytemplates.com/index.php?route=product/category&amp;path=297">Only Categories</a></li>
        </ul>
    </li>
</ul>
</dt>
<dd></dd>

<?php } else { ?>

<dt class="item">
    <a class="btn-main">lAYOUT</a>
</dt>
<dd class="item-content content-small">
    <div class="megamenuClose"></div>
    <ul class="row-list">
        <li><a href="http://oc-cb-store1.tonytemplates.com">Default</a></li>
        <li><a href="http://oc-cb-store7.tonytemplates.com/">Simple</a></li>
        <li><a href="http://oc-cb-store6.tonytemplates.com/">Gallery</a></li>
        <li><a href="http://oc-cb-store5.tonytemplates.com/">Land</a></li>
        <li><a href="http://oc-cb-store3.tonytemplates.com/">Boxed</a></li>
        <li><a href="http://oc-cb-store4.tonytemplates.com/">Boxed-Land</a></li>
        <li><a href="http://oc-cb-store2.tonytemplates.com/">Marina Grey</a></li>
        <li><a href="http://oc-cb-store8.tonytemplates.com/">Bio Product</a></li>
        <li><a href="http://oc-cb-store10.tonytemplates.com/">Kids</a></li>
        <li><a href="http://oc-cb-store9.tonytemplates.com/">Art Gallery</a></li>
        <li><a href="http://oc-cb-store11.tonytemplates.com/">Lingerie</a></li>
        <li><a href="http://oc-cb-store12.tonytemplates.com/">Tools</a></li>
    </ul>
</dd>
<dt class="item"> <a class="btn-main">Listing</a> </dt>
<dd class="item-content content-small">
    <div class="megamenuClose"></div>
    <ul class="row-list">
        <li><a href="http://oc-cb-store6.tonytemplates.com/index.php?route=product/category&amp;path=296">With Left Column</a></li>
        <li><a href="http://oc-cb-store7.tonytemplates.com/index.php?route=product/category&amp;path=76">No Left Column</a></li>
        <li><a href="http://oc-cb-store4.tonytemplates.com/index.php?route=product/category&amp;path=302">Gallery Listing With Left Column</a></li>
        <li><a href="http://oc-cb-store3.tonytemplates.com/index.php?route=product/category&amp;path=318">Gallery Listing No Left Column</a></li>
        <li><a href="http://oc-cb-store5.tonytemplates.com/index.php?route=product/category&amp;path=111">Listing With Collections Block</a></li>
        <li><a href="http://oc-cb-store6.tonytemplates.com/index.php?route=product/category&amp;path=297">Only Categories</a></li>
    </ul>
</dd>
<dt class="item"> <a class="btn-main">Product</a> </dt>
<dd class="item-content content-small">
    <div class="megamenuClose"></div>
    <ul class="row-list">
        <li><a href="http://oc-cb-store1.tonytemplates.com/index.php?route=product/product&amp;product_id=110">Classic</a></li>
        <li><a href="http://oc-cb-store1.tonytemplates.com/index.php?route=product/product&amp;product_id=82">Creative</a></li>
        <li><a href="http://oc-cb-store1.tonytemplates.com/index.php?route=product/product&amp;product_id=182">Advanced Color Option</a></li>
    </ul>
</dd>

<?php } ?>

<!--end layout item-->

<!--layout panel-->
<div id="layout-panel">
    <a class="btn-toggle"><span class="icon flaticon-idea12 blink"></span>DEMOS</a>
    <div class="demo-outer">
        <div class="demos" style="height: 520px;">
            <ul>
                <li><a class="coolbaby-default" href="http://oc-cb-store1.tonytemplates.com"><div class="hover">
                    <h3>Default</h3>
                    view demo</div></a></li>
                <li><a class="coolbaby-boxedland" href="http://oc-cb-store4.tonytemplates.com/"><div class="hover">
                    <h3>Boxed Land</h3>
                    view demo</div></a></li>
                <li><a class="coolbaby-boxed" href="http://oc-cb-store3.tonytemplates.com/"><div class="hover">
                    <h3>Boxed</h3>
                    view demo</div></a></li>
                <li><a class="coolbaby-land" href="http://oc-cb-store5.tonytemplates.com/"><div class="hover">
                    <h3>Land</h3>
                    view demo</div></a></li>
                <li><a class="coolbaby-simple" href="http://oc-cb-store7.tonytemplates.com/"><div class="hover">
                    <h3>Simple</h3>
                    view demo</div></a></li>
                <li><a class="coolbaby-marina" href="http://oc-cb-store2.tonytemplates.com/"><div class="hover">
                    <h3>Marina</h3>
                    view demo</div></a></li>
                <li><a class="coolbaby-gallery" href="http://oc-cb-store6.tonytemplates.com/"><div class="hover">
                    <h3>Gallery</h3>
                    view demo</div></a></li>
                <li><a class="coolbaby-bio" href="http://oc-cb-store8.tonytemplates.com/"><div class="hover">
                    <h3>Bio Product</h3>
                    view demo</div></a></li>
                <li><a class="coolbaby-art" href="http://oc-cb-store9.tonytemplates.com/"><div class="hover">
                    <h3>Art Gallery</h3>
                    view demo</div></a></li>
                <li><a class="coolbaby-baby" href="http://oc-cb-store10.tonytemplates.com/"><div class="hover">
                    <h3>Baby</h3>
                    view demo</div></a></li>
                <li><a class="coolbaby-tools" href="http://oc-cb-store12.tonytemplates.com/"><div class="hover">
                    <h3>Tools</h3>
                    view demo</div></a></li>
                <li><a class="coolbaby-lingerie" href="http://oc-cb-store11.tonytemplates.com/"><div class="hover">
                    <h3>Lingerie</h3>
                    view demo</div></a></li>
            </ul>
        </div>
    </div>
</div>

<!--end layout panel-->

<!--facebook example-->
<div class="widget-outer facebook-widget">
    <div class="fb_outer">
        <div>120 people like <strong><a href="#">COOLBABY</a></strong></div>
        <div class="items_row">
            <div class="item">
                <div class="photo"><a href="#"><img src="http://bumer.tonytemplates.com/coolbaby/demo/media/wysiwyg/fb/fb_user.png" alt=""></a></div>
                <div class="name"><a href="#">loremipsum</a></div>
            </div>
            <div class="item aligncenter">
                <div class="photo"><a href="#"><img src="http://bumer.tonytemplates.com/coolbaby/demo/media/wysiwyg/fb/fb_user-02.png" alt=""></a></div>
                <div class="name"><a href="#">dolor</a></div>
            </div>
            <div class="item alignright">
                <div class="photo"><a href="#"><img src="http://bumer.tonytemplates.com/coolbaby/demo/media/wysiwyg/fb/fb_user-03.png" alt=""></a></div>
                <div class="name"><a href="#">sitamet</a></div>
            </div>
        </div>
        <div class="items_row">
            <div class="item">
                <div class="photo"><a href="#"><img src="http://bumer.tonytemplates.com/coolbaby/demo/media/wysiwyg/fb/fb_user-04.png" alt=""></a></div>
                <div class="name"><a href="#">diam</a></div>
            </div>
            <div class="item aligncenter">
                <div class="photo"><a href="#"><img src="http://bumer.tonytemplates.com/coolbaby/demo/media/wysiwyg/fb/fb_user-05.png" alt=""></a></div>
                <div class="name"><a href="#">labore</a></div>
            </div>
            <div class="item alignright">
                <div class="photo"><a href="#"><img src="http://bumer.tonytemplates.com/coolbaby/demo/media/wysiwyg/fb/fb_user-06.png" alt=""></a></div>
                <div class="name"><a href="#">nonumy</a></div>
            </div>
        </div>
        <div class="items_row">
            <div class="item">
                <div class="photo"><a href="#"><img src="http://bumer.tonytemplates.com/coolbaby/demo/media/wysiwyg/fb/fb_user-07.png" alt=""></a></div>
                <div class="name"><a href="#">loremipsum</a></div>
            </div>
            <div class="item aligncenter">
                <div class="photo"><a href="#"><img src="http://bumer.tonytemplates.com/coolbaby/demo/media/wysiwyg/fb/fb_user-08.png" alt=""></a></div>
                <div class="name"><a href="#">dolor</a></div>
            </div>
            <div class="item alignright">
                <div class="photo"><a href="#"><img src="http://bumer.tonytemplates.com/coolbaby/demo/media/wysiwyg/fb/fb_user-09.png" alt=""></a></div>
                <div class="name"><a href="#">sitamet</a></div>
            </div>
        </div>
    </div>
</div>

