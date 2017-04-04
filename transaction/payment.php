<?php
include '../config.php';

    $ord=$_GET['ordid'];
    $shipid=$_GET['shipid'];
 
    global $comm;
    $url = APIDOMAIN . "index.php?action=getcartdetail&cart_id=" . $ord; 
    $res = $comm->executeCurl($url);

    if($res['error']['err_code'] ==0)
    {
      $ordid=$res['result'][0]['cart_id'];
       $price=$res['totalprice']; 
    }
    
    $billngurl=APIDOMAIN . "index.php?action=getshipdatabyshipid&shpid=".$shipid;
    $shpres=$comm->executeCurl($billngurl);
 
    $biltel=$shpres['results']['mobile'];
    $bilmail=$shpres['results']['email'];  
?>
<html>
  <body>
    <form method="post" name="redirect" action="ccavRequestHandler.php" >
      <input type="hidden" name="merchant_id" value="87218" />
      <input type="hidden" name="order_id" value="<?php echo $ordid ?>" />
      <input type="hidden" name="amount" value="<?php echo $price ?>" />
      <input type="hidden" name="currency" value="INR" />
      <input type="hidden" name="redirect_url" value="<?php echo DOMAIN ?>transaction/ccavResponseHandler.php" />
      <input type="hidden" name="cancel_url" value="<?php echo DOMAIN ?>transaction/Failure/<?php echo $ordid ?>"/>
      <input type="hidden" name="language" value="EN"/>
      <input type="hidden" name="billing_country" value="India"/>
      <input type="hidden" name="billing_tel" value="<?php echo $biltel ?>"/>
      <input type="hidden" name="billing_email" value="<?php echo $bilmail ?>"/>
      
    </form>
    <script language='javascript'>document.redirect.submit();</script>
  </body> 
</html>