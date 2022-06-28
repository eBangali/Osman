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
<h2 title='Submit Shipment Info'>Submit Shipment Info</h2>
</div>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = "";
$trakingOrderIDforSaller_error ="";
$courier_service_name_spg_error = "*";
$CorierServicesTrakingNumber_error = "*";
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>
<?php
if (isset($_REQUEST['MerchantSubmitShipmentInfoSubmit']))
{
extract($_REQUEST);

/* Form Key*/
if(isset($_REQUEST["form_key"]))
{
$form_key = preg_replace('#[^a-zA-Z0-9]#i','',$_POST["form_key"]);
if($formKey->read_and_check_formkey($form_key) == true)
{

}
else
{
$formKey_error = "<b class='text-warning'>Sorry the server is currently too busy please try again later.</b>";
$error = 1;
}
}
/* courier_service_name_spg */
if (empty($_REQUEST["courier_service_name_spg"]))
{
$courier_service_name_spg_error = "<b class='text-warning'>Courier Service Name Required</b>";
$error =1;
}
/* valitation courier_service_name_spg_address  */
elseif (! preg_match("/^([A-Za-z\ ]+)$/",$courier_service_name_spg))
{
$courier_service_name_spg_error = "<b class='text-warning'>Invalid Courier Service Name</b>";
$error =1;
}
else
{
$courier_service_name_spg = $sanitization -> test_input($_POST["courier_service_name_spg"]);
}

/* trakingOrderIDforSaller */
if (empty($_REQUEST["trakingOrderIDforSaller"]))
{
$trakingOrderIDforSaller_error = "<b class='text-warning'>Please go back and try again can not submit</b>";
$error =1;
}

/* CorierServicesTrakingNumber */
if (empty($_REQUEST["CorierServicesTrakingNumber"]))
{
$CorierServicesTrakingNumber_error = "<b class='text-warning'>Shipment Trackign Required</b>";
$error =1;
}
/* valitation CorierServicesTrakingNumber*/
elseif(! preg_match("/^([A-Za-z0-9\-\_]+)$/",$CorierServicesTrakingNumber))
{
$CorierServicesTrakingNumber_error = "<b class='text-warning'>Use A-Za-z0-9</b>";
$error =1;
}
else
{
$CorierServicesTrakingNumber = $sanitization ->test_input($_POST["CorierServicesTrakingNumber"]);
}
/* Submition form */
if($error ==0)
{
extract($_REQUEST);
$user = new ebapps\bay\ebcart();
$user->bay_sumbit_shipment_info();
}
}
?>
<?php
if(isset($_REQUEST['SubmitShipmentInfoByMerchant']))
{
?>
<div class="well">
<?php
$submitShipmentInfo ="<form method='post'>";
$submitShipmentInfo .="<fieldset class='group-select'>";
$submitShipmentInfo .="<fieldset>";
$submitShipmentInfo .="<input type='hidden' name='form_key' value='";
$submitShipmentInfo .= $formKey->outputKey(); 
$submitShipmentInfo .="'>"; 
$submitShipmentInfo .="$formKey_error";
$submitShipmentInfo .="$trakingOrderIDforSaller_error";
$submitShipmentInfo .="<input type='hidden' name='trakingOrderIDforSaller' value='";
include_once (ebbay.'/ebcart.php');
$objTraking = new ebapps\bay\ebcart();
$submitShipmentInfo .=$objTraking -> generate_form_to_submit_shipment_info();
$submitShipmentInfo .="'>";
$submitShipmentInfo .="Select Courier Service: $courier_service_name_spg_error";
$submitShipmentInfo .="<select class='form-control' name='courier_service_name_spg'><option value='Home-Delevery-Self'>Home Delevery Self</option><option value='DHL'>DHL</option><option value='Australia-Post'>Australia Post</option><option value='Continental Courier Services LLC'>Continental Courier Services LLC</option></select>";
$submitShipmentInfo .="Delivery Tracking: $CorierServicesTrakingNumber_error";
$submitShipmentInfo .="<input class='form-control' type='text' name='CorierServicesTrakingNumber' />";
$submitShipmentInfo .="<div class='buttons-set'><button type='submit' name='MerchantSubmitShipmentInfoSubmit' title='Submit' class='button submit'><span>Submit</span></button></div>";
$submitShipmentInfo .="</fieldset>";
$submitShipmentInfo .="</form>";
echo $submitShipmentInfo;
?>
</div>
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
