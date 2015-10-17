<?php 
include APICLUDE.'common/db.class.php';

   class orders extends DB
{
       function __construct($db) 
       {
           parent::DB($db);
       }
       
//  said= shipping address id, baid =billing address id 
       public function addOrd($params)
       {
           $dt=  json_decode($params['dt'],1);
           $detls  = $dt['result'];
           $proErr = $dt['error'];
           if($proErr['errCode']== 0)
           {
               $osql="INSERT
                      INTO 
                                     tbl_order_master
                                    (user_id,
                                     cart_id,
                                     shipping_address_id,
                                     bill_address_id,
                                     date_time,
                                     order_status,
                                     active_flag)
                      VALUES
                                  (".$detls['uid'].",
                                   ".$detls['cid'].",
                                   ".$detls['said'].",
                                   ".$detls['baid'].",
                                     now(),
                                     1,
                                     1)";
               $ores=$this->query($osql);
               if($ores)
               {
                   $arr="Order table has been updated";
                   $err=array('Code'=>0,'Msg'=>'Insert Operation is completed');
               }
               else
               {
                   $arr=array();
                   $err=array('Code'=>1,'Msg'=>'Insert Operation error');
               }
           }
           else
           {
               $arr=array();
               $err=array('Code'=>1,'Msg'=>'Error in obtaining data');
           }
           $result=array('results'=>$arr,'error'=>$err);
           return $result;
        }
       
       public function ordById($params)
       {
            $sql ="SELECT 
                                    user_id,
                                    cart_id,
                                    shipping_address_id,
                                    bill_address_id,
                                    transaction_id,
                                    order_status,
                                    active_flag,
                                    update_time,
                                    date_time
                   FROM 
                                    tbl_order_master 
                   WHERE 
                                    transaction_id=\"".$params['tid']."\" 
                   AND 
                                    active_flag=1 
                   ORDER BY 
                                    date_time DESC";
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
                while($row = $this->fetchData($res))
                {
                    $arr[] = $row;
                    $err= array('code' => 0, 'msg' => 'Data Fetched Successfully');
                }
            }
            else
            {
                $arr = array();
                $err= array('code' => 0, 'msg' => 'Data Fetched Successfully');
            }
            $result = array('results'=>$arr,'error'=>$err);
            return $result;
       }
       
       public function actOrdList($params)
       {
            $sql = "SELECT
                                    user_id,
                                    cart_id,
                                    shipping_address_id,
                                    bill_address_id,
                                    transaction_id,
                                    order_status,
                                    active_flag,
                                    update_time,
                                    date_time
                    FROM 
                                    tbl_order_master 
                    WHERE 
                                    user_id=".$params['uid']." 
                    AND 
                                    order_status=1 
                    ORDER BY 
                                    order_id";               
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
                $arr =array();
                $err= array('code'=>1,'msg'=>'error in fetching data');
            }
            $result = array('results'=>$arr,'error'=>$err);
            return $result;
       }

# tid = transaction id      paytype=payment by cash,netbank or card       
# pmode=credit,debit,visa,master,mastero      oid=order id  
# cuse= card bank name used     cur=currency in 
# des= description   amt = amount price   
       public function addtrans($params)
       {
           $dt=  json_decode($params['dt'],1);
           $detls=$dt['result'];
           $proErr = $dt['error'];
           if($proErr['errCode']== 0)
           {
               $isql="INSERT 
                      INTO 
                                            tbl_transaction
                                           (transaction_id,
                                            payment_type,
                                            payment_mode,
                                            card_use,
                                            payment_date,
                                            currency,
                                            date_time,
                                            transaction_status,
                                            transaction_desc,
                                            amount)
                      VALUES
                                        ('".$detls['tid']."',
                                         '".$detls['ptyp']."',
                                         '".$detls['pmode']."',
                                         '".$detls['cuse']."',
                                            now(),
                                         '".$detls['cur']."',
                                            now(),
                                            1,
                                         '".$detls['des']."',
                                          ".$detls['amt'].")";

               $ires=$this->query($isql);
               if($ires)
               {
                   $osql="UPDATE
                                            tbl_order_master 
                          SET 
                                            transaction_id='".$detls['tid']."' 
                          WHERE 
                                            order_id=".$detls['oid']." 
                          AND 
                                            user_id=".$detls['uid'];
                   $ores=$this->query($osql);
                   if($ores)
                   {
                       $arr="Payment is done";
                       $err=array('Code'=>0,'Msg'=>'Transaction is complete');
                   }
                   else
                   {
                       $arr=array();
                       $err=array('Code'=>1,'Msg'=>'Invalid order id or userid');
                   }
               }
               else
               {
                   $arr=array();
                   $err=array('Code'=>1,'Msg'=>'Transaction is not done');
               }
           }
           else
           {
               $arr=array();
               $err=array('Code'=>1,'Msg'=>'Error in retreiving data');
           }
           $result=array('results'=>$arr,'error'=>$err);
           return $result;
        }

       public function viewtrans($params)
       {
        $isql="SELECT
                                transaction_id,
                                payment_type,
                                payment_mode,
                                card_use,
                                payment_date,
                                currency,
                                date_time,
                                transaction_status,
                                transaction_desc,
                                amount
               FROM 
                                tbl_transaction_master
               WHERE 
                                transaction_id=".$params['tid'];
            $page   = ($params['page'] ? $params['page'] : 1);
            $limit  = ($params['limit'] ? $params['limit'] : 15);
        if (!empty($page))
        {
            $start = ($page * $limit) - $limit;
            $isql.=" LIMIT " . $start . ",$limit";
        }
        
        $ires=$this->query($isql);
        $cntres=$this->numRows($ires);
        if($cntres>0)
        {
            while($row=$this->fetchData($ores));
            {
               $arr[]=$row;
            }
            $err=array('Code'=>0,'Msg'=>'Transaction Details fetched');
        }
        else
        {
           $arr=array();
           $err=array('Code'=>0,'Msg'=>'No records found');
        }
   }
       
}        
?>