<?php
include APICLUDE . 'common/db.class.php';
class cart extends DB {
    function __construct($db) 
    {
        parent::DB($db);
        
    }
        
    public function addToCart($params)
    {
        $ssql="SELECT product_id,quantity from tbl_user_cart WHERE usermobile='".$params['usermobile']."' AND product_id =".$params['pid']." AND vendormobile=".$params['vendormobile'];
        $sres=$this->query($ssql);
        $row=$this->fetchData($sres);
        $avlQt=$row['quantity'];
        if($this->numRows($sres)<1)
        {
            $isql="INSERT INTO tbl_user_cart(product_id,usermobile,vendormobile,quantity,add_date,update_date,active_flag) VALUES('".$params['pid']."','".$params['usermobile']."',".$params['vendormobile'].",".$params['qty'].",now(),now(),1)";
            $ires=$this->query($isql);                         
             if($ires)
             {  
                 $arr="Insertion done successfully";
                 $err['error'] = array('code' => 0, 'msg' => 'Row Updated Successfully');
             }
             else
            {
                $arr="Some problem in Inserting value";
                $err= array('code' => 0, 'msg' => 'Insertion Failed');
            }
        }
        if($this->numRows($sres)>0)
        {
            $newqt = $avlQt + $params['qty'];
            $usql="UPDATE tbl_user_cart SET quantity=".$newqt." WHERE usermobile=".$params['usermobile']." AND product_id =".$params['pid']." AND vendormobile=".$params['vendormobile'];
            $ures=$this->query($usql);
            if($ures>0)
            {
               $arr="Update Done"; 
               $err['error'] = array('code' => 0, 'msg' => 'Update Successful');
            }
            else
            {
                $arr="problem in Updation";
                $err['error'] = array('code' => 0, 'msg' => 'Update Failure.');
            }
        }
        else
        {
            $arr="Product is not updated in the cart";
            $err=array('Code'=>1,'Msg'=>'Error in updating cart');
        }
        $result = array('results' => $arr, 'error' =>$err);
        return $result;
    }
    
    public function editcart($params)
    {
        $qry = "UPDATE tbl_user_cart SET quantity=".$params['quantity'].",update_date=now() WHERE cart_id=".$params['cart_id']." AND product_id=".$params['product_id']." AND active_flag=1";
        $ret = $this->query($qry);
        if($ret)
        {
            $arr="Product quantity is added";
            $err=array('Code'=>0,'Msg'=>'Product Added');
        }
        else
        {
            $arr="product quantity is not edited";
            $err=array('Code'=>1,'Msg'=>'Error in editing cart quantity');
        }
        $result=array('result'=>$arr,'error'=>$err);
        return $result;
    }
    
    public function readcart($params)
    {
        $sql = "SELECT cart_id,product_id,vendormobile,usermobile,quantity FROM tbl_user_cart WHERE cart_id=".$params['cartid']." AND active_flag=1";
        $res = $this->query($sql);
        if ($res) 
        {
            $data['total']=$this->numRows($res);
            while ($row=$this->fetchData($res)) {
                $data['results'][] = $row;
                $product_id[] = $row['product_id'];
                $qty_arr[$row['product_id']] = $row['quantity'];
            }
        }
        $total_amount = 0;
        if(!empty($product_id))
        {                                       
            $product_id_arr = array_unique($product_id);
            if(count($product_id))
            {
                
                $product_id_str = implode("','", $product_id_arr);
                $sql = "SELECT product_id as product_id, product_display_name as pdisp, product_model as model, product_brand as brand, prd_price as price, prd_price as offerprice, product_currency as currency FROM tbl_product_master WHERE product_id IN('".$product_id_str."')";
                $res = $this->query($sql);
                if($res)
                {   

                    while($row=$this->fetchData($res)) 
                    {
                        $data['products'][$row['product_id']] = $row;
                        $tmp_qty = $qty_arr[$row['product_id']];
                        if($tmp_qty > 1)
                        {
                            $total_amount += ($row['offerprice'] * $tmp_qty * 1);
                            $cur_total = ($row['offerprice'] * $tmp_qty * 1);
                        }
                        else
                        {
                            $total_amount += $row['offerprice'];
                            $cur_total = $row['offerprice'];
                        }
                        $data['products'][$row['product_id']]['cur_total'] = number_format($cur_total, '2', '.', ',');
                    }
                    $err=array('Code'=>0,'Msg'=>'Data is fetched');
                }
                else
            {

                $data="Values are not fetched as desired";
                $err=array('Code'=>1,'Msg'=>'Data is not fetched');
            }
            }
            else
            {

                $data="Values are not fetched as desired";
                $err=array('Code'=>1,'Msg'=>'Data is not fetched');
            }
        
            $data['total_amount'] = $total_amount;
            }
        else
        {
            $data="No product with this id";
            $err=array('code'=>0,'msg'=>'select operation returns no result');
        }
        
        $result=array('total'=>$data,'error'=>$err);
        return $result;
    }

    public function delPrd($params) 
    {
       $sql = "UPDATE tbl_user_cart SET active_flag=0,update_date=now() WHERE cart_id=".$params['cartid']." AND product_id=".$params['pid']." AND active_flag = 1";
        $res = $this->query($sql);
        if($res)
        {
            $arr = 'Data deleted';
            $err = array('code' => 0, 'msg' => 'Cart is deactivated');
        } 
        else
        {
            $arr = 'Error deleting Cart';
            $err = array('Code' => 0, 'Msg' => 'Update Not Done');
        }
            $result = array('results'=>$arr,'error'=>$err);
            return $result;
    }

  /*  public function cartClr($params)
    {
        $sql = "Delete FROM tbl_user_cart WHERE cart_id='".$params['cartid']."' AND active_flag = 1 AND product_id=".$params['product_id']."";
        $ret = $this->query($sql);
        if($this->numrows($ret)>0) 
        {
            $arr = 'Cart has been cleared';
            $err= array('code' => 0, 'msg' => 'Cart Updated Successfully');
        }
        else
        {
            $arr= 'Error clearing the cart';
            $err= array('code' => 0, 'msg' => 'Cart Updated Unsuccessfully');
        }
        $result = array('results'=>$arr,'error'=>$err);
        return $result;
    }
*/
}

?>