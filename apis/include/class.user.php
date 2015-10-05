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
            $arr='User is already Registered';
            $err=array('Code'=>0,'Msg'=>'Data matched');
            }
            $result = array('results' => $arr, 'error' => $err);
            return $result;
        }

        public function userReg($params) // USER LOGIN PROCESS
        {   
           $dt= json_decode($params['dt'],1);
           $detls  = $dt['result'];

            $isql = "INSERT INTO tbl_registration(userName,logmobile,password,usertype,email,active_flag,cdt,udt,is_complete)
                    VALUES('".$detls['username']."',".$detls['logmobile'].",MD5('".$detls['password']."'),".$detls['usertype'].",'".$detls['email']."',0,now(),now(),0)";
           $ires=$this->query($isql);
            $uid=$this->lastInsertedId();
            if($ires)
            {
                    if($detls['usertype']=1)
                    {
                        $isql = "INSERT INTO tbl_user_info(user_id,userName,logmobile,cdt,udt)
                             VALUES(".$uid.",'".$detls['username']."',".$detls['logmobile'].",now(),now())";
        
                        $ires2=$this->query($isql);
                    }
                    if($detls['usertype']=2)
                    {
                        $isql = "INSERT INTO tbl_vendor_master(user_id,vname,logmob,cdt,udt)
                             VALUES(".$uid.",'".$detls['username']."',".$detls['logmobile'].",now(),now())";                    
                        $ires2=$this->query($isql);
                    }
                 if($ires)
                 {
                    $arr="Registration process Is Complete";
                    $err=array('code'=>0,'msg'=>"Insert Operation Done");
                  }
            }
           else
           {
                $arr='Registeration not done';
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
          
          if($type=1)
          {
         $vsql = "UPDATE tbl_user_info set userName='".$detls['username']."',gender=".$detls['gen'].",alt_email='".$detls['alt_email']."',dob=STR_TO_DATE('".$detls['dob']."','%Y-%m-%d'),working_phone='".$detls['workphone']."',pincode=".$detls['pincode'].",fulladdress='".$detls['address']."',cityname='".$detls['cityname']."',id_type='".$detls['idtype']."',id_proof_no='".$detls['idproof']."',udt=now() where logmobile=".$detls['logmobile']."";
          $vres=$this->query($vsql);
                if($vres)
                {
                    $arr="Profile is updated";
                    $err=array('code'=>0,'msg'=>'Update operation is done successfully');
                }
                else
                {
                    $arr="profile is not updated";
                    $err=array('code'=>0,'msg'=>'Update operation unsuccessfull');
                }
          }
          if($type=2)
          {
          $vsql = "UPDATE tbl_vendor_master set gender=".$detls['gen'].",vname='".$detls['username']."',wrk_cell='".$detls['workphone']."',landline=".$detls['landline'].",add1='".$detls['address']."',area='".$detls['area']."',city='".$detls['cityname']."',state='".$detls['state']."',pincode=".$detls['pincode'].",website='".$detls['website']."',fax='".$detls['fax']."',lat=".$detls['lat'].",lng=".$detls['lng'].",udt=now() where logmob=".$detls['logmobile']."";
          $vres=$this->query($vsql);
                if($vres)
                {
                    $arr="Profile is updated";
                    $err=array('code'=>0,'msg'=>'Update operation is done successfully');
                }
                else
                {
                    $arr="profile is not updated";
                    $err=array('code'=>0,'msg'=>'Update operation unsuccessfull');
                }
          }
          
          $result = array('results'=>$arr,'error'=>$err);
          return $result;
        }
                
        public function logUser($params) // USER LOGIN CHECK
        {
          $vsql="SELECT logmobile,password,usertype from tbl_registration where logmobile=".$params['mobile']." AND password=MD5('".$params['password']."') AND active_flag=1";
           
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
                $err['error']=array('code'=>1,'msg'=>'Parameters matched');
                }
               else if($ut=2)
                {
                $arr="Welcome and greetings Vendor";
                $err['error']=array('code'=>1,'msg'=>'Parameters matched');
                }
            }   
            else
            {
                $arr="No user with this mobile is registered";
                $err['error']=array('code'=>1,'msg'=>'Problem in fetching data');
            }
            $result = array('results'=>$arr,'error'=>$err['error']);
            return $result;
        }
                
        public function actUser($params) // Activate Status
        {   
            $vsql="SELECT active_flag from tbl_registration where logmobile=".$params['mobile']."";
            $vres=$this->query($vsql);
            if($this->numRows($vres)==1) //If user is registered
            {
                $usql="UPDATE tbl_registration set active_flag=1 where logmobile=".$params['mobile'];
                $ures=$this->query($usql);
                if($ures)
                {
                    $arr="User profile is activated";
                    $err=array('code'=>1,'msg'=>'Value has been changed');
                }
                else
                {
                    $arr="Update operation is not performed";
                    $err=array('code'=>1,'msg'=>'Error in updating data');
                }
            }
            else
            {
                $arr="Data Not Found regarding ur requested parameters";
                $err=array('code'=>1,'msg'=>'Problem in fetching data');
            }  // If user is not registered
            $result = array('results'=>$arr,'error'=>$err);
            return $result;
        }

        public function deactUser($params) // DeActivate Status
        {   
            $vsql="SELECT active_flag from tbl_registration where logmobile=".$params['mobile']."";
            $vres=$this->query($vsql);
            if($this->numRows($vres)==1) //If user is registered
            {
            $usql="UPDATE tbl_registration set active_flag=0 where logmobile=".$params['mobile'];
            $ures=$this->query($usql);
                if($ures)
                {
                    $arr="User profile is deactivated";
                    $err=array('code'=>0,'msg'=>'Row has been Updated');
                }
                else
                {
                $arr="Update operation is not performed";
                $err=array('code'=>1,'msg'=>'Error in updating data');
                }
            }
            else
            {
                $arr="Data Not Found regarding ur requested parameters";
                $err=array('code'=>1,'msg'=>'Problem in fetching data');
            }  // If user is not registered
            $result = array('results'=>$arr,'error'=>$err);
            return $result;
        }

        public function updatePass($params)
        {
            $vsql="SELECT logmobile,userName,email from tbl_registration where logmobile=".$params['mobile']." AND active_flag=1";
            $vres=$this->query($vsql);
            if($this->numRows($vres)==1) //If user is registered
            {
                $usql="UPDATE tbl_registration set password=MD5('".$params['password']."') where logmobile=".$params['mobile'];
                $ures=$this->query($usql);
                if($ures)
                {
                $arr="User profile password is updated";
                $err=array('code'=>0,'msg'=>'Row has been Updated');
                }
                else
                {
                $arr="Password not updated";
                $err=array('code'=>1,'msg'=>'Error in updating data');
                }
            }
            else
            {
                $arr="User Not Exist";
                $err=array('code'=>1,'msg'=>'Problem in fetching data');
            }  // If user is not registered
            $result = array('results'=>$arr,'error'=>$err);
            return $result;
        }
        
        public function viewAll($params)   // USERTYPE -- 1- USER    2-VENDOR 
        {
            $vsql="SELECT user_id,userName,email,usertype from tbl_registration where logmobile=".$params['mobile']." AND active_flag=1";
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
                    $v2sql="SELECT * from tbl_user_info where logmobile=".$params['mobile']." and user_id=".$arr['user_id']."";
                    $v2res=$this->query($v2sql);
                    $chkres1=$this->numRows($v2res);
                    if($chkres1>0)//If user is registered and is customer
                    {
                       while($row2=$this->fetchData($v2res))
                       {
                           $arr['gender']=$row2['gender'];
                           $arr['alt_email']=$row2['alt_email'];
                           $arr['dob']=$row2['dob'];
                           $arr['work_phone']=$row2['working_phone'];
                           $arr['address']=$row2['fulladdress'];
                           $arr['pincode']=$row2['pincode'];
                           $arr['city']=$row2['cityname'];
                           $arr['id_type']=$row2['id_type'];
                           $arr['id_proof_no']=$row2['id_proof_no'];
                       }
                    }
                }
                if($arr['usertype']==0)      // Vendor
                {
                    $v2sql="SELECT * from tbl_vendor_master where logmob=".$params['mobile']." and user_id=".$arr['user_id']."";
                    $v2res=$this->query($v2sql);
                    $chkres1=$this->numRows($v2res);
                    if($chkres1>0)//If user is registered and is customer
                    {
                       while($row2=$this->fetchData($v2res))
                       {
                           $arr['vname']=$row2['vname'];
                           $arr['wrk_cell']=$row2['wrk_cell'];
                           $arr['landline']=$row2['landline'];
                           $arr['add1']=$row2['add1'];                       
                           $arr['area']=$row2['area'];
                           $arr['city']=$row2['city'];
                           $arr['state']=$row2['state'];
                           $arr['pincode']=$row2['pincode'];
                           $arr['website']=$row2['website'];
                           $arr['fax']=$row2['fax'];
                           $arr['lat']=$row2['lat'];
                           $arr['lng']=$row2['lng'];
                           $arr['rating']=$row2['rating'];
                           $arr['gender']=$row2['gender'];
                       }
                    }
                }
                
                $err=array('code'=>0,'msg'=>'Data fetched successfully');
            }
            else
            {
                $arr="User Not Exist";
                $err=array('code'=>1,'msg'=>'Problem in fetching data');
            }  
            $result = array('results'=>$arr,'error'=>$err);
            return $result;
        }
        
        public function iscomp($params) // Activate Status
        {   
            $vsql="SELECT is_complete from tbl_registration where logmobile=".$params['mobile']."";
            $vres=$this->query($vsql);
            if($this->numRows($vres)==1) //If user is registered
            {
                $usql="UPDATE tbl_registration set is_complete=1 where logmobile=".$params['mobile'];
                $ures=$this->query($usql);
                if($ures)
                {
                    $arr="User profile is completed";
                    $err=array('code'=>1,'msg'=>'Value has been changed');
                }
                else
                {
                    $arr="Update operation is not performed";
                    $err=array('code'=>1,'msg'=>'Error in updating data');
                }
            }
            else
            {
                $arr="Data Not Found regarding ur requested parameters";
                $err=array('code'=>1,'msg'=>'Problem in fetching data');
            }  // If user is not registered
            $result = array('results'=>$arr,'error'=>$err);
            return $result;
        }
    }
    ?>