<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php
include_once(ebbd.'/connection.inc.php');
if(isset($_POST['image']))
{
$data = $_POST['image'];
$image_array_1 = explode(';', $data);
$image_array_2 = explode(",", $image_array_1[1]);
$data = base64_decode($image_array_2[1]);
//
$username = $_SESSION['ebusername'];
$year = date('Y');
$month = date('m');
$day = date('d');
$store_path_a = eb."/ebcontents";
if(!is_dir($store_path_a))
{ 
mkdir($store_path_a,0755);
}
$store_path_b = $store_path_a."/"."uploads";
if(!is_dir($store_path_b))
{ 
mkdir($store_path_b,0755);
}
$store_path_1 = $store_path_b."/".$username;
if(!is_dir($store_path_1))
{ 
mkdir($store_path_1,0755);
}
$store_path_app = $store_path_1."/"."blog";
if(!is_dir($store_path_app))
{ 
mkdir($store_path_app,0755);
}
$store_path_2 = $store_path_app."/".$year;
if(!is_dir($store_path_2))
{ 
mkdir($store_path_2,0755);
}
$store_path_3 = $store_path_2."/".$month;
if(!is_dir($store_path_3))
{ 
mkdir($store_path_3,0755);
}
$store_path_4 = $store_path_3."/".$day;
if(!is_dir($store_path_4))
{ 
mkdir($store_path_4,0755);
}
//
$store_path_5 = $store_path_4."/"."small";
if(!is_dir($store_path_5))
{ 
mkdir($store_path_5,0755);
}
//
$upload_path = $store_path_4;
$file_path = $upload_path.'/'.uniqid(mt_rand()).'.png';
$imageName = $file_path;
$contents_og_image_url = str_replace(docRoot, domainForImagStore, $imageName);
file_put_contents($imageName, $data);
//
$upload_path_small = $store_path_5;
$file_path_small = $upload_path_small.'/'.uniqid(mt_rand()).'.png';
$imageNameSmall = $file_path_small;
$contents_og_small_image_url = str_replace(docRoot, domainForImagStore, $imageNameSmall);
file_put_contents($imageNameSmall, $data);
//
echo $imageName;
echo $imageNameSmall;
//
$contents_id = intval($_POST['contents_id']);
//
if(isset($_SESSION['memberlevel']))
{
if($_SESSION['memberlevel'] >= 9)
{
$query = "UPDATE blog_contents SET contents_approved='NO', contents_og_image_url='$contents_og_image_url', contents_og_small_image_url='$contents_og_small_image_url' WHERE contents_id=$contents_id";
$result = $connectdb -> query($query);	
}
elseif($_SESSION['memberlevel'] <= 8)
{
$query = "UPDATE blog_contents SET contents_approved='GPOST', contents_og_image_url='$contents_og_image_url', contents_og_small_image_url='$contents_og_small_image_url' WHERE contents_id=$contents_id";
$result = $connectdb -> query($query);	
}
}
}
?>