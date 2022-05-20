<?php 
include_once (ebblog.'/blog.php');
if(isset($_GET['articleno']))
{
$articleno = $_GET['articleno']; 
$objOg = new ebapps\blog\blog(); 
$objOg -> content_item_details_seo($articleno); 
if($objOg->eBData >= 1)
{
foreach($objOg->eBData as $valobjOg)
{
extract($valobjOg); 
$mataData  = "<meta property='og:site_name' content='".domain."'>";
$mataData .= "<meta property='og:url' content='";
if(isset($_SESSION['ebusername']))
{
$mataData .=fullUrl.$_SESSION['ebusername'].'/';
}
else
{
$mataData .=fullUrl;
}
$mataData .="' />";
if(!empty($contents_video_link))
{
//
$mataData .= "<meta property='og:type' content='video.other' />";
$mataData .= "<meta property='og:video:url' content='".hypertextWithOrWithoutWww.$contents_video_link."' />";
$mataData .= "<meta property='og:video:secure_url' content='".hypertextWithOrWithoutWww.$contents_video_link."' />";
$mataData .= "<meta property='og:video:type' content='text/html' />";
$mataData .= "<meta property='og:video:width' content='1280' />";
$mataData .= "<meta property='og:video:height' content='720' />";
}
else
{
$mataData .= "<meta property='og:image:type' content='image/jpeg' />";
$mataData .= "<meta property='og:image' content='";
$mataData .= hypertextWithOrWithoutWww.$contents_og_small_image_url;
$mataData .= "' />";
$mataData .= "<meta property='og:image:url' content='";
$mataData .= hypertextWithOrWithoutWww.$contents_og_small_image_url;
$mataData .= "' />";
$mataData .= "<meta property='og:image:width' content='1024' />";
$mataData .= "<meta property='og:image:height' content='717' />";
}
$mataData .= "<meta property='og:title' content='".$contents_og_image_title."' />";
$mataData .= "<meta property='og:description' content='".$objOg->visulString($contents_category).", ".$objOg->visulString($contents_sub_category).", ".$contents_og_image_title."' />";
$mataData .= "<meta name='twitter:card' content='summary_large_image' />";
$mataData .= "<meta name='twitter:site' content='@eBangali' />";
$mataData .= "<meta name='twitter:domain' content='".domain."' />";
$mataData .= "<meta name='twitter:creator' content='@eBangali' />";
$mataData .= "<meta name='twitter:title' content='$contents_og_image_title' />";
$mataData .= "<meta name='twitter:description' content='".$objOg->visulString($contents_category).", ".$objOg->visulString($contents_sub_category).", ".$contents_og_image_title."' />";
$mataData .= "<meta name='twitter:image' content='".hypertextWithOrWithoutWww.$contents_og_small_image_url."' />";
$mataData .= "<meta name='twitter:url' content='";
if(isset($_SESSION['ebusername']))
{
$mataData .=fullUrl.$_SESSION['ebusername'].'/';
}
else
{
$mataData .=fullUrl;
}
$mataData .="' />";
$mataData .= "<title>".$contents_og_image_title."</title>";
$mataData .= "<meta name='description' content='".$objOg->visulString($contents_category).", ".$objOg->visulString($contents_sub_category).", ".$contents_og_image_title."' />";
$mataData .= "<meta name='keywords' content='".$objOg->visulString($contents_sub_category).", ".$objOg->visulString($contents_category)."' />";
echo $mataData;
}
}
}

if(empty($_GET['articleno']))
{
$objEmpty = new ebapps\blog\blog();
$objEmpty -> content_item_details_seo_last();
if($objEmpty ->eBData >= 1)
{
foreach($objEmpty->eBData as $valobjEmpty)
{
extract($valobjEmpty);
$mataData  = "<meta property='og:site_name' content='".domain."' />";
$mataData .= "<meta property='og:url' content='";
if(isset($_SESSION['ebusername']))
{
$mataData .=fullUrl.$_SESSION['ebusername'].'/';
}
else
{
$mataData .=fullUrl;
}
$mataData .="' />";
if(!empty($contents_video_link))
{
//
$mataData .= "<meta property='og:type' content='video.other' />";
$mataData .= "<meta property='og:video:url' content='".hypertextWithOrWithoutWww.$contents_video_link."' />";
$mataData .= "<meta property='og:video:secure_url' content='".hypertextWithOrWithoutWww.$contents_video_link."' />";
$mataData .= "<meta property='og:video:type' content='text/html' />";
$mataData .= "<meta property='og:video:width' content='1280' />";
$mataData .= "<meta property='og:video:height' content='720' />";
}
else
{
$mataData .= "<meta property='og:image:type' content='image/jpeg' />";
$mataData .= "<meta property='og:image' content='";
$mataData .= hypertextWithOrWithoutWww.$contents_og_small_image_url;
$mataData .= "' />";
$mataData .= "<meta property='og:image:url' content='";
$mataData .= hypertextWithOrWithoutWww.$contents_og_small_image_url;
$mataData .= "' />";
$mataData .= "<meta property='og:image:width' content='1024' />";
$mataData .= "<meta property='og:image:height' content='717' />";
}
$mataData .= "<meta property='og:title' content='$contents_og_image_title' />";
$mataData .= "<meta property='og:description' content='".$objEmpty->visulString($contents_category).", ".$objEmpty->visulString($contents_sub_category).", ".$contents_og_image_title."' />";

$mataData .= "<meta name='twitter:card' content='summary_large_image' />";
$mataData .= "<meta name='twitter:site' content='@eBangali' />";
$mataData .= "<meta name='twitter:domain' content='".domain."' />";
$mataData .= "<meta name='twitter:creator' content='@eBangali' />";
$mataData .= "<meta name='twitter:title' content='".$contents_og_image_title."' />";
$mataData .= "<meta name='twitter:description' content='".$objEmpty->visulString($contents_category).", ".$objEmpty->visulString($contents_sub_category).", ".$contents_og_image_title."' />";
$mataData .= "<meta name='twitter:image' content='".hypertextWithOrWithoutWww.$contents_og_small_image_url."' />";
$mataData .= "<meta name='twitter:url' content='";
if(isset($_SESSION['ebusername']))
{
$mataData .=fullUrl.$_SESSION['ebusername'].'/';
}
else
{
$mataData .=fullUrl;
}
$mataData .="' />";
$mataData .= "<title>".$contents_og_image_title."</title>";
$mataData .= "<meta name='description' content='".$objEmpty->visulString($contents_category).", ".$objEmpty->visulString($contents_sub_category).", ".$contents_og_image_title."' />";
$mataData .= "<meta name='keywords' content='".$objEmpty->visulString($contents_sub_category).", ".$objEmpty->visulString($contents_category)."' />";
echo $mataData;
}
}
}
?>
