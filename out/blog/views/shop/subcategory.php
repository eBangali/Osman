<?php include_once (dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/initialize.php'); ?>
<?php include_once (ebblog.'/blog.php'); ?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-nofollow.php'); ?>
<?php include_once (ebcontents.'/views/shop/seo.php'); ?>
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
<section class='contentIndex'>
<?php
if($postApproveType == 'GPOST')
{
if(isset($_SESSION['memberlevel']))
{
if($_SESSION['memberlevel'] >= 1)
{
include_once("guest-subcategory-thumbnail.php");
}
}
else
{
include_once (eblogin."/session.inc.center.php");
}
}
elseif($postApproveType == 'OK')
{
include_once("subcategory-thumbnail.php");
}
else
{
?>
<script>
window.location.replace('/');
</script>
<?php
}
?>
</section>
<?php include_once (eblayout.'/a-common-footer.php'); ?>
