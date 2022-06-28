<?php
$subCategoryProduct = new ebapps\bay\ebcart();
$subCategoryProduct ->bayProductAllGroupByABCDID(); 
if($subCategoryProduct->eBData)
{
$newProduct ="<div class='content-page'>";
$newProduct .="<div class='container'>"; 
$newProduct .="<div class='category-product'>";
$newProduct .="<div class='navbar nav-menu'>";
$newProduct .="<div class='navbar-collapse'>";
$newProduct .="<ul class='nav navbar-nav'>";
$newProduct .="<li>";
$newProduct .="<div class='new_title'>";
$newProduct .="<h2>All Categories</h2>";
$newProduct .="</div>";
$newProduct .="</li>";
$newProduct .="</ul>";
$newProduct .="</div>";
$newProduct .="</div>";
$newProduct .="<div class='product-bestseller'>";
$newProduct .="<div class='product-bestseller-content'>";
$newProduct .="<div class='product-bestseller-list'>";
$newProduct .="<div class='tab-container'>";
$newProduct .="<div class='tab-panel active'>";
$newProduct .="<div class='category-products'>";
$newProduct .="<ul class='products-grid'>";
foreach($subCategoryProduct->eBData as $valsubCategoryProduct): extract($valsubCategoryProduct);
/////////
$categoryProductOne = new ebapps\bay\ebcart();
$categoryProductOne ->bayProductOne($maxid);
if($categoryProductOne->eBData)
{
foreach($categoryProductOne->eBData as $valcategoryProductOne): extract($valcategoryProductOne);
/////////
$newProduct .="<li class='item col-lg-3 col-md-3 col-sm-4 col-xs-12'>";
$newProduct .="<div class='item-inner'>";
$newProduct .="<div class='item-img'>";
$newProduct .="<div class='item-img-info'><a class='product-image' title='".stripslashes($s_og_image_title)."' href='";
$newProduct .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$newProduct .="'><img alt='".stripslashes($s_og_image_title)."' src='";
if(hypertextWithOrWithoutWww.$s_og_small_image_url)
{
$newProduct .=hypertextWithOrWithoutWww.$s_og_small_image_url;
}
$newProduct .="'></a>";
if($salse >= 1){
$newProduct .="<div class='sale-label sale-top-left'>Sale</div>";
}
if($salse <= 1000){
$newProduct .="<div class='new-label new-top-right'>New</div>";
}
$newProduct .="<div class='box-hover'>";
$newProduct .="<ul class='add-to-links'>";
$newProduct .="<li><a class='link-quickview' href='";
$newProduct .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$newProduct .="'>Quick View</a></li>";
$newProduct .="<li><a class='link-wishlist' href='";
$newProduct .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$newProduct .="'>Wishlist</a></li>";
$newProduct .="<li><a class='link-compare' href='";
$newProduct .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$newProduct .="'>Compare</a></li>";
$newProduct .="</ul>";
$newProduct .="</div>";
$newProduct .="</div>";
$newProduct .="</div>";
$newProduct .="<div class='item-info'>";
$newProduct .="<div class='info-inner'>";
$newProduct .="<div class='item-title'><a title='".stripslashes($s_og_image_title)."' href='";
$newProduct .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$newProduct .="'>".stripslashes($s_og_image_title)."</a></div>";
$newProduct .="<div class='item-content'>";
$newProduct .="<div class='rating'>";
$newProduct .="<div class='ratings'>";
$newProduct .="<div class='rating-box'>";
$porductRating = new ebapps\bay\ebcart();
$porductRating ->bay_count_of_buyer_rating($bay_showroom_approved_items_id);
if($porductRating->eBData)
{
foreach($porductRating->eBData as $valporductRating): extract($valporductRating);
$newProduct .="<div style='width:";
$newProduct .=number_format($bay_quality_rating,0,".","");
$newProduct .="%' class='rating'></div>";
endforeach;
}
$newProduct .="</div>";
$newProduct .="</div>";
$newProduct .="</div>";
$newProduct .="<div class='item-price'>";
$newProduct .="<div class='price-box'><span class='regular-price'> <span class='price'>";
$newProduct .="".primaryCurrency." ".number_format($discountprice,2,".","");
$newProduct .="</span></span></div>";
$newProduct .="</div>";
//
$newProduct .="<div class='action'>";
if(isset($_SESSION['cart'][$bay_showroom_approved_items_id]))
{
foreach($_SESSION['cart'] as $id => $qty):$product = $this-> product($bay_showroom_approved_items_id);
if($id == $bay_showroom_approved_items_id)
{
$newProduct .="<form method='post'>";
$newProduct .="<button name='reducedPageItem' class='eBCartReduceItem' type='submit'><i class='fa fa-minus'>&nbsp;</i></button>";
$newProduct .="<input type='hidden' name='id' value='$bay_showroom_approved_items_id' />";
$newProduct .="<input type='text' class='eBCartQtn' title='Qty' name='qtnPageMore' value='$qty'>";
$newProduct .="<button name='increasePageItem' class='eBCartIncreaseItem' type='submit'><i class='fa fa-plus'>&nbsp;</i></button>";
$newProduct .="</form>";
}
endforeach;
}
else
{
$newProduct .="<form method='post'>";
$newProduct .="<input type='hidden' name='qtnPage' value='1'>";
$newProduct .="<input type='hidden' name='id' value='$bay_showroom_approved_items_id'>";
$newProduct .="<button type='submit' name='add' class='eBCartAddItem' title='Add to Cart'>Add to  <i class='fa fa-shopping-cart'>&nbsp;</i></button>";
$newProduct .="</form>";
}
$newProduct .="</div>";
$newProduct .="</div>";
$newProduct .="</div>";
$newProduct .="</div>";
$newProduct .="</div>";
$newProduct .="</li>";
endforeach;
//////////
}
endforeach;
//////////
$newProduct .="</ul>";
$newProduct .="</div>";
$newProduct .="</div>";

$newProduct .="</div>";
$newProduct .="</div>";
$newProduct .="</div>";
$newProduct .="</div>";
$newProduct .="</div>";
$newProduct .="</div>";
$newProduct .="</div>";
echo $newProduct;
}
//
$obj = new ebapps\bay\ebcart(); 
echo $obj -> bayProductPaginationGroup();
?>