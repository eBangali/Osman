<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php
include_once(ebbd.'/dbconfig.php');
$adMin = new ebapps\dbconnection\dbconfig();
if(isset($adMin->eBAdminUserIsSet))
{
?>
<?php include_once (eblogin.'/session.inc.php'); ?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-noindex.php'); ?>
<?php include_once (eblayout.'/a-common-header-title-one.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts-text-editor.php'); ?>
<?php include_once (eblayout.'/a-common-page-id-start.php'); ?>
<?php include_once (eblayout.'/a-common-header.php'); ?>
<nav>
  <div class='container'>
    <div>
      <?php include_once (eblayout.'/a-common-navebar.php'); ?>
      <?php include_once (eblayout.'/a-common-navebar-index-bay.php'); ?>
    </div>
  </div>
</nav>
<?php include_once (eblayout.'/a-common-page-id-end.php'); ?>
<?php include_once (ebaccess.'/access_permission_merchant_minimum.php'); ?>	
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>

</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<div class="well">
<h2 title='Item Status'>Item Status</h2>
</div>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php
if(isset($_REQUEST['DeleteScreenshots']))
{
extract($_REQUEST);
$obj=new ebapps\bay\ebcart();
$obj->BaydeleteScreenShootMerchant($bay_multi_image_id, $add_items_id_in_bay_merchant_multi_img, $bay_big_imag_url);
}
?>
<?php
$obj=new ebapps\bay\ebcart();
$obj->merchant_view_items();
$merchantviewitems ="<article>";
$merchantviewitems .="<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>";
if($obj->eBData >= 1)
{
foreach($obj->eBData as $val)
{
extract($val);
$merchantviewitems .="<div class='panel panel-default'>";
$merchantviewitems .="<div class='panel-heading' role='tab' id='heading".$bay_merchant_add_items_id."'>";
$merchantviewitems .="<h3 class='panel-title'> <a class='collapsed' data-toggle='collapse' data-parent='#accordion' href='#collapse".$bay_merchant_add_items_id."' aria-expanded='false' aria-controls='collapse".$bay_merchant_add_items_id."'>";
//
$merchantviewitems .="<div class='row'>";
$merchantviewitems .="<div class='col-xs-12 col-md-12'>";
//
$merchantviewitems .="<div class='row'>";
if(file_exists(str_replace(hostingName, docRoot, hypertextWithOrWithoutWww.$m_og_image_url)))
{
$merchantviewitems .="<div class='col-xs-12 col-md-3'><img class='img-responsive' src='".hypertextWithOrWithoutWww."$m_og_image_url' /></div>";
}
else
{
$merchantviewitems .="<div class='col-xs-12 col-md-3'><img class='img-responsive' src='".themeResource."/images/blankImage.jpg' /></div>";
}
$merchantviewitems .="<div class='col-xs-12 col-md-9'>";
if($m_product_approved==0)
{
$merchantviewitems .="<i class='fa fa-times-circle fa-lg' aria-hidden='true'></i> REVIEWING ID: $bay_merchant_add_items_id<br>";
}
if($m_product_approved==1)
{
$merchantviewitems .="<i class='fa fa-check-circle fa-lg' aria-hidden='true'></i> PUBLISHED ID: $bay_merchant_add_items_id<br>";
}
$merchantviewitems .="<b>Title: ".stripslashes($m_og_image_title)."</b><br>";
$merchantviewitems .="<b>".$obj->visulString($m_category_a)." <i class='fa fa-angle-double-right' aria-hidden='true'></i> ".$obj->visulString($m_category_b)."</b><br>";
$merchantviewitems .="<b>".$obj->visulString($m_category_c)." <i class='fa fa-angle-double-right' aria-hidden='true'></i> ".$obj->visulString($m_category_d)."</b><br>";
$merchantviewitems .="<b>Mark Price: $m_marked_price</b> ";
$merchantviewitems .="<b>Showroom ID: $m_showroom_id</b> ";
$merchantviewitems .="<b>Size: $m_size</b>";
$merchantviewitems .="</div>"; 
$merchantviewitems .="</div>";
//
$merchantviewitems .="</div>";
$merchantviewitems .="</div>";
//
$merchantviewitems .="</a>";
$merchantviewitems .="</h3>";
$merchantviewitems .="</div>";
$merchantviewitems .="<div id='collapse".$bay_merchant_add_items_id."' class='panel-collapse collapse' role='tabpanel' aria-labelledby='heading".$bay_merchant_add_items_id."'>";
//
$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Merchant:</div><div class='col-xs-12 col-md-9'>$username_merchant_adi</div></div>";
$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Title:</div><div class='col-xs-12 col-md-9'>".stripslashes($m_og_image_title)."</div></div>";
$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Category:</div><div class='col-xs-12 col-md-9'>".$obj->visulString($m_category_a)."</div></div>";
$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Sub Category:</div><div class='col-xs-12 col-md-9'>".$obj->visulString($m_category_b)."</div></div>";
$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Sub Category:</div><div class='col-xs-12 col-md-9'>".$obj->visulString($m_category_c)."</div></div>";
$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Sub Category:</div><div class='col-xs-12 col-md-9'>".$obj->visulString($m_category_d)."</div></div>";
if(file_exists(str_replace(hostingName, docRoot, hypertextWithOrWithoutWww.$m_og_image_url)))
{
$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Profile Image:</div><div class='col-xs-12 col-md-9'><img src='".hypertextWithOrWithoutWww."$m_og_small_image_url' width='100%' /></div></div>";
}
else
{
$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Upload Profile Image:</div><div class='col-xs-12 col-md-9'><form action='bay-image-upload.php' method='post'><input type='hidden' name='bay_merchant_add_items_id' value='$bay_merchant_add_items_id' /><button type='submit' name='upload_image' title='Submit' class='button submit'> <span> Upload Profile Image </span> </button></form></div></div>";
}
//
if(!empty($bay_merchant_add_items_id))
{
$objmulti = new ebapps\bay\ebcart();
$objmulti ->bay_multi_img($bay_merchant_add_items_id);
if($objmulti->eBData)
{
foreach($objmulti->eBData as $valmulti)
{
extract($valmulti);
if($bay_image_approved==1)
{
$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Screenshots:</div><div class='col-xs-12 col-md-9'><img src='".hypertextWithOrWithoutWww."$bay_big_imag_url' class='img-responsive' />";
$merchantviewitems .="<form method='post'><input type='hidden' name='bay_multi_image_id' value='$bay_multi_image_id' /><input type='hidden' name='add_items_id_in_bay_merchant_multi_img' value='$add_items_id_in_bay_merchant_multi_img' /><input type='hidden' name='bay_big_imag_url' value='$bay_big_imag_url' /><button type='submit' name='DeleteScreenshots' title='Delete Screenshots' class='button submit'> <span> Delete Screenshots </span> </button></form>";
$merchantviewitems .="</div></div>";
}
}
}
}

//
if($m_product_approved==1)
{
$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Upload Screenshots:</div><div class='col-xs-12 col-md-9'><form action='bay-add-multi-image.php' method='post'><input type='hidden' name='bay_merchant_add_items_id' value='$bay_merchant_add_items_id' /><div class='buttons-set'>
<button type='submit' name='bay_upload_image' title='Add Screenshot' class='button submit'> <span> Add Screenshot </span> </button>
</div></form></div></div>";
}
$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Description:</div><div class='col-xs-12 col-md-9'>".stripslashes($m_og_image_description)."</div></div>";
$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Showroom ID:</div><div class='col-xs-12 col-md-9'>$m_showroom_id</div></div>";
$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Size:</div><div class='col-xs-12 col-md-9'>$m_size</div></div>";
$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Cost Price ".primaryCurrency.":</div><div class='col-xs-12 col-md-9'>$m_costprice_price</div></div>";
$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Marked Price ".primaryCurrency.":</div><div class='col-xs-12 col-md-9'>$m_marked_price</div></div>";
$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Profit Percent:</div><div class='col-xs-12 col-md-9'>$m_profit_percent</div></div>";
$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Discount Percent:</div><div class='col-xs-12 col-md-9'>$m_discount_percent</div></div>";
$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Stock:</div><div class='col-xs-12 col-md-9'>$m_stock</div></div>";
$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>VAT/GST/TAX Percent:</div><div class='col-xs-12 col-md-9'>$m_vat_tax</div></div>";
$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Weight in kg:</div><div class='col-xs-12 col-md-9'>$m_weight</div></div>";
$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Packing/ Unit ".primaryCurrency.":</div><div class='col-xs-12 col-md-9'>$m_handling_packing</div></div>";
$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Shipment From:</div><div class='col-xs-12 col-md-9'>";
$adminZone = new ebapps\bay\ebcart();
$adminZone ->merchant_country_of_origin($m_country_of_origin);
if($adminZone->eBData >= 1)
{
foreach($adminZone->eBData as $val)
{
extract($val);
$merchantviewitems .="$country_name";
}
}
$merchantviewitems .="</div></div>";
$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Submit Date :</div><div class='col-xs-12 col-md-9'>$m_date</div></div>";

if(!empty($m_video_link))
{
$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>Video:</div><div class='col-xs-12 col-md-9'>";
$merchantviewitems .="<div class='bs-example' data-example-id='responsive-embed-16by9-iframe-youtube'>";
$merchantviewitems .="<div class='embed-responsive embed-responsive-16by9'>";
$merchantviewitems .="<iframe class='embed-responsive-item' src='".hypertextWithOrWithoutWww."$m_video_link' allowfullscreen=''>";
$merchantviewitems .="</iframe>";
$merchantviewitems .="</div>";
$merchantviewitems .="</div>";
$merchantviewitems .="</div></div>";
}

$merchantviewitems .="<div class='row'><div class='col-xs-12 col-md-3'>OPTION:</div><div class='col-xs-12 col-md-9'>";
$merchantviewitems .="<form action='bay_merchants_items_edit.php' method='get'><fieldset class='group-select'><input type='hidden' name='bay_merchant_add_items_id' value='$bay_merchant_add_items_id' /><input type='hidden' name='username_merchant_adi' value='$username_merchant_adi' /><div class='buttons-set'>
<button type='submit' title='EDIT AS OLD' class='button submit'> <span> EDIT AS OLD </span> </button>
</div></fieldset></form>";
//
$merchantviewitems .="<form action='bay_merchants_items_edit_as_new.php' method='get'><fieldset class='group-select'><input type='hidden' name='bay_merchant_add_items_id' value='$bay_merchant_add_items_id' /><input type='hidden' name='username_merchant_adi' value='$username_merchant_adi' /><div class='buttons-set'>
<button type='submit' title='EDIT AS NEW' class='button submit'> <span> EDIT AS NEW </span> </button>
</div></fieldset></form>";
$merchantviewitems .="</div></div>";
//
$merchantviewitems .="</div>";
$merchantviewitems .="</div>";
}
$merchantviewitems .="</div>";
$merchantviewitems .="</article>";
echo $merchantviewitems;
}
else
{
echo "<pre>No Item Found</pre>";
}
?>
</div>
<div class='col-xs-12 col-md-3 sidebar-offcanvas'>
<?php include_once ("bay-my-account.php"); ?>
</div>
</div>
</div>
<?php include_once (eblayout.'/a-common-footer-edit.php'); ?>
<?php
}
else
{
header("Location: ".outLink."/access/admin-register.php");
}
?>
