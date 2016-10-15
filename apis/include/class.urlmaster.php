<?php

     include_once APICLUDE . 'common/db.class.php';
    
    class urlmaster extends DB{
        
        function __construct($db) {
            parent::DB($db);
        }
        
  
        public function changePassUrl($params)
        {
          
        $mobile=(!empty($params['mobile'])) ? trim($params['mobile']) : '';
        $email=(!empty($params['email'])) ? trim(urldecode($params['email'])) : '';
        $uid=(!empty($params['uid'])) ? trim($params['uid']) : '';
        $url=(!empty($params['url'])) ? trim(urldecode($params['url'])) : '';
        
         if((empty($email) && empty($mobile)) ||empty($uid)){
                
                $error = array('err_code'=>1, 'err_msg'=>'parameters are missing');
                $result = array('result'=>$resp, 'error'=>$error);
                return $result;
            }
       
            $urlmaker = $this->generateURL(6);
              
            
                $isql = "   INSERT
                            INTO
                                    tbl_url_master
                                   (urlkey,
                                    user_id,
                                    mobile,
                                    email,
                                    cPass_url,
                                    active_flag,
                                    created_date)
                            VALUES
                                    (\"".$urlmaker."\",
                                    \"".$params['uid']."\",    
                                    \"".$params['mobile']."\",
                                    \"".$params['email']."\",
                                    \"".$params['url']."\",
                                        1,
                                        now()
                                    )";
                $res = $this->query($isql);
		$cntRes=$this->numRows($res);
		if($cntRes == 0)
		{
                if($res)
                {
                    $sql = "    SELECT
                                       *
                                FROM 
                                        tbl_url_master
                                WHERE 
                                        urlkey =\"".$urlmaker."\"
                                AND
                                        active_flag=1";
                    $urlgetRes = $this->query($sql);
                    if($urlgetRes)
                    {
                        
                        while($urlgetRow = $this->fetchData($urlgetRes))
                        {
                            $arr[] = $urlgetRow;
                        }
                    }
                       /* while($urlgetRow = $this->fetchData($urlgetRes))
                        {
                            
                        $reslt['uid'] = $row['user_id'];
                        $reslt['mob'] = $row['logmobile'];
                        $reslt['email'] = $row['email'];
                       // $reslt['key'] = $row['urlkey'];
                           
                            $arr[] = $reslt;
                        }
                     // $urlParm = 'http://www.jeva.com?action=resetpassword&key='.$key.'&userid='$userid;
                       // $msg= '<a href='
                      //  mail($key, $userid, $sql)*/
                    
                    $err = array('code'=>0,'msg'=>'url is created');
                }
                else
                {
                    $arr = array();
                    $err = array('code'=>0,'msg'=>'Error in url creation');
                }
            }
            else
            {
                $row = $this->fetchData($res); 
                $arr = $row['urlkey'];
                $err = array('code'=>0,'msg'=>'url is created');
            }
            $result = array('result'=>$arr,'error'=>$err);
            return $result;
        }
        
        public function getUserDet($params)
        {
            $url=(!empty($params['key'])) ? trim($params['key']) : '';
        if(empty($url))
        {
           // $arr = array();
           $error = array('err_code'=>1, 'err_msg'=>' parameters are missing');
           $result = array('result'=>$resp, 'error'=>$error);
           return $result;
           
        }
            $sql = "SELECT
                            user_id
                    FROM 
                            tbl_url_master
                    WHERE
                            urlkey = \"".$params['key']."\"
                    AND
                            DATE_SUB(`update_date`,INTERVAL - 30 MINUTE) > now()
                    AND
                            active_flag=1";
            $res = $this->query($sql);
            $cntRes = $this->numRows($res);
          
            if($cntRes == 1)
            {  
                $row = $this->fetchData($res);
                $uid = $row['user_id'];
            
                global $comm;
                $url = APIDOMAIN."index.php?action=getUserDetailsById&userid=".$uid;
                
                $res  = $comm->executeCurl($url); 
                $data = $res;
                $arr = $data;
            }
            else
            {
                $arr['error'] = array('code'=>1,'msg'=>'Error in fetching data');
            }
            $result = $arr;
            return $result;
        }
        
        
        private function generateURL($strLength)
        {
          
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            for($i=0;$i<=$strLength;$i++)
            {
                $string = substr($chars,rand(6,strlen($chars)),6);
               
            }
            $chkSql = " SELECT
                                urlkey
                        FROM
                                tbl_url_master
                        WHERE
                                urlkey = \"".$string."\"
                        AND 
                                active_flag=1";
            $chkRes = $this->query($chkSql);
            $cntRes = $this->numRows($chkRes);
            if($cntRes > 0)
            {
                $string = $this->generateURL(6);
            }
            return $string;
        }
                
	public function getuserdatabyurl($params)
	{
	   
	  $url=(!empty($params['key'])) ? trim($params['key']) : '';
	 
        if(empty($url))
        {
           // $arr = array();
           $error = array('err_code'=>1, 'err_msg'=>' parameters are missing');
           $result = array('result'=>$resp, 'error'=>$error);
           return $result;
           
        }
            $sql = "SELECT
                            user_id,mobile,email,active_flag
                    FROM 
                            tbl_url_master
                    WHERE
                            urlkey = \"".$params['key']."\"  AND
			    DATE_SUB(`update_date`,INTERVAL - 30 MINUTE) > now()
                             AND active_flag=1";
	    $res=$this->query($sql);
	    if($res)
	    {
	    while($row= $this->fetchData($res)){ 
	      $arr['user_id']=$row['user_id'];
	      $arr['mobile']=$row['mobile'];
	      $arr['email']=$row['email']; 
	      $reslt=$arr;
	    }
	    $arr['error'] = array('code'=>0,'msg'=>'data fetched successfully');
	    }
	    else{
	      $arr['error'] = array('code'=>0,'msg'=>'errror in fetched data');
	    }
	     $results = array('result' => $reslt, 'error' => $err);
            return $results; 
	}
	
	
    }
?>