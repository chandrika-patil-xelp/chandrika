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
        include BTEMPLATE.'products.html';
        break;
    case 'addProduct':
        $page = 'addProduct';
        include BTEMPLATE.'addProduct.html';
        break;
    
    case 'addCategory':
        $page = 'addCategory';
        include BTEMPLATE.'addCategory.html';
        break;
    
    case 'addAttribute':
        $page = 'addAttribute';
        include BTEMPLATE.'addAttribute.html';
        break;
    
    case 'coupon':
        $page = 'coupon';
        include BTEMPLATE.'coupon.html';
        break;
    
    case 'orders':
        $page = 'orders';
        include BTEMPLATE.'orders.html';
        break;
    
}
?>