<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php
include_once (ebbd."/connection.inc.php");
if(isset($_POST['searchQuery'])  && $_POST['searchQuery'] != '')
{
$outPut = "";
/*** MySQL 8.0.23 OK ***/
$query ="SELECT";
$query .=" showroom.bay_showroom_approved_items_id,";
$query .=" showroom.username_merchant_ai,";
$query .=" showroom.s_category_a,";
$query .=" showroom.s_category_b,";
$query .=" showroom.s_category_c,";
$query .=" showroom.s_category_d,";
$query .=" showroom.s_showroom_id,";
$query .=" showroom.s_size,";
$query .=" showroom.s_og_image_url,";
$query .=" showroom.s_og_small_image_url,";
$query .=" showroom.s_og_image_title,";
$query .=" showroom.s_og_image_description,";
$query .=" sout.salse,";
$query .=" (showroom.purchase - sout.salse) AS stockinhand,";
$query .=" (showroom.showroomprice - showroom.discount) AS discountprice,";
$query .=" showroom.s_marked_price,";
$query .=" showroom.s_discount_percent,";
$query .=" showroom.s_vat_tax,";
$query .=" showroom.s_weight,";
$query .=" showroom.s_handling_packing,";
$query .=" showroom.s_country_of_origin,";
$query .=" showroom.s_date";
$query .=" FROM";
$query .=" (";
$query .=" SELECT";
$query .=" bay_showroom_approved_items_id,";
$query .=" username_merchant_ai,";
$query .=" tracking_unique_product_ai,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_size,";
$query .=" s_og_image_url,";
$query .=" s_og_small_image_url,";
$query .=" s_og_image_title,";
$query .=" s_og_image_description,";
$query .=" SUM(s_stock) AS purchase,";
$query .=" s_marked_price AS showroomprice,";
$query .=" s_marked_price * s_discount_percent / 100 AS discount,";
$query .=" s_marked_price,";
$query .=" s_discount_percent,";
$query .=" s_vat_tax,";
$query .=" s_weight,";
$query .=" s_handling_packing,";
$query .=" s_country_of_origin,";
$query .=" s_date";
$query .=" FROM bay_showroom_approved_items";
$query .=" WHERE";
$query .=" s_product_approved = 1";
$query .=" AND s_og_image_title LIKE '%".$_POST['searchQuery']."%'";
$query .=" AND s_category_a IN (SELECT s_category_a FROM bay_showroom_approved_items WHERE s_product_approved=1 GROUP BY s_category_a)";
$query .=" AND s_category_b IN (SELECT s_category_b FROM bay_showroom_approved_items WHERE s_product_approved=1 GROUP BY s_category_b)";
$query .=" AND s_category_c IN (SELECT s_category_c FROM bay_showroom_approved_items WHERE s_product_approved=1 GROUP BY s_category_c)";
$query .=" AND s_category_d IN (SELECT s_category_d FROM bay_showroom_approved_items WHERE s_product_approved=1 GROUP BY s_category_d)";
$query .=" AND s_showroom_id IN (SELECT s_showroom_id FROM bay_showroom_approved_items WHERE s_product_approved=1 GROUP BY s_showroom_id)";
$query .=" GROUP BY";
$query .=" bay_showroom_approved_items_id,";
$query .=" s_category_a,";
$query .=" s_category_b,";
$query .=" s_category_c,";
$query .=" s_category_d,";
$query .=" s_showroom_id,";
$query .=" s_size";
$query .=" ) showroom";
$query .=" JOIN";
$query .=" (";
$query .=" SELECT";
$query .=" tracking_unique_product_sr,";
$query .=" SUM(sqtn_sr) AS salse,";
$query .=" payment_status";
$query .=" FROM bay_salse_report_stock_update";
$query .=" WHERE";
$query .=" payment_status = 'OK'";
$query .=" GROUP BY tracking_unique_product_sr";
$query .=" ) sout";
$query .=" ON showroom.tracking_unique_product_ai = sout.tracking_unique_product_sr";
$query .=" WHERE";
$query .=" sout.salse >= 0";
$query .=" ORDER BY discount DESC";
//
$result = $connectdb -> query($query);
$outPut = "<ul class='list-group'>";
if($result)
{
while($row = $result->fetch_array())
{
$outPut .= "<li class='list-group-item'><img class='search-img' src='".hypertextWithOrWithoutWww.$row['s_og_small_image_url']."' />".$row['s_og_image_title']."</li>";
}
$result -> free_result();
}
else
{
$outPut .= "<li class='list-group-item'>Nothing Found</li>";
}
$outPut .= "</ul>";
$connectdb -> close();
echo $outPut;
}
//
?>