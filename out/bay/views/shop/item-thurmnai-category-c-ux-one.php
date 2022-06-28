<?php
$subCategoryProduct = new ebapps\bay\ebcart();
$subCategoryProduct ->item_thurmnai_category_c($productid, $sHowRoomID, $eBCategoryCC, $eBCategoryDD); 
if($subCategoryProduct->eBData)
{
$compare ="<div class='content-page'>";
$compare .="<div class='container'>"; 
$compare .="<div class='category-product'>";
$compare .="<div class='navbar nav-menu'>";
$compare .="<div class='navbar-collapse'>";
$compare .="<ul class='nav navbar-nav'>";
$compare .="<li>";
$compare .="<div class='new_title'>";
$compare .="<h2>Compare</h2>";
$compare .="</div>";
$compare .="</li>";
$compare .="</ul>";
$compare .="</div>";
$compare .="</div>";
$compare .="<div class='product-bestseller'>";
$compare .="<div class='product-bestseller-content'>";
$compare .="<div class='product-bestseller-list'>";
$compare .="<div class='tab-container'>";

$compare .="<div class='tab-panel active'>";
$compare .="<div class='category-products'>";
$compare .="<ul class='products-grid'>";
foreach($subCategoryProduct->eBData as $valsubCategoryProduct): extract($valsubCategoryProduct);

$compare .="<li class='item col-lg-3 col-md-3 col-sm-4 col-xs-12'>";
$compare .="<div class='item-inner'>";
$compare .="<div class='item-img'>";
$compare .="<div class='item-img-info'><a class='product-image' title='".stripslashes($s_og_image_title)."' href='";
$compare .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$compare .="'><img alt='".stripslashes($s_og_image_title)."' src='";
if(hypertextWithOrWithoutWww.$s_og_small_image_url)
{
$compare .=hypertextWithOrWithoutWww.$s_og_small_image_url;
}
$compare .="'></a>";
if($salse >= 1){
$compare .="<div class='sale-label sale-top-left'>Sale</div>";
}
if($salse <= 1000){
$compare .="<div class='new-label new-top-right'>New</div>";
}
$compare .="<div class='box-hover'>";
$compare .="<ul class='add-to-links'>";
$compare .="<li><a class='link-quickview' href='";
$compare .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$compare .="'>Quick View</a></li>";
$compare .="<li><a class='link-wishlist' href='";
$compare .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$compare .="'>Wishlist</a></li>";
$compare .="<li><a class='link-compare' href='";
$compare .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$compare .="'>Compare</a></li>";
$compare .="</ul>";
$compare .="</div>";
$compare .="</div>";
$compare .="</div>";
$compare .="<div class='item-info'>";
$compare .="<div class='info-inner'>";
$compare .="<div class='item-title'><a title='".stripslashes($s_og_image_title)."' href='";
$compare .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$compare .="'>".stripslashes($s_og_image_title)."</a></div>";
$compare .="<div class='item-content'>";
$compare .="<div class='rating'>";
$compare .="<div class='ratings'>";
$compare .="<div class='rating-box'>";
$porductRating = new ebapps\bay\ebcart();
$porductRating ->bay_count_of_buyer_rating($bay_showroom_approved_items_id);
if($porductRating->eBData)
{
foreach($porductRating->eBData as $valporductRating): extract($valporductRating);
$compare .="<div style='width:";
$compare .=number_format($bay_quality_rating,0,".","");
$compare .="%' class='rating'></div>";
endforeach;
}
$compare .="</div>";
$compare .="</div>";
$compare .="</div>";
$compare .="<div class='item-price'>";
$compare .="<div class='price-box'><span class='regular-price'> <span class='price'>";
$compare .="".primaryCurrency." ".number_format($discountprice,2,".","");
$compare .="</span></span></div>";
//
$compare .="<div class='price-box'><span class='regular-price'> <span class='price'>";
if($s_size != 'NA')
{
$compare .=$this->visulString($s_size);
}
if($salse > 0)
{
$compare .=" ($salse)";
}
$compare .="</span></span></div>";
$compare .="</div>";
//
$compare .="<div class='action'>";
if(isset($_SESSION['cart'][$bay_showroom_approved_items_id]))
{
foreach($_SESSION['cart'] as $id => $qty):$product = $this-> product($bay_showroom_approved_items_id);
if($id == $bay_showroom_approved_items_id)
{
$compare .="<form method='post'>";
$compare .="<button name='reducedPageItem' class='eBCartReduceItem' type='submit'><i class='fa fa-minus'>&nbsp;</i></button>";
$compare .="<input type='hidden' name='id' value='$bay_showroom_approved_items_id' />";
$compare .="<input type='text' class='eBCartQtn' title='Qty' name='qtnPageMore' value='$qty'>";
$compare .="<button name='increasePageItem' class='eBCartIncreaseItem' type='submit'><i class='fa fa-plus'>&nbsp;</i></button>";
$compare .="</form>";
}
endforeach;
}
else
{
$compare .="<form method='post'>";
$compare .="<input type='hidden' name='qtnPage' value='1'>";
$compare .="<input type='hidden' name='id' value='$bay_showroom_approved_items_id'>";
$compare .="<button type='submit' name='add' class='eBCartAddItem' title='Add to Cart'>Add to  <i class='fa fa-shopping-cart'>&nbsp;</i></button>";
$compare .="</form>";
}
$compare .="</div>";

$compare .="</div>";
$compare .="</div>";
$compare .="</div>";
$compare .="</div>";
$compare .="</li>";
endforeach;

$compare .="</ul>";
$compare .="</div>";
$compare .="</div>";

$compare .="</div>";
$compare .="</div>";
$compare .="</div>";
$compare .="</div>";
$compare .="</div>";
$compare .="</div>";
$compare .="</div>";
echo $compare;
}
?>