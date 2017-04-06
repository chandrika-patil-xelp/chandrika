<?php
 
  class urlxml extends DB
  {
    function _construct($db)
    {
      parent::DB($db);
    }
    
     public function createurl ($params)
    {   
      $sql = "SELECT  productid  from tbl_product_master where active_flag=1 order by productid ASC";
      $res = $this->query($sql);
      $i=0;
      $datasitemap = '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
       $data = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
       
      
      if($res)
      { 
          while($row = $this->fetchData($res)){
	
     
	    $sql1 = "  
		      SELECT
			    productid AS pid,
			    jewelleryType,
			    product_name,
			    certificate,
			    (SELECT GROUP_CONCAT(id ORDER By id DESC) FROM tbl_product_metal_purity_mapping WHERE productid=pid ORDER BY id DESC) AS metalid,
			    (SELECT GROUP_CONCAT(dname) FROM tbl_metal_purity_master WHERE id IN (metalid)) AS metal
		      FROM
			    tbl_product_master
		      WHERE
			    active_flag=1 
		      AND 
			    productid=".$row['productid']."";
	    $res1 = $this->query($sql1);
	      
	    while($row2 = $this->fetchData($res1))
	    {
	      $url=DOMAIN;      
	       $pname=  ucwords($row2['product_name']);
           $arr['product_name']= trim(preg_replace('/\s\s+/', ' ', $pname));
           
	  $arr['pid']=$row2['pid'];
	 
	  if($row2['jewelleryType'] === '1')
		$arr['jewelleryType'] ='Gold';
	  else  if($row2['jewelleryType'] === '2')
		$arr['jewelleryType'] ='Plain Gold';
	  else  if($row2['jewelleryType'] === '3')
		$arr['jewelleryType'] ='Platinum';
     
          $url.='Product-Details/'. str_replace(' ','-',$arr['product_name']);
	  $url.=''.str_replace(' ','-',$arr['metal']);
	  $url.='-'. str_replace(' ','-',$arr['jewelleryType']);
          $url.='/pid-'. str_replace(' ','-',$arr['pid']);
	 $arr['url']=$url;
      
	//  $url.='-'. str_replace(' ','_',$arr['certificate']);
	
	   $reslt[]=$arr;
	      $data .= '<url>';
	      $data .= '<loc>';
	      $data .= $url;
	      $data .= '</loc>';
	      $data .= '<changefreq>weekly</changefreq>';
	      $data .= '<priority>1.0</priority>';
	      $data .= '</url>';
	      
	 
               $i++;

	       
	    }
          }
             
	      $data.= '</urlset>';
           $filename = WEBROOT."prodDisplay.xml";

          $myfile = fopen($filename, "a") or die("Unable to open file");
          fwrite($myfile, $data);
          fclose($myfile);

	      $datasitemap .= '<sitemap>';
	     $datasitemap .= '<loc>http://www.jzeva.com/</loc>';
	      $datasitemap .= '<lastmod>'.date('c').'</lastmod>';
	      $datasitemap .= '</sitemap>';
	    $datasitemap .= '</sitemapindex>';
       
	$err=array('error_code'=>0,'err_msg'=>'Data fetched successfully');
      }
      else
      {
	$reslt=array();
	$err=array('error_code'=>1, 'err_msg'=>'error in fetching data');
      }
      $result=array('result'=>$reslt,'error'=>$err);
      return $result; 
    }
   
     public function generalMap()
    {
        global $comm;
        $url = DOMAIN;
        $links = '';
        $arr = array();

        $urls = APIDOMAIN."index.php?action=getSubCat&catid=99999";
        $res1  = $comm->executeCurl($urls);
        $res2   = $this->subUrls($res1);

     //  echo "<pre>";print_r($res2);die;

        $datasitemap = '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        $data = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

        $arr = array(
                      0=>'About-Us',
                      1=>'Terms-And-Conditions',
                      2=>'Return-And-Exchange',
                      3=>'Privacy-Policy',
                      4=>'Contact-Us',
                      5=>'Warranty-And-Repairs',
                      6=>'Shipping',
                      7=>'Faq',
                      8=>'Gemstone-Guide',
                      9=>'Diamond-Guide',
                      10=>'Precious-Metal-Guide',
                      11=>'Jewellery-Care',
                      12=>'Ring-Size-Guide',
                      13=>'Bespoke',
                      14=>'Bangle-Size-Guide',
                      15=>'Craftsmanship',
                      16=>'Packaging',
                      17=>'OurPromise',
                      18=>'OurStory',
                      19=>'Responsible-Fashion',
                      20=>'Concierge-Services'
                     
                      
                  );
            $resultArr = array_merge($arr,$res2);

          //  echo "<pre>";print_r($resultArr);die;

            foreach($resultArr as $ky=>$vl)
            {
              $data .= '<url>';
              $data .= '<loc>';
              $data .= $url.$vl;
              $data .= '</loc>';
              $data .= '<changefreq>weekly</changefreq>';
              $data .= '<priority>1.0</priority>';
              $data .= '</url>';
              $data .= "\n";

            }
        $data .= '</urlset>';
        $filename = WEBROOT."generalUrl.xml";
        $myfile = fopen($filename, "w") or die("Unable to open file");
        fwrite($myfile, $data);
        fclose($myfile);
        echo "Success";
    }

    public function subUrls($res)
    {
      
        $jewel = $res['root'];
        unset($jewel[1]);
        unset($jewel[2]);
        $i = 0;
        foreach($jewel as $key => $val)
        {
          $dname = preg_replace('/[^a-zA-Z0-9]+/', ' ', $val['cat_name']);
          $dname= trim(preg_replace('/\s\s+/', ' ', $dname));
          $dname=str_replace(' ','-',$dname);
          $dname = ereg_replace("[ \t\n\r]+", " ", $dname); 
    
          $link[$i] =$dname.'/pid-'.$val['catid'];  
          $i++;
          foreach($val['subcat'] as $ky => $vl)
          {
            $cname = preg_replace('/[^a-zA-Z0-9]+/', ' ', $vl['cat_name']);
            $cname = ereg_replace("[ \t\n\r]+", " ", $cname);
       
            $link[$i] = $cname.'/pid-'.$vl['catid'];
            $i++;
          }

        }
     
        return $link;


    }
      
//    public function createurl ($params)
//    {
//      $sql="SELECT
//		  productid AS pid,
//		  jewelleryType,
//		  product_name,
//		  certificate,
//		  (SELECT GROUP_CONCAT(id ORDER By id DESC) FROM tbl_product_metal_purity_mapping WHERE productid=pid ORDER BY id DESC) AS metalid,
//		  (SELECT GROUP_CONCAT(dname) FROM tbl_metal_purity_master WHERE id IN (metalid)) AS metal
//	    FROM
//		  tbl_product_master
//	    WHERE 
//		  active_flag=1";
//      $res=  $this->query($sql);
//      if($res)
//      { 
//          $datasitemap = '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
//       
//            //$data = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
//             
//	while($row=  $this->fetchData($res))
//	{
//            $data = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
//	  //$url="https://www.jzeva.com/";
//            $url=DOMAIN;
//	  
//          $pname=  ucwords($row['product_name']);
//           $arr['product_name']= trim(preg_replace('/\s\s+/', ' ', $pname));
//	  $arr['pid']=$row['pid'];
//	 
//	  if($row['jewelleryType'] === '1')
//		$arr['jewelleryType'] ='Gold';
//	  else  if($row['jewelleryType'] === '2')
//		$arr['jewelleryType'] ='Plain Gold';
//	  else  if($row['jewelleryType'] === '3')
//		$arr['jewelleryType'] ='Platinum';
//     
//          $url.='Product-Details/'. str_replace(' ','-',$arr['product_name']);
//	  $url.=''.str_replace(' ','-',$arr['metal']);
//	  $url.='-'. str_replace(' ','-',$arr['jewelleryType']);
//          $url.='/pid-'. str_replace(' ','-',$arr['pid']);
//	 $arr['url']=$url;
//       
//	//  $url.='-'. str_replace(' ','_',$arr['certificate']);
//	//echo "<pre>";print_r($url);die;
//	   $reslt[]=$arr;
//	}
//	$err=array('error_code'=>0,'err_msg'=>'Data fetched successfully');
//      }
//      else
//      {
//	$reslt=array();
//	$err=array('error_code'=>1, 'err_msg'=>'error in fetching data');
//      }
//      $result=array('result'=>$reslt,'error'=>$err);
//      return $result; 
//    }
  }
?>
