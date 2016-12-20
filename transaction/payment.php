<?php
include '../config.php';

    $ordid=$_GET['ordid'];

    global $comm;
    $url = APIDOMAIN . "index.php?action=getOrderDetailsByOrdIds&orderid=" . $ordid; 
    $res = $comm->executeCurl($url);
    
    if($res['error']['err_code'] ==0)
    {
      $oid=$res['result'][0]['oid'];
      $price=$res['totalprice'];
    }
?>
<html>
  <body>
    <form method="post" name="redirect" action="ccavRequestHandler.php" >
      <input type="hidden" name="merchant_id" value="87218" />
      <input type="hidden" name="order_id" value="<?php echo $oid ?>" />
      <input type="hidden" name="amount" value="<?php echo $price ?>" />
      <input type="hidden" name="currency" value="INR" />
      <input type="hidden" name="redirect_url" value="<?php echo DOMAIN ?>index.php?action=checkoutAfter&ordid=<?php echo $oid ?>" />
      <input type="hidden" name="cancel_url" value="<?php echo DOMAIN ?>index.php?action=confirmpymnt"/>
      <input type="hidden" name="language" value="EN"/>
       
    </form>
    <script language='javascript'>document.redirect.submit();</script>
  </body> 
</html>