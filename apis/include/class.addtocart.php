<?php

    include_once APICLUDE . 'common/db.class.php';
    
    class addtocart extends DB{
        
        function __construct($db) {
            parent::DB($db);
        }
        
        public function addToCart($params)
	{ 
	    $params = json_decode($params[0],1);
            
	    if(empty($params['pid']) || empty($params['cartid']) || empty($params['col_car_qty'])){
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
				    active_flag, 
                                    created_on,
				    updatedon
                                  ) 
                                  VALUES ";
	    
                      $sql .= " (".$params['cartid'].", '".$params['pid']."','".$params['userid']."','".$params['col_car_qty']."','".$params['qty']."','"
			    . $params['price']."',1,NOW(), NOW())";
                                        
     
	 	      $sql.="
                    ON DUPLICATE KEY UPDATE
                                pqty = VALUES(pqty),price = VALUES(price),active_flag=VALUES(active_flag),
				created_on=VALUES(created_on),updatedon=VALUES(updatedon)";
		        
	     $res = $this->query($sql); 
            $resp = array();
             
            if($res){
                $error = array('err_msg'=>0, 'err_code'=>'Add To Cart Data Inserted Successfully');
            }else{
                $error = array('err_msg'=>1, 'err_code'=>'Error Inserting Add To Cart Data');
            }
            
            $result = array('result'=>$resp, 'error'=>$error);
            return $result;
	  
        }
	    

  public function getcartdetail()
  {
      
       $sql = "  SELECT  cart_id,product_id AS pid,userid,col_car_qty AS combine, pqty, price,created_on,updatedon,active_flag, "
              . "(SELECT  GROUP_CONCAT(dname) FROM tbl_metal_color_master WHERE id = SUBSTRING_INDEX(combine, '|@|',1) AND active_flag = 1 ) AS color,"
	    ."(SELECT  GROUP_CONCAT(dname) FROM tbl_metal_purity_master WHERE id = SUBSTRING_INDEX(SUBSTRING_INDEX(combine,'|@|',2),'|@|',-1) AND active_flag = 1 ) AS carat,"
             ."(SELECT  GROUP_CONCAT(dname) FROM tbl_diamond_quality_master WHERE id = SUBSTRING_INDEX(combine,'|@|',-1)  AND active_flag = 1 ) AS quality,"
            . "(SELECT  GROUP_CONCAT(product_name) FROM tbl_product_master WHERE productid = pid AND active_flag = 1 ) AS prdname,"
	    . "(SELECT  GROUP_CONCAT(product_image) FROM tbl_product_image_mapping WHERE product_id = pid  AND active_flag !=2 ORDER BY
                            image_sequence DESC) AS prdimage"
            . " FROM tbl_cart_master WHERE active_flag=1 order by updatedon DESC";
       
   
      $res = $this->query($sql);
            if ($res) {
                while ($row = $this->fetchData($res)) {
		    
                    $arr['cart_id'] = $row['cart_id'];
                    $arr['product_id'] = $row['pid'];
                    $arr['userid'] = $row['userid'];
		    $arr['col_car_qty'] = $row['combine'];
                    $arr['pqty'] = $row['pqty']; 
		    $arr['price'] = $row['price']; 
		    $arr['active_flag'] = $row['active_flag']; 
                    $arr['created_on'] = $row['created_on'];
		    $arr['updatedon'] = $row['updatedon'];
		    $arr['prdname'] = $row['prdname']; 
                    $arr['prdimage'] = $row['prdimage']; 
                    $arr['color'] = $row['color']; 
                    $arr['carat'] = $row['carat']; 
                    $arr['quality'] = $row['quality']; 
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
        
        // CODE FOR REMOVE CART ENDS
        //(!empty($params['deladdr_id'])) ? trim($params['deladdr_id']) : "";
        
        public function removeItemFromCart($params){
            
          //  $pid = (!empty($params['pid'])) ? trim($params['pid']) : '';
          //  $oid = (!empty($params['oid'])) ? trim($params['oid']) : '';
           // print($params['pid']);
            if(empty($params['pid']) || empty($params['col_car_qty']) ||  empty($params['cartid'])){
                $resp = array();
                $error = array('err_code'=>1, 'err_msg'=>'Parameters Missing');
                $result = array('result'=>$resp, 'error'=>$error);
                return $result;
            }
            
            $sql = "UPDATE 
                            tbl_cart_master 
                          SET
                            active_flag = 2 
                          WHERE col_car_qty = '".$params['col_car_qty']."' AND
                             product_id = '".$params['pid']."' AND cart_id = '".$params['cartid']."' ";
            
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
            
            if(empty($name) || empty($pass)){
                $resp = array();
                $error = array('err_msg'=>0, 'err_code'=>'Parameters Missing');
                $result = array('result'=>$resp, 'error'=>$error);
                return $result;
            }
            
            $sql = "SELECT 
                        user_id,
                        user_name,
                        logmobile,
                        email
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
        
    }
    
   
?>