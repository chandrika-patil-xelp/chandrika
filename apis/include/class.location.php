<?php

require_once APICLUDE.'common/db.class.php';

class location extends DB {

    public function viewbyPincode($params) {
      $cname = (!empty($params['code'])) ? trim(urldecode($params['code'])) : '';
      if (empty($cname)) 
      {
            $arr = array();
            $err = array('Code' => 1, 'Msg' => 'Invalid Parameters');
            $result = array('results' => $arr, 'error' => $err);
            $res = $result;
            return $res;
      }
        $vsql = "SELECT area,city,state,country,latitude,longitude from tbl_area_master where pincode='" . $params['code'] . "'";
        $vres = $this->query($vsql);
        $cres = $this->numRows($vres);
        if ($cres > 0) {
            while ($row = $this->fetchData($vres)) {
                $arr[] = $row;
            }
            $err = array('code' => 0, 'msg' => 'Value fetched successfully');
        } else {
            $arr = array();
            $err = array('code' => 1, 'msg' => 'no records found');
        }
        $result = array('results' => $arr, 'error' => $err);
        return $result;
    }
 
}

?>
