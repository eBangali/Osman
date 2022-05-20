<?php include_once (ebblog.'/blog.php'); ?>
<?php if(isset($_GET['id'])){$contentsid = $_GET['id']; ?>
<?php $obj= new ebapps\blog\blog(); $obj -> content_item_details_seo($contentsid); ?>
<?php  if($obj->data >= 1) { foreach($obj->data as $val){ extract($val); ?>
<div class='social-share-vertical'>
<ul>
<li class="pinterest"><a target="_blank" href="<?php echo hypertextWithOrWithoutWww; ?>pinterest.com/pin/create/button/?url=<?php if(isset($_SESSION['ebusername'])){ echo fullUrl.$_SESSION['ebusername']."/"; } else {echo fullUrl;}?>&media=<?php echo hypertextWithOrWithoutWww.$contents_og_small_image_url; ?>&description=<?php echo ucfirst($obj->visulString($contents_sub_category)); ?> <?php echo ucfirst($contents_og_image_title); ?>"  title="Pin It"><i class="fa fa-pinterest"></i></a></li>
<li class='twitter'><a target='_blank' href='<?php echo hypertextWithOrWithoutWww; ?>twitter.com/share?url=<?php if(isset($_SESSION['ebusername'])){ echo fullUrl.$_SESSION['ebusername']."/"; } else {echo fullUrl;}?>' title="Share to Twitter"><i class='fa fa-twitter'></i></a></li>
<li class='facebook'><a target='_blank' href='<?php echo hypertextWithOrWithoutWww; ?>facebook.com/sharer/sharer.php?u=<?php if(isset($_SESSION['ebusername'])){ echo fullUrl.$_SESSION['ebusername']."/"; } else {echo fullUrl;}?>' title="Share to Facebook"><i class='fa fa-facebook'></i></a></li>
</ul>
</div>
<?php }}} ?>
<?php if(empty($_GET['id'])){ ?>
<?php $obj= new ebapps\blog\blog(); $obj -> content_item_details_seo_last(); ?>
<?php if($obj->data >= 1) { foreach($obj->data as $val){ extract($val); ?>
<div class='social-share-vertical'>
<ul>
<li class="pinterest"><a target="_blank" href="<?php echo hypertextWithOrWithoutWww; ?>pinterest.com/pin/create/button/?url=<?php if(isset($_SESSION['ebusername'])){ echo fullUrl.$_SESSION['ebusername']."/"; } else {echo fullUrl;}?>&media=<?php echo hypertextWithOrWithoutWww.$contents_og_small_image_url; ?>&description=<?php echo ucfirst($obj->visulString($contents_sub_category)); ?> <?php echo ucfirst($contents_og_image_title); ?>" title="Pin It"><i class="fa fa-pinterest"></i></a></li>
<li class='twitter'><a target='_blank' href='<?php echo hypertextWithOrWithoutWww; ?>twitter.com/share?url=<?php if(isset($_SESSION['ebusername'])){ echo fullUrl.$_SESSION['ebusername']."/"; } else {echo fullUrl;}?>' title="Share to Twitter"><i class='fa fa-twitter'></i></a></li>
<li class='facebook'><a target='_blank' href='<?php echo hypertextWithOrWithoutWww; ?>facebook.com/sharer/sharer.php?u=<?php if(isset($_SESSION['ebusername'])){ echo fullUrl.$_SESSION['ebusername']."/"; } else {echo fullUrl;}?>' title="Share to Facebook"><i class='fa fa-facebook'></i></a></li>
</ul>
</div>
<?php } } } ?>
