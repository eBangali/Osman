<?php include_once ('initialize.php'); ?>
<?php
include_once(ebbd.'/dbconfig.php');
$adMin = new ebapps\dbconnection\dbconfig();
if(isset($adMin->eBAdminUserIsSet))
{
?>
<?php
include_once (ebbay."/ebcart.php");
$obj= new ebapps\bay\ebcart();
$obj ->ecart();
?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-index-follow.php'); ?>
<?php include_once (ebproduct.'/views/shop/seo.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts-below-body-facebook.php'); ?>
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
<?php include_once (ebproduct.'/views/shop/breadcrumbs-grid.php'); ?>
<?php include_once (ebproduct.'/views/shop/search.php'); ?>
<?php include_once (ebproduct.'/views/shop/carouselBranding.php'); ?>
<?php //include_once (ebproduct.'/views/shop/carouselAndHotDeal.php'); ?>
<?php //include_once (ebproduct.'/views/shop/group-all-products.php'); ?>
<?php include_once (ebproduct.'/views/shop/group-all-products_per_6.php'); ?>
<?php //include_once (ebproduct.'/views/shop/best-sales.php'); ?>
<?php include_once (ebproduct.'/views/shop/best-sales_per_6.php'); ?>
<?php include_once (ebproduct.'/views/shop/features-box.php'); ?>
<?php include_once (ebproduct.'/views/shop/features-mobile-box.php'); ?>
<?php //include_once (ebproduct.'/views/shop/max_discount.php'); ?>
<?php include_once (ebproduct.'/views/shop/max_discount_per_6.php'); ?>
<?php include_once (eblayout.'/a-common-footer.php'); ?>
<?php
}
else
{
header("Location: ".outLink."/access/admin-register.php");
}
?>
