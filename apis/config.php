<?php

if(!stristr($_SERVER['HTTP_HOST'], '.jzeva.com') && !stristr($_SERVER['HTTP_HOST'], 'localhost'))
{
    $inival = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/jzeva_con.ini',true);
}

define('DOMAIN','http://'.$_SERVER['HTTP_HOST'].'/jzeva/');
define('APIDOMAIN','http://'.$_SERVER['HTTP_HOST'].'/jzeva/apis/');
define('WEBROOT',$_SERVER['DOCUMENT_ROOT'].'/jzeva/');
define('TEMPLATE',WEBROOT.'template/');
define('INCLUDES',WEBROOT.'include/');
define('APICLUDE',WEBROOT.'apis/include/');
define('VERSION',0.1);
//define('SMSAPI','http://alerts.sinfini.com/api/web2sms.php?workingkey=Aacffda7db60ac1a8470709273bea3bfe&to=+91_MOBILE&sender=NAFEXC&message=_MESSAGE');


$db['jzeva'] = array('localhost','root','','jzeva');

$css['home'] = DOMAIN.'tools/css/home.css?v='.VERSION;
$css['curr'] = DOMAIN.'tools/css/currency.css?v='.VERSION;
$css['cflg'] = DOMAIN.'tools/css/currencyFlags.css?v='.VERSION;
$css['foot'] = DOMAIN.'tools/css/footer.css?v='.VERSION;
$css['cntr'] = DOMAIN.'tools/css/country.css?v='.VERSION;
$css['test'] = DOMAIN.'tools/css/testimonial.css?v='.VERSION;

//$jvs['jqry'] = DOMAIN.'tools/js/lib/jquery.js';
//$jvs['auto'] = DOMAIN.'tools/js/lib/autosuggest.js?v='.VERSION;

//$jvs['home'] = DOMAIN.'tools/js/homePage.js?v='.VERSION;
//$jvs['yout'] = DOMAIN.'tools/js/yout.js?v='.VERSION;
//$jvs['track'] = DOMAIN.'tools/js/trackPage.js?v='.VERSION;
//$jvs['comm'] = DOMAIN.'tools/js/Common.js?v='.VERSION;
//$jvs['hamm'] = DOMAIN.'tools/js/hammer.js?v='.VERSION;
//$jvs['tracktimer'] = DOMAIN.'tools/js/lib/trackTime.js?v='.VERSION;
//$jvs['contact'] = DOMAIN.'tools/js/contact.js?v='.VERSION;

include INCLUDES.'class.common.php';

$comm = new Common();
$comm->clearParam($_GET);
?>