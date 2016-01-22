<?php



include './config.php';
$params = array_merge($_GET, $_POST);
$action = (!empty($params['action'])) ? trim($params['action']) : '';
$case = (!empty($params['case'])) ? trim($params['case']) : '';




if($params['debug'])
{
    echo "<pre>";print_r($params);echo "</pre>";
}



switch ($action) {
    case 'home':
        $page = 'index';
        include TEMPLATE.'index.html';
        break;
    
    case 'orders':
        $page = 'orders';
        include TEMPLATE.'orders.html';
        break;
    
    
}


?>