<?php $obj= new ebapps\blog\blog(); $obj -> contents_detail_how_to_do($articleno); ?>
<?php if($obj->eBData >= 1) { ?>
<?php foreach($obj->eBData as $val): extract($val); ?>
<?php if(!empty($contents_og_image_what_to_do)){ ?>
<?php 
$whatToDo ="<div class='well'>";
//
$phraseCat = substr($contents_og_image_what_to_do, 0, 10000);
$phraseOne = str_replace($obj->visulString($contents_category), "<b>".$obj->visulString($contents_category)."</b>", $phraseCat);
$phraseTwo = str_replace($obj->visulString($contents_sub_category), "<em>".$obj->visulString($contents_sub_category)."</em>", $phraseOne);
$whatToDo .= $phraseTwo;
//
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
//
$seoCat = substr($contents_og_image_how_to_solve, 0, 10000);
$seoOne = str_replace($obj->visulString($contents_category), "<b>".$obj->visulString($contents_category)."</b>", $seoCat);
$seoTwo = str_replace($obj->visulString($contents_sub_category), "<em>".$obj->visulString($contents_sub_category)."</em>", $seoOne);
$howToDo .= $seoTwo;
//
$howToDo .="</div>";
echo $howToDo;  
?>
<?php } endforeach; } ?>
<?php include_once("download.php"); ?>
<br />
<br />
<?php include_once("post-video.php"); ?>
<?php include_once("comments.php"); ?>