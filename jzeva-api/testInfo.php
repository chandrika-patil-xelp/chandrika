<?php
// localhost/jzeva-api/testInfo.php?&trace=1	
session_start();
error_reporting( 1 );

include 'config.php';
include INCLUDER.'dbclass.php'; 

if($_REQUEST['trace']) 
{
	define("DEBUG_MODE","1"); 
}
else
{
	define("DEBUG_MODE","0"); 
	header('Content-type: application/json');
}


$conobj = new dbclass($db['jzeva']); 
IF(DEBUG_MODE) 
{ 	
	echo '<pre>'; 
	print_r($_REQUEST); 
	print_r($conobj);
} 

$sql = "show tables";

$res    = $conobj->firequery($sql); 
  
IF(DEBUG_MODE) 
{ 
	echo '<br> Query ->'.$sql; 
	echo '<br> Resource ->'.$res; 
	echo '<br> Error ->'.mysql_error();         
} 
$result_array = array();
if($res)
	{
		$row1 = $conobj->mysql_bring_ary($res); 
		foreach($row1 as $key=>$row) 
		{
			echo '<pre>';
			print_r($row);
		}
	}



?>