<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
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
<h2 title='Forgotten Password?'>Forgotten Password?</h2>
</div>
    <div class='well col-xs-12'>
    <div class='col-xs-12 col-md-7'>
    <?php include_once (eblogin.'/login.php'); ?>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = "";
$usernameemail_error = "";
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>
<?php
if (isset($_REQUEST['retrieve']))
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

/* Full name */
if (empty($_REQUEST["usernameemail"]))
{
$usernameemail_error = "<b class='text-warning'>Username or eMail or Mobile Number Required.</b>";
$error =1;
} 
/* valitation fullname  */
elseif (! preg_match("/^[A-Za-z0-9\@\.\_]{3,32}$/",$usernameemail))
{
$usernameemail_error = "<b class='text-warning'>Username or eMail or Mobile Number?</b>";
$error =1;
}
else 
{
$usernameemail = $sanitization->test_input($_POST["usernameemail"]);
}
/* Submition form */
if($error ==0)
{
$user = new ebapps\login\login();
extract($_REQUEST);
$user -> retrieve($usernameemail);
}
}
?>
<form method='post'>
<fieldset class='group-select'>
<input type='hidden' name='form_key' value='<?php echo $formKey->outputKey(); ?>'>
<?php echo $formKey_error; ?>

<div class='input-group'>
<span class='input-group-addon' id='sizing-addon2'>Username or eMail:</span>
<?php echo $usernameemail_error;  ?>
<input type='text' name='usernameemail' placeholder='Username or eMail' class='form-control' aria-describedby='sizing-addon2' required  autofocus>
</div>

<div class='buttons-set'>
<button type='submit' name='retrieve' title='Submit' class='button submit'> <span> Submit </span> </button>
</div>
</fieldset>
</form>
<br />
<a href='<?php echo outAccessLink; ?>/signup.php'><button type='button' title='Register New User'><b>Register New User</b></button></a>
    </div>
    </div> 
    </div>
    <div class='col-xs-12 col-md-3 sidebar-offcanvas'>
    
    </div>
  </div>
</div>
<?php include_once (eblayout.'/a-common-footer.php'); ?>