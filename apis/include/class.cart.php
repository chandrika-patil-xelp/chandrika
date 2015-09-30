<?php
include APICLUDE . 'common/db.class.php';
class cart extends DB {
    function __construct($db) 
    {
        parent::DB($db);
        
    }

    public function getCartId($params)
    {
      $ip=$params['ip'];
      $umob=$params['umob'];
      if(!empty($ip) || !empty($umob))
      {
        $sql="SELECT cart_id from tbl_cartid_generator where ipadd='".$ip."' AND logmobile=".$umob;
        $res=$this->query($sql);
        $chres=$this->numRows($res);
        if($chres>0)
        {
            $row=$this->fetchData($res);
            $arr=$row['cart_id'];
            $err=array('Code'=>0,'Msg'=>'Cart id is obtained');
        }
        else
        {
            $arr=array();
            $err=array('Code'=>1,'Msg'=>'Cart id is not yet generated');
        }
      }
      else
      {
        $sql="SELECT cart_id from tbl_cartid_generator where ipadd='".$params['ip']."'";
        $res=$this->query($sql);
        $chres=$this->numRows($res);
        if($chres>0)
        {
            $row=$this->fetchData($res);
            $arr=$row['cart_id'];
            $err=array('Code'=>0,'Msg'=>'Cart id is obtained');
        }
        else
        {
            $arr=array();
            $err=array('Code'=>1,'Msg'=>'Cart id is not yet generated');
        } 
      }
      $result=array('results'=>$arr,'error'=>$err);
      return $result;
}   
        
     
#     Here Search is based on ip address and user logged mobile
#     ---------So that a unique ip can be assigned to them---------
#     what if ip address and log mobile conflicts with other users too???
#     Also when anonymous user adds something 
#
    public function addToCart($params)
    {  
        $isInside= 0;
        $dt     = json_decode($params['dt'],1);
        $detls  = $dt['result'];
        $proErr = $dt['error'];
            if($proErr['errCode']== 0)
           {
                $cart_Id = "JZ";
                $alph = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
                $num = array(0,1,2,3,4,5,6,7,8,9);
                $tmp = "";
                for($i=0;$i<8;$i++)
                {
                    if ((strlen($tmp)%2)==0)
                    {
                        $tmp .= $alph[array_rand($alph)];
                    }
                    else 
                    {
                        $tmp .= $num[array_rand($num)];
                    }
                }
                $cartid= $tmp;
             $crtsql = "SELECT cart_id FROM tbl_cartid_generator WHERE ipadd='".$detls['ip']."' or logmobile=".$detls['logmob']."";
            $crtres = $this->query($crtsql);
	    $cnt1 = $this->numRows($crtres);
                if($cnt1==0)
                {
                    $isql = "INSERT INTO tbl_cartid_generator(cart_id,ipadd,logmobile,cdt,udt,aflag) VALUES('".$cartid."','".$detls['ip']."',".$detls['logmob'].",now(),now(),1)";
                    $ires = $this->query($isql);
                }    
                else
                {
                    $row=$this->fetchData($crtres);
                    $cartid=$row['cart_id'];
                }
            
           $ssql="SELECT product_id,quantity from tbl_user_cart WHERE usermobile='".$detls['logmob']."' AND product_id =".$detls['pid']." AND vendormobile=".$detls['vmob'];
            $sres=$this->query($ssql);
            $row=$this->fetchData($sres);
           $avlQt=$row['quantity'];
            $cnt2=$this->numRows($sres);
                if(!$cnt2)
                {
                  $ucsql="insert into tbl_user_cart(cart_id,product_id,vendormobile,usermobile,quantity,add_date,update_date,active_flag)
                         VALUES('".$cartid."',".$detls['pid'].",".$detls['vmob'].",".$detls['logmob'].",".$detls['qty'].",now(),now(),1)";
                $ucres = $this->query($ucsql);                
                    if($ucres)
                    {
                        $arr="Cart Updated";
                        $err=array('Code'=>0,'Msg'=>'Insertion completed');
                    }
                    else
                    {
                        $arr="Cart not Updated";
                        $err=array('Code'=>0,'Msg'=>'Insertion incomplete');
                    }
                }
                else if($cnt2>0)
                {
                $row=$this->fetchData($sres);
                $newqt = $avlQt + $detls['qty'];
                $usql="UPDATE tbl_user_cart SET quantity=".$newqt.",active_flag=1 WHERE usermobile=".$detls['logmob']." AND product_id =".$detls['pid']." AND vendormobile=".$detls['vmob'];
                $ures=$this->query($usql);
                    if($ures>0)
                    {
                        $arr="Update Done"; 
                        $err= array('code' => 0, 'msg' => 'Update Successful');
                    }
                    else
                    {
                        $arr="problem in Updation";
                        $err= array('code' => 0, 'msg' => 'Update Failure.');
                    }
                }
           }
        else
        {
            $arr="Product is not updated in the cart";
            $err=array('Code'=>1,'Msg'=>'Error in updating cart');
        }
            $result = array('results'=>$arr, 'error' => $err);
            return $result;
}
    
    
  /*  public function addToCart($params)
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
            $usql="UPDATE tbl_user_cart SET quantity=".$newqt.",active_flag=1 WHERE usermobile=".$params['usermobile']." AND product_id =".$params['pid']." AND vendormobile=".$params['vendormobile'];
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
    } */
    
    public function editcart($params)
    {
        $qry = "UPDATE tbl_user_cart SET quantity=".$params['quantity'].",update_date=now() WHERE cart_id=".$params['cart_id']." AND product_id=".$params['product_id']." AND vendormobile=".$params['vendormobile']." AND active_flag=1";
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
       $csql="SELECT cart_id FROM tbl_cartid_generator WHERE ipadd='".$params['ip']."' or logmobile=".$params['logmob']." AND aflag=1";
       $cres = $this->query($csql);
       $row=$this->fetchData($cres);
       $cartid=$row['cart_id'];
        
       $sql = "SELECT cart_id,product_id,vendormobile,usermobile,quantity FROM tbl_user_cart WHERE cart_id='".$cartid."' AND active_flag=1";
       $res = $this->query($sql);
        if ($res) 
        {
            $data['total']=$this->numRows($res);
            while ($row=$this->fetchData($res)) 
            {
                $data['results'][] = $row;
                $product_id[] = $row['product_id'];
                $qty_arr[$row['product_id']] = $row['quantity']; //quantity value in cart
            }
        }
        $total_amount = 0;
        if(!empty($product_id))
        {                                       
            $product_id_arr = array_unique($product_id);
            if(count($product_id))
            {
                
                $product_id_str = implode("','", $product_id_arr); //numerous product id
                
                $sql = "SELECT product_id as product_id, product_display_name as pdisp, product_model as model, product_brand as brand, prd_price as price, prd_price as offerprice, product_currency as currency FROM tbl_product_master WHERE product_id IN('".$product_id_str."')";
                $res = $this->query($sql);
                if($res)
                {   

                    while($row=$this->fetchData($res)) 
                    {
                        $data['products'][$row['product_id']] = $row; //reading all product one by one
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
            $data="No product associated in this cart";
            $err=array('code'=>0,'msg'=>'select operation returns no result');
        }
        
        $result=array('total'=>$data,'error'=>$err);
        return $result;
    }

    public function delPrd($params) 
    {
       $sql = "UPDATE tbl_user_cart SET active_flag=2,update_date=now() WHERE cart_id=".$params['cid']." AND product_id=".$params['pid']." AND vendormobile=".$params['vmob']." AND active_flag = 1";
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

    public function cartClr($params)
    {
        $sql = "UPDATE tbl_user_cart set active_flag=2 where cart_id='".$params['cid']."'";
        $ret = $this->query($sql);
        if($ret) 
        {
            $arr = 'Cart has been cleared';
            $err= array('code' => 0, 'msg' => 'Cart Updated Successfully');
        }
        else
        {
            $arr= 'Error clearing the cart';
            $err= array('code' => 0, 'msg' => 'Cart is not Updated ');
        }
        $result = array('results'=>$arr,'error'=>$err);
        return $result;
    }
}

?>