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
<h2 title='Sales History'>Sales History</h2>
</div>
<div class='well'>
<article>
<div class="panel panel-default table-responsive">
<table class="table">
<thead>
<tr>
<th>SALES ID</th>
<th>INVOICES</th>
<th>CHECK STATUS</th>
<th>SHIPMENT INFO</th>
</tr>
</thead>
<tbody>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php $obj= new ebapps\bay\ebcart(); $obj -> bay_sales_history_group_by_order_tracking(); ?>
<?php if($obj->eBData){ foreach($obj->eBData as $val): extract($val); ?>
<?php 
$zoneDhl = "<tr>";
$zoneDhl = "<td>$orderid</td>";
$zoneDhl .= "<td><form action='merchant-view-invoice.php' method='get'><input type='hidden' name='trackerID' value='$tracking_unique_sales_order_in_m2m' /><button type='submit' value='View Invoice' class='button submit' alt='View Invoice'> <b>View Invoice</b></button></form></td>";
$zoneDhl .= "<td><form action='merchant-view-shipment-status.php' method='post'><input type='hidden' name='trackingUniqueSalesForViesShipmentInfo' value='$tracking_unique_sales_order_in_m2m' /><button type='submit' name='MerchantViewShipmentStatus' class='button submit' value='View Status' alt='View Status'><b>View Status</b></button></form></td>";
$zoneDhl .= "<td>";
/* Shipment Info Submit */
$obcheck = new ebapps\bay\ebcart(); 
$obcheck -> is_exist_bay_shipment_info($tracking_unique_sales_order_in_m2m);
if($obcheck->eBData){ foreach($obcheck->eBData as $obcheckval): extract($obcheckval);
if($handover_delevery_status == 'NO')
{
$zoneDhl .= "<form action='merchant-submit-shipment-info.php' method='post'><input type='hidden' name='trackingForSellerToSubmitDelevery' value='$tracking_unique_sales_order_in_m2m' /><button type='submit' name='SubmitShipmentInfoByMerchant' class='button submit' value='Submit Shipment Info'  alt='Submit Shipment Info'><b>Submit Shipment Info</b></button></form>";
}
endforeach;
}
/* Shipment Status by product id and merchant */
$obcheck = new ebapps\bay\ebcart(); 
$obcheck -> bay_shipment_status_by_product_id_merchant($tracking_unique_sales_order_in_m2m);
if($obcheck->eBData){ foreach($obcheck->eBData as $obcheckval): extract($obcheckval);
if($handover_delevery_status == 'PICKEDUP')
{
$zoneDhl .= "<form action='' method='get'><input type='hidden' name='trackingForSellerToSubmitDelevery' value='$tracking_unique_sales_order_in_m2m' /><button type='submit' name='TrackShipmentInfoByMerchant' class='button submit' value='TRACKING DETAILS' alt='TRACKING PICKEDUP'> <b>TRACKING PICKEDUP</b></button></form>";
}
endforeach;
}
//
$zoneDhl .= "</td>";
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
