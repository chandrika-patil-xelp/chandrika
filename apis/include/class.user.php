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
           $proErr  = $dt['error'];
           if($proErr['errCode']== 0)
           { 
            $dob=explode(' ',$detls['dob']);
            $detls['dob']=implode('-',$dob);   
           $isql = "INSERT INTO tbl_registration(userName,gender,logmobile,password,usertype,email,alt_email,dob,working_phone,fulladdress,pincode,cityname,id_type,id_proof_no,active_flag,cdt,udt,is_complete)
                    VALUES('".$detls['username']."',".$detls['gender'].",".$detls['logmobile'].",MD5('".$detls['password']."'),".$detls['usertype'].",'".$detls['email']."','".$detls['alt_email']."',STR_TO_DATE('".$detls['dob']."','%Y-%m-%d'),".$detls['working_phone'].",'".$detls['fulladdress']."',".$detls['pincode'].",'".$detls['cityname']."','".$detls['id_type']."','".$detls['id_proof_no']."',0,now(),now(),0)";
            $ires=$this->query($isql);
                if($ires)
                {
                $arr="Registration process Is Complete";
                $err=array('code'=>0,'msg'=>"Insert Operation Done");
                }
                else
                {       
                    $arr="Problem in SignUp";
                    $err=array('code'=>1,'msg'=>"Error in insert operation");
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
          $dob=explode(' ',$params['dob']);
          $params['dob']=implode('-',$dob);
          $vsql = "UPDATE tbl_registration set userName='".$params['uname']."',usertype=".$params['usertype'].",alt_email='".$params['alt_email']."',dob=STR_TO_DATE('".$params['dob']."','%Y-%m-%d'),working_phone=".$params['work_phone'].",pincode=".$params['pincode'].",fulladdress='".$params['address']."',cityname='".$params['cityname']."',id_type='".$params['idtype']."',id_proof_no='".$params['idproof']."' where logmobile=".$params['logmobile'];
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
            $result = array('results'=>$arr,'error'=>$err);
            return $result;
        }
                
        public function logUser($params) // USER LOGIN CHECK
        {
          $vsql="SELECT logmobile,password from tbl_registration where logmobile=".$params['mobile']." AND password=MD5('".$params['password']."') AND active_flag=1";
           
           $vres=$this->query($vsql);
            if($this->numRows($vres)==1)
            {
                $arr="Welcome and greetings user";
                $err['error']=array('code'=>1,'msg'=>'Parameters matched');
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
        
        public function viewAll($params)
        {
            $vsql="SELECT * from tbl_registration where logmobile=".$params['mobile']." AND active_flag=1";
            $vres=$this->query($vsql);
            $chkres=$this->numRows($vres);
            if($chkres>0)//If user is registered and is customer
            {   $i=-1;
                while($row=$this->fetchData($vres))
                {
                    $arr[]=$row;
                    $i++;
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
    }
    ?>