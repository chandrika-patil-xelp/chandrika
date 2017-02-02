<?php

include_once APICLUDE . 'common/db.class.php';

class user extends DB {

    function __construct($db) {
        parent::DB($db);
    }

    private function generateId() {
        $dTime = round(microtime(true) * 1000);
        $rNum = mt_rand(1, 9);
        $genrd = $rNum . $dTime;
        return $genrd;
    }

    public function addUser($params) {

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
        $isvendor = (!empty($params['isvendor'])) ? trim($params['isvendor']) : '';
        $city = (!empty($params['city'])) ? trim($params['city']) : '';

        if ((empty($name)) || (empty($mobile)) || (empty($email)) || (empty($pass))) {
            $resp = array();
            $error = array('errCode' => 1, 'errMsg' => 'Parameter Missing');
            $result = array('results' => $resp, 'error' => $error);
            return $result;
        }
        $emlsql = "select email from tbl_user_master where email='" . $email . "'";
        $eres = $this->query($emlsql);
        $row = $this->fetchData($eres);
        $cnt1 = $this->numRows($eres);
        if ($cnt1 > 0) {
            $resp = array();
            $error = array('err_code' => 1, 'err_msg' => 'email id already exist');
            $result = array('results' => $resp, 'error' => $error);
            return $result;
        }
        //changes
        $mobsql = "select logmobile from tbl_user_master where logmobile='" . $mobile . "'";
        $lres = $this->query($mobsql);
        $lrow = $this->fetchData($lres);
        $cnt1 = $this->numRows($lres);
        if ($cnt1 > 0) {
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
        if (!$params['userid']) {
            $userid = $comm->generateId();
        } else {
            $userid = $params['userid'];
        }


        $sql = "INSERT INTO tbl_user_master "
                . "(user_id,user_name,password,logmobile,email,city,address,date_time,updated_by,is_active,gender) VALUES ("
                . "\"" . $userid . "\""
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
                . "user_name             = \"" . urldecode($params['name']) . "\","
                . "password              = \"" . urldecode(md5($params['pass'])) . "\","
                . "logmobile             = \"" . $params['mobile'] . "\","
                . "email                 = \"" . urldecode($params['email']) . "\","
                . "city                  = \"" . urldecode($params['city']) . "\","
                . "updated_by            = \"" . $params['userid'] . "\"";

        $res = $this->query($sql);

        global $db;
        include 'class.emailtemplate.php';
        $obj = new emailtemplate($db['jzeva']);
        $message = $obj->genwelcumtemplate($params);

        $subject = "Welcome to JZEVA";
        $headers = "Content-type:text/html;charset=UTF-8" . "<br/><br/>";
        $headers .= 'From: care@jzeva.com' . "<br/><br/>";

        mail($email, $subject, $message, $headers);

        $result = array();
        if ($res) {
            $err = array('err_code' => 0, 'err_msg' => 'Data inserted successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function login($params) {

        $email = (!empty($params['email'])) ? trim($params['email']) : '';
        $mobile = (!empty($params['mobile'])) ? trim($params['mobile']) : '';
        $pass = (!empty($params['pass'])) ? trim($params['pass']) : '';
        $userid = (!empty($params['uid'])) ? trim($params['uid']) : '';
        //$resp = array();
        if ((empty($email) && empty($mobile)) || empty($pass)) {

            $error = array('err_code' => 1, 'err_msg' => 'parameters are missing');
            $result = array('result' => $resp, 'error' => $error);
            return $result;
        }



        $sql = "SELECT
                    user_name,

                    user_id AS uid,
                    email,
                    logmobile,
                    password,
		    is_vendor,
                    (SELECT GROUP_CONCAT(cart_id) FROM tbl_cart_master WHERE userid = uid  AND active_flag =1)
                            AS cartid
                  FROM
                    tbl_user_master
                  WHERE  email = '" . $email . "' or logmobile='" . $mobile . "'
                    ";

        $res = $this->query($sql);
        $num = $this->numRows($res);


        if ($num > 0) {

            if ($res) {
                while ($row = $this->fetchData($res)) {
                    $arr['uid'] = $row['uid'];
                    $arr['name'] = $row['user_name'];
                    $arr['mobile'] = $row['logmobile'];
                    $arr['email'] = $row['email'];
                    $arr['password'] = $row['password'];
                    $arr['is_vendor'] = $row['is_vendor'];
                }
                if (md5($params['pass']) != $arr['password']) {
                    $error = array('err_code' => 1, 'err_msg' => 'Password incorrect');
                    $result = array('result' => $resp, 'error' => $error);
                    return $result;
                }
                $resp[] = $arr;
            }

            $error = array('err_code' => 0, 'err_msg' => 'signed in successfully');
        } else {
            if (!empty($email)) {
                $error = array('err_code' => 1, 'err_msg' => 'Email.id does not exist');
            }
            if (!empty($mobile)) {
                $error = array('err_code' => 1, 'err_msg' => 'Mobile No does not exist');
            }
            $result = array('result' => $resp, 'error' => $error);
            return $result;
        }

        $result = array('result' => $resp, 'error' => $error);
        return $result;
    }

    public function forgotPass($params) {

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
        $url = APIDOMAIN . "index.php?action=changePassUrl&uid=" . $uid . "&email=" . $em . "&mobile=" . $mobile;


        $res = $comm->executeCurl($url);
        $data = $res;

        $urlkey = $data['result'][0]['urlkey'];
        if ($cnt1 > 0) {
            $subject = 'Set Password';
            $message = 'Hello ' . $row['user_name'] . ',';
            $message .= "<br/><br/>";
            $message .= ' Thanks for creating an account with us..';
            $message .= "<br/><br/>";
            $message . ' Please click on the following link to set password for your account:';
            $message .= "<br/><br/>";
            $message .= DOMAIN . "FP-" . $urlkey;
            $message .= "<br/><br/>";
            $message .= "For any assistance, Call: 022-32623263. Email: info@jzeva.com";
            $message .= "<br/><br/>";
            $message .= "Team JZEVA";

            $headers = "Content-type:text/html;charset=UTF-8" . "<br/><br/>";

            $headers .= 'From: info@jzeva.com' . "<br/><br/>";

            $mail = mail($row['email'], $subject, $message, $headers);

            if ($mail) {
                $smsText = "JZEVA Password Change Request";
                $smsText .= "\r\n\r\n";
                $smsText .= "Dear " . $row['user_name'] . ", the link to change your password is as follows";
                $smsText .= "\r\n\r\n";
                $smsText .= DOMAIN . 'FP-' . $urlkey;
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
          return $result; */
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
      } */

//  public function getUserDetailsById($params)
//        {
//
//            if($params['userid'])
//            {
//                $sql="SELECT user_name as name,logmobile as mb,gender as gn,email as em,city,address,is_active as aflag,is_vendor as vendor from tbl_user_master WHERE user_id='".$params['userid']."'";
//                $res=$this->query($sql);
//
//                $result = array();
//                if ($res)
//                {
//                    $result=$this->fetchData($res);
//                    $result['address']=  mb_convert_encoding($result['address'], "UTF-8");
//
//                    $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
//                }
//                else
//                {
//                    $err = array('err_code' => 1, 'err_msg' => 'Error in fetching data');
//                }
//                $results = array('result' => $result, 'error' => $err);
//                return $results;
//
//            }
//            else
//            {
//
//                $resp = array();
//                $error = array('errCode' => 1, 'errMsg' => 'Parameter Missing');
//                $result = array('results' => $resp, 'error' => $error);
//                return $result;
//
//            }
//
//        }
//        */
//


    public function addOrder() {
        global $comm;
        #$params=array('orderid'=>'4120160322123432','product_id'=>'6120160315162137','user_id'=>'7720160321212345','order_date'=>'2016-03-21 21:23:10','delivery_date'=>'2016-03-22 21:23:10','order_status'=>0,'active_flag'=>1,'updatedby'=>'system','product_price'=>300000);
        $params = array('product_id' => '6120160315162137', 'user_id' => '7720160321212345', 'order_date' => '2016-03-21 21:23:10', 'delivery_date' => '2016-03-22 21:23:10', 'order_status' => 0, 'active_flag' => 1, 'updatedby' => 'system', 'product_price' => 300000, 'payment' => 0);


        if (!$params['orderid']) {
            $orderid = $comm->generateId();
        } else {
            $orderid = $params['orderid'];
        }

        $sql = "INSERT INTO tbl_order_master(order_id,product_id,user_id,order_date,delivery_date,order_status,active_flag,createdon,updatedby,product_price,payment) VALUES("
                . "\"" . $orderid . "\""
                . ",\"" . $params['product_id'] . "\""
                . ",\"" . $params['user_id'] . "\""
                . ",\"" . $params['order_date'] . "\""
                . ",\"" . $params['delivery_date'] . "\""
                . ",\"" . $params['order_status'] . "\""
                . ",\"" . $params['active_flag'] . "\""
                . ",now()"
                . ",\"" . $params['updatedby'] . "\""
                . ",\"" . $params['product_price'] . "\""
                . ",\"" . $params['payment'] . "\""
                . ")"
                . " ON DUPLICATE KEY UPDATE "
                . " delivery_date =  \"" . $params['delivery_date'] . "\","
                . " order_status =  \"" . $params['order_status'] . "\","
                . " active_flag =  \"" . $params['active_flag'] . "\","
                . " updatedby =  \"" . $params['updatedby'] . "\"";


        $res = $this->query($sql);

        $result = array();
        if ($res) {
            $err = array('err_code' => 0, 'err_msg' => 'Data inserted successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function getOrderDetailsByOrdId($params) {
        global $comm;
        if ($params['orderid']) {
            $sql = "SELECT  order_id as oid,product_id as pid,(Select product_seo_name from tbl_product_master where productid=pid) as pname,user_id as uid,(SELECT user_name from tbl_user_master WHERE user_id=uid) AS uname,(SELECT logmobile from tbl_user_master WHERE user_id=uid) AS umobile,order_date as odate,delivery_date as ddate,order_status as ostatus,active_flag as aflag, product_price as price,payment as pm   FROM tbl_order_master WHERE order_id=" . $params['orderid'] . "";

            $res = $this->query($sql);

            $result = array();
            if ($res) {
                $result = $this->fetchData($res);
                $result['odate'] = $comm->makeDate($result['odate']);
                $result['ddate'] = $comm->makeDate($result['ddate']);
                $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
            } else {
                $err = array('err_code' => 1, 'err_msg' => 'Error in fetching data');
            }
            $results = array('result' => $result, 'error' => $err);
            return $results;
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Parameter Missing');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function getOrderDetailsByuId($params) {
        global $comm;
        if ($params['userid']) {

            $sql = "SELECT (order_id) as oid,product_id as pid,(Select product_seo_name from tbl_product_master where productid=pid) as pname,user_id as uid,order_date as odate,delivery_date as ddate,order_status as ostatus,active_flag as aflag, product_price as price ,payment as pm  FROM tbl_order_master WHERE user_id=" . $params['userid'] . " ORDER BY order_date DESC";
            $res = $this->query($sql);
            $result = array();
            if ($res) {
                while ($row = $this->fetchData($res)) {
                    $row['odate'] = $comm->makeDate($row['odate']);
                    $row['ddate'] = $comm->makeDate($row['ddate']);
                    $result[] = $row;
                }

                $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
            } else {
                $err = array('err_code' => 1, 'err_msg' => 'Error in fetching data');
            }
            $results = array('result' => $result, 'error' => $err);
            return $results;
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Parameter Missing');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function getAllUserDetails($params) {
        if ($params['userid']) {
            $user = $this->getUserDetailsById($params);
            $orders = $this->getOrderDetailsByuId($params);
            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Parameter Missing');
        }
        $results = array('result' => array('user' => $user['result'], 'orders' => $orders['result']), 'error' => $err);
        return $results;
    }

    public function changeOrderStatus($params) {

        $params = json_decode($params[0], 1);
        $orderid = (!empty($params['orderid'])) ? trim($params['orderid']) : '';
        $orderst = (!empty($params['ostatus'])) ? trim($params['ostatus']) : '';
        $userid = (!empty($params['userid'])) ? trim($params['userid']) : '';
        $pid = (!empty($params['pid'])) ? trim($params['pid']) : '';
        $combn = (!empty($params['combn'])) ? trim($params['combn']) : '';
        $size = (!empty($params['sz'])) ? trim($params['sz']) : '';
        if (empty($orderid)) {
            $resp = array();
            $error = array('errCode' => 1, 'errMsg' => 'Parameter Missing');
            $result = array('results' => $resp, 'error' => $error);
            return $result;
        } else {
            global $db;
            global $comm;
            $smssql = "SELECT
			  shipping_id as shipid,
			  product_id as pid,
			  (SELECT name FROM tbl_order_shipping_details WHERE shipping_id=shipid)AS shipname,
			  (SELECT mobile FROM tbl_order_shipping_details WHERE shipping_id=shipid)AS mobile,
			  (SELECT gender FROM tbl_order_shipping_details WHERE shipping_id=shipid)AS gender,
			  (SELECT email FROM tbl_order_shipping_details WHERE shipping_id=shipid)AS email,
			  (SELECT product_name FROM tbl_product_master WHERE productid=pid)AS prd_name
		    FROM tbl_order_master WHERE order_id=" . $orderid . "";

            $smsres = $this->query($smssql);
            $smsrow = $this->fetchData($smsres);
            $email = $smsrow['email'];
            $gender = $smsrow['gender'];
            $usrname = $smsrow['shipname'];
            $prdname = $smsrow['prd_name'];
            $mobile = $smsrow['mobile'];

            $gndr = "";
            if ($gender == 1)
                $gndr = "Ms";
            else if ($gender == 2)
                $gndr = "Mr";
            else if ($gender == 3)
                $gndr = "Mrs";

            if ($params['ostatus'] == 5) {

                $txt = 'Dear ' . $gndr . '.  ' . $usrname . ' your Jzeva jewellery ' . $prdname . ' with order number ' . $orderid . ' has been shipped. You can track your order on www.jzeva.com.';

                $url = str_replace('_MOBILE', $mobile, SMSAPI);
                $url = str_replace('_MESSAGE', urlencode($txt), $url);
                $smsurlres = $comm->executeCurl($url, true);


                include APICLUDE . 'class.emailtemplate.php';
                $obj = new emailtemplate($db['jzeva']);
                $message = $obj->getshippingtemplate(array('userid' => $userid, 'ordid' => $orderid, 'pid' => $pid));
                $subject = "JZEVA Order Shipped Detail";
                $headers = "Content-type:text/html;charset=UTF-8" . "<br/><br/>";
                $headers .= 'From: care@jzeva.com' . "<br/><br/>";

                mail($email, $subject, $message, $headers);
            } else if ($params['ostatus'] == 6) {
                $txt = 'Dear ' . $gndr . '.  ' . $usrname . ' your Jzeva jewellery ' . $prdname . ' with order number ' . $orderid . ' has been Delivered. Thank you for shopping with Jzeva.com';

                $url = str_replace('_MOBILE', $mobile, SMSAPI);
                $url = str_replace('_MESSAGE', urlencode($txt), $url);
                $smsurlres = $comm->executeCurl($url, true);
            }
            $sql = "UPDATE tbl_order_master SET  order_status =  \"" . $params['ostatus'] . "\" WHERE order_id=" . $params['orderid'] . " AND user_id=" . $params['userid'] . " AND product_id= " . $params['pid'] . " AND col_car_qty= '" . $params['combn'] . "' AND size=" . $params['sz'] . "";
            $res = $this->query($sql);
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

    public function geOrderList($params) {

        $sql = "  SELECT
                        order_id as oid
                    FROM
                        tbl_order_master
                    WHERE
                        active_flag=1
                    ORDER BY updatedon DESC ";

        $page = ($params['page'] ? $params['page'] : 1);
        $limit = ($params['limit'] ? $params['limit'] : 1000);

        //Making sure that query has limited rows
        if ($limit > 1000) {
            $limit = 1000;
        }

        if (!empty($page)) {
            $start = ($page * $limit) - $limit;
            $sql.=" LIMIT " . $start . ",$limit";
        }
        $res = $this->query($sql);
        if ($this->numRows($res) > 0) {

            while ($row = $this->fetchData($res)) {
                $tmpparams = array('orderid' => $row['oid']);
                $reslt[] = $this->getOrderDetailsByOrdId($tmpparams);
            }

            foreach ($reslt as $key => $val) {
                $result[] = $val['result'];
            }
            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'No records found');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function getUserList($params) {

        $sql = "SELECT
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
        if ($limit > 1000) {
            $limit = 1000;
        }
        if (!empty($page)) {
            $start = ($page * $limit) - $limit;
            $sql.=" LIMIT " . $start . ",$limit";
        }
        $res = $this->query($sql);

        if ($this->numRows($res) > 0) {
            $i = 0;
            while ($row = $this->fetchData($res)) {
                $result[] = $row;
                $result[$i]['address'] = mb_convert_encoding($row['address'], "UTF-8");
                $i++;
            }
            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in fetching data');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function sendotp($params) {
        $mobile = (!empty($params['mobile'])) ? trim($params['mobile']) : '';
        if (empty($mobile)) {
            $resp = array();
            $error = array('errCode' => 1, 'errMsg' => 'Parameter Missing');
            $result = array('results' => $resp, 'error' => $error);
            return $result;
        }

        $mobsql = "select logmobile from tbl_user_master where logmobile='" . $mobile . "'";
        $lres = $this->query($mobsql);
        $lrow = $this->fetchData($lres);
        $cnt1 = $this->numRows($lres);
        if ($cnt1 > 0) {
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
            if ($res) {
                $row = $this->fetchData($res);
                if ($row['vcode']) {
                    $rno = $row['vcode'];
                    $isValidate = false;
                }
            }
            if ($isValidate) {
                $rno = rand(100000, 999999);
                $sql = "INSERT
                                INTO
                                            tbl_verification_code (mobile,vcode)
                                VALUES
                                            (" . $params['mobile'] . ",
                                             " . $rno . ")";
                $res = $this->query($sql);
            }
            if ($rno) {
                $txt = 'Your OTP is ' . $rno;
                $url = str_replace('_MOBILE', $params['mobile'], SMSAPI);
                $url = str_replace('_MESSAGE', urlencode($txt), $url);  // print_r($url);
                $res = $comm->executeCurl($url, true);
                if (!empty($res)) {
                    $err = array('err_code' => 0, 'err_msg' => 'OTP is sent to your mobile number');
                } else {
                    $err = array('err_code' => 1, 'err_msg' => 'OTP sending failed');
                }
            }
        } else {
            $err = array('err_code' => 2, 'err_msg' => 'mobile number not exist');
        }
        $result = array();
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function addshippingdetail($params) {
        global $comm;
        $params = (json_decode($params[0], 1));
        if (empty($params['shipping_id'])) {
            $ship_id = $comm->generateId();
        } else {
            $ship_id = $params['shipping_id'];
        }
        $userid = (!empty($params['user_id'])) ? trim($params['user_id']) : '';
        $name = (!empty($params['name'])) ? trim($params['name']) : '';
        $mobile = (!empty($params['mobile'])) ? trim($params['mobile']) : '';
        $city = (!empty($params['city'])) ? trim($params['city']) : '';
        $email = (!empty($params['email'])) ? trim($params['email']) : '';

        if ((empty($mobile)) && (empty($email))) {
            $resp = array();
            $error = array('errCode' => 1, 'errMsg' => 'Parameter Missing');
            $result = array('results' => $resp, 'error' => $error);
            return $result;
        }

        $sql = "INSERT INTO tbl_order_shipping_details "
                . "(user_id,shipping_id,name,mobile,email,city,address,state,pincode,gender,active_flag,createdon) VALUES ("
                . "\"" . $userid . "\""
                . ",\"" . $ship_id . "\""
                . ",\"" . $name . "\""
                . ",\"" . $mobile . "\""
                . ",\"" . $email . "\""
                . ",\"" . $city . "\""
                . ",\"" . urldecode($params['address']) . "\""
                . ",\"" . urldecode(($params['state'])) . "\""
                . ",\"" . urldecode(($params['pincode'])) . "\""
                . ",\"" . urldecode(($params['gender'])) . "\""
                . ",1"
                . ",now())"
                . " ON DUPLICATE KEY UPDATE "
                . "name    = \"" . $name . "\","
                . "mobile  = \"" . $mobile . "\","
                . "email   = \"" . $email . "\","
                . "city    = \"" . $city . "\","
                . "address  = \"" . $params['address'] . "\","
                . "state    = \"" . urldecode($params['state']) . "\","
                . "pincode  = \"" . urldecode($params['pincode']) . "\","
                . "gender  = \"" . urldecode($params['gender']) . "\"";



        $res = $this->query($sql);

        $result = array();
        if ($res) {
            $err = array('err_code' => 0, 'err_msg' => 'Data inserted successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err, 'shipid' => $ship_id);
        return $results;
    }

    public function removeShipngdetail($params) {

//            $shipping_id = (!empty($params['shipping_id'])) ? trim($params['shipping_id']) : '';
//            $user_id = (!empty($params['name'])) ? trim($params['user_id']) : '';

        if (empty($params['shipping_id']) || empty($params['user_id'])) {
            $resp = array();
            $error = array('err_code' => 1, 'err_msg' => 'Parameters Missing');
            $result = array('result' => $resp, 'error' => $error);
            return $result;
        }

        $sql = "UPDATE
                            tbl_order_shipping_details
                          SET
                            active_flag = 2
                          WHERE shipping_id = '" . $params['shipping_id'] . "'
                            AND user_id = '" . $params['user_id'] . "' ";

        $res = $this->query($sql);

        if ($res) {
            $error = array('err_code' => 0, 'err_msg' => 'Updated Successfully');
        } else {
            $error = array('err_code' => 1, 'err_msg' => 'Error In Updating');
        }

        $results = array('result' => $resp, 'error' => $error);
        return $results;
    }

    public function newforgotPass($params) {

        $email = (!empty($params['email'])) ? trim($params['email']) : '';

        if (empty($email)) {

            $resp = array();
            $error = array('Code' => 1, 'Msg' => 'Invalid parameters');
            $res = array('results' => $resp, 'error' => $error);
            return $res;
        }
        $vsql = "   SELECT
                                logmobile,
                                user_name,
				gender
                        FROM
                                tbl_user_master
                        WHERE
                                email=\"" . $email . "\"
                        AND
                                is_active = 1";
        $vres = $this->query($vsql);

        $row = $this->fetchData($vres);

        $mobile = $row['logmobile'];
        $uname = urldecode($row['user_name']);
        $gndr = $row['gender'];

        global $comm;
        $isValidate = true;
        $msql = "SELECT
                        *,
                        DATE_SUB(`updated_on`,INTERVAL - 10 MINUTE) as intervl,
                        now()
                        FROM
                                tbl_verification_code
                        WHERE
                                mobile = " . $mobile . "
                        AND
                                DATE_SUB(`updated_on`,INTERVAL - 10 MINUTE) > now() limit 1";
        $mres = $this->query($msql);
        if ($mres) {
            $mrow = $this->fetchData($mres);
            if ($mrow['vcode']) {
                $rno = $mrow['vcode'];
                $isValidate = false;
            }
        }
        if ($isValidate) {
            $rno = rand(100000, 999999);
            $mssql = "INSERT
                                INTO
                                            tbl_verification_code (mobile,vcode)
                                VALUES
                                            (" . $mobile . ",
                                             " . $rno . ")";
            $msres = $this->query($mssql);
        }


	          $subject  = "JZEVA password assistance";
            $message=$this->frgotpassotpTemplate($uname,$rno,$gndr);
            $headers  = "Content-type:text/html;charset=UTF-8" . "<br/><br/>";
            $headers .= 'From: care@jzeva.com' . "<br/><br/>";

            if (!empty($email))
            {

                     mail($email, $subject, $message, $headers);
                     $err=array('code'=>0,'msg'=>'OTP mail sent to Your email id');
	    }
	    else
            {
                $arr = array();
                $err = array('code'=>1,'msg'=>'Error in sending mail');
            }
            $result = array('result'=>$arr,'error'=>$err,'mob'=>$mobile);
            return $result;
        }

    public function checkopt($params) {
        $otpval = $params['otpval'];
        if (empty($otpval)) {
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
        $row = $this->fetchData($res);
        $result = array();
        if ($res) {
            $arr['mobile'] = $row['mob'];
            $arr['otp'] = $row['vcode'];
            $arr['intervl'] = $row['intervl'];
            $arr['email'] = $row['email'];
            $result = $arr;
            $err = array('err_code' => 0, 'err_msg' => 'data fetched successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'error in fetching data');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function getuserdetailbymail($params) {
        $email = (!empty($params['email'])) ? trim($params['email']) : '';
        if ($email == "" || $email == null || $email == "undefined") {

            $resp = array();
            $error = array('Code' => 1, 'Msg' => 'Invalid Email.id');
            $res = array('results' => $resp, 'error' => $error);
            return $res;
        }
        $sql = "select user_id,user_name,logmobile,email from tbl_user_master where email='" . $params['email'] . "'";
        $res = $this->query($sql);
        if ($res) {
            while ($row = $this->fetchData($res)) {
                $arr['user_id'] = $row['user_id'];
                $arr['user_name'] = $row['user_name'];
                $arr['logmobile'] = $row['logmobile'];
                $reslt = $arr;
            }
            $err = array('Code' => 0, 'Msg' => 'Data fetched successfully');
        } else {
            $err = array('Code' => 1, 'Msg' => 'error in fetching detail');
        }
        $result = array('results' => $reslt, 'error' => $err);
        return $result;
    }

    public function updateuserpass($params) {
        $userid = (!empty($params['user_id'])) ? trim($params['user_id']) : '';


        if (empty($userid)) {
            $resp = array();
            $error = array('errCode' => 1, 'errMsg' => 'Parameter Missing');
            $result = array('results' => $resp, 'error' => $error);
            return $result;
        }

        $sql = "UPDATE tbl_user_master PASSWORD SET "
                . "PASSWORD='" . urldecode(md5($params['pass'])) . "' WHERE user_id='" . $params['user_id'] . "'"
                . "AND logmobile='" . $params['mobile'] . "'OR email='" . $params['email'] . "'";

        $res = $this->query($sql);
        $result = array();
        if ($res) {
            $err = array('err_code' => 0, 'err_msg' => 'Data updated successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in updating');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function sendnewuserotp($params) {
        $mobile = (!empty($params['mobile'])) ? trim($params['mobile']) : '';
        if (empty($mobile)) {
            $resp = array();
            $error = array('errCode' => 1, 'errMsg' => 'Parameter Missing');
            $result = array('results' => $resp, 'error' => $error);
            return $result;
        }

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
        if ($res) {
            $row = $this->fetchData($res);
            if ($row['vcode']) {
                $rno = $row['vcode'];
                $isValidate = false;
            }
        }
        if ($isValidate) {
            $rno = rand(100000, 999999);
            $sql = "INSERT
                                INTO
                                            tbl_verification_code (mobile,vcode)
                                VALUES
                                            (" . $params['mobile'] . ",
                                             " . $rno . ")";
            $res = $this->query($sql);
        }
        if ($rno) {
            $txt = 'Dear Customer, Your OTP is ' . $rno . ' and it is Valid till next 10 mins. Please do not share this OTP with anyone. Thank You JZEVA.com';

            $url = str_replace('_MOBILE', $params['mobile'], SMSAPI);
            $url = str_replace('_MESSAGE', urlencode($txt), $url);  // print_r($url);
            $res = $comm->executeCurl($url, true);
            if (!empty($res)) {
                $err = array('err_code' => 0, 'err_msg' => 'OTP is sent to your mobile number');
            } else {
                $err = array('err_code' => 1, 'err_msg' => 'OTP sending failed');
            }
        }

        $result = array();
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function addnewUser($params) {

        global $comm;
        $name = (!empty($params['name'])) ? trim($params['name']) : '';
        $mobile = (!empty($params['mobile'])) ? trim($params['mobile']) : '';
        $pass = (!empty($params['pass'])) ? trim($params['pass']) : '';
        $email = (!empty($params['email'])) ? trim($params['email']) : '';
        $city = (!empty($params['city'])) ? trim($params['city']) : '';

        if ((empty($mobile)) && (empty($email))) {
            $resp = array();
            $error = array('errCode' => 1, 'errMsg' => 'Parameter Missing');
            $result = array('results' => $resp, 'error' => $error);
            return $result;
        }

        if (!$params['userid']) {
            $userid = $comm->generateId();
        } else {
            $userid = $params['userid'];
        }


        $sql = "INSERT INTO tbl_user_master "
                . "(user_id,user_name,password,logmobile,email,city,address,date_time,updated_by,is_active,gender) VALUES ("
                . "\"" . $userid . "\""
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
                . "user_name             = \"" . urldecode($params['name']) . "\","
                . "password              = \"" . urldecode(md5($params['pass'])) . "\","
                . "logmobile             = \"" . $params['mobile'] . "\","
                . "email                 = \"" . urldecode($params['email']) . "\","
                . "city                  = \"" . urldecode($params['city']) . "\","
                . "updated_by            = \"" . $params['userid'] . "\"";

        $res = $this->query($sql);


        $result = array();
        if ($res) {
            $err = array('userid' => $userid, 'err_code' => 0, 'err_msg' => 'Data inserted successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function getshippingdatabyid($params) {

        $userid = (!empty($params['userid'])) ? trim($params['userid']) : '';
        if ($userid == "" || $userid == null || $userid == "undefined") {
            $resp = array();
            $error = array('Code' => 1, 'Msg' => 'Invalid parameter');
            $res = array('results' => $resp, 'error' => $error);
            return $res;
        }
        $sql = "SELECT user_id,shipping_id,name,mobile,email,city,address,state,pincode,gender,createdon FROM tbl_order_shipping_details WHERE user_id='" . $params['userid'] . "' AND active_flag=1 order by createdon DESC";
        $res = $this->query($sql);
        if ($res) {
            while ($row = $this->fetchData($res)) {
                $arr['user_id'] = $row['user_id'];
                $arr['shipping_id'] = $row['shipping_id'];
                $arr['name'] = $row['name'];
                $arr['mobile'] = $row['mobile'];
                $arr['email'] = $row['email'];
                $arr['city'] = $row['city'];
                $arr['address'] = $row['address'];
                $arr['state'] = $row['state'];
                $arr['pincode'] = $row['pincode'];
                $arr['gender'] = $row['gender'];
                $arr['createdon'] = $row['createdon'];

                $reslt[] = $arr;
            }
            $err = array('Code' => 0, 'Msg' => 'Data fetched successfully');
        } else {
            $err = array('Code' => 1, 'Msg' => 'error in fetching detail');
        }
        $result = array('results' => $reslt, 'error' => $err);
        return $result;
    }

    public function getshipdatabyUid($params) {

        $userid = (!empty($params['userid'])) ? trim($params['userid']) : '';
        $pid = (!empty($params['pid'])) ? trim($params['pid']) : '';

        if ($userid == "" || $userid == null || $userid == "undefined") {
            $resp = array();
            $error = array('Code' => 1, 'Msg' => 'Invalid parameter');
            $res = array('results' => $resp, 'error' => $error);
            return $res;
        }

        $sql = "SELECT
                user_id as uid,
                 product_id as pid,
                 shipping_id as sid,
                (SELECT GROUP_CONCAT(user_name) FROM tbl_user_master WHERE user_id = uid ) AS usrname,
                (SELECT GROUP_CONCAT(logmobile) FROM tbl_user_master WHERE user_id = uid )AS usrmb,
                (SELECT GROUP_CONCAT(email) FROM tbl_user_master WHERE user_id = uid )AS usremail,
                (SELECT GROUP_CONCAT(address) FROM tbl_order_shipping_details WHERE shipping_id = sid )AS shpadd,
                (SELECT GROUP_CONCAT(city) FROM tbl_order_shipping_details WHERE shipping_id = sid )AS shpcity,
                (SELECT GROUP_CONCAT(state) FROM tbl_order_shipping_details WHERE shipping_id = sid )AS shpstate,
                (SELECT GROUP_CONCAT(pincode) FROM tbl_order_shipping_details WHERE shipping_id = sid )AS shppin
                    FROM tbl_order_master WHERE user_id='" . $params['userid'] . "' AND product_id='" . $params['pid'] . "' AND active_flag=1";
        $res = $this->query($sql);
        if ($res) {
            while ($row = $this->fetchData($res)) {
                $arr['uid'] = $row['uid'];
                $arr['sid'] = $row['sid'];
                $arr['name'] = $row['usrname'];
                $arr['mb'] = $row['usrmb'];
                $arr['email'] = $row['usremail'];
                $arr['address'] = $row['shpadd'];
                $arr['city'] = $row['shpcity'];
                $arr['state'] = $row['shpstate'];
                $arr['pincode'] = $row['shppin'];
                $arr['pid'] = $row['pid'];

                $reslt[] = $arr;
            }
            $err = array('Code' => 0, 'Msg' => 'Data fetched successfully');
        } else {
            $err = array('Code' => 1, 'Msg' => 'error in fetching detail');
        }
        $result = array('results' => $reslt, 'error' => $err);
        return $result;
    }

    public function createemailUrl($params) {

        $email = (!empty($params['email'])) ? trim(urldecode($params['email'])) : '';
        $url = (!empty($params['url'])) ? trim(urldecode($params['url'])) : '';

        if (empty($email)) {

            $error = array('err_code' => 1, 'err_msg' => 'parameters are missing');
            $result = array('result' => $resp, 'error' => $error);
            return $result;
        }

        $urlmaker = $this->generateURL(6);


        $isql = "   INSERT
                            INTO
                                    tbl_url_master
                                   (urlkey,
                                    user_id,
                                    logmobile,
                                    email,
                                    cPass_url,
                                    active_flag,
                                    created_date)
                            VALUES
                                    (\"" . $urlmaker . "\",
                                    \"" . $params['uid'] . "\",
                                    \"" . $params['mobile'] . "\",
                                    \"" . $params['email'] . "\",
                                    \"" . $params['url'] . "\",
                                        1,
                                        now()
                                    )";

        $res = $this->query($isql);
        $cntRes = $this->numRows($res);
        if ($cntRes == 0) {
            if ($res) {
                $sql = "    SELECT
                                       *
                                FROM
                                        tbl_url_master
                                WHERE
                                        urlkey =\"" . $urlmaker . "\"
                                AND
                                        active_flag=1";
                $urlgetRes = $this->query($sql);
                if ($urlgetRes) {

                    while ($urlgetRow = $this->fetchData($urlgetRes)) {
                        $arr[] = $urlgetRow;
                    }
                }

                $key = $arr[0]['urlkey'];
                //   print_r($arr[0]['urlkey']);
                /* while($urlgetRow = $this->fetchData($urlgetRes))
                  {

                  $reslt['uid'] = $row['user_id'];
                  $reslt['mob'] = $row['logmobile'];
                  $reslt['email'] = $row['email'];
                  // $reslt['key'] = $row['urlkey'];

                  $arr[] = $reslt;
                  } */

                //    $urlParm = "http://www.jeva.com?action=resetpassword&key=".$key."&userid=".$userid;
                //     $msg= '<a href='
                //         mail($key, $userid, $sql);

                $err = array('code' => 0, 'msg' => 'url is created');
            } else {
                $arr = array();
                $err = array('code' => 0, 'msg' => 'Error in url creation');
            }
        } else {
            $row = $this->fetchData($res);
            $arr = $row['urlkey'];
            $err = array('code' => 0, 'msg' => 'url is created');
        }
        $result = array('result' => $arr, 'error' => $err);
        return $result;
    }

    private function generateURL($strLength) {

        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for ($i = 0; $i <= $strLength; $i++) {
            $string = substr($chars, rand(6, strlen($chars)), 6);
        }
        $chkSql = " SELECT
                                urlkey
                        FROM
                                tbl_url_master
                        WHERE
                                urlkey = \"" . $string . "\"
                        AND
                                active_flag=1";
        $chkRes = $this->query($chkSql);
        $cntRes = $this->numRows($chkRes);
        if ($cntRes > 0) {
            $string = $this->generateURL(6);
        }
        return $string;
    }

    public function getUserdetailbymob($params) {
        $sql = "SELECT user_name as name,logmobile as mb,email,user_id from tbl_user_master WHERE logmobile='" . $params['mob'] . "' or email='" . $params['email'] . "'";
        $res = $this->query($sql);

        $result = array();
        if ($res) {
            $row = $this->fetchData($res);
            $result['mob'] = $row['mb'];
            $result['email'] = $row['email'];
            $result['user_id'] = $row['user_id'];
            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in fetching data');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function getUserDetailsbyinpt($params) {

        $email = (!empty($params['email'])) ? trim($params['email']) : '';
        $mobile = (!empty($params['mobile'])) ? trim($params['mobile']) : '';
        if (($email == "" || $email == null) && ($mobile == "" || $mobile == null)) {

            $resp = array();
            $error = array('Code' => 1, 'Msg' => 'Invalid parameter ');
            $res = array('results' => $resp, 'error' => $error);
            return $res;
        }

        $sql = "select user_id,user_name,logmobile,email,"
                . " (SELECT DISTINCT(cart_id) FROM tbl_cart_master WHERE userid =user_id AND active_flag=1) AS cart_id "
                . " from tbl_user_master ";
        $sql.="where logmobile='" . $params['mobile'] . "' OR email='" . $params['email'] . "'";

        $res = $this->query($sql);
        if ($res) {

            while ($row = $this->fetchData($res)) {
                $arr['user_id'] = $row['user_id'];
                $arr['user_name'] = $row['user_name'];
                $arr['logmobile'] = $row['logmobile'];
                $arr['email'] = $row['email'];
                $arr['cart_id'] = $row['cart_id'];
                $reslt[] = $arr;
            }
            $err = array('Code' => 0, 'Msg' => 'Data fetched successfully');
        } else {
            $err = array('Code' => 1, 'Msg' => 'error in fetching detail');
        }
        $result = array('results' => $reslt, 'error' => $err);
        return $result;
    }

    public function getallOrderDtails() {
        global $comm;
        $result = array();
        $sqlcount = "  SELECT
                                    count(product_id) AS  cnt
                                            FROM
                                     tbl_order_master
                                         WHERE
                                      active_flag NOT IN(2)";
        $rescnt = $this->query($sqlcount);
        $row = $this->fetchData($rescnt);
        $total = $row['cnt'];


        $sql = "SELECT
                        order_id as oid,
                        product_id as pid,
                        shipping_id as shpid,
                        (Select product_name from tbl_product_master where productid=pid) as pname,
                        user_id as uid,
                        (SELECT user_name from tbl_user_master WHERE user_id=uid) AS uname,
                        (SELECT logmobile from tbl_user_master WHERE user_id=uid) AS umobile,
                        (SELECT name from tbl_order_shipping_details WHERE user_id=uid and shipping_id=shpid) AS custname,
                        (SELECT mobile from tbl_order_shipping_details WHERE user_id=uid and shipping_id=shpid) AS custmob,
                        order_date as odate,
                        delivery_date as ddate,
                        order_status as ostatus,
                        active_flag as aflag,
                        price as price,
                        payment as pm,
                        col_car_qty,
                        size
                        FROM tbl_order_master WHERE  active_flag=1 order by createdon DESC";


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


        if ($res) {
            while ($row = $this->fetchData($res)) {
                $arr['oid'] = $row['oid'];
                $arr['pid'] = $row['pid'];
                $arr['pname'] = $row['pname'];
                $arr['uid'] = $row['uid'];
                $arr['shpid'] = $row['shpid'];
                $arr['uname'] = $row['uname'];
                $arr['umobile'] = $row['umobile'];
                $arr['ostatus'] = $row['ostatus'];
                $arr['aflag'] = $row['aflag'];
                $arr['price'] = $row['price'];
                $arr['custname'] = $row['custname'];
                $arr['custmob'] = $row['custmob'];
                $arr['pm'] = $row['pm'];
                $arr['col_car_qty'] = $row['col_car_qty'];
                $arr['size'] = $row['size'];
                $arr['odate'] = $comm->makeDate($row['odate']);
                $arr['ddate'] = $comm->makeDate($row['ddate']);
                $result[] = $arr;
            }

            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in fetching data');
        }
        $results = array('result' => $result, 'error' => $err, 'total' => $total);
        return $results;
    }

    public function orderTrack($params) {
        global $comm;

        $orderid = (!empty($params['orderid'])) ? trim($params['orderid']) : '';
        $pid = (!empty($params['pid'])) ? trim($params['pid']) : '';
        $combn = (!empty($params['combn'])) ? trim($params['combn']) : '';
        $size = (!empty($params['sz'])) ? trim($params['sz']) : '';

        $sql = "SELECT
                        order_id as oid,
                        product_id as pid,
                        col_car_qty as combine,
                        size,
                        shipping_id as shpid,
                        (Select product_seo_name from tbl_product_master where productid=pid) as pseoname,
                        user_id as uid,
                       
                        (SELECT name from tbl_order_shipping_details WHERE shipping_id=shpid) AS uname,
                        (SELECT mobile from tbl_order_shipping_details WHERE shipping_id=shpid) AS umobile,
                        (SELECT email from tbl_order_shipping_details WHERE shipping_id=shpid) AS usremail,
                         (SELECT address FROM tbl_order_shipping_details WHERE shipping_id = shpid )AS shpadd,
                        (SELECT city FROM tbl_order_shipping_details WHERE shipping_id = shpid )AS shpcity,
                        (SELECT state FROM tbl_order_shipping_details WHERE shipping_id = shpid )AS shpstate,
                        (SELECT pincode FROM tbl_order_shipping_details WHERE shipping_id = shpid )AS shppin,
                        order_date as odate,
                        delivery_date as ddate,
                        order_status as ostatus,
                        active_flag as aflag,
                        price as price,
                        payment as pm,
                        (Select payment_mode from tbl_transaction_master where order_id=oid) as paymode,
                        (SELECT transaction_id from tbl_transaction_master WHERE order_id=oid) AS transcId,
(SELECT  GROUP_CONCAT(product_name) FROM tbl_product_master WHERE productid = pid AND active_flag !=2 ) AS prdname,
(SELECT  GROUP_CONCAT(procurement_cost) FROM tbl_product_master WHERE productid = pid AND active_flag !=2 ) AS procurementcost,
(SELECT  GROUP_CONCAT(diamond_setting) FROM tbl_product_master WHERE productid = pid AND active_flag !=2 ) AS dmdsetting,
(SELECT  GROUP_CONCAT(certificate) FROM tbl_product_master WHERE productid = pid AND active_flag !=2 ) AS certificate,
(SELECT  GROUP_CONCAT(margin) FROM tbl_product_master WHERE productid = pid AND active_flag !=2 ) AS margin,
(SELECT  GROUP_CONCAT(measurement) FROM tbl_product_master WHERE productid = pid AND active_flag !=2 ) AS measurement,
(SELECT  GROUP_CONCAT(making_charges) FROM tbl_product_master WHERE productid = pid AND active_flag !=2 ) AS mkngchrg,

(SELECT  GROUP_CONCAT(vendorid) FROM tbl_product_master WHERE productid = pid AND active_flag !=2 ) AS vendid,
(SELECT GROUP_CONCAT(name) FROM tbl_vendor_master WHERE FIND_IN_SET(vendorid,vendid)) AS vendorname,

(SELECT  GROUP_CONCAT(product_weight) FROM tbl_product_master WHERE productid = pid AND active_flag !=2 ) AS prodwgt,
(SELECT  GROUP_CONCAT(product_code) FROM tbl_product_master WHERE productid = pid AND active_flag !=2 ) AS product_code,
(SELECT  GROUP_CONCAT(dname) FROM tbl_metal_color_master WHERE id = SUBSTRING_INDEX(combine, '|@|',1) AND active_flag !=2 ) AS color,
(SELECT  GROUP_CONCAT(dname) FROM tbl_metal_purity_master WHERE id = SUBSTRING_INDEX(SUBSTRING_INDEX(combine,'|@|',2),'|@|',-1) AND active_flag !=2 ) AS Metalcarat,
(SELECT  GROUP_CONCAT(dname) FROM tbl_diamond_quality_master WHERE id = SUBSTRING_INDEX(combine,'|@|',-1)  AND active_flag !=2 ) AS quality,
(SELECT  GROUP_CONCAT(jewelleryType) FROM tbl_product_master WHERE productid = pid  AND active_flag !=2)  AS jewelleryType,

(SELECT  GROUP_CONCAT(metal_weight) FROM tbl_product_master WHERE productid = pid  AND active_flag !=2)  AS metal_weight,
(SELECT GROUP_CONCAT(diamond_id) FROM tbl_product_diamond_mapping WHERE productid = pid AND active_flag = 1 ) AS allDimonds,
(SELECT GROUP_CONCAT(carat) FROM tbl_product_diamond_mapping WHERE FIND_IN_SET(diamond_id,allDimonds)) AS dmdcarat,
(SELECT GROUP_CONCAT(total_no) FROM tbl_product_diamond_mapping WHERE FIND_IN_SET(diamond_id,allDimonds)) AS totaldmd,
(SELECT GROUP_CONCAT(shape) FROM tbl_product_diamond_mapping WHERE FIND_IN_SET(diamond_id,allDimonds)) AS shape,
(SELECT GROUP_CONCAT(gemstone_id) FROM tbl_product_gemstone_mapping WHERE productid = pid AND active_flag = 1 ) AS allGemstone,
(SELECT GROUP_CONCAT(gemstone_name) FROM tbl_gemstone_master WHERE FIND_IN_SET(id,allGemstone)) AS gemstoneName,
(SELECT GROUP_CONCAT(carat) FROM tbl_product_gemstone_mapping WHERE FIND_IN_SET(gemstone_id,allGemstone) AND productid =pid) AS gemscarat ,
(SELECT GROUP_CONCAT(total_no) FROM tbl_product_gemstone_mapping WHERE FIND_IN_SET(gemstone_id,allGemstone) AND productid =pid) AS totalgems,
(SELECT GROUP_CONCAT(price_per_carat) FROM tbl_product_gemstone_mapping WHERE FIND_IN_SET(gemstone_id,allGemstone) AND productid =pid) AS gemsPricepercarat,

(SELECT GROUP_CONCAT(solitaire_id) FROM tbl_product_solitaire_mapping WHERE productid = pid AND active_flag = 1 ) AS allSolitaire,
(SELECT GROUP_CONCAT(no_of_solitaire) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS totalSolitaire,
(SELECT GROUP_CONCAT(carat) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS Solicarat,
(SELECT GROUP_CONCAT(price_per_carat) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS SoliPricepercarat,
 (SELECT GROUP_CONCAT(shape) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS solishape,
(SELECT GROUP_CONCAT(color) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS soliclr,
(SELECT GROUP_CONCAT(clarity) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS soliclar ,
(SELECT GROUP_CONCAT(cut) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS solicut ,
(SELECT GROUP_CONCAT(symmetry) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS solisymm,
(SELECT GROUP_CONCAT(polish) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS solipolish,
(SELECT GROUP_CONCAT(fluorescence) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS soliflrcnce,
(SELECT GROUP_CONCAT(table_no) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS solitblno,
(SELECT GROUP_CONCAT(crown_angle) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS solicrwnangle,
(SELECT GROUP_CONCAT(girdle) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS soligirdle,

(SELECT GROUP_CONCAT(uncut_id) FROM tbl_product_uncut_mapping WHERE productid = pid AND active_flag = 1 ) AS allUncut,
(SELECT GROUP_CONCAT(total_no) FROM tbl_product_uncut_mapping WHERE FIND_IN_SET(uncut_id,allUncut) AND productid =pid) AS totalUncut,
(SELECT GROUP_CONCAT(carat) FROM tbl_product_uncut_mapping WHERE FIND_IN_SET(uncut_id,allUncut) AND productid =pid) AS Uncutcarat,
(SELECT GROUP_CONCAT(price_per_carat) FROM tbl_product_uncut_mapping WHERE FIND_IN_SET(uncut_id,allUncut) AND productid =pid) AS UncutPricepercarat,
(SELECT GROUP_CONCAT(quality) FROM tbl_product_uncut_mapping WHERE FIND_IN_SET(uncut_id,allUncut) AND productid =pid) AS uncutqual,
(SELECT GROUP_CONCAT(color) FROM tbl_product_uncut_mapping WHERE FIND_IN_SET(uncut_id,allUncut) AND productid =pid) AS Uncutclr,

(SELECT GROUP_CONCAT(catid) FROM tbl_category_product_mapping WHERE  productid =pid ) AS ccatid,
(SELECT DISTINCT(NAME) FROM tbl_size_master WHERE  FIND_IN_SET(catid,ccatid) )AS ccatname,
(SELECT GROUP_CONCAT(cat_name) FROM tbl_category_master WHERE  FIND_IN_SET(catid,ccatid) )AS catgryname,
                      
                        (SELECT  GROUP_CONCAT(product_image) FROM tbl_product_image_mapping WHERE product_id = pid  AND active_flag !=2) AS prdimage,
                        (SELECT GROUP_CONCAT(product_image) FROM tbl_product_image_mapping WHERE product_id = pid AND active_flag = 1 AND  default_img_flag=1) AS default_img
                        FROM tbl_order_master WHERE order_id=" . $params['orderid'] . " AND product_id= " . $params['pid'] . " AND col_car_qty='" . $params['combn'] . "' AND size=" . $params['sz'];

        $res = $this->query($sql);


        if ($res) {
            while ($row = $this->fetchData($res)) {
                $arr['oid'] = $row['oid'];
                $arr['pid'] = $row['pid'];
                $arr['col_car_qty'] = $row['combine'];
                $arr['sz'] = $row['size'];
                $arr['shpid'] = $row['shpid'];
                $arr['prdSeo'] = $row['pseoname'];
                $arr['proccost'] = $row['procurementcost'];
                $arr['vendid'] = $row['vendid'];
                $arr['vendorname'] = $row['vendorname'];
                $arr['prodwgt'] = $row['prodwgt'];
                $arr['dmdsetting'] = $row['dmdsetting'];
                $arr['certificate'] = $row['certificate'];
                $arr['margin'] = $row['margin'];
                $arr['measurement'] = $row['measurement'];
                $arr['mkngchrg'] = $row['mkngchrg'];
                $arr['uid'] = $row['uid'];
                $arr['uname'] = $row['uname'];
                $arr['umobile'] = $row['umobile'];
                $arr['odate'] = $comm->makeDate($row['odate']);
                $arr['ddate'] = $comm->makeDate($row['ddate']);
                $arr['ostatus'] = $row['ostatus'];
                $arr['aflag'] = $row['aflag'];
                $arr['price'] = $row['price'];
                $arr['pm'] = $row['pm'];
                $arr['paymode'] = $row['paymode'];
                $arr['transcId'] = $row['transcId'];
                $arr['prdname'] = $row['prdname'];
                $arr['prdcode'] = $row['product_code'];
                $arr['defimg'] = $row['default_img'];
                $arr['catgryname'] = $row['catgryname'];



                $arr['prdimg'] = $row['prdimage'];
                $arr['color'] = $row['color'];
                $arr['Metalcarat'] = $row['Metalcarat'];
                $arr['quality'] = $row['quality'];
                $arr['jwelType'] = $row['jewelleryType'];
                $arr['mtlwgt'] = $row['metal_weight'];
                $arr['alldmd'] = $row['allDimonds'];
                $arr['dmdcarat'] = $row['dmdcarat'];
                $arr['totdmd'] = $row['totaldmd'];
                $arr['dmdshape'] = $row['shape'];
                $arr['allgems'] = $row['allGemstone'];

                $arr['gemstoneName'] = $row['gemstoneName'];

                $arr['totalgems'] = $row['totalgems'];
                $arr['gemscarat'] = $row['gemscarat'];
                $arr['gemsPricepercarat'] = $row['gemsPricepercarat'];

                $arr['allSolit'] = $row['allSolitaire'];
                $arr['totalSolit'] = $row['totalSolitaire'];
                $arr['Solicarat'] = $row['Solicarat'];
                $arr['SoliPricepercarat'] = $row['SoliPricepercarat'];
                $arr['solishape'] = $row['solishape'];
                $arr['soliclr'] = $row['soliclr'];
                $arr['soliclar'] = $row['soliclar'];
                $arr['solicut'] = $row['solicut'];
                $arr['solisymm'] = $row['solisymm'];
                $arr['solipolish'] = $row['solipolish'];
                $arr['soliflrcnce'] = $row['soliflrcnce'];
                $arr['solitblno'] = $row['solitblno'];
                $arr['solicrwnangle'] = $row['solicrwnangle'];
                $arr['soligirdle'] = $row['soligirdle'];

                $arr['allUncut'] = $row['allUncut'];
                $arr['totalUncut'] = $row['totalUncut'];
                $arr['Uncutcarat'] = $row['Uncutcarat'];
                $arr['UncutPricepercarat'] = $row['UncutPricepercarat'];
                $arr['uncutqual'] = $row['uncutqual'];
                $arr['Uncutclr'] = $row['Uncutclr'];

                $arr['ccatid'] = $row['ccatid'];
                $arr['ccatname'] = $row['ccatname'];

                $arr['email'] = $row['usremail'];
                $arr['address'] = $row['shpadd'];
                $arr['city'] = $row['shpcity'];
                $arr['state'] = $row['shpstate'];
                $arr['pincode'] = $row['shppin'];

                $result[] = $arr;
            }

            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in fetching data');
        }


        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function frgotpassotpTemplate($uname, $otp, $gnd) {
        if ($gnd == 1)
            $gndr = "Ms";
        else if ($gnd == 2)
            $gndr = "Mr";
        else if ($gnd == 3)
            $gndr = "Mrs";
        else
            $gndr = "Dear";

        $message = '<html>
		    <head>
			<title>otp email</title>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<style>
			    *{box-sizing:border-box;padding:0;margin:0;}
			</style>
		    </head>
		    <body>
			<div style="width:100%;height:100%;background-color:#f3f3f3;padding-top:30px;padding-bottom:30px;font-family:sans-serif">
			    <div style="width:100%;height:auto;margin:auto;max-width:750px">
				<div style="width:100%;height:auto;margin-bottom: 30px;">
				    <div style="width:150px;height:auto;margin:auto">
					<img src="' . DOMAIN . 'frontend/emailer/jzeva_logo.png" alt="JZEVA" width="150" height="50">
				    </div>
				</div>
				<div style="width:100%;height:auto;background-color:#fff;padding:25px;min-height:300px;padding-bottom:0px;box-sizing:border-box;">
				    <div style="width:100%;height:auto;margin-bottom:30px;">
					<div style="width:70px;height:60px;margin:auto">
					    <img src="' . DOMAIN . 'frontend/emailer/otp.png" alt="img" width="70" height="60">
					</div>
				    </div>
				    <div style="width:100%;height:auto;font-size:20px;color:#0CCDB8;text-align:center;line-height:25px"> ' . $gndr . '. ' . $uname . '</div>
				    <div style="width: 100%;height: auto;font-size: 13px;text-align: center;color: #333;line-height: 25px;margin-top: 10px;letter-spacing: 0.1em;"><span style="display:inline-block;line-height:25px;vertical-align:middle">THANK YOU FOR YOUR INTEREST IN JZEVA</span></div>
				    <div style="width:100%;height:auto;font-size:14px;color:#333;text-align:center;line-height:25px;padding-top:10px;">We are glad to assist you in changing the password of your jzeva account</div>
				    <div style="width:100%;height:auto;font-size:14px;color:#333;text-align:center;line-height:25px;padding-top:10px;"><span style="display:inline-block;line-height:25px;vertical-align:middle">Please use the OTP sent in this email to proceed with changing your password</span></div>
				    <div style="width:100%;height:auto;font-size:45px;line-height:50px;color:#0CCDB8;text-align:center;margin-top: 10px;">' . $otp . '</div>
				    <div style="width:100%;height:auto;padding:20px 25px;background-color:#222529;margin-top:25px;box-sizing:border-box;">
					<div style="width:100%;height:auto;font-size:12px;color:#fff;text-align:center;line-height:20px;margin-top:10px;">Should you have any question or require our assistance, our concierege services desk is available at</div>
					<div style="width:100%;height:auto;font-size:12px;line-height:20px;color:#0CCDB8;text-align:center;margin-top:7px"><span style="display:inline-block;line-height:25px;vertical-align:middle">Call +91 7022248707 | Email <a href="" style="color:#0CCDB8;text-decoration:none">care@jzeva.com</a></span></div>
					<div style="width:100%;height:auto;font-size:11px;line-height:25px;color:#999;text-align:center;margin-top: 4px;margin-bottom: 1px;text-decoration:none;"><span style="display:inline-block;line-height:25px;vertical-align:middle">( Monday to Saturday 10AM - 9PM IST )</span></div>
				    </div>
				</div>
				<div style="width:100%;height:auto;padding:0px 25px 25px 25px;background-color:#15181b;min-height:200px;box-sizing:border-box;">
				    <div style="width:100%;height:auto;padding:0px 25px 20px 25px;background-color:#222529;box-sizing:border-box;">
					<div style="width:100%;height:auto;font-size:12px;color:#fff;text-align:center;line-height:25px;">We look forward to serving you in the future. Happy Shopping!!!</div>
					 <div style="width:100%;height:auto;font-size:13px;color:#fff;text-align:center;line-height:25px;margin-top: 25px;">Yours Truly</div>
					  <div style="width:100%;height:auto;font-size:14px;color:#fff;text-align:center;line-height:20px; margin-bottom: 15px;">JZEVA</div>
				    </div>
				    <div style="width:100%;height:auto;margin-top:50px;margin-bottom:15px">
					<center>
					<a href style="text-decoration:none"><div style="width:100%;cursor:pointer;color:#0CCDB8;display:inline-block;vertical-align:top;font-size:9px;padding:0px 5px;line-height:16px;height:25px">FOLLOW US</div></a><a href="https://www.facebook.com/JzevaLuxury/?fref=ts" style="text-decoration:none"><div style="width:auto;cursor:pointer;padding:0px 5px;color:#fff;display:inline-block;vertical-align:top;font-size:9px;line-height:16px;border-right:1px solid #fff;letter-spacing:0.02em;height:16px">FACEBOOK</div></a><a href="https://www.instagram.com/jzevaluxury/" style="text-decoration:none"><div style="width:auto;cursor:pointer;padding:0px 5px;color:#fff;display:inline-block;vertical-align:top;font-size:9px;line-height:16px;border-right:1px solid #fff;letter-spacing:0.02em;height:16px">INSTAGRAM</div></a><a href="https://in.pinterest.com/JzevaLuxury/" style="text-decoration:none"><div style="width:auto;cursor:pointer;padding:0px 5px;color:#fff;display:inline-block;vertical-align:top;font-size:9px;line-height:16px;letter-spacing:0.02em;height:16px">PINTEREST</div></a>
					</center>
				    </div>
				    <div style="width:100%;height:auto;font-size:12px;color:#999;line-height:25px;text-align:center;margin-top:30px">You are receiving this email in response to an order or request you submitted to  <a href="" style="color:#999;text-decoration:none !important">www.jzeva.com</a></div>
				    <div style="width:100%;height:auto;font-size:12px;color:#999;line-height:25px;text-align:center;margin-bottom: 30px;">Please visit <a href="" style="color:#999;text-decoration:none !important">www.jzeva.com</a> to consult our privacy policy and condition of sale.</div>
				</div>
			    </div>
			</div>
		    </body>
		</html>';

 
        return $message;
    }

    public function checkusertype($params) {
        $userid = (!empty($params['userid'])) ? trim($params['userid']) : '';

        if (($userid == "" || $userid == null)) {

            $resp = array();
            $error = array('Code' => 1, 'Msg' => 'Invalid parameter ');
            $res = array('results' => $resp, 'error' => $error);
            return $res;
        }

        $sql = "select is_vendor "
                . " from tbl_user_master where user_id=" . $params['userid'] . "";

        $res = $this->query($sql);
        if ($res) {

            $row = $this->fetchData($res);
            $result['is_vendor'] = $row['is_vendor'];
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in fetching data');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function getshipdatabyshipid($params) {

        $shpid = (!empty($params['shpid'])) ? trim($params['shpid']) : '';

        if ($shpid == "" || $shpid == null) {
            $resp = array();
            $error = array('Code' => 1, 'Msg' => 'Invalid parameter');
            $res = array('results' => $resp, 'error' => $error);
            return $res;
        }

        $sql = "SELECT
                       user_id ,
                       shipping_id ,
                  		 name,
                  		 mobile,
                  		 email,
                  		 city,
                  		 address,
                  		 state,
                       gender,
                  		 pincode
                FROM
                      tbl_order_shipping_details
                WHERE
                      shipping_id='" . $shpid . "' AND active_flag=1";
        $res = $this->query($sql);
        if ($res) {
            while ($row = $this->fetchData($res)) {
                $arr['user_id'] = $row['user_id'];
                $arr['shipping_id'] = $row['shipping_id'];
                $arr['name'] = $row['name'];
                $arr['mobile'] = $row['mobile'];
                $arr['email'] = $row['email'];
                $arr['city'] = $row['city'];
                $arr['address'] = $row['address'];
                $arr['state'] = $row['state'];
                $arr['pincode'] = $row['pincode'];
                $arr['gender'] = $row['gender'];

                $reslt = $arr;
            }
            $err = array('Code' => 0, 'Msg' => 'Data fetched successfully');
        } else {
            $err = array('Code' => 1, 'Msg' => 'error in fetching detail');
        }
        $result = array('results' => $reslt, 'error' => $err);
        return $result;
    }

    public function OrderDetailsbyordid($params) {
        global $comm;
        if (empty($params['orderid'])) {
            $reslt = array();
            $error = array('err_code' => 1, 'err_msg' => ' Parameter missing');
            $result = array('result' => $reslt, 'error' => $error, '');
            return $result;
        }


        $sql = "SELECT
                            order_id AS oid,
                            product_id AS pid,
                            user_id AS uid,
                            shipping_id AS shpId,
                            col_car_qty AS combine,
                            size,
                            pqty,
                            price,

                            (SELECT name FROM tbl_order_shipping_details WHERE shipping_id=shpId) AS uname,
			    (SELECT gender FROM tbl_order_shipping_details WHERE shipping_id=shpId) AS gender,
                            (SELECT mobile FROM tbl_order_shipping_details WHERE shipping_id=shpId) AS mobile,
                            (SELECT email FROM tbl_order_shipping_details WHERE shipping_id=shpId) AS email,
                            (SELECT city FROM tbl_order_shipping_details WHERE shipping_id=shpId) AS customerCity,
			    (SELECT state FROM tbl_order_shipping_details WHERE shipping_id=shpId) AS customerState,
			    (SELECT pincode FROM tbl_order_shipping_details WHERE shipping_id=shpId) AS customerPincode,
			    (SELECT address FROM tbl_order_shipping_details WHERE shipping_id=shpId) AS customerAddrs,
			    (SELECT transaction_id FROM tbl_transaction_master WHERE order_id=oid) AS transactionid,
			    (SELECT payment_mode FROM tbl_transaction_master WHERE order_id=oid) AS transactiontype,
			    (SELECT product_name FROM tbl_product_master WHERE productid=pid) AS prd_name,
			    (SELECT product_code FROM tbl_product_master WHERE productid=pid) AS prd_code,
			    (SELECT  GROUP_CONCAT(dname) FROM tbl_metal_color_master WHERE id = SUBSTRING_INDEX(combine, '|@|',1) AND active_flag = 1 ) AS color,
			    (SELECT  GROUP_CONCAT(dname) FROM tbl_metal_purity_master WHERE id = SUBSTRING_INDEX(SUBSTRING_INDEX(combine,'|@|',2),'|@|',-1) AND active_flag = 1 ) AS carat,
			    (SELECT  GROUP_CONCAT(dname) FROM tbl_diamond_quality_master WHERE id = SUBSTRING_INDEX(combine,'|@|',-1)  AND active_flag = 1 ) AS quality,
			    (SELECT GROUP_CONCAT(catid) FROM tbl_category_product_mapping WHERE  productid =pid ) AS ccatid,
			    (SELECT DISTINCT(NAME) FROM tbl_size_master WHERE  FIND_IN_SET(catid,ccatid) )AS ccatname,
			    (SELECT  GROUP_CONCAT(metal_weight) FROM tbl_product_master WHERE productid = pid  AND active_flag =1) AS metal_weight,
			    (SELECT GROUP_CONCAT(diamond_id) FROM tbl_product_diamond_mapping WHERE productid = pid AND active_flag = 1 ) AS allDimonds,
			    (SELECT GROUP_CONCAT(carat) FROM tbl_product_diamond_mapping WHERE FIND_IN_SET(diamond_id,allDimonds)) AS dmdcarat,
			    (SELECT invoice_id FROM tbl_invoice_master WHERE order_id=oid) AS invoiceno,
			    
			    price/pqty as basic_prz,
			    order_date AS orddt,
                            delivery_date AS deldt,
                            order_status AS ordsta,
                            active_flag AS actflg,
                            payment AS pay
                            FROM tbl_order_master WHERE order_id = " . $params['orderid'] . " AND active_flag=1";

        $res = $this->query($sql);

        if ($res) {
            $totalprice = 0;
            while ($row = $this->fetchData($res)) {

                $reslt['oid'] = ($row['oid'] != NULL) ? $row['oid'] : '';
                $reslt['pid'] = ($row['pid'] != NULL) ? $row['pid'] : '';
                $reslt['uid'] = ($row['uid'] != NULL) ? $row['uid'] : '';
                $reslt['uname'] = ($row['uname'] != NULL) ? $row['uname'] : '';
                $reslt['gender'] = ($row['gender'] != NULL) ? $row['gender'] : '';
                $reslt['mobile'] = ($row['mobile'] != NULL) ? $row['mobile'] : '';
                $reslt['email'] = ($row['email'] != NULL) ? $row['email'] : '';
                $reslt['orddt'] = $comm->makeDate($row['orddt']);
                $reslt['deldt'] = $comm->makeDate($row['deldt']);
                $reslt['actflg'] = ($row['actflg'] != NULL) ? $row['actflg'] : '';
                $reslt['ppri'] = ($row['price'] != NULL) ? $row['price'] : '';
                $reslt['size'] = ($row['size'] != NULL) ? $row['size'] : '';
                $reslt['pqty'] = ($row['pqty'] != NULL) ? $row['pqty'] : '';
                $reslt['pay'] = ($row['pay'] != NULL) ? $row['pay'] : '';
                $reslt['ucity'] = ($row['customerCity'] != NULL) ? $row['customerCity'] : '';
                $reslt['ustate'] = ($row['customerState'] != NULL) ? $row['customerState'] : '';
                $reslt['upin'] = ($row['customerPincode'] != NULL) ? $row['customerPincode'] : '';
                $reslt['uaddres'] = ($row['customerAddrs'] != NULL) ? $row['customerAddrs'] : '';
                $reslt['transactionid'] = ($row['transactionid'] != NULL) ? $row['transactionid'] : '';
                $reslt['transactiontype'] = ($row['transactiontype'] != NULL) ? $row['transactiontype'] : '';
                $reslt['prd_name'] = ($row['prd_name'] != NULL) ? $row['prd_name'] : '';
                $reslt['prd_code'] = ($row['prd_code'] != NULL) ? $row['prd_code'] : '';
                $reslt['color'] = ($row['color'] != NULL) ? $row['color'] : '';
                $reslt['carat'] = ($row['carat'] != NULL) ? $row['carat'] : '';
                $reslt['quality'] = ($row['quality'] != NULL) ? $row['quality'] : '';
                $reslt['ccatname'] = ($row['ccatname'] != NULL) ? $row['ccatname'] : '';
                $reslt['metal_weight'] = ($row['metal_weight'] != NULL) ? $row['metal_weight'] : '';
                $reslt['dmdcarat'] = ($row['dmdcarat'] != NULL) ? $row['dmdcarat'] : '';
                $reslt['basic_prz'] = ($row['basic_prz'] != NULL) ? $row['basic_prz'] : '';
                $reslt['invoiceno'] = ($row['invoiceno'] != NULL) ? $row['invoiceno'] : '';


                $resp[] = $reslt;
                $totalprice+=($row['price'] != NULL) ? $row['price'] : '';
            }
            $error = array('err_code' => 0, 'err_msg' => ' Data fetched successfully ');
        } else {
            $error = array('err_code' => 1, 'err_msg' => ' Error In Fetching Data ');
        }



        $result = array('result' => $resp, 'error' => $error, 'totalprice' => $totalprice);
        return $result;
    }

    public function checktrackord($params) {

        if (empty($params['orderid'])) {
            $res = array();
            $err = array('error_code' => 1, 'err_msg' => 'Parameter Missing');
            $result = array('relust' => $res, 'error' => $err);
            return $result;
        }

        $sql = "SELECT
			  DISTINCT(order_id)
		    FROM
			  tbl_order_master
		    WHERE
			  order_id=" . $params['orderid'] . "
		    AND
			  active_flag=1
		    AND
			  shipping_id IN (SELECT
						shipping_id
					  FROM
						  tbl_order_shipping_details
					  WHERE
						   ";

        if (!empty($params['mobile'])) {
            $sql.=" mobile=" . $params['mobile'] . ") ";
        } else if (!empty($params['email'])) {
            $sql.=" email='" . $params['email'] . "' )";
        }

        $res = $this->query($sql);
        $row = $this->fetchData($res);

        if ($res) {
            if ($this->numRows($res) > 0) {
                $reslt['order_id'] = $row['order_id'];
                $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
            } else
                $err = array('err_code' => 1, 'err_msg' => 'Please Enter Correct Data');
        }
        else {
            $err = array('err_code' => 2, 'err_msg' => 'Error in fetching data');
        }
        $result = array();
        $results = array('result' => $reslt, 'error' => $err);
        return $results;
    }

    public function gettrackordrdetail($params) {

        if (empty($params['orderid'])) {
            $res = array();
            $err = array('error_code' => 1, 'err_msg' => 'Parameter Missing');
            $result = array('relust' => $res, 'error' => $err);
            return $result;
        }

        $sql = " SELECT
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


			    (SELECT  GROUP_CONCAT(dname) FROM tbl_metal_color_master WHERE id = SUBSTRING_INDEX(combine, '|@|',1) AND active_flag !=2 ) AS color,
			    (SELECT  GROUP_CONCAT(dname) FROM tbl_metal_purity_master WHERE id = SUBSTRING_INDEX(SUBSTRING_INDEX(combine,'|@|',2),'|@|',-1) AND active_flag !=2 ) AS Metalcarat,
			    (SELECT  GROUP_CONCAT(dname) FROM tbl_diamond_quality_master WHERE id = SUBSTRING_INDEX(combine,'|@|',-1)  AND active_flag !=2 ) AS quality,
			    (SELECT  GROUP_CONCAT(jewelleryType) FROM tbl_product_master WHERE productid = pid  AND active_flag !=2) AS jewelleryType,
                            (SELECT GROUP_CONCAT(catid) FROM tbl_category_product_mapping WHERE  productid =pid ) AS ccatid,
			    (SELECT DISTINCT(NAME) FROM tbl_size_master WHERE  FIND_IN_SET(catid,ccatid) )AS ccatname,
			    (SELECT  GROUP_CONCAT(metal_weight) FROM tbl_product_master WHERE productid = pid  AND active_flag !=2)                            AS metal_weight,
			    (SELECT  GROUP_CONCAT(carat) FROM tbl_product_diamond_mapping WHERE productid = pid AND active_flag !=2 ) AS dmdcarat,
			    (SELECT  GROUP_CONCAT(product_code) FROM tbl_product_master WHERE productid = pid AND active_flag !=2 ) AS product_code,

			     (SELECT GROUP_CONCAT(shipping_id) FROM tbl_order_shipping_details WHERE shipping_id = shpId) AS shipngDet,
			     (SELECT gender FROM tbl_order_shipping_details WHERE shipping_id = shpId) AS gender,
			     (SELECT GROUP_CONCAT(name) FROM tbl_order_shipping_details WHERE FIND_IN_SET(shipping_id,shipngDet)) AS customername,
			     (SELECT GROUP_CONCAT(mobile) FROM tbl_order_shipping_details WHERE FIND_IN_SET(shipping_id,shipngDet)) AS customerMob,
			     (SELECT GROUP_CONCAT(city) FROM tbl_order_shipping_details WHERE FIND_IN_SET(shipping_id,shipngDet)) AS customerCity,
			     (SELECT GROUP_CONCAT(state) FROM tbl_order_shipping_details WHERE FIND_IN_SET(shipping_id,shipngDet)) AS customerState,
			     (SELECT GROUP_CONCAT(pincode) FROM tbl_order_shipping_details WHERE FIND_IN_SET(shipping_id,shipngDet)) AS customerPincode,
			     (SELECT GROUP_CONCAT(address) FROM tbl_order_shipping_details WHERE FIND_IN_SET(shipping_id,shipngDet)) AS customerAddrs,
			     (SELECT GROUP_CONCAT(product_image) FROM tbl_product_image_mapping WHERE product_id = pid AND active_flag = 1 AND  default_img_flag=1) AS default_image

	      FROM tbl_order_master WHERE order_id= " . $params['orderid'] . " AND active_flag = 1 ";

        $res = $this->query($sql);


        if ($res) {
            $prztotal = 0;
            while ($row = $this->fetchData($res)) {

                $reslt['oid'] = ($row['oid'] != null) ? $row['oid'] : '';
                $reslt['pid'] = ($row['pid'] != NULL) ? $row['pid'] : '';
                $reslt['uid'] = ($row['uid'] != NULL) ? $row['uid'] : '';
                $reslt['prdSeoname'] = ($row['prdSeoname'] != NULL) ? $row['prdSeoname'] : '';
                $reslt['shipping_id'] = ($row['shipping_id'] != NULL) ? $row['shipping_id'] : '';
                $reslt['col_car_qty'] = ($row['col_car_qty'] != NULL) ? $row['col_car_qty'] : '';
                $reslt['size'] = ($row['size'] != NULL) ? $row['size'] : '';
                $reslt['color'] = ($row['color'] != NULL) ? $row['color'] : '';
                $reslt['Metalcarat'] = ($row['Metalcarat'] != NULL) ? $row['Metalcarat'] : '';
                $reslt['quality'] = ($row['quality'] != NULL) ? $row['quality'] : '';
                $reslt['pqty'] = ($row['pqty'] != NULL) ? $row['pqty'] : '';
                $reslt['price'] = ($row['price'] != NULL) ? $row['price'] : '';
                $reslt['cartid'] = ($row['cartid'] != NULL) ? $row['cartid'] : '';
                $reslt['jewelleryType'] = ($row['jewelleryType'] != NULL) ? $row['jewelleryType'] : '';
                $reslt['ccatid'] = $row['ccatid'];
                $reslt['ccatname'] = $row['ccatname'];
                $reslt['metal_weight'] = $row['metal_weight'];
                $reslt['dmdcarat'] = $row['dmdcarat'];
                $reslt['product_code'] = ($row['product_code'] != NULL) ? $row['product_code'] : '';

                if ($row['jewelleryType'] === '1') {
                    $reslt['jewelType'] = 'Gold';
                } else if ($row['jewelleryType'] === '2') {
                    $reslt['jewelType'] = 'Plain Gold';
                } else if ($row['jewelleryType'] === '3') {
                    $reslt['jewelType'] = 'Platinum';
                }

                $reslt['order_date'] = ($row['order_date']);
                $reslt['updatedon'] = ($row['updatedon']);
                $reslt['order_status'] = ($row['order_status'] != NULL) ? $row['order_status'] : '';
                $reslt['active_flag'] = ($row['active_flag'] != NULL) ? $row['active_flag'] : '';
                $reslt['product_price'] = ($row['product_price'] != NULL) ? $row['product_price'] : '';
                $reslt['payment'] = ($row['payment'] != NULL) ? $row['payment'] : '';
                $reslt['payment_type'] = ($row['payment_type'] != NULL) ? $row['payment_type'] : '';
                $reslt['prdimage'] = ($row['prdimage'] != NULL) ? $row['prdimage'] : '';
                $reslt['prdname'] = ($row['prdname'] != NULL) ? $row['prdname'] : '';
                $reslt['product_code'] = ($row['product_code'] != NULL) ? $row['product_code'] : '';

                $reslt['shipngDet'] = ($row['shipngDet'] != NULL) ? $row['shipngDet'] : '';
                $reslt['gender'] = ($row['gender'] != NULL) ? $row['gender'] : '';
                $reslt['customername'] = ($row['prdimage'] != NULL) ? $row['customername'] : '';
                $reslt['customerMob'] = ($row['prdname'] != NULL) ? $row['customerMob'] : '';
                $reslt['customerCity'] = ($row['product_code'] != NULL) ? $row['customerCity'] : '';
                $reslt['customerState'] = ($row['shipngDet'] != NULL) ? $row['customerState'] : '';
                $reslt['customerPincode'] = ($row['prdimage'] != NULL) ? $row['customerPincode'] : '';
                $reslt['customerAddrs'] = ($row['prdname'] != NULL) ? $row['customerAddrs'] : '';
                $reslt['default_image'] = $row['default_image'];
                $reslt['prc'] = $row['prc'];
                $reslt['cnt'] = $row['cnt'];



                if ($row['payment_type'] == '0') {
                    $reslt['payment_type'] = 'Credit Card';
                } else if ($row['payment_type'] == '1') {
                    $reslt['payment_type'] = 'Debit Card';
                } else if ($row['payment_type'] == '2') {
                    $reslt['payment_type'] = 'Net Banking';
                } else if ($row['payment_type'] == '3') {
                    $reslt['payment_type'] = 'EMI';
                } else if ($row['payment_type'] == '4') {
                    $reslt['payment_type'] = 'COD';
                }

                $resp[] = $reslt;
                $prztotal+=$reslt['price'];
            }
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in fetching data');
        }
        $results = array('result' => $resp, 'error' => $err, 'total' => $prztotal);
        return $results;
    }

}

?>
