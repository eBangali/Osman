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
<h2 title='Set Admin DHL Shipping Zone'>Set Admin DHL Shipping Zone</h2>
</div>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = "";
$admin_dhl_shipping_country_id_error = "*";
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>
<?php
if(isset($_REQUEST['admin_dhl_shipping_country_id_submit']))
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

/* admin_dhl_shipping_country_id */
if (empty($_REQUEST["admin_dhl_shipping_country_id"]))
{
$admin_dhl_shipping_country_id_error = "<b class='text-warning'>Shipping From Country Required</b>";
$error =1;
} 
/* valitation admin_dhl_shipping_country_id  */
elseif (! preg_match("/^([0-9]+)$/",$admin_dhl_shipping_country_id))
{
$admin_dhl_shipping_country_id_error = "<b class='text-warning'>Shipping From Country Required</b>";
$error =1;
}
else 
{
$admin_dhl_shipping_country_id = $sanitization -> test_input($_POST["admin_dhl_shipping_country_id"]);
}

/* Submition form */
if($error ==0)
{
$user = new ebapps\bay\ebcart();
extract($_REQUEST);
$user->submit_admin_dhl_shipping_country_id($admin_dhl_shipping_country_id);
}
//
}
?>
<div class='well'>
<form method="post">
<fieldset class='group-select'>
<input type='hidden' name='form_key' value='<?php echo $formKey->outputKey(); ?>'>
<?php echo $formKey_error; ?>
Country : <?php echo $admin_dhl_shipping_country_id_error;  ?>
<select class='form-control' required autofocus  name='admin_dhl_shipping_country_id'>
<option value=''>Select Country</option>
<?php $country_id = new ebapps\bay\ebcart(); $country_id->select_country_of_admin_shipping_zone(); ?></select>

<div class='buttons-set'>
<button type='submit' name='admin_dhl_shipping_country_id_submit' title='Submit' class='button submit'> <span> Submit </span> </button>
</div>
</fieldset>
</form>
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
