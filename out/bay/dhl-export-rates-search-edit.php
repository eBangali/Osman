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
<?php include_once (ebaccess.'/access_permission_admin_minimum.php'); ?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>

</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<div class="well">
<h2 title='Edit DHL Rates'>Edit DHL Rates</h2>
</div>
<div class='well'>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php
/* Initialize valitation */
$error = 0;
$dhl_price_error = "*";
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>
<?php
if(isset($_REQUEST['DhlPriceUpdate']))
{
extract($_REQUEST);
/* dhl_price */
if (empty($_REQUEST["dhl_price"]))
{
$dhl_price_error = "Rates required";
$error =1;
} 
elseif (! preg_match("/^([0-9]{1,4}[.]{1,1}[0-9]{2,2})$/",$dhl_price))
{
$dhl_price_error = "Price error";
$error =1;
}
else 
{
$dhl_price = $sanitization -> test_input($_POST["dhl_price"]);
}

/* Submition form */
if($error == 0){
extract($_REQUEST);
$obj = new ebapps\bay\ebcart();
$obj->update_dhl_price($bay_dhl_weight_zone_price_id, $dhl_price);
}
//
}
?>
<?php
if(isset($_REQUEST['option_dhl_price_edit']))
{
extract($_REQUEST);
$obj = new ebapps\bay\ebcart();
$obj->edit_dhl_export_price($bay_dhl_weight_zone_price_id);
if($obj->eBData >= 1)
{
foreach($obj->eBData as $val)
{
extract($val);
$updateDhlPrice ="<form method='post'>"; 
$updateDhlPrice .="<fieldset class='group-select'>";
$updateDhlPrice .="<input type='hidden' name='bay_dhl_weight_zone_price_id' value='$bay_dhl_weight_zone_price_id'>";
$updateDhlPrice .="Rates must be in ".primaryCurrency." $dhl_price_error"; 
$updateDhlPrice .="<input class='form-control' type='number' step='0.01' name='dhl_price' value='$dhl_price'>"; 
$updateDhlPrice .="<div class='buttons-set'>
<button type='submit' name='DhlPriceUpdate' title='UPDATE' class='button submit'> <span> UPDATE </span> </button>
</div>";
$updateDhlPrice .="</fieldset>";
$updateDhlPrice .="</form>";
echo $updateDhlPrice;  
}
}
}
?>
</div>
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

