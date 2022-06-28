<?php include_once (dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/initialize.php'); ?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<?php include_once (ebproduct.'/views/shop/seo.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts-below-body-facebook.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts.php'); ?>
<?php include_once (eblayout.'/a-common-page-id-start.php'); ?>
<?php include_once (eblogin.'/session.inc.php'); ?>
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
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = '';
$full_name_sa_error = '*';
$address_line_1_sa_error = '*';
$address_line_2_sa_error = '*';
$city_town_sa_error = '*';
$state_province_region_sa_error = '*';
$postal_code_sa_error = '*';
$phone_mobile_number_error = '*';
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>
<?php
if(isset($_REQUEST['shipping_address']))
{
extract($_REQUEST);
/* Form Key*/
if(isset($_REQUEST['form_key']))
{
$form_key = preg_replace('#[^a-zA-Z0-9]#i','',$_POST['form_key']);
if($formKey->read_and_check_formkey($form_key) == true)
{

}
else
{
$formKey_error = "<b class='text-warning'>Sorry the server is currently too busy please try again later.</b>";
$error = 1;
}
}

/* receiver_full_name */
if (empty($_REQUEST['full_name_sa']))
{
$full_name_sa_error = "<b class='text-warning'>Full name required</b>";
$error =1;
} 
/* valitation full_name_sa  */
elseif (! preg_match('/^([A-Za-z0-9\.\,\-\ ]+)$/',$full_name_sa))
{
$full_name_sa_error = "<b class='text-warning'>Full name?</b>";
$error =1;
}
else 
{
$full_name_sa = $sanitization -> test_input($_POST['full_name_sa']);
}
/* address_line_1_sa */
if (empty($_REQUEST['address_line_1_sa']))
{
$address_line_1_sa_error = "<b class='text-warning'>Address required</b>";
$error =1;
}
/* valitation address_line_1_sa  */
elseif (! preg_match('/^([A-Za-z0-9\.\,\-\#\:\ ]{2,250})$/',$address_line_1_sa))
{
$address_line_1_sa_error = "<b class='text-warning'>Address?</b>";
$error =1;
}
else 
{
$address_line_1_sa = $sanitization -> test_input($_POST['address_line_1_sa']);
}

/* address_line_2_sa */
if (empty($_REQUEST['address_line_2_sa']))
{
$address_line_2_sa_error = "<b class='text-warning'>Address required</b>";
}
/* valitation address_line_2_sa  */
elseif (! preg_match('/^([A-Za-z0-9\.\,\-\#\:\ ]{2,250})$/',$address_line_2_sa))
{
$address_line_2_sa_error = "<b class='text-warning'>Address?</b>";
$error =0;
}
else 
{
$address_line_2_sa = $sanitization -> test_input($_POST['address_line_2_sa']);
}

/* city_town_sa */
if (empty($_REQUEST['city_town_sa']))
{
$city_town_sa_error = "<b class='text-warning'>City /Town required</b>";
$error =1;
} 
/* valitation city_town_sa  */
elseif (! preg_match('/^([A-Za-z0-9\.\,\-\#\:\ ]+)$/',$city_town_sa))
{
$city_town_sa_error = "<b class='text-warning'>City/Town letters?</b>";
$error =1;
}
else 
{
$city_town_sa = $sanitization -> test_input($_POST['city_town_sa']);
}
/* state_province_region_sa */
if (empty($_REQUEST['state_province_region_sa']))
{
$state_province_region_sa_error = "<b class='text-warning'>State/Province/Region required</b>";
} 
/* valitation state_province_region_sa  */
elseif (! preg_match('/^([A-Za-z0-9\.\,\-\#\:\ ]+)$/',$state_province_region_sa))
{
$state_province_region_sa_error = "<b class='text-warning'>State/Province/Region?</b>";
$error =1;
}
else 
{
$state_province_region_sa = $sanitization -> test_input($_POST['state_province_region_sa']);
}

/* postal_code_sa */
if (empty($_REQUEST['postal_code_sa']))
{
$postal_code_sa_error = "<b class='text-warning'>Postal code required</b>";
$error =1;
} 
/* valitation postal_code_sa */
elseif (! preg_match('/^([A-Za-z0-9\.\,\-]{1,20})$/',$postal_code_sa))
{
$postal_code_sa_error = "<b class='text-warning'>Postal code?</b>";
$error =1;
}
else 
{
$postal_code_sa = $sanitization -> test_input($_POST['postal_code_sa']);
}

/* phone_mobile_number */
if (empty($_REQUEST['phone_mobile_number']))
{
$phone_mobile_number_error = "<b class='text-warning'>Mobile required</b>";
$error =1;
} 
/* valitation phone_mobile_number  */
elseif (! preg_match('/^([0-9]{5,15})$/',$phone_mobile_number))
{
$phone_mobile_number_error = "<b class='text-warning'>Mobile?</b>";
$error =1;
}
else 
{
$phone_mobile_sa = strval($_POST['phone_mobile_code'].$_POST['phone_mobile_number']);
}

/* Submition form */
if($error ==0)
{
$merchant = new ebapps\bay\ebcart();
extract($_REQUEST);
$merchant->submit_new_shipping_address($full_name_sa, $address_line_1_sa, $address_line_2_sa, $city_town_sa, $state_province_region_sa, $postal_code_sa, $phone_mobile_sa, $country_sa);
}
//
}
?>
<!-- Shipment-Address -->
<?php if($_SESSION['cart'])
{
?>
<?php if(isset($_REQUEST['ContinueCheckout']))
{
extract($_REQUEST);
include_once('paymentGetWayPaypal.php');
include_once (eblayout.'/a-common-footer.php');
exit();
}
/* elseif Start for simplify checkout */
elseif(isset($_REQUEST['ContinuebSimplifyCheckout']))
{
extract($_REQUEST);
include_once('paymentGetWaySimplify.php');
include_once (eblayout.'/a-common-footer.php');
exit();
}
/* elseif Eand for simplify checkout */
/* elseif Start for bKash checkout */
elseif(isset($_REQUEST['ContinuebKashCheckout']))
{
extract($_REQUEST);
include_once('paymentGetWayBkashManual.php');
include_once (eblayout.'/a-common-footer.php');
exit();
}
/* elseif Eand for bKash checkout */
?>
<!--Testing shipment-address -->
<?php
$shipmentprofile = new ebapps\bay\ebcart();
$shipmentprofile -> shipment_exist();
if($shipmentprofile->eBData)
{
?>
<!--Testing shipment-address -->
<?php
$confirmorder = new ebapps\bay\ebcart();
$confirmorder -> confirm_order_exist();
if($confirmorder->eBData)
{
?>

<?php
}
/*#########*/
else
{
?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>

</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<div class='panel' align='right'>
<div class='well'>
<!-- ADD A BUTTON TO CHECK THAT USER HAS VERIFIED EMAIL -->
<!-- ADD A BUTTON TO CHECK THAT USER HAS VERIFIED PHONE -->
<p><strong>By clicking &ldquo;CHECKOUT&ldquo; you are agreeing and consenting to the <a href='<?php echo outPagesLink; ?>/terms-conditions.php' title='Terms and Conditions'>Terms and Conditions</a>.</strong></p>
<!-- Payment Options Starts -->
<form method='post'>
<?php $i=1; ?>
<?php foreach($_SESSION['cart'] as $id => $qty): $product = $this-> product($id); ?>
<!-- Items Process -->
<input type='hidden' name='sln' value='<?php echo $i; ?>' />
<input type='hidden' name='tracking_unique_product_ai_<?php echo $i; ?>' value='<?php echo $product ['tracking_unique_product_ai']; ?>' />
<input type='hidden' name='item_number_<?php echo $i; ?>' value='<?php echo  $product ['bay_showroom_approved_items_id']; ?>' />
<input type='hidden' name='quantity_<?php echo $i; ?>' value='<?php echo $qty; ?>' />
<input type='hidden' name='size_<?php echo $i; ?>' value='<?php echo $product['s_size']; ?>' />
<input type='hidden' name='item_total_price_<?php echo $i; ?>' value='<?php echo number_format( $product['discountprice'],2,'.','')* $qty; ?>' />
<input type='hidden' name='handling_<?php echo $i; ?>' value='<?php $item_handling = new ebapps\bay\ebcart(); $item_handling = $item_handling->item_handling_paypal($id)*$qty; echo floatval(number_format($item_handling,2,'.','')); ?>'>
<input type='hidden' name='tax_<?php echo $i; ?>' value='<?php $item_tax = new ebapps\bay\ebcart(); $item_tax = $item_tax->total_tax_paypal($id)*$qty; echo floatval(number_format($item_tax,2,'.','')); ?>' />
<input type='hidden' name='shipping_<?php echo $i; ?>' value='<?php $item_shipment_price = new ebapps\bay\ebcart(); $item_shipment_price = $item_shipment_price->select_item_dhl_price($id); echo floatval(number_format($item_shipment_price,2,'.','')); ?>'>
<input type='hidden' name='username_merchant_<?php echo $i; ?>' value='<?php echo $product ['username_merchant_ai']; ?>' />
<?php $i++; ?>
<?php endforeach; ?>
<?php
/* Start PayPal */
$paymentOptionPayPal = new ebapps\bay\ebcart();
$paymentOptionPayPal -> paymentOptionPayPalExist();
if($paymentOptionPayPal->eBData)
{
foreach($paymentOptionPayPal->eBData as $valpaymentOptionPayPal)
{
extract($valpaymentOptionPayPal);
{
echo "<button type='submit' name='ContinueCheckout' class='button submit' title='PayPal Checkout'><b>Checkout</b> <i class='fa fa-paypal fa-lg' aria-hidden='true'></i></button><br /><br />";
}
}
}
/* End PayPal */
/* Start Simplify */
$paymentOptionSimplify = new ebapps\bay\ebcart();
$paymentOptionSimplify -> paymentOptionSimplifyExits();
if($paymentOptionSimplify->eBData)
{
foreach($paymentOptionSimplify->eBData as $valpaymentOptionSimplify)
{
extract($valpaymentOptionSimplify);
{
echo "<button type='submit' name='ContinuebSimplifyCheckout' class='button submit' title='Simplify Checkout'><b>Checkout <img src='".themeResource."/images/icon/simplify.png'></b></button><br /><br />";
}
}
}
/* End Simplify */
/* Start bKash */
$paymentOptionBkashManual = new ebapps\bay\ebcart();
$paymentOptionBkashManual -> paymentOptionBkashManualExits();
if($paymentOptionBkashManual->eBData)
{
foreach($paymentOptionBkashManual->eBData as $valpaymentOptionBkashManual)
{
extract($valpaymentOptionBkashManual);
{
echo "<button type='submit' name='ContinuebKashCheckout' class='button submit' title='bKash Checkout'><b>Checkout <img src='".themeResource."/images/icon/bKash.png'></b></button><br /><br />";
}
}
}
/* End bKash */
?>
</form>
<!-- Payment Options Ends -->
</div>
</div>
</div>
</div>
</div>
<?php
}

?>
<!--shipment-address -->
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
<div class='well'>
<!-- HTML Code -->
<form method='post'>
<fieldset class='group-select'>
<legend>
<h2>Shipping Address</h2></legend>
<input type='hidden' name='form_key' value='<?php echo $formKey->outputKey(); ?>'>
<?php echo $formKey_error; ?>
Full Name: <?php echo $full_name_sa_error;  ?>
<input class='form-control' type='text' name='full_name_sa' placeholder='Delivery Recipient Full Name' required autofocus value='' />
Address Line 1: <?php echo $address_line_1_sa_error;  ?>
<input class='form-control' type='text' name='address_line_1_sa' placeholder='Delivery Recipient Address' required autofocus value='' />
Address Line 2: <?php echo $address_line_2_sa_error;  ?>
<input class='form-control' type='text' name='address_line_2_sa' value='' />
City/Town: <?php echo $city_town_sa_error;  ?>
<input class='form-control' type='text' name='city_town_sa' placeholder='City/Town' required autofocus value='' />
State/Province/Region: <?php echo $state_province_region_sa_error;  ?>
<input class='form-control' type='text' name='state_province_region_sa' placeholder='State/Province/Region' required autofocus value='' />
Postal Code: <?php echo $postal_code_sa_error;  ?>
<input class='form-control' type='text' name='postal_code_sa' placeholder='Postal Code' required autofocus value='' />

<input type='hidden' name='country_sa' value='<?php $country = new ebapps\bay\ebcart(); $country->selected_shipping_country_dhl(); ?>' />
Country : <b><?php $country2 = new ebapps\bay\ebcart(); $country2->selected_shipping_country_dhl(); ?></b>
<br />
<a href='<?php echo outBayLink; ?>/product/checkout/'><button type='button' class='button submit' title='Change Country'>Change Country</button></a>
<br />
Mobile Number: <?php echo $phone_mobile_number_error;  ?>
<div class='input-group'><span class='input-group-addon alert-info' style='text-align:right' role='alert'>+<?php $countryCode = new ebapps\bay\ebcart(); $countryCode->selected_shipping_country_dial_code(); ?><input type='hidden' name='phone_mobile_code' value='<?php $countryCode->selected_shipping_country_dial_code(); ?>'></span><input type='text' name='phone_mobile_number' placeholder='Delivery Recipient Mobile' class='form-control' required  autofocus></div>
<button type='submit' name='shipping_address' class='button submit' title='Submit Address'><b>Submit Address</b></button>
</fieldset>
</form>
</div>
</div>
</div>
</div>
<?php
}
?>
<!--shipment-address -->
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
<a href='<?php echo outBayLink; ?>/product/'><button type='button' class='button submit' title='Shop'><i class='fa fa-cart-plus fa-lg' aria-hidden='true'></i> <b>Shop</b></button></a>
</div>
</div>
</div>
</div>
<?php 
}
?>
<?php include_once (eblayout."/a-common-footer.php"); ?>