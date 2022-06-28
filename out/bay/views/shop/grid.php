<?php include_once (dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/initialize.php'); ?>
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
<?php include_once('breadcrumbs-grid.php'); ?>
<?php include_once('search.php'); ?>
<?php include_once (eblayout."/a-common-ad-body.php"); ?>
<section class='main-container col2-left-layout bounceInUp animated'>
  <div class='container'>
    <div class='row'>
      <div class='col-sm-9 col-sm-push-3'>
        <?php include_once('gridCarousel.php'); ?>
        <?php include_once('artical_grid.php'); ?>
      </div>
      <div class='col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9'>
        <?php include_once('categoryNavbar.php'); ?>
        <?php include_once('priceAndDiscountSelectiongrid.php'); ?>
      </div>
    </div>
  </div>
</section>
<!-- You may looking For Chouse one of them -->
<?php //include_once('item-thurmnai-category-b-ux-one.php'); ?>
<?php include_once('item-thurmnai-category-b-ux-one_per_6.php'); ?>
<?php include_once (eblayout."/a-common-footer.php"); ?>
