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
<h2 title='bKash Payment Verify From History'>bKash Payment Verify From History</h2>
<p><b>If anybody submitted wrong Transaction ID but really paid just approve.</b></p>
</div>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php
if(isset($_REQUEST['option_bkash_payment_approve']))
{
extract($_REQUEST);
$obj = new ebapps\bay\ebcart();
$obj->bay_approve_bkash_payment($username_buyer_bk, $order_tracking_unique_bk, $bkash_tranjaction_id_bk);
}
?>
<?php
$obj = new ebapps\bay\ebcart();
$obj->bay_bKash_payment_verify_admin_no_ok();
if($obj->eBData >= 1)
{
foreach($obj->eBData as $val):
{
extract($val);
$fortbkashverify = "<div class='well'>";
$fortbkashverify .= "<form method='post'>";
$fortbkashverify .= "<fieldset class='group-select'>";
$fortbkashverify .= "Buyer Username: $username_buyer_bk <input type='hidden' name='username_buyer_bk' value='$username_buyer_bk' />";
$fortbkashverify .= "Transaction Group Tracking: $order_tracking_unique_bk  <input type='hidden' name='order_tracking_unique_bk' value='$order_tracking_unique_bk' />";

$fortbkashverify .= "bKash Transaction ID: <b>$bkash_tranjaction_id_bk</b> <input type='hidden' name='bkash_tranjaction_id_bk' value='$bkash_tranjaction_id_bk' />";

$fortbkashverify .= "Grand Total ".secondaryCurrency.": $grand_total_price_bk";
$fortbkashverify .= "bKash Payment Date: $payment_date_bk";
$fortbkashverify .= "<div class='buttons-set'>
<button type='submit' name='option_bkash_payment_approve' title='APPROVE' class='button submit'> <span> APPROVE </span> </button>
</div>";
$fortbkashverify .= "</fieldset>";
$fortbkashverify .= "</form>";
$fortbkashverify .= "</div>";
echo $fortbkashverify;
}
endforeach;
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
