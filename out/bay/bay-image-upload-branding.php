<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php');?>
<?php
include_once(ebbd.'/dbconfig.php');
$adMin = new ebapps\dbconnection\dbconfig();
if(isset($adMin->eBAdminUserIsSet))
{
?>
<?php include_once (eblogin.'/session.inc.php');?>
<?php include_once (eblayout.'/a-common-header-icon.php');?>
<?php include_once (eblayout.'/a-common-header-meta-noindex.php'); ?>
<?php include_once (eblayout.'/a-common-header-title-one.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts-text-editor.php');?>
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
<?php include_once (ebaccess.'/access_permission_merchant_minimum.php');?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>

</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<div class="well">
<h2 title='Upload Product Image'>Upload Product Image</h2>
</div> 
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php include_once (ebimageupload.'/uploadimage-bay-branding.php'); ?>
<?php
if(isset($_REQUEST['submit']))
{
extract($_REQUEST);
$merchant = new ebapps\bay\ebcart();
$up = new ebapps\upload\uploadimage();
$m_url_raw = $up -> upload_file('item_picture');
/* Change it later with your cpanel login username and hostname*/
if($m_url_raw)
{
$m_url = str_replace(docRoot, domainForImagStore, $m_url_raw);
$merchant->updates_merchant_branding_image_url($branding_id,$m_url);
}
}
?>
<?php $merchant = new ebapps\bay\ebcart(); $merchant -> upload_image_to_bay_branding_merchant(); ?>
<?php  if($merchant->eBData >= 1) { foreach($merchant->eBData as $val){ extract($val); ?>
<div class="well">
<form method='post' enctype='multipart/form-data'>
<fieldset class='group-select'>
Profile Image: .jpg
NB: Image dimensions must be 1366x460 in pixels
<input type='hidden' name='branding_id' value='<?php echo $branding_id; ?>'>
<input type='file' required autofocus name='item_picture' />
<div class='buttons-set'>
<button type='submit' name='submit' title='Submit' class='button submit'> <span> Submit </span> </button>
</div>
</fieldset>
</form>
</div>
<?php } } ?>
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
