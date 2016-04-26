<?php

require_once APICLUDE.'common/db.class.php';
class category extends DB
{
    function __construct($db) 
    {
            parent::DB($db);
    }
    
    public function addCategory($params)
    {   
        $params = json_decode($params[0],1);
        $catid=0;
        if(!$params['catid'])
        {
            global $comm;
            $params['catid']=$comm->generateId();
        
        }
        else
        {
            $catid= $params['catid'];
        }
        
        $sql="INSERT INTO "
                . " tbl_category_master (catid,pcatid,cat_name,createdon,updatedby)"
                . " VALUES("
                        . "'".urldecode($params['catid'])."'"
                        . ",\"" . urldecode($params['pcatid']) . "\","
                        . "'".urldecode($params['cat_name'])."',"
                        . "now(),"
                        . "".$params['userid'].") "
                        . "ON DUPLICATE KEY UPDATE "
                                . "pcatid=VALUES(pcatid),"
                                . "cat_name=VALUES(cat_name),"
                                . "updatedby=VALUES(updatedby)";
        
        $res=$this->query($sql);
        
        $attrs=  urldecode($params['attrs']);
        
            $attrsAr =explode(",",$attrs);
            $tmparams=  array('catid'=>$params['catid'],'attributeids'=>$attrsAr,'userid'=>$params['userid']);
            $this->addCatAttrMapping($tmparams);
        
        
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
    
    
    public function getCatgoryList($params)
    {
        
        $sql="SELECT "
                . "catid,pcatid,cat_name,active_flag "
                    . "FROM"
                        //. " tbl_category_master  WHERE active_flag =1 ORDER BY createdon DESC ";
                        . " tbl_category_master  WHERE active_flag =1 ORDER BY cat_name ";
                            
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
        $res=  $this->query($sql);
        if($this->numRows($res)>0)
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
        $dactivesql="UPDATE tbl_category_attribute_mapping SET active_flag =2  WHERE catid=".$params['catid'];
        $dares=  $this->query($dactivesql);
                
        $sql="INSERT INTO tbl_category_attribute_mapping (catid,attributeid,createdon,updatedby) VALUES";
        foreach($params['attributeids'] as $key=>$val)
        {
            $tmpparams = array('catid' => $params['catid'],'attributeid'=>$val,'userid' => $params['userid']);
            $sql.="('" . $tmpparams['catid'] . "','" . $tmpparams['attributeid'] . "',now()," . $tmpparams['userid'] . "),";
        }
            
        $sql = trim($sql, ",");
        $sql.=" ON DUPLICATE KEY UPDATE updatedby=VALUES(updatedby),active_flag=1";
        
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
        $sql  = "SELECT catid,pcatid,cat_name,cat_lvl,lineage,active_flag,createdon,updatedon,updatedby FROM tbl_category_master WHERE catid='".$params['catid']."'";
        $res  = $this->query($sql);
        if($res)
        {
            $row                        =  $this->fetchData($res);
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
       
        $mapreslt=$this->getCatMapping($params);
        
        $result['category']=$catreslt;
        $result['mapping']=$mapreslt['result'];
        
        $results=array('result'=>$result,'error'=>$err);
        
        return $results;
        
    }
    
    
    public function getCatMapping($params)
    {
        global $db;
        require_once APICLUDE.'class.attributes.php';
        $attrobj=new attributes($db['jzeva']);
        
        $sql="Select catid,attributeid from tbl_category_attribute_mapping  WHERE active_flag=1 AND catid='".$params['catid']."'";
        $res=$this->query($sql);
        
        if($res)
        {
            
            while ($row=$this->fetchData($res))
            {
                
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
    
    
    public function getMultyCatMapping($params)
    {
        $params=  json_decode($params[0],1);
        $catList= explode(",", $params['catid']);
        
        global $db;
        require_once APICLUDE.'class.attributes.php';
        $attrobj=new attributes($db['jzeva']);
        
        $attrArray=array();
        foreach ($catList as $val)
        {
            $sql="Select catid,attributeid from tbl_category_attribute_mapping  WHERE active_flag=1 AND catid='".$val."'";
            $res=$this->query($sql);

            if($res)
            {
                while ($row=$this->fetchData($res))
                {
                   array_push($attrArray, $row['attributeid']);
                }
                $err=array('err_code'=>0,'err_msg'=>'Data fetched successfully');
            }
            else
            {
                $err=array('err_code'=>1,'err_msg'=>'Error in fetching data');
            }
            
        }
       
        $uniqattrs=array_values(array_unique($attrArray));
        foreach ($uniqattrs as $at)
        {
            $atrparm=array('attributeid'=>$at);
            $attreslt=$attrobj->getAttributeDetails($atrparm);
            $reslt['attributes']=$attreslt['result'];
            $result[]=$reslt['attributes'];
            
        }
        
        
        $results=array('result'=>$result,'error'=>$err);
        return $results;

    }
    
}
?>