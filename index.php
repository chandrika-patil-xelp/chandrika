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
        $title='Our Luxury Packaging | Jzeva';
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
  
      $title=$res['result']['title'];
      $desc=$res['result']['descrp'];
      $descp= trim(preg_replace('/\s\s+/', ' ', $desc));
      $keywords=$res['result']['keywrd'];
        include TEMPLATE . 'product_grid.html';
        break;
    case 'landing_page':
        $page = 'product_page';
        $titl='Online Designer Jewellery Store | Jzeva';
        $title= trim(preg_replace('/\s\s+/', ' ', $titl));
        $desc="India's best Online Designer Precious Jewellery Store.";
        $descp= trim(preg_replace('/\s\s+/', ' ', $desc));
        $keywords= 'Curated Designs,Certified Diamonds, Lifetime Exchange,Luxury Packaging,Complimentary Shipping,Customised Jewellery';
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
      $title=$prdNm.' made of '.$metal.' and '.$atrs.' | '.Jzeva;
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
        $title='Terms And Conditions | Jzeva';
      
        include TEMPLATE . 'tandc.html';
        break;
    case 'privacy':
        $page = 'privacy';
         $title='Privacy Policy | Jzeva';
        include TEMPLATE . 'privacy.html';
        break;
    case 'contact':
        $page = 'contact';
        $title='Contact Us | Jzeva';
        include TEMPLATE . 'contact.html';
        break;
    case 'warranty':
        $page = 'warranty';
        $title='Our Warranty And Repairs | Jzeva';
        include TEMPLATE . 'warranty.html';
        break;
    case 'randc':
        $page = 'randc';
        $title='Our Returns And Exchange Policy | Jzeva';
        include TEMPLATE . 'randc.html';
        break;
    case 'diamondguide':
        $page = 'diamondguide';
        $title='Have a Look on Diamond Guide | Jzeva';
        $desc="Learn about the Diamond Quality,Diamond Colour,Diamond Cut and Carat.";
        $descp= trim(preg_replace('/\s\s+/', ' ', $desc));

        include TEMPLATE . 'diamondguide.html';
        break;
    case 'preciousmetalguide':
        $page = 'preciousmetalguide';
        $title='Precious Metal Guide | Jzeva';
        $desc=" Learn how to clean precious jewellery, how to care diamond & gemstone jewellery";
        $descp= trim(preg_replace('/\s\s+/', ' ', $desc));
        include TEMPLATE . 'preciousmetalguide.html';
        break;
    case 'jewellerycare':
        $page = 'jewellerycare';
        $title='Learn to Care Your Jewellery | Jzeva';
        $desc=" Learn how to clean precious jewellery, how to care diamond & gemstone jewellery";
        $descp= trim(preg_replace('/\s\s+/', ' ', $desc));

        include TEMPLATE . 'jewellerycare.html';
        break;
    case 'responsiblef':
        $page = 'responsiblef';
        $title=' Our Jewellery hasn’t caused any Violations to Human-Rights or the Environment. | Jzeva';
        include TEMPLATE . 'responsiblef.html';
        break;
//    case 'gemstoneguide':
//        $page = 'gemstoneguide';
//        include TEMPLATE . 'gemstoneguide.html';
//        break;
    case 'faq':
        $page = 'faq';
         $title='Frequently Asked Questions | Jzeva';
        include TEMPLATE . 'faq.html';
        break;
    case 'sizeguide':
        $page = 'sizeguide';
        $title="Look Your Ring Size - Rings Guide";
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
        $title='Shipping Details | Jzeva';
        include TEMPLATE . 'shipping.html';
        break;
    case 'bangleguide':
        $page = 'bangleguide';
        $title='Look Your Bangle Size - Bangles Guide';
        include TEMPLATE . 'bangleguide.html';
        break;
    case 'conciergeServices':
        $page = 'conciergeServices';
        $title='Concierge Services | Jzeva';
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
        $title='Our Promise to the Customers | Jzeva';
        include TEMPLATE . 'ourPromise.html';
        break;
    case 'ourStory':
        $page = 'ourStory';
        $title='Our Story Behind Our Jewellery| Jzeva';
        include TEMPLATE . 'ourStory.html';
        break;
    case 'craftsmanship':
        $page = 'craftsmanship';
        $title='Craftmanship | Jzeva';
        include TEMPLATE . 'craftsmanship.html';
        break;
  
    case 'gemstoneGuideNew':
        $page = 'gemstoneGuideNew';
        $title='Have a Look on Gemstone Guide | Jzeva';
         $desc="Buy Gemstone studded Jewellery";
        $descp= trim(preg_replace('/\s\s+/', ' ', $desc));
        $keywords="Ruby,Emerald,Amber,Pearl,Amethyst,Sapphire,Blue-Topaz,Red-Coral,Moonstone,Aquamarine,Tanzanite,Jade";
      
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
        $title='Bespoke Designer Jewellery | Jzeva';
       
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
