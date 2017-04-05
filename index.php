<?php

header("Content-Length");
include './config.php';

$params = array_merge($_GET, $_POST);
$action = (!empty($params['action'])) ? trim($params['action']) : '';
$case = (!empty($params['case'])) ? trim($params['case']) : '';



if ($params['debug']) {
    echo "<pre>";
    print_r($params);
    echo "</pre>";
}

switch ($action) {

    case 'icons':
        $page = 'Icons';
        include 'icons.html';
        break;

    case 'home':
        $page = 'index';
        include TEMPLATE . 'index.html';
        break;
    case 'loginJzeva':
        $page = 'loginJzeva';
        include TEMPLATE . 'loginJzeva.html';
        break;
    case 'home_jzeva':
        $page = 'home_jzeva';
        include TEMPLATE . 'home_jzeva.html';
        break;
    case 'gemstone':
        $page = 'gemstone';
        include TEMPLATE . 'gemstone.html';
        break;
    case 'gem_desc':
        $page = 'gem_desc';
        include TEMPLATE . 'gem_desc.html';
        break;
    case 'gem_desc2':
        $page = 'gem_desc2';
        include TEMPLATE . 'gem_desc2.html';
        break;
    case 'gemstonePage':
        $page = 'gemstonePage';
        include TEMPLATE . 'gemstonePage.html';
        break;
    case 'login':
        $page = 'login';
        include TEMPLATE . 'login.html';
        break;
    case 'packaging':
        $page = 'packaging';
        $title='Packaging | Jzeva';
        $keywors="Buy Jewellery online India,  Buy diamond jewellery online India,  diamond Jewellery,  white gold Jewellery,  fine Jewellery, fine ring, diamond ring, fine diamond necklace, fine pendants,  engagement ring, engagement band, eternity band, wedding band, wedding necklace, wedding party Jewellery, engagement Jewellery, cts, size, sz, 14kt, 18kt, 22kt, free shipping,  inspired, INDIAN HANDMADE, pave diamond, 
motif diamond, natural diamond, genuine diamond, Simulated Diamond, Stunning diamond, Sparkling diamond, Buy now, discounted Jewellery, men's Jewellery, Diamond accented, solitaire diamond, EXQUISITE jewellery, exceptional jewellery,, classic diamond, 
men's Jewellery, womens Jewellery, branded Jewellery, rare jewellery, royal jewellery,
women's Jewellery, princess cut, solid gold, pretty jewellery, gorgeous jewellery, estate Jewellery, Fabulous jewellery, online jewellery, Rose Gold, White Gold, Platinum, Gold, gemstone jewellery, International Jewellery, modern Jewellery, chic Jewellery, trendy Jewellery, Sexy Designs, Diamond Rings, Diamond Earrings, Diamond Pendants, Pendant sets, Solitaire rings, Solitaire Earrings, Diamond Bangles, Diamonds Necklace, precious Jewellery, Diamond Jewellery,  luxury Jewellery, luxury lifestyle, designer jewellery, Wedding jewellery, Diamond jewellery below 20000, High end diamond jewellery";
        include TEMPLATE . 'packaging.html';
        break;
    case 'login1':
        $page = 'login1';
        include TEMPLATE . 'login_new.html';
        break;
    case 'signUp':
        $page = 'signUp';
        include TEMPLATE . 'signup.html';
        break;

    case 'orders':
        $page = 'orders';
        include TEMPLATE . 'orders.html';
        break;
    case 'track':
        $page = 'track';
        include TEMPLATE . 'track_order.html';
        break;
    case 'confirmation':
        $page = 'confirmation';
        include TEMPLATE . 'confirmation.html';
        break;
    case 'product_details':
        $page = 'product_details';
        include TEMPLATE . 'product_details.html';
        break;
    case 'product_preview':
        $page = 'product_preview';
        include TEMPLATE . 'product_preview.html';
        break;
    case 'product_grid':
        $page = 'product_grid';
        $par_id=$params['id']; 
        $url = APIDOMAIN . 'index.php?action=getProDesOfcatid&id='. $par_id;
        $res = $comm->executeCurl($url);
        
      $titl=$res['result']['title'];
       $titl= $titl; 
      
      $title= trim(preg_replace('/\s\s+/', ' ', $titl));
       $dom=DOMAIN;
      $domi= explode('/' , $dom);
      $domain=$domi[3]; 
        $domain=ucwords($domain);
      $title=$title.' | '.$domain;
      $desc=$res['result']['descrp'];
      $descp= trim(preg_replace('/\s\s+/', ' ', $desc));
      $keywords=$res['result']['keywrd'];
        include TEMPLATE . 'product_grid.html';
        break;
    case 'landing_page':
        $page = 'product_page';
        $titl='Precious Designer Jewellery | Jzeva';
        $title= trim(preg_replace('/\s\s+/', ' ', $titl));
        $desc="India's best Online Designer Precious Jewellery Store. | Curated Designs | Certified Diamonds | Lifetime Exchange | Luxury Packaging | Complimentary Shipping | Customised Jewellery";
        $descp= trim(preg_replace('/\s\s+/', ' ', $desc));
        $keywords= "Buy Jewellery online India,  Buy diamond jewellery online India,  diamond Jewellery,  white gold Jewellery,  fine Jewellery, fine ring, diamond ring, fine diamond necklace, fine pendants,  engagement ring, engagement band, eternity band, wedding band, wedding necklace, wedding party Jewellery, engagement Jewellery, cts, size, sz, 14kt, 18kt, 22kt, free shipping,  inspired, INDIAN HANDMADE, pave diamond, 
motif diamond, natural diamond, genuine diamond, Simulated Diamond, Stunning diamond, Sparkling diamond, Buy now, discounted Jewellery, men's Jewellery, Diamond accented, solitaire diamond, EXQUISITE jewellery, exceptional jewellery,, classic diamond, 
men's Jewellery, womens Jewellery, branded Jewellery, rare jewellery, royal jewellery,
women's Jewellery, princess cut, solid gold, pretty jewellery, gorgeous jewellery, estate Jewellery, Fabulous jewellery, online jewellery, Rose Gold, White Gold, Platinum, Gold, gemstone jewellery, International Jewellery, modern Jewellery, chic Jewellery, trendy Jewellery, Sexy Designs, Diamond Rings, Diamond Earrings, Diamond Pendants, Pendant sets, Solitaire rings, Solitaire Earrings, Diamond Bangles, Diamonds Necklace, precious Jewellery, Diamond Jewellery,  luxury Jewellery, luxury lifestyle, designer jewellery, Wedding jewellery, Diamond jewellery below 20000, High end diamond jewellery";
        include TEMPLATE . 'landing_page.html';
        break;
    case 'product_page':
        $page = 'product_page';
        $prodid=$params['pid'];
      $url = APIDOMAIN . 'index.php?action=getProductById&pid='. $prodid;
      $res = $comm->executeCurl($url);
      $prdNm=$res['results']['basicDetails']['prdNm']; 
      $prdNm=ucwords($prdNm);
      $prdNm= trim(preg_replace('/\s\s+/', ' ', $prdNm));
      if($res['results']['basicDetails']['jewelleryType']==1){ 
      $metal='Gold';
      }
      if($res['results']['solitaire']['count'] == 1){
       $atrs='Solitaire';   
      }else{
      $atrs=$res['results']['attrVals']['result'][1]['value'];}
      $title=$prdNm.' | '.$metal.' | '.$atrs.' | '.Jzeva;
      $desc=$res['results']['basicDetails']['productDescription'];
      $descp= trim(preg_replace('/\s\s+/', ' ', $desc));
      $keywords=$res['results']['basicDetails']['prdSeo'];
        include TEMPLATE . 'product_page.html';
        break;
    
    case 'check_out':
        $page = 'check_out';
        include TEMPLATE . 'check_out.html';
        break;
    case 'login_jzeva':
        $page = 'login_jzeva';
        include TEMPLATE . 'login_jzeva.html';
        break;
    case 'filter':
        $page = 'filter';
        include TEMPLATE . 'filter.html';
        break;
    case 'reset_pswrd':
        $page = 'reset_pswrd';
        include TEMPLATE . 'reset_pswrd.html';
        break;
    case 'frgt_pswrd':
        $page = 'frgt_pswrd';
        include TEMPLATE . 'frgt_pswrd.html';
        break;
    case 'sign_up':
        $page = 'sign_up';
        include TEMPLATE . 'sign_up.html';
        break;
    case 'input_form':
        $page = 'input_form';
        include TEMPLATE . 'input_and_form.html';
        break;

    case 'checkOutNew':
        $page = 'checkOutNew';
        $title='Proceeded to CheckOut';
        include TEMPLATE . 'checkOutNew.html';
        break;

    case 'userProfile':
        $page = 'userProfile';
        include TEMPLATE . 'userProfile.html';
        break;

    case 'collections':
        $page = 'collections';
        include TEMPLATE . 'collections.html';
        break;

    case 'filterPage':
        $page = 'filterPage';
        include TEMPLATE . 'filterPage.html';
        break;
    case 'resetpsw':
        $page = 'resetpsw';
        include TEMPLATE . 'resetpsw.html';
        break;
    case 'otp':
        $page = 'otp';
        include TEMPLATE . 'otp.html';
        break;
    case 'tandc':
        $page = 'tandc';
        $title='Terms and Conditions | Jzeva';
        $keyword='Buy Jewellery online India,  Buy diamond jewellery online India,  diamond Jewellery,  white gold Jewellery,  fine Jewellery, fine ring, diamond ring, fine diamond necklace, fine pendants,  engagement ring, engagement band, eternity band, wedding band, wedding necklace, wedding party Jewellery, engagement Jewellery, cts, size, sz, 14kt, 18kt, 22kt, free shipping,  inspired, INDIAN HANDMADE, pave diamond, 
motif diamond, natural diamond, genuine diamond, Simulated Diamond, Stunning diamond, Sparkling diamond, Buy now, discounted Jewellery, mens Jewellery, Diamond accented, solitaire diamond, EXQUISITE jewellery, exceptional jewellery,, classic diamond, 
mens Jewellery, womens Jewellery, branded Jewellery, rare jewellery, royal jewellery,
womens Jewellery, princess cut, solid gold, pretty jewellery, gorgeous jewellery, estate Jewellery, Fabulous jewellery, online jewellery, Rose Gold, White Gold, Platinum, Gold, gemstone jewellery, International Jewellery, modern Jewellery, chic Jewellery, trendy Jewellery, Sexy Designs, Diamond Rings, Diamond Earrings, Diamond Pendants, Pendant sets, Solitaire rings, Solitaire Earrings, Diamond Bangles, Diamonds Necklace, precious Jewellery, Diamond Jewellery,  luxury Jewellery, luxury lifestyle, designer jewellery, Wedding jewellery, Diamond jewellery below 20000, High end diamond jewellery';
        include TEMPLATE . 'tandc.html';
        break;
    case 'privacy':
        $page = 'privacy';
         $title='Privacy Policy | Jzeva';
          $keyword="Buy Jewellery online India,  Buy diamond jewellery online India,  diamond Jewellery,  white gold Jewellery,  fine Jewellery, fine ring, diamond ring, fine diamond necklace, fine pendants,  engagement ring, engagement band, eternity band, wedding band, wedding necklace, wedding party Jewellery, engagement Jewellery, cts, size, sz, 14kt, 18kt, 22kt, free shipping,  inspired, INDIAN HANDMADE, pave diamond, 
motif diamond, natural diamond, genuine diamond, Simulated Diamond, Stunning diamond, Sparkling diamond, Buy now, discounted Jewellery, men's Jewellery, Diamond accented, solitaire diamond, EXQUISITE jewellery, exceptional jewellery,, classic diamond, 
men's Jewellery, womens Jewellery, branded Jewellery, rare jewellery, royal jewellery,
women's Jewellery, princess cut, solid gold, pretty jewellery, gorgeous jewellery, estate Jewellery, Fabulous jewellery, online jewellery, Rose Gold, White Gold, Platinum, Gold, gemstone jewellery, International Jewellery, modern Jewellery, chic Jewellery, trendy Jewellery, Sexy Designs, Diamond Rings, Diamond Earrings, Diamond Pendants, Pendant sets, Solitaire rings, Solitaire Earrings, Diamond Bangles, Diamonds Necklace, precious Jewellery, Diamond Jewellery,  luxury Jewellery, luxury lifestyle, designer jewellery, Wedding jewellery, Diamond jewellery below 20000, High end diamond jewellery";
        include TEMPLATE . 'privacy.html';
        break;
    case 'contact':
        $page = 'contact';
        $title='Contact Us | Jzeva';
        $keyword="Buy Jewellery online India,  Buy diamond jewellery online India,  diamond Jewellery,  white gold Jewellery,  fine Jewellery, fine ring, diamond ring, fine diamond necklace, fine pendants,  engagement ring, engagement band, eternity band, wedding band, wedding necklace, wedding party Jewellery, engagement Jewellery, cts, size, sz, 14kt, 18kt, 22kt, free shipping,  inspired, INDIAN HANDMADE, pave diamond, 
motif diamond, natural diamond, genuine diamond, Simulated Diamond, Stunning diamond, Sparkling diamond, Buy now, discounted Jewellery, men's Jewellery, Diamond accented, solitaire diamond, EXQUISITE jewellery, exceptional jewellery,, classic diamond, 
men's Jewellery, womens Jewellery, branded Jewellery, rare jewellery, royal jewellery,
women's Jewellery, princess cut, solid gold, pretty jewellery, gorgeous jewellery, estate Jewellery, Fabulous jewellery, online jewellery, Rose Gold, White Gold, Platinum, Gold, gemstone jewellery, International Jewellery, modern Jewellery, chic Jewellery, trendy Jewellery, Sexy Designs, Diamond Rings, Diamond Earrings, Diamond Pendants, Pendant sets, Solitaire rings, Solitaire Earrings, Diamond Bangles, Diamonds Necklace, precious Jewellery, Diamond Jewellery,  luxury Jewellery, luxury lifestyle, designer jewellery, Wedding jewellery, Diamond jewellery below 20000, High end diamond jewellery";
        include TEMPLATE . 'contact.html';
        break;
    case 'warranty':
        $page = 'warranty';
        $title='Warranty and Repairs | Jzeva';
        $keyword="Buy Jewellery online India,  Buy diamond jewellery online India,  diamond Jewellery,  white gold Jewellery,  fine Jewellery, fine ring, diamond ring, fine diamond necklace, fine pendants,  engagement ring, engagement band, eternity band, wedding band, wedding necklace, wedding party Jewellery, engagement Jewellery, cts, size, sz, 14kt, 18kt, 22kt, free shipping,  inspired, INDIAN HANDMADE, pave diamond, 
motif diamond, natural diamond, genuine diamond, Simulated Diamond, Stunning diamond, Sparkling diamond, Buy now, discounted Jewellery, men's Jewellery, Diamond accented, solitaire diamond, EXQUISITE jewellery, exceptional jewellery,, classic diamond, 
men's Jewellery, womens Jewellery, branded Jewellery, rare jewellery, royal jewellery,
women's Jewellery, princess cut, solid gold, pretty jewellery, gorgeous jewellery, estate Jewellery, Fabulous jewellery, online jewellery, Rose Gold, White Gold, Platinum, Gold, gemstone jewellery, International Jewellery, modern Jewellery, chic Jewellery, trendy Jewellery, Sexy Designs, Diamond Rings, Diamond Earrings, Diamond Pendants, Pendant sets, Solitaire rings, Solitaire Earrings, Diamond Bangles, Diamonds Necklace, precious Jewellery, Diamond Jewellery,  luxury Jewellery, luxury lifestyle, designer jewellery, Wedding jewellery, Diamond jewellery below 20000, High end diamond jewellery";
        include TEMPLATE . 'warranty.html';
        break;
    case 'randc':
        $page = 'randc';
        $title='Returns and Exchange | Jzeva';
        $keywords=" Buy Jewellery online India,  Buy diamond jewellery online India,  diamond Jewellery,  white gold Jewellery,  fine Jewellery, fine ring, diamond ring, fine diamond necklace, fine pendants,  engagement ring, engagement band, eternity band, wedding band, wedding necklace, wedding party Jewellery, engagement Jewellery, cts, size, sz, 14kt, 18kt, 22kt, free shipping,  inspired, INDIAN HANDMADE, pave diamond, 
motif diamond, natural diamond, genuine diamond, Simulated Diamond, Stunning diamond, Sparkling diamond, Buy now, discounted Jewellery, men's Jewellery, Diamond accented, solitaire diamond, EXQUISITE jewellery, exceptional jewellery,, classic diamond, 
men's Jewellery, womens Jewellery, branded Jewellery, rare jewellery, royal jewellery,
women's Jewellery, princess cut, solid gold, pretty jewellery, gorgeous jewellery, estate Jewellery, Fabulous jewellery, online jewellery, Rose Gold, White Gold, Platinum, Gold, gemstone jewellery, International Jewellery, modern Jewellery, chic Jewellery, trendy Jewellery, Sexy Designs, Diamond Rings, Diamond Earrings, Diamond Pendants, Pendant sets, Solitaire rings, Solitaire Earrings, Diamond Bangles, Diamonds Necklace, precious Jewellery, Diamond Jewellery,  luxury Jewellery, luxury lifestyle, designer jewellery, Wedding jewellery, Diamond jewellery below 20000, High end diamond jewellery";
        include TEMPLATE . 'randc.html';
        break;
    case 'diamondguide':
        $page = 'diamondguide';
        $title='Diamond Guide | Jzeva';
        $desc="Learn about the Diamond Quality,Diamond Colour,Diamond Cut and Carat.";
        $keyword="Buy Jewellery online India,  Buy diamond jewellery online India,  diamond Jewellery,  white gold Jewellery,  fine Jewellery, fine ring, diamond ring, fine diamond necklace, fine pendants,  engagement ring, engagement band, eternity band, wedding band, wedding necklace, wedding party Jewellery, engagement Jewellery, cts, size, sz, 14kt, 18kt, 22kt, free shipping,  inspired, INDIAN HANDMADE, pave diamond, 
motif diamond, natural diamond, genuine diamond, Simulated Diamond, Stunning diamond, Sparkling diamond, Buy now, discounted Jewellery, men's Jewellery, Diamond accented, solitaire diamond, EXQUISITE jewellery, exceptional jewellery,, classic diamond, 
men's Jewellery, womens Jewellery, branded Jewellery, rare jewellery, royal jewellery,
women's Jewellery, princess cut, solid gold, pretty jewellery, gorgeous jewellery, estate Jewellery, Fabulous jewellery, online jewellery, Rose Gold, White Gold, Platinum, Gold, gemstone jewellery, International Jewellery, modern Jewellery, chic Jewellery, trendy Jewellery, Sexy Designs, Diamond Rings, Diamond Earrings, Diamond Pendants, Pendant sets, Solitaire rings, Solitaire Earrings, Diamond Bangles, Diamonds Necklace, precious Jewellery, Diamond Jewellery,  luxury Jewellery, luxury lifestyle, designer jewellery, Wedding jewellery, Diamond jewellery below 20000, High end diamond jewellery";
        $descp= trim(preg_replace('/\s\s+/', ' ', $desc));

        include TEMPLATE . 'diamondguide.html';
        break;
    case 'preciousmetalguide':
        $page = 'preciousmetalguide';
        $title='Precious Metal | Jzeva';
        $desc=" Learn how to clean precious jewellery, how to care diamond & gemstone jewellery";
        $descp= trim(preg_replace('/\s\s+/', ' ', $desc));
        $keywords="Buy Jewellery online India,  Buy diamond jewellery online India,  diamond Jewellery,  white gold Jewellery,  fine Jewellery, fine ring, diamond ring, fine diamond necklace, fine pendants,  engagement ring, engagement band, eternity band, wedding band, wedding necklace, wedding party Jewellery, engagement Jewellery, cts, size, sz, 14kt, 18kt, 22kt, free shipping,  inspired, INDIAN HANDMADE, pave diamond, 
motif diamond, natural diamond, genuine diamond, Simulated Diamond, Stunning diamond, Sparkling diamond, Buy now, discounted Jewellery, men's Jewellery, Diamond accented, solitaire diamond, EXQUISITE jewellery, exceptional jewellery,, classic diamond, 
men's Jewellery, womens Jewellery, branded Jewellery, rare jewellery, royal jewellery,
women's Jewellery, princess cut, solid gold, pretty jewellery, gorgeous jewellery, estate Jewellery, Fabulous jewellery, online jewellery, Rose Gold, White Gold, Platinum, Gold, gemstone jewellery, International Jewellery, modern Jewellery, chic Jewellery, trendy Jewellery, Sexy Designs, Diamond Rings, Diamond Earrings, Diamond Pendants, Pendant sets, Solitaire rings, Solitaire Earrings, Diamond Bangles, Diamonds Necklace, precious Jewellery, Diamond Jewellery,  luxury Jewellery, luxury lifestyle, designer jewellery, Wedding jewellery, Diamond jewellery below 20000, High end diamond jewellery";
        include TEMPLATE . 'preciousmetalguide.html';
        break;
    
    case 'jewellerycare':
        $page = 'jewellerycare';
        $title='Jewellery Care | Jzeva';
        $desc=" Learn how to clean precious jewellery, how to care diamond & gemstone jewellery";
        $descp= trim(preg_replace('/\s\s+/', ' ', $desc));
        $keyword="Buy Jewellery online India,  Buy diamond jewellery online India,  diamond Jewellery,  white gold Jewellery,  fine Jewellery, fine ring, diamond ring, fine diamond necklace, fine pendants,  engagement ring, engagement band, eternity band, wedding band, wedding necklace, wedding party Jewellery, engagement Jewellery, cts, size, sz, 14kt, 18kt, 22kt, free shipping,  inspired, INDIAN HANDMADE, pave diamond, 
motif diamond, natural diamond, genuine diamond, Simulated Diamond, Stunning diamond, Sparkling diamond, Buy now, discounted Jewellery, men's Jewellery, Diamond accented, solitaire diamond, EXQUISITE jewellery, exceptional jewellery,, classic diamond, 
men's Jewellery, womens Jewellery, branded Jewellery, rare jewellery, royal jewellery,
women's Jewellery, princess cut, solid gold, pretty jewellery, gorgeous jewellery, estate Jewellery, Fabulous jewellery, online jewellery, Rose Gold, White Gold, Platinum, Gold, gemstone jewellery, International Jewellery, modern Jewellery, chic Jewellery, trendy Jewellery, Sexy Designs, Diamond Rings, Diamond Earrings, Diamond Pendants, Pendant sets, Solitaire rings, Solitaire Earrings, Diamond Bangles, Diamonds Necklace, precious Jewellery, Diamond Jewellery,  luxury Jewellery, luxury lifestyle, designer jewellery, Wedding jewellery, Diamond jewellery below 20000, High end diamond jewellery";
        include TEMPLATE . 'jewellerycare.html';
        break;
    case 'responsiblef':
        $page = 'responsiblef';
        $title=' Responisble Fashion | Jzeva';
        $keywords="Buy Jewellery online India,  Buy diamond jewellery online India,  diamond Jewellery,  white gold Jewellery,  fine Jewellery, fine ring, diamond ring, fine diamond necklace, fine pendants,  engagement ring, engagement band, eternity band, wedding band, wedding necklace, wedding party Jewellery, engagement Jewellery, cts, size, sz, 14kt, 18kt, 22kt, free shipping,  inspired, INDIAN HANDMADE, pave diamond, 
motif diamond, natural diamond, genuine diamond, Simulated Diamond, Stunning diamond, Sparkling diamond, Buy now, discounted Jewellery, men's Jewellery, Diamond accented, solitaire diamond, EXQUISITE jewellery, exceptional jewellery,, classic diamond, 
men's Jewellery, womens Jewellery, branded Jewellery, rare jewellery, royal jewellery,
women's Jewellery, princess cut, solid gold, pretty jewellery, gorgeous jewellery, estate Jewellery, Fabulous jewellery, online jewellery, Rose Gold, White Gold, Platinum, Gold, gemstone jewellery, International Jewellery, modern Jewellery, chic Jewellery, trendy Jewellery, Sexy Designs, Diamond Rings, Diamond Earrings, Diamond Pendants, Pendant sets, Solitaire rings, Solitaire Earrings, Diamond Bangles, Diamonds Necklace, precious Jewellery, Diamond Jewellery,  luxury Jewellery, luxury lifestyle, designer jewellery, Wedding jewellery, Diamond jewellery below 20000, High end diamond jewellery";
        include TEMPLATE . 'responsiblef.html';
        break;
//    case 'gemstoneguide':
//        $page = 'gemstoneguide';
//        include TEMPLATE . 'gemstoneguide.html';
//        break;
    case 'faq':
        $page = 'faq';
         $title="FAQ's | Jzeva";
         $keyword="Buy Jewellery online India,  Buy diamond jewellery online India,  diamond Jewellery,  white gold Jewellery,  fine Jewellery, fine ring, diamond ring, fine diamond necklace, fine pendants,  engagement ring, engagement band, eternity band, wedding band, wedding necklace, wedding party Jewellery, engagement Jewellery, cts, size, sz, 14kt, 18kt, 22kt, free shipping,  inspired, INDIAN HANDMADE, pave diamond, 
motif diamond, natural diamond, genuine diamond, Simulated Diamond, Stunning diamond, Sparkling diamond, Buy now, discounted Jewellery, men's Jewellery, Diamond accented, solitaire diamond, EXQUISITE jewellery, exceptional jewellery,, classic diamond, 
men's Jewellery, womens Jewellery, branded Jewellery, rare jewellery, royal jewellery,
women's Jewellery, princess cut, solid gold, pretty jewellery, gorgeous jewellery, estate Jewellery, Fabulous jewellery, online jewellery, Rose Gold, White Gold, Platinum, Gold, gemstone jewellery, International Jewellery, modern Jewellery, chic Jewellery, trendy Jewellery, Sexy Designs, Diamond Rings, Diamond Earrings, Diamond Pendants, Pendant sets, Solitaire rings, Solitaire Earrings, Diamond Bangles, Diamonds Necklace, precious Jewellery, Diamond Jewellery,  luxury Jewellery, luxury lifestyle, designer jewellery, Wedding jewellery, Diamond jewellery below 20000, High end diamond jewellery";
        include TEMPLATE . 'faq.html';
        break;
    case 'sizeguide':
        $page = 'sizeguide';
        $title="Ring Sizing Guide | Jzeva";
        $keywords="Buy Jewellery online India,  Buy diamond jewellery online India,  diamond Jewellery,  white gold Jewellery,  fine Jewellery, fine ring, diamond ring, fine diamond necklace, fine pendants,  engagement ring, engagement band, eternity band, wedding band, wedding necklace, wedding party Jewellery, engagement Jewellery, cts, size, sz, 14kt, 18kt, 22kt, free shipping,  inspired, INDIAN HANDMADE, pave diamond, 
motif diamond, natural diamond, genuine diamond, Simulated Diamond, Stunning diamond, Sparkling diamond, Buy now, discounted Jewellery, men's Jewellery, Diamond accented, solitaire diamond, EXQUISITE jewellery, exceptional jewellery,, classic diamond, 
men's Jewellery, womens Jewellery, branded Jewellery, rare jewellery, royal jewellery,
women's Jewellery, princess cut, solid gold, pretty jewellery, gorgeous jewellery, estate Jewellery, Fabulous jewellery, online jewellery, Rose Gold, White Gold, Platinum, Gold, gemstone jewellery, International Jewellery, modern Jewellery, chic Jewellery, trendy Jewellery, Sexy Designs, Diamond Rings, Diamond Earrings, Diamond Pendants, Pendant sets, Solitaire rings, Solitaire Earrings, Diamond Bangles, Diamonds Necklace, precious Jewellery, Diamond Jewellery,  luxury Jewellery, luxury lifestyle, designer jewellery, Wedding jewellery, Diamond jewellery below 20000, High end diamond jewellery";
        include TEMPLATE . 'sizeguide.html';
        break;
    case 'myaccount':
        $page = 'myaccount';
        $title='Account Details';
        $keywords='Previous-Orders,Wishlist,Personal-Information,Saved-Addresses';
        include TEMPLATE . 'myaccount.html';
        break;
    case 'shipping':
        $page = 'shipping';
        $title='Shipping | Jzeva';
        $keywords="Buy Jewellery online India,  Buy diamond jewellery online India,  diamond Jewellery,  white gold Jewellery,  fine Jewellery, fine ring, diamond ring, fine diamond necklace, fine pendants,  engagement ring, engagement band, eternity band, wedding band, wedding necklace, wedding party Jewellery, engagement Jewellery, cts, size, sz, 14kt, 18kt, 22kt, free shipping,  inspired, INDIAN HANDMADE, pave diamond, 
motif diamond, natural diamond, genuine diamond, Simulated Diamond, Stunning diamond, Sparkling diamond, Buy now, discounted Jewellery, men's Jewellery, Diamond accented, solitaire diamond, EXQUISITE jewellery, exceptional jewellery,, classic diamond, 
men's Jewellery, womens Jewellery, branded Jewellery, rare jewellery, royal jewellery,
women's Jewellery, princess cut, solid gold, pretty jewellery, gorgeous jewellery, estate Jewellery, Fabulous jewellery, online jewellery, Rose Gold, White Gold, Platinum, Gold, gemstone jewellery, International Jewellery, modern Jewellery, chic Jewellery, trendy Jewellery, Sexy Designs, Diamond Rings, Diamond Earrings, Diamond Pendants, Pendant sets, Solitaire rings, Solitaire Earrings, Diamond Bangles, Diamonds Necklace, precious Jewellery, Diamond Jewellery,  luxury Jewellery, luxury lifestyle, designer jewellery, Wedding jewellery, Diamond jewellery below 20000, High end diamond jewellery";
        include TEMPLATE . 'shipping.html';
        break;
    case 'bangleguide':
        $page = 'bangleguide';
        $title='Bangle Sizing Guide | Jzeva';
        $keywords="Buy Jewellery online India,  Buy diamond jewellery online India,  diamond Jewellery,  white gold Jewellery,  fine Jewellery, fine ring, diamond ring, fine diamond necklace, fine pendants,  engagement ring, engagement band, eternity band, wedding band, wedding necklace, wedding party Jewellery, engagement Jewellery, cts, size, sz, 14kt, 18kt, 22kt, free shipping,  inspired, INDIAN HANDMADE, pave diamond, 
motif diamond, natural diamond, genuine diamond, Simulated Diamond, Stunning diamond, Sparkling diamond, Buy now, discounted Jewellery, men's Jewellery, Diamond accented, solitaire diamond, EXQUISITE jewellery, exceptional jewellery,, classic diamond, 
men's Jewellery, womens Jewellery, branded Jewellery, rare jewellery, royal jewellery,
women's Jewellery, princess cut, solid gold, pretty jewellery, gorgeous jewellery, estate Jewellery, Fabulous jewellery, online jewellery, Rose Gold, White Gold, Platinum, Gold, gemstone jewellery, International Jewellery, modern Jewellery, chic Jewellery, trendy Jewellery, Sexy Designs, Diamond Rings, Diamond Earrings, Diamond Pendants, Pendant sets, Solitaire rings, Solitaire Earrings, Diamond Bangles, Diamonds Necklace, precious Jewellery, Diamond Jewellery,  luxury Jewellery, luxury lifestyle, designer jewellery, Wedding jewellery, Diamond jewellery below 20000, High end diamond jewellery";
        include TEMPLATE . 'bangleguide.html';
        break;
    case 'conciergeServices':
        $page = 'conciergeServices';
        $title='Conceirge Services | Jzeva';
        $keywords="Buy Jewellery online India,  Buy diamond jewellery online India,  diamond Jewellery,  white gold Jewellery,  fine Jewellery, fine ring, diamond ring, fine diamond necklace, fine pendants,  engagement ring, engagement band, eternity band, wedding band, wedding necklace, wedding party Jewellery, engagement Jewellery, cts, size, sz, 14kt, 18kt, 22kt, free shipping,  inspired, INDIAN HANDMADE, pave diamond, 
motif diamond, natural diamond, genuine diamond, Simulated Diamond, Stunning diamond, Sparkling diamond, Buy now, discounted Jewellery, men's Jewellery, Diamond accented, solitaire diamond, EXQUISITE jewellery, exceptional jewellery,, classic diamond, 
men's Jewellery, womens Jewellery, branded Jewellery, rare jewellery, royal jewellery,
women's Jewellery, princess cut, solid gold, pretty jewellery, gorgeous jewellery, estate Jewellery, Fabulous jewellery, online jewellery, Rose Gold, White Gold, Platinum, Gold, gemstone jewellery, International Jewellery, modern Jewellery, chic Jewellery, trendy Jewellery, Sexy Designs, Diamond Rings, Diamond Earrings, Diamond Pendants, Pendant sets, Solitaire rings, Solitaire Earrings, Diamond Bangles, Diamonds Necklace, precious Jewellery, Diamond Jewellery,  luxury Jewellery, luxury lifestyle, designer jewellery, Wedding jewellery, Diamond jewellery below 20000, High end diamond jewellery";
        include TEMPLATE . 'conciergeServices.html';
        break;
    case 'gemstonenew':
        $page = 'gemstonenew';
        include TEMPLATE . 'gemstonenew.html';
        break;
    case 'logintest':
        $page = 'logintest';
        include TEMPLATE . 'logintest.html';
        break;
    case 'ourPromise':
        $page = 'ourPromise';
        $title='Our Promise | Jzeva';
        $keywords="Buy Jewellery online India,  Buy diamond jewellery online India,  diamond Jewellery,  white gold Jewellery,  fine Jewellery, fine ring, diamond ring, fine diamond necklace, fine pendants,  engagement ring, engagement band, eternity band, wedding band, wedding necklace, wedding party Jewellery, engagement Jewellery, cts, size, sz, 14kt, 18kt, 22kt, free shipping,  inspired, INDIAN HANDMADE, pave diamond, 
motif diamond, natural diamond, genuine diamond, Simulated Diamond, Stunning diamond, Sparkling diamond, Buy now, discounted Jewellery, men's Jewellery, Diamond accented, solitaire diamond, EXQUISITE jewellery, exceptional jewellery,, classic diamond, 
men's Jewellery, womens Jewellery, branded Jewellery, rare jewellery, royal jewellery,
women's Jewellery, princess cut, solid gold, pretty jewellery, gorgeous jewellery, estate Jewellery, Fabulous jewellery, online jewellery, Rose Gold, White Gold, Platinum, Gold, gemstone jewellery, International Jewellery, modern Jewellery, chic Jewellery, trendy Jewellery, Sexy Designs, Diamond Rings, Diamond Earrings, Diamond Pendants, Pendant sets, Solitaire rings, Solitaire Earrings, Diamond Bangles, Diamonds Necklace, precious Jewellery, Diamond Jewellery,  luxury Jewellery, luxury lifestyle, designer jewellery, Wedding jewellery, Diamond jewellery below 20000, High end diamond jewellery";
        include TEMPLATE . 'ourPromise.html';
        break;
    case 'ourStory':
        $page = 'ourStory';
        $title='Our Story | Jzeva';
        $keywords="Buy Jewellery online India,  Buy diamond jewellery online India,  diamond Jewellery,  white gold Jewellery,  fine Jewellery, fine ring, diamond ring, fine diamond necklace, fine pendants,  engagement ring, engagement band, eternity band, wedding band, wedding necklace, wedding party Jewellery, engagement Jewellery, cts, size, sz, 14kt, 18kt, 22kt, free shipping,  inspired, INDIAN HANDMADE, pave diamond, 
motif diamond, natural diamond, genuine diamond, Simulated Diamond, Stunning diamond, Sparkling diamond, Buy now, discounted Jewellery, men's Jewellery, Diamond accented, solitaire diamond, EXQUISITE jewellery, exceptional jewellery,, classic diamond, 
men's Jewellery, womens Jewellery, branded Jewellery, rare jewellery, royal jewellery,
women's Jewellery, princess cut, solid gold, pretty jewellery, gorgeous jewellery, estate Jewellery, Fabulous jewellery, online jewellery, Rose Gold, White Gold, Platinum, Gold, gemstone jewellery, International Jewellery, modern Jewellery, chic Jewellery, trendy Jewellery, Sexy Designs, Diamond Rings, Diamond Earrings, Diamond Pendants, Pendant sets, Solitaire rings, Solitaire Earrings, Diamond Bangles, Diamonds Necklace, precious Jewellery, Diamond Jewellery,  luxury Jewellery, luxury lifestyle, designer jewellery, Wedding jewellery, Diamond jewellery below 20000, High end diamond jewellery";
        include TEMPLATE . 'ourStory.html';
        break;
    case 'craftsmanship':
        $page = 'craftsmanship';
        $title='Craftsmanship | Jzeva';
        $keywords="Buy Jewellery online India,  Buy diamond jewellery online India,  diamond Jewellery,  white gold Jewellery,  fine Jewellery, fine ring, diamond ring, fine diamond necklace, fine pendants,  engagement ring, engagement band, eternity band, wedding band, wedding necklace, wedding party Jewellery, engagement Jewellery, cts, size, sz, 14kt, 18kt, 22kt, free shipping,  inspired, INDIAN HANDMADE, pave diamond, 
motif diamond, natural diamond, genuine diamond, Simulated Diamond, Stunning diamond, Sparkling diamond, Buy now, discounted Jewellery, men's Jewellery, Diamond accented, solitaire diamond, EXQUISITE jewellery, exceptional jewellery,, classic diamond, 
men's Jewellery, womens Jewellery, branded Jewellery, rare jewellery, royal jewellery,
women's Jewellery, princess cut, solid gold, pretty jewellery, gorgeous jewellery, estate Jewellery, Fabulous jewellery, online jewellery, Rose Gold, White Gold, Platinum, Gold, gemstone jewellery, International Jewellery, modern Jewellery, chic Jewellery, trendy Jewellery, Sexy Designs, Diamond Rings, Diamond Earrings, Diamond Pendants, Pendant sets, Solitaire rings, Solitaire Earrings, Diamond Bangles, Diamonds Necklace, precious Jewellery, Diamond Jewellery,  luxury Jewellery, luxury lifestyle, designer jewellery, Wedding jewellery, Diamond jewellery below 20000, High end diamond jewellery";
        include TEMPLATE . 'craftsmanship.html';
        break;
  
    case 'gemstoneGuideNew':
        $page = 'gemstoneGuideNew';
        $title='Gemstone Guide | Jzeva';
         $desc="Buy Gemstone studded Jewellery";
        $descp= trim(preg_replace('/\s\s+/', ' ', $desc));
        $keywords="Buy Jewellery online India,  Buy diamond jewellery online India,  diamond Jewellery,  white gold Jewellery,  fine Jewellery, fine ring, diamond ring, fine diamond necklace, fine pendants,  engagement ring, engagement band, eternity band, wedding band, wedding necklace, wedding party Jewellery, engagement Jewellery, cts, size, sz, 14kt, 18kt, 22kt, free shipping,  inspired, INDIAN HANDMADE, pave diamond, 
motif diamond, natural diamond, genuine diamond, Simulated Diamond, Stunning diamond, Sparkling diamond, Buy now, discounted Jewellery, men's Jewellery, Diamond accented, solitaire diamond, EXQUISITE jewellery, exceptional jewellery,, classic diamond, 
men's Jewellery, womens Jewellery, branded Jewellery, rare jewellery, royal jewellery,
women's Jewellery, princess cut, solid gold, pretty jewellery, gorgeous jewellery, estate Jewellery, Fabulous jewellery, online jewellery, Rose Gold, White Gold, Platinum, Gold, gemstone jewellery, International Jewellery, modern Jewellery, chic Jewellery, trendy Jewellery, Sexy Designs, Diamond Rings, Diamond Earrings, Diamond Pendants, Pendant sets, Solitaire rings, Solitaire Earrings, Diamond Bangles, Diamonds Necklace, precious Jewellery, Diamond Jewellery,  luxury Jewellery, luxury lifestyle, designer jewellery, Wedding jewellery, Diamond jewellery below 20000, High end diamond jewellery";
      
        include TEMPLATE . 'gemstoneGuideNew.html';
        break;
    case 'orderPlacing':
        $page = 'orderplace';
        include TEMPLATE . 'deliveryAddress.html';
        break;

    case 'checkoutAfter':
        $page = 'checkoutAfter';
        include TEMPLATE . 'checkoutAfter.html';
        break;
    case 'checkoutBefore':
        $page = 'checkoutBefore';
        include TEMPLATE . 'checkoutBefore.html';
        break;
    case 'product_page1':
        $page = 'product_page1';
        include TEMPLATE . 'product_page1.html';
        break;
    case 'beforePayment':
        $page = 'beforePayment';
        include TEMPLATE . 'beforePayment.html';
        break;
    case 'paymentg':
        $page = 'paymentg';
        include WEBROOT . 'transaction/paymentg.html';
        break;

    case 'paymentdetail':
        $page = 'paymntdetail';
        include WEBROOT . 'transaction/paymntdetail.html';
        break;

    case 'confirmpymnt':
        $page = 'confirmpmnt';
        include WEBROOT . 'transaction/confirmpmnt.html';
        break;

    case 'checkoutBefore':
        $page = 'checkoutBefore';
        include TEMPLATE . 'checkoutBefore.html';
        break;

       case 'paymentfail':
        $page = 'transactionFail';
        include TEMPLATE . 'transactionFail.html';
	break;

     case 'trygem':
        $page = 'trygem';
        include TEMPLATE . 'trygem.html';
        break;

     case 'transactionAbort':
        $page = 'transactionAbort';
        include TEMPLATE . 'transactionAbort.html';
        break;

    case 'transactionSuccess':
        $page = 'transactionSuccess';
        include TEMPLATE . 'transactionSuccess.html';
        break;


    case 'checkoutGuest':
        $page = 'checkoutGuest';
        include TEMPLATE . 'checkoutGuest.html';
        break;

     case 'guestaccount':
        $page = 'guestaccount';
        include TEMPLATE . 'guestaccount.html';
        break;

        case 'customerInvoice':
        $page = 'customerInvoice';
        include TEMPLATE . 'customerInvoice.html';
        break;

     case 'bespoke':
        $page = 'bespoke';
        $title='Customised Jewellery - Bespoke Designer Jewellery | Jzeva';
        $keyword="Customised Jewellery, desinger, bespoke jewellery, make your own jewellery, personalised jewellery, custom jewellery, made to order, design your own jewellery, wedding jewellery";
        include TEMPLATE . 'bespoke.html';
        break;

     case 'invoice':
        $page = 'invoice';
        include WEBROOT . 'frontend/emailer/customerInc.html';
        break;

        case 'customerInc':
        $page = 'customerInc';
        include TEMPLATE . 'customerInc.html';
        break;


        case 'mheader':
        $page = 'mheader';
        include TEMPLATE . 'mheader.html';
        break;
}
?>
