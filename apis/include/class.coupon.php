<?php
require_once APICLUDE.'common/db.class.php';

class coupon extends DB 
{
    
    function __construct($db) {
        parent::DB($db);
    }
    
    
    public function addCoupon($params)
    {
        global $comm;
        $params=  json_decode($params[0],1);
        if(!$params['coupon_id'])
        {
            $cpid=$comm->generateId();
            $ccode= $this->generateCouponCode();
            $params['coupon_id']=$cpid;
            //$params['coupon_code']=$ccode;
        }
            
            $params['start_date']=date_format(date_create($params['start_date']),"Y-m-d");
            $params['end_date']=date_format(date_create($params['end_date']),"Y-m-d");
        
            $sql="INSERT INTO "
                . "tbl_coupon_master "
                . "(coupon_id,coupon_name,coupon_code, discount_type, discount_amount, minimum_amount, description, start_date, end_date, active_flag,createdon,updatedby)"
                . " VALUES("
                        . "'".$params['coupon_id']."',"
                        . "'".urldecode($params['coupon_name'])."',"
                        . "'".urldecode($params['coupon_code'])."',"
                        . "'".$params['discount_type']."',"
                        . "'".$params['discount_amount']."',"
                        . "'".$params['minimum_amount']."',"
                        . "'".urldecode($params['description'])."',"
                        . "'".$params['start_date']."',"
                        . "'".$params['end_date']."',"
                        . "'".$params['active_flag']."',"
                        . "now(),"
                        . "'".$params['userid']."'"
                    . ")  "
                . "ON DUPLICATE KEY UPDATE "
                    . "description='".urldecode($params['description'])."',"
                    . "start_date='".$params['start_date']."',"
                    . "end_date='".$params['end_date']."',"
                    . "active_flag=".$params['active_flag'].","
                    . "updatedby='".$params['userid']."'";
                
        $res=  $this->query($sql);
        $result=array();
        if($res)
        {
            $err=array('err_code'=>0,'err_msg'=>'Data inserted successfully');
        }
        else
        {
            $err=array('err_code'=>1,'err_msg'=>'Error in inserting');
        }
        
        $results=array('result'=>$result,'error'=>$err);
        return $results;
        
    }
    
    
    private function generateCouponCode()
    {
        $code='JZEVA12525';
        return $code;
    }
    
   
    public function getCouponList($params)
    {
        global $comm;        
        $sql="  SELECT
                        * 
                FROM
                        tbl_coupon_master 
                WHERE 
                        active_flag=1
                ORDER BY
                        createdon DESC 
                ";
        
        $page = ($params['page'] ? $params['page'] : 1);
        $limit = ($params['limit'] ? $params['limit'] : 1000);
        //Making sure that query has limited rows
        if ($limit >1000 ) {
            $limit = 1000;
        }
        if (!empty($page)) {
            $start = ($page * $limit) - $limit;
            $sql.=" LIMIT " . $start . ",$limit";
        }
        $res= $this->query($sql);
        
        if($this->numRows($res)>0)
        {
            while($row = $this->fetchData($res))
            {
                $reslt['id']            =  $row['coupon_id'];   
                $reslt['code']          =  $row['coupon_code']; 
                $reslt['name']          =  $row['coupon_name']; 
                $reslt['dist_type']     =  $row['discount_type']; 
                $reslt['dist_amount']   =  intval($row['discount_amount']); 
                $reslt['min_amount']    =  intval($row['minimum_amount']); 
                $reslt['desc']          =  $row['description']; 
                $reslt['stdate']        =  $comm->makeDate($row['start_date']); 
                $reslt['enddate']       =  $comm->makeDate($row['end_date']); 
                $reslt['aflag']         =  $row['active_flag']; 
                $reslt['cdt']           =  $comm->makeDate($row['createdon']); 
                $reslt['udt']           =  $row['updatedon']; 
                $reslt['updby']         =  $row['updatedby']; 
                $result[]=$reslt;
            }
            $err=array('err_code'=>0,'err_msg'=>'Data fetched successfully');
        }
        else
        {
            $err=array('err_code'=>1,'err_msg'=>'Error in fetching data');
        }
        
        $results=array('result'=>$result,'error'=>$err);
        return $results;
        
    }
    
    
    
    public function getCouponDetailsById()
    {
        global $comm;
        $params= array('couponid'=>'8420160201203118');
        $sql="SELECT * FROM tbl_coupon_master WHERE coupon_id='".$params['couponid']."'";
        $res= $this->query($sql);
        
        if($res)
        {
            $row = $this->fetchData($res);
            $reslt['id']            =  $row['coupon_id'];   
            $reslt['code']          =  $row['coupon_code']; 
            $reslt['name']          =  $row['coupon_name']; 
            $reslt['dist_type']     =  $row['discount_type']; 
            $reslt['dist_amount']   =  intval($row['discount_amount']); 
            $reslt['min_amount']    =  intval($row['minimum_amount']); 
            $reslt['desc']          =  $row['description']; 
            $reslt['stdate']        =  $comm->makeDate($row['start_date']); 
            $reslt['enddate']       =  $comm->makeDate($row['end_date']); 
            $reslt['aflag']         =  $row['active_flag']; 
            $reslt['cdt']           =  $row['createdon']; 
            $reslt['udt']           =  $row['updatedon']; 
            $reslt['updby']         =  $row['updatedby']; 
            $result[]=$reslt;

            $err=array('err_code'=>0,'err_msg'=>'Data fetched successfully');
        }
        else
        {
            $err=array('err_code'=>1,'err_msg'=>'Error in fetching data');
        }
        
        $results=array('result'=>$result,'error'=>$err);
        return $results;
        
    }
    
    function updateCouponStatus($params)
    {
        //$params= array('active_flag'=>2,'userid'=>5,'couponid'=>'8420160201203118');
        $params=  json_decode($params[0],1);
        
        $sql="UPDATE tbl_coupon_master SET active_flag=".$params['active_flag'].",updatedby='".$params['userid']."'  WHERE coupon_id='".$params['coupon_id']."'";
        $res=  $this->query($sql);
        $result=array();
        if($res)
        {
            $err=array('err_code'=>0,'err_msg'=>'Data updated successfully');
        }
        else
        {
            $err=array('err_code'=>1,'err_msg'=>'Error in updating');
        }
        
        $results=array('result'=>$result,'error'=>$err);
        return $results;
    }
    
}
?>