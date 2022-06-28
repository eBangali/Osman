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
<h2 title='Branding Status'>Branding Status</h2>
</div>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php
if(isset($_REQUEST['approve_merchants_braningn_items']))
{
extract($_REQUEST);

$obj=new ebapps\bay\ebcart();
$obj->approve_merchants_branding_items($branding_id);
}
?>
<?php
if(isset($_REQUEST['notApprovedBranding']))
{
extract($_REQUEST);
$obj=new ebapps\bay\ebcart();
if(isset($branding_id) and isset($branding_image_url))
{
$obj->notBayBrandingApproved($branding_id, $branding_image_url);
}
}
?>
<?php
if(isset($_REQUEST['deleteBrands']))
{
extract($_REQUEST);
$obj=new ebapps\bay\ebcart();
$obj->deleteBranding($branding_id, $branding_image_url);
}
?>
<?php
$obj=new ebapps\bay\ebcart();
$obj->branding_view_items();
$branding ="<article>";
$branding .="<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>";
if($obj->eBData >= 1)
{
foreach($obj->eBData as $val)
{
extract($val);
$branding .= "<div class='panel panel-default'>";
$branding .= "<div class='panel-heading' role='tab' id='heading".$branding_id."'>";
$branding .= "<h3 class='panel-title'> <a class='collapsed' data-toggle='collapse' data-parent='#accordion' href='#collapse".$branding_id."' aria-expanded='false' aria-controls='collapse".$branding_id."'>";
//
$branding .= "<div class='row'>";
$branding .= "<div class='col-xs-12 col-md-12'>";
$branding .= "<div class='table-responsive'>";
$branding .= "<table class='table table-bordered'>";
$branding .= "<tbody>";
$branding .= "<tr>";
if(file_exists(str_replace(hostingName, docRoot, hypertextWithOrWithoutWww.$branding_image_url)))
{
$branding .= "<td width='30%'><img class='img-responsive' src='".hypertextWithOrWithoutWww."$branding_image_url' /></td>";
}
else
{
$branding .= "<td width='30%'><img class='img-responsive' src='".themeResource."/images/blankImage.jpg' /></td>";
}
$branding .= "<td>";
if($branding_active==0)
{
$branding .= "<i class='fa fa-times-circle fa-lg' aria-hidden='true'></i> REVIEWING <br>";
}
if($branding_active==1)
{
$branding .= "<i class='fa fa-check-circle fa-lg' aria-hidden='true'></i> PUBLISHED <br>";
}
$branding .= "<b>Title: ".$branding_title."</b><br>";
$branding .= "<b>ID: $branding_id</b>";
$branding .= "</td>"; 
$branding .= "</tr>";
$branding .= "</tbody>";
$branding .= "</table>";
$branding .= "</div>";
$branding .= "</div>";
$branding .= "</div>";
//
$branding .= "</a>";
$branding .= "</h3>";
$branding .= "</div>";
$branding .= "<div id='collapse".$branding_id."' class='panel-collapse collapse' role='tabpanel' aria-labelledby='heading".$branding_id."'>";
$branding .= "<div class='table-responsive panel-body'>";
$branding .= "<table class='table'>";
$branding .= "<tbody>";
$branding .= "<tr><td scope='row'>Merchant:</td><td>$username_merchant</td></tr>";
$branding .= "<tr><td>Title:</td><td>".ucfirst($branding_title)."</td></tr>";
if(file_exists(str_replace(hostingName, docRoot, hypertextWithOrWithoutWww.$branding_image_url)))
{
$branding .="<tr><td>Profile Image:</td><td><img src='".hypertextWithOrWithoutWww."$branding_image_url' class='img-responsive' /></td></tr>";
}
else
{
$branding .= "<tr><td>Upload Profile Image:</td><td><form action='bay-image-upload-branding.php' method='post'><input type='hidden' name='branding_id' value='$branding_id' /><div class='buttons-set'><button type='submit' name='upload_image_branding' title='Submit' class='button submit'> <span> Upload Profile Image </span> </button></div></form></td></tr>";
}
$branding .= "<tr><td>URL:</td><td>$branding_url</td></tr>";
$branding .= "<tr><td>Submit Date :</td><td>$branding_start_date</td></tr>";
$branding .= "<tr>";
$branding .= "<td>OPTIONS: </td>";
$branding .= "<td>";
if($branding_active==0){
if(file_exists(str_replace(hostingName, docRoot, hypertextWithOrWithoutWww.$branding_image_url)))
{
$branding .= "<form method='post'><div class='buttons-set'><input type='hidden' name='branding_id' value='$branding_id' /><button type='submit' name='approve_merchants_braningn_items' title='APPROVE' class='button submit'> <span> APPROVE </span> </button></div></form>";
}
}
$branding .= "<form method='post'><div class='buttons-set'><input type='hidden' name='branding_id' value='$branding_id' /><input type='hidden' name='branding_image_url' value='$branding_image_url' /><button type='submit' name='notApprovedBranding' title='Not Approved' class='button submit'> <span> Not Approved </span> </button></div></form>";

$branding .= "<form action='bay_branding_edit.php' method='get'><input type='hidden' name='branding_id' value='$branding_id' /><div class='buttons-set'>
<button type='submit' name='option_branding_edit' title='EDIT' class='button submit'> <span> EDIT </span> </button>
</div></form>";
$branding .= "<form method='post'><input type='hidden' name='branding_id' value='$branding_id' /><input type='hidden' name='branding_image_url' value='$branding_image_url' /><div class='buttons-set'>
<button type='submit' name='deleteBrands' title='Delete' class='button submit'> <span> Delete </span> </button>
</div></form>";
$branding .= "</td>";
$branding .= "</tr>";
$branding .= "</tbody>";
$branding .= "</table>";
$branding .= "</div>";
$branding .= "</div>";
$branding .= "</div>";
}
$branding .= "</div>";
$branding .= "</article>";
echo $branding;
}
else
{
echo "<pre>No Item Found</pre>";
}
?>
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
