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
<h2 title='Add Category C'>Add Category C</h2>
</div>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<script language='javascript' type='text/javascript'>
/* Select B from A */
$(document).ready(function()
{
$("#category_a").change(function()
{
var pic_name = $(this).val();
if(pic_name != '')  
{
$.ajax
({
type: "POST",
url: "bay_merchant_add_items_select_b_from_a.php",
data: "pic_name="+ pic_name,
success: function(option)
{
$("#category_b").html("<option value=''>Please Select</option>"+option);
}
});
}
else
{
$("#category_b").html("<option value=''>Please Select</option>");
}
return false;
});
});
</script>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = '';
$category_a_error = '*';
$category_b_error = '*';
$category_c_error = '*';
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>

<?php
$user = new ebapps\bay\ebcart();
if(isset($_REQUEST['category_c_submit']))
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
if (empty($_REQUEST['category_a']))
{
$category_a_error = "<b class='text-warning'>Category a name required</b>";
$error =1;
} 
/* valitation category_a  */
elseif (! preg_match('/^([a-zA-Z0-9\/\-\,\.\(\)]+)$/',$category_a))
{
$category_a_error = "<b class='text-warning'>Whitespace, single or double quotes, certain special characters are not allowed.</b>";
$error =1;
}
else 
{
$category_a = $sanitization -> test_input($_POST['category_a']);
}
/* category_b */
if (empty($_REQUEST['category_b']))
{
$category_b_error = "<b class='text-warning'>Category b name required</b>";
$error =1;
} 
/* valitation category_b  */
elseif (! preg_match('/^([a-zA-Z0-9\/\-\,\.\(\)]+)$/',$category_b))
{
$category_b_error = "<b class='text-warning'>Whitespace, single or double quotes, certain special characters are not allowed.</b>";
$error =1;
}
else 
{
$category_b = $sanitization -> test_input($_POST['category_c']);
}
/* category_c */
if (empty($_REQUEST['category_c']))
{
$category_c_error = "<b class='text-warning'>Category c name required</b>";
$error =1;
} 
/* valitation category_c  */
elseif (! preg_match('/^([a-zA-Z0-9\/\-\,\.\(\)]+)$/',$category_c))
{
$category_c_error = "<b class='text-warning'>Whitespace, single or double quotes, certain special characters are not allowed.</b>";
$error =1;
}
else 
{
$category_c = $sanitization -> test_input($_POST['category_c']);
}
/* Submition form */
if($error ==0){
extract($_REQUEST);
$user->submit_category_c($category_a, $category_b, $category_c);
}
//
}
?>
<div class='well'>
<form method='post'>
<fieldset class='group-select'>

<input type='hidden' name='form_key' value='<?php echo $formKey->outputKey(); ?>'>
<?php echo $formKey_error; ?>
Select Category A: <?php echo $category_a_error;  ?>
<select class='form-control' id='category_a' name='category_a'><option>Please Select</option><?php $user->select_category_a(); ?></select>
Select Category B: <?php echo $category_b_error;  ?>
<select class='form-control' id='category_b' name='category_b'><option>Please Select</option></select>
Category C: <?php echo $category_c_error;  ?>
<input class='form-control' type='text' name='category_c' placeholder="Men-s-T-shirts will be shown as Men's T-shirts" required autofocus />
<div class='buttons-set'>
<button type='submit' name='category_c_submit' title='Submit' class='button submit'> <span> Submit </span> </button>
</div>
</fieldset>
</form>
</div>


<div class='well'>
<article>
<div class="panel panel-default table-responsive">
<table class="table">
<thead>
<tr>
<th>CATEGORY A</th>
<th>CATEGORY B</th>
<th>CATEGORY C</th>
<th>EDIT</th>
</tr>
</thead>
<tbody>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php $obj= new ebapps\bay\ebcart(); $obj -> select_category_c_to_show(); ?>
<?php if($obj->eBData){ foreach($obj->eBData as $val): extract($val); ?>
<?php 
$zoneDhl = "<tr>";					 
$zoneDhl .= "<td>".$obj->visulString($bay_category_a_in_bay_category_c)."</td>";
$zoneDhl .= "<td>".$obj->visulString($bay_category_b_in_bay_category_c)."</td>";
$zoneDhl .= "<td>".$obj->visulString($bay_category_c)."</td>";
$zoneDhl .= "<td><form action='bay-edit-category-c.php' method='get'><input type='hidden' name='category_c_old' value='$bay_category_c' /><button type='submit' name='edit_category_c' value='Edit' class='button submit' alt='Edit'><b>Edit</b></button></form></td>";
$zoneDhl .= "</tr>";
echo $zoneDhl;
endforeach;
}
?>    
</tbody>
</table>
</div>
</article>
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
