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
$gridInfo .="<span title='Grid' class='button button-active button-grid'>&nbsp;</span>";
$gridInfo .="<a href='";
if(isset($_GET['id'])){$productid = $_GET['id'];}
$obj= new ebapps\bay\ebcart();
$obj -> itemPageInnation($productid); 
if($obj->eBData) { foreach($obj->eBData as $val){ extract($val);
$gridInfo .=outBayLink."/product/list/$bay_showroom_approved_items_id/";
}
}
$gridInfo .="' title='List' class='button-list'>&nbsp;</a>";
$gridInfo .="</div>";
$gridInfo .="</div>";
$gridInfo .="</div>";

$subCategoryProduct = new ebapps\bay\ebcart();
$subCategoryProduct ->bayProductAllCDunlimit($eBCategoryCC, $eBCategoryDD);
if($subCategoryProduct->eBData)
{
$gridInfo .="<div class='category-products'>";
$gridInfo .="<ul class='products-grid'>";
foreach($subCategoryProduct->eBData as $valsubCategoryProduct): extract($valsubCategoryProduct);

$gridInfo .="<li class='item col-lg-3 col-md-3 col-sm-4 col-xs-12'>";
$gridInfo .="<div class='item-inner'>";
$gridInfo .="<div class='item-img'>";
$gridInfo .="<div class='item-img-info'><a class='product-image' title='".stripslashes($s_og_image_title)."' href='";
$gridInfo .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$gridInfo .="'><img alt='".stripslashes($s_og_image_title)."' src='";
if(hypertextWithOrWithoutWww.$s_og_small_image_url)
{
$gridInfo .=hypertextWithOrWithoutWww.$s_og_small_image_url;
}
$gridInfo .="'></a>";
$gridInfo .="<div class='box-hover'>";
$gridInfo .="<ul class='add-to-links'>";
$gridInfo .="<li><a class='link-quickview' href='";
$gridInfo .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$gridInfo .="'>Quick View</a></li>";
$gridInfo .="<li><a class='link-wishlist' href='";
$gridInfo .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$gridInfo .="'>Wishlist</a></li>";
$gridInfo .="<li><a class='link-compare' href='";
$gridInfo .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$gridInfo .="'>Compare</a></li>";
$gridInfo .="</ul>";
$gridInfo .="</div>";
$gridInfo .="</div>";
$gridInfo .="</div>";
$gridInfo .="<div class='item-info'>";
$gridInfo .="<div class='info-inner'>";
$gridInfo .="<div class='item-title'><a title='".stripslashes($s_og_image_title)."' href='";
$gridInfo .=outBayLink."/product/item-details-grid/$bay_showroom_approved_items_id/";
$gridInfo .="'>".stripslashes($s_og_image_title)."</a></div>";
$gridInfo .="<div class='item-content'>";
$gridInfo .="<div class='rating'>";
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
$gridInfo .="</div>";
$gridInfo .="</div>";
$gridInfo .="<div class='item-price'>";
$gridInfo .="<div class='price-box'><span class='regular-price'> <span class='price'>";
$gridInfo .="".primaryCurrency." ".number_format($discountprice,2,".","");
$gridInfo .="</span></span></div>";
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
$gridInfo .="</div>";
//
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
$gridInfo .="</div>";
$gridInfo .="</div>";
$gridInfo .="</div>";
$gridInfo .="</li>";
endforeach;
$gridInfo .="</ul>";
$gridInfo .="</div>";
}
echo $gridInfo;
?>
