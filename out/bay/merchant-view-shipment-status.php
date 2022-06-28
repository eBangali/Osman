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
<div class='col-xs-12 col-md-9'>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php
$shipmentStatus = "<div class='row'>";
$shipmentStatus .= "<div class='col-xs-12 col-md-12 eb-center'>";
$shipmentStatus .= "<h2>Sales, Shipping, Return, Refund, Query...</h2>";
$shipmentStatus .= "</div>";
$shipmentStatus .= "</div>";
$shipmentStatus .= "<div class='row'>";
$shipmentStatus .= "<div class='col-xs-12 col-md-12'>";
$shipmentStatus .= "<div class='table-responsive'>";
$shipmentStatus .= "<table class='table table-bordered'>";
$shipmentStatus .= "<thead>";
$shipmentStatus .= "<tr>";
$shipmentStatus .= "<th>ITEM</th>";
$shipmentStatus .= "<th>ID</th>";
$shipmentStatus .= "<th>SIZE</th>";
$shipmentStatus .= "<th>QTY</th>";
$shipmentStatus .= "<th>SELLER</th>";
$shipmentStatus .= "<th>SHIPMENT.DATE</th>";
$shipmentStatus .= "<th>COURIER</th>";
$shipmentStatus .= "<th>COURIER.TRACKING</th>";
$shipmentStatus .= "<th>REFUND</th>";
$shipmentStatus .= "<th>QUERY</th>";
$shipmentStatus .= "</tr>";
$shipmentStatus .= "</thead>";
$shipmentStatus .= "<tbody>";
?>
<?php $objProdect = new ebapps\bay\ebcart(); $objProdect -> view_shipment_product_for_merchant(); ?>
<?php if($objProdect->eBData){ foreach($objProdect->eBData as $val): extract($val); ?>
<?php
$shipmentStatus .= "<tr align='right'>";
$shipmentStatus .= "<td width='100px'><a href='".outBayLink."/product/item-details-grid/$bay_appro_id_in_order_m2m/'>";
?>
<?php $objThurmbnail = new ebapps\bay\ebcart(); $objThurmbnail -> view_invoice_product_sml_image($bay_appro_id_in_order_m2m); ?>
<?php if($objThurmbnail->eBData){ foreach($objThurmbnail->eBData as $val): extract($val); ?>
<?php
$shipmentStatus .= "<img class='img-responsive' src='";
if(hypertext.$s_og_small_image_url)
{
$shipmentStatus .= hypertext."$s_og_small_image_url";
}
$shipmentStatus .= "' />";
?>
<?php endforeach; } ?>
<?php
$shipmentStatus .= "</a></td>";
$shipmentStatus .= "<td><a href='".outBayLink."/product/item-details-grid/$bay_appro_id_in_order_m2m/'>$bay_appro_id_in_order_m2m</a></td>"; 
?>
<?php $objSizeQtn = new ebapps\bay\ebcart(); $objSizeQtn -> view_shipment_status_size_qtn(); ?>
<?php if($objSizeQtn->eBData){ foreach($objSizeQtn->eBData as $val): extract($val); ?>
<?php
if($bay_showroom_approved_items_id_io == $bay_appro_id_in_order_m2m)
{
$shipmentStatus .= "<td>$size_io</td>";
$shipmentStatus .= "<td>$sqtn_io</td>";
}
?>
<?php endforeach; } ?>
<?php
$shipmentStatus .= "<td>$username_merchant_in_m2m_for_crm</td>";
?>
<?php $objShipmentDateServiceTracking = new ebapps\bay\ebcart(); $objShipmentDateServiceTracking -> view_shipment_status_date_service_tracking(); ?>
<?php if($objShipmentDateServiceTracking->eBData){ foreach($objShipmentDateServiceTracking->eBData as $val): extract($val); ?>
<?php
if($bay_product_id_in_prove_crm == $bay_appro_id_in_order_m2m)
{
$shipmentStatus .= "<td>$shipment_date_spg</td>"; 
$shipmentStatus .= "<td>$courier_service_name_spg</td>";
$shipmentStatus .= "<td>$tracking_number_courier_services_spg</td>";
//
$objRating = new ebapps\bay\ebcart();
$objRating -> is_exist_bay_refund_request($tracking_unique_sales_order_in_m2m, $bay_appro_id_in_order_m2m);
if($objRating->eBData)
{ 
foreach($objRating->eBData as $val): extract($val); 
if($request_status == 'NO')
{
$shipmentStatus .= "<td><i class='fa fa-times-circle fa-2x' aria-hidden='true'></i></td>";
}
if($request_status == 'REQUESTED')
{
$shipmentStatus .= "<td><i class='fa fa-times-circle fa-2x' aria-hidden='true'></i></td>";
}
if($request_status == 'PAID')
{
$shipmentStatus .= "<td><i class='fa fa-check-circle fa-2x ' aria-hidden='true'></i></td>";
}
endforeach;
}
//
$shipmentStatus .= "<td><form action='merchant-bay-support-reply.php' method='post'><input type='hidden' name='tracking_unique_sales_order_spg' value='$tracking_unique_sales_order_in_m2m' /><input type='hidden' name='bay_product_id_in_prove_crm' value='$bay_appro_id_in_order_m2m' /><button type='submit' name='BayMerchantReplyQuery' class='button submit' value='Query'  alt='Query'><b>Query</b></button></form></td>";
}
?>
<?php endforeach; } ?>
<?php endforeach; } ?>
<?php
$shipmentStatus .= "</tr>";
$shipmentStatus .= "</tbody>";
$shipmentStatus .= "</table>";
$shipmentStatus .= "</div>";
$shipmentStatus .= "</div>";
$shipmentStatus .= "</div>";
echo $shipmentStatus;
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
