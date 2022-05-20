<?php $obj= new ebapps\blog\blog(); $obj -> contents_detail_how_to_do($articleno); ?>
<?php if($obj->eBData >= 1) { ?>
<?php foreach($obj->eBData as $val): extract($val); ?>
<?php if(!empty($contents_og_image_what_to_do)){ ?>
<?php 
$whatToDo ="<div class='well'>";
$whatToDo .=$contents_og_image_what_to_do;
$whatToDo .="</div>";
echo $whatToDo;  
?>
<?php } endforeach; } ?>
<?php $obj= new ebapps\blog\blog(); $obj -> contents_detail_how_to_do($articleno); ?>
<?php if($obj->eBData >= 1) { ?>
<?php foreach($obj->eBData as $val): extract($val); ?>
<?php if(!empty($contents_og_image_how_to_solve)){ ?>
<?php 
$howToDo ="<div class='well'>";
$howToDo .=$contents_og_image_how_to_solve;
$howToDo .="</div>";
echo $howToDo;  
?>
<?php } endforeach; } ?>
<?php include_once("download.php"); ?>
<br />
<br />
<?php include_once("post-video.php"); ?>
<?php include_once("comments.php"); ?>