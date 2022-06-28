<?php
$subCategoryProduct = new ebapps\bay\ebcart();
$subCategoryProduct ->item_thurmnai_category_b_100($productid, $sHowRoomID, $eBCategoryBB, $eBCategoryCC); 
if($subCategoryProduct->eBData)
{
$youMayLookingFor ="<div class='content-page'>";
$youMayLookingFor .="<div class='container'>"; 
$youMayLookingFor .="<div class='category-product'>";
$youMayLookingFor .="<div class='navbar nav-menu'>";
$youMayLookingFor .="<div class='navbar-collapse'>";
$youMayLookingFor .="<ul class='nav navbar-nav'>";
$youMayLookingFor .="<li>";
$youMayLookingFor .="<div class='new_title'>";
$youMayLookingFor .="<h2>You may looking For</h2>";
$youMayLookingFor .="</div>";
$youMayLookingFor .="</li>";
$youMayLookingFor .="</ul>";
$youMayLookingFor .="</div>";
$youMayLookingFor .="</div>";
$youMayLookingFor .="<div class='product-bestseller'>";
$youMayLookingFor .="<div class='product-bestseller-content'>";
$youMayLookingFor .="<div class='product-bestseller-list'>";
$youMayLookingFor .="<div class='tab-container'>";

$youMayLookingFor .="<div class='tab-panel active'>";
$youMayLookingFor .="<div class='category-products'>";
$youMayLookingFor .="<ul class='products-grid'>";
foreach($subCategoryProduct->eBData as $valsubCategoryProduct): extract($valsubCategoryProduct);

$youMayLookingFor .="<li class='item col-lg-3 col-md-3 col-sm-4 col-xs-12'>";
$youMayLookingFor .="<div class='item-inner'>";
$youMayLookingFor .="<div class='item-img'>";
$youMayLookingFor .="<div class='item-img-info'><a class='product-image' title='".stripslashes($s_og_image_title)."' href='";
$youMayLookingFor .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$youMayLookingFor .="'><img alt='".stripslashes($s_og_image_title)."' src='";
if(hypertextWithOrWithoutWww.$s_og_small_image_url)
{
$youMayLookingFor .=hypertextWithOrWithoutWww.$s_og_small_image_url;
}
$youMayLookingFor .="'></a>";
if($salse >= 1){
$youMayLookingFor .="<div class='sale-label sale-top-left'>Sale</div>";
}
if($salse <= 1000){
$youMayLookingFor .="<div class='new-label new-top-right'>New</div>";
}
$youMayLookingFor .="<div class='box-hover'>";
$youMayLookingFor .="<ul class='add-to-links'>";
$youMayLookingFor .="<li><a class='link-quickview' href='";
$youMayLookingFor .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$youMayLookingFor .="'>Quick View</a></li>";
$youMayLookingFor .="<li><a class='link-wishlist' href='";
$youMayLookingFor .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$youMayLookingFor .="'>Wishlist</a></li>";
$youMayLookingFor .="<li><a class='link-compare' href='";
$youMayLookingFor .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$youMayLookingFor .="'>Compare</a></li>";
$youMayLookingFor .="</ul>";
$youMayLookingFor .="</div>";
$youMayLookingFor .="</div>";
$youMayLookingFor .="</div>";
$youMayLookingFor .="<div class='item-info'>";
$youMayLookingFor .="<div class='info-inner'>";
$youMayLookingFor .="<div class='item-title'><a title='".stripslashes($s_og_image_title)."' href='";
$youMayLookingFor .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$youMayLookingFor .="'>".stripslashes($s_og_image_title)."</a></div>";
$youMayLookingFor .="<div class='item-content'>";
$youMayLookingFor .="<div class='rating'>";
$youMayLookingFor .="<div class='ratings'>";
$youMayLookingFor .="<div class='rating-box'>";
$porductRating = new ebapps\bay\ebcart();
$porductRating ->bay_count_of_buyer_rating($bay_showroom_approved_items_id);
if($porductRating->eBData)
{
foreach($porductRating->eBData as $valporductRating): extract($valporductRating);
$youMayLookingFor .="<div style='width:";
$youMayLookingFor .=number_format($bay_quality_rating,0,".","");
$youMayLookingFor .="%' class='rating'></div>";
endforeach;
}
$youMayLookingFor .="</div>";
$youMayLookingFor .="</div>";
$youMayLookingFor .="</div>";
$youMayLookingFor .="<div class='item-price'>";
$youMayLookingFor .="<div class='price-box'><span class='regular-price'> <span class='price'>";
$youMayLookingFor .="".primaryCurrency." ".number_format($discountprice,2,".","");
$youMayLookingFor .="</span></span></div>";
//
$youMayLookingFor .="<div class='price-box'><span class='regular-price'> <span class='price'>";
if($s_size != 'NA')
{
$youMayLookingFor .=$this->visulString($s_size);
}
if($salse > 0)
{
$youMayLookingFor .=" ($salse)";
}
$youMayLookingFor .="</span></span></div>";
$youMayLookingFor .="</div>";
//
$youMayLookingFor .="<div class='action'>";
if(isset($_SESSION['cart'][$bay_showroom_approved_items_id]))
{
foreach($_SESSION['cart'] as $id => $qty):$product = $this-> product($bay_showroom_approved_items_id);
if($id == $bay_showroom_approved_items_id)
{
$youMayLookingFor .="<form method='post'>";
$youMayLookingFor .="<button name='reducedPageItem' class='eBCartReduceItem' type='submit'><i class='fa fa-minus'>&nbsp;</i></button>";
$youMayLookingFor .="<input type='hidden' name='id' value='$bay_showroom_approved_items_id' />";
$youMayLookingFor .="<input type='text' class='eBCartQtn' title='Qty' name='qtnPageMore' value='$qty'>";
$youMayLookingFor .="<button name='increasePageItem' class='eBCartIncreaseItem' type='submit'><i class='fa fa-plus'>&nbsp;</i></button>";
$youMayLookingFor .="</form>";
}
endforeach;
}
else
{
$youMayLookingFor .="<form method='post'>";
$youMayLookingFor .="<input type='hidden' name='qtnPage' value='1'>";
$youMayLookingFor .="<input type='hidden' name='id' value='$bay_showroom_approved_items_id'>";
$youMayLookingFor .="<button type='submit' name='add' class='eBCartAddItem' title='Add to Cart'>Add to  <i class='fa fa-shopping-cart'>&nbsp;</i></button>";
$youMayLookingFor .="</form>";
}
$youMayLookingFor .="</div>";

$youMayLookingFor .="</div>";
$youMayLookingFor .="</div>";
$youMayLookingFor .="</div>";
$youMayLookingFor .="</div>";
$youMayLookingFor .="</li>";
endforeach;

$youMayLookingFor .="</ul>";
$youMayLookingFor .="</div>";
$youMayLookingFor .="</div>";

$youMayLookingFor .="</div>";
$youMayLookingFor .="</div>";
$youMayLookingFor .="</div>";
$youMayLookingFor .="</div>";
$youMayLookingFor .="</div>";
$youMayLookingFor .="</div>";
$youMayLookingFor .="</div>";
echo $youMayLookingFor;
}
?>