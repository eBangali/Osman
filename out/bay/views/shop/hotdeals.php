<?php
$objHot = new ebapps\bay\ebcart();
$objHot ->hotdeals(); 
if($objHot->eBData)
{
$pubObjHot ="<ul class='products-grid'>";
foreach($objHot->eBData as $valobjHot): extract($valobjHot);
$pubObjHot .="<li class='item col-xs-12'>";
$pubObjHot .="<div class='item-inner'>";
$pubObjHot .="<div class='item-img'>";
$pubObjHot .="<div class='item-img-info'><a class='product-image' title='".stripslashes($s_og_image_title)."' href='";
$pubObjHot .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$pubObjHot .="'><img alt='".stripslashes($s_og_image_title)."' src='";
if(hypertextWithOrWithoutWww.$s_og_small_image_url)
{
$pubObjHot .=hypertextWithOrWithoutWww.$s_og_small_image_url;
}
$pubObjHot .="'></a>";
if($salse >= 1){
$pubObjHot .="<div class='sale-label sale-top-left'>Hot Deal</div>";
}
if($salse <= 1000){
$pubObjHot .="<div class='new-label new-top-right'>New</div>";
}
$pubObjHot .="<div class='box-hover'>";
$pubObjHot .="<ul class='add-to-links'>";
$pubObjHot .="<li><a class='link-quickview' href='";
$pubObjHot .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$pubObjHot .="'>Quick View</a></li>";
$pubObjHot .="<li><a class='link-wishlist' href='";
$pubObjHot .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$pubObjHot .="'>Wishlist</a></li>";
$pubObjHot .="<li><a class='link-compare' href='";
$pubObjHot .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$pubObjHot .="'>Compare</a></li>";
$pubObjHot .="</ul>";
$pubObjHot .="</div>";
$pubObjHot .="</div>";
$pubObjHot .="</div>";
$pubObjHot .="<div class='item-info'>";
$pubObjHot .="<div class='info-inner'>";
$pubObjHot .="<div class='item-title'><a title='".stripslashes($s_og_image_title)."' href='";
$pubObjHot .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$pubObjHot .="'>".stripslashes($s_og_image_title)."</a></div>";
$pubObjHot .="<div class='item-content'>";
$pubObjHot .="<div class='rating'>";
$pubObjHot .="<div class='ratings'>";
$pubObjHot .="<div class='rating-box'>";
$porductRating = new ebapps\bay\ebcart();
$porductRating ->bay_count_of_buyer_rating($bay_showroom_approved_items_id);
if($porductRating->eBData)
{
foreach($porductRating->eBData as $valporductRating): extract($valporductRating);
$pubObjHot .="<div style='width:";
$pubObjHot .=number_format($bay_quality_rating,0,".","");
$pubObjHot .="%' class='rating'></div>";
endforeach;
}
$pubObjHot .="</div>";
$pubObjHot .="</div>";
$pubObjHot .="</div>";
$pubObjHot .="<div class='item-price'>";
$pubObjHot .="<div class='price-box'><span class='regular-price'> <span class='price'>";
$pubObjHot .="".primaryCurrency." ".number_format($discountprice,2,".","");
$pubObjHot .="</span></span></div>";
//
$pubObjHot .="<div class='price-box'><span class='regular-price'> <span class='price'>";
if($s_size != 'NA')
{
$pubObjHot .=$this->visulString($s_size);
}
if($salse > 0)
{
$pubObjHot .=" ($salse)";
}
$pubObjHot .="</span></span></div>";
$pubObjHot .="</div>";
//
$pubObjHot .="<div class='action'>";
if(isset($_SESSION['cart'][$bay_showroom_approved_items_id]))
{
foreach($_SESSION['cart'] as $id => $qty):$product = $this-> product($bay_showroom_approved_items_id);
if($id == $bay_showroom_approved_items_id)
{
$pubObjHot .="<form method='post'>";
$pubObjHot .="<button name='reducedPageItem' class='eBCartReduceItem' type='submit'><i class='fa fa-minus'>&nbsp;</i></button>";
$pubObjHot .="<input type='hidden' name='id' value='$bay_showroom_approved_items_id' />";
$pubObjHot .="<input type='text' class='eBCartQtn' title='Qty' name='qtnPageMore' value='$qty'>";
$pubObjHot .="<button name='increasePageItem' class='eBCartIncreaseItem' type='submit'><i class='fa fa-plus'>&nbsp;</i></button>";
$pubObjHot .="</form>";
}
endforeach;
}
else
{
$pubObjHot .="<form method='post'>";
$pubObjHot .="<input type='hidden' name='qtnPage' value='1'>";
$pubObjHot .="<input type='hidden' name='id' value='$bay_showroom_approved_items_id'>";
$pubObjHot .="<button type='submit' name='add' class='eBCartAddItem' title='Add to Cart'>Add to  <i class='fa fa-shopping-cart'>&nbsp;</i></button>";
$pubObjHot .="</form>";
}
$pubObjHot .="</div>";
$pubObjHot .="</div>";
$pubObjHot .="</div>";
$pubObjHot .="</div>";
$pubObjHot .="</div>";
$pubObjHot .="</li>";
endforeach;
//////////
$pubObjHot .="</ul>";
echo $pubObjHot;
}
?>