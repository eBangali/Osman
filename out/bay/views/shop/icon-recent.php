<?php $obj= new ebapps\bay\ebcart(); $obj -> icon_find_products(); ?>
<?php if($obj->eBData){ $i= 0; foreach($obj->eBData as $val): extract($val); ?>
<div class="col-xs-4">
<div class="thumbnail text-center homeCategory <?php if($i%4==1){ echo "animationOne";} elseif($i%4==2){echo "animationTwo";} elseif($i%4==3){ echo "animationThree";} elseif($i%4==0){ echo "animationFour";} ?>">
<a href="<?php echo outBayLink; ?>/product/item-details-grid/<?php echo $bay_showroom_approved_items_id; ?>/"><img src="<?php echo hypertextWithOrWithoutWww.$s_og_small_image_url; ?>" alt="<?php echo stripslashes($s_og_image_title); ?>" title="<?php echo stripslashes($s_og_image_title); ?>" /></a>
<i class="fa fa-star awsamColor" aria-hidden="true"> <?php echo number_format($s_discount_percent,2,'','')." % OFF"; ?></i>
<p title="<?php echo stripslashes($s_og_image_title); ?>"><a href="<?php echo outBayLink; ?>/product/item-details-grid/<?php echo $bay_showroom_approved_items_id; ?>/" class="btn btn-primary" role="button"><?php echo number_format($discountprice,2,".",""); ?> </a></p>
</div>
</div>
<?php $i++; endforeach; } ?>