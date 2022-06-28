<?php
$searchObj= new ebapps\bay\ebcart(); 
$searchObj -> search_in_bay(); 
if($searchObj->eBData)
{
$newSearch ="<div class='content-page'>";
$newSearch .="<div class='container'>"; 
$newSearch .="<div class='category-product'>";
$newSearch .="<div class='navbar nav-menu'>";
$newSearch .="<div class='navbar-collapse'>";
$newSearch .="<ul class='nav navbar-nav'>";
$newSearch .="<li>";
$newSearch .="<div class='new_title'>";
$newSearch .="<h2>Search Result </h2>";
$newSearch .="</div>";
$newSearch .="</li>";

$newSearch .="</ul>";
$newSearch .="</div>";
$newSearch .="</div>";
$newSearch .="<div class='product-bestseller'>";
$newSearch .="<div class='product-bestseller-content'>";
$newSearch .="<div class='product-bestseller-list'>";
$newSearch .="<div class='tab-container'>";

$newSearch .="<div class='tab-panel active'>";
$newSearch .="<div class='category-products'>";
$newSearch .="<ul class='products-grid'>";
foreach($searchObj->eBData as $vaLsearchObj): extract($vaLsearchObj);
$searchObjOne = new ebapps\bay\ebcart(); 
$searchObjOne -> search_in_bay_one($maxid); 
if($searchObjOne->eBData)
{
foreach($searchObjOne->eBData as $vaLsearchObjOne): extract($vaLsearchObjOne);
//$newSearch .="<li class='item col-lg-3 col-md-3 col-sm-4 col-xs-12'>";
$newSearch .="<li class='item col-sm-2 col-xs-12'>";
$newSearch .="<div class='item-inner'>";
$newSearch .="<div class='item-img'>";
$newSearch .="<div class='item-img-info'><a class='product-image' title='".stripslashes($s_og_image_title)."' href='";
$newSearch .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$newSearch .="'><img alt='".stripslashes($s_og_image_title)."' src='";
if(hypertextWithOrWithoutWww.$s_og_small_image_url)
{
$newSearch .=hypertextWithOrWithoutWww.$s_og_small_image_url;
}
$newSearch .="'></a>";
$newSearch .="<div class='box-hover'>";
$newSearch .="<ul class='add-to-links'>";
$newSearch .="<li><a class='link-quickview' href='";
$newSearch .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$newSearch .="'>Quick View</a></li>";
$newSearch .="<li><a class='link-wishlist' href='";
$newSearch .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$newSearch .="'>Wishlist</a></li>";
$newSearch .="<li><a class='link-compare' href='";
$newSearch .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$newSearch .="'>Compare</a></li>";
$newSearch .="</ul>";
$newSearch .="</div>";
$newSearch .="</div>";
$newSearch .="</div>";
$newSearch .="<div class='item-info'>";
$newSearch .="<div class='info-inner'>";
$newSearch .="<div class='item-title'><a title='".stripslashes($s_og_image_title)."' href='";
$newSearch .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$newSearch .="'>".stripslashes($s_og_image_title)."</a></div>";
$newSearch .="<div class='item-content'>";
$newSearch .="<div class='rating'>";
$newSearch .="<div class='ratings'>";
$newSearch .="<div class='rating-box'>";
$porductRating = new ebapps\bay\ebcart();
$porductRating ->bay_count_of_buyer_rating($bay_showroom_approved_items_id);
if($porductRating->eBData)
{
foreach($porductRating->eBData as $valporductRating): extract($valporductRating);
$newSearch .="<div style='width:";
$newSearch .=number_format($bay_quality_rating,0,".","");
$newSearch .="%' class='rating'></div>";
endforeach;
}
$newSearch .="</div>";
$newSearch .="</div>";
$newSearch .="</div>";
$newSearch .="<div class='item-price'>";
$newSearch .="<div class='price-box'><span class='regular-price'> <span class='price'>";
$newSearch .="".primaryCurrency." ".number_format($discountprice,2,".","");
$newSearch .="</span></span></div>";
//
$newSearch .="<div class='price-box'><span class='regular-price'> <span class='price'>";
if($s_size != 'NA')
{
$newSearch .=$this->visulString($s_size);
}
if($salse > 0)
{
$newSearch .=" ($salse)";
}
$newSearch .="</span></span></div>";
$newSearch .="</div>";
//
$newSearch .="<div class='action'>";
if(isset($_SESSION['cart'][$bay_showroom_approved_items_id]))
{
foreach($_SESSION['cart'] as $id => $qty):$product = $this-> product($bay_showroom_approved_items_id);
if($id == $bay_showroom_approved_items_id)
{
$newSearch .="<form method='post'>";
$newSearch .="<button name='reducedPageItem' class='eBCartReduceItem' type='submit'><i class='fa fa-minus'>&nbsp;</i></button>";
$newSearch .="<input type='hidden' name='id' value='$bay_showroom_approved_items_id' />";
$newSearch .="<input type='text' class='eBCartQtn' title='Qty' name='qtnPageMore' value='$qty'>";
$newSearch .="<button name='increasePageItem' class='eBCartIncreaseItem' type='submit'><i class='fa fa-plus'>&nbsp;</i></button>";
$newSearch .="</form>";
}
endforeach;
}
else
{
$newSearch .="<form method='post'>";
$newSearch .="<input type='hidden' name='qtnPage' value='1'>";
$newSearch .="<input type='hidden' name='id' value='$bay_showroom_approved_items_id'>";
$newSearch .="<button type='submit' name='add' class='eBCartAddItem' title='Add to Cart'>Add to  <i class='fa fa-shopping-cart'>&nbsp;</i></button>";
$newSearch .="</form>";
}
$newSearch .="</div>";

$newSearch .="</div>";
$newSearch .="</div>";
$newSearch .="</div>";
$newSearch .="</div>";
$newSearch .="</li>";
endforeach;
}
endforeach;
$newSearch .="</ul>";
$newSearch .="</div>";
$newSearch .="</div>";

$newSearch .="</div>";
$newSearch .="</div>";
$newSearch .="</div>";
$newSearch .="</div>";
$newSearch .="</div>";
$newSearch .="</div>";
$newSearch .="</div>";
echo $newSearch;
}
?>