<?php include_once (dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/initialize.php'); ?>
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
<?php include_once (ebbay."/ebcart.php"); ?>
<?php
/* Initialize valitation */
$error = 0;
$bay_bkash_trxid_error = "";
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>
<?php
if (isset($_REQUEST['bay_submit_bkash_trxid']))
{
extract($_REQUEST);

/* bkash_trxid */
if (empty($_REQUEST["bay_bkash_trxid"]))
{
$bay_bkash_trxid_error = "<b class='text-warning'>bKash Tranjaction ID Required</b>";
$error =1;
} 

elseif (! preg_match("/^([A-Za-z0-9]+)$/",$bay_bkash_trxid))
{
$bay_bkash_trxid_error = "<b class='text-warning'>bKash Tranjaction ID?</b>";
$error =1;
}
else 
{
$bay_bkash_trxid = $sanitization -> test_input($_POST["bay_bkash_trxid"]);
}
/* Submition form */
if($error == 0)
{
if(isset($_POST["bay_submit_bkash_trxid"])){
$bkash = new ebapps\bay\ebcart();
$bkash -> bay_bkash_payment_gross_crm($_POST['bKashSln']);
/* Default session */
$_SESSION['cart'] = array();
$_SESSION['total_items'] = intval(0);
$_SESSION['total_price'] = 0.00;
/*** ***/
$_SESSION['total_tax'] = 0.00;
$_SESSION['total_handling'] = 0.00;
$_SESSION['total_shipment'] = 0.00;
$_SESSION['total_payment'] = $_SESSION['total_price'] + $_SESSION['total_tax'] + $_SESSION['total_shipment']+ $_SESSION['total_handling'];
}
?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>

</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<div class='well'>
<article>
<?php echo "<b>Thanks for purchases, we shall confirm your payment and then process for shipment. Please wait.</b>"; ?>
</article>
</div>
<?php
$emtyCart ="<div class='well'>";
$emtyCart .="<b>Your cart is empty.....</b>";
$emtyCart .="<br />";
$emtyCart .="<a href='".outBayLink."/product/'><button type='button' class='button submit' title='Shop'><i class='fa fa-cart-plus fa-lg' aria-hidden='true'></i> <b>Shop</b></button></a>";
$emtyCart .="</div>";
echo $emtyCart;
?>
</div>
<div class='col-xs-12 col-md-3 sidebar-offcanvas'>
<?php include_once ("bay-my-account.php"); ?>
</div>
</div>
</div>
<?php
}
}
?>
<?php if($_SESSION['cart'])
{
?>
<!-- bKash -->
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>

</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<div class="well">
<h2 title='bKash Payment'>bKash Payment</h2>
</div>
<div class='well'>
<article>
<ol>
<li>Go to your bKash Mobile Menu by dialing <strong>*247#</strong></li>
<li>Choose <strong>Payment</strong></li>
<li>Enter the Merchant bKash Account Number you want to pay to: <strong><?php $merchant = new ebapps\bay\ebcart(); $merchant -> paymentOptionBkashManualExits(); if($merchant -> eBData >= 1) { foreach($merchant -> eBData as $val){ extract($val); echo $payment_gateways_username; }} ?></strong></li>
<li>Enter the amount you want to pay: <strong><?php echo secondaryCurrency; ?> <?php echo number_format($_SESSION['total_payment'] * convertSecondary,0,'.',''); ?></strong></li>
<li>Enter a reference* against your payment (you can mention the purpose of the transaction in one word. e.g. Bill)</li>
<li>Enter the Counter Number : <strong><?php /* Quintity */ echo $_SESSION['total_items']; ?></strong></li>
<li>Now enter your bKash Mobile Menu PIN to confirm</li>
</ol>
</article>
</div>
<div class='well'>
<article>
<div>After Successful Transaction you will receive SMS</div>
<form method="post">
<fieldset class='group-select'>
<?php $i=1; foreach($_SESSION['cart'] as $id => $qty): $product = $this-> product($id); ?>
<!-- Items 2ND Step Process -->
<input type="hidden" name="bKashSln" value="<?php echo $i; ?>" />
<input type='hidden' name='item_name_<?php echo $i; ?>' value='<?php echo $product['s_og_image_title']; ?>' />
<input type="hidden" name="item_number_<?php echo $i; ?>" value="<?php echo  $product ["bay_showroom_approved_items_id"]; ?>" />
<input type="hidden" name="quantity_<?php echo $i; ?>" value="<?php echo $qty; ?>" />
<input type="hidden" name="amount_<?php echo $i; ?>" value="<?php $discountprice = number_format($product["discountprice"],2,'.','')* $qty; echo number_format($discountprice,2,'.',''); ?>" />
<input type='hidden' name='handling_<?php echo $i; ?>' value='<?php $item_handling = new ebapps\bay\ebcart(); $item_handling = $item_handling->item_handling_paypal($id)*$qty; echo floatval(number_format($item_handling,2,'.','')); ?>'>
<input type="hidden" name="tax_<?php echo $i; ?>" value="<?php $item_tax = new ebapps\bay\ebcart(); $item_tax = $item_tax->total_tax_paypal($id)*$qty; echo floatval(number_format($item_tax,2,'.','')); ?>" />
<input type='hidden' name='shipping_<?php echo $i; ?>' value='<?php $item_shipment_price = new ebapps\bay\ebcart(); $item_shipment_price = $item_shipment_price->select_item_dhl_price($id); echo floatval(number_format($item_shipment_price,2,'.','')); ?>'>
<input type="hidden" name="username_merchant_<?php echo $i; ?>" value="<?php echo $product ["username_merchant_ai"]; ?>" />

<?php $i++; endforeach; ?>
<?php echo "<b>$bay_bkash_trxid_error</b>"; ?>
<li>Enter The bKash Transaction ID:</li>
<li><input type="text" name="bay_bkash_trxid" required autofocus /> </li>
<li><button type='submit' name='bay_submit_bkash_trxid' class='button submit' title='Confirm'><b>
Confirm <i class='fa fa-university' aria-hidden='true'></i></b></button></li>
</fieldset>
</form>
</article>
</div>
</div>
</div>
</div>
<!-- bKash -->
<?php
}
?>
<?php include_once (eblayout."/a-common-footer.php"); ?>