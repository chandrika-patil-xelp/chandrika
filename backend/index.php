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
    
    case 'category':
        $page = 'category';
        $tab = 'category';
        include BTEMPLATE.'category.html';
        break;
    
    case 'addCategory':
        $page = 'addCategory';
        $tab = 'category';
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
        include BTEMPLATE.'addAttribute.html';
        break;
    
    case 'coupon':
        $page = 'coupon';
        $tab = 'coupons';
        include BTEMPLATE.'coupon.html';
        break;
    
    case 'discounts':
        $page = 'discounts';
        $tab = 'discounts';
        include BTEMPLATE.'discounts.html';
        break;
    
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