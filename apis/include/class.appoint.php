<?php
include APICLUDE.'common/db.class.php';
class appoint extends DB
{
    function __construct($db) 
    {
            parent::DB($db);
    }
                
    public function makeAppoint($params)
    {   
       $dt= json_decode($params['dt'],1);
       $detls  = $dt['result'];
       $proErr  = $dt['error'];
       if($proErr['errCode']== 0)
       { 
        $vsql=" SELECT 
                            appointment_id,
                            DATE_FORMAT(date_time, '%m/%d/%Y') as timespan 
                FROM 
                            tbl_stylist_appoint 
                WHERE 
                            user_id=".$detls['uid']." 
                AND 
                            meet_status=0 
                AND 
                            date_time BETWEEN NOW()-INTERVAL 30 DAY AND NOW()";
        $vres=$this->query($vsql);
        $chkres=$this->numRows($vres);
        if($chkres>0)
        {
            $arr=array();
            $err=array('code'=>1,'msg'=>"Insertion not done");
        }
        else if($chkres=0)
        {
       $isql =" INSERT 
                INTO 
                        tbl_stylist_appoint
                        (user_id,
                        customer_mobile,
                        customer_name,
                        customer_email,
                        customer_address,
                        product_type,
                        category,
                        budget,
                        meet_status,
                        display_flag,date_time)
                VALUES
                       (\"".$detls['uid']."\",
                        \"".$detls['cmob']."\",
                        \"".$detls['cname']."\",
                        \"".$detls['cemail']."\",
                        \"".$detls['fulladd']."\",
                        \"".$detls['ptype']."\",
                        \"".$detls['cat']."\",
                        \"".$detls['budget']."\",
                        0,
                        1,
                        now())";
        $ires=$this->query($isql);
            if($ires)
            {
            $arr="Stylist appointment is confirmed";
            $err=array('code'=>0,'msg'=>"Insert Operation Done");
            }
            else
            {       
                $arr=array();
                $err=array('code'=>1,'msg'=>"Error in insert operation");
            }
       }
       else
       {
            $arr=array();
            $err=array('code'=>1,'msg'=>'Error in decoding data');
       }
       }
        $result = array('results' =>$arr,'error'=>$err);
        return $result;
    }
    
    public function viewAppoint($params)
    {
        $vsql="SELECT 
                        customer_name AS customer_name,
                        customer_mobile AS customer_mobile,
                        customer_email AS customer_email,
                        full_address AS full_address,
                        product_type AS product_type,
                        category,
                        budget,
                        date_time 
                FROM 
                        tbl_stylist_appoint 
                WHERE 
                        meet_status=0
                AND 
                        display_flag=1
                ORDER BY 
                        appointid ASC";
        
        $page   = ($params['page'] ? $params['page'] : 1);
        $limit  = ($params['limit'] ? $params['limit'] : 15);
        
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
        
   }
?>       
        