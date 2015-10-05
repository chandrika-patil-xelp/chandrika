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
        $vsql="SELECT DATE_FORMAT(cdt, '%m/%d/%Y') FROM tbl_stylist_appoint WHERE user_id=".$detls['uid']." AND meet_status=0 AND cdt BETWEEN NOW() - INTERVAL 30 DAY AND NOW()";
        $vres=$this->query($vsql);
        $chkres=$this->numRows($vres);
        if($chkres>0)
        {
            $arr="Appointment is already being confirmed by this number";
            $err=array('code'=>1,'msg'=>"Insertion not done");
        }
        else if($chkres=0)
        {
       $isql = "INSERT INTO tbl_stylist_appoint(user_id,cust_mobile,cust_name,cust_email,fulladd,prd_type,category,budget,meet_status,display_flag,cdt,udt)
                VALUES(".$detls['uid'].",".$detls['cmob'].",'".$detls['cname']."','".$detls['cemail']."','".$detls['fulladd']."','".$detls['ptype']."','".$detls['cat']."','".$detls['budget']."',0,1,now(),now())";
        $ires=$this->query($isql);
            if($ires)
            {
            $arr="Stylist appointment is confirmed";
            $err=array('code'=>0,'msg'=>"Insert Operation Done");
            }
            else
            {       
                $arr="Problem in making appointment";
                $err=array('code'=>1,'msg'=>"Error in insert operation");
            }
       }
       else
       {
            $arr='Data is not passed properly';
            $err=array('code'=>1,'msg'=>'Error in decoding data');
       }
       }
        $result = array('results' =>$arr,'error'=>$err);
        return $result;
    }
    
    public function viewAppoint($params)
    {
        $vsql="SELECT cust_name,cust_mobile,cust_email,fulladd,prd_type,category,budget,cdt from tbl_stylist_appoint where meet_status=0 and display_flag=1";
        $page=$params['page'];
        $limit=$params['limit'];
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
            $arr='There is no appointment request active';
            $err=array('Code'=>1,'Msg'=>'No match found');
        }
        $result=array('results'=>$arr,'error'=>$err);
        return $result;
    }
        
   }
?>       
        