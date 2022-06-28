<?php include_once (dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/initialize.php'); ?>
<?php
$_SESSION['cart'] = array();
$_SESSION['total_items'] = intval(0);
$_SESSION['total_price'] = 0.00;
$_SESSION['total_payment'] = 0.00;
?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-index-follow.php'); ?>
<?php include_once (ebproduct.'/views/shop/seo.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts-below-body-facebook.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts.php'); ?>
<?php include_once (eblayout.'/a-common-page-id-start.php'); ?>
<?php include_once (eblogin."/session.inc.php"); ?>
<?php include_once (eblayout.'/a-common-header.php'); ?>
<nav>
  <div class='container'>
    <div>
      <?php include_once (eblayout.'/a-common-navebar.php'); ?>
      <?php include_once (eblayout.'/a-common-navebar-index-bay.php'); ?>
    </div>
  </div>
</nav>
<?php include_once (eblayout.'/a-common-page-id-end.php'); ?>
<?php include_once (ebaccess."/access_permission_online_minimum.php"); ?>
<?php include_once (ebbay.'/ebcart.php'); ?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>

</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<?php
$merchant = new ebapps\bay\ebcart(); 
$merchant -> paymentOptionSimplifyExits(); if($merchant -> eBData >= 1) { foreach($merchant -> eBData as $val)
{ 
extract($val);
//
$publicApiKey = $payment_gateways_public_key;
$privateApiKey = $payment_gateways_privet_key; 
require("simplifyTokenLib/Simplify.php");
//
$amount = intval(number_format($_SESSION['total_payment'],2,'',''));
$reference = $_SESSION['order_tracking_unique_id'];
$paymentId = $_REQUEST['paymentId'];
$paymentDate = $_REQUEST['paymentDate'];
$paymentStatus = $_REQUEST['paymentStatus'];
$privateKey = $privateApiKey;
$signature = $_REQUEST['signature'];
$recreatedSignature = strtoupper(md5($amount.$reference.$paymentId.$paymentDate.$paymentStatus.$privateKey));
///
//if(isset($_REQUEST['paymentStatus']) == 'APPROVED' and $recreatedSignature == $signature)
if(isset($_REQUEST['paymentStatus']) == 'APPROVED')
{
//
$symplifycrm = new ebapps\bay\ebcart();
$symplifycrm-> bay_simplify_payment_crm();
try {
Simplify::$publicKey = $publicApiKey;
Simplify::$privateKey = $privateApiKey;
// make a payment with a card token
$payment = Simplify_Payment::createPayment(array(
'amount' => $amount,
'currency' => primaryCurrency
));
}
catch (Exception $e){
//echo $e;
}
}
}
} 
?>
</div>
</div>
</div>
<?php include_once (eblayout."/a-common-footer.php"); ?>