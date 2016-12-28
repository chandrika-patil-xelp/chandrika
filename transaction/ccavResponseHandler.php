<?php include('Crypto.php')?> 
<?php
      include '../config.php';
      
	error_reporting(0);
	
	$workingKey='208B73AFD56C6EA93C6A44379EB8C4FF';		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
 	$order_status="";
	$decryptValues=explode('&', $rcvdString); 
	$dataSize=sizeof($decryptValues);
	
	 global $comm;
	 $colnames=array('order_id','bank_ref_no','order_status','failure_message','payment_mode','status_code','status_message','amount','offer_type','offer_code','discount_value','mer_amount','si_created','si_ref_no','si_status','trans_date');
   
	 foreach($decryptValues as $key => $val) 
	  { 
	       $info=  explode('=',$val ); 
	       if(in_array($info[0], $colnames))
	       { 
		    $arr[$info[0]]=$info[1];  
	       } 
	  }
	   
 	 $get = APIDOMAIN . "index.php?action=addtransactiondata&order_id=".$arr['order_id']."&bank_ref_no=".$arr['bank_ref_no']."&order_status=".urlencode($arr['order_status'])."&failure_msg=".$arr['failure_message']."&payment_mode=".urlencode($arr['payment_mode'])."&status_code=".$arr['status_code']."&status_msg=".urlencode($arr['status_message'])."&amount=".urlencode($arr['amount'])."&offer_type=".$arr['offer_type']."&offer_code=".$arr['offer_code']."&discount_val=".urlencode($arr['discount_value'])."&jzeva_price=".urlencode($arr['mer_amount'])."&si_created=".$arr['si_created']."&si_ref_no=".$arr['si_ref_no']."&si_status=".$arr['si_status']."&trans_date=".urlencode($arr['trans_date'])."";
 	  $res=$comm->executeCurl($get);
	  
	 $getord=APIDOMAIN . "index.php?action=gettransactiondata&order_id=".$arr['order_id'];
	 $res=$comm->executeCurl($getord);
	 
	 
	echo "<center>";

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==3)	$order_status=$information[1];
	}
	if($order_status==="Success")
	{
	//	echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
	    $path = DOMAIN . 'index.php?action=checkoutAfter&ordid=' . $arr['order_id'];
	    header('Location: '.$path) and exit;
	}
	else if($order_status==="Aborted")
	{
		echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
	
	}
	else if($order_status==="Failure")
	{
		echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
	}
	else
	{
		echo "<br>Security Error. Illegal access detected";
	
	}

	echo "<br><br>";
	echo "<table cellspacing=4 cellpadding=4>";
	for($i = 0; $i < $dataSize; $i++) 
	{
//		$information=explode('=',$decryptValues[$i]);
//	    	echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
	}

	echo "</table><br>";
	echo "</center>";
?>
