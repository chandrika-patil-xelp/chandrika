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
       $usql = "UPDATE 
                                tbl_registration 
                SET 
                                subscribe=1 
                WHERE 
                                is_active=1
                AND 
                                user_id=".$params['uid'];
       
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
                $arr=array();
                $err=array('code'=>1,'msg'=>"Error in update operation");
            }
       }
       else
       {
            $arr=array();
            $err=array('code'=>1,'msg'=>'Error in decoding data');
       }
        $result = array('results' =>$arr,'error'=>$err);
        return $result;
    }
    
    public function viewSubscribers($params)
    {
        $vsql="SELECT 
                                user_id,
                                user_name,
                                logmobile,
                                email
               FROM 
                                tbl_registration 
               WHERE
                                subscribe=1 
               AND 
                                is_active=1";
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
            $arr=array();
            $err=array('Code'=>1,'Msg'=>'No match found');
        }
        $result=array('results'=>$arr,'error'=>$err);
        return $result;
    }
    
    public function addNewsletter($params)
    {
       $dt= json_decode($params['dt'],1);
       $detls  = $dt['result'];
           
           $sql="INSERT 
                 INTO 
                                    tbl_newsletter_master
                                   (news_headline,
                                    news_description,
                                    content,
                                    active_flag,
                                    date_time)
                                    
                 VALUES
                                (\"".$detls['name']."\",
                                 \"".$detls['des']."\",
                                 \"".$detls['content']."\",
                                     1,
                                     now())";           
           $res=$this->query($sql);
          
           if($res)
           {
               $arr='Newsletter has been added';
               $err=array('Code'=>0,'Msg'=>'Insertion is done successfully');
           }
           else
           {
               $arr=array();
               $err=array('Code'=>0,'Msg'=>'Insertion unsuccessful');
           }
        $result=array('result'=>$arr,'error'=>$err);
        return $result;
    }
    
    public function unSubscribe($params)
    {
        $chksql="SELECT
                             * 
                 FROM 
                             tbl_registration
                 WHERE 
                             user_id=".$params['uid'];
        $chkres=$this->query($chksql);
        $cntres=$this->numRows($chkres);
        if($cntres==1)
        {
            $sql="UPDATE 
                                    tbl_registration
                  SET 
                                    subscribe=0
                  WHERE 
                                    user_id=".$params['uid'];
            $res=$this->query($sql);
            
            $arr="you are unsubscribed from our newsletter facility";
            $err=array('Code'=>0,'msg'=>'Update operation completed');
        }
        else
        {
            $arr=array();
            $err=array('Code'=>0,'msg'=>'Update operation completed');
        }
        $result=array('result'=>$arr,'error'=>$err);
        return $result;
    }
    
   }
?>       
        