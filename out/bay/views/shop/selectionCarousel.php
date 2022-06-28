<?php $obj= new ebapps\bay\ebcart(); $obj -> bayProductAllCD($eBCategoryCC, $eBCategoryDD); ?>
<?php if($obj->eBData > 0) { ?>
<div class="category-description std">
          <div class="slider-items-products">
            <div id="category-desc-slider" class="product-flexslider hidden-buttons">
              <div class="slider-items slider-width-col1 owl-carousel owl-theme"> 
                <?php foreach($obj->eBData as $val): extract($val); ?>
                <!-- Item -->
                <div class="item"> <a href="<?php echo outBayLink; ?>/product/item-details-grid/<?php echo $bay_showroom_approved_items_id; ?>/"><img alt="<?php echo stripslashes($s_og_image_title); ?>" src="<?php echo hypertextWithOrWithoutWww.$s_og_image_url; ?>"></a>
                  <div class="cat-img-title cat-bg cat-box">
                    <div class="small-tag"><?php echo $obj->visulString($s_category_c); ?></div>
                    <h2 class="cat-heading"><?php echo strtoupper($obj->visulString($s_category_d)); ?></h2>
                    <p><?php echo stripslashes($s_og_image_title); ?></p>
                  </div>
                </div>
                <?php endforeach;  ?>
                <!-- End Item --> 
              </div>
            </div>
          </div>
        </div>		
<?php } ?>