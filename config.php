<?php
/*
if(!stristr($_SERVER['HTTP_HOST'], '.b2eweb.com') && !stristr($_SERVER['HTTP_HOST'], 'localhost'))
{
    $inival = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/b2e_con.ini',true);
}
*/
define('DOMAIN','http://'.$_SERVER['HTTP_HOST'].'/jzeva/');
define('APIDOMAIN','http://'.$_SERVER['HTTP_HOST'].'/jzeva/apis/');
define('WEBROOT',$_SERVER['DOCUMENT_ROOT'].'/jzeva/');
define('TEMPLATE',WEBROOT.'template/');
define('INCLUDES',WEBROOT.'include/');
define('APICLUDE',WEBROOT.'apis/include/');
define('VERSION',0.8);
/*define('SMSAPI','http://alerts.sinfini.com/api/web2sms.php?workingkey=Aacffda7db60ac1a8470709273bea3bfe&to=+91_MOBILE&sender=NAFEXC&message=_MESSAGE');

/*
$db['comm-api'] = array('127.0.0.1','root','','db_common');
$db['kitty'] = array('127.0.0.1','root','','db_kitty');
$db['qdost'] = array('127.0.0.1','root','','db_qdost');
*/
$db['jzeva'] = array('localhost','root','','db_jzeva');

/*$css['home'] = DOMAIN.'tools/css/home.css?v='.VERSION;

$jvs['jqry'] = DOMAIN.'tools/js/lib/jquery.js';
*/
include INCLUDES.'class.common.php';
$comm = new Common();
$comm->clearParam($_GET);
?>
