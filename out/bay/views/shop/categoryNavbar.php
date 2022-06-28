<div class='side-nav-categories'>
<div class='block-title'> Categories </div>
<div class='box-content box-category'>
<ul>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php $category = new ebapps\bay\ebcart(); $category ->menu_category_showroom(); ?>
<?php if($category->eBData >= 1) { ?>
<?php foreach($category->eBData as $catval): extract($catval); ?>
<?php if (!empty($s_category_a)){ ?>
<li> <a class='active' href='<?php echo outBayLink; ?>/product/list/<?php echo $bay_showroom_approved_items_id; ?>/<?php echo $this->seoUrl($s_category_a); ?>/<?php echo $this->seoUrl($s_category_b); ?>/<?php echo $this->seoUrl($s_category_c); ?>/<?php echo $this->seoUrl($s_category_d); ?>/'>
<?php $cat = $s_category_a; echo $category->visulString($s_category_a); ?>
</a> <span class='subDropdown minus'></span>
<ul class='level0_415' style='display:block'>
<?php $subcategory = new ebapps\bay\ebcart(); $subcategory ->menu_sub_category_showroom($cat); ?>
<?php if($subcategory->eBData >= 1) { ?>
<?php $bayHasSep =0; foreach($subcategory->eBData as $subval): extract($subval); ?>
<?php if (!empty($s_category_a) and !empty($s_category_b)){ ?>
<?php $catSub = $s_category_a; $catSubSub = $s_category_b; ?>
<li> <a href='<?php echo outBayLink; ?>/product/list/<?php echo $bay_showroom_approved_items_id; ?>/<?php echo $this->seoUrl($s_category_a); ?>/<?php echo $this->seoUrl($s_category_b); ?>/<?php echo $this->seoUrl($s_category_c); ?>/<?php echo $this->seoUrl($s_category_d); ?>/'><?php echo $subcategory->visulString($s_category_b); ?></a> <span class='subDropdown plus'></span>
<ul class='level1' style='display:none'>
<?php $subSubcategory = new ebapps\bay\ebcart(); $subSubcategory ->menu_sub_sub_category_showroom($catSub,$catSubSub); ?>
<?php if($subSubcategory->eBData >= 1) { ?>
<?php foreach($subSubcategory->eBData as $subsubval): extract($subsubval); ?>
<?php if (!empty($s_category_a) and !empty($s_category_b) and !empty($s_category_c)){ ?>
<li><a href='<?php echo outBayLink; ?>/product/list/<?php echo $bay_showroom_approved_items_id; ?>/<?php echo $this->seoUrl($s_category_a); ?>/<?php echo $this->seoUrl($s_category_b); ?>/<?php echo $this->seoUrl($s_category_c); ?>/<?php echo $this->seoUrl($s_category_d); ?>/'><?php echo $subSubcategory->visulString($s_category_c); ?></a></li>
<?php } endforeach; } ?>
</ul>
</li>
<?php  } $bayHasSep++; endforeach; } ?>
</ul>
</li>
<?php } endforeach; } ?>
<!--End eCommerce Dextop Menue-->
</ul>
</div> 
</div>

