<?php $obj= new ebapps\blog\blog(); $obj -> contents_download($articleno); ?>
<?php if($obj->eBData >= 1) { ?>
<?php foreach($obj->eBData as $val): extract($val); ?>
<?php if(!empty($contents_preview_link)){ ?>
<a class='eb-cart-back' href='<?php echo hypertextWithOrWithoutWww.$contents_preview_link; ?>' target='_blank'>Preview</a>
<?php } ?>
<?php if(!empty($contents_github_link)){ ?>
<a class='eb-cart-back' href='<?php echo hypertextWithOrWithoutWww.$contents_github_link; ?>' target='_blank'>Download</a>
<?php } endforeach; } ?>