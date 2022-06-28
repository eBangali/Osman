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
<div class='well'>
<div class='panel' align='right'>
<form action='<?php echo outBayLink; ?>/product/paymentgetwaybkashbanualnumber/' method='post'>
<fieldset>
<?php $i=1; foreach($_SESSION['cart'] as $id => $qty): $product = $this-> product($id); ?>
<!-- Items 2ND Step Process -->
<input type='hidden' name='sln' value='<?php echo $i; ?>' />
<input type='hidden' name='tracking_unique_product_ai_<?php echo $i; ?>' value='<?php echo $product ['tracking_unique_product_ai']; ?>' />
<input type='hidden' name='item_name_<?php echo $i; ?>' value='<?php echo $product['s_og_image_title']; ?>' />
<input type='hidden' name='item_number_<?php echo $i; ?>' value='<?php echo  $product ['bay_showroom_approved_items_id']; ?>' />
<input type='hidden' name='quantity_<?php echo $i; ?>' value='<?php echo $qty; ?>' />
<input type='hidden' name='size_<?php echo $i; ?>' value='<?php echo $product['s_size']; ?>' />
<input type='hidden' name='item_total_price_<?php echo $i; ?>' value='<?php $discountprice = number_format( primaryTosecondary * $product['discountprice'],2,'.','')* $qty; echo number_format($discountprice,0,'.',''); ?>' />
<input type='hidden' name='handling_<?php echo $i; ?>' value='<?php $item_handling = new ebapps\bay\ebcart(); $item_handling = $item_handling->item_handling_paypal($id)*$qty; echo floatval(number_format($item_handling,0,'.','')); ?>'>
<input type='hidden' name='tax_<?php echo $i; ?>' value='<?php $item_tax = new ebapps\bay\ebcart(); $item_tax = $item_tax->total_tax_paypal($id)*$qty; echo floatval(number_format($item_tax,0,'.','')); ?>' />
<input type='hidden' name='shipping_<?php echo $i; ?>' value='<?php $item_shipment_price = new ebapps\bay\ebcart(); $item_shipment_price = $item_shipment_price->select_item_dhl_price($id); echo floatval(number_format($item_shipment_price,0,'.','')); ?>'>
<input type='hidden' name='username_merchant_<?php echo $i; ?>' value='<?php echo $product ['username_merchant_ai']; ?>' />
<?php $i++; endforeach; ?>
<button type='submit' name='PayWithBkash' class='button submit' title='bKash Pay'><b>bKash Pay <i class='fa fa-university' aria-hidden='true'></i></b></button>
</fieldset>
</form>
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