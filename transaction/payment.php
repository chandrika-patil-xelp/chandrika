<?php
include '../config.php';

    $ordid=$_GET['ordid'];
    $shipid=$_GET['shipid'];
    
    global $comm;
    $url = APIDOMAIN . "index.php?action=getcartdetail&cart_id=" . $ordid; 
    $res = $comm->executeCurl($url);
 
    if($res['error']['err_code'] ==0)
    { 
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
      <input type="hidden" name="amount" value="1" />
      <input type="hidden" name="currency" value="INR" />
      <input type="hidden" name="redirect_url" value="<?php echo DOMAIN ?>transaction/ccavResponseHandler.php" />
      <input type="hidden" name="cancel_url" value="<?php echo DOMAIN ?>transaction/landngpage.php?ordid=<?php echo $ordid ?>&shipid=<?php echo $shipid ?>"/>
      <input type="hidden" name="language" value="EN"/>
      <input type="hidden" name="billing_country" value="India"/>
      <input type="hidden" name="billing_tel" value="<?php echo $biltel ?>"/>
      <input type="hidden" name="billing_email" value="<?php echo $bilmail ?>"/>
      
    </form>
    <script language='javascript'>document.redirect.submit();</script>
  </body> 
</html>