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
<?php include_once (eblayout.'/a-common-header-meta-scripts.php'); ?>
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
<?php include_once (ebaccess.'/access_permission_online_minimum.php'); ?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>

<div class='col-xs-12 col-md-2'>
</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<div class="well">
<button onclick='printDocInvoicClient();' class='button submit'><b>Click to Print</b></button>

<script type='text/javascript'>
function printDocInvoicClient()
{
var toPrint = document.getElementById('selectPrintAreaClient');
var popupWin = window.open();
popupWin.document.open();
popupWin.document.write('<html>');
popupWin.document.write('<head><title>Print Preview</title></head>');
popupWin.document.write('<body onload="window.print()">');
popupWin.document.write(toPrint.innerHTML);
popupWin.document.write('</body>');
popupWin.document.write('</html>');
popupWin.document.close();
}
</script>
</div>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php include_once (ebqrcode.'/qrlib.php'); ?>
<?php
$invoice = "<div id='selectPrintAreaClient'>";
$invoice .= "<div class='row'>";
$invoice .= "<div class='col-xs-12 col-md-6'>";
$invoice .= "</div>";
$invoice .= "<div class='col-xs-12 col-md-6'>";
$invoice .= "<h1>INVOICE <b>(PAID)</b></h1>";
$invoice .= "</div>";
$invoice .= "</div>";
$invoice .= "<div class='row'>";
$invoice .= "<div class='col-xs-12 col-md-4'>";
?>
<?php $objBuyerContact = new ebapps\bay\ebcart(); $objBuyerContact -> client_view_invoice_buyer_contact_details(); ?>
<?php if($objBuyerContact->eBData){ foreach($objBuyerContact->eBData as $val): extract($val); ?>
<?php $objdate = new ebapps\bay\ebcart(); $objdate -> client_view_invoice_date_invoice_num(); ?>
<?php if($objdate->eBData){ foreach($objdate->eBData as $val): extract($val); ?>
<?php
$qrurl = outBayLinkFull."/user-view-invoice.php?trackerID=$tracking_unique_sales_order_io";
QRcode::png("$qrurl","$tracking_unique_sales_order_io.png","S","3","3");
?>
<?php
$invoice .= "<strong>".domain."</strong>";
$invoice .= "<br>";
$invoice .= "<strong>".adminEmail."</strong>";
$invoice .= "<br>";
$invoice .= "<strong>".adminMobile."</strong>";
$invoice .= "<br>";
$invoice .= "<img src='$tracking_unique_sales_order_io.png' />";
?>
<?php endforeach; } ?>
<?php endforeach; } ?>
<?php
$invoice .= "</div>";
$invoice .= "<div class='col-xs-12 col-md-8'>";
$invoice .= "<div class='col-xs-12 col-md-12'>";
$invoice .= "<strong>BILL TO</strong>";
$invoice .= "</div>";
?>
<?php $objShipTo = new ebapps\bay\ebcart(); $objShipTo -> client_view_invoice_shipment_to(); ?>
<?php if($objShipTo->eBData){ foreach($objShipTo->eBData as $val): extract($val); ?>
<?php
//
$invoice .= "<div class='col-xs-12 col-md-3'>";
$invoice .= "<strong>INVOICE ID</strong>";
$invoice .= "</div>";
$invoice .= "<div class='col-xs-12 col-md-9'>";
$invoice .= "<input value='$tracking_unique_sales_order_io' class='form-control input-sm' disabled />";
$invoice .= "</div>";
//
$invoice .= "<div class='col-xs-12 col-md-3'>";
$invoice .= "<strong>Date</strong>";
$invoice .= "</div>";
$invoice .= "<div class='col-xs-12 col-md-9'>";
$invoice .= "<input value='$sdate_io' class='form-control input-sm' disabled />";
$invoice .= "</div>";
//
$invoice .= "<div class='col-xs-12 col-md-3'>";
$invoice .= "<strong>Name</strong>";
$invoice .= "</div>";
$invoice .= "<div class='col-xs-12 col-md-9'>";
$invoice .= "<input value='$full_name_sa' class='form-control input-sm' disabled />";
$invoice .= "</div>";
//
$invoice .= "<div class='col-xs-12 col-md-3'>";
$invoice .= "<strong>Address</strong>";
$invoice .= "</div>";
$invoice .= "<div class='col-xs-12 col-md-9'>";	
$invoice .= "<input value='$address_line_1_sa' class='form-control input-sm' disabled />";
$invoice .= "</div>";
$invoice .= "<div class='col-xs-12 col-md-3'>";
$invoice .= "</div>";
$invoice .= "<div class='col-xs-12 col-md-9'>";	
$invoice .= "<input value='$address_line_2_sa' class='form-control input-sm' disabled />";
$invoice .= "</div>";
$invoice .= "<div class='col-xs-12 col-md-3'>";
$invoice .= "<strong>City</strong>";
$invoice .= "</div>";
$invoice .= "<div class='col-xs-12 col-md-9'>";	
$invoice .= "<input value='$city_town_sa' class='form-control input-sm' disabled />";
$invoice .= "</div>";
$invoice .= "<div class='col-xs-12 col-md-3'>";
$invoice .= "<strong>State</strong>";
$invoice .= "</div>";
$invoice .= "<div class='col-xs-12 col-md-9'>";	
$invoice .= "<input value='$state_province_region_sa' class='form-control input-sm' disabled />";
$invoice .= "</div>";
$invoice .= "<div class='col-xs-12 col-md-3'>";
$invoice .= "<strong>Postal Code</strong>";
$invoice .= "</div>";
$invoice .= "<div class='col-xs-12 col-md-9'>";	
$invoice .= "<input value='$postal_code_sa' class='form-control input-sm' disabled />";
$invoice .= "</div>";
$invoice .= "<div class='col-xs-12 col-md-3'>";
$invoice .= "<strong>Country</strong>";
$invoice .= "</div>";
$invoice .= "<div class='col-xs-12 col-md-9'>";	
$invoice .= "<input value='$country_sa' class='form-control input-sm' disabled />";
$invoice .= "</div>";
$invoice .= "<div class='col-xs-12 col-md-3'>";
$invoice .= "<strong>Phone</strong>";
$invoice .= "</div>";
$invoice .= "<div class='col-xs-12 col-md-9'>";	
$invoice .= "<input value='$phone_mobile_sa' class='form-control input-sm' disabled />";
$invoice .= "</div>";
$invoice .= "</div>";
$invoice .= "</div>";
?>
<?php endforeach; } ?>
<?php
$invoice .= "<div class='row'>";
$invoice .= "<div class='col-xs-12 col-md-12 eb-center'>";
$invoice .= "<h2>Item Details</h2>";
$invoice .= "</div>";
$invoice .= "</div>";
$invoice .= "<div class='row'>";
$invoice .= "<div class='col-xs-12 col-md-12'>";
$invoice .= "<div class='table-responsive'>";
$invoice .= "<table class='table table-bordered'>";
$invoice .= "<thead>";
$invoice .= "<tr>";
$invoice .= "<th>Seller</th>";
$invoice .= "<th>Item</th>";
$invoice .= "<th>ID</th>";
$invoice .= "<th>Size</th>";
$invoice .= "<th>Price</th>";
$invoice .= "<th>Qty</th>";
$invoice .= "<th>Total</th>";
$invoice .= "</tr>";
$invoice .= "</thead>";
$invoice .= "<tbody>";
?>
<?php $objProdect = new ebapps\bay\ebcart(); $objProdect -> client_view_invoice(); ?>
<?php if($objProdect->eBData){ foreach($objProdect->eBData as $val): extract($val); ?>
<?php
$invoice .= "<tr align='right'>";
$invoice .= "<td>$username_merchant_io</td>";
$invoice .= "<td><a href='".outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id_io/'>";
?>
<?php $objThurmbnail = new ebapps\bay\ebcart(); $objThurmbnail -> client_view_invoice_product_sml_image($bay_showroom_approved_items_id_io); ?>
<?php if($objThurmbnail->eBData){ foreach($objThurmbnail->eBData as $val): extract($val); ?>
<?php
$invoice .= "<img class='img-responsive' src='";
if(hypertext.$s_og_small_image_url)
{
$invoice .= hypertext."$s_og_small_image_url";
}
$invoice .= "' />";
?>
<?php endforeach; } ?>
<?php
$invoice .= "</a></td>";
$invoice .= "<td><a href='".outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id_io/'>$bay_showroom_approved_items_id_io</a></td>"; 
$invoice .= "<td><input value='$size_io' class='form-control input-sm' size='50' disabled /></td>";
$price = $item_total_price_io/$sqtn_io;
$invoice .= "<td><input value='$price' class='form-control input-sm' size='100' disabled /></td>";
$invoice .= "<td><input value='$sqtn_io' class='form-control input-sm' size='50' disabled /></td>";
$invoice .= "<td><input value='$item_total_price_io' class='form-control input-sm' size='150' disabled /></td>";
$invoice .= "</tr>";
?>
<?php endforeach; } ?>
<?php
$invoice .= "<tr align='right'>";
$invoice .= "<td colspan='6'><b>Subtotal (Refundable)</b>:</td>";
?>
<?php $obj = new ebapps\bay\ebcart(); $obj -> client_view_invoice_sum_of_vat_shipment_total(); ?>
<?php if($obj->eBData){ foreach($obj->eBData as $val): extract($val); ?>
<?php
$invoice .= "<td><input value='$subTotal' class='form-control input-sm' size='50' disabled /></td>";
$invoice .= "</tr>";
$invoice .= "<tr align='right'>";
$invoice .= "<td colspan='6'>VAT/GST/TAX</td>";
$invoice .= "<td><input value='$taxVat' class='form-control input-sm' size='50' disabled /></td>";
$invoice .= "</tr>";
$invoice .= "<tr align='right'>";
$invoice .= "<td colspan='6'>Shipment Charges</td>";
$invoice .= "<td><input value='$ShiPPing' class='form-control input-sm' size='50' disabled /></td>";
$invoice .= "</tr>";
$invoice .= "<tr align='right'>";
$invoice .= "<td colspan='6'>Handling Charges</td>";
$invoice .= "<td><input value='$HandLing' class='form-control input-sm' size='50' disabled /></td>";
$invoice .= "</tr>";
$invoice .= "<tr align='right'>";
$invoice .= "<td colspan='6'><b>Grand Total</b></td>";
$grandTotal = $subTotal + $taxVat + $ShiPPing + $HandLing; 
$invoice .= "<td><input value='$grandTotal' class='form-control input-sm' size='150' disabled /></td>";
$invoice .= "</tr>";
$invoice .= "</tbody>";
$invoice .= "</table>";
$invoice .= "</div>";
$invoice .= "</div>";
$invoice .= "</div>";
$invoice .= "</div>";
$invoice .= "</div>";
echo $invoice;
?>
<?php endforeach; } ?>
<div class='col-xs-12 col-md-3 sidebar-offcanvas'>
<?php include_once ("bay-my-account.php"); ?>
</div>
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
