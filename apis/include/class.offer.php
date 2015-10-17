<?php
include APICLUDE . 'common/db.class.php';
class offer extends DB
{
    function __construct($db) 
    {
        parent::DB($db);
        
    }
    
    public function addOffer($params)
    {
          $isql="INSERT 
                 INTO 
                                 tbl_offer_master
                                (offer_name,
                                 offer_description,
                                 offer_discount_percentage,
                                 offer_validity_days,
                                 offer_voucher_description,
                                 active_flag,
                                 date_time)
                                 
                 VALUES 
                             (\"".$params['offername']."\",
                              \"".$params['des']."\",
                              \"".$params['amdp']."\",
                              \"".$params['valid']."\",
                              \"".$params['vdesc']."\",
                                  1,
                                  now())";
        $ires=$this->query($isql);
        if($ires)
        {
            $arr="offer data is Inserted";
            $err= array('code' => 0, 'msg' => 'Entry done successfully in offer table');
        }
        else
        {
            $arr=array();
            $err= array('code' => 0, 'msg' => 'error in insert operation');
        }
        $result = array('results' => $arr, 'error' => $err);
        return $result;
    }
    
    public function viewOffer($params)
    {
        $vsql="SELECT
                                offer_name,
                                offer_description,
                                offer_discount_percentage,
                                offer_validity_days,
                                offer_voucher_description,
                                date_time
               FROM 
                                tbl_offer_master
               WHERE 
                                offer_id=".$params['offid']." 
               AND 
                                active_flag=1";
        $vres=$this->query($vsql);
        if($this->numRows($vres)>0)
           {
               while($row=$this->fetchData($vres))
               {
                   $arr[]=$row;
                   
               }
               $err= array('code' => 0, 'msg' => 'offer information has been retreived');
           }
        else
        {
            $arr=array();
            $err= array('code' => 1, 'msg' => 'error in fetching data');
        }
        $result = array('results' => $arr, 'error' => $err);
        return $result;
    }
    
    public function actOffer($params)
    {
        $vsql="UPDATE
                                tbl_offer_master
               SET 
                                active_flag=1
               WHERE 
                                offer_id=".$params['offid'];
        $vres=$this->query($vsql);
        if($vres>0)
           {
               $arr="Offer id matched and set to active";
               $err= array('code' => 0, 'msg' => 'offer is activated');
           }
        else
        {
            $arr=array();
            $err= array('code' => 1, 'msg' => 'error in updating');
        }
        $result = array('results' => $arr, 'error' => $err);
        return $result;
    }
    
    public function deactOffer($params)
    {
        $vsql="UPDATE 
                            tbl_offer_master
               SET
                            active_flag=0 
               WHERE 
                            offer_id=".$params['offid'];
        $vres=$this->query($vsql);
        if($vres)
           {
                $arr="Offer has matched and deactivated";
                $err= array('code' => 0, 'msg' => 'Offer has been deactivated');
           }
        else
        {
            $arr=array();
            $err= array('code' => 1, 'msg' => 'record regarding this id not found');
        }
        $result = array('results' => $arr, 'error' => $err);
        return $result;
    }
    
    public function offerUserBind($params)
    {
       $chsql="SELECT
                            * 
               FROM 
                            tbl_offer_user_mapping
               WHERE 
                            user_id=".$params['uid']." 
               AND 
                            offer_id=".$params['offerid']."";
       
        $chrs=$this->query($chsql);
        $chres=$this->numRows($chrs);
        if($chres<1)
        {
          $isql="INSERT 
                 INTO
                                        tbl_offer_user_mapping
                                       (offer_id,
                                        user_id,
                                        active_flag,
                                        date_time)
                 VALUES
                                     (".$params['offerid'].",
                                      ".$params['uid'].",
                                      ".$params['dispflag'].",
                                        now())";
            $ires=$this->query($isql);
            if($ires)
            {
                $arr="offer data is Inserted";
                $err= array('code' => 0, 'msg' => 'Entry done successfully ');
            }
            else
            {
                $arr=array();
                $err = array('code' => 0, 'msg' => 'error in insert operation');
            }
        }
        else
        {
            $arr=array();
            $err = array('code' => 0, 'msg' => 'insertion is not done');
        }
        $result = array('results' => $arr, 'error' => $err);
        return $result;
    }

    public function offerUserUnBind($params)
    {
      $chsql="SELECT 
                            * 
              FROM 
                            tbl_offer_user_mapping
              WHERE
                            user_id=".$params['uid']." 
              AND
                            offerid=".$params['offid']."";
        $chrs=$this->query($chsql);
        $chres=$this->numRows($chrs);
        if($chres==1)
        {
       $isql="UPDATE 
                                tbl_offer_user_mapping
              SET 
                                active_flag=1
              WHERE 
                                user_id=".$params['uid']." 
              AND 
                                offerid=".$params['offid']."";
       
        $ires=$this->query($isql);
        if($ires)
        {
            $arr="offer data is unbinded";
            $err= array('code' => 0, 'msg' => 'Unsetting the offer is done');
        }
        else
        {
            $arr=array();
            $err = array('code' => 0, 'msg' => 'error in insert operation');
        }
        
        }
        else
        {
            $arr=array();
            $err = array('code' => 0, 'msg' => 'Update is not done');
        }
        $result = array('results' => $arr, 'error' => $err);
        return $result;       
    }    
    }
?>
