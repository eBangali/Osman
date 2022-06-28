<script>
function reDuce()
{
var result = document.getElementById('qtnMore');
var qty = result.value; 
if( !isNaN( qty ) && qty > 1 ) 
{
result.value--;
}
}

function inCrease()
{
var result = document.getElementById('qtnMore');
var qty = result.value;
if( !isNaN( qty )  && qty) 
{
result.value++;
}
}
</script>
<?php
if(isset($_GET['id']))
{
$productid = $_GET['id'];

$objProduct = new ebapps\bay\ebcart();
$objProduct -> item_details($productid);

$eBitem ="<section class='main-container col1-layout'>";
$eBitem .="<div class='main'>";
$eBitem .="<div class='container'>";
$eBitem .="<div class='row'>";
$eBitem .="<div class='col-main'>";
$eBitem .="<div class='product-view'>";
$eBitem .="<div class='product-essential'>";
$eBitem .="<div class='product-img-box col-lg-4 col-sm-5 col-xs-12'>";
$eBitem .="<div class='new-label new-top-left'>New</div>";
//### Preview ###//
$eBitem .="<div class='product-image'>";
if(!empty($productid)){
if($objProduct->eBData >= 1){
foreach($objProduct->eBData as $valobjProduct): extract($valobjProduct);
$eBitem .="<div class='product-full'><img id='product-zoom' src='";
if(hypertextWithOrWithoutWww.$s_og_image_url)
{ 
$eBitem .=hypertextWithOrWithoutWww.$s_og_image_url; 
}
$eBitem .="' data-zoom-image='";
if(hypertextWithOrWithoutWww.$s_og_image_url)
{ 
$eBitem .=hypertextWithOrWithoutWww.$s_og_image_url; 
}
$eBitem .="' alt='".stripslashes($s_og_image_title)."'></div>";
endforeach; 
}
}
//
$eBitem .="<div class='more-views'>";
$eBitem .="<div class='slider-items-products'>";
$eBitem .="<div id='gallery_01' class='product-flexslider hidden-buttons product-img-thumb'>";
$eBitem .="<div class='slider-items slider-width-col4 block-content'>";

if(!empty($productid)){
$objPreview = new ebapps\bay\ebcart(); $objPreview -> item_details_preview_on($productid);
if($objPreview->eBData >= 1){
foreach($objPreview->eBData as $valobjPreview): extract($valobjPreview);
$eBitem .="<div class='more-views-items'><a href='' data-image='";
if(hypertextWithOrWithoutWww.$bay_big_imag_url)
{ 
$eBitem .=hypertextWithOrWithoutWww.$bay_big_imag_url; 
}
$eBitem .="' data-zoom-image='";
if(hypertextWithOrWithoutWww.$bay_big_imag_url)
{ 
$eBitem .=hypertextWithOrWithoutWww.$bay_big_imag_url; 
}
$eBitem .="'><img id='product-zoom'  src='";
if(hypertextWithOrWithoutWww.$bay_big_imag_url)
{ 
$eBitem .=hypertextWithOrWithoutWww.$bay_big_imag_url; 
}
$eBitem .="' alt='".stripslashes($s_og_image_title)."'></a></div>";
endforeach; 
}
}
$eBitem .="</div>";
$eBitem .="</div>";
$eBitem .="</div>";
$eBitem .="</div>";
//
$eBitem .="</div>";
//### Preview ###//
//### Video ###//
if(!empty($productid)){
if($objProduct->eBData >= 1){
foreach($objProduct->eBData as $valobjProduct): extract($valobjProduct);
if(!empty($s_video_link)) { ?>
<?php   
$eBitem .="<div class='thumbnail text-center homeCategory'>";
$eBitem .="<h3 title='".stripslashes($s_og_image_title)."'>".stripslashes($s_og_image_title)."</h3>";
$eBitem .="<div class='bs-example' data-example-id='responsive-embed-16by9-iframe-youtube'>";
$eBitem .="<div class='embed-responsive embed-responsive-16by9'>";
$eBitem .="<iframe class='embed-responsive-item' src='".hypertextWithOrWithoutWww.$s_video_link."' allowfullscreen=''> </iframe>";
$eBitem .="</div>";
$eBitem .="</div>";
$eBitem .="</div>";
}
endforeach; 
}
}
//### Video ###//
$eBitem .="</div>";
//
$eBitem .="<div class='product-shop col-lg-8 col-sm-7 col-xs-12'>";

$eBitem .="<div class='product-next-prev'>";
//Previous
$prevItem= new ebapps\bay\ebcart(); 
$prevItem -> item_thurmnai_category_c_prev($productid, $sHowRoomID, $eBCategoryCC, $eBCategoryDD); 
if($prevItem->eBData)
{
foreach($prevItem->eBData as $vaLprevItem): extract($vaLprevItem);
$eBitem .="<a class='product-prev' href='";
$eBitem .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$eBitem .="'><samp></samp></a>";
endforeach;
}
//Previous
//Next
$nextItem= new ebapps\bay\ebcart(); 
$nextItem -> item_thurmnai_category_c_next($productid, $sHowRoomID, $eBCategoryCC, $eBCategoryDD); 
if($nextItem->eBData)
{
foreach($nextItem->eBData as $vanextItem): extract($vanextItem);
$eBitem .="<a class='product-next' href='";
$eBitem .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$eBitem .="'><samp></samp></a>";
endforeach;
}
//Next
$eBitem .="</div>";

$eBitem .="<div class='product-name'>";
if(!empty($productid)){
$objDetails= new ebapps\bay\ebcart(); $objDetails -> item_details($productid);
if($objDetails->eBData >= 1) { foreach($objDetails->eBData as $valObjDetails){ extract($valObjDetails);
$eBitem .="<h1>".stripslashes($s_og_image_title)."</h1>";
$eBitem .="</div>";
$eBitem .="<div class='ratings'>";
$eBitem .="<div class='rating-box'>";
if(!empty($productid)){
$objRating = new ebapps\bay\ebcart();
$objRating->bay_count_of_buyer_rating($productid);
if($objRating->eBData >= 1){
foreach($objRating->eBData as $valObjRating): extract($valObjRating);
$eBitem .="<div style='width:";
$eBitem .=number_format($bay_quality_rating,0,".","");
$eBitem .="%' class='rating'></div>";
endforeach; 
}}
$eBitem .="</div>";
$eBitem .="</div>";

if($s_discount_percent >= 5.00)
{
$eBitem .="<div class='price-block'>";
$eBitem .="<div class='price-box'>";
$eBitem .="<b class='discountPercent'>".number_format($s_discount_percent,0,'','')."% OFF</b>";
$eBitem .="</div>";
$eBitem .="</div>";
}

$eBitem .="<div class='price-block'>";
$eBitem .="<div class='price-box'>";
$eBitem .="<p class='special-price'><span class='price-label'>Special Price</span><span id='product-price-48' class='price'>";
$eBitem .="".primaryCurrency." ".number_format($discountprice,2,".","");
$eBitem .="</span></p>";
if($discountprice != $s_marked_price)
{
$eBitem .="<p class='old-price'><span class='price-label'>Regular Price:</span><span class='price'>";
$eBitem .="".primaryCurrency." ".number_format($s_marked_price,2,".","");
$eBitem .="</span></p>";
}
if($stockinhand >=1)
{
$eBitem .="<p class='availability in-stock pull-right'><span>In Stock</span></p>";
}
else
{
$eBitem .="<p class='availability out-of-stock pull-right'><span>Out of Stock</span></p>";
}
$eBitem .="</div>";
$eBitem .="</div>";

$eBitem .="<div class='add-to-box'>";
$eBitem .="<div class='add-to-cart'>";
//
$eBitem .="<form method='post'>";
$eBitem .="<div class='custom pull-left'>";
//
$eBitem .="<button onclick='reDuce();' class='reduced items-count' type='button'><i class='fa fa-minus'>&nbsp;</i></button>";
$eBitem .="<input type='text' class='input-text qty' title='Qty' maxlength='12' value='1' id='qtnMore' name='qtnMore'>";
$eBitem .="<button onclick='inCrease();' class='increase items-count' type='button'><i class='fa fa-plus'>&nbsp;</i></button>";
//
$eBitem .="<select class='input-text eboption' name='id' required autofocus>";
$size = new ebapps\bay\ebcart();
$size->bay_select_size($username_merchant_ai, $s_category_a, $s_category_b, $s_category_c, $s_category_d, $s_showroom_id);
if($size->eBData)
{
foreach($size->eBData as $vAlsize): extract($vAlsize);
$eBitem .="<option value='$bay_showroom_approved_items_id'>".$this->visulString($s_size)."</option>";
endforeach;
}
$eBitem .="</select>";
//
$eBitem .="</div>";
$eBitem .="<button type='submit' name='add' class='button btn-cart' title='Add to Cart'>Add to Cart</button>";
$eBitem .="</form>";
$eBitem .="</div>";
// Like
$eBitem .="<div class='email-addto-box'>";
$eBitem .="<ul class='add-to-links'>";
$eBitem .="<li>";
if(isset($_SESSION['ebusername']))
{
/*Logined True with hober effect and check wish exist or wish now*/
if(isset($_REQUEST['addWishtoLike']))
{
extract($_REQUEST);
$countWish = new ebapps\bay\ebcart();
$countWish ->addWishLike();
}
$objProductLike = new ebapps\bay\ebcart();
$objProductLike -> checkWishLikeAlreadyExist($productid);
if($objProductLike->eBData)
{
foreach($objProductLike->eBData as $vaLobjProductLike): extract($vaLobjProductLike);	
$countWishAll = new ebapps\bay\ebcart();
$countWishAll ->count_total_wishLike($productid);
if($countWishAll->eBData)
{
foreach($countWishAll->eBData as $vaLcountWishAll): extract($vaLcountWishAll);

if($totalProductLikes < 1)
{
$eBitem .="<form method='post'>";
$eBitem .="<input type='hidden' name='idWishLike' value='$productid'>";
$eBitem .="<button title='Add to Wishlist' type='submit' name='addWishtoLike' class='link-wishlist'></button>";
$eBitem .="<b>".$totalProductLikes." like</b>";
$eBitem .="</form>";
}
elseif ($totalProductLikes == 1)
{
$eBitem .="<form method='post'>";
$eBitem .="<input type='hidden' name='idWishLike' value='$productid'>";
$eBitem .="<button title='Add to Wishlist' type='submit' name='addWishtoLike' class='link-wishlist'></button>";
$eBitem .="<b>".$totalProductLikes." like</b>";
$eBitem .="</form>";
}
elseif ($totalProductLikes > 1)
{
$eBitem .="<form method='post'>";
$eBitem .="<input type='hidden' name='idWishLike' value='$productid'>";
$eBitem .="<button title='Add to Wishlist' type='submit' name='addWishtoLike' class='link-wishlist'></button>";
$eBitem .="<b>".$totalProductLikes." likes</b>";
$eBitem .="</form>";		
}
endforeach;
}
endforeach;
}
}
if(empty($_SESSION['ebusername']))
{
/*Logined False with hober effect and show count of with */  				   
$countWishAll = new ebapps\bay\ebcart();
$countWishAll ->count_total_wishLike($productid);
if($countWishAll->eBData)
{
foreach($countWishAll->eBData as $vaLcountWishAll): extract($vaLcountWishAll);
if($totalProductLikes <= 1)
{
$eBitem .="<span title='Add to Wishlist' class='link-wishlist'></span> <b>".$totalProductLikes." like</b>";
}
elseif ($totalProductLikes > 1)
{
$eBitem .="<span title='Add to Wishlist' class='link-wishlist'></span> <b>".$totalProductLikes." likes</b>";		
}
endforeach;
}
}
$eBitem .="</li>";																	  
$eBitem .="</ul>";
$eBitem .="</div>";
// End Like	
$eBitem .="</div>";
//
$eBitem .="<div class='short-description'>";
$eBitem .="<h2>Quick Overview</h2>";
$eBitem .=stripslashes($s_og_image_description);
$eBitem .="</div>";
//
$eBitem .="</div>";
$eBitem .="</div>";
$eBitem .="</div>";
$eBitem .="</div>";
}}}
//
$eBitem .="<div class='product-collateral col-lg-12 col-sm-12 col-xs-12'>";
$eBitem .="<div class='add_info'>";
$eBitem .="<ul id='product-detail-tab' class='nav nav-tabs product-tabs'>";
$eBitem .="<li class='active'><a href='#reviews_tabs' data-toggle='tab'>Reviews</a></li>";
$eBitem .="</ul>";

$eBitem .="<div id='productTabContent' class='tab-content'>";
//
$eBitem .="<div class='tab-pane fade in active' id='reviews_tabs'>";
$eBitem .="<div class='box-collateral box-reviews' id='customer-reviews'>";
$eBitem .="<div class='box-reviews2'>";
$eBitem .="<div class='box visible'>";
$eBitem .="<ul>";
if(!empty($productid)){
$objAllRating = new ebapps\bay\ebcart();
$objAllRating -> bay_all_quality_communication_testimonial_rating($productid);
if($objAllRating->eBData >= 1){
foreach($objAllRating->eBData as $valobjAllRating): extract($valobjAllRating);
$eBitem .="<li>";
$eBitem .="<table class='ratings-table'>";
$eBitem .="<tbody>";
$eBitem .="<tr>";
$eBitem .="<th>Quality</th>";
$eBitem .="<td><div class='rating-box'>";
$eBitem .="<div class='rating' style='width:";
$eBitem .=$bay_rating_for_quality_satisfaction*20;
$eBitem .="%'></div>";
$eBitem .="</div></td>";
$eBitem .="</tr>";
$eBitem .="<tr>";
$eBitem .="<th>Support</th>";
$eBitem .="<td><div class='rating-box'>";
$eBitem .="<div class='rating' style='width:";
$eBitem .=$bay_rating_for_communication_satisfaction*20;
$eBitem .="%'></div>";
$eBitem .="</div></td>";
$eBitem .="</tr>";
$eBitem .="</tbody>";
$eBitem .="</table>";
$eBitem .="<div class='review'>";
$eBitem .="<small>Review by <span>$bay_username_buyer_in_rating</span>on $bay_rating_date</small>";
$eBitem .="<div class='review-txt'>$bay_rating_testimonial</div>";
$eBitem .="</div>";
$eBitem .="</li>";
endforeach; 
}}
$eBitem .="</ul>";
$eBitem .="</div>";
$eBitem .="</div>";
$eBitem .="</div>";
$eBitem .="</div>";
//
$eBitem .="</div>";
$eBitem .="</div>";
$eBitem .="</div>";
$eBitem .="</div>";
$eBitem .="</div>";
$eBitem .="</div>";
$eBitem .="</div>";
$eBitem .="</div>";
$eBitem .="</section>";
}
echo $eBitem;
?>