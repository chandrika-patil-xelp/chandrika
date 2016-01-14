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


    #Attributes

    

    default :

        break;
}
echo json_encode($res);
exit;
?>
