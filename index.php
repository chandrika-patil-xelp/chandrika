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
     case 'product_details':
        $page = 'product_details';
        include TEMPLATE.'product_details.html';
        break;
      case 'product_preview':
        $page = 'product_preview';
        include TEMPLATE.'product_preview.html';
        break;
        case 'product_grid':
          $page = 'product_grid';
          include TEMPLATE.'product_grid.html';
          break;
     case 'product_page':
          $page = 'product_page';
          include TEMPLATE.'product_page.html';
          break;
     case 'check_out':
          $page = 'check_out';
          include TEMPLATE.'check_out.html';
          break;
     case 'login_jzeva':
        $page = 'login_jzeva';
        include TEMPLATE.'login_jzeva.html';
        break;
    case 'filter':
        $page = 'filter';
        include TEMPLATE.'filter.html';
        break;
     case 'reset_pswrd':
        $page = 'reset_pswrd';
        include TEMPLATE.'reset_pswrd.html';
        break;
    case 'frgt_pswrd':
        $page = 'frgt_pswrd';
        include TEMPLATE.'frgt_pswrd.html';
        break;
    case 'sign_up':
        $page = 'sign_up';
        include TEMPLATE.'sign_up.html';
        break;
     case 'input_form':
        $page = 'input_form';
        include TEMPLATE.'input_and_form.html';
        break;




}


?>
