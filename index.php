<?php
/*
	include 'config.php';
	error_reporting(0);
	$action = $_GET['action'];
	$type 	= $_GET['type'];
	$cases 	= $_GET['cases'];
	
	switch ($action)
	{
		case 'ajx':
			switch ($type)
			{
				case 'user':
					$str = $_GET['str'];
					$url = APIDOMAIN.'index.php?action='.$cases.'&str='.urlencode($str);
					$res = $comm->executeCurl($url,1);
					echo $res;
				break;
			}
			
		break;
		
		case 'aboutus':
                    $page='aboutus';
                    include TEMPLATE.'aboutus.html';
                    break;
                case 'contact':
                   $page='aboutus';
                   include TEMPLATE.'contactus.html';
                   break;
		default:
			/*if($_GET['par'])
			{
				switch ($_GET['par'])
				{
					case 'About Us':
						
					break;
					default:
						$par = $_GET['par'];
						$url = APIDOMAIN.'index.php?action=cUrl&par='.urlencode($par);
						$res = $comm->executeCurl($url);
						//print_r($res);die;
						if(!empty($res['results']))
						{
							$ex = explode(' - ',$res['results']['title']);
							$ex = array_reverse($ex);
							$res['results']['title'] = implode(' - ',$ex);
						}
						
						$url = APIDOMAIN.'index.php?action=fCur&vl='.urlencode($res['results']['name']);
						$fcur = $comm->executeCurl($url);
						
						switch($res['template'])
						{
							case 'cPage':
								$page = 'currency';
								include TEMPLATE.'currency.html';
							break;
							case 'uPage':
								$page = 'country';
								$extn = 'in '.ucwords(strtolower($res['results']['country']));
								
								foreach($fcur['results'] as $key => $val)
								{
									//echo "<pre>";print_r($val);die;
									$exd = explode(' - ',$val['title']);
									$tmp = '<a href="'.DOMAIN.$val['name'].'-'.str_replace(' ','-',$exd[0]).'">'.$val['name'].'</a>';
									$res['results']['country_hist'] = str_replace($val['name'],$tmp,$res['results']['country_hist']);
								}
								
								include TEMPLATE.'country.html';
							break;
							case 'hPage':
								$page = 'index';
								$extn = 'in '.ucwords(strtolower($par));
								include TEMPLATE.'nafex.html';
							break;
						}
					break;
				}
				
				exit;
			}
			
                        $page = 'index';
			$url = APIDOMAIN.'index.php?action=fCur';
			$fcur = $comm->executeCurl($url);
			include TEMPLATE.'jzeva.html';
		break;
	}
*/
?>


<?php
/*
$result=array("product_name"=>"bluediamond","brandid"=>11,"lotref"=>1123,"barcode"=>"qw211111",
            "lotno"=>1133,"product_display_name"=>"marveric blue silver diamond",            
            "product_model"=>"rw231","product_brand"=>"orra","product_price"=>12211223.02,
            "product_currency"=>"INR","product_keywords"=>"blue,silver,diamond",
            "product_desc"=>"a clear cut solitaire diamond in the vault",
            "product_wt"=>223.21,"prd_img"=>"abc.jpeg",
            "category_id"=>1,"product_warranty"=>"1 year");

$attribute=array(0=>array(0=>111,1=>"green",2=>1));
$design=array("desmobile"=>"889898989","desname"=>"shiamak");
$error=array("errCode"=>0);
$arr=array('result'=>$result,'attributes'=>$attribute,'design'=>$design,'error'=>$error);
$a=json_encode($arr);
print_r($a);
  ?>
<?php

 $result=array("username"=>"Shubham Bajpai","gender"=>0,"logmobile"=>9975887206,
               "password"=>"shubham","usertype"=>1,"email"=>"shubham@gmail.com",
                "alt_email"=>"shubhambaajpai@gmail.com","dob"=>"1990-10-10","working_phone"=>7309290529,
                "fulladdress"=>"ES 1B/962,Sector A, Jankipuram","pincode"=>223232,"cityname"=>"delhi","id_type"=>"DL",
                "id_proof_no"=>"VH32323HN");

$error=array("errCode"=>0);
$arr=array('result'=>$result,'error'=>$error);
$a=json_encode($arr);
print_r($a);
*/
 ?>

<?php
/*
 $result=array("ip"=>"192.168.2.21","logmob"=>9975887206,
               "vmob"=>7309290529,"qty"=>1,"pid"=>9);

$error=array("errCode"=>0);
$arr=array('result'=>$result,'error'=>$error);
$a=json_encode($arr);
print_r($a);
*/
 ?>
 
<?php

/*
$result=array("vname"=>"arun singh","logmob"=>9421522299,"pass"=>"singh123","email"=>"singharun@gmail.com",
              "wcell"=>"9696969696","lLine"=>"0232222132","ad1"=>"jangalganj","ad2"=>"rajokumar","area"=>"ddad wdawdad adawd awda wd",
               "city"=>"banglore","st"=>"karnatka","pc"=>323222,"wbst"=>"yahoo.com","fax"=>"020221313");

$error=array("errCode"=>0);
$arr=array('result'=>$result,'error'=>$error);
$a=json_encode($arr);
print_r($a);
*/
?>


<?php 
/*
 $result=array("filter_flg"=>0,"price"=>0,"pfrm"=>9975887206,"pto"=>12,
               "catid"=>4,"brname"=>"xyz,abcd,a,b,c,d","type"=>"jwellery,gold",
                "pgen"=>"Female","metal"=>"gold","color"=>"golden",
                "shape"=>"3,2,1,2","style"=>"adaw wqd ","purity"=>"18k",
                "size"=>"4,33,21");


$arr=array('result'=>$result);
$a=json_encode($arr);
print_r($a);
*/
 $result=array("filter_flg"=>0,"aid"=>"111,100014,43"); 
 
$value=array("111"=>"add,eeddwe,qdqd","100014"=>"necklace,eferg,earring","43"=>"qwdwqd,21,332,dwqdqwd,dqd");
$arr=array('result'=>$result,'value'=>$value);
$a=json_encode($arr);
print_r($a);


?>


