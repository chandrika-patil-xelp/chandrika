<?php

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

$params = array_merge($_GET,$_POST);
$str = urldecode($params['search']);
$case = $params['case'];
$obj = new dbclass($db['jzeva']);

switch ($case)
{
// localhost/jzeva-api/inbuiltFunc.php?&case=searchbox&search=j&trace=1
    case 'searchbox':
			if(!empty($str)) {
				$sql = 	"SELECT pcode, 
						pname, 
						ptype, 
						mtype, 
                                                color, 
						shape, 
                                                mwt,
                                                twt,
                                                MATCH(pname) AGAINST ('" . $str . "*' IN BOOLEAN MODE) AS startwith "
						. "FROM 
								`product` "
						. "WHERE 
								MATCH(pname) AGAINST ('" . $str . "*' IN BOOLEAN MODE) "
						. "ORDER BY 
								startwith DESC "
						. "LIMIT 
								0,10";
				$res =  $obj->firequery($sql);
				if($res)
				{
					$i=0;
					while($row = $obj->bringdata($res))
					{
						unset($arrval);
						$arrval['id'] 			= $row['pcode'];
						$arrval['name'] 		= $row['pname'];
						$arrval['category']		= $row['ptype'];
						$arrval['designer'] 		= $row['did'];
						$arrval['metal_used']           = $row['mtype'];
						$arrval['metal_weight']		= $row['mwt'];
                                                $arrval['total_weight']		= $row['twt'];
                                                $arrval['gem_color']		= $row['color'];
                                                $arrval['diamond_shape']	= $row['shape'];
						$arr['result'][] = $arrval;
					}
					$arr['error']['code'] = 0;
					$arr['error']['msg'] = '';
				}
				else
				{
					$arr['result'] = array();
					$arr['error']['code'] = 1;
					$arr['error']['msg'] = 'Query Failed';
				}
			}
			else
			{
				$arr['result'] = array();
				$arr['error']['code'] = 1;
				$arr['error']['msg'] = 'Incorrect Parameters Passed';
			}
	break;
	
	default:
			$arr['result'] = array();
			$arr['error']['code'] = 1;
			$arr['error']['msg'] = 'Incorrect Parameters Passed';
	break;
}
echo json_encode($arr);
?>