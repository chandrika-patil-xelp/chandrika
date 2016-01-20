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

    public function addProduct() {

        $pid = $this->generateId();

        $sizeArray = array('4' => 20, '4.5' => 22, '6' => 5, '7' => 2, '8' => 3, '9' => 1, '10' => 7,);
        $metalColorArray = array('white', 'rose');
        $metalPurityArray = array('22 carat', '14 carat', '18 carat', '24 carat');

        $solitaire1 = array('shape' => 'Round', 'color' => 'D', 'clarity' => 'IF', 'cut' => 'very good', 'symmetry' => 'very good', 'polish' => 'good', 'fluorescence' => 'none', 'carat' => 0.5, 'price_per_carat' => 5005.25, 'table' => '56', 'crown_angle' => '25', 'girdle' => '25');
        $solitaire2 = array('shape' => 'Pear', 'color' => 'E', 'clarity' => 'VVS1', 'cut' => 'very good', 'symmetry' => 'good', 'polish' => 'good', 'fluorescence' => 'none', 'carat' => 0.6, 'price_per_carat' => 5005.25, 'table' => '56', 'crown_angle' => '25', 'girdle' => '25');
        $solitaire3 = array('shape' => 'Heart', 'color' => 'F', 'clarity' => 'IF', 'cut' => 'very good', 'symmetry' => 'good', 'polish' => 'good', 'fluorescence' => 'none', 'carat' => 0.7, 'price_per_carat' => 5005.25, 'table' => '56', 'crown_angle' => '25', 'girdle' => '25');
        $solitaire4 = array('shape' => 'Oval', 'color' => 'G', 'clarity' => 'VVS2', 'cut' => 'very good', 'symmetry' => 'fair', 'polish' => 'good', 'fluorescence' => 'none', 'carat' => 0.8, 'price_per_carat' => 5005.25, 'table' => '56', 'crown_angle' => '25', 'girdle' => '25');
        $solitaire5 = array('shape' => 'Cushion', 'color' => 'H', 'clarity' => 'VS2', 'cut' => 'very good', 'symmetry' => 'very good', 'polish' => 'good', 'fluorescence' => 'none', 'carat' => 0.9, 'price_per_carat' => 5005.25, 'table' => '56', 'crown_angle' => '25', 'girdle' => '25');

        $solitaires = array($solitaire1, $solitaire2, $solitaire3, $solitaire4, $solitaire5);


        $d1Quality = array('VVS - GH', 'VVS - EF');
        $diamond1 = array('shape' => 'Pear', 'quality' => $d1Quality, 'carat' => 5.5, 'total_no' => 5);
        $d2Quality = array('VVS - IF', 'VS - IJ', 'SI - EF');
        $diamond2 = array('shape' => 'oval', 'quality' => $d2Quality, 'carat' => 2.5, 'total_no' => 15);

        $diamonds = array($diamond1, $diamond2);



        $uncut1 = array('color' => 'D', 'quality' => 'IF', 'carat' => 0.1, 'price_per_carat' => 1000.25, 'total_no' => 1);
        $uncut2 = array('color' => 'E', 'quality' => 'GH', 'carat' => 0.2, 'price_per_carat' => 1015.25, 'total_no' => 2);
        $uncut3 = array('color' => 'F', 'quality' => 'JK', 'carat' => 0.3, 'price_per_carat' => 1025.25, 'total_no' => 3);

        $uncuts = array($uncut1, $uncut2, $uncut3);



        $gemstone1 = array('gvalue' => 1, 'total_no' => 1, 'carat' => 1.2, 'price_per_carat' => 1000);
        $gemstone2 = array('gvalue' => 2, 'total_no' => 2, 'carat' => 2.2, 'price_per_carat' => 1100);
        $gemstone3 = array('gvalue' => 3, 'total_no' => 3, 'carat' => 3.2, 'price_per_carat' => 1200);
        $gemstone4 = array('gvalue' => 4, 'total_no' => 4, 'carat' => 4.2, 'price_per_carat' => 1300);

        $gemstones = array($gemstone1, $gemstone2, $gemstone3, $gemstone4);




        $details = array('vendorid' => '1', 'product_name' => '22k ring golden',
            'product_seo_name' => '22K Gold Office Wear Ring', 'gender' => 0, 'product_weight' => 5.5, 'diamond_setting' => 'prong', 'metal_weight' => 4,
            'making_charges' => 12500.56, 'procurement_cost' => 11000.52, 'margin' => 5, 'measurement' => '10X50', 'certificate' => 'SGL');


        $params = array('catid' => '1,2,3,4,5', 'userid' => '55', 'productid' => $pid, 'sizes' => $sizeArray, 'metalpurity' => $metalPurityArray, 'metalcolor' => $metalColorArray, 'has_solitaire' => 1, 'solitaires' => $solitaires, 'has_diamond' => 1, 'diamonds' => $diamonds, 'has_uncut' => 1, 'uncut' => $uncuts, 'has_gemstone' => 1, 'gemstone' => $gemstones, 'details' => $details);
        $userid = $params['userid'];

        #echo "<pre>";  print_r($params);  echo "</pre>";die;
        #ADDING CATEGORY MAPPING FOR CURRENT PRODUCT
        $catids = explode(",", $params['catid']);
        $tmpcatparams = array('catid' => $params['catid'], 'userid' => $userid, 'pid' => $pid);
        $catres = $this->addCatProductMapping($tmpcatparams);
        if ($catres['error']['err_code'] == 0) {

            $sizeparams = array('productid' => $params['productid'], 'updatedby' => $userid, 'sizes' => $params['sizes']);
            $sizeres = $this->addProductSizeMApping($sizeparams);

            if ($sizeres['error']['err_code'] == '0') {


                #Product Metal Purity Mapping
                $mprLen = sizeof($params['metalpurity']);

                if ($mprLen > 1) {
                    $customise_purity = 0;
                } else {
                    $customise_purity = 1;
                }
                $metalPurityparams = array('productid' => $params['productid'], 'updatedby' => $userid, 'metalpurity' => $params['metalpurity']);
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
                        $pcode = $this->generateProductCode();
                        $genDetails = array('productid' => $params['productid'], 'product_code' => $pcode, 'customise_purity' => $customise_purity, 'customise_color' => $customise_color, 'has_diamond' => $params['has_diamond'], 'has_solitaire' => $params['has_solitaire'], 'has_uncut' => $params['has_uncut'], 'has_gemstone' => $params['has_gemstone'], 'updatedby' => $userid, 'details' => $params['details']);
                        $renres = $this->addProductGeneralDetails($genDetails);

                        if ($renres['error']['err_code'] == "1") {
                            $result = array();
                            $err = array('err_code' => 1, 'err_msg' => 'Error in adding general details of product');
                            $results = array('result' => $result, 'error' => $err);
                            return $results;
                        }
                    } else {
                        $result = array();
                        $err = array('err_code' => 1, 'err_msg' => 'Error in adding product metal color');
                        $results = array('result' => $result, 'error' => $err);
                        return $results;
                    }
                } else {
                    $result = array();
                    $err = array('err_code' => 1, 'err_msg' => 'Error in adding product metal purity');
                    $results = array('result' => $result, 'error' => $err);
                    return $results;
                }
            } else {
                $result = array();
                $err = array('err_code' => 1, 'err_msg' => 'Error in adding product sizes');
                $results = array('result' => $result, 'error' => $err);
                return $results;
            }
        } else {
            $result = array();
            $err = array('err_code' => 1, 'err_msg' => 'Error in adding category');
            $results = array('result' => $result, 'error' => $err);
            return $results;
        }
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
                . ",'" . $params['details']['product_name'] . "'"
                . ",'" . $params['details']['product_seo_name'] . "'"
                . ",'" . $params['details']['gender'] . "'"
                . "," . $params['details']['product_weight'] . ""
                . ",'" . $params['details']['diamond_setting'] . "'"
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
            $sid = $this->getSizeIdByValue($key);
            $tmpparams = array('size_id' => $sid, 'updatedby' => $params['updatedby'], 'productid' => $params['productid'], 'quantity' => $val);

            $sql.="(" . $tmpparams['productid'] . "," . $tmpparams['size_id'] . "," . $tmpparams['quantity'] . ",now()," . $tmpparams['updatedby'] . "),";
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

            $purityid = $this->getMetalPurityIdByValue($val);
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

            $colorid = $this->getMetalColorIdByValue($val);
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
            $tmpparams = array('shape' => $solt['shape'], 'color' => $solt['color'], 'clarity' => $solt['clarity'], 'cut' => $solt['cut'], 'symmetry' => $solt['symmetry'], 'polish' => $solt['polish'], 'fluorescence' => $solt['fluorescence'], 'carat' => $solt['carat'], 'price_per_carat' => $solt['price_per_carat'], 'table' => $solt['table'], 'crown_angle' => $solt['crown_angle'], 'girdle' => $solt['girdle'], 'solitaire_id' => $solid, 'updatedby' => $params['updatedby'], 'productid' => $params['productid']);

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
                $qulid = $this->getDiamondQualityIdByValue($dqul);
                $qltmpparams = array('diamond_id' => $dmdid, 'updatedby' => $params['updatedby'], 'id' => $qulid);

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

}
?>



