<script>
$(document).ready(function(){
$("#search").keyup(function(){
var searchQuery = $(this).val();
if(searchQuery != '')  
{
$.ajax
({
type: "POST",
url: "<?php echo outBayLink; ?>/autosuggestion_bay.php",
data: "searchQuery="+ searchQuery,
success: function(data)
{
$('#match-list').fadeIn();
$('#match-list').html(data);
}
});
}
else
{
$('#match-list').fadeOut();
$('#match-list').html('');
}
});

$(document).on('click','li',function()
{
$('#search').val($(this).text());
$('#match-list').fadeOut();
});

});
</script>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = '';
$search_bay_error = '';
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>
<?php
if(isset($_REQUEST['submit_search_bay']))
{
extract($_REQUEST);

/* Form Key*/
if(isset($_REQUEST['form_key']))
{
$form_key = preg_replace('#[^a-zA-Z0-9]#i','',$_POST['form_key']);
if($formKey->read_and_check_formkey($form_key) == true)
{

}
else
{
$formKey_error = "<b class='text-warning'>Sorry too busy please try again later.</b>";
$error = 1;
}
}

/* search_bay */
if (empty($_REQUEST['search_bay']))
{
$search_bay_error = "<b class='text-warning'>Keyword required</b>";
$error =1;
} 
/* valitation search_bay  */
elseif (! preg_match('/^([A-Za-z\-\ ]+){2,24}$/',$search_bay))
{
$search_bay_error = "";
$error =1;
}
else 
{
$search_bay = $sanitization -> test_input($_POST['search_bay']);
}
?>
<?php } ?>
<div class='col-lg-7 col-md-5 col-sm-5 col-xs-3 hidden-xs category-search-form'>
<div class='search-box'>
<form id='search_mini_form' method='post'>
<select name='cat' id='cat' class='cate-dropdown hidden-sm hidden-md'>
<option value=''>All Categories</option>
<?php
$category = new ebapps\bay\ebcart();
$category ->menu_category_showroom();
?>
<?php if($category->eBData >= 1) { ?>
<?php foreach($category->eBData as $catval): extract($catval); ?>
<?php if (!empty($s_category_a)){ ?>
<option value='<?php echo $s_category_a; ?>'><?php echo $category->visulString($s_category_a); ?></option>
<?php } ?>
<?php endforeach; } ?>
</select>
<!-- Autocomplete End code -->
<input id='search' type='text' name='search_bay' value='<?php echo $search_bay_error;  ?><?php echo $formKey_error; ?>' class='searchbox' required />
<input type='hidden' name='form_key' value='<?php echo $formKey->outputKey(); ?>'>
<button type='submit' name='submit_search_bay' title='Search' class='search-btn-bg' id='submit-button'><span>Search</span></button>
</form>
<div id='match-list'></div>
</div>
</div>
<div class='col-lg-3 col-md-4 col-sm-4 col-xs-12 card_wishlist_area'>
<div class='mm-toggle-wrap'>
<div class='mm-toggle'><i class='fa fa-align-justify'></i><span class='mm-label'>Menu</span> </div>
</div>
<div class='top-cart-contain'> 
<!-- Top Cart -->
<div class='mini-cart'>
<?php if(isset($_SESSION['cart']))
{
?>
<div class='basket'><a href='<?php echo outBayLink; ?>/product/checkout/'><span class='price'><?php echo primaryCurrencySign; ?><?php echo number_format($_SESSION['total_payment'],2,".",""); ?></span> <span class='cart_count'><?php echo $_SESSION['total_items']; ?></span> </a> </div>
<?php
}
else
{
?>
<div class='basket'><a href='<?php echo outBayLink; ?>/product/checkout/'><span class='price'><?php echo primaryCurrencySign; ?><?php echo number_format(0.00,2,".",""); ?></span> <span class='cart_count'><?php echo 0; ?></span> </a> </div>
<?php
} 
?>
</div>
</div>
<!-- mgk home -->
<div class='mgk-ebhome'><a title='My Home' href='<?php echo outBayLink; ?>/product/'><i class='fa fa-home'></i><span class='title-ebhome hidden-xs'></span></a></div>
<!-- mgk wishlist -->
<div class='mgk-wishlist'><a title='My Wishlist' href='<?php echo outBayLink; ?>/product/wishlist/'><i class='fa fa-heart'></i><span class='title-wishlist hidden-xs'></span></a></div>
</div>