<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php
include_once(ebbd.'/dbconfig.php');
$adMin = new ebapps\dbconnection\dbconfig();
if(isset($adMin->eBAdminUserIsSet))
{
?>
<?php include_once (eblogin.'/session_access_retrive.inc.php'); ?>
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
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>

</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<div class='well'>
<h2 title='Please change your password'>Please change your password</h2>
</div>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = '';
$ebchangepassword_error = '';
$ebconfirmpassword_error = '';
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>
<?php
if (isset($_REQUEST['change_password']))
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

/* ebchangepassword */
if (empty($_REQUEST['ebchangepassword']))
{
$ebchangepassword_error = "<b class='text-warning'>password required</b>";
$error =1;
}
/* valitation ebchangepassword */
elseif(! preg_match('/^[A-Za-z0-9\-\_\[\]\+\=\)\(\*\&\^\%\$\#\@\!]{3,32}$/',$ebchangepassword))
{
$ebchangepassword_error = "<b class='text-warning'>Passowrd?</b>";
$error =1;
}
else
{
$ebchangepassword = $sanitization->test_input($_POST['ebchangepassword']);
}
/* ebconfirmpassword */
if (empty($_REQUEST['ebconfirmpassword']))
{
$ebconfirmpassword_error = "<b class='text-warning'>Confirm Password required</b>";
$error =1;
}
/* valitation ebconfirmpassword  */
elseif (! preg_match('/^[A-Za-z0-9\-\_\[\]\+\=\)\(\*\&\^\%\$\#\@\!]{3,32}$/',$ebconfirmpassword))
{
$ebconfirmpassword_error = "<b class='text-warning'>Confirm Password?</b>";
$error =1;
}
//
elseif($_POST['ebconfirmpassword'] != $_POST['ebchangepassword'])
{
$ebconfirmpassword_error = "<b class='text-warning'>Password does not match</b>";
$error =1;
}
else
{
$ebconfirmpassword = $sanitization->test_input($_POST['ebconfirmpassword']);
}
/* Submition form */
if($error ==0)
{
extract($_REQUEST);
if($ebconfirmpassword == $ebconfirmpassword)
{
include_once (ebHashKey.'/hashPassword.php');
$addHashToPass = new ebapps\hashpassword\hashPassword();
$ebconfirmpasswordTow = $addHashToPass -> hashPasswordChange($ebconfirmpassword);
include_once (eblogin.'/registration_page.php'); 
$ebUserTemp = new ebapps\login\registration_page();
$ebUserTemp->changepassword($ebconfirmpasswordTow);
}
}
}
?>
<div class='well'>
<form method='post'>
<fieldset class='group-select'>
<input type='hidden' name='form_key' value='<?php echo $formKey->outputKey(); ?>'>
<?php echo $formKey_error; ?>

<div class='input-group'>
<span class='input-group-addon' id='sizing-addon2'>New Password: </span> <?php echo $ebchangepassword_error; ?>
<input type='password' name='ebchangepassword' placeholder='New Password' class='form-control' aria-describedby='sizing-addon2' required  autofocus>
</div>


<div class='input-group'>
<span class='input-group-addon' id='sizing-addon2'>Confirm New Password: </span> <?php echo $ebconfirmpassword_error; ?>
<input type='password' name='ebconfirmpassword' placeholder='Confirm New Password' class='form-control' aria-describedby='sizing-addon2' required  autofocus>
</div>

<div class='buttons-set'>
<button type='submit' name='change_password' title='Change' class='button submit'> <span> Change </span> </button>
</div>

</fieldset>
</form>
</div>
</div>
<div class='col-xs-12 col-md-3 sidebar-offcanvas'>

</div>
</div>
</div>
<?php include_once (eblayout.'/a-common-footer.php'); ?>
<?php
}
else
{
header("Location: ".outLink."/access/admin-register.php");
}
?>
