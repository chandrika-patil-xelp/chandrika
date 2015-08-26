<?php

	include APICLUDE.'common/db.class.php';
	class shopcart extends DB
    {
		function __construct($db) {
			parent::DB($db);
		}
		
		public function addCart($cId,$pId,$quant)
		{
			if(empty($cId) || empty($pID) || empty($quant))
			{
                            $result['error'] = 1;
                            $arr['msg']="Invalid Parameters";
                            return $arr;
                        }
                        
                        if(!empty($cId) || !empty($pID) || !empty($quant))
                        
                            $sql = "SELECT
                                                 quantity,
                                                 status
                                        FROM     
                                                 shopcart
                                        WHERE 
                                                 scid=\"" . $cart_id . "\" 
                                        AND      user_id=\"" . $user_id . "\" 
                                        AND      pcode=\"" . $pcode . "\" 
                                        AND      status = 1";
                            $res = $this->query($sql);
                            
                            if($res)
                            {
				while($row = $this->fetchData($res))
				{
                                        if($row['quantity'])
                                        {
                                            $sql1 = "UPDATE
                                                                   shopcart 
                                                            SET 
                                                                   quantity=(quantity+$quantity),
                                                                   udt = now() 
                                                            WHERE 
                                                                   scid=\"" . $cart_id . "\" 
                                                            AND
                                                                   pcode=\"" . $pcode . "\"
                                                            AND 
                                                                   status = 1";
                                            $res2 = $this->query($sql1);
                                        }
                                        else 
                                        {
                                            $qry = "INSERT INTO 
                                                                    shopcart 
                                                                    (cart_id,
                                                                     pcode,
                                                                     vendor_id,
                                                                     user_id,
                                                                     quantity,
                                                                     cdt,
                                                                     udt,
                                                                     status) 
                                                           VALUES (
                                                                    \"" . $cart_id . "\",
                                                                    \"" . $pcode . "\",
                                                                    " . $user_id . ", 
                                                                    " . $quantity . ",
                                                                    now(),
                                                                    now(),
                                                                    1
                                                                  )";
                                            $new_added = 1;
                                        }
                                        $ret = $this->query($qry);
                                        
                                        if($this->numRows($res1))
				{
					$arr = $this->fetchData($res1);
				}
                                        
                                        
				}
                            }
                            
                        
                        return $arr;
			
		}
		
		public function edtCart($cId,$pId,$quant)
		{
                    if(empty($cId) || empty($pID) || empty($quant))
			{
                            $result['error'] = 1;
                            $arr['msg']="Invalid Parameters";
                            return $arr;
                        }
                    if(!empty($cId) || !empty($pID) || !empty($quant))
                        
			$sql = "UPDATE
                                            shopcart 
                                            SET 
                                                    quantity=(" . $quantity . "),
                                                    udt = now()
                                            WHERE
                                                    user_id=\"" . $user_id . "\"
                                            AND 
                                                    scid=\"" . $cart_id . "\"
                                            AND     
                                                    pcode=\"" . $pcode . "\"
                                             AND
                                                    status = 1";
			$res = $this->query($sql);
			if($res)
			{
				if($this->numRows($res))
				{
					$arr = $this->fetchData($res);
				}
			}
			return $arr;
		}
                
                public function readCart($cId)
                {
                    if(empty($cId) || empty($pID) || empty($quant))
			{
                            $result['error'] = 1;
                            $arr['msg']="Invalid Parameters";
                            return $arr;
                        }
                    if(!empty($cId))
                    {
                        $sql ="SELECT
                                        scid,
                                        pcode,
                                        user_id,
                                        quantity
                               FROM 
                                        shopcart 
                               WHERE 
                                        scid=\"" . $cart_id . "\"
                               AND 
                                        status = 1";
                        
                        $res = $this->query($sql);
                        if ($res) 
                            {
                                $data['total'] = $obj->numRows($res);
                                while($row = $obj->fetchData($res))
                                {
                                    $data['results'][] = $row;
                                    $product_id_arr[] = $row['pcode'];
                                    $qty_arr[$row['pcode']] = $row['quantity'];
                                }
                            }
                        $total_amount = 0;
                        if(!empty($product_id_arr))
                        {
                                $product_id_arr = array_unique($product_id_arr);
                                if (count($product_id_arr))
                                    {
                                        unset($obj);
                                        $obj = new dbclass($db['jzeva']);
                                        $product_id_str = implode("','", $product_id_arr);
                                        $sql2 = "SELECT
                                                        pcode, 
                                                        pname, 
                                                        ptype as category, 
                                                        twt as totalwt, 
                                                        mtype as metaltype, 
                                                        cvw as costinvoucher, 
                                                        cwv as costnovchr 
                                                FROM 
                                                        product 
                                                WHERE 
                                                        pcode in ('" . $product_id_str . "')";
                                        $res = $this->query($sql2);
                                        if ($res) 
                                        {
                                                while ($row = $obj->bringdata($res))
                                             {
                                                $data['products'][$row['pcode']] = $row;
                                                $tmp_qty = $qty_arr[$row['pcode']];
                                                if($tmp_qty > 1)
                                                {
                                                    $total_amount += ($row['cvw'] * $tmp_qty * 1);
                                                    $cur_total = ($row['cvw'] * $tmp_qty * 1);
                                                }
                                                else
                                                {
                                                $total_amount += $row['cvw'];
                                                $cur_total = $row['cvw'];
                                                }
                                                $data['products'][$row['product_id']]['cur_total'] = number_format($cur_total, '2', '.', ',');
                                             }
                                        }
                    			
                                    }
                        }
                        $data['total_amount'] = $total_amount;
                        return $data;
                    }
                }
                
                public function delPrd($cId,$pId)
                {
                    if(empty($cId) || empty($pID) || empty($quant))
			{
                            $result['error'] = 1;
                            $arr['msg']="Invalid Parameters";
                            return $arr;
                        }
                        
                        if(!empty($cId) || !empty($pID) || !empty($quant))
                            $sql = "UPDATE 
                                            shopcart
                                    SET 
                                            status=2, 
                                            udt = now()  
                                    WHERE 
                                            scid=\"" . $cart_id . "\" 
                                    AND 
                                            pcode=\"" . $pcode . "\"
                                    AND 
                                            status = 1";
                            $ret = $obj->firequery($qry);
                            if ($ret) 
                            {
                                
                                $arr['msg'] = 'Data deleted';
                                return $arr;
                            } 
                            else 
                                {
                                $arr['msg'] = 'Error deleting data';
                                return $arr;
                                }
                }
                
                public function cartClr($cId)
                {
                    if(empty($cId))
			{
                            $arr['msg']="Invalid Parameters";
                            return $arr;
                        }
                    if(!empty($cId))
                        {
                        $sql = "UPDATE 
                                        shopcart 
                                SET 
                                        status=2, 
                                        udt = now()  
                                WHERE 
                                        scid=\"" . $cart_id . "\" 
                                AND 
                                        status = 1";
                        $ret = $obj->firequery($qry);
                            if ($ret) 
                            {
                                $arr['msg'] = 'Cart has been cleared';
                                return $arr;
                            }
                            else
                                {
                                    $arr['msg'] = 'Error clearing the cart';
                                    return $arr;
                                }
                        }
                }
    }

?>