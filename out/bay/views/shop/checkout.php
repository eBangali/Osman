<?php include_once (dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/initialize.php'); ?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-index-follow.php'); ?>
<?php include_once (ebproduct.'/views/shop/seo.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts-below-body-facebook.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts.php'); ?>
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
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>

</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'> 
<?php if($_SESSION['cart'])
{
?>
<table class='table table-bordered'>
<thead>
<tr>
<th>Remove</th>
<th>Item</th>
<th>Size</th>
<th>Price</th>
<th>Qty</th>
<th><?php echo primaryCurrency; ?></th>
</tr>
</thead>
<tbody>
<?php foreach($_SESSION['cart'] as $id => $qty): $product = $this-> product($id); ?>
<tr align='right'>
<td>
<?php
$eBdelet ="<form method='post' action='".outBayLink."/product/checkout/'>";
$eBdelet .="<div class='custom pull-left'>";
$eBdelet .="<input type='hidden' name='id' value='$id' />";
$eBdelet .="<input type='hidden' name='qtnMore' value='0'>";
$eBdelet .="<button class='increase items-count' title='Remove This Item' type='submit'><i class='fa fa-trash fa-lg'>&nbsp;</i></button>";
$eBdelet .="</div>";
$eBdelet .="</form>";
echo $eBdelet;
?>        
</td>
<td><a href='<?php echo outBayLink; ?>/product/item-details-grid/<?php echo $product ['bay_showroom_approved_items_id']; ?>/'><?php if(hypertextWithOrWithoutWww.$product['s_og_small_image_url']){ ?><img width="100%" src="<?php echo hypertextWithOrWithoutWww.$product['s_og_small_image_url']; ?>" alt="<?php echo $product['s_og_image_title']; ?>" title="<?php echo $product['s_og_image_title']; ?>" /><?php } ?></a></td> 
<td><?php echo $product['s_size']; ?></td>
<td><?php echo floatval(number_format($product['discountprice'],2,'.','')); ?></td>
<td>
<?php
$eBitem ="<form class='form-inline' method='post' action='".outBayLink."/product/checkout/'>";
$eBitem .="<button name='reducedItem' class='eBCartReduceItem' type='submit'><i class='fa fa-minus'>&nbsp;</i></button>";
$eBitem .="<input type='hidden' name='id' value='$id' />";
$eBitem .="<input type='text' class='eBCartQtn' title='Qty' name='qtnMore' value='$qty'>";
$eBitem .="<button name='increaseItem' class='eBCartIncreaseItem' type='submit'><i class='fa fa-plus'>&nbsp;</i></button>";
$eBitem .="</form>";
echo $eBitem;
?>
</td>
<td><?php $item_price = floatval(number_format($product['discountprice'],2,'.',''))*$qty; echo floatval(number_format($item_price,2,'.','')); ?></td>
</tr>
<?php endforeach; ?>
<tr align='right'>
<td colspan='5'><b>Subtotal (Refundable)</b>:</td>
<td><?php echo  number_format($_SESSION['total_price'],2,'.',''); ?></td>
</tr>
<tr align='right'>
<td colspan='5'>VAT/GST/TAX:</td>
<td><?php echo floatval(number_format($_SESSION['total_tax'],2,'.','')); ?></td>
</tr>
<tr align='right'>
<td colspan='5'>
<?php
$countryPreTo = new ebapps\bay\ebcart(); 
$countryPreTo->select_shipping_address_from_bay_dhl_country_name();
if($countryPreTo->eBData)
{
foreach($countryPreTo->eBData as $vaLcountryPreTo): extract($vaLcountryPreTo);
$countryToPre = $country_name;
endforeach;
}
$editCountryDeleveryTo ="<form method='post' action='".outBayLink."/product/checkout/'>";
$editCountryDeleveryTo .="<div class='input-group'>";
/* 
$editCountryDeleveryTo .="<span class='input-group-addon' id='sizing-addon2'><b>Delivery Charge</b></span>";
*/
$editCountryDeleveryTo .="<select class='form-control qtn' name='receiver_country'>";
if(isset($countryToPre))
{
$editCountryDeleveryTo .="<option selected value='$bay_dhl_country_zone_id'>".$countryToPre."</option>";
}
$objCountry = new ebapps\bay\ebcart();
$objCountry->select_shipping_address_from_bay_dhl_country_id();
if($objCountry->eBData)
{
foreach($objCountry->eBData as $val)
{
extract($val);
$editCountryDeleveryTo .="<option value='$bay_dhl_country_zone_id'>".$country_name."</option>";
}
}
$editCountryDeleveryTo .="</select>";
$editCountryDeleveryTo .="</div>";
$editCountryDeleveryTo .="<button type='submit' class='button submit' title='Delivery Charge'> <b>Delivery Charge</b></button>";
$editCountryDeleveryTo .="</form>";
echo $editCountryDeleveryTo;
?>
</td>
<td><?php echo  number_format($_SESSION['total_shipment'],2,'.',''); ?></td>
</tr>
<tr align='right'>
<td colspan='5'>Handling Charges:</td>
<td><?php echo number_format($_SESSION['total_handling'],2,'.',''); ?></td>
</tr>
<tr align='right'>
<td colspan='5'><b>Grand Total:</b></td>
<td><b><?php echo  number_format($_SESSION['total_payment'],2,'.',''); ?></b></td>
</tr>
</tbody>
</table>
<!--Checkout Submit Form -->
<div class='panel' align='right'>
<p align='right'><a href='<?php echo outBayLink; ?>/product/'><button type='button' class='button submit' title='Shop'><i class='fa fa-cart-plus fa-lg' aria-hidden='true'></i>
<b>Shop</b></button></a></p>
<form action='<?php echo outBayLink; ?>/product/checkout-process/' method='post'>
<button type='submit' class='button submit' title='Checkout'><i class='fa fa-shopping-cart fa-lg' aria-hidden='true'></i> <b>Checkout</b></button>
</fieldset>
</form>
</div>
<!--Checkout Submit Form -->
<?php
}
else
{
$emtyCart ="<div class='well'>";
$emtyCart .="<b>Your cart is empty.....</b>";
$emtyCart .="<br />";
$emtyCart .="<a href='".outBayLink."/product/'><button type='button' class='button submit' title='Shop'><i class='fa fa-cart-plus fa-lg' aria-hidden='true'></i> <b>Shop</b></button></a>";
$emtyCart .="</div>";
echo $emtyCart;
}
?>
</div>
<div class='col-xs-12 col-md-3 sidebar-offcanvas'>

</div>
</div>
</div>
<?php include_once (eblayout."/a-common-footer.php"); ?>