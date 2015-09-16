<?php 
include APICLUDE.'common/db.class.php';

   class orders extends DB
{
       function __construct($db) 
       {
           parent::DB($db);
       }
       
       public function ordById($params)
       {
            $sql ="SELECT * from tbl_order_master WHERE usermobile=".$params['usermobile']." ORDER BY dt DESC";
            $res=$this->query($sql);
            if($this->numRows($res)>0)
            {
                while($row = $this->fetchData($res))
                {
                    $arr[] = $row;
                    $err= array('code' => 0, 'msg' => 'Data Fetched Successfully');
                }
            }
            else
            {
                $arr = "Some problem in fetching details";
                $err= array('code' => 0, 'msg' => 'Data Fetched Successfully');
            }
            $result = array('results'=>$arr,'error'=>$err);
            return $result;
       }
       
       public function actOrdList($params)
       {
            $sql = "SELECT * from tbl_order_master WHERE usermobile=".$params['usermobile']." and ordstatus=1 ORDER BY usermobile";               
            $res = $this->query($sql);
            if($this->numRows($res)>0)
            {
                while($row=$this->fetchData($res))
                {
                $arr[] = $row;
                $err=array('code'=>0,'msg'=>'Activated Order List');
                }
            }
            else
            {
                $arr[] ="There is no activated List found";
                $err= array('code' => 1, 'msg' => 'error in fetching data');
            }
            $result = array('results'=>$arr,'error'=>$err);
            return $result;
       }

    /*   public function ordByCat($params)
       {
          $sql = "SELECT 
                            p.pstatus,
                            s.quantity,
                            p.pcode,
                            p.ptype,
                            p.cwv,
                            p.pname,
                            s.cdt
                  FROM 
                            jzeva.order as o
                  JOIN 
                            shopcart as s 
                  ON 
                            o.shopcartid=s.scid 
                  JOIN 
                            jzeva.product as p 
                  ON 
                            s.pcode=p.pcode
                  WHERE 
                            p.pcode='".$params['pcode']."'
                  ORDER BY 
                            s.quantity"; 
           $res = $this->query($sql);
          if($this->numRows($res))
          {
            while($row=$this->fetchData($res))
              {
                $arr[] = $row;
                $err['error'] = array('code' => 0, 'msg' => 'Details are fetched');
              }
          }
          else
          {
              $arr="There is no product in the order";
              $err['error'] = array('code' => 0, 'msg' => 'no product in order');
          }
            $result = array('results' => $arr, 'error' => $err['error']);
            return $result;
       }
       
       public function ordByAmt($params)
       {   
           $sql = "SELECT p.pstatus,s.quantity,p.pcode,p.cwv,p.pname,s.cdt FROM jzeva.order as o JOIN jzeva.shopcart as s ON o.shopcartid=s.scid JOIN jzeva.product as p ON s.pcode=p.pcode WHERE p.pcode='".$params['pcode']."'ORDER BY s.quantity";
           $res=$this->query($sql);
           if($this->numRows($res)>0)
           {
               while($row=$this->fetchData($res))
               {
                   $arr[]=$row;
                   $err['error'] = array('code' => 0, 'msg' => 'Order List with highest cost');
               }
           }
           else
           {
                   $arr[]="No record found";
                   $err['error'] = array('code' => 0, 'msg' => 'Error in fetching records.');
               
           }
            $result = array('results' => $arr, 'error' => $err['error']);
            return $result;
        }
     * 
     */
}
?>