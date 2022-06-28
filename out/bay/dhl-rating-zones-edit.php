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
<h2 title='Edit DHL Zone'>Edit DHL Zone</h2>
</div>
<div class='well'>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php
/* Initialize valitation */
$error = 0;
$dhl_country_zone_error = "*";
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>
<?php
if(isset($_REQUEST['DhlZoneUpdate']))
{
extract($_REQUEST);
/* dhl_country_zone */
if (empty($_REQUEST["dhl_country_zone"]))
{
$dhl_country_zone_error = "Zone required";
$error =1;
} 
elseif (! preg_match("/^([0-9]{1,4})$/",$dhl_country_zone))
{
$dhl_country_zone_error = "Zone error";
$error =1;
}
else 
{
$dhl_country_zone = $sanitization -> test_input($_POST["dhl_country_zone"]);
}

/* Submition form */
if($error == 0){
extract($_REQUEST);
$obj = new ebapps\bay\ebcart();
$obj->update_dhl_country_zone($bay_dhl_country_zone_id, $dhl_country_zone);
}
//
}
?>
<?php
if(isset($_REQUEST['bay_dhl_zone_edit']))
{
extract($_REQUEST);
$obj = new ebapps\bay\ebcart();
$obj->edit_dhl_zone_by_id($bay_dhl_zone_edit);
if($obj->eBData >= 1)
{
foreach($obj->eBData as $val)
{
extract($val);
$updateDhlZone ="<form method='post'>"; 
$updateDhlZone .="<fieldset class='group-select'>";
$updateDhlZone .="<input type='hidden' name='bay_dhl_country_zone_id' value='$bay_dhl_country_zone_id'>";
//
$updateDhlZone .="<div class='input-group'>";
$updateDhlZone .="<span class='input-group-addon' id='sizing-addon2'>Zone: $dhl_country_zone_error</span>";
$updateDhlZone .="<select class='form-control' name='dhl_country_zone'>";
if(isset($dhl_country_zone))
{
$updateDhlZone .="<option selected value='$dhl_country_zone'>".$dhl_country_zone."</option>";
}
$updateDhlZone .="<option value='0'>0</option>";
$updateDhlZone .="<option value='1'>1</option>";
$updateDhlZone .="<option value='2'>2</option>";
$updateDhlZone .="<option value='3'>3</option>";
$updateDhlZone .="<option value='4'>4</option>";
$updateDhlZone .="<option value='5'>5</option>";
$updateDhlZone .="<option value='6'>6</option>";
$updateDhlZone .="<option value='7'>7</option>";
$updateDhlZone .="</select>";
$updateDhlZone .="</div>";
//
$updateDhlZone .="<div class='buttons-set'><button type='submit' name='DhlZoneUpdate' title='UPDATE' class='button submit'> <span> UPDATE </span> </button></div>";
$updateDhlZone .="</fieldset>";
$updateDhlZone .="</form>";
echo $updateDhlZone;  
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
