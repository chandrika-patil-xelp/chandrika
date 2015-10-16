<?php
include APICLUDE . 'common/db.class.php';
class attribute extends DB
{
    function __construct($db) 
    {
        parent::DB($db);
        
    }
    
    public function get_attrList($params)
    {
        $sql = "SELECT 
                            attribute_id,
                            attribute_name,
                            attribute_display_name,
                            attribute_unit,
                            attribute_type_flag,
                            attribute_unit_position,
                            attrinute_values,
                            attribute_range,
                            use_list
                FROM 
                            tbl_attribute_master 
                ORDER BY 
                            attribute_id ASC";
        $page   = ($params['page'] ? $params['page'] : 1);
        $limit  = ($params['limit'] ? $params['limit'] : 15);
        if (!empty($page))
        {
            $start = ($page * $limit) - $limit;
            $sql.=" LIMIT " . $start . ",$limit";
        }
        
        $res = $this->query($sql); 
	if($res)
        {
            while($row1=$this->mysqlFetchArr($res)) 
            {
                $arr[] = $row1;
            }
            $err=array('Code'=>0,'Msg'=>'Data Fetched Successfully');
        }
        $result= array('result'=>$arr,'error'=>$err);
	return $result;
    }
    
    public function set_attributes_details($params)
    {
	$name 	= $params['name'];
	$dname 	= $params['dname'];
	$unit 	= $params['unit'];
	$flag 	= $params['flag'];
	$upos 	= $params['upos'];
	$vals 	= $params['vals'];
	$range 	= $params['range'];
        $uselist= $params['uselist'];

	# INSERTING REQUIRED DATA #
        $sql = "INSERT
                INTO 
                            tbl_attribute_master 
                SET 
                            attribute_name=\"".$name."\",
                            attribute_display_name=\"".$dname."\",
                            attribute_unit=\"".$unit."\",
                            attribute_type_flag=\"".$flag."\",
                            attribute_unit_position=\"".$upos."\",
                            attribute_values=\"".$vals."\",
                            attribute_range=\"".$range."\",
                            use_list=\"".$uselist."\"";
	$res = $this->query($sql);
	if($res)
        { 
            $err=array('Code'=>0,'Msg'=>'Data Insertion Successfull');
            $arr="New Attribute Inserted";
	}
        else
        {
            $err=array('Code'=>1,'Msg'=>'Data Insertion failed');
            $arr=array();
        }
        $result=array('result'=>$arr,'error'=>$err);
	return $result;
    }
    
    public function fetch_attributes_details($params)
    {
        $sql = "SELECT 
                        attribute_id,
                        attribute_name,
                        attribute_display_name,
                        attribute_unit,
                        attribute_type_flag,
                        attribute_unit_position,
                        attribute_values,
                        attribute_range,
                        use_list
                FROM 
                        tbl_attribute_master 
                WHERE 
                        attribute_id=".$params['attribid']." 
                ORDER BY 
                        attribute_id ASC";
        
	$res    = $this->query($sql);
        $chkres=$this->numRows($res);
        if($chkres>0)
        {
            while($row1 = $this->mysqlFetchArr($res))
            {
                $arr[] = $row1;
            }
            $err=array('Code'=>0,'Msg'=>'Values are fetched successfully');
        }
        else
        {
            $arr=array();
            $err=array('Code'=>1,'Msg'=>'Error in fetching data');
        }
        $result=array('result'=> $arr,'error'=>$err);
	return $result;
    }

    public function set_category_mapping($params)
    {
	$aid 		= $params['aid'];
	$dflag 		= $params['dflag'];
	$dpos 		= $params['dpos'];
	$fil_flag 	= $params['fil_flag'];
	$fil_pos 	= $params['fil_pos'];
	$aflag	 	= $params['aflag'];
	$catid 		= $params['catid'];
        $chksql="SELECT count(1) from tbl_attribute_category_mapping where attribute_id=".$aid." and category_id=".$catid."";
        $ckres=$this->query($chksql);
        $chkres=$this->numRows($ckres);
        if($chkres==0)
        {
        $sql = "INSERT 
                            INTO 
                            tbl_attribute_category_mapping 
                SET 
                            attribute_id=\"".$aid."\",
                            attribute_display_flag =\"".$dflag."\",
                            attribute_display_position=\"".$dpos."\",
                            attribute_filter_flag = \"".$fil_flag."\",
                            attribute_filter_position=\"".$fil_pos."\",
                            active_flag=\"".$aflag."\",
                            category_id=\"".$catid."\"";
        $res = $this->query($sql);
            if($res)
            { 
                $arr="Mapping completion successfull";
                $err=array('Code'=>0,'Msg'=>'Data Insert Successfully');
            }
            else
            {
                $arr=array();
                $err=array('Code'=>1,'Msg'=>'Problem in Insertion');
            }
        }
        else
        {
                $arr=array();
                $err=array('Code'=>1,'Msg'=>'Insert operation not commited');
        }
        $result=array('result'=>$arr,'error'=>$err);
	return $result;
    }
    
    public function fetch_category_mapping($params)
    {
        $mapsql="SELECT
                                attribute_id 
                 FROM 
                                tbl_attribute_category_mapping
                 WHERE 
                                category_id=".$params['catid']."
                 ORDER BY 
                                category_id ASC";
        $mapres=$this->query($mapsql);
        $cres=$this->numRows($mapres);
        if($cres>0)
        {
            $i=0;
            while($row=$this->fetchData($mapres)) 
            {
            $attributeMap['attrid'][$i]=$row['attribute_id'];
            $i++;
            }
            $atribs=implode(',',$attributeMap['attrid']);
            
            $attrsql="SELECT 
                                    attribute_name,
                                    attribute_display_name,
                                    attribute_unit,
                                    attribute_type_flag,
                                    attribute_unit_position,
                                    attribute_values,
                                    attribute_range,
                                    use_list
                      FROM 
                                    tbl_attribute_master
                      WHERE 
                                    attribute_id IN(".$atribs.") 
                     ORDER BY 
                                    attribute_id ASC";
            $res = $this->query($attrsql); 
            if($res)
            {   
                while($row1=$this->fetchData($res)) 
                {
                    $attrs['atrribute_Name']=$row1['attr_name'];
                    $attrs['attribute_Disp_Name']=$row1['attr_display_name'];
                    $attrs['attribute_Unit']=$row1['attr_unit'];
                    $attrs['attribute_Num_Flag']=$row1['attr_type_flag'];
                    $attrs['attribtue_Unit_Pos']=$row1['attr_unit_pos'];
                    $attrs['attribute_Values']=$row1['attr_values'];
                    $attrs['attribute_Range']=$row1['attr_range'];
                    $attrs['attribute_uselist']=$row1['use_list'];
                    $attribute[]=$attrs;
                }
                $arr=array('attributes'=>$attribute,'attribute_Map'=>$attributeMap);
                $err=array('Code'=>'0','Msg'=>'Values are Fetched');
            }
            else
            {
                $arr=array();
                $err=array('Code'=>0,'Msg'=>'Values not found');
            }
        }
        else
        {
            $arr=array();
            $err=array('code'=>1,'Msg'=>'Error in fetching data');
        }
        $result=array('results'=>$arr,'error'=>$err);
        return $result;
    }
    
    function unset_category_mapping($params) 
    {   
        $sql = "UPDATE tbl_attribute_category_mapping SET active_flag=2 WHERE category_id=".$params['catid']." AND attribute_id=".$params['aid'];
	$res = $this->query($sql);
	if($res) 
        { 
	$arr="Value has been cleared from attributes";
        $err=array('code'=>0, 'msg'=>'Data Deleted Successfully');
	}
        $result=array('result'=>$arr,'error'=>$err);
	return $result;
    }
}
?>