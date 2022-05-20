<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php include_once (eblogin.'/session.inc.php'); ?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-noindex.php'); ?>
<?php include_once (eblayout.'/a-common-header-title-one.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts.php'); ?>
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
<?php include_once (ebaccess.'/access_permission_admin_minimum.php'); ?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>
</div>
<div class='col-xs-12 col-md-7'>
<?php
$pubDate = date('c',time());
$xml_output  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
$xml_output .= "<urlset\n";
$xml_output .= "xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"\n";
$xml_output .= "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\n";
$xml_output .= "xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9\n";
$xml_output .= "http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\n";
?>
<!--Blog-->
<?php include_once (ebblog.'/blog.php'); ?>
<?php $obj= new ebapps\blog\blog(); $obj ->contents_mrss(); ?>
<?php if($obj->data >=1){ foreach($obj->data as $val): extract($val); ?> 
<?php
$xml_output .= "<url>\n";
$xml_output .= "\t<loc>".outContentsLinkFull."/contents/details/$contents_id/$contents_category/$contents_sub_category/</loc>\n";
$xml_output .= "\t<lastmod>$pubDate</lastmod>\n";
$xml_output .= "\t<priority>1.00</priority>\n";
$xml_output .= "</url>\n";
?>
<?php endforeach; } ?>
<!--Blog-->
<?php include_once (ebblog.'/blog.php'); ?>
<?php
$tagKeyObj= new ebapps\blog\blog(); $tagKeyObj ->select_blog_items_tags_views();
if($tagKeyObj->data >=1){ foreach($tagKeyObj->data as $valtagKeyObj): extract($valtagKeyObj);
$xml_output .= "<url>\n";
$xml_output .= "\t<loc>".outContentsLinkFull."/contents/tags/$cont_items_id_in_subcat_keywords/$cont_subcategory_keywords_id/$cont_subcategory_keywords_value/$contents_category/$contents_sub_category/</loc>\n";
$xml_output .= "\t<lastmod>$pubDate</lastmod>\n";
$xml_output .= "\t<priority>1.00</priority>\n";
$xml_output .= "</url>\n";
?>
<?php endforeach; } ?>
<?php
$xml_output .= "</urlset>";
$filenamepath =  eb."/sitemap.xml";
chmod($filenamepath, 0755);
$fp = fopen($filenamepath,'w');
$write = fwrite($fp,$xml_output);
echo $xml_output;
?>
</div>
<div class='col-xs-12 col-md-3 sidebar-offcanvas'>
<?php include_once ("access-my-account.php"); ?>
</div>
</div>
</div>	
<?php include_once (eblayout.'/a-common-footer.php'); ?>