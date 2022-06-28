<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php
include_once(ebbd.'/dbconfig.php');
$adMin = new ebapps\dbconnection\dbconfig();
if(isset($adMin->eBAdminUserIsSet))
{
?>
<?php include_once (eblogin.'/session.inc.php'); ?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-noindex.php'); ?>
<?php include_once (eblayout.'/a-common-header-title-one.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts-text-editor.php'); ?>
<?php include_once (eblayout.'/a-common-page-id-start.php'); ?>
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
<?php include_once (ebaccess.'/access_permission_merchant_minimum.php'); ?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>

</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<div class="well">
<h2 title='Make Refund'>Make Refund</h2>
</div>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>
<?php
/* Initialize valitation */
$error = 0;
$finalRefundAmount_error = "*";
$transactionID_error = "*";
$returnsExtraComment_error = "*";
?>
<?php
if (isset($_REQUEST['refundPaymentDone']))
{
extract($_REQUEST);
/* finalRefundAmount */
if (empty($_REQUEST["finalRefundAmount"]))
{
$finalRefundAmount_error = "<b class='text-warning'>Amount required</b>";
} 
/* valitation finalRefundAmount  */
elseif (! preg_match("/^([0-9]{1,6}[.]{1,1}[0-9]{1,2})$/",$finalRefundAmount))
{
$finalRefundAmount_error = "<b class='text-warning'>Price nubmers and dot allowed maximum 999999.99</b>";
}
else 
{
$finalRefundAmount = $sanitization -> test_input($_POST["finalRefundAmount"]);
}

/* transactionID */
if (empty($_REQUEST["transactionID"]))
{
$transactionID_error = "<b class='text-warning'>Message required</b>";
$error =1;
}
/* valitation transactionID  */
elseif (! preg_match("/^([A-Za-z0-9\-\.\,\?\ ]+){3,600}$/",$transactionID))
{
$transactionID_error = "<b class='text-warning'>Use A-Za-z0-9.,? mini 3 max 600.</b>";
$error =1;
}
else
{
$transactionID = $sanitization -> test_input($_POST["transactionID"]);
}

/* returnsExtraComment */
if (empty($_REQUEST["returnsExtraComment"]))
{
$returnsExtraComment_error = "<b class='text-warning'>Message required</b>";
}
/* valitation returnsExtraComment  */
elseif (! preg_match("/^([A-Za-z0-9\-\_\.\, ]+){3,128}$/",$returnsExtraComment))
{
$returnsExtraComment_error = "<b class='text-warning'>Use A-Za-z0-9.,? mini 3 max 128</b>";
}
else
{
$returnsExtraComment = $sanitization -> test_input($_POST["returnsExtraComment"]);
}

/* Submition form */
if($error ==0)
{
extract($_REQUEST);
$user = new ebapps\bay\ebcart();
$user->refundPaymentDone($username_buyer_rrg, $username_merchant_rrg, $tracking_unique_sales_order_id, $bay_product_id_in_returns_refunds_crm, $payment_method, $payment_currency, $payment_to, $finalRefundAmount, $transactionID, $returnsExtraComment);
}
}
?>
<?php $objRequstRefund = new ebapps\bay\ebcart(); $objRequstRefund -> view_to_refund(); ?>
<?php if($objRequstRefund->eBData){ foreach($objRequstRefund->eBData as $val): extract($val); ?>
<?php
$requestRefund = "<div class='well'>";
$requestRefund .= "<form method='post'>";
$requestRefund .= "<fieldset class='group-select'>";
$requestRefund .= "<fieldset>";
$requestRefund .= "<input type='hidden' name='username_buyer_rrg' value='";
$requestRefund .= $username_buyer_rrg;
$requestRefund .= "' />";
$requestRefund .= "<input type='hidden' name='username_merchant_rrg' value='";
$requestRefund .= $username_merchant_rrg;
$requestRefund .= "' />";
$requestRefund .= "<input type='hidden' name='tracking_unique_sales_order_id' value='";
$requestRefund .= $tracking_unique_sales_order_rrg;
$requestRefund .= "' />";
$requestRefund .= "<input type='hidden' name='bay_product_id_in_returns_refunds_crm' value='";
$requestRefund .= $bay_product_id_in_returns_refunds_crm;
$requestRefund .= "' />";
$requestRefund .= "<input type='hidden' name='payment_method' value='";
$requestRefund .= $payment_method;
$requestRefund .= "' />";
//
$requestRefund .= "<input type='hidden' name='payment_currency' value='";
$requestRefund .= $payment_currency;
$requestRefund .= "' />";
//
$requestRefund .= "Refund Method: $payment_method ";
if($payment_method =='PayPal')
{
$refundToPaypal = new ebapps\bay\ebcart();
$refundToPaypal ->refundPaymentPayPalToId($tracking_unique_sales_order_rrg); 
if($refundToPaypal->eBData){ foreach($refundToPaypal->eBData as $valR): extract($valR);
if(!empty($payer_email_pg))
{
$requestRefund .= "To:  $payer_email_pg ";
$requestRefund .= "<input type='hidden' name='payment_to' value='$payer_email_pg' />";
}
else
{
$requestRefund .= "To:  ";
$requestRefund .= "<input type='hidden' name='payment_to' value='' />";
}
endforeach;
}
}
if($payment_method =='bKash')
{
$refundToBkash = new ebapps\bay\ebcart();
$refundToBkash ->refundPaymentBkashNoTo($username_buyer_rrg); 
if($refundToBkash->eBData){ foreach($refundToBkash->eBData as $valB): extract($valB);
if(!empty($bkashid))
{
$requestRefund .= "To:  $bkashid";
$requestRefund .= "<input type='hidden' name='payment_to' value='$bkashid' />";
}
else
{
$requestRefund .= "To:  ";
$requestRefund .= "<input type='hidden' name='payment_to' value='' />";
}
endforeach;
}
}
$requestRefund .= "Currency:  $payment_currency ";
$requestRefund .= "Amount:  $total_refund_with_shipment_without_texvat ";
$requestRefund .= "<input type='number' class='form-control' name='finalRefundAmount' placeholder='Amount of Refund' required />";
$requestRefund .= "Transaction ID:";
$requestRefund .= "<input type='text' class='form-control' name='transactionID' placeholder='Transaction ID' required />";
$requestRefund .= "Extra Message: ";
$requestRefund .= "<textarea class='form-control' name='returnsExtraComment' required></textarea>";
$requestRefund .= "<div class='buttons-set'><button type='submit' name='refundPaymentDone' title='Submit' class='button submit'><span>Refund Done</span></button></div>";
$requestRefund .= "</fieldset>";
$requestRefund .= "</form>";
$requestRefund .= "</div>";
echo $requestRefund;
endforeach; 
}
?>
</div>
<div class='col-xs-12 col-md-3 sidebar-offcanvas'>
<?php include_once ("bay-my-account.php"); ?>
</div>
</div>
</div>
<?php include_once (eblayout.'/a-common-footer-edit.php'); ?>
<?php
}
else
{
header("Location: ".outLink."/access/admin-register.php");
}
?>
