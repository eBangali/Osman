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
<div class='col-xs-12 col-md-9 sidebar-offcanvas'>
<div class="well">
<h2 title='Admin Check Return And Refund'> Admin Check Return And Refund</h2>
</div>
<div class='well'>
<article>
<div class="panel panel-default table-responsive">
<table class="table">
<thead>
<tr>
<th>CLIENT</th>
<th>MERCNANT</th>
<th>ID</th>
<th>P.QTN</th>
<th>RECEIVED.ITEM</th>
<th>REFUND.AMOUNT</th>
<th>R.QTN</th>
<th>STATUS</th>
<th>REFUNDED</th>
<th>CURRENCY</th>
</tr>
</thead>
<tbody>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php $obj= new ebapps\bay\ebcart(); $obj -> admin_check_return_refund(); ?>
<?php if($obj->eBData){ foreach($obj->eBData as $val): extract($val); ?>
<?php 
$zoneDhl = "<tr>";					 
$zoneDhl .= "<td>$username_buyer_rrg</td>";
$zoneDhl .= "<td>$username_merchant_rrg</td>";
$zoneDhl .= "<td><a href='".outBayLink."/product/item-details-grid/$bay_product_id_in_returns_refunds_crm/'>$bay_product_id_in_returns_refunds_crm</a></td>";
$zoneDhl .= "<td>$total_qtn_crm</td>";
$zoneDhl .= "<td>$received_return_item</td>";
$zoneDhl .= "<td>$total_refund_with_shipment_without_texvat</td>";					 
$zoneDhl .= "<td>$return_qtn_crm</td>";
$zoneDhl .= "<td>$request_status</td>";
$zoneDhl .= "<td>$return_refund_total_crm</td>";
$zoneDhl .= "<td>$payment_currency</td>";
$zoneDhl .= "</tr>";
echo $zoneDhl;
endforeach;
}
?>    
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