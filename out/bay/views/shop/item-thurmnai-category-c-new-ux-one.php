<?php
$subCategoryProduct = new ebapps\bay\ebcart();
$subCategoryProduct ->item_thurmnai_category_c_New($productid, $sHowRoomID, $eBCategoryCC, $eBCategoryDD); 
if($subCategoryProduct->eBData)
{
$newArrival ="<div class='content-page'>";
$newArrival .="<div class='container'>"; 
$newArrival .="<div class='category-product'>";
$newArrival .="<div class='navbar nav-menu'>";
$newArrival .="<div class='navbar-collapse'>";
$newArrival .="<ul class='nav navbar-nav'>";
$newArrival .="<li>";
$newArrival .="<div class='new_title'>";
$newArrival .="<h2>New Arrival</h2>";
$newArrival .="</div>";
$newArrival .="</li>";
$newArrival .="</ul>";
$newArrival .="</div>";
$newArrival .="</div>";
$newArrival .="<div class='product-bestseller'>";
$newArrival .="<div class='product-bestseller-content'>";
$newArrival .="<div class='product-bestseller-list'>";
$newArrival .="<div class='tab-container'>";

$newArrival .="<div class='tab-panel active'>";
$newArrival .="<div class='category-products'>";
$newArrival .="<ul class='products-grid'>";
foreach($subCategoryProduct->eBData as $valsubCategoryProduct): extract($valsubCategoryProduct);

$newArrival .="<li class='item col-lg-3 col-md-3 col-sm-4 col-xs-12'>";
$newArrival .="<div class='item-inner'>";
$newArrival .="<div class='item-img'>";
$newArrival .="<div class='item-img-info'><a class='product-image' title='".stripslashes($s_og_image_title)."' href='";
$newArrival .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$newArrival .="'><img alt='".stripslashes($s_og_image_title)."' src='";
if(hypertextWithOrWithoutWww.$s_og_small_image_url)
{
$newArrival .=hypertextWithOrWithoutWww.$s_og_small_image_url;
}
$newArrival .="'></a>";
if($salse >= 1){
$newArrival .="<div class='sale-label sale-top-left'>Sale</div>";
}
if($salse <= 1000){
$newArrival .="<div class='new-label new-top-right'>New</div>";
}
$newArrival .="<div class='box-hover'>";
$newArrival .="<ul class='add-to-links'>";
$newArrival .="<li><a class='link-quickview' href='";
$newArrival .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$newArrival .="'>Quick View</a></li>";
$newArrival .="<li><a class='link-wishlist' href='";
$newArrival .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$newArrival .="'>Wishlist</a></li>";
$newArrival .="<li><a class='link-compare' href='";
$newArrival .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$newArrival .="'>Compare</a></li>";
$newArrival .="</ul>";
$newArrival .="</div>";
$newArrival .="</div>";
$newArrival .="</div>";
$newArrival .="<div class='item-info'>";
$newArrival .="<div class='info-inner'>";
$newArrival .="<div class='item-title'><a title='".stripslashes($s_og_image_title)."' href='";
$newArrival .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$newArrival .="'>".stripslashes($s_og_image_title)."</a></div>";
$newArrival .="<div class='item-content'>";
$newArrival .="<div class='rating'>";
$newArrival .="<div class='ratings'>";
$newArrival .="<div class='rating-box'>";
$porductRating = new ebapps\bay\ebcart();
$porductRating ->bay_count_of_buyer_rating($bay_showroom_approved_items_id);
if($porductRating->eBData)
{
foreach($porductRating->eBData as $valporductRating): extract($valporductRating);
$newArrival .="<div style='width:";
$newArrival .=number_format($bay_quality_rating,0,".","");
$newArrival .="%' class='rating'></div>";
endforeach;
}
$newArrival .="</div>";
$newArrival .="</div>";
$newArrival .="</div>";
$newArrival .="<div class='item-price'>";
$newArrival .="<div class='price-box'><span class='regular-price'> <span class='price'>";
$newArrival .="".primaryCurrency." ".number_format($discountprice,2,".","");
$newArrival .="</span></span></div>";
//
$newArrival .="<div class='price-box'><span class='regular-price'> <span class='price'>";
if($s_size != 'NA')
{
$newArrival .=$this->visulString($s_size);
}
if($salse > 0)
{
$newArrival .=" ($salse)";
}
$newArrival .="</span></span></div>";
$newArrival .="</div>";
//
$newArrival .="<div class='action'>";
if(isset($_SESSION['cart'][$bay_showroom_approved_items_id]))
{
foreach($_SESSION['cart'] as $id => $qty):$product = $this-> product($bay_showroom_approved_items_id);
if($id == $bay_showroom_approved_items_id)
{
$newArrival .="<form method='post'>";
$newArrival .="<button name='reducedPageItem' class='eBCartReduceItem' type='submit'><i class='fa fa-minus'>&nbsp;</i></button>";
$newArrival .="<input type='hidden' name='id' value='$bay_showroom_approved_items_id' />";
$newArrival .="<input type='text' class='eBCartQtn' title='Qty' name='qtnPageMore' value='$qty'>";
$newArrival .="<button name='increasePageItem' class='eBCartIncreaseItem' type='submit'><i class='fa fa-plus'>&nbsp;</i></button>";
$newArrival .="</form>";
}
endforeach;
}
else
{
$newArrival .="<form method='post'>";
$newArrival .="<input type='hidden' name='qtnPage' value='1'>";
$newArrival .="<input type='hidden' name='id' value='$bay_showroom_approved_items_id'>";
$newArrival .="<button type='submit' name='add' class='eBCartAddItem' title='Add to Cart'>Add to  <i class='fa fa-shopping-cart'>&nbsp;</i></button>";
$newArrival .="</form>";
}
$newArrival .="</div>";

$newArrival .="</div>";
$newArrival .="</div>";
$newArrival .="</div>";
$newArrival .="</div>";
$newArrival .="</li>";
endforeach;

$newArrival .="</ul>";
$newArrival .="</div>";
$newArrival .="</div>";

$newArrival .="</div>";
$newArrival .="</div>";
$newArrival .="</div>";
$newArrival .="</div>";
$newArrival .="</div>";
$newArrival .="</div>";
$newArrival .="</div>";
echo $newArrival;
}
?>