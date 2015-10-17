<?php

include APICLUDE.'common/db.class.php';
class viewlog extends DB
{
        function __construct($db) 
        {
            parent::DB($db);
        }

        
        ## For fetching user details of customer
        
        /* 
         * Fetch Details of user from tbl_registration
         * fetch details of clicked Product according to product_id passed while clicking
         * 
         * Fill details using two arrays. 1-- udetail  2-- prod
         * 
         *  */
   public function filLog($params)
    {  
        $uid=$params['uid'];
        $udsql="            SELECT 
                                        user_name,
                                        email
                            FROM 
                                        tbl_registration 
                            WHERE
                                        user_id=".$uid."";
        $udres=$this->query($udsql);
        $chkres=$this->numRows($udres);
        if($chkres=1)
        {
            while($row1=$this->fetchData($udres)) 
            {
                $udetail['uname']=$row1['user_name'];
                $udetail['email']=$row1['email'];
            }
          $isql="           INSERT INTO
                                        tbl_viewlog
                                            (user_id,
                                            user_name,
                                            email,
                                            product_id,
                                            vendor_id,
                                            updated_by,
                                            date_time)
                            VALUES  
                                        (".$uid.",
                                        '".$udetail['uname']."',
                                        '".$udetail['email']."',
                                        ".$params['pid'].",
                                        ".$params['vid'].",
                                        'customer',
                                        now())";
            $ires=$this->query($isql);
            if($ires)
            {
                $arr="Log Entry is successfully completed";
                $err=array('Code'=>0,'Msg'=>'Data inserted');
            }
        else
        {
            $arr=array();
            $err=array('Code'=>1,'Msg'=>'Error in completing the operation');
        }
        }
        $result=array('results'=>$arr,'error'=>$err);
        return $result;
    }
    
    # view log by vendor for his product being viewed
    
    public function viewLog($params)
    {
        # check the products under the requested vendor
        
       $page   = ($params['page'] ? $params['page'] : 1);
       $limit  = ($params['limit'] ? $params['limit'] : 15);
        $viewprod="         SELECT 
                                    user_id,  
                                    user_name,
                                    email,
                                    date_time,
                                    product_id 
                            FROM 
                                    tbl_viewlog 
                            WHERE
                                    vendor_id=".$params['vid']."";
        if (!empty($page))
        {
            $start = ($page * $limit) - $limit;
            $viewprod.=" LIMIT " . $start . ",$limit";
        }
        $viewres=$this->query($viewprod);
        $chkres=$this->numRows($viewres);
        if($chkres>0)
        {   
            while($row=$this->fetchData($viewres))
            {   
                $arr[]=$row;
            }
            $err=array('Code'=>0,'Msg'=>'Values fetched successfully');
        }
        else
        {
            $arr=array();
            $err=array('Code'=>0,'Msg'=>'No Values fetched');
        }
        $result=array('result'=>$arr,'error'=>$err);
        return $result;
    }    
}
                