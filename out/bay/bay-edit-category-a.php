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
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<div class='well'>
<h2 title='Edit Category A'>Edit Category A</h2>
</div> 
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = '';
$category_a_new_error = '*';
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>

<?php
if(isset($_REQUEST['category_a_submit']))
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

/* category_a */
if (empty($_REQUEST['category_a_new']))
{
$category_a_new_error = "<b class='text-warning'>Category name required</b>";
$error =1;
} 
/* valitation category_a  */
elseif (! preg_match('/^([a-zA-Z0-9\/\-\,\.\(\)]+)$/',$category_a_new))
{
$category_a_new_error = "<b class='text-warning'>Whitespace, single or double quotes, certain special characters are not allowed.</b>";
$error =1;
}
else 
{
$category_a_new = $sanitization -> test_input($_POST['category_a_new']);
}
/* Submition form */
if($error ==0){
$user = new ebapps\bay\ebcart();
extract($_REQUEST);
$user->eidt_submit_category_a($category_a_old, $category_a_new);
}
//
}
?>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php
$objEditA = new ebapps\bay\ebcart();
$objEditA -> eidt_category_a_to_show(); 
if($objEditA->eBData){ foreach($objEditA->eBData as $valobjEditA): extract($valobjEditA);

$editCategoryA = "<div class='well'>";					 
$editCategoryA .= "<form method='post'>";
$editCategoryA .= "<fieldset class='group-select'>";
$editCategoryA .= "Category : $category_a_new_error";
$editCategoryA .= "<input type='hidden' name='category_a_old' value='$bay_category_a'>";
$editCategoryA .= "<input type='text' class='form-control' name='category_a_new' value='$bay_category_a' required autofocus />";
$editCategoryA .= "<div class='buttons-set'>";
$editCategoryA .= "<button type='submit' name='category_a_submit' title='Submit' class='button submit'> <span> Submit </span> </button>";
$editCategoryA .= "</div>";
$editCategoryA .= "</fieldset>";
$editCategoryA .= "</form>";
$editCategoryA .= "</div>";
echo $editCategoryA;
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
