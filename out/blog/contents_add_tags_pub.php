<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php
include_once(ebbd.'/dbconfig.php');
$adMin = new ebapps\dbconnection\dbconfig();
if(isset($adMin->eBAdminUserIsSet))
{
?>
<?php include_once (eblogin.'/session.inc.php'); ?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<?php include_once (eblayout.'/a-common-header-title-one.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-noindex.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts-text-editor.php'); ?>
<?php include_once (eblayout.'/a-common-page-id-start.php'); ?>
<?php include_once (eblayout.'/a-common-header.php'); ?>
<nav>
  <div class='container'>
    <div>
      <?php include_once (eblayout.'/a-common-navebar.php'); ?>
      <?php include_once (eblayout.'/a-common-navebar-index-blog.php'); ?>
    </div>
  </div>
</nav>
<?php include_once (eblayout.'/a-common-page-id-end.php'); ?>
<?php include_once (ebaccess."/access_permission_online_minimum.php"); ?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>

</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<div class="well">
<h2 title='Tags URL'>Tags URL</h2>
</div>
<?php include_once (ebblog.'/blog.php'); ?>
<div class="well">
<?php
$tagKeyObj = new ebapps\blog\blog();
$tagKeyObj->select_blog_items_tags_views_pub();
$keywordTags ="<div class='table-responsive'>"; 
$keywordTags .="<table class='table'>";
$keywordTags .="<thead>";
$keywordTags .="<tr>";
$keywordTags .="<th>Keyword Tags URL</th>";
$keywordTags .="</tr>";
$keywordTags .="</thead>";
$keywordTags .="<tbody>";
if($tagKeyObj->eBData >= 1)
{
foreach($tagKeyObj->eBData as $valtagKeyObj)
{
extract($valtagKeyObj);
$keywordTags .="<tr>";
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
</div>
<div class='col-xs-12 col-md-3 sidebar-offcanvas'>
<?php include_once ("contents-my-account.php"); ?>
</div>
</div>
</div>
<?php include_once (eblayout.'/a-common-footer-edit.php'); ?>
<?php
}
else
{
header("Location: ".outLink."/access/admin-register.php");
}
?>
