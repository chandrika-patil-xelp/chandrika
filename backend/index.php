<?php

include 'config.php';
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
        include TEMPLATE.'products.html';
        break;
    case 'addProduct':
        $page = 'addProduct';
        include TEMPLATE.'addProduct.html';
        break;
    
    case 'addCategory':
        $page = 'addCategory';
        include TEMPLATE.'addCategory.html';
        break;
    
    case 'addAttribute':
        $page = 'addAttribute';
        include TEMPLATE.'addAttribute.html';
        break;
    
    case 'coupon':
        $page = 'coupon';
        include TEMPLATE.'coupon.html';
        break;
    
    case 'orders':
        $page = 'orders';
        include TEMPLATE.'orders.html';
        break;
    
}
?>