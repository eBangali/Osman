<?php $obj= new ebapps\blog\blog(); $obj -> contentsLikeAll();
if($obj->eBData > 0)
{
foreach($obj->eBData as $val): extract($val);
$likeList ="<div class='row'>";
$likeList .="<div class='col-xs-12 col-md-4'>";
$likeList .="<b><a title='".$contents_og_image_title."' href='";
$likeList .=outContentsLink."/contents/details/$contents_id/$contents_category/$contents_sub_category/";
$likeList .="'>";
$likeList .=$contents_og_image_title;
$likeList .="</a></b>";
$likeList .="<br>";
if(file_exists(str_replace(hostingName, docRoot, hypertextWithOrWithoutWww.$contents_og_small_image_url))) {
$likeList .="<a title='".$contents_og_image_title."' href='";
$likeList .=outContentsLink."/contents/details/$contents_id/$contents_category/$contents_sub_category/";
$likeList .="'>";
$likeList .="<img class='img-responsive' alt='".$contents_og_image_title."' src='";
$likeList .=hypertextWithOrWithoutWww."$contents_og_small_image_url";
$likeList .="'>";
$likeList .="</a>";
$likeList .="<br>";
}
//
$countComment = new ebapps\blog\blog();
$countComment ->count_total_like($contents_id);
if($countComment->eBData)
{
foreach($countComment->eBData as $valcountComment): extract($valcountComment);
$likeList .="<i class='fa fa-heart'></i>  ";
$likeList .=$totalPostLikes;
endforeach;
}
$likeList .="</div>";
//
$likeList .="<div class='col-xs-12 col-md-8'>";
$likeList .=$contents_og_image_what_to_do;
$likeList .="</div>";
$likeList .="</div>";
echo $likeList;
endforeach;
}
?>