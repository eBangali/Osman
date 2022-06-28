<div class='container'>
<div class='row'>
<div class='col-xs-12'>
<div class='breadcrumbs'>
<ul>
<li class='home'><a href='<?php echo outBayLink; ?>/product/' title='HOME'> HOME</a><span>/ </span></li>
<?php if(isset($_GET['id'])){
$productid = $_GET['id']; 
?>
<?php $obj= new ebapps\bay\ebcart(); $obj -> itemPageInnation($productid); ?>
<?php  if($obj->eBData) { foreach($obj->eBData as $val){ extract($val); ?>
<li><a href='<?php echo outBayLink; ?>/product/list/<?php echo $bay_showroom_approved_items_id; ?>/<?php echo $this->seoUrl($s_category_a); ?>/<?php echo $this->seoUrl($s_category_b); ?>/<?php echo $this->seoUrl($s_category_c); ?>/<?php echo $this->seoUrl($s_category_d); ?>/'><strong><?php echo strtoupper($obj->visulString($s_category_a)); ?></strong></a><span>/ </span></li>
<li><a href='<?php echo outBayLink; ?>/product/list/<?php echo $bay_showroom_approved_items_id; ?>/<?php echo $this->seoUrl($s_category_a); ?>/<?php echo $this->seoUrl($s_category_b); ?>/<?php echo $this->seoUrl($s_category_c); ?>/<?php echo $this->seoUrl($s_category_d); ?>/'><strong><?php echo strtoupper($obj->visulString($s_category_b)); ?></strong></a><span>/ </span></li>
<li><a href='<?php echo outBayLink; ?>/product/list/<?php echo $bay_showroom_approved_items_id; ?>/<?php echo $this->seoUrl($s_category_a); ?>/<?php echo $this->seoUrl($s_category_b); ?>/<?php echo $this->seoUrl($s_category_c); ?>/<?php echo $this->seoUrl($s_category_d); ?>/'><strong><?php echo strtoupper($obj->visulString($s_category_c)); ?></strong></a><span>/ </span></li>
<li><a href='<?php echo outBayLink; ?>/product/list/<?php echo $bay_showroom_approved_items_id; ?>/<?php echo $this->seoUrl($s_category_a); ?>/<?php echo $this->seoUrl($s_category_b); ?>/<?php echo $this->seoUrl($s_category_c); ?>/<?php echo $this->seoUrl($s_category_d); ?>/'><strong><?php echo strtoupper($obj->visulString($s_category_d)); ?></strong></a><span>/ </span></li>
<li><a href='<?php echo outBayLink; ?>/product/seller/<?php echo $bay_showroom_approved_items_id; ?>/<?php echo $this->seoUrl($s_category_a); ?>/<?php echo $this->seoUrl($s_category_b); ?>/<?php echo $this->seoUrl($s_category_c); ?>/<?php echo $this->seoUrl($s_category_d); ?>/'><strong><?php echo strtoupper($obj->visulString($username_merchant)); ?></strong></a></li><?php }}} ?>
</ul>
</div>
</div>
</div>
</div>