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
        $sql="SELECT product_id,product_display_name,product_model,product_brand,category_id FROM tbl_product_master where product_name LIKE '%".$params['srch']."%' ORDER BY product_name DESC LIMIT 0,10";
        $res=$this->query($sql);
        if($this->numRows($res)>0)
        {
            while($row=$this->fetchData($res))
            {
                $arr[]=$row;
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

    public function suggestCity($params)
    {
	$sql="SELECT cityname FROM tbl_city_master where cityname LIKE '%".$params['srch']."%' ORDER BY cityname DESC";
        $res=$this->query($sql);
        if($this->numRows($res)>0)
        {
            while($row=$this->fetchData($res))
            {
                $arr= $row;
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
    
    public function suggestBrand($params)
    {
	$sql="SELECT name FROM tbl_brandid_generator where name LIKE '%".$params['srch']."%' ORDER BY name DESC";
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
                $arr = "No records matched";
                $err = array('Code'=> 1,'Msg'=>'Search Query Failed');
        }
    $result=array('results'=>$arr,'error'=>$err);
    return $result;
    }
    
    public function suggestCat($params)
    {
	$sql="SELECT category_name FROM tbl_categoryid_generator where category_name LIKE '%".$params['srch']."%' ORDER BY category_name DESC";
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
                $arr = "No records matched";
                $err = array('Code'=> 1,'Msg'=>'Search Query Failed');
        }
    $result=array('results'=>$arr,'error'=>$err);
    return $result;
    }
    
    public function suggestOff($params)
    {
	$sql="SELECT offername FROM tbl_offer_master where offername LIKE '%".$params['srch']."%' ORDER BY offername DESC";
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

    public function suggestVendor($params)
    {
	$sql="SELECT userName FROM tbl_registration where usertype=2 AND userName LIKE '%".$params['srch']."%' ORDER BY userName DESC";
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
}
?>