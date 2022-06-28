<!--#video-->
<?php $obj= new ebapps\bay\ebcart(); $obj -> item_details($productid); ?>
<?php if($obj->eBData > 0) { foreach($obj->eBData as $val): extract($val);
if(!empty($s_video_link)) { ?>
<section id='video' class='video'>
<div class='container'>
<div class='row'>    
<div class='col-xs-12'>
<div class='thumbnail text-center homeCategory'>
<h3 title='<?php echo stripslashes($s_og_image_title); ?>'><?php echo stripslashes($s_og_image_title); ?></h3>
<div class='bs-example' data-example-id='responsive-embed-16by9-iframe-youtube'>
<div class='embed-responsive embed-responsive-16by9'>
<iframe class='embed-responsive-item' src='<?php echo hypertextWithOrWithoutWww.$s_video_link; ?>' allowfullscreen=''> </iframe>
</div>
</div>
</div>
</div>

</div>
</div>
</section>
<?php } endforeach;  }  ?>
<!--/#video-->