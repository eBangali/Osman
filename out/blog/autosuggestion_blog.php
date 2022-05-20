<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php
include_once (ebbd."/connection.inc.php");
if(isset($_POST['searchQuery'])  && $_POST['searchQuery'] != '')
{
$outPut = "";
//
$query  ="SELECT";
$query .=" contents_id,";
$query .=" contents_og_small_image_url,";
$query .=" contents_og_image_title";
$query .=" FROM blog_contents";
$query .=" WHERE";
$query .=" contents_approved = 1";
$query .=" AND contents_og_image_title LIKE '%".$_POST['searchQuery']."%'";
$query .=" ORDER BY contents_id DESC";
//
$result = $connectdb -> query($query);
$outPut = "<ul class='list-group'>";
if($result)
{
while($row = $result->fetch_array())
{ 
$outPut .= "<li class='list-group-item'><img class='search-img' src='".hypertextWithOrWithoutWww.$row['contents_og_small_image_url']."' />".$row['contents_og_image_title']."</li>";
}
$result -> free_result();
}
else
{
$outPut .= "<li class='list-group-item'>Nothing Found</li>";
}
$outPut .= "</ul>";
$connectdb -> close();
echo $outPut;
}
?>