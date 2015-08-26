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
        $desid  = (!empty($params['desid']) && !stristr($params['desid'],'null')  && !stristr($params['desid'],'undefined')) ?  trim(urldecode($params['desid'])) : 0;
        if(empty($desid))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention the designerid');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }        
    }
    if($action=='latestdesigner')
    {
        $afterdt = (!empty($params['adate']) && !stristr($params['adate'],'null') && !stristr($params['adate'],'undefined')) ?  trim(urldecode($params['adate'])) : '';
        if(empty($afterdt))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention the date in proper format');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
        }
        
    }
     switch($action)
    {
         
//   localhost/jzeva-api/designer.php?&action=prdWithDesigner&trace=1
        case 'prdWithDesigner': //show all products designer wise
            $err = array('errCode' => 2, 'errMsg' => 'Error in fetching details from database');
            $results = array();
            $sql="select product.pcode,product.pname,designer.desname from product,designer order by designer.desname desc";
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
    
// localhost/jzeva-api/designer.php?&action=designerInfo&trace=1        
        case 'designerInfo':  // shows all the designers in database
            $err = array('errCode' => 2, 'errMsg' => 'Error in fetching details from database');
            $results = array();
            $sql="select * from designer";
            $res = $obj->firequery($sql);
            
            if($res)
            {
                while( $row =$obj->bringdata($res))
               
                {
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
            
            if($row)
                { 
                        $reslt['desid'] = $row['desid'];
                        $reslt['desname'] = $row['desname'];
                        $reslt['deslocation'] = $row['deslocation'];
                        $reslt['desexperience'] = $row['desexperience'];
                        
                    $results[]=$reslt;
                }
            $err = array('errCode' => 0, 'errMsg' => 'Values shown successfully!');
            }
            
                }
            $result = array('results' => $results, 'error' => $err);
            break;

//  localhost/jzeva-api/designer.php?&action=prdbydsign&desid=1&trace=1
        case "prdbydsign": //show products with a partcular designer's data
                $err=array('errCode' => 0, 'errMsg' => 'Error in fetching details from database');
                $results=array();
                $sql="select product.pcode,product.pname,designer.desname,product.cwv,designer.deslocation,designer.desexperience from product,designer where product.did='$desid'";
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
                   $reslt['product_code']=$row['pcode'];
                   $reslt['product_name']=$row['pname'];
                   $reslt['designer_name']=$row['desnname'];
                   $reslt['designer_location']=$row['deslocation'];
                   $reslt['designer_experience']=$row['desexperience'];
                   $reslt['product_cwv']=$row['cwv'];
                   echo "<br/>";
            }
            $err = array('errCode' => 0, 'errMsg' => 'Values shown successfully!');
            $result = array('results' => $reslt, 'error' => $err);
            break;

//  localhost/jzeva-api/designer.php?&action=latestdesigner&adate=2015-08-01&trace=1
        case 'latestdesigner': // show the newly appeared designers in the market
            $err = array('errCode' => 2, 'errMsg' => 'Error in fetching details from database');
            $results = array();
            $sql="select * from product where cdt > '$afterdt' order by cdt desc";
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
            echo json_encode($result);
            exit;
            break;
    }
$obj->close();
echo json_encode($result);
exit();
?>