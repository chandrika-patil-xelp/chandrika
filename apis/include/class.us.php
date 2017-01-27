
<?php

    include_once APICLUDE . 'common/db.class.php';

    class us extends DB{

        function __construct($db) {
            parent::DB($db);
        }

        public function addUsers($params){

            $userid = (!empty($params['userid'])) ? trim($params['userid']) : '';
            $name = (!empty($params['name'])) ? trim($params['name']) : '';
            $pass = (!empty($params['pass'])) ? trim($params['pass']) : '';
            $mob = (!empty($params['mobile'])) ? trim($params['mobile']) : '';
            $email = (!empty($params['email'])) ? trim($params['email']) : '';
            $city = (!empty($params['city'])) ? trim($params['city']) : '';
            $addr = (!empty($params['addr'])) ? trim($params['addr']) : '';
            $is_ven = (!empty($params['isven'])) ? trim($params['isven']) : '';
            $subsc = (!empty($params['subsc'])) ? trim($params['subsc']) : '';
            $isact = (!empty($params['isactive'])) ? trim($params['isactive']) : '';
            $passflag = (!empty($params['pass_flag'])) ? trim($params['pass_flag']) : '';
            $gender = (!empty($params['gender'])) ? trim($params['gender']) : '';
                 echo $gender;

            if(empty($userid)){
                $userid = $this->generateId();
            }

            $resp = array();

            if(empty($name) || empty($pass) || empty($mob) || empty($email) || empty($city) ){

                $error = array('err_code'=>1, 'err_msg' =>' Parameters Missing ');
                $result = array('result'=>$resp, 'error'=>$error );
                return $result;

            }

            //$datetime = str_replace(" ", "-", $params['date_time']);

            $sql = "INSERT INTO tbl_user_master (
                            user_id,
                            user_name,
                            PASSWORD,
                            logmobile,
                            email,
                            city,
                            address,
                            is_vendor,
                            date_time,
                            update_time,
                            updated_by,
                            subscribe,
                            is_active,
                            pass_flag,
                            gender
                          )
                          VALUES (".$userid.", '".urldecode($name)."', '".urldecode(md5($pass))."', '".$mob."', '".urldecode($email)."', '".urldecode($city)."',"
                                . "'".urldecode($addr)."', '".$is_ven."', NOW(), NOW(), '".$userid."', '".$subsc."',"
                                . "'".$isact."', '".$passflag."', '".$gender."' ) "
                    . "ON DUPLICATE KEY UPDATE "
                    . "username = ".urldecode($name).","
                    . "logmobile = ".$mob.","
                    . "email = ".$email.","
                    . "city = ".urldecode($city).","
                    . "updated_by = ".$userid." ";


           $res = $this->query($sql);

           if($res){

               $error = array('err_code'=>0, 'err_msg'=>' Users Addedd Successfully ' );

           }else{
               $error = array('err_code'=>1, 'err_msg'=>' Error in adding User ' );
           }

           $results = array('result'=>$resp, 'error'=>$error );
           return $results;

        }

        /** get user details by id start **/
        public function getUserDetailsById($params){

            if(!empty($params['userid'])){

                        $sql = "SELECT
                                    user_id,
                                    user_name,
                                    password,
                                    logmobile,
                                    email,
                                    city,
                                    address,
                                    is_vendor,
                                    date_time,
                                    update_time,
                                    updated_by,
                                    subscribe,
                                    is_active,
                                    pass_flag,
                                    gender
                                  FROM
                                    tbl_user_master
                                  WHERE user_id = ".$params['userid']."
                                 ";


                        $res = $this->query($sql);

                        if($res){

                            while ($row = $this->fetchData($res)){

                                $reslt['uid'] = trim($row['user_id']!=NULL) ? $row['user_id'] : '' ;
                                $reslt['uname'] = trim($row['user_name']!=NULL) ? $row['user_name'] : '' ;
                                $reslt['pw'] = trim($row['email']!=NULL) ? $row['password'] : '' ;
                                $reslt['mob'] = trim($row['logmobile']!=NULL) ? $row['logmobile'] : '' ;
                                $reslt['email'] = trim($row['email']!=NULL) ? $row['email'] : '' ;
                                $reslt['city'] = trim($row['city']!=NULL) ? $row['city'] : '' ;
                                $reslt['addr'] = trim(mb_convert_encoding($row['address'], 'UTF-8')!=NULL) ? mb_convert_encoding($row['address'], 'UTF-8') : '' ;
                                $reslt['isVen'] = trim($row['is_vendor']) ? $row['is_vendor'] : '' ;
                                $reslt['gender'] = trim($row['gender']) ? $row['gender'] : '' ;
                                $resp[] = $reslt;
                                $error = array('err_code'=>0, 'err_msg'=>' User Details By Id Fetched Successfully ' );
                            }
                        }else{
                            $error = array('err_code'=>1, 'err_msg'=>' Error In Fetching User Details By Id ' );
                        }

                        $result = array('result'=>$resp, 'error'=>$error );
                        return $result;

            }else{

                    $resp = array();
                    $error = array('err_code'=>1, 'err_msg'=>' Parameters Missing ' );
                    $result = array('result'=>$resp, 'error'=>$error );
                    return $result;
                }

            }

        /** get user details by id start **/

        /** get user list start **/
        public function getUserLists(){

            $sql = "SELECT
                        user_id AS uid,
                        user_name AS name,
                        logmobile AS mob,
                        email AS em,
                        address AS addr,
                        (SELECT COUNT(order_id) FROM tbl_order_master WHERE user_id=uid AND order_status < 6) AS openOrd,
                        (SELECT COUNT(order_id) FROM tbl_order_master WHERE user_id=uid AND order_status = 6) AS pastOrd
                        FROM tbl_user_master ";

            $res = $this->query($sql);

            if($res){

                while ($row = $this->fetchData($res)){

                    $reslt['uid'] = trim($row['uid']!=NULL) ? $row['uid'] : '';
                    $reslt['name'] = trim($row['name']!=NULL) ? $row['name'] : '';
                    $reslt['mob'] = trim($row['mob']!=NULL) ? $row['mob'] : '';
                    $reslt['email'] = trim($row['em']!=NULL) ? $row['em'] : '';
                    $reslt['address'] = mb_convert_encoding($row['addr'], "UTF-8");
                    $reslt['openOrd'] = trim($row['openOrd']!=NULL) ? $row['openOrd'] : '';
                    $reslt['pastOrd'] = trim($row['pastOrd']!=NULL) ? $row['pastOrd'] : '';
                    $resp[] = $reslt;

                }

                $error = array('err_code'=>0, 'err_msg'=>' User List Fetched Successfully ' );

            }else{
                $error = array('err_code'=>1, 'err_msg'=>' Error Fetching User List ' );
            }

            $result = array('result'=>$resp, 'error'=>$error );
            return $result;

        }

                /** get user list ends **/

        /** add orders start **/

        public function addOrdersdetail($params)
	{
            global $comm, $db;
             $params= (json_decode($params[0],1));


	    $updby="user";

            $sql = "INSERT INTO tbl_order_master (
                            order_id,
                            product_id,
                            user_id,
                  	    shipping_id,
                            col_car_qty,
                            size,
                             pqty,
                             price,
                            order_date,
                            delivery_date,
                            order_status,
                            createdon,
                            updatedon,
                            updatedby,
                            payment,
                            payment_type
                          )
                          VALUES ";


	     foreach($params['data'] as $kye=> $val){

            $leaddtsql="SELECT leadTime FROM tbl_product_master WHERE productid=".$val['pid']." AND active_flag=1";
            $ldtres=$this->query($leaddtsql);
            $leaddt=$this->fetchData($ldtres);
            $deldate=date('Y-m-d H:i:s', strtotime("+".$leaddt['leadTime']." days"));
	          $sql.="(".$val['orderid'].", '".$val['pid']."', '".$val['userid']."', '".$val['shipping_id']."','".$val['col_car_qty']."','".$val['size']."','".$val['pqty']."','".$val['prodpri']."',NOW(),'".$deldate."',";

	          $sql.= " 0, NOW(), NOW(), '".$updby."',"
                    . "'".$val['payment']."', '".$val['payment_type']."' ),";
	     }
	      $sql = trim($sql, ",");

        $sql.="ON DUPLICATE KEY UPDATE user_id = VALUES(user_id),pqty = VALUES(pqty),price = VALUES(price),"
	 	           . "order_date = VALUES(order_date),delivery_date = VALUES(delivery_date),order_status = VALUES(order_status),"
	 	            . "createdon = VALUES(createdon),updatedon = VALUES(updatedon),updatedby = VALUES(updatedby),payment = VALUES(payment),payment_type = VALUES(payment_type)";

	          $resord = $this->query($sql);
        
	if($resord)
	{
	  $invoiceid=$this->generateId();
	  $invcsql="INSERT INTO 
				tbl_invoice_master (
				invoice_id,
				order_id,
				user_id,
				createdon,
				updatedon )
		    VALUES(";
	  $invcsql.="
		    ".$invoiceid.",
		    ".$params['data'][0]['orderid'].",
		    ".$params['data'][0]['userid'].",
		    NOW(),
		    NOW() )
		    ON DUPLICATE KEY UPDATE 
		    order_id=	VALUES(order_id),
		    user_id=	VALUES(user_id),
		    createdon=	VALUES(createdon),
		    updatedon=	VALUES(updatedon) ";
	  $res=  $this->query($invcsql);
	  
	  if($res)
	  {
	      
	    $smssql="SELECT
			   product_id AS pid,
			   shipping_id AS shipid,
			   (SELECT name FROM tbl_order_shipping_details WHERE shipping_id=shipid)AS shipname,
			   (SELECT mobile FROM tbl_order_shipping_details WHERE shipping_id=shipid)AS mobile,
			   (SELECT gender FROM tbl_order_shipping_details WHERE shipping_id=shipid)AS gender,
			   (SELECT email FROM tbl_order_shipping_details WHERE shipping_id=shipid)AS email,
			   (SELECT product_name FROM tbl_product_master WHERE productid=pid)AS prd_name
		     FROM
			  tbl_order_master
		     WHERE
			  order_id=".$params['data'][0]['orderid'];

	    $smsres=  $this->query($smssql);
	    if($smsres){
	      while($smsrow = $this->fetchData($smsres)){
		  $email = $smsrow['email'];
		  $gender = $smsrow['gender'];
		  $usrname=$smsrow['shipname'];
		  $prdnamarr[]=$smsrow['prd_name'];
		  $mobile=$smsrow['mobile'];
	      }
	    }
	    $prdname=implode(', ',$prdnamarr);

	   

	    $gndr="";
	    if($gender == 1)
	      $gndr="Ms";
	    else if($gender == 2)
	      $gndr="Mr";
	    else if($gender == 3)
	      $gndr="Mrs";
	    else
	      $gndr="Dear";
	    global $comm;
	    $txt = ''.$gndr.' '.$usrname.' your Jzeva jewellery '.$prdname.' with order number '.$params['data'][0]['orderid'].' has been received. Thank you for shopping with Jzeva.com';
	    
	    $url = str_replace('_MOBILE', $mobile, SMSAPI);
	    $url = str_replace('_MESSAGE', urlencode($txt), $url);
	    $smsurlres = $comm->executeCurl($url, true);
	    
	    $mobvndone=9007297981;
	    $vndrtxt = 'Hi, We got one new order placed  for Product name '.$prdname.' with order number '.$params['data'][0]['orderid'].'.';
	    $vndroneurl = str_replace('_MOBILE', $mobvndone, SMSAPI);
	    $vndroneurl = str_replace('_MESSAGE', urlencode($vndrtxt), $vndroneurl);
	    $smsurlvndres = $comm->executeCurl($vndroneurl, true);
	    
	    $mobvndtwo=7022248707;
	    $vndrtxttwo = 'Hi, We got one new order placed  for Product name '.$prdname.' with order number '.$params['data'][0]['orderid'].'.';
	    $vndrtwourl = str_replace('_MOBILE', $mobvndtwo, SMSAPI);
	    $vndrtwourl = str_replace('_MESSAGE', urlencode($vndrtxttwo), $vndrtwourl);
	    $smsurlvndrres = $comm->executeCurl($vndrtwourl, true);
	    
            include APICLUDE.'class.emailtemplate.php';
            $obj	= new emailtemplate($db['jzeva']);
            $message	=$obj->genordrtemplate($params);

	    $subject  = "JZEVA Order Detail";
            $headers  = "Content-type:text/html;charset=UTF-8" . "<br/><br/>";
            $headers .= 'From: care@jzeva.com' . "<br/><br/>";


	    mail($email, $subject, $message, $headers);
 
            $error = array('err_code'=>0, 'err_msg'=>' Adding Order Details Inserted Successfully ' );
	  }
	  else
	  {
                $error = array('err_code'=>1, 'err_msg'=>' Error IN Adding Order Details ' );
          }
	}
	
            $resp = array();
            if($res){

                $error = array('err_code'=>0, 'err_msg'=>' Adding Order Details Inserted Successfully ' );

            }else{
                $error = array('err_code'=>1, 'err_msg'=>' Error IN Adding Order Details ' );
            }

            $result = array('result'=>$resp, 'error'=>$error);
            return $result;

        }

        /** add orders ends **/

        public function addOrderbackend($params)
	{
            global $comm;
             $params= (json_decode($params[0],1));
              $orderid = (!empty($params['orderid'])) ? trim($params['orderid']) : '';
	   if(empty($params['orderid'])){
	      $orderid=  $this->generateId();
	    }
            $ordstatus="";
	    $updby="user";

            $sql = "INSERT INTO tbl_order_master (
                            order_id,
                            product_id,
                            user_id,
			    shipping_id,
			    col_car_qty,
			    size,
			    pqty,
			    price,
                            order_date,
                            delivery_date,
                            order_status,
                            createdon,
                            updatedon,
                            updatedby,
                            payment,
                            payment_type
                          )
                          VALUES ";

	    $sql .= " (".$orderid.", '".$params['pid']."','".$params['userid']."','".$params['shipping_id']."','".$params['col_car_qty'].""
			    . "','".$params['size']."','".$params['pqty']."','".$params['prodpri']."',NOW(), NOW(),";
               $sql.= " '".$ordstatus."', NOW(), NOW(), '".$updby."',"
                    . "'".$params['payment']."', '".$params['payment_type']."' ),";
       $sql = trim($sql, ",");

                   $sql.="ON DUPLICATE KEY UPDATE user_id = VALUES(user_id),pqty = VALUES(pqty),price = VALUES(price),"
	 	    . "order_date = VALUES(order_date),delivery_date = VALUES(delivery_date),order_status = VALUES(order_status),"
	 	    . "createdon = VALUES(createdon),updatedon = VALUES(updatedon),updatedby = VALUES(updatedby),payment = VALUES(payment),payment_type = VALUES(payment_type)";


	    $res = $this->query($sql);
            $resp = array();
            if($res){

                $error = array('err_code'=>0, 'err_msg'=>' Adding Order Details Inserted Successfully ' );

            }else{
                $error = array('err_code'=>1, 'err_msg'=>' Error IN Adding Order Details ' );
            }

            $result = array('result'=>$resp, 'error'=>$error,'ordid'=>$orderid);
            return $result;

        }


        /** GET ORDER DETAILS BY ORDER ID START **/
        public function getOrderDetailsByOrdIds($params){
            global $comm;
            if($params['orderid']){

                $sql = "SELECT
                            order_id AS oid,
                            product_id AS pid,
                            user_id AS uid,
                            shipping_id AS shpId,
                            col_car_qty AS combine,
                            size,
                            pqty,
                            price,

                            (SELECT product_name FROM tbl_product_master WHERE productid = pid) AS pname,
                            (SELECT metal_weight FROM tbl_product_master WHERE productid = pid) AS pwgt,

                            (SELECT user_name FROM tbl_user_master WHERE user_id=uid) AS uname,
                            (SELECT logmobile FROM tbl_user_master WHERE user_id=uid) AS mobile,
                            (SELECT email FROM tbl_user_master WHERE user_id=uid) AS email,
                            (SELECT GROUP_CONCAT(shipping_id) FROM tbl_order_shipping_details WHERE shipping_id = shpId) AS shipngDet,

 (SELECT GROUP_CONCAT(city) FROM tbl_order_shipping_details WHERE FIND_IN_SET(shipping_id,shipngDet)) AS customerCity,
 (SELECT GROUP_CONCAT(state) FROM tbl_order_shipping_details WHERE FIND_IN_SET(shipping_id,shipngDet)) AS customerState,
 (SELECT GROUP_CONCAT(pincode) FROM tbl_order_shipping_details WHERE FIND_IN_SET(shipping_id,shipngDet)) AS customerPincode,
 (SELECT GROUP_CONCAT(address) FROM tbl_order_shipping_details WHERE FIND_IN_SET(shipping_id,shipngDet)) AS customerAddrs,

(SELECT GROUP_CONCAT(catid) FROM tbl_category_product_mapping WHERE  productid =pid ) AS ccatid,
(SELECT DISTINCT(NAME) FROM tbl_size_master WHERE  FIND_IN_SET(catid,ccatid) )AS ccatname,
(SELECT  GROUP_CONCAT(making_charges) FROM tbl_product_master WHERE productid = pid AND active_flag !=2 ) AS mkngchrg,
(SELECT GROUP_CONCAT(diamond_id) FROM tbl_product_diamond_mapping WHERE productid = pid AND active_flag = 1 ) AS allDimonds,
(SELECT GROUP_CONCAT(carat) FROM tbl_product_diamond_mapping WHERE FIND_IN_SET(diamond_id,allDimonds)) AS dmdcarat,

(SELECT  GROUP_CONCAT(dname) FROM tbl_metal_color_master WHERE id = SUBSTRING_INDEX(combine, '|@|',1) AND active_flag !=2 ) AS color,
(SELECT  GROUP_CONCAT(dname) FROM tbl_metal_purity_master WHERE id = SUBSTRING_INDEX(SUBSTRING_INDEX(combine,'|@|',2),'|@|',-1) AND active_flag !=2 ) AS Metalcarat,
(SELECT  GROUP_CONCAT(dname) FROM tbl_diamond_quality_master WHERE id = SUBSTRING_INDEX(combine,'|@|',-1)  AND active_flag !=2 ) AS quality,
(SELECT  GROUP_CONCAT(product_image) FROM tbl_product_image_mapping WHERE product_id = pid  AND active_flag !=2) AS prdimage,
(SELECT GROUP_CONCAT(product_image) FROM tbl_product_image_mapping WHERE product_id = pid AND active_flag = 1 AND  default_img_flag=1) AS default_image,
(SELECT gender FROM tbl_user_master WHERE user_id = uid AND is_active = 1) AS usrgender,

                            order_date AS orddt,
                            delivery_date AS deldt,
                            order_status AS ordsta,
                            active_flag AS actflg,

                            payment AS pay
                            FROM tbl_order_master WHERE order_id = ".$params['orderid']." ";

                $res = $this->query($sql);

                if($res){
		  $totalprice=0;
                 while ($row = $this->fetchData($res)){

                    $reslt['oid'] = ($row['oid']!=NULL) ? $row['oid'] : '';
                    $reslt['pid'] = ($row['pid']!=NULL) ? $row['pid'] : '';
                    $reslt['uid'] = ($row['uid']!=NULL) ? $row['uid'] : '';
                    $reslt['pname'] = ($row['pname']!=NULL) ? $row['pname'] : '';
                    $reslt['uname'] = ($row['uname']!=NULL) ? $row['uname'] : '';
                    $reslt['mobile'] = ($row['mobile']!=NULL) ? $row['mobile'] : '';
                    $reslt['email'] = ($row['email']!=NULL) ? $row['email'] : '';
                    $reslt['orddt'] = $comm->makeDate($row['orddt']);
                    $reslt['deldt'] = $comm->makeDate($row['deldt']);
                    $reslt['actflg'] = ($row['actflg']!=NULL) ? $row['actflg'] : '';
                    $reslt['ppri'] = ($row['price']!=NULL) ? $row['price'] : '';
                    $reslt['size'] = ($row['size']!=NULL) ? $row['size'] : '';
                    $reslt['pqty'] = ($row['pqty']!=NULL) ? $row['pqty'] : '';
                    $reslt['pay'] = ($row['pay']!=NULL) ? $row['pay'] : '';
                    $reslt['ucity'] = ($row['customerCity']!=NULL) ? $row['customerCity'] : '';
                    $reslt['ustate'] = ($row['customerState']!=NULL) ? $row['customerState'] : '';
                    $reslt['upin'] = ($row['customerPincode']!=NULL) ? $row['customerPincode'] : '';
                    $reslt['uaddres'] = ($row['customerAddrs']!=NULL) ? $row['customerAddrs'] : '';
                     $reslt['oclr'] = ($row['color']!=NULL) ? $row['color'] : '';
                    $reslt['ocarat'] = ($row['Metalcarat']!=NULL) ? $row['Metalcarat'] : '';
                    $reslt['oqual'] = ($row['quality']!=NULL) ? $row['quality'] : '';
                    $reslt['oimg'] = ($row['prdimage']!=NULL) ? $row['prdimage'] : '';
                     $reslt['odefimg'] = ($row['default_image']!=NULL) ? $row['default_image'] : '';
                     $reslt['pwgt'] = ($row['pwgt']!=NULL) ? $row['pwgt'] : '';
                     $reslt['ccatid'] = ($row['ccatid']!=NULL) ? $row['ccatid'] : '';
                     $reslt['ccatname'] = ($row['ccatname']!=NULL) ? $row['ccatname'] : '';
                     $reslt['mkngchrg'] = ($row['mkngchrg']!=NULL) ? $row['mkngchrg'] : '';
                     $reslt['allDimonds'] = ($row['allDimonds']!=NULL) ? $row['allDimonds'] : '';
                     $reslt['dmdcarat'] = ($row['dmdcarat']!=NULL) ? $row['dmdcarat'] : '';
		     $reslt['gender'] = ($row['usrgender']!=NULL) ? $row['usrgender'] : '';
                    $resp[] = $reslt;
		    $totalprice+=($row['price'] != NULL) ?$row['price']:'';
                 }
                    $error = array('err_code'=>0, 'err_msg'=>' getOrderDetailsByOrdId fetched successfully ' );

                }else{
                    $error = array('err_code'=>1, 'err_msg'=>' Error In Fetching getOrderDetailsByOrdId ' );
                }

            }else{
               $error = array('err_code'=>1, 'err_msg'=>' Error In Fecthing Data ' );
            }

            $result = array('result'=>$resp, 'error'=>$error,'totalprice'=>$totalprice );
            return $result;

        }

        /** GET ORDER DETAILS BY ORDER ID ENDS **/

        /** GET PRODUCT DETAILS BY PRODUCT ID START **/
     function getOrderDetailsByUserId($params)
    {
//        if(empty($params['userid'])){
//            $resp = array();
//            $error = array('err_code'=>1, 'err_msg'=>'Parameters Missing');
//            $result = array('result'=>$resp, 'error'=>$error);
//            return $result;
//        }
             $sqlcount = "  SELECT
                                    count(product_id) AS  cnt,
                                    sum(price) AS prc
                                            FROM
                                     tbl_order_master
                                         WHERE
                                      order_id=".$params['order_id']." AND
                                      active_flag =1 ";
            $rescnt= $this->query($sqlcount);
            $row = $this->fetchData($rescnt);
            $total= $row['cnt'];
            $totprice = $row['prc'];

         global $comm;



                $sql = "SELECT
                            order_id AS oid,
                            product_id AS pid,
                            user_id AS uid,
                            shipping_id AS shpId,
                            col_car_qty AS combine,
                            size,
                            pqty,
                            price,
                            order_date,
                            updatedon,
                            order_status,
                            active_flag,
                            product_price,
                            payment,
                            payment_type,

                            (SELECT product_seo_name FROM tbl_product_master WHERE productid=pid) AS prdSeoname,
(SELECT  GROUP_CONCAT(product_image) FROM tbl_product_image_mapping WHERE product_id = pid  AND active_flag !=2) AS prdimage,
(SELECT  GROUP_CONCAT(product_name) FROM tbl_product_master WHERE productid = pid AND active_flag !=2 ) AS prdname,
(SELECT  GROUP_CONCAT(product_code) FROM tbl_product_master WHERE productid = pid AND active_flag !=2 ) AS product_code,

(SELECT  GROUP_CONCAT(carat) FROM tbl_product_diamond_mapping WHERE productid = pid AND active_flag !=2 ) AS dmdcarat,
(SELECT GROUP_CONCAT(solitaire_id) FROM tbl_product_solitaire_mapping WHERE productid = pid AND active_flag = 1 ) AS allSolitaire,
(SELECT GROUP_CONCAT(no_of_solitaire) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS totalSolitaire,
(SELECT GROUP_CONCAT(carat) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS Solicarat,
(SELECT GROUP_CONCAT(clarity) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS Soliclarity,

(SELECT  GROUP_CONCAT(dname) FROM tbl_metal_color_master WHERE id = SUBSTRING_INDEX(combine, '|@|',1) AND active_flag !=2 ) AS color,
(SELECT  GROUP_CONCAT(dname) FROM tbl_metal_purity_master WHERE id = SUBSTRING_INDEX(SUBSTRING_INDEX(combine,'|@|',2),'|@|',-1) AND active_flag !=2 ) AS Metalcarat,
(SELECT  GROUP_CONCAT(dname) FROM tbl_diamond_quality_master WHERE id = SUBSTRING_INDEX(combine,'|@|',-1)  AND active_flag !=2 ) AS quality,



(SELECT  GROUP_CONCAT(metal_weight) FROM tbl_product_master WHERE productid = pid  AND active_flag !=2)
                            AS metal_weight,
(SELECT  GROUP_CONCAT(jewelleryType) FROM tbl_product_master WHERE productid = pid  AND active_flag !=2)
                            AS jewelleryType,

(SELECT GROUP_CONCAT(catid) FROM tbl_category_product_mapping WHERE  productid =pid ) AS ccatid,
                (SELECT DISTINCT(NAME) FROM tbl_size_master WHERE  FIND_IN_SET(catid,ccatid) )AS ccatname,


 (SELECT GROUP_CONCAT(shipping_id) FROM tbl_order_shipping_details WHERE shipping_id = shpId) AS shipngDet,
 (SELECT GROUP_CONCAT(name) FROM tbl_order_shipping_details WHERE FIND_IN_SET(shipping_id,shipngDet)) AS customername,
 (SELECT GROUP_CONCAT(mobile) FROM tbl_order_shipping_details WHERE FIND_IN_SET(shipping_id,shipngDet)) AS customerMob,
 (SELECT GROUP_CONCAT(city) FROM tbl_order_shipping_details WHERE FIND_IN_SET(shipping_id,shipngDet)) AS customerCity,
 (SELECT GROUP_CONCAT(state) FROM tbl_order_shipping_details WHERE FIND_IN_SET(shipping_id,shipngDet)) AS customerState,
 (SELECT GROUP_CONCAT(pincode) FROM tbl_order_shipping_details WHERE FIND_IN_SET(shipping_id,shipngDet)) AS customerPincode,
 (SELECT GROUP_CONCAT(address) FROM tbl_order_shipping_details WHERE FIND_IN_SET(shipping_id,shipngDet)) AS customerAddrs,
 (SELECT GROUP_CONCAT(gender) FROM tbl_order_shipping_details WHERE shipping_id = shpId) AS gender,
 (SELECT GROUP_CONCAT(product_image) FROM tbl_product_image_mapping WHERE product_id = pid AND active_flag = 1 AND  default_img_flag=1) AS default_image

 FROM tbl_order_master WHERE order_id= ".$params['order_id']." AND active_flag = 1 ";


                $res = $this->query($sql);

                if($res){

                     while ($row = $this->fetchData($res)){

                     $reslt['oid'] = ($row['oid']!=null) ? $row['oid'] : '';
                     $reslt['pid'] = ($row['pid']!=NULL) ? $row['pid'] : '';
                     $reslt['uid'] = ($row['uid']!=NULL) ? $row['uid'] : '';
                     $reslt['prdSeoname'] = ($row['prdSeoname']!=NULL) ? $row['prdSeoname'] : '';
                     $reslt['shipping_id'] = ($row['shipping_id']!=NULL) ? $row['shipping_id'] : '';
                     $reslt['col_car_qty'] = ($row['col_car_qty']!=NULL) ? $row['col_car_qty'] : '';
                     $reslt['size'] = ($row['size']!=NULL) ? $row['size'] : '';
                     $reslt['color'] = ($row['color']!=NULL) ? $row['color'] : '';
                     $reslt['Metalcarat'] = ($row['Metalcarat']!=NULL) ? $row['Metalcarat'] : '';
                      $reslt['quality'] = ($row['quality']!=NULL) ? $row['quality'] : '';
                     $reslt['pqty'] = ($row['pqty']!=NULL) ? $row['pqty'] : '';
                     $reslt['price'] = ($row['price']!=NULL) ? $row['price'] : '';
                     $reslt['cartid'] = ($row['cartid']!=NULL) ? $row['cartid'] : '';

                     $reslt['order_date'] = ($row['order_date']);
                     $reslt['updatedon'] = ($row['updatedon']);
                     $reslt['order_status'] = ($row['order_status']!=NULL) ? $row['order_status'] : '';
                     $reslt['active_flag'] = ($row['active_flag']!=NULL) ? $row['active_flag'] : '';
                     $reslt['product_price'] = ($row['product_price']!=NULL) ? $row['product_price'] : '';
                     $reslt['payment'] = ($row['payment']!=NULL) ? $row['payment'] : '';
                      $reslt['payment_type'] = ($row['payment_type']!=NULL) ? $row['payment_type'] : '';
                      $reslt['prdimage'] = ($row['prdimage']!=NULL) ? $row['prdimage'] : '';
                       $reslt['prdname'] = ($row['prdname']!=NULL) ? $row['prdname'] : '';
                       $reslt['product_code'] = ($row['product_code']!=NULL) ? $row['product_code'] : '';

                       $reslt['shipngDet'] = ($row['shipngDet']!=NULL) ? $row['shipngDet'] : '';
                      $reslt['customername'] = ($row['prdimage']!=NULL) ? $row['customername'] : '';
                       $reslt['customerMob'] = ($row['prdname']!=NULL) ? $row['customerMob'] : '';
                       $reslt['customerCity'] = ($row['product_code']!=NULL) ? $row['customerCity'] : '';
                       $reslt['customerState'] = ($row['shipngDet']!=NULL) ? $row['customerState'] : '';
                      $reslt['customerPincode'] = ($row['prdimage']!=NULL) ? $row['customerPincode'] : '';
                       $reslt['customerAddrs'] = ($row['prdname']!=NULL) ? $row['customerAddrs'] : '';
                      $reslt['default_image'] = $row['default_image'];
                       $reslt['dmdcarat'] = $row['dmdcarat'];
                       $reslt['Solicarat'] = $row['Solicarat'];
                       $reslt['Soliclarity'] = $row['Soliclarity'];
                       $reslt['metal_weight'] = $row['metal_weight'];
                       $reslt['ccatid'] = $row['ccatid'];
                       $reslt['ccatname'] = $row['ccatname'];
                        $reslt['jewelleryType'] = $row['jewelleryType'];
                        $reslt['prc'] = $row['prc'];
                         $reslt['cnt'] = $row['cnt'];
                         $reslt['gender'] = $row['gender'];


                          if($row['jewelleryType'] === '1'){
                             $reslt['jewelType'] ='Gold';
                        }else  if($row['jewelleryType'] === '2'){
                             $reslt['jewelType'] ='Plain Gold';
                        }else  if($row['jewelleryType'] === '3'){
                             $reslt['jewelType'] ='Platinum';
                        }

                       if($row['payment_type']== '0'){
                           $reslt['payment_type'] ='Credit Card';
                       }else if($row['payment_type']== '1'){
                           $reslt['payment_type'] ='Debit Card';
                       }else if($row['payment_type']== '2'){
                           $reslt['payment_type'] ='Net Banking';
                       }else if($row['payment_type']== '3'){
                           $reslt['payment_type'] ='EMI';
                       }
                       else if($row['payment_type']== '4'){
                           $reslt['payment_type'] ='COD';
                       }
                       $reslt['cnt']=$total;
                        $reslt['total']=$totprice;
                     $resp[] = $reslt;



                     }
                   // $error = array('err_code'=>0, 'err_msg'=>' Fetched Data Successfully ');

                }else{
                  //  $error = array('err_code'=>1, 'err_msg'=>' Error Fetching Data ');
                }

         //  $resl= array('result'=>$resp, 'error'=>$error);
            return $resp;

    }




        /** GET ALL USER DETAILS START **/
        public function getAllUDetail($params){

            if($params['userid']){

                $user = $this->getUserDetailsById($params);
                $orders = $this->getOrderDetailsByUserId($params);

                $error = array('err_code'=>0, 'err_msg'=>' Data Fetched Successfully ');

            }else{
                $error = array('err_code'=>1, 'err_msg'=>' Parameters Missing ' );
            }

            $result = array('users'=>$user['result'], 'orders'=>$orders['result'], 'error'=>$error );
            return $result;

        }

        /** GET ALL USER DETAILS ENDS **/

        /** GET ORDER LIST START **/
        public function getOrderList(){

            $sql = "SELECT order_id AS oid FROM tbl_order_master ";
            $res = $this->query($sql);

            if($res){

                while ($row = $this->fetchData($res)){
                    $oid = array('orderid'=>$row['oid']);
                    $resp[] = $this->getOrderDetailsByOrdIds($oid);
                }

                foreach ($resp as $key => $val ){
                    $result[] = $val['result'];
                }

                $error = array('err_code'=>0, 'err_msg'=>' Fetched Data Successfully ' );

            }else{
               $error = array('err_code'=>1, 'err_msg'=>' Error In Fetching Data ' );
            }

            $results = array('users'=>$result, 'error'=>$error);
            return $results;

        }

        /** GET ORDER LIST ENDS **/

        /** CHANGE ORDER STATUS START **/

        public function chngOrdStatus($params){

            $params = json_decode($params[0],1);
            $orderid = (!empty($params['orderid'])) ? trim($params['orderid']) : '';
            $userid = (!empty($params['userid'])) ? trim($params['userid']) : '';
            $ostatus = (!empty($params['ostatus'])) ? trim($params['ostatus']) : '';

            if(empty($orderid) || empty($userid) || empty($ostatus)){
                $resp = array();
                $error = array('err_code'=>1, 'err_msg'=>' Parameters Missing ');
                $result = array('result'=>$resp, 'error'=>$error );
                return $result;
            }else{

                $sql = "UPDATE tbl_order_master SET order_status = ".$params['ostatus']." WHERE order_id = ".$params['orderid']." AND user_id = ".$params['userid']." ";
                $res = $this->query($sql);
                $resp = array();
                if($res){
                    $error = array('err_code'=>0, 'err_msg'=>' Order Status Updated Successfully ');
                }else{
                    $error = array('err_code'=>1, 'err_msg'=>' Error In Updating Order Status ');
                }

                $result = array('result'=>$resp, 'error'=>$error );
                return $result;

            }

        }

        /** CHANGE ORDER STATUS ENDS **/

        /** code for forgot password start **/
//        public function forgotPass($params){
//
//            $isNew = TRUE;
//            $mob = $params['mob'];
//
//            if(empty($mob)){
//                $resp = array();
//                $error = array('err_code'=>1, 'err_msg'=>'Parameters Missing');
//                $result = array('result'=>$resp, 'error'=>$error);
//                return $result;
//            }
//
//            $sql = "SELECT code FROM tbl_verification_master WHERE mobile='".$mob."' AND DATE_SUB('updated_on', INTERVAL - 5 MINUTE) > NOW() LIMIT 1";
//
//            $res = $this->query($sql);
//
//            $veriCode = "";
//
//            if($res){
//                $row = $this->fetchData($res);
//                if(!empty($row) && !empty($row['code'])){
//                    $veriCode = $row['code'];
//                    $isNew = FALSE;
//                }
//            }
//
//            if($isNew){
//                $veriCode = mt_rand(1111, 9999);
//            }
//
//            if($veriCode){
//
//                $sqlOtp = "INSERT INTO tbl_verification_master (
//                                    mobile,
//                                    CODE,
//                                    created_on,
//                                    updated_on
//                                  )
//                                  VALUES ('".$mob."', '".$veriCode."', NOW(), NOW())";
//
//                $sqlOtpRes = $this->query($sqlOtp);
//
//                if($sqlOtpRes){
//
//                    global $comm;
//
//                    $smsUrl = str_replace('_MESSAGE', $veriCode, SMSAPI);
//                    $smsUrl = str_replace('_MOBILE', $mob, $smsUrl);
//                    $resp = $comm->executeCurl($smsUrl);
//
//                    if($resp)
//                    {
//                        if(stristr($resp['status'], 'ok'))
//                        {
//                                $error = array('errCode' => 0, 'errMsg' => 'Verification code sent successfully');
//                        }
//                        else
//                        {
//                                $error = array('errCode' => 1, 'errMsg' => 'API for sending verification code failed');
//                        }
//                    }
//                    else
//                    {
//                            $error = array('errCode' => 1, 'errMsg' => 'Error calling API for sending verification code');
//                    }
//
//                }else{
//                    $error = array('err_code'=>1, 'err_msg'=>'Otp Not Saved in DB');
//                }
//
//            }else{
//                $error = array('err_code'=>1, 'err_msg'=>'OTP Not Sent');
//            }
//
//            $results = array('result'=>$resp, 'error'=>$error);
//            return $results;
//
//        }


        public function forgotPass($params){

            $mob = $params['mob'];

            if(empty($mob)){
                $resp = array();
                $error = array('err_code'=>1, 'err_msg'=>'Parameters Missing');
                $result = array('result'=>$resp, 'error'=>$resp);
                return $result;
            }

            $sql = "SELECT logmobile FROM tbl_user_master WHERE logmobile='".$mob."'";
            $res = $this->query($sql);
            $row = $this->fetchData($res);
            $numRows = $this->numRows($res);

            if($numRows > 0){

                    global $comm;

                    $pass = mt_rand(111111, 999999);

                    $smsUrl = str_replace('_MESSAGE', $pass, SMSAPI);
                    $smsUrl = str_replace('_MOBILE', $mob, $smsUrl);
                    $resp = $comm->executeCurl($smsUrl);

                    if($resp){

                        $optSql = "INSERT INTO tbl_verification_master (mobile, code, created_on) VALUES ('".$mob."', '".$pass."', NOW())";
                        $optRes = $this->query($optSql);

                        if($optRes){
                            $error = array('err_code'=>0, 'err_msg'=>'Otp Sent And Saved In DB');
                        }else{
                            $error = array('err_code'=>1, 'err_msg'=>'Error Sending OTP and saving in DB');
                        }

                        $error = array('err_code'=>0, 'err_msg'=>'Otp Sent Successfully');

                    }else{
                        $error = array('err_code'=>1, 'err_msg'=>'Error Sending OTP');
                    }


//                $pass = mt_rand(11111, 99999);
//
//                $optSql = "INSERT INTO tbl_verification_master (mobile, code, created_on) VALUES ('".$mob."', '".$pass."', NOW())";
//                $optRes = $this->query($optSql);
//
//                if($optRes){
//
//                    $smsUrl = str_replace('_MESSAGE', $pass, SMSAPI);
//                    $smsUrl = str_replace('_MOBILE', $mob, $smsUrl);
//                    $resp = $comm->executeCurl($smsUrl);
//
//                    if($resp){
//                        $error = array('error'=>0, 'err_msg'=>'OTP Sent Successfully');
//                    }else{
//                         $error = array('err_code'=>1, 'err_msg'=>'Error In Sending OTP');
//                    }
//
//                }else{
//                    $error = array('err_code'=>1, 'err_msg'=>'Error In Sending OTP');
//                }

                $error = array('err_code'=>0, 'err_msg'=>'mobile number found');
            }else{
                $error = array('err_code'=>0, 'err_msg'=>'mobile number not found');
            }

            $results = array('result'=>$resp, 'error'=>$error);
            return $results;

        }

        /** code for forgot password ends **/

        /** code for sign up start **/
    public function signUp($params){

        //print_r($params);
        $userId = (!empty($params['uid'])) ? trim($params['uid']) : '';
        $name = (!empty($params['name'])) ? trim($params['name']) : '';
        $city = (!empty($params['city'])) ? trim($params['city']) : '';
        $mob = (!empty($params['mob'])) ? trim($params['mob']) : '';
        $email = (!empty($params['email'])) ? trim($params['email']) : '';
        $pass = (!empty($params['pass'])) ? trim($params['pass']) : '';
        //$cPass = (!empty($params['cpass'])) ? trim($params['cpass']) : '';

        if(empty($name) || empty($city) || empty($mob) || empty($email) || empty($pass)){
            $resp = array();
            $error = array('err_code'=>1, 'err_msg'=>'Parameters Missing');
            $result = array('result'=>$resp, 'error'=>$error);
            return $result;
        }

        if(empty($userId)){
            $userId = $this->generateId();
        }

        $sql = "INSERT INTO tbl_user_master (
                        user_id,
                        user_name,
                        city,
                        logmobile,
                        email,
                        PASSWORD
                      )
                      VALUES (".$userId.", '".$name."', '".$city."', '".$mob."', '".$email."', '".md5($pass)."')";

        $res = $this->query($sql);

        if($res){
            $error = array('err_code'=>0, 'err_msg'=>'Inserted Successfully');
        }else{
            $error = array('err_code'=>1, 'err_msg'=>'Error Inserting Data');
        }

        $results = array('result'=>$resp, 'error'=>$error);
        return $results;

    }


     function getAllOrderDetails($params)
    {


         global $comm;


          $sql = "  SELECT DISTINCT(order_id )
                                            FROM
                                     tbl_order_master
                                         WHERE
                                         user_id=".$params['userid']." AND
                                      active_flag =1 ORDER BY createdon DESC";

           $page = ($params['page'] ? $params['page'] : 1);
        $limit = ($params['limit'] ? $params['limit'] : 10000);

        if ($limit > 1) {
            $limit = 10000;
        }
        //$limit = 100;
        if (!empty($page)) {
            $start = ($page * $limit) - $limit;
            $sql.=" LIMIT " . $start . ",$limit";
        }
            $res = $this->query($sql);

                if($res){

                     while ($row = $this->fetchData($res)){
                            $ordids=array('order_id'=>$row['order_id']);
                            $resl[]=  $this->getOrderDetailsByUserId($ordids);

                     }

                     $error = array('err_code'=>0, 'err_msg'=>' Fetched Data Successfully ');
                }

                else{
                    $error = array('err_code'=>1, 'err_msg'=>' Error Fetching Data ');
                }

            $result = array('result'=>$resl, 'error'=>$error);
            return $result;

    }

             /** code for sign up ends **/
 
    private function generateId(){

           $dTime = round(microtime(true) * 1000); 
		    $rNum = mt_rand(1, 9);
		    $genrd = $rNum.$dTime;
		    return $genrd; 
                }



  }

?>
