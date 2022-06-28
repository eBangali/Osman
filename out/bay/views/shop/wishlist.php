<?php include_once (dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/initialize.php'); ?>
<?php include_once (dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/error-testing.php'); ?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-index-follow.php'); ?>
<?php include_once (ebproduct.'/views/shop/seo.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts-below-body-facebook.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts.php'); ?>
<?php include_once (eblayout.'/a-common-page-id-start.php'); ?>
<?php include_once (eblogin."/session.inc.php"); ?>
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
<?php include_once (ebaccess."/access_permission_online_minimum.php"); ?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>
<?php include_once (eblayout.'/a-common-ad-left.php'); ?>
</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<div class="well">
<h2 title='Likelist'>Likelist</h2>
</div>
<?php $objWhisToBuy = new ebapps\bay\ebcart(); $objWhisToBuy -> wishToBuyBayAll();
if($objWhisToBuy->eBData > 0)
{
foreach($objWhisToBuy->eBData as $valObjWhisToBuy): extract($valObjWhisToBuy);
$likeList ="<div class='row'>";
$likeList .="<div class='col-xs-12 col-md-4'>";
$likeList .="<b><a title='".$s_og_image_title."' href='";
$likeList .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$likeList .="'>";
$likeList .=$s_og_image_title;
$likeList .="</a></b>";
if(file_exists(str_replace(hostingName, docRoot, hypertextWithOrWithoutWww.$s_og_small_image_url))) {
$likeList .="<br>";
$likeList .="<a title='".$s_og_image_title."' href='";
$likeList .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$likeList .="'>";

$likeList .="<img class='img-responsive' alt='".$s_og_image_title."' src='";
$likeList .=hypertextWithOrWithoutWww."$s_og_small_image_url";
$likeList .="'>";
$likeList .="</a>";
}
$likeList .="<br>";
//
$countComment = new ebapps\bay\ebcart();
$countComment ->count_total_wishLike($bay_showroom_approved_items_id);
if($countComment->eBData)
{
foreach($countComment->eBData as $valcountComment): extract($valcountComment);
$likeList .="<i class='fa fa-heart'></i>  ";
$likeList .=$totalProductLikes;
endforeach;
}
$likeList .="</div>";
//
$likeList .="<div class='col-xs-12 col-md-8'>";
$likeList .=$s_og_image_description;
$likeList .="</div>";
$likeList .="</div>";
endforeach;
echo $likeList;
}
?>
</div>
<div class='col-xs-12 col-md-3 sidebar-offcanvas'>
<?php include_once ("bay-my-account.php"); ?>
</div>
</div>
</div>
<?php include_once (eblayout."/a-common-footer.php"); ?>
