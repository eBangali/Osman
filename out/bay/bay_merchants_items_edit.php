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
<script language='javascript' type='text/javascript'>
/* Select B from A */
$(document).ready(function()
{
  $("#m_category_a").change(function()
  {
    var pic_name = $(this).val();
	if(pic_name != '')  
	 {
	  $.ajax
	  ({
	     type: "POST",
		 url: "bay_select_b_from_d.php",
		 data: "pic_name="+ pic_name,
		 success: function(option)
		 {
		   $("#m_category_b").html("<option value=''>Please Select</option>"+option);
		 }
	  });
	 }
	 else
	 {
	   $("#m_category_b").html("<option value=''>Please Select</option>");
	 }
	return false;
  });
});
/* Select C from B */
$(document).ready(function()
{
  $("#m_category_b").change(function()
  {
    var pic_name = $(this).val();
	if(pic_name != '')  
	 {
	  $.ajax
	  ({
	     type: "POST",
		 url: "bay_select_c_from_d.php",
		 data: "pic_name="+ pic_name,
		 success: function(option)
		 {
		   $("#m_category_c").html("<option value=''>Please Select</option>"+option);
		 }
	  });
	 }
	 else
	 {
	   $("#m_category_c").html("<option value=''>Please Select</option>");
	 }
	return false;
  });
});
/* Select D from C */
$(document).ready(function()
{
  $("#m_category_c").change(function()
  {
    var pic_name = $(this).val();
	if(pic_name != '')  
	 {
	  $.ajax
	  ({
	     type: "POST",
		 url: "bay_select_d_from_d.php",
		 data: "pic_name="+ pic_name,
		 success: function(option)
		 {
		   $("#m_category_d").html("<option value=''>Please Select</option>"+option);
		 }
	  });
	 }
	 else
	 {
	   $("#m_category_d").html("<option value=''>Please Select</option>");
	 }
	return false;
  });
});

</script>
<script>
var costPrice;
var profitPercent;
var salesPrice;
var discountPercent;
var markedPrice;
function profitPercentFunction(profitPercentValue)
{
this.costPrice = document.getElementById('costPriceShow').value;
this.profitPercent = document.getElementById('profitShow').value=profitPercentValue;
this.markedPrice = document.getElementById('markedPriceShow').value;
var CP = parseFloat(costPrice);
var P = parseFloat(profitPercent);
var MP = parseFloat(markedPrice);
/*Profit Loss Formula = CP + P.CP = MP - D.MP */
salesPrice = ((0.01*P*CP)+CP).toFixed(2);
discountPercent = (((MP - salesPrice)/MP)*100).toFixed(2);
this.discountPercent = document.getElementById('discountPercentShow').value=discountPercent;
}

</script>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>

</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<div class='well'>
<h2 title='Edit Item'>Edit Item</h2>
</div>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php $obj = new ebapps\bay\ebcart(); ?>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = "";
$m_category_a_error = "";
$m_category_b_error = "";
$m_category_c_error = "";
$m_category_d_error = "";
$m_og_image_title_error = "*";
$m_og_image_description_error = "*";
$m_showroom_id_error = "*";
$m_size_error = "*";
$m_stock_error = "";
$m_profit_percent_error = "";
$m_discount_percent_error = "";
$m_vat_tax_error = "*";
$m_weight_error = "*";
$m_handling_packing_error = "*";
$m_video_link_error = "*";
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>
<?php
if(isset($_REQUEST['merchant_product_edit']))
{
extract($_REQUEST);
//
$cp = floatval(number_format(($m_costprice_price),2,'.',''));
$p = floatval(number_format(($m_profit_percent),2,'.',''));
$mp = floatval(number_format(($m_marked_price),2,'.',''));
$salesPrice = ((0.01*$p*$cp)+$cp);
$salesPrice = floatval(number_format(($salesPrice),2,'.',''));

$discountPercent = ((($mp - $salesPrice)/$mp)*100);
$discountPercent = floatval(number_format(($discountPercent),2,'.',''));
//
$m_discount_percent = floatval(number_format(($m_discount_percent),2,'.',''));
/* Form Key*/
if(isset($_REQUEST["form_key"]))
{
$form_key = preg_replace('#[^a-zA-Z0-9]#i','',$_POST["form_key"]);
if($formKey->read_and_check_formkey($form_key) == true)
{

}
else
{
$formKey_error = "<b class='text-warning'>Sorry the server is currently too busy please try again later.</b>";
$error = 1;
}
}
/* m_category_a */
if (empty($_REQUEST["m_category_a"]))
{
$m_category_a_error = "<b class='text-warning'>Category a Required</b>";
$error =1;
} 
/* valitation m_category_a  */
elseif (! preg_match("/^([a-zA-Z0-9\/\-\,\.\(\)]+)$/",$m_category_a))
{
$m_category_a_error = "<b class='text-warning'>Whitespace, single or double quotes, certain special characters are not allowed.</b>";
$error =1;
}
else 
{
$m_category_a = $sanitization -> test_input($_POST["m_category_a"]);
}
/* m_category_b */
if (empty($_REQUEST["m_category_b"]))
{
$m_category_b_error = "<b class='text-warning'>Category b Required</b>";
$error =1;
} 
/* valitation m_category_b  */
elseif (! preg_match("/^([a-zA-Z0-9\/\-\,\.\(\)]+)$/",$m_category_b))
{
$m_category_b_error = "<b class='text-warning'>Characters Problem.</b>";
$error =1;
}
else 
{
$m_category_b = $sanitization -> test_input($_POST["m_category_b"]);
}
/* m_category_c */
if (empty($_REQUEST["m_category_c"]))
{
$m_category_c_error = "<b class='text-warning'>Category c Required</b>";
$error =1;
} 
/* valitation m_category_c  */
elseif (! preg_match("/^([a-zA-Z0-9\/\-\,\.\(\)]+)$/",$m_category_c))
{
$m_category_c_error = "<b class='text-warning'>Whitespace, single or double quotes, certain special characters are not allowed.</b>";
$error =1;
}
else 
{
$m_category_c = $sanitization -> test_input($_POST["m_category_c"]);
}
/* m_category_d */
if (empty($_REQUEST["m_category_d"]))
{
$m_category_d_error = "<b class='text-warning'>Category d Required</b>";
$error =1;
} 
/* valitation category_d  */
elseif (! preg_match("/^([a-zA-Z0-9\/\-\,\.\(\)]+)$/",$m_category_d))
{
$m_category_d_error = "<b class='text-warning'>Whitespace, single or double quotes, certain special characters are not allowed.</b>";
$error =1;
}
else 
{
$m_category_d = $sanitization -> test_input($_POST["m_category_d"]);
}
/* m_og_image_title */
if (empty($_REQUEST["m_og_image_title"]))
{
$m_og_image_title_error = "<b class='text-warning'>Title Required</b>";
$error =1;
} 
/* valitation m_og_image_title  Tested allow (productname-productname-product-name)*/
elseif (! preg_match("/^([A-Za-z0-9\?\.\,\(\)\-\ ]{3,120})$/",$m_og_image_title))
{
$m_og_image_title_error = "<b class='text-warning'>Character Problem Max 120</b>";
$error =1;
}
/* SEO valitation m_og_image_title */

elseif (strpos($m_og_image_title, $_POST["m_category_d"]) === false)
{
$keyWord = $_POST["m_category_d"];
$m_og_image_title_error = "<b class='text-warning'>Use mimimum one keyword as '$keyWord' Required</b>";
$error =1;
}
else 
{
$m_og_image_title = $sanitization -> test_input($_POST["m_og_image_title"]);
}

/* m_og_image_description */
if (empty($_REQUEST["m_og_image_description"]))
{
$m_og_image_description_error = "<b class='text-warning'>Description Required</b>";
$error =1;
} 
/* VVI Please Never Allow ~!@#$%^&*(){}[]-+=:;'?/\| */
/*
elseif (! preg_match("/^([a-zA-Z0-9\,\.\?\#\-\<\/\>\ ]{3,3000})/",$m_og_image_description))
*/
elseif (! preg_match("/^([a-zA-Z0-9\,\.\?\#\-\<\/\ ]{3,3000})/",$m_og_image_description))
{
$m_og_image_description_error = "<b class='text-warning'>Character Problem</b>";
$error =1;
}
/* SEO valitation m_og_image_description */
elseif (strpos($m_og_image_description, $_POST["m_category_d"]) === false)
{
$keyWord = $_POST["m_category_d"];
$m_og_image_description_error = "<b class='text-warning'>Use mimimum one keyword as '$keyWord' Required</b>";
$error =1;
}
else 
{
$m_og_image_description = $sanitization -> testArea($_POST["m_og_image_description"]);
}
/* m_showroom_id */
if (empty($_REQUEST["m_showroom_id"]))
{
$m_showroom_id_error = "<b class='text-warning'>Showroom ID Required</b>";
$error =1;
} 
/* valitation m_showroom_id Tested */
elseif (! preg_match("/^([A-Z0-9\-]{1,20})$/",$m_showroom_id))
{
$m_showroom_id_error = "<b class='text-warning'>Character Problem</b>";
$error =1;
}
else 
{
$m_showroom_id = $sanitization -> test_input($_POST["m_showroom_id"]);
}
//
/* m_size */
if (empty($_REQUEST["m_size"]))
{
$m_size_error = "<b class='text-warning'>Size Required</b>";
$error =1;
} 
/* valitation m_size Tested */
elseif (! preg_match("/^([a-zA-Z0-9\/\-\,\.\(\)]{1,16})$/",$m_size))
{
$m_size_error = "<b class='text-warning'>Character Problem</b>";
$error =1;
}
else 
{
$m_size = $sanitization -> test_input($_POST["m_size"]);
}
/* m_profit_percent */
if (empty($_REQUEST["m_profit_percent"]))
{

} 
/* valitation m_profit_percent  Tested */
elseif (! preg_match("/^([0-4]{0,1}[0-9]{0,2})$/",$m_profit_percent))
{
$m_profit_percent_error = "<b class='text-warning'>Max 499</b>";
$error =1;
}
else 
{
$m_profit_percent = $sanitization -> test_input($_POST["m_profit_percent"]);
}

/* m_discount_percent */
if (empty($_REQUEST["m_discount_percent"]))
{
$m_discount_percent_error = "<b class='text-warning'>Discount Required</b>";
$error =1;
} 
/* valitation m_discount_percent  Tested*/
elseif (! preg_match("/^([0-9]{0,1}[0-9]{0,1}[.]{1,1}[0-9]{2,2})$/",$m_discount_percent))
{

}

elseif ($m_discount_percent !== $discountPercent)
{
$m_discount_percent_error = "<b class='text-warning'>That value was $discountPercent</b>";
$error =1;
}
else 
{
$m_discount_percent = $sanitization -> test_input($_POST["m_discount_percent"]);
}
/* m_vat_tax */
if (empty($_REQUEST["m_vat_tax"]))
{
$m_vat_tax_error = "<b class='text-warning'>VAT/GST/TAX Required</b>";
$error =1;
} 
/* valitation m_discount_percent Tested */
elseif (! preg_match("/^([0-4]{0,1}[0-9]{0,1}[0-9]{0,1}[.]{1,1}[0-9]{2,2})$/",$m_vat_tax))
{
$m_vat_tax_error = "<b class='text-warning'>Max 499.99</b>";
$error =1;
}
else 
{
$m_vat_tax = $sanitization -> test_input($_POST["m_vat_tax"]);
}
/* m_weight */
if (empty($_REQUEST["m_weight"]))
{
$m_weight_error = "<b class='text-warning'>Weight Required</b>";
$error =1;
} 
/* valitation m_weight  Tested*/
elseif (! preg_match("/^([0-2]{0,1}[0-9]{0,1}[.]{1,1}[0-9]{2,2})$/",$m_weight))
{
$m_weight_error = "<b class='text-warning'>Max 24.99</b>";
$error =1;
}
else 
{
$m_weight = $sanitization -> test_input($_POST["m_weight"]);
}
/* m_handling_packing */
if (empty($_REQUEST["m_handling_packing"]))
{
$m_handling_packing_error = "<b class='text-warning'>Handling Packing Required</b>";
$error =1;
} 
/* valitation m_handling_packing Tested */
elseif (! preg_match("/^([0-9]{1,4}[.]{1,1}[0-9]{2,2})$/",$m_handling_packing))
{
$m_handling_packing_error = "<b class='text-warning'>Max 9999.99</b>";
$error =1;
}
else 
{
$m_handling_packing = $sanitization -> test_input($_POST["m_handling_packing"]);
}

/* m_video_link */
if (!empty($_REQUEST['m_video_link']))
{
/* valitation m_video_link  */
if (!preg_match('/^([a-zA-Z0-9\,\.\/\+\?\-\=\_\-]{3,3000})$/',$m_video_link))
{
$m_video_link_error = "<b class='text-warning'>Error on video link</b>";
$error =1;
}
else 
{
$m_video_link = $sanitization -> test_input($_POST['m_video_link']);
}
}

/* Submition form */
if($error == 0)
{
extract($_REQUEST);
$obj->merchant_product_update($m_category_a, $m_category_b, $m_category_c, $m_category_d, $bay_merchant_add_items_id, $uniqueProductID, $m_og_image_title, $m_og_image_description, $m_showroom_id, $m_size, $m_stock, $m_profit_percent, $m_discount_percent, $m_vat_tax, $m_weight, $m_handling_packing, $m_video_link);
}
//
}
?>
<div class='well'>
<?php
$obj = new ebapps\bay\ebcart();
$obj->edit_product_item();
if($obj->eBData >= 1)
{
foreach($obj->eBData as $val)
{
extract($val);
$updateProduct ="<form method='post' enctype='multipart/form-data'>"; 
$updateProduct .="<fieldset class='group-select'>";
$updateProduct .="<input type='hidden' name='form_key' value='";
$updateProduct .= $formKey->outputKey(); 
$updateProduct .="'>"; 
$updateProduct .="$formKey_error";
$updateProduct .="<input type='hidden' name='bay_merchant_add_items_id' value='$bay_merchant_add_items_id' />"; 
$updateProduct .="<input type='hidden' name='uniqueProductID' value='$tracking_unique_product_adi' />";
$updateProduct .="<div class='input-group'><span class='input-group-addon' id='sizing-addon2'>Merchant:</span><span class='form-control'>$username_merchant_adi</span></div>";
//
$updateProduct .="<div class='input-group'> <span class='input-group-addon'>Category A: $m_category_a_error</span><select id='m_category_a' name='m_category_a' class='form-control' required autofocus>";
$updateProduct .="<option value='$m_category_a' selected>".$obj->visulString($m_category_a)."</option>";
//
$objCategory = new ebapps\bay\ebcart();
$objCategory->select_category_a_edit();
if($objCategory->eBData)
{
foreach($objCategory->eBData as $valCategory)
{
extract($valCategory);
$updateProduct .="<option value='".$bay_category_a."'>".$objCategory ->visulString($bay_category_a)."</option>";
}
}
$updateProduct .="</select></div>";
//
$updateProduct .="<div class='input-group'> <span class='input-group-addon'>Category B: $m_category_b_error</span><select id='m_category_b' name='m_category_b' class='form-control' required autofocus>";
$updateProduct .="<option value='$m_category_b' selected>".$obj->visulString($m_category_b)."</option>";
$updateProduct .="</select></div>";
//
$updateProduct .="<div class='input-group'> <span class='input-group-addon'>Category C: $m_category_c_error</span><select id='m_category_c' name='m_category_c' class='form-control' required autofocus>";
$updateProduct .="<option value='$m_category_c' selected>".$obj->visulString($m_category_c)."</option>";
$updateProduct .="</select></div>";
//
$updateProduct .="<div class='input-group'> <span class='input-group-addon'>Category D: $m_category_d_error</span><select id='m_category_d' name='m_category_d' class='form-control' required autofocus>";
$updateProduct .="<option value='$m_category_d' selected>".$obj->visulString($m_category_d)."</option>";
$updateProduct .="</select></div>";
//
if(!empty($m_og_small_image_url))
{
$updateProduct .= "Profile Image:";
$updateProduct .= "<img src='".hypertextWithOrWithoutWww."$m_og_small_image_url' width='100%' />";
}
//
$updateProduct .="<div class='input-group'><span class='input-group-addon' id='sizing-addon2'>Title: $m_og_image_title_error</span><input class='form-control' type='text' name='m_og_image_title' value='$m_og_image_title' placeholder='T-Shirt' /></div>";
//
$updateProduct .="Description: $m_og_image_description_error";
$updateProduct .="<textarea class='form-control' name='m_og_image_description' id='WhatToDo'>$m_og_image_description</textarea>";
//
$updateProduct .="<div class='input-group'><span class='input-group-addon' id='sizing-addon2'>Showroom ID: $m_showroom_id_error </span><input type='text' class='form-control' name='m_showroom_id' value='$m_showroom_id' disabled /><input type='hidden' name='m_showroom_id' value='$m_showroom_id' /></div>";
//
$updateProduct .="<div class='input-group'> <span class='input-group-addon'>Size: $m_size_error</span><select name='m_size' class='form-control' required autofocus>";
$updateProduct .="<option value='$m_size' selected>".$obj->visulString($m_size)."</option>";
//
$objCategory = new ebapps\bay\ebcart();
$objCategory->select_size_merchant_eidt();
if($objCategory->eBData)
{
foreach($objCategory->eBData as $valCategory)
{
extract($valCategory);
$updateProduct .="<option value='".$size_name."'>".$objCategory ->visulString($size_name)."</option>";
}
}
$updateProduct .="</select></div>";
//
$updateProduct .="<div class='input-group'><span class='input-group-addon' id='sizing-addon2'>Cost Price: ".primaryCurrency."</span><input type='text' class='form-control' name='m_costprice_price' value='$m_costprice_price' id='costPriceShow' disabled /><input type='hidden' name='m_costprice_price' value='$m_costprice_price' /></div>";
$updateProduct .="<div class='input-group'><span class='input-group-addon' id='sizing-addon2'>Marked Price: ".primaryCurrency."</span><input type='text' name='m_marked_price' class='form-control' value='$m_marked_price' id='markedPriceShow' disabled /><input type='hidden' name='m_marked_price'  value='$m_marked_price' /></div>";

$updateProduct .="<dt class='last even'>Profit Percent $m_profit_percent_error: <input type='button' value='$m_profit_percent' id='profitShow'></dt>";
$updateProduct .="<dd class='last even'><input type='range' name='m_profit_percent' id='profitPercent' value='$m_profit_percent' min='0.00' max='$m_profit_percent' onchange='profitPercentFunction(this.value);'></dd>";

$updateProduct .="<div class='input-group'><span class='input-group-addon' id='sizing-addon2'>Discount Percent $m_discount_percent_error: <input type='hidden' value='$m_discount_percent' id='discountShow'></span><input type='number' class='form-control' min='0.00' step='0.01' name='m_discount_percent' id='discountPercentShow' value='$m_discount_percent' required /></div>";

$updateProduct .="<div class='input-group'><span class='input-group-addon' id='sizing-addon2'>Stock: $m_stock_error </span><input class='form-control' type='number' name='m_stock' value='$m_stock' placeholder='999999' required /></div>";

$updateProduct .="<div class='input-group'><span class='input-group-addon' id='sizing-addon2'>VAT/GST/TAX in Percent $m_vat_tax_error: </span><input class='form-control' type='text' name='m_vat_tax' placeholder='499.99' value='$m_vat_tax'></div>";
$updateProduct .="<div class='input-group'><span class='input-group-addon' id='sizing-addon2'>Weight in kg $m_weight_error: </span><input class='form-control' min='0.00' type='number' step='0.01' max='24.99' name='m_weight' placeholder='24.99' value=$m_weight></div>";
$updateProduct .="<div class='input-group'><span class='input-group-addon' id='sizing-addon2'>Packing/ Unit $m_handling_packing_error: ".primaryCurrency."</span><input class='form-control' type='text' name='m_handling_packing' placeholder='9999.99' value='$m_handling_packing'></div>";

$updateProduct .="<div class='input-group'><span class='input-group-addon' id='sizing-addon2'>Shipment From:</span><span class='form-control'>";
$adminZone = new ebapps\bay\ebcart();
$adminZone ->merchant_country_of_origin($m_country_of_origin);
if($adminZone->eBData >= 1)
{
foreach($adminZone->eBData as $val)
{
extract($val);
$updateProduct .="<b>$country_name</b>";
}
}
$updateProduct .="</span></div>";
$updateProduct .="<div class='input-group'><span class='input-group-addon' id='sizing-addon2'>Upload Date:</span><span class='form-control'>$m_date</span></div>";

$updateProduct .="Video link whthout https://www: $m_video_link_error";
$updateProduct .="<input class='form-control' type='text' name='m_video_link' placeholder='google.com' value='$m_video_link' />";

$updateProduct .="<div class='buttons-set'>
<button type='submit' name='merchant_product_edit' title='Submit' class='button submit'> <span> Submit </span> </button>
</div>";
$updateProduct .="</fieldset>";
$updateProduct .="</form>";
echo $updateProduct;  
}
}
?>
</div>
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
