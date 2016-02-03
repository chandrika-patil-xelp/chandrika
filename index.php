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
     case 'gemstone':
        $page = 'gemstone';
        include TEMPLATE.'gemstone.html';
        break;
    case 'gem_desc':
        $page = 'gem_desc';
        include TEMPLATE.'gem_desc.html';
        break;
    case 'gem_desc2':
        $page = 'gem_desc2';
        include TEMPLATE.'gem_desc2.html';
        break;
    
    case 'orders':
        $page = 'orders';
        include TEMPLATE.'orders.html';
        break;
     case 'track':
        $page = 'track';
        include TEMPLATE.'track_order.html';
        break;
      case 'confirmation':
        $page = 'confirmation';
        include TEMPLATE.'confirmation.html';
        break;
    
    
    
}


?>