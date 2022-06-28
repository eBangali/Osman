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
<?php include_once (ebaccess.'/access_permission_online_minimum.php'); ?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>

</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<div class="well">
<h2 title='Return and Refund'>Return and Refund</h2>
<p>We will refund you the price of the Product, You have to return the Product.</p>
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
$product_qtn_of_return_error = "*";
$returns_refunds_comment_rrg_error = "*";
?>
<?php
if (isset($_REQUEST['contact_for_return']))
{
extract($_REQUEST);
/* product_qtn_of_return */
if (empty($_REQUEST["product_qtn_of_return"]))
{
$product_qtn_of_return_error = "<b class='text-warning'>Quntity required</b>";
} 
/* valitation product_qtn_of_return  */
elseif (! preg_match("/^([0-9])$/",$product_qtn_of_return))
{
$product_qtn_of_return_error = "<b class='text-warning'>Only numbers are allowed</b>";
}
else 
{
$product_qtn_of_return = $sanitization -> test_input($_POST["product_qtn_of_return"]);
}

/* returns_refunds_comment_rrg */
if (empty($_REQUEST["returns_refunds_comment_rrg"]))
{
$returns_refunds_comment_rrg_error = "<b class='text-warning'>Message required</b>";
$error =1;
}
/* valitation returns_refunds_comment_rrg  */
elseif (! preg_match("/^([a-zA-Z0-9\,\.\?\ ]{3,100})/",$returns_refunds_comment_rrg))
{
$returns_refunds_comment_rrg_error = "<b class='text-warning'>Use A-Za-z0-9.,? mini 3 max 100.</b>";
$error =1;
}
else
{
$returns_refunds_comment_rrg = $sanitization -> test_input($_POST["returns_refunds_comment_rrg"]);
}
/* Submition form */
if($error ==0)
{
extract($_REQUEST);
$user = new ebapps\bay\ebcart();
$user->submit_requst_for_return($tracking_unique_sales_order_rrg, $bay_product_id_in_returns_refunds_crm, $product_qtn_of_return, $returns_refunds_comment_rrg);
}
}
?>
<?php $objRequstRefund = new ebapps\bay\ebcart(); $objRequstRefund -> view_requst_for_return(); ?>
<?php if($objRequstRefund->eBData){ foreach($objRequstRefund->eBData as $val): extract($val); ?>
<?php if($return_qtn_crm == 0) { ?>
<?php
$requestRefund = "<div class='well'>";
$requestRefund .= "<form method='post'>";
$requestRefund .= "<fieldset class='group-select'>";
$requestRefund .= "<fieldset>";
$requestRefund .= "Quantity of Refund: ";
$requestRefund .= "<input type='hidden' name='tracking_unique_sales_order_rrg' value='";
$requestRefund .= $tracking_unique_sales_order_rrg;
$requestRefund .= "' />";

$requestRefund .= "<input type='hidden' name='bay_product_id_in_returns_refunds_crm' value='";
$requestRefund .= $bay_product_id_in_returns_refunds_crm;
$requestRefund .= "' />";

$requestRefund .= "<input type='number' class='form-control' min='1' max='";
$requestRefund .= $total_qtn_crm;
$requestRefund .= "' name='product_qtn_of_return' placeholder='Quantity of Refund' required />";
$requestRefund .= "Message: ";
$requestRefund .= "<textarea class='form-control' name='returns_refunds_comment_rrg' required></textarea>";
$requestRefund .= "<div class='buttons-set'><button type='submit' name='contact_for_return' title='Submit' class='button submit'><span>Submit</span></button></div>";
$requestRefund .= "</fieldset>";
$requestRefund .= "</form>";
$requestRefund .= "</div>";
?>
<?php 
} 
else 
{ 
$requestRefund = "<div class='well'>";
$requestRefund .= "You have already submitted refund request please wait until seller received your shipment. Please communicate using QUERY.";
$requestRefund .= "<p>";
$requestRefund .= "<h3>Seller's Name and Address.</h3>";
?>
<?php $objSellerInfo = new ebapps\bay\ebcart(); $objSellerInfo -> view_requst_for_return_seller_address(); ?>
<?php if($objSellerInfo->eBData){ foreach($objSellerInfo->eBData as $val): extract($val); ?>
<?php
$requestRefund .= "<b>Name: $full_name</b><br>";
$requestRefund .= "<b>Mobile : $mobile</b><br>";
$requestRefund .= "<b>Address: $address_line_1</b><br>";
$requestRefund .= "<b>Address: $address_line_2</b><br>";
$requestRefund .= "<b>City /Town: $city_town</b><br>";
$requestRefund .= "<b>State /Province /Region: $state_province_region</b><br>";
$requestRefund .= "<b>Postal Code: $postal_code</b><br>";
$requestRefund .= "<b>Country: $country</b><br>";
$requestRefund .= "</p>";
$requestRefund .= "</div>";
endforeach;
}
} 
?>
<?php echo $requestRefund; ?>
<?php endforeach; ?>
<?php } ?>
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
