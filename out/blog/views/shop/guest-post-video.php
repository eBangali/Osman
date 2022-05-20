<?php include_once (dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/initialize.php');
$obj= new ebapps\blog\blog();
$obj -> contents_detail_video_guest($articleno);
if($obj->eBData >= 1)
{
foreach($obj->eBData as $val): extract($val);
if(!empty($contents_video_link))
{
?>
<div class="bs-example" data-example-id="responsive-embed-16by9-iframe-youtube">
<div class="embed-responsive embed-responsive-16by9">
<iframe class="embed-responsive-item" src="<?php echo hypertextWithOrWithoutWww.$contents_video_link; ?>" allowfullscreen=""> </iframe>
</div>
</div>    
<?php
}
endforeach;
}
?>
