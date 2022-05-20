<?php
include_once('initialize.php');
include_once(ebbd.'/dbconfig.php');
$adMin = new ebapps\dbconnection\dbconfig();
if(isset($adMin->AdminUserIsSet))
{
?>
<?php include_once (ebblog.'/blog.php'); ?>
<?php
$obj= new ebapps\blog\blog();
$obj ->blog_control();
?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<?php include_once (ebcontents.'/views/shop/seo.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts-below-body-facebook.php'); ?> 
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
<?php include_once (ebcontents.'/views/shop/search.php'); ?>
<?php include_once (ebcontents.'/views/shop/carousel.php'); ?>
<section class='contentIndex'>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>
<?php include_once (eblayout.'/a-common-ad-left.php'); ?>
</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<?php include_once (ebcontents.'/views/shop/indexAllPost.php'); ?>
</div>
<div class='col-right sidebar col-md-3 col-xs-12'>
<?php include_once (ebcontents.'/views/shop/rightWidgetForPost.php'); ?>
</div>
</div>
<?php include_once (ebcontents.'/views/shop/video.php'); ?>
</div>
</section>
<?php include_once (eblayout.'/a-common-footer.php'); ?>
<?php
}
else
{
header("Location: ".outLink."/access/admin-register.php");
}
?>
