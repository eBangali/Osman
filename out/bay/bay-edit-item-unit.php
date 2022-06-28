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
<h2 title='Edit Item Unit'>Edit Item Unit</h2>
</div> 
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = '';
$item_unit_name_error = '*';
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>

<?php
if(isset($_REQUEST['item_unit_submit']))
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
if (empty($_REQUEST['item_unit_name']))
{
$item_unit_name_error = "<b class='text-warning'>Category name required</b>";
$error =1;
} 
/* valitation category_a  */
elseif (! preg_match('/^([a-zA-Z0-9\/\-\,\.\(\)]+)$/',$item_unit_name))
{
$item_unit_name_error = "<b class='text-warning'>Whitespace, single or double quotes, certain special characters are not allowed.</b>";
$error =1;
}
else 
{
$item_unit_name = $sanitization -> test_input($_POST['item_unit_name']);
}
/* Submition form */
if($error ==0){
$user = new ebapps\bay\ebcart();
extract($_REQUEST);
$user->submit_edit_item_unit($item_unit_id, $item_unit_name);
}
//
}
?>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php
$item_unit = new ebapps\bay\ebcart();
$item_unit -> eidt_item_unit_to_show(); 
if($item_unit->eBData){ foreach($item_unit->eBData as $valitem_unit): extract($valitem_unit);

$item = "<div class='well'>";					 
$item .= "<form method='post'>";
$item .= "<fieldset class='group-select'>";
$item .= "Category : $item_unit_name_error";
$item .= "<input type='hidden' name='item_unit_id' value='$size_id'>";
$item .= "<input type='text' class='form-control' name='item_unit_name' value='$size_name' required autofocus />";
$item .= "<div class='buttons-set'>";
$item .= "<button type='submit' name='item_unit_submit' title='Submit' class='button submit'> <span> Submit </span> </button>";
$item .= "</div>";
$item .= "</fieldset>";
$item .= "</form>";
$item .= "</div>";
echo $item;
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
