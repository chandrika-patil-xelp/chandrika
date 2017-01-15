<?php 
	include '../../../config.php';
	$params	= array_merge($_GET,$_POST);
	$pid 	= $params['pid'];
	$othrflg=$params['othrflg'];
	if($othrflg == 0){
	  $url = APIDOMAIN.'index.php?action=imagedisplay&pid='.$pid."&af=".urlencode('0,1')."&othrimgflag=0";
	  $res = $comm->executeCurl($url,1);
	}
	else{
	  $url = APIDOMAIN.'index.php?action=imagedisplay&pid='.$pid."&af=".urlencode('0,1')."&othrimgflag=1";
	  $res = $comm->executeCurl($url,1);
	}
	echo $res;
?>