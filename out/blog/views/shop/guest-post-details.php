<?php include_once (dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/initialize.php'); ?>
<?php 
$obj= new ebapps\blog\blog(); 
$obj -> contents_detail_how_to_do_guest($articleno); 
if($obj->eBData >= 1)
{ 
foreach($obj->eBData as $val): extract($val); 
if(!empty($contents_og_image_what_to_do))
{  
$whatToDo ="<div class='well'>";
$whatToDo .=$contents_og_image_what_to_do;
$whatToDo .="</div>";
echo $whatToDo;  
} 
endforeach;
} 
$obj = new ebapps\blog\blog(); 
$obj -> contents_detail_how_to_do_guest($articleno);
if($obj->eBData >= 1) {
foreach($obj->eBData as $val): extract($val);
if(!empty($contents_og_image_how_to_solve)){
$howToDo ="<div class='well'>";
$howToDo .=$contents_og_image_how_to_solve;
$howToDo .="</div>";
echo $howToDo;  
} 
endforeach;
} 
include_once("guest-download.php"); 
echo "<br><br>";
include_once("guest-post-video.php");
include_once("guest-comments.php");
?>
