<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php
include_once(ebbd.'/dbconfig.php');
$adMin = new ebapps\dbconnection\dbconfig();
if(isset($adMin->eBAdminUserIsSet))
{
?>
<?php include_once (eblogin.'/session.inc.php'); ?>
<?php include_once (ebblog.'/blog.php'); ?>
<div class="well">
<?php
$tagKeyObj = new ebapps\blog\blog();
$tagKeyObj->select_blog_items_tags_views();
$keywordTags ="<div class='table-responsive'>"; 
$keywordTags .="<table class='table'>";
$keywordTags .="<thead>";
$keywordTags .="<tr>";
$keywordTags .="<th>Post ID</th>";
$keywordTags .="<th>Tag ID</th>";
$keywordTags .="<th>Keyword</th>";
$keywordTags .="</tr>";
$keywordTags .="</thead>";
$keywordTags .="<tbody>";
if($tagKeyObj->eBData >= 1)
{
foreach($tagKeyObj->eBData as $valtagKeyObj)
{
extract($valtagKeyObj);
$keywordTags .="<tr>";
$keywordTags .="<td scope='row'>$cont_items_id_in_subcat_keywords</td>";
//
$keywordTags .="<td>";
if(isset($cont_subcategory_keywords_id)){
$keywordTags .= "$cont_subcategory_keywords_id";
}
$keywordTags .="</td>";
$keywordTags .="<td>";
if(isset($cont_subcategory_keywords_value)){
$keywordTags .= "<a href='".outContentsLinkFull."/contents/tags/$cont_items_id_in_subcat_keywords/$cont_subcategory_keywords_id/$cont_subcategory_keywords_value/$contents_category/$contents_sub_category/'>".$tagKeyObj->visulString($cont_subcategory_keywords_value)."</a>";
}
$keywordTags .="</td>";
$keywordTags .="</tr>";
}
}
$keywordTags .="</tbody>";
$keywordTags .="</table>";
$keywordTags .="</div>";
echo $keywordTags;
?>
</div>
<?php
}
else
{
header("Location: ".outLink."/access/admin-register.php");
}
?>
