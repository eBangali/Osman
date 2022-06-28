<?php 
include_once (ebbay."/ebcart.php");
if(isset($_GET["id"]))
{
$productid = $_GET["id"]; 
$objOg = new ebapps\bay\ebcart(); 
$objOg -> item_details($productid); 
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
if(!empty($s_video_link))
{
$mataData .= "<meta property='og:type' content='video.other' />";
$mataData .= "<meta property='og:video:url' content='".hypertextWithOrWithoutWww.$s_video_link."' />";
$mataData .= "<meta property='og:video:secure_url' content='".hypertextWithOrWithoutWww.$s_video_link."' />";
$mataData .= "<meta property='og:video:type' content='text/html' />";
$mataData .= "<meta property='og:video:width' content='1280' />";
$mataData .= "<meta property='og:video:height' content='720' />";
}
else
{
$mataData .= "<meta property='og:image:type' content='image/jpeg' />";
$mataData .= "<meta property='og:image' content='";
$mataData .= hypertextWithOrWithoutWww.$s_og_image_url;
$mataData .= "' />";
$mataData .= "<meta property='og:image:url' content='";
$mataData .= hypertextWithOrWithoutWww.$s_og_image_url;
$mataData .= "' />";
$mataData .= "<meta property='og:image:width' content='1366' />";
$mataData .= "<meta property='og:image:height' content='956' />";
}
$mataData .= "<meta property='og:title' content='".$s_og_image_title."' />";
$mataData .= "<meta property='og:description' content='".$objOg->visulString($s_category_c).", ".$objOg->visulString($s_category_d).", ".$s_og_image_title."' />";
$mataData .= "<meta name='twitter:card' content='summary_large_image' />";
$mataData .= "<meta name='twitter:site' content='@eBangali' />";
$mataData .= "<meta name='twitter:domain' content='".domain."' />";
$mataData .= "<meta name='twitter:creator' content='@eBangali' />";
$mataData .= "<meta name='twitter:title' content='$s_og_image_title' />";
$mataData .= "<meta name='twitter:description' content='".$objOg->visulString($s_category_c).", ".$objOg->visulString($s_category_d).", ".$s_og_image_title."' />";
$mataData .= "<meta name='twitter:image' content='".hypertextWithOrWithoutWww.$s_og_image_url."' />";
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
$mataData .= "<title>".$s_og_image_title."</title>";
$mataData .= "<meta name='description' content='".$objOg->visulString($s_category_c).", ".$objOg->visulString($s_category_d).", ".$s_og_image_title."' />";
$mataData .= "<meta name='keywords' content='".$objOg->visulString($s_category_d).", ".$objOg->visulString($s_category_c)."' />";
echo $mataData;
}
}
}

if(empty($_GET["id"]))
{
$objEmpty = new ebapps\bay\ebcart();
$objEmpty -> item_last_item_seo();
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
if(!empty($s_video_link))
{
$mataData .= "<meta property='og:type' content='video.other' />";
$mataData .= "<meta property='og:video:url' content='".hypertextWithOrWithoutWww.$s_video_link."' />";
$mataData .= "<meta property='og:video:secure_url' content='".hypertextWithOrWithoutWww.$s_video_link."' />";
$mataData .= "<meta property='og:video:type' content='text/html' />";
$mataData .= "<meta property='og:video:width' content='1280' />";
$mataData .= "<meta property='og:video:height' content='720' />";
}
else
{
$mataData .= "<meta property='og:image:type' content='image/jpeg' />";
$mataData .= "<meta property='og:image' content='";
$mataData .= hypertextWithOrWithoutWww.$s_og_image_url;
$mataData .= "' />";
$mataData .= "<meta property='og:image:url' content='";
$mataData .= hypertextWithOrWithoutWww.$s_og_image_url;
$mataData .= "' />";
$mataData .= "<meta property='og:image:width' content='1366' />";
$mataData .= "<meta property='og:image:height' content='956' />";
}
$mataData .= "<meta property='og:title' content='$s_og_image_title' />";
$mataData .= "<meta property='og:description' content='".$objEmpty->visulString($s_category_c).", ".$objEmpty->visulString($s_category_d).", ".$s_og_image_title."' />";
$mataData .= "<meta name='twitter:card' content='summary_large_image' />";
$mataData .= "<meta name='twitter:site' content='@eBangali' />";
$mataData .= "<meta name='twitter:domain' content='".domain."' />";
$mataData .= "<meta name='twitter:creator' content='@eBangali' />";
$mataData .= "<meta name='twitter:title' content='".$s_og_image_title."' />";
$mataData .= "<meta name='twitter:description' content='".$objEmpty->visulString($s_category_c).", ".$objEmpty->visulString($s_category_d).", ".$s_og_image_title."' />";
$mataData .= "<meta name='twitter:image' content='".hypertextWithOrWithoutWww.$s_og_image_url."' />";
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
$mataData .= "<title>".$s_og_image_title."</title>";
$mataData .= "<meta name='description' content='".$objEmpty->visulString($s_category_c).", ".$objEmpty->visulString($s_category_d).", ".$s_og_image_title."' />";
$mataData .= "<meta name='keywords' content='".$objEmpty->visulString($s_category_d).", ".$objEmpty->visulString($s_category_c)."' />";
echo $mataData;
}
}
}
?>
