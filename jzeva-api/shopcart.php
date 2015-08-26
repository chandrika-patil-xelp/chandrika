<?php
include 'config.php';
include INCLUDER . 'dbclass.php';
$params = array_merge($_GET, $_POST);
if (!empty($params['trace'])) 
{
    define("DEBUG_MODE", "1");
}
else 
{
    define("DEBUG_MODE", "0");
    header('Content-type: application/json');
}
$obj = new dbclass($db['jzeva']);

$action = !empty($params['action']) ? $params['action'] : '';
$cart_id = !empty($params['cartid']) ? $params['cartid'] : '';
$pcode = !empty($params['pcode']) ? $params['pcode'] : '';
$quantity = !empty($params['quantity']) ? intval($params['quantity']) : '';
$ip_address = !empty($params['ip_address']) ? $params['ip_address'] : '';
$user_id = !empty($params['user_id']) ? $params['user_id'] : '';

switch ($action) 
{
    case 'addtocart':
        if (empty($cart_id) || empty($product_id) || empty($quantity)) 
        {
            $result['error'] = 1;
            $result['msg'] = 'Invalid Parameters';
            echo json_encode($result);
            exit;
        }
        $sql = "SELECT quantity,status FROM shopcart WHERE scid=\"" . $cart_id . "\" AND user_id=\"" . $user_id . "\" AND pcode=\"" . $pcode . "\" AND status = 1";
        $res = $obj->firequery($sql);
        if ($res) {
            $row = $obj->bringdata($res);
            if ($row['quantity']) {
                $qry = "UPDATE shopcart 
                        SET quantity=(quantity+$quantity), udt = now() 
                        WHERE scid=\"" . $cart_id . "\" 
                        AND pcode=\"" . $pcode . "\"
                        AND status = 1";
            } 
            else 
            {
                $qry = "INSERT INTO shopcart (cart_id, pcode, vendor_id, user_id, quantity, cdt, udt, status) 
                        VALUES (\"" . $cart_id . "\", \"" . $pcode . "\", " . $user_id . ", " . $quantity . ", now(), now(), 1 )";
                $new_added = 1;
            }
            
            $ret = $obj->firequery($qry);
            if ($ret) {
                $result['error'] = 0;
                $result['msg'] = 'Data Added';
            } else {
                $result['error'] = 1;
                $result['msg'] = 'Error adding data';
            }
            $result['new_added'] = $new_added;
            $result['cartId'] = $cart_id;
            echo json_encode($result);
        }
        break;
    case 'editcart':
        if (empty($cart_id) || empty($pcode) || empty($quantity))
        {
            $result['error'] = 1;
            $result['msg'] = 'Invalid Parameters';
            echo json_encode($result);
            exit;
        }
        $qry = "UPDATE shopcart SET quantity=(" . $quantity . "), udt = now() WHERE user_id=\"" . $user_id . "\" AND scid=\"" . $cart_id . "\" AND pcode=\"" . $pcode . "\" AND status = 1";
        $ret = $obj->firequery($qry);
        if ($ret) {
            $result['error'] = 0;
            $result['msg'] = 'Data Added';
        } else {
            $result['error'] = 1;
            $result['msg'] = 'Error editing data';
        }
        echo json_encode($result);
        break;     // for quantity increment decrement
    case 'readcart':
        if (empty($cart_id)) {
            $result['error'] = 1;
            $result['msg'] = 'Invalid Parameters';
            echo json_encode($result);
            exit;
        }

        $sql = "SELECT scid, pcode, user_id, quantity FROM shopcart 
                WHERE scid=\"" . $cart_id . "\"
                AND status = 1";
        $res = $obj->firequery($sql);
        if ($res) {
            $data['total'] = $obj->num_of_rows($res);
            while ($row = $obj->bringdata($res)) {
                $data['results'][] = $row;
                $product_id_arr[] = $row['pcode'];
                $qty_arr[$row['pcode']] = $row['quantity'];
            }
        }
        $total_amount = 0;
        if(!empty($product_id_arr))
        {
            $product_id_arr = array_unique($product_id_arr);
            if (count($product_id_arr)) {
                unset($obj);
                $obj = new dbclass($db['jzeva']);
                $product_id_str = implode("','", $product_id_arr);
                $sql = "SELECT pcode, pname, ptype as category, twt as totalwt, mtype as metaltype, cvw as costinvoucher, cwv as costnovchr FROM tbl_product_master WHERE pcode in ('" . $product_id_str . "')";
                $res = $obj->firequery($sql);
                if ($res) {
                    while ($row = $obj->bringdata($res)) {
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
        echo json_encode($data);
        break;    //to count the number products and their quantity
    case 'deleteitem':
        if (empty($cart_id) || empty($pcode)) {
            $result['error'] = 1;
            $result['msg'] = 'Invalid Parameters';
            echo json_encode($result);
            exit;
        }
        $qry = "UPDATE shopcart
                SET status=2, udt = now()  
                WHERE scid=\"" . $cart_id . "\" 
                AND pcode=\"" . $pcode . "\"
                AND status = 1";
        $ret = $obj->firequery($qry);
        if ($ret) {
            $result['error'] = 0;
            $result['msg'] = 'Data deleted';
        } else {
            $result['error'] = 1;
            $result['msg'] = 'Error deleting data';
        }
        echo json_encode($result);
        break; //for making product status in cart inactive
    case 'clearcart':
        if (empty($cart_id)) {
            $result['error'] = 1;
            $result['msg'] = 'Invalid Parameters';
            echo json_encode($result);
            exit;
        }
        $qry = "UPDATE shopcart 
                SET status=2, udt = now()  
                WHERE scid=\"" . $cart_id . "\" 
                AND status = 1";
        $ret = $obj->firequery($qry);
        if ($ret) {
            $result['error'] = 0;
            $result['msg'] = 'Data deleted';
        } else {
            $result['error'] = 1;
            $result['msg'] = 'Error clearing cart';
        }
        echo json_encode($result);
        break; // change whole cart status to disable it  
}
exit;
function generateCartID() {
    $cart_Id = "JZEVA";
    $alpha_array = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
    $numbers_array = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
    $tmp = "";

    for ($i = 0; $i < 8; $i++) {
        if ((strlen($tmp) % 2) == 0) {
            $tmp .= $alpha_array[array_rand($alpha_array)];
        } else {
            $tmp .= $numbers_array[array_rand($numbers_array)];
        }
    }
    $cart_Id = $tmp;

    return $cart_Id;
}
?>