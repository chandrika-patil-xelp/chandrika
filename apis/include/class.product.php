<?php

include_once APICLUDE.'common/db.class.php';

class product extends DB
{
    function __construct($db) {
        parent::DB($db);
    }
    
    
    private function generateId()
    {
        $curdate = date('YmdHis');
        $rNo = mt_rand(11, 99);

        $genId = $rNo . $curdate;
        return $genId;
    }
    
    private function generateProductCode()
    {
        $pcode="JZEVA0525604585";
        return $pcode;
        
    }
    
    public function addProduct()
    {
        
        $pid=$this->generateId();
        $params=  array('catid'=>'1,2,3,4,5','userid'=>'55');
        
        $catids=  explode(",", $params['catid']);
        $userid=$params['userid'];
        
        
        #ADDING CATEGORY MAPPING FOR CURRENT PRODUCT
        foreach($catids as $val)
        {
            $tmpparams=  array('catid'=>$val,'userid'=>$userid,'pid'=>$pid);
            #$this->addCatProductMapping($tmpparams);
        }
        
        #ADDING GENERAL DETAILS FOR CURRENT PRODUCT
        $pcode=$this->generateProductCode();
        
        $generaldetails= array('productid' =>$pid,'product_code'=>$pcode,'vendorid' =>'1','product_name' =>'18k ring golden','product_seo_name' =>'18K Gold Office Wear Ring','product_weight' =>5.5,'diamond_setting' =>'prong','metal_weight' =>4,'making_charges' =>12500.56,'procurement_cost' =>11000.52,'margin' =>5,'measurement' =>'10X50','certificate' =>'SGL','has_diamond' =>1,'has_solitaire' =>1,'has_uncut' =>1,'has_gemstone' =>1,'createdon' =>'now()','updatedby' =>$userid);
        
        $this->addProductGeneralDetails($generaldetails);
        
    }
    
    
    
    public function addCatProductMapping($params)
    {
        
        $sql="INSERT INTO tbl_category_product_mapping (catid,productid,createdon,updatedby) VALUES (".$params['catid'].",".$params['pid'].",now(),".$params['userid'].")";
        $res=$this->query($sql);
        $result=array();
        if($res)
        {
            $err=array('err_code'=>0,'err_msg'=>'Data inserted successfully');
        }else{
            $err=array('err_code'=>1,'err_msg'=>'Error in inserting');
        }
        $results=array('result'=>$result,'error'=>$err);
        return $results;
    }
    
    
    public function addProductGeneralDetails($params)
    {
        
        $sizeArray=array('4'=>20,'4.5'=>22,'6'=>5,'7'=>2,'8'=>3,'9'=>1,'10'=>7,);
        #$metalPurityArray=array('9 carat','14 carat','18 carat','22 carat');
        $metalPurityArray=array('24 carat');
        
        $metalColorArray=array('white');
        
        #$generaldetails= array('productid' =>$pid,'product_code'=>$pcode,'vendorid' =>'1','product_name' =>'18k ring golden','product_seo_name' =>'18K Gold Office Wear Ring','product_weight' =>5.5,'diamond_setting' =>'prong','metal_weight' =>4,'making_charges' =>12500.56,'procurement_cost' =>11000.52,'margin' =>5,'measurement' =>'10X50','certificate' =>'SGL','has_diamond' =>1,'has_solitaire' =>1,'has_uncut' =>1,'has_gemstone' =>1,'createdon' =>'now()','updatedby' =>$userid,'size'=>$sizeArray,'metalPurity'=>$metalPurityArray);
        $generaldetails= array('productid' =>$pid,'product_code'=>$pcode,'vendorid' =>'1','product_name' =>'18k ring golden',
            'product_seo_name' =>'18K Gold Office Wear Ring','gender'=>0,'product_weight' =>5.5,'diamond_setting' =>'prong','metal_weight' =>4,
            'making_charges' =>12500.56,'procurement_cost' =>11000.52,'margin' =>5,'measurement' =>'10X50','certificate' =>'SGL',
            'has_diamond' =>1,'has_solitaire' =>1,'has_uncut' =>1,'has_gemstone' =>1,'createdon' =>'now()',
            'updatedby' =>$userid,'size'=>$sizeArray,'metalPurity'=>$metalPurityArray,'metalColor'=>$metalColorArray);
        
        foreach($generaldetails['size'] as $key=>$qty)
        {
            $sid=$this->getSizeIdByValue($key);
            $sparams=array('productid'=>$params['productid'],'size_id'=>$sid,'updatedby' =>$params['updatedby'],'quantity'=>$qty);
            #$this->addProductSizeMApping($sparams);
        }
        
        # Product Metal Purity Mapping
        $mprLen=sizeof($metalPurityArray);
        
        if($mprLen>1)
        {
            $customise_purity=0;
        }
        else
        {
            $customise_purity=1;
        }
        
        foreach($generaldetails['metalPurity'] as $key=>$value)
        {
            $purityid=$this->getMetalPurityIdByValue($value);
            $metalPurityparams=array('productid'=>$params['productid'],'purityid'=>$purityid,'updatedby' =>$params['updatedby']);
            #$this->addProductMetalPurityMapping($metalPurityparams);
        }
        
        
        # Product Metal Color Mapping
        $mclrLen=sizeof($metalColorArray);
        if($mclrLen>1)
        {
            $customise_color=0;
        }
        else
        {
            $customise_color=1;
        }
        
        
        foreach($generaldetails['metalColor'] as $key=>$value)
        {
            $colorid=$this->getMetalColorIdByValue($value);
            $metalColorparams=array('productid'=>$params['productid'],'colorid'=>$colorid,'updatedby' =>$params['updatedby']);
            #$this->addProductMetalColorMapping($metalColorparams);
        }
        
        #Adding Solitaire To Product
        /*
        if($params['has_solitaire'])
        {
            $solitaire1= array('shape'=>'Round','color'=>'D','clarity'=>'IF','cut'=>'very good','symmetry'=>'very good','polish'=>'good','fluorescence'=>'none','carat'=>0.5,'price_per_carat'=>5005.25,'table'=>'56','crown_angle'=>'25','girdle'=>'25','updatedby' =>$params['updatedby']);
            $solitaire2= array('shape'=>'Round','color'=>'E','clarity'=>'VVS1','cut'=>'very good','symmetry'=>'good','polish'=>'good','fluorescence'=>'none','carat'=>0.6,'price_per_carat'=>5005.25,'table'=>'56','crown_angle'=>'25','girdle'=>'25','updatedby' =>$params['updatedby']);
            $solitaire3= array('shape'=>'Round','color'=>'D','clarity'=>'IF','cut'=>'very good','symmetry'=>'good','polish'=>'good','fluorescence'=>'none','carat'=>0.7,'price_per_carat'=>5005.25,'table'=>'56','crown_angle'=>'25','girdle'=>'25','updatedby' =>$params['updatedby']);
            $solitaire4= array('shape'=>'Round','color'=>'F','clarity'=>'VVS2','cut'=>'very good','symmetry'=>'fair','polish'=>'good','fluorescence'=>'none','carat'=>0.8,'price_per_carat'=>5005.25,'table'=>'56','crown_angle'=>'25','girdle'=>'25','updatedby' =>$params['updatedby']);
            $solitaire5= array('shape'=>'Round','color'=>'D','clarity'=>'VS2','cut'=>'very good','symmetry'=>'very good','polish'=>'good','fluorescence'=>'none','carat'=>0.9,'price_per_carat'=>5005.25,'table'=>'56','crown_angle'=>'25','girdle'=>'25','updatedby' =>$params['updatedby']);
            
            $solitaires= array('solitaire' => array($solitaire1,$solitaire2,$solitaire3,$solitaire4,$solitaire5));
            
            foreach ($solitaires as $key=>$val)
            {
                foreach ($val as $key1=>$val1)
                {   
                    $val1['productid']=$params['productid'];
                    $val1['updatedby']=$params['updatedby'];
                    $this->addSolitaire($val1);
                }
            }
        }
        
        
        #Adding Diamond To Product
            $d1Quality=array('VVS - GH');
            $diamond1 = array('shape'=>'Pear','quality'=>$d1Quality,'carat'=>5.5,'total_no'=>5);


            $d2Quality=array('VVS - IF','VVS - EF','VVS - GH');
            $diamond2 = array('shape'=>'oval','quality'=>$d2Quality,'carat'=>2.5,'total_no'=>5);

            $diamonds= array('diamonds' => array($diamond1,$diamond2));

            foreach ($diamonds as $key=>$val)
            {
                foreach ($val as $key1=>$val1)
                {   
                    $val1['productid']=$params['productid'];
                    $val1['updatedby']=$params['updatedby'];
                    $this->addDiamond($val1);
                }
            }
        
        
        */
        
        #Adding Uncut Diamond To Product
        
            $uncut1= array('color'=>'D','quality'=>'IF','carat'=>0.1,'price_per_carat'=>1000.25,'updatedby' =>$params['updatedby'],'total_no'=>1);
            $uncut2= array('color'=>'E','quality'=>'GH','carat'=>0.2,'price_per_carat'=>1015.25,'updatedby' =>$params['updatedby'],'total_no'=>2);
            $uncut3= array('color'=>'F','quality'=>'JK','carat'=>0.3,'price_per_carat'=>1025.25,'updatedby' =>$params['updatedby'],'total_no'=>3);
            
            $uncut= array('uncut' => array($uncut1,$uncut2,$uncut3));
            
            
            foreach ($uncut as $key=>$val)
            {
                foreach ($val as $key1=>$val1)
                {   
                    $val1['productid']=$params['productid'];
                    $val1['updatedby']=$params['updatedby'];
                    #$this->addUncutDiamond($val1);
                }
            }
        
        #Adding Gemstone To Product
            
           $gemstone1 = array('gvalue'=>1,'total_no'=>1,'carat'=>1.2,'price_per_carat'=>1000);
           $gemstone2 = array('gvalue'=>2,'total_no'=>2,'carat'=>2.2,'price_per_carat'=>1100);
           $gemstone3 = array('gvalue'=>3,'total_no'=>3,'carat'=>3.2,'price_per_carat'=>1200);
           $gemstone4 = array('gvalue'=>4,'total_no'=>4,'carat'=>4.2,'price_per_carat'=>1300);
           
           $gemstone = array('gemstone' => array($gemstone1,$gemstone2,$gemstone3,$gemstone4));
           
           foreach ($gemstone as $key=>$val)
            {
                foreach ($val as $key1=>$val1)
                {   
                    $val1['productid']=$params['productid'];
                    $val1['updatedby']=$params['updatedby'];
                    $this->addGemstone($val1);
                }
            }
            
        
        
        $sql="INSERT INTO "
                . "tbl_product_master "
                        . "(productid,"
                        . "product_code,"
                        . "vendorid,"
                        . "product_name"
                        . ",product_seo_name"
                        . ",gender"
                        . ",product_weight"
                        . ",diamond_setting"
                        . ",metal_weight"
                        . ",making_charges"
                        . ",procurement_cost"
                        . ",margin"
                        . ",measurement"
                        . ",customise_purity"
                        . ",customise_color"
                        . ",certificate"
                        . ",has_diamond"
                        . ",has_solitaire"
                        . ",has_uncut"
                        . ",has_gemstone"
                        . ",createdon"
                        . ",updatedby)"
                                . " VALUES "
                                . "(".$params['productid'].","
                                . "'".$params['product_code']."'"
                                . ",".$params['vendorid'].""
                                . ",'".$params['product_name']."'"
                                . ",'".$params['product_seo_name']."'"
                                . ",'".$params['gender']."'"
                                . ",".$params['product_weight'].""
                                . ",'".$params['diamond_setting']."'"
                                . ",".$params['metal_weight'].""
                                . ",".$params['making_charges'].""
                                . ",".$params['procurement_cost'].""
                                . ",".$params['margin'].""
                                . ",'".$params['measurement']."'"
                                . ",".$customise_purity.""
                                . ",".$customise_color.""
                                . ",'".$params['certificate']."'"
                                . ",".$params['has_diamond'].""
                                . ",".$params['has_solitaire'].""
                                . ",".$params['has_uncut'].""
                                . ",".$params['has_gemstone'].""
                                . ",now()"
                                . ",".$params['updatedby'].")";
        
        
        $res=$this->query($sql);
        $result=array();
        if($res)
        {
            $err=array('err_code'=>0,'err_msg'=>'Data inserted successfully');
        }else{
            $err=array('err_code'=>1,'err_msg'=>'Error in inserting');
        }
        $results=array('result'=>$result,'error'=>$err);
        return $results;       
    
    }
    
    
    public function addProductSizeMApping($params)
    {
        
        $sql="INSERT INTO tbl_product_size_mapping (productid,size_id,quantity,createdon,updatedby) VALUES "
                . "(".$params['productid'].","
                . "".$params['size_id'].","
                . "".$params['quantity'].","
                . "now()"
                . ",".$params['updatedby'].")";
        
        $res=$this->query($sql);
        $result=array();
        if($res)
        {
            $err=array('err_code'=>0,'err_msg'=>'Data inserted successfully');
        }else{
            $err=array('err_code'=>1,'err_msg'=>'Error in inserting');
        }
        $results=array('result'=>$result,'error'=>$err);
        return $results;
        
    }
    
    
    public function getSizeIdByValue($size)
    {
        $sql="SELECT id FROM tbl_size_master WHERE size_value=".$size;
        $res=$this->query($sql);
        $result=array();
        
        if($res)
        {
            $row=$this->fetchData($res);
            $sid=$row['id'];
            return $sid;
        }
    }
    
    
    public function addProductMetalPurityMapping($params)
    {
        $sql="INSERT INTO tbl_product_metal_purity_mapping (productid,id,createdon,updatedby) VALUES"
                . "(".$params['productid'].","
                . "".$params['purityid'].","
                . "now()"
                . ",".$params['updatedby'].")";
        
        
        $res=$this->query($sql);
        $result=array();
        if($res)
        {
            $err=array('err_code'=>0,'err_msg'=>'Data inserted successfully');
        }else{
            $err=array('err_code'=>1,'err_msg'=>'Error in inserting');
        }
        $results=array('result'=>$result,'error'=>$err);
        return $results;
        
    }
    
    
    
    
    public function getMetalPurityIdByValue($value)
    {
        $sql="SELECT id FROM tbl_metal_purity_master WHERE dname='".strtolower($value)."'";
        $res=$this->query($sql);
        $result=array();
        
        if($res)
        {
            $row=$this->fetchData($res);
            $purityid=$row['id'];
            return $purityid;
        }
    }
    
    
    public function addProductMetalColorMapping($params)
    {
        $sql="INSERT INTO tbl_product_metal_color_mapping (productid,id,createdon,updatedby) VALUES"
                . "(".$params['productid'].","
                . "".$params['colorid'].","
                . "now()"
                . ",".$params['updatedby'].")";
        
        
        $res=$this->query($sql);
        $result=array();
        if($res)
        {
            $err=array('err_code'=>0,'err_msg'=>'Data inserted successfully');
        }else{
            $err=array('err_code'=>1,'err_msg'=>'Error in inserting');
        }
        $results=array('result'=>$result,'error'=>$err);
        return $results;
        
    }
    
    
    
    public function getMetalColorIdByValue($value)
    {
        $sql="SELECT id FROM tbl_metal_color_master WHERE dname='".strtolower($value)."'";
        $res=$this->query($sql);
        $result=array();
        
        if($res)
        {
            $row=$this->fetchData($res);
            $colorid=$row['id'];
            return $colorid;
        }
    }
    
    
    
    public function getVendorList()
    {
        $sql="SELECT vendorid,name,city,mobile,email,lng,lat FROM  tbl_vendor_master";
        $res=$this->query($sql);
        $result=array();
        
        if($res)
        {
            while($row=$this->fetchData($res))
            {
                $reslt['vid']       = $row['vendorid'];
                $reslt['name']      = $row['name'];
                $reslt['city']      = $row['city'];
                $reslt['email']     = $row['email'];
                $reslt['landline']  = $row['landline'];
                $reslt['mobile']    = $row['mobile'];
                $reslt['lng']       = $row['lng'];
                $reslt['lat']       = $row['lat'];
                $result[]=$reslt;
                    
            }
            $err=array('err_code'=>0,'err_msg'=>'Data fetched successfully');
        }
        else
        {
            $err=array('err_code'=>1,'err_msg'=>'Error in inserting');
        }
        $results=array('result'=>$result,'error'=>$err);
        return $results;        
    }
    
    
    public function getVendorDetailsById($vid)
    {
        $sql="SELECT vendorid,name,city,mobile,email,lng,lat FROM  tbl_vendor_master WHERE vendorid='".$vid."'";
        $res=$this->query($sql);
        $result=array();
        
        if($res)
        {
            $row=$this->fetchData($res);
            $reslt['vid']       = $row['vendorid'];
            $reslt['name']      = $row['name'];
            $reslt['city']      = $row['city'];
            $reslt['email']     = $row['email'];
            $reslt['landline']  = $row['landline'];
            $reslt['mobile']    = $row['mobile'];
            $reslt['lng']       = $row['lng'];
            $reslt['lat']       = $row['lat'];
            $result[]=$reslt;
            $err=array('err_code'=>0,'err_msg'=>'Data fetched successfully');
        }
        else
        {
            $err=array('err_code'=>1,'err_msg'=>'Error in inserting');
        }
        $results=array('result'=>$result,'error'=>$err);
        return $results;        
    }
    
    public function getVendorDetailsByName($name)
    {
        $sql="SELECT vendorid,name,city,mobile,email,lng,lat FROM  tbl_vendor_master WHERE name='".$name."'";
        $res=$this->query($sql);
        $result=array();
        
        if($res)
        {
            $row=$this->fetchData($res);
            $reslt['vid']       = $row['vendorid'];
            $reslt['name']      = $row['name'];
            $reslt['city']      = $row['city'];
            $reslt['email']     = $row['email'];
            $reslt['landline']  = $row['landline'];
            $reslt['mobile']    = $row['mobile'];
            $reslt['lng']       = $row['lng'];
            $reslt['lat']       = $row['lat'];
            $result[]=$reslt;
            $err=array('err_code'=>0,'err_msg'=>'Data fetched successfully');
        }
        else
        {
            $err=array('err_code'=>1,'err_msg'=>'Error in inserting');
        }
        $results=array('result'=>$result,'error'=>$err);
        return $results;        
        
    }
    
    
    public function addSolitaire($params)
    {
        $solid=$this->generateId();
        $params['solitaire_id']=$solid;
        
        $sql="INSERT INTO tbl_product_solitaire_mapping (productid,solitaire_id,shape,color,clarity,cut,symmetry,polish,fluorescence,carat,price_per_carat,table_no,crown_angle,girdle,createdon,updatedby) Values"
                . "("
                . "".$params['productid'].","
                . "".$params['solitaire_id'].","
                . "'".$params['shape']."',"
                . "'".$params['color']."',"
                . "'".$params['clarity']."',"
                . "'".$params['cut']."',"
                . "'".$params['symmetry']."',"
                . "'".$params['polish']."',"
                . "'".$params['fluorescence']."',"
                . "".$params['carat'].","
                . "".$params['price_per_carat'].","
                . "'".$params['table']."',"
                . "'".$params['crown_angle']."',"
                . "'".$params['girdle']."',"
                ."now(),"
                . "".$params['updatedby'].""
                . ")";
 

        $res=  $this->query($sql);
        $result=array();
        if($res)
        {
            $err=array('err_code'=>0,'err_msg'=>'Data inserted successfully');
        }else{
            $err=array('err_code'=>1,'err_msg'=>'Error in inserting');
        }
        $results=array('result'=>$result,'error'=>$err);
        return $results;
        
        
    }
    
    
    
    public function addDiamond($params)
    {
        $dmid=$this->generateId();
        $params['diamond_id']=$dmid;
    
        echo "<pre>";
        //print_r($params);
        echo "</pre>";
        
        
        $this->addPrdDiamondMapping($params);
        
        foreach($params['quality'] as $key =>$val)
        {
            
            $qlid=$this->getDiamondQualityIdByValue($val);
            $tmparams = array('diamond_id'=>$params['diamond_id'],'id'=>$qlid,'updatedby'=>$params['updatedby']);
            $this->addDiamondQualityMapping($tmparams);
            
        }
                
    }
    
    public function addPrdDiamondMapping($params)
    {
        
        $sql="INSERT INTO "
                . "tbl_product_diamond_mapping "
                    . "(productid,diamond_id,shape,carat,total_no,createdon,updatedby) "
                        . "VALUES"
                            . "("
                            . "".$params['productid'].","
                            . "".$params['diamond_id'].","
                            . "'".$params['shape']."',"
                            . "".$params['carat'].","
                            . "".$params['total_no'].","
                            . "now()"
                            . ",".$params['updatedby'].")";
        
        
        $res=$this->query($sql);
        $result=array();
        if($res)
        {
            $err=array('err_code'=>0,'err_msg'=>'Data inserted successfully');
        }else{
            $err=array('err_code'=>1,'err_msg'=>'Error in inserting');
        }
        $results=array('result'=>$result,'error'=>$err);
        return $results;
        
    }
    
    
    public function addDiamondQualityMapping($params)
    {
        $sql="INSERT INTO "
                . "tbl_diamond_quality_mapping "
                    . "(diamond_id,id,createdon,updatedby) "
                        . "VALUES "
                            . "("
                            . "".$params['diamond_id'].","
                            . "".$params['id'].","
                            . "now()"
                            . ",".$params['updatedby'].")";
        
        $res=$this->query($sql);
        $result=array();
        if($res)
        {
            $err=array('err_code'=>0,'err_msg'=>'Data inserted successfully');
        }else{
            $err=array('err_code'=>1,'err_msg'=>'Error in inserting');
        }
        $results=array('result'=>$result,'error'=>$err);
        return $results;
    }
    
    
    
    
    
    
    public function getDiamondQualityIdByValue($value)
    {
        $sql="SELECT id FROM tbl_diamond_quality_master WHERE dname='".strtolower($value)."'";
        $res=$this->query($sql);
        $result=array();
        
        if($res)
        {
            $row=$this->fetchData($res);
            $qid=$row['id'];
            return $qid;
        }
    }
    
    
    
    public function addUncutDiamond($params)
    {
        $uncutid=$this->generateId();
        $params['uncut_id']=$uncutid;
        
        $sql="INSERT INTO tbl_product_uncut_mapping (productid,uncut_id,color,quality,total_no,carat,price_per_carat,createdon,updatedby) VALUES"
                . "("
                . "".$params['productid'].","
                . "".$params['uncut_id'].","
                . "'".$params['color']."',"
                . "'".$params['quality']."',"
                . "".$params['total_no'].","
                . "".$params['carat'].","
                . "".$params['price_per_carat'].","
                . "now()"
                . ",".$params['updatedby'].")";
        
        $res=$this->query($sql);
        $result=array();
        if($res)
        {
            $err=array('err_code'=>0,'err_msg'=>'Data inserted successfully');
        }else{
            $err=array('err_code'=>1,'err_msg'=>'Error in inserting');
        }
        $results=array('result'=>$result,'error'=>$err);
        return $results;
    }
    
    
    public function addGemstone($params)
    {
        $garr=$this->getGemstoneDetailsById($params['gvalue']);
        $gname=$garr['result']['name'];
        $gemstoneid=$this->generateId();
        $params['gemstone_id']=$gemstoneid;
        $params['gemstone_name']=$gname;
        
        
        
        $sql="INSERT INTO tbl_product_gemstone_mapping (productid,gemstone_id,gemstone_name,total_no,carat,price_per_carat,createdon,updatedby) VALUES"
                . "("
                . "".$params['productid'].","
                . "".$params['gemstone_id'].","
                . "'".$params['gemstone_name']."',"
                . "".$params['total_no'].","
                . "".$params['carat'].","
                . "".$params['price_per_carat'].","
                . "now()"
                . ",".$params['updatedby'].")";
        
        $res=$this->query($sql);
        $result=array();
        if($res)
        {
            $err=array('err_code'=>0,'err_msg'=>'Data inserted successfully');
        }else{
            $err=array('err_code'=>1,'err_msg'=>'Error in inserting');
        }
        $results=array('result'=>$result,'error'=>$err);
        return $results;
    }
    
    
    public function getGemstoneDetailsById($gid)
    {
        
        $sql="SELECT id,gemstone_name,description FROM tbl_gemstone_master WHERE id=" .$gid;
        $res= $this->query($sql);
        $row= $this->fetchData($res);
        
        $result=array();
        
        if($res)
        {
            $reslt['id']=$row['id'];
            $reslt['name']=$row['gemstone_name'];
            $reslt['desc']=$row['description'];
            $result=$reslt;
            $err=array('err_code'=>0,'err_msg'=>'Data fetched successfully');
        }
        else
        {
            $err=array('err_code'=>1,'err_msg'=>'Error in inserting');
        }
        $results=array('result'=>$result,'error'=>$err);
        return $results;   
        
    }
    
    
}


?>



