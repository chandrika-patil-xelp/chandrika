<?php
include APICLUDE.'common/db.class.php';
class helpdesk extends DB
{
    function __construct($db) 
    {
            parent::DB($db);
    }
    
    public function askhelp($params)
    {
       $dt= json_decode($params['dt'],1);
       $detls  = $dt['result'];
       $proErr  = $dt['error'];
       if($proErr['errCode']== 0)
       {
       $sql="INSERT 
             INTO 
                            tbl_contactus_master
                           (customer_email,
                            user_id,
                            logmobile,
                            customer_name,
                            customer_query,
                            active_flag,
                            date_time)
                 VALUES
                         (\"".$detls['cemail']."\",
                          \"".$detls['logmobile']."\",
                          \"".$detls['uid']."\",
                          \"".$detls['cname']."\",
                          \"".$detls['cquery']."\",
                              1,
                              now(),
                              now())";
           
           $res=$this->query($sql);
           if($res)
           {
               $arr='Query has been added';
               $err=array('Code'=>0,'Msg'=>'Insertion is done successfully');
           }
           else
           {
               $arr=array();
               $err=array('Code'=>1,'Msg'=>'Insertion unsuccessful');
           }
       }
       else
        {
           $arr=array();
           $err=array('Code'=>1,'Msg'=>'data parameters are incomplete');
        }
        $result=array('result'=>$arr,'error'=>$err);
        return $result;
    }
    
    public function viewhelp($params)
    {
        $chksql="SELECT
                                * 
                 FROM 
                                tbl_contactus_master 
                 WHERE 
                                active_flag=1 
                 ORDER BY 
                                date_time DESC";
        $page=$params['page'];
        $limit=$params['limit'];
        if (!empty($page))
        {
            $start = ($page * $limit) - $limit;
            $chksql.=" LIMIT " . $start . ",$limit";
        }
        $chkres=$this->query($chksql);
        $cntres=$this->numRows($chkres);
        if($cntres=1)
        {
            while($row=$this->fetchData($chkres))
            {
                $arr[]=$row;
            }
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
        