<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
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
      <?php include_once (eblayout.'/a-common-navebar-index-blog.php'); ?>
    </div>
  </div>
</nav>
<?php include_once (eblayout.'/a-common-page-id-end.php'); ?>
<?php include_once (ebaccess.'/access_permission_admin_minimum.php'); ?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-9 sidebar-offcanvas'>
<div class="well">
<h2 title='Payment Gateways'>Payment Gateways</h2>
</div>
<div class='well'>

<?php include_once (eblogin.'/registration_page.php'); ?>
<?php $formMail = new ebapps\login\registration_page(); ?>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = "";
$gateway_error = "";
$payment_id_error = "";
$public_key_error = "";
$private_key_error = "";
$extra_key_one_error = "";
$extra_key_two_error = "";
$captcha_error = "";
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>
<?php
if (isset($_REQUEST['paymentGateway']))
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
/* gateway */
if (empty($_REQUEST["gateway"]))
{
$gateway_error = "<b class='text-warning'>Gateway required.</b>";
$error =1;
}
/* valitation gateway  */
elseif (! preg_match("/^([A-Za-z0-9\-\_\.\@]+){3,180}$/",$gateway))
{
$gateway_error = "<b class='text-warning'>Invalid Gateway.</b>";
$error =1;
}
else
{
$gateway = $sanitization -> test_input($_POST["gateway"]);
}
/* payment_id */
if (empty($_REQUEST["payment_id"]))
{
$payment_id_error = "<b class='text-warning'>Payment ID Required.</b>";
$error =0;
}
/* valitation gateway  */
elseif (! preg_match("/^([A-Za-z0-9\-\_\.\@]+){3,180}$/",$payment_id))
{
$payment_id_error = "<b class='text-warning'>Invalid Gateway ID.</b>";
$error =0;
}
else
{
$payment_id = $sanitization -> test_input($_POST["payment_id"]);
}
/* public_key */
if (empty($_REQUEST["public_key"]))
{
$public_key_error = "<b class='text-warning'>Public Key Required.</b>";
$error =0;
}
/* valitation public_key  */
elseif (! preg_match("/^([A-Za-z0-9\-\_\.\@]+){3,180}$/",$public_key))
{
$public_key_error = "<b class='text-warning'>Invalid Public Key.</b>";
$error =0;
}
else
{
$public_key = $sanitization -> test_input($_POST["public_key"]);
}
/* private_key */
if (empty($_REQUEST["private_key"]))
{
$private_key_error = "<b class='text-warning'>Private Key Required.</b>";
$error =0;
}
/* valitation private_key  */
elseif (! preg_match("/^([A-Za-z0-9\-\_\.\@]+){3,180}$/",$private_key))
{
$private_key_error = "<b class='text-warning'>Invalid Private Key.</b>";
$error =0;
}
else
{
$private_key = $sanitization -> test_input($_POST["private_key"]);
}
/* extra_key_one */
if (empty($_REQUEST["extra_key_one"]))
{
$extra_key_one_error = "<b class='text-warning'>Extra Key One Required.</b>";
$error =0;
}
/* valitation extra_key_one  */
elseif (! preg_match("/^([A-Za-z0-9\-\_\.\@]+){3,180}$/",$extra_key_one))
{
$extra_key_one_error = "<b class='text-warning'>Invalid Extra Key.</b>";
$error =0;
}
else
{
$extra_key_one = $sanitization -> test_input($_POST["extra_key_one"]);
}
/* extra_key_two */
if (empty($_REQUEST["extra_key_two"]))
{
$extra_key_two_error = "<b class='text-warning'>Extra Key Two Required.</b>";
$error =0;
}
/* valitation extra_key_two  */
elseif (! preg_match("/^([A-Za-z0-9\-\_\.\@]+){3,180}$/",$extra_key_two))
{
$extra_key_two_error = "<b class='text-warning'>Invalid Extra Key Two.</b>";
$error =0;
}
else
{
$extra_key_two = $sanitization -> test_input($_POST["extra_key_two"]);
}
/* Captcha */
if (empty($_REQUEST["answer"]))
{
$captcha_error = "<b class='text-warning'>Captcha required.</b>";
$error =1;
}
elseif (isset($_SESSION['captcha']) and $_POST['answer'] !==$_SESSION['captcha'])
{
unset($_SESSION['captcha']);
$captcha_error = "<b class='text-warning'> Captcha?</b>";
$error =1;
}
else
{
$sanitization->test_input($_POST["answer"]);
}
/* Submition form */
if($error ==0)
{
extract($_REQUEST);
$formMail->paymentGatewaySetUp($gateway,$payment_id,$public_key,$private_key,$extra_key_one,$extra_key_two);
}
}
?>
<?php include_once (ebaccess.'/access_payment_gateways_show.php'); ?>
<div class='well'>
<form method='post' enctype="multipart/form-data">
<fieldset class='group-select'>
<input type='hidden' name='form_key' value='<?php echo $formKey->outputKey(); ?>' />
<?php echo $formKey_error; ?>

<div class='input-group'>
<span class='input-group-addon' id='sizing-addon2'>Gateway: <?php echo $gateway_error;  ?></span>
<select class='form-control' name='gateway'>
<option value='stripe'>Stripe</option>
<option value='simplify'>Simplify</option>
<option value='paypal' selected='selected'>PayPal</option>
<option value='bKash'>bKash</option>
<option value='OldBkash'>Old bKash</option>
</select>
</div>
<div class='input-group'> <span class='input-group-addon' id='sizing-addon2'>Payment ID: <?php echo $payment_id_error; ?></span>
<input type='text' name='payment_id' placeholder='Payment ID' class='form-control' aria-describedby='sizing-addon2'>
</div>
<div class='input-group'> <span class='input-group-addon' id='sizing-addon2'>Public Key: <?php echo $public_key_error;  ?></span>
<input type='text' name='public_key' placeholder='Public Key' class='form-control' aria-describedby='sizing-addon2'>
</div>
<div class='input-group'> <span class='input-group-addon' id='sizing-addon2'>Private Key: <?php echo $private_key_error;  ?></span>
<input type='text' name='private_key' placeholder='Private Key' class='form-control' aria-describedby='sizing-addon2'>
</div>
<div class='input-group'> <span class='input-group-addon' id='sizing-addon2'>Extra Key One: <?php echo $extra_key_one_error;  ?></span>
<input type='text' name='extra_key_one' placeholder='Extra Key One' class='form-control' aria-describedby='sizing-addon2'>
</div>
<div class='input-group'> <span class='input-group-addon' id='sizing-addon2'>Extra Key Two: <?php echo $extra_key_two_error;  ?></span>
<input type='text' name='extra_key_two' placeholder='Extra Key Two' class='form-control' aria-describedby='sizing-addon2'>
</div>
<div class='input-group'> <span class='input-group-addon' id='sizing-addon2'>
<?php
include_once(ebfromeb.'/captcha.php');
$cap = new ebapps\captcha\captchaClass();	
$captcha = $cap -> captchaFun();
echo "<b class='btn btn-Captcha btn-sm gradient'>$captcha</b>";
?>
<?php echo $captcha_error;  ?></span>
<input type='text' name='answer' placeholder='Enter captcha here' class='form-control' aria-describedby='sizing-addon2' required>
</div>
<div class='buttons-set'>
<button type='submit' name='paymentGateway' title='Add Payment Gateway' class='button submit'> <span> Add Payment Gateway </span> </button>
</div>
</fieldset>
</form>
</div>
</div>
</div>
<div class='col-xs-12 col-md-3 sidebar-offcanvas'>
<?php include_once ("access-my-account.php"); ?>
</div>
</div>
</div>
<?php include_once (eblayout.'/a-common-footer-edit.php'); ?>
