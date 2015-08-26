<?php
// localhost/jzeva-api/productInfo.php?&action=getPrdByCode&prdCode=product001&trace=1
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
        echo "<br/>";
        echo "<pre>";
        print_r($params);
        echo "</pre>";
        echo "<br/><br/>";
    }

    $action = (!empty($params['action']) && !stristr($params['action'], 'null') && !stristr($params['action'], 'undefined')) ? trim($params['action']) : '';
   $page   = (!empty($params['page']) && !stristr($params['page'], 'null') && !stristr($params['page'], 'undefined')) ? trim($params['page']) : 1;
    $limit  = (!empty($params['limit']) && !stristr($params['limit'], 'null') && !stristr($params['limit'], 'undefined')) ? trim($params['limit']) : 50;

    if (empty($action)) 
    {
        $res = array();
        $err = array('errCode' => 2, 'errMsg' => 'Please mention action to be performed');
        $result = array('results' => $res, 'error' => $err);
        echo json_encode($result);
        exit;
    }
  
 //----------------------------  1  (GET LIST BY PRODUCT TYPE)  --------------------------------------------------------------------------------
    if ($action == 'getProductType') 
    {
        $prdtype = (!empty($params['ptype']) && !stristr($params['ptype'], 'null') && !stristr($params['ptype'], 'undefined')) ? trim($params['ptype']) : 0;
    
        if (empty($prdtype)) 
        {
            $res = array();
            $err = array('errCode' => 2, 'errMsg' => 'Please mention Product type');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
        }
    }

//---------------------------- 2  (GET PRODUCT DESCRIPTION VIA CODE)  --------------------------------------------------------------------------------        
    if ($action == 'getPrdByCode') 
    {
        $prdcode = (!empty($params['prdCode']) && !stristr($params['prdCode'], 'null') && !stristr($params['prdCode'], 'undefined')) ? trim($params['prdCode']) : '';
    
        if (empty($prdcode)) 
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention Product code');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
        }
    }
    
//----------------------------  3  (GET PRODUCT DETAILS BY NAME ) -------------------------------------------------------------------------------        
    if ($action == 'getPrdByName') 
    {
        $prname = (!empty($params['prbyname']) && !stristr($params['prbyname'], 'null') && !stristr($params['prbyname'], 'undefined')) ? trim($params['prbyname']) : '';
        if (empty($prname)) 
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention Product Name');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
        }
    }

//----------------------------  4  (FILL PRODUCT DETAILS )  -------------------------------------------------------------------------------        
    if ($action == 'addProduct') 
    {
        $prdata = (!empty($params['prdata']) && !stristr($params['prdata'], 'null') && !stristr($params['prdata'], 'undefined')) ? trim($params['prdata']) : '';
        
        
        if (empty($prdata)) 
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please pass product data');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
        }
    }
  switch ($action) 
    {
      // localhost/jzeva-api/productInfo.php?action=getProductType&ptype=1&trace=0
        case 'getProductType':
            $err = array('errCode' => 1, 'errMsg' => 'Error while fetching product details');
            $results = array();
            $sql = "SELECT * FROM product WHERE ptype=$prdtype";
            if (!empty($page)) {
                $start = ($page * $limit) - $limit;      // this is for paging
                $sql.=" LIMIT " . $start . ",$limit";  // this is for limiting the content for each page
            }

            $res = $obj->firequery($sql);

            if (DEBUG_MODE) 
            {
                echo '<br/>';
                echo 'Select Query: ';
                echo '<br/>';
                echo $sql;
                echo '<br/>';
                echo 'Select Query Resource: ';
                echo $res;
                echo '<br/>';
                echo 'MySql Error Number: ' . mysql_errno() . ' AND MySql Error Message: ' . mysql_error();
            }

            if ($res) {
                while ($row = $obj->bringdata($res)) 
                {

                    if (DEBUG_MODE) 
                    {
                        echo '<br/>';
                        echo 'Results: ';
                        echo '<br/>';
                        echo '<pre>';
                        print_r($row);
                        echo '</pre>';
                    }
                    
                    if ($row && !empty($row['ptype'])) 
                    {
                        $reslt['product_code'] = $row['pcode'];
                        $reslt['product_name'] = $row['pname'];
                        $reslt['product_display_tags'] = $row['tags'];
                        $reslt['product_metal_type'] = $row['mtype'];
                        $reslt['product_color'] = $row['color'];
                        $reslt['product_shape'] = $row['shape'];
                        $reslt['product_total_wt'] = $row['twt'];
                        $reslt['product_gold_wt'] = $row['gwt'];
                        $reslt['labor charge'] = $row['lcharge'];
                        $reslt['product_designer'] = $row['did'];
                        $reslt['product_cost_without_voucher'] = $row['cwv'];
                        $results[] = $reslt;
                    }
                }
                $err = array('errCode' => 0, 'errMsg' => 'Details fetched successfully');
            }
            $result = array('results' => $results, 'error' => $err);
            break;             
        // localhost/jzeva-api/productInfo.php?action=getPrdByCode&prdCode=product001&trace=0
        case 'getPrdByCode':
            $err = array('errCode' => 2, 'errMsg' => 'Error while fetching product details');
            $results = array();
            $sql="SELECT * FROM product LEFT JOIN diamond_cat ON product.diamond_id=diamond_cat.did LEFT JOIN gold_cat on product.gold_id=gold_cat.gid WHERE product.pcode='.$prdcode.' IS NOT NULL";
            $res = $obj->firequery($sql);
              if (DEBUG_MODE)
            {
                echo '<br/>';
                echo 'Select Query: ';
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
                   $row = $obj->bringdata($res);
                 if(DEBUG_MODE)
                {
                    echo '<br/>';
                    echo 'Results: ';
                    echo '<br/>';
                    echo '<pre>';
                    print_r($row);
                    echo '</pre>';
                }
                if($row && !empty($row['prdcode']))
                { 
                    $results[]=$row;
                }
                $err = array('errCode' => 0, 'errMsg' => 'Details fetched Successfully');
            }
            
                $result = array('result' =>$row, 'error here is' => $err);
                break;                 
      //  localhost/jzeva-api/productInfo.php?action=getPrdByName&prbyname=j&trace=1        
        case 'getPrdByName': 
           $err = array('errCode' => 2, 'errMsg' => 'Error while fetching product details');
            $results = array();
            
            $sql = "SELECT *,IF(pname LIKE '".$prname."%',1,0) as startwith FROM product WHERE MATCH(pname) AGAINST (\"'" . $prname . "*'\" IN BOOLEAN MODE) ORDER BY startwith DESC ";
            if (!empty($page)) {
                $start = ($page * $limit) - $limit;
                $sql.=" LIMIT " . $start . ",$limit";
            }
            $res = $obj->firequery($sql);

            if (DEBUG_MODE) 
            {
                echo '<br/>';
                echo 'Select Query: ';
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
                $row = $obj->bringdata($res);
                    if (DEBUG_MODE) 
                    {
                        echo '<br/>';
                        echo 'Results: ';
                        echo '<br/>';
                        echo '<pre>';
                        print_r($row);
                        echo '</pre>';
                    }
                    if ($row && !empty($row['prdcode'])) 
                    { 
                        $results[]=$row;
                    }
                    $err = array('errCode' => 0, 'errMsg' => 'Details fetched successfully');
                }

                    $result = array('results' => $row, 'error' => $err);
                    break;
      // localhost/jzeva-api/productInfo.php?action=addProduct&prdata={%20%22product_details%22:%20[%20{%20%22pname%22:%20%22xxxxx%22,%20%22tags%22:%20%22round%22,%20%22ptype%22:%202,%20%22mtype%22:%201,%20%22color%22:%20%22goldenyello%22,%20%22shape%22:%201,%20%22gold_id%22:%201,%20%22diamond_id%22:%201,%20%22mwt%22:%201,%20%22twt%22:%201,%20%22gwt%22:%201,%20%22sid%22:%201,%20%22pimg%22:%201,%20%22vat%22:%201,%20%22lcharge%22:%201,%20%22did%22:%201,%20%22height%22:%201,%20%22width%22:%201,%20%22offid%22:%201,%20%22cva%22:%20%2290923.00%22,%20%22cwv%22:%20%22994323.00%22,%20%22pstatus%22:%20%221%22%20}%20]%20}&trace=1              
     
                    
        case 'addProduct':
            $err = array('errCode' => 2, 'errMsg' => 'Error while adding product');
            $results = array();           
           echo $attribute = urldecode($prdata);
            $attr =  json_decode($attribute,true);    
            print_r($attr);
            $prdDet=$attr['product_details'];
           // $prdAttr=$attr['attribute_details'];
            
            $pname=$prdDet[0]['pname'];
            $ptags=$prdDet[0]['tags'];
            $ptype=$prdDet[0]['ptype'];
            $prMetaltype=$prdDet[0]['mtype'];
            $prcolor=$prdDet[0]['color'];
            $prshape=$prdDet[0]['shape'];
            $prGoldId=$prdDet[0]['gold_id'];
            $prDiamondId=$prdDet[0]['diamond_id'];
            $prMetalWt=$prdDet[0]['mwt'];
            $prMetalType=$prdDet[0]['mtype'];
            $totalWt=$prdDet[0]['twt'];
            $prGoldWt=$prdDet[0]['gwt'];
            $prSizeId=$prdDet[0]['sid'];
            $prImg=$prdDet[0]['pimg'];
            $prVat=$prdDet[0]['vat'];
            $prLabourCharge=$prdDet[0]['lcharge'];
            $prDesignerId=$prdDet[0]['did'];
            $prheight=$prdDet[0]['height'];
            $prWidth=$prdDet[0]['width'];
            $prOfferId=$prdDet[0]['offid'];
            $prCostVoucher=$prdDet[0]['cva'];
            $prCostWithoutVoucher=$prdDet[0]['cwv'];
            $prstatus=$prdDet[0]['pstatus'];
            
            $ins_id = "product".mt_rand(000,10000000);
            $sql1="INSERT INTO product (pcode,pname,tags,ptype,mtype,color,shape,gold_id,diamond_id,mwt,twt,gwt,sid,vat,lcharge,did,height,width,offid,cwv,cva,pstatus) VALUES(\"$ins_id\",\"$pname\",\"$ptags\",\"$ptype\",\"$prcolor\",$prshape,\"$prGoldId\",\"$prDiamondId\",\"$prMetalType\",\"$totalWt\",\"$prGoldWt\",\"$prSizeId\",\"$prImg\",\"$prVat\",\"$prLabourCharge\",\"$prDesignerId\",\"$prheight\",\"$prWidth\",\"$prOfferId\",\"$prCostVoucher\",\"$prCostWithoutVoucher\",\"$prstatus\")";
            $res1 = $obj->firequery($sql1);
            
            if (DEBUG_MODE) 
            {
                echo '<br/>';
                echo 'INSERT Query: ';
                echo '<br/>';
                echo $sql1;
                echo '<br/>';
                echo 'Insert Query Resource: ';
                echo $res1;
                echo '<br/>';
                echo 'MySql Error Number: ' . mysql_errno() . ' AND MySql Error Message: ' . mysql_error();
            }
          
            if($res1)
            {
                $err = array('errCode' => 0, 'errMsg' => 'Product added successfully!');
            }
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
exit;