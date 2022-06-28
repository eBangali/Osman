<?php include_once(ebbay.'/ebcart.php'); ?>
<?php if(isset($_GET['id'])){$productid = $_GET['id']; ?>
<?php $obj= new ebapps\bay\ebcart(); $obj -> item_details($productid); ?>
<?php  if($obj->eBData >= 1) { foreach($obj->eBData as $val){ extract($val); ?>
<div class='social-share-vertical'>
<ul>
<li class='twitter'><a target='_blank' href='<?php echo hypertextWithOrWithoutWww; ?>twitter.com/share?url=<?php if(isset($_SESSION['ebusername'])){ echo fullUrl.$_SESSION['ebusername']."/"; } else {echo fullUrl;}?>'><i class='fa fa-twitter'></i></a></li>
<li class='facebook'><a target='_blank' href='<?php echo hypertextWithOrWithoutWww; ?>facebook.com/sharer/sharer.php?u=<?php if(isset($_SESSION['ebusername'])){ echo fullUrl.$_SESSION['ebusername']."/"; } else {echo fullUrl;}?>'><i class='fa fa-facebook'></i></a></li>
</ul>
</div>
<?php }}} ?>