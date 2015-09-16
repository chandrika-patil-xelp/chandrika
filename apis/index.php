<?php
include '../config.php';
$res['results'] = array();
$params = array_merge($_GET, $_POST);
$action = $_GET['action'];
        
switch($action)
    {        
//----------------------------User--------------------------------

//  localhost/jzevasb/apis/index.php?action=checkUser&mobile=9975887206                
        case 'checkUser':
            include APICLUDE.'class.user.php';
            $mobile=(!empty($params['mobile'])) ? trim($params['mobile']) : '';
            if(empty($mobile))
            {   
                $arr = "Some Parameters missing";
                $err = array('Code' => 1, 'Msg' => 'Some Parameters missing');
                $result = array('results'=>$arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new user($db['jzeva']);
            $result= $obj->checkUser($params);
            $res= $result;
            break;
            
//  localhost/jzevasb/apis/index.php?action=userReg&dt={%22result%22:%20{%22username%22:%20%22Shubham%20Bajpai%22,%22gender%22:%200,%22logmobile%22:%209975887206,%22password%22:%20%22shubham%22,%22usertype%22:%201,%22email%22:%20%22shubham@gmail.com%22,%22alt_email%22:%20%22shubhambaajpai@gmail.com%22,%22dob%22:%20%221990-10-10%22,%22working_phone%22:%207309290529,%22fulladdress%22:%20%22ES%201B/962,Sector%20A,%20Jankipuram%22,%22pincode%22:%20223232,%22cityname%22:%20%22delhi%22,%22id_type%22:%20%22DL%22,%22id_proof_no%22:%20%22VH32323HN%22},%22error%22:%20{%22errCode%22:%200}}
        case 'userReg':
            include APICLUDE.'class.user.php';
            $dt=(!empty($params['dt'])) ? trim(urldecode($params['dt'])) : '';
            if(empty($dt))
            {   
                $arr = "Some Parameters missing";
                $err = array('Code' => 1, 'Msg' => 'Some Parameters missing');
                $result = array('results'=>$arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new user($db['jzeva']);
            $result= $obj->userReg($params);
            $res= $result;
            break;
            
//  localhost/jzevasb/apis/index.php?action=udtProfile&uname=Shushrut%20Kumar&usertype=1&alt_email=shubhambaajpai@gmail.com&pincode=232322&address=janakpuri&cityname=Delhi&state=delhi&work_phone=4342423422&dob=1995-12-19&idproof=gsg6667fsf&idtype=driving%20license&logmobile=9975887206
        case 'udtProfile':
            include APICLUDE.'class.user.php';
            $logmobile=(!empty($params['logmobile'])) ?  trim($params['logmobile']) : '';
            $uname=(!empty($params['uname'])) ?  trim(urldecode($params['uname'])) : '';
            $usertype=(!empty($params['usertype'])) ?  trim($params['usertype']) : '';
            $alt_email=(!empty($params['alt_email'])) ?  trim($params['alt_email']) : '';
            $dob=(!empty($params['dob'])) ?  trim($params['dob']) : '';
            $work_phone=(!empty($params['work_phone'])) ?  trim($params['work_phone']) : '';
            $pincode=(!empty($params['pincode'])) ? trim($params['pincode']) : '';
            $address=(!empty($params['address'])) ? trim(urldecode($params['address'])) : '';
            $cityname=(!empty($params['cityname'])) ?  trim(urldecode($params['cityname'])) : '';
            $idproof=(!empty($params['idproof'])) ?  trim(urldecode($params['idproof'])) : '';
            $idtype=(!empty($params['idtype'])) ?  trim(urldecode($params['idtype'])) : '';
            if(empty($uname) && empty($usertype) && empty($alt_mobile) && empty($dob) && empty($work_phone) && empty($pincode) && empty($address) && empty($cityname)&& empty($idproof) && empty($idtype))
            {   
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Some parameters missing');
                $result = array('results'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj= new user($db['jzeva']);
            $result= $obj->udtProfile($params);
            $res= $result;
            break;                
            
//  localhost/jzevasb/apis/index.php?action=logUser&mobile=9975887206&password=bajpai123            
        case 'logUser':
            include  APICLUDE.'class.user.php';
            $mobile=(!empty($params['mobile'])) ?  trim($params['mobile']) : '';
            $password=(!empty($params['password'])) ?  trim(urldecode($params['password'])) : '';
            if(empty($mobile) && empty($password))
            {
                $arr=array();
                $err=array('code'=> 1,'Msg'=> 'Invalid parameters');
                $result=array('results'=> $arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj = new user($db['jzeva']);
            $result = $obj->logUser($params);
            $res= $result;
            break;

// localhost/jzevasb/apis/index.php?action=updatePass&mobile=9975887206&password=shubham            
        case 'updatePass':
            include APICLUDE.'class.user.php';
            $password=(!empty($params['passowrd'])) ?  trim(urldecode($params['password'])) : '';
            $mobile=(!empty($params['mobile'])) ?  trim($params['mobile']) : '';
            if(empty($password) && empty($mobile))
            {
                $arr=array();
                $err=array('code'=>1,'Msg'=>'Some Parameters missing');
                $result=array('results'=> $arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj=new user($db['jzeva']);
            $result =$obj->updatePass($params);
            $res= $result;
            break;

// localhost/jzevasb/apis/index.php?action=deactUser&mobile=9975887206            
        case 'deactUser':
            include APICLUDE.'class.user.php';
            $mobile=(!empty($params['mobile'])) ?  trim($params['mobile']) : '';
            if(empty($params['mobile']))
            {
            $arr=array();
            $err=array('code'=>1,'Msg'=>'plz provide the email');
            $result=array('results'=> $arr,'error'=>$err);
            $res=$result;
            break;
            }
            $obj=new user($db['jzeva']);
            $result =  $obj->deactUser($params);
            $res= $result;
            break;

// localhost/jzevasb/apis/index.php?action=actUser&mobile=9975887206                        
        case 'actUser':
            include APICLUDE.'class.user.php';
            $mobile=(!empty($params['mobile'])) ?  trim($params['mobile']) : '';
            if(empty($params['mobile']))
            {
            $arr=array();
            $err=array('code'=>1,'Msg'=>'plz provide the email');
            $result=array('results'=> $arr,'error'=>$err['error']);
            $res=$result;
            break;
            }
            $obj=new user($db['jzeva']);
            $result =  $obj->actUser($params);
            $res= $result;
            break;

// localhost/jzevasb/apis/index.php?action=viewAll&mobile=9975887206            
        case 'viewAll':
            include APICLUDE.'class.user.php';
            $mobile=(!empty($params['mobile'])) ?  trim($params['mobile']) : '';
            if(empty($mobile))
            {
                $arr=array();
                $err=array('code'=>1,'Msg'=>'Some Parameters missing');
                $result=array('results'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj=new user($db['jzeva']);
            $result =  $obj->viewAll($params);
            $res= $result;
            break;

//--------------------------Order---------------------------------------- 
                       
// localhost/jzevasb/apis/index.php?action=ordById&usermobile=9975887206                            
        case 'ordById':
            include APICLUDE.'class.orders.php';
            $usermobile=(!empty($params['usermobile'])) ? trim(urldecode($params['usermobile'])):'';
            if(empty($usermobile))
            {
                $res = array();
                $err = array('Code' => 1, 'Msg' => 'Please mention the user id');
                $result = array('results' => $res, 'error' => $err);
                break;
            }
            $obj= new orders($db['jzeva']);
            $result = $obj->ordById($params);
            $res= $result;
            break;

// localhost/jzevasb/apis/index.php?action=actOrdList&usermobile=9975887206             
        case 'actOrdList':
            include APICLUDE.'class.orders.php';
            $usermobile=(!empty($params['usermobile'])) ? trim(urldecode($params['usermobile'])):'';
            if(empty($usermobile))
            {
                $res = array();
                $err = array('Code' => 1, 'Msg' => 'Invalid parameters');
                $result = array('results' => $res, 'error' => $err);
                break;
            }
            $obj = new orders($db['jzeva']);
            $result=$obj->actOrdList($params);
            $res= $result;
            break;
                
/*        case 'ordByCat':
            include APICLUDE.'class.orders.php';
            $pid = (!empty($params['product_id'])) ? trim($params['product_id']) : '';
            if(empty($pid))
            {
                $res = array();
                $err = array('Code' => 1, 'Msg' => 'Please mention the product id');
                $result = array('results' => $res, 'error' => $err);
                break;
            }
            $obj    = new orders($db['jzeva']);
            $result = $obj->ordByCat($params);
            $res = $result;
            break;

        case 'ordByAmt':
            include APICLUDE.'class.orders.php';
            $pid  = (!empty($params['product_id'])) ? trim($params['product_id']) : '';
            if(empty($pid))
            {
            $res = array();
            $err = array('Code' => 1, 'Msg' => 'Please mention the product code');
            $result = array('results' => $res, 'error' => $err);
            break;
            }
            $obj= new orders($db['jzeva']);
            $result= $obj->ordByAmt($params);
            $res = $result;
            break;
  */          
//-----------------------------ViewLog----------------------------                

//  localhost/jzevasb/apis/index.php?action=filLog&mobile=9975887206&product_id=7            
        case 'filLog':
            include APICLUDE.'class.viewlog.php';
            $mobile=(!empty($params['mobile'])) ? trim($params['mobile']) : '';
            $product_id=(!empty($params['product_id'])) ? trim($params['product_id']) : '';
            if(empty($product_id) && empty($mobile))
            {
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Invalid Parameters');
                $result = array('results' => $arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new viewlog($db['jzeva']);
            $result= $obj->filLog($params);
            $res = $result;
            break;

//  localhost/jzevasb/apis/index.php?action=viewLog&logmobile=7878787878                        
        case 'viewLog':
            include APICLUDE.'class.viewlog.php';
            $logmobile=(!empty($params['logmobile'])) ? trim($params['logmobile']) : '';
            if(empty($logmobile))
            {
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Invalid Parameters');
                $result = array('results' => $arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new viewlog($db['jzeva']);
            $result= $obj->viewLog($params);
            $res = $result;
            break;
            
//-----------------------------Vendor-----------------------------

//  localhost/jzevasb/apis/index.php?action=addVendorPrdInfo&product_id=7&logmobile=9975887206&vendor_price=3300023&vendor_quantity=3&vendor_currency=INR&vendor_remarks=Excellent&active_flag=1            
        case 'addVendorPrdInfo':
            include APICLUDE.'class.vendor.php';            
            $product_id=(!empty($params['product_id'])) ? trim($params['product_id']) : '';
            $logmobile=(!empty($params['logmobile'])) ? trim($params['logmobile']) : '';
            $vendor_price=(!empty($params['vendor_price'])) ? trim($params['vendor_price']) : '';
            $vendor_quantity=(!empty($params['vendor_quantity'])) ? trim($params['vendor_quantity']) : '';
            $vendor_currency=(!empty($params['vendor_currency'])) ? trim(urldecode($params['vendor_currency'])) : '';
            $vendor_remarks=(!empty($params['vendor_remarks'])) ? trim(urldecode($params['vendor_remarks'])) : '';
            $active_flag=(!empty($params['active_flag'])) ? trim($params['active_flag']) : '';
            if(empty($product_id)&&empty($logmobile)&&empty($vendor_price)&&empty($vendor_quantity)&&empty($vendor_currency)&&empty($vendor_remarks)&&empty($active_flag)&&empty($updatedby))
            {
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Invalid parameters');
                $result = array('results' => $arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new vendor($db['jzeva']);
            $result= $obj->addVendorPrdInfo($params);
            $res=$result;
            break;

//  localhost/jzevasb/apis/index.php?action=getVproducts&vendormobile=9975887206  
        case 'getVproducts':
            include APICLUDE.'class.vendor.php';
            $vendormobile=(!empty($params['vendormobile'])) ? trim($params['vendormobile']) : '';
            if(empty($vendormobile))
            {
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Invalid parameters');
                $result = array('results' => $arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj=new vendor($db['jzeva']);
            $result=$obj->getVproducts($params);
            $res=$result;
            break;

//  localhost/jzevasb/apis/index.php?action=getVproductsByName&vendormobile=9975887206&prname=blue            
        case 'getVproductsByName':
            include APICLUDE.'class.vendor.php';
            $vendormobile=(!empty($params['vendormobile'])) ? trim($params['vendormobile']) : ''; //user session mobile
            $prname=(!empty($params['prname'])) ? trim(urldecode($params['prname'])) : '';
            if(empty($vendormobile)&&empty($vendormobile))
            {
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Invalid parameters');
                $result = array('results' => $arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj=new vendor($db['jzeva']);
            $result=$obj->getVproductsByName($params);
            $res=$result;
            break;
                        
//  localhost/jzevasb/apis/index.php?action=updateProductInfo&vendor_id=1&logmobile=9975887206&product_id=7&vendor_price=93323823&vendor_quantity=10&active_flag=1
        case 'updateProductInfo':
            include APICLUDE.'class.vendor.php';
            $vendor_id=(!empty($params['vendor_id'])) ? trim($params['vendor_id']) : '';
            $logmobile=(!empty($params['logmobile'])) ? trim($params['logmobile']) : '';
            $product_id=(!empty($params['product_id'])) ? trim($params['product_id']) : '';
            $vendor_price=(!empty($params['vendor_price'])) ? trim($params['vendor_price']) : '';
            $vendor_quantity=(!empty($params['vendor_quantity'])) ? trim($params['vendor_quantity']) : '';
            $active_flag=(!empty($params['active_flag'])) ? trim($params['active_flag']) : '';
            if(empty($vendor_id)&&empty($product_id)&&empty($logmobile)&&empty($vendor_price)&&empty($vendor_quantity)&&empty($active_flag))
            {
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Invalid parameters');
                $result = array('results' => $arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new vendor($db['jzeva']);
            $result= $obj->updateProductInfo($params);
            $res=$result;
            break;

//-------------------------Location---------------------------------               
            
// localhost/jzevasb/apis/index.php?action=addCity&cname=Pakistan&sname=Punjab&cityname=lahore            
        case 'addCity':
            include APICLUDE.'class.location.php';
            $cityname=(!empty($params['cityname'])) ? trim(urldecode($params['cityname'])) : '';
            $sname=(!empty($params['sname'])) ? trim(urldecode($params['sname'])) : '';
            $cname=(!empty($params['cname'])) ? trim(urldecode($params['cname'])) : '';
            if(empty($cname)&&empty($cityname)&&empty($sname))
            {
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Invalid Parameters');
                $result = array('results' => $arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new location($db['jzeva']);
            $result= $obj->addCity($params);
            $res=$result;
            break;

// localhost/jzevasb/apis/index.php?action=viewbyCity&cityname=bangalore            
        case 'viewbyCity':
            include APICLUDE.'class.location.php';
            $cityname=(!empty($params['cityname'])) ? trim(urldecode($params['cityname'])) : '';
            if(empty($cityname))
            {
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Invalid Parameters');
                $result = array('results' => $arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new location($db['jzeva']);
            $result= $obj->viewbyCity($params);
            $res= $result;
            break;
                        
// localhost/jzevasb/apis/index.php?action=viewbyState&sname=haryana&cname=India                 
        case 'viewbyState': 
            include APICLUDE.'class.location.php';
            $sname=(!empty($params['sname'])) ? trim(urldecode($params['sname'])) : '';
            $cname=(!empty($params['cname'])) ? trim(urldecode($params['cname'])) : '';
            if(empty($sname)&&empty($cname))
            {
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Invalid Parameters');
                $result = array('results'=>$arr,'error' => $err);
                $res=$result;
                break;
            }
            $obj= new location($db['jzeva']);
            $result= $obj->viewbyState($params);
            $res=$result;
            break;
        
// localhost/jzevasb/apis/index.php?action=viewbyCountry&cname=lahore            
        case 'viewbyCountry':
            include APICLUDE.'class.location.php';
            $cname=(!empty($params['cname'])) ? trim(urldecode($params['cname'])) : '';
            if(empty($cname))
            {
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Invalid Parameters');
                $result = array('results' => $arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new location($db['jzeva']);
            $result= $obj->viewbyCountry($params);
            $res=$result;
            break;    
            
// localhost/jzevasb/apis/index.php?action=updatecity&newcityname=Delhi&oldcityname=delhi&sname=delhi&cname=India            
        case 'updatecity':
            include APICLUDE.'class.location.php';
            $newcityname=(!empty($params['newcityname'])) ? trim(urldecode($params['newcityname'])) : '';
            $oldcityname=(!empty($params['oldcityname'])) ? trim(urldecode($params['oldcityname'])) : '';
            $sname=(!empty($params['sname'])) ? trim(urldecode($params['sname'])) : '';
            $cname=(!empty($params['cname'])) ? trim(urldecode($params['cname'])) : '';            
            if(empty($cname)&& empty($newcityname) && empty($sname) && empty($oldcityname))
            {
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Invalid Parameters');
                $result = array('results' => $arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new location($db['jzeva']);
            $result= $obj->updateCity($params);
            $res=$result;
            break;

//-------------------------CategoryInfo-----------------------------
        
// localhost/jzevasb/apis/index.php?action=getCatList        
        case 'getCatList': 
            include APICLUDE.'class.categoryInfo.php';
            $obj= new categoryInfo($db['jzeva']);
            $result= $obj->getCatList();
            $res=$result;
            break;
        
// localhost/jzevasb/apis/index.php?action=getCatName&catid=3        
        case 'getCatName':
            include APICLUDE.'class.categoryInfo.php';
            $catid=(!empty($params['catid'])) ? trim($params['catid']) : '';
            if(empty($catid))
            {
                $arr=array();
                $err=array('code'=>1,'Invalid Parameter');
                $result=array('result'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj= new categoryInfo($db['jzeva']);
            $result= $obj->getCatName($params);
            $res= $result;
            break;

// localhost/jzevasb/apis/index.php?action=getCatId&catName=jwellery            
        case 'getCatId':
            include APICLUDE.'class.categoryInfo.php';
            $catName=(!empty($params['catName'])) ? trim(urldecode($params['catName'])) : '';
            if(empty($catName))
            {
                $arr=array();
                $err=array('code'=>1,'Invalid Parameter');
                $result=array('result'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj= new categoryInfo($db['jzeva']);
            $result= $obj->getCatId($params);
            $res= $result;
            break;

// localhost/jzevasb/apis/index.php?action=addCat&catName=Diamond       
        case 'addCat':
            include APICLUDE.'class.categoryInfo.php';
            $catName=(!empty($params['catName'])) ? trim(urldecode($params['catName'])) : '';
            if(empty($catName))
            {
                $arr=array();
                $err=array('code'=>1,'Invalid Parameter');
                $result=array('result'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }

            $obj= new categoryInfo($db['jzeva']);
            $result=$obj->addCat($params);
            $res=$result;
            break;
        
// localhost/jzevasb/apis/index.php?action=deleteCat&catid=3                        
        case 'deleteCat':
            include APICLUDE.'class.categoryInfo.php';
            $catid=(!empty($params['catid'])) ? trim($params['catid']) : '';
            if(empty($catid))
            {
                $arr=array();
                $err=array('code'=>1,'Invalid Parameter');
                $result=array('result'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj= new categoryInfo($db['jzeva']);
            $result= $obj->deleteCat($params);
            $res= $result;
            break;

// localhost/jzevasb/apis/index.php?action=updateCat&catid=2&catName=jwellery            
        case 'updateCat':
            include APICLUDE.'class.categoryInfo.php';
            $catid=(!empty($params['catid'])) ? trim($params['catid']) : '';
            $catName=(!empty($params['catName'])) ? trim(urldecode($params['catName'])) : '';
            if(empty($catid) && empty($catName))
            {
                $arr=array();
                $err=array('code'=>1,'Invalid Parameter');
                $result=array('result'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj= new categoryInfo($db['jzeva']);
            $result= $obj->updateCat($params);
            $res=$result;
            break;

//----------------------BrandInfo------------------------------

// localhost/jzevasb/apis/index.php?action=getBrandList           
        case 'getBrandList':
            include APICLUDE.'class.brandInfo.php';
            $obj= new brandInfo($db['jzeva']);
            $result= $obj->getBrandList();
            $res=$result;
            break;

//-------------------------Auto---------------------------------  

// localhost/jzevasb/apis/index.php?action=searchbox&srch=p        
        case 'searchbox':
            include APICLUDE.'class.auto.php';
            $srch=(!empty($params['srch'])) ? trim(urldecode($params['srch'])) : '';
            if(empty($srch))
            {
            $arr=array();
            $err=array('code'=> 1,'Msg'=> 'Invalid parameters');
            $result=array('results'=> $arr,'error'=>$err['error']);
            $res=$result;
            break;
            }
            $obj = new auto($db['jzeva']);
            $result=$obj->searchbox($params);
            $res=$result;
            break;

//--------------------Product-----------------------------------           

//  localhost/jzevasb/apis/index.php?action=addNewproduct&dt={%22result%22:%20{%22product_name%22:%20%22bluediamond%22,%22brandid%22:%2011,%22lotref%22:%201123,%22barcode%22:%20%22qw211111%22,%22lotno%22:%201133,%22product_display_name%22:%20%22marveric%20blue%20silver%20diamond%22,%22product_model%22:%20%22rw231%22,%22product_brand%22:%20%22orra%22,%22product_price%22:%2012211223.02,%22product_currency%22:%20%22INR%22,%22product_keywords%22:%20%22blue,silver,diamond%22,%22product_desc%22:%20%22a%20clear%20cut%20solitaire%20diamond%20in%20the%20vault%22,%22product_wt%22:%20223.21,%22prd_img%22:%20%22abc.jpeg%22,%22category_id%22:%201,%22product_warranty%22:%20%221%20year%22},%22attributes%22:%20[[111,%22green%22,1]],%22design%22:%20{%22desmobile%22:%20%22889898989%22,%22desname%22:%20%22shiamak%22},%22error%22:%20{%22errCode%22:%200}}
        case 'addNewproduct':
            include APICLUDE.'class.product.php';
            $dt=(!empty($params['dt'])) ? trim(urldecode($params['dt'])) : '';
            if(empty($dt))
            {
                
            $arr=array();
            $err=array('code'=> 1,'Msg'=> 'Invalid parameters');
            $result=array('results'=> $arr,'error'=>$err);
            $res=$result;
            break;
            }
            $obj=new product($db['jzeva']);
            $result=$obj->addNewproduct($params);
            $res=$result;
            break;
     
            /*case 'imageUpdate':
            include APICLUDE.'class.product.php';
            $dt=(!empty($params['dt'])) ? trim(urldecode($params['dt'])) : '';
            if(empty($dt))
            {
            $arr=array();
            $err=array('code'=> 1,'Msg'=> 'Invalid parameters');
            $result=array('results'=> $arr,'error'=>$err['error']);
            $res=$result; 
            break;
            }
            $obj=new product($db['jzeva']);
            $result=$obj->imageUpdate($params);
            $res=$result;
            break; */
            
//  localhost/jzevasb/apis/index.php?action=getPrdByName&prname=blue            
        case 'getPrdByName':
            include APICLUDE.'class.product.php';
            $prname=(!empty($params['prname'])) ? trim(urldecode($params['prname'])) : '';
            if(empty($prname))
            {
            $arr=array();
            $err=array('code'=> 1,'Msg'=> 'Invalid parameters');
            $result=array('results'=> $arr,'error'=>$err);
            $res=$result;
            break;
            }
            $obj=new product($db['jzeva']);
            $result=$obj->getPrdByName($params);
            $res=$result;
            break;

//  localhost/jzevasb/apis/index.php?action=getPrdByCatid&catid=1
        case 'getPrdByCatid': 
            include APICLUDE.'class.product.php';
            $catid=(!empty($params['catid'])) ? trim($params['catid']) : '';
            if(empty($catid))
            {
            $arr=array();
            $err=array('code'=> 1,'Msg'=> 'Invalid parameter');
            $result=array('results'=> $arr,'error'=>$err);
            $res=$result;
            break;
            }
            $obj=new product($db['jzeva']);
            $result=$obj->getPrdByCatid($params);
            $res=$result;
            break;

//  localhost/jzevasb/apis/index.php?action=getPrdById&prdid=7          
        case 'getPrdById':            
            include APICLUDE.'class.product.php';
            $prdid=(!empty($params['prdid'])) ? trim($params['prdid']):'';
            if(empty($prdid))
            {
            $arr=array();
            $err=array('code'=> 1,'Msg'=> 'Invalid parameters');
            $result=array('results'=> $arr,'error'=>$err);
            $res=$result;
            break;
            }
            $obj=new product($db['jzeva']);
            $result=$obj->getPrdById($params);
            $res= $result;
            break;
            
//  localhost/jzevasb/apis/index.php?action=getList
        case 'getList':
            include APICLUDE.'class.product.php';
            $obj=new product($db['jzeva']);
            $result=$obj->getList();
            $res=$result;
            break;

//  localhost/jzevasb/apis/index.php?action=productByCity&cityname=lucknow            
        case 'productByCity':
            include APICLUDE.'class.product.php';
            $cityname   =(!empty($params['cityname'])) ? trim($params['cityname']): "";
            //$pcode=(!empty($params['product_id'])) ? trim($params['product_id']): "";
            if(empty($cityname))
            {
                $arr=array();
                $err=array('Code'=>1,'Msg'=>'Invalid Parameters');
                $result=array('result'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj= new product($db['jzeva']);
            $result=$obj->productByCity($params);
            $res=$result;
            break;
            
//---------------------------Offer---------------------------------------            

//  localhost/jzevasb/apis/index.php?action=addOffer&offername=diwalidhamaka&des=a well reknown festive offer we are celebrating since ages&amdp=1.1&valid=1 year&vdesc=1123fwhf232
        case 'addOffer':
            include APICLUDE.'class.offer.php';
            $offername = (!empty($params['offername'])) ? trim(urldecode($params['offername'])) : '';
            $des  = (!empty($params['des'])) ? trim(urldecode($params['des'])) : '';
            $amdp  = (!empty($params['amdp'])) ? trim(urldecode($params['amdp'])) : '';
            $valid=(!empty($params['valid'])) ?  trim(urldecode($params['valid'])) : '';
            $voucherdesc  =   (!empty($params['vdesc'])) ? trim(urldecode($params['vdesc'])) : '';
            if(empty($offername) && empty($des) && empty($amdp) && empty($valid) && empty($voucherdesc))
            {
                $res = array();
                $err = array('Code' => 1, 'Msg' => 'Invalid Parameters');
                $result = array('results' => $res, 'error' => $err);
                break;
            }
            $obj    = new offer($db['jzeva']);
            $result = $obj->addOffer($params);
            $res = $result;
            break;

//  localhost/jzevasb/apis/index.php?action=viewOffer&offid=1
        case 'viewOffer':
            include APICLUDE.'class.offer.php';
            $offid  = (!empty($params['offid'])) ?  trim($params['offid']) : '';               
            if(empty($offid))
            {
                $res = array();
                $err = array('Code' => 1, 'Msg' => 'Please mention the offer id');
                $result = array('results' => $res, 'error' => $err);
                break;
            }
            $obj    = new offer($db['jzeva']);
            $result = $obj->viewOffer($params);
            $res = $result;
            break;

//  localhost/jzevasb/apis/index.php?action=actOffer&offid=2            
        case 'actOffer':
            include APICLUDE.'class.offer.php';
            $offid  = (!empty($params['offid'])) ?  trim($params['offid']) : '';               
            if(empty($offid))
            {
                $res = array();
                $err = array('Code' => 1, 'Msg' => 'Please mention the offer id');
                $result = array('results' => $res, 'error' => $err);
                break;
            }
            $obj    = new offer($db['jzeva']);
            $result = $obj->actOffer($params);
            $res = $result;
            break;
            
//  localhost/jzevasb/apis/index.php?action=deactOffer&offid=2
        case 'deactOffer':
            include APICLUDE.'class.offer.php';
            $offid  = (!empty($params['offid'])) ?  trim($params['offid']) : '';               
            if(empty($offid))
            {
                $res = array();
                $err = array('Code' => 1, 'Msg' => 'Please mention the offer id');
                $result = array('results' => $res, 'error' => $err);
                break;
            }
            $obj    = new offer($db['jzeva']);
            $result = $obj->deactOffer($params);
            $res = $result;
            break;

//  localhost/jzevasb/apis/index.php?action=offerUserBind&offerid=2&logmobile=9975887206&dispos=999&dispflag=1
        case 'offerUserBind':
            include APICLUDE.'class.offer.php';
            $offid  = (!empty($params['offid'])) ?  trim($params['offid']) : '';               
            $usermobile  = (!empty($params['logmobile'])) ?  trim($params['logmobile']) : '';
            $dpos  = (!empty($params['dispos'])) ?  trim($params['dispos']) : '';               
            $dflag  = (!empty($params['dispflag'])) ?  trim($params['dispflag']) : '';
            if(empty($offid) && empty($usermobile) && empty($dpos) && empty($dflag))
            {
                $res = array();
                $err = array('Code' => 1, 'Msg' => 'Invalid parameters');
                $result = array('results' => $res, 'error' => $err);
                break;
            }
            $obj    = new offer($db['jzeva']);
            $result = $obj->offerUserBind($params);
            $res = $result;
            break;

//  localhost/jzevasb/apis/index.php?action=offerUserUnBind&offid=2&logmobile=9975887206
        case 'offerUserUnBind':
            include APICLUDE.'class.offer.php';
            $offid  = (!empty($params['offid'])) ?  trim($params['offid']) : '';               
            $usermobile  = (!empty($params['logmobile'])) ?  trim($params['logmobile']) : '';
            if(empty($offid) && empty($usermobile))
            {
                $res = array();
                $err = array('Code' => 1, 'Msg' => 'Invalid parameters');
                $result = array('results' => $res, 'error' => $err);
                break;
            }
            $obj    = new offer($db['jzeva']);
            $result = $obj->offerUserUnBind($params);
            $res = $result;
            break;    
            
//----------------------cart------------------------------------------------            

        
//  localhost/jzevasb/apis/index.php?action=addToCart&usermobile=9975887206&qty=20&pid=7&vendormobile=7309290529        
        case 'addToCart':
            include APICLUDE.'class.cart.php';
            $usermobile  = (!empty($params['usermobile']))?  trim($params['usermobile']) : '';
            $qty  = (!empty($params['qty'])) ? trim($params['qty']) : '';
            $pid  = (!empty($params['pid'])) ? trim($params['pid']) : '';
            $vendormobile  =(!empty($params['vendormobile'])) ? trim($params['vendormobile']) : '';
            if(empty($uid) && empty($qty) && empty($pid) && empty($cartid))
            {
            $res = array();
            $err = array('Code' => 1, 'Msg' => 'Invalid Parameters');
            $result = array('results' => $res, 'error' => $err);
            break;
            }
            $obj=new cart($db['jzeva']);
            $result=$obj->addToCart($params);
            $res = $result;
            break; 
            
//  localhost/jzevasb/apis/index.php?action=editCart&cart_id=1&quantity=10&product_id=7            
        case 'editCart':
            include APICLUDE.'class.cart.php';
            $cartid  = (!empty($params['cart_id']))?  trim($params['cart_id']) : '';
            $qty  = (!empty($params['quantity'])) ? trim($params['quantity']) : '';
            $pid  = (!empty($params['product_id'])) ? trim($params['product_id']) : '';    
            if(empty($qty) && empty($pid) && empty($cartid))
            {
            $res = array();
            $err = array('Code' => 1, 'Msg' => 'Invalid Parameters');
            $result = array('results' => $res, 'error' => $err);
            break;
            }
            $obj=new cart($db['jzeva']);
            $result=$obj->editCart($params);
            $res=$result;
            break;

//  localhost/jzevasb/apis/index.php?action=readCart&cartid=1            
        case 'readCart':
            include APICLUDE.'class.cart.php';
            $cartid =(!empty($params['cartid'])) ? trim($params['cartid']) : '';
            if(empty($cartid))
            {
            $res = array();
            $err = array('Code' => 1, 'Msg' => 'Please mention the user id');
            $result = array('results' => $res, 'error' => $err);
            break;
            }
            $obj    = new cart($db['jzeva']);
            $result = $obj->readCart($params);
            $res= $result;
            break;

//  localhost/jzevasb/apis/index.php?action=delPrd&cartid=1&pid=7
        case 'delPrd':
            include APICLUDE.'class.cart.php';
            $pid  = (!empty($params['pid'])) ? trim($params['pid']) : '';
            $cartid  =(!empty($params['cartid'])) ? trim($params['cartid']) : '';
            if(empty($pid) && empty($cartid))
            {
                $res = array();
                $err = array('Code' => 1, 'Msg' => 'Invalid Parameters');
                $result = array('results' => $res, 'error' => $err);
                break;
            }
            $obj=new cart($db['jzeva']);
            $result=$obj->delPrd($params);
            $res= $result;
            break;
/*
//  localhost/jzevasb/apis/index.php?action=cartClr&cartid=1&product_id=7            
        case 'cartClr':
            include APICLUDE.'class.cart.php';
            $pid  = (!empty($params['product_id'])) ? trim($params['product_id']) : '';
            $cartid  = (!empty($params['cartid'])) ?  trim($params['cartid']) : '';
            if(empty($pid) && empty($cartid))
            {
                $res = array();
                $err = array('Code' => 1, 'Msg' => 'Invalid Parameters');
                $result = array('results'=>$res,'error'=>$err);
                break;
            }
            $obj= new cart($db['jzeva']);
            $result = $obj->cartClr($params);
            $res= $result;
            break;
*/
            
//----------------------Attribute-----------------------------------------------

 // localhost/jzevasb/apis/index.php?action=get_attrList            
        case 'get_attrList':
            include APICLUDE.'class.attribute.php';
            $obj = new attribute($db['jzeva']);
            $result=$obj->get_attrList();
            $res=$result;
            break;
        
//  localhost/jzevasb/apis/index.php?action=set_attributes_details&name=flurocent&dname=luminous&unit=10&flag=1&upos=2&vals={10,20,30,40,50,60,70}&range=10        
        case 'set_attributes_details':
            include APICLUDE.'class.attribute.php';
            $name=(!empty($params['name'])) ? trim($params['name']):'';
            $dname=(!empty($params['dname'])) ? trim($params['dname']):'';
            $unit=(!empty($params['unit'])) ? trim($params['unit']):'';
            $flag=(!empty($params['flag'])) ? trim($params['flag']):'';                
            $upos=(!empty($params['upos'])) ? trim(urldecode($params['upos'])):'';
            $vals=(!empty($params['vals'])) ? trim($params['vals']) : '';
            $range=(!empty($params['range'])) ? trim(urldecode($params['range'])):'';
            if(empty($name) && empty($dname) && empty($unit) && empty($flag) && empty($upos) && empty($vals) && empty($range))
            {
            $arr=array();
            $err=array('code'=> 1,'Msg'=> 'Invalid parameters');
            $result=array('results'=> $arr,'error'=>$err['error']);
            $res=$result;
            break;
            }
            $obj = new attribute($db['jzeva']);
            $result=$obj->set_attributes_details($params);
            $res=$result;
            break; 

//  localhost/jzevasb/apis/index.php?action=fetch_attributes_details&attribid=100012        
        case 'fetch_attributes_details':
            include APICLUDE.'class.attribute.php';
            $attrid=(!empty($params['attribid'])) ? trim($params['attribid']):'';
            if(empty($attrid))
            {
                $arr=array();
                $err=array('Code'=>1,'Msg'=>'Invalid Parameters');
                $result=array('result'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj= new attribute($db['jzeva']);
            $result=$obj->fetch_attributes_details($params);
            $res=$result;
            break;

//  localhost/jzevasb/apis/index.php?action=set_category_mapping&aid=43&dflag=1&dpos=999&fil_flag=1&fil_pos=999&aflag=1&catid=3
        case 'set_category_mapping':
            include APICLUDE.'class.attribute.php';
            $aid =(!empty($params['aid'])) ? trim($params['aid']):'';
            $dflag =(!empty($params['dflag'])) ? trim($params['dflag']):'';
            $dpos =(!empty($params['dpos'])) ? trim($params['dpos']):'';
            $fil_flag =(!empty($params['fil_flag'])) ? trim($params['fil_flag']):'';
            $fil_pos =(!empty($params['fil_pos'])) ? trim($params['fil_pos']):'';
            $aflag =(!empty($params['aflag'])) ? trim($params['aflag']):'';
            $catid =(!empty($params['catid'])) ? trim($params['catid']):'';
            if(empty($aid) && empty($dflag) && empty($dpos) && empty($fil_flag) && empty($fil_pos) && empty($aflag) && empty($catid))
            {
                $arr=array();
                $err=array('Code'=>1,'Msg'=>'Invalid Parameters');
                $result=array('result'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj= new attribute($db['jzeva']);
            $result=$obj->set_category_mapping($params);
            $res=$result;
            break;
            
//  localhost/jzevasb/apis/index.php?action=fetch_category_mapping&catid=3            
        case 'fetch_category_mapping':
            include APICLUDE.'class.attribute.php';
            $catid =(!empty($params['catid'])) ? trim($params['catid']):'';
            if(empty($catid))
            {
                $arr=array();
                $err=array('Code'=>1,'Msg'=>'Invalid Parameters');
                $result=array('result'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj= new attribute($db['jzeva']);
            $result=$obj->fetch_category_mapping($params);
            $res=$result;
            break;

//  localhost/jzevasb/apis/index.php?action=unset_category_mapping&catid=3&aid=12            
        case 'unset_category_mapping':
            include APICLUDE.'class.attribute.php';
            $id   =(!empty($params['aid'])) ? trim($params['aid']): "";
            $catid=(!empty($params['catid'])) ? trim($params['catid']): "";
            if(empty($id)&& empty($catid))
            {
                $arr=array();
                $err=array('Code'=>1,'Msg'=>'Invalid Parameters');
                $result=array('result'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj= new attribute($db['jzeva']);
            $result=$obj->unset_category_mapping($params);
            $res=$result;
            break;

        default :
        break;

//-----------------------------------------------------------------------------            
}    
echo json_encode($res);
exit;
?>