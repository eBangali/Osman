<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php
include_once(ebbd.'/dbconfig.php');
$adMin = new ebapps\dbconnection\dbconfig();
if(isset($adMin->eBAdminUserIsSet))
{
?>
<?php include_once (eblogin.'/session.inc.php'); ?>
<aside class='col-right sidebar wow bounceInUp animated'>
<div class='block block-account'>
<div class='block-title'>eCommerce Settings</div>
<div class='block-content'>
<ul>
<?php if ($_SESSION['memberlevel'] >= 1) { ?>
<li><a href='<?php echo outBayLink; ?>/product/'><i class='fa fa-shopping-basket fa-lg' aria-hidden='true'></i> Shop</a></li>
<li><a href='<?php echo outBayLink; ?>/user-purchase-history.php' title='Purchase History'><i class='fa fa-list-alt fa-lg' aria-hidden='true'></i> Purchase History</a></li>
<li><a href='<?php echo outBayLink; ?>/returns-refunds.php' title='Return And Refund'><i class='fa fa-retweet fa-lg' aria-hidden='true'></i> Return And Refund</a></li>
<li><a href='<?php echo outBayLink; ?>/bay-referral.php' title='Referral URL'><i class='fa fa-user-plus fa-lg' aria-hidden='true'></i> Referral URL</a></li>
<?php } ?>
<?php if ($_SESSION['memberlevel'] >= 9) { ?>
<li><a href='<?php echo outBayLink; ?>/admin-check-vat-tax-to-return.php' title='VAT/GST/TAX Amount'><i class='fa fa-retweet fa-lg' aria-hidden='true'></i> VAT/GST/TAX Amount</a></li>
<li><a href='<?php echo outBayLink; ?>/admin-check-returns-refunds.php' title='Admin Check Return And Refund'><i class='fa fa-retweet fa-lg' aria-hidden='true'></i> Admin Check Return And Refund</a></li>
<?php } ?>
<?php if ($_SESSION['memberlevel'] >= 8) { ?>
<li><a href='<?php echo outBayLink; ?>/merchant-returns-refunds.php' title='Merchant Return And Refund'><i class='fa fa-retweet fa-lg' aria-hidden='true'></i> Merchant Return And Refund</a></li>
<li><a href='<?php echo outBayLink; ?>/merchant-sales-history.php' title='Sales History'><i class='fa fa-history fa-lg' aria-hidden='true'></i> Sales History</a></li>
<?php } ?>
<?php if ($_SESSION['memberlevel'] >= 9) { ?>
<li><a href='<?php echo outBayLink; ?>/bay-bkash-payment-verify.php' title='bKash Payment Verify'><i class='fa fa-money fa-lg' aria-hidden='true'></i> bKash Payment Verify</a></li>
<li><a href='<?php echo outBayLink; ?>/dhl-export-rates-by-zone-and-product.php' title='DHL Rates'><i class='fa fa-truck fa-lg' aria-hidden='true'></i> DHL Rates</a></li>
<li><a href='<?php echo outBayLink; ?>/dhl-rating-zones.php' title='DHL Rating Zones'><i class='fa fa-bus fa-lg' aria-hidden='true'></i> DHL Rating Zones</a></li>
<li><a href='<?php echo outBayLink; ?>/bay-branding-status.php' title='Branding Status'><i class='fa fa-shield fa-lg' aria-hidden='true'></i> Branding Status</a></li>
<li><a href='<?php echo outBayLink; ?>/bay-branding.php' title='Branding Add New'><i class='fa fa-get-pocket fa-lg' aria-hidden='true'></i> Branding Add New</a></li>
<?php } ?>
<?php if ($_SESSION['memberlevel'] >= 9) { ?>
<li><a href='<?php echo outBayLink; ?>/bay-admin-view-of-merchants-items.php' title='Item Approval'><i class='fa fa-refresh fa-lg' aria-hidden='true'></i> Item Approval</a></li>
<li><a href='<?php echo outBayLink; ?>/bay-add-item-unit.php' title='Add Item Unit'><i class='fa fa-plus fa-lg' aria-hidden='true'></i> Add Item Unit</a></li>
<?php } ?>
<?php if ($_SESSION['memberlevel'] >= 8) { ?>
<li><a href='<?php echo outBayLink; ?>/bay-merchants-items-view.php' title='Item Status'><i class='fa fa-tasks fa-lg' aria-hidden='true'></i> Item Status</a></li>
<li><a href='<?php echo outBayLink; ?>/bay-merchant-add-items.php' title='Shop Add Item'><i class='fa fa-plus fa-lg' aria-hidden='true'></i> Shop Add Item</a></li>
<?php } ?>
<?php if ($_SESSION['memberlevel'] >= 9) { ?>
<li><a href='<?php echo outBayLink; ?>/bay-add-category-d.php' title='Add Category D'><i class='fa fa-database fa-lg' aria-hidden='true'></i> Add Category D</a></li>
<li><a href='<?php echo outBayLink; ?>/bay-add-category-c.php' title='Add Category C'><i class='fa fa-database fa-lg' aria-hidden='true'></i> Add Category C</a></li>
<li><a href='<?php echo outBayLink; ?>/bay-add-category-b.php' title='Add Category B'><i class='fa fa-database fa-lg' aria-hidden='true'></i> Add Category B</a></li>
<li class='last'><a href='<?php echo outBayLink; ?>/bay-add-category-a.php' title='Add Category A'><i class='fa fa-database fa-lg' aria-hidden='true'></i> Add Category A</a></li>
<?php } ?>
</ul>
</div>
</div>
</aside>
<?php
}
else
{
header("Location: ".outLink."/access/admin-register.php");
}
?>
