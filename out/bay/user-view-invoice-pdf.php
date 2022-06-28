<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php
include_once(ebbd.'/dbconfig.php');
$adMin = new ebapps\dbconnection\dbconfig();
if(isset($adMin->eBAdminUserIsSet))
{
?>
<?php include_once (eblogin.'/session.inc.php'); ?>
<?php include_once (ebaccess.'/access_permission_online_minimum.php'); ?>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php include_once (ebfpdf.'/fpdf.php'); ?>
<?php
$pdf = new ebapps\fpdf\FPDF('P','mm','A4');
$pdf->AliasNbPages('{pages}');
$pdf->SetAutoPageBreak(true, 15);
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(20,12,$pdf->Image(hypertextWithOrWithoutWww.domain.themeResource."/images/Logo.png", $pdf->GetX(), $pdf->GetY(),30),0,0,0,'',0);
$pdf->Ln();
$pdf->Cell(180,16,'INVOICE (PAID)',0,0,'C',0,'');
$pdf->Ln();
//
$invoiceNumDate = new ebapps\bay\ebcart();
$invoiceNumDate -> client_view_invoice_date_invoice_num_for_pdf();
if($invoiceNumDate->eBData)
{
foreach($invoiceNumDate->eBData as $valinvoiceNumDate): extract($valinvoiceNumDate);
$pdf->SetFont('Arial','',9);
$pdf->Cell(80,5,"INVOICE ID: ".$tracking_unique_sales_order_io,0,0);
$pdf->Ln();
$pdf->Cell(80,5,"Date: ".$sdate_io,0,0);
$pdf->Ln();
endforeach;
}
//
$objShipTo = new ebapps\bay\ebcart();
$objShipTo -> client_view_invoice_shipment_to_pdf();
if($objShipTo->eBData)
{
foreach($objShipTo->eBData as $valobjShipTo): extract($valobjShipTo);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(80,5,"BILL TO:",0,0);
$pdf->Ln();
$pdf->SetFont('Arial','',9);
$pdf->Cell(80,5,"Name: ".$full_name_sa,0,0);
$pdf->Ln();
$pdf->Cell(80,5,"Address: ".$address_line_1_sa,0,0);
$pdf->Ln();
$pdf->Cell(80,5,$address_line_2_sa,0,0);
$pdf->Ln();
$pdf->Cell(80,5,"City: ".$city_town_sa,0,0);
$pdf->Ln();
$pdf->Cell(80,5,"State: ".$state_province_region_sa,0,0);
$pdf->Ln();
$pdf->Cell(80,5,"Postal Code: ".$postal_code_sa,0,0);
$pdf->Ln();
$pdf->Cell(80,5,"Country: ".$country_sa,0,0);
$pdf->Ln();
$pdf->Cell(80,5,"Phone: ".$phone_mobile_sa,0,0);
endforeach;
}
$pdf->Ln();
$pdf->SetFont('Arial','B',9);
$pdf->Cell(40,5,'Product Details',0,0,'L',0,'');
$pdf->Ln();
$pdf->SetFont('Arial','',9);
$pdf->Cell(40,5,'Seller',1,0);
$pdf->Cell(20,5,'Image',1,0);
$pdf->Cell(20,5,'ID',1,0);
$pdf->Cell(15,5,'Size',1,0);
$pdf->Cell(25,5,'Price',1,0);
$pdf->Cell(20,5,'Qty',1,0);
$pdf->Cell(40,5,'Total',1,0);
$pdf->Ln();
$objProdect = new ebapps\bay\ebcart();
$objProdect -> pdf_view_invoice();
if($objProdect->eBData)
{
foreach($objProdect->eBData as $val): extract($val);
$pdf->SetFont('Arial','',9);
$pdf->Cell(40,14,$username_merchant_io,1,0);
$objProdectImg = new ebapps\bay\ebcart();
$objProdectImg -> pdf_view_invoice_small_imag($bay_showroom_approved_items_id_io);
if($objProdectImg->eBData)
{
foreach($objProdectImg->eBData as $valObjProdectImg): extract($valObjProdectImg);
$pdf->Cell(20,14,$pdf->Image(hypertextWithOrWithoutWww.$s_og_small_image_url, $pdf->GetX(), $pdf->GetY(),20),0,0,0,'',0);
endforeach;
}
$pdf->Cell(20,14,$bay_showroom_approved_items_id_io,1,0);
$pdf->Cell(15,14,$size_io,1,0);
$price = $item_total_price_io/$sqtn_io;
$pdf->Cell(25,14,$price,1,0);
$pdf->Cell(20,14,$sqtn_io,1,0);
$pdf->Cell(40,14,$item_total_price_io,1,0);
$pdf->Ln();
endforeach;
}
//
$objProdectTotal = new ebapps\bay\ebcart();
$objProdectTotal -> client_view_invoice_sum_of_vat_shipment_total_for_pdf();
if($objProdectTotal->eBData)
{
foreach($objProdectTotal->eBData as $valobjProdectTotal): extract($valobjProdectTotal);
$pdf->SetFont('Arial','',9);
$pdf->Cell(140,5,"Subtotal (Refundable): ",1,0,'R',0,'');
$pdf->Cell(40,5,$subTotal,1,0,'R',0,'');
$pdf->Ln();
$pdf->SetFont('Arial','',9);
$pdf->Cell(140,5,"VAT/GST/TAX: ",1,0,'R',0,'');
$pdf->Cell(40,5,$taxVat,1,0,'R',0,'');
$pdf->Ln();
$pdf->SetFont('Arial','',9);
$pdf->Cell(140,5,"Shipment Charges: ",1,0,'R',0,'');
$pdf->Cell(40,5,$ShiPPing,1,0,'R',0,'');
$pdf->Ln();
$pdf->SetFont('Arial','',9);
$pdf->Cell(140,5,"Handling Charges: ",1,0,'R',0,'');
$pdf->Cell(40,5,$HandLing,1,0,'R',0,'');
$pdf->Ln();
$grandTotal = $subTotal + $taxVat + $ShiPPing + $HandLing; 
$pdf->SetFont('Arial','B',9);
$pdf->Cell(140,5,"Grand Total: ",1,0,'R',0,'');
$pdf->Cell(40,5,$grandTotal,1,0,'R',0,'');
$pdf->Ln();
endforeach;
}
//
$pdf->Output();
?>
<?php
}
else
{
header("Location: ".outLink."/access/admin-register.php");
}
?>
