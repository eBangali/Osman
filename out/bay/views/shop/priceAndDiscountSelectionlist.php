<script language='javascript'>
function updateTextInputPriceMin(val){
document.getElementById('priceMinShow').value=val; 
}
function updateTextInputPriceMax(val){
document.getElementById('priceMaxShow').value=val; 
}
function updateTextInputDiscount(val){
document.getElementById('discountShow').value=val; 
}
</script>
<div class='block block-layered-nav'>
      <div class='block-title'>Shop By</div>
      <div class='block-content'>
        <dl id='narrow-by-list'>
        <?php
$obj= new ebapps\bay\ebcart();
$obj -> itemPageInnation($productid);
if($obj->eBData > 0) { foreach($obj->eBData as $val){ extract($val);
?>
<form method='post' action='<?php echo outBayLink; ?>/product/selectionlist/<?php echo $bay_showroom_approved_items_id; ?>/<?php echo $this->seoUrl($s_category_a); ?>/<?php echo $this->seoUrl($s_category_b); ?>/<?php echo $this->seoUrl($s_category_c); ?>/<?php echo $this->seoUrl($s_category_d); ?>/'>
<?php }} ?> 
          <div class='odd'>Min Price <?php echo primaryCurrency; ?> <input type='number' min='0' max='900' value='0' class='form-control' id='priceMinShow'></div>     
          <div class='odd'>
          <input type='range' name='price-min' id='price-min' value='0' min='0' max='<?php echo number_format( 900,0,'.',''); ?>' onchange="updateTextInputPriceMin(this.value);">
          </div>
          <div class='odd'>Max Price <?php echo primaryCurrency; ?> <input type='number' min='900' max='9000' value='900' class='form-control' value='<?php echo number_format(9000,0,'.',''); ?>' id='priceMaxShow'></div>
          <div class='odd'>
          <input type='range' name='price-max' id='price-max' value='900' min='900' max='<?php echo number_format(9000,0,'.',''); ?>' onchange="updateTextInputPriceMax(this.value);">
          </div>
          <div class='last even'>Max Discount %<input type='number' min='0' max='80' value='50' class='form-control' id='discountShow'></div>
          <div class='last even'>
          <input type='range' name='discount-max' id='discount-max' value='50' min='0' max='80' onchange="updateTextInputDiscount(this.value);">
          </div>
          <button type='submit' name='selectionSearch' class='button submit' title='Search'><i class='fa fa-search-plus fa-lg' aria-hidden='true'></i> <b>Search</b> </button>
          </form>
        </dl>
      </div>
    </div>