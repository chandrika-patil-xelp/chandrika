<?php

include_once APICLUDE . 'common/db.class.php';

class product extends DB {

    function __construct($db) {
        parent::DB($db);
    }

    private function generateId() {
        $curdate = date('YmdHis');
        $rNo = mt_rand(11, 99);

        $genId = $rNo . $curdate;
        return $genId;
    }

    private function generateProductCode() {
        $pcode = "JZEVA0525604585";
        return $pcode;
    }

    public function addProduct($params) {
        $params= (json_decode($params[0],1));
        
       
        if(!$params['productid'])
        {
            $pid = $this->generateId();
            $params['productid']=$pid;
            $pcode = $this->generateProductCode();
            $params['product_code']=$pcode;
        }       
        
        $userid = $params['userid'];
        
        #echo "<pre>";print_r($params);  echo "</pre>";die;
        
        
        #ADDING CATEGORY MAPPING FOR CURRENT PRODUCT
        
        $catids = explode(",", $params['catid']);
        $tmpcatparams = array('catid' => $params['catid'], 'userid' => $userid, 'pid' => $pid);
        $catres = $this->addCatProductMapping($tmpcatparams);
        if ($catres['error']['err_code'] == 0) 
        {

            $sizeparams = array('productid' => $params['productid'], 'updatedby' => $userid, 'sizes' => $params['sizes']);
            $sizeres = $this->addProductSizeMApping($sizeparams);

            if ($sizeres['error']['err_code'] == '0') 
            {
                
               
                
                #Product Metal Purity Mapping
                $mprLen = sizeof($params['mpurity']);

                if ($mprLen > 1) {
                    $customise_purity = 0;
                } else {
                    $customise_purity = 1;
                }
                $metalPurityparams = array('productid' => $params['productid'], 'updatedby' => $userid, 'metalpurity' => $params['mpurity']);
                $mpurityres = $this->addProductMetalPurityMapping($metalPurityparams);

                if ($mpurityres['error']['err_code'] == 0) {
                    #Product Metal Color Mapping
                    $mclrLen = sizeof($params['metalcolor']);
                    
                   
                    
                    if ($mclrLen > 1) {
                        $customise_color = 0;
                    } else {
                        $customise_color = 1;
                    }

                    $metalColorparams = array('productid' => $params['productid'], 'updatedby' => $userid, 'metalcolors' => $params['metalcolor']);
                    $mcolorres = $this->addProductMetalColorMapping($metalColorparams);

                    if ($mcolorres['error']['err_code'] == 0) {

                        #Adding Solitaire To Product
                        if ($params['has_solitaire']) {

                            $solitairesparams = array('productid' => $params['productid'], 'updatedby' => $userid, 'solitaires' => $params['solitaires']);
                            $solres = $this->addSolitaire($solitairesparams);

                            if ($solres['error']['err_code'] == "1") {
                                $result = array();
                                $err = array('err_code' => 1, 'err_msg' => 'Error in adding solitaire');
                                $results = array('result' => $result, 'error' => $err);
                                return $results;
                            }
                        }


                        #Adding Diamond To Product
                        if ($params['has_diamond']) {

                            $diamondresparams = array('productid' => $params['productid'], 'updatedby' => $userid, 'diamonds' => $params['diamonds']);
                            $diamondres = $this->addDiamond($diamondresparams);

                            if ($diamondres['error']['err_code'] == "1") {
                                $result = array();
                                $err = array('err_code' => 1, 'err_msg' => 'Error in adding diamond');
                                $results = array('result' => $result, 'error' => $err);
                                return $results;
                            }
                        }


                        #Adding Uncut Diamond To Product
                        if ($params['has_uncut']) {

                            $uncutparams = array('productid' => $params['productid'], 'updatedby' => $userid, 'uncut' => $params['uncut']);
                            $uncutdmdres = $this->addUncutDiamond($uncutparams);

                            if ($uncutdmdres['error']['err_code'] == "1") {
                                $result = array();
                                $err = array('err_code' => 1, 'err_msg' => 'Error in adding uncut diamond');
                                $results = array('result' => $result, 'error' => $err);
                                return $results;
                            }
                        }


                        #Adding Gemstone To Product
                        if ($params['has_gemstone']) {

                            $gemstoneparams = array('productid' => $params['productid'], 'updatedby' => $userid, 'gemstone' => $params['gemstone']);
                            $gemres = $this->addGemstone($gemstoneparams);


                            if ($gemres['error']['err_code'] == "1") {
                                $result = array();
                                $err = array('err_code' => 1, 'err_msg' => 'Error in adding gemstone to product');
                                $results = array('result' => $result, 'error' => $err);
                                return $results;
                            }
                        }


                        #Adding General Product Details
                        
                        $genDetails = array('productid' => $params['productid'], 'product_code' => $params['product_code'], 'customise_purity' => $customise_purity, 'customise_color' => $customise_color, 'has_diamond' => $params['has_diamond'], 'has_solitaire' => $params['has_solitaire'], 'has_uncut' => $params['has_uncut'], 'has_gemstone' => $params['has_gemstone'], 'updatedby' => $userid, 'details' => $params['details']);
                        $renres = $this->addProductGeneralDetails($genDetails);

                        if ($renres['error']['err_code'] == "1") {
                            $result = array();
                            $err = array('err_code' => 1, 'err_msg' => 'Error in adding general details of product');
                            $results = array('result' => $result, 'error' => $err);
                            return $results;
                        }
                    }
                    else 
                    {
                        $result = array();
                        $err = array('err_code' => 1, 'err_msg' => 'Error in adding product metal color');
                        $results = array('result' => $result, 'error' => $err);
                        return $results;
                    }
                } 
                else 
                {
                    $result = array();
                    $err = array('err_code' => 1, 'err_msg' => 'Error in adding product metal purity');
                    $results = array('result' => $result, 'error' => $err);
                    return $results;
                }
            } 
            else
            {
                $result = array();
                $err = array('err_code' => 1, 'err_msg' => 'Error in adding product sizes');
                $results = array('result' => $result, 'error' => $err);
                return $results;
            }
        } 
        else
        {
            $result = array();
            $err = array('err_code' => 1, 'err_msg' => 'Error in adding category');
            $results = array('result' => $result, 'error' => $err);
            return $results;
        }
        
        
        $result = array('product id' =>$params['productid']);
        $err = array('err_code' => 0, 'err_msg' => 'Product Added Successfully');
        $results = array('result' => $result, 'error' => $err);
        return $results;
        
    }

    public function addCatProductMapping($params) {

        $catids = explode(",", $params['catid']);
        $sql = "INSERT INTO tbl_category_product_mapping (catid,productid,createdon,updatedby) VALUES ";
        foreach ($catids as $val) {
            $tmpparams = array('catid' => $val, 'userid' => $params['userid'], 'pid' => $params['pid']);
            $sql.="(" . $tmpparams['catid'] . "," . $tmpparams['pid'] . ",now()," . $tmpparams['userid'] . "),";
        }
        $sql = trim($sql, ",");

        $sql.=" ON DUPLICATE KEY UPDATE catid = VALUES(catid),updatedby=VALUES(updatedby)";
        $res = $this->query($sql);
        $result = array();
        if ($res) {
            $err = array('err_code' => 0, 'err_msg' => 'Data inserted successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function addProductGeneralDetails($params) {


       #echo "<pre>";        print_r($params);        echo "</pre>";    die;


        $sql = "INSERT INTO "
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
                . "(" . $params['productid'] . ","
                . "'" . $params['product_code'] . "'"
                . "," . $params['details']['vendorid'] . ""
                . ",'" . urldecode($params['details']['product_name']) . "'"
                . ",'" . urldecode($params['details']['product_seo_name']) . "'"
                . ",'" . $params['details']['gender'] . "'"
                . "," . $params['details']['product_weight'] . ""
                . ",'" . urldecode($params['details']['dmdSetting']) . "'"
                . "," . $params['details']['metal_weight'] . ""
                . "," . $params['details']['making_charges'] . ""
                . "," . $params['details']['procurement_cost'] . ""
                . "," . $params['details']['margin'] . ""
                . ",'" . $params['details']['measurement'] . "'"
                . "," . $params['customise_purity'] . ""
                . "," . $params['customise_color'] . ""
                . ",'" . $params['details']['certificate'] . "'"
                . "," . $params['has_diamond'] . ""
                . "," . $params['has_solitaire'] . ""
                . "," . $params['has_uncut'] . ""
                . "," . $params['has_gemstone'] . ""
                . ",now()"
                . "," . $params['updatedby'] . ")";


        $sql.=" ON DUPLICATE KEY UPDATE "
                . "product_code = VALUES(product_code),"
                . "vendorid = VALUES(vendorid),"
                . "product_name = VALUES(product_name),"
                . "product_seo_name = VALUES(product_seo_name),"
                . "gender = VALUES(gender),"
                . "product_weight = VALUES(product_weight),"
                . "diamond_setting = VALUES(diamond_setting),"
                . "metal_weight = VALUES(metal_weight),"
                . "making_charges = VALUES(making_charges),"
                . "procurement_cost = VALUES(procurement_cost),"
                . "margin = VALUES(margin),"
                . "measurement = VALUES(measurement),"
                . "customise_purity = VALUES(customise_purity),"
                . "customise_color = VALUES(customise_color),"
                . "certificate = VALUES(certificate),"
                . "has_diamond = VALUES(has_diamond),"
                . "has_solitaire = VALUES(has_solitaire),"
                . "has_uncut = VALUES(has_uncut),"
                . "has_gemstone = VALUES(has_gemstone),"
                . " updatedby=VALUES(updatedby)";
        $res = $this->query($sql);
        $result = array();
        if ($res) {
            $err = array('err_code' => 0, 'err_msg' => 'Data inserted successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function addProductSizeMApping($params) {

        $sql = "INSERT INTO tbl_product_size_mapping (productid,size_id,quantity,createdon,updatedby) VALUES ";
        foreach ($params['sizes'] as $key => $val) {
            
            foreach ($val as $key1 => $val1) 
            {
                $tmpparams = array('size_id' => $key1, 'updatedby' => $params['updatedby'], 'productid' => $params['productid'], 'quantity' => $val1);
                $sql.="(" . $tmpparams['productid'] . "," . $key1 . "," . $val1 . ",now()," . $tmpparams['updatedby'] . "),";
                  
            }
        }
        $sql = trim($sql, ",");
        $sql.=" ON DUPLICATE KEY UPDATE quantity = VALUES(quantity),updatedby=VALUES(updatedby)";

        
        $res = $this->query($sql);
        $result = array();
        if ($res) {
            $err = array('err_code' => 0, 'err_msg' => 'Data inserted successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function getSizeIdByValue($size) {
        $sql = "SELECT id FROM tbl_size_master WHERE size_value=" . $size;
        $res = $this->query($sql);
        $result = array();

        if ($res) {
            $row = $this->fetchData($res);
            $sid = $row['id'];
            return $sid;
        }
    }

    public function addProductMetalPurityMapping($params) {
        
        $sql = "INSERT INTO tbl_product_metal_purity_mapping (productid,id,createdon,updatedby) VALUES";

        foreach ($params['metalpurity'] as $key => $val) {

            #$purityid = $this->getMetalPurityIdByValue($val);
            $purityid =$val;
            $tmpparams = array('id' => $purityid, 'updatedby' => $params['updatedby'], 'productid' => $params['productid']);

            $sql.="(" . $tmpparams['productid'] . "," . $tmpparams['id'] . ",now()," . $tmpparams['updatedby'] . "),";
        }

        $sql = trim($sql, ",");
        $sql.=" ON DUPLICATE KEY UPDATE id = VALUES(id),updatedby=VALUES(updatedby)";


        $res = $this->query($sql);
        $result = array();
        if ($res) {
            $err = array('err_code' => 0, 'err_msg' => 'Data inserted successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function getMetalPurityIdByValue($value) {
        $sql = "SELECT id FROM tbl_metal_purity_master WHERE dname='" . strtolower($value) . "'";
        $res = $this->query($sql);
        $result = array();

        if ($res) {
            $row = $this->fetchData($res);
            $purityid = $row['id'];
            return $purityid;
        }
    }
    
    

    public function addProductMetalColorMapping($params) {

        $sql = "INSERT INTO tbl_product_metal_color_mapping (productid,id,createdon,updatedby) VALUES";

        foreach ($params['metalcolors']as $key => $val) {

            #$colorid = $this->getMetalColorIdByValue($val);
            $colorid = $val;
            $tmpparams = array('id' => $colorid, 'updatedby' => $params['updatedby'], 'productid' => $params['productid']);

            $sql.="(" . $tmpparams['productid'] . "," . $tmpparams['id'] . ",now()," . $tmpparams['updatedby'] . "),";
        }


        $sql = trim($sql, ",");
        $sql.=" ON DUPLICATE KEY UPDATE id = VALUES(id),updatedby=VALUES(updatedby)";

        $res = $this->query($sql);
        $result = array();
        if ($res) {
            $err = array('err_code' => 0, 'err_msg' => 'Data inserted successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function getMetalColorIdByValue($value) {
        $sql = "SELECT id FROM tbl_metal_color_master WHERE dname='" . strtolower($value) . "'";
        $res = $this->query($sql);
        $result = array();

        if ($res) {
            $row = $this->fetchData($res);
            $colorid = $row['id'];
            return $colorid;
        }
    }
    
    public function getMetalColorList() {
        $sql = "SELECT id,dname,dvalue FROM tbl_metal_color_master WHERE active_flag = 1";
        $res = $this->query($sql);
        $result = array();

        if($res)
        {
            while($row = $this->fetchData($res))
            {
                $reslt['id'] =$row['id'];
                $reslt['name'] = $row['dname'];
                $reslt['value'] = $row['dvalue']; 
                $result[]=$reslt;

            }
            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
        } 
        else
        {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }
    
    
    

    public function getVendorList() {
        $sql = "SELECT vendorid,name,city,mobile,email,lng,lat FROM  tbl_vendor_master";
        $res = $this->query($sql);
        $result = array();

        if ($res) {
            while ($row = $this->fetchData($res)) {
                $reslt['vid'] = $row['vendorid'];
                $reslt['name'] = $row['name'];
                $reslt['city'] = $row['city'];
                $reslt['email'] = $row['email'];
                $reslt['landline'] = $row['landline'];
                $reslt['mobile'] = $row['mobile'];
                $reslt['lng'] = $row['lng'];
                $reslt['lat'] = $row['lat'];
                $result[] = $reslt;
            }
            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function getVendorDetailsById($vid) {
        $sql = "SELECT vendorid,name,city,mobile,email,lng,lat FROM  tbl_vendor_master WHERE vendorid='" . $vid . "'";
        $res = $this->query($sql);
        $result = array();

        if ($res) {
            $row = $this->fetchData($res);
            $reslt['vid'] = $row['vendorid'];
            $reslt['name'] = $row['name'];
            $reslt['city'] = $row['city'];
            $reslt['email'] = $row['email'];
            $reslt['landline'] = $row['landline'];
            $reslt['mobile'] = $row['mobile'];
            $reslt['lng'] = $row['lng'];
            $reslt['lat'] = $row['lat'];
            $result[] = $reslt;
            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function getVendorDetailsByName($name) {
        $sql = "SELECT vendorid,name,city,mobile,email,lng,lat FROM  tbl_vendor_master WHERE name='" . $name . "'";
        $res = $this->query($sql);
        $result = array();

        if ($res) {
            $row = $this->fetchData($res);
            $reslt['vid'] = $row['vendorid'];
            $reslt['name'] = $row['name'];
            $reslt['city'] = $row['city'];
            $reslt['email'] = $row['email'];
            $reslt['landline'] = $row['landline'];
            $reslt['mobile'] = $row['mobile'];
            $reslt['lng'] = $row['lng'];
            $reslt['lat'] = $row['lat'];
            $result[] = $reslt;
            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function addSolitaire($params) {

        $sql = "INSERT INTO tbl_product_solitaire_mapping (productid,solitaire_id,shape,color,clarity,cut,symmetry,polish,fluorescence,carat,price_per_carat,table_no,crown_angle,girdle,createdon,updatedby) Values";

        foreach ($params['solitaires'] as $solt) {

            $solid = $this->generateId();
            $tmpparams = array('shape' => $solt['shape'], 'color' => $solt['color'], 'clarity' => $solt['clarity'], 'cut' => urldecode($solt['cut']), 'symmetry' => urldecode($solt['symmetry']), 'polish' => urldecode($solt['polish']), 'fluorescence' => urldecode($solt['fluorescence']), 'carat' => $solt['carat'], 'price_per_carat' => $solt['price_per_carat'], 'table' => $solt['table'], 'crown_angle' => $solt['crown_angle'], 'girdle' => $solt['girdle'], 'solitaire_id' => $solid, 'updatedby' => $params['updatedby'], 'productid' => $params['productid']);

            $sql.="(" . $tmpparams['productid'] . "," . $tmpparams['solitaire_id'] . ",'" . $tmpparams['shape'] . "','" . $tmpparams['color'] . "'," . "'" . $tmpparams['clarity'] . "'," . "'" . $tmpparams['cut'] . "'," . "'" . $tmpparams['symmetry'] . "'," . "'" . $tmpparams['polish'] . "'," . "'" . $tmpparams['fluorescence'] . "'," . "" . $tmpparams['carat'] . "," . "" . $tmpparams['price_per_carat'] . "," . "'" . $tmpparams['table'] . "'," . "'" . $tmpparams['crown_angle'] . "'," . "'" . $tmpparams['girdle'] . "'," . "now()," . "" . $params['updatedby'] . "" . "),";
        }

        $sql = trim($sql, ",");
        $sql.=" ON DUPLICATE KEY UPDATE color = VALUES(color),cut = VALUES(cut),symmetry = VALUES(symmetry),polish= VALUES(polish),fluorescence = VALUES(fluorescence),carat = VALUES(carat),price_per_carat = VALUES(price_per_carat), table_no = VALUES(table_no),crown_angle = VALUES(crown_angle), girdle = VALUES(girdle), updatedby=VALUES(updatedby)";

        $res = $this->query($sql);
        $result = array();
        if ($res) {
            $err = array('err_code' => 0, 'err_msg' => 'Data inserted successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function addDiamond($params) {

        $sql = "INSERT INTO tbl_product_diamond_mapping (productid,diamond_id,shape,carat,total_no,createdon,updatedby) VALUES";

        $qulsql = "INSERT INTO tbl_diamond_quality_mapping (diamond_id,id,createdon,updatedby) VALUES";

        foreach ($params['diamonds'] as $dmd) {

            $dmdid = $this->generateId();
            $tmpparams = array('quality' => $dmd['quality'], 'shape' => $dmd['shape'], 'carat' => $dmd['carat'], 'total_no' => $dmd['total_no'], 'diamond_id' => $dmdid, 'updatedby' => $params['updatedby'], 'productid' => $params['productid']);

            $sql.="(" . $tmpparams['productid'] . "," . $tmpparams['diamond_id'] . ",'" . $tmpparams['shape'] . "'," . $tmpparams['carat'] . "," . $tmpparams['total_no'] . ",now()," . $tmpparams['updatedby'] . "" . "),";


            foreach ($dmd['quality'] as $dqul) {
                #$qulid = $this->getDiamondQualityIdByValue($dqul);
                $qltmpparams = array('diamond_id' => $dmdid, 'updatedby' => $params['updatedby'], 'id' => $dqul);

                $qulsql.="(" . $qltmpparams['diamond_id'] . "," . $qltmpparams['id'] . ",now()," . $qltmpparams['updatedby'] . "" . "),";
            }
        }

        $sql = trim($sql, ",");
        $sql.=" ON DUPLICATE KEY UPDATE shape = VALUES(shape),carat = VALUES(carat),total_no = VALUES(total_no),updatedby=VALUES(updatedby)";


        $qulsql = trim($qulsql, ",");
        $qulsql.=" ON DUPLICATE KEY UPDATE updatedby=VALUES(updatedby)";


        $dmdprdRes = $this->addPrdDiamondMapping($sql);
        $dmdQltRes = $this->addDiamondQualityMapping($qulsql);


        if ($dmdprdRes['error']['err_code'] == 0 && $dmdQltRes['error']['err_code'] == 0) {
            $err = array('err_code' => 0, 'err_msg' => 'Data inserted successfully');
        } else {
            if ($dmdprdRes['error']['err_code'] == 1) {
                $err = array('err_code' => 1, 'err_msg' => 'Error in adding diamond to product');
            } else if ($dmdQltRes['error']['err_code'] == 1) {
                $err = array('err_code' => 1, 'err_msg' => 'Error in adding diamond quality to product');
            }
        }
        $result = array();
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function addPrdDiamondMapping($sql) {

        $res = $this->query($sql);
        $result = array();
        if ($res) {
            $err = array('err_code' => 0, 'err_msg' => 'Data inserted successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function addDiamondQualityMapping($sql) {

        $res = $this->query($sql);
        $result = array();
        if ($res) {
            $err = array('err_code' => 0, 'err_msg' => 'Data inserted successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function getDiamondQualityIdByValue($value) {
        $sql = "SELECT id FROM tbl_diamond_quality_master WHERE dname='" . strtolower($value) . "'";
        $res = $this->query($sql);
        $result = array();

        if ($res) {
            $row = $this->fetchData($res);
            $qid = $row['id'];
            return $qid;
        }
    }
    
    public function getDiamondQualityList()
    {
        $sql= "SELECT id,dname,dvalue,price_per_carat FROM tbl_diamond_quality_master";
        $res=$this->query($sql);
        
        if($res)
        {
            while($row = $this->fetchData($res))
            {
                $reslt['id'] =$row['id'];
                $reslt['name'] = $row['dname'];
                $reslt['value'] = $row['dvalue']; 
                $reslt['price'] =  intval($row['price_per_carat']);
                $result[]=$reslt;

            }
            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
        } 
        else
        {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
        
    }
    

    public function addUncutDiamond($params) {

        $sql = "INSERT INTO tbl_product_uncut_mapping (productid,uncut_id,color,quality,total_no,carat,price_per_carat,createdon,updatedby) VALUES";

        foreach ($params['uncut'] as $arr) {

            $uncutid = $this->generateId();
            $tmpparams = array('productid' => $params['productid'], 'color' => $arr['color'], 'quality' => $arr['quality'], 'carat' => $arr['carat'], 'price_per_carat' => $arr['price_per_carat'], 'total_no' => $arr['total_no'], 'updatedby' => $params['updatedby']);

            $sql.="(" . $tmpparams['productid'] . "," . $uncutid . ",'" . $tmpparams['color'] . "','" . $tmpparams['quality'] . "'," . $tmpparams['total_no'] . "," . $tmpparams['carat'] . "," . $tmpparams['price_per_carat'] . ",now()," . $tmpparams['updatedby'] . "" . "),";
        }

        $sql = trim($sql, ",");
        $sql.=" ON DUPLICATE KEY UPDATE color = VALUES(color),quality = VALUES(quality),total_no = VALUES(total_no),carat = VALUES(carat),price_per_carat = VALUES(price_per_carat), updatedby=VALUES(updatedby)";

        $res = $this->query($sql);
        $result = array();
        if ($res) {
            $err = array('err_code' => 0, 'err_msg' => 'Data inserted successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function addGemstone($params) {

        $sql = "INSERT INTO tbl_product_gemstone_mapping (productid,gemstone_id,gemstone_name,total_no,carat,price_per_carat,createdon,updatedby) VALUES";

        foreach ($params['gemstone'] as $arr) {
            $garr = $this->getGemstoneDetailsById($arr['gvalue']);
            $gname = $garr['result']['name'];
            $gemstoneid = $this->generateId();

            $tmpparams = array('productid' => $params['productid'], 'total_no' => $arr['total_no'], 'carat' => $arr['carat'], 'price_per_carat' => $arr['price_per_carat'], 'updatedby' => $params['updatedby']);

            $sql.="(" . $tmpparams['productid'] . "," . $gemstoneid . ",'" . $gname . "'," . $tmpparams['total_no'] . "," . $tmpparams['carat'] . "," . $tmpparams['price_per_carat'] . ",now()," . $tmpparams['updatedby'] . "" . "),";
        }
        $sql = trim($sql, ",");

        $sql.=" ON DUPLICATE KEY UPDATE total_no = VALUES(total_no),carat = VALUES(carat),price_per_carat = VALUES(price_per_carat),updatedby=VALUES(updatedby)";

        $res = $this->query($sql);
        $result = array();
        if ($res) {
            $err = array('err_code' => 0, 'err_msg' => 'Data inserted successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }

    public function getGemstoneDetailsById($gid) {

        $sql = "SELECT id,gemstone_name,description FROM tbl_gemstone_master WHERE id=" . $gid;
        $res = $this->query($sql);
        $row = $this->fetchData($res);

        $result = array();

        if ($res) {
            $reslt['id'] = $row['id'];
            $reslt['name'] = $row['gemstone_name'];
            $reslt['desc'] = $row['description'];
            $result = $reslt;
            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }
    
    
    
    public function getGemstoneList() {

        $sql = "SELECT id,gemstone_name,description FROM tbl_gemstone_master";
        $res = $this->query($sql);

        if ($res) 
        {
            while($row = $this->fetchData($res))
            {
                $reslt['id'] = $row['id'];
                $reslt['name'] = $row['gemstone_name'];
                $reslt['desc'] = $row['description'];
                $result[] = $reslt;
            }
            
            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
        }
            
        else
        {
            $err = array('err_code' => 1, 'err_msg' => 'Error in fetching data');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }
    
    
    public function getSizeListByCat($params)
    {
        
        $sql="SELECT id,name,size_value,catid FROM tbl_size_master  WHERE active_flag = 1 AND catid = ".$params['catid'];
        $res =$this->query($sql);
        
        if($res)
        {
            while($row = $this->fetchData($res))
            {
                $reslt['id'] = $row['id'];
                $reslt['name'] = $row['name'];
                $reslt['sval'] = $row['size_value'];
                $result[] = $reslt;
            }
            
            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
        }
            
        else
        {
            $err = array('err_code' => 1, 'err_msg' => 'Error in fetching data');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
        
    }
    
    public function getSizeList()
    {
        
        $sql="SELECT id,name,size_value,catid FROM tbl_size_master  WHERE active_flag";
        $res =$this->query($sql);
        
        if($res)
        {
            while($row = $this->fetchData($res))
            {
                $reslt['id'] = $row['id'];
                $reslt['name'] = $row['name'];
                $reslt['sval'] = $row['size_value'];
                $reslt['catid'] = $row['catid'];
                $result[] = $reslt;
            }
            
            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
        }
            
        else
        {
            $err = array('err_code' => 1, 'err_msg' => 'Error in fetching data');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
        
    }

    public function getProductById($params) {

        try {
            $productSql = "SELECT 
                                *
                        FROM 
                                tbl_product_master
                        WHERE 
                               productid = " . $params['pid'] . " ";
            // WHERE active_flag=1 ";
            $res = $this->query($productSql);
            if ($res) {
                if($row = $this->fetchData($res)){
                    $arr['prdId'] = $row['productid'];
                    $arr['prdCod'] = $row['product_code'];
                    $arr['vndId'] = $row['vendorid'];
                    $arr['prdNm'] = $row['product_name'];
                    $arr['prdSeo'] = $row['product_seo_name'];
                    $arr['gender'] = $row['gender'];
                    $arr['prdWgt'] = $row['product_weight'];
                    $arr['dmdStng'] = $row['diamond_setting'];
                    $arr['mtlWgt'] = $row['metal_weight'];
                    $arr['mkngCrg'] = $row['making_charges'];
                    $arr['procmtCst'] = $row['procurement_cost'];
                    $arr['mrgn'] = $row['margin'];
                    $arr['mesmnt'] = $row['measurement'];
                    $arr['custPurty'] = $row['customise_purity'];
                    $arr['custClor'] = $row['customise_color'];
                    $arr['crtficte'] = $row['certificate'];
                    $arr['hasDmd'] = $row['has_diamond'];
                    $arr['hasSol'] = $row['has_solitaire'];
                    $arr['hasUnct'] = $row['has_uncut'];
                    $arr['hasGem'] = $row['has_gemstone'];
                    $arr['crtdOn'] = $row['createdon'];
                    $arr['updtOn'] = $row['updatedon'];
                    $arr['updtBy'] = $row['updatedby'];
                    
                }

                $gemstone = $this->getProductGemstone($params);
                $solitaire = $this->getProductSolitaire($params);
                $uncut = $this->getProductUncut($params);
                $size = $this->getProductSize($params);
                $vendor = $this->getProductVendor($params);
                $metalColor = $this->getProductMetalColor($params);
                $metalPurity = $this->getProductMetalPurity($params);
                $discount = $this->getProductDiscount($params);
                $dimond = $this->getProductDiamond($params);
                $catAttr = $this->getCatMap($params);
                $imageDtl = $this->getImagesByPid(array('pid' => $row['productid']));
                // $sizeMaster = $this->getProductSizeMaster($params);

                $result = array(
                    'basicDetails' => $arr,
                    'gamestone' => $gemstone,
                    'solitaire' => $solitaire,
                    'uncut' => $uncut,
                    'size' => $size,
                    'vendor' => $vendor,
                    'metalColor' => $metalColor,
                    'metalPurity' => $metalPurity,
                    'discount' => $discount,
                    'dimond' => $dimond,
                    'catAttr' => $catAttr,
                    'images' =>$imageDtl
                        
                );
                $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
            } else {
                $err = array('err_code' => 1, 'err_msg' => 'Error in fetching data');
            }
            $results = array('results' => $result, 'error' => $err);
        } catch (Exception $e) {
            echo 'Exection in API getProductById message : ' . $e->getMessage();
        }
        return $results;
    }

    public function getProductGemstone($params) {
        try {
            $count = 0;
            $sql = "SELECT 
                                *
                        FROM 
                                tbl_product_gemstone_mapping
                        WHERE 
                                productid = " . $params['pid'] . " ";
            // WHERE active_flag=1 ";
            $res = $this->query($sql);
            if ($res) {
                while ($row = $this->fetchData($res)) {
                    $arr['prdId'] = $row['productid'];
                    $arr['gemId'] = $row['gemstone_id'];
                    $arr['gemNm'] = $row['gemstone_name'];
                    $arr['totNo'] = $row['total_no'];
                    $arr['crat'] = $row['carat'];
                    $arr['prcPrCrat'] = $row['price_per_carat'];
                    $arr['actFlg'] = $row['active_flag'];
                    $arr['crtdOn'] = $row['createdon'];
                    $arr['updtOn'] = $row['updatedon'];
                    $arr['updtBy'] = $row['updatedby'];
                    $resArr[] = $arr;
                    $count++;
                }
            }

            return array('count' => $count, 'results' => $resArr);
        } catch (Exception $e) {
            echo 'Exection in function getProductGemstone message : ' . $e->getMessage();
        }
    }

    public function getProductDiscount($params) {
        try {
            $count = 0;
            $sql = "SELECT 
                                *
                        FROM 
                                tbl_discount_master
                        WHERE 
                                productid = " . $params['pid'] . " ";
            // WHERE active_flag=1 ";
            $res = $this->query($sql);
            if ($res) {
                while ($row = $this->fetchData($res)) {
                    $arr['prdId'] = $row['productid'];
                    $arr['disType'] = $row['discount_type'];
                    $arr['disAmt'] = $row['discount_amount'];
                    $arr['strtDate'] = $row['start_date'];
                    $arr['endDate'] = $row['end_date'];
                    $arr['actFlg'] = $row['active_flag'];
                    $arr['crtdOn'] = $row['createdon'];
                    $arr['updtOn'] = $row['updatedon'];
                    $arr['updtBy'] = $row['updatedby'];
                    $resArr[] = $arr;
                    $count++;
                }
            }
            return array('count' => $count, 'results' => $resArr);
        } catch (Exception $e) {
            echo 'Exection in function getProductDiscount message : ' . $e->getMessage();
        }
    }

    public function getProductSolitaire($params) {
        try {
            $count = 0;
            $sql = "SELECT 
                                *
                        FROM 
                                tbl_product_solitaire_mapping
                        WHERE 
                                productid = " . $params['pid'] . " ";
            // WHERE active_flag=1 ";
            $res = $this->query($sql);
            if ($res) {
                while ($row = $this->fetchData($res)) {
                    $arr['prdId'] = $row['productid'];
                    $arr['soliId'] = $row['solitaire_id'];
                    $arr['shape'] = $row['shape'];
                    $arr['colr'] = $row['color'];
                    $arr['clrty'] = $row['clarity'];
                    $arr['cut'] = $row['cut'];
                    $arr['symty'] = $row['symmetry'];
                    $arr['polish'] = $row['polish'];
                    $arr['flresce'] = $row['fluorescence'];
                    $arr['carat'] = $row['carat'];
                    $arr['prcPrCrat'] = $row['price_per_carat'];
                    $arr['tblNo'] = $row['table_no'];
                    $arr['crwnAngle'] = $row['crown_angle'];
                    $arr['girdle'] = $row['girdle'];
                    $arr['actFlg'] = $row['active_flag'];
                    $arr['crtdOn'] = $row['createdon'];
                    $arr['updtOn'] = $row['updatedon'];
                    $arr['updtBy'] = $row['updatedby'];
                    $resArr[]=$arr;
                    $count++;
                }
            }
            return array('count' => $count, 'results' => $resArr);
        } catch (Exception $e) {
            echo 'Exection in function getProductSolitaire message : ' . $e->getMessage();
        }
    }

    public function getProductUncut($params) {
        try {
            $count = 0;
            $sql = "SELECT 
                                *
                        FROM 
                                tbl_product_uncut_mapping
                        WHERE 
                                productid = " . $params['pid'] . " ";
            // WHERE active_flag=1 ";
            $res = $this->query($sql);
            if ($res) {
                while ($row = $this->fetchData($res)) {
                    $arr['prdId'] = $row['productid'];
                    $arr['unctId'] = $row['uncut_id'];
                    $arr['clor'] = $row['color'];
                    $arr['qulty'] = $row['quality'];
                    $arr['totNo'] = $row['total_no'];
                    $arr['crat'] = $row['carat'];
                    $arr['prcPrCrat'] = $row['price_per_carat'];
                    $arr['actFlg'] = $row['active_flag'];
                    $arr['crtdOn'] = $row['createdon'];
                    $arr['updtOn'] = $row['updatedon'];
                    $arr['updtBy'] = $row['updatedby'];
                    $resArr[] = $arr;
                    $count++;
                }
            }
            return array('count' => $count, 'results' => $resArr);
        } catch (Exception $e) {
            echo 'Exection in function getProductUncut message : ' . $e->getMessage();
        }
    }

    public function getProductSize($params) {
        try {
            $count = 0;
            $sql = "
                    SELECT 
                                *
                        FROM 
                                tbl_product_size_mapping
                        WHERE 
                                productid = " . $params['pid'] . " ";
            // WHERE active_flag=1 ";
            $res = $this->query($sql);
            if ($res) {
                while ($row = $this->fetchData($res)) {
                    $arr['prdId'] = $row['productid'];
                    $arr['sizId'] = $row['size_id'];
                    $arr['qnty'] = $row['quantity'];
                    $arr['crtdOn'] = $row['createdon'];
                    $arr['updtOn'] = $row['updatedon'];
                    $arr['updtBy'] = $row['updatedby'];
                    $arr['sizeMaster'] = $this->getSizeMasterByID(array('size_id' => $row['size_id']));
                    $resArr[] = $arr;
                    $count++;
                }
            }
            return array('count' => $count, 'results' => $resArr);
        } catch (Exception $e) {
            echo 'Exection in function getProductSize message : ' . $e->getMessage();
        }
    }

    public function getProductDiamond($params) {
        try {
            $count = 0;
            $sql = "
                    SELECT 
                                *
                        FROM 
                                tbl_product_diamond_mapping
                        WHERE 
                                productid = " . $params['pid'] . "
                                 
                                    ";
            // AND active_flag=1 ";
            $res = $this->query($sql);
            if ($res) {
                while ($row = $this->fetchData($res)) {
                    $arr['prdId'] = $row['productid'];
                    $arr['dmdId'] = $row['diamond_id'];
                    $arr['shap'] = $row['shape'];
                    $arr['crat'] = $row['carat'];
                    $arr['totNo'] = $row['total_no'];
                    $arr['crtdOn'] = $row['createdon'];
                    $arr['updtOn'] = $row['updatedon'];
                    $arr['updtBy'] = $row['updatedby'];
                    $arr['QualityMaster'] = $this->getQualityMap(array('diamond_id' => $row['diamond_id']));
                    $count++;
                }
            }
            return array('count' => $count, 'results' => $arr);
        } catch (Exception $e) {
            echo 'Exection in function getProductDiamond message : ' . $e->getMessage();
        }
    }

    public function getCatMap($params) {
        try {

            $count = 0;
            $sql = "
                SELECT 
                        * 
                    FROM
                         tbl_category_master
                    WHERE
                            active_flag =1
                        AND
                            catid IN(
                                        SELECT 
                                                catid
                                        FROM 
                                                tbl_category_product_mapping
                                        WHERE
                                                productid =" . $params['pid'] . " 
                                        AND
                                                active_flag =1
                                    )
                         ";
            // WHERE active_flag=1 ";
            $res = $this->query($sql);
            if ($res) {
                while ($row = $this->fetchData($res)) {
                    $arr['catId'] = $row['catid'];
                    $arr['pcatId'] = $row['pcatid'];
                    $arr['catNm'] = $row['cat_name'];
                    $arr['catLvl'] = $row['cat_lvl'];
                    $arr['lineage'] = $row['lineage'];
                    $arr['actFlg'] = $row['active_flag'];
                    $arr['crtdOn'] = $row['createdon'];
                    $arr['updtOn'] = $row['updatedon'];
                    $arr['updtBy'] = $row['updatedby'];
                    $arr['attrMaster'] = $this->getCatAttr(array('catid' => $row['catid']));
                    $resArr[] = $arr;
                    $count++;
                }
            }
            return array('count' => $count, 'results' => $resArr);
        } catch (Exception $e) {
            echo 'Exection in function getCatMap message : ' . $e->getMessage();
        }
    }

    public function getCatAttr($params) {
        try {
            $count = 0;
            $sql = "
                    SELECT 
                        * 
                    FROM
                         tbl_attribute_master
                    WHERE
                            active_flag =1
                        AND
                            attributeid IN(
                                        SELECT 
                                                attributeid
                                        FROM 
                                                tbl_category_attribute_mapping
                                        WHERE
                                                catid =" . $params['catid'] . " 
                                        AND
                                                active_flag =1
                                    )
                          ";
            // AND active_flag=1 ";
            $res = $this->query($sql);
            if ($res) {
                while ($row = $this->fetchData($res)) {
                    $arr['atrId'] = $row['attributeid'];
                    $arr['atrNm'] = $row['attr_name'];
                    $arr['atrValus'] = $row['attr_values'];
                    $arr['atrTyp'] = $row['attr_type'];
                    $arr['atrUnt'] = $row['attr_unit'];
                    $arr['atrUntPos'] = $row['attr_unit_pos'];
                    $arr['atrPos'] = $row['attr_pos'];
                    $arr['actFlg'] = $row['active_flag'];
                    $arr['crtdOn'] = $row['createdon'];
                    $arr['updtOn'] = $row['updatedon'];
                    $arr['updtBy'] = $row['updatedby'];
                    $resArr[] = $arr;
                    
                    $count++;
                }
            }
            return array('count' => $count, 'results' => $resArr);
        } catch (Exception $e) {
            echo 'Exection in function getCatAttr message : ' . $e->getMessage();
        }
    }

    public function getQualityMap($params) {
        try {

            $count = 0;
            $sql = "
                SELECT 
                        * 
                    FROM
                         tbl_diamond_quality_master
                    WHERE
                            active_flag =1
                        AND
                            id IN(
                                        SELECT 
                                                id
                                        FROM 
                                                tbl_diamond_quality_mapping
                                        WHERE
                                                diamond_id =" . $params['diamond_id'] . " 
                                        AND
                                                active_flag =1
                                    )
                         ";
            // WHERE active_flag=1 ";
            $res = $this->query($sql);
            if ($res) {
                while ($row = $this->fetchData($res)) {
                    $arr['id'] = $row['id'];
                    $arr['dNm'] = $row['dname'];
                    $arr['dVal'] = $row['dvalue'];
                    $arr['prcPrCrat'] = $row['price_per_carat'];
                    $arr['actFlg'] = $row['active_flag'];
                    $arr['crtdOn'] = $row['createdon'];
                    $arr['updtOn'] = $row['updatedon'];
                    $arr['updtBy'] = $row['updatedby'];
                    $resArr[] = $arr;
                    $count++;
                }
            }
            return array('count' => $count, 'results' => $resArr);
        } catch (Exception $e) {
            echo 'Exection in function getQualityMap message : ' . $e->getMessage();
        }
    }

    public function getSizeMasterByID($params) {
        try {
            $count = 0;
            $sql = "
                    SELECT 
                                *
                        FROM 
                                tbl_size_master
                        WHERE
                                id =" . $params['size_id'] . " 
                         ";
            // WHERE active_flag=1 ";
            $res = $this->query($sql);
            if ($res) {
                while ($row = $this->fetchData($res)) {
                    $arr['id'] = $row['id'];
                    $arr['nm'] = $row['name'];
                    $arr['sizVal'] = $row['size_value'];
                    $arr['catId'] = $row['catid'];
                    $arr['actFlg'] = $row['active_flag'];
                    $arr['crtdOn'] = $row['createdon'];
                    $arr['updtOn'] = $row['updatedon'];
                    $arr['updtBy'] = $row['updatedby'];
                    $resArray[] = $arr;
                    $count++;
                }
            }
            return array('count' => $count, 'results' => $resArray);
        } catch (Exception $e) {
            echo 'Exection in function getSizeMasterByID message : ' . $e->getMessage();
        }
    }

    public function getProductSizeMaster($params) {
        try {
            $count = 0;
            $sql = "       SELECT 
                                *
                        FROM 
                                tbl_size_master
                        WHERE
                                    
                                active_flag = 1 
                        AND
                            id IN  (
                                        SELECT 
                                                id
                                        FROM 
                                                tbl_product_size_mapping
                                        WHERE 
                                                productid = " . $params['pid'] . " 
                                        AND            
                                                active_flag = 1 
                                    )";
            // WHERE active_flag=1 ";
            $res = $this->query($sql);
            if ($res) {
                while ($row = $this->fetchData($res)) {
                    $arr['id'] = $row['id'];
                    $arr['nm'] = $row['name'];
                    $arr['sizVal'] = $row['size_value'];
                    $arr['catId'] = $row['catid'];
                    $arr['actFlg'] = $row['active_flag'];
                    $arr['crtdOn'] = $row['createdon'];
                    $arr['updtOn'] = $row['updatedon'];
                    $arr['updtBy'] = $row['updatedby'];
                    $resArr[] = $arr;
                    $count++;
                }
            }
            return array('count' => $count, 'results' => $resArr);
        } catch (Exception $e) {
            echo 'Exection in function getProductSizeMaster message : ' . $e->getMessage();
        }
    }

    public function getProductVendor($params) {
        try {
            $count = 0;
            $sql = "       SELECT 
                                *
                        FROM 
                                tbl_vendor_master
                        WHERE   
                                                active_flag = 1 
                        AND
                            vendorid IN  (
                                        SELECT 
                                                vendorid
                                        FROM 
                                                tbl_product_master
                                        WHERE 
                                                productid = " . $params['pid'] . " 
                                       
                                    )";
            // WHERE active_flag=1 ";
            $res = $this->query($sql);
            if ($res) {
                while ($row = $this->fetchData($res)) {
                    $arr['venId'] = $row['vendorid'];
                    $arr['nm'] = $row['name'];
                    $arr['ct'] = $row['city'];
                    $arr['mob'] = $row['mobile'];
                    $arr['email'] = $row['email'];
                    $arr['ldlne'] = $row['landline'];
                    $arr['lng'] = $row['lng'];
                    $arr['lat'] = $row['lat'];
                    $arr['actFlg'] = $row['active_flag'];
                    $arr['crtdOn'] = $row['createdon'];
                    $arr['updtOn'] = $row['updatedon'];
                    $arr['updtBy'] = $row['updatedby'];
                     $resArr[] = $arr;
                    $count++;
                }
            }
            return array('count' => $count, 'results' => $resArr);
        } catch (Exception $e) {
            echo 'Exection in function getProductVendor message : ' . $e->getMessage();
        }
    }

    public function getProductMetalColor($params) {
        try {
            $count = 0;
            $sql = "       SELECT 
                                *
                        FROM 
                                tbl_metal_color_master
                        WHERE   
                                 active_flag = 1 
                        AND
                            id IN  (
                                        SELECT 
                                                id
                                        FROM 
                                                tbl_product_metal_color_mapping
                                        WHERE 
                                                productid = " . $params['pid'] . " 
                                            AND
                                                active_flag=1
                                       
                                    )";
            // WHERE active_flag=1 ";
            $res = $this->query($sql);
            if ($res) {
                while ($row = $this->fetchData($res)) {
                    $arr['id'] = $row['id'];
                    $arr['dNm'] = $row['dname'];
                    $arr['dVal'] = $row['dvalue'];
                    $arr['actFlg'] = $row['active_flag'];
                    $arr['crtdOn'] = $row['createdon'];
                    $arr['updtOn'] = $row['updatedon'];
                    $arr['updtBy'] = $row['updatedby'];
                    $resArr[] = $arr;
                    $count++;
                }
            }
            return array('count' => $count, 'results' => $resArr);
        } catch (Exception $e) {
            echo 'Exection in function getProductMetalColor message : ' . $e->getMessage();
        }
    }

    public function getProductMetalPurity($params) {
        try {
            $count = 0;
            $sql = "       SELECT 
                                *
                        FROM 
                                tbl_metal_purity_master
                        WHERE   
                                 active_flag = 1 
                        AND
                            id IN  (
                                        SELECT 
                                                id
                                        FROM 
                                                tbl_product_metal_purity_mapping
                                        WHERE 
                                                productid = " . $params['pid'] . " 
                                            AND
                                                active_flag=1
                                       
                                    )";
            // WHERE active_flag=1 ";
            $res = $this->query($sql);
            if ($res) {
                while ($row = $this->fetchData($res)) {
                    $arr['id'] = $row['id'];
                    $arr['dNm'] = $row['dname'];
                    $arr['dVal'] = $row['dvalue'];
                    $arr['actFlg'] = $row['active_flag'];
                    $arr['crtdOn'] = $row['createdon'];
                    $arr['updtOn'] = $row['updatedon'];
                    $arr['updtBy'] = $row['updatedby'];
                    $arr['prc'] = $row['price'];
                    $resArr[] = $arr;
                    $count++;
                }
            }
            return array('count' => $count, 'results' => $resArr);
        } catch (Exception $e) {
            echo 'Exection in function getProductMetalPurity message : ' . $e->getMessage();
        }
    }

   
    public function pageList($param) {
        global $comm;
        try {
            $sql = "SELECT 
                            productid,
                            createdon, 
                            product_code,
                            metal_weight,
                            product_seo_name seo,
                            product_name pName,	
                            active_flag,

                            productid AS id,
                             IF(has_diamond=1,
                                    (
                                        SELECT 
                                                SUM(carat) 
                                        FROM 
                                            tbl_product_diamond_mapping
                                        WHERE 
                                            productid =id
                                    ),
                                    0) AS diamondW,
                            IF(product_seo_name = NULL OR product_seo_name='',
                                product_name,
                            product_seo_name) AS prdName
                            FROM 
                                tbl_product_master ORDER BY updatedon";


            $page = ($params['page'] ? $params['page'] : 1);
            $limit = ($params['limit'] ? $params['limit'] : 20);

            //Making sure that query has limited rows 
            if ($limit > 20) {
                $limit = 20;
            }

            if (!empty($page)) {
                $start = ($page * $limit) - $limit;
                $sql.=" LIMIT " . $start . ",$limit";
            }
            $res = $this->query($sql);

            if ($res) 
            {
                while ($row = $this->fetchData($res)) {

                    //Date format is not specified so it matches with default mysql
                    $arr['creDate'] = $comm->makeDate($row['createdon']);

                    //Product code 
                    $arr['prdCode'] = $row['product_code'];

                    //Total sum weight of diamonds in product
                    $arr['diaWgt'] = $row['diamondW'];

                    $arr['mtlWgt'] = $row['metal_weight'];

                    //Product name is SEO name, if seo name is blank then product name
                    $arr['prdName'] = $row['seo'];
                    $arr['pid'] = $row['productid'];

                    // Getting product image from differnt API internally in array
                    $imageDtl = $this->getImagesByPid(array('pid' => $row['id']));

                    //Active flag is not included in database schema so given hardcoded value
                    $arr['isActive'] = $row['active_flag'];
                    $arr['imgDtl'] = $imageDtl;
                    $result[] = $arr;
                }
                $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
            }
            else {
                $err = array('err_code' => 1, 'err_msg' => 'Error in fetching data');
            }
            $results = array('results' => $result, 'error' => $err);
        } catch (Exception $e) {
            echo 'Exection in API pageList message : ' . $e->getMessage();
        }
        return $results;
    }

    public function test()
    {
        #$data=array('dt' =>'{"mpurity":["1"],"metalcolor":["1","2","3"],"sizes":[{"id":"1","qty":"10"},{"id":"3","qty":"20"},{"id":"5","qty":"30"}],"solitaires":[{"shape":"Emerald","color":"D","clarity":"VVS1","cut":"Very%20Good","symmetry":"Very%20Good","polish":"Very%20Good","fluorescence":"Medium","carat":"100","price_per_carat":"10000","table":"522","crown_angle":"100","girdle":"100"}],"has_solitaire":1,"has_diamond":0,"has_gemstone":0,"details":{"vendorid":"1","product_name":"18K%20Gold%20Ring","product_seo_name":"18K%20White%20Gold%20Ring","gender":"0","product_weight":"10","certificate":"IGI","metal_weight":"10","making_charges":"15000","procurement_cost":"150","margin":"10","measurement":"10X20","dmdSetting":"Prong,Bezel,Pave,Test%20Diamond%20Setting"},"userid":"1","catid":"1,11,2,3,4,10"}');
        $data=array('dt' =>'{"mpurity":["1"],"metalcolor":["1","2","3"],"sizes":[{"1":"10"},{"3":"12"},{"5":"15"}],"solitaires":[{"shape":"Emerald","color":"D","clarity":"VVS1","cut":"Very%20Good","symmetry":"Very%20Good","polish":"Very%20Good","fluorescence":"Medium","carat":"100","price_per_carat":"10000","table":"522","crown_angle":"100","girdle":"100"}],"has_solitaire":1,"has_diamond":0,"has_gemstone":0,"details":{"vendorid":"1","product_name":"18K%20Gold%20Ring","product_seo_name":"18K%20White%20Gold%20Ring","gender":"0","product_weight":"10","certificate":"IGI","metal_weight":"10","making_charges":"15000","procurement_cost":"150","margin":"10","measurement":"10X20","dmdSetting":"Prong,Bezel,Pave,Test%20Diamond%20Setting"},"userid":"1","catid":"1,11,2,3,4,10"}');
        
        echo "<pre>";
        print_r(json_decode($data['dt'],1));
        echo "</pre>";
    
    }
    
    
    public function imageUpdate($params)
    {
        $err = array('errCode' => 0, 'errMsg' => 'Details updated successfully');
        $pid = $params['pid'];
        $img = $params['imgpath'];

        $sql = "SELECT
                        product_image,
                        image_sequence
                FROM
                        tbl_product_image_mapping
                WHERE 
                        product_id = " . $pid . " 
                AND 
                        active_flag = 0 
                ORDER BY
                        image_sequence ASC";
        $res = $this->query($sql);
        $cnt = $this->numRows($res);
        $flag = true;
        if ($cnt)
        {
            while ($row = $this->fetchData($res))
            {
                if (strtolower($row['product_image']) == strtolower($img))
                {
                    $err = array('errCode' => 1, 'errMsg' => 'No results updated');
                    $flag = false;
                }
                $image_sequence = $row['image_sequence'];
            }
        }
        $sequence = ($image_sequence ? $image_sequence + 1 : 1);
        if ($flag) {
            $sql = "INSERT
                    INTO 
                        tbl_product_image_mapping 
                        (
                                product_id,
                                product_image,
                                active_flag,
                                image_sequence,
                                upload_date,
                                update_date
                        )
                        VALUES
                        (
                                " . $pid . ",
                                \"" . $img . "\",
                                0,
                                " . $sequence . ",
                                NOW(),
                                NOW()
                        )";
            $res2 = $this->query($sql);
        }

        $arr = array();
        $result = array('results' => $arr, 'error' => $err);
        return $result;
    }

    public function imageRemove($params)
    {
        $pid = $params['pid'];

        $sql = "SELECT 
                        product_image
                FROM 
                        tbl_product_image_mapping
                WHERE 
                        product_id = ".$pid." 
                AND
                        active_flag in (0, 1)";
        $res = $this->query($sql);
        $cnt = $this->numRows($res);

        if($res)
        {
            while($row = $this->fetchData($res))
            {
                    if(stristr($row['product_image'], $params['file']) !== FALSE)
                    {
                        $sql = "UPDATE 
                                                tbl_product_image_mapping 
                                        SET 
                                                active_flag = 2 
                                        WHERE 
                                                product_id = ".$pid." 
                                        AND 
                                                product_image = \"".$row['product_image']."\"";
                        $res = $this->query($sql);
                        $err = array('errCode' => 0, 'errMsg' => 'Details updated successfully');
                    }
                    else
                    {
                            $err = array('errCode' => 1, 'errMsg' => 'No results updated');
                    }
            }
            $arr = array();
            $result = array('results' => $arr, 'error' => $err);
            return $result;
        }
    }
		
    public function imageDisplay($params)
    {
        $af = (!empty($params['af'])) ? trim(urldecode($params['af'])) : 1;

        $arr = array();
        $pid = $params['pid'];
        $prdSql = " SELECT
                            vendor_id 
                    FROM 
                            tbl_vendor_product_mapping
                    WHERE
                            product_id = ".$pid."";
        $prdRes = $this->query($prdSql);
        $Vcnt = $this->numRows($prdRes);

        if($Vcnt)
        {
            $row = $this->fetchData($prdRes);
            if($row['vendor_id'] == $params['vid'])
            {
                $extn = " AND active_flag not in (2) ";
            }
        }
               $extn = " AND active_flag not in (2) ";                       
        $sql = "SELECT 
                        product_image
                FROM 
                        tbl_product_image_mapping
                WHERE 
                        product_id = ".$pid." ".$extn." 
                ORDER BY
                        image_sequence ASC";
        $res = $this->query($sql);
        if($res)
        {
                while($row = $this->fetchData($res))
                {
                        $arr[] = $row['product_image'];
                }

        }

        if(!empty($arr))
        {
                $err = array('errCode' => 0, 'errMsg' => 'Details fetched successfully');
        }
        else
        {
                $err = array('errCode' => 1, 'errMsg' => 'No results found');
        }
        $result = array('results' => $arr, 'error' => $err);
        return $result;
    }
    public function getImagesByPid($params) {
        try {
            $count = 0;
            $sql = "SELECT 
                        product_image
                FROM 
                        tbl_product_image_mapping
                WHERE 
                        product_id = " . $params['pid'] . " 
              ";

            $res = $this->query($sql);
            if ($res) {
                while ($row = $this->fetchData($res)) {
                    #$image = DOMAIN . $row['product_image'];
                    $image = IMGDOMAIN.$row['product_image'];
                    $images[] = $image;
                    $count++;
                }
            }
            $result = array('count' => $count, 'images' => $images);
            return $result;
        } catch (Exception $e) {
            echo 'Exection in API getImagesByPid message : ' . $e->getMessage();
        }
    }
    
    
    public function changeProductStatus($params)
    {
        $params= (json_decode($params[0],1));
        
        $sql="UPDATE tbl_product_master set active_flag='".$params['active_flag']."'   WHERE productid = '".$params['pid']."'";
        $res = $this->query($sql);
        $result = array();
        if ($res) {
            $err = array('err_code' => 0, 'err_msg' => 'Data updated successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in updating');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
        
    }

}
?>
