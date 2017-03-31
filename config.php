<?php
error_reporting(0);
define('REQURI', $_SERVER['REQUEST_URI']);
if($_SERVER['HTTPS'])
{
		$httpReq = 'https://';
}
else
{
		$httpReq = 'http://';
}

if(stristr($_SERVER['HTTP_HOST'],'jzeva.com') && stristr(REQURI, 'beta'))
{
	define('WEBROOT', $_SERVER['DOCUMENT_ROOT'].'/beta/');
	define('DOMAIN', $httpReq.$_SERVER['HTTP_HOST'].'/beta/');
	define('APIDOMAIN',$httpReq.$_SERVER['HTTP_HOST'].'/beta/apis/');
	define('IMGDOMAIN',$httpReq.$_SERVER['HTTP_HOST'].'/backend/image-upload/');
	define('BACKDOMAIN',$httpReq.$_SERVER['HTTP_HOST'].'/beta/backend/');
	define('BACKWEBROOT',$_SERVER['DOCUMENT_ROOT'].'/beta/backend/');
	$db['jzeva'] = array('localhost','root','developer@jzeva','db_jzeva_beta');
}

else if(stristr($_SERVER['HTTP_HOST'], 'jzeva.com'))
{
	define('DOMAIN',$httpReq.$_SERVER['HTTP_HOST'].'/');
	define('APIDOMAIN',$httpReq.$_SERVER['HTTP_HOST'].'/apis/');
	define('BACKDOMAIN',$httpReq.$_SERVER['HTTP_HOST'].'/backend/');
	define('WEBROOT',$_SERVER['DOCUMENT_ROOT'].'/');
	define('BACKWEBROOT',$_SERVER['DOCUMENT_ROOT'].'/backend/');
	define('IMGDOMAIN',$httpReq.$_SERVER['HTTP_HOST'].'/backend/image-upload/');
	$db['jzeva'] = array('localhost','root','developer@jzeva','db_jzeva');
}
else
{
	define('DOMAIN',$httpReq.$_SERVER['HTTP_HOST'].'/jzeva/');
	define('APIDOMAIN',$httpReq.$_SERVER['HTTP_HOST'].'/jzeva/apis/');
	define('BACKDOMAIN',$httpReq.$_SERVER['HTTP_HOST'].'/jzeva/backend/');
	define('WEBROOT',$_SERVER['DOCUMENT_ROOT'].'/jzeva/');
	define('BACKWEBROOT',$_SERVER['DOCUMENT_ROOT'].'/jzeva/backend/');
	define('IMGDOMAIN',$httpReq.$_SERVER['HTTP_HOST'].'/jzeva/backend/image-upload/');
	$db['jzeva'] = array('localhost','root','','db_jzeva');
}


// define('SMSAPI','http://alerts.sinfini.com/api/web2sms.php?workingkey=A31cf85c3cc3b65100bf9bd7fbe30cd90&to=+91_MOBILE&sender=SIDEMO&message=_MESSAGE');
  define('SMSAPI','http://123.63.33.43//blank/sms/user/urlsmstemp.php?username=jzeva&pass=jzeva@123&senderid=JZVLUX&dest_mobileno=+91_MOBILE&tempid=36890&F1=jzeva&F2=jzeva@123&F3=+919986814466&response=Y&message=_MESSAGE');

define('BTEMPLATE',BACKWEBROOT.'template/');
define('BINCLUDES',BACKWEBROOT.'include/');
define('BAPICLUDE',BACKWEBROOT.'apis/include/');

define('TEMPLATE',WEBROOT.'frontend/template/');
define('INCLUDES',WEBROOT.'include/');
define('APICLUDE',WEBROOT.'apis/include/');

define('VERSION',2.22);



//define('FAVICON', BACKDOMAIN . 'tools/img/common/favicon.ico');
define('FAVICON', DOMAIN.'frontend/tools/img/icons/fav1.png');

$css = array();
$jvs = array();


#CSS
    $css['jquery_toast']        = BACKDOMAIN.'tools/css/lib/jquery.toast.min.css?v='.VERSION;
    $css['backend']             = BACKDOMAIN.'tools/css/backend.css?v='.VERSION;
    $css['rangeSlider']        = BACKDOMAIN.'tools/css/lib/rangeslider/ion.rangeSlider.css?v='.VERSION;
    $css['rangeSkin']        = BACKDOMAIN.'tools/css/lib/rangeslider/ion.rangeSlider.skinHTML5.css?v='.VERSION;
    $css['rangeNormalize']        = BACKDOMAIN.'tools/css/lib/rangeslider/normalize.css?v='.VERSION;





#CSS End

#JS
    $jvs['jqry'] 		= BACKDOMAIN.'tools/js/lib/jquery.js?v='.VERSION;
    $jvs['jqryUi'] 		= BACKDOMAIN.'tools/js/lib/jquery-ui.js?v='.VERSION;
    $jvs['increase']            = BACKDOMAIN.'tools/js/lib/jquery.increaseAuto.js?v='.VERSION;
    $jvs['jquery_toast'] 	= BACKDOMAIN.'tools/js/lib/jquery.toast.min.js?v='.VERSION;
    $jvs['velocity']            = BACKDOMAIN.'tools/js/lib/velocity.js?v='.VERSION;
    $jvs['common']              = BACKDOMAIN.'tools/js/Common.js?v='.VERSION;
    $jvs['nicescroll']          = BACKDOMAIN.'tools/js/lib/jquery.nicescroll.min.js?v='.VERSION;
    $jvs['rangeJS']          = BACKDOMAIN.'tools/js/lib/ion.rangeSlider.js?v='.VERSION;





        #CMS PAGES JS
            $jvs['Product']                 = BACKDOMAIN.'tools/js/cms/product.js?v='.VERSION;
            $jvs['addProduct']              = BACKDOMAIN.'tools/js/cms/addProduct.js?v='.VERSION;
            $jvs['rate']                    = BACKDOMAIN.'tools/js/cms/rate.js?v='.VERSION;
            $jvs['category']                = BACKDOMAIN.'tools/js/cms/category.js?v='.VERSION;
            $jvs['addCategory']             = BACKDOMAIN.'tools/js/cms/addCategory.js?v='.VERSION;
            $jvs['addAttribute']            = BACKDOMAIN.'tools/js/cms/addAttribute.js?v='.VERSION;
            $jvs['attribute']               = BACKDOMAIN.'tools/js/cms/attribute.js?v='.VERSION;
            $jvs['coupon']               = BACKDOMAIN.'tools/js/cms/coupon.js?v='.VERSION;
            $jvs['search']               = BACKDOMAIN.'tools/js/cms/searchJs.js?v='.VERSION;
            $jvs['placeOrder']               = BACKDOMAIN.'tools/js/cms/placeOrder.js?v='.VERSION;

#JS End



        #FRONTEND
        $fcss=array();
        $fjvs=array();


            $fcss['home']             = DOMAIN.'frontend/tools/css/home.css?v='.VERSION;
            $fcss['oldcss']             = DOMAIN.'frontend/tools/css/oldCss.css?v='.VERSION;
            $fcss['inpt_form']             = DOMAIN.'frontend/tools/css/input_and_form.css?v='.VERSION;
						$fcss['main']             = DOMAIN.'frontend/tools/css/main.css?v='.VERSION;
						$fcss['toaster']             = DOMAIN.'frontend/tools/css/webToaster.css?v='.VERSION;
            $fcss['ripple']             = DOMAIN.'frontend/tools/css/ripple.css?v='.VERSION;
            $fcss['range_slider']             = DOMAIN.'frontend/tools/css/rangeslider/ion.rangeSlider.css?v='.VERSION;
            $fcss['range_slider1']             = DOMAIN.'frontend/tools/css/rangeslider/ion.rangeSlider.skinHTML5.css?v='.VERSION;
            $fcss['range_slider2']             = DOMAIN.'frontend/tools/css/rangeslider/normalize.css?v='.VERSION;
            $fcss['range_slider3']             = DOMAIN.'frontend/tools/css/rangeslider/ion.rangeSlider.skinFlat.css?v='.VERSION;
            $fcss['range_slider4']             = DOMAIN.'frontend/tools/css/rangeslider/ion.rangeSlider.skinModern.css?v='.VERSION;
            $fcss['range_slider5']             = DOMAIN.'frontend/tools/css/rangeslider/ion.rangeSlider.skinNice.css?v='.VERSION;
            $fcss['range_slider6']             = DOMAIN.'frontend/tools/css/rangeslider/ion.rangeSlider.skinSimple.css?v='.VERSION;
            $fcss['gemstone']             = DOMAIN.'frontend/tools/css/gemstone.css?v='.VERSION;
            $fcss['bxslider']             = DOMAIN.'frontend/tools/css/jquery.bxslider.css?v='.VERSION;
            $fjvs['jquery']                   = DOMAIN.'frontend/tools/js/jquery.js?v='.VERSION;
						$fcss['malihu']        = DOMAIN.'frontend/tools/css/jquery.mCustomScrollbar.min.css?v='.VERSION;

            $fjvs['bxslider']                   = DOMAIN.'frontend/tools/js/jquery.bxslider.js?v='.VERSION;
            $fjvs['velocity']                   = DOMAIN.'frontend/tools/js/velocity.js?v='.VERSION;
            $fjvs['nicescroll']                   = DOMAIN.'frontend/tools/js/jquery.nicescroll.min.js?v='.VERSION;
            $fjvs['menu']                   = DOMAIN.'frontend/tools/js/menu.js?v='.VERSION;
            $fjvs['home']                   = DOMAIN.'frontend/tools/js/home.js?v='.VERSION;
            $fjvs['range_slider']                   = DOMAIN.'frontend/tools/js/ion.rangeSlider1.js?v='.VERSION;
            $fjvs['hammer']                   = DOMAIN.'frontend/tools/js/hammer.js?v='.VERSION;
            $fjvs['malihu']                   = DOMAIN.'frontend/tools/js/jquery.mCustomScrollbar.concat.min.js?v='.VERSION;
            $fjvs['ripple']                   = DOMAIN.'frontend/tools/js/ripple.js?v='.VERSION;
            $fjvs['Common']              = DOMAIN.'frontend/tools/js/Common.js?v='.VERSION;
            $fjvs['toastr'] 	= DOMAIN.'frontend/tools/js/toastr.js?v='.VERSION;
						$fjvs['numerator'] 	= DOMAIN.'frontend/tools/js/jquery-numerator.js?v='.VERSION;
              #CMS PAGES JS(Frontend)
            $jvs['prodpage']                 = DOMAIN.'frontend/tools/js/cms/prodpage.js?v='.VERSION;
            $jvs['proddetails']                 = DOMAIN.'frontend/tools/js/cms/product_details.js?v='.VERSION;
            $jvs['prodGrid']                 = DOMAIN.'frontend/tools/js/cms/prodgrid.js?v='.VERSION;
            $jvs['protry']                 = DOMAIN.'frontend/tools/js/cms/protry.js?v='.VERSION;
            $jvs['login']                 = DOMAIN.'frontend/tools/js/cms/login.js?v='.VERSION;
            $jvs['cart']                 = DOMAIN.'frontend/tools/js/cms/cart.js?v='.VERSION;
            $jvs['filter']                 = DOMAIN.'frontend/tools/js/cms/filter.js?v='.VERSION;
            $jvs['checkout']                 = DOMAIN.'frontend/tools/js/cms/checkout.js?v='.VERSION;
             $jvs['checkoutafter']          = DOMAIN.'frontend/tools/js/cms/checkoutafter.js?v='.VERSION;
            $jvs['filter']                 = DOMAIN.'frontend/tools/js/cms/filter.js?v='.VERSION;

            $jvs['otp']                 = DOMAIN.'frontend/tools/js/cms/otp.js?v='.VERSION;
            $jvs['resetpass']                 = DOMAIN.'frontend/tools/js/cms/resetpass.js?v='.VERSION;
	    $jvs['header']		      = DOMAIN.'frontend/tools/js/cms/header.js?v='.VERSION;
	    $jvs['account']		      = DOMAIN.'frontend/tools/js/cms/account.js?v='.VERSION;
	    $jvs['checkoutbefore']          = DOMAIN.'frontend/tools/js/cms/checkoutbefore.js?v='.VERSION;
	    $fjvs['cookie']              = DOMAIN.'frontend/tools/js/jquery.cookie.js?v='.VERSION;
             $fjvs['rangeNewJS']              = DOMAIN.'frontend/tools/js/ion.rangeSlider2.js?v='.VERSION;

	    $fjvs['tranfail']              = DOMAIN.'frontend/tools/js/cms/transactionfail.js?v='.VERSION;
	    $jvs['chkoutguest']		  = DOMAIN.'frontend/tools/js/cms/checkoutguest.js?v='.VERSION;
         $fjvs['jqueryUi']                   = DOMAIN.'frontend/tools/js/jqueryUi.js?v='.VERSION;

include APICLUDE.'common/class.common.php';
$comm = new Common();
$comm->clearParam($_GET);



?>
