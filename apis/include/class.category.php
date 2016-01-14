<?php

include APICLUDE.'common/db.class.php';
class category extends DB
{
    function __construct($db) 
    {
            parent::DB($db);
    }
    
    
    
    public function addCategory($params)
    {   
        if(!$params['catid'])
        {
            $sql="INSERT INTO "
                    . "tbl_category_master "
                    . "(pcatid,cat_name,createdon,updatedby) "
                    . "VALUES(".$params['pcatid'].",'".$params['cat_name']."',now(),".$params['userid'].")";
        }
        else        
        {
            $sql="Update "
                    . "tbl_category_master "
                    . "SET  "
                    . "pcatid =".$params['pcatid'].",cat_name='".$params['cat_name']."',createdon=now(),updatedby='".$params['userid']."' WHERE catid=".$params['catid']."";
        }
        
        $res=$this->query($sql);
        $result=array();
        if($res)
        {
            $err=array('err_code'=>0,'err_msg'=>'Data inserted successfully');
        }else{
            $err=array('err_code'=>1,'err_msg'=>'Error in inserting');
        }
        $results=array('result'=>$result,'error'=>$err);
        return $results;
    }
    
    
    public function getCatgoryList()
    {
        
        $sql="SELECT "
                . "catid,pcatid,cat_name "
                    . "FROM"
                        . " tbl_category_master "
                            . "WHERE active_flag = 1";
        
        $res=  $this->query($sql);
        if($res)
        {
            while($row=  $this->fetchData($res))
            {
                $reslt['cid']       =    $row['catid'];
                $reslt['pid']       =    $row['pcatid'];
                $reslt['name']      =    $row['cat_name'];
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
    
    
    public function changeCategoryStatus($params)
    {
        $sql="UPDATE "
                . "tbl_category_master "
                    . "SET "
                        . "active_flag=".$params['active_flag'].",updatedby='".$params['userid']."' WHERE catid=".$params['catid']."";
        
        $res=$this->query($sql);
        $result=array();
        if($res)
        {
            $err=array('err_code'=>0,'err_msg'=>'Data updated successfully');
        }else{
            $err=array('err_code'=>1,'err_msg'=>'Error in updating');
        }
        $results=array('result'=>$result,'error'=>$err);
        return $results;
        
    }
}
?>
