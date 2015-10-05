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
          $isql="INSERT INTO tbl_offer_master(offername,des,amdp,valid,vdesc,udt,cdt,active_flag) 
                 VALUES ('".$params['offername']."','".$params['des']."',".$params['amdp'].",'".$params['valid']."','".$params['vdesc']."',now(),now(),0)";
        $ires=$this->query($isql);
        if($ires)
        {
            $arr="offer data is Inserted";
            $err= array('code' => 0, 'msg' => 'Entry done successfully in offer table');
        }
        else
        {
            $arr="Some problem in inserting values";
            $err= array('code' => 0, 'msg' => 'error in insert operation');
        }
        $result = array('results' => $arr, 'error' => $err);
        return $result;
    }
    
    public function viewOffer($params)
    {
        $vsql="SELECT offername,des,amdp,valid,vdesc,cdt FROM tbl_offer_master WHERE offid=".$params['offid']." AND active_flag=1";
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
            $arr="Some problem in fetching values";
            $err= array('code' => 1, 'msg' => 'error in fetching data');
        }
        $result = array('results' => $arr, 'error' => $err);
        return $result;
    }
    
    public function actOffer($params)
    {
        $vsql="UPDATE tbl_offer_master set active_flag=1 WHERE offid=".$params['offid'];
        $vres=$this->query($vsql);
        if($vres>0)
           {
               $arr="Offer id matched and set to active";
               $err= array('code' => 0, 'msg' => 'offer is activated');
           }
        else
        {
            $arr="Some problem in fetching values";
            $err= array('code' => 1, 'msg' => 'error in updating');
        }
        $result = array('results' => $arr, 'error' => $err);
        return $result;
    }
    
    public function deactOffer($params)
    {
        $vsql="UPDATE tbl_offer_master set active_flag=0 WHERE offid=".$params['offid'];
        $vres=$this->query($vsql);
        if($vres)
           {
                $arr="Offer has matched and deactivated";
                $err= array('code' => 0, 'msg' => 'Offer has been deactivated');
           }
        else
        {
            $arr="Some problem in updating data";
            $err= array('code' => 1, 'msg' => 'record regarding this id not found');
        }
        $result = array('results' => $arr, 'error' => $err);
        return $result;
    }
    
    public function offerUserBind($params)
    {
       $chsql="SELECT * from tbl_offer_user_mapping where user_id=".$params['uid']." and offerid=".$params['offerid']."";
        $chrs=$this->query($chsql);
        $chres=$this->numRows($chrs);
        if($chres<1)
        {
          $isql="INSERT INTO tbl_offer_user_mapping(offerid,user_id,display_flag,udt,cdt,active_flag) VALUES(".$params['offerid'].",".$params['uid'].",".$params['dispflag'].",now(),now(),1)";
            $ires=$this->query($isql);
            if($ires)
            {
                $arr="offer data is Inserted";
                $err= array('code' => 0, 'msg' => 'Entry done successfully ');
            }
            else
            {
                $arr="Some problem in inserting values";
                $err = array('code' => 0, 'msg' => 'error in insert operation');
            }
        }
        else
        {
            $arr="Offer is already been provided to user";
            $err = array('code' => 0, 'msg' => 'insertion is not done');
        }
        $result = array('results' => $arr, 'error' => $err);
        return $result;
    }

    public function offerUserUnBind($params)
    {
      $chsql="SELECT * from tbl_offer_user_mapping where user_id=".$params['uid']." and offerid=".$params['offid']."";
        $chrs=$this->query($chsql);
        $chres=$this->numRows($chrs);
        if($chres==1)
        {
       $isql="UPDATE tbl_offer_user_mapping SET active_flag=1 where user_id=".$params['uid']." and offerid=".$params['offid']."";
        $ires=$this->query($isql);
        if($ires)
        {
            $arr="offer data is unbinded";
            $err= array('code' => 0, 'msg' => 'Unsetting the offer is done');
        }
        else
        {
            $arr="Some problem in inserting values";
            $err = array('code' => 0, 'msg' => 'error in insert operation');
        }
        
        }
        else
        {
            $arr="Offer is already removed from user";
            $err = array('code' => 0, 'msg' => 'Update is not done');
        }
        $result = array('results' => $arr, 'error' => $err);
        return $result;
       
    }
    
    }

?>
