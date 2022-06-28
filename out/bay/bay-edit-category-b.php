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
<h2 title='Edit Category B'>Edit Category B</h2>
</div>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = '';
$category_b_new_error = '*';
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>

<?php
$user = new ebapps\bay\ebcart();
if(isset($_REQUEST['category_b_submit']))
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

/* category_b_new */
if (empty($_REQUEST['category_b_new']))
{
$category_b_new_error = "<b class='text-warning'>Category B name required</b>";
$error =1;
} 
/* valitation category_b_new  */
elseif (! preg_match('/^([a-zA-Z0-9\/\-\,\.\(\)]+)$/',$category_b_new))
{
$category_b_new_error = "<b class='text-warning'>Whitespace, single or double quotes, certain special characters are not allowed.</b>";
$error =1;
}
else 
{
$category_b_new = $sanitization -> test_input($_POST['category_b_new']);
}
/* Submition form */
if($error == 0){
extract($_REQUEST);
$user->eidt_submit_category_b($category_b_new, $category_b_old);
}
//
}
?>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php
$editCategoryB = new ebapps\bay\ebcart();
$editCategoryB -> eidt_category_b_to_show(); 
if($editCategoryB->eBData){ foreach($editCategoryB->eBData as $valeditCategoryB): extract($valeditCategoryB);

$editCategoryB = "<div class='well'>";					 
$editCategoryB .= "<form method='post'>";
$editCategoryB .= "<fieldset class='group-select'>";
$editCategoryB .= "Category : $category_b_new_error";
$editCategoryB .= "<input type='hidden' name='category_b_old' value='$bay_category_b'>";
$editCategoryB .= "<input type='text' class='form-control' name='category_b_new' value='$bay_category_b' required autofocus />";
$editCategoryB .= "<div class='buttons-set'>";
$editCategoryB .= "<button type='submit' name='category_b_submit' title='Submit' class='button submit'> <span> Submit </span> </button>";
$editCategoryB .= "</div>";
$editCategoryB .= "</fieldset>";
$editCategoryB .= "</form>";
$editCategoryB .= "</div>";
echo $editCategoryB;
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
