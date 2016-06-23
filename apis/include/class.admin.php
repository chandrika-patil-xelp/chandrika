<?php

require_once APICLUDE.'common/db.class.php';
class admin extends DB
{

    function __construct($db)
    {
        parent::DB($db);
    }

    public function getProdList($params)
    {
        $subQuery = "   SELECT
                                product_id AS id,
                                (select product_seo_name from tbl_product_master WHERE productid = product_id) as pname,
                                (select product_code from tbl_product_master WHERE productid = product_id) as pcode,
                                (SELECT date_format(a.update_date,'%D %b,%Y|%h:%i %p') as dateForm) as date,
                                count(product_id) AS total_img,
                                sum(active_flag = 0) as pend_img,
                                sum(active_flag = 1) as appr_img,
                                sum(active_flag = 3) as rej_img
                        FROM
                                tbl_product_image_mapping as a
                        GROUP BY
                                product_id
                        ORDER BY
                                upload_date";

        $cntRes = $this->query($subQuery);
        $total_products = $this->numRows($cntRes);

        $page = ($params['page'] ? $params['page'] : 1);
        $limit = ($params['limit'] ? $params['limit'] : 1000);
        //Making sure that query has limited rows
        if ($limit >1000 )
        {
            $limit = 1000;
        }
        if (!empty($page))
        {
            $start = ($page * $limit) - $limit;
            $subQuery.=" LIMIT " . $start . ",$limit";
        }
        $subQueryRes = $this->query($subQuery);
        if($this->numRows($subQueryRes)>0)
        {
            while ($row = $this->fetchData($subQueryRes))
            {
                $result[] = $row;
            }
        }
        $results=array('products'=>$result,"total_products"=>$total_products);

        $err = array('Code' => 0, 'Msg' => 'Details fetched successfully');
        $result=array('results'=>$results,'error'=>$err);
        return $result;
    }

    public function getImgByProd($params)
    {
        $query="SELECT
                        *
                FROM
                        tbl_product_image_mapping
                WHERE
                        product_id = ".$params['pid']."
                AND
                        active_flag NOT IN(2)
                ORDER BY
                        image_sequence ASC";
        $res = $this->query($query);
        $total=$this->numRows($res);
        if($total>0)
        {
            while ($row = $this->fetchData($res))
            {
                $result[]=$row;
            }
            $results=array('imgs'=>$result,"total_imgs"=>$total,'pid'=>$params['pid']);
            $err = array('Code' => 0, 'Msg' => 'Details fetched successfully');
        }
        else
        {
            $results = '';
            $err = array('Code' => 1, 'Msg' => 'Error in fetching data');
        }
        $result=array('results'=>$results,'error'=>$err);
        return $result;
    }

    public function updateImageData($params)
    {

        $dt = json_decode($params['dt']);

        if(count($dt))
        {
            foreach($dt as $key => $val)
            {
                $data = explode('|@|',$val);
                $id = $data[0];
                $seq = $data[1];
                $flg = $data[2];
                $rea = $data[3];

                $query = "UPDATE
                                tbl_product_image_mapping
                        SET
                                image_sequence='".urldecode($seq)."',
                                active_flag='".$flg."',
                                reason='".urldecode($rea)."',
                                update_date=NOW()
                        WHERE
                                id = ".$id;
                $res = $this->query($query);
                if($res)
                {
                    $res = true;
                }
                else
                {
                    $res = false;
                }
            }
        }

        if($res == true)
        {
            $results=array();
            $err = array('Code' => 0, 'Msg' => 'Data has been updated');
        }
        else
        {
            $results=array();
            $err = array('Code' => 1, 'Msg' => 'Error in Updating data');
        }
        $result=array('results'=>$results,'error'=>$err);
        return $result;
    }
}
?>
