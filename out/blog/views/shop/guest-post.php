<?php include_once (dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/initialize.php'); ?>
<?php
$guestPost ="<div class='site-content' id='primary'>";
$guestPost .="<div role='main' id='content'>";
$objPost = new ebapps\blog\blog(); $objPost -> guestPostContentsPostAll();
if($objPost->eBData){foreach($objPost->eBData as $valPost): extract($valPost);
$guestPost .="<article class='blog_entry clearfix wow bounceInUp animated' id='post-$contents_id'>";
$guestPost .="<header class='blog_entry-header clearfix'>";
$guestPost .="<div class='blog_entry-header-inner'>";
$guestPost .="<h2 class='blog_entry-title' title='".$contents_og_image_title."'>";
$guestPost .=strtoupper($contents_og_image_title)."</h2>";
$guestPost .="</div>";
$guestPost .="</header>";
$guestPost .="<div class='entry-content'>";
$guestPost .="<div class='featured-thumb'>";
if(!empty($contents_og_image_url)){
$guestPost .="<a href='";
$guestPost .=outContentsLink."/contents/solve/$contents_id/".$objPost->seoUrl($contents_og_image_title)."/";
$guestPost .="'><img class='img-responsive' alt='".$contents_og_image_title."' src='";
$guestPost .=hypertextWithOrWithoutWww."$contents_og_image_url";
$guestPost .="' /></a>";
}
$guestPost .="</div>";
/**/
$guestPost .="<div class='entry-content'>";
$guestPost .="<ul class='post-meta'>";
$guestPost .="<li><i class='fa fa-user'></i>Posted by <a href='";
$guestPost .=outContentsLink."/contents/writer/$username_contents/";
$guestPost .="'>$username_contents</a></li>";

/*Like?*/
$countLikeNow = new ebapps\blog\blog();
$countLikeNow ->count_like_now($contents_id);

if($countLikeNow->eBData)
{
foreach($countLikeNow->eBData as $valcountLikeNow): extract($valcountLikeNow);
	
if(isset($_SESSION['ebusername']) and $likeNow == 0)
{
/*Logined True with hober effect */
/*Like Now*/
if(isset($_REQUEST['add_for_like']))
{
extract($_REQUEST);
$countLike = new ebapps\blog\blog();
$countLike ->add_for_like($contents_id_for_like);

}
$guestPost .="<li><form method='post' class='toLike'><input type='hidden' name='contents_id_for_like' value='$contents_id' /><button type='submit' name='add_for_like'><i class='fa fa-heart'></i></button></form></li>";
}
else 
{
/*Logined False with hober effect */
/* Login to like */
$guestPost .="<li><i class='fa fa-heart'></i></li>";
}
endforeach;
}   
				   
				   
$guestPost .="<li><a href='";
$guestPost .=outContentsLink."/contents/solve/$contents_id/".$objPost->seoUrl($contents_og_image_title)."/";			   
$guestPost .="'>";
$countComment = new ebapps\blog\blog();
$countComment ->count_total_like($contents_id);
if($countComment->eBData)
{
foreach($countComment->eBData as $valcountComment): extract($valcountComment);
	
if($totalPostLikes <= 1)
{
$guestPost .=$totalPostLikes;
$guestPost .=" like";
}
else 
{
$guestPost .=$totalPostLikes;
$guestPost .=" Likes";	
}
endforeach;
}
$guestPost .="</a></li>";

/* */				   
$guestPost .="<li><i class='fa fa-comments'></i><a href='";
$guestPost .=outContentsLink."/contents/solve/$contents_id/".$objPost->seoUrl($contents_og_image_title)."/";
$guestPost .="'>";
$countComment = new ebapps\blog\blog();
$countComment ->count_total_contents($contents_id);
if($countComment->eBData)
{
foreach($countComment->eBData as $valcountComment): extract($valcountComment);
if($totalPostComments <= 1)
{
$guestPost .=$totalPostComments;
$guestPost .=" Comment";
}
else 
{
$guestPost .=$totalPostComments;
$guestPost .=" Comments";	
}
endforeach;
}
$guestPost .="</a></li>"; 

$guestPost .="<li><i class='fa fa-clock-o'></i><span class='day'>".date('d M Y',strtotime($contents_date))."</span></li>";
$guestPost .="</ul>";
$guestPost .="<div>";
$guestPost .=$contents_og_image_what_to_do;
$guestPost .="</div>";
$guestPost .="</div>";
$guestPost .="<p><a class='eb-cart-back' href='";
$guestPost .=outContentsLink."/contents/solve/$contents_id/".$objPost->seoUrl($contents_og_image_title)."/";
$guestPost .="'>Read More</a></p>";
$guestPost .="</div>";
$guestPost .="<footer class='entry-meta'> This entry was posted in <a title='View all posts in ".$contents_category."' href='";
$guestPost .=outContentsLink."/contents/category/$contents_id/";
$guestPost .="'>".$objPost->visulString($contents_category)."</a> and <a title='View all posts in ".$contents_sub_category."' href='";
$guestPost .=outContentsLink."/contents/subcategory/$contents_id/";
$guestPost .="'>".$objPost->visulString($contents_sub_category)."</a></footer>";
$guestPost .="</article>";
endforeach;
}
$guestPost .="</div>";
$guestPost .="</div>";
echo $guestPost;
$obj = new ebapps\blog\blog(); 
echo $obj -> guestPostContentsPagination();
?>
