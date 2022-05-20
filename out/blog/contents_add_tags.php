<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php include_once (dirname(dirname(dirname(__FILE__))).'/error-testing.php'); ?>
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
<?php include_once (ebaccess.'/access_permission_admin_minimum.php'); ?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>

</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<div class="well">
<h2 title='Add Tags'>Add Tags</h2>
</div>
<?php include_once (ebblog.'/blog.php'); ?>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = "";
$blog_subcategory_keywords_error = "*";
$blog_product_or_services_id_error = "*";
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();

$kewwordFind = new ebapps\blog\blog();
if(isset($_REQUEST['blog_sub_subcategory_keywords_submit']))
{
extract($_REQUEST);

/* Form Key*/
if(isset($_REQUEST["form_key"]))
{
$form_key = preg_replace('#[^a-zA-Z0-9]#i','',$_POST["form_key"]);
if($formKey->read_and_check_formkey($form_key) == true)
{

}
else
{
$formKey_error = "<b class='text-warning'>Sorry the server is currently too busy please try again later.</b>";
$error = 1;
}
}
//
$kewwordFind->select_contents_sub_category_for_tags($_POST["blog_product_or_services_id"]);
if($kewwordFind->eBData)
{
foreach($kewwordFind->eBData as $vaLmerchant): extract($vaLmerchant);
$keyWordReleted = $contents_sub_category;
endforeach;
/* blog_product_or_services_id */
if (empty($_REQUEST["blog_product_or_services_id"]))
{
$blog_product_or_services_id_error = "<b class='text-warning'>Product or services required</b>";
$error =1;
} 
/* valitation blog_product_or_services_id  */
elseif (! preg_match("/^([0-9]+)$/",$blog_product_or_services_id))
{
$blog_product_or_services_id_error = "<b class='text-warning'>Only numbers allowed.</b>";
$error =1;
}
else 
{
$blog_product_or_services_id = $sanitization -> test_input($_POST["blog_product_or_services_id"]);
}
/* blog_subcategory_keywords */
if (empty($_REQUEST["blog_subcategory_keywords"]))
{
$blog_subcategory_keywords_error = "<b class='text-warning'>Subcategory related keyword required</b>";
$error =1;
} 
/* valitation blog_subcategory_keywords  */
elseif (! preg_match("/^[a-zA-Z\-]{3,41}$/",$blog_subcategory_keywords))
{
$blog_subcategory_keywords_error = "<b class='text-warning'>Whitespace, single or double quotes, certain special characters are not allowed.</b>";
$error =1;
}
//
/* SEO valitation blog_subcategory_keywords */
elseif(strpos($blog_subcategory_keywords, $keyWordReleted) === false)
{
$keyWordReleted = $kewwordFind->visulString($keyWordReleted);
$blog_subcategory_keywords_error = "<b class='text-warning'>Use mimimum one keyword as '$keyWordReleted' required</b>";
$error =1;
}
else 
{
$blog_subcategory_keywords = $sanitization -> test_input($_POST["blog_subcategory_keywords"]);
}
/* Submition form */
if($error == 0)
{
extract($_REQUEST);
$kewwordFind->submit_blog_sub_subcategory_keywords($blog_product_or_services_id, $blog_subcategory_keywords);
}
//
}
}
?>
<div class="well">
<form method="post">
<fieldset class='group-select'>
<input type='hidden' name='form_key' value='<?php echo $formKey->outputKey(); ?>'>
<?php echo $formKey_error; ?>
Select Product or Services ID: <?php echo $blog_product_or_services_id_error;  ?>
<select class="form-control" name='blog_product_or_services_id'><?php $kewwordFind->select_blog_items_id_for_tags(); ?></select>
Add Tags: <?php echo $blog_subcategory_keywords_error;  ?>
<input class="form-control" type="text" name="blog_subcategory_keywords" placeholder="Men-s-T-shirts will be shown as Men's T-shirts" required autofocus />
<div class='buttons-set'>
<button type='submit' name='blog_sub_subcategory_keywords_submit' title='Submit' class='button submit'> <span> Submit </span> </button>
</div>
</fieldset>
</form>
</div>
<?php include_once ("contents_add_tags_views.php"); ?>
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
