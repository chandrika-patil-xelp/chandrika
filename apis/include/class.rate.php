<?php

include_once APICLUDE . 'common/db.class.php';

class rate extends DB {

    function __construct($db) {
        parent::DB($db);
    }

    
    public function addRates($params)
    {
    $tparams = json_decode($params[0],1);
        $dres=$this->addDmdQualityRates($tparams);
        $gres=$this->addGoldRate($tparams);
        
        $result = array();
        if($dres['error']['err_code'] == '1' || $gres['error']['err_code'] == '1')
        {
            
            $err = array('err_code' => 1, 'err_msg' => 'Error in adding rates');
            
            
        }     
        else
        {
            $err = array('err_code' => 0, 'err_msg' => 'Rates added successfully');
        }   
        $results = array('result' => $result, 'error' => $err);
        return $results;
        
    }
    
    
    public function addGoldRate($params)
    {
        
        $crt24=  floatval($params['grate']);
        $crtR22=  floatval(($crt24*91.6)/100);
        $crtR18=floatval(($crt24*75.1)/100);
        $crtR14=floatval(($crt24*58.3)/100);
        $crtR9=floatval(($crt24*37.5)/100);
        
        $sql="INSERT INTO tbl_metal_purity_master(id,price,createdon,updatedby) VALUES(1,$crtR9,now(),".$params['userid']."),(2,$crtR14,now(),".$params['userid']."),(3,$crtR18,now(),".$params['userid']."),(4,$crtR22,now(),".$params['userid']."),(5,$crt24,now(),".$params['userid'].") "
                . "ON DUPLICATE KEY UPDATE price = VALUES(price), updatedby = VALUES(updatedby )";
        
        $res=$this->query($sql);
        if ($res) {
            $err = array('err_code' => 0, 'err_msg' => 'Data inserted successfully');
        } else {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
        
    }
    
    
    public function addDmdQualityRates($params)
    {
        $sql = "INSERT INTO tbl_diamond_quality_master (id,price_per_carat,createdon,updatedby) VALUES ";
        
        foreach ($params['diamondrates'] as $key=>$val)
        {
           
            $tmpparams= array('id' =>  intval($key+1),'price_per_carat'=>$val,'updatedby'=>$params['userid']);
                
            
           $sql.="(" . $tmpparams['id'] . "," . $tmpparams['price_per_carat'] . ",now()," . $tmpparams['updatedby'] . "),";
        }

        $sql = trim($sql, ",");
        $sql.=" ON DUPLICATE KEY UPDATE id = VALUES(id), price_per_carat = VALUES(price_per_carat),updatedby=VALUES(updatedby)";

        
        $res=$this->query($sql);
        if ($res) 
        {
            $err = array('err_code' => 0, 'err_msg' => 'Data inserted successfully');
        }
        else
        {
            $err = array('err_code' => 1, 'err_msg' => 'Error in inserting');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
       
    }
    
    
    public function getGoldRates($params)
    {
        $sql= "SELECT id,dname,dvalue,price FROM tbl_metal_purity_master WHERE active_flag = 1";
        
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
        
        
        if($res)
        {
            while($row = $this->fetchData($res))
            {
                $reslt['id']        =     $row['id'];
                $reslt['name']     =     $row['dname'];
                $reslt['value']    =     $row['dvalue'];
                $reslt['price']     = floatval($row['price']);
                $result[]= $reslt;

            }
            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
        }
        else
        {
            $err = array('err_code' => 1, 'err_msg' => 'Error in fetching successfully');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
        
    }
    
    public function getAllGoldRates($params)
    {
        $sql= "SELECT id,dname,dvalue,price FROM tbl_metal_purity_master WHERE active_flag IN (1,3)";
        
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
        
        
        if($res)
        {
            while($row = $this->fetchData($res))
            {
                $reslt['id']        =     $row['id'];
                $reslt['name']     =     $row['dname'];
                $reslt['value']    =     $row['dvalue'];
                $reslt['price']     = floatval($row['price']);
                $result[]= $reslt;

            }
            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
        }
        else
        {
            $err = array('err_code' => 1, 'err_msg' => 'Error in fetching successfully');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
        
    }
    
    public function getDmdRates($params)
    {
        $sql= "SELECT id,dname,dvalue,price_per_carat FROM tbl_diamond_quality_master WHERE active_flag = 1";
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
        
        if($res)
        {
            while($row = $this->fetchData($res))
            {
                $reslt['id']        =     $row['id'];
                $reslt['name']     =     $row['dname'];
                $reslt['value']    =     $row['dvalue'];
                $reslt['price']     = floatval($row['price_per_carat']);
                $result[]= $reslt;

            }
            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
        }
        else
        {
            $err = array('err_code' => 1, 'err_msg' => 'Error in fetching successfully');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }
    
    public function getPltnmRates($params)
    {
        $sql= " SELECT
                        id,
                        dname,
                        dvalue,
                        price
                FROM 
                        tbl_metal_purity_master 
                WHERE 
                        active_flag = 3";
        
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
        
        if($res)
        {
            while($row = $this->fetchData($res))
            {
                $reslt['id']        =     $row['id'];
                $reslt['name']     =     $row['dname'];
                $reslt['value']    =     $row['dvalue'];
                $reslt['price']     = floatval($row['price']);
                $result[]= $reslt;
            }
            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
        }
        else
        {
            $err = array('err_code' => 1, 'err_msg' => 'Error in fetching successfully');
        }
        $results = array('result' => $result, 'error' => $err);
        return $results;
    }
    
    
    
    
    public function getAllRates($params)
    {
        $page = ($params['page'] ? $params['page'] : 1);
        $limit = ($params['limit'] ? $params['limit'] : 1000);
        //Making sure that query has limited rows
      
        
        $grates=$this->getGoldRates($params);
        $dmdrates=$this->getDmdRates($params);
        $prates=$this->getPltnmRates($params);
        
        
        if($grates['error']['err_code'] == '1' || $dmdrates['error']['err_code'] == '1' || $prates['error']['err_code'] == '1')
        {
            $err = array('err_code' => 1, 'err_msg' => 'Error in fetching rates');
        }     
        else
        {
            $err = array('err_code' => 0, 'err_msg' => 'Data fetched successfully');
            $result['goldRates']=$grates['result'];
            $result['diamondRates']=$dmdrates['result'];
            $result['platinumRates']=$prates['result'];
        }   
        
        $results = array('result' => $result, 'error' => $err);
        return $results;
       
    }
    
    
}



?>