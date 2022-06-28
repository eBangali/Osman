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
<?php include_once (ebaccess.'/access_permission_online_minimum.php'); ?>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = "";
$bay_support_requirements_error = "*";
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>
<?php
if (isset($_REQUEST['bay_submit_query']))
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

/* bay_support_requirements */
if (empty($_REQUEST["bay_support_requirements"]))
{
$bay_support_requirements_error = "<b class='text-warning'>Query required</b>";
$error =1;
}
elseif (! preg_match("/^([a-zA-Z0-9\,\.\?\<\#\-\ ]{3,300})/",$bay_support_requirements))
{
$bay_support_requirements_error = "<b class='text-warning'>Use A-Za-z0-9.,? mini 3 max 300.</b>";
$error =1;
}
else
{
$bay_support_requirements = $sanitization -> test_input($_POST["bay_support_requirements"]);
}

/* Submition form */
if($error == 0)
{
extract($_REQUEST);
$user = new ebapps\bay\ebcart();
$user->merchant_bay_submit_a_query_buyer($bay_product_id_in_buyer_support, $bay_order_tracking_id, $bay_support_requirements);
}
}
?>
<?php
$obj = new ebapps\bay\ebcart();
$obj->merchant_bay_read_query_to_submit_another_one();
if($obj->eBData > 0)
{
foreach($obj->eBData as $val)
{
extract($val);
$queryMe ="<div class='well'>"; 
$queryMe .="<form method='post'>"; 
$queryMe .="<fieldset class='group-select'>";
$queryMe .="<legend><b>Query</b></legend>";
$queryMe .="<input type='hidden' name='form_key' value='";
$queryMe .= $formKey->outputKey(); 
$queryMe .="'>"; 
$queryMe .=""; 
$queryMe .="$formKey_error";
$queryMe .="<input type='hidden' name='bay_product_id_in_buyer_support' value='$bay_product_id_in_buyer_support' /><input type='hidden' name='bay_order_tracking_id' value='$bay_order_tracking_id' />"; 
$queryMe .="Query Description: $bay_support_requirements_error <textarea class='form-control' name='bay_support_requirements' rows='6' required autofocus placeholder='Please use  Google Drive, WeTransfer, Dropbox to link a file.'></textarea>";
$queryMe .="<div class='buttons-set'><button type='submit' name='bay_submit_query' title='Submit' class='button submit'><span>Submit</span></button></div>"; 
$queryMe .="</fieldset>";
$queryMe .="</form>";
$queryMe .="</div>";
echo $queryMe;  
}
}
?>
<?php
}
else
{
header("Location: ".outLink."/access/admin-register.php");
}
?>
