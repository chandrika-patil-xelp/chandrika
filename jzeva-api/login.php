<?php
    set_time_limit(0);
    error_reporting(1);
    
    include 'config.php';
    include INCLUDER . 'dbclass.php';

    $params = array_merge($_GET, $_POST);

    if ($params['trace']) 
    {
        define("DEBUG_MODE", "1");
       // header('Content-type: application/json');
    }
    else
    {
        define("DEBUG_MODE", "0");
        header('Content-type: application/json');
    }
    
    $obj = new dbclass($db['jzeva']);
  

    if (DEBUG_MODE) 
    {
        echo "Request Parameters: ";        
        print_r("<pre>");
        print_r($params);
       
        echo "</pre>";
        echo "<br/><br/>";
    }

    $action = (!empty($params['action']) && !stristr($params['action'], 'null') && !stristr($params['action'], 'undefined')) ? trim($params['action']) : '';

    if (empty($action)) 
    {
        $res = array();
        $err = array('errCode' => 1, 'errMsg' => 'Please mention action to be performed');
        $result = array('results' => $res, 'error' => $err);
        echo json_encode($result);
        exit;
    }
    
    if($action=='login')
    {
        $username  = (!empty($params['username']) && !stristr($params['username'],'null')  && !stristr($params['username'],'undefined')) ?  trim(urldecode($params['username'])) : '';
        $password  =   (!empty($params['password']) && !stristr($params['password'], 'null') && !stristr($params['password'], 'undefined')) ? trim($params['password']) : '';
        $status  =   (!empty($params['status']) && !stristr($params['status'], 'null') && !stristr($params['status'], 'undefined')) ? trim($params['status']) : 0;
        if(empty($username))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention the username');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($password)){
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention password');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;            
        }
        if(empty($status))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention status');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
    }
 
    if($action=='saveCustomer')
    {   
        $customerid  = (!empty($params['customer_id']) && !stristr($params['customer_id'],'null')  && !stristr($params['customer_id'],'undefined')) ?  trim(urldecode($params['customer_id'])) : '';
        $title  = (!empty($params['gender']) && !stristr($params['gender'],'null')  && !stristr($params['gender'],'undefined')) ?  trim(urldecode($params['gender'])) : '';
        $custname  = (!empty($params['cust_name']) && !stristr($params['cust_name'],'null')  && !stristr($params['cust_name'],'undefined')) ?  trim(urldecode($params['cust_name'])) : '';
        $email  =   (!empty($params['email']) && !stristr($params['email'],'null')  && !stristr($params['email'],'undefined')) ?  trim($params['email']) : '0';
        $phone  = (!empty($params['phone']) && !stristr($params['phone'],'null')  && !stristr($params['phone'],'undefined')) ?  trim(urldecode($params['phone'])) : '';
        $address  = (!empty($params['address']) && !stristr($params['address'],'null')  && !stristr($params['address'],'undefined')) ?  trim(urldecode($params['address'])) : '';
        $cityid  = (!empty($params['city_id']) && !stristr($params['city_id'],'null')  && !stristr($params['city_id'],'undefined')) ?  trim(urldecode($params['city_id'])) : '';
        $stateid  = (!empty($params['state_id']) && !stristr($params['state_id'],'null')  && !stristr($params['state_id'],'undefined')) ?  trim(urldecode($params['state_id'])) : '';
        $countryid  = (!empty($params['country_id']) && !stristr($params['country_id'],'null')  && !stristr($params['country_id'],'undefined')) ?  trim(urldecode($params['country_id'])) : 'India';
        $pincode  = (!empty($params['pincode']) && !stristr($params['pincode'],'null')  && !stristr($params['pincode'],'undefined')) ?  trim(urldecode($params['pincode'])) : '';
        $idproof  = (!empty($params['idproof']) && !stristr($params['idproof'],'null')  && !stristr($params['idproof'],'undefined')) ?  trim(urldecode($params['idproof'])) : '';
        $idtype  = (!empty($params['idtype']) && !stristr($params['idtype'],'null')  && !stristr($params['idtype'],'undefined')) ?  trim(urldecode($params['idtype'])) : 0;
        $usertype  =   (!empty($params['usertype']) && !stristr($params['usertype'],'null')  && !stristr($params['usertype'],'undefined')) ?  trim($params['usertype']) : 0;
        
        if(empty($usertype))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'No user_type mentioned');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        
        if(empty($customerid))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'No customer id generated');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($title))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention Gender');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        
        if(empty($custname))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention custname');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($address))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention address');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($cityid))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention city');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($stateid))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention state');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($countryid))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention country');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        
        if(empty($pincode))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention pincode');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($idtype))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention identity proof type');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($idproof))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention identity proof number');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
         if(empty($email))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention contact email address');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
        }
        if(empty($phone))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please login');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
        }
        
    }
    
    if($action=='saveVendor')
    {   
        $vendorid  = (!empty($params['vendor_id']) && !stristr($params['vendor_id'],'null')  && !stristr($params['vendor_id'],'undefined')) ?  trim(urldecode($params['vendor_id'])) : '';
        $title  = (!empty($params['gender']) && !stristr($params['gender'],'null')  && !stristr($params['gender'],'undefined')) ?  trim(urldecode($params['gender'])) : '';
        $usertype  = (!empty($params['vendor_type']) && !stristr($params['vendor_type'],'null')  && !stristr($params['vendor_type'],'undefined')) ?  trim(urldecode($params['vendor_type'])) : 0;
        $vendorname  = (!empty($params['vendor_name']) && !stristr($params['vendor_name'],'null')  && !stristr($params['vendor_name'],'undefined')) ?  trim(urldecode($params['vendor_name'])) : '';
        $email  =   (!empty($params['email']) && !stristr($params['email'],'null')  && !stristr($params['email'],'undefined')) ?  trim($params['email']) : '0';
        $phone  = (!empty($params['vendor_phone']) && !stristr($params['vendor_phone'],'null')  && !stristr($params['vendor_phone'],'undefined')) ?  trim(urldecode($params['vendor_phone'])) : '';
        $address  = (!empty($params['address']) && !stristr($params['address'],'null')  && !stristr($params['address'],'undefined')) ?  trim(urldecode($params['address'])) : '';      
        $dob  = (!empty($params['dob']) && !stristr($params['dob'],'null')  && !stristr($params['dob'],'undefined')) ?  trim(urldecode($params['dob'])) : '';
        $cityid  = (!empty($params['city_id']) && !stristr($params['city_id'],'null')  && !stristr($params['city_id'],'undefined')) ?  trim(urldecode($params['city_id'])) : '';
        $stateid  = (!empty($params['state_id']) && !stristr($params['state_id'],'null')  && !stristr($params['state_id'],'undefined')) ?  trim(urldecode($params['state_id'])) : '';
        $countryid  = (!empty($params['country_id']) && !stristr($params['country_id'],'null')  && !stristr($params['country_id'],'undefined')) ?  trim(urldecode($params['country_id'])) : 'India';
        $pincode  = (!empty($params['pincode']) && !stristr($params['pincode'],'null')  && !stristr($params['pincode'],'undefined')) ?  trim(urldecode($params['pincode'])) : '';
        $vlicense  = (!empty($params['vendor_license']) && !stristr($params['vendor_license'],'null')  && !stristr($params['vendor_license'],'undefined')) ?  trim(urldecode($params['pincode'])) : '';
        $licissuedate = (!empty($params['lid']) && !stristr($params['lid'],'null')  && !stristr($params['lid'],'undefined')) ?  trim(urldecode($params['lid'])) : '';
        $licexpirydate = (!empty($params['eid']) && !stristr($params['eid'],'null')  && !stristr($params['eid'],'undefined')) ?  trim(urldecode($params['eid'])) : '';
        $dealin = (!empty($params['dealin']) && !stristr($params['dealin'],'null')  && !stristr($params['dealin'],'undefined')) ?  trim(urldecode($params['dealin'])) : '';
        $idproof  = (!empty($params['idproof']) && !stristr($params['idproof'],'null')  && !stristr($params['idproof'],'undefined')) ?  trim(urldecode($params['idproof'])) : '';
        $pstatus  = (!empty($params['pstatus']) && !stristr($params['pstatus'],'null')  && !stristr($params['pstatus'],'undefined')) ?  trim(urldecode($params['pstatus'])) : '';
        $diamond_lic  = (!empty($params['diamond_lic']) && !stristr($params['diamond_lic'],'null')  && !stristr($params['diamond_lic'],'undefined')) ?  trim(urldecode($params['diamond_lic'])) : 0;
        
        if(empty($vendorid))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'No vendor id generated');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($title))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention Gender');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($vendorname))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention vendor name');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($address))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention address');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($dob))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention your date of birth');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($cityid))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention city');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($stateid))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention state');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($countryid))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention country');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($pincode))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention pincode');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($vlicense))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention vendors license number');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($licissuedate))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention issue date of license');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($licexpirydate))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention expiry date of license');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($dealin))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention vendor deals in');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
         if(empty($email))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention contact email address');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
        }
        if(empty($pstatus))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention profile status');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($diamond_lic))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention diamond license number');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($idproof))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention identity proof number');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($mobile))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please login');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
        }
        if(empty($address))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention address');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
    }

    if($action == 'getUserInfo')
    {
        $username  = (!empty($params['username']) && !stristr($params['username'],'null')  && !stristr($params['username'],'undefined')) ?  trim(urldecode($params['username'])) : '';
        $usertype  =   (!empty($params['usertype']) && !stristr($params['usertype'],'null')  && !stristr($params['usertype'],'undefined')) ?  trim($params['usertype']) : 0;
        if(empty($username))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please enter username');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
        }
    }
    
    if($action=='updatePass')
    {
        $username  = (!empty($params['username']) && !stristr($params['username'],'null')  && !stristr($params['username'],'undefined')) ?  trim(urldecode($params['username'])) : '';
        $newpass = (!empty($params['pass']) && !stristr($params['pass'], 'null') && !stristr($params['pass'], 'undefined')) ? trim(urldecode($params['pass'])) : '';
        $status = (!empty($params['pstatus']) && !stristr($params['pstatus'], 'null') && !stristr($params['pstatus'], 'undefined')) ? trim(urldecode($params['pstatus'])) : 0;
        
        if(empty($username))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention valid username');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($status))
        {
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention profile status {boolean for active | inactive}');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
        if(empty($newpass)){
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Please mention password');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            
        }
    }

    switch($action)
    {
        //  localhost/jzeva-api/login.php?&action=login&username=chinmay123&password=bajpai&status=1&trace=1
        case 'login':
            
            $err = array('errCode' => 2, 'errMsg' => 'Error in login');
            $results = array(); 
            $sql="SELECT * FROM users WHERE username='".$username."' AND password='".$password."' AND status=1";
            $res=$obj->firequery($sql);

            if (DEBUG_MODE) 
            {

                echo 'Select Query: ';
                echo $sql;
                print_r("\n");
                echo 'Select Query Resource: ';
                echo $res;
                print_r("\n");
                echo 'MySql Error Number: ' . mysql_errno() . ' AND MySql Error Message: ' . mysql_error();
            }
            
            if($res)
            {
                $row = $obj->bringdata($res);

                if(DEBUG_MODE)
                {
                    echo '<br/>';
                    echo 'Results: ';
                    echo '<br/>';
                    echo '<pre>';
                    print_r($row);
                    echo '</pre>';
                }

                if($row && !empty($row['username']) && !empty($row['password']) && !empty($row['status']))
                {
                           $results['user_id'] = $row['user_id'];
                            $results['username'] = $row['username'];
                            $results['password'] = $row['password'];
                            $results['user_type'] = $row['user_type'];
                            $results['facility'] = $row['facility'];
                            $results['email'] = $row['email'];
                            $results['status'] = $row['status'];
                            
                }
                $err = array('errCode' => 0, 'errMsg' => 'Details fetched successfully');
            }
                $result = array('results' => $results, 'error' => $err);             
                break;     
        
        case 'saveCustomer':            
            if($usertype==2)
            {
            
            $err = array('errCode' => 2, 'errMsg' => 'Error in login');
            $results = array();
            $sql="INSERT INTO customer(customer_id,user_type,gender,cust_name,email,phone,address,dob,username,password,country_id,state_id,city_id,pincode,id_proof,id_type,cdt)VALUES($customerid,$usertype,$title,$custname,$email,$phone,$address,$dob,$username,MD5('$password'),$country_id,$state_id,$cityid,,$pincode,$id_proof,$id_type,now())";
            $res=$obj->firequery($sql);
            if(DEBUG_MODE)
            {
                echo '<br/>';
                echo 'INSERT Query: ';
                echo '<br/>';
                echo $sql;
                echo '<br/>';
                echo 'INSERT Query Resource: ';
                echo $res;
                echo '<br/>';
                echo 'MySql Error Number: ' . mysql_errno() . ' AND MySql Error Message: ' . mysql_error();
            }
            if($res)
            {
                $row =$obj->bringdata($res);
                $automatic="INSERT INTO users(user_id,user_type,uname,email,username,password)VALUES($customerid,$usertype,$custname,$email,$username,MD5('$password'))";
                $res2=$obj->firequery($automatic);
                if(DEBUG_MODE)
                {
                    echo '<br/>';
                    echo 'Results: ';
                    echo '<br/>';
                    echo '<pre>';
                    print_r($row);
                    echo '</pre>';
                }
                
                if($row && !empty($row['username']) && !empty($row['usertype']))
                { 
                    $results=$row;
                }
                $err = array('errCode' => 0, 'errMsg' => 'Values shown successfully!');
            
            }
            }
                $result = array('results' => $results, 'error' => $err);
                break;    
        
        case 'saveVendor':
            if($usertype==3)
            {
            $err = array('errCode' => 2, 'errMsg' => 'Error in login');
            $results = array();
            $sql="INSERT INTO vendor(vendor_id,user_type,gender,vendor_name,email,vendor_phone,address,dob,username,password,country_id,state_id,city_id,pincode,vendor_license,lid,eid,dealin,pdt,pstatus,diamond_lic,cdt) VALUES($vendorid,$usertype,$title,$vendorname,$email,$phone,$address,$dob,$username,MD5('$password'),$country_id,$state_id,$cityid,$pincode,$vlicense,$licissuedate,$licissuedate,$licexpirydate,$dealin,$pstatus,$diamond_lic,now())";
            $res=$obj->query($sql);
            if(DEBUG_MODE)
            {
                echo '<br/>';
                echo 'INSERT Query: ';
                echo '<br/>';
                echo $sql;
                echo '<br/>';
                echo 'INSERT Query Resource: ';
                echo $res;
                echo '<br/>';
                echo 'MySql Error Number: ' . mysql_errno() . ' AND MySql Error Message: ' . mysql_error();
            }
            if($res)
            {
                $row =$obj->bringdata($res);
            $automatic="INSERT INTO users(user_id,user_type,uname,email,username,password)VALUES($vendorid,$usertype,$vendorname,$email,$username,MD5('$password'))";
            $res2=$obj->query($automatic);
                if(DEBUG_MODE)
                {
                    echo '<br/>';
                    echo 'INSERT Query: Table status';
                    echo '<br/>';
                    echo $sql2;
                    echo '<br/>';
                    echo 'INSERT Query Resource: ';
                    echo $res2;
                    echo '<br/>';
                    echo 'MySql Error Number: ' . mysql_errno() . ' AND MySql Error Message: ' . mysql_error();
                }
                if($res)
                {
                    $results=$row;
                    
                } $err = array('errCode' => 0, 'errMsg' => 'Vendor sign up successfull!');
            }
              }
                $result = array('results' => $results, 'error' => $err);
                break;  
        
        case 'getUserInfo':
           if($usertype==3)
           {
            $err = array('errCode' => 2, 'errMsg' => 'Error in fetching details from database');
            $results = array();
            $sql = "SELECT * FROM users,vendor WHERE users.user_type='$usertype' and vendor.username='$username' group by users.username desc";
            $res = $obj->firequery($sql);
            if(DEBUG_MODE)
            {
                echo '<br/>';
                echo 'SELECT Query:';
                echo '<br/>';
                echo $sql;
                echo '<br/>';
                echo 'SELECT Query Resource: ';
                echo $res;
                echo '<br/>';
                echo 'MySql Error Number: ' . mysql_errno() . ' AND MySql Error Message: ' . mysql_error();
            }
            
            if($res)
            {
                $row =$obj->bringdata($res);
                if(DEBUG_MODE)
                {
                    echo '<br/>';
                    echo 'Results: ';
                    echo '<br/>';
                    echo '<pre>';
                    print_r($row);
                    echo '</pre>';
                }
                if($row && !empty($row['username']) && !empty($row['usertype']))
                { 
                    $result=$row;
                }
                $err = array('errCode' => 0, 'errMsg' => 'Values shown successfully!');
            }
           }
           if($usertype==2)
           {
            $err = array('errCode' => 2, 'errMsg' => 'Error in fetching details from database');
            $results = array();
            $sql = "SELECT * FROM users,customer WHERE users.user_type='$usertype' and customer.username='$username' group by users.username desc";
            $res = $obj->firequery($sql);
            if(DEBUG_MODE)
            {
                echo '<br/>';
                echo 'SELECT Query:';
                echo '<br/>';
                echo $sql;
                echo '<br/>';
                echo 'SELECT Query Resource: ';
                echo $res;
                echo '<br/>';
                echo 'MySql Error Number: ' . mysql_errno() . ' AND MySql Error Message: ' . mysql_error();
            }
            
            if($res)
            {
                $row =$obj->bringdata($res);
                if(DEBUG_MODE)
               {
                    echo '<br/>';
                    echo 'Results: ';
                    echo '<br/>';
                    echo '<pre>';
                    print_r($row);
                    echo '</pre>';
                }
                if($row && !empty($row['username']) && !empty($row['usertype']))
                {
                    $result = $row;
                }
                $err = array('errCode' => 0, 'errMsg' => 'Values shown successfully!');            
            }
           }
            $result = array('results' => $result, 'error' => $err);
            break;  
            
        case 'updatePass':
            
            if($usertype ==2)
          {
            $err = array('errCode' => 2, 'errMsg' => 'Error in fetching details from database');
            $results = array();
            $sql="UPDATE customer,users SET user.password=MD5(\"$newpass\"),customer.password=MD5(\"$newpass\"),customer.last_updated=now() WHERE users.username = $username";
            $res = $obj->firequery($sql);
            if(DEBUG_MODE)
            {
                echo '<br/>';
                echo 'UPDATE Query:';
                echo '<br/>';
                echo $sql;
                echo '<br/>';
                echo 'UPDATE Query Resource: ';
                echo $res;
                echo '<br/>';
                echo 'MySql Error Number: ' . mysql_errno() . ' AND MySql Error Message: ' . mysql_error();
            }
            
            if($res)
            {
                $err = array('errCode' => 0, 'errMsg' => 'Password updated successfully!');
            }
          }
          if($usertype ==3)
          {
            $err = array('errCode' => 2, 'errMsg' => 'Error in fetching details from database');
            $results = array();
            $sql="UPDATE users,vendor SET users.password=MD5(\"$newpass\"),vendor.password=MD5(\"$newpass\"),vendor.last_updated=now() WHERE users.username = $username;";
            $res = $obj->firequery($sql);
            if(DEBUG_MODE)
            {
                echo '<br/>';
                echo 'UPDATE Query:';
                echo '<br/>';
                echo $sql;
                echo '<br/>';
                echo 'UPDATE Query Resource: ';
                echo $res;
                echo '<br/>';
                echo 'MySql Error Number: ' . mysql_errno() . ' AND MySql Error Message: ' . mysql_error();
            }
            
            if($res)
            {
                $err = array('errCode' => 0, 'errMsg' => 'Password updated successfully!');
            }
          }
          
            $result = array('results' => $results, 'error' => $err);
            break;   
        
        default :    // Alternate conditions.
            $res = array();
            $err = array('errCode' => 1, 'errMsg' => 'Respective action not found');
            $result = array('results' => $res, 'error' => $err);
            echo json_encode($result);
            exit;
            break;
    }
$obj->close();
echo json_encode($result);
exit();
?>