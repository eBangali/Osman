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
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = "";
$search_bay_dhl_zone_error = "";
$search_bay_weitht_error = "";
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>
<?php
if(isset($_REQUEST['submit_search_bay_dhl']))
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

/* search_bay_dhl_zone */
if (empty($_REQUEST["search_bay_dhl_zone"]))
{
$search_bay_dhl_zone_error = "<b class='text-warning'>DHL Zone Required</b>";
$error =1;
} 
/* valitation search_bay_dhl_zone  */
elseif (! preg_match("/^[0-9]{1,4}$/",$_REQUEST["search_bay_dhl_zone"]))
{
$search_bay_dhl_zone_error = "<b class='text-warning'>DHL Zone Required</b>";
$error =1;
}
else 
{
$search_bay_dhl_zone = $sanitization -> test_input($_REQUEST["search_bay_dhl_zone"]);
}
//
/* search_bay_weitht */
if (empty($_REQUEST["search_bay_weitht"]))
{
$search_bay_weitht_error = "<b class='text-warning'>Weight in Kg Required</b>";
$error =1;
} 
elseif (! preg_match("/^[0-9.]{1,4}$/",$_REQUEST["search_bay_weitht"]))
{
$search_bay_weitht_error = "<b class='text-warning'>Weight in Kg Required</b>";
$error =1;
}
else 
{
$search_bay_weitht = $sanitization -> test_input($_REQUEST["search_bay_weitht"]);
}
?>
<?php } ?>
<div class='well'>
<form method='post'>
<fieldset class='group-select'>
<input type='hidden' name='form_key' value='<?php echo $formKey->outputKey(); ?>'>
<?php echo $formKey_error; ?>
DHL Zone <?php echo $search_bay_dhl_zone_error; ?>
<select class='form-control' name='search_bay_dhl_zone'><option>Please Select</option><?php $zone = new ebapps\bay\ebcart(); $zone->search_dhl_rating_zones(); ?></select>
Weight in Kg <?php echo $search_bay_weitht_error; ?>
<input class='form-control' type='number' step='0.50' min='0.50' max='25.00' name='search_bay_weitht' placeholder='Weight in KG' required autofocus />
<div class='buttons-set'>
<button type='submit' name='submit_search_bay_dhl' title='Find Rate' class='button submit'> <span> Find Rate </span> </button>
</div>
</fieldset>
</form>
</div>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php
if($error == 0)
{
extract($_REQUEST);
$searchobj= new ebapps\bay\ebcart(); 
$searchobj -> search_in_bay_dhl_price(); ?>
<?php if($searchobj->eBData >= 1) { ?>
<?php foreach($searchobj->eBData as $val): extract($val); ?>
<?php 
$zoneDhlSearch = "<div class='well'>";
$zoneDhlSearch .= "<article>";
$zoneDhlSearch .= "<div class='panel panel-default'>";
$zoneDhlSearch .= "<table class='table'>";
$zoneDhlSearch .= "<thead>";
$zoneDhlSearch .= "<tr>";
$zoneDhlSearch .= "<th>ZONE</th>";
$zoneDhlSearch .= "<th>WEIGHT IN KG</th>";
$zoneDhlSearch .= "<th>".primaryCurrency."</th>";
$zoneDhlSearch .= "<th>OPTION</th>";
$zoneDhlSearch .= "</tr>";
$zoneDhlSearch .= "</thead>";
$zoneDhlSearch .= "<tbody>";
$zoneDhlSearch .= "<tr>";
$zoneDhlSearch .= "<td>$dhl_zone</td>";
$zoneDhlSearch .= "<td>$dhl_weight</td>";
$zoneDhlSearch .= "<td>$dhl_price</td>";
$zoneDhlSearch .= "<td><form action='dhl-export-rates-search-edit.php' method='get'><input type='hidden' name='bay_dhl_weight_zone_price_id' value='$bay_dhl_weight_zone_price_id' /><div class='buttons-set'><button type='submit' class='button submit' name='option_dhl_price_edit' value='EDIT' alt='EDIT RATES' title='EDIT RATES'><b>EDIT RATES</b></button></div></form></td>";
$zoneDhlSearch .= "</tr>";
$zoneDhlSearch .= "</tbody>";
$zoneDhlSearch .= "</table>";
$zoneDhlSearch .= "</div>";
$zoneDhlSearch .= "</article>";
$zoneDhlSearch .= "</div>";
echo $zoneDhlSearch;
?>
<?php endforeach; }} ?>
<?php
}
else
{
header("Location: ".outLink."/access/admin-register.php");
}
?>
