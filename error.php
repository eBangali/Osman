<?php
include_once ('initialize.php');
include_once(ebbd.'/dbconfig.php');
$adMin = new ebapps\dbconnection\dbconfig();
if(isset($adMin->eBAdminUserIsSet))
{
?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-nofollow.php'); ?>
<?php include_once (ebOutSoft.'/views/shop/seo.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts-below-body-facebook.php'); ?> 
<?php include_once (eblayout.'/a-common-header-meta-noindex.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts.php'); ?>
<?php include_once (eblayout.'/a-common-page-id-start.php'); ?>
<?php include_once (eblayout.'/a-common-header.php'); ?>
<nav>
  <div class='container'>
    <div>
      <?php include_once (eblayout.'/a-common-navebar.php'); ?>
      <?php include_once (eblayout.'/a-common-navebar-index-soft.php'); ?>
    </div>
  </div>
</nav>
<?php include_once (eblayout.'/a-common-page-id-end.php'); ?>
<section class='content-wrapper'>
<div class='container'>
<div class='std'>
<div class='page-not-found'>
<p><img src='<?php echo themeResource; ?>/images/signal.png'>Oops! The Page you requested was not found!</p>
<div><a href='<?php echo hostingAndRoot; ?>/index.php' type='button' class='btn-home'><span>Back To Home</span></a></div>
</div>
</div>
</div>
</section>
<?php include_once (ebOutSoft.'/views/shop/search.php'); ?>
<div class='container'>
<div class='row'>
<?php include_once (ebOutSoft.'/views/shop/thumbnail.php'); ?> 
<?php include_once (ebOutSoft.'/views/shop/thumbnail-pagination.php'); ?>
<?php include_once (ebOutSoft.'/views/shop/features-mobile-box.php'); ?>
</div>
</div>
<?php include_once (eblayout.'/a-common-footer.php'); ?>
<?php
}
else
{
header("Location: ".outLink."/access/admin-register.php");
}
?>
