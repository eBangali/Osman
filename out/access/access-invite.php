<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php include_once (eblogin.'/session.inc.affiliate.php'); ?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<meta property='og:image:url' content='<?php echo themeResource; ?>/images/affiliate-marketing.jpg' />
<meta property='og:image:type' content='image/jpeg' />
<meta property='og:image:width' content='1024' />
<meta property='og:image:height' content='717' />
<meta property='og:title' content='Refer someone you know' />
<meta property='og:description' content='Refer someone you know' />
<meta name='twitter:card' content='summary_large_image'>
<meta name='twitter:site' content='@eBangali'>
<meta name='twitter:domain' content='ebangali.com'/>
<meta name='twitter:creator' content='@eBangali'>
<meta name='twitter:title' content='Refer someone you know'>
<meta name='twitter:description' content='Refer someone you know'>
<meta name='twitter:image' content='<?php echo themeResource; ?>/images/affiliate-marketing.jpg'/>
<meta name='twitter:url' content='<?php echo fullUrl; ?>'>
<title>Refer someone you know</title>
<meta name='description' content='Refer someone you know' />
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
<?php include_once (ebaccess.'/access_permission_omr_minimum.php'); ?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>
</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<!-- Level Starts -->
<div class='side-nav-categories'>
<div class='well'>
<h2 title='Refer Someone'>Refer Someone</h2>
</div>
<div class='box-content box-category'>
<ul>
<?php include_once (eblogin.'/registration_page.php'); ?>
<?php 
$count1stLevel = new ebapps\login\registration_page();
$count1stLevel ->countFirstLevelOfInvite();
if($count1stLevel->data)
{
foreach($count1stLevel->data as $count1stLevelval): extract($count1stLevelval);
echo "<b>Directly Invited : $countFirstLevelTotal</b>";
endforeach;
} 
?>
</ul>
</div> 
</div>
<!-- Level End -->
<?php 
if(isset($_SESSION['memberlevel']))
{
if($_SESSION['memberlevel'] >= 3)
{
include_once ("invitefnf.php");
}

}
?>
</div>
<div class='col-xs-12 col-md-3 sidebar-offcanvas'>
<?php include_once ("access-my-account.php"); ?>
</div>
</div>
</div>
<?php include_once (eblayout.'/a-common-footer.php'); ?>