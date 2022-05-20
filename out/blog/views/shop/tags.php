<?php include_once (dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/initialize.php'); ?>
<?php include_once (ebblog.'/blog.php'); ?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-index-follow.php'); ?>
<?php include_once (ebcontents.'/views/shop/seotag.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts-below-body-facebook.php'); ?> 
<?php include_once (eblayout.'/a-common-header-meta-google-adsense-blog.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts.php'); ?>
<?php include_once (eblayout.'/a-common-page-id-start.php'); ?>
<?php include_once (eblayout.'/a-common-header.php'); ?>
<nav>
  <div class='container'>
    <div>
      <?php include_once (eblayout.'/a-common-navebar.php'); ?>
      <?php include_once (eblayout.'/a-common-navebar-index-blog.php'); ?>
    </div>
  </div>
</nav>
<?php include_once (eblayout.'/a-common-page-id-end.php'); ?>
<?php include_once ('breadcrumbs.php'); ?>
<?php include_once (eblayout."/a-common-share-button-for-blog.php"); ?>
<?php include_once('search.php'); ?>
<?php include_once (eblayout.'/a-common-ad-any-body-blog.php'); ?>
<section class='contentIndex'>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>
</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<?php include_once("post-header.php"); ?>
<?php include_once("post-details-tags.php"); ?>
</div>
<div class='col-right sidebar col-md-3 col-xs-12'>
<?php include_once('rightWidgetForCategory.php'); ?>
<?php include_once("rightWidgetForPostCategory.php"); ?>
</div>
</div>
</div>
</section>
<?php include_once("category-thumbnail.php"); ?>
<?php include_once (eblayout.'/a-common-footer.php'); ?>