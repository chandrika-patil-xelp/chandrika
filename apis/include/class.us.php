
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
                                  WHERE user_id = ".$params['userid']." ";
                        
                        $res = $this->query($sql);
                        
                        if($res){
                            
                            while ($row = $this->fetchData($res)){
                                
                                $reslt['uid'] = trim($row['user_id']!=NULL) ? $row['user_id'] : '' ;
                                $reslt['uname'] = trim($row['user_name']!=NULL) ? $row['user_name'] : '' ;
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
            global $comm; 
            $params= (json_decode($params[0],1));
	    
            $ordstatus="";
	    $updby="user"; 
	    
            $sql = "INSERT INTO tbl_order_master (
                            order_id,
                            product_id,
                            user_id,
			    col_car_qty,
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
	     
	    $sql.="(".$val['orderid'].", '".$val['pid']."', '".$val['userid']."', '".$val['col_car_qty']."','".$val['pqty']."','".$val['prodpri']."',NOW(),";  
	     if($val['diloptn']==1){
	      $sql.="ADDDATE(now(), INTERVAL 7 DAY),";
	    }
	    else if($val['diloptn']==2){
	      $sql.="ADDDATE(now(), INTERVAL 2 DAY),";
	    }
	    else if($val['diloptn']==3){
	      $sql.="ADDDATE(now(), INTERVAL 5 HOUR),";
	    }
	     $sql.= " '".$ordstatus."', NOW(), NOW(), '".$updby."',"
                    . "'".$val['payment']."', '".$val['payment_type']."' ),"; 
	    }
	    $sql = trim($sql, ","); 
            $sql.="ON DUPLICATE KEY UPDATE user_id = VALUES(user_id),user_id = VALUES(user_id),pqty = VALUES(pqty),price = VALUES(price),"
		    . "order_date = VALUES(order_date),delivery_date = VALUES(delivery_date),order_status = VALUES(order_status),"
		    . "createdon = VALUES(createdon),updatedon = VALUES(updatedon),updatedby = VALUES(updatedby),payment = VALUES(payment),payment_type = VALUES(payment_type)";
             $res = $this->query($sql);
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
        
        /** GET ORDER DETAILS BY ORDER ID START **/
        public function getOrderDetailsByOrdIds($params){
            global $comm;
            if($params['orderid']){
                
                $sql = "SELECT 
                            order_id AS oid,
                            product_id AS pid,
                            user_id AS uid,
                            (SELECT product_seo_name FROM tbl_product_master WHERE productid = pid) AS pname ,
                            (SELECT user_name FROM tbl_user_master WHERE user_id=uid) AS uname,
                            (SELECT logmobile FROM tbl_user_master WHERE user_id=uid) AS mobile,
                            (SELECT email FROM tbl_user_master WHERE user_id=uid) AS email,
                            order_date AS orddt,
                            delivery_date AS deldt,
                            order_status AS ordsta,
                            active_flag AS actflg,
                            product_price AS pprice,
                            payment AS pay
                            FROM tbl_order_master WHERE order_id = ".$params['orderid']." ";
                
                $res = $this->query($sql);
                
                if($res){
                    
                    $row = $this->fetchData($res);
                    
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
                    $reslt['ppri'] = ($row['pprice']!=NULL) ? $row['pprice'] : '';
                    $reslt['pay'] = ($row['pay']!=NULL) ? $row['pay'] : '';
                    
                    //$resp[] = $reslt;
                    
                    $error = array('err_code'=>0, 'err_msg'=>' getOrderDetailsByOrdId fetched successfully ' );
                    
                }else{
                    $error = array('err_code'=>1, 'err_msg'=>' Error In Fetching getOrderDetailsByOrdId ' );
                }
               
            }else{
               $error = array('err_code'=>1, 'err_msg'=>' Error In Fecthing Data ' );
            }
             
            $result = array('result'=>$reslt, 'error'=>$error );
            return $result;
            
        }

        /** GET ORDER DETAILS BY ORDER ID ENDS **/
        
        /** GET PRODUCT DETAILS BY PRODUCT ID START **/
        
        public function getOrderDetailsByUserId($params){
            global $comm;
            if($params['userid']){
           
                $sql = "SELECT 
                            order_id AS oid,
                            product_id AS pid,
                            user_id AS uid,
                            (SELECT product_seo_name FROM tbl_product_master WHERE productid=pid) AS pname,
                            (SELECT user_name FROM tbl_user_master WHERE user_id=uid) AS uname,
                            (SELECT logmobile FROM tbl_user_master WHERE user_id=uid) AS mobile,
                            (SELECT email FROM tbl_user_master WHERE user_id=uid) AS email,
                            order_date AS orddate,
                            delivery_date AS deldate,
                            order_status AS ordsta,
                            active_flag AS actflg,
                            product_price AS pprice,
                            payment AS pay
                            FROM tbl_order_master WHERE user_id= ".$params['userid']." ";
                
                $res = $this->query($sql);
                
                if($res){
                    
                     $row = $this->fetchData($res);
                    
                     $reslt['oid'] = ($row['oid']!=null) ? $row['oid'] : '';
                     $reslt['pid'] = ($row['pid']!=NULL) ? $row['pid'] : '';
                     $reslt['uid'] = ($row['uid']!=NULL) ? $row['uid'] : '';
                     $reslt['pname'] = ($row['pname']!=NULL) ? $row['pname'] : '';
                     $reslt['uname'] = ($row['uname']!=NULL) ? $row['uname'] : '';
                     $reslt['mobile'] = ($row['mobile']!=NULL) ? $row['mobile'] : '';
                     $reslt['email'] = ($row['email']!=NULL) ? $row['email'] : '';
                     $reslt['odate'] = $comm->makeDate($row['orddate']);
                     $reslt['ddate'] = $comm->makeDate($row['deldate']);
                     $reslt['ordsta'] = ($row['ordsta']!=NULL) ? $row['ordsta'] : '';
                     $reslt['actflg'] = ($row['actflg']!=NULL) ? $row['actflg'] : '';
                     $reslt['pprice'] = ($row['pprice']!=NULL) ? $row['pprice'] : '';
                     $reslt['pay'] = ($row['pay']!=NULL) ? $row['pay'] : '';
                     
                     $resp[] = $reslt;
                     
                     $error = array('err_code'=>0, 'err_msg'=>' Fetched Data Successfully ');
                    
                }else{
                    $error = array('err_code'=>1, 'err_msg'=>' Error Fetching Data ');
                }
                
            }else{
                $error = array('err_code'=>1, 'err_msg'=>' Parameters Missing ' );
            }
            
            $result = array('result'=>$resp, 'error'=>$error );
            return $result;
            
        }
        
        /** GET PRODUCT DETAILS BY PRODUCT ID ENDS **/
        
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
                $res = $this->query($sql, 1); 
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

        /** code for sign up ends **/
        
        private function generateId(){
            
            $dt = date("YmdHis");
            $rd = mt_rand(11, 99);
            $genrd = $rd.$dt;
            return $genrd;
            
        }
        
        
    }

?>