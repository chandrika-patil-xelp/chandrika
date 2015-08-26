<?php

define('DOMAIN','http://'.$_SERVER['HTTP_HOST'].'jzeva/'); //online live server address
define('WEBROOT',$_SERVER['DOCUMENT_ROOT'].'/jzeva-api/'); //all files will be present in
define('TEMPLATE',WEBROOT.'template/'); //GUI pages will be in
define('INCLUDER',WEBROOT.'include/'); //Included documents

$db = array(); //instead of writting array again we use this

//Find the occurrence of a string for case insensitivity

if(stristr($_SERVER['HTTP_HOST'],'.jzeva.com') || stristr($_SERVER['HTTP_HOST'],'localhost'))
{    /* this is a comment 
      *  variable['declared_string'] = array('localhost*','username*','password*','dbname*');
      *  */
	
        $db['jzeva'] = array('127.0.0.1','root','','jzeva');
	
        
}
?>