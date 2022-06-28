<?php
if(isset($_GET['id'])){$productid = $_GET['id'];}
$obj= new ebapps\bay\ebcart();
$obj -> itemPageInnation($productid); 
if($obj->eBData > 0) { foreach($obj->eBData as $val){ extract($val);
$gridInfo ="<h2 class='page-heading'> <span class='page-heading-title'>".$obj->visulString($s_category_d)."</span> </h2>";
}}
$gridInfo .="<div class='display-product-option'>";
$gridInfo .="<div class='sorter'>";
$gridInfo .="<div class='view-mode'>";
$gridInfo .="<a class='button-grid' title='Grid' href='";
if(isset($_GET['id'])){$productid = $_GET['id'];}
$obj= new ebapps\bay\ebcart();
$obj -> itemPageInnation($productid); 
if($obj->eBData) { foreach($obj->eBData as $val){ extract($val);
$gridInfo .=outBayLink."/product/selectiongrid/$bay_showroom_approved_items_id/";
}
}
$gridInfo .="'>&nbsp;</a>";
$gridInfo .="<span class='button-active button-list' title='List'>&nbsp;</span>";
$gridInfo .="</div>";
$gridInfo .="</div>";
$gridInfo .="</div>";

$subCategoryProduct = new ebapps\bay\ebcart();
$subCategoryProduct ->bayProductAllCDunlimit($eBCategoryCC, $eBCategoryDD);
if($subCategoryProduct->eBData)
{
$gridInfo .="<div class='category-products'>";
///////////////
$gridInfo .="<ol class='products-list'>";
foreach($subCategoryProduct->eBData as $valsubCategoryProduct): extract($valsubCategoryProduct);
$gridInfo .="<li class='item'>";
$gridInfo .="<div class='product-image'>";
$gridInfo .="<a href='";
$gridInfo .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$gridInfo .="' title='".stripslashes($s_og_image_title)."'>";
$gridInfo .="<img class='small-image' src='";
if(hypertextWithOrWithoutWww.$s_og_small_image_url)
{
$gridInfo .=hypertextWithOrWithoutWww.$s_og_small_image_url;
}
$gridInfo .="' alt='".stripslashes($s_og_image_title)."'>";
$gridInfo .="</a>";
if($salse <= 1000 ){
$gridInfo .="<div class='new-label new-top-left'>New</div>";
}
if($salse >= 1 ){
$gridInfo .="<div class='sale-label sale-top-right'>Sale</div>";
}
$gridInfo .="</div>";
$gridInfo .="<div class='product-shop'>";
$gridInfo .="<h2 class='product-name'>";
$gridInfo .="<a href='";
$gridInfo .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$gridInfo .="' title='".stripslashes($s_og_image_title)."'>".stripslashes($s_og_image_title)."</a>";
$gridInfo .="</h2>";
$gridInfo .="<div class='ratings'>";
$gridInfo .="<div class='rating-box'>";
$porductRating = new ebapps\bay\ebcart();
$porductRating ->bay_count_of_buyer_rating($bay_showroom_approved_items_id);
if($porductRating->eBData)
{
foreach($porductRating->eBData as $valporductRating): extract($valporductRating);
$gridInfo .="<div style='width:";
$gridInfo .=number_format($bay_quality_rating,0,".","");
$gridInfo .="%' class='rating'></div>";
endforeach;
}
$gridInfo .="</div>";
$gridInfo .="<p class='rating-links'> ### Review(s)</p>";
$gridInfo .="</div>";
$gridInfo .="<div class='desc std'>";
$gridInfo .="<p>$s_og_image_description</p>";
$gridInfo .="</div>";
$gridInfo .="<div class='price-box'>";
$gridInfo .="<p class='old-price'> <span class='price-label'></span> <span class='price'>"."".primaryCurrency." ".number_format($s_marked_price,2,".","")."</span> </p>";
$gridInfo .="<p class='special-price'> <span class='price-label'></span> <span class='price'>";
$gridInfo .="".primaryCurrency." ".number_format($discountprice,2,".","");
$gridInfo .="</span></p>";
$gridInfo .="</div>";
//
$gridInfo .="<div class='price-box'><span class='regular-price'> <span class='price'>";
if($s_size != 'NA')
{
$gridInfo .=$this->visulString($s_size);
}
if($salse > 0)
{
$gridInfo .=" ($salse)";
}
$gridInfo .="</span></span></div>";
$gridInfo .="<div class='action'>";
if(isset($_SESSION['cart'][$bay_showroom_approved_items_id]))
{
foreach($_SESSION['cart'] as $id => $qty):$product = $this-> product($bay_showroom_approved_items_id);
if($id == $bay_showroom_approved_items_id)
{
$gridInfo .="<form method='post'>";
$gridInfo .="<button name='reducedPageItem' class='eBCartReduceItem' type='submit'><i class='fa fa-minus'>&nbsp;</i></button>";
$gridInfo .="<input type='hidden' name='id' value='$bay_showroom_approved_items_id' />";
$gridInfo .="<input type='text' class='eBCartQtn' title='Qty' name='qtnPageMore' value='$qty'>";
$gridInfo .="<button name='increasePageItem' class='eBCartIncreaseItem' type='submit'><i class='fa fa-plus'>&nbsp;</i></button>";
$gridInfo .="</form>";
}
endforeach;
}
else
{
$gridInfo .="<form method='post'>";
$gridInfo .="<input type='hidden' name='qtnPage' value='1'>";
$gridInfo .="<input type='hidden' name='id' value='$bay_showroom_approved_items_id'>";
$gridInfo .="<button type='submit' name='add' class='eBCartAddItem' title='Add to Cart'>Add to  <i class='fa fa-shopping-cart'>&nbsp;</i></button>";
$gridInfo .="</form>";
}
$gridInfo .="</div>";

$gridInfo .="</div>";
$gridInfo .="</li>";
endforeach;
$gridInfo .="</ol>";
//////////////
$gridInfo .="</div>";
}
echo $gridInfo;
?>
