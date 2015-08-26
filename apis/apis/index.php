<?php

	include '../config.php';
	
	$res['results'] = array();
	$res['error'] = array('code' => 0, 'msg' => 'Data Fetched Successfully.');

    $action = $_GET['action'];
	switch($action)
	{
		case 'cAuto':
			include APICLUDE.'class.auto.php';
			$str 	= $_GET['str'];
			$obj 	= new auto($db['jzeva']);
			$result = $obj->cAuto($str);
			$res['results'] = $result;
			echo json_encode($res);
		break;
		
		case 'aAuto':
			include APICLUDE.'class.auto.php';
			$str 	= $_GET['str'];
			$obj 	= new auto($db['jzeva']);
			$result = $obj->aAuto($str);
			$res['results'] = $result;
			echo json_encode($res);
		break;
            
                case 'vPrd':
                        include APLICUDE.'class.products.php';
                        $str    = $_GET['str'];
                        $obj    = new auto($db['jzeva']);
                        $result = $obj->vPrd($str);
                        $res['results'] = $result;
                        echo json_encode($res);
                break;
            
                case 'vUser':
                        include APLICUDE.'class.users.php';
                        $str    = $_GET['str'];
                        $obj    = new auto($db['jzeva']);
                        $result = $obj->vUser($str);
                        $res['results'] = $result;
                        echo json_encode($res);
                break;
            
		
		case 'vSCart':
			include APICLUDE.'class.shopcart.php';
			$mb 	= $_GET['mb'];
			$obj 	= new rate($db['jzeva']);
			$result = $obj->cOTP($mb);
			$res['results'] = $result;
			echo json_encodse($res);
		break;
                
        	case 'order':
			include APICLUDE.'class.orders.php';
			$vl = $_GET['vl'];
			$obj = new functions($db['jzeva']);
			$result = $obj->fCurList($vl);
			$res['results'] = $result;
			echo json_encode($res);
		break;
            
            
            /*
		case 'rOTP':
			include APICLUDE.'class.rate.php';
			$mb 	= $_GET['mb'];
			$vc 	= $_GET['vc'];
			$obj 	= new rate($db['nafex']);
			$result = $obj->rOTP($mb,$vc);
			$res['results'] = $result;
			echo json_encode($res);
		break;
		
		case 'cRate':
			include APICLUDE.'class.rate.php';
			$c1 = $_GET['c1'];
			$c2 = $_GET['c2'];
			$et = $_GET['etype'];
			$qn = $_GET['qn'];
			$obj 	= new rate($db['nafex']);
			$result = $obj->cRate($c1,$c2,$et,$qn);
			$res['results'] = $result;
			echo json_encode($res);
		break;
		*/

		/*
		case 'cUrl':
			$par = $_GET['par'];
			include APICLUDE.'class.functions.php';
			$obj = new functions($db['nafex']);
			$result = $obj->cUrlPar($par);
			$res = $result;
			echo json_encode($res);
		break;*/
	}
?>