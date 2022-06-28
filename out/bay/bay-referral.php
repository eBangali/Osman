<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php
include_once(ebbd.'/dbconfig.php');
$adMin = new ebapps\dbconnection\dbconfig();
if(isset($adMin->eBAdminUserIsSet))
{
?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<meta property='og:image:url' content='<?php echo themeResource; ?>/images/reffer-friends.jpg' />
<meta property='og:image:type' content='image/jpeg' />
<meta property='og:image:width' content='1366' />
<meta property='og:image:height' content='956' />
<meta property='og:title' content='Refer friend to buy from us' />
<meta property='og:description' content='Refer friend to buy from us' />

<meta name='twitter:card' content='summary_large_image'>
<meta name='twitter:site' content='@eBangali'>
<meta name='twitter:domain' content='ebangali.com'/>
<meta name='twitter:creator' content='@eBangali'>
<meta name='twitter:title' content='Refer friend to buy from us'>
<meta name='twitter:description' content='Refer friend to buy from us'>
<meta name='twitter:image' content='<?php echo themeResource; ?>/images/reffer-friends.jpg'/>
<meta name='twitter:url' content='<?php echo fullUrl; ?>'>

<title>Refer friend to buy from us</title>
<meta name='description' content='Refer friend to buy from us' />
<?php include_once (eblogin.'/session.inc.php'); ?>
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
<?php include_once (ebaccess.'/access_permission_online_minimum.php'); ?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>

</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<div class="well">
<h2 title='Referral URL'>Referral URL</h2>
<p><b>For easy referral social share your URLs</b></p>
</div>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php $obj= new ebapps\bay\ebcart(); $obj -> bayProductRefAll();
if($obj->eBData > 0)
{
foreach($obj->eBData as $val): extract($val);
$bayReferral ="<div class='row'>";
$bayReferral .="<div class='col-xs-12 col-md-4'>";
$bayReferral .="<b><a title='".$s_og_image_title."' href='";
$bayReferral .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$bayReferral .="'>";
$bayReferral .=$obj->visulString($s_og_image_title);
$bayReferral .="</a></b>";
if(file_exists(str_replace(hostingName, docRoot, hypertextWithOrWithoutWww.$s_og_image_url))) {
$bayReferral .="<br>";
$bayReferral .="<a title='".$s_og_image_title."' href='";
$bayReferral .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$bayReferral .="'>";
$bayReferral .="<img class='img-responsive' alt='".$s_og_image_title."' src='";
$bayReferral .=hypertextWithOrWithoutWww."$s_og_image_url";
$bayReferral .="'>";
$bayReferral .="</a>";
}
$bayReferral .="<br>";
//
$countComment = new ebapps\bay\ebcart();
$countComment ->count_total_wishLike($bay_showroom_approved_items_id);
if($countComment->eBData)
{
foreach($countComment->eBData as $valcountComment): extract($valcountComment);
$bayReferral .="<i class='fa fa-heart'></i>  ";
$bayReferral .=$totalProductLikes;
endforeach;
}
$bayReferral .="</div>";
//
$bayReferral .="<div class='col-xs-12 col-md-8'>";
if(file_exists(str_replace(hostingName, docRoot, hypertextWithOrWithoutWww.$s_og_image_url))) {
$bayReferral .="<textarea class='form-control' rows='3'>";
$bayReferral .="<a ";
$bayReferral .="title='$s_og_image_title' href='";
$bayReferral .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/".$_SESSION['ebusername']."/";
$bayReferral .="'>";
$bayReferral .="<img alt='".strtoupper($s_og_image_title)."' ";
$bayReferral .="src='";
$bayReferral .=hypertextWithOrWithoutWww.$s_og_image_url;
$bayReferral .="'>";
$bayReferral .=$obj->visulString($s_og_image_title);
$bayReferral .="</a>";
$bayReferral .="</textarea>";
}
//
$bayReferral .="<textarea class='form-control' rows='3'>";
$bayReferral .="<a href='";
$bayReferral .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/".$_SESSION['ebusername']."/";
$bayReferral .="'>";
$bayReferral .=$obj->visulString($s_og_image_title);
$bayReferral .="</a>";
$bayReferral .="</textarea>";
$bayReferral .="</div>";
$bayReferral .="</div>";
echo $bayReferral;
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
