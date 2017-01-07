<?php

include_once APICLUDE . 'common/db.class.php';

class rate extends DB {

    function __construct($db) {
        parent::DB($db);
    }

    
    public function addRates($params)
    {
        $tparams =  json_decode($params[0],1);
        $dres    =  $this->addDmdQualityRates($tparams);
        $gres    =  $this->addGoldRate($tparams);
        $prates  =  $this->addPltnmRates($tparams);
        $result  = array();
        if($dres['error']['err_code'] == '1' || $gres['error']['err_code'] == '1')
        {
            
            $err = array('err_code' => 1, 'err_msg' => 'Error in adding rates');
            
            
        }     
        else
        {
            $err = array('err_code' => 0, 'err_msg' => 'Rates added successfully');
        }   
        $results = array('result' => $result, 'error' => $err);
        return $results;
        
    }
    
    
    public function addGoldRate($params)
    {
        
        $crt24=  floatval($params['grate']);
        $crtR22=  floatval(($crt24*91.6)/100);
        $crtR18=floatval(($crt24*75.1)/100);
        $crtR14=floatval(($crt24*58.3)/100);
        $crtR9=floatval(($crt24*37.5)/100);
        
        $sql="INSERT INTO tbl_metal_purity_master(id,price,createdon,updatedby) VALUES(1,$crtR9,now(),".$params['userid']."),(2,$crtR14,now(),".$params['userid']."),(3,$crtR18,now(),".$params['userid']."),(4,$crtR22,now(),".$params['userid']."),(5,$crt24,now(),".$params['userid'].") "
                . "ON DUPLICATE KEY UPDATE price = VALUES(price), updatedby = VALUES(updatedby )";
        
        $res=$this->query($sql);
        if ($res) {
            $err = array('err_code' => 0, 'err_msg' => 'Data inserted successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
        
    }

    public function addPltnmRates($params)
    {
        $pltRt=  floatval($params['platinumrates']);
        $sql="    INSERT
                  INTO
                        tbl_metal_purity_master
                        (
                            id,
                            price,
                            createdon,
                            updatedby
                        )
                  VALUES
                        (
                            6,
                            $pltRt,
                            now(),
                            ".$params['userid']."
                        )
                  ON DUPLICATE KEY UPDATE
                        price = VALUES(price),
                        updatedby = VALUES(updatedby)";
        $res=$this->query($sql);
        if ($res)
        {
            $err = array('err_code' => 0, 'err_msg' => 'Data inserted successfully');
        }
        else
        {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }


    public function addDmdQualityRates($params)
    {
        $sql = "INSERT INTO tbl_diamond_quality_master (id,price_per_carat,createdon,updatedby) VALUES ";
        
        foreach ($params['diamondrates'] as $key=>$val)
        {
           
            $tmpparams= array('id' =>  intval($key+1),'price_per_carat'=>$val,'updatedby'=>$params['userid']);
                
            
           $sql.="(" . $tmpparams['id'] . "," . $tmpparams['price_per_carat'] . ",now()," . $tmpparams['updatedby'] . "),";
        }

        $sql = trim($sql, ",");
        $sql.=" ON DUPLICATE KEY UPDATE id = VALUES(id), price_per_carat = VALUES(price_per_carat),updatedby=VALUES(updatedby)";

        
        $res=$this->query($sql);
        if ($res) 
        {
            $err = array('err_code' => 0, 'err_msg' => 'Data inserted successfully');
        }
        else
        {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
       
    }
    
    
    public function getGoldRates($params)
    {
        $sql= "SELECT id,dname,dvalue,price FROM tbl_metal_purity_master WHERE active_flag = 1";
        
        $page = ($params['page'] ? $params['page'] : 1);
        $limit = ($params['limit'] ? $params['limit'] : 1000);
        //Making sure that query has limited rows
        if ($limit >1000 ) {
            $limit = 1000;
        }
        if (!empty($page)) {
            $start = ($page * $limit) - $limit;
            $sql.=" LIMIT " . $start . ",$limit";
        }
        
        
        $res = $this->query($sql);
        
        
        if($res)
        {
            while($row = $this->fetchData($res))
            {
                $reslt['id']        =     $row['id'];
                $reslt['name']     =     $row['dname'];
                $reslt['value']    =     $row['dvalue'];
                $reslt['price']     = floatval($row['price']);
                $result[]= $reslt;

            }
            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
        }
        else
        {
            $err = array('err_code' => 1, 'err_msg' => 'Error in fetching successfully');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
        
    }
    
    public function getAllGoldRates($params)
    {
        $sql= "SELECT id,dname,dvalue,price FROM tbl_metal_purity_master WHERE active_flag IN (1,3)";
        
        $page = ($params['page'] ? $params['page'] : 1);
        $limit = ($params['limit'] ? $params['limit'] : 1000);
        //Making sure that query has limited rows
        if ($limit >1000 ) {
            $limit = 1000;
        }
        if (!empty($page)) {
            $start = ($page * $limit) - $limit;
            $sql.=" LIMIT " . $start . ",$limit";
        }
        
        
        $res = $this->query($sql);
        
        
        if($res)
        {
            while($row = $this->fetchData($res))
            {
                $reslt['id']        =     $row['id'];
                $reslt['name']     =     $row['dname'];
                $reslt['value']    =     $row['dvalue'];
                $reslt['price']     = floatval($row['price']);
                $result[]= $reslt;

            }
            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
        }
        else
        {
            $err = array('err_code' => 1, 'err_msg' => 'Error in fetching successfully');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
        
    }
    
    public function getDmdRates($params)
    {
        $sql= "SELECT id,dname,dvalue,price_per_carat FROM tbl_diamond_quality_master WHERE active_flag = 1";
        $page = ($params['page'] ? $params['page'] : 1);
        $limit = ($params['limit'] ? $params['limit'] : 1000);
        //Making sure that query has limited rows
        if ($limit >1000 ) {
            $limit = 1000;
        }
        if (!empty($page)) {
            $start = ($page * $limit) - $limit;
            $sql.=" LIMIT " . $start . ",$limit";
        }
        
        $res = $this->query($sql);
        
        if($res)
        {
            while($row = $this->fetchData($res))
            {
                $reslt['id']        =     $row['id'];
                $reslt['name']     =     $row['dname'];
                $reslt['value']    =     $row['dvalue'];
                $reslt['price']     = floatval($row['price_per_carat']);
                $result[]= $reslt;

            }
            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
        }
        else
        {
            $err = array('err_code' => 1, 'err_msg' => 'Error in fetching successfully');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }
    
    public function getPltnmRates($params)
    {
        $sql= " SELECT
                        id,
                        dname,
                        dvalue,
                        price
                FROM 
                        tbl_metal_purity_master 
                WHERE 
                        active_flag = 3";
        
        $page = ($params['page'] ? $params['page'] : 1);
        $limit = ($params['limit'] ? $params['limit'] : 1000);
        //Making sure that query has limited rows
        if ($limit >1000 ) {
            $limit = 1000;
        }
        if (!empty($page)) {
            $start = ($page * $limit) - $limit;
            $sql.=" LIMIT " . $start . ",$limit";
        }
        $res = $this->query($sql);
        
        if($res)
        {
            while($row = $this->fetchData($res))
            {
                $reslt['id']        =     $row['id'];
                $reslt['name']     =     $row['dname'];
                $reslt['value']    =     $row['dvalue'];
                $reslt['price']     = floatval($row['price']);
                $result[]= $reslt;
            }
            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
        }
        else
        {
            $err = array('err_code' => 1, 'err_msg' => 'Error in fetching successfully');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }
    
    
    
    
    public function getAllRates($params)
    {
        $page = ($params['page'] ? $params['page'] : 1);
        $limit = ($params['limit'] ? $params['limit'] : 1000);
        //Making sure that query has limited rows
      
        
        $grates=$this->getGoldRates($params);
        $dmdrates=$this->getDmdRates($params);
        $prates=$this->getPltnmRates($params);
        
        
        if($grates['error']['err_code'] == '1' || $dmdrates['error']['err_code'] == '1' || $prates['error']['err_code'] == '1')
        {
            $err = array('err_code' => 1, 'err_msg' => 'Error in fetching rates');
        }     
        else
        {
            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
            $result['goldRates']=$grates['result'];
            $result['diamondRates']=$dmdrates['result'];
            $result['platinumRates']=$prates['result'];
        }   
        
        $results = array('result' => $result, 'error' => $err);
        return $results;
       
    }
    
    public function gettransactiondata($params)
    {
      if (empty($params['order_id']) ) {
            $resp = array();
            $error = array('errCode' => 1, 'errMsg' => 'Parameter Missing');
            $result = array('results' => $resp, 'error' => $error);
            return $result;
        }
      
	$sql="SELECT 
		     order_id,
		     bank_ref_no,
		     order_status,
		     failure_msg,
		     payment_mode,
		     status_code,
		     status_msg,
		     amount,
		     offer_type,
		     offer_code,
		     discount_val,
		     jzeva_price,
		     si_created,
		     si_ref_no,
		     si_status,
		     trans_date
	      FROM  
		     tbl_transaction_master 
	      WHERE
		     order_id=".$params['order_id']."";
		   
      $res = $this->query($sql);
      if($res)
      {
	 
	  $row=$this->fetchData($res);
	  $arr['order_id']=$row['order_id'];
	  $arr['bank_ref_no']=$row['bank_ref_no'];
	  $arr['order_status']=$row['order_status'];
	  $arr['failure_msg']=$row['failure_msg'];
	  $arr['payment_mode']=$row['payment_mode'];
	  $arr['status_code']=$row['status_code']; 
	  $arr['status_msg']=$row['status_msg']; 
	  $arr['amount']=$row['amount'];
	  $arr['offer_type']=$row['offer_type'];
	  $arr['offer_code']=$row['offer_code'];
	  $arr['discount_val']=$row['discount_val'];
	  $arr['jzeva_price']=$row['jzeva_price'];
	  $arr['si_created']=$row['si_created'];
	  $arr['si_ref_no']=$row['si_ref_no'];
	  $arr['si_status']=$row['si_status'];
	  $arr['trans_date']=$row['trans_date'];  
	  $reslt=$arr;
	 
	  $err = array('err_code' => 0, 'err_msg' => 'Data Fetched successfully');
      }
      
      else 
      {
	  $err = array('err_code' => 1, 'err_msg' => 'Error in Fetching data');
      }
     
     $results=array('result'=>$reslt,'error'=>$err); 
        return $results;
      
    }
    
     public function addtransactiondata($params)
     {
       
         $trstr=split(" ",$params['trans_date']); 
 	 $trndate= date( "Y-m-d h:i:s",strtotime( $trstr[1]));
	 
       $sql="INSERT INTO 
			    tbl_transaction_master (
						    order_id,
						    transaction_id,
						    order_status,
						    failure_msg,
						    payment_mode,
						    status_code,
						    status_msg,
						    amount,
						    offer_type,
						    offer_code,
						    discount_val,
						    jzeva_price,
						    si_created,
						    si_ref_no,
						    si_status,
						    trans_date,
						    Cheque_Date,
						    transaction_flag) 
			    VALUES (
				\"".$params['order_id']."\",
				\"".$params['bank_ref_no']."\",
				\"".urldecode($params['order_status'])."\",
				\"".$params['failure_message']."\",
				\"".urldecode($params['payment_mode'])."\",
				\"".$params['status_code']."\",
				\"".urldecode($params['status_msg'])."\",
				\"".urldecode($params['amount'])."\",
				\"".$params['offer_type']."\",
				\"".$params['offer_code']."\",
				\"".urldecode($params['discount_value'])."\",
				\"".urldecode($params['jzeva_price'])."\",
				\"".$params['si_created']."\",
				\"".$params['si_ref_no']."\",
				\"".$params['si_status']."\",
				\"".$trndate."\",
				\"".urldecode($params['Cheque_Date'])."\",
				\"".urldecode($params['transactionflag'])."\"
		  ) ON DUPLICATE KEY UPDATE
				order_id=VALUES(order_id),
				transaction_id=VALUES(transaction_id),
				order_status=VALUES(order_status),
				failure_msg=VALUES(failure_msg),
				payment_mode=VALUES(payment_mode),
				status_code=VALUES(status_code),
				status_msg=VALUES(status_msg),
				amount=VALUES(amount),
				offer_type=VALUES(offer_type),
				offer_code=VALUES(offer_code),
				discount_val=VALUES(discount_val),
				jzeva_price=VALUES(jzeva_price),
				si_created=VALUES(si_created),
				si_ref_no=VALUES(si_ref_no),
				si_status=VALUES(si_status),
				trans_date=VALUES(trans_date),
				Cheque_Date=VALUES(Cheque_Date),
				transaction_flag=VALUES(transaction_flag)";
    
	      $res = $this->query($sql);
	         
 
                $resp = array();
                if($res){
                    $error = array('err_code'=>0, 'err_msg'=>' Transaction Added Successfully ');
                }else{
                    $error = array('err_code'=>1, 'err_msg'=>' Error In Updating Transaction ');
                }

                $result = array('result'=>$resp, 'error'=>$error );
                return $result;
     }
     
}

?>