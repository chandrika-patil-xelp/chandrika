<?php
include '../config.php';
$res['results'] = array();
$params = array_merge($_GET, $_POST);
$action = $_GET['action'];
        
switch($action)
{        
//----------------------------User---------------------------------------

//  localhost/jzeva/apis/index.php?action=checkUser&mobile=9987867578                
        case 'checkUser':
            include APICLUDE.'class.user.php';
            $mobile=(!empty($params['mobile'])) ? trim($params['mobile']) : '';
            if(empty($mobile))
            {   
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Some Parameters missing');
                $result = array('results'=>$arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new user($db['jzeva']);
            $result= $obj->checkUser($params);
            $res= $result;
            break;
            
// localhost/jzeva/apis/index.php?action=userReg&username=Shushrut Kumar&password=mishra1.234&mobile=7309290529&email=shubham.bajpai@xelpmoc.in&isvendor=1                                        
        case 'userReg':
            include APICLUDE.'class.user.php';
            $username=(!empty($params['username'])) ? trim(urldecode($params['username'])) : '';
            $password=(!empty($params['password'])) ? trim(urldecode($params['password'])) : '';
            $mobile=(!empty($params['mobile'])) ? trim($params['mobile']) : '';
            $email=(!empty($params['email'])) ?  trim(urldecode($params['email'])) : '';
            $usertype=(!empty($params['usertype'])) ? trim($params['usertype']) : '';
            if(empty($username)  &&  empty($password)  &&  empty($mobile)  &&  empty($email)  &&  empty($usertype))
            {   
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Some Parameters missing');
                $result = array('results'=>$arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new user($db['jzeva']);
            $result= $obj->userReg($params);
            $res= $result;
            break;
            
//  localhost/jzeva/apis/index.php?action=udtProfile&dt={%22result%22:{%22logmobile%22:7309290529,%22username%22:%22jummanji%22,%22gen%22:1,%22alt_email%22:%22singharun@gmail.com%22,%22dob%22:%221990-10-08%22,%22workphone%22:%229696969696%22,%22pincode%22:223232,%22area%22:%22janakpuri%20west%22,%22cityname%22:%22DELHI%22,%22state%22:%22Delhi%22,%22country%22:%22india%22,%22address1%22:%22sfwfe%20ewf%20wef%20wfe%22,%22address2%22:%22sfwfe%20ewf%20wef%20wfe%22,%22mobile%22:34235235,%22landline%22:%223242425225%22,%22idtype%22:%22323222%22,%22idproof%22:%22323222%22,%22lat%22:10.224113,%22lng%22:23.74756363245}}            
        case 'udtProfile':
            include APICLUDE.'class.user.php';
            $dt=(!empty($params['dt'])) ?  trim(urldecode($params['dt'])) : '';
            if(empty($dt))
            {   
                //echo "here";
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
            
//  localhost/jzeva/apis/index.php?action=logUser&mobile=7309290529&password=mishra1.234            
        case 'logUser':
            include  APICLUDE.'class.user.php';
            $mobile=(!empty($params['mobile'])) ?  trim($params['mobile']) : '';
            $password=(!empty($params['password'])) ?  trim(urldecode($params['password'])) : '';
            if(empty($mobile)  &&  empty($password))
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

// localhost/jzeva/apis/index.php?action=updatePass&mobile=9975887206&password=bajpai123            
        case 'updatePass':
            include APICLUDE.'class.user.php';
            $password=(!empty($params['passowrd'])) ?  trim(urldecode($params['password'])) : '';
            $mobile=(!empty($params['mobile'])) ?  trim($params['mobile']) : '';
            if(empty($password)  &&  empty($mobile))
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

// localhost/jzeva/apis/index.php?action=deactUser&mobile=9975887206            
        case 'deactUser':
            include APICLUDE.'class.user.php';
            $mobile=(!empty($params['mobile'])) ?  trim($params['mobile']) : '';
            if(empty($params['mobile']))
            {
            $arr=array();
            $err=array('code'=>1,'Msg'=>'Invalid Parameters');
            $result=array('results'=> $arr,'error'=>$err);
            $res=$result;
            break;
            }
            $obj=new user($db['jzeva']);
            $result =  $obj->deactUser($params);
            $res= $result;
            break;

// localhost/jzeva/apis/index.php?action=actUser&mobile=9975887206                        
        case 'actUser':
            include APICLUDE.'class.user.php';
            $mobile=(!empty($params['mobile'])) ?  trim($params['mobile']) : '';
            if(empty($params['mobile']))
            {
            $arr=array();
            $err=array('code'=>1,'Msg'=>'Invalid Parameter');
            $result=array('results'=> $arr,'error'=>$err);
            $res=$result;
            break;
            }
            $obj=new user($db['jzeva']);
            $result =  $obj->actUser($params);
            $res= $result;
            break;

//  localhost/jzeva/apis/index.php?action=viewAll&uid=6           
        case 'viewAll':
            include APICLUDE.'class.user.php';
            $uid=(!empty($params['uid']))?trim($params['uid']) : '';
            if(empty($uid))
            {
                $arr=array();
                $err=array('code'=>1,'Msg'=>'Some Parameters missing');
                $result=array('results'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj=new user($db['jzeva']);
            $result=$obj->viewAll($params);
            $res=$result;
            break;
//--------------------------Order----------------------------------------
                       
//  localhost/jzeva/apis/index.php?action=addOrd&dt={%22result%22:%20{%22uid%22:%2010105,%22cid%22:111,%22said%22:1,%22baid%22:%201,%22tid%22:%20%22singharun@gmail.com%22,%22ost%22:%20%221990-10-08%22},%22error%22:%20{%22errCode%22:%200}}
        case 'addOrd':
            include APICLUDE.'class.orders.php';
            $dt=(!empty($params['dt'])) ? trim(urldecode($params['dt'])) : '';
            if(empty($dt))
            {
                $arr=array();
                $err=array('Code'=>1,'Msg'=>'Invalid Parameter');
                $result=array('results'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj=new orders($db['jzeva']);
            $result=$obj->addOrd($params);
            $res=$result;
            break;
    
//  localhost/jzeva/apis/index.php?action=ordById&tid=9975887206&page=1&limit=1                            
        case 'ordById':
            include APICLUDE.'class.orders.php';
            $tid=(!empty($params['tid'])) ? trim(urldecode($params['tid'])):'';
            if(empty($tid))
            {
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Parameter missing');
                $result = array('results' => $res, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new orders($db['jzeva']);
            $result = $obj->ordById($params);
            $res= $result;
            break;
            
//  localhost/jzeva/apis/index.php?action=actOrdList&uid=9975887206&limit=1&page=1            
        case 'actOrdList':
            include APICLUDE.'class.orders.php';
            $uid=(!empty($params['uid'])) ? trim($params['uid']):'';
            if(empty($oid))
            {
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Parameter missing');
                $result = array('results' => $res, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new orders($db['jzeva']);
            $result = $obj->ordById($params);
            $res= $result;
            break;
            
//  localhost/jzeva/apis/index.php?action=addtrans&dt={%22result%22:%20{%22oid%22:1,%22uid%22:10105,%22tid%22:%209975887206,%22ptyp%22:%20%22sadd%22,%22pmode%22:%201,%22cuse%22:%20%22singharun@gmail.com%22,%22cur%22:%20%221990-10-08%22,%22des%22:%20%22sddv%20cd%20qwdd%22,%22amt%22:%20120012},%22error%22:%20{%22errCode%22:%200}}
        case 'addtrans':
            include APICLUDE.'class.orders.php';
            $dt=(!empty($params['dt'])) ? trim(urldecode($params['dt'])):'';
            if(empty($dt))
            {
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Invalid parameters');
                $result = array('results' => $res, 'error' => $err);
                $res=$result;
                break;
            }
            $obj = new orders($db['jzeva']);
            $result=$obj->addtrans($params);
            $res= $result;
            break;
            
//  localhost/jzeva/apis/index.php?action=actOrdList&tid=9975887206&page=1&limit=1
        case 'viewtrans':
            include APICLUDE.'class.orders.php';
            $tid  = (!empty($params['tid'])) ? trim($params['tid']) : '';
            if(empty($tid))
            {
            $arr = array();
            $err = array('Code' => 1, 'Msg' => 'Invalid transaction id');
            $result = array('results' => $res, 'error' => $err);
            break;
            }
            $obj= new orders($db['jzeva']);
            $result= $obj->ordByAmt($params);
            $res = $result;
            break;         
//-----------------------------ViewLog----------------------------------

//  localhost/jzeva/apis/index.php?action=filLog&uid=&product_id=7&vid=            
        case 'filLog':
            include APICLUDE.'class.viewlog.php';
            $uid=(!empty($params['uid'])) ? trim($params['uid']) : '';
            $product_id=(!empty($params['product_id'])) ? trim($params['product_id']) : '';
            $vid=(!empty($params['vid'])) ? trim($params['vid']):'';
            if(empty($product_id) && empty($uid) && empty($vid))
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

//  localhost/jzeva/apis/index.php?action=viewLog&vid=7878787878&pid=&page=&limit=                        
        case 'viewLog':
        include APICLUDE.'class.viewlog.php';
        $vid=(!empty($params['vid'])) ? trim($params['vid']) : '';
        if(empty($vid))
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
            
//-----------------------------Vendor Product------------------------------------

//  localhost/jzeva/apis/index.php?action=addVendorPrdInfo&dt={%22result%22:%20{%22pid%22:%201,%22vid%22:%207,%22vp%22:%207309290529,%22vq%22:%201,%22vc%22:%20%22INR%22,%22vr%22:%204.21,%22af%22:%201}}
        case 'addVendorPrdInfo':
            include APICLUDE.'class.vendor.php';            
            $dt=(!empty($params['dt'])) ? trim($params['dt']) : '';
            if(empty($dt))
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

//  localhost/jzeva/apis/index.php?action=getVproducts&vid=9975887206&page=&limit=  
        case 'getVproducts':
            include APICLUDE.'class.vendor.php';
            $vid=(!empty($params['vid'])) ? trim($params['vid']) : '';
            if(empty($vid))
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

//  localhost/jzeva/apis/index.php?action=getVproductsByName&vid=7&prname=blue&page=1&limit=1        
     /*   case 'getVproductsByName':
            include APICLUDE.'class.vendor.php';
            $vid=(!empty($params['vid'])) ? trim($params['vid']) : ''; //user session mobile
            $prname=(!empty($params['prname'])) ? trim(urldecode($params['prname'])) : '';
            $page=(!empty($params['page'])) ? trim($params['page']) : '';
            $limit=(!empty($params['limit'])) ? trim($params['limit']) : '';
            if(empty($vid) && empty($prname) && empty($page) && empty($limit))
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
            */
                        
//  localhost/jzeva/apis/index.php?action=updateProductInfo&vid=1&logmobile=9975887206&pid=7&vp=93323823&vq=10&af=1
        case 'updateProductInfo':
            include APICLUDE.'class.vendor.php';
            $vendor_id=(!empty($params['vid'])) ? trim($params['vid']) : '';
            $product_id=(!empty($params['pid'])) ? trim($params['pid']) : '';
            $vendor_price=(!empty($params['vp'])) ? trim($params['vp']) : '';
            $vendor_quantity=(!empty($params['vq'])) ? trim($params['vq']) : '';
            $active_flag=(!empty($params['af'])) ? trim($params['af']) : '';
            if(empty($vendor_id) && empty($product_id) && empty($vendor_price) && empty($vendor_quantity) && empty($active_flag))
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
            
//  localhost/jzeva/apis/index.php?action=getVDetailByPid&pid=1&vid=7&page=1&limit=1
        case 'getVDetailByVidPid':
            include APICLUDE.'class.vendor.php';
            $product_id=(!empty($params['pid'])) ? trim($params['pid']) : '';
            $vid=(!empty($params['vid'])) ? trim($params['vid']) : '';
            if(empty($product_id)&&empty($vid))
            {
                $arr=array();
                $err=array('Code'=>0,'Msg'=>'Invalid Parameter');
                $result=array('results'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj=new vendor($db['jzeva']);
            $result=$obj->getVDetailByPid($params);
            $res=$result;
            break;
   
//  localhost/jzeva/apis/index.php?action=getVDetailByPid&pid=1&vid=7&page=1&limit=1
        case 'getVDetailByPid':
            include APICLUDE.'class.vendor.php';
            $product_id=(!empty($params['pid'])) ? trim($params['pid']) : '';
            if(empty($product_id))
            {
                $arr=array();
                $err=array('Code'=>0,'Msg'=>'Invalid Parameter');
                $result=array('results'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj=new vendor($db['jzeva']);
            $result=$obj->getVDetailByPid($params);
            $res=$result;
            break;
               

//-------------------------Location--------------------------------------
 // localhost/jzeva/apis/index.php?action=addCity&cname=Pakistan&sname=Punjab&cityname=lahore            
        case 'addCity':
            include APICLUDE.'class.location.php';
            $cityname=(!empty($params['cityname'])) ? trim(urldecode($params['cityname'])) : '';
            $sname=(!empty($params['sname'])) ? trim(urldecode($params['sname'])) : '';
            $cname=(!empty($params['cname'])) ? trim(urldecode($params['cname'])) : '';
            if(empty($cname) && empty($cityname) && empty($sname))
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
            
// localhost/jzeva/apis/index.php?action=viewbyCity&cityname=bangalore            
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
                        
//  localhost/jzeva/apis/index.php?action=viewbyState&sname=punjab&cname=pakistan&page=1&limit=2                 
        case 'viewbyState': 
            include APICLUDE.'class.location.php';
            $sname=(!empty($params['sname'])) ? trim(urldecode($params['sname'])) : '';
            $cname=(!empty($params['cname'])) ? trim(urldecode($params['cname'])) : '';
            if(empty($sname) && empty($cname))
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
        
//  localhost/jzeva/apis/index.php?action=viewbyCountry&cname=pakistan&page=1&limit=2              
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
            
//  localhost/jzeva/apis/index.php?action=updatecity&newcityname=Delhi&oldcityname=lahore&sname=delhi&cname=India            
        case 'updatecity':
            include APICLUDE.'class.location.php';
            $newcityname=(!empty($params['newcityname'])) ? trim(urldecode($params['newcityname'])) : '';
            $oldcityname=(!empty($params['oldcityname'])) ? trim(urldecode($params['oldcityname'])) : '';
            $sname=(!empty($params['sname'])) ? trim(urldecode($params['sname'])) : '';
            $cname=(!empty($params['cname'])) ? trim(urldecode($params['cname'])) : '';            
            if(empty($cname) &&  empty($newcityname)  &&  empty($sname)  &&  empty($oldcityname))
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
        
//   localhost/jzeva/apis/index.php?action=getCatList&page=1&limit=2        
        case 'getSubCat': 
            include APICLUDE.'class.categoryInfo.php';
            $obj= new categoryInfo($db['jzeva']);
            $result= $obj->getSubCat($params);
            $res=$result;
            break;
        
        
//   localhost/jzeva/apis/index.php?action=getCatList&page=1&limit=2        
        case 'getCatList': 
            include APICLUDE.'class.categoryInfo.php';
            $obj= new categoryInfo($db['jzeva']);
            $result= $obj->getCatList($params);
            $res=$result;
            break;        
        
//  localhost/jzeva/apis/index.php?action=getCatName&catid=10001&page=1&limit=1        
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

// localhost/jzeva/apis/index.php?action=getCatId&catName=bullion            
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

// localhost/jzeva/apis/index.php?action=addCat&catName=Diamond       
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
        
//  localhost/jzeva/apis/index.php?action=deleteCat&catid=1                        
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

//  localhost/jzeva/apis/index.php?action=updateCat&catid=1&catName=diamond            
        case 'updateCat':
            include APICLUDE.'class.categoryInfo.php';
            $catid=(!empty($params['catid'])) ? trim($params['catid']) : '';
            $catName=(!empty($params['catName'])) ? trim(urldecode($params['catName'])) : '';
            if(empty($catid)  &&  empty($catName))
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

// localhost/jzeva/apis/index.php?action=getBrandList&page=&limit=                  
        case 'getBrandList':
            include APICLUDE.'class.brandInfo.php';
            $obj= new brandInfo($db['jzeva']);
            $result= $obj->getBrandList($params);
            $res=$result;
            break;

//-------------------------Auto---------------------------------  

//  localhost/jzeva/apis/index.php?action=searchbox&srch=b&page=1&limit=1         
        case 'searchbox':
            include APICLUDE.'class.auto.php';
            $srch=(!empty($params['srch'])) ? trim(urldecode($params['srch'])) : '';
            if(empty($srch))
            {
            $arr=array();
            $err=array('code'=> 1,'Msg'=> 'Invalid parameters');
            $result=array('results'=> $arr,'error'=>$err);
            $res=$result;
            break;
            }
            $obj = new auto($db['jzeva']);
            $result=$obj->searchbox($params);
            $res=$result;
            break;

//  localhost/jzeva/apis/index.php?action=suggestCity&str=de&page=1&limit=3            
        case 'suggestCity':
            include APICLUDE.'class.auto.php';
            $srch=(!empty($params['str'])) ? trim(urldecode($params['str'])) : '';
            if(empty($srch))
            {
            $arr=array();
            $err=array('code'=> 1,'Msg'=> 'Invalid parameters');
            $result=array('results'=> $arr,'error'=>$err);
            $res=$result;
            break;
            }
            $obj = new auto($db['jzeva']);
            $result=$obj->suggestCity($params);
            $res=$result;
            break;
            
//  localhost/jzeva/apis/index.php?action=suggestBrand&str=p&page=1&limit=1            
        case 'suggestBrand':
            include APICLUDE.'class.auto.php';
            $srch=(!empty($params['str'])) ? trim(urldecode($params['str'])) : '';
            if(empty($srch))
            {
            $arr=array();
            $err=array('code'=> 1,'Msg'=> 'Invalid parameters');
            $result=array('results'=> $arr,'error'=>$err);
            $res=$result;
            break;
            }
            $obj = new auto($db['jzeva']);
            $result=$obj->suggestBrand($params);
            $res=$result;
            break;

//  localhost/jzeva/apis/index.php?action=suggestCat&str=2&page=1&limit=2
        case 'suggestCat':
            include APICLUDE.'class.auto.php';
            $srch=(!empty($params['str'])) ? trim(urldecode($params['str'])) : '';
            if(empty($srch))
            {
            $arr=array();
            $err=array('code'=> 1,'Msg'=> 'Invalid parameters');
            $result=array('results'=> $arr,'error'=>$err);
            $res=$result;
            break;
            }
            $obj = new auto($db['jzeva']);
            $result=$obj->suggestCat($params);
            $res=$result;
            break;
            
//  localhost/jzeva/apis/index.php?action=suggestVendor&str=p&page=1&limit=1
        case 'suggestVendor':
            include APICLUDE.'class.auto.php';
            $srch=(!empty($params['str'])) ? trim(urldecode($params['str'])) : '';
            if(empty($srch))
            {
            $arr=array();
            $err=array('code'=> 1,'Msg'=> 'Invalid parameters');
            $result=array('results'=> $arr,'error'=>$err);
            $res=$result;
            break;
            }
            $obj = new auto($db['jzeva']);
            $result=$obj->suggestVendor($params);
            $res=$result;
            break;    
//--------------------Product---------------------------------------------
//  localhost/jzeva/apis/index.php?action=addNewproduct&dt={%22result%22:%20{%22product_name%22:%20%22bluediamond%22,%22brandid%22:%2011,%22lotref%22:%201123,%22barcode%22:%20%22qw211111%22,%22lotno%22:%201133,%22product_display_name%22:%20%22marveric%20blue%20silver%20diamond%22,%22product_model%22:%20%22rw231%22,%22product_brand%22:%20%22orra%22,%22product_price%22:%2012211223.02,%22product_currency%22:%20%22INR%22,%22product_keywords%22:%20%22blue,silver,diamond%22,%22product_desc%22:%20%22a%20clear%20cut%20solitaire%20diamond%20in%20the%20vault%22,%22product_wt%22:%20223.21,%22prd_img%22:%20%22abc.jpeg%22,%22category_id%22:%201,%22product_warranty%22:%20%221%20year%22},%22attributes%22:%20[[111,3,%22green%22,1]],%22design%22:{%22desname%22:%22jackdeniel%22},%22error%22:%20{%22errCode%22:%200}}
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
            
//  localhost/jzeva/apis/index.php?action=getPrdByName&prname=blue&page=1&limit=1            
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

//  localhost/jzeva/apis/index.php?action=getPrdByCatid&catid=1&page=1&limit=1         
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
			//print_r($res);die;
            break;

//  localhost/jzeva/apis/index.php?action=getPrdById&prdid=2&catid=3&page=1&limit=1         
        case 'getPrdById':            
            include APICLUDE.'class.product.php';
            $prdid=(!empty($params['prdid'])) ? trim($params['prdid']):'';
            $catid=(!empty($params['prdid'])) ? trim($params['prdid']):'';
            if(empty($prdid) && empty($catid))
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
            
//  localhost/jzeva/apis/index.php?action=getList&page=1&limit=1
        case 'getList':
            include APICLUDE.'class.product.php';
            $obj=new product($db['jzeva']);
            $result=$obj->getList($params);
            $res=$result;
            break;

//  localhost/jzeva/apis/index.php?action=productByCity&cityname=DELHI&page=1&limit=1            
        case 'productByCity':
            include APICLUDE.'class.product.php';
            $cityname=(!empty($params['cityname'])) ? trim($params['cityname']): "";
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
            
//  localhost/jzeva/apis/index.php?action=productByBrand&bname=orra&page=1&limit=1
        case 'productByBrand':
            include APICLUDE.'class.product.php';
            $bname=(!empty($params['bname'])) ? trim($params['bname']): "";
            if(empty($bname))
            {
                $arr=array();
                $err=array('Code'=>1,'Msg'=>'Invalid Parameters');
                $result=array('result'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj= new product($db['jzeva']);
            $result=$obj->productByBrand($params);
            $res=$result;
            break;

//  localhost/jzeva/apis/index.php?action=productByDesigner&desname=shiamak&page=1&limit=1            
        case 'productByDesigner':
            include APICLUDE.'class.product.php';
            $desname=(!empty($params['desname'])) ? trim($params['desname']): "";
            if(empty($desname))
            {
                $arr=array();
                $err=array('Code'=>1,'Msg'=>'Invalid Parameters');
                $result=array('result'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj= new product($db['jzeva']);
            $result=$obj->productByDesigner($params);
            $res=$result;
            break;


//------------------------------Suggestions str and table name---------------
   /*     
//  localhost/jzeva/apis/index.php?action=getsuggestions&tname=tbl_product_master&str=b            
       case 'getsuggestions':
            include APICLUDE.'class.product.php';
            $tblname=(!empty($params['tname']))? trim($params['tname']):'';
            $str=(!empty($params['str']))? trim($params['str']):'';
            if(empty($tblname) && empty($tblname))
            {
                $arr="Parameters missing";
                $err=array('Code'=>1,'Msg'=>'Invalid Parameters');
                $result=array('results'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj=new product($db['jzeva']);
            $result=$obj->getsuggestions($params);
            $res=$result;
            break;            
       */     
 
//---------------------------Offer-----------------------------------------

//  localhost/jzeva/apis/index.php?action=addOffer&offername=diwalidhamaka&des=a well reknown festive offer we are celebrating since ages&amdp=1.1&valid=1 year&vdesc=1123fwhf232
        case 'addOffer':
            include APICLUDE.'class.offer.php';
            $offername = (!empty($params['offername'])) ? trim(urldecode($params['offername'])) : '';
            $des  = (!empty($params['des'])) ? trim(urldecode($params['des'])) : '';
            $amdp  = (!empty($params['amdp'])) ? trim(urldecode($params['amdp'])) : '';
            $valid=(!empty($params['valid'])) ?  trim(urldecode($params['valid'])) : '';
            $voucherdesc  =   (!empty($params['vdesc'])) ? trim(urldecode($params['vdesc'])) : '';
            if(empty($offername) && empty($des) && empty($amdp) && empty($valid) && empty($voucherdesc))
            {
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Invalid Parameters');
                $result = array('results' => $res, 'error' => $err);
                $res=$result;
                break;
            }
            $obj    = new offer($db['jzeva']);
            $result = $obj->addOffer($params);
            $res = $result;
            break;

//  localhost/jzeva/apis/index.php?action=viewOffer&offid=1
        case 'viewOffer':
            include APICLUDE.'class.offer.php';
            $offid  = (!empty($params['offid'])) ?  trim($params['offid']) : '';
            
            if(empty($offid))
            {
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Please mention the offer id');
                $result = array('results' => $arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj    = new offer($db['jzeva']);
            $result = $obj->viewOffer($params);
            $res = $result;
            break;

//  localhost/jzeva/apis/index.php?action=actOffer&offid=2            
        case 'actOffer':
            include APICLUDE.'class.offer.php';
            $offid  = (!empty($params['offid'])) ?  trim($params['offid']) : '';               
            if(empty($offid))
            {
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Please mention the offer id');
                $result = array('results' => $arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj    = new offer($db['jzeva']);
            $result = $obj->actOffer($params);
            $res = $result;
            break;
            
//  localhost/jzeva/apis/index.php?action=deactOffer&offid=2
        case 'deactOffer':
            include APICLUDE.'class.offer.php';
            $offid  = (!empty($params['offid'])) ?  trim($params['offid']) : '';               
            if(empty($offid))
            {
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Please mention the offer id');
                $result = array('results' => $arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj    = new offer($db['jzeva']);
            $result = $obj->deactOffer($params);
            $res = $result;
            break;

//  localhost/jzeva/apis/index.php?action=offerUserBind&offerid=1&uid=6&dispflag=1
        case 'offerUserBind':
            include APICLUDE.'class.offer.php';
            $offid  = (!empty($params['offid'])) ?  trim($params['offid']) : '';               
            $uid  = (!empty($params['uid'])) ?  trim($params['uid']) : '';
            $dflag  = (!empty($params['dispflag'])) ?  trim($params['dispflag']) : '';
            if(empty($offid) && empty($uid) && empty($dflag))
            {
                $arr = "Some parameters are missing";
                $err = array('Code' => 1, 'Msg' => 'Invalid parameters');
                $result = array('results' => $arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj    = new offer($db['jzeva']);
            $result = $obj->offerUserBind($params);
            $res = $result;
            break;

//  localhost/jzeva/apis/index.php?action=offerUserUnBind&offid=2&uid=6
        case 'offerUserUnBind':
            include APICLUDE.'class.offer.php';
            $offid  = (!empty($params['offid'])) ?  trim($params['offid']) : '';               
            $uid  = (!empty($params['uid'])) ?  trim($params['uid']) : '';
            if(empty($offid) && empty($uid))
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
            
//----------------------cart-----------------------------------------------
     /*        
//  localhost/jzeva/apis/index.php?action=getcartId&ip=192.168.2.21&umob=9975887206          
        case 'getcartId':
            include APICLUDE.'class.cart.php';
            $ip=(!empty($params['ip'])) ? trim(urldecode($params['ip'])) : '';
            $umob=(!empty($params['umob'])) ? trim($params['umob']) : '';
            if(empty($ip) && empty($umob))
            {
                $arr=array();
                $err=array('Code'=>1,'Msg'=>'Invalid Parameters');
                $result=array('results'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj=new cart($db['jzeva']);
            $result=$obj->getCartId($params);
            $res=$result;
            break;
          */ 
            
//  localhost/jzeva/apis/index.php?action=addToCart&dt={%22result%22:%20{%22ip%22:%20%22192.168.2.21%22,%22logmob%22:%209975887206,%22vmob%22:%207309290529,%22qty%22:%201,%22pid%22:%209},%22error%22:%20{%22errCode%22:%200}}        
        case 'addToCart':
            include APICLUDE.'class.cart.php';
            $dt  = (!empty($params['dt']))?  trim($params['dt']) : '';
            if(empty($dt))
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
            
//  localhost/jzeva/apis/index.php?action=editCart&cart_id=1&quantity=10&product_id=7            
        case 'editCart': 
            include APICLUDE.'class.cart.php';
            $cartid  = (!empty($params['cart_id']))?  trim($params['cart_id']) : '';
            $qty  = (!empty($params['quantity'])) ? trim($params['quantity']) : '';
            $pid  = (!empty($params['product_id'])) ? trim($params['product_id']) : '';    
            if(empty($qty) && empty($pid) && empty($cartid))
            {
            $arr = array();
            $err = array('Code' => 1, 'Msg' => 'Invalid Parameters');
            $result = array('results' => $res, 'error' => $err);
            $res=$result;
            break;
            }
            $obj=new cart($db['jzeva']);
            $result=$obj->editCart($params);
            $res=$result;
            break;

//  localhost/jzeva/apis/index.php?action=readCart&ip=192.168.2.21&logmob=9975887206            
        case 'readCart':
            include APICLUDE.'class.cart.php';
            $uid=(!empty($params['uid'])) ? trim(urldecode($params['uid'])) : '';
            if(empty($uid))
            {
            $res = array();
            $err = array('Code' => 1, 'Msg' => 'Invalid Parameter');
            $result = array('results' =>$res,'error'=>$err);
            $res= $result;
            break;
            }
            $obj    = new cart($db['jzeva']);
            $result = $obj->readCart($params);
            $res= $result;
            break;

//  localhost/jzeva/apis/index.php?action=delPrd&cartid=1&pid=7&vmob=7878787878
        case 'delPrd':
            include APICLUDE.'class.cart.php';
            $pid  = (!empty($params['pid'])) ? trim($params['pid']) : '';
            $cartid  =(!empty($params['cartid'])) ? trim($params['cartid']) : '';
            $vid  =(!empty($params['vid'])) ? trim($params['vid']) : '';
            if(empty($pid) && empty($cartid) && empty($vid))
            {
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Invalid Parameters');
                $result = array('results' => $res, 'error' => $err);
                $res=$result;
                break;
            }
            $obj=new cart($db['jzeva']);
            $result=$obj->delPrd($params);
            $res= $result;
            break;
/*
//  localhost/jzeva/apis/index.php?action=cartClr&logmobile=9975887206&product_id=9&vendormob=7309290529            
        case 'cartClr':
            include APICLUDE.'class.cart.php';
            $pid =(!empty($params['product_id'])) ? trim($params['product_id']) : '';
            $logmobile =(!empty($params['logmobile'])) ?  trim($params['logmobile']) : '';
            $vendormob=(!empty($params['vendormob'])) ?  trim($params['vendormob']) : '';
            if(empty($pid) && empty($logmobile) && empty($vendormob))
            {
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Invalid Parameters');
                $result = array('results'=>$res,'error'=>$err);
                $res=$result;
                break;
            }
            $obj= new cart($db['jzeva']);
            $result = $obj->cartClr($params);
            $res= $result;
            break;
 * */
 
            
//----------------------Attribute------------------------------------------

 // localhost/jzeva/apis/index.php?action=get_attrList&page=1&limit=1            
        case 'get_attrList':
            include APICLUDE.'class.attribute.php';
            $obj = new attribute($db['jzeva']);
            $result=$obj->get_attrList($params);
            $res=$result;
            break;
        
//  localhost/jzeva/apis/index.php?action=set_attributes_details&name=flurocent&dname=luminous&unit=10&flag=1&upos=2&vals={10,20,30,40,50,60,70}&range=10        
        case 'set_attributes_details':
            include APICLUDE.'class.attribute.php';
            $name=(!empty($params['name'])) ? trim($params['name']):'';
            $dname=(!empty($params['dname'])) ? trim($params['dname']):'';
            $unit=(!empty($params['unit'])) ? trim($params['unit']):'';
            $flag=(!empty($params['flag'])) ? trim($params['flag']):'';                
            $upos=(!empty($params['upos'])) ? trim(urldecode($params['upos'])):'';
            $vals=(!empty($params['vals'])) ? trim($params['vals']) : '';
            
            if(empty($name)  &&  empty($dname)  &&  empty($unit)  &&  empty($flag)  &&  empty($upos)  &&  empty($vals))
            {
            $arr=array();
            $err=array('code'=> 1,'Msg'=> 'Invalid parameters');
            $result=array('results'=> $arr,'error'=>$err);
            $res=$result;
            break;
            }
            $obj = new attribute($db['jzeva']);
            $result=$obj->set_attributes_details($params);
            $res=$result;
            break; 

//  localhost/jzeva/apis/index.php?action=fetch_attributes_details&attribid=1        
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

//  localhost/jzeva/apis/index.php?action=set_category_mapping&aid=43&dflag=1&dpos=999&fil_flag=1&fil_pos=999&aflag=1&catid=3
        case 'set_category_mapping':
            include APICLUDE.'class.attribute.php';
            $aid =(!empty($params['aid'])) ? trim($params['aid']):'';
            $dflag =(!empty($params['dflag'])) ? trim($params['dflag']):'';
            $dpos =(!empty($params['dpos'])) ? trim($params['dpos']):'';
            $fil_flag =(!empty($params['fil_flag'])) ? trim($params['fil_flag']):'';
            $fil_pos =(!empty($params['fil_pos'])) ? trim($params['fil_pos']):'';
            $aflag =(!empty($params['aflag'])) ? trim($params['aflag']):'';
            $catid =(!empty($params['catid'])) ? trim($params['catid']):'';
            if(empty($aid)  &&  empty($dflag)  &&  empty($dpos)  &&  empty($fil_flag)  &&  empty($fil_pos)  &&  empty($aflag)  &&  empty($catid))
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
            
//  localhost/jzeva/apis/index.php?action=fetch_category_mapping&catid=3            
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

//  localhost/jzeva/apis/index.php?action=unset_category_mapping&catid=3&aid=12            
        case 'unset_category_mapping':
            include APICLUDE.'class.attribute.php';
            $id   =(!empty($params['aid'])) ? trim($params['aid']): "";
            $catid=(!empty($params['catid'])) ? trim($params['catid']): "";
            if(empty($id) &&  empty($catid))
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
//--------------------Stylist Appointment----------------------------------

//  localhost/jzeva/apis/index.php?action=makeAppoint&dt={%22result%22:%20{%22cname%22:%20%22Insane%20Rider%22,%22cemail%22:%20%22rider.insane@motorbikes.com%22,%22cmob%22:%207309290529,%22fulladd%22:%20%22qdqd%20wedwdw%20wcec%20wwwedd%20wdewd%22,%22ptype%22:%20%22earring%22,%22cat%22:%20%22diamond,gold%22,%22budget%22:%20%2210000~6000000%22},%22error%22:%20{%22errCode%22:%200}}
        case 'makeAppoint':
            include APICLUDE.'class.appoint.php';
            $dt=(!empty($params['dt'])) ? trim(urldecode($params['dt'])) : '';
            if(empty($dt))
            {   
                $arr = "Some Parameters are missing";
                $err = array('Code' => 1, 'Msg' => 'Some Parameters are missing');
                $result = array('results'=>$arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new appoint($db['jzeva']);
            $result=$obj->makeAppoint($params);
            $res=$result;
            break;    

//  localhost/jzeva/apis/index.php?action=makeAppoint            
        case 'viewAppoint':
            include APICLUDE.'class.appoint.php';
            $obj= new appoint($db['jzeva']);
            $result=$obj->viewAppoint();
            $res=$result;
            break;
            
//--------------------Custom Design----------------------------------------

//  localhost/jzeva/apis/index.php?action=showCDes            
        case 'showCDes':
            include APICLUDE.'class.custDes.php';
            $obj= new custDes($db['jzeva']);
            $result=$obj->showCDes();
            $res=$result;
            break;

//  localhost/jzeva/apis/index.php?action=addCDes&dt={%22result%22:%20{%22cname%22:%20%22Insane%20Rider%22,%22cemail%22:%20%22rider.insane@motorbikes.com%22,%22cmob%22:%207309290529,%22title%22:%20%22qdqd%20wedwdw%20wcec%20wwwedd%20wdewd%22,%22desimg%22:%20%22earring.png%22},%22error%22:%20{%22errCode%22:%200}}
        case 'addCDes':
            include APICLUDE.'class.custDes.php';
            $dt=(!empty($params['dt'])) ? trim(urldecode($params['dt'])) : '';
            if(empty($dt))
            {   
                $arr = "Some Parameters are missing";
                $err = array('Code' => 1, 'Msg' => 'Some Parameters are missing');
                $result = array('results'=>$arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new custDes($db['jzeva']);
            $result=$obj->addCDes($params);
            $res=$result;
            break;

//----------------------Customer Speaks-------------------------------------
            
//  localhost/jzeva/apis/index.php?action=addCDes&dt=            
        case 'addCom':
            include APICLUDE.'class.speaks.php';
            $dt=(!empty($params['dt'])) ? trim(urldecode($params['dt'])) : '';
            if(empty($dt))
            {   
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Some Parameters are missing');
                $result = array('results'=>$arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new speaks($db['jzeva']);
            $result=$obj->addCom($params);
            $res=$result;
            break;

//  localhost/jzeva/apis/index.php?action=viewCom            
        case 'viewCom':
            include APICLUDE.'class.speak.php';
            $obj= new speak($db['jzeva']);
            $result=$obj->viewCom();
            $res=$result;
            break;            
        
//-----------------------Subscribe and Newsletter---------------------------

//  localhost/jzeva/apis/index.php?action=subscribe&uid=6        
        case 'subscribe':
            include APICLUDE.'class.newsletter.php';
            $uid = (!empty($params['uid'])) ? trim($params['uid']):'';
            if(empty($uid))
            {
                $arr="Invalid Parameter";
                $err=array('Code'=>1,'Msg'=>'Parameter missing');
                $result=array('results'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj=new newsletter($db['jzeva']);
            $result=$obj->subscribe($params);
            $res=$result;
            break;
            
//  localhost/jzeva/apis/index.php?action=viewSubscribers&page=1&limit=1            
        case 'viewSubscribers':
            include APICLUDE.'class.newsletter.php';
            $page=(!empty($params['page'])) ? trim(urldecode($params['page'])) : '';
            $limit=(!empty($params['limit'])) ? trim(urldecode($params['limit'])) : '';
            if(empty($limit) && empty($page))
            {   
                $arr = "Some Parameters are missing";
                $err = array('Code' => 1, 'Msg' => 'Some Parameters are missing');
                $result = array('results'=>$arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new newsletter($db['jzeva']);
            $result=$obj->viewSubscribers($params);
            $res=$result;
            break;

//  localhost/jzeva/apis/index.php?action=addNewsletter&dt=            
        case 'addNewsletter':
            include APICLUDE.'class.newsletter.php';
            $dt=(!empty($params['dt'])) ? trim(urldecode($params['dt'])) : '';
            if(empty($dt))
            {   
                $arr = "Some Parameters are missing";
                $err = array('Code' => 1, 'Msg' => 'Some Parameters are missing');
                $result = array('results'=>$arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new newsletter($db['jzeva']);
            $result=$obj->addNewsletter($params);
            $res=$result;
            break;

//  localhost/jzeva/apis/index.php?action=unsubscribe&uid=6
        case 'unsubscribe':
            include APICLUDE.'class.newsletter.php';
            $uid = (!empty($params['uid'])) ? trim($params['uid']):'';
            if(empty($uid))
            {
                $arr="Invalid Parameter";
                $err=array('Code'=>1,'Msg'=>'Parameter missing');
                $result=array('results'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj=new newsletter($db['jzeva']);
            $result=$obj->unSubscribe($params);
            $res=$result;
            break;
                
//-------------------------Helpdesk--------------------------------------

//  localhost/jzeva/apis/index.php?action=askhelp&dt={%22result%22:%20{%22uid%22:%206,%22cname%22:%20%22Insane%20Rider%22,%22cemail%22:%20%22rider.insane@motorbikes.com%22,%22logmobile%22:%207309290529,%22cquery%22:%20%22qdqd%20wedwdw%20wcec%20wwwedd%20wdewd%22},%22error%22:%20{%22errCode%22:%200}}            
        case 'askhelp':
            include APICLUDE.'class.helpdesk.php';
            $dt=(!empty($params['dt'])) ? trim(urldecode($params['dt'])) : '';
            if(empty($dt))
            {   
                $arr = array();
                $err = array('Code' => 1, 'Msg' => 'Some Parameters are missing');
                $result = array('results'=>$arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new helpdesk($db['jzeva']);
            $result=$obj->askhelp($params);
            $res=$result;
            break;

//  localhost/jzeva/apis/index.php?action=viewhelp&page=1&limit=1          
        case 'viewhelp':
            include APICLUDE.'class.helpdesk.php';
            $obj= new helpdesk($db['jzeva']);
            $result=$obj->viewhelp($params);
            $res=$result;
            break;
//----------------------Address Id and details------------------------------------

//  localhost/jzeva/apis/index.php?action=fillAdd&dt={%22result%22:%20{%22uid%22:%2010105,%22addtitle%22:%20%22home%22,%22add1%22:%201,%22add2%22:%20%22singharun@gmail.com%22,%22fulladd%22:%20%221990-10-08%22,%22area%22:%20%229696969696%22,%22city%22:%20223232,%22state%22:%20%22Delhi%22,%22country%22:%20%22india%22,%22pcode%22:%20221212},%22error%22:%20{%22errCode%22:%200}}
        case 'fillAdd':
            include APICLUDE.'class.address.php';
            $dt=(!empty($params['dt'])) ? trim(urldecode($params['dt'])) : '';
            if(empty($dt))
            {   
                $arr = "Some Parameters are missing";
                $err = array('Code' => 1, 'Msg' => 'Some Parameters are missing');
                $result = array('results'=>$arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new address($db['jzeva']);
            $result=$obj->fillAdd($params);
            $res=$result;
            break;

//  localhost/jzeva/apis/index.php?action=getAdd&addid=1            
        case 'getAdd':
            include APICLUDE.'class.address.php';
            $addid=(!empty($params['addid'])) ? trim(urldecode($params['addid'])) : '';
            if(empty($addid))
            {   
                $arr = "Some Parameters are missing";
                $err = array('Code' => 1, 'Msg' => 'Some Parameters are missing');
                $result = array('results'=>$arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new address($db['jzeva']);
            $result=$obj->getAdd($params);
            $res=$result;
            break;

//  localhost/jzeva/apis/index.php?action=getAddByUser&uid=10105            
            
        case 'getAddByUser':
            include APICLUDE.'class.address.php';
            $uid=(!empty($params['uid'])) ? trim(urldecode($params['uid'])) : '';
            if(empty($uid))
            {   
                $arr = "Parameter is missing";
                $err = array('Code' => 1, 'Msg' => 'Inapproprate data is sent');
                $result = array('results'=>$arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new address($db['jzeva']);
            $result=$obj->getAddByUser($params);
            $res=$result;
            break; 
//  localhost/jzeva/apis/index.php?action=getUserAddID&uid=10105       
        case 'getUserAddID':
            include APICLUDE.'class.address.php';
            $uid=(!empty($params['uid'])) ? trim(urldecode($params['uid'])) : '';
            if(empty($uid))
            {   
                $arr = "Parameter is missing";
                $err = array('Code' => 1, 'Msg' => 'Inapproprate data is sent');
                $result = array('results'=>$arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new address($db['jzeva']);
            $result=$obj->getUserAddID($params);
            $res=$result;
            break;
            
//---------------------------filter----------------------------------------

//  localhost/jzeva/apis/index.php?action=get_filters&category_id=3&page=1&limit=1            
        case 'get_filters':
            include APICLUDE.'class.filter.php';
            $page=(!empty($params['page'])) ? trim(urldecode($params['page'])) : '';
            $limit=(!empty($params['limit'])) ? trim(urldecode($params['limit'])) : '';
            $category_id=(!empty($params['category_id'])) ? trim($params['category_id']):'';
            if(empty($category_id) && empty($limit) && empty($page))
            {   
                $arr = "Parameter is missing";
                $err = array('Code' => 1, 'Msg' => 'Invalid Parameter');
                $result = array('results'=>$arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new filter($db['jzeva']);
            $result=$obj->get_filters($params);
            $res=$result;
            break;

/*  HAve to be changed as per the requirement        */            
//  localhost/jzeva/apis/index.php?action=refine&catid=1&page=1&limit=1&dt={%22result%22:%20{%22filter_flg%22:%201,%22pfrm%22:%200,%22pto%22:%20120000000,%22catid%22:%204,%22brname%22:%20%22orra%22,%22type%22:%20%22jwellery,gold%22,%22metal%22:%20%22gold%22}}            
        case 'refine': 
            include APICLUDE.'class.filter.php';
            $page=(!empty($params['page'])) ? trim(urldecode($params['page'])) : '';
            $limit=(!empty($params['limit'])) ? trim(urldecode($params['limit'])) : '';
            $dt=(!empty($params['dt'])) ? trim($params['dt']):'';
            $catid=(!empty($params['catid'])) ? trim($params['catid']):'';
            if(empty($dt) && empty($limit) && empty($page) && empty($catid))
            {   
                $arr = "Parameter is missing";
                $err = array('Code' => 1, 'Msg' => 'Invalid Parameter');
                $result = array('results'=>$arr, 'error' => $err);
                $res=$result;
                break;
            }
            $obj= new filter($db['jzeva']);
            $result=$obj->refine($params);
            $res=$result;
            break;

//-------------------------Lineage----------------------------------------

//  localhost/jzeva/apis/index.php?action=set_lineage&dt={%22result%22:%20{%22p_catid%22:%200,%22catname%22:%200,%22lvl%22:%209975887206,%22lineage%22:%20%22xyz,abcd,a,b,c,d%22,%22pid%22:%201}}
        case 'set_lineage':
            include APICLUDE.'class.categories.php';
            $dt=(!empty($params['dt']))? trim($params['dt']):'';
            if(empty($dt))
            {
                $arr="Parameters missing";
                $err=array('Code'=>1,'Msg'=>'Invalid Parameters');
                $result=array('results'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj=new categories($db['jzeva']);
            $result=$obj->set_lineage($params);
            $res=$result;
            break;

//  localhost/jzeva/apis/index.php?action=upd_prd_lineage&dt={%22result%22:%20{%22pcatid%22:%2012312,%22catname%22:%22bullion%22,%22lvl%22:%209975887206,%22lineage%22:%20%22xyz,abcd,a,b,c,d%22,%22pflag%22:1,%22catid%22:0,%22pid%22:%201}}
        case 'upd_prd_lineage':
            include APICLUDE.'class.categories.php';
            $dt=(!empty($params['dt']))? trim($params['dt']):'';
            if(empty($dt))
            {
                $arr="Parameters missing";
                $err=array('Code'=>1,'Msg'=>'Invalid Parameters');
                $result=array('results'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj=new categories($db['jzeva']);
            $result=$obj->upd_prd_lineage($params);
            $res=$result;
            break;
            
//------------------------Wishlist-------------------------------------------

//  localhost/jzeva/apis/index.php?action=addtowsh&page=1&limit=1&dt={"result": {"uid": 0,"pid": 0,"vid": 9975887206,"wf": 12}}            
        case 'addtowsh':
            include APICLUDE.'class.wishlist.php';
            $dt=(!empty($params['dt']))? trim($params['dt']):'';
            if(empty($dt))
            {
                $arr = array();
                $err=array('Code'=>1,'Msg'=>'Invalid Parameters');
                $result=array('results'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj=new wishlist($db['jzeva']);
            $result=$obj->addtowsh($params);
            $res=$result;
            break;

//  localhost/jzeva/apis/index.php?action=viewsh&page=1&limit=1&uid=7              
        case 'viewsh':
            include APICLUDE.'class.wishlist.php';
            $dt=(!empty($params['dt']))? trim($params['dt']):'';
            if(empty($dt))
            {
                $arr = array();
                $err=array('Code'=>1,'Msg'=>'Invalid Parameters');
                $result=array('results'=>$arr,'error'=>$err);
                $res=$result;
                break;
            }
            $obj=new wishlist($db['jzeva']);
            $result=$obj->viewsh($params);
            $res=$result;
            break;    
                
     
//---------------------------------------------------------------------------
        
        default:
        break;

//---------------------------------------------------------------------------
}    
echo json_encode($res);
exit;
?>