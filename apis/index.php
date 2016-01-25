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
            $tmpparams=array('pcatid'=>$params['pcatid'],'cat_name'=>$params['cat_name'],'userid'=>$params['userid'],'catid'=>$params['catid'],'attrs'=>$params['attrs']);
        else
            $tmpparams=array('pcatid'=>$params['pcatid'],'cat_name'=>$params['cat_name'],'userid'=>$params['userid'],'attrs'=>$params['attrs']);
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

    case 'getCatAttrsIds':
        include APICLUDE.'class.category.php';
        $obj	= new category($db['jzeva']);
        $catid=9;;
        $result	=$obj->getCatAttrsIds($catid);
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

    #Product
    
    case 'addProduct':
        include APICLUDE.'class.product.php';
        $obj=new product($db['jzeva']);
        $tmpaparams = array($params['dt']);
        $result	=$obj->addProduct($tmpaparams);
        $res = $result;
    break;

    case 'getMetalColorIdByValue':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $result	=$obj->getMetalColorIdByValue();
        $res = $result;
    break;

    case 'getVendorList':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $result	=$obj->getVendorList();
        $res = $result;
    break;

    case 'getVendorDetailsById':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $vid=$params['vid'];
        $result	=$obj->getVendorDetailsById($vid);
        $res = $result;
    break;

    case 'getVendorDetailsByName':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $name=$params['name'];
        $result	=$obj->getVendorDetailsByName($name);
        $res = $result;
    break;

    case 'getDiamondQualityList':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $result	=$obj->getDiamondQualityList();
        $res = $result;
    break;

    case 'getGemstoneList':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $result	=$obj->getGemstoneList();
        $res = $result;
    break;

    case 'getSizeListByCat':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $tmpparams=array('catid'=>$params['catid']);
        $result	=$obj->getSizeListByCat($tmpparams);
        $res = $result;
    break;

    case 'getSizeList':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $result	=$obj->getSizeList();
        $res = $result;
    break;


    #Rate

    case 'addRates':
        include APICLUDE.'class.rate.php';
        $obj	= new rate($db['jzeva']);
        $result	=$obj->addRates();
        $res = $result;
    break;

    case 'addGoldRate':
        include APICLUDE.'class.rate.php';
        $obj	= new rate($db['jzeva']);
        $tmpparams= array('rate'=>$params['rate']);
        $result	=$obj->addGoldRate($tmpparams);
        $res = $result;
    break;

    case 'getGoldRates':
        include APICLUDE.'class.rate.php';
        $obj	= new rate($db['jzeva']);
        $result	=$obj->getGoldRates();
        $res = $result;
    break;

    case 'getDmdRates':
        include APICLUDE.'class.rate.php';
        $obj	= new rate($db['jzeva']);
        $result	=$obj->getDmdRates();
        $res = $result;
    break;

    case 'getAllRates':
        include APICLUDE.'class.rate.php';
        $obj	= new rate($db['jzeva']);
        $result	=$obj->getAllRates();
        $res = $result;
    break;

    case 'getMetalColorList':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $result	=$obj->getMetalColorList();
        $res = $result;
    break;


    
    case 'test':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $result	=$obj->test();
        $res = $result;
    break;


    




    default :

        break;
}
echo json_encode($res);
exit;
?>
