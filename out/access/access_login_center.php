<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php include_once (ebHashKey.'/hashPassword.php'); ?>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php include_once (eblogin.'/login.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = "";
$ebusername_error = "<b>Username</b>";
$ebpassword_error = "<b>Password</b>";
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

/* ebusername */
if (empty($_REQUEST["ebusername"]))
{
$ebusername_error = "<b class='text-warning'>Username required.</b>";
$error =1;
}
/* valitation ebusername */
elseif(! preg_match("/^[A-Za-z0-9]{2,32}$/",$ebusername))
{
$ebusername_error = "<b class='text-warning'>Username use no-whitespace minimum 2 maximum 32.</b>";
$error =1;
}
else
{
$ebusername = $sanitization -> test_input($_POST["ebusername"]);
}
/* ebpassword */
if (empty($_REQUEST["ebpassword"]))
{
$ebpassword_error = "<b class='text-warning'>Password required.</b>";
$error =1;
}
/* valitation ebpassword  */
elseif (! preg_match("/^[A-Za-z0-9\-\.\,\_\[\]\+\=\)\(\*\&\^\%\$\#\@\!]{2,100}$/",$ebpassword))
{
$ebpassword_error = "<b class='text-warning'>Password use minimum 2 maximum 100.</b>";
$error =1;
}
else
{
$ebpassword = $sanitization -> test_input($_POST["ebpassword"]);
}
/* Submition form */
if($error == 0)
{
extract($_REQUEST);
$haPassword = new ebapps\hashpassword\hashPassword();
$ebpassword = $haPassword -> hashPassword($ebpassword);
$userLogin = new ebapps\login\login();
$userLogin -> login2system($ebusername, $ebpassword);
}

}
?>
<?php
if(empty($_SESSION['ebusername']))
{
?>
<div class='well'>
<form method='post'>
<input type='hidden' name='form_key' value='<?php echo $formKey->outputKey(); ?>'>
<?php echo $formKey_error; ?>
<?php echo $ebusername_error; ?>
<input type='text' name='ebusername' placeholder='Username' class='form-control' autofocus='1' required >
<?php echo $ebpassword_error; ?>
<input type='password' name='ebpassword' placeholder='Password' class='form-control' autofocus='1' required >
<div class='buttons-set'>
<button type='submit' name='login' title='Log In' class='button submit'> <span>Log In</span> </button>
</div>
</form>
<br />
<br />
<a href='<?php echo outAccessLink; ?>/access_frogetlogin.php'><button type='button' title='Forgotten Password?'><b>Forgotten Password?</b></button></a>
<br />
<br />
<a href='<?php echo outAccessLink; ?>/signup.php'><button type='button' title='Create New Account'><b>Create New Account</b></button></a>
</div>
<?php
}
?>
