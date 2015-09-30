<?php
include APICLUDE.'common/db.class.php';
class newsletter extends DB
{
    function __construct($db) 
    {
            parent::DB($db);
    }
                
    public function subsribe($params)
    {   
       $usql = "UPDATE tbl_registration set subscribe=1 where active_flag=1 and logmobile=".$params['mobile'];
       $ures=$this->query($usql);
       $chkres=$this->numRows($ures);
       if($chkres>0)
       {
           if($ires)
            {
            $arr="Your Subscription is done";
            $err=array('code'=>0,'msg'=>"Update operation Done");
            }
            else
            {       
                $arr="Problem in Subscribing";
                $err=array('code'=>1,'msg'=>"Error in update operation");
            }
       }
       else
       {
            $arr='Data is not passed properly';
            $err=array('code'=>1,'msg'=>'Error in decoding data');
       }
        $result = array('results' =>$arr,'error'=>$err);
        return $result;
    }
    
    public function viewSubscribers()
    {
        $vsql="SELECT userName,logmobile,email from tbl_registration where subscribe=1 and active_flag=1";
        $vres=$this->query($vsql);
        $chksql=$this->numRows($vres);
        if($chkres>0)
        {
            while($row=$this->fetchData($vres))
            {
                $arr[]=$row;
            }
            $err=array('Code'=>0,'Msg'=>'Data values fetched');
        }
        else
        {
            $arr='There is no appointment request active';
            $err=array('Code'=>1,'Msg'=>'No match found');
        }
        $result=array('results'=>$arr,'error'=>$err);
        return $result;
    }
    
    public function addNewsletter($params)
    {
       $dt= json_decode($params['dt'],1);
       $detls  = $dt['result'];
       $proErr  = $dt['error'];
       if($proErr['errCode']== 0)
       {
           $sql="INSERT INTO tbl_newsletter_master(name,descr,content,dflag,cdt,udt)
                 VALUES('".$detls['name']."','".$detls['des']."','".$params['content']."',1,now(),now())";
           
           $res=$this->query($sql);
           $chkres=$this->numRows($res);
           if($chkres>0)
           {
               $arr='Newsletter has been added';
               $err=array('Code'=>0,'Msg'=>'Insertion is done successfully');
           }
           else
           {
               $arr='Newsletter has not been added';
               $err=array('Code'=>0,'Msg'=>'Insertion unsuccessful');
           }
       }
       else
        {
           $arr='Error in passing the data';
           $err=array('Code'=>0,'Msg'=>'data parameters are incomplete');
        }
        $result=array('result'=>$arr,'error'=>$err);
        return $result;
    }
    
    public function unSubscribe($params)
    {
        $chksql="SELECT * from tbl_registration where logmobile=".$params['logmobile'];
        $chkres=$this->query($chkres);
        $cntres=$this->numRows($chkres);
        if($cntres==1)
        {
            $sql="UPDATE tbl_registration set subscribe=0 where logmobile=".$params['logmobile'];
            $res=$this->query($sql);
            $arr="you are unsubscribed from our newsletter facility";
            $err=array('Code'=>0,'msg'=>'Update operation completed');
        }
        else
        {
            $arr="you are unsubscribed from our newsletter facility";
            $err=array('Code'=>0,'msg'=>'Update operation completed');
        }
        $result=array('result'=>$arr,'error'=>$err);
        return $result;
    }
    
   }
?>       
        