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
<h2 title='Upload Product Image'>Upload Product Image</h2>
</div>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php include_once (ebimageupload.'/uploadimage-bay-multi.php'); ?>
<?php
if(isset($_REQUEST['submit']))
{
extract($_REQUEST);
$merchant = new ebapps\bay\ebcart();
$up = new ebapps\upload\uploadimage();
$url_raw = $up -> upload_file('item_picture');
if($url_raw)
{
$bay_big_imag_url = str_replace(docRoot, domainForImagStore, $url_raw);
$merchant->insert_bay_multi_image_url($bay_merchant_add_items_id,$bay_big_imag_url);
}
}
?>
<?php $merchant = new ebapps\bay\ebcart(); $merchant -> select_image_from_bay(); ?>
<?php  if($merchant->eBData >= 1) { foreach($merchant->eBData as $val){ extract($val); ?>
<div class="well">
<form method='post' enctype='multipart/form-data'>
<fieldset class='group-select'>
Item Image:.jpg
NB: Image dimensions must be 1366x956 in pixels
<input type='hidden' name='bay_merchant_add_items_id' value='<?php echo $bay_merchant_add_items_id; ?>'>
<input type='file' required autofocus name='item_picture' />
<div class='buttons-set'>
<button type='submit' name='submit' title='Submit' class='button submit'> <span> Upload Product Image </span> </button>
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