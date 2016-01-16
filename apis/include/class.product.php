<?php

include_once APICLUDE.'common/db.class.php';

class product extends DB
{
    function __construct($db) {
        parent::DB($db);
    }
    
    
    private function generateproductId()
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
        
        $pid=$this->generateproductId();
        $params=  array('catid'=>'1,2,3,4,5','userid'=>'55');
        
//        echo "<pre>";
//        print_r($params);
//        echo "</pre>";
        
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
        $generaldetails= array('productid' =>$pid,'product_code'=>$pcode,'vendorid' =>'1','product_name' =>'18k ring golden','product_seo_name' =>'18K Gold Office Wear Ring','product_weight' =>5.5,'diamond_setting' =>'prong','metal_weight' =>4,'making_charges' =>12500.56,'procurement_cost' =>11000.52,'margin' =>5,'measurement' =>'10X50','certificate' =>'SGL','has_diamond' =>1,'has_solitaire' =>1,'has_uncut' =>1,'has_gemstone' =>1,'createdon' =>'now()','updatedby' =>$userid,'size'=>$sizeArray);
        
        foreach($generaldetails['size'] as $key=>$qty){
            
            
            $sid=$this->getSizeIdByValue($key);
            $sparams=array('productid'=>$params['productid'],'size_id'=>$sid,'updatedby' =>$params['updatedby'],'quantity'=>$qty);
            $this->addProductSizeMApping($sparams);
            
        }
        
        
        $sql="INSERT INTO "
                . "tbl_product_master "
                        . "(productid,"
                        . "product_code,"
                        . "vendorid,"
                        . "product_name"
                        . ",product_seo_name"
                        . ",product_weight"
                        . ",diamond_setting"
                        . ",metal_weight"
                        . ",making_charges"
                        . ",procurement_cost"
                        . ",margin"
                        . ",measurement"
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
                                . ",".$params['product_weight'].""
                                . ",'".$params['diamond_setting']."'"
                                . ",".$params['metal_weight'].""
                                . ",".$params['making_charges'].""
                                . ",".$params['procurement_cost'].""
                                . ",".$params['margin'].""
                                . ",'".$params['measurement']."'"
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
    
    
    
    
}


?>