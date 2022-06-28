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
<div class='well'>
<h2 title='Edit Item'>Edit Item</h2>
</div>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = "";
$branding_title_error = "*";
$branding_url_error = "*";
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>
<?php
if(isset($_REQUEST['bay_branding_item_edit']))
{
extract($_REQUEST);
//
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
/* branding_title */
if (empty($_REQUEST["branding_title"]))
{
$branding_title_error = "<b class='text-warning'>Title required</b>";
$error =1;
} 
/* valitation branding_title  Tested allow (productname-productname-product-name)*/
elseif (! preg_match("/^([A-Za-z0-9\?\.\,\-\ ]{3,55})$/",$branding_title))
{
$branding_title_error = "<b class='text-warning'>Single or double quotes, certain special characters are not allowed. Minimum characters 3 maximum characters 55</b>";
$error =1;
}
else 
{
$branding_title = $sanitization -> test_input($_POST["branding_title"]);
}
/* branding_url */
if (empty($_REQUEST['branding_url']))
{

} 
/* valitation branding_url  */
elseif (!preg_match('/^([a-zA-Z0-9\,\.\/\+\?\-\=\_\-]{3,255})$/',$branding_url))
{
$branding_url_error = "<b class='text-warning'>Certain special characters are not allowed.</b>";
$error =1;
}
else 
{
$branding_url = $sanitization -> test_input($_POST['branding_url']);
}
/* Submition form */
if($error == 0){
extract($_REQUEST);
$obj = new ebapps\bay\ebcart();
$obj->branding_item_update($branding_id, $branding_title, $branding_url);
}
//
}
?>
<div class='well'>
<?php
if(isset($_REQUEST['option_branding_edit']))
{
extract($_REQUEST);
$obj = new ebapps\bay\ebcart();
$obj->edit_branding_item();
if($obj->eBData >= 1)
{
foreach($obj->eBData as $val)
{
extract($val);
$updateBranding ="<form method='post'>"; 
$updateBranding .="<fieldset class='group-select'>"; 
$updateBranding .="<input type='hidden' name='form_key' value='";
$updateBranding .= $formKey->outputKey(); 
$updateBranding .="'>";  
$updateBranding .="$formKey_error";
$updateBranding .="<input type='hidden' name='branding_id' value='$branding_id' />"; 
$updateBranding .="Merchant: $username_merchant";
$updateBranding .="Title: $branding_title_error";
$updateBranding .="<input class='form-control' type='text' name='branding_title' value='$branding_title' placeholder='T-Shirt' />";
$updateBranding .="URL whthout https://www: $branding_url_error";
$updateBranding .="<input class='form-control' type='text' name='branding_url' placeholder='google.com' value='$branding_url' />";
$updateBranding .="<div class='buttons-set'>
<button type='submit' name='bay_branding_item_edit' title='Submit' class='button submit'> <span> Submit </span> </button>
</div>";
$updateBranding .="</fieldset>";
$updateBranding .="</form>";
echo $updateBranding;  
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
