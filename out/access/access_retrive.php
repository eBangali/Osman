<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php include_once (ebHashKey.'/hashPassword.php'); ?>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = '';
$ebusername_error = '*';
$password_error = '*';
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>
<?php
if(isset($_REQUEST['login']))
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

/* ebusername */
if (empty($_REQUEST['ebusername']))
{
$ebusername_error = "<b class='text-warning'>Username required</b>";
$error =1;
}
/* valitation ebusername */
elseif(! preg_match('/^[A-Za-z0-9]{3,32}$/',$ebusername))
{
$ebusername_error = "<b class='text-warning'>Use no-whitespace mini 3 max 32</b>";
$error =1;
}
else
{
$ebusername = $sanitization->test_input($_POST['ebusername']);
}
/* password */
if (empty($_REQUEST['password']))
{
$password_error = "<b class='text-warning'>Temporary Password required</b>";
$error =1;
}
/* valitation password  */
elseif (! preg_match('/^[A-Za-z0-9\-\_\[\]\+\=\)\(\*\&\^\%\$\#\@\!]{3,64}$/',$password))
{
$password_error = "<b class='text-warning'>Use no-whitespace, mini 3 max 64</b>";
$error =1;
}
else
{
$password = $sanitization->test_input($_POST['password']);
}
/* Submition form */
if($error == 0)
{
extract($_REQUEST);
$user -> login2system($ebusername, $password);
}

}
?>
<?php
if(empty($_SESSION['ebusername']))
{
?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<?php include_once (eblayout.'/a-common-header-title-one.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts.php'); ?>
<?php include_once (eblayout.'/a-common-page-id-start.php'); ?>
<nav>
  <div class='container'>
    <div>
      <?php include_once (eblayout.'/a-common-navebar.php'); ?>
      <?php include_once (eblayout.'/a-common-navebar-index-blog.php'); ?>
    </div>
  </div>
</nav>
<?php include_once (eblayout.'/a-common-navebar.php'); ?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>
<?php include_once (eblayout.'/a-common-ad-left.php'); ?>
</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<div class='well'>
<h2 title='Temporary Login'>Temporary Login</h2>
</div>
<div class='well'>
<form method='post'>
<fieldset class='group-select'>
<input type='hidden' name='form_key' value='<?php echo $formKey->outputKey(); ?>'>
<?php echo $formKey_error; ?>

<div class='input-group'>
<span class='input-group-addon' id='sizing-addon2'>Username: <?php echo $ebusername_error; ?></span>
<input type='text' name='ebusername' placeholder='username' class='form-control' aria-describedby='sizing-addon2' required  autofocus>
</div>


<div class='input-group'>
<span class='input-group-addon' id='sizing-addon2'>Temporary Password: <?php echo $password_error; ?></span>
<input type='password' name='password' placeholder='Temporary Password' class='form-control' aria-describedby='sizing-addon2' required  autofocus>
</div>

<div class='buttons-set'>
<button type='submit' name='login' title='Login' class='button submit'> <span> Login </span> </button>
</div>
</fieldset>
</form>
</div>
</div>
<div class='col-xs-12 col-md-3 sidebar-offcanvas'>
<?php include_once (eblayout.'/a-common-ad-right.php'); ?>
</div>
</div>
</div>	
<?php include_once (eblayout.'/a-common-footer.php'); ?>
<?php exit(); } ?>