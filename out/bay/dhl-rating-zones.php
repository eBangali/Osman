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
<?php include_once (ebbay.'/ebcart.php'); ?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>

</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<div class="well">
<h2 title='DHL Rating Zones'>DHL Rating Zones from 
<?php 
$shipmentFrom = new ebapps\bay\ebcart(); 
$shipmentFrom -> select_admin_shipping_from_country();
if($shipmentFrom->eBData)
{ 
foreach($shipmentFrom->eBData as $shipmentFromVal): extract($shipmentFromVal); 
echo $admin_country_name;
endforeach;
}
?>
</h2>
</div>
<div class='well'>
<article>
<div class="panel panel-default">
<table class="table">
<thead>
<tr>
<th>COUNTRY</th>
<th>ZONE</th>
<th>EDIT</th>
</tr>
</thead>
<tbody>
<?php $obj= new ebapps\bay\ebcart(); $obj -> dhl_rating_zones(); ?>
<?php if($obj->eBData){ foreach($obj->eBData as $val): extract($val); ?>
<?php 
$zoneDhl = "<tr>";
$zoneDhl .= "<td>$country_name</td>";
$zoneDhl .= "<td>$dhl_country_zone</td>";
$zoneDhl .= "<td><form action='dhl-rating-zones-edit.php' method='get'><input type='hidden' name='bay_dhl_zone_edit' value='$bay_dhl_country_zone_id' /><div class='buttons-set'><button type='submit' class='button submit' alt='EDIT' title='EDIT'><b>EDIT</b></button></div></form></td>";
$zoneDhl .= "</tr>";
echo $zoneDhl;
?>
<?php endforeach; ?>
<?php } ?>      
</tbody>
</table>
</div>
</article>
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
