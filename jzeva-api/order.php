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
    if($action=='orderByUid')
    {
        $user_id  = (!empty($params['userid']) && !stristr($params['userid'],'null')  && !stristr($params['userid'],'undefined')) ?  trim(urldecode($params['userid'])) :'';
        if(empty($user_id))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention the userid');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }        
    }
    
        if($action=='totalActiveOrd')
    {
        $flag  = (!empty($params['flag']) && !stristr($params['flag'],'null')  && !stristr($params['flag'],'undefined')) ?  trim(urldecode($params['flag'])) : 0;
        if(empty($flag))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention the status');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        
    }
    
      if($action=='ordByCategory')
    {
        $pcode  = (!empty($params['pcode']) && !stristr($params['pcode'],'null')  && !stristr($params['pcode'],'undefined')) ?  trim(urldecode($params['pcode'])) : 0;
        if(empty($pcode))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention the  status');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
    }

    
     switch($action)
    {
         
//    localhost/jzeva-api/order.php?action=orderByUid&userid=customer001&trace=1
        case 'orderByUid':  //for all the order history made by user.
            $err = array('errCode' => 2, 'errMsg' => 'Error in fetching details from database');
            $results = array();
            $sql="SELECT user.uname,user.user_type,user.email,user.username,scart.pcode,scart.quantity,scart.offid,
                  Ord.shipp_address,Ord.bill_address, prd.pimg,prd.pname FROM jzeva.users as user
                  JOIN jzeva.order as Ord ON user.user_id = Ord.uid
                  JOIN jzeva.shopcart as scart ON Ord.shopcartid = scart.scid
                  JOIN jzeva.product as prd ON scart.pcode = prd.pcode
                  JOIN jzeva.offer as off ON prd.offid = off.offid
                  WHERE user.user_id = '$user_id'  ORDER BY user.uname";
            $res = $obj->firequery($sql);            
            if(DEBUG_MODE)
            {
                echo '<br/>';
                echo 'Select Query:';
                echo '<br/>';
                echo $sql;
                echo '<br/><br/>';
                echo 'Select Query Resource: ';
                echo $res;
                echo '<br/>';
                echo 'MySql Error Number: ' . mysql_errno() . ' AND MySql Error Message: ' . mysql_error();
            }
             while( $row =$obj->bringdata($res))
                { 
                    $reslt['person_name'] = $row['uname'];
                    $reslt['usertype'] = $row['user_type'];
                    $reslt['user_email'] = $row['email'];
                    $reslt['username'] = $row['username'];
                    $reslt['productcode'] = $row['pcode'];
                    $reslt['product_quantitiy'] = $row['quantity'];
                    $reslt['offer_id'] = $row['offid'];
                    $reslt['shipaddress'] = $row['shipp_address'];
                    $reslt['billaddress'] = $row['bill_address'];
                    $reslt['prd_img'] = $row['pimg'];
                    $reslt['prd_name'] = $row['pname'];
                    $results[] = $reslt;
                        
                }
            $err = array('errCode' => 0, 'errMsg' => 'Values shown successfully!');            
            $result = array('results' => $results, 'error' => $err);
            break;             
// localhost/jzeva-api/totalActiveOrd.php?&action=totalActiveOrd&trace=1        
        case 'totalActiveOrd':  // shows all the lined up active orders
            $err = array('errCode' => 2, 'errMsg' => 'Error in fetching details from database');
            $results = array();
            $sql="select user.uname,user.user_id,ord.shopcartid,ord.id,ord.billingname,ord.dt from jzeva.order as ord
                  JOIN jzeva.users as user ON ord.uid = user.user_id where ord.ordstatus = '$status'";
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
            if($res)
                
            { 
                while($row = $obj->bringdata($res))
                {
                     if(DEBUG_MODE)
                    {
                        echo '<br/>';
                        echo 'Results: ';
                        echo '<br/>';
                        echo '<pre>';
                        print_r($row);
                        echo '</pre>';
                    }
                    
                    if($row && !empty($row['flag']))
                    {
                        $reslt['userid'] = $row['user_id'];
                        $reslt['username'] = $row['uname'];
                        $reslt['orderid'] = $row['shopcartid'];
                        $reslt['nameonbill'] = $row['billingname'];
                        $reslt['cartid'] = $row['shopcartid'];
                        $reslt['ordt'] = $row['dt'];
                        
                    $results[]=$reslt;
                   }
                
                }
            $err = array('errCode' => 0, 'errMsg' => 'Values shown successfully!');
            }
            $result = array('results' => $results, 'error' => $err);
            break;
//  localhost/jzeva-api/order.php?&action=ordByCategory&pcode=1&trace=1
        case "ordByCategory": //category type description
                 $err = array('errCode' => 2, 'errMsg' => 'Error in fetching details from database');
            $results = array();
            $sql    = "select p.pstatus,s.quantity,p.pcode,p.cwv,p.pname,s.cdt, from jzeva.order as o
                       JOIN shopcart as s on o.shopcartid=s.scid 
                       JOIN jzeva.product as p on s.pcode=p.pcode
                       
                       where p.pcode='$pcode' order by s.quantity";
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
            if($res)
            { 
                while($row = $obj->bringdata($res))
                {
                     if(DEBUG_MODE)
                    {
                        echo '<br/>';
                        echo 'Results: ';
                        echo '<br/>';
                        echo '<pre>';
                        print_r($row);
                        echo '</pre>';
                    }
                    
                    if($row && !empty($row['flag']))
                    {
                        $reslt['prcode'] = $row['pcode'];
                        $reslt['prdquantity'] = $row['quantity'];
                        $reslt['PrdCst'] = $row['cwv'];                        
                        $reslt['prdname'] = $row['pname'];
                        $reslt['date'] = $row['cdt'];
                        $reslt['Instock'] = $row['pstatus'];
                        $results[]=$reslt;
                   }
                
                }
            $err = array('errCode' => 0, 'errMsg' => 'Values shown successfully!');
            }
            $result = array('results' => $results, 'error' => $err);
            break;
//  localhost/jzeva-api/designer.php?&action=latestdesigner&adate=2015-08-01&trace=1
        case 'ordByAmt': // 
            $err = array('errCode' => 2, 'errMsg' => 'Error in fetching details from database');
            $results = array();
            $sql="select p.pstatus,s.quantity,p.pcode,p.cwv,p.pname,s.cdt from jzeva.order as o
                  JOIN jzeva.shopcart as s on o.shopcartid=s.scid 
                  JOIN jzeva.product as p on s.pcode=p.pcode 
                  where p.pcode='$pcode' order by s.quantity";
            $res = $obj->firequery($sql);
            if($res)
            {
                $row =$obj->bringdata($res);
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
             if(empty($row['cdt']))
            {
                $err = array('errCode' => 3, 'errMsg' => 'Error in fetching details from database');
            }
            
            if($row && !empty($row['cdt']))
                { 
  
                        $reslt['prcode'] = $row['pcode'];
                        $reslt['prdquantity'] = $row['quantity'];
                        $reslt['PrdCst'] = $row['cwv'];
                        $reslt['totalcost'] = $reslt['PrdCst'] * $reslt['prdquantity'];
                        $reslt['prdname'] = $row['pname'];
                        $reslt['date'] = $row['cdt'];
                        $reslt['Instock'] = $row['pstatus'];
                        $results=$row;
                }
            $err = array('errCode' => 0, 'errMsg' => 'Values shown successfully!');
            }
            $result = array('results' => $row, 'error' => $err);
            break;

            default :    
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Respective action not found');
            $result = array('results' => $res, 'error' => $err);
            //echo json_encode($result);
            exit;
            break;
    }
$obj->close();
//print_r($result);
echo json_encode($result);
exit();
?>