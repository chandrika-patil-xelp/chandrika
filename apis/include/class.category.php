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
        $arrs=explode(",", $params['attrs']);
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
        
        if(!$params['catid'])
        {
            
            $catid=  $this->lastInsertedId();
            foreach ($arrs as $val)
            {   
                $aflag=1;
                $tmparams=  array('catid'=>$catid,'attributeid'=>$val,'userid'=>$params['userid'],'active_flag'=>$aflag);
                $this->addCatAttrMapping($tmparams);
            }
        }
        else
        {
            $catid=$params['catid'];
            $activesql="UPDATE tbl_category_attribute_mapping SET active_flag =1  WHERE catid=".$catid." AND attributeid IN(".$params['attrs'].")";
            $dactivesql="UPDATE tbl_category_attribute_mapping SET active_flag =2  WHERE catid=".$catid." AND attributeid NOT IN(".$params['attrs'].")";
            
            $ares=  $this->query($activesql);
            $dares=  $this->query($dactivesql);
        }
        

        
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
                . "catid,pcatid,cat_name,active_flag "
                    . "FROM"
                        . " tbl_category_master ";
                            
        
        $res=  $this->query($sql);
        if($res)
        {
            while($row=  $this->fetchData($res))
            {
                $reslt['cid']       =    $row['catid'];
                $reslt['pid']       =    $row['pcatid'];
                $reslt['name']      =    $row['cat_name'];
                $reslt['active']      =    $row['active_flag'];
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
        
        $params=json_decode($params[0],1);
        $sql="UPDATE "
                . "tbl_category_master "
                    . "SET "
                        . "active_flag=".$params['active_flag'].",updatedby='".$params['userid']."' WHERE catid=".$params['catid']."";
        
        $res=$this->query($sql);
        $result=array();
        if($res)
        {
            $err=array('err_code'=>0,'err_msg'=>'Data updated successfully');
        }
        else{
            $err=array('err_code'=>1,'err_msg'=>'Error in updating');
        }
        $results=array('result'=>$result,'error'=>$err);
        return $results;
        
    }
    
    public function addCatAttrMapping($params)
    {
        $sql="INSERT INTO tbl_category_attribute_mapping (catid,attributeid,createdon,updatedby) VALUES("
                . "'".$params['catid']."',"
                . "'".$params['attributeid']."',"
                ."now(),"
                . "'".$params['userid']."')"
                . " ON DUPLICATE KEY UPDATE"
                . " active_flag = '".$params['active_flag']."',"
                . "createdon = now(),"
                . "updatedby = '".$params['userid']."'";
        
        $res=$this->query($sql);
        $result=array();
        if($res)
        {
            $err=array('err_code'=>0,'err_msg'=>'Data inserted successfully');
        }
        else{
            $err=array('err_code'=>1,'err_msg'=>'Error in inserting');
        }
        $results=array('result'=>$result,'error'=>$err);
        return $results;
        
    }
    
    public function manageCatAttrMapping($params)
    {
        
        $sql="UPDATE tbl_category_attribute_mapping SET  active_flag=".$params['active_flag'].", updatedby='".$params['userid']."' WHERE catid=". "'".$params['catid']."' AND attributeid=". "'".$params['attributeid']."'";
        $res=$this->query($sql);
        $result=array();
        if($res)
        {
            $err=array('err_code'=>0,'err_msg'=>'Data updated successfully');
        }
        else{
            $err=array('err_code'=>1,'err_msg'=>'Error in updating');
        }
        $results=array('result'=>$result,'error'=>$err);
        return $results;
    }
    
    
    public function getCategoryDetails($params)
    {   
        
        $sql="SELECT catid,pcatid,cat_name,cat_lvl,lineage,active_flag,createdon,updatedon,updatedby FROM tbl_category_master  WHERE catid="."'".$params['catid']."'";
        $res=  $this->query($sql);
        if($res)
        {
            $row=  $this->fetchData($res);            
            $catreslt['id']             =  $row['catid'];
            $catreslt['pid']            =  $row['pcatid'];
            $catreslt['name']           =  $row['cat_name'];
            $catreslt['cat_lvl']        =  $row['cat_lvl'];
            $catreslt['lineage']        =  $row['lineage'];
            $catreslt['aflag']          =  $row['active_flag'];
            $catreslt['createdon']      =  $row['createdon'];
            $catreslt['updatedon']      =  $row['updatedon'];
            $catreslt['updatedby']      =  $row['updatedby'];
            
            $err=array('err_code'=>0,'err_msg'=>'Data fetched successfully');
        }
        else
        {
            $err=array('err_code'=>1,'err_msg'=>'Error in fetching data');
        }
        
        $mapreslt=$this->getCatMapping($params['catid']);
        
        $result['category']=$catreslt;
        $result['mapping']=$mapreslt['result'];
        
        $results=array('result'=>$result,'error'=>$err);
        return $results;
        
    }
    
    
    public function getCatMapping($params)
    {
        
        $sql="Select catid,attributeid from tbl_category_attribute_mapping  WHERE active_flag=1 AND catid="."'".$params['catid']."'";
        $res=$this->query($sql);
        
        if($res)
        {
            while ($row=$this->fetchData($res))
            {
                global $db;
                include_once APICLUDE.'class.attributes.php';
                $attrobj=new attributes($db['jzeva']);
                $atrparm=array('attributeid'=>$row['attributeid']);
                $attreslt=$attrobj->getAttributeDetails($atrparm);
                $reslt['attributes']=$attreslt['result'];
                $result[]=$reslt['attributes'];
                $err=array('err_code'=>0,'err_msg'=>'Data fetched successfully');
            }
            
        }
        else
        {
            $err=array('err_code'=>1,'err_msg'=>'Error in fetching data');
        }
        $results=array('result'=>$result,'error'=>$err);
        return $results;
        
    }
    
}
?>