<?php
include APICLUDE.'common/db.class.php';
class newsletter extends DB
{
    function __construct($db) 
    {
            parent::DB($db);
    }
                
    public function subscribe($params)
    {   
       $usql = "UPDATE tbl_registration set subscribe=1 where active_flag=1 and user_id=".$params['uid'];
       $ures=$this->query($usql);
       if($ures)
       {
           if($ures)
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
    
    public function viewSubscribers($params)
    {
        $vsql="SELECT user_id,userName,logmobile,email from tbl_registration where subscribe=1 and active_flag=1";
        $page   = $params['page'];
        $limit  = $params['limit'];
        if (!empty($page))
        {
            $start = ($page * $limit) - $limit;
            $vsql.=" LIMIT " . $start . ",$limit";
        }
        $vres=$this->query($vsql);
        $chkres=$this->numRows($vres);
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
            $arr='No Subscription yet';
            $err=array('Code'=>1,'Msg'=>'No match found');
        }
        $result=array('results'=>$arr,'error'=>$err);
        return $result;
    }
    
    public function addNewsletter($params)
    {
       $dt= json_decode($params['dt'],1);
       $detls  = $dt['result'];
           $sql="INSERT INTO tbl_newsletter_master(name,descr,content,dflag,cdt,udt)
                 VALUES('".$detls['name']."','".$detls['des']."','".$detls['content']."',1,now(),now())";           
           $res=$this->query($sql);
          
           if($res)
           {
               $arr='Newsletter has been added';
               $err=array('Code'=>0,'Msg'=>'Insertion is done successfully');
           }
           else
           {
               $arr='Newsletter has not been added';
               $err=array('Code'=>0,'Msg'=>'Insertion unsuccessful');
           }
        $result=array('result'=>$arr,'error'=>$err);
        return $result;
    }
    
    public function unSubscribe($params)
    {
        $chksql="SELECT * from tbl_registration where user_id=".$params['uid'];
        $chkres=$this->query($chksql);
        $cntres=$this->numRows($chkres);
        if($cntres==1)
        {
            $sql="UPDATE tbl_registration set subscribe=0 where user_id=".$params['uid'];
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
        