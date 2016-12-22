<?php
include '../config.php';

    $ordid=$_GET['ordid'];

    global $comm;
    $url = APIDOMAIN . "index.php?action=getcartdetail&cart_id=" . $ordid; 
    $res = $comm->executeCurl($url);
 
    if($res['error']['err_code'] ==0)
    { 
      $price=$res['totalprice'];
    }
?>
<html>
  <body>
    <form method="post" name="redirect" action="ccavRequestHandler.php" >
      <input type="hidden" name="merchant_id" value="87218" />
      <input type="hidden" name="order_id" value="<?php echo $ordid ?>" />
      <input type="hidden" name="amount" value="1" />
      <input type="hidden" name="currency" value="INR" />
      <input type="hidden" name="redirect_url" value="<?php echo DOMAIN ?>transaction/ccavResponseHandler.php" />
      <input type="hidden" name="cancel_url" value="<?php echo DOMAIN ?>index.php?action=landing_page"/>
      <input type="hidden" name="language" value="EN"/>
       
    </form>
    <script language='javascript'>document.redirect.submit();</script>
  </body> 
</html>