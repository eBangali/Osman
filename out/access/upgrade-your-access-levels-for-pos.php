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
<?php include_once (ebaccess."/access_permission_online_minimum.php"); ?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>
<?php include_once (eblayout.'/a-common-ad-left.php'); ?>
</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>

<div class='well'>
<h2 title='Upgrade Access levels'>Upgrade Access levels</h2>
</div>
<?php include_once (ebHashKey.'/hashPassword.php'); ?>
<?php include_once (eblogin.'/registration_page.php'); ?>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = "";
$aggreeTerms_error ="";
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>
<?php
if (isset($_REQUEST['updatetomerchant']))
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
/* aggreeTerms */
if (empty($_REQUEST["aggreeTerms"]))
{
$aggreeTerms_error = "<b class='text-warning'>Agreement required</b>";
$error =1;
} 
/* Submition form */
if($error ==0)
{
extract($_REQUEST);
$user = new ebapps\login\registration_page();
$user->update_account_for_free_pos($ebusername);
}}
?>
<div class='well'>
<?php
$obj = new ebapps\login\registration_page();
$obj->update_account_info_read();
if($obj->data)
{
foreach($obj->data as $val)
{
extract($val);
$updateAccount ="<form method='post'>"; 
$updateAccount .="<fieldset class='group-select'>";
$updateAccount .="<input type='hidden' name='form_key' value='";
$updateAccount .= $formKey->outputKey(); 
$updateAccount .="'>"; 
$updateAccount .="$formKey_error";
$updateAccount .="<div class='input-group'><span class='input-group-addon' id='sizing-addon2'>Username: </span><span class='form-control' aria-describedby='sizing-addon2'>$ebusername <input type='hidden' name='ebusername' value='$ebusername' /></span></div>";
$updateAccount .="<div class='input-group'><span class='input-group-addon' id='sizing-addon2'>Level Type: </span><span class='form-control' aria-describedby='sizing-addon2'>$account_type</span></div>";
$updateAccount .="<div class='input-group'><span class='input-group-addon' id='sizing-addon2'>Level Power: </span><span class='form-control' aria-describedby='sizing-addon2'>$member_level</span></div>";
// 
$updateAccount .="<b>By sign up you agree our <a href='".outPagesLink."/terms-conditions.php'>terms and conditions.</a></b>"; 
$updateAccount .="$aggreeTerms_error <input type='checkbox' name='aggreeTerms' />";
$updateAccount .="<div class='buttons-set'>";
$updateAccount .="<button type='submit' name='updatetomerchant' title='Update' class='button submit'> <span> Update </span> </button>"; 
$updateAccount .="</div>";
$updateAccount .="</fieldset>";
$updateAccount .="</form>";
echo $updateAccount;  
}
}
?>
</div>
</div>
<div class='col-xs-12 col-md-3 sidebar-offcanvas'>
<?php include_once (eblayout."/a-common-ad-right.php"); ?>
</div>
</div>
</div>
<?php include_once (eblayout.'/a-common-footer.php'); ?>
