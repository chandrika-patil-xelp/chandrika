<?php
include APICLUDE.'common/db.class.php';
class auto extends DB
{
        function __construct($db) 
        {
                parent::DB($db);
        }

    public function searchbox($params)
    {
	$sql="SELECT
                    *,
                    product_name,
                    MATCH(product_name) AGAINST ('" . $params['srch'] . "*' IN BOOLEAN MODE) AS startwith 
              FROM 
                    tbl_product_master 
              WHERE 
                    MATCH(product_name) AGAINST ('".$params['srch']."*' IN BOOLEAN MODE) 
                    ORDER BY startwith ASC";
        $page   = ($params['page'] ? $params['page'] : 1);
        $limit  = ($params['limit'] ? $params['limit'] : 15);
        if (!empty($page))
        {
            $start = ($page * $limit) - $limit;
            $sql.=" LIMIT " . $start . ",$limit";
        }
        $res=$this->query($sql);
        if($this->numRows($res))
        {
            while($row=$this->fetchData($res))
            {
                $arrval['id']       = $row['product_id'];
                $arrval['name']     = $row['product_display_name'];
                $arrval['model']    = $row['product_model'];
                $arrval['brand']    = $row['product_brand'];
                $arrval['price']    = $row['product_price'];
                $arrval['description']  = $row['product_description'];
                $arrval['designer']  = $row['designer_name'];
                $arr[]              =$arrval;
            }
            $err=array('Code'=> 0,'Msg'=>'Values are fetched');
        }
        else
        {
                $arr = array();
                $err = array('Code'=> 1,'Msg'=>'Search Query Failed');
        }
    $result=array('results'=>$arr,'error'=>$err);
    return $result;
    }
    
    public function suggestCity($params)
    {
	$sql="  SELECT 
                        MATCH(cityname) AGAINST ('" . $params['str'] . "*' IN BOOLEAN MODE)
                        AS startwith,cityname
                FROM
                        tbl_city_master 
                WHERE
                        MATCH(cityname) AGAINST ('".$params['str']."*' IN BOOLEAN MODE)
                ORDER BY 
                        startwith DESC";
        
        $page   = ($params['page'] ? $params['page'] : 1);
        $limit  = ($params['limit'] ? $params['limit'] : 15);
        
        if (!empty($page))
        {
            $start = ($page * $limit) - $limit;
            $sql.=" LIMIT " . $start . ",$limit";
        }
        $res=$this->query($sql);
        if($this->numRows($res)>0)
        {
            while($row=$this->fetchData($res))
            {
                $arr[]= $row;
            }
            $err=array('Code'=> 0,'Msg'=>'Values are fetched');
        }
        else
        {
                $arr = array();
                $err = array('Code'=> 1,'Msg'=>'Search Query Failed');
        }
    $result=array('results'=>$arr,'error'=>$err);
    return $result;
    }
    
    public function suggestBrand($params)
    {
	$sql="  SELECT
                        name,
                        MATCH(name) AGAINST ('" . $params['str'] . "*' IN BOOLEAN MODE) AS startwith 
                FROM 
                        tbl_brandid_generator 
                WHERE 
                        MATCH(name) AGAINST ('".$params['str']."*' IN BOOLEAN MODE) 
                ORDER BY
                        startwith";
        $page   = ($params['page'] ? $params['page'] : 1);
        $limit  = ($params['limit'] ? $params['limit'] : 15);
        
        if (!empty($page))
        {
            $start = ($page * $limit) - $limit;
            $sql.=" LIMIT " . $start . ",$limit";
        }
        
        $res=$this->query($sql);
        if($this->numRows($res))
        {
            while($row=$this->fetchData($res))
            {
                $arr[]= $row;
            }
            $err=array('Code'=> 0,'Msg'=>'Values are fetched');
        }
        else
        {
                $arr = array();
                $err = array('Code'=> 1,'Msg'=>'Search Query Failed');
        }
    $result=array('results'=>$arr,'error'=>$err);
    return $result;
    }
    
    public function suggestCat($params)
    {
	$sql="  SELECT 
                        category_name,
                        MATCH(category_name) AGAINST ('" . $params['str'] . "*' IN BOOLEAN MODE) AS startwith 
                FROM 
                        tbl_category_master
                WHERE 
                        MATCH(category_name) AGAINST ('".$params['str']."*' IN BOOLEAN MODE) ORDER BY startwith ASC";
       $page   = ($params['page'] ? $params['page'] : 1);
        $limit  = ($params['limit'] ? $params['limit'] : 15);
        
        if (!empty($page))
        {
            $start = ($page * $limit) - $limit;
           $sql.=" LIMIT " . $start . ",$limit";
        }
        
        
        $res=$this->query($sql);
        $chkres=$this->numRows($res);
        if($chkres>0)
        {$i=0;
            while($row=$this->mysqlFetchArr($res))
            {   
                $arr[]= $row;
                $i++;
            }
            $err=array('Code'=> 0,'Msg'=>'Values are fetched');
        }
        else
        {
                $arr = array();
                $err = array('Code'=> 1,'Msg'=>'Search Query Failed');
        }
    $result=array('results'=>$arr,'error'=>$err);
    return $result;
    }
   
    /* 
    public function suggestOff($params)
    {
	$sql="SELECT
                         offername,
     *                   MATCH(offername) AGAINST ('" . $params['str'] . "*' IN BOOLEAN MODE) as startwith
     *        FROM 
     *                   tbl_offer_master
     *        WHERE 
     *                   MATCH(offername) AGAINST ('".$params['str']."*' IN BOOLEAN MODE) 
     *        ORDER BY 
     *                   startwith DESC LIMIT";
        $page   = ($params['page'] ? $params['page'] : 1);
        $limit  = ($params['limit'] ? $params['limit'] : 15);
        ;
        if (!empty($page))
        {
            $start = ($page * $limit) - $limit;
      echo      $sql.=" LIMIT " . $start . ",$limit";
        }
        $res=$this->query($sql);
        if($this->numRows($res)>0)
        {
            while($row=$this->fetchData($res))
            {
                $arr[]= $row;
            }
            $err=array('Code'=> 0,'Msg'=>'Values are fetched');
        }
        else
        {
                $arr = "No records matched";
                $err = array('Code'=> 1,'Msg'=>'Search Query Failed');
        }
    $result=array('results'=>$arr,'error'=>$err);
    return $result;
    }
*/
    
    public function suggestVendor($params)
    {
	$sql="  SELECT 
                        vendor_name,
                        MATCH(vendor_name) AGAINST ('" . $params['str'] . "*' IN BOOLEAN MODE) AS startwith 
                FROM 
                        tbl_vendor_master
                WHERE   
                        MATCH(vendor_name) AGAINST ('".$params['str']."*' IN BOOLEAN MODE) 
                ORDER BY 
                        startwith DESC";
        
        $page   = ($params['page'] ? $params['page'] : 1);
        $limit  = ($params['limit'] ? $params['limit'] : 15);
        
        if (!empty($page))
        {
            $start = ($page * $limit) - $limit;
            $sql.=" LIMIT " . $start . ",$limit";
        }
        $res=$this->query($sql);
        if($this->numRows($res)>0)
        {
            while($row=$this->fetchData($res))
            {
                $arr[]= $row;
            }
            $err=array('Code'=> 0,'Msg'=>'Values are fetched');
        }
        else
        {
                $arr = array();
                $err = array('Code'=> 1,'Msg'=>'Search Query Failed');
        }
    $result=array('results'=>$arr,'error'=>$err);
    return $result;
    }

    
    
}
?>
