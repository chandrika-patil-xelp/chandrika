<?php

include '../config.php';
$params = array_merge($_GET, $_POST);
$action = (!empty($params['action'])) ? trim($params['action']) : '';
$case = (!empty($params['case'])) ? trim($params['case']) : '';

if($params['debug'])
{
    echo "<pre>";print_r($params);echo "</pre>";
}

switch ($action) {
    case 'products':
        $page = 'products';
        $tab = 'products';
        include BTEMPLATE.'products.html';
        break;
    case 'addProduct':
        $page = 'addProduct';
        $tab = 'products';
        include BTEMPLATE.'addProduct.html';
        break;

    case 'upload':
        $pid = $_GET['pid'];
        $page = 'upload';
        setcookie("back", $_SERVER['HTTP_REFERER']);
        include 'image-upload/index.html';
        break;
    
    case 'productPreview':
        $page = 'productPreview';
        $tab = 'products';
        include BTEMPLATE.'productPreview.html';
        break;
    
    case 'category':
        $page = 'category';
        $tab = 'category';
        include BTEMPLATE.'category.html';
        break;
    
    case 'addCategory':
        $page = 'addCategory';
        $tab = 'category';
        $edit=0;
        include BTEMPLATE.'addCategory.html';
        break;
    
    case 'editCategory':
        $page = 'addCategory';
        $tab = 'category';
        $cid=$params['cid'];
        $url = APIDOMAIN . "index.php?action=getCategoryDetails&catid=" . $cid;
        $res = $comm->executeCurl($url);
        $data = $res['result'];
        $data= json_encode($data);
        $edit=1;
        include BTEMPLATE.'addCategory.html';
        break;
    
    case 'attributes':
        $page = 'attributes';
        $tab = 'attribute';        
        include BTEMPLATE.'attributes.html';
        break;
    
    case 'addAttribute':
        $page = 'addAttribute';
        $tab = 'attribute';
        $edit=0;
        include APICLUDE.'class.attributes.php';
        include BTEMPLATE.'addAttribute.html';
        break;
    
    case 'editAttribute':
        $page = 'addAttribute';
        $tab = 'attribute';
        $aid=$params['aid'];
        $url = APIDOMAIN . "index.php?action=getAttributeDetails&attributeid=" . $aid;
        $res = $comm->executeCurl($url);
        $data = $res['result'];
        $data= json_encode($data);
        $edit=1;        
        include APICLUDE.'class.attributes.php';
        include BTEMPLATE.'addAttribute.html';
        break;
    
    case 'coupon':
        $page = 'coupon';
        $tab = 'coupons';
        include BTEMPLATE.'coupon.html';
        break;
    
    /*case 'discounts':
        $page = 'discounts';
        $tab = 'discounts';
        include BTEMPLATE.'discounts.html';
        break;
    */
    case 'orders':
        $page = 'orders';
        $tab = 'orders';
        include BTEMPLATE.'orders.html';
        break;
    
    case 'rates':
        $page = 'rateManager';
        $tab = 'rate manager';
        include BTEMPLATE.'rateManager.html';
        break;
    
}
?>