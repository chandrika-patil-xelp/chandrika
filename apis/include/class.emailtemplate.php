<?php

    include_once APICLUDE . 'common/db.class.php';

    class emailtemplate extends DB{

        function __construct($db) {
            parent::DB($db);
        }

        public function genordrtemplate($params)
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
                        <div style="width:100%;height:auto;margin:auto;max-width:750px">
                            <div style="width:100%;height:auto;margin-bottom: 30px;">
                          <div style="width:150px;height:auto;margin:auto">
                              <img src="'.DOMAIN.'frontend/emailer/jzeva_logo.png" alt="JZEVA" width="150" height="50">
                          </div>
                            </div>
                            <div style="width:100%;height:auto;background-color:#fff;padding:25px;min-height:300px;padding-bottom:0px">
                        <div style="width:100%;height:auto;margin-bottom:15px;">
                            <div style="width:70px;height:70px;margin:auto">
                          <img src="'.DOMAIN.'frontend/emailer/confirm.png" alt="img" width="70" height="70">
                            </div>
                        </div>
                        <div style="width:100%;height:auto;font-size:22px;color:#0CCDB8;text-align:center;line-height:28px">Dear '.$gndr.'. '.$name.'</div>
                        <div style="width:100%;height:auto;font-size:13px;color:#333;text-align:center;line-height:30px;margin-top:10px;">CONGRATULATIONS ON YOUR PURCHASE FROM JZEVA!!!</div>
                        <div style="width:100%;height:auto;font-size:14px;color:#333;text-align:center;line-height:0px"><span style="display:inline-block;line-height:normal;vertical-align:middle"><b>We are glad to inform you that your order is now confirmed and will reach on the promised date</b></span></div>
                        <div style="width:100%;height:auto;padding:15px;margin-top: 20px;">
                            <div style="width:100%;height:auto;margin-bottom:5px">
                        <div style="width:33.33%;height:35px;line-height:35px;font-size:12px;color:#333;display:inline-block;vertical-align:top;text-align:left;padding-left: 10px;">INVOICE NO<span style="padding-left:10px">jz21132</span></div><div style="width:33.33%;height:35px;line-height:35px;font-size:12px;color:#333;display:inline-block;vertical-align:top;text-align:center">ORDER NO<span style="padding-left:10px">'.$params['data'][0]['orderid'].'</span></div><div style="width:33.33%;height:35px;line-height:35px;font-size:12px;color:#333;display:inline-block;vertical-align:top;text-align:right">DATE<span style="padding-left:10px">'.date("jS M Y").'</span></div>
                        </div>
                                          <div style="width:100%;height:auto;padding:10px;background-color:#f3f3f3;text-align:left;color:#333;font-size:12px;line-height:15px;">'.$itm.'</div>
                                          <div style="width:100%;height:auto;padding-top:15px;">
                                              <div style="width:100%;height:auto;margin-bottom:30px">';

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
                              $prdqlty=$prow['prdqlty'];
                              $prdimgs=$prow['prdimg'];
                              $prddeldt=date('Y-m-d', strtotime("+".$prow['leadTime']." days"));
                              $prdimgs=explode(',',$prdimgs);


                              $message.='<div style="width:48%;height:auto;min-height:150px;padding:10px;border:1px solid #ccc;border-radius:2px;display:inline-block;vertical-align:top;">
                                      <div style="width:35%;height:auto;display:inline-block;vertical-align:top;"><img src="'.IMGDOMAIN.''.$prdimgs[0].'" alt="img" width="100" height="100"></div><div style="width:65%;height:auto;display:inline-block;vertical-align:top;padding-left: 10px;"><div style="width:100%;height:auto;font-size:12px;color:#333;line-height:20px">'.$prdname.'</div><div style="width:100%;height:auto;font-size:11px;color:#333;line-height:20px;text-align:left">Product Code : <span style="padding-left:5px">'.$prdcode.'</span></div><div style="width:100%;height:auto;font-size:11px;color:#333;line-height:20px;text-align:left;margin-top: 10px;">Gold : '.$val['weight'].' gms | Diamond: '.$val['dmdcarat'].' Ct</div><div style="width:100%;height:auto;font-size:11px;color:#333;line-height:20px;text-align:left;">Quality : '.$prdqlty.' | Purity: '.$prdcarat.'</div><div style="width:100%;height:auto;font-size:11px;color:#333;line-height:20px;text-align:left;">Size : '.$val['size'].' | Color: '.$prdcolr.'</div><div style="width:100%;height:auto;font-size:11px;color:#0CCDB8;line-height:20px;text-align:left;margin-top: 5px;">Delivery Date: '.$prddeldt.'</div></div>
                                      </div>
                                      </div>';

                          }

            $message.=' <div style="width:100%;height:auto;padding:10px;background-color:#f3f3f3">
                        <div style="width:50%;height:auto;display:inline-block;vertical-align:top"><div style="width:100%;height:20px;color:#333;font-size:13px;line-height:20px">TOTAL AMOUNT (IN WORDS)</div><div style="width:100%;height:20px;color:#333;font-size:10px;line-height:20px"><span style="display:inline-block;vertical-align:middle;line-height:normal">'.$params['totprzwrd'].' Only</span></div></div><div style="width:50%;height:auto;display:inline-block;vertical-align:top"><div style="width:100%;height:20px;color:#333;font-size:13px;line-height:20px;text-align:right">GRAND TOTAL<span style="padding-left:25px">&#8377; '.$params['totprz'].'</span></div><div style="width:100%;height:20px;color:#333;font-size:11px;line-height:15px;padding-left: 125px;">*Inclusive of all taxes</div></div>
                        </div>
                                  <div style="width:100%;height:auto;padding-top:15px">
                                      <div style="width:100%;height:auto;font-size:13px;color:#333;text-align:center;line-height:25px;text-align:left;">THE PRODUCT WILL BE DELIVERED TO</div>
                                      <div style="width:100%;height:auto;text-align:left;font-size:11px;line-height:20px;margin-top:6px;color:#333"><b>'.$gndr.'. '.$name.'</b></div>
                                      <div style="width:100%;height:auto;text-align:left;font-size:13px;color:#333;line-height:20px;margin-top:10px">'.$addrs.'</div>
                                      <div style="width:100%;height:auto;text-align:left;font-size:13px;color:#333;line-height:20px;">'.$city.'-'.$pincode.'</div>
                                      <div style="width:100%;height:auto;font-size:12px;color:#666;line-height:20px;text-align:left;margin-top:10px">Please login to your My jzeva account to view the status of your order</div>
                                  </div>
                       </div>
                       </div>
                       <div style="width:100%;height:auto;padding:20px;background-color:#222529;margin-top:20px">
                          <div style="width:100%;height:auto;font-size:12px;color:#fff;text-align:center;line-height:20px;margin-top:20px;">Should you have any question or require our assistance, our concierege services desk is available at</div>
                          <div style="width:100%;height:auto;font-size:15px;line-height:20px;color:#0CCDB8;text-align:center;margin-top:13px">Call +91 9980051525 | Email care@jzeva.com</div>
                          <div style="width:100%;height:auto;font-size:14px;line-height:25px;color:#666;text-align:center;margin-top: 6px;margin-bottom: 20px;">( Monday to Friday 10AM - 10PM IST and Saturday 10AM - 10PM IST )</div>
                       </div>
                       </div>
                       <div style="width:100%;height:auto;padding:0px 25px 25px 25px;background-color:#15181b;min-height:200px">
                          <div style="width:100%;height:auto;padding:0px 25px 25px 25px;background-color:#222529">
                      <div style="width:100%;height:auto;font-size:14px;color:#fff;text-align:center;line-height:29px;">We look forward to serving you in the future. Happy Shopping!!!</div>
                         <div style="width:100%;height:auto;font-size:14px;color:#fff;text-align:center;line-height:25px;margin-top: 50px;">Yours Truly</div>
                          <div style="width:100%;height:auto;font-size:14px;color:#fff;text-align:center;line-height:20px; margin-bottom: 15px;">JZEVA</div>
                          </div>
                          <div style="width:100%;height:auto;margin-top:55px;margin-bottom:15px">
                      <center>
                            <div style="width:auto;padding:0px 10px;color:#0CCDB8;display:inline-block;vertical-align:top;font-size:12px;line-height:16px;height:16px">FOLLOW US</div><div style="width:auto;padding:0px 10px;color:#fff;display:inline-block;vertical-align:top;font-size:12px;line-height:16px;border-right:1px solid #fff;letter-spacing:0.02em;height:16px">FACEBOOK</div><div style="width:auto;padding:0px 10px;color:#fff;display:inline-block;vertical-align:top;font-size:12px;line-height:16px;border-right:1px solid #fff;letter-spacing:0.02em;height:16px">TWITTER</div><div style="width:auto;padding:0px 10px;color:#fff;display:inline-block;vertical-align:top;font-size:12px;line-height:16px;border-right:1px solid #fff;letter-spacing:0.02em;height:16px">INSTAGRAM</div><div style="width:auto;padding:0px 10px;color:#fff;display:inline-block;vertical-align:top;font-size:12px;line-height:16px;letter-spacing:0.02em;height:16px">PINTEREST</div>
                      </center>
                      </div>
                      <div style="width:100%;height:auto;font-size:14px;color:#666;line-height:25px;text-align:center;margin-top:40px">You are receiving this email in response to an order or request you submitted to  <a href="'.DOMAIN.'index.php?action=landing_page" style="color:#666;text-decoration:none !important">www.jzeva.com</a></div>
                      <div style="width:100%;height:auto;font-size:14px;color:#666;line-height:25px;text-align:center;margin-bottom: 30px;">Please visit <a href="'.DOMAIN.'index.php?action=landing_page" style="color:#666;text-decoration:none !important">www.jzeva.com</a> to consult our privacy policy and condition of sail</div>
                      </div>
                      </div>
                      </div>
                   </body>
                   </html> ';
	 
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
			    <div style="width:100%;height:auto;margin:auto;max-width:750px">
				<div style="width:100%;height:auto;margin-bottom: 30px;">
				    <div style="width:150px;height:auto;margin:auto">
					<img src="'.DOMAIN.'frontend/emailer/jzeva_logo.png" alt="JZEVA" width="150" height="50">
				    </div>
				</div>
				<div style="width:100%;height:auto;background-color:#fff;padding:25px;min-height:300px;padding-bottom:0px">
				    <div style="width:100%;height:auto;margin-bottom:15px;">
					<div style="width:70px;height:60px;margin:auto">
					    <img src="'.DOMAIN.'frontend/emailer/signup.png" alt="img" width="70" height="60">
					</div>
				    </div>
				    <div style="width:100%;height:auto;font-size:22px;color:#0CCDB8;text-align:center;line-height:28px">Dear '.$gndr.'. '.$params['name'].'</div>
				    <div style="width:100%;height:auto;font-size:15px;text-align:center;color:#333;line-height:30px;margin-top:15px"><span style="display:inline-block;line-height:normal;vertical-align:middle">WELCOME TO THE WORLD OF LUXURIOUS JEWELLERY</span></div>
				    <div style="width:100%;height:auto;font-size:12px;color:#333;line-height:20px;text-align:center;margin-top:10px">We at jzeva extremely pleased to have you express interest in your collection</div>
				    <div style="width:100%;height:auto;font-size:12px;color:#333;line-height:20px;text-align:center">Your profile has been created and can now be accessed by clicking on my account link at <a href="'.DOMAIN.'index.php?action=landing_page" style="text-decoration:none;color:#333">www.jzeva.com</a></div>
				    <div style="width:100%;height:auto;font-size:12px;color:#333;line-height:20px;text-align:center">You can log on to your account at any time ,using this email address and your secure password</div>
				    <div style="width:100%;height:auto;padding:50px 0px 50px 0px">
					<div style="width:100%;height:auto">
					    <center>
						<a  target="_blank" href="'.DOMAIN.'index.php?action=landing_page&actn=lognpopup">
						<div style="width:auto;height:35px;line-height:35px;color:#fff;font-size:12px;text-align: center;padding:0px 30px;display:inline-block;vertical-align:top;background-color:#0CCDB8">
						 LOGIN</div></a>
					    </center>
					</div>
				    </div>
				    <div style="width:100%;height:auto">
					<div style="width:40%;height:1px;border-bottom:1px solid #ccc;margin:auto"></div>
				    </div>
				    <div style="width:100%;height:auto;padding-top:40px">
					<div style="width:49%;height:auto;display:inline-block;vertical-align:top;padding-right:10px;padding-top: 6px;">
					    <div style="width:100%;height:auto;font-size:13px;color:#333;text-align:right;line-height:18px">YOUR MY JZEVA ACCOUNT HAS</div>
					    <div style="width:100%;height:auto;font-size:13px;color:#333;text-align:right;line-height:18px">MANY PRIVILEGES</div>
					</div>
					<div style="width:49%;height:auto;display:inline-block;vertical-align:top;padding-left:10px;">
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
					     <div style="width:100%;height:30px;font-size:12px;color:#333;line-height:30px">
						<span style="width:20px;height:30px;display:inline-block;vertical-align:top">
						    <img src="'.DOMAIN.'frontend/emailer/iconn.png" alt="img" width="15" height="15" style="margin-top:7.5px">
						</span>
						<span style="display:inline-block;vertical-align:top;">Save your valuable time when ordering at our e shop</span>
					    </div>
					</div>
				    </div>
				    <div style="width:100%;height:auto;padding:20px;background-color:#222529;margin-top:40px">
					<div style="width:100%;height:auto;font-size:12px;color:#fff;text-align:center;line-height:20px;margin-top:20px;">Should you have any question or require our assistance, our concierege services desk is available at</div>
					<div style="width:100%;height:auto;font-size:15px;line-height:20px;color:#0CCDB8;text-align:center;margin-top:13px">Call +91 9980051525 | Email care@jzeva.com</div>
					<div style="width:100%;height:auto;font-size:14px;line-height:25px;color:#666;text-align:center;margin-top: 6px;margin-bottom: 20px;">( Monday to Friday 10AM - 10PM IST and Saturday 10AM - 10PM IST )</div>
				    </div>
				</div>
				<div style="width:100%;height:auto;padding:0px 25px 25px 25px;background-color:#15181b;min-height:200px">
				    <div style="width:100%;height:auto;padding:0px 25px 25px 25px;background-color:#222529">
					<div style="width:100%;height:auto;font-size:14px;color:#fff;text-align:center;line-height:29px;">We look forward to serving you in the future. Happy Shopping!!!</div> 
					 <div style="width:100%;height:auto;font-size:14px;color:#fff;text-align:center;line-height:25px;margin-top: 50px;">Yours Truly</div> 
					  <div style="width:100%;height:auto;font-size:14px;color:#fff;text-align:center;line-height:20px; margin-bottom: 15px;">JZEVA</div> 
				    </div>
				    <div style="width:100%;height:auto;margin-top:55px;margin-bottom:15px">
					<center> 
					    <div style="width:auto;padding:0px 10px;color:#0CCDB8;display:inline-block;vertical-align:top;font-size:12px;line-height:16px;height:16px">FOLLOW US</div><div style="width:auto;padding:0px 10px;color:#fff;display:inline-block;vertical-align:top;font-size:12px;line-height:16px;border-right:1px solid #fff;letter-spacing:0.02em;height:16px">FACEBOOK</div><div style="width:auto;padding:0px 10px;color:#fff;display:inline-block;vertical-align:top;font-size:12px;line-height:16px;border-right:1px solid #fff;letter-spacing:0.02em;height:16px">TWITTER</div><div style="width:auto;padding:0px 10px;color:#fff;display:inline-block;vertical-align:top;font-size:12px;line-height:16px;border-right:1px solid #fff;letter-spacing:0.02em;height:16px">INSTAGRAM</div><div style="width:auto;padding:0px 10px;color:#fff;display:inline-block;vertical-align:top;font-size:12px;line-height:16px;letter-spacing:0.02em;height:16px">PINTEREST</div>
					</center>
				    </div>
				    <div style="width:100%;height:auto;font-size:14px;color:#666;line-height:25px;text-align:center;margin-top:40px">You are receiving this email in response to an order or request you submitted to  <a href="'.DOMAIN.'index.php?action=landing_page" style="color:#666;text-decoration:none !important">www.jzeva.com</a></div>
				    <div style="width:100%;height:auto;font-size:14px;color:#666;line-height:25px;text-align:center;margin-bottom: 30px;">Please visit <a href="'.DOMAIN.'index.php?action=landing_page" style="color:#666;text-decoration:none !important">www.jzeva.com</a> to consult our privacy policy and condition of sail</div>
				</div>
			    </div>
			</div>
		    </body>
		</html>

		';
	 
	  return $message;
	}
	
	public function genshippingtemplate($params)
	{
	   
	  $sql="SELECT 
		      user_name,
		      gender
		FROM
		      tbl_user_master
		WHERE
		      user_id=".$params['userid']."";
	  $res=  $this->query($sql);
	  $row= $this->fetchData($res);
	  $gndr=  $this->getgender($row['gender']);
	   
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
			    <div style="width:100%;height:auto;margin:auto;max-width:750px">
				<div style="width:100%;height:auto;margin-bottom: 30px;">
				    <div style="width:150px;height:auto;margin:auto">
					<img src="'.DOMAIN.'frontend/emailer/jzeva_logo.png" alt="JZEVA" width="150" height="50">
				    </div>
				</div>
				<div style="width:100%;height:auto;background-color:#fff;padding:25px;min-height:300px;padding-bottom:0px">
				    <div style="width:100%;height:auto;margin-bottom:15px;">
					<div style="width:60px;height:60px;margin:auto">
					    <img src="'.DOMAIN.'frontend/emailer/shipping.png" alt="img" width="60" height="60">
					</div>
				    </div>
				    <div style="width:100%;height:auto;font-size:22px;color:#0CCDB8;text-align:center;line-height:28px">Dear '.$gndr.'. '.$row['user_name'].'</div>
				    <div style="width:100%;height:auto;font-size:14px;text-align:center;color:#000;line-height:22px;margin-top:25px"><span style="display:inline-block;line-height:normal;vertical-align:middle">We are glad to inform you that your jzeva jewellery <span>FLORE RING</span> with order number</span></div>
				    <div style="width:100%;height:auto;font-size:13px;color:#000;text-align:center;line-height:17px;margin-top: 3px"><span style="display:inline-block;line-height:normal;vertical-align:middle">'.$params['ordid'].' has been shipped from our location</span></div>
				    <div style="width:100%;height:auto;font-size:13px;color:#000;text-align:center;line-height:22px;margin-top: 25px;"><span style="display:inline-block;line-height:normal;vertical-align:middle">If you have opted for cash on delivery please pay the amount to the</span></div>
				     <div style="width:100%;height:auto;font-size:13px;color:#000;text-align:center;line-height:22px"><span style="display:inline-block;line-height:normal;vertical-align:middle">delivery personnel on receipt of your jewellery</span></div>
				    <div style="width:100%;height:auto;padding:20px;background-color:#222529;margin-top:55px">
					<div style="width:100%;height:auto;font-size:12px;color:#fff;text-align:center;line-height:20px;margin-top:20px;"><span style="display:inline-block;line-height:normal;vertical-align:middle">Should you have any question or require our assistance, our concierege services desk is available at</span></div>
					<div style="width:100%;height:auto;font-size:15px;line-height:20px;color:#0CCDB8;text-align:center;margin-top:13px"><span style="display:inline-block;line-height:normal;vertical-align:middle">Call +91 9980051525 | Email care@jzeva.com</span></div>
					<div style="width:100%;height:auto;font-size:14px;line-height:25px;color:#666;text-align:center;margin-top: 10px;margin-bottom: 20px;text-decoration:none;"><span style="display:inline-block;line-height:normal;vertical-align:middle">( Monday to Friday 10AM - 10PM IST and Saturday 10AM - 10PM IST )</span></div>
				    </div>
				</div>
				<div style="width:100%;height:auto;padding:0px 25px 25px 25px;background-color:#15181b;min-height:200px">
				    <div style="width:100%;height:auto;padding:0px 25px 25px 25px;background-color:#222529">
					<div style="width:100%;height:auto;font-size:14px;color:#fff;text-align:center;line-height:29px;">We look forward to serving you in the future. Happy Shopping!!!</div> 
					 <div style="width:100%;height:auto;font-size:14px;color:#fff;text-align:center;line-height:25px;margin-top: 50px;">Yours Truly</div> 
					  <div style="width:100%;height:auto;font-size:14px;color:#fff;text-align:center;line-height:20px; margin-bottom: 15px;">JZEVA</div> 
				    </div>
				    <div style="width:100%;height:auto;margin-top:55px;margin-bottom:15px">
					<center> 
					    <div style="width:auto;padding:0px 10px;color:#0CCDB8;display:inline-block;vertical-align:top;font-size:12px;line-height:16px;height:16px">FOLLOW US</div><div style="width:auto;padding:0px 10px;color:#fff;display:inline-block;vertical-align:top;font-size:12px;line-height:16px;border-right:1px solid #fff;letter-spacing:0.02em;height:16px">FACEBOOK</div><div style="width:auto;padding:0px 10px;color:#fff;display:inline-block;vertical-align:top;font-size:12px;line-height:16px;border-right:1px solid #fff;letter-spacing:0.02em;height:16px">TWITTER</div><div style="width:auto;padding:0px 10px;color:#fff;display:inline-block;vertical-align:top;font-size:12px;line-height:16px;border-right:1px solid #fff;letter-spacing:0.02em;height:16px">INSTAGRAM</div><div style="width:auto;padding:0px 10px;color:#fff;display:inline-block;vertical-align:top;font-size:12px;line-height:16px;letter-spacing:0.02em;height:16px">PINTEREST</div>
					</center>
				    </div>
				    <div style="width:100%;height:auto;font-size:14px;color:#666;line-height:25px;text-align:center;margin-top:40px">You are receiving this email in response to an order or request you submitted to  <a href="'.DOMAIN.'index.php?action=landing_page" style="color:#666;text-decoration:none !important">www.jzeva.com</a></div>
				    <div style="width:100%;height:auto;font-size:14px;color:#666;line-height:25px;text-align:center;margin-bottom: 30px;">Please visit <a href="'.DOMAIN.'index.php?action=landing_page" style="color:#666;text-decoration:none !important">www.jzeva.com</a> to consult our privacy policy and Terms and condition</div>
				</div>
			    </div>
			</div>
		    </body>
		</html>';
	   
	  return $message;
	}
	
	public function getgender($params)
	{
	  if($params == 1)
	    $gndr="Ms";
	  else if($params == 2)
	    $gndr="Mr";
	  else if($params == 3)
	    $gndr="Mrs";
	 
	  return $gndr;
	}
    }

?>
