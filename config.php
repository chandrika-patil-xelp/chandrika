<?php
error_reporting(0);

if(stristr($_SERVER['HTTP_HOST'], 'jzeva.com'))
{
	define('DOMAIN','http://'.$_SERVER['HTTP_HOST'].'/');
	define('APIDOMAIN','http://'.$_SERVER['HTTP_HOST'].'/apis/');
	define('BACKDOMAIN','http://'.$_SERVER['HTTP_HOST'].'/backend/');
	define('WEBROOT',$_SERVER['DOCUMENT_ROOT'].'/');
	define('BACKWEBROOT',$_SERVER['DOCUMENT_ROOT'].'/backend/');
	define('IMGDOMAIN','http://'.$_SERVER['HTTP_HOST'].'/backend/image-upload/');

	$db['jzeva'] = array('localhost','root','developer@jzeva','db_jzeva');
}
else
{
	define('DOMAIN','http://'.$_SERVER['HTTP_HOST'].'/jzeva/');
	define('APIDOMAIN','http://'.$_SERVER['HTTP_HOST'].'/jzeva/apis/');
	define('BACKDOMAIN','http://'.$_SERVER['HTTP_HOST'].'/jzeva/backend/');
	define('WEBROOT',$_SERVER['DOCUMENT_ROOT'].'/jzeva/');
	define('BACKWEBROOT',$_SERVER['DOCUMENT_ROOT'].'/jzeva/backend/');
	define('IMGDOMAIN','http://'.$_SERVER['HTTP_HOST'].'/jzeva/backend/image-upload/');

	$db['jzeva'] = array('localhost','root','','db_jzeva_shubham');
	
}

define('BTEMPLATE',BACKWEBROOT.'template/');
define('BINCLUDES',BACKWEBROOT.'include/');
define('BAPICLUDE',BACKWEBROOT.'apis/include/');

define('TEMPLATE',WEBROOT.'frontend/template/');
define('INCLUDES',WEBROOT.'include/');
define('APICLUDE',WEBROOT.'apis/include/');

define('VERSION',1.0);



define('FAVICON', BACKDOMAIN . 'tools/img/common/favicon.ico');

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
        
#JS End
        
        
        
        #FRONTEND
        $fcss=array();
        $fjvs=array();
        
        
            $fcss['home']             = DOMAIN.'frontend/tools/css/home.css?v='.VERSION;
             $fcss['inpt_form']             = DOMAIN.'frontend/tools/css/input_and_form.css?v='.VERSION;
             $fcss['ripple']             = DOMAIN.'frontend/tools/css/ripple.css?v='.VERSION;
            $fcss['range_slider']             = DOMAIN.'frontend/tools/css/rangeslider/ion.rangeSlider.css?v='.VERSION;
            $fcss['range_slider1']             = DOMAIN.'frontend/tools/css/rangeslider/ion.rangeSlider.skinHTML5.css?v='.VERSION;
            $fcss['range_slider2']             = DOMAIN.'frontend/tools/css/rangeslider/normalize.css?v='.VERSION;
            $fcss['gemstone']             = DOMAIN.'frontend/tools/css/gemstone.css?v='.VERSION;
            $fcss['bxslider']             = DOMAIN.'frontend/tools/css/jquery.bxslider.css?v='.VERSION;
            $fjvs['jquery']                   = DOMAIN.'frontend/tools/js/jquery.js?v='.VERSION;
            
            $fjvs['bxslider']                   = DOMAIN.'frontend/tools/js/jquery.bxslider.js?v='.VERSION; 
            $fjvs['velocity']                   = DOMAIN.'frontend/tools/js/velocity.js?v='.VERSION;
            $fjvs['menu']                   = DOMAIN.'frontend/tools/js/menu.js?v='.VERSION;
            $fjvs['home']                   = DOMAIN.'frontend/tools/js/home.js?v='.VERSION;
            $fjvs['range_slider']                   = DOMAIN.'frontend/tools/js/ion.rangeSlider.js?v='.VERSION;
            $fjvs['hammer']                   = DOMAIN.'frontend/tools/js/hammer.js?v='.VERSION;
             $fjvs['ripple']                   = DOMAIN.'frontend/tools/js/ripple.js?v='.VERSION;
            
include APICLUDE.'common/class.common.php';
$comm = new Common();
$comm->clearParam($_GET);



?>