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
            $csql=" SELECT
                            logmobile 
                    FROM 
                            tbl_registration 
                    WHERE 
                            logmobile=".$params['mobile']."";
            $cres=$this->query($csql);
            $cnt1 = $this->numRows($cres);
            if($cnt1==0)
            {
                $arr=array();
                $err=array('Code'=>0,'Msg'=>'No Data matched');
            }
            else 
            {
            $arr='User is already Registered';
            $err=array('Code'=>0,'Msg'=>'No Data matched');
            }
            $result = array('results' => $arr, 'error' => $err);
            return $result;
        }

         public function userReg($params) // USER LOGIN PROCESS
        {   
           $isql = "INSERT
                    INTO 
                                tbl_registration
                               (user_name,
                                password,
                                logmobile,
                                email,
                                user_type,
                                is_active,
                                date_time,
                                updated_by)
                    VALUES
                               ('".$params['username']."',
                                   MD5('".$params['password']."'),
                                 ".$params['mobile'].",
                                '".$params['email']."',
                                 ".$params['usertype'].",
                                   0,
                                   now(),
                                   now(),
                                '".$params['username']."')";
            $ires=$this->query($isql);
            $uid=$this->lastInsertedId();
            
            if($params['usertype']=1)
            {
            $isql= "INSERT 
                    INTO 
                                    tbl_vendor_master
                                   (vendor_id,
                                    email,
                                    date_time,
                                    is_complete)
                    VALUES
                                  (".$uid.",
                                  '".$params['email']."',
                                     now(),
                                     0)";
            $res=$this->query($isql);
                if($res)
                {
                $arr="SignUp process Is Complete";
                $err=array('code'=>0,'msg'=>"Insert Operation Done");
                }
                else
                {       
                    $arr=array();
                    $err=array('code'=>1,'msg'=>"Error in insert operation");
                }
            }
           else if($params['usertype']=0)
            {
                $arr="SignUp process Is Complete";
                $err=array('code'=>0,'msg'=>"Insert Operation Done");            
            }
            else
            {
                $arr=array();
                $err=array('code'=>1,'msg'=>'Error in insertion ');
            }
            $result = array('results' =>$arr,'error'=>$err);
            return $result;
        }
        
        public function udtProfile($params) // Update vendor details
        {
            $dt= json_decode($params['dt'],1);
            $detls  = $dt['result'];
            
         $sql="     SELECT
                            user_type,
                            user_id 
                    FROM
                            tbl_registration
                    WHERE
                            logmobile=".$detls['logmobile']."";
          $res=$this->query($sql);
          $row=$this->fetchData($res);
          $isv=$row['user_type'];
          $uid=$row['user_id'];
          
          if($isv==1)
          {
           $vsql = "UPDATE 
                                        tbl_vendor_master 
                    SET 
                                        orgName='".$detls['orgname']."',
                                        fulladdress='".$detls['fulladd']."',
                                        address1='".$detls['add1']."',
                                        area='".$detls['area']."',
                                        postal_code='".$detls['pincode']."',
                                        city='".$detls['city']."',
                                        country='".$detls['country']."',
                                        state='".$detls['state']."',
                                        telephones='".$detls['tel']."',
                                        alt_email='".$detls['altmail']."',
                                        officecity='".$detls['ofcity']."',
                                        officecountry='".$detls['ofcountry']."', 
                                        contact_person='".$detls['cperson']."',
                                        position='".$detls['position']."',
                                        contact_mobile=".$detls['cmobile'].",
                                        email='".$detls['email']."',
                                        memship_Cert='".$detls['memcert']."',
                                        bdbc='".$detls['bdbc']."',
                                        other_bdbc='".$detls['othbdbc']."',
                                        vatno=".$detls['vat'].",
                                        website='".$detls['wbst']."',
                                        landline='".$detls['landline']."',
                                        mdbw='".$detls['mdbw']."',
                                        banker='".$detls['banker']."',
                                        pancard='".$detls['pan']."',
                                        turnover='".$detls['tovr']."',
                                        lat=".$detls['lat'].",
                                        lng=".$detls['lng'].",
                                        updatedby='vendor',
                                        is_complete='is_complete' 
                WHERE 
                                                vendor_id=".$uid."";
             $vres=$this->query($vsql);
            if($vres)
            {
                $arr="Vendor table is updated";
                $err=array('code'=>0,'msg'=>'Update operation is done successfully');
            }
          }
         else if($isv==0)
          {
             $vsql = "UPDATE tbl_registration 
                      SET 
                                            user_name='".$detls['username']."',
                                            email='".$detls['email']."',
                                            updatedby='".$detls['username']."',
                                            is_complete=is_complete
                     WHERE 
                                            user_id=".$uid."";
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
          else 
          {
                $arr=array();
                $err=array('code'=>1,'msg'=>'Update operation unsuccessfull');
          }
          
            $result = array('results'=>$arr,'error'=>$err);
            return $result;
        }
                
        public function logUser($params) // USER LOGIN CHECK
        {
            $vsql="SELECT 
                          logmobile,
                          password,
                          user_type
                   FROM 
                          tbl_registration 
                   WHERE
                          logmobile=".$params['mobile']." 
                   AND 
                          password=MD5('".$params['password']."')
                   AND
                          is_active=1";
            $vres=$this->query($vsql);
            $cntres=$this->numRows($vres);
            if($cntres=1)
            {
                while($row=$this->fetchData($vres))
                {
                    $arr['utype']=$row['user_type'];
                }
                $ut=$arr['utype'];
                if($ut=0)
                {
                    $arr="Welcome and greetings user";
                    $err=array('code'=>1,'msg'=>'Parameters matched');
                }
                else if($ut=1)
                {
                    $arr="Welcome and greetings Vendor";
                    $err=array('code'=>1,'msg'=>'Parameters matched');
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
            $vsql="         SELECT   
                                    is_active 
                            FROM
                                    tbl_registration 
                            WHERE   
                                    logmobile=".$params['mobile']."";
            $vres=$this->query($vsql);
            if($this->numRows($vres)==1) //If user is registered
            {
                $usql="     UPDATE 
                                    tbl_registration 
                            SET 
                                    is_active=1 
                            WHERE
                                    logmobile=".$params['mobile'];
                $ures=$this->query($usql);
                if($ures)
                {
                    $arr="User profile is activated";
                    $err=array('code'=>0,'msg'=>'Value has been changed');
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
            $vsql="     SELECT 
                                is_active 
                        FROM 
                                tbl_registration
                        WHERE 
                                logmobile=".$params['mobile']."";
            $vres=$this->query($vsql);
            if($this->numRows($vres)==1) //If user is registered
            {
            $usql="     UPDATE 
                                tbl_registration 
                        SET 
                                is_active=0 
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
                            user_name,
                            email
                 FROM
                            tbl_registration 
                 WHERE 
                            logmobile=".$params['mobile']."
                  AND 
                            is_active=1";
          
            $vres=$this->query($vsql);
            if($this->numRows($vres)==1) //If user is registered
            {
               $usql="UPDATE 
                             tbl_registration 
                      SET 
                             password=MD5('".$params['password']."')
                      WHERE 
                             logmobile=".$params['mobile'];
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
        
        public function viewAll($params)
        {
            $vsql="         SELECT 
                                    user_type,
                                    user_id 
                            FROM 
                                    tbl_registration 
                            WHERE 
                                    user_id=".$params['uid']." 
                            AND 
                                    is_active=1";
            $vres=$this->query($vsql);
            $chkres=$this->numRows($vres);
            if($chkres>0)//If user is registered and is customer
            {  
                while($row1=$this->fetchData($vres))
                {
                    $arr1['isv']=$row1['user_type'];
                    $arr1['uid']=$row1['user_id'];
                }

                if($arr1['isv']==0)   // check if it is User
                {  
                  $vensql="     SELECT 
                                        user_name,
                                        logmobile,
                                        email 
                                FROM
                                        tbl_registration
                                WHERE 
                                        user_id =".$arr1['uid'];
                  $res=$this->query($vensql);
                  while($row=$this->fetchData($res))
                   {
                      $arr[]=$row;
                  }
                  $err=array('code'=>0,'msg'=>'Values fetched');
                }
                else if($arr1['isv']==1)    // check if it is Vendor
                {
                  $vensql="     SELECT
                                        orgName,
                                        email,
                                        fulladdress,
                                        contact_person,
                                        contact_mobile 
                                FROM    
                                        tbl_vendor_master
                                WHERE
                                        vendor_id =".$arr1['uid'];
                  $res=$this->query($vensql);
                  while($row=$this->fetchData($res))
                  {
                      $arr[]=$row;
                  }
                  $err=array('code'=>0,'msg'=>'Data fetched successfully');
                }
                else
                {
                    $arr=array();
                    $err=array('code'=>1,'msg'=>'Problem in fetching data');
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
    }
    ?>
