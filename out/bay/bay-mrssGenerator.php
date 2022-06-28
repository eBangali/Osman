<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php
include_once(ebbd.'/dbconfig.php');
$adMin = new ebapps\dbconnection\dbconfig();
if(isset($adMin->eBAdminUserIsSet))
{
?>
<?php include_once (eblogin.'/session.inc.php'); ?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-noindex.php'); ?>
<?php include_once (eblayout.'/a-common-header-title-one.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts-text-editor.php'); ?>
<?php include_once (eblayout.'/a-common-page-id-start.php'); ?>
<?php include_once (eblayout.'/a-common-header.php'); ?>
<nav>
  <div class='container'>
    <div>
      <?php include_once (eblayout.'/a-common-navebar.php'); ?>
      <?php include_once (eblayout.'/a-common-navebar-index-bay.php'); ?>
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
<div class="well">
<h2 title='Product mRSS'>Product mRSS</h2>
</div>
<div class="well">
<?php
$pubDate =date("r");
$xml_output  = "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
$xml_output .= "<rss version=\"2.0\">\n";
$xml_output .= "<channel>\n";
$xml_output .= "\t<title>".hostingName."</title>\n";
$xml_output .= "\t<link>".outLink."/</link>\n";
$xml_output .= "\t<description>".hostingName."</description>\n";
$xml_output .= "\t<language>en-us</language>\n";
$xml_output .= "\t<lastBuildDate>$pubDate</lastBuildDate>\n";
$xml_output .= "\t<copyright>Copyright (c) ".date("Y")." ".domain."</copyright>\n";
?>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php $obj= new ebapps\bay\ebcart(); $obj ->mrss_bay(); ?>
<?php if($obj->eBData >=1){foreach($obj->eBData as $val): extract($val); ?> 
<?php
$xml_output .= "<item>\n";
$xml_output .= "\t<title>$s_og_image_title</title>\n";
$xml_output .= "\t<link>".outBayLink."/product/item-details/$bay_showroom_approved_items_id/</link>\n";
$xml_output .= "\t<description><![CDATA[$s_og_image_title<br /><a href='".outBayLink."/product/item-details/$bay_showroom_approved_items_id/'><img src='".hypertextWithOrWithoutWww."$s_og_image_url' width='300px' alt='$s_og_image_title' title='$s_og_image_title' /></a>]]></description>\n";
$xml_output .= "\t<category>$s_category_c</category>\n";
$xml_output .= "\t<pubDate>$s_date</pubDate>\n";
$xml_output .= "</item>\n";
?>
<?php endforeach; ?>
<?php } ?>
<?php
$xml_output .=  "</channel>\n";
$xml_output .=  "</rss>";
$filenamepath =  eb."/mrss-bay.xml";
$fp = fopen($filenamepath,'w');
$write = fwrite($fp,$xml_output);
echo $xml_output;
?>
</div>
</div>
<div class='col-xs-12 col-md-3 sidebar-offcanvas'>
<?php include_once ("bay-my-account.php"); ?>
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
