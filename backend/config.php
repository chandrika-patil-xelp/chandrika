<?php
error_reporting(0);


define('DOMAIN','http://'.$_SERVER['HTTP_HOST'].'/jzeva_backend/');
define('APIDOMAIN','http://'.$_SERVER['HTTP_HOST'].'/jzeva_backend/apis/');
define('WEBROOT',$_SERVER['DOCUMENT_ROOT'].'/jzeva_backend/');

define('TEMPLATE',WEBROOT.'template/');
define('INCLUDES',WEBROOT.'include/');
define('APICLUDE',WEBROOT.'apis/include/');
define('VERSION',1.0);



define('FAVICON', DOMAIN . 'tools/img/common/favicon.ico');

$db['jzeva_backend'] = array('localhost','root','','db_jzeva');

$css = array();
$jvs = array();


#CSS
    $css['jquery_toast'] = DOMAIN.'tools/css/lib/jquery.toast.min.css?v='.VERSION;
    $css['backend'] = DOMAIN.'tools/css/backend.css?v='.VERSION;
#CSS End


#JS
    $jvs['jqry'] 		= DOMAIN.'tools/js/lib/jquery.js?v='.VERSION;
    $jvs['jqryUi'] 		= DOMAIN.'tools/js/lib/jquery-ui.js?v='.VERSION;
    $jvs['increase']            = DOMAIN.'tools/js/lib/jquery.increaseAuto.js?v='.VERSION;
    $jvs['jquery_toast'] 	= DOMAIN.'tools/js/lib/jquery.toast.min.js?v='.VERSION;
    $jvs['velocity']            = DOMAIN.'tools/js/lib/velocity.js?v='.VERSION;
    $jvs['common']            = DOMAIN.'tools/js/Common.js?v='.VERSION;
#JS End
    
    
include INCLUDES.'class.common.php';
$comm = new Common();
$comm->clearParam($_GET);



?>