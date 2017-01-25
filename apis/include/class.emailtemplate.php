<?php

    include_once APICLUDE . 'common/db.class.php';

    class emailtemplate extends DB{

        function __construct($db) {
            parent::DB($db);
        }

        public function genordrtemplate($params)
        {
	  
	  if($params['data'][0]['userid'] !== null)
	  {
	      $sql="   SELECT
			      user_name,gender,
			       (SELECT address FROM tbl_order_shipping_details WHERE shipping_id=".$params['data'][0]['shipping_id']." AND active_flag=1 ) AS addr,
			       (SELECT city FROM tbl_order_shipping_details WHERE shipping_id=".$params['data'][0]['shipping_id']." AND active_flag=1 ) AS city,
			       (SELECT pincode FROM tbl_order_shipping_details WHERE shipping_id=".$params['data'][0]['shipping_id']." AND active_flag=1 ) AS pincode

			FROM
			      tbl_user_master
			WHERE
			      user_id=".$params['data'][0]['userid']."";

	      $res=  $this->query($sql);
	      $row=  $this->fetchData($res);
	      $name=$row['user_name'];
	      $addrs=$row['addr'];
	      $city=$row['city'];
	      $pincode=$row['pincode'];
	      $gndr=  $this->getgender($row['gender']);

	      $itms=COUNT($params['data']);

	      if($itms > 1)
		$itm=$itms."Items";
	      else
		$itm=$itms."Item";
	  }
	  else
	  {
	      $sql="   SELECT
			       name,gender, address AS addr, city, pincode  
			FROM
			      tbl_order_shipping_details
			WHERE
			      shipping_id=".$params['data'][0]['shipping_id']."";

	      $res=  $this->query($sql);
	      $row=  $this->fetchData($res);
	      $name=$row['name'];
	      $addrs=$row['addr'];
	      $city=$row['city'];
	      $pincode=$row['pincode'];
	      $gndr=  $this->getgender($row['gender']);

	      $itms=COUNT($params['data']);

	      if($itms > 1)
		$itm=$itms."  Items";
	      else
		$itm=$itms."  Item";
	  }
	  
	  
	  $message='<html>
		    <head>
			<title>confirm</title>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			 <style>
			    *{box-sizing:border-box;padding:0;margin:0;}
			</style>
		    </head>
		    <body>
		       <div style="width:100%;height:100%;background-color:#f3f3f3;padding-top:30px;padding-bottom:30px;font-family:sans-serif">
			    <div style="width:100%;height:auto;margin:auto;max-width:750px;box-sizing:border-box;">
				<div style="width:100%;height:auto;margin-bottom: 30px;">
				    <div style="width:150px;height:auto;margin:auto">
					<img src="'.DOMAIN.'frontend/emailer/jzeva_logo.png" alt="JZEVA" width="150" height="50">
				    </div>
				</div>
				<div style="width:100%;height:auto;background-color:#fff;padding:25px;min-height:300px;padding-bottom:0px;box-sizing:border-box;">
				    <div style="width:100%;height:auto;margin-bottom:30px;">
					<div style="width:70px;height:70px;margin:auto">
					    <img src="'.DOMAIN.'frontend/emailer/confirm.png" alt="JZEVA" width="70" height="70">
					</div>
				    </div>
				    <div style="width:100%;height:auto;font-size:20px;color:#0CCDB8;text-align:center;line-height:28px"> '.$gndr.' '.$name.'</div>
				    <div style="width:100%;height:auto;font-size:13px;color:#333;text-align:center;line-height:25px;margin-top:10px;letter-spacing:0.1em;">CONGRATULATIONS ON YOUR PURCHASE FROM JZEVA!!!</div>
				    <div style="width:100%;height:auto;font-size:14px;color:#333;text-align:center;line-height:0px"><span style="display:inline-block;line-height:25px;padding-top:10px;vertical-align:middle">We are glad to inform you that your order is now confirmed and will reach on the</span></div>
				     <div style="width:100%;height:auto;font-size:14px;color:#333;text-align:center;line-height:0px"><span style="display:inline-block;line-height:normal;vertical-align:middle">promised date.</span></div>
				    <div style="width:100%;height:auto;padding:0px;margin-top: 35px;">
				    
				    
				    <div style="width:100%;height:auto;margin-bottom:5px">
                            <div style="width:32%;height:auto;line-height:15px;font-size:11px;color:#333;display:inline-block;vertical-align:top;text-align:center;">
							    INVOICE NO 
								<span style="padding-left:1px;font-weight: bold;display: inline-block;width:100%;">
							   JZ21132
							   </span>
							</div>
							<div style="width:32%;height:auto;line-height:15px;font-size:11px;color:#333;display:inline-block;vertical-align:top;text-align:center;">
							   ORDER NO 
							<span style="padding-left:1px;font-weight: bold;display: inline-block;width:100%;">
							  '.$params['data'][0]['orderid'].'
							   </span>
							</div>
							<div style="width:32%;height:auto;line-height:15px;font-size:11px;color:#333;display:inline-block;vertical-align:top;text-align:center;"> 
							   DATE 
							<span style="padding-left:1px;font-weight: bold;display: inline-block;width:100%;">
							 '.date("jS M Y").'
							   </span>
                            </div>
                        </div>
                        <div style="width:100%;height:auto;padding:10px;background-color:#f3f3f3;text-align:left;color:#333;font-size:12px;line-height:15px;box-sizing:border-box;">'.$itm.'</div>
                        <div style="width:100%;height:auto;padding-top:15px;">
                            <div style="width:100%;height:auto;margin-bottom:20px"> '; 
	  
			foreach($params['data'] as $key=>$val)
                        {
                              $combn=$val['col_car_qty'];
                              list($col,$car,$qty)=explode('|@|',$combn);
 
                              $psql=" SELECT
                                            product_name,
                                            product_code,
                                            leadTime,
                                            (SELECT dname FROM tbl_metal_color_master WHERE id=".$col.") AS prdcolor,
                                            (SELECT dname FROM tbl_metal_purity_master WHERE id=".$car.") AS prdcarat,
                                            (SELECT dname FROM tbl_diamond_quality_master WHERE id=".$qty.") AS prdqlty,
                                            (SELECT GROUP_CONCAT(product_image) FROM tbl_product_image_mapping WHERE product_id=".$val['pid'].") AS prdimg
					    
                                      FROM
                                            tbl_product_master
                                      WHERE
                                            productid=".$val['pid']." AND active_flag=1";

                              $pres= $this->query($psql);
                              $prow= $this->fetchData($pres);

                              $prdname=$prow['product_name'];
                              $prdcode=$prow['product_code'];
                              $prdcolr=$prow['prdcolor'];
                              $prdcarat=$prow['prdcarat'];
			      $prdcarat=  explode(' ', $prdcarat);
                              $prdqlty=$prow['prdqlty'];
                              $prdimgs=$prow['prdimg'];
                              $prddeldt=date('Y-m-d', strtotime("+".$prow['leadTime']." days"));
                              $prdimgs=explode(',',$prdimgs);
			      $quantity=(int)$val['pqty'];
			      $qntystr="Quantity-<span style='color:#0CCDB8;'>".$quantity."</span>";
			    $message.='     
			      <div style="width:100%;height:auto;padding:10px;border:1px solid #ccc;margin-bottom: 10px;border-radius:2px;display:inline-block;box-sizing:border-box;">
                                <div style="width:auto;height:auto;display:inline-block;vertical-align:top;"><img src="'.IMGDOMAIN.''.$prdimgs[0].'" alt="'.BACKDOMAIN.'tools/img/noimage.svg" width="70" height="70"></div><div style="width:69%;height:auto;display:inline-block;vertical-align:top;padding-left: 10px;"><div style="width:100%;height:auto;font-size:12px;color:#333;line-height:20px">'.$prdname.'</div><div style="width:100%;height:auto;font-size:11px;color:#333;line-height:20px;text-align:left">Product Code : <span style="padding-left:0px">'.$prdcode.'</span></div><div style="width:auto;display:inline-block;height:auto;font-size:11px;color:#333;line-height:20px;text-align:left;margin-top: 5px;">Gold : '.$val['weight'].' gms | Diamond: '.$val['dmdcarat'].' Ct | Quality : '.$prdqlty.' | Purity: '.$prdcarat[0].' Ct | ';
			    if($val['size'] !== 0.0){
						     $message.=' Size : 14.0 | ';
						  }
			      $message.='Color: '.$prdcolr.'</div><div style="width:auto;height:auto;font-size:11px;line-height:20px;text-align:left;margin-top:5px;display:inline-block;"> '.$qntystr.'</div> </div>
                            </div>';
			       
			      }
 
			       
                          $message.='  </div>
					      <div style="width:100%;height:auto;padding:10px;background-color:#f3f3f3;box-sizing:border-box;">
						  <div style="width:100%;height:auto;display:inline-block;vertical-align:top">
						      <div style="width:50%;text-align:left;height: auto;line-height:15px;font-size:10px!important;color:#333;display:inline-block;vertical-align:top;">
							<div style="width: 100%;text-align:left;height: auto;line-height: 15px;font-size:10px!important;color: #333;display: inline-block;vertical-align: top;">GRAND TOTAL</div>
							<div style="width:100%;height:auto;color:#333;font-size:11px;line-height:15px;text-align:left;display: inline-block;">*Inclusive of all taxes</div>
						      </div>

						      <div style="width:40%;text-align: right;height: auto;line-height: 15px;font-size:10px!important;color: #333;display: inline-block;vertical-align: top;">
							  <div style="width:100%;padding-left:0px;height: auto;line-height:15px;font-size:10px!important;color: #333;display: inline-block;vertical-align: top;text-align:right;">&#8377; '.$params['totprz'].'</div>
						      </div>
						     </div>
					      </div>
					    <div style="width:100%;height:auto;padding-top:10px">
						<div style="width:100%;height:auto;font-size:12px;color:#333;text-align:center;line-height:25px;text-align:left;">THE PRODUCT WILL BE DELIVERED TO</div>
						<div style="width:100%;height:auto;text-align:left;font-size:11px;line-height:20px;margin-top:6px;color:#333"><b>'.$gndr.' '.$name.'</b></div>
						<div style="width:100%;height:auto;text-align:left;font-size:11px;color:#333;line-height:20px;margin-top:5px">'.$addrs.'</div>
						<div style="width:100%;height:auto;text-align:left;font-size:11px;color:#333;line-height:20px;">'.$city.'-'.$pincode.'</div>
						<div style="width:100%;height:auto;font-size:11px;color:#666;line-height:20px;text-align:left;margin-top:10px;padding-bottom: 15px;">Please login to your My jzeva account to view the status of your order</div>
					    </div>
					</div>
				    </div>
				    <div style="width:100%;height:auto;padding:20px 25px;background-color:#222529;margin-top:10px;box-sizing:border-box;">
					<div style="width:100%;height:auto;font-size:12px;color:#fff;text-align:center;line-height:20px;margin-top:10px;"><span style="display:inline-block;line-height:25px;vertical-align:middle">Should you have any question or require our assistance, our concierege services desk is available at</span></div>
					<div style="width:100%;height:auto;font-size:12px;line-height:20px;color:#0CCDB8;text-align:center;margin-top:7px"><span style="display:inline-block;line-height:25px;vertical-align:middle">Call +997779990000 | Email <a href="" style="color:#0CCDB8;text-decoration:none">care@jzeva.com</a></span></div>
					<div style="width:100%;height:auto;font-size:11px;line-height:25px;color:#999;text-align:center;margin-top: 4px;margin-bottom: 1px;text-decoration:none;"><span style="display:inline-block;line-height:25px;vertical-align:middle">( Monday to Saturday 10AM - 9PM IST )</span></div>
				    </div>
				</div>
				<div style="width:100%;height:auto;padding:0px 25px 25px 25px;background-color:#15181b;min-height:200px;box-sizing:border-box;">
				    <div style="width:100%;height:auto;padding:0px 25px 20px 25px;background-color:#222529;box-sizing:border-box;">
					<div style="width:100%;height:auto;font-size:12px;color:#fff;text-align:center;line-height:25px;">We look forward to serving you in the future. Happy Shopping!!!</div>
					 <div style="width:100%;height:auto;font-size:13px;color:#fff;text-align:center;line-height:25px;margin-top: 25px;">Yours Truly</div>
					  <div style="width:100%;height:auto;font-size:14px;color:#fff;text-align:center;line-height:20px; margin-bottom: 15px;">JZEVA</div>
				    </div>
				    <div style="width:100%;height:auto;margin-top:50px;margin-bottom:15px">
					<center>
					<a href style="text-decoration:none"><div style="width:100%;cursor:pointer;color:#0CCDB8;display:inline-block;vertical-align:top;font-size:9px;padding:0px 5px;line-height:16px;height:25px">FOLLOW US</div></a><a href style="text-decoration:none"><div style="width:auto;cursor:pointer;padding:0px 5px;color:#fff;display:inline-block;vertical-align:top;font-size:9px;line-height:16px;border-right:1px solid #fff;letter-spacing:0.02em;height:16px">FACEBOOK</div></a><a href style="text-decoration:none"><div style="width:auto;cursor:pointer;padding:0px 5px;color:#fff;display:inline-block;vertical-align:top;font-size:9px;line-height:16px;border-right:1px solid #fff;letter-spacing:0.02em;height:16px">INSTAGRAM</div></a><a href style="text-decoration:none"><div style="width:auto;cursor:pointer;padding:0px 5px;color:#fff;display:inline-block;vertical-align:top;font-size:9px;line-height:16px;letter-spacing:0.02em;height:16px">PINTEREST</div></a>
					</center>
				    </div>
				    <div style="width:100%;height:auto;font-size:12px;color:#999;line-height:25px;text-align:center;margin-top:30px">You are receiving this email in response to an order or request you submitted to  <a href="'.DOMAIN.'index.php?action=landing_page" style="color:#999;text-decoration:none !important">www.jzeva.com</a></div>
				    <div style="width:100%;height:auto;font-size:12px;color:#999;line-height:25px;text-align:center;margin-bottom: 30px;">Please visit <a href="'.DOMAIN.'index.php?action=landing_page" style="color:#999;text-decoration:none !important">www.jzeva.com</a> to consult our privacy policy and condition of sale.</div>
				</div>
			    </div>
			</div>
		    </body>
		</html>
		';
 
          return $message;
        }

	
	public function genwelcumtemplate($params)
	{
	 
	 $gndr= $this->getgender($params['gender']); 
	 
	 
	 $message='<html>
		  <head>
		      <title>login</title>
		      <meta charset="UTF-8">
		      <meta name="viewport" content="width=device-width, initial-scale=1.0">
		      <style>
			  *{box-sizing:border-box;padding:0;margin:0;}
		      </style>
		  </head>
		  <body>
		      <div style="width:100%;height:100%;background-color:#f3f3f3;padding-top:30px;padding-bottom:30px;font-family:sans-serif">
			  <div style="width:100%;height:auto;margin:auto;max-width:750px;box-sizing:border-box;">
			    <div style="width:100%;height:auto;margin-bottom: 30px;">
				<div style="width:150px;height:auto;margin:auto">
				    <img src="'.DOMAIN.'frontend/emailer/jzeva_logo.png" alt="JZEVA" width="150" height="50">
				</div>
			    </div>
			      <div style="width:100%;height:auto;background-color:#fff;padding:25px;min-height:300px;padding-bottom:0px;box-sizing:border-box;">
				  <div style="width:100%;height:auto;margin-bottom:30px;">
				      <div style="width:70px;height:60px;margin:auto">
					  <img src="'.DOMAIN.'frontend/emailer/signup.png" alt="img" width="70" height="60">
				      </div>
				  </div>
				  <div style="width:100%;height:auto;font-size:20px;color:#0CCDB8;text-align:center;line-height:25px"> '.$gndr.' '.$params['name'].'</div>
				  <div style="width:100%;height:auto;font-size:13px;text-align:center;color:#333;line-height:25px;margin-top:10px;letter-spacing:0.1em;"><span style="display:inline-block;line-height:25px;;vertical-align:middle">WELCOME TO THE WORLD OF LUXURIOUS JEWELLERY</span></div>
				  <div style="width:100%;height:auto;font-size:14px;color:#333;line-height:25px;text-align:center;padding-top:10px;">We at jzeva extremely pleased to have you express interest in your collection</div>
				  <div style="width:100%;height:auto;font-size:14px;color:#333;line-height:25px;text-align:center">Your profile has been created and can now be accessed by clicking on my account link at <a href="'.DOMAIN.'index.php?action=landing_page" style="text-decoration:none;color:#333">www.jzeva.com</a></div>
				  <div style="width:100%;height:auto;font-size:14px;color:#333;line-height:25px;text-align:center">You can log on to your account at any time ,using this email address and your secure password</div>
				  <div style="width:100%;height:auto;padding:50px 0px 50px 0px">
				      <div style="width:100%;height:auto">
					  <center>
					  <a href="'.DOMAIN.'index.php?action=landing_page&actn=lognpopup" target="_blank">
					      <div style="width:auto;height:35px;line-height:35px;color:#fff;font-size:12px;text-align: center;padding:0px 30px;display:inline-block;vertical-align:top;background-color:#0CCDB8">
					      LOGIN</div></a>
					  </center>
				      </div>
				  </div>
				  <div style="width:100%;height:auto">
				      <div style="width:40%;height:1px;border-bottom:1px solid #ccc;margin:auto"></div>
				  </div>
				  <div style="width:100%;height:auto;padding-top:40px">
				    <div style="width:100%;height:auto;display:inline-block;vertical-align:top;">
					<div style="width:100%;height:auto;font-size:14px;color:#333;text-align:center;line-height:25px">YOUR JZEVA ACCOUNT HAS</div>
					<div style="width:100%;height:auto;font-size:14px;color:#333;text-align:center;line-height:25px">MANY PRIVILEGES</div>
				    </div>
				      <div style="width:100%;height:auto;display:inline-block;vertical-align:top;">
					<div style="width:100%;height:30px;font-size:12px;color:#333;line-height:30px">
					   <span style="width:20px;height:30px;display:inline-block;vertical-align:top">
					       <img src="'.DOMAIN.'frontend/emailer/iconn.png" alt="img" width="15" height="15" style="margin-top:7.5px">
					   </span>
					   <span style="display:inline-block;vertical-align:top;">Manage your personal information</span>
				       </div>
					   <div style="width:100%;height:30px;font-size:12px;color:#333;line-height:30px">
					      <span style="width:20px;height:30px;display:inline-block;vertical-align:top">
						  <img src="'.DOMAIN.'frontend/emailer/iconn.png" alt="img" width="15" height="15" style="margin-top:7.5px">
					      </span>
					      <span style="display:inline-block;vertical-align:top;">Exclusive access to limited edition jewellery</span>
					  </div>
					   <div style="width:100%;height:30px;font-size:12px;color:#333;line-height:30px">
					      <span style="width:20px;height:30px;display:inline-block;vertical-align:top">
						  <img src="'.DOMAIN.'frontend/emailer/iconn.png" alt="img" width="15" height="15" style="margin-top:7.5px">
					      </span>
					      <span style="display:inline-block;vertical-align:top;">Create , save and share wishlist</span>
					  </div>
					   <div style="width:100%;height:30px;font-size:12px;color:#333;line-height:30px">
					      <span style="width:20px;height:30px;display:inline-block;vertical-align:top">
						  <img src="'.DOMAIN.'frontend/emailer/iconn.png" alt="img" width="15" height="15" style="margin-top:7.5px">
					      </span>
					      <span style="display:inline-block;vertical-align:top;">Early access to collection</span>
					  </div>
					   <div style="width:100%;height:30px;font-size:12px;color:#333;line-height:30px">
					      <span style="width:20px;height:30px;display:inline-block;vertical-align:top">
						  <img src="'.DOMAIN.'frontend/emailer/iconn.png" alt="img" width="15" height="15" style="margin-top:7.5px">
					      </span>
					      <span style="display:inline-block;vertical-align:top;">Follow up on your order status</span>
					  </div>
					   <div style="width:100%;height:30px;font-size:12px;color:#333;line-height:normal;">
					      <span style="width:20px;height:30px;display:inline-block;vertical-align:top">
						  <img src="'.DOMAIN.'frontend/emailer/iconn.png" alt="img" width="15" height="15" style="margin-top:7.5px">
					      </span>
					      <span style="display: inline-block;vertical-align: top;line-height:normal;font-size: 12px;width: calc(100% - 40px);margin-top:9px;">Save your valuable time when ordering at our e-shop</span>
					  </div>
				      </div>
				  </div>
				  <div style="width:100%;height:auto;padding:20px 25px;background-color:#222529;margin-top:25px;box-sizing:border-box;">
				      <div style="width:100%;height:auto;font-size:12px;color:#fff;text-align:center;line-height:20px;margin-top:10px;">Should you have any question or require our assistance, our concierege services desk is available at</div>
				      <div style="width:100%;height:auto;font-size:12px;line-height:20px;color:#0CCDB8;text-align:center;margin-top:7px"><span style="display:inline-block;line-height:25px;vertical-align:middle">Call +997779990000 | Email <a href="#" style="color:#0CCDB8;text-decoration:none">care@jzeva.com</a></span></div>
				      <div style="width:100%;height:auto;font-size:11px;line-height:25px;color:#999;text-align:center;margin-top: 4px;margin-bottom: 1px;text-decoration:none;"><span style="display:inline-block;line-height:25px;vertical-align:middle">( Monday to Saturday 10AM - 9PM IST )</span></div>
				  </div>
			      </div>
			      <div style="width:100%;height:auto;padding:0px 25px 25px 25px;background-color:#15181b;min-height:200px;box-sizing:border-box;">
				  <div style="width:100%;height:auto;padding:0px 25px 20px 25px;background-color:#222529;box-sizing:border-box;">
				      <div style="width:100%;height:auto;font-size:12px;color:#fff;text-align:center;line-height:25px;">We look forward to serving you in the future. Happy Shopping!!!</div>
				       <div style="width:100%;height:auto;font-size:13px;color:#fff;text-align:center;line-height:25px;margin-top: 25px;">Yours Truly</div>
					<div style="width:100%;height:auto;font-size:14px;color:#fff;text-align:center;line-height:20px; margin-bottom: 15px;">JZEVA</div>
				  </div>
				  <div style="width:100%;height:auto;margin-top:50px;margin-bottom:15px">
				      <center>
				      <a href="#" style="text-decoration:none"><div style="width:100%;cursor:pointer;color:#0CCDB8;display:inline-block;vertical-align:top;font-size:9px;padding:0px 5px;line-height:16px;height:25px">FOLLOW US</div></a><a href="#" style="text-decoration:none"><div style="width:auto;cursor:pointer;padding:0px 5px;color:#fff;display:inline-block;vertical-align:top;font-size:9px;line-height:16px;border-right:1px solid #fff;letter-spacing:0.02em;height:16px">FACEBOOK</div></a><a href="#" style="text-decoration:none"><div style="width:auto;cursor:pointer;padding:0px 5px;color:#fff;display:inline-block;vertical-align:top;font-size:9px;line-height:16px;border-right:1px solid #fff;letter-spacing:0.02em;height:16px">INSTAGRAM</div></a><a href="#" style="text-decoration:none"><div style="width:auto;cursor:pointer;padding:0px 5px;color:#fff;display:inline-block;vertical-align:top;font-size:9px;line-height:16px;letter-spacing:0.02em;height:16px">PINTEREST</div></a>
				      </center>
				  </div>
				  <div style="width:100%;height:auto;font-size:12px;color:#999;line-height:25px;text-align:center;margin-top:30px">You are receiving this email in response to an order or request you submitted to  <a href="'.DOMAIN.'index.php?action=landing_page" style="color:#999;text-decoration:none !important">www.jzeva.com</a></div>
				  <div style="width:100%;height:auto;font-size:12px;color:#999;line-height:25px;text-align:center;margin-bottom: 30px;">Please visit <a href="#" style="color:#999;text-decoration:none !important">www.jzeva.com</a> to consult our privacy policy and condition of sale.</div>
			      </div>
			  </div>
		      </div>
		  </body>
	      </html>';

	  return $message;
	}
	
	public function getshippingtemplate($params)
	{ 
	  $ordsql="SELECT 
			product_id AS pid,
			user_id AS uid,
			shipping_id AS shipid,
			(SELECT product_name FROM  tbl_product_master  WHERE   productid=pid AND active_flag=1) AS product_name, 
			(SELECT name FROM  tbl_order_shipping_details  WHERE   shipping_id=shipid) AS user_name,
			(SELECT gender FROM  tbl_order_shipping_details  WHERE   shipping_id=shipid AND active_flag=1) AS shp_gender,
			(SELECT product_name FROM  tbl_product_master  WHERE   productid=".$params['pid']." AND active_flag=1) AS prd_name
			
		  FROM
		        tbl_order_master
		  WHERE
		        order_id=".$params['ordid']." AND active_flag=1"; 
	   
	  $ordres=  $this->query($ordsql);
	  $ordrow= $this->fetchData($ordres);
	  
	  if($ordres)
	  {
	    
	      $prdname=$ordrow['prd_name']; 
	      $gender=$ordrow['shp_gender'];
	      $usrname=$ordrow['user_name'];
	    
	  }
	  $gndr=  $this->getgender($gender); 
	  
	  $message='<html>
		      <head>
			  <title>shipped</title>
			  <meta charset="UTF-8">
			  <meta name="viewport" content="width=device-width, initial-scale=1.0">
			  <style>
			      *{box-sizing:border-box;padding:0;margin:0;}
			  </style>
		      </head>
		      <body>
			  <div style="width:100%;height:100%;background-color:#f3f3f3;padding-top:30px;padding-bottom:30px;font-family:sans-serif">
			      <div style="width:100%;height:auto;margin:auto;max-width:750px;box-sizing:border-box;">
				  <div style="width:100%;height:auto;margin-bottom: 30px;">
				      <div style="width:150px;height:auto;margin:auto">
					  <img src="'.DOMAIN.'frontend/emailer/jzeva_logo.png" alt="JZEVA" width="150" height="50">
				      </div>
				  </div>
				  <div style="width:100%;height:auto;background-color:#fff;padding:25px;min-height:300px;padding-bottom:0px;box-sizing:border-box;">
				      <div style="width:100%;height:auto;margin-bottom:25px;">
					  <div style="width:60px;height:60px;margin:auto">
					      <img src="'.DOMAIN.'frontend/emailer/shipping.png" alt="img" width="60" height="60">
					  </div>
				      </div>
				      <div style="width:100%;height:auto;font-size:20px;color:#0CCDB8;text-align:center;line-height:28px"> '.$gndr.' '.$usrname.'</div>
				      <div style="width:100%;height:auto;font-size:12px;text-align:center;color:#000;line-height:25px;margin-top:10px"><span style="display:inline-block;line-height:25px;vertical-align:middle">We are glad to inform you that your jzeva jewellery <span>'.$prdname.'</span> with order number</span></div>
				      <div style="width:100%;height:auto;font-size:12px;color:#000;text-align:center;line-height:25px;margin-top: 3px"><span style="display:inline-block;line-height:25px;vertical-align:middle">'.$params['ordid'].' has been shipped from our location</span></div>
				      <div style="width:100%;height:auto;font-size:12px;color:#000;text-align:center;line-height:25px;margin-top: 10px;"><span style="display:inline-block;line-height:25px;vertical-align:middle">If you have opted for cash on delivery please pay the amount to the</span></div>
				       <div style="width:100%;height:auto;font-size:12px;color:#000;text-align:center;line-height:22px"><span style="display:inline-block;line-height:normal;vertical-align:middle">delivery personnel on receipt of your Jewellery</span></div>
				      <div style="width:100%;height:auto;padding:20px 25px;background-color:#222529;margin-top:25px;box-sizing:border-box;">
					  <div style="width:100%;height:auto;font-size:12px;color:#fff;text-align:center;line-height:25px;margin-top:10px;"><span style="display:inline-block;line-height:25px;vertical-align:middle">Should you have any question or require our assistance, our concierege services desk is available at</span></div>
					<div style="width:100%;height:auto;font-size:12px;line-height:20px;color:#0CCDB8;text-align:center;margin-top:7px"><span style="display:inline-block;line-height:25px;vertical-align:middle">Call +997779990000 | Email <a href="" style="color:#0CCDB8;text-decoration:none">care@jzeva.com</a></span></div>
					<div style="width:100%;height:auto;font-size:11px;line-height:25px;color:#999;text-align:center;margin-top: 4px;margin-bottom: 1px;text-decoration:none;"><span style="display:inline-block;line-height:25px;vertical-align:middle">( Monday to Saturday 10AM - 9PM IST )</span></div>
				      </div>
				  </div>
				  <div style="width:100%;height:auto;padding:0px 25px 25px 25px;background-color:#15181b;min-height:200px;box-sizing:border-box;">
				    <div style="width:100%;height:auto;padding:0px 25px 20px 25px;background-color:#222529;box-sizing:border-box;">
					<div style="width:100%;height:auto;font-size:12px;color:#fff;text-align:center;line-height:25px;">We look forward to serving you in the future. Happy Shopping!!!</div>
					 <div style="width:100%;height:auto;font-size:13px;color:#fff;text-align:center;line-height:25px;margin-top: 25px;">Yours Truly</div>
					  <div style="width:100%;height:auto;font-size:14px;color:#fff;text-align:center;line-height:20px; margin-bottom: 15px;">JZEVA</div>
				    </div>
				    <div style="width:100%;height:auto;margin-top:50px;margin-bottom:15px">
					<center>
					  <a href style="text-decoration:none"><div style="width:100%;cursor:pointer;color:#0CCDB8;display:inline-block;vertical-align:top;font-size:9px;padding:0px 5px;line-height:16px;height:25px">FOLLOW US</div></a><a href style="text-decoration:none"><div style="width:auto;cursor:pointer;padding:0px 5px;color:#fff;display:inline-block;vertical-align:top;font-size:9px;line-height:16px;border-right:1px solid #fff;letter-spacing:0.02em;height:16px">FACEBOOK</div></a><a href style="text-decoration:none"><div style="width:auto;cursor:pointer;padding:0px 5px;color:#fff;display:inline-block;vertical-align:top;font-size:9px;line-height:16px;border-right:1px solid #fff;letter-spacing:0.02em;height:16px">INSTAGRAM</div></a><a href style="text-decoration:none"><div style="width:auto;cursor:pointer;padding:0px 5px;color:#fff;display:inline-block;vertical-align:top;font-size:9px;line-height:16px;letter-spacing:0.02em;height:16px">PINTEREST</div></a>
					</center>
				    </div>
				    <div style="width:100%;height:auto;font-size:12px;color:#999;line-height:25px;text-align:center;margin-top:30px">You are receiving this email in response to an order or request you submitted to  <a href="'.DOMAIN.'index.php?action=landing_page" style="color:#999;text-decoration:none !important">www.jzeva.com</a></div>
				    <div style="width:100%;height:auto;font-size:12px;color:#999;line-height:25px;text-align:center;margin-bottom: 30px;">Please visit <a href="'.DOMAIN.'index.php?action=landing_page" style="color:#999;text-decoration:none !important">www.jzeva.com</a> to consult our privacy policy and Terms and condiations.</div>
				  </div>
			      </div>
			  </div>
		      </body>
		  </html>      ';
	  
	 
	  return $message;
	}
	
	public function getgender($params)
	{
	  if($params == 1)
	    $gndr="Ms.";
	  else if($params == 2)
	    $gndr="Mr.";
	  else if($params == 3)
	    $gndr="Mrs.";
	  else
	    $gndr="Dear";
	  
	  return $gndr;
	}
    }

?>
