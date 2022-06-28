<?php
$subCategoryDiscountMax = new ebapps\bay\ebcart();
$subCategoryDiscountMax ->item_thurmnai_category_seller($username_merchant); 
if($subCategoryDiscountMax->eBData)
{
$maxiDiscount ="<div class='content-page'>";
$maxiDiscount .="<div class='container'>"; 
$maxiDiscount .="<div class='category-product'>";
$maxiDiscount .="<div class='navbar nav-menu'>";
$maxiDiscount .="<div class='navbar-collapse'>";
$maxiDiscount .="<ul class='nav navbar-nav'>";
$maxiDiscount .="<li>";
$maxiDiscount .="<div class='new_title'>";
$maxiDiscount .="<h2>$username_merchant</h2>";
$maxiDiscount .="</div>";
$maxiDiscount .="</li>";
$maxiDiscount .="</ul>";
$maxiDiscount .="</div>";
$maxiDiscount .="</div>";
$maxiDiscount .="<div class='product-bestseller'>";
$maxiDiscount .="<div class='product-bestseller-content'>";
$maxiDiscount .="<div class='product-bestseller-list'>";
$maxiDiscount .="<div class='tab-container'>";

$maxiDiscount .="<div class='tab-panel active'>";
$maxiDiscount .="<div class='category-products'>";
$maxiDiscount .="<ul class='products-grid'>";
foreach($subCategoryDiscountMax->eBData as $valsubCategoryDiscountMax): extract($valsubCategoryDiscountMax);
$maxiDiscount .="<li class='item col-lg-3 col-md-3 col-sm-4 col-xs-12'>";
$maxiDiscount .="<div class='item-inner'>";
$maxiDiscount .="<div class='item-img'>";
$maxiDiscount .="<div class='item-img-info'><a class='product-image' title='".stripslashes($s_og_image_title)."' href='";
$maxiDiscount .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$maxiDiscount .="'><img alt='".stripslashes($s_og_image_title)."' src='";
if(hypertextWithOrWithoutWww.$s_og_small_image_url)
{
$maxiDiscount .=hypertextWithOrWithoutWww.$s_og_small_image_url;
}
$maxiDiscount .="'></a>";
if($salse >= 1){
$maxiDiscount .="<div class='sale-label sale-top-left'>Sale</div>";
}
if($salse <= 1000){
$maxiDiscount .="<div class='new-label new-top-right'>New</div>";
}
$maxiDiscount .="<div class='box-hover'>";
$maxiDiscount .="<ul class='add-to-links'>";
$maxiDiscount .="<li><a class='link-quickview' href='";
$maxiDiscount .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$maxiDiscount .="'>Quick View</a></li>";
$maxiDiscount .="<li><a class='link-wishlist' href='";
$maxiDiscount .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$maxiDiscount .="'>Wishlist</a></li>";
$maxiDiscount .="<li><a class='link-compare' href='";
$maxiDiscount .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$maxiDiscount .="'>Compare</a></li>";
$maxiDiscount .="</ul>";
$maxiDiscount .="</div>";
$maxiDiscount .="</div>";
$maxiDiscount .="</div>";
$maxiDiscount .="<div class='item-info'>";
$maxiDiscount .="<div class='info-inner'>";
$maxiDiscount .="<div class='item-title'><a title='".stripslashes($s_og_image_title)."' href='";
$maxiDiscount .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$maxiDiscount .="'>".stripslashes($s_og_image_title)."</a></div>";
$maxiDiscount .="<div class='item-content'>";
$maxiDiscount .="<div class='rating'>";
$maxiDiscount .="<div class='ratings'>";
$maxiDiscount .="<div class='rating-box'>";
$porductRating = new ebapps\bay\ebcart();
$porductRating ->bay_count_of_buyer_rating($bay_showroom_approved_items_id);
if($porductRating->eBData)
{
foreach($porductRating->eBData as $valporductRating): extract($valporductRating);
$maxiDiscount .="<div style='width:";
$maxiDiscount .=number_format($bay_quality_rating,0,".","");
$maxiDiscount .="%' class='rating'></div>";
endforeach;
}
$maxiDiscount .="</div>";
$maxiDiscount .="</div>";
$maxiDiscount .="</div>";
$maxiDiscount .="<div class='item-price'>";
$maxiDiscount .="<div class='price-box'><span class='regular-price'> <span class='price'>";
$maxiDiscount .="".primaryCurrency." ".number_format($discountprice,2,".","");
$maxiDiscount .="</span></span></div>";
//
$maxiDiscount .="<div class='price-box'><span class='regular-price'> <span class='price'>";
if($s_size != 'NA')
{
$maxiDiscount .=$this->visulString($s_size);
}
if($salse > 0)
{
$maxiDiscount .=" ($salse)";
}
$maxiDiscount .="</span></span></div>";
$maxiDiscount .="</div>";
//
$maxiDiscount .="<div class='action'>";
if(isset($_SESSION['cart'][$bay_showroom_approved_items_id]))
{
foreach($_SESSION['cart'] as $id => $qty):$product = $this-> product($bay_showroom_approved_items_id);
if($id == $bay_showroom_approved_items_id)
{
$maxiDiscount .="<form method='post'>";
$maxiDiscount .="<button name='reducedPageItem' class='eBCartReduceItem' type='submit'><i class='fa fa-minus'>&nbsp;</i></button>";
$maxiDiscount .="<input type='hidden' name='id' value='$bay_showroom_approved_items_id' />";
$maxiDiscount .="<input type='text' class='eBCartQtn' title='Qty' name='qtnPageMore' value='$qty'>";
$maxiDiscount .="<button name='increasePageItem' class='eBCartIncreaseItem' type='submit'><i class='fa fa-plus'>&nbsp;</i></button>";
$maxiDiscount .="</form>";
}
endforeach;
}
else
{
$maxiDiscount .="<form method='post'>";
$maxiDiscount .="<input type='hidden' name='qtnPage' value='1'>";
$maxiDiscount .="<input type='hidden' name='id' value='$bay_showroom_approved_items_id'>";
$maxiDiscount .="<button type='submit' name='add' class='eBCartAddItem' title='Add to Cart'>Add to  <i class='fa fa-shopping-cart'>&nbsp;</i></button>";
$maxiDiscount .="</form>";
}
$maxiDiscount .="</div>";
$maxiDiscount .="</div>";
$maxiDiscount .="</div>";
$maxiDiscount .="</div>";
$maxiDiscount .="</div>";
$maxiDiscount .="</li>";
endforeach;
//////////
$maxiDiscount .="</ul>";
$maxiDiscount .="</div>";
$maxiDiscount .="</div>";

$maxiDiscount .="</div>";
$maxiDiscount .="</div>";
$maxiDiscount .="</div>";
$maxiDiscount .="</div>";
$maxiDiscount .="</div>";
$maxiDiscount .="</div>";
$maxiDiscount .="</div>";
echo $maxiDiscount;
}
?>