<?php $objabcdid = new ebapps\bay\ebcart(); $objabcdid -> new_arrival_desc_carousel_abcdid(); ?>
<?php if($objabcdid->eBData > 0) { ?>
<div id='rev_slider_4_wrapper' class='rev_slider_wrapper fullwidthbanner-container'>
<div id='rev_slider_4' class='rev_slider fullwidthabanner'>
<ul>
<?php foreach($objabcdid->eBData as $valobjabcdid): extract($valobjabcdid); ?>
<?php $objcategory= new ebapps\bay\ebcart(); $objcategory -> new_arrival_desc_carousel($maxid); ?>
<?php if($objcategory->eBData > 0) { ?>
<?php foreach($objcategory->eBData as $valcategory): extract($valcategory); ?>
<li data-transition='random' data-slotamount='7' data-masterspeed='1000' data-thumb='<?php echo hypertextWithOrWithoutWww.$s_og_image_url; ?>'><img src='<?php echo hypertextWithOrWithoutWww.$s_og_image_url; ?>' alt='<?php echo stripslashes($s_og_image_title); ?>' data-bgposition='left top' data-bgfit='cover' data-bgrepeat='no-repeat' />
<div class='info'>
<div class='tp-caption ExtraLargeTitle sft tp-resizeme' data-endspeed='500' data-speed='500' data-start='1100' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1'><span class='eBTextBack'><?php echo $objcategory->visulString($s_category_c); ?></span> </div>
<div class='tp-caption sfb  tp-resizeme' data-endspeed='500' data-speed='500' data-start='1500' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1'><a href='<?php echo outBayLink; ?>/product/item-details-grid/<?php echo $bay_showroom_approved_items_id; ?>/' class='buy-btn eBTextBack'>Shop Now</a></div>
</div>
</li>
<?php endforeach; } ?>
<?php endforeach;  ?>
</ul>
</div>
</div><!-- Slider -->
<?php } ?>