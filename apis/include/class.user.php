<?php
        include APICLUDE.'common/db.class.php';
	class user extends DB
    {
		function __construct($db) 
                {
			parent::DB($db);
		}

        public function checkUser($params)
        {
            $csql="select logmobile from tbl_registration where logmobile=".$params['mobile']."";
            $cres=$this->query($csql);
            $cnt1 = $this->numRows($cres);
            if($cnt1==0)
            {
                $arr='User Not yet Registered';
                $err=array('Code'=>0,'Msg'=>'No Data matched');
            }
            else 
            {
            $arr=array();
            $err=array('Code'=>0,'Msg'=>'Data matched');
            }
            $result = array('results'=>$arr,'error'=>$err);
            return $result;
        }

        public function userReg($params) // USER LOGIN PROCESS
        {   
           $dt= json_decode($params['dt'],1);
           $detls  = $dt['result'];

            $isql = "INSERT 
                     INTO 
                                tbl_registration(userName,logmobile,password,usertype,email,active_flag,
                                                 date_time,is_complete)
                    VALUES
                                (\"".$detls['username']."\",
                                 \"".$detls['logmobile']."\",
                             MD5(\"".$detls['password']."\"),
                                 \"".$detls['usertype']."\",
                                 \"".$detls['email']."\",
                                 0,
                                 now(),
                                 now(),
                                 0)";
            $ires=$this->query($isql);
            $uid=$this->lastInsertedId();
            
            if($ires)
            {
                    if($detls['usertype']=0)
                    {
                        $isql = "INSERT 
                                 INTO 
                                            tbl_vendor_master(user_id,vname,logmob,date_time)
                                            VALUES
                                            (\"".$uid."\",
                                             \"".$detls['username']."\",
                                             \"".$detls['logmobile']."\",
                                             now(),
                                             now())";                    
                        $ires2=$this->query($isql);
                    }
                    else if($detls['usertype']=1)
                    {
                        $arr="Registration process Is Complete";
                        $err=array('code'=>0,'msg'=>"Insert Operation Done");    
                    }
                    else
                    {
                        $arr=array();
                        $err=array('code'=>1,'msg'=>"Undefined usertype");
                    }
            }
           else
           {
                $arr=array();
                $err=array('code'=>1,'msg'=>'Error in registration');
           }
            $result = array('results' =>$arr,'error'=>$err);
            return $result;
        }              
        
        public function udtProfile($params) // Update vendor details
        {
           $dt= json_decode($params['dt'],1);
           $detls  = $dt['result'];
           
            
          $dob=explode(' ',$detls['dob']);
          $detls['dob']=implode('-',$dob);
          
         $sql="SELECT usertype from tbl_registration where logmobile=".$detls['logmobile']."";
          $res=$this->query($sql);
          $row=$this->fetchData($res);
          
          $type=$row['usertype'];
          
          if($type=0)
          {
          $vsql = "UPDATE 
                                tbl_vendor_master 
                   SET 
                                gender=\"".$detls['gen']."\",
                                vname=\"".$detls['username']."\",
                                wrk_cell=\"".$detls['workphone']."\",
                                landline=\"".$detls['landline']."\",
                                add1=\"".$detls['address']."\",
                                area=\"".$detls['area']."\",
                                city=\"".$detls['cityname']."\",
                                state=\"".$detls['state']."\",
                                pincode=\"".$detls['pincode']."\",
                                website=\"".$detls['website']."\",
                                fax=\"".$detls['fax']."\",
                                lat=\"".$detls['lat']."\",
                                lng=\"".$detls['lng']."\",
                                udt=now() 
                   WHERE 
                                logmob=\"".$detls['logmobile']."\"";
          $vres=$this->query($vsql);
          if($vres)
          {
                $arr="Profile is updated";
                $err=array('code'=>0,'msg'=>'Update operation is done successfully');
          }
          else
            {
                $arr=array();
                $err=array('code'=>1,'msg'=>'Update operation unsuccessfull');
            }
          }
          
          else if($isv=2)
          {
             $vsql = "UPDATE 
                                            tbl_registration 
                      SET 
                                            userName=\"".$detls['username']."\",
                                            email=\"".$detls['email']."\",
                                            date_time=now(),
                                            is_complete=is_complete
                     WHERE 
                                            user_id=\"".$uid."\"";
             $vres=$this->query($vsql);
             if($vres)
             {
                $arr="User Profile is updated";
                $err=array('code'=>0,'msg'=>'Update operation is done successfully');
             }
             else
             {
                $arr=array();
                $err=array('code'=>0,'msg'=>'Update operation unsuccessfull');
             }
          }
          $result = array('results'=>$arr,'error'=>$err);
          return $result;
        }
                
        public function logUser($params) // USER LOGIN CHECK
        {
          if(!empty($params['mobile']))
          {
            $vsql="SELECT       
                                logmobile,
                                password,
                                usertype 
                   FROM 
                                tbl_registration 
                   WHERE 
                                logmobile=".$params['mobile']."
                   AND 
                                password=MD5('".$params['password']."') 
                   AND 
                                active_flag=1";
          }
         else if(!empty($params['email']))
          {
            $vsql="SELECT 
                                    email,
                                    password,
                                    usertype 
                   FROM 
                                    tbl_registration 
                   WHERE 
                                    email=".$params['email']."
                   AND 
                                    password=MD5(\"".$params['password']."\") 
                   AND 
                                    active_flag=1";
          }
           $vres=$this->query($vsql);
            if($this->numRows($vres)==1)
            {
                while($row=$this->fetchData($vres))
                {
                    $arr['utype']=$row['usertype'];
                }
                $ut=$arr['utype'];
                if($ut=1)
                {
                $arr="Welcome and greetings user";
                $err=array('code'=>0,'msg'=>'Parameters matched');
                }
               else if($ut=2)
                {
                $arr="Welcome and greetings Vendor";
                $err=array('code'=>0,'msg'=>'Parameters matched');
                }
            }   
            else
            {
                $arr=array();
                $err=array('code'=>1,'msg'=>'Problem in fetching data');
            }
            $result = array('results'=>$arr,'error'=>$err);
            return $result;
        }
                
        public function actUser($params) // Activate Status
        {   
            $vsql="SELECT 
                                active_flag 
                    FROM 
                                tbl_registration 
                    WHERE 
                                logmobile=\"".$params['mobile']."\"";
            $vres=$this->query($vsql);
            if($this->numRows($vres)==1) //If user is registered
            {
                $usql="UPDATE 
                                    tbl_registration 
                       SET 
                                    active_flag=1 
                       WHERE 
                                    logmobile=".$params['mobile'];
                $ures=$this->query($usql);
                if($ures)
                {
                    $arr="User profile is activated";
                    $err=array('code'=>1,'msg'=>'Value has been changed');
                }
                else
                {
                    $arr=array();
                    $err=array('code'=>1,'msg'=>'Error in updating data');
                }
            }
            else
            {
                $arr=array();
                $err=array('code'=>1,'msg'=>'Problem in fetching data');
            }  // If user is not registered
            $result = array('results'=>$arr,'error'=>$err);
            return $result;
        }

        public function deactUser($params) // DeActivate Status
        {   
            $vsql="SELECT 
                                active_flag 
                   FROM 
                                tbl_registration 
                   WHERE 
                                logmobile=".$params['mobile']."";
            $vres=$this->query($vsql);
            if($this->numRows($vres)==1) //If user is registered
            {
            $usql="UPDATE 
                                tbl_registration 
                   SET 
                                active_flag=0 
                   WHERE 
                                logmobile=".$params['mobile'];
            $ures=$this->query($usql);
                if($ures)
                {
                    $arr="User profile is deactivated";
                    $err=array('code'=>0,'msg'=>'Row has been Updated');
                }
                else
                {
                $arr=array();
                $err=array('code'=>1,'msg'=>'Error in updating data');
                }
            }
            else
            {
                $arr=array();
                $err=array('code'=>1,'msg'=>'Problem in fetching data');
            }  // If user is not registered
            $result = array('results'=>$arr,'error'=>$err);
            return $result;
        }

        public function updatePass($params)
        {
            $vsql="SELECT 
                               logmobile,
                               userName,
                               email 
                   FROM 
                               tbl_registration 
                   WHERE 
                               logmobile=\"".$params['mobile']."\"
                   AND 
                                active_flag=1";
            $vres=$this->query($vsql);
            if($this->numRows($vres)==1) //If user is registered
            {
                $usql="UPDATE 
                                tbl_registration 
                       SET 
                                password=MD5(\"".$params['password']."\")
                       WHERE 
                                logmobile=\"".$params['mobile']."\"";
                $ures=$this->query($usql);
                if($ures)
                {
                $arr="User profile password is updated";
                $err=array('code'=>0,'msg'=>'Row has been Updated');
                }
                else
                {
                $arr=array();
                $err=array('code'=>1,'msg'=>'Error in updating data');
                }
            }
            else
            {
                $arr=array();
                $err=array('code'=>1,'msg'=>'Problem in fetching data');
            }  // If user is not registered
            $result = array('results'=>$arr,'error'=>$err);
            return $result;
        }
        
        public function viewAll($params)   // USERTYPE -- 1- USER    2-VENDOR 
        {
            $vsql="SELECT 
                                user_id,
                                userName,
                                email,
                                usertype 
                    FROM 
                                tbl_registration 
                    WHERE 
                                logmobile=".$params['mobile']." 
                    AND 
                                active_flag=1";
            $vres=$this->query($vsql);
            $chkres=$this->numRows($vres);
            if($chkres>0)//If user is registered and is customer
            {   
                while($row=$this->fetchData($vres))
                {
                    $arr['user_id']=$row['user_id'];
                    $arr['userName']=$row['userName'];
                    $arr['email']=$row['email'];
                    $arr['usertype']=$row['usertype'];
                }
                if($arr['usertype']==1)    // Customer
                {
                    $v2sql="SELECT 
                                        * 
                            FROM 
                                        tbl_registration
                            WHERE 
                                        logmobile=".$params['mobile']." 
                            AND 
                                        user_id=".$arr['user_id']."";
                    $v2res=$this->query($v2sql);
                    $chkres1=$this->numRows($v2res);
                    if($chkres1>0)//If user is registered and is customer
                    {
                       while($row2=$this->fetchData($v2res))
                       {
                           $arr['userName']=$row2['userName'];
                           $arr['logmobile']=$row2['logmobile'];
                           $arr['email']=$row2['email'];
                           $arr['subscribe']=$row2['subscribe'];
                       }
                    }
                }
                if($arr['usertype']==0)      // Vendor
                {
                    $v2sql="SELECT 
                                        * 
                            FROM 
                                        tbl_vendor_master 
                            WHERE 
                                        logmobile=\"".$params['mobile']."\" 
                            AND
                                        user_id=\"".$arr['user_id']."\"";
                    $v2res=$this->query($v2sql);
                    $chkres1=$this->numRows($v2res);
                    if($chkres1>0)//If user is registered and is customer
                    {
                       while($row2=$this->fetchData($v2res))
                       {
                           $arr['vendor_name']=$row2['vname'];
                           $arr['work_cell']=$row2['wrk_cell'];
                           $arr['land_line']=$row2['landline'];
                           
                           $arr['fulladdress']=$row2['add1'];                       
                           
                           $arr['area']=$row2['area'];
                           $arr['city']=$row2['city'];
                           $arr['state']=$row2['state'];
                           $arr['pincode']=$row2['pincode'];
                           $arr['website']=$row2['website'];
                           $arr['fax']=$row2['fax'];
                           $arr['latitude']=$row2['lat'];
                           $arr['longitude']=$row2['lng'];
                           $arr['rating']=$row2['rating'];
                           $arr['gender']=$row2['gender'];
                       }
                    }
                }
                
                $err=array('code'=>0,'msg'=>'Data fetched successfully');
            }
            else
            {
                $arr=array();
                $err=array('code'=>1,'msg'=>'Problem in fetching data');
            }  
            $result = array('results'=>$arr,'error'=>$err);
            return $result;
        }
        
        public function iscomp($params) // Activate Status
        {   
            $vsql="SELECT
                                is_complete 
                    FROM        tbl_registration
                    WHERE 
                                logmobile=".$params['mobile']."";
            $vres=$this->query($vsql);
            if($this->numRows($vres)==1) //If user is registered
            {
                $usql="UPDATE 
                                    tbl_registration
                        SET 
                                    is_complete=1
                        WHERE 
                                    logmobile=".$params['mobile'];
                $ures=$this->query($usql);
                if($ures)
                {
                    $arr="User profile is completed";
                    $err=array('code'=>1,'msg'=>'Value has been changed');
                }
                else
                {
                    $arr=array();
                    $err=array('code'=>1,'msg'=>'Error in updating data');
                }
            }
            else
            {
                $arr=array();
                $err=array('code'=>1,'msg'=>'Problem in fetching data');
            }  // If user is not registered
            $result = array('results'=>$arr,'error'=>$err);
            return $result;
        }
    }
    ?>