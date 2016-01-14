<?php
include '../config.php';
$params = array_merge($_GET, $_POST);
$params = array_merge($params, $_FILES);
$action = $_GET['action'];

if($params['debug'])
{
    echo "<pre>";
    print_r($params);
    echo "</pre>";
    
}


switch($action)
{
    #Category
    
    case 'addCategory':
        include APICLUDE.'class.category.php';
        $obj	= new category($db['jzeva']);
        if($params['catid'])        
            $tmpparams=array('pcatid'=>$params['pcatid'],'cat_name'=>$params['cat_name'],'userid'=>$params['userid'],'catid'=>$params['catid']);
        else
            $tmpparams=array('pcatid'=>$params['pcatid'],'cat_name'=>$params['cat_name'],'userid'=>$params['userid']);
        $result	=$obj->addCategory($tmpparams);
        $res = $result;
    break;
    
    case 'getCatgoryList':
        include APICLUDE.'class.category.php';
        $obj	= new category($db['jzeva']);
        $result	=$obj->getCatgoryList();
        $res = $result;
    break;
    
    case 'changeCategoryStatus':
        include APICLUDE.'class.category.php';
        $obj	= new category($db['jzeva']);
        $tmpparams=array('active_flag'=>$params['active_flag'],'userid'=>$params['userid'],'catid'=>$params['catid']);
        $result	=$obj->changeCategoryStatus($tmpparams);
        $res = $result;
    break;

    case 'addCatAttrMapping':
        include APICLUDE.'class.category.php';
        $obj	= new category($db['jzeva']);
        $tmpparams=array('userid'=>$params['userid'],'catid'=>$params['catid'],'attributeid'=>$params['attributeid'],);
        $result	=$obj->addCatAttrMapping($tmpparams);
        $res = $result;
    break;

    case 'manageCatAttrMapping':
        include APICLUDE.'class.category.php';
        $obj	= new category($db['jzeva']);
        $tmpparams=array('active_flag'=>$params['active_flag'],'userid'=>$params['userid'],'catid'=>$params['catid'],'attributeid'=>$params['attributeid']);
        $result	=$obj->manageCatAttrMapping($tmpparams);
        $res = $result;
    break;

    case 'getCategoryDetails':
        include APICLUDE.'class.category.php';
        $obj	= new category($db['jzeva']);
        $tmpparams=array('catid'=>$params['catid']);
        $result	=$obj->getCategoryDetails($tmpparams);
        $res = $result;
    break;

    case 'getCatMapping':
        include APICLUDE.'class.category.php';
        $obj	= new category($db['jzeva']);
        $tmpparams=array('catid'=>$params['catid']);
        $result	=$obj->getCatMapping($tmpparams);
        $res = $result;
    break;






    #Attributes
    
    case 'addAttribute':
        include APICLUDE.'class.attributes.php';
        $obj	= new attributes($db['jzeva']);
        if($params['attributeid'])        
            $tmpparams=array('attributeid'=>$params['attributeid'],'attr_name'=>$params['attr_name'],'attr_type'=>$params['attr_type'],'attr_unit'=>$params['attr_unit'],'attr_unit_pos'=>$params['attr_unit_pos'],'attr_pos'=>$params['attr_pos'],'map_column'=>$params['map_column'],'userid'=>$params['userid']);
        else
            $tmpparams=array('attr_name'=>$params['attr_name'],'attr_type'=>$params['attr_type'],'attr_unit'=>$params['attr_unit'],'attr_unit_pos'=>$params['attr_unit_pos'],'attr_pos'=>$params['attr_pos'],'map_column'=>$params['map_column'],'userid'=>$params['userid']);
        $result	=$obj->addAttribute($tmpparams);
        $res = $result;
    break;
    
    case 'getAttributeList':
        include APICLUDE.'class.attributes.php';
        $obj	= new attributes($db['jzeva']);
        $result	=$obj->getAttributeList();
        $res = $result;
    break;
    
    case 'changeAttributeStatus':
        include APICLUDE.'class.attributes.php';
        $obj	= new attributes($db['jzeva']);
        $tmpparams=array('active_flag'=>$params['active_flag'],'userid'=>$params['userid'],'attributeid'=>$params['attributeid']);
        $result	=$obj->changeAttributeStatus($tmpparams);
        $res = $result;
    break;

    case 'getAttributeDetails':
        include APICLUDE.'class.attributes.php';
        $obj	= new attributes($db['jzeva']);
        $tmpparams=array('attributeid'=>$params['attributeid']);
        $result	=$obj->getAttributeDetails($tmpparams);
        $res = $result;
    break;


    

    default :

        break;
}
echo json_encode($res);
exit;
?>
