<?php
    include_once APICLUDE . 'common/db.class.php';

    class user extends DB {

        function __construct($db) {
            parent::DB($db);
        }
        
        
        public function addUser()
        {
            global $comm;
            #$params= (json_decode($params[0],1));
            #$params=array('userid'=>'9320160321210137','name'=>'Shubham Gupta','pass'=>'123456','mobile'=>'8767194606','email'=>'shubham@xelpmoc.in','city'=>'Mumbai');
            $params=array('name'=>'Ankur Gala','pass'=>'123456','mobile'=>'1234567899','email'=>'ankurgala@xelpmoc.in','city'=>'Mumbai','address'=>'#657, 5th A Cross, 17th E Main Road,Koramangala 6th Block,Bangalore – 560095','gender'=>1);
            
            
        //echo "<pre>";print_r($params); echo "<pre>";print_r(json_encode($params));  die;
            
            
            $name = (!empty($params['name'])) ? trim($params['name']) : '';
            $mobile = (!empty($params['mobile'])) ? trim($params['name']) : '';
            $pass = (!empty($params['pass'])) ? trim($params['pass']) : '';
            $email = (!empty($params['email'])) ? trim($params['email']) : '';
            
            
            if((empty($name)) || (empty($mobile)) || (empty($pass)) || (empty($email)))
            {
                $resp = array();
                $error = array('errCode' => 1, 'errMsg' => 'Parameter Missing');
                $result = array('results' => $resp, 'error' => $error);
                return $result;
            }
            
            
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
                    . ",\"" . $params['gender'] . "\""
                    . ",\"" . 1 . "\")"
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
        
        public function geOrderList()
        {
            
            $sql="SELECT order_id as oid from tbl_order_master";
            $res=$this->query($sql);
            if($res)
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
                $err = array('err_code' => 1, 'err_msg' => 'Error in fetching data');
            }
            $results = array('result' => $result, 'error' => $err);
            return $results;
        }
        
        
        public function getUserList()
        {
            
            $sql="SELECT user_id as uid,user_name as name, logmobile as mb,email as em,address as address , (SELECT count(order_id)  FROM tbl_order_master WHERE  user_id= uid  AND order_status < 6) AS openOrd ,(SELECT count(order_id)  FROM tbl_order_master WHERE  user_id= uid  AND order_status = 6) AS pastOrd  FROM tbl_user_master";
            $res=$this->query($sql);
            
            if($res)
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
            
            
    }
    
    
    
    
?>