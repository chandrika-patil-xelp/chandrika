<?php
set_time_limit(0);
error_reporting(1);
include 'config.php';
include INCLUDER . 'dbclass.php';
$params = array_merge($_GET, $_POST);
    if ($params['trace']) 
    {
        define("DEBUG_MODE", "1");
    }
    else
    {
        define("DEBUG_MODE", "0");
        header('Content-type: application/json');
    }
    $obj = new dbclass($db['jzeva']);
    if (DEBUG_MODE) 
    {
        echo "Request Parameters: ";        
        print_r("<pre>");
        print_r($params);
        echo "</pre>";
        echo "<br/><br/>";
    }
    $action = (!empty($params['action']) && !stristr($params['action'], 'null') && !stristr($params['action'], 'undefined')) ? trim($params['action']) : '';
    if (empty($action)) 
    {
        $res = array();
        $err = array('errCode' => 1, 'errMsg' => 'Please mention action to be performed');
        $result = array('results' => $res, 'error' => $err);
        echo json_encode($result);
        exit;
    }
    if($action=='prdbydsign')
    {
        $user_id  = (!empty($params['userid']) && !stristr($params['userid'],'null')  && !stristr($params['userid'],'undefined')) ?  trim(urldecode($params['userid'])) : 0;
        if(empty($user_id))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention the designerid');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }        
    }
    
     switch($action)
    {
  // localhost/jzeva-api/customdesign.php?&action=showDesign&userid=1&trace=1
        case 'showDesign':
            $err = array('errCode' => 2, 'errMsg' => 'Error in fetching details from database');
            $results = array();
            $sql="select dp from customdesign where user_id= '$user_id' and status=1 order by cdid";
            $res = $obj->firequery($sql);            
            if(DEBUG_MODE)
            {
                echo '<br/>';
                echo 'Select Query:';
                echo '<br/>';
                echo $sql;
                echo '<br/>';
                echo 'Select Query Resource: ';
                echo $res;
                echo '<br/>';
                echo 'MySql Error Number: ' . mysql_errno() . ' AND MySql Error Message: ' . mysql_error();
            }
             while( $row =$obj->bringdata($res))
                { 
                    $results[]=$row;
                }
            $err = array('errCode' => 0, 'errMsg' => 'Values shown successfully!');            
            $result = array('results' => $results, 'error' => $err);
            break;            
    
            default :    
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Respective action not found');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            break;
    }
$obj->close();
echo json_encode($result);
exit();
?>