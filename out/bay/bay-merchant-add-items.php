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
    <div class='col-xs-12 col-md-2 eb-gap'>

    </div>
    <div class='col-xs-12 col-md-7 eb-gap sidebar-offcanvas'>
      <div class="well">
        <h2 title='Shop Add Item'>Shop Add Item</h2>
      </div>
<?php include_once (ebbay.'/ebcart.php');
$merchant = new ebapps\bay\ebcart();
?>
<?php 
$adminZone = new ebapps\bay\ebcart();
$adminZone ->admin_dhl_shipping_zone();
if($adminZone->eBData >= 1)
{
foreach($adminZone->eBData as $val)
{
extract($val);
/*Do Nothing */
}
}
else
{
echo "<div class='well'><a href='dhl-shipping-zone-admin-setting.php'>Admin DHL Shipping Zone Empty</a>";
echo "</div></div></div></div>";
include_once (eblayout.'/a-common-footer-edit.php');
exit();
}
?>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
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

function costPriceShowFunction(costPriceShowValue)
{
this.costPrice = document.getElementById('costPriceShow').value=costPriceShowValue;
}

function profitPercentFunction(profitPercentValue)
{
this.profitPercent = document.getElementById('profitShow').value=profitPercentValue; 
}

function discountFunction(discountValue)
{
this.discountPercent = document.getElementById('discountShow').value=discountValue;
var partOneStringToDecimal = parseFloat(costPrice);
var partTwoStringToDecimal = parseFloat(profitPercent);
salesPrice = ((0.01*partTwoStringToDecimal*partOneStringToDecimal)+partOneStringToDecimal);
//
var discount = parseFloat(discountPercent);
markedPrice = ((salesPrice*100)/(100-discount));
markedPrice = markedPrice.toFixed(2)
document.getElementById('markedPriceShow').value=markedPrice;
}

</script>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = "";
$m_category_a_error = "";
$m_category_b_error = "";
$m_category_c_error = "";
$m_category_d_error = "";
$m_og_image_title_error = "";
$m_og_image_description_error = "";
$m_showroom_id_error = "";
$m_size_error = "";
$m_costprice_price_error = "";
$m_stock_error = "";
$m_profit_percent_error = "";
$m_discount_percent_error = "";
$m_marked_price_error = "";
$m_vat_tax_error = "";
$m_weight_error = "";
$m_handling_packing_error = "";
$m_video_link_error = "";
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>
<?php
if(isset($_REQUEST['bay_merchant_add_items']))
{
extract($_REQUEST);
//
$m_marked_price = floatval(number_format(($_POST["m_marked_price"]),2,'.',''));
$m_marked_price = floatval(number_format(($m_marked_price),1,'.',''));
//
$partOneStringToDecimal = floatval(number_format(($m_costprice_price),2,'.',''));
$partTwoStringToDecimal = intval($m_profit_percent);
$salesPrice = (((0.01*$partTwoStringToDecimal*$partOneStringToDecimal)+$partOneStringToDecimal));
$salesPrice = floatval(number_format(($salesPrice),2,'.',''));
$discount = floatval(number_format(($m_discount_percent),2,'.',''));
$markedPrice = ($salesPrice*100)/(100-$discount);
$markedPrice = floatval(number_format($markedPrice,2,'.',''));
$markedPrice = floatval(number_format($markedPrice,1,'.',''));
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
elseif (strpos($m_og_image_title, $merchant->visulString($m_category_d)) === false)
{
$keyWord = $merchant->visulString($m_category_d);
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
$m_og_image_description_error = "<b class='text-warning'>Some special letter problem minimum 3 maximum 3000.</b>";
$error =1;
}
/* SEO valitation m_og_image_description */
elseif (strpos($m_og_image_description, $merchant->visulString($m_category_d)) === false)
{
$keyWord = $merchant->visulString($m_category_d);
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

/* m_size */
if (empty($_REQUEST["m_size"]))
{
$m_size_error = "<b class='text-warning'>Size Required</b>";
$error =1;
} 
/* valitation m_size Tested */
elseif (! preg_match("/^([a-zA-Z0-9\/\-\,\.\(\)]{1,16})$/",$m_size))
{
$m_size_error = "<b class='text-warning'>Characters Problem.</b>";
$error =1;
}
else 
{
$m_size = $sanitization -> test_input($_POST["m_size"]);
}
/* m_costprice_price */
if (empty($_REQUEST["m_costprice_price"]))
{
$m_costprice_price_error = "<b class='text-warning'>Price Required</b>";
$error =1;
} 
/* valitation m_costprice_price  Tested*/
elseif (! preg_match("/^([0-9]{1,6}[.]{1,1}[0-9]{2,2})$/",$m_costprice_price))
{
$m_costprice_price_error = "<b class='text-warning'>Max 999999.99 ".primaryCurrency."</b>";
$error =1;
}
else 
{
$m_costprice_price = $sanitization -> test_input($_POST["m_costprice_price"]);
}

/* m_stock */
if (empty($_REQUEST["m_stock"]))
{
$m_stock_error = "<b class='text-warning'>Stock Required</b>";
$error =1;
} 
/* valitation m_stock  Tested*/
elseif (! preg_match("/^([0-9]{1,6})$/",$m_stock))
{
$m_stock_error = "<b class='text-warning'>Numbers Only Max 999999</b>";
$error =1;
}
else 
{
$m_stock = $sanitization -> test_input($_POST["m_stock"]);
}
/* m_profit_percent */
if (empty($_REQUEST["m_profit_percent"]))
{

} 
/* valitation m_profit_percent  Tested */
elseif (! preg_match("/^([0-4]{0,1}[0-9]{0,2})$/",$m_profit_percent))
{
$m_profit_percent_error = "<b class='text-warning'>Numbers Only Max 499</b>";
$error =1;
}
else 
{
$m_profit_percent = $sanitization -> test_input($_POST["m_profit_percent"]);
}
/* m_discount_percent */
if (empty($_REQUEST["m_discount_percent"]))
{

} 
/* valitation m_discount_percent  Tested */
elseif (! preg_match("/^([0-8]{0,1}[0-9]{0,1}[.]{1,1}[0-9]{2,2})$/",$m_discount_percent))
{

}
else 
{
$m_discount_percent = $sanitization -> test_input($_POST["m_discount_percent"]);
}
/* m_marked_price */
if (empty($_REQUEST["m_marked_price"]))
{
$m_marked_price_error = "<b class='text-warning'>Price Required</b>";
$error =1;
} 
/* valitation m_marked_price  Tested */
elseif (! preg_match("/^([0-9]{1,8}[.]{1,1}[0-9]{2,2})$/",$m_marked_price))
{

}
elseif ($m_marked_price !== $markedPrice)
{
$m_marked_price_error = "<b class='text-warning'>Marked Price ".primaryCurrency." $markedPrice?</b>";
$error =1;
}
else 
{
$m_marked_price = $sanitization -> test_input($_POST["m_marked_price"]);
}
/* m_vat_tax */
if (empty($_REQUEST["m_vat_tax"]))
{
$m_vat_tax_error = "<b class='text-warning'>VAT/GST/TAX Required</b>";
$error =1;
}
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
if (!preg_match('/^([a-zA-Z0-9\,\.\/\+\?\-\=\_\-]{3,255})$/',$m_video_link))
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
if($error == 0){
extract($_REQUEST);
$merchant->submit_new_merchant_item($m_category_a, $m_category_b, $m_category_c, $m_category_d, $m_og_image_title, $m_og_image_description, $m_showroom_id, $m_size, $m_costprice_price, $m_stock, $m_profit_percent, $m_marked_price, $m_discount_percent, $m_vat_tax, $m_weight, $m_handling_packing, $m_video_link, $m_country_of_origin);
}
//
}
?>
      <div class='well'>
        <form method="post" enctype="multipart/form-data">
          <fieldset class='group-select'>
            <input type='hidden' name='form_key' value='<?php echo $formKey->outputKey(); ?>'>
            <?php echo $formKey_error; ?>
            <?php $categoryes = new ebapps\bay\ebcart(); ?>
            <div class='input-group'> <span class='input-group-addon'>Select Category A: <?php echo $m_category_a_error;  ?></span>
              <select id='m_category_a' name='m_category_a' class='form-control' required autofocus>
                <option>Please Select</option>
                <?php $categoryes->select_category_a(); ?>
              </select>
            </div>
            <div class='input-group'> <span class='input-group-addon'>Select Category B: <?php echo $m_category_b_error;  ?></span>
              <select class='form-control' id='m_category_b' name='m_category_b' required autofocus /></select>
            </div>
            <div class='input-group'> <span class='input-group-addon'>Select Category C: <?php echo $m_category_c_error;  ?></span>
              <select class='form-control' id='m_category_c' name='m_category_c' required autofocus /></select>
            </div>
            <div class='input-group'> <span class='input-group-addon'>Select Category D: <?php echo $m_category_d_error;  ?></span>
              <select class='form-control' id='m_category_d' name='m_category_d' required autofocus /></select>
            </div>
            Item Title: <?php echo $m_og_image_title_error; ?>
            <input class='form-control' type="text" name='m_og_image_title' required autofocus />
            Description: <?php echo $m_og_image_description_error; ?>
            <textarea class='form-control' name='m_og_image_description' rows='6' placeholder='Do not use any Special Characters' id='WhatToDo' required autofocus></textarea>
            <div class='input-group'><span class='input-group-addon' id='sizing-addon2'>Showroom ID: <?php echo $m_showroom_id_error;  ?></span>
              <input class='form-control' type='text' name='m_showroom_id' placeholder='Showroom ID' class='form-control' aria-describedby='sizing-addon2' required autofocus />
            </div>
            <div class='input-group'> <span class='input-group-addon'>Select a Size: <?php echo $m_size_error; ?></span>
              <select name='m_size' class='form-control' required autofocus>
                <?php $obj = new ebapps\bay\ebcart(); $obj -> select_size_merchant(); ?>
              </select>
            </div>
            <div class='input-group'> <span class='input-group-addon'>Cost Price <?php echo primaryCurrency; ?> (1 <?php echo primaryCurrency; ?> = <?php echo convertSecondary; ?> <?php echo secondaryCurrency; ?>):</span><?php echo $m_costprice_price_error;  ?>
              <input type='hidden' value='' id='costPriceShow'>
              <input type='number' step='0.01' min="0.01" max='999999.99' name='m_costprice_price' id='costPrice' value='' placeholder='999999.99' required onchange='costPriceShowFunction(this.value);' class='form-control' aria-describedby='sizing-addon2' required autofocus />
            </div>
            <dt class='last even'>Profit Percent: <?php echo $m_profit_percent_error;  ?>
              <input type='button' id='profitShow' />
            </dt>
            <dd class='last even'>
            <!-- Profit percent = Sales commission 30% + Free Delevery 15% + Depreciation cost 15% + Profit 15% + Promitional cost 100% -->
              <input type='range' name='m_profit_percent' id='profitPercent' min='0' max='499' onchange="profitPercentFunction(this.value);" required autofocus>
            </dd>
            <dt class='last even'>Discount Percent: <?php echo $m_discount_percent_error;  ?>
              <input type='button' id='discountShow' />
            </dt>
            <dd class='last even'>
              <input type='range' name='m_discount_percent' id='discountPercent' step='0.01' min='0.00' max='89.99' onchange="discountFunction(this.value);" required autofocus>
            </dd>
            <div class='input-group'> <span class='input-group-addon'>Marked Price <?php echo $m_marked_price_error;  ?> <?php echo primaryCurrency; ?> (1 <?php echo primaryCurrency; ?> = <?php echo convertSecondary; ?> <?php echo secondaryCurrency; ?>):</span>
              <input class='form-control' min='0.00' type='number' step='0.01' max='99999999.99' name='m_marked_price' value='' id='markedPriceShow' placeholder='99999999.99' required />
            </div>
            <div class='input-group'><span class='input-group-addon' id='sizing-addon2'>Stock: <?php echo $m_stock_error;  ?></span>
              <input class='form-control' type='number' name='m_stock' placeholder='999999' required />
            </div>
            <div class='input-group'> <span class='input-group-addon'>VAT/GST/TAX in Percent <?php echo $m_vat_tax_error;  ?>:</span>
              <input class='form-control' type='number' name='m_vat_tax' step='0.01' placeholder='499.99' required autofocus />
            </div>
            <div class='input-group'> <span class='input-group-addon'>Weight in kg <?php echo $m_weight_error;  ?>:</span>
              <input class='form-control' type='number' name='m_weight' step='0.01' max='24.99' placeholder='24.99' required autofocus />
            </div>
            <div class='input-group'> <span class='input-group-addon'>Packing per Unit <?php echo $m_handling_packing_error;  ?> <?php echo primaryCurrency; ?>:</span>
              <input class='form-control' type='number' min='0.00' step='0.01' name='m_handling_packing' placeholder='99999999.99' required autofocus />
            </div>
            <div class='input-group'> <span class='input-group-addon'>Video link whthout https://www:</span><?php echo $m_video_link_error;  ?>
              <input class='form-control' type='text' name='m_video_link' placeholder='youtube.com' />
            </div>
            <div class='input-group'> <span class='input-group-addon'>Delivery From:</span>
<?php 
$adminZone = new ebapps\bay\ebcart();
$adminZone ->admin_dhl_shipping_zone();
if($adminZone->eBData >= 1)
{
foreach($adminZone->eBData as $val)
{
extract($val);
echo "<select><option>$admin_country_name</option></select>";
}
}
echo "<input type='hidden' name='m_country_of_origin' value='$admin_dhl_country_id' />";
?>
            </div>
            <div class='buttons-set'>
              <button type='submit' name='bay_merchant_add_items' title='Submit' class='button submit'> <span> Submit </span> </button>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
    <div class='col-xs-12 col-md-3 eb-gap sidebar-offcanvas'>
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

