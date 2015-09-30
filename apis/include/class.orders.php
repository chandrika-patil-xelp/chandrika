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
               $osql="INSERT INTO tbl_order_master(user_id,cart_id,shipAddId,billAddId,cdt,udt,dflag) VALUES(".$detls['uid'].",".$detls['cid'].",".$dtls['said'].",".$detls['baid'].",now(),now(),1)";
               $ores=$this->query($osql);
               if($ores)
               {
                   $arr="Order table has been updated";
                   $err=array('Code'=>0,'Msg'=>'Insert Operation is completed');
               }
               else
               {
                   $arr="Order is not inserted";
                   $err=array('Code'=>0,'Msg'=>'Insert Operation error');
               }
           }
           else
           {
               $arr="Data not sent in proper manner";
               $err=array('Code'=>0,'Msg'=>'Error in obtaining data');
           }
           $result=array('results'=>$arr,'error'=>$err);
           return $result;
        }
       
       public function ordById($params)
       {
            $sql ="SELECT * from tbl_order_master WHERE transid='".$params['tid']."' and dflag=1 ORDER BY cdt DESC";
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
            $sql = "SELECT * from tbl_order_master WHERE user_id=".$params['uid']." and ordstatus=1 ORDER BY oid";               
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
               $isql="INSERT INTO tbl_trans_master(transid,paytype,paymode,card_use,paydate,curr,cdt,tstatus,tdesc,amt)
                      VALUES('".$detls['tid']."','".$detls['ptyp']."','".$detls['pmode']."','".$detls['cuse']."',now(),'".$detls['cur']."',now(),1,'".$detls['des']."',".$detls['amt'].")";

               $ires=$this->query($isql);
               if(ires)
               {
                   $osql="UPDATE tbl_order_master set transid='".$detls['tid']."' WHERE oid=".$detls['oid']." and user_id=".$detls['uid'];
                   $ores=$this->query($osql);
                   if($ores)
                   {
                       $arr="Payment is done";
                       $err=array('Code'=>0,'Msg'=>'Transaction is complete');
                   }
                   else
                   {
                       $arr="Order table record is not found";
                       $err=array('Code'=>0,'Msg'=>'Invalid order id or userid');
                   }
               }
               else
               {
                   $arr="Error in transaction";
                   $err=array('Code'=>0,'Msg'=>'Transaction is not done');
               }
           }
           else
           {
               $arr="Data is not obtained in proper form";
               $err=array('Code'=>0,'Msg'=>'Error in retreiving data');
           }
           $result=array('results'=>$arr,'error'=>$err);
           return $result;
        }

       public function viewtrans($params)
       {
        $isql="SELECT transid,paytype,paymode,card_use,paydate,curr,cdt,tstatus,tdesc,amt from tbl_trans_master where transid=".$params['tid'];
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
           $arr="Error in fetching data";
           $err=array('Code'=>0,'Msg'=>'No records found');
        }
   }
       
}        
?>