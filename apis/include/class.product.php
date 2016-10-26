<?php

include_once APICLUDE . 'common/db.class.php';

class product extends DB {

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
        $rNo = mt_rand(1000000000, 9999999999);
        $pcode = "JZEVA".$rNo;
        return $pcode;
    }

    public function checkVproductCode($params)
    {
        if($params['case'] == '1')
        {
            $sql = "SELECT
                                productid
                      FROM
                                tbl_product_master
                      WHERE
                                vendor_prd_code = \"". $params['code'] ."\"
                      AND
                                productid NOT IN (".$params['pid'].")
                      AND
                                active_flag=1";
        }
        if($params['case'] == '2')
        {
            $sql = "SELECT
                                productid
                      FROM
                                tbl_product_master
                      WHERE
                                vendor_prd_code = \"". $params['code'] ."\"
                      AND
                                active_flag=1";
        }
        $res = $this->query($sql);
        $cnt = $this->numRows($res);
        if($cnt > 0)
        {
            $arr = array();
            $err = array('code'=>1,'msg'=>'Vendor Code is already used');
        }
        else
        {
            $arr = array();
            $err = array('code'=>0,'msg'=>'Vendor Code is not yet used');
        }

        $result = array('result'=>$arr,'error'=>$err);
        return $result;
    }

    public function addProduct($params) 
    { 
        $params = json_decode($params[0],1);
        if(!$params['productid'])
        {
            $pid = $this->generateId();
            $params['productid']=$pid;
            $pcode = $this->generateProductCode();
            $params['product_code']=$pcode;
        }

        $userid = $params['userid'];

        #ADDING CATEGORY MAPPING FOR CURRENT PRODUCT

        $tmpattrparams = array
                            (
                                'attrvalues' => $params['filterAttrs'],
                                'userid' => $userid,
                                'pid' => $params['productid']
                            );

        $attrres = $this->addPrdAtributeValuesMapping($tmpattrparams);

        $catids = explode(",", $params['catid']);
        $tmpcatparams = array
                            (
                                'catid' => $params['catid'],
                                'userid' => $userid,
                                'pid' => $params['productid']
                            );
        $catres = $this->addCatProductMapping($tmpcatparams);
        if ($catres['error']['err_code'] == 0)
        {

            $sizeparams = array
                            (
                                'productid' => $params['productid'],
                                'updatedby' => $userid,
                                'sizes' => $params['sizes']
                            );

            if(sizeof($params['sizes']))
                $sizeres = $this->addProductSizeMApping($sizeparams);

                #Product Metal Purity Mapping
                $mprLen = sizeof($params['mpurity']);

                if ($mprLen > 1)
                {
                    $customise_purity = 0;
                }
                else
                {
                    $customise_purity = 1;
                }

                $metalPurityparams = array
                                        (
                                            'productid' => $params['productid'],
                                            'updatedby' => $userid,
                                            'metalpurity' => $params['mpurity']
                                        );

                $mpurityres = $this->addProductMetalPurityMapping($metalPurityparams);

                if ($mpurityres['error']['err_code'] == 0)
                {
                    #Product Metal Color Mapping
                    $mclrLen = sizeof($params['metalcolor']);

                    if ($mclrLen > 1)
                    {
                        $customise_color = 0;
                    }
                    else
                    {
                        $customise_color = 1;
                    }

                    $metalColorparams = array
                                            (
                                                'productid' => $params['productid'],
                                                'updatedby' => $userid,
                                                'metalcolors' => $params['metalcolor']
                                            );

                    $mcolorres = $this->addProductMetalColorMapping($metalColorparams);

                    if ($mcolorres['error']['err_code'] == 0)
                    {

                        #Adding Solitaire To Product
                        if ($params['has_solitaire'])
                        {

                            $solitairesparams = array
                                                    (
                                                        'productid' => $params['productid'],
                                                        'updatedby' => $userid,
                                                        'solitaires' => $params['solitaires']
                                                    );
                            $solres = $this->addSolitaire($solitairesparams);

                            if ($solres['error']['err_code'] == "1")
                            {
                                $result = array();
                                $err = array
                                            (
                                                'err_code' => 1,
                                                'err_msg' => 'Error in adding solitaire'
                                            );
                                $results = array
                                                (
                                                    'result' => $result,
                                                    'error' => $err
                                                );
                                return $results;
                            }
                        }


                        #Adding Diamond To Product
                        if ($params['has_diamond'])
                        {

                            $diamondresparams = array
                                                    (
                                                        'productid' => $params['productid'],
                                                        'updatedby' => $userid,
                                                        'diamonds' => $params['diamonds']
                                                    );

                            $diamondres = $this->addDiamond($diamondresparams);

                            if ($diamondres['error']['err_code'] == "1")
                            {
                                $result = array();
                                $err = array
                                            (
                                                'err_code' => 1,
                                                'err_msg' => 'Error in adding diamond'
                                            );

                                $results = array
                                                (
                                                    'result' => $result,
                                                    'error' => $err
                                                );
                                return $results;
                            }
                        }


                        #Adding Uncut Diamond To Product
                        if ($params['has_uncut'])
                        {

                            $uncutparams = array
                                                (
                                                    'productid' => $params['productid'],
                                                    'updatedby' => $userid,
                                                    'uncut' => $params['uncut']
                                                );

                            $uncutdmdres = $this->addUncutDiamond($uncutparams);

                            if ($uncutdmdres['error']['err_code'] == "1")
                            {
                                $result = array();
                                $err = array
                                            (
                                                'err_code' => 1,
                                                'err_msg' => 'Error in adding uncut diamond'
                                            );

                                $results = array
                                                (
                                                    'result' => $result,
                                                    'error' => $err
                                                );
                                return $results;
                            }
                        }


                        #Adding Gemstone To Product
                        if ($params['has_gemstone'])
                        {

                            $gemstoneparams = array
                                                (
                                                    'productid' => $params['productid'],
                                                    'updatedby' => $userid,
                                                    'gemstone' => $params['gemstone']
                                                );

                            $gemres = $this->addGemstone($gemstoneparams);


                            if ($gemres['error']['err_code'] == "1")
                            {
                                $result = array();
                                $err = array
                                            (
                                                'err_code' => 1,
                                                'err_msg' => 'Error in adding gemstone to product'
                                            );
                                $results = array
                                                (
                                                    'result' => $result,
                                                    'error' => $err
                                                );
                                return $results;
                            }
                        }


                        #Adding General Product Details

                        $genDetails = array
                                        (
                                            'productid' => $params['productid'],
                                            'product_code' => $params['product_code'],
                                            'productDescription' => addSlashes(stripslashes(urldecode($params['details']['productDescription']))),
                                            'vPCode' => $params['details']['vPCode'],
                                            'jewelleryType' => $params['details']['jewelleryType'],
                                            'leadTime' => $params['details']['leadTime'],
                                            'returneligible' => $params['details']['eligible'],
                                            'customise_purity' => $customise_purity,
                                            'customise_color' => $customise_color,
                                            'has_diamond' => $params['has_diamond'],
                                            'has_solitaire' => $params['has_solitaire'],
                                            'has_uncut' => $params['has_uncut'],
                                            'has_gemstone' => $params['has_gemstone'],
                                            'updatedby' => $userid,
                                            'details' => $params['details']
                                        );

                        $renres = $this->addProductGeneralDetails($genDetails);

                        if ($renres['error']['err_code'] == "1")
                        {
                            $result = array();
                            $err = array
                                        (
                                            'err_code' => 1,
                                            'err_msg' => 'Error in adding general details of product'
                                        );
                            $results = array
                                        (
                                            'result' => $result,
                                            'error' => $err
                                        );
                            return $results;
                        }
                    }
                    else
                    {
                        $result = array();
                        $err = array
                                    (
                                        'err_code' => 1,
                                        'err_msg' => 'Error in adding product metal color'
                                    );
                        $results = array
                                    (
                                        'result' => $result,
                                        'error' => $err
                                    );
                        return $results;
                    }
                }
                else
                {
                    $result = array();
                    $err = array
                                (
                                    'err_code' => 1,
                                    'err_msg' => 'Error in adding product metal purity'
                                );
                    $results = array
                                (
                                    'result' => $result,
                                    'error' => $err
                                );
                    return $results;
                }
        }
        else
        {
            $result = array();
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in adding category'
                        );
            $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
            return $results;
        }


        $result = array
                        (
                            'product id' =>$params['productid']
                        );
        $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Product Added Successfully'
                        );
        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;

    }


    public function addPrdAtributeValuesMapping($params)
    {
        $delsql="
                    DELETE
                    FROM
                            tbl_product_attributes_mapping
                    WHERE
                            productid='".$params['pid']."'
                ";

        $res = $this->query($delsql);

        $sql="
                INSERT
                INTO
                        tbl_product_attributes_mapping
                        (
                            productid,
                            attributeid,
                            value,
                            createdon,
                            updatedby
                        )
                VALUES
            ";

            foreach ($params['attrvalues'] as $key=>$val)
            {
                $val=  urldecode($val);
                $tmpparams = array
                                (
                                    'attributeid' => $key,
                                    'userid' => $params['userid'],
                                    'pid' => $params['pid']
                                );
                $sql.="(
                            '" . $params['pid'] . "',
                            "  . $tmpparams['attributeid'] . ",
                            '" . $val . "',
                                 now(),
                            "  . $tmpparams['userid'] . "
                        ),";
            }
        $sql = trim($sql, ",");

        $res = $this->query($sql);
        $result = array();

        if ($res)
        {
            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data inserted successfully'
                        );
        }

        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in inserting'
                        );
        }

        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;
    }

    public function getPrdAtributeValues($pid)
    {
        $sql="
                SELECT
                        attributeid as attid,
                        value
                FROM
                        tbl_product_attributes_mapping
                WHERE
                        productid = '".$pid."'
            ";

        $res=$this->query($sql);

        if($res)
        {
            while($row=$this->fetchData($res))
            {
                $reslt[]=$row;
            }

            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data fetched successfully'
                        );
        }

        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in fetching'
                        );
        }

        $results = array
                        (
                            'result' => $reslt,
                            'error' => $err
                        );
        return $results;
    }

    public function addCatProductMapping($params)
    {
        $catids = explode(",", $params['catid']);

        $sql = "INSERT
                INTO
                        tbl_category_product_mapping
                        (
                            catid,
                            productid,
                            createdon,
                            updatedby)
                VALUES ";
        foreach ($catids as $val)
        {
            $tmpparams = array
                            (
                                'catid' => $val,
                                'userid' => $params['userid'],
                                'pid' => $params['pid']
                            );
            $sql.=  "(
                            " . $tmpparams['catid'] . ",
                            " . $tmpparams['pid'] . ",
                                now(),
                            " . $tmpparams['userid'] . "
                    ),";
        }
        $sql = trim($sql, ",");

        $sql.="
                    ON DUPLICATE KEY UPDATE
                                catid = VALUES(catid),
                                updatedby=VALUES(updatedby)";

        $res = $this->query($sql);
        $result = array();
        if ($res)
        {
            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data inserted successfully'
                        );
        }
        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in inserting'
                        );
        }
        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;
    }

    public function addProductGeneralDetails($params)
    {
        $sql = "INSERT
                INTO "
                        . "tbl_product_master "
                        . "(productid,"
                        . "product_code,"
                        . "productDescription,"
                        . "vendorid,"
                        . "vendor_prd_code,"
                        . "jewelleryType,"
                        . "leadTime,"
                        . "returneligible,"
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
                        . "(\"" . $params['productid'] . "\","
                        . "\"" . $params['product_code'] . "\""
                        . ",\"" . $params['productDescription'] . "\""
                        . ",\"" . $params['details']['vendorid'] . "\""
                        . ",\"" . $params['vPCode'] . "\""
                        . ",\"" . $params['jewelleryType'] . "\""
                        . ",\"" . $params['leadTime'] . "\""
                        . ",\"" . $params['returneligible'] . "\""
                        . ",\"" . urldecode($params['details']['product_name']) . "\""
                        . ",\"" . urldecode($params['details']['product_seo_name']) . "\""
                        . ",\"" . $params['details']['gender'] . "\""
                        . ",\"" . $params['details']['product_weight'] . "\""
                        . ",\"" . urldecode($params['details']['dmdSetting']) . "\""
                        . ",\"" . $params['details']['metal_weight'] . "\""
                        . ",\"" . $params['details']['making_charges'] . "\""
                        . ",\"" . $params['details']['procurement_cost'] . "\""
                        . ",\"" . $params['details']['margin'] . "\""
                        . ",\"" . $params['details']['measurement'] . "\""
                        . ",\"" . $params['customise_purity'] . "\""
                        . ",\"" . $params['customise_color'] . "\""
                        . ",\"" . $params['details']['certificate'] . "\""
                        . ",\"" . $params['has_diamond'] . "\""
                        . ",\"" . $params['has_solitaire'] . "\""
                        . ",\"" . $params['has_uncut'] . "\""
                        . ",\"" . $params['has_gemstone'] . "\""
                        . ",now()"
                        . ",\"" . $params['updatedby'] . "\")";


        $sql.="
                ON DUPLICATE KEY UPDATE "
                        . "vendorid = VALUES(vendorid),"
                        . "vendor_prd_code = VALUES(vendor_prd_code),"
                        . "productDescription = VALUES(productDescription),"
                        . "jewelleryType = VALUES(jewelleryType),"
                        . "leadTime = VALUES(leadTime),"
                        . "returneligible = VALUES(returneligible),"
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
                        . " updatedby=VALUES(updatedby)
                ";
        $res = $this->query($sql);
        $result = array();
        if ($res)
        {
            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data inserted successfully'
                        );
        }
        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in inserting'
                        );
        }
        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;
    }

    public function addProductSizeMApping($params)
    {
        $dactivesql="
                        DELETE
                        FROM
                                tbl_product_size_mapping
                        WHERE
                                productid=".$params['productid'];
        $dares=  $this->query($dactivesql);

        $sql = "
                    INSERT
                    INTO
                            tbl_product_size_mapping
                            (
                                productid,
                                size_id,
                                quantity,
                                createdon,
                                updatedby
                            )
                    VALUES ";
        foreach ($params['sizes'] as $key => $val)
        {
            foreach ($val as $key1 => $val1)
            {
                $tmpparams = array
                                (
                                    'size_id'  => $key1,
                                    'updatedby' => $params['updatedby'],
                                    'productid' => $params['productid'],
                                    'quantity' => $val1
                                );
                $sql.="
                            (
                                " . $tmpparams['productid'] . ",
                                " . $key1 . ",
                                " . $val1 . ",
                                    now(),
                                " . $tmpparams['updatedby'] . "
                            ),";

            }
        }
        $sql = trim($sql, ",");
        $sql.=  "
                    ON DUPLICATE KEY UPDATE
                                    quantity = VALUES(quantity),
                                    updatedby=VALUES(updatedby)
                ";


        $res = $this->query($sql);
        $result = array();
        if ($res)
        {
            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data inserted successfully'
                        );
        }
        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in inserting'
                        );
        }
        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;
    }

    public function getSizeIdByValue($size)
    {
        $sql = "
                    SELECT
                            id
                    FROM
                            tbl_size_master
                    WHERE
                            size_value=" . $size;
        $res = $this->query($sql);
        $result = array();

        if ($res)
        {
            $row = $this->fetchData($res);
            $sid = $row['id'];
            return $sid;
        }
    }

    public function addProductMetalPurityMapping($params)
    {
        $dactivesql="
                        DELETE
                        FROM
                                tbl_product_metal_purity_mapping
                        WHERE
                                productid=".$params['productid'];

        $dares=  $this->query($dactivesql);

        $sql = "
                    INSERT
                    INTO
                            tbl_product_metal_purity_mapping
                            (
                                productid,
                                id,
                                createdon,
                                updatedby
                            )
                    VALUES";

        foreach ($params['metalpurity'] as $key => $val)
        {

            #$purityid = $this->getMetalPurityIdByValue($val);
            $purityid =$val;
            $tmpparams = array
                            (
                                'id' => $purityid,
                                'updatedby' => $params['updatedby'],
                                'productid' => $params['productid']
                            );

            $sql.="
                        (
                            " . $tmpparams['productid'] . ",
                            " . $tmpparams['id'] . ",
                                now(),
                            " . $tmpparams['updatedby'] . "
                        ),";
        }

        $sql = trim($sql, ",");
        $sql.=  "
                    ON DUPLICATE KEY UPDATE
                                    updatedby=VALUES(updatedby)
                ";
        $res = $this->query($sql);
        $result = array();
        if ($res)
        {
            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data inserted successfully'
                        );
        }
        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in inserting'
                        );
        }
        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;
    }

    public function getMetalPurityIdByValue($value)
    {
        $sql = "
                    SELECT
                            id
                    FROM
                            tbl_metal_purity_master
                    WHERE
                            dname='" . strtolower($value) . "'
                ";
        $res = $this->query($sql);
        $result = array();

        if ($res)
        {
            $row = $this->fetchData($res);
            $purityid = $row['id'];
            return $purityid;
        }
    }

    public function addProductMetalColorMapping($params)
    {
        $dactivesql="
                        DELETE
                        FROM
                                tbl_product_metal_color_mapping
                        WHERE
                                productid=".$params['productid'];
        $dares=  $this->query($dactivesql);

        $sql = "
                    INSERT
                    INTO
                            tbl_product_metal_color_mapping
                            (
                                productid,
                                id,
                                createdon,
                                updatedby
                            )
                    VALUES";

        foreach ($params['metalcolors']as $key => $val)
        {

            #$colorid = $this->getMetalColorIdByValue($val);
            $colorid = $val;
            $tmpparams = array
                            (
                                'id' => $colorid,
                                'updatedby' => $params['updatedby'],
                                'productid' => $params['productid']
                            );

            $sql.="
                        (
                            " . $tmpparams['productid'] . ",
                            " . $tmpparams['id'] . ",
                                now(),
                            " . $tmpparams['updatedby'] . "
                        ),";
        }


        $sql = trim($sql, ",");
        $sql.=  "
                    ON DUPLICATE KEY UPDATE
                                    id = VALUES(id),
                                    updatedby=VALUES(updatedby)
                ";

        $res = $this->query($sql);
        $result = array();
        if ($res)
        {
            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data inserted successfully'
                        );
        }
        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in inserting'
                        );
        }
        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;
    }

    public function getMetalColorIdByValue($value)
    {
        $sql = "
                    SELECT
                            id
                    FROM
                            tbl_metal_color_master
                    WHERE
                            dname='" . strtolower($value) . "'";
        $res = $this->query($sql);
        $result = array();

        if ($res)
        {
            $row = $this->fetchData($res);
            $colorid = $row['id'];
            return $colorid;
        }
    }

    public function getMetalColorList($params)
    {
        $sql = "
                    SELECT
                            id,
                            dname,
                            dvalue
                    FROM
                            tbl_metal_color_master
                    WHERE
                            active_flag = 1";

        $page = ($params['page'] ? $params['page'] : 1);
        $limit = ($params['limit'] ? $params['limit'] : 1000);

        if ($limit >1000 )
        {
            $limit = 1000;
        }
        if (!empty($page))
        {
            $start = ($page * $limit) - $limit;
            $sql.=" LIMIT " . $start . ",$limit";
        }

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
            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data fetched successfully'
                        );
        }
        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in inserting'
                        );
        }
        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;
    }

    public function getVendorList($params)
    {
        $sql = "SELECT
                        vendorid,
                        name,
                        city,
                        mobile,
                        email,
                        lng,
                        lat
                FROM
                        tbl_vendor_master
                WHERE
                        active_flag =1 ";

        $page = ($params['page'] ? $params['page'] : 1);
        $limit = ($params['limit'] ? $params['limit'] : 1000);

        if ($limit >1000 )
        {
            $limit = 1000;
        }
        if (!empty($page))
        {
            $start = ($page * $limit) - $limit;
            $sql.=" LIMIT " . $start . ",$limit";
        }
        $res = $this->query($sql);
        $result = array();

        if ($this->numRows($res)>0)
        {
            while ($row = $this->fetchData($res))
            {
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

            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data fetched successfully'
                        );
        }
        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in inserting'
                        );
        }
        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;
    }

    public function getVendorDetailsById($vid)
    {
        $sql = "SELECT
                        vendorid,
                        name,
                        city,
                        mobile,
                        email,
                        lng,
                        lat
                FROM
                        tbl_vendor_master
                WHERE
                        vendorid='" . $vid . "'
                ";
        $res = $this->query($sql);
        $result = array();

        if ($res)
        {
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
            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data fetched successfully'
                        );
        }
        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in inserting'
                        );
        }

        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;
    }

    public function getVendorDetailsByName($name)
    {
        $sql = "
                    SELECT
                                vendorid,
                                name,
                                city,
                                mobile,
                                email,
                                lng,
                                lat
                    FROM
                                tbl_vendor_master
                    WHERE
                                name='" . $name . "'";
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
            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data fetched successfully'
                        );
        }
        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in inserting'
                        );
        }
        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;
    }

    public function addSolitaire($params)
    {

        $sql = "INSERT
                INTO
                        tbl_product_solitaire_mapping
                        (
                            productid,
                            solitaire_id,
                            shape,
                            color,
                            clarity,
                            cut,
                            symmetry,
                            polish,
                            fluorescence,
                            carat,
                            price_per_carat,
                            table_no,
                            crown_angle,
                            girdle,
                            no_of_solitaire,
                            createdon,
                            updatedby
                        )
                VALUES
                ";

        foreach ($params['solitaires'] as $solt)
        {
            if(!$solt['solitaire_id'])
            {
                $solid = $this->generateId();
            }
            else
            {
                $solid = $solt['solitaire_id'];
            }

            $tmpparams = array
                            (
                                'shape' => $solt['shape'],
                                'color' => $solt['color'],
                                'clarity' => $solt['clarity'],
                                'cut' => urldecode($solt['cut']),
                                'symmetry' => urldecode($solt['symmetry']),
                                'polish' => urldecode($solt['polish']),
                                'fluorescence' => urldecode($solt['fluorescence']),
                                'carat' => $solt['carat'],
                                'price_per_carat' => $solt['price_per_carat'],
                                'table' => $solt['table'],
                                'crown_angle' => $solt['crown_angle'],
                                'girdle' => $solt['girdle'],
                                'no_of_solitaire' => $solt['nofs'],
                                'solitaire_id' => $solid,
                                'updatedby' => $params['updatedby'],
                                'productid' => $params['productid']
                            );

            $sql.="
                        (
                            '" . $tmpparams['productid'] . "',
                            '" . $tmpparams['solitaire_id'] . "',
                            '" . $tmpparams['shape'] . "',
                            '" . $tmpparams['color'] . "',
                            '" . $tmpparams['clarity'] . "',
                            '" . $tmpparams['cut'] . "',
                            '" . $tmpparams['symmetry'] . "',
                            '" . $tmpparams['polish'] . "',
                            '" . $tmpparams['fluorescence'] . "',
                            "  . $tmpparams['carat'] . ",
                            "  . $tmpparams['price_per_carat'] . ",
                            '" . $tmpparams['table'] . "',
                            '" . $tmpparams['crown_angle'] . "',
                            '" . $tmpparams['girdle'] . "',
                            '" . $tmpparams['no_of_solitaire'] . "',
                                 now(),
                            "  . $params['updatedby'] . "
                        ),";
        }

        $sql = trim($sql, ",");
        $sql.="
                ON DUPLICATE KEY UPDATE
                        shape = VALUES(shape),
                        color = VALUES(color),
                        clarity = VALUES(clarity),
                        cut = VALUES(cut),
                        symmetry = VALUES(symmetry),
                        polish= VALUES(polish),
                        fluorescence = VALUES(fluorescence),
                        carat = VALUES(carat),
                        price_per_carat = VALUES(price_per_carat),
                        table_no = VALUES(table_no),
                        crown_angle = VALUES(crown_angle),
                        girdle = VALUES(girdle),
                        no_of_solitaire = VALUES(no_of_solitaire),
                        updatedby=VALUES(updatedby)
                ";

        $res = $this->query($sql);
        $result = array();
        if ($res)
        {
            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data inserted successfully'
                        );
        }
        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in inserting'
                        );
        }

        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;
    }


    public function changeSolitaireStatus($params)
    {
        $params= json_decode($params[0],1);
        $sql = "
                    UPDATE
                            tbl_product_solitaire_mapping
                    SET
                            active_flag=".$params['active_flag'].",
                            updatedby = '".$params['updatedby']."'
                    WHERE
                            productid = '".$params['productid']."'
                    AND
                            solitaire_id = '".$params['solitaire_id']."'
                ";
        $res = $this->query($sql);
        $result = array();
        if ($res)
        {
            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data updated successfully'
                        );
        }
        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in updating'
                        );
        }
        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;

    }

    public function changeDiamondStatus($params)
    {
        $params= json_decode($params[0],1);
        $sql = "
                    UPDATE
                                tbl_product_diamond_mapping
                    SET
                                active_flag=".$params['active_flag'].",
                                updatedby = '".$params['updatedby']."'
                    WHERE
                                productid = '".$params['productid']."'
                    AND
                                diamond_id = '".$params['diamond_id']."'
                ";
        $res = $this->query($sql);
        $result = array();
        if ($res)
        {
            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data updated successfully'
                        );
        }
        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in updating'
                        );
        }
        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;

    }


    public function addDiamond($params)
    {

        $sql = "
                    INSERT
                    INTO
                            tbl_product_diamond_mapping
                            (
                                productid,
                                diamond_id,
                                shape,
                                carat,
                                total_no,
                                createdon,
                                updatedby
                            )
                    VALUES";

        $qulsql =   "
                        INSERT
                        INTO
                                tbl_diamond_quality_mapping
                                (
                                    diamond_id,
                                    id,
                                    createdon,
                                    updatedby
                                )
                        VALUES
                    ";

        foreach ($params['diamonds'] as $dmd)
        {

            if(!$dmd['diamond_id'])
            {
                $dmdid = $this->generateId();
            }
            else
            {
                $dmdid = $dmd['diamond_id'];
            }

            $tmpparams = array
                            (
                                'quality' => $dmd['quality'],
                                'shape' => $dmd['shape'],
                                'carat' => $dmd['carat'],
                                'total_no' => $dmd['total_no'],
                                'diamond_id' => $dmdid,
                                'updatedby' => $params['updatedby'],
                                'productid' => $params['productid']
                            );

            $sql.="
                    (
                        '" . $tmpparams['productid'] . "',
                        '" . $tmpparams['diamond_id'] . "',
                        '" . $tmpparams['shape'] . "',
                        "  . $tmpparams['carat'] . ",
                        "  . $tmpparams['total_no'] . ",
                             now(),
                        " . $tmpparams['updatedby'] . "
                    ),
                ";


            foreach ($dmd['quality'] as $dqul)
            {

                $qltmpparams = array
                                (
                                    'diamond_id' => $dmdid,
                                    'updatedby' => $params['updatedby'],
                                    'id' => $dqul
                                );

                $qulsql.="
                            (
                                " . $qltmpparams['diamond_id'] . ",
                                " . $qltmpparams['id'] . ",
                                    now(),
                                " . $qltmpparams['updatedby'] . "
                            ),
                        ";
            }
        }

        $sql = trim(trim($sql), ",");
        $sql.=  "
                    ON DUPLICATE KEY UPDATE
                            shape = VALUES(shape),
                            carat = VALUES(carat),
                            total_no = VALUES(total_no),
                            updatedby=VALUES(updatedby)
                ";


        $qulsql = trim(trim($qulsql), ",");
        $qulsql.="
                    ON DUPLICATE KEY UPDATE
                            updatedby=VALUES(updatedby)
                ";

        $dsql=  "
                    DELETE
                    FROM
                            tbl_diamond_quality_mapping
                    WHERE
                            diamond_id ='".$dmdid."'
                ";
        $dres = $this->query($dsql);
        $dmdprdRes = $this->addPrdDiamondMapping($sql);
        $dmdQltRes = $this->addDiamondQualityMapping($qulsql);


        if ($dmdprdRes['error']['err_code'] == 0 && $dmdQltRes['error']['err_code'] == 0)
        {
            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data inserted successfully'
                        );
        }
        else
        {
            if ($dmdprdRes['error']['err_code'] == 1)
            {
                $err = array
                            (
                                'err_code' => 1,
                                'err_msg' => 'Error in adding diamond to product'
                            );
            }
            else if ($dmdQltRes['error']['err_code'] == 1)
            {
                $err = array
                            (
                                'err_code' => 1,
                                'err_msg' => 'Error in adding diamond quality to product'
                            );
            }
        }
            $result = array();
            $results = array
                            (
                                'result' => $result,
                                'error' => $err
                            );
        return $results;
    }

    public function addPrdDiamondMapping($sql)
    {
        $res = $this->query($sql);
        $result = array();
        if ($res)
        {
            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data inserted successfully'
                        );
        }
        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in inserting'
                        );
        }
        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;
    }

    public function addDiamondQualityMapping($sql)
    {
        $res = $this->query($sql);
        $result = array();
        if ($res)
        {
            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data inserted successfully'
                        );
        }
        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in inserting'
                        );
        }
        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;
    }

    public function getDiamondQualityIdByValue($value)
           
    {
        $sql = "
                    SELECT
                            id
                    FROM
                            tbl_diamond_quality_master
                    WHERE
                            dname='" . strtolower($value) . "'
                ";
        $res = $this->query($sql);
        $result = array();

        if ($res)
        {
            $row = $this->fetchData($res);
            $qid = $row['id'];
            return $qid;
        }
    }

    public function getDiamondQualityList($params)
    {
        $sql= "SELECT
                        id,
                        dname,
                        dvalue,
                        price_per_carat
                FROM
                        tbl_diamond_quality_master
                WHERE
                        active_flag =1
                        ";

        $page = ($params['page'] ? $params['page'] : 1);
        $limit = ($params['limit'] ? $params['limit'] : 1000);

        if ($limit >1000 )
        {
            $limit = 1000;
        }

        if (!empty($page))
        {
            $start = ($page * $limit) - $limit;
            $sql.=" LIMIT " . $start . ",$limit";
        }
        $res=$this->query($sql);

        if($this->numRows($res)>0)
        {
            while($row = $this->fetchData($res))
            {
                $reslt['id'] =$row['id'];
                $reslt['name'] = $row['dname'];
                $reslt['value'] = $row['dvalue'];
                $reslt['price'] =  intval($row['price_per_carat']);
                $result[]=$reslt;

            }
            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data fetched successfully'
                        );
        }
        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in inserting'
                        );
        }
        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;

    }


    public function addUncutDiamond($params)
    {
        $sql = "
                    INSERT
                    INTO
                            tbl_product_uncut_mapping
                            (
                                productid,
                                uncut_id,
                                color,
                                quality,
                                total_no,
                                carat,
                                price_per_carat,
                                createdon,
                                updatedby
                            )
                    VALUES
                ";

        foreach ($params['uncut'] as $arr)
        {
            if(!$arr['uncut_id'])
            {
                $uncutid = $this->generateId();
            }
            else
            {
                $uncutid = $arr['uncut_id'];
            }

            $tmpparams = array
                            (
                                'productid' => $params['productid'],
                                'uncut_id' => $uncutid,
                                'color' => $arr['color'],
                                'quality' => $arr['quality'],
                                'carat' => $arr['carat'],
                                'price_per_carat' => $arr['price_per_carat'],
                                'total_no' => $arr['total_no'],
                                'updatedby' => $params['updatedby']
                            );

            $sql.=  "
                        (
                            "  . $tmpparams['productid'] . ",
                            "  . $uncutid . ",
                            '" . $tmpparams['color'] . "',
                            '" . $tmpparams['quality'] . "',
                            "  . $tmpparams['total_no'] . ",
                            "  . $tmpparams['carat'] . ",
                            "  . $tmpparams['price_per_carat'] . ",
                                 now(),
                            "  . $tmpparams['updatedby'] . "
                        ),";
        }

        $sql = trim($sql, ",");
        $sql.=  "
                    ON DUPLICATE KEY UPDATE
                                    color = VALUES(color),
                                    quality = VALUES(quality),
                                    total_no = VALUES(total_no),
                                    carat = VALUES(carat),
                                    price_per_carat = VALUES(price_per_carat),
                                    updatedby=VALUES(updatedby)
                ";

        $res = $this->query($sql);
        $result = array();
        if ($res)
        {
            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data inserted successfully'
                        );
        }
        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in inserting'
                        );
        }
        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;
    }

    public function changeUncutStatus($params)
    {
        $params= json_decode($params[0],1);
        $sql = "
                    UPDATE
                            tbl_product_uncut_mapping
                    SET
                            active_flag=".$params['active_flag'].",
                            updatedby = '".$params['updatedby']."'
                    WHERE
                            productid = '".$params['productid']."'
                    AND
                            uncut_id = '".$params['uncut_id']."'
                ";
        $res = $this->query($sql);
        $result = array();
        if ($res)
        {
            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data updated successfully'
                        );
        }
        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in updating'
                        );
        }
        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;

    }

    public function changeGemstoneStatus($params)
    {
        $params= json_decode($params[0],1);
        $sql = "
                    UPDATE
                                tbl_product_gemstone_mapping
                    SET
                                active_flag=".$params['active_flag'].",
                                updatedby = '".$params['updatedby']."'
                    WHERE
                                productid = '".$params['productid']."'
                    AND
                                gemstone_id = '".$params['gemstone_id']."'
                ";
        $res = $this->query($sql);
        $result = array();
        if ($res)
        {
            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data updated successfully'
                        );
        }
        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in updating'
                        );
        }
        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;

    }


    public function addGemstone($params)
    {
        $dsql=  "
                    UPDATE
                            tbl_product_gemstone_mapping
                    SET
                            active_flag = 0
                    WHERE
                            productid ='".$params['productid']."'
                ";
        $dres = $this->query($dsql);

        $sql = "
                INSERT
                INTO
                        tbl_product_gemstone_mapping
                        (
                            productid,
                            gemstone_id,
                            gemstone_name,
                            total_no,
                            carat,
                            price_per_carat,
                            createdon,
                            updatedby
                        )
                VALUES";

        foreach ($params['gemstone'] as $arr)
        {
            $garr = $this->getGemstoneDetailsById($arr['gvalue']);
            $gname = $garr['result']['name'];
            $gemstoneid =$arr['gvalue'];

            $tmpparams = array
                            (
                                'productid' => $params['productid'],
                                'total_no' => $arr['total_no'],
                                'carat' => $arr['carat'],
                                'price_per_carat' => $arr['price_per_carat'],
                                'updatedby' => $params['updatedby']
                            );
            $sql.=  "
                        (
                            '" . $tmpparams['productid'] . "',
                            " . $gemstoneid . ",
                            '" . $gname . "',
                            " . $tmpparams['total_no'] . ",
                            " . $tmpparams['carat'] . ",
                            " . $tmpparams['price_per_carat'] . ",
                                now(),
                            " . $tmpparams['updatedby'] . "
                        ),
                    ";
        }
        $sql = trim(trim($sql), ",");

        $sql.=  "
                    ON DUPLICATE KEY UPDATE
                                        total_no = VALUES(total_no),
                                        carat = VALUES(carat),
                                        price_per_carat = VALUES(price_per_carat),
                                        updatedby=VALUES(updatedby),
                                        active_flag = 1
                ";

        $res = $this->query($sql);
        $result = array();
        if ($res)
        {
            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data inserted successfully'
                        );
        }
        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in inserting'
                        );
        }
        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;
    }

    public function getGemstoneDetailsById($gid)
    {

        $sql = "
                    SELECT
                            id,
                            gemstone_name,
                            description
                    FROM
                            tbl_gemstone_master
                    WHERE
                            id=" . $gid;
        $res = $this->query($sql);
        $row = $this->fetchData($res);

        $result = array();

        if ($res)
        {
            $reslt['id'] = $row['id'];
            $reslt['name'] = $row['gemstone_name'];
            $reslt['desc'] = $row['description'];
            $result = $reslt;
            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data fetched successfully'
                        );
        }
        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in inserting'
                        );
        }
        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;
    }

    public function getGemstoneList($params)
    {

        $sql = "SELECT
                        id,
                        gemstone_name,
                        description
                FROM
                        tbl_gemstone_master
                WHERE
                        active_flag =1
                        ";

        $page = ($params['page'] ? $params['page'] : 1);
        $limit = ($params['limit'] ? $params['limit'] : 1000);

        if ($limit >1000 )
        {
            $limit = 1000;
        }
        if (!empty($page))
        {
            $start = ($page * $limit) - $limit;
            $sql.=" LIMIT " . $start . ",$limit";
        }
        $res=  $this->query($sql);

        if ($this->numRows($res)>0)
        {
            while($row = $this->fetchData($res))
            {
                $reslt['id'] = $row['id'];
                $reslt['name'] = $row['gemstone_name'];
                $reslt['desc'] = $row['description'];
                $result[] = $reslt;
            }

            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data fetched successfully'
                        );
        }

        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in fetching data'
                        );
        }
        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;
    }

    public function getSizeListByCat($params)
    {

        $sql="  SELECT
                        id,
                        name,
                        size_value,
                        catid
                FROM
                        tbl_size_master
                WHERE
                        active_flag = 1
                AND
                        catid = ".$params['catid'];
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

            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data fetched successfully'
                        );
        }

        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in fetching data'
                        );
        }
        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;

    }

    public function getSizeList()
    {

        $sql=   "   SELECT
                            id,
                            name,
                            size_value,
                            catid
                    FROM
                            tbl_size_master
                    WHERE
                            active_flag";
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

            $err = array
                        (
                            'err_code' => 0,
                            'err_msg' => 'Data fetched successfully'
                        );
        }

        else
        {
            $err = array
                        (
                            'err_code' => 1,
                            'err_msg' => 'Error in fetching data'
                        );
        }
        $results = array
                        (
                            'result' => $result,
                            'error' => $err
                        );
        return $results;

    }
    
    

    public function getProductById($params)
    {
       
        try
        {
            $productSql = " SELECT
                                   productid ,
				   productid AS prdid,
				   product_code,
				   productDescription,
				   vendorid,
				   vendor_prd_code,
				   leadTime,
				   returneligible,
				   jewelleryType,
				   product_name,
				   product_seo_name,gender,product_weight,diamond_setting,metal_weight,
				   making_charges,procurement_cost,margin,measurement,customise_purity,
				   customise_color,certificate,has_diamond,has_solitaire,has_uncut,
				   has_gemstone,createdon,updatedon,updatedby,active_flag,
				   (SELECT GROUP_CONCAT(product_image) FROM tbl_product_image_mapping WHERE product_id = prdid AND active_flag != 2 AND  default_img_flag=1) 
  AS default_image
                            FROM
                                    tbl_product_master
                            WHERE
                                   productid = " . $params['pid'] . " AND active_flag != 2";
            $res = $this->query($productSql);
            if ($res)
            {
                if($row = $this->fetchData($res))
                {
                    $arr['prdId'] = $row['productid'];
                    $arr['prdCod'] = $row['product_code'];
                    $arr['productDescription'] = stripslashes(addslashes($row['productDescription']));
                    $arr['vndId'] = $row['vendorid'];
                    $arr['vPCode'] = $row['vendor_prd_code'];
                    $arr['leadTime'] = $row['leadTime'];
                    $arr['returneligible'] = $row['returneligible'];
                    $arr['jewelleryType'] = $row['jewelleryType'];
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
                    $arr['active_flag'] = $row['active_flag'];
		    $arr['default_image'] = $row['default_image'];
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
                $attrVals = $this->getPrdAtributeValues($row['productid']);
                $imageDtl = $this->getImagesByPid(array('pid' => $row['productid']));

                // $sizeMaster = $this->getProductSizeMaster($params);

                $result = array
                            (
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
                                'attrVals' => $attrVals,
                                'images' =>$imageDtl

                            );
                $err = array
                            (
                                'err_code' => 0,
                                'err_msg' => 'Data fetched successfully'
                            );
            }
            else
            {
                $err = array
                            (
                                'err_code' => 1,
                                'err_msg' => 'Error in fetching data'
                            );
            }
            $results = array
                            (
                                'results' => $result,
                                'error' => $err
                            );
        }
        catch (Exception $e)
        {
            echo 'Exection in API getProductById message : ' . $e->getMessage();
        }
        return $results;
    }
    
  
    
    public function getProductGemstone($params)
    {
     $pid = (!empty($params['pid'])) ? trim($params['pid']) : '';
        try
        {
            $count = 0;
            $sql = "    SELECT
                                *
                        FROM
                                tbl_product_gemstone_mapping
                        WHERE
                                productid = " . $params['pid'] . "
                        AND
                                active_flag=1";
            $res = $this->query($sql);
            
            if ($res)
            {
                while ($row = $this->fetchData($res))
                {
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

            return array
                        (
                            'count' => $count,
                            'results' => $resArr
                        );
        } catch (Exception $e) {
            echo 'Exection  in function getProductGemstone message : ' . $e->getMessage();
        }
    }

    public function getProductDiscount($params)
    {
        try
        {
            $count = 0;
            $sql = "    SELECT
                                *
                        FROM
                                tbl_discount_master
                        WHERE
                                productid = " . $params['pid'] . " ";
            // WHERE active_flag=1 ";
            $res = $this->query($sql);
            if ($res)
            {
                while ($row = $this->fetchData($res))
                {
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
        }
        catch (Exception $e)
        {
            echo 'Exection in function getProductDiscount message : ' . $e->getMessage();
        }
    }

    public function getProductSolitaire($params)
    {
        
        try
        {
            $count = 0;
            $sql = "    SELECT
                                *
                        FROM
                                tbl_product_solitaire_mapping
                        WHERE
                                active_flag !=2

                        AND
                                productid = " . $params['pid'] . " ";
            // WHERE active_flag=1 ";
            $res = $this->query($sql);
            if ($res)
            {
                while ($row = $this->fetchData($res))
                {
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
                    $arr['nofs'] = $row['no_of_solitaire'];
                    $arr['actFlg'] = $row['active_flag'];
                    $arr['crtdOn'] = $row['createdon'];
                    $arr['updtOn'] = $row['updatedon'];
                    $arr['updtBy'] = $row['updatedby'];
                    
                   
                    $resArr[]=$arr;
                    $count++;
                }
            }
            return array('count' => $count, 'results' => $resArr);
        }
        catch (Exception $e)
        {
            echo 'Exection in function getProductSolitaire message : ' . $e->getMessage();
        }
    }

    public function getProductUncut($params)
    {
        try
        {
            $count = 0;
            $sql = "    SELECT
                                *
                        FROM
                                tbl_product_uncut_mapping
                        WHERE
                                active_flag=1
                        AND
                                productid = " . $params['pid'] . " ";
            $res = $this->query($sql);
            if ($res)
            {
                while ($row = $this->fetchData($res))
                {
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
        }
        catch (Exception $e)
        {
            echo 'Exection in function getProductUncut message : ' . $e->getMessage();
        }
    }

    public function getProductSize($params)
    {
        try
        {
            $count = 0;
            $sql = "
                        SELECT
                                *
                        FROM
                                tbl_product_size_mapping
                        WHERE
                                productid = " . $params['pid'] . " ";

            $res = $this->query($sql);
            if ($res)
            {
                while ($row = $this->fetchData($res))
                {
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
        }
        catch (Exception $e)
        {
            echo 'Exection in function getProductSize message : ' . $e->getMessage();
        }
    }

    public function getProductDiamond($params)
    {
        try
        {
            $count = 0;
            $sql = "
                        SELECT
                                *
                        FROM
                                tbl_product_diamond_mapping
                        WHERE
                                active_flag=1
                        AND
                                productid = " . $params['pid'] . "

                    ";
            $res = $this->query($sql);
            if ($res)
            {
                while ($row = $this->fetchData($res))
                {
                    $arr['prdId'] = $row['productid'];
                    $arr['dmdId'] = $row['diamond_id'];
                    $arr['shape'] = $row['shape'];
                    $arr['crat'] = $row['carat'];
                    $arr['totNo'] = $row['total_no'];
                    $arr['crtdOn'] = $row['createdon'];
                    $arr['updtOn'] = $row['updatedon'];
                    $arr['updtBy'] = $row['updatedby'];
                    $arr['QMast'] = $this->getQualityMap(array('diamond_id' => $row['diamond_id']));
                    $result[]=$arr;
                    $count++;
                }
            }
            return array('count' => $count, 'results' => $result);
        }
        catch (Exception $e)
        {
            echo 'Exection in function getProductDiamond message : ' . $e->getMessage();
        }
    }

    public function getCatMap($params)
    {
        try
        {

            $count = 0;
            $sql = "
                        SELECT
                                *,
                                catid as ucid,
                                (select count(*) as cnt from tbl_category_master where pcatid = ucid) as parentcnt,
                                if(pcatid = 0,1,0) as topParent
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
                        ORDER BY
                                topParent DESC,
                                parentcnt DESC
                    ";
            $res = $this->query($sql);
            if ($res)
            {
                while ($row = $this->fetchData($res))
                {
                    $arr['cid'] = $row['catid'];
                    $arr['pid'] = $row['pcatid'];
                    $arr['name'] = $row['cat_name'];
                    $arr['catLvl'] = $row['cat_lvl'];
                    $arr['lineage'] = $row['lineage'];
                    $arr['active'] = $row['active_flag'];
                    $arr['crtdOn'] = $row['createdon'];
                    $arr['updtOn'] = $row['updatedon'];
                    $arr['updtBy'] = $row['updatedby'];
                    $arr['attrMaster'] = $this->getCatAttr(array('catid' => $row['catid']));
                    $resArr[] = $arr;
                    $count++;
                }
            }
            return array('count' => $count, 'results' => $resArr);
        }
        catch (Exception $e)
        {
            echo 'Exection in function getCatMap message : ' . $e->getMessage();
        }
    }

    public function getCatAttr($params)
    {
        try
        {
            $count = 0;
            $sql = "
                    SELECT
                        *
                    FROM
                         tbl_attribute_master
                    WHERE
                            active_flag =1
                        AND
                            attributeid IN
                                        (
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

    public function getQualityMap($params)
    {
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
                        order by price_per_carat ASC ";
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

    public function getProductSizeMaster($params)
    {
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

    public function getProductVendor($params)
    {
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

                                    )order by price DESC";
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

    public function pageList($params) {
        global $comm;
        try {
            $sql = "SELECT
                            productid,
                            createdon,
                            updatedon,
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
                            IF(product_name = NULL OR product_name='',product_seo_name,product_name) AS prdName
                            FROM
                                tbl_product_master
                            WHERE
                                active_flag < 3

                                ORDER BY createdon DESC";


            $page = ($params['page'] ? $params['page'] : 1);
            $limit = ($params['limit'] ? $params['limit'] : 1000);

            //Making sure that query has limited rows
            if ($limit >1000 ) {
                $limit = 1000;
            }

            if (!empty($page)) {
                $start = ($page * $limit) - $limit;
                $sql.=" LIMIT " . $start . ",$limit";
            }

            $res = $this->query($sql);



            if ($this->numRows($res)>0)
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
                    $arr['prdName'] = $row['prdName'];
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
        $imgName = $params['oldName'];

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
                                image_name,
                                upload_date,
                                update_date
                        )
                        VALUES
                        (
                                " . $pid . ",
                                \"" . $img . "\",
                                0,
                                " . $sequence . ",
                                \"" . $imgName . "\",
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
                        active_flag !=2 AND
                        product_id = " . $params['pid'] . " ORDER BY image_sequence DESC";


            $res = $this->query($sql);
            if ($res) {
                while ($row = $this->fetchData($res)) 
                {
                    if(!empty($row['product_image']))
                    {
                        $image = trim( IMGDOMAIN . $row['product_image'],',');
                        $images[] = $image;
                        $count++;
                    }
                }
                if(count($images) == 0)
                {
                    $image= (IMGDOMAIN.'uploads/noimg2.svg');
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


    public function changePrdPropertyStatus($params)
    {
        $params= (json_decode($params[0],1));

        $sql1="UPDATE tbl_product_master set has_solitaire='0' AND updatedby='".$params['updatedby']."'  WHERE productid = '".$params['pid']."'";

        $sql2="UPDATE tbl_product_master set has_diamond='0' AND updatedby='".$params['updatedby']."'  WHERE productid = '".$params['pid']."'";

        $sql3="UPDATE tbl_product_master set has_uncut='0' AND updatedby='".$params['updatedby']."' WHERE productid = '".$params['pid']."'";

        $sql4="UPDATE tbl_product_master set has_gemstone='0' AND updatedby='".$params['updatedby']."'  WHERE productid = '".$params['pid']."'";

        if($params['type']==1)
            $sql=$sql1;

        if($params['type']==2)
            $sql=$sql2;

        if($params['type']==3)
            $sql=$sql3;

        if($params['type']==4)
            $sql=$sql4;


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

 
       public function getProDetailsById($params){
            
            $pid = (!empty($params['pid'])) ? trim($params['pid']) : '';
           
                     
             $sql = "SELECT   
                            productid,
                            productid AS pid,
                            product_code,
                             vendorid,
                             vendor_prd_code,
                             leadTime,
                             returneligible,
                             productDescription,
                             jewelleryType,
                             product_name,
                             product_seo_name,
                             gender,
                             product_weight,
                             diamond_setting,
                             metal_weight,
                             making_charges,
                             procurement_cost,
                             margin,
                             measurement,
                             customise_purity,
                             customise_color,
                             certificate,
                             has_diamond,
                             has_solitaire,
                             has_uncut,
                             has_gemstone,
                             active_flag,
                             createdon,
                             updatedon,
                             updatedby,
                           
                            (SELECT  GROUP_CONCAT(diamond_id) FROM tbl_product_diamond_mapping WHERE productid = pid AND active_flag = 1 ) AS allDimonds,
                            (SELECT  GROUP_CONCAT(gemstone_id) FROM tbl_product_gemstone_mapping WHERE productid = pid AND active_flag = 1 ) AS allGemstone,
                            (SELECT  GROUP_CONCAT(solitaire_id) FROM tbl_product_solitaire_mapping WHERE productid = pid AND active_flag = 1 ) AS allSolitaire,
                            (SELECT  GROUP_CONCAT(uncut_id) FROM tbl_product_uncut_mapping WHERE productid = pid AND active_flag = 1 ) AS allUncut,
                            (SELECT  GROUP_CONCAT(id) FROM tbl_product_metal_purity_mapping WHERE productid = pid AND active_flag = 1 ) AS allmetalpurity,
                            (SELECT  GROUP_CONCAT(id) FROM tbl_product_metal_color_mapping WHERE productid = pid AND active_flag = 1 ) AS allmetalcolor,
                            (SELECT  GROUP_CONCAT(attributeid) FROM tbl_product_attributes_mapping WHERE productid = pid AND active_flag = 1 ) AS attrVals,
                            (SELECT  GROUP_CONCAT(catid) FROM tbl_category_product_mapping WHERE productid = pid AND active_flag = 1 ) AS catpro,
                            (SELECT  GROUP_CONCAT(attributeid) FROM tbl_product_attributes_mapping WHERE productid = pid AND active_flag = 1 ) AS attrpro,
                            (SELECT  GROUP_CONCAT(product_id) FROM tbl_product_image_mapping WHERE product_id = pid AND active_flag = 1 ) AS images
                            
                            
                        FROM 
                            tbl_product_master  
                        WHERE  
                            productid=".$pid." AND active_flag =1 
                        ORDER BY
                            createdon desc";   
            $res = $this->query($sql);
            
            if($res){
                while ($row = $this->fetchData($res)){
                    
                    $arr['prdId'] = $row['productid'];
                    $arr['prdCod'] = $row['product_code'];
                    $arr['productDescription'] = stripslashes(addslashes($row['productDescription']));
                    $arr['vndId'] = $row['vendorid'];
                    $arr['vPCode'] = $row['vendor_prd_code'];
                    $arr['leadTime'] = $row['leadTime'];
                    $arr['returneligible'] = $row['returneligible'];
                    $arr['jewelleryType'] = $row['jewelleryType'];
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
                    $arr['allDimonds'] = $row['allDimonds'];
                    $arr['allGemstone'] = $row['allGemstone'];
                    $arr['allSolitaire'] = $row['allSolitaire'];
                    $arr['allUncut'] = $row['allUncut'];
                    $arr['allmetalpurity'] = $row['allmetalpurity'];
                    $arr['allmetalcolor'] = $row['allmetalcolor'];
                    $arr['catAttr'] = $row['catAttr'];
                    $arr['catpro'] = $row['catpro'];
                    $arr['attrpro'] = $row['attrpro'];
                    $arr['attrVals'] = $row['attrVals'];
                    $arr['images'] = $row['images'];
                    $arr['active_flag'] = $row['active_flag'];
                    
                    $basic_details = array();
                    $dimondDetails = array();
                    $gemstoneDetails = array();
                    $solitaireDetails = array();
                    $uncutDetails = array();
                    $catpro =array();
                    $attrVals =array();
                    $images = array();
                   // $attrpro =array();
                    
                    if($row['jewelleryType'] === '1'){
                             $arr['jwelType'] ='Gold';
                        }else  if($row['jewelleryType'] === '2'){
                             $arr['jwelType'] ='Plain Gold';
                        }else  if($row['jewelleryType'] === '3'){
                             $arr['jwelType'] ='Platinum';
                        }  
                   
                    if($row['has_diamond'] === '1'){
                             $arr['diam'] ='Diamond';
                             $sqlQ = " SELECT 
                                                        diamond_id,
                                                        shape,
                                                        total_no,
                                                        carat,
                                                        active_flag
                                                FROM 
                                                        tbl_product_diamond_mapping
                                                WHERE 
                                                        productid=".$pid."
                                                             AND
                                                        active_flag = 1
                                      ";
                              $resdiamQuality = $this->query($sqlQ);
                              while ($rowdiamQ = $this->fetchData($resdiamQuality)){
                                  $arrdiaQDetails[]= $rowdiamQ;
                                  
                              }
                              
                              $diamQ = $arrdiaQDetails;
                        }
                        $arr['diamQuality'] =$diamQ;
                        
                        
                
                    if($row['has_solitaire'] === '1'){
                             $arr['soli'] ='Solitaire';
                        }
                      if($row['has_uncut'] === '1'){
                             $arr['uncut'] ='Uncut-Diamond';
                        }
                       if($row['has_gemstone'] === '1'){
                             $arr['gems'] ='Gemstones';
                        }
                        
                      /*if($row['has_solitaire'] === '1' && $row['has_uncut'] === '1' && $row['has_gemstone'] === '1' &&  $row['has_diamond'] === '1'){
                             $arr['hasSol'] ='Solitaire';
                             $arr['uncut-diamond'] ='Uncut-Diamond';
                             $arr['gemstone'] ='Gemstones';
                             $arr['diamond'] ='diamond';
                        }
                        */
                     if($row['attrVals']){
                            $sqlattrVals = "  SELECT
                                            attributeid as attid,
                                        value
                                                FROM
                                              tbl_product_attributes_mapping
                                        WHERE
                                           productid = ".$pid." AND active_flag=1 ";  
                             $resattrVals= $this->query($sqlattrVals);
                              while ($rowattrVals = $this->fetchData($resattrVals)){
                                  $arrattrValsDetails[]= $rowattrVals;
                                  
                              }
                              $attrVals = $arrattrValsDetails;
                        }
                        $arr['attrVals'] =$attrVals;
                        
                     
                        
                            $sqlimages = "  SELECT
                                             product_image
                                            FROM
                                     tbl_product_image_mapping
                                         WHERE
                                      active_flag NOT IN(2) AND
                        product_id = " .$pid. " ORDER BY image_sequence ";  
                             $resimages= $this->query($sqlimages);
                              while ($rowimages = $this->fetchData($resimages)){
                                  $arrimgDetails[]= $rowimages;
                              }
                              $images = $arrimgDetails;
                       
                        $arr['images'] =$images;
                        
                        
                      if($row['catpro']){
                            $sqlcatpro = "   SELECT
                                                      *
                                                     FROM
                                            tbl_category_master
                                             WHERE
                                             active_flag =1
                                                AND
                                        catid IN
                                        (
                                            SELECT
                                                    catid
                                            FROM
                                                    tbl_category_product_mapping
                                            WHERE
                                                    productid =".$pid."
                                            AND
                                                    active_flag =1
                                        ) ";  
                             $rescatPro= $this->query($sqlcatpro);
                              while ($rowcatpro = $this->fetchData($rescatPro)){
                                  $arrcatproDetails[]= $rowcatpro;
                                  
                              }
                              $catpro = $arrcatproDetails;
                        }
                        $arr['catpro'] =$catpro;
                        
                        
                         if($row['attrpro']){
                            $sqlattrpro = "   SELECT
                                                      *
                                                     FROM
                                            tbl_attribute_master
                                             WHERE
                                             active_flag =1
                                                AND
                                        attributeid IN
                                        (
                                            SELECT
                                                    attributeid
                                            FROM
                                                    tbl_product_attributes_mapping
                                            WHERE
                                                    productid =".$pid."
                                            AND
                                                    active_flag =1
                                        ) ";  
                             $resattrPro= $this->query($sqlattrpro);
                              while ($rowattrpro = $this->fetchData($resattrPro)){
                                  $arrattrproDetails[]= $rowattrpro;
                                  
                              }
                              $attrpro = $arrattrproDetails;
                        }
                        $arr['attrpro'] =$attrpro;
                        
                        
                        
                        
                
                
                    if( $arr['hasDmd'] === '1'){
                        if($row['allDimonds']){
                            $sqlDimondMapping = "SELECT *,
                                                        (SELECT 
                                                        GROUP_CONCAT(diamond_id)
                                                FROM 
                                                        tbl_product_diamond_mapping
                                                WHERE 
                                                        productid=".$pid."
                                                             AND
                                                        active_flag = 1) AS DiamIDS,
                                                        
(SELECT GROUP_CONCAT(id) FROM tbl_diamond_quality_mapping where  find_in_set(diamond_id,DiamIDS)) as qid
FROM tbl_diamond_quality_master having  find_in_set(id,qid)


";  
                             $resDimondMapping = $this->query($sqlDimondMapping);
                              while ($rowDimondMapping = $this->fetchData($resDimondMapping)){
                                  $arrdimondDetails[]= $rowDimondMapping;
                                  
                              }
                              $dimondDetails = $arrdimondDetails;
                        }
                        $arr['DimondDetails'] =$dimondDetails;
                        
                        
                    }
                   
                 
                    if( $arr['hasGem'] === '1'){
                        if($row['allGemstone']){
                            $count=0;
                            $sqlGemstoneMapping = "SELECT 
                                                        gemstone_id,
                                                        gemstone_name,
                                                        total_no,
                                                        carat,
                                                        price_per_carat
                                                FROM 
                                                        tbl_product_gemstone_mapping
                                                WHERE 
                                                        productid=".$pid."
                                                             AND
                                                        active_flag = 1";  
                             $resGemstoneMapping = $this->query($sqlGemstoneMapping);
                              while ($rowGemstoneMapping = $this->fetchData($resGemstoneMapping)){
                                  $arrgemstoneDetails[]= $rowGemstoneMapping;
                                   $count++;
                              }
                              $gemstoneDetails = $arrgemstoneDetails;
                        }
                        $arr['GemstoneDetails'] =$gemstoneDetails;
                        
                        
                    }
                    
                   
                    if( $arr['hasSol'] === '1'){
                          
                        if($row['allSolitaire']){
                            $sqlSolitaireMapping = "SELECT 
                                                        solitaire_id,
                                                        shape,
                                                        color,
                                                        clarity,
                                                        cut,
                                                        symmetry,
                                                        polish,
                                                        fluorescence,
                                                        carat,
                                                        price_per_carat,
                                                        table_no,
                                                        crown_angle,
                                                        girdle,
                                                        no_of_solitaire
                                                FROM 
                                                        tbl_product_solitaire_mapping
                                                WHERE 
                                                        productid=".$pid."
                                                             AND
                                                        active_flag = 1";  
                             $resSolitaireMapping = $this->query($sqlSolitaireMapping);
                              while ($rowSolitaireMapping = $this->fetchData($resSolitaireMapping)){
                                  $arrSolitaireDetails[]= $rowSolitaireMapping;
                                  
                              }
                              $solitaireDetails = $arrSolitaireDetails;
                        }
                        $arr['SolitaireDetails'] =$solitaireDetails;
                        
                        
                    }
                    
                   
                    if( $arr['hasUnct'] === '1'){
                        if($row['allUncut']){
                            $count =0;
                            $sqlUncutMapping = "SELECT 
                                                        uncut_id,
                                                        color,
                                                        quality,
                                                        total_no,
                                                        carat,
                                                        price_per_carat
                                                        
                                                FROM 
                                                        tbl_product_uncut_mapping
                                                WHERE 
                                                        productid=".$pid."
                                                             AND
                                                        active_flag = 1";  
                             $resUncutMapping = $this->query($sqlUncutMapping);
                              while ($rowUncutMapping = $this->fetchData($resUncutMapping)){
                                  $arrUncutDetails[]= $rowUncutMapping;
                                   $count++;
                              }
                              $UncutDetails = $arrUncutDetails;
                        }
                        $arr['UncutDetails'] =$UncutDetails;
                        
                        
                    }
                    
                    $metalpurityDetails = array();
                    if( $arr['custPurty'] === '1'){
                        if($row['allmetalpurity']){
                            $sqlMetalpurMapping = "SELECT
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
                                                     productid = " .$pid. "
                                                     AND
                                                     active_flag=1)
                                                    ";  
                          
                             $resMetalpurMapping = $this->query($sqlMetalpurMapping);
                              while ($rowMetalpurMapping = $this->fetchData($resMetalpurMapping)){
                                  $arrmetalpurDetails[]= $rowMetalpurMapping;
                                  
                              }
                              $metalpurityDetails = $arrmetalpurDetails;
                        }
                        $arr['metalpurityDetails'] =$metalpurityDetails;
                        
                        
                    }
                    
                      $metalClrDetails = array();
                    if( $arr['custClor'] === '1'){
                        if($row['allmetalcolor']){
                            $sqlMetalclrMapping = " SELECT
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
                                                productid = " .$pid. "
                                            AND
                                                active_flag=1)";  
                             $resMetalclrMapping = $this->query($sqlMetalclrMapping);
                              while ($rowMetalclrMapping = $this->fetchData($resMetalclrMapping)){
                                  $arrmetalclrDetails[]= $rowMetalclrMapping;
                                  
                              }
                              $metalclrDetails = $arrmetalclrDetails;
                        }
                        $arr['metalcolorDetails'] =$metalclrDetails;
                        
                        
                    }
                    
                  
                    
                    $resp[] = $arr;
                }
               
                
                
                $error = array('err_code'=>0, 'err_msg'=>'details fetched successfully');
            }else{
                $error = array('err_code'=>1, 'err_msg'=>'error in fetching details');
            }
            
            $result = array('result'=>$resp, 'error'=>$error);
            return $result;
            
        }
        
        public function getProGrid($params){
            
            global $comm;
           
            $sqlcount = "  SELECT
                                    count(productid) AS  cnt
                                            FROM
                                     tbl_product_master
                                         WHERE
                                      active_flag NOT IN(2)";  
            $rescnt= $this->query($sqlcount);
            $row = $this->fetchData($rescnt);
            $total= $row['cnt'];
            
	    $sql='SET GLOBAL group_concat_max_len = 1000000';
           
            $res = $this->query($sql);
            $sql = " SELECT   
                             productid,
                             productid AS pid,
                             product_code,
                             vendorid,
                             vendor_prd_code,
                             
                             jewelleryType,
                             product_name,
                             product_seo_name,
                             metal_weight,
                             customise_purity,
                             customise_color,
                             
                             has_diamond,
                             has_solitaire,
                             has_uncut,
                             has_gemstone,
                             making_charges,
                             gender,
                             active_flag,
                             createdon,
                             updatedon,
                             updatedby,
                           
                            (SELECT GROUP_CONCAT(diamond_id) FROM tbl_product_diamond_mapping WHERE productid = pid AND active_flag = 1 ) AS allDimonds,
                            (SELECT GROUP_CONCAT(carat) FROM tbl_product_diamond_mapping WHERE FIND_IN_SET(diamond_id,allDimonds)) AS dmdcarat ,
                            (SELECT GROUP_CONCAT(total_no) FROM tbl_product_diamond_mapping WHERE FIND_IN_SET(diamond_id,allDimonds)) AS totaldmd,
                            (SELECT GROUP_CONCAT(shape) FROM tbl_product_diamond_mapping WHERE FIND_IN_SET(diamond_id,allDimonds)) AS shape,
                            
                            (SELECT GROUP_CONCAT(id) FROM tbl_diamond_quality_mapping WHERE diamond_id = allDimonds AND active_flag = 1 ) AS DimondQuality,
                            (SELECT GROUP_CONCAT(dname) FROM tbl_diamond_quality_master WHERE FIND_IN_SET(id,DimondQuality)) AS dmdQ,
                            (SELECT GROUP_CONCAT(price_per_carat) FROM tbl_diamond_quality_master WHERE FIND_IN_SET(id,DimondQuality)) AS dmdQPricepercarat,


                            (SELECT GROUP_CONCAT(gemstone_id) FROM tbl_product_gemstone_mapping WHERE productid = pid AND active_flag = 1 ) AS allGemstone,
                            (SELECT GROUP_CONCAT(gemstone_name) FROM tbl_gemstone_master WHERE FIND_IN_SET(id,allGemstone)) AS gemstoneName,
                            (SELECT GROUP_CONCAT(carat) FROM tbl_product_gemstone_mapping WHERE FIND_IN_SET(gemstone_id,allGemstone) AND productid =pid) AS gemscarat ,
                            (SELECT GROUP_CONCAT(total_no) FROM tbl_product_gemstone_mapping WHERE FIND_IN_SET(gemstone_id,allGemstone) AND productid =pid) AS totalgems,
                            (SELECT GROUP_CONCAT(price_per_carat) FROM tbl_product_gemstone_mapping WHERE FIND_IN_SET(gemstone_id,allGemstone) AND productid =pid) AS gemsPricepercarat,


                            (SELECT GROUP_CONCAT(solitaire_id) FROM tbl_product_solitaire_mapping WHERE productid = pid AND active_flag = 1 ) AS allSolitaire,
                            (SELECT GROUP_CONCAT(no_of_solitaire) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS totalSolitaire,
                            (SELECT GROUP_CONCAT(carat) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS Solicarat,
                            (SELECT GROUP_CONCAT(price_per_carat) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS SoliPricepercarat,
                            
                            (SELECT GROUP_CONCAT(uncut_id) FROM tbl_product_uncut_mapping WHERE productid = pid AND active_flag = 1 ) AS allUncut,
                            (SELECT GROUP_CONCAT(total_no) FROM tbl_product_uncut_mapping WHERE FIND_IN_SET(uncut_id,allUncut) AND productid =pid) AS totalUncut,
                            (SELECT GROUP_CONCAT(carat) FROM tbl_product_uncut_mapping WHERE FIND_IN_SET(uncut_id,allUncut) AND productid =pid) AS Uncutcarat,
                            (SELECT GROUP_CONCAT(price_per_carat) FROM tbl_product_uncut_mapping WHERE FIND_IN_SET(uncut_id,allUncut) AND productid =pid) AS UncutPricepercarat,
                            
                            (SELECT GROUP_CONCAT(id) FROM tbl_product_metal_purity_mapping WHERE productid = pid AND active_flag = 1 ) AS allmetalpurity,
                            (SELECT GROUP_CONCAT(dvalue) FROM tbl_metal_purity_master WHERE FIND_IN_SET(id,allmetalpurity)) AS purity,
                            (SELECT GROUP_CONCAT(price) FROM tbl_metal_purity_master WHERE FIND_IN_SET(id,allmetalpurity)) AS purprice,
                            
                            (SELECT GROUP_CONCAT(id) FROM tbl_product_metal_color_mapping WHERE productid = pid AND active_flag = 1 ) AS allmetalcolor,
                            (SELECT GROUP_CONCAT(attributeid) FROM tbl_product_attributes_mapping WHERE productid = pid AND active_flag = 1 ) AS attrVals,
                            (SELECT GROUP_CONCAT(catid) FROM tbl_category_product_mapping WHERE productid = pid AND active_flag = 1 ) AS catpro,
                            (SELECT GROUP_CONCAT(attributeid) FROM tbl_product_attributes_mapping WHERE productid = pid AND active_flag = 1 ) AS attrpro,
                            (SELECT GROUP_CONCAT(product_image) FROM tbl_product_image_mapping WHERE product_id = pid AND active_flag !=2 ORDER BY
                            image_sequence DESC) AS images,
			    (SELECT GROUP_CONCAT(product_image) FROM tbl_product_image_mapping WHERE product_id = pid AND active_flag != 2 AND  default_img_flag=1) 
                            AS default_image
                               
                        FROM 
                            tbl_product_master  
                        WHERE  
                            active_flag != 2
                        ORDER BY
                            createdon DESC ";
            // $price = $comm->IND_money_format(priceDigit);
          $price = $comm->IND_money_format(price);
       
            
        $page = ($params['page'] ? $params['page'] : 1);
        $limit = ($params['limit'] ? $params['limit'] : 12);

        if ($limit > 12)
        {
            $limit = 12;
        }
        //$limit = 100;
        if (!empty($page))
        {
            $start = ($page * $limit) - $limit;
            $sql.=" LIMIT " . $start . ",$limit";
        }
            
            $res = $this->query($sql);
            
            if($res){
                while ($row = $this->fetchData($res)){
                    
                    $arr['prdId'] = $row['productid'];
                    $arr['prdCod'] = $row['product_code'];
                   
                    $arr['jewelleryType'] = $row['jewelleryType'];
                    $arr['prdNm'] = $row['product_name'];
                    
                    $arr['metal_weight'] = $row['metal_weight'];
                    $arr['custPurty'] = $row['customise_purity'];
                   
                    $arr['custClor'] = $row['customise_color'];
                    
                    $arr['hasDmd'] = $row['has_diamond'];
                    
                     
                    $arr['hasSol'] = $row['has_solitaire'];
                    $arr['hasUnct'] = $row['has_uncut'];
                    $arr['hasGem'] = $row['has_gemstone'];
                    $arr['making_charges'] = $row['making_charges'];
                    $arr['active_flag'] = $row['active_flag'];
                    $arr['allDimonds'] = $row['allDimonds'];
                    $arr['dmdcarat'] = $row['dmdcarat'];
                     $arr['totaldmd'] = $row['totaldmd'];
                       $arr['shape'] = $row['shape'];
                       
                     $arr['DimondQuality'] = $row['DimondQuality'];
                     $arr['dmdQ'] = $row['dmdQ'];
                     $arr['dmdQPricepercarat'] = $row['dmdQPricepercarat'];
                        
                    $arr['allGemstone'] = $row['allGemstone'];
                    $arr['gemstoneName'] = $row['gemstoneName'];
                   
                    $arr['totalgems'] = $row['totalgems'];
                    $arr['gemscarat'] = $row['gemscarat'];
                    $arr['gemsPricepercarat'] = $row['gemsPricepercarat'];
                      
                    $arr['allSolitaire'] = $row['allSolitaire'];
                    $arr['totalSolitaire'] = $row['totalSolitaire'];
                    $arr['Solicarat'] = $row['Solicarat'];
                    $arr['SoliPricepercarat'] = $row['SoliPricepercarat'];
                    
                    $arr['allUncut'] = $row['allUncut'];
                    $arr['totalUncut'] = $row['totalUncut'];
                    $arr['Uncutcarat'] = $row['Uncutcarat'];
                    $arr['UncutPricepercarat'] = $row['UncutPricepercarat'];
                    
                    $arr['allmetalpurity'] = $row['allmetalpurity'];
                     $arr['purity'] = $row['purity'];
                     $arr['purprice'] = $row['purprice'];
                    $arr['allmetalcolor'] = $row['allmetalcolor'];
                     $arr['gender'] = $row['gender'];
		     $arr['default_image'] = $row['default_image'];
                    //$arr['images']= $row['images'];
                   $arr['images'] = trim($row['images'],',');
                   
                    
                        if($row['jewelleryType'] === '1'){
                             $arr['jwelType'] ='Gold';
                        }else  if($row['jewelleryType'] === '2'){
                             $arr['jwelType'] ='Plain Gold';
                        }else  if($row['jewelleryType'] === '3'){
                             $arr['jwelType'] ='Platinum';
                        }  
                       
                          if( $arr['hasGem'] === '1'){
                        if($row['allGemstone']){
                            $count=0;
                            $sqlGemstoneMapping = " SELECT 
                                                            productid,
                                                            gemstone_name,
                                                            total_no,
                                                            carat,
                                                            price_per_carat  
                                                    FROM 
                                                            tbl_product_gemstone_mapping 
                                                    WHERE 
                                                            productid IN(SELECT productid FROM tbl_product_master WHERE productid=pid ORDER BY createdon ASC  
                                                       ";  
                             $resGemstoneMapping = $this->query($sqlGemstoneMapping);
                              while ($rowGemstoneMapping = $this->fetchData($resGemstoneMapping)){
                                  $arrgemstoneDetails[]= $rowGemstoneMapping;
                                   $count++;
                              }
                              $gemstoneDetails = $arrgemstoneDetails;
                        }
                        $arr['GemstoneDetails'] =$gemstoneDetails;
                        
                        
                    }
                    
                   
                        $resp[] = $arr;
                         
                }    
                $error = array('err_code'=>0, 'err_msg'=>'details fetched successfully' );
            }else{
                $error = array('err_code'=>1, 'err_msg'=>'error in fetching details' );
            }
            
            $result = array('result'=>$resp, 'error'=>$error,'total'=>$total);
            return $result;
            
        }

        
       public function getImages() {
       
            $sql = "SELECT 
                        productid AS pid,
                       (SELECT GROUP_CONCAT(product_image) FROM tbl_product_image_mapping WHERE product_id = pid AND active_flag =1 ) AS images
                        FROM 
                            tbl_product_master  
                        WHERE  
                            active_flag != 2
                        ORDER BY
                            createdon ASC ";
               $page = ($params['page'] ? $params['page'] : 1);
        $limit = ($params['limit'] ? $params['limit'] : 5);

        if ($limit > 5 )
        {
            $limit = 5;
        }

        if (!empty($page))
        {
            $start = ($page * $limit) - $limit;
            $sql.=" LIMIT " . $start . ",$limit";
        }

            $res = $this->query($sql);
            if ($res) {
                while ($row = $this->fetchData($res)) {
                    $arr['images'] = $row['images'];
                    
                        $resp[] = $arr;
                         
               }    
                $error = array('err_code'=>0, 'err_msg'=>'details fetched successfully' );
            }else{
                $error = array('err_code'=>1, 'err_msg'=>'error in fetching details' );
            }
            
            $result = array('result'=>$resp, 'error'=>$error);
            return $result;
            
        }

    public function getProductdetailbycatid($params) {
      
       global $comm;
           $cid=  urldecode($params['id']);
            $sqlcount = "  SELECT count(productid) AS cnt
	     FROM tbl_category_product_mapping WHERE catid=".$cid." AND active_flag =1";
            $rescnt= $this->query($sqlcount);
            $row = $this->fetchData($rescnt);
            $total= $row['cnt'];
            
	    $sqlglb='SET GLOBAL group_concat_max_len = 1000000';
           
            $res = $this->query($sqlglb);
      $sql="SELECT 
		    productid,
                             productid AS pid,
                             product_code,
                             vendorid,
                             vendor_prd_code,
                             leadTime,
			     returneligible,
			     productDescription,
                             jewelleryType,
                             product_name,
                             product_seo_name,
			     gender,
                             product_weight,
                             diamond_setting,
                             metal_weight,
                             making_charges,
			     procurement_cost,
			     margin,
			     measurement,
			     customise_purity,
			     customise_color,
			     certificate,
                             has_diamond,
                             has_solitaire,
                             has_uncut,
                             has_gemstone,
                             active_flag, 
                             createdon,
                             updatedon,
                             updatedby,
			     (SELECT GROUP_CONCAT(diamond_id) FROM tbl_product_diamond_mapping WHERE productid = pid AND active_flag = 1 ) AS allDimonds,
                            (SELECT GROUP_CONCAT(carat) FROM tbl_product_diamond_mapping WHERE FIND_IN_SET(diamond_id,allDimonds)) AS dmdcarat,
                            (SELECT GROUP_CONCAT(total_no) FROM tbl_product_diamond_mapping WHERE FIND_IN_SET(diamond_id,allDimonds)) AS totaldmd,
                            (SELECT GROUP_CONCAT(shape) FROM tbl_product_diamond_mapping WHERE FIND_IN_SET(diamond_id,allDimonds)) AS shape,
			    
			    (SELECT GROUP_CONCAT(id) FROM tbl_diamond_quality_mapping WHERE diamond_id = allDimonds AND active_flag = 1 ) AS DimondQuality,
                            (SELECT GROUP_CONCAT(dname) FROM tbl_diamond_quality_master WHERE FIND_IN_SET(id,DimondQuality)) AS dmdQ,
                            (SELECT GROUP_CONCAT(price_per_carat) FROM tbl_diamond_quality_master WHERE FIND_IN_SET(id,DimondQuality)) AS dmdQPricepercarat,


                            (SELECT GROUP_CONCAT(gemstone_id) FROM tbl_product_gemstone_mapping WHERE productid = pid AND active_flag = 1 ) AS allGemstone,
                            (SELECT GROUP_CONCAT(gemstone_name) FROM tbl_gemstone_master WHERE FIND_IN_SET(id,allGemstone)) AS gemstoneName,
                            (SELECT GROUP_CONCAT(carat) FROM tbl_product_gemstone_mapping WHERE FIND_IN_SET(gemstone_id,allGemstone) AND productid =pid) AS gemscarat ,
                            (SELECT GROUP_CONCAT(total_no) FROM tbl_product_gemstone_mapping WHERE FIND_IN_SET(gemstone_id,allGemstone) AND productid =pid) AS totalgems,
                            (SELECT GROUP_CONCAT(price_per_carat) FROM tbl_product_gemstone_mapping WHERE FIND_IN_SET(gemstone_id,allGemstone) AND productid =pid) AS gemsPricepercarat,


                            (SELECT GROUP_CONCAT(solitaire_id) FROM tbl_product_solitaire_mapping WHERE productid = pid AND active_flag = 1 ) AS allSolitaire,
                            (SELECT GROUP_CONCAT(no_of_solitaire) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS totalSolitaire,
                            (SELECT GROUP_CONCAT(carat) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS Solicarat,
                            (SELECT GROUP_CONCAT(price_per_carat) FROM tbl_product_solitaire_mapping WHERE FIND_IN_SET(solitaire_id,allSolitaire) AND productid =pid) AS SoliPricepercarat,
                            
                            (SELECT GROUP_CONCAT(uncut_id) FROM tbl_product_uncut_mapping WHERE productid = pid AND active_flag = 1 ) AS allUncut,
                            (SELECT GROUP_CONCAT(total_no) FROM tbl_product_uncut_mapping WHERE FIND_IN_SET(uncut_id,allUncut) AND productid =pid) AS totalUncut,
                            (SELECT GROUP_CONCAT(carat) FROM tbl_product_uncut_mapping WHERE FIND_IN_SET(uncut_id,allUncut) AND productid =pid) AS Uncutcarat,
                            (SELECT GROUP_CONCAT(price_per_carat) FROM tbl_product_uncut_mapping WHERE FIND_IN_SET(uncut_id,allUncut) AND productid =pid) AS UncutPricepercarat,
                            
                            (SELECT GROUP_CONCAT(id) FROM tbl_product_metal_purity_mapping WHERE productid = pid ) AS allmetalpurity,
                            (SELECT GROUP_CONCAT(dvalue) FROM tbl_metal_purity_master WHERE FIND_IN_SET(id,allmetalpurity)) AS purity,
                            (SELECT GROUP_CONCAT(price) FROM tbl_metal_purity_master WHERE FIND_IN_SET(id,allmetalpurity)) AS purprice,
                            
                            (SELECT GROUP_CONCAT(id) FROM tbl_product_metal_color_mapping WHERE productid = pid AND active_flag = 1 ) AS allmetalcolor,
                            (SELECT GROUP_CONCAT(attributeid) FROM tbl_product_attributes_mapping WHERE productid = pid AND active_flag = 1 ) AS attrVals,
                            (SELECT GROUP_CONCAT(catid) FROM tbl_category_product_mapping WHERE productid = pid AND active_flag = 1 ) AS catpro,
                            (SELECT GROUP_CONCAT(attributeid) FROM tbl_product_attributes_mapping WHERE productid = pid AND active_flag = 1 ) AS attrpro,
                            (SELECT GROUP_CONCAT(product_image) FROM tbl_product_image_mapping WHERE product_id = pid AND active_flag !=2 ORDER BY
                            image_sequence DESC) AS images,
			    
			    (SELECT pcatid FROM tbl_category_master WHERE catid =".$cid.") AS cpcatid,
			    (SELECT cat_name FROM tbl_category_master WHERE catid = cpcatid ) AS parntcatname,
			    (SELECT cat_name FROM tbl_category_master WHERE catid =".$cid." ) AS chldcatname
			    
	  FROM tbl_product_master WHERE active_flag != 2 AND productid  IN (SELECT
	    productid FROM tbl_category_product_mapping WHERE catid=".$cid.")" ;
      
      $price = $comm->IND_money_format(price);
      
      $page = ($params['page'] ? $params['page'] : 1);
      $limit = ($params['limit'] ? $params['limit'] : 12);

        if ($limit > 12)
        {
            $limit = 12;
        }
        if (!empty($page))
        {
            $start = ($page * $limit) - $limit;
            $sql.=" LIMIT " . $start . ",$limit";
        }
      
      $res=  $this->query($sql);
      if($res){
	 while ($row = $this->fetchData($res)){
                    
                    $arr['prdId'] = $row['productid'];
                    $arr['prdCod'] = $row['product_code']; 
                    $arr['vendorid'] = $row['vendorid'];
                    $arr['vendor_prd_code'] = $row['vendor_prd_code']; 
                    $arr['leadTime'] = $row['leadTime'];
                    $arr['returneligible'] = $row['returneligible']; 
                    $arr['productDescription'] = $row['productDescription']; 
                    $arr['jewelleryType'] = $row['jewelleryType']; 
                    $arr['prdNm'] = $row['product_name'];
                    $arr['product_seo_name'] = $row['product_seo_name'];
		    $arr['gender'] = $row['gender']; 
                    $arr['product_weight'] = $row['product_weight'];
		    $arr['diamond_setting'] = $row['diamond_setting'];
		    $arr['metal_weight'] = $row['metal_weight']; 
                    $arr['making_charges'] = $row['making_charges'];
                    $arr['procurement_cost'] = $row['procurement_cost'];
                    $arr['margin'] = $row['margin'];
                    $arr['measurement'] = $row['measurement']; 
                    $arr['custPurty'] = $row['customise_purity']; 
                    $arr['custClor'] = $row['customise_color'];
                    $arr['certificate'] = $row['certificate']; 
                    $arr['hasDmd'] = $row['has_diamond'];
                    $arr['hasSol'] = $row['has_solitaire']; 
                    $arr['hasUnct'] = $row['has_uncut'];
                    $arr['hasGem'] = $row['has_gemstone'];
                    $arr['active_flag'] = $row['active_flag']; 
                    $arr['createdon'] = $row['createdon'];
                    $arr['updatedon'] = $row['updatedon'];
                    $arr['updatedby'] = $row['updatedby'];  
		    
		    $arr['allDimonds'] = $row['allDimonds'];
                    $arr['dmdcarat'] = $row['dmdcarat'];
                    $arr['totaldmd'] = $row['totaldmd'];
		    $arr['shape'] = $row['shape'];
		    
		     $arr['DimondQuality'] = $row['DimondQuality'];
                     $arr['dmdQ'] = $row['dmdQ'];
                     $arr['dmdQPricepercarat'] = $row['dmdQPricepercarat'];
                        
                    $arr['allGemstone'] = $row['allGemstone'];
                    $arr['gemstoneName'] = $row['gemstoneName'];
                   
                    $arr['totalgems'] = $row['totalgems'];
                    $arr['gemscarat'] = $row['gemscarat'];
                    $arr['gemsPricepercarat'] = $row['gemsPricepercarat'];
                      
                    $arr['allSolitaire'] = $row['allSolitaire'];
                    $arr['totalSolitaire'] = $row['totalSolitaire'];
                    $arr['Solicarat'] = $row['Solicarat'];
                    $arr['SoliPricepercarat'] = $row['SoliPricepercarat'];
                    
                    $arr['allUncut'] = $row['allUncut'];
                    $arr['totalUncut'] = $row['totalUncut'];
                    $arr['Uncutcarat'] = $row['Uncutcarat'];
                    $arr['UncutPricepercarat'] = $row['UncutPricepercarat'];
                    
                    $arr['allmetalpurity'] = $row['allmetalpurity'];
                     $arr['purity'] = $row['purity'];
                     $arr['purprice'] = $row['purprice'];
                    $arr['allmetalcolor'] = $row['allmetalcolor']; 
		     $arr['default_image'] = $row['default_image']; 
                   $arr['images'] = trim($row['images'],',');
                   $arr['parntcatname'] = $row['parntcatname'];
		   $arr['chldcatname'] = $row['chldcatname'];
		   
		     if($row['jewelleryType'] === '1'){
                             $arr['jwelType'] ='Gold';
                        }else  if($row['jewelleryType'] === '2'){
                             $arr['jwelType'] ='Plain Gold';
                        }else  if($row['jewelleryType'] === '3'){
                             $arr['jwelType'] ='Platinum';
                        }  
                       
                          if( $arr['hasGem'] === '1'){
                        if($row['allGemstone']){
                            $count=0;
                            $sqlGemstoneMapping = " SELECT 
                                                            productid,
                                                            gemstone_name,
                                                            total_no,
                                                            carat,
                                                            price_per_carat  
                                                    FROM 
                                                            tbl_product_gemstone_mapping 
                                                    WHERE 
                                                            productid IN(SELECT productid FROM tbl_product_master WHERE productid=pid ORDER BY createdon ASC  
                                                       ";  
                             $resGemstoneMapping = $this->query($sqlGemstoneMapping);
                              while ($rowGemstoneMapping = $this->fetchData($resGemstoneMapping)){
                                  $arrgemstoneDetails[]= $rowGemstoneMapping;
                                   $count++;
                              }
                              $gemstoneDetails = $arrgemstoneDetails;
                        }
                        $arr['GemstoneDetails'] =$gemstoneDetails;
                         
                    }
                     
                        $reslt[] = $arr;
                    } 
	 
	 $error = array('err_code'=>0, 'err_msg'=>'details fetched successfully' );
      }
      else{
	  $error = array('err_code'=>1, 'err_msg'=>'error in fetching details' );
      }
     
    $result = array('result'=>$reslt, 'error'=>$error, 'total'=>$total);
      return $result;
    }
}
?>
