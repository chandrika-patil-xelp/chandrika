<?php
include '../config.php';
$params = array_merge($_GET, $_POST);
$params = array_merge($params, $_FILES);
$action = $_GET['action'];

//   echo  $image = trim('../backend/image-upload/uploads/7020160831074925/1472630480RNG8610_00029.jpg');
//   echo '<br>';
// echo filesize($image)/1024;
// die;
//

if($params['debug'])
{
    echo "<pre>";    print_r($params);  echo "</pre>";

}

switch($action)
{
    #Category
    case 'addCategory':
        include APICLUDE.'class.category.php';
        $obj	= new category($db['jzeva']);
        $tmpparams = array($params['dt']);
        $result	=$obj->addCategory($tmpparams);
        $res = $result;
    break;
    case 'getCatgoryTree':
        include APICLUDE.'class.category.php';
        $obj	= new category($db['jzeva']);
        $result	=$obj->getCatgoryTree();
        $res = $result;
    break;

    //jzeva/apis/?action=getCatgoryList&limit=20&page=1
    case 'getCatgoryList':
        include APICLUDE.'class.category.php';
        $obj	= new category($db['jzeva']);
        $page   = ($params['page'] ? $params['page'] : 1);
        $limit  = ($params['limit'] ? $params['limit'] : 1000);
        $tmpParams = array('page'=>$params['page'],'limit' => $limit);
        $result	=$obj->getCatgoryList($tmpParams);
        $res = $result;
    break;

    case 'changeCategoryStatus':
        include APICLUDE.'class.category.php';
        $obj	= new category($db['jzeva']);
        $tmpparams=array($params['dt']);
        //$tmpparams=array('active_flag'=>$params['active_flag'],'userid'=>$params['userid'],'catid'=>$params['catid']);
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

    case 'getMultyCatMapping':
        include APICLUDE.'class.category.php';
        $obj	= new category($db['jzeva']);
        $tmpparams = array($params['dt']);
        $result	=$obj-> getMultyCatMapping($tmpparams);
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
        $tmpaparams = array($params['dt']);
        $result	=$obj->addAttribute($tmpaparams);
        $res = $result;
    break;

    //jzeva/apis/?action=getAttributeList&limit=2&page=2
    case 'getAttributeList':
        include APICLUDE.'class.attributes.php';
        $obj	= new attributes($db['jzeva']);
        $page   = ($params['page'] ? $params['page'] : 1);
        $limit  = ($params['limit'] ? $params['limit'] : 1000);
        $tmpParams = array('page'=>$params['page'],'limit' => $limit);
        $result	=$obj->getAttributeList($tmpParams);
        $res = $result;
    break;

    case 'changeAttributeStatus':
        include APICLUDE.'class.attributes.php';
        $obj	= new attributes($db['jzeva']);
        $tmpparams=array($params['dt']);
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
        foreach($tmpaparams as $key => $value)
        {
            $tmpaparams[$key] = strip_tags($value);
        }
        $result	=$obj->addProduct($tmpaparams);
        $res = $result;
    break;



    case 'getMetalColorIdByValue':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $result	=$obj->getMetalColorIdByValue();
        $res = $result;
    break;

    case 'addImg':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $result	=$obj->addImg($params);
        $res = $result;
    break;



    case 'getProGrid':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $result	=$obj->getProGrid($params);
        $res = $result;
    break;

    case 'getProGridById':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $result	=$obj->getProGridById($params);
        $res = $result;
    break;


     case 'getAllratesById':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $result	=$obj->getAllratesById($params);
        $res = $result;
    break;


     case 'getjewellaryType':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $result	=$obj->getjewellaryType();
        $res = $result;
    break;



    case 'checkVproductCode':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $result	=$obj->checkVproductCode($params);
        $res = $result;
    break;

    //jzeva/apis/?action=getVendorList&limit=20&page=1
    case 'getVendorList':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $page   = ($params['page'] ? $params['page'] : 1);
        $limit  = ($params['limit'] ? $params['limit'] : 1000);
        $tmpParams = array('page'=>$params['page'],'limit' => $limit);
        $result	=$obj->getVendorList($tmpParams);
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
    ///jzeva/apis/?action=getDiamondQualityList&limit=100&page=1
    case 'getDiamondQualityList':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $page   = ($params['page'] ? $params['page'] : 1);
        $limit  = ($params['limit'] ? $params['limit'] : 1000);
        $tmpParams = array('page'=>$params['page'],'limit' => $limit);
        $result	=$obj->getDiamondQualityList($tmpParams);
        $res = $result;
    break;
    ///jzeva/apis/?action=getGemstoneList&limit=100&page=1
    case 'getGemstoneList':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $page   = ($params['page'] ? $params['page'] : 1);
        $limit  = ($params['limit'] ? $params['limit'] : 1000);
        $tmpParams = array('page'=>$params['page'],'limit' => $limit);
        $result	=$obj->getGemstoneList($tmpParams);
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

    case 'changeProductStatus':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $tmpparams=array($params['dt']);
        $result	=$obj->changeProductStatus($tmpparams);
        $res = $result;
    break;

    case 'changeSolitaireStatus':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $tmpparams=array($params['dt']);
        $result	=$obj->changeSolitaireStatus($tmpparams);
        $res = $result;
    break;

    case 'changeDiamondStatus':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $tmpparams=array($params['dt']);
        $result	=$obj->changeDiamondStatus($tmpparams);
        $res = $result;
    break;

    case 'changeUncutStatus':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $tmpparams=array($params['dt']);
        $result	=$obj->changeUncutStatus($tmpparams);
        $res = $result;
    break;

    case 'changeGemstoneStatus':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $tmpparams=array($params['dt']);
        $result	=$obj->changeGemstoneStatus($tmpparams);
        $res = $result;
    break;

    case 'changePrdPropertyStatus':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $tmpparams=array($params['dt']);
        $result	=$obj->changePrdPropertyStatus($tmpparams);
        $res = $result;
    break;


    #Rate

    case 'addRates':
        include APICLUDE.'class.rate.php';
        $obj	= new rate($db['jzeva']);
        $tmpaparams = array($params['dt']);
        $result	=$obj->addRates($tmpaparams);
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
        $page   = ($params['page'] ? $params['page'] : 1);
        $case   = ($params['case'] ? $params['case'] : '');
        $limit  = ($params['limit'] ? $params['limit'] : 1000);
        $tmpParams = array('page'=>$params['page'],'limit' => $limit,'case' => $case);
        if(empty($params['case']))
        {
            $result	=$obj->getGoldRates($tmpParams);
        }
        else
        {
            $result	=$obj->getAllGoldRates($tmpParams);
        }
        $res = $result;
    break;

    case 'getDmdRates':
        include APICLUDE.'class.rate.php';
        $obj	= new rate($db['jzeva']);
        $page   = ($params['page'] ? $params['page'] : 1);
        $limit  = ($params['limit'] ? $params['limit'] : 1000);
        $tmpParams = array('page'=>$params['page'],'limit' => $limit);
        $result	=$obj->getDmdRates($tmpParams);
        $res = $result;
    break;

    case 'getAllRates':
        include APICLUDE.'class.rate.php';
        $obj	= new rate($db['jzeva']);
        $page   = ($params['page'] ? $params['page'] : 1);
        $limit  = ($params['limit'] ? $params['limit'] : 1000);
        $tmpParams = array('page'=>$params['page'],'limit' => $limit);
        $result	=$obj->getAllRates($tmpParams);
        $res = $result;
    break;

    case 'getMetalColorList':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $page   = ($params['page'] ? $params['page'] : 1);
        $limit  = ($params['limit'] ? $params['limit'] : 1000);
        $tmpParams = array('page'=>$params['page'],'limit' => $limit);
        $result	=$obj->getMetalColorList($tmpParams);
        $res = $result;
    break;

    // Get product details list with mapping
    //localhost:8080/jzeva/apis/?action=getProductById&pid=1720160125153911
    case 'getProductById':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $tmpParams = array('pid'=>$params['pid']);
        $result	=$obj->getProductById($tmpParams);
        $res = $result;
    break;




    case 'getImagesByPid':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $tmpParams = array('pid'=>$params['pid']);
        $result	=$obj->getImagesByPid($tmpParams);
        $res = $result;
    break;

     case 'getImages':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $tmpParams = array('pid'=>$params['pid']);
        $result	=$obj->getImages();
        $res = $result;
    break;



    case 'pageList':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $page   = ($params['page'] ? $params['page'] : 1);
        $limit  = ($params['limit'] ? $params['limit'] : 20);
        $tmpParams = array('page'=>$params['page'],'limit' => $limit);
        $result	=$obj->pageList($tmpParams);
        $res = $result;
    break;


// http://localhost/jzeva/backend/index.php?action=upload&pid=1
    case 'imageupdate':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $result	= $obj->imageUpdate($params);
        $res= $result;
    break;

    case 'imageremove':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $result	= $obj->imageRemove($params);
        $res= $result;
    break;

    case 'imagedisplay':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $result	= $obj->imageDisplay($params);
        $res= $result;
    break;



    #COUPONS

    case 'addCoupon':
        include APICLUDE.'class.coupon.php';
        $obj	= new coupon($db['jzeva']);
        $tmpparams = array($params['dt']);
        $result	=$obj->addCoupon($tmpparams);
        $res = $result;
    break;

    case 'getCouponList':
        include APICLUDE.'class.coupon.php';
        $obj	= new coupon($db['jzeva']);
        $page   = ($params['page'] ? $params['page'] : 1);
        $limit  = ($params['limit'] ? $params['limit'] : 1000);
        $tmpParams = array('page'=>$params['page'],'limit' => $limit);
        $result	=$obj->getCouponList($tmpParams);
        $res = $result;
    break;

    case 'getCouponDetailsById':
        include APICLUDE.'class.coupon.php';
        $obj	= new coupon($db['jzeva']);
        $result	=$obj->getCouponDetailsById();
        $res = $result;
    break;



    case 'updateCouponStatus':
        include APICLUDE.'class.coupon.php';
        $obj	= new coupon($db['jzeva']);
        $tmpparams = array($params['dt']);
        $result	=$obj->updateCouponStatus($tmpparams);
        $res = $result;
    break;

/* FOR image moderation */
//jzeva/apis/?action=getProdList&limit=2&page=1
    case 'getProdList':
        include APICLUDE.'class.admin.php';
        $obj=   new admin($db['jzeva']);
        $page   = ($params['page'] ? $params['page'] : 1);
        $limit  = ($params['limit'] ? $params['limit'] : 1000);
        $tmpParams = array('page'=>$params['page'],'limit' => $limit);
        $res=   $obj->getProdList($tmpParams);
        break;

    case 'getImgByProd':
        include APICLUDE.'class.admin.php';
        $obj=new admin($db['jzeva']);
        $res=$obj->getImgByProd($params);
        break;

    case 'updateImageData':
        include APICLUDE.'class.admin.php';
        $obj=new admin($db['jzeva']);
        $res=$obj->updateImageData($params);

        break;

    case 'test':
        include APICLUDE.'class.attributes.php';
        $obj	= new category($db['jzeva']);
        $page   = ($params['page'] ? $params['page'] : 1);
        $limit  = ($params['limit'] ? $params['limit'] : 1000);
        $tmpParams = array('page'=>$params['page'],'limit' => $limit);
        $result	=$obj->getCatgoryList($tmpParams);
    break;


    #USER
    case 'addUser':

        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']);
        $res	=$obj->addUser($params);

    break;

    case 'getUser':
        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']);
        $tmpparams=array('userid'=>$params['userid']);
        $res	=$obj->getUserDetailsById($tmpparams);
    break;

    case 'addOrder':
        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']);
        $res	=$obj->addOrder();
    break;

    case 'OrderDtails':
        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']);
        $tmpparams=array('orderid'=>$params['orderid']);
        $res	=$obj->getOrderDetailsByOrdId($tmpparams);
    break;

    case 'OrderDtailsByuserId':
        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']);
        $tmpparams=array('userid'=>$params['userid']);
        $res	=$obj->getOrderDetailsByuId($tmpparams);
    break;

    case 'getAllUserDetails':
        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']);
        $tmpparams=array('userid'=>$params['userid']);
        $res	=$obj->getAllUserDetails($tmpparams);
    break;

    case 'changeOrderStatus':
        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']);
        $tmpparams = array($params['dt']);
        $res	=$obj->changeOrderStatus($tmpparams);
    break;

//jzeva/apis/?action=geOrderList&limit=10&page=1
    case 'geOrderList':
        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']);
        $page   = ($params['page'] ? $params['page'] : 1);
        $limit  = ($params['limit'] ? $params['limit'] : 1000);
        $tmpParams = array('page'=>$params['page'],'limit' => $limit);
        $res	=$obj->geOrderList($tmpParams);
    break;


    case 'getUserList':
        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']);
        $page   = ($params['page'] ? $params['page'] : 1);
        $limit  = ($params['limit'] ? $params['limit'] : 1000);
        $tmpParams = array('page'=>$params['page'],'limit' => $limit);
        $res	=$obj->getUserList($tmpParams);
    break;


    case 'login':
            include APICLUDE.'class.user.php';
            $obj = new user($db['jzeva']);
            $res = $obj->login($params);
            break;



    case 'newforgotPass':
            include_once APICLUDE . 'class.user.php';
            $obj=new user($db['jzeva']);
            $res = $obj->newforgotPass($params);
            break;

      #CHANGE PASSWORD
     // localhost/jzeva/apis/index.php?action=changePassUrl&uid=8720161006153344&email=ss@gmail.com

      case 'changePassUrl':
       include APICLUDE.'class.urlmaster.php';
          $obj	= new urlmaster($db['jzeva']);
        $result	= $obj->changePassUrl($params);

        $res = $result;
        break;

//  localhost/iftosi/apis/index.php?action=getUserDet&key=uvwxyz
    case 'getUserDet':

        include APICLUDE.'class.urlmaster.php';
        $obj	= new urlmaster($db['jzeva']);
        $result	= $obj->getUserDet($params);
        $res = $result;
        break;


    /** ADD USER CODDE START **/
    //http://localhost/jzeva/apis/index.php/?action=addUsers&name=rahul&pass=khan0605&mobile=8147604885&email=skrahul0605@gmail.com&city=kdkr&addr=kandukur&isven=1&updby=123&subsc=akjbd&isactive=1&pass_flag=0&gender=1
    case 'addUsers':
        include APICLUDE.'class.us.php';
        $obj = new us($db['jzeva']);
        $res = $obj->addUsers($params);
        break;

    //getUserDetailsById

    //http://localhost/jzeva/apis/index.php/?action=getUserDetailsById&userid=6420160421142522
    case 'getUserDetailsById':
        include APICLUDE.'class.us.php';
        $obj = new us($db['jzeva']);
        $res = $obj->getUserDetailsById($params);
        break;

    //getuserlist
    //http://localhost/jzeva/apis/index.php/?action=getUserLists
    case 'getUserLists':
        include APICLUDE.'class.us.php';
        $obj = new us($db['jzeva']);
        $res = $obj->getUserLists();
        break;

    //orders
    //http://localhost/jzeva/apis/index.php/?action=addOrders&pid=6120160315162137&userid=6420160421142522&orddate=2016-04-22&deldate=2016-04-25&orderstat=5&actflg=1&updby=user&prodpri=84645&payment=4
    case 'addOrders':
        include APICLUDE.'class.us.php';
        $obj = new us($db['jzeva']);
	$tmpaparams = array($params['dt']);
        $res = $obj->addOrders($tmpaparams);
        break;

    //getOrderDetailsByOrdIds
    //http://localhost/jzeva/apis/index.php/?action=getOrderDetailsByOrdIds&orderid=4220160422072902
    case 'getOrderDetailsByOrdIds':
        include APICLUDE.'class.us.php';
        $obj = new us($db['jzeva']);
        $res = $obj->getOrderDetailsByOrdIds($params);
        break;

    //getOrderDetailsByUserId
    //http://localhost/jzeva/apis/index.php/?action=getOrderDetailsByUserId&userid=6420160421142522

    case 'getOrderDetailsByUserId':
        include APICLUDE.'class.us.php';
        $obj = new us($db['jzeva']);
        $res = $obj->getOrderDetailsByUserId($params);
        break;

    //getAllUDetail
    //http://localhost/jzeva/apis/index.php/?action=getAllUDetail&userid=6420160421142522
    case 'getAllUDetail':
        include APICLUDE.'class.us.php';
        $obj = new us($db['jzeva']);
        $res = $obj->getAllUDetail($params);
        break;

    //getOrderList
    //http://localhost/jzeva/apis/index.php/?action=getOrderList
    case 'getOrderList':
        include APICLUDE.'class.us.php';
        $obj = new us($db['jzeva']);
        $res = $obj->getOrderList();
        break;

    //chngOrdStatus
    //http://localhost/jzeva/apis/index.php/?action=chngOrdStatus&dt={%22orderid%22:%224220160422072902%22,%22userid%22:%226420160421142522%22,%22ostatus%22:%222%22}
    case 'chngOrdStatus':
        include APICLUDE.'class.us.php';
        $obj = new us($db['jzeva']);
        $tmpparam = array($params['dt']);
        $res = $obj->chngOrdStatus($tmpparam);
        break;


    /** ADD USER CODDE ENDS **/

   /** GET PRODUCT DETAILS BY ID START **/
    //http://localhost/jzeva/apis/index.php/?action=getProductDetailById&pid=6120160315162137
    case 'getProductDetailById':
        include APICLUDE.'class.product.php';
        $obj = new product($db['jzeva']);
        $res = $obj->getProductDetailById($params);
        break;


    case 'getProductImgById':
        include APICLUDE.'class.product.php';
        $obj = new product($db['jzeva']);
        $res = $obj->getProductImgById($params);
        break;



      case 'addTocart':

        include APICLUDE . 'class.addtocart.php';
        $obj = new addtocart($db['jzeva']);
        $tmpaparams = array($params['dt']);

        //
        //      foreach($tmpaparams as $key => $value)
        //     {
        //         $tmpaparams[$key] = strip_tags($value);
        //     }
        $res = $obj->addToCart($tmpaparams);
        break;

    case 'getcartdetail':
        include APICLUDE.'class.addtocart.php';
        $obj = new addtocart($db['jzeva']);
         $res = $obj->getcartdetail($params);
        break;

    /** CODE FOR ADD TO CART ENDS **/



      case 'updatecartdata':
        include APICLUDE.'class.addtocart.php';
        $obj = new addtocart($db['jzeva']);
	 $res = $obj->updatecartdata($params);
        break;

      case 'updatecartincrz':
        include APICLUDE.'class.addtocart.php';
        $obj = new addtocart($db['jzeva']);
	 $res = $obj->updatecartincrz($params);
        break;

      case 'newcart':
        include APICLUDE.'class.addtocart.php';
        $obj = new addtocart($db['jzeva']);
	 $res = $obj->newcart( $params);
        break;


      case 'updatecartdecrese':
        include APICLUDE.'class.addtocart.php';
        $obj = new addtocart($db['jzeva']);
	 $res = $obj->updatecartdecrese($params);
        break;

     case 'getcartdetailbyid':
        include APICLUDE.'class.addtocart.php';
        $obj = new addtocart($db['jzeva']);
        $res = $obj->getcartdetailbyid();
        break;

      case 'updatecartincrz':
        include APICLUDE.'class.addtocart.php';
        $obj = new addtocart($db['jzeva']);
	 $res = $obj->updatecartincrz($params);
        break;


        case 'updatecartdecrese':
        include APICLUDE.'class.addtocart.php';
        $obj = new addtocart($db['jzeva']);
	 $res = $obj->updatecartdecrese($params);
        break;

    /** CODE FOR get product and user details by order id start **/

    case 'getProductByOrderId':
        include APICLUDE.'class.addtocart.php';
        $obj = new addtocart($db['jzeva']);
        $res = $obj->getProductByOrderId($params);
        break;

    /** CODE FOR get product and user details by order id ends **/

    case 'userAddress':
        include APICLUDE.'class.addtocart.php';
        $obj = new addtocart($db['jzeva']);
        $res = $obj->userAddress($params);
        break;

    // CODE FOR REMOVE CART START
    //http://localhost/jzeva/apis/index.php/?action=removeItemFromCart&pid=4820160125153111&oid=1463130805589
    case 'removeItemFromCart':
        include APICLUDE.'class.addtocart.php';
        $obj = new addtocart($db['jzeva']);
        $res = $obj->removeItemFromCart($params);
        break;

    case 'updateOptVal':
        include APICLUDE.'class.addtocart.php';
        $obj = new addtocart($db['jzeva']);
        $res = $obj->updateOptVal($params);

        break;

    //http://localhost/jzeva/apis/index.php/?action=getZipcode&zipcd=523105

    case 'getZipcode':
        include APICLUDE.'class.addtocart.php';
        $obj = new addtocart($db['jzeva']);
        $res = $obj->getZipcode($params);
        break;


    // CODE FOR REMOVE CART ENDS

    //code for login start
    //http://localhost/jzeva/apis/index.php/?action=login&name=skrahul0605@gmail.com&pass=khan0605
//    case 'login':
//        include APICLUDE.'class.addtocart.php';
//        $obj = new addtocart($db['jzeva']);
//        $res = $obj->login($params);
//        break;
    //code for login ends

    case 'forgotPass':
        include APICLUDE.'class.us.php';
        $obj = new us($db['jzeva']);
        $res = $obj->forgotPass($params);
        break;

    case 'signUp':
        include APICLUDE.'class.us.php';
        $obj = new us($db['jzeva']);
        $res = $obj->signUp($params);
        break;

    //http://localhost/jzeva/apis/index.php/?action=search&search=ring
    case 'search':
        include APICLUDE.'class.addtocart.php';
        $obj = new addtocart($db['jzeva']);
        $res = $obj->searchPrd($params);
        break;


    case 'sendotp':
        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']);
        $res	=$obj->sendotp($params);
    break;



    case 'addOrdersdetail':
        include APICLUDE.'class.us.php';
        $obj = new us($db['jzeva']);
	 $tmpaparams = array($params['dt']);
         $res = $obj->addOrdersdetail($tmpaparams);
    break;


    case 'getuserdetailbymail':
        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']);
        $res	=$obj->getuserdetailbymail($params);
    break;

    case 'getuserdatabyurl':
        include APICLUDE.'class.urlmaster.php';
        $obj	= new urlmaster($db['jzeva']);
        $result	= $obj->getuserdatabyurl($params);
        $res = $result;
    break;

    case 'updateuserpass':
        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']);
        $res	=$obj->updateuserpass($params);
    break;

     
    case 'addshippingdetail':
        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']);
	$tmpaparams = array($params['dt']);
        $res	=$obj->addshippingdetail($tmpaparams);
    break;

     case 'removeShipngdetail':
        include APICLUDE.'class.user.php';
        $obj = new user($db['jzeva']);
        $res = $obj->removeShipngdetail($params);
        break;
    
     case 'addOrderbackend':
        include APICLUDE.'class.us.php';
        $obj = new us($db['jzeva']);
	$tmpaparams = array($params['dt']);
         $res = $obj->addOrderbackend($tmpaparams);
    break;

   case 'checkopt':
        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']);
        $res	=$obj->checkopt($params);
    break;


    case 'getuserdatabyurl':
        include APICLUDE.'class.urlmaster.php';
        $obj	= new urlmaster($db['jzeva']);
        $result	= $obj->getuserdatabyurl($params);
        $res = $result;
    break;

    case 'setImagedeflt':
        include APICLUDE.'class.admin.php';
        $obj=new admin($db['jzeva']);
        $res=$obj->setImagedeflt($params);
    break;

    

  case 'getProDesOfcatid':
        include APICLUDE.'class.product.php';
        $obj = new product($db['jzeva']);
        $res = $obj->getProDesOfcatid($params);
  break;
  case 'getProductdetailbycatid':
        include APICLUDE.'class.product.php';
        $obj = new product($db['jzeva']);
        $res = $obj->getProductdetailbycatid($params);
  break;

  case 'removCrtItemaftrcheckot':
        include APICLUDE.'class.addtocart.php';
        $obj = new addtocart($db['jzeva']);
        $res = $obj->removCrtItemaftrcheckot($params);
  break;
    
  case 'viewbyPincode':
      include APICLUDE . 'class.location.php';
      $obj = new location($db['jzeva']);
      $result = $obj->viewbyPincode($params);
      $res = $result;
  break;

    case 'suggestCity':
      include APICLUDE . 'class.location.php';
      $obj = new location($db['jzeva']);
      $result = $obj->suggestCity($params);
      $res = $result;
  break;

  case 'getSubCat':
        include APICLUDE.'class.category.php';
        $obj = new category($db['jzeva']);
	$catid = $_GET['catid'];
         $result = $obj->getSubCat($catid);
	$res = $result;
  break;

  case 'sendnewuserotp':
        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']);
        $res	=$obj->sendnewuserotp($params);
    break;

    case 'addnewUser':
        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']);
        $res	=$obj->addnewUser($params);
    break;

  case 'getshippingdatabyid':
        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']);
        $result	= $obj->getshippingdatabyid($params);
        $res = $result;
  break;

    case 'getshipdatabyUid':

        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']);
        $result	= $obj->getshipdatabyUid($params);
        $res = $result;
  break;


  case 'createemailUrl':
            include_once APICLUDE . 'class.user.php';
            $obj=new user($db['jzeva']);
           // $tmp_params = array('email' => $email);
            $res = $obj->createemailUrl($params);
  break;

  case 'getattributetypes':
        include APICLUDE.'class.attributes.php';
        $obj	= new attributes($db['jzeva']);
	$attid = $_GET['attrid'];
        $result	=$obj->getattributetypes($attid);
        $res = $result;
    break;

  case 'addtowishlist':
        include APICLUDE.'class.addtocart.php';
        $obj = new addtocart($db['jzeva']);
        $tmpaparams = array($params['dt']);
        $res = $obj->addtowishlist($tmpaparams);
        break;

  case 'getwishdetail':
        include APICLUDE.'class.addtocart.php';
        $obj = new addtocart($db['jzeva']);
        $res = $obj->getwishdetail($params);
  break;

case 'getUserdetailbymob':
        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']);
        $res	=$obj->getUserdetailbymob($params);
    break;


  case 'getUserDetailsbyinpt':
        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']);
        $res	=$obj->getUserDetailsbyinpt($params);
    break;

     case 'checkpassw':
        include APICLUDE.'class.addtocart.php';
        $obj = NEW addtocart($db['jzeva']);
        $res = $obj->checkpassw($params);
  break;

case 'removeItmFrmWishlist':
        include APICLUDE.'class.addtocart.php';
        $obj = new addtocart($db['jzeva']);
        $res = $obj->removeItmFrmWishlist($params);
        break;

 case 'getprodDescrp':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $result	=$obj->getprodDescrp($params);
        $res = $result;
    break;

   case 'getfiltrmenus':
        include APICLUDE.'class.product.php';
        $obj	= new product($db['jzeva']);
        $result	=$obj->getfiltrmenus($params);
        $res = $result;
    break;

   case 'getprodByfiltr':
        include APICLUDE.'class.product.php';
        $obj	= NEW product($db['jzeva']);  
         $result=$obj->getprodByfiltr($params);
        $res = $result;
    break;

  case 'getProductdetailbypid':
        include APICLUDE.'class.product.php';
        $obj	= NEW product($db['jzeva']);
        $result	=$obj->getProductdetailbypid($params);
        $res = $result;
    break;

  case 'checkusertype':
        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']);
        $result	=$obj->checkusertype($params);
	$res = $result;
    break;


//http://localhost:8012/jzeva/backend/?action=orders
  case 'getallOrderDtails':
        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']);
        $res=$obj->getallOrderDtails();
  break;

case 'orderTrack':

        include APICLUDE.'class.user.php';
        $obj = new user($db['jzeva']);
        $res =$obj->orderTrack($params);
     break;
//http://localhost:8012/jzeva/index.php?action=myaccount&actn=oId
  case 'getAllOrderDetails':
        include APICLUDE.'class.us.php';
        $obj = new us($db['jzeva']);
        $res = $obj->getAllOrderDetails($params);
        break;
   
    case 'getshipdatabyshipid': 
        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']);
        $result	= $obj->getshipdatabyshipid($params);
        $res = $result;
  break;

  case 'gettransactiondata': 
        include APICLUDE.'class.rate.php';
        $obj	= new rate($db['jzeva']);
        $result	= $obj->gettransactiondata($params);
        $res = $result;
  break;

  case 'addtransactiondata': 
        include APICLUDE.'class.rate.php';
        $obj	= new rate($db['jzeva']);
        $result	= $obj->addtransactiondata($params);
        $res = $result;
  break;
    
  case 'OrderDetailsbyordid':
        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']);
        $tmpparams=array('orderid'=>$params['orderid']);
        $res	=$obj->OrderDetailsbyordid($tmpparams);
    break;
  
  case 'checktrackord':
        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']); 
        $res	=$obj->checktrackord($params);
  break;
  
  case 'gettrackordrdetail':
        include APICLUDE.'class.user.php';
        $obj	= new user($db['jzeva']); 
        $res	=$obj->gettrackordrdetail($params);
  break;

  } 
echo json_encode($res);
exit;
?>
