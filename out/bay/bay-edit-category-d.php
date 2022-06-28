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
<div class='col-xs-12 col-md-9 sidebar-offcanvas'>

<div class='well'>
<h2 title='Edit category D'>Edit category D</h2>
</div>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = '';
$category_d_error = '*';
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>

<?php
$user = new ebapps\bay\ebcart();
if(isset($_REQUEST['category_d_submit']))
{
extract($_REQUEST);

/* Form Key*/
if(isset($_REQUEST['form_key']))
{
$form_key = preg_replace('#[^a-zA-Z0-9]#i','',$_POST['form_key']);
if($formKey->read_and_check_formkey($form_key) == true)
{

}
else
{
$formKey_error = "<b class='text-warning'>Sorry the server is currently too busy please try again later.</b>";
$error = 1;
}
}
/* category_d */
if (empty($_REQUEST['category_d']))
{
$category_d_error = "<b class='text-warning'>Category d name required</b>";
$error =1;
} 
/* valitation category_d  */
elseif (! preg_match('/^([a-zA-Z0-9\/\-\,\.\(\)]+)$/',$category_d))
{
$category_d_error = "<b class='text-warning'>Whitespace, single or double quotes, certain special characters are not allowed.</b>";
$error =1;
}
else 
{
$category_d = $sanitization -> test_input($_POST['category_d']);
}
/* Submition form */
if($error ==0){
extract($_REQUEST);
$user->eidt_submit_category_d($category_d, $category_d_id);
}
//
}
?>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php
$editCategoryD = new ebapps\bay\ebcart();
$editCategoryD -> eidt_category_d_to_show(); 
if($editCategoryD->eBData){ foreach($editCategoryD->eBData as $valeditCategoryD): extract($valeditCategoryD);

$editCategoryD = "<div class='well'>";					 
$editCategoryD .= "<form method='post'>";
$editCategoryD .= "<fieldset class='group-select'>";
$editCategoryD .= "Category : $category_d_error";
$editCategoryD .= "<input type='hidden' name='category_d_id' value='$bay_category_d_id'>";
$editCategoryD .= "<input type='text' class='form-control' name='category_d' value='$bay_category_d' required autofocus />";
$editCategoryD .= "<div class='buttons-set'>";
$editCategoryD .= "<button type='submit' name='category_d_submit' title='Submit' class='button submit'> <span> Submit </span> </button>";
$editCategoryD .= "</div>";
$editCategoryD .= "</fieldset>";
$editCategoryD .= "</form>";
$editCategoryD .= "</div>";
echo $editCategoryD;
endforeach;
}
?>
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