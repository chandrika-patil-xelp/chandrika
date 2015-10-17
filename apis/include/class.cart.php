<?php
include APICLUDE . 'common/db.class.php';
class cart extends DB {
    function __construct($db) 
    {
        parent::DB($db);
        
    }

    public function getCartId($params)
    {
      
      $uid=$params['uid'];
      if(!empty($uid))
      {
        $sql="SELECT 
                            cart_id 
              FROM 
                            tbl_cartid_generator 
              WHERE 
                            user_id=\"".$params['uid']."\"";
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
             $crtsql = "SELECT 
                                cart_id 
                        FROM 
                                tbl_cartid_generator 
                        WHERE 
                                user_id=".$detls['uid']."";
            $crtres = $this->query($crtsql);
	    $cnt1 = $this->numRows($crtres);
                if($cnt1==0)
                {
                    $isql ="INSERT INTO 
                                    tbl_cartid_generator(cart_id,user_id,date_time,active_flag) 
                            VALUES('".$cartid."',".$detls['uid'].",now(),1)";
                    $ires = $this->query($isql);
                }    
                else
                {
                    $row=$this->fetchData($crtres);
                    $cartid=$row['cart_id'];
                }
            
           $ssql="      SELECT 
                                product_id,
                                quantity from tbl_user_cart
                        WHERE 
                                user_id='".$detls['uid']."' 
                                AND product_id =".$detls['pid']." 
                                AND vendor_id=".$detls['vid'];
           $sres=$this->query($ssql);
           $row=$this->fetchData($sres);
           $avlQt=$row['quantity'];
            $cnt2=$this->numRows($sres);
                if($cnt2==0)
                {
                  $ucsql="  INSERT INTO
                                    tbl_user_cart
                                    (cart_id,
                                    product_id,
                                    vendor_id,
                                    user_id,
                                    quantity,
                                    add_date,
                                    update_date,
                                    active_flag)
                            VALUES
                                    (\"".$cartid."\",
                                     \"".$detls['pid']."\",
                                     \"".$detls['vid']."\",
                                     \"".$detls['uid']."\",
                                     \"".$detls['qty']."\"
                                     ,now()
                                     ,1)";
                    $ucres = $this->query($ucsql);                
                    if($ucres)
                    {
                        $arr="Cart Updated";
                        $err=array('Code'=>0,'Msg'=>'Insertion completed');
                    }
                    else
                    {
                        $arr=array();
                        $err=array('Code'=>0,'Msg'=>'Insertion incomplete');
                    }
                }
                else if($cnt2>0)
                {
                $row=$this->fetchData($sres);
                $newqt = $avlQt + $detls['qty'];
                $usql=" UPDATE 
                                tbl_user_cart 
                        SET 
                                quantity=".$newqt.",
                                active_flag=1 
                        WHERE 
                                user_id=".$detls['uid']." 
                                AND product_id =".$detls['pid']." 
                                AND vendor_id=".$detls['vid'];
                
                $ures=$this->query($usql);
                    if($ures)
                    {
                        $arr="Update Done"; 
                        $err= array('code' => 0, 'msg' => 'Update Successful');
                    }
                    else
                    {
                        $arr=array();
                        $err= array('code' => 0, 'msg' => 'Update Failure.');
                    }
                }
           }
        else
        {
            $arr=array();
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
       $qry = " UPDATE 
                        tbl_user_cart 
                SET 
                        quantity=".$params['quantity']."
                WHERE 
                        cart_id='".$params['cart_id']."' 
                        AND product_id=".$params['product_id']." 
                        AND vendor_id=".$params['vid']." 
                        AND active_flag=1";
       $ret = $this->query($qry);
        if($ret)
        {
            $arr="Product quantity is added";
            $err=array('Code'=>0,'Msg'=>'Product Updated');
        }
        else
        {
            $arr=array();
            $err=array('Code'=>1,'Msg'=>'Error in editing cart quantity');
        }
        $result=array('result'=>$arr,'error'=>$err);
        return $result;
    }
    
    public function readcart($params)
    {
       $csql="          SELECT 
                                cart_id 
                        FROM 
                                tbl_cartid_generator
                        WHERE 
                            user_id=".$params['uid']." 
                            AND active_flag=1";
       $cres = $this->query($csql);
       $row=$this->fetchData($cres);
       $cartid=$row['cart_id'];
        
       $sql = "         SELECT 
                                cart_id,
                                product_id,
                                vendor_id,
                                user_id,
                                quantity 
                        FROM
                                tbl_user_cart 
                        WHERE 
                                cart_id='".$cartid."' 
                                AND active_flag=1";
       $res = $this->query($sql);
        if ($res) 
        {
            $arr['total']=$this->numRows($res);
            while ($row=$this->fetchData($res)) 
            {
                $arr['results'][] = $row;
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
                
                $sql = "    SELECT 
                                    product_id 
                            AS 
                                    product_id,
                                    product_display_name AS pdisp,
                                    product_model AS model,
                                    product_brand AS brand,
                                    product_price AS price, 
                                    product_price AS offerprice,
                                    product_currency AS currency 
                            FROM    
                                    tbl_product_master
                            WHERE 
                                    product_id IN('".$product_id_str."')";
                $res = $this->query($sql);
                if($res)
                {   

                    while($row=$this->fetchData($res)) 
                    {
                        $arr['products'][$row['product_id']] = $row; //reading all product one by one
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
                        $arr['products'][$row['product_id']]['cur_total'] = number_format($cur_total, '2', '.', ',');
                        }
                    $err=array('Code'=>0,'Msg'=>'Data is fetched');
                }
                else
                {

                    $arr=array();
                    $err=array('Code'=>1,'Msg'=>'Data is not fetched');
                }
            }
            else
            {

                $arr=array();
                $err=array('Code'=>1,'Msg'=>'Data is not fetched');
            }
        
            $arr['total_amount'] = $total_amount;
        }
        else
        {
            $arr=array();
            $err=array('code'=>0,'msg'=>'select operation returns no result');
        }
        
        $result=array('total'=>$arr,'error'=>$err);
        return $result;
    }

    public function delPrd($params) 
    {
       $sql = "     UPDATE  
                            tbl_user_cart 
                    SET 
                            active_flag=2
                    WHERE 
                            cart_id=".$params['cid']." 
                            AND product_id=".$params['pid']." 
                            AND vendor_id=".$params['vid']." 
                            AND active_flag = 1";
       $res = $this->query($sql);
        if($res)
        {
            $arr = 'Data deleted';
            $err = array('code' => 0, 'msg' => 'Cart is deactivated');
        } 
        else
        {
            $arr = array();
            $err = array('Code' => 1, 'Msg' => 'Update Not Done');
        }
            $result = array('results'=>$arr,'error'=>$err);
            return $result;
    }

    public function cartClr($params)
    {
        $sql = "        UPDATE 
                                tbl_user_cart 
                        SET 
                                active_flag=2 
                                cart_id='".$params['cid']."'";
        $ret = $this->query($sql);
        if($ret) 
        {
            $arr = 'Cart has been cleared';
            $err= array('code' => 0, 'msg' => 'Cart Updated Successfully');
        }
        else
        {
            $arr= array();
            $err= array('code' => 0, 'msg' => 'Cart is not Updated ');
        }
        $result = array('results'=>$arr,'error'=>$err);
        return $result;
    }
}

?>