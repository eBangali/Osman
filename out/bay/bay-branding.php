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
<div class='col-xs-12 col-md-7 eb-gap sidebar-offcanvas'>
<div class='well'>
<h2 title='Branding Add New'>Branding Add New</h2>
</div>
<?php include_once (ebbay.'/ebcart.php');
$merchant = new ebapps\bay\ebcart();
?>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = '';
$branding_title_error = '*';
$branding_url_error = '*';
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>
<?php
if(isset($_REQUEST['bay_branding_add']))
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
/* branding_title */
if (empty($_REQUEST['branding_title']))
{
$branding_title_error = "<b class='text-warning'>Title required</b>";
$error =1;
} 
elseif (! preg_match('/^([A-Za-z0-9\?\.\,\-\ ]{3,55})$/',$branding_title))
{
$branding_title_error = "<b class='text-warning'>Single or double quotes, certain special characters are not allowed. Minimum characters 3 maximum characters 55</b>";
$error =1;
}
else 
{
$branding_title = $sanitization -> test_input($_POST['branding_title']);
}
/* branding_url */
if (empty($_REQUEST['branding_url']))
{

} 
elseif (! preg_match('/^([a-zA-Z0-9\,\.\/\+\?\-\=\_\-]{3,255})$/',$branding_url))
{
$branding_url_error = "<b class='text-warning'>Certain special characters are not allowed.</b>";
$error =1;
}
else 
{
$branding_url = $sanitization -> test_input($_POST['branding_url']);
}

/* Submition form */
if($error == 0)
{
extract($_REQUEST);
$merchant->submit_new_branding_item($branding_title, $branding_url);
}
//
}
?>
<div class='well'>
<form method='post' enctype='multipart/form-data'>
<fieldset class='group-select'>

<input type='hidden' name='form_key' value='<?php echo $formKey->outputKey(); ?>'>
<?php echo $formKey_error; ?>
<?php $categoryes = new ebapps\bay\ebcart(); ?> 
Title: <?php echo $branding_title_error; ?>
<input class='form-control' type='text' name='branding_title' required autofocus />
Link whthout https://www: <?php echo $branding_url_error;  ?>
<input class='form-control' type='text' name='branding_url' />
<div class='buttons-set'>
<button type='submit' name='bay_branding_add' title='Submit' class='button submit'> <span> Submit </span> </button>
</div>

</fieldset>
</form>
</div>
</div>
<div class='col-xs-12 col-md-3 sidebar-offcanvas'>
<?php include_once ('bay-my-account.php'); ?>
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
