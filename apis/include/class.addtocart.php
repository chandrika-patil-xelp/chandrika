  
<?php

    include_once APICLUDE . 'common/db.class.php';
    
    class addtocart extends DB{
        
        function __construct($db) {
            parent::DB($db);
        }
        
        public function addToCart($params)
	{  
	    $params = json_decode($params[0],1); 
	    if(empty($params['cartid'])){
	      $cartid=  $this->generateId();
	    }
	    else{
	      $cartid=$params['cartid'];
	    }
	    if(empty($params['pid']) || empty($params['col_car_qty'])){
                $resp = array();
                $error = array('err_code'=>1, 'err_msg'=>'Parameters Missing');
                $result = array('result'=>$resp, 'error'=>$error);
                return $result;
            }
          
            $sql = "INSERT INTO tbl_cart_master (
                                    cart_id,
                                    product_id,
                                    userid, 
				    col_car_qty,
                                    pqty, 
				    price, 
                                    size,
				    active_flag, 
                                    created_on,
				    updatedon
                                  ) 
                                  VALUES ";
	    
                      $sql .= " (".$cartid.", '".$params['pid']."','".$params['userid']."','".$params['col_car_qty']."','".$params['qty']."',
			    '".$params['price']."','".$params['RBsize']."',1,NOW(), NOW())";
                                        
     
	 	      $sql.="
                    ON DUPLICATE KEY UPDATE
                                pqty = VALUES(pqty),price = VALUES(price),size= VALUES(size),active_flag=VALUES(active_flag),
				updatedon=VALUES(updatedon)";
		        
	     $res = $this->query($sql); 
          
             
            if($res){
                $error = array('err_msg'=>0, 'err_code'=>'Add To Cart Data Inserted Successfully');
            }else{
                $error = array('err_msg'=>1, 'err_code'=>'Error Inserting Add To Cart Data');
            } 
             
            $result = array('result'=>$params , 'error'=>$error , 'cartid' => $cartid );  
            return $result;
	  
        }
	    
  public function updatecartincrz($params)
  {
    $qnty =0;
    $qsql="SELECT   pqty  FROM  tbl_addtocart_master  WHERE cart_id='".$params['crtid']."' ";
    $res = $this->query($qsql); 
     if($res){ 
         while ($row = $this->fetchData($res)){
	   $qnty = $row['pqty'];
	 }
     }
     
    
     if(empty($params['crtid'])){
                $resp = array();
                $error = array('err_code'=>1, 'err_msg'=>'Parameters Missing');
                $result = array('result'=>$resp, 'error'=>$error);
                return $result;
            }
            $qnty=$qnty+1; 
            $sql = "UPDATE 
                            tbl_addtocart_master 
                          SET
                           pqty='".$qnty."',"."price='".$params['price']."'"
                          . " WHERE cart_id = '".$params['crtid']."'";
            
            $res = $this->query($sql);
            
            if($res){
                $error = array('err_code'=>0, 'err_msg'=>'Updated Successfully');
            }else{
                $error = array('err_code'=>1, 'err_msg'=>'Error In Updating' );
            }
            
            $results = array('result'=>$resp, 'error'=>$error);
            return $results;
	    
  }
  
  function updatecartdecrese($params)
  {
    $qnty =0;
    $qsql="SELECT   pqty  FROM  tbl_addtocart_master  WHERE cart_id='".$params['cardid']."' ";
    $res = $this->query($qsql); 
     if($res){ 
         while ($row = $this->fetchData($res)){
	   $qnty = $row['pqty'];
	 }
     }
     
    
     if(empty($params['cardid'])){
                $resp = array();
                $error = array('err_code'=>1, 'err_msg'=>'Parameters Missing');
                $result = array('result'=>$resp, 'error'=>$error);
                return $result;
            }
            $qnty=$qnty-1; 
            $sql = "UPDATE 
                            tbl_addtocart_master 
                          SET
                           pqty='".$qnty."',"."price='".$params['price']."'"
                          . " WHERE cart_id = '".$params['cardid']."'";
            
            $res = $this->query($sql);
            
            if($res){
                $error = array('err_code'=>0, 'err_msg'=>'Updated Successfully');
            }else{
                $error = array('err_code'=>1, 'err_msg'=>'Error In Updating' );
            }
            
            $results = array('result'=>$resp, 'error'=>$error);
            return $results;
  }
  
//get product and user details by order id.
	
        public function getProductByOrderId($params){
            
           // print_r($params['ordId']);
            try{
                
                $ordId = $params['ordId'];
                $resp = array();
                
                if(empty($ordId)){
                   
                    $error = array('err_code'=>1, 'err_msg'=>'Parameter Missing');
                    $result = array('result'=>$resp, 'error'=>$error);
                    return $result;
                }
                
                $sql = "SELECT 
                                cart_id AS oId,
                                product_id AS pId,
                                userid AS uId,
                                pqty AS qty,
                                metal AS mtl,
                                stone AS stn,
                                size AS size,
                                (SELECT product_name FROM tbl_product_master WHERE productid=pId) AS pName,
                                (SELECT product_seo_name FROM tbl_product_master WHERE productid=pId) AS pSeoName,
                                (SELECT procurement_cost FROM tbl_product_master WHERE productid=pId) AS pCost,
                                (SELECT product_image FROM tbl_product_image_mapping WHERE product_id=pId LIMIT 1) AS pImg,
                                (SELECT user_name FROM tbl_user_master WHERE user_id=uId) AS uName,
                                (SELECT logmobile FROM tbl_user_master WHERE user_id=uId) AS uMob,
                                (SELECT email FROM tbl_user_master WHERE user_id=uId) AS uEmail,
                                (SELECT city FROM tbl_user_master WHERE user_id=uId) AS uCity,
                                (SELECT address FROM tbl_user_master WHERE user_id=uId) AS uAddr	
                              FROM
                                tbl_addtocart_master 
                              WHERE cart_id='".$ordId."'";
                
                $res = $this->query($sql);
                
                if($res){
                    
                    global $db;
                    require_once APICLUDE.'class.product.php';
                    $prodObj = new product($db['jzeva']);
                    
                    while ($row = $this->fetchData($res)){
                        
                        $arr['oId'] = $row['oId'];
                        $arr['pId'] = $row['pId'];
                        $arr['uId'] = $row['uId'];
                        $arr['qty'] = $row['qty'];
                        $arr['pNa'] = $row['pName'];
                        $arr['pSe'] = $row['pSeoName'];
                        $arr['pCost'] = $row['pCost'];
                        $arr['pImg'] = $row['pImg'];
                        $arr['uname'] = $row['uName'];
                        $arr['uMob'] = $row['uMob'];
                        $arr['uEm'] = $row['uEmail']; 
                        $arr['uCty'] = $row['uCity'];
                        $arr['uAddr'] = $row['uAddr'];
                        
                        $resp[] = $arr;
                        
                    }
                    
                    $error = array('err_code'=>0, 'err_msg'=>'Fetched Successfully');
                }else{
                    $error = array('err_code'=>1, 'err_msg'=>'Error Fetching Data');
                }
                
                
                $results = array('result'=>$resp, 'error'=>$error);
                return $results;
                
            }  catch (Exception $e){
                echo "Error In getProductByOrderId ".$e->getMessage();
            }
            
        }
        
       
        public function removeItemFromCart($params){
            
          //  $pid = (!empty($params['pid'])) ? trim($params['pid']) : '';
          //  $oid = (!empty($params['oid'])) ? trim($params['oid']) : '';
           // print($params['pid']);
            if(empty($params['pid']) || empty($params['col_car_qty'])){
                $resp = array();
                $error = array('err_code'=>1, 'err_msg'=>'Parameters Missing');
                $result = array('result'=>$resp, 'error'=>$error);
                return $result;
            }
            
            $sql = "UPDATE 
                            tbl_cart_master 
                          SET
                            active_flag = 2 
                          WHERE col_car_qty = '".$params['col_car_qty']."' 
                            AND product_id = '".$params['pid']."' AND cart_id = '".$params['cartid']."' AND size = '".$params['size']."'";
            
            $res = $this->query($sql);
            
            if($res){
                $error = array('err_code'=>0, 'err_msg'=>'Updated Successfully');
            }else{
                $error = array('err_code'=>1, 'err_msg'=>'Error In Updating' );
            }
            
            $results = array('result'=>$resp, 'error'=>$error);
            return $results;
            
        }
        
        public function updateOptVal($params){
            
            $pid = $params['pid'];
            $oid = $params['oid']; 
            $pqty = $params['qty'];
            
            //print_r($pid . ' ' .$oid . ' ' .$pqty );
            
            if(empty($pid) || empty($oid) || empty($pqty)){
                $resp = array();
                $error = array('err_code'=>1, 'err_msg'=>'parameters missing');
                $result = array('result'=>$resp, 'error'=>$error );
                return $result;
            }
            
            $sql = "UPDATE 
                        tbl_addtocart_master 
                      SET
                        pqty = '".$pqty."' 
                      WHERE product_id = '".$pid."' 
                        AND order_id = '".$oid."' ";
            
           $res = $this->query($sql);
            
           if($res){
               $error = array('err_code'=>0, 'err_msg'=>'Quantity Updated Successfully');
           }  else {
               $error = array('err_code'=>1, 'err_msg'=>'Error Updating Quantity');
           }
           
            $results = array('result'=>$resp, 'error'=>$error );
            return $results;
            
        }
        
        
        // CODE FOR CUSTOMER ADDRESS START
        public function userAddress($params){
            
            $delId = (!empty($params['deladdr_id'])) ? trim($params['deladdr_id']) : "";
            $fName = (!empty($params['fname'])) ? trim($params['fname']) : "";
            $lName = (!empty($params['lname'])) ? trim($params['lname']) : "";
            $email = (!empty($params['email'])) ? trim($params['email']) : "";
            $mobile = (!empty($params['mobile'])) ? trim($params['mobile']) : "";
            $pass = (!empty($params['password'])) ? trim($params['password']) : "";
            $cPass = (!empty($params['cpass'])) ? trim($params['cpass']) : "";
            $street = (!empty(urldecode($params['street']))) ? trim(urldecode($params['street'])) : "";
            $zipcode = (!empty($params['zipcode'])) ? trim($params['zipcode']) : "";
            $state = (!empty($params['state'])) ? trim($params['state']) : "";
            $country = (!empty($params['country'])) ? trim($params['country']) : "";
            $day = (!empty($params['day'])) ? trim($params['day']) : "";
            $month = (!empty($params['month'])) ? trim($params['month']) : "";
            $year = (!empty($params['year'])) ? trim($params['year']) : "";
            
            $dob = $day.'-'.$month.'-'.$year;
            
            $resp = array();
            
            if(empty($fName) || empty($lName) || empty($email) || empty($mobile) || empty($pass) || empty($cPass)){
                $error = array('err_code'=>1, 'err_msg'=>'Parameters Missing');
                $result = array('result'=>$resp, 'error'=>$error);
                return $result;
            }
            
            if(empty($delId)){
                $delId = $this->generateId();
            }
            
            $sql = "INSERT INTO tbl_deladdr_master (
                            deladdr_id,
                            fname,
                            lname,
                            email,
                            mobile,
                            pass,
                            cpass,
                            street,
                            zipcode,
                            state,
                            country,
                            dob,
                            created_on
                          ) 
                          VALUES (".$delId.", '".$fName."', '".$lName."', '".$email."', '".$mobile."',"
                    . "'".$pass."', '".$cPass."', '".$street."', '".$zipcode."', '".$state."', '".$country."', '".$dob."', NOW())";

            $res = $this->query($sql);
            
            if($res){
                $error = array('err_code'=>0, 'err_msg'=>'Delivery Address Added Successfully');
            }else{
                $error = array('err_code'=>1, 'err_msg'=>'Error Adding Delivery Address');
            }
            
            $results = array('result'=>$resp, 'error'=>$error);
            return $results;
            
        }

        // CODE FOR CUSTOMER ADDRESS ENDS
        
        public function getZipcode($params){
            
            $zipcd = (!empty($params['zipcd'])) ? trim($params['zipcd']) : "";
            
            if(empty($zipcd)){
                $resp= array();
                $error = array('err_code'=>1, 'err_msg'=>'Parameters Missing');
                $result = array('result'=>$resp, 'error'=>$error);
                return $result;
            }
            
            $sql = "SELECT 
                        id,
                        area,
                        pincode,
                        country,
                        state,
                        city,
                        dcity,
                        stdcode 
                      FROM
                        tbl_area_master 
                      WHERE pincode = '".$zipcd."' AND typeflag=1";
            
            $res = $this->query($sql);
            
            if($res){
                
                while ($row = $this->fetchData($res)){
                    
                    $arr['id'] = trim($row['id']!=NULL) ? $row['id'] : '' ;
                    $arr['area'] = trim($row['area']!=NULL) ? $row['area'] : '';
                    $arr['pincode'] = trim($row['pincode']!=NULL) ? $row['pincode'] : '';
                    $arr['country'] = trim($row['country']!=NULL) ? $row['country'] : '';
                    $arr['state'] = trim($row['state']!=NULL) ? $row['state'] : '';
                    $arr['city'] = trim($row['city']!=NULL) ? $row['city'] : '';
                    $arr['dcity'] = trim($row['dcity']!=NULL) ? $row['dcity'] : '';
                    $arr['stdcd'] = trim($row['stdcode']!=NULL) ? $row['stdcode'] : '';
                    $resp[] = $arr;
                    
                }
                $error = array('err_code'=>0, 'err_msg'=>'Data Fetched Successfully');
            }else{
                $error = array('err_code'=>1, 'err_msg'=>'Error In Fetching Data');
            }
            
            $results = array('result'=>$resp, 'error'=>$error);
            return $results;
            
        }
        
        //log in start
        
        public function login($params){
            
            $name = (!empty($params['name'])) ? trim($params['name']) : "";
            $pass = (!empty($params['pass'])) ? trim($params['pass']) : "";
            print_r($params);
             if(empty($name) || empty($pass)){
                $resp = array();
                $error = array('err_msg'=>0, 'err_code'=>'Parameters Missing');
                $result = array('result'=>$resp, 'error'=>$error);
                return $result;
            }
            
            $sql = "SELECT 
                        user_id AS user_id,
                        user_name,
                        logmobile,
                        email,
			(SELECT GROUP_CONCAT(cart_id) FROM tbl_cart_master WHERE userid =user_id) AS cart_id
                      FROM
                        tbl_user_master 
                      WHERE email='".$name."' 
                        AND PASSWORD='".md5($pass)."' AND is_active=1";
            
            $res = $this->query($sql);
           
            if($res){
                
                if($this->numRows($res)>0){
                    
                    //$fetLogDt = $this->fetchData($res);
                    while ($row = $this->fetchData($res)){
                        $arr['uid'] = ($row['user_id']!=NULL) ? $row['user_id'] : '';
                        $arr['uname'] = ($row['user_name']!=NULL) ? $row['user_id'] : '';
                        $arr['mob'] = ($row['logmobile']!=NULL) ? $row['logmobile'] : '';
                        $arr['email'] = ($row['email']!=NULL) ? $row['email'] : '';
			$arr['cart_id'] = ($row['cart_id']!=NULL) ? $row['cart_id'] : '';
                        $resp[] = $row;
                        $error = array('err_code'=>0, 'err_msg'=>'Login Details Fetched Successfully');
                    }
                    
                }else{
                     $resp = array('name'=>'', 'pass'=>'');
                     $error = array('err_code'=>1, 'err_msg'=>'Invalid Login Details');
                }
                
            }else{
                $resp = array('name'=>'', 'pass'=>'');
                $error = array('err_code'=>1, 'err_msg'=>'Invalid Login Details');
            }
            
            $results = array('result'=>$resp, 'error'=>$error);  
             return $results;
            
        }

        //log in ends
        
        // search start
        public function searchPrd($params){
            
            $search = (!empty($params['search'])) ? trim($params['search']) : "";
            
            if(empty($search)){
                $resp = array();
                $error = array('err_code'=>1, 'err_msg'=>'Parameters Missing');
                $result = array('result'=>$resp, 'error'=>$error);
                return $result;
            }
         
            $sql = "SELECT 
                        product_name 
                      FROM
                        tbl_product_master 
                      WHERE product_name LIKE '%$search%' LIMIT 4";
            
            $res = $this->query($sql);
            
            if($res){
                
                while ($row = $this->fetchData($res)){
                    $resp[] = $row;
                }
                
                $error = array('err_code'=>0, 'err_msg'=>'Search Details Fetched Successfully');
            }else{
                $error = array('err_code'=>1, 'err_msg'=>'Error Searching Data');
            }
            
            $results = array('result'=>$resp, 'error'=>$error);
            return $results;
            
        }


        //search ends

        private function generateId() 
        {
            $curdate = date('YmdHis');
            $rNo = mt_rand(11, 99);
            $genId = $rNo . $curdate;
            return $genId;
            
        }
         
	
	public function  getcartdetail($params)
	{
	  if($params['cart_id']=='null' && $params['userid']=='null'){
                $resp = array();
                $error = array('err_code'=>1, 'err_msg'=>'Parameters Missing');
                $result = array('result'=>$resp, 'error'=>$error);
                return $result;
            }
	  $cartidvar=(!empty($params['cart_id']))?trim($params['cart_id']):'';
	  $abh=!empty($params['userid'])?trim($params['userid']):'';   
	   $flag=0;
	    if (empty($params['cart_id']) || $params['cart_id']=='null')
	   {    $flg=1; 
		//print_r($flg);
	   } 
	   if (empty($params['userid']) || $params['userid']=='null')
	   {    $flg=2;
		//print_r($flg);
	   }
	    
	   
         $sql = "  SELECT  cart_id,product_id AS pid,userid,col_car_qty AS combine, pqty, price,size,created_on,updatedon,active_flag, "
              . "(SELECT  GROUP_CONCAT(dname) FROM tbl_metal_color_master WHERE id = SUBSTRING_INDEX(combine, '|@|',1) AND active_flag = 1 ) AS color,"
	    ."(SELECT  GROUP_CONCAT(dname) FROM tbl_metal_purity_master WHERE id = SUBSTRING_INDEX(SUBSTRING_INDEX(combine,'|@|',2),'|@|',-1) AND active_flag = 1 ) AS carat,"
             ."(SELECT  GROUP_CONCAT(dname) FROM tbl_diamond_quality_master WHERE id = SUBSTRING_INDEX(combine,'|@|',-1)  AND active_flag = 1 ) AS quality,"
            . "(SELECT  GROUP_CONCAT(product_name) FROM tbl_product_master WHERE productid = pid ) AS prdname,"
	    . "(SELECT  GROUP_CONCAT(product_image) FROM tbl_product_image_mapping WHERE product_id = pid  AND active_flag =1 ORDER BY
                            image_sequence DESC) AS prdimage,"
            . "(SELECT  GROUP_CONCAT(jewelleryType) FROM tbl_product_master WHERE productid = pid  AND active_flag !=2) 
                            AS jewelleryType,"
            . "(SELECT  GROUP_CONCAT(metal_weight) FROM tbl_product_master WHERE productid = pid  AND active_flag !=2) 
                            AS metal_weight,"
                     
            ." (SELECT GROUP_CONCAT(diamond_id) FROM tbl_product_diamond_mapping WHERE productid = pid AND active_flag = 1 ) AS allDimonds,
               (SELECT GROUP_CONCAT(carat) FROM tbl_product_diamond_mapping WHERE FIND_IN_SET(diamond_id,allDimonds)) AS dmdcarat,
               (SELECT GROUP_CONCAT(total_no) FROM tbl_product_diamond_mapping WHERE FIND_IN_SET(diamond_id,allDimonds)) AS totaldmd,
               (SELECT GROUP_CONCAT(shape) FROM tbl_product_diamond_mapping WHERE FIND_IN_SET(diamond_id,allDimonds)) AS shape,"
            ." (SELECT GROUP_CONCAT(gemstone_id) FROM tbl_product_gemstone_mapping WHERE productid = pid AND active_flag = 1 ) AS allGemstone,
               (SELECT GROUP_CONCAT(gemstone_name) FROM tbl_gemstone_master WHERE FIND_IN_SET(id,allGemstone)) AS gemstoneName,
               (SELECT GROUP_CONCAT(carat) FROM tbl_product_gemstone_mapping WHERE FIND_IN_SET(gemstone_id,allGemstone) AND productid =pid) AS gemscarat ,
               (SELECT GROUP_CONCAT(total_no) FROM tbl_product_gemstone_mapping WHERE FIND_IN_SET(gemstone_id,allGemstone) AND productid =pid) AS totalgems,
               (SELECT GROUP_CONCAT(price_per_carat) FROM tbl_product_gemstone_mapping WHERE FIND_IN_SET(gemstone_id,allGemstone) AND productid =pid) AS gemsPricepercarat,"
             ."(SELECT GROUP_CONCAT(solitaire_id) FROM tbl_product_solitaire_mapping WHERE productid = pid AND active_flag = 1 ) AS allSolitaire,
               (SELECT GROUP_CONCAT(no_of_solitaire) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS totalSolitaire,
               (SELECT GROUP_CONCAT(carat) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS Solicarat,
               (SELECT GROUP_CONCAT(price_per_carat) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS SoliPricepercarat,"
                            
             ."(SELECT GROUP_CONCAT(uncut_id) FROM tbl_product_uncut_mapping WHERE productid = pid AND active_flag = 1 ) AS allUncut,
               (SELECT GROUP_CONCAT(total_no) FROM tbl_product_uncut_mapping WHERE FIND_IN_SET(uncut_id,allUncut) AND productid =pid) AS totalUncut,
               (SELECT GROUP_CONCAT(carat) FROM tbl_product_uncut_mapping WHERE FIND_IN_SET(uncut_id,allUncut) AND productid =pid) AS Uncutcarat,
               (SELECT GROUP_CONCAT(price_per_carat) FROM tbl_product_uncut_mapping WHERE FIND_IN_SET(uncut_id,allUncut) AND productid =pid) AS UncutPricepercarat,
		(SELECT  GROUP_CONCAT(product_image) FROM tbl_product_image_mapping WHERE product_id = pid AND default_img_flag = 1 ) AS default_img,
      		(SELECT GROUP_CONCAT(catid) FROM tbl_category_product_mapping WHERE  productid =pid ) AS ccatid,
                (SELECT DISTINCT(NAME) FROM tbl_size_master WHERE  FIND_IN_SET(catid,ccatid) )AS ccatname";
	       
	       if($flg == 1){
		 $sql.= " FROM tbl_cart_master WHERE active_flag=1 AND userid='".$params['userid']."' order by created_on DESC";  
	       }
	       else if($flg==2){
		$sql.= " FROM tbl_cart_master WHERE active_flag=1 AND cart_id='".$params['cart_id']."' order by created_on DESC";  
	       } 
	       else{
		 $sql.=" FROM tbl_cart_master WHERE active_flag=1 AND (cart_id='".$params['cart_id']."' OR userid='".$params['userid']."') order by created_on DESC";
	       } 
	       
	       //  print_r($sql);
      $res = $this->query($sql);
            if ($res) {
		$totalprc=0;
                while ($row = $this->fetchData($res)) {
		    
                    $arr['cart_id'] = $row['cart_id'];
                    $arr['product_id'] = $row['pid'];
                    $arr['userid'] = $row['userid'];
		    $arr['col_car_qty'] = $row['combine'];
                    $arr['pqty'] = $row['pqty']; 
		    $arr['price'] = $row['price']; 
                    $arr['size'] = $row['size']; 
		    $arr['active_flag'] = $row['active_flag']; 
                    $arr['created_on'] = $row['created_on'];
		    $arr['updatedon'] = $row['updatedon'];
		    $arr['prdname'] = $row['prdname']; 
                     $arr['metal_weight'] = $row['metal_weight']; 
                    $arr['prdimage'] = $row['prdimage']; 
                    $arr['color'] = $row['color']; 
                    $arr['carat'] = $row['carat']; 
                    $arr['quality'] = $row['quality'];
                    $arr['jewelleryType'] = $row['jewelleryType'];
                      $arr['allDimonds'] = $row['allDimonds'];
                    $arr['dmdcarat'] = $row['dmdcarat'];
                     $arr['totaldmd'] = $row['totaldmd'];
                       $arr['shape'] = $row['shape'];
                             
                    $arr['allGemstone'] = $row['allGemstone'];
                    $arr['gemstoneName'] = $row['gemstoneName'];
                   
                    $arr['totalgems'] = $row['totalgems'];
                    $arr['gemscarat'] = $row['gemscarat'];
                    $arr['gemsPricepercarat'] = $row['gemsPricepercarat'];
                      
                    $arr['allSolitaire'] = $row['allSolitaire'];
                    $arr['totalSolitaire'] = $row['totalSolitaire'];
                    $arr['Solicarat'] = $row['Solicarat'];
                    $arr['SoliPricepercarat'] = $row['SoliPricepercarat'];
                    
                    $arr['allUncut'] = $row['allUncut'];
                    $arr['totalUncut'] = $row['totalUncut'];
                    $arr['Uncutcarat'] = $row['Uncutcarat'];
                    $arr['UncutPricepercarat'] = $row['UncutPricepercarat'];
                    $arr['default_img'] = $row['default_img'];
                    $arr['ccatname'] = $row['ccatname'];
                    $arr['ccatid'] = $row['ccatid'];
                     if($row['jewelleryType'] === '1'){
                             $arr['jewelleryType'] ='Gold';
                        }else  if($row['jewelleryType'] === '2'){
                             $arr['jewelleryType'] ='Plain Gold';
                        }else  if($row['jewelleryType'] === '3'){
                             $arr['jewelleryType'] ='Platinum';
                        }  
                    $totalprc+= $row['price'];  
                    $resArr[] = $arr;
                   
                } 
		$err=array('err_code'=>0,'err_msg'=>'Data fetched successfully');
            }
	    else
	    {
	      $err=array('err_code'=>1,'err_msg'=>'Error in fetching data');
	    }
            $results=array('result'=>$resArr,'error'=>$err,'totalprice'=>$totalprc);   
		    return $results; 
	}
	 
	public function updatecartdata($params)
	{
	  $flag=0;
	  if($params['cartid']==null || $params['cartid']==""){
	    $flag=1;
	  }
	  if($params['userid']==null || $params['userid']==""){
	    $flag=2;
	  }
	  if(empty($params['cartid']) && empty($params['userid'])){
                $resp = array();
                $error = array('err_code'=>1, 'err_msg'=>'Parameters Missing');
                $result = array('result'=>$resp, 'error'=>$error);
                return $result;
            }
	  $sql="UPDATE tbl_cart_master SET ";
	  if($flag==1){
	    $sql.="userid='".$params['userid']."' ";
	  }
	  else if($flag==2){
	    $sql.="cart_id='".$params['newcartid']."' ";
	  }
	  else{
	    $sql.="cart_id='".$params['newcartid']."', userid='".$params['userid']."'";
	  }
	  $sql.="  WHERE cart_id='".$params['cartid']."' AND active_flag=1 "; 
	  $res = $this->query($sql);
            
            if($res){
                $error = array('err_code'=>0, 'err_msg'=>'Updated Successfully');
            }else{
                $error = array('err_code'=>1, 'err_msg'=>'Error In Updating' );
            }
            
            $results = array('result'=>$resp, 'error'=>$error);   
            return $results;
	}
	
	 public function removCrtItemaftrcheckot($params)
	{    
            
            $sql = "UPDATE 
                            tbl_cart_master 
                          SET
                            active_flag = 2 
                          WHERE cart_id = ".$params['cartid']."
			    OR
				userid=".$params['userid']."";
			    
	     
            $res = $this->query($sql);
            
            if($res){
                $error = array('err_code'=>0, 'err_msg'=>'Updated Successfully');
            }else{
                $error = array('err_code'=>1, 'err_msg'=>'Error In Updating' );
            }
            
            $results = array('result'=>$resp, 'error'=>$error);
            return $results;
            
        } 
	 
         public function addtowishlist($params)
	{ 
	     $params = json_decode($params[0],1);
                          
	     if(empty($params['wish_id'])){
	       $wishid=  $this->generateId();
	     } 
	    if(empty($params['user_id']) ||  empty($params['pid'])){
                $resp = array();
                $error = array('err_code'=>1, 'err_msg'=>'Parameters Missing');
                $result = array('result'=>$resp, 'error'=>$error);
                return $result;
            }
	    
	    $wishchk="SELECT 
			     wish_id,
			     active_flag
		      FROM
			     tbl_wishlist_master
		      WHERE
			     user_id=".$params['user_id']."
		      AND
			     product_id=".$params['pid']."";
	    $wishckres=  $this->query($wishchk);
	    $wishcnt=  $this->numRows($wishckres);
	    
	    if($wishcnt > 0)
	    {
	      $wishchkrow=  $this->fetchData($wishckres); 
	      $existngid=$wishchkrow['wish_id']; 
	      $active=$wishchkrow['active_flag']; 
	      if($active == 0)
	      {
		  $updsql="UPDATE 
				 tbl_wishlist_master
			   SET
				col_car_qty='".$params['col_car_qty']."',
				price=".$params['price'].",
				size='".$params['size']."',
				active_flag=1,  
				updatedon=NOW()
			   WHERE
				wish_id=".$existngid."";
		  $res=  $this->query($updsql); 
	      }
	      else
	      {
		$resp = array();
		$error = array('err_code'=>2, 'err_msg'=>'This Product is Already in your wishlist');
		$result = array('result'=>$resp, 'error'=>$error);
		return $result;
	      }
	    }
	    else
	    {  
	      $sql = "INSERT INTO tbl_wishlist_master (
                                    wish_id,
                                    user_id,
                                    product_id, 
				    col_car_qty,
                                    price,
                                    size,
				    active_flag, 
                                    created_on,
				    updatedon
                                  ) 
                                  VALUES ";
	    
                      $sql .= " (".$wishid.", '".$params['user_id']."','".$params['pid']."','".$params['col_car_qty']."','".$params['price'].""
			    . "','".$params['size']."',1,NOW(), NOW())";
                                   
   
	 	      $sql.="
                    ON DUPLICATE KEY UPDATE
                                user_id = VALUES(user_id),product_id = VALUES(product_id),col_car_qty=VALUES(col_car_qty),
				updatedon=VALUES(updatedon)";
		       
	      $res = $this->query($sql); 
	    }
            $resp = array();
             
            if($res){
                $error = array('err_code'=>0, 'err_msg'=>'Add To Wishlist Successfully');
            }else{
                $error = array('err_code'=>1, 'err_msg'=>'Error Inserting Wishlist Data');
            }
            
            $result = array('result'=>$resp, 'error'=>$error);
            return $result;
	  
        }
        
        public function  getwishdetail($params)
	{
	  if(empty($params['userid']) || $params['userid']== 'null'){
                $resp = array();
                $error = array('err_code'=>1, 'err_msg'=>'Parameters Missing');
                $result = array('result'=>$resp, 'error'=>$error);
                return $result;
            }
	  
	   
         $sql = "  SELECT  wish_id,user_id,product_id AS pid,col_car_qty AS combine,price,size,active_flag,created_on,updatedon, "
            . "(SELECT  GROUP_CONCAT(dname) FROM tbl_metal_color_master WHERE id = SUBSTRING_INDEX(combine, '|@|',1) AND active_flag = 1 ) AS color,"
	    ."(SELECT  GROUP_CONCAT(dname) FROM tbl_metal_purity_master WHERE id = SUBSTRING_INDEX(SUBSTRING_INDEX(combine,'|@|',2),'|@|',-1) AND active_flag = 1 ) AS carat,"
            ."(SELECT  GROUP_CONCAT(dname) FROM tbl_diamond_quality_master WHERE id = SUBSTRING_INDEX(combine,'|@|',-1)  AND active_flag = 1 ) AS quality,"
            . "(SELECT  GROUP_CONCAT(product_name) FROM tbl_product_master WHERE productid = pid AND active_flag = 1 ) AS prdname,"
            . "(SELECT  GROUP_CONCAT(jewelleryType) FROM tbl_product_master WHERE productid = pid AND active_flag = 1 ) AS jweltype,"
            . "(SELECT  GROUP_CONCAT(has_diamond) FROM tbl_product_master WHERE productid = pid AND active_flag = 1 ) AS hasdmd,"
            . "(SELECT  GROUP_CONCAT(has_solitaire) FROM tbl_product_master WHERE productid = pid AND active_flag = 1 ) AS hasSoli,"
            . "(SELECT  GROUP_CONCAT(has_uncut) FROM tbl_product_master WHERE productid = pid AND active_flag = 1 ) AS hasUncut,"
            . "(SELECT  GROUP_CONCAT(has_gemstone) FROM tbl_product_master WHERE productid = pid AND active_flag = 1 ) AS hasGems,"
            ."(SELECT GROUP_CONCAT(gemstone_id) FROM tbl_product_gemstone_mapping WHERE productid = pid AND active_flag = 1 ) AS allGemstone,"
            ."(SELECT GROUP_CONCAT(gemstone_name) FROM tbl_gemstone_master WHERE FIND_IN_SET(id,allGemstone)) AS gemstoneName,"
	    . "(SELECT  GROUP_CONCAT(product_image) FROM tbl_product_image_mapping WHERE product_id = pid  AND active_flag !=2 ORDER BY
                            image_sequence DESC) AS prdimage, 
		(SELECT GROUP_CONCAT(product_image) FROM tbl_product_image_mapping WHERE product_id = pid AND active_flag =1 AND  default_img_flag=1) AS default_image ";
            
            
	        
		 $sql.=" FROM tbl_wishlist_master WHERE active_flag=1 AND user_id='".$params['userid']."'";
	   
      $res = $this->query($sql);
            if ($res) {
                while ($row = $this->fetchData($res)) {
		    
                    $arr['wish_id'] = $row['wish_id'];
                    $arr['product_id'] = $row['pid'];
                    $arr['user_id'] = $row['user_id'];
		    $arr['col_car_qty'] = $row['combine']; 
                    $arr['price'] = $row['price'];
		    $arr['active_flag'] = $row['active_flag']; 
                    $arr['created_on'] = $row['created_on'];
		    $arr['updatedon'] = $row['updatedon'];
		    $arr['prdname'] = $row['prdname']; 
                    $arr['prdimage'] = $row['prdimage']; 
                    $arr['color'] = $row['color']; 
                    $arr['carat'] = $row['carat']; 
                    $arr['quality'] = $row['quality'];
                    $arr['size'] = $row['size'];
                    $arr['hasdmd'] = $row['hasdmd'];
                    $arr['hasSoli'] = $row['hasSoli'];
                    $arr['hasUncut'] = $row['hasUncut'];
                    $arr['hasGems'] = $row['hasGems'];
                     $arr['allGemstone'] = $row['allGemstone'];
                      $arr['gemstoneName'] = $row['gemstoneName'];
                    $arr['jweltype'] = $row['jweltype'];
                    $arr['default_image'] = $row['default_image'];
		      
                   if($row['jweltype'] === '1'){
                             $arr['jweltype'] ='Gold';
                        }else  if($row['jweltype'] === '2'){
                             $arr['jweltype'] ='Plain Gold';
                        }else  if($row['jweltype'] === '3'){
                             $arr['jweltype'] ='Platinum';
                        }  
                        
                    if($row['hasdmd'] === '1'){
                             $arr['hasdmd'] ='Diamond';
                        }else  if($row['hasdmd'] === '0'){
                             $arr['hasdmd'] ='';
                        }
                    if($row['hasSoli'] === '1'){
                             $arr['hasSoli'] ='Solitaire';
                        }else  if($row['hasSoli'] === '0'){
                             $arr['hasSoli'] ='';
                        }
                    if($row['hasGems'] === '1'){
                             $arr['hasGems'] ='Gemstone';
                        }else  if($row['hasGems'] === '0'){
                             $arr['hasGems'] ='';
                        }
                    if($row['hasUncut'] === '1'){
                             $arr['hasUncut'] ='Uncut';
                        }else  if($row['hasUncut'] === '0'){
                             $arr['hasUncut'] ='';
                        }
                        
                    $resArr[] = $arr;
                        }  
                        
                   $err=array('err_code'=>0,'err_msg'=>'Data fetched successfully');
                }  
	    else
	    {
	      $err=array('err_code'=>1,'err_msg'=>'Error in fetching data');
	    }
            $results=array('result'=>$resArr,'error'=>$err);   
		    return $results; 
	}
	
         
      
  
	  public function checkpassw($params){
             
            $pass = (!empty($params['pass'])) ? trim($params['pass']) : "";
            // print_r($params);
             if(empty($pass)){
                $resp = array();
                $error = array('err_msg'=>0, 'err_code'=>'Parameters Missing');
                $result = array('result'=>$resp, 'error'=>$error);
                return $result;
            }
            
            $sql = "SELECT  
		      user_id,user_name,logmobile,email,
		      (SELECT DISTINCT(cart_id) FROM tbl_cart_master WHERE userid =user_id AND active_flag=1) AS cart_id,
			 password
                      FROM
                        tbl_user_master 
                      WHERE logmobile='".$params['mob']."' ";
                     
            
            $res = $this->query($sql);
           $resp=array();
            if($res){
                
                if($this->numRows($res)>0){
                    
                    //$fetLogDt = $this->fetchData($res);
                    while ($row = $this->fetchData($res)){ 
			$arr['password'] = ($row['password']!=NULL) ? $row['password'] : '';
                         if(md5($pass) == $arr['password'])
			 {
			    $arr['uid'] = ($row['user_id']!=NULL) ? $row['user_id'] : '';
			    $arr['uname'] = ($row['user_name']!=NULL) ? $row['user_name'] : '';
			    $arr['mob'] = ($row['logmobile']!=NULL) ? $row['logmobile'] : '';
			    $arr['email'] = ($row['email']!=NULL) ? $row['email'] : '';
			    $arr['cart_id'] = ($row['cart_id']!=NULL) ? $row['cart_id'] : '';
			    $resp =$arr; 	  
			    $error = array('err_code'=>0, 'err_msg'=>'Password is correct');
			 }
			 else
			 $error = array('err_code'=>1, 'err_msg'=>'Invalid Password');  
                    }
                    
                } 
            }
	    else{ 
                $error = array('err_code'=>2, 'err_msg'=>'Error in fetching data');
            }
            
            $results = array('result'=>$resp, 'error'=>$error);  
             return $results;
            
        }
        
        
        public function removeItmFrmWishlist($params){
             
            if(empty($params['wish_id']) || empty($params['col_car_qty'])){
                $resp = array();
                $error = array('err_code'=>1, 'err_msg'=>'Parameters Missing');
                $result = array('result'=>$resp, 'error'=>$error);
                return $result;
            }
            
            $sql = "UPDATE 
                            tbl_wishlist_master 
                          SET
                            active_flag = 0 
                          WHERE col_car_qty = '".$params['col_car_qty']."' 
                            AND product_id = '".$params['pid']."' AND wish_id = '".$params['wish_id']."' AND size = '".$params['size']."'";
            
            $res = $this->query($sql);
            
            if($res){
                $error = array('err_code'=>0, 'err_msg'=>'Updated Successfully');
            }else{
                $error = array('err_code'=>1, 'err_msg'=>'Error In Updating' );
            }
            
            $results = array('result'=>$resp, 'error'=>$error);
            return $results;
            
        }
    }
     
    ?>