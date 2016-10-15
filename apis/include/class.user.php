<?php
    include_once APICLUDE . 'common/db.class.php';

    class user extends DB {

        function __construct($db) {
            parent::DB($db);
        }
        
        
        public function addUser($params)
        {
         
            global $comm;
           // $params= (json_decode($params[0],1));
           
            #$params=array('userid'=>'9320160321210137','name'=>'Shubham Gupta','pass'=>'123456','mobile'=>'8767194606','email'=>'shubham@xelpmoc.in','city'=>'Mumbai');
            //$params=array('name'=>'Ankur Gala','pass'=>'123456','mobile'=>'1234567899','email'=>'ankurgala@xelpmoc.in','city'=>'Mumbai','address'=>'#657, 5th A Cross, 17th E Main Road,Koramangala 6th Block,Bangalore – 560095','gender'=>1);
          //$params=array('name'=>'','pass'=>'','mobile'=>'','email'=>'','city'=>'','address'=>'','gender'=>1);
            
        //echo "<pre>";print_r($params); echo "<pre>";print_r(json_encode($params));  die;
             
            
            
            $name = (!empty($params['name'])) ? trim($params['name']) : '';
            $mobile = (!empty($params['mobile'])) ? trim($params['mobile']) : '';
            $pass = (!empty($params['pass'])) ? trim($params['pass']) : '';
          // $cpass = (!empty($params['cpass'])) ? trim($params['cpass']) : '';
            $email = (!empty($params['email'])) ? trim($params['email']) : '';
            $isvendor =(!empty($params['isvendor'])) ? trim($params['isvendor']) : '';
            $city=(!empty($params['city'])) ? trim($params['city']) : '';
            
            if((empty($name)) || (empty($mobile)) || (empty($email)) || (empty($pass)) )
            {
                $resp = array();
                $error = array('errCode' => 1, 'errMsg' => 'Parameter Missing');
                $result = array('results' => $resp, 'error' => $error);
                return $result;
            }
             $emlsql="select email from tbl_user_master where email='".$email."'";
	    $eres = $this->query($emlsql); 
            $row = $this->fetchData($eres);
            $cnt1 = $this->numRows($eres);  
	     if ($cnt1 > 0)
            {
	        $resp = array();
                $error = array('err_code' => 1, 'err_msg' => 'email id already exist');
                $result = array('results' => $resp, 'error' => $error);
                return $result;
	    }
	    //changes
	    $mobsql="select logmobile from tbl_user_master where logmobile='".$mobile."'";
	    $lres = $this->query($mobsql); 
            $lrow = $this->fetchData($lres);
            $cnt1 = $this->numRows($lres);  
	     if ($cnt1 > 0)
            {
	        $resp = array();
                $error = array('err_code' => 1, 'err_msg' => 'mobile number already exist');
                $result = array('results' => $resp, 'error' => $error);
                return $result;
	    }
           /*  if($cpass != $pass){
                $error = array('err_code'=>1, 'err_msg'=>'password and confirm password doesnt match');
                $result = array('result'=>$resp, 'error'=>$error);
                return $result;
            }
            */
            if(!$params['userid'])
            {
                $userid=$comm->generateId();
            }
            else
            {
                $userid = $params['userid'];
            }
           
            
            $sql="INSERT INTO tbl_user_master "
                    . "(user_id,user_name,password,logmobile,email,city,address,date_time,updated_by,is_active,gender) VALUES ("
                    . "\"".$userid."\""
                    . ",\"" . urldecode($params['name']) . "\""
                    . ",\"" . urldecode(md5($params['pass'])) . "\""
                    . ",\"" . $params['mobile'] . "\""
                    . ",\"" . urldecode($params['email']) . "\""
                    . ",\"" . urldecode($params['city']) . "\""
                    . ",\"" . urldecode($params['address']) . "\""
                    . ",now()"
                    . ",\"" . $userid . "\""
                   
                    . ",\"" . 1 . "\""
                    . ",\"" . $params['gender'] . "\")"
                    . " ON DUPLICATE KEY UPDATE "
                            ."user_name             = \"".urldecode($params['name'])."\","
                            ."password              = \"" .urldecode(md5($params['pass']))."\","
                            ."logmobile             = \"" .$params['mobile']."\","
                            ."email                 = \"" .urldecode($params['email'])."\","
                            ."city                  = \"" .urldecode($params['city'])."\","
                            ."updated_by            = \"" .$params['userid']."\"";
                                    
            $res=$this->query($sql);
             
             
            $result = array();
            if ($res) {
                $err = array('err_code' => 0, 'err_msg' => 'Data inserted successfully');
            } else {
                $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
            }
            $results = array('result' => $result, 'error' => $err);
            return $results;
            
        }
        
         public function login($params){
             
            $email = (!empty($params['email'])) ? trim($params['email']) : '';
            $mobile = (!empty($params['mobile'])) ? trim($params['mobile']) : '';
            $pass = (!empty($params['pass'])) ? trim($params['pass']) : '';
           $userid = (!empty($params['uid'])) ? trim($params['uid']) : '';
            //$resp = array();
            if((empty($email) && empty($mobile)) || empty($pass)){
                
                $error = array('err_code'=>1, 'err_msg'=>'parameters are missing');
                $result = array('result'=>$resp, 'error'=>$error);
                return $result;
            }
            
            
           
            $sql = "SELECT 
                    user_name,
                   
                    user_id AS uid,
                    email,
                    logmobile,
                    password,
                    (SELECT GROUP_CONCAT(cart_id) FROM tbl_cart_master WHERE userid = uid  AND active_flag =1) 
                            AS cartid
                  FROM
                    tbl_user_master 
                  WHERE  email = '".$email."' or logmobile='".$mobile."'
                    ";
            
            $res = $this->query($sql);
            $num = $this->numRows($res);
           
          
            if($num > 0){
                
                if($res){
                    while ($row = $this->fetchData($res)){
                        $arr['uid'] = $row['uid'];
                        $arr['name'] = $row['user_name'];
                        $arr['mobile'] = $row['logmobile'];
                        $arr['email'] = $row['email'];
                        $arr['password'] = $row['password'];    
                    }
//            echo md5($params['pass'])."<br>";
//            echo $arr['password'];
                 if(md5($params['pass']) != $arr['password']){
                $error = array('err_code'=>1, 'err_msg'=>'Password incorrect');
                 $result = array('result'=>$resp, 'error'=>$error);
                    return $result; 
                }
                    $resp[] = $arr;
                }
                
                $error = array('err_code'=>0, 'err_msg'=>'signed in successfully');
            }else{
                 
                $error = array('err_code'=>1, 'err_msg'=>'Email.id does not exist');
                 $result = array('result'=>$resp, 'error'=>$error);
                    return $result; 
                 }
            
            $result = array('result'=>$resp, 'error'=>$error);
            return $result;
            
        }
        
        
        
         public function forgotPass($params)
        {
            
              $email = (!empty($params['email'])) ? trim($params['email']) : '';
          
            if (empty($email)) {
                
                $resp = array();
                $error = array('Code' => 1, 'Msg' => 'Invalid parameters');
                $res = array('results' => $resp, 'error' => $error);
                return $res;
            }
            $vsql = "   SELECT
                                email,
                                user_id,
                                logmobile,
                                user_name
                        FROM
                                tbl_user_master
                        WHERE
                                email=\"" . $params['email'] . "\"
                        AND
                                is_active = 1";
            $vres = $this->query($vsql);
            
            $row = $this->fetchData($vres); 
            $cnt1 = $this->numRows($vres);
            $mobile = $row['logmobile']; 
            $uid = $row['user_id'];
            $em = $row['email'];
            $uname = $row['user_name'];

            global $comm;
          $url = APIDOMAIN."index.php?action=changePassUrl&uid=".$uid."&email=".$em."&mobile=".$mobile;
        
          
            $res  = $comm->executeCurl($url); 
            $data = $res;
        
            $urlkey =  $data['result'][0]['urlkey'];
             if ($cnt1 > 0){
                 $subject = 'Set Password';
                $message = 'Hello '.$row['user_name'].',';
                $message .= "<br/><br/>";
                $message .= ' Thanks for creating an account with us..';
                $message .= "<br/><br/>";
                $message . ' Please click on the following link to set password for your account:';
                $message .= "<br/><br/>";
                $message .= DOMAIN."FP-". $urlkey;
                $message .= "<br/><br/>";
                $message .= "For any assistance, Call: 022-32623263. Email: info@jzeva.com";
                $message .= "<br/><br/>";
                $message .= "Team JZEVA";
                
                 $headers  = "Content-type:text/html;charset=UTF-8" . "<br/><br/>";

                 $headers .= 'From: info@jzeva.com' . "<br/><br/>";

                    $mail = mail($row['email'], $subject, $message, $headers);
                
                     if ($mail)
                    {
                        $smsText = "JZEVA Password Change Request";
                        $smsText .= "\r\n\r\n";
                        $smsText .= "Dear ".$row['user_name'].", the link to change your password is as follows";
                        $smsText .= "\r\n\r\n";
                        $smsText .= DOMAIN.'FP-'. $urlkey;
                        $smsText .= "\r\n\r\n";
                        $smsText .= "For any assistance, Call: 022-32623263. Email: info@jzeva.com";
                        $smsText .= "\r\n\r\n";
                        $smsText .= "Team JZEVA";
                       
                        $smsText = urlencode($smsText);
                       
                        $sendSMS = str_replace('_MOBILE', $mobile, SMSAPI); 
                        $sendSMS = str_replace('_MESSAGE', $smsText, $sendSMS); 
                        $res = $comm->executeCurl($sendSMS, true);
                    }
             }
/*
            if ($cnt1 > 0)
            {
                    $subject  = "IFtoSI Password Change Request";
                    $message  = "Dear ".$uname.", the link to change your password is as follows";
                    $message .= "<br/><br/>";
                    $message .= DOMAIN."FP-". $urlkey;
                    $message .= "<br/><br/>";
                    $message .= "For any assistance, Call: 022-32623263. Email: info@iftosi.com";
                    $message .= "<br/><br/>";
                    $message .= "Team IFtoSI";

                    $headers  = "Content-type:text/html;charset=UTF-8" . "<br/><br/>";

                    $headers .= 'From: info@iftosi.com' . "<br/><br/>";

                    $mail = mail($row['email'], $subject, $message, $headers);
                    if ($mail)
                    {
                        $smsText .= "IFtoSI Password Change Request";
                        $smsText .= "\r\n\r\n";
                        $smsText .= "Dear ".$uname.", the link to change your password is as follows";
                        $smsText .= "\r\n\r\n";
                        $smsText .= DOMAIN.'FP-'. $urlkey;
                        $smsText .= "\r\n\r\n";
                        $smsText .= "For any assistance, Call: 022-32623263. Email: info@iftosi.com";
                        $smsText .= "\r\n\r\n";
                        $smsText .= "Team IFtoSI";

                        $smsText = urlencode($smsText);
                        $sendSMS = str_replace('_MOBILE', $mobile, SMSAPI);
                        $sendSMS = str_replace('_MESSAGE', $smsText, $sendSMS);
                        $res = $comm->executeCurl($sendSMS, true);
                        if($res)
                        {
                            $arr = array();
                            $err = array('Code' => 0, 'Msg' => 'Link for changing password is sent to: '.$row['email'].'');
                        }
                        else
                        {
                            $arr = array();
                            $err = array('code'=>0,'msg'=>'SMS & EMAIL is not sent to the user');
                        }
                        $arr = array();
                        $err = array('Code' => 0, 'Msg' => 'Link for changing password is sent to: '.$row['email'].'');
                    }
                    else
                    {
                        $arr = array();
                        $err = array('Code' => 1, 'Msg' => 'Mail not Sent');
                    }
            }
            else
            {
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Failed to Update Password');
            }
            $result = array('results' => $arr, 'error' => $err);
            return $result;*/
        }
       
        
      /*  public function forgotpass($params) {
            
       $vsql = "SELECT * FROM tbl_user_master WHERE email=\"" . $params['email'] . "\"";
        $vres = $this->query($vsql);
        $row = $this->fetchData($vres);
       
        $cnt1 = $this->numRows($vres);
 
        if ($cnt1 > 0) {
            $password = mt_rand(11111111, 99999999); 
            $vsql1 = "UPDATE tbl_user_master SET password=MD5('$password') WHERE email=\"" . $params['email'] . "\"";

            $vres1 = $this->query($vsql1);
             if ($vres1) {
                $subject = 'Your Password is Changed Now';
                $message = 'Your password was successfully Changed. Your new password is ' . $password;
              
              $arr = array();
                $mail = mail($params['email'], $subject, $message);
               
                if ($mail) {
                   
                    $err = array('errCode' => 0, 'errMsg' => 'Email sent with the password');
                } else {
                    
                    $err = array('errCode' => 1, 'errMsg' => 'Mail not Sent');
                }
           
       /*   if ($vres1) {
                
                require_once APICLUDE . 'PHPMailer/PHPMailerAutoload.php';
                $mail = new PHPMailer;
                
                
                $subject = 'Your Password Changed';
                $message = 'Dear '.$row['first_name'].', Your password was successfully Changed. Your new password is ' . $password;

                
                $mail->addAddress($row['email'], $row['first_name']);

                $mail->setFrom('info@zommodity.com', "Zommodity");

                $mail->addReplyTo('info@zommodity.com', "Zommodity");

                $mail->isHTML(true);

                $mail->Subject = $subject;
                $mail->Body = $message;

                if ($mail->send()) {
                    $arr = array();
                    $err = array('errCode' => 0, 'errMsg' => 'Email sent with the password');
                } else {
                    $arr = array();
                    $err = array('errCode' => 1, 'errMsg' => 'Mail not Sent');
                }
            } else {
                $arr = array();
                $err = array('errCode' => 1, 'errMsg' => 'Failed to Update Password');
            }
        } else {
           
            $err = array('errCode' => 1, 'errMsg' => 'invalid Email ID');
        }
        }
        $result = array('results' => $arr, 'error' => $err);
        return $result;
    }*/
        
        public function getUserDetailsById($params)
        {
            
            if($params['userid'])
            {
                $sql="SELECT user_name as name,logmobile as mb,gender as gn,email as em,city,address,is_active as aflag,is_vendor as vendor from tbl_user_master WHERE user_id='".$params['userid']."'";
                $res=$this->query($sql);
                
                $result = array();
                if ($res) 
                {
                    $result=$this->fetchData($res);
                    $result['address']=  mb_convert_encoding($result['address'], "UTF-8");
                    
                    $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
                } 
                else 
                {
                    $err = array('err_code' => 1, 'err_msg' => 'Error in fetching data');
                }
                $results = array('result' => $result, 'error' => $err);
                return $results;

            }
            else
            {
                
                $resp = array();
                $error = array('errCode' => 1, 'errMsg' => 'Parameter Missing');
                $result = array('results' => $resp, 'error' => $error);
                return $result;
                
            }
            
        }
        
        
        
        
        public function addOrder()
        {
            global $comm;
            #$params=array('orderid'=>'4120160322123432','product_id'=>'6120160315162137','user_id'=>'7720160321212345','order_date'=>'2016-03-21 21:23:10','delivery_date'=>'2016-03-22 21:23:10','order_status'=>0,'active_flag'=>1,'updatedby'=>'system','product_price'=>300000);
            $params=array('product_id'=>'6120160315162137','user_id'=>'7720160321212345','order_date'=>'2016-03-21 21:23:10','delivery_date'=>'2016-03-22 21:23:10','order_status'=>0,'active_flag'=>1,'updatedby'=>'system','product_price'=>300000,'payment'=>0);
            
            
            if(!$params['orderid'])
            {
                $orderid=$comm->generateId();
            }
            else
            {
                $orderid = $params['orderid'];
            }
            
            $sql="INSERT INTO tbl_order_master(order_id,product_id,user_id,order_date,delivery_date,order_status,active_flag,createdon,updatedby,product_price,payment) VALUES("
                   . "\"".$orderid."\""
                   . ",\"".$params['product_id']."\""
                   . ",\"".$params['user_id']."\""
                   . ",\"".$params['order_date']."\""
                   . ",\"".$params['delivery_date']."\""
                   . ",\"".$params['order_status']."\""
                   . ",\"".$params['active_flag']."\""
                   .",now()"
                   .",\"".$params['updatedby']."\""
                   .",\"".$params['product_price']."\""
                   .",\"".$params['payment']."\""
                   . ")"
                   ." ON DUPLICATE KEY UPDATE "
                        . " delivery_date =  \"" .$params['delivery_date']."\","
                        . " order_status =  \"" .$params['order_status']."\","
                        . " active_flag =  \"" .$params['active_flag']."\","
                        . " updatedby =  \"" .$params['updatedby']."\"";
            
             
            $res=  $this->query($sql);
            
            $result = array();
            if ($res) {
                $err = array('err_code' => 0, 'err_msg' => 'Data inserted successfully');
            } else {
                $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
            }
            $results = array('result' => $result, 'error' => $err);
            return $results;
            
        }
        
        
        public function getOrderDetailsByOrdId($params)
        {
            global $comm;
            if($params['orderid'])
            {
                $sql="SELECT order_id as oid,product_id as pid,(Select product_seo_name from tbl_product_master where productid=pid) as pname,user_id as uid,(SELECT user_name from tbl_user_master WHERE user_id=uid) AS uname,(SELECT logmobile from tbl_user_master WHERE user_id=uid) AS umobile,order_date as odate,delivery_date as ddate,order_status as ostatus,active_flag as aflag, product_price as price,payment as pm   FROM tbl_order_master WHERE order_id=".$params['orderid']."";

                $res=$this->query($sql);

                $result = array();
                if ($res) 
                {
                    $result=$this->fetchData($res);
                    $result['odate']=$comm->makeDate($result['odate']);
                    $result['ddate']=$comm->makeDate($result['ddate']);
                    $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
                } 
                else 
                {
                    $err = array('err_code' => 1, 'err_msg' => 'Error in fetching data');
                }
                $results = array('result' => $result, 'error' => $err);
                return $results;
            }
            else
            {
                $err = array('err_code' => 1, 'err_msg' => 'Parameter Missing');
            }
            $results = array('result' => $result, 'error' => $err);
            return $results;
        
        }
        
        
        public function getOrderDetailsByuId($params)
        {
            global $comm;
            if($params['userid'])
            {
                
                $sql="SELECT order_id as oid,product_id as pid,(Select product_seo_name from tbl_product_master where productid=pid) as pname,user_id as uid,order_date as odate,delivery_date as ddate,order_status as ostatus,active_flag as aflag, product_price as price ,payment as pm  FROM tbl_order_master WHERE user_id=".$params['userid']." ORDER BY order_date DESC";
                $res=$this->query($sql);
                $result = array();
                if ($res) 
                {
                    while($row=$this->fetchData($res))
                    {
                        $row['odate']=$comm->makeDate($row['odate']);
                        $row['ddate']=$comm->makeDate($row['ddate']);
                        $result[]=$row; 
                    }
                    
                    $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
                } 
                else 
                {
                    $err = array('err_code' => 1, 'err_msg' => 'Error in fetching data');
                }
                $results = array('result' => $result, 'error' => $err);
                return $results;
            }
            else
            {
                $err = array('err_code' => 1, 'err_msg' => 'Parameter Missing');
            }
            $results = array('result' => $result, 'error' => $err);
            return $results;
        
        }
        
        public function getAllUserDetails($params)
        {
            if($params['userid'])
            {
                $user=$this->getUserDetailsById($params);
                $orders=$this->getOrderDetailsByuId($params);
                $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
                
            }
            else
            {
                $err = array('err_code' => 1, 'err_msg' => 'Parameter Missing');
            }
            $results = array('result' => array('user'=>$user['result'],'orders'=>$orders['result']), 'error' => $err);
            return $results;
            
        }
        
        public function changeOrderStatus($params)
        {
            $params=  json_decode($params[0],1);
            $orderid = (!empty($params['orderid'])) ? trim($params['orderid']) : '';
            $orderst = (!empty($params['ostatus'])) ? trim($params['ostatus']) : '';
            $userid = (!empty($params['userid'])) ? trim($params['userid']) : '';
            
            if((empty($orderid)) || (empty($orderst)) || (empty($userid)))
            {
                $resp = array();
                $error = array('errCode' => 1, 'errMsg' => 'Parameter Missing');
                $result = array('results' => $resp, 'error' => $error);
                return $result;
            }
            else
            {
                $sql="UPDATE tbl_order_master SET  order_status =  \"" .$params['ostatus']."\" WHERE order_id=".$params['orderid']." AND user_id=".$params['userid']."";
                $res=  $this->query($sql);
                $result = array();
                if ($res) {
                    $err = array('err_code' => 0, 'err_msg' => 'Data updatetd successfully');
                } else {
                    $err = array('err_code' => 1, 'err_msg' => 'Error in updating data');
                }
                $results = array('result' => $result, 'error' => $err);
                return $results;
                
            }
            
        }
        
        public function geOrderList($params)
        {
            
            $sql="  SELECT 
                        order_id as oid 
                    FROM 
                        tbl_order_master 
                    WHERE 
                        active_flag=1 
                    ORDER BY updatedon DESC ";
            
            $page = ($params['page'] ? $params['page'] : 1);
            $limit = ($params['limit'] ? $params['limit'] : 1000);

            //Making sure that query has limited rows
            if ($limit >1000 ) {
                $limit = 1000;
            }

            if (!empty($page)) {
                $start = ($page * $limit) - $limit;
                $sql.=" LIMIT " . $start . ",$limit";
            }
            $res=$this->query($sql);
            if($this->numRows($res)>0)
            {
                
                while($row=$this->fetchData($res))
                {
                    $tmpparams=array('orderid'=>$row['oid']);
                    $reslt[]=$this->getOrderDetailsByOrdId($tmpparams);
                }
                
                foreach ($reslt as $key=>$val)
                {
                    $result[]=$val['result'];
                }
                $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
            } 
            else 
            {
                $err = array('err_code' => 1, 'err_msg' => 'No records found');
            }
            $results = array('result' => $result, 'error' => $err);
            return $results;
        }
        
        
        public function getUserList($params)
        {
            
            $sql="SELECT 
                        user_id as uid,
                        user_name as name,
                        logmobile as mb,
                        email as em,
                        address as address ,
                        (SELECT count(order_id)  FROM tbl_order_master WHERE  user_id= uid  AND order_status < 6) AS openOrd ,
                        (SELECT count(order_id)  FROM tbl_order_master WHERE  user_id= uid  AND order_status = 6) AS pastOrd  
                FROM 
                        tbl_user_master
                WHERE
                        is_active = 1
                ORDER BY
                        update_time DESC
                    ";
            $page = ($params['page'] ? $params['page'] : 1);
            $limit = ($params['limit'] ? $params['limit'] : 1000);
            //Making sure that query has limited rows
            if ($limit >1000 ) {
                $limit = 1000;
            }
            if (!empty($page)) {
                $start = ($page * $limit) - $limit;
                $sql.=" LIMIT " . $start . ",$limit";
            }
            $res=$this->query($sql);
          
            if($this->numRows($res)>0)
            {
                $i=0;
                while($row=$this->fetchData($res))
                {  
                    $result[]=$row;
                    $result[$i]['address']= mb_convert_encoding($row['address'], "UTF-8");
                    $i++;    
                } 
                $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
            } 
            else 
            {
                $err = array('err_code' => 1, 'err_msg' => 'Error in fetching data');
            }
            $results = array('result' => $result, 'error' => $err);
            return $results;          
            
            
        }
        
       public function sendotp($params)
       {
            $mobile = (!empty($params['mobile'])) ? trim($params['mobile']) : '';
               if( empty($mobile) )
            {
                $resp = array();
                $error = array('errCode' => 1, 'errMsg' => 'Parameter Missing');
                $result = array('results' => $resp, 'error' => $error);
                return $result;
            }
            
            $mobsql="select logmobile from tbl_user_master where logmobile='".$mobile."'";
	    $lres = $this->query($mobsql); 
            $lrow = $this->fetchData($lres);
            $cnt1 = $this->numRows($lres);   
	     if ($cnt1 > 0)
            { 
             //   $err = array('err_code' => 0, 'err_msg' => 'mobile number exist'); 
                
                global $comm;
                $isValidate = true;
                $sql = "SELECT
                        *,
                        DATE_SUB(`updated_on`,INTERVAL - 10 MINUTE) as intervl,
                        now()
                        FROM
                                tbl_verification_code
                        WHERE
                                mobile = " . $params['mobile'] . "
                        AND
                                DATE_SUB(`updated_on`,INTERVAL - 10 MINUTE) > now() limit 1";
                $res = $this->query($sql);
                  if ($res)
                    { 
                        $row = $this->fetchData($res); 
                        if ($row['vcode'])
                        {
                            $rno = $row['vcode'];
                             $isValidate = false; 
                        }
                    }
                    if ($isValidate)
                    {
                        $rno = rand(100000, 999999);
                        $sql = "INSERT
                                INTO
                                            tbl_verification_code (mobile,vcode)
                                VALUES
                                            (" . $params['mobile'] . ",
                                             " . $rno . ")";
                        $res = $this->query($sql); 
                    }
                    if($rno)
                    {
                        $txt = 'Your OTP is ' . $rno;
                        $url = str_replace('_MOBILE', $params['mobile'], SMSAPI);
                        $url = str_replace('_MESSAGE', urlencode($txt), $url);  // print_r($url);  
                        $res = $comm->executeCurl($url, true);
                        if (!empty($res))
                        {
                          $err = array('err_code' => 0, 'err_msg' => 'OTP is sent to your mobile number');  
                        }
                        else
                        {
                           $err = array('err_code' => 1, 'err_msg' => 'OTP sending failed');  
                        }
                    }
	    }
            else{ 
                $err = array('err_code' => 2, 'err_msg' => 'mobile number not exist');
            } 
            $result = array();
            $results = array('result' => $result, 'error' => $err);
            return $results; 
            
       }
       
       public function addshippingdetail($params)
        { 
            global $comm;
            $params= (json_decode($params[0],1));
            
            $userid = (!empty($params['user_id'])) ? trim($params['user_id']) : '';
            $name = (!empty($params['name'])) ? trim($params['name']) : '';
            $mobile = (!empty($params['mobile'])) ? trim($params['mobile']) : '';
            $city = (!empty($params['city'])) ? trim($params['city']) : ''; 
            $email = (!empty($params['email'])) ? trim($params['email']) : '';
            $deliveryopt = (!empty($params['delivery_option'])) ? trim($params['delivery_option']) : '';
            
           if((empty($userid)) || (empty($name)) || (empty($mobile)) || (empty($email)) || (empty($city)) || (empty($deliveryopt)))
            {
                $resp = array();
                $error = array('errCode' => 1, 'errMsg' => 'Parameter Missing');
                $result = array('results' => $resp, 'error' => $error);
                return $result;
            }
              
            $sql="INSERT INTO tbl_order_shipping_details "
                    . "(user_id,name,mobile,email,city,address,state,pincode,delivery_option,createdon) VALUES ("
                    . "\"".$userid."\""
                    . ",\"" . $name . "\""
                    . ",\"" . $mobile . "\""
                    . ",\"" . $email . "\""
                    . ",\"" . $city . "\""
                    . ",\"" . urldecode($params['address']) . "\"" 
                    . ",\"" . urldecode(($params['state'])) . "\""
		    . ",\"" . urldecode(($params['pincode'])) . "\""
		    . ",\"" . $deliveryopt . "\""
                    . ",now())"
                    . " ON DUPLICATE KEY UPDATE "
                            ."name    = \"".$name."\"," 
                            ."mobile  = \"" .$mobile."\","
                            ."email   = \"" .$email."\","
                            ."city    = \"" .$city."\","
                            ."address  = \"" .$params['address']."\","
			    ."state    = \"" .urldecode($params['state'])."\","
			    ."pincode  = \"" .urldecode($params['pincode'])."\","
			    ."delivery_option   = \"" .$deliveryopt."\"";
                                    
            $res=$this->query($sql);
            
            $result = array();
            if ($res) {
                $err = array('err_code' => 0, 'err_msg' => 'Data inserted successfully');
            } else {
                $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
            }
            $results = array('result' => $result, 'error' => $err);
            return $results;
            
        }
        
	public function newforgotPass($params)
        {
             
            $email = (!empty($params['email'])) ? trim($params['email']) : '';
         
            if (empty($email)) {
                
                $resp = array();
                $error = array('Code' => 1, 'Msg' => 'Invalid parameters');
                $res = array('results' => $resp, 'error' => $error);
                return $res;
            }
            $vsql = "   SELECT
                                email,
                                user_id,
                                logmobile,
                                user_name
                        FROM
                                tbl_user_master
                        WHERE
                                email=\"" . $params['email'] . "\"
                        AND
                                is_active = 1";
            $vres = $this->query($vsql);
            
            $row = $this->fetchData($vres);
            $cnt1 = $this->numRows($vres); 
            $mobile = $row['logmobile']; 
            $uid = $row['user_id'];
            $em = urlencode($row['email']);
            $uname = urlencode($row['user_name']);
	    
	  
	    
            global $comm;
            $url = APIDOMAIN."index.php?action=changePassUrl&uid=".$uid."&email=".$em."&mobile=".$mobile;
	   
            $res  = $comm->executeCurl($url);
            $data = $res;
	      //    print_r($res);
	     
             $urlkey =  $data['result'][0]['urlkey'];
	   
            if ($cnt1 > 0)
            {
                    $subject  = "JZEVA Password Change Request";
                    $message  = "Dear ".$uname.", the link to change your password is as follows";
                    $message .= "<br/><br/>";
		    $message .= DOMAIN."FP-". $urlkey;
                   // $message .= DOMAIN."FP-". $urlkey;
                    $message .= "<br/><br/>";
                    $message .= "For any assistance, Call: 022-32623263. Email: info@jzeva.com";
                    $message .= "<br/><br/>";
                    $message .= "Team jzeva";

                    $headers  = "Content-type:text/html;charset=UTF-8" . "<br/><br/>";

                    $headers .= 'From: info@jzeva.com' . "<br/><br/>";

                    $mail = mail($row['email'], $subject, $message, $headers); 
		              print_r($message);
                     
                        $arr = array();
                        $err = array('Code' => 0, 'Msg' => 'Link for changing password is sent to: '.$row['email'].'');
           } 
           else
            {
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Failed to Update Password');
            }
            $result = array('results' => $arr, 'error' => $err); 
             return $result; 
        }
	
	public function checkopt($params)
	{
	  $otpval=$params['otpval'];
	   if( empty($otpval) )
            {
                $resp = array();
                $error = array('errCode' => 1, 'errMsg' => 'Parameter Missing');
                $result = array('results' => $resp, 'error' => $error);
                return $result;
            }
	    $sql = "SELECT
                        mobile as mob,vcode,updated_on,
                        DATE_SUB(`updated_on`,INTERVAL - 10 MINUTE) as intervl,
                        now(),
			(SELECT GROUP_CONCAT(email) FROM tbl_user_master WHERE logmobile=mob AND is_active=1) AS email
                        FROM
                                tbl_verification_code
                        WHERE
                                mobile = " . $params['mobile'] . "
                        AND
                                DATE_SUB(`updated_on`,INTERVAL - 10 MINUTE) > now() limit 1";
                $res = $this->query($sql);
		$row=  $this->fetchData($res);
		$result = array();
	    if($res){
	      $arr['mobile']=$row['mob'];
	      $arr['otp']=$row['vcode'];
	      $arr['intervl']=$row['intervl'];
	      $arr['email']=$row['email'];
	      $result=$arr;
	      $err = array('err_code' => 0, 'err_msg' => 'data fetched successfully');
	    }
	    else{
                $err = array('err_code' => 1, 'err_msg' => 'error in fetching data');
            }
            $results = array('result' => $result, 'error' => $err);
            return $results;  
	}
	
	public function getuserdetailbymail($params)
	{
	  $email=(!empty($params['email'])) ? trim($params['email']): '';
	  if ($email == "" || $email == null || $email == "undefined") {
                
                $resp = array();
                $error = array('Code' => 1, 'Msg' => 'Invalid Email.id');
                $res = array('results' => $resp, 'error' => $error);
                return $res;
            }
	    $sql="select user_id,user_name,logmobile,email from tbl_user_master where email='".$params['email']."'";
	    $res=  $this->query($sql);
	    if($res){
	    while($row=  $this->fetchData($res)){
	      $arr['user_id']=$row['user_id'];
	      $arr['user_name']=$row['user_name'];
	      $arr['logmobile']=$row['logmobile'];
	      $reslt=$arr;
	    }
	     $err = array('Code' => 0, 'Msg' => 'Data fetched successfully');
	    }
	    else{
	      $err = array('Code' => 1, 'Msg' => 'error in fetching detail');
	    }
	    $result = array('results' => $reslt, 'error' => $err); 
            return $result; 
	}
	
	public function updateuserpass($params)
	{
	    $userid = (!empty($params['user_id'])) ? trim($params['user_id']) : '';
            
            
            if(empty($userid))
            {
                $resp = array();
                $error = array('errCode' => 1, 'errMsg' => 'Parameter Missing');
                $result = array('results' => $resp, 'error' => $error);
                return $result;
            }
	    
	    $sql="UPDATE tbl_user_master PASSWORD SET "
		    . "PASSWORD='".urldecode(md5($params['pass']))."' WHERE user_id='".$params['user_id']."'"
		    . "AND logmobile='".$params['mobile']."'AND email='".$params['email']."'";
	                      
            $res=$this->query($sql); 
            $result = array();
            if ($res) {
                $err = array('err_code' => 0, 'err_msg' => 'Data updated successfully');
            } else {
                $err = array('err_code' => 1, 'err_msg' => 'Error in updating');
            }
            $results = array('result' => $result, 'error' => $err);
            return $results;
	    
	}
    }
     
?>