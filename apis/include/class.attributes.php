<?php

include APICLUDE.'common/db.class.php';
class attributes extends DB
{
    function __construct($db) 
    {
            parent::DB($db);
    }
    
    public function addAttributes($params)
    {
        /*$sql="INSERT INTO tbl_attribute_master (attr_name,attr_type,attr_unit,attr_unit_pos,attr_pos,map_column,createdon,updatedby)"
                . "VALUES("
                . "'".$params['attr_name']."',"
                . "$params[]"
                . "";*/
        
    }
    
    
}
?>
