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
            $chksql="SELECT addid from tbl_addid_generator where uid=".$detls['logmob']."";
            $chkres=$this->query($chksql);
            $cntres=$this->numRows($chkres);
            if(!$cntres)
            {
                $isql="INSERT INTO tbl_addid_generator(uid) VALUES(".$detls['logmob'].")";
                $ires=$this->query($isql);
                $addid=$this->lastInsertedId();
            }
            else
            {
                $adisql="INSERT INTO tbl_address_master(addid,uid,addtitle,add1,add2,fulladd,area,city,state,pincode,country,cdt,udt,dflag)
                      VALUES(".$addid.",".$detls['logmob'].",'".$detls['addtitle']."','".$detls['add1']."','".$detls['add2']."','".$detls['fulladd']."',
                      '".$detls['area']."','".$detls['city']."','".$detls['state']."',".$detls['pcode'].",'".$detls['country']."',now(),now(),1)";

                $adires=$this->query($adisql);
                if($adires)
                {
                    $arr="Address is inserted";
                    $err=array('code'=>0,'msg'=>'Values are inserted');
                }
                else
                {
                    $arr="Address insertion failed";
                    $err=array('code'=>0,'msg'=>'Values are not inserted');
                }
            }
       }
       else
       {
           $arr='Error in obtaining parameters';
           $err=array('Code'=>1,'Msg'=>'Data parameter is not in proper format');
       }
        $result=array('reuslts'=>$arr,'error'=>$err);
        return $result;        
    }
    
    public function getAdd($params)
    {
        $sql="SELECT addid,uid,addtitle,add1,add2,fulladd,area,city,state,pincode,country,cdt,udt,dflag from tbl_address_master WHERE addid=".$params['addid'];
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
            $arr="Error in fetching data";
            $err=array('Code'=>1,'Msg'=>'Error in selection');
        }
        $result=array('results'=>$arr,'error'=>$err);
        return $result;
    }
    
    public function getAddByUser($params)
    {
        $sql="SELECT addid,uid,addtitle,add1,add2,fulladd,area,city,state,pincode,country,cdt,udt,dflag from tbl_address_master WHERE uid=".$params['logmob'];
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
            $arr="Error in fetching data";
            $err=array('Code'=>1,'Msg'=>'Error in selection');
        }
        $result=array('results'=>$arr,'error'=>$err);
        return $result;
    }
    
    public function getUserAddID($params)
    {
        $sql="SELECT addid from tbl_addid_generator WHERE uid=".$params['logmob'];
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
            $arr="Error in fetching data";
            $err=array('Code'=>1,'Msg'=>'Error in selection');
        }
        $result=array('results'=>$arr,'error'=>$err);
        return $result;
    }
    
}