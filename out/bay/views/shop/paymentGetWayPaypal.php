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
<?php if($_SESSION['cart'])
{
?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>

</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<div class="well">
<div class="panel" align="right">
<!-- PayPal -->
<form action='https://www.paypal.com/cgi-bin/webscr' method='post' target='_top'>
<input type='hidden' name='cmd' value='_cart'>
<input type='hidden' name='upload' value='1'>
<input type='hidden' name='business' value='<?php $merchant = new ebapps\bay\ebcart(); $merchant -> paymentOptionPayPalExist(); if($merchant -> eBData >= 1) { foreach($merchant -> eBData as $val){ extract($val); echo $payment_gateways_username; }} ?>' />
<?php $i=1; foreach($_SESSION['cart'] as $id => $qty): $product = $this-> product($id); ?>
<!-- Items -->
<input type='hidden' name='item_name_<?php echo $i; ?>' value='<?php echo $product['s_og_image_title']; ?>' />
<input type='hidden' name='item_number_<?php echo $i; ?>' value='<?php echo $product ['bay_showroom_approved_items_id']; ?>' />
<input type='hidden' name='quantity_<?php echo $i; ?>' value='<?php echo $qty; ?>' />
<input type='hidden' name='amount_<?php echo $i; ?>' value='<?php echo number_format($product['discountprice'],2,'.',''); ?>' />
<input type='hidden' name='tax_<?php echo $i; ?>' value='<?php $item_tax = new ebapps\bay\ebcart(); $tax = $item_tax->total_tax_paypal($id); echo floatval(number_format($tax,2,'.','')); ?>'>
<input type='hidden' name='handling_<?php echo $i; ?>' value='<?php $item_handling = new ebapps\bay\ebcart(); $handling = $item_handling->item_handling_paypal($id)*$qty; echo floatval(number_format($handling,2,'.','')); ?>'>
<input type='hidden' name='shipping_<?php echo $i; ?>' value='<?php $item_shipment_price = new ebapps\bay\ebcart(); $item_shipment = $item_shipment_price->select_item_dhl_price($id); echo floatval(number_format($item_shipment,2,'.','')); ?>'>
<?php $i++; endforeach; ?>
<input type='hidden' name='currency_code' value='<?php echo primaryCurrency; ?>'>
<input type='hidden' name='userid' value='<?php if(isset($_SESSION['ebusername'])){echo $_SESSION['ebusername'];} ?>'>
<input type='hidden' name='lc' value='US'>
<input type='hidden' name='rm' value='2'>
<input type='hidden' name='return' value='<?php echo hostingAndRoot; ?>/out/bay/product/thankyou/' />
<input type='hidden' name='cancel_return' value='<?php echo hostingAndRoot; ?>/out/bay/product/' />
<button type='submit' name='payPaypal' class='button submit' title='PayPal Pay'><b> PayPal Pay <i class='fa fa-paypal' aria-hidden='true'></i></b></button>
</form>
<!-- PayPal -->
</div>
</div>
</div>
</div>
</div>
<?php
}
else
{
?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>

</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<div class="well">
<?php echo '<b>Your cart is empty.....</b>'; ?>
<br />
<a href='<?php echo outBayLink; ?>/product/'><button type='button' class='button submit' title='Shop'> <b>Shop</b> <i class='fa fa-cart-plus' aria-hidden='true'></i></button></a>
</div>
</div>
</div>
</div>
<?php 
}
?>
<?php include_once (eblayout."/a-common-footer.php"); ?>