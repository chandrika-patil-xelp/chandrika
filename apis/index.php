<?php

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
				case 'auto':
					$str = $_GET['str'];
					$url = APIDOMAIN.'index.php?action='.$cases.'&str='.urlencode($str);
					$res = $comm->executeCurl($url,1);
					echo $res;
                                        break;
                                
                                case 'ptype':
                                        $ptype = $_GET['ptype'];
                                        $url = APIDOMAIN.'index.php?action='.$cases.'&ptype='.$ptype;
                                        $res = $comm->executeCurl($url,1);
                                        echo $res;
                                        break;
                                
                                case 'pcode':
                                        $pcode = $_GET['pcode'];
                                        $url   = APIDOMAIN.'index.php?action='.$cases.'&pcode='.$pcode;
  					$res = $comm->executeCurl($url,1);
					echo $res;
                                        break;
                            
                                case 'nm':
                                       $nm  = $_GET['pname'];
                                       $url = APIDOMAIN.'index.php?action='.$cases.'&pname='.$pname;
  				       $res = $comm->executeCurl($url,1);
				       echo $res;
                                       break;
                                        
                                
                                        /*
				case 'otp':
					$mb = $_GET['mb'];
					$vc = $_GET['vc'];
					$url = APIDOMAIN.'index.php?action='.$cases.'&mb='.$mb.'&vc='.$vc;
					$res = $comm->executeCurl($url,1);
					echo $res;
				break;
				case 'rate':
					$c1 = $_GET['c1'];
					$c2 = $_GET['c2'];
					$et = $_GET['etype'];
					$qn = $_GET['qn'];
					$url = APIDOMAIN.'index.php?action='.$cases.'&c1='.$c1.'&c2='.$c2.'&etype='.$et.'&qn='.$qn;
					$res = $comm->executeCurl($url,1);
					echo $res;
				break;
                             
                            */
			}
			
		break;
		
		case 'aboutus':
                    $page='aboutus';
                    include TEMPLATE.'aboutus.html';
                    break;
                case 'faq':
                    $page='aboutus';
                    include TEMPLATE.'faq.html';
                    break;
                
                
                
                
                default:
                    if($_GET['par'])
                    {
                        switch ($_GET['par'])
			{
			case 'About Us':			
                                        break;
			
                        default:
                            $par = $_GET['par'];
			    $url = APIDOMAIN.'index.php?action=cUrl&par='.urlencode($par);
			    $res = $comm->executeCurl($url);
			    //print_r($res);
                            die;
			   
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
			case 'pPage':
        		    $page = 'product';
                            include TEMPLATE.'currency.html';
			    break;
			
			case 'hPage':
			    $page = 'index';
			    $extn = 'in '.ucwords(strtolower($par));
			    include TEMPLATE.'jzeva.html';
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
?>