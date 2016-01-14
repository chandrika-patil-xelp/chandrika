<?php

include_once  APICLUDE.'common/db.class.php';
class attributes extends DB
{
    function __construct($db) 
    {
            parent::DB($db);
    }
    
    public function addAttribute($params)
    {
        if(!$params['attributeid'])
        {
        $sql="INSERT INTO"
                . " tbl_attribute_master "
                    . "(attr_name,attr_type,attr_unit,attr_unit_pos,attr_pos,map_column,createdon,updatedby)"
                    . "VALUES("
                        . "'".$params['attr_name']."',"
                        . "".$params['attr_type'].","
                        . "'".$params['attr_unit']."',"
                        . "".$params['attr_unit_pos'].","
                        . "".$params['attr_pos'].","
                        . "'".$params['map_column']."',"
                        . "now(),"
                        . "".$params['userid'].")";
        }
        else
        {
            $sql="UPDATE tbl_attribute_master "
                    . "SET "
                            ."attr_name='".$params['attr_name']
                            ."',attr_type=".$params['attr_type']
                            .",attr_unit='".$params['attr_unit']
                            ."',attr_unit_pos=".$params['attr_unit_pos']
                            .",attr_pos=".$params['attr_pos']
                            .",map_column='".$params['map_column']
                            ."',updatedby='".$params['userid']
                            ."'"
                        ."WHERE "
                            . "attributeid=".$params['attributeid']."";
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
    
    
    
    public function getAttributeList()
    {
        
        $sql="SELECT attributeid,attr_name,attr_type,attr_unit,attr_unit_pos,attr_pos,map_column FROM tbl_attribute_master WHERE active_flag=1 ORDER By attributeid";
        $res=$this->query($sql);
        
        if($res)
        {
            while ($row=$this->fetchData($res))
            {
               
                $reslt['id']         = $row['attributeid'];
                $reslt['name']       = $row['attr_name'];
                $reslt['type']       = intval($row['attr_type']);
                $reslt['unit']       = $row['attr_unit'];
                $reslt['upos']       = intval($row['attr_unit_pos']);
                $reslt['apos']       = intval($row['attr_pos']);
                $reslt['col']        = $row['map_column'];
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
    
    
    
    public function changeAttributeStatus($params)
    {

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
        $sql="SELECT attributeid,attr_name,attr_type,attr_unit,attr_unit_pos,attr_pos,map_column,active_flag,createdon,updatedon,updatedby FROM tbl_attribute_master WHERE attributeid="."'".$params['attributeid']."'";
        
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
            $reslt['col']= $row['map_column'];
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
