<?php
include APICLUDE.'common/db.class.php';
class address extends DB
{
    function __construct($db) 
    {
            parent::DB($db);
    }

    public function fillAdd($params)
    {  
       $dt     = json_decode($params['dt'],1);
       $detls  = $dt['result'];
       $proErr = $dt['error'];
       if($proErr['errCode']== 0)
       {
            $chksql="SELECT
                                    address_id 
                     FROM 
                                    tbl_addressid_generator 
                     WHERE 
                                    user_id=\"".$detls['uid']."\"";
            $chkres=$this->query($chksql);
            $cntres=$this->numRows($chkres);
            if($cntres==0)
            {
                $isql="INSERT 
                       INTO 
                                        tbl_addressid_generator
                                       (user_id,
                                        date_time)
                       VALUES
                                      (\"".$detls['uid']."\",
                                           now())";
                $ires=$this->query($isql);
                $addid=$this->lastInsertedId();
            }
            else
            {
                $row=$this->fetchData($chkres);
                $addid=$row['addid'];
            }
            
                $adisql="INSERT
                         INTO 
                                    tbl_address_master
                                   (address_id,
                                    user_id,
                                    address_title,
                                    address1,
                                    address2,
                                    full_address,
                                    area,
                                    city,
                                    state,
                                    pincode,
                                    country,
                                    date_time,
                                    active_flag)
                      VALUES
                                (\"".$addid."\",
                                 \"".$detls['uid']."\",
                                 \"".$detls['addtitle']."\",
                                 \"".$detls['add1']."\",
                                 \"".$detls['add2']."\",
                                 \"".$detls['fulladd']."\",
                                 \"".$detls['area']."\",
                                 \"".$detls['city']."\",
                                 \"".$detls['state']."\",
                                 \"".$detls['pcode']."\",
                                 \"".$detls['country']."\",
                                     now(),
                                     1)
                      ON
                      DUPLICATE
                      KEY
                                adddress_title  =\"".$detls['addtitle']."\",
                                address1        =\"".$detls['add1']."\",
                                address2        =\"".$detls['add2']."\",
                                fulladdress     =\"".$detls['fulladd']."\",
                                area            =\"".$detls['area']."\",
                                city            =\"".$detls['city']."\",
                                state           =\"".$detls['state']."\",
                                pincode         =\"".$detls['pcode']."\",
                                country         =\"".$detls['country']."\"";

                $adires=$this->query($adisql);
                if($adires)
                {
                    $arr="Address is inserted";
                    $err=array('code'=>0,'msg'=>'Values are inserted');
                }
                else
                {
                    $arr=array();
                    $err=array('code'=>0,'msg'=>'Values are not inserted');
                }
        }
       else
       {
           $arr=array();
           $err=array('Code'=>1,'Msg'=>'Data parameter is not in proper format');
       }
        $result=array('reuslts'=>$arr,'error'=>$err);
        return $result;        
    }
    
    public function getAdd($params)
    {
        $sql="SELECT
                            address_id,
                            user_id,
                            address_title,
                            address1,
                            address2,
                            full_address,
                            area,
                            city,
                            state,
                            pincode,
                            country,
                            date_time,
                            active_flag
                FROM 
                            tbl_address_master 
                WHERE 
                            address_id=".$params['addid']."
                ORDER BY 
                            address_id ASC";
        $res=$this->query($sql);
        if($res)
        {
            while($row=$this->fetchData($res))
            {
                $arr[]=$row;
            }
           $err=array('Code'=>0,'Msg'=>'Values are fetched successfully');
        }
        else
        {
            $arr=array();
            $err=array('Code'=>1,'Msg'=>'Error in selection');
        }
        $result=array('results'=>$arr,'error'=>$err);
        return $result;
    }
    
    public function getAddByUser($params)
    {
        $sql="SELECT
                            address_id,
                            user_id,
                            address_title,
                            address1,
                            address2,
                            full_address,
                            area,
                            city,
                            state,
                            pincode,
                            country,
                            date_time,
                            active_flag
              FROM 
                            tbl_address_master
              WHERE 
                            user_id=".$params['uid'];
        $res=$this->query($sql);
        if($res)
        {
            while($row=$this->fetchData($res))
            {
                $arr[]=$row;
            }
           $err=array('Code'=>0,'Msg'=>'Values are fetched successfully');
        }
        else
        {
            $arr=array();
            $err=array('Code'=>1,'Msg'=>'Error in selection');
        }
        $result=array('results'=>$arr,'error'=>$err);
        return $result;
    }
    
    public function getUserAddID($params)
    {
        $sql="SELECT 
                        address_id,
                        address_title 
              FROM 
                        tbl_addressid_generator
              WHERE 
                        user_id=".$params['uid']."
              ORDER BY 
                        address_id ASC";
        $res=$this->query($sql);
        if($res)
        {
            while($row=$this->fetchData($res))
            {
                $arr[]=$row;
            }
           $err=array('Code'=>0,'Msg'=>'Values are fetched successfully');
        }
        else
        {
            $arr=array();
            $err=array('Code'=>1,'Msg'=>'Error in selection');
        }
        $result=array('results'=>$arr,'error'=>$err);
        return $result;
    }  
}