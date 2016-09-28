<?php

require_once 'class.category.php';
class attributes extends DB
{
    function __construct($db) 
    {
            parent::DB($db);
    }
    
    
    
    public function addAttribute($params)
    {
      
        $params = json_decode($params[0],1);
        if(!$params['attributeid'])
        {
            global $comm;
            $params['attributeid']=$comm->generateId();
        
        }
        else
        {
            $attributeid= $params['attributeid'];
            
        }
                
        $sql="  INSERT
                INTO
                        tbl_attribute_master
                        (
                            attributeid,
                            attr_name,
                            attr_type,
                            attr_unit,
                            attr_unit_pos,
                            attr_pos,
                            attr_values,
                            createdon,
                            updatedby
                        )
                VALUES
                        (
                        \"".urldecode($params['attributeid'])."\",
                        \"".urldecode($params['attr_name'])."\",
                        \"".$params['attr_type']."\",
                        \"".$params['attr_unit']."\",
                        \"".$params['attr_unit_pos']."\",
                        \"".$params['attr_pos']."\",
                        \"".urldecode($params['attr_values'])."\",
                            now(),
                        \"".$params['userid']."\") 
                ON DUPLICATE KEY UPDATE 
                        attr_name = VALUES(attr_name),
                        attr_type=VALUES(attr_type),
                        attr_unit=VALUES(attr_unit),
                        attr_unit_pos=VALUES(attr_unit_pos),
                        attr_pos=VALUES(attr_pos),
                        attr_values = VALUES(attr_values),
                        updatedby=VALUES(updatedby)";
        
        $res=$this->query($sql);
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
    
    
    
    public function getAttributeList($params)
    {
        
        $sql1="
                SELECT 
                        attributeid,
                        attr_name,
                        attr_type,
                        attr_unit,
                        attr_unit_pos,
                        attr_pos,
                        attr_values,
                        active_flag 
                FROM 
                        tbl_attribute_master 
                ORDER BY 
                        createdon DESC ";
        
        $page = ($params['page'] ? $params['page'] : 1);
        $limit = ($params['limit'] ? $params['limit'] : 1000);
        //Making sure that query has limited rows
        if ($limit >1000 ) {
            $limit = 1000;
        }
        if (!empty($page)) {
            $start = ($page * $limit) - $limit;
            $sql1.=" LIMIT " . $start . ",$limit";
        }
        
        $res1=$this->query($sql1);
        
        if($this->numRows($res1)>0)
        {
            while ($row1=$this->fetchData($res1))
            {
                
                $reslt['id']            = $row1['attributeid'];
                $reslt['name']          = $row1['attr_name'];
                $reslt['type']          = intval($row1['attr_type']);
                $reslt['unit']          = $row1['attr_unit'];
                $reslt['upos']          = intval($row1['attr_unit_pos']);
                $reslt['apos']          = intval($row1['attr_pos']);
                $reslt['vals']          = $row1['attr_values'];
                $reslt['active']        = $row1['active_flag'];
                $reslt['catg']          = $this->getMappedCatg($row1['attributeid']);
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
    
    
    public function getMappedCatg($aid)
    {
        global $db;
        //$sql="SELECT catid AS ctid FROM tbl_category_attribute_mapping WHERE attributeid=".$aid."";
        $sql="SELECT catid AS ctid,(SELECT active_flag FROM `tbl_category_master` WHERE catid=ctid)  AS catFlag FROM tbl_category_attribute_mapping WHERE attributeid=".$aid." HAVING catFlag=1";
        $res = $this->query($sql);        
        if($res)
        {
           
            $catobj=new category($db['jzeva']);
            $catg=array();
            while ($row = $this->fetchData($res))
            {
                $cparams= array('catid'=>$row['ctid']);
                $cres=$catobj->getCategoryDetails($cparams);
                $name=$cres['result']['category']['name'];
                array_push($catg, $name);
                
            }
            $ct=implode($catg,",");
            return $ct;
        }
        
    }
    
    
    public function changeAttributeStatus($params)
    {
        
        $params= json_decode($params[0],1);
        
        $sql="UPDATE tbl_attribute_master "
                    . "SET "
                            ."active_flag='".$params['active_flag']
                            ."',updatedby='".$params['userid']
                            ."',updatedon=now()"
                        ."WHERE "
                            . "attributeid=".$params['attributeid']."";
        
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
    
    
    
    public function getAttributeDetails($params)
    {
        $sql="SELECT attributeid,attr_name,attr_type,attr_unit,attr_unit_pos,attr_pos,attr_values,active_flag,createdon,updatedon,updatedby FROM tbl_attribute_master WHERE attributeid="."'".$params['attributeid']."'";
        
        $res=  $this->query($sql);
        if($res)
        {
            $row=$this->fetchData($res);
            
            $reslt['attrid']= $row['attributeid'];
            $reslt['name']= $row['attr_name'];
            $reslt['type']= $row['attr_type'];
            $reslt['unit']= $row['attr_unit'];
            $reslt['upos']= $row['attr_unit_pos'];
            $reslt['apos']= $row['attr_pos'];
            $reslt['values']= $row['attr_values'];
            $reslt['aflag']= $row['active_flag'];
            $reslt['createdon']= $row['createdon'];
            $reslt['updatedon']= $row['updatedon'];
            $reslt['updatedby']= $row['updatedby'];
            $result=$reslt;
            
            $err=array('err_code'=>0,'err_msg'=>'Data fetched successfully');
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
