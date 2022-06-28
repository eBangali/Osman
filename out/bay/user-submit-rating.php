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
<?php include_once (ebaccess.'/access_permission_online_minimum.php'); ?>
<div class='container'>
<div class='row row-offcanvas row-offcanvas-right'>
<div class='col-xs-12 col-md-2'>

</div>
<div class='col-xs-12 col-md-7 sidebar-offcanvas'>
<div class="well">
<h2 title='Rating'>Rating</h2>
</div>
<div class='well'>
<?php include_once (ebbay.'/ebcart.php'); ?>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = "";
$bay_rating_for_quality_satisfaction_error = "*";
$bay_rating_for_communication_satisfaction_error = "*";
$bay_rating_testimonial_error = "*";
?> 
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>
<?php
if (isset($_REQUEST['bay_submit_rating']))
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

/* bay_rating_for_quality_satisfaction */
if (empty($_REQUEST["bay_rating_for_quality_satisfaction"]))
{
$bay_rating_for_quality_satisfaction_error = "<b class='text-warning'>Rating quality required</b>";
$error =1;
} 

elseif (! preg_match("/^([0-9]+)$/",$bay_rating_for_quality_satisfaction))
{
$bay_rating_for_quality_satisfaction_error = "<b class='text-warning'>Rating?</b>";
$error =1;
}
else 
{
$bay_rating_for_quality_satisfaction = $sanitization -> test_input($_POST["bay_rating_for_quality_satisfaction"]);
}
/* bay_rating_for_communication_satisfaction */
if (empty($_REQUEST["bay_rating_for_communication_satisfaction"]))
{
$bay_rating_for_communication_satisfaction_error = "<b class='text-warning'>Rating communication number required</b>";
$error =1;
} 

elseif (! preg_match("/^[0-9]$/",$bay_rating_for_communication_satisfaction))
{
$bay_rating_for_communication_satisfaction_error = "<b class='text-warning'>Use only numbers</b>";
$error =1;
}
else 
{
$bay_rating_for_communication_satisfaction = $sanitization -> test_input($_POST["bay_rating_for_communication_satisfaction"]);
}
/* bay_rating_testimonial */
if (empty($_REQUEST["bay_rating_testimonial"]))
{
$bay_rating_testimonial_error = "<b class='text-warning'>Rating testimonial required</b>";
$error =1;
}
elseif (! preg_match("/^([a-zA-Z0-9\,\.\?\ ]{3,100})/",$bay_rating_testimonial))
{
$bay_rating_testimonial_error = "<b class='text-warning'>Use A-Za-z0-9.,? mini 3 max 100.</b>";
$error =1;
}
else
{
$bay_rating_testimonial = $sanitization -> test_input($_POST["bay_rating_testimonial"]);
}
/* Submition form */
if($error ==0)
{
extract($_REQUEST);
$user = new ebapps\bay\ebcart();
$user->bay_submit_rating($bay_product_id_in_rating, $bay_tracking_order_id_in_rating, $bay_rating_for_quality_satisfaction, $bay_rating_for_communication_satisfaction, $bay_rating_testimonial);
}
}
if(isset($_REQUEST['BaySubmitRating']))
{
extract($_REQUEST);
$obj = new ebapps\bay\ebcart();
$obj->bay_submit_rating_read();
if($obj->eBData)
{
foreach($obj->eBData as $val):
extract($val);
if(empty($bay_rating_date))
{
$ratingMe ="<form method='post'>";  
$ratingMe .="<fieldset class='group-select'>";
$ratingMe .="<b>Please give me high rating to boost my Business</b>";

$ratingMe .="<input type='hidden' name='form_key' value='";
$ratingMe .= $formKey->outputKey(); 
$ratingMe .="'>";
$ratingMe .="$formKey_error";

$ratingMe .="<input type='hidden' name='bay_product_id_in_rating' value='$bay_product_id_in_rating' /><input type='hidden' name='bay_tracking_order_id_in_rating' value='$bay_tracking_order_id_in_rating' />"; 
$ratingMe .="Your Satisfaction for Quality out of 5: $bay_rating_for_quality_satisfaction_error <select class='form-control' name='bay_rating_for_quality_satisfaction'><option value='5'>5</option><option value='4'>4</option><option value='3'>3</option><option value='2'>2</option><option value='1'>1</option></select>"; 
$ratingMe .="Your Satisfaction for Communication/ after sales Services out of 5: $bay_rating_for_communication_satisfaction_error <select class='form-control' name='bay_rating_for_communication_satisfaction'><option value='5'>5</option><option value='4'>4</option><option value='3'>3</option><option value='2'>2</option><option value='1'>1</option></select>"; 
$ratingMe .="Give me a Testimonial: $bay_rating_testimonial_error <textarea class='form-control' name='bay_rating_testimonial' rows='6' required autofocus></textarea>";
$ratingMe .="<div class='buttons-set'><button type='submit' name='bay_submit_rating' title='Submit' class='button submit'><span>Submit</span></button></div>";
$ratingMe .="</fieldset>";
$ratingMe .="</form>";
} 
else 
{ 
$ratingMe = "<b>You have already submitted the rating.</b>"; 
} 
echo $ratingMe;
endforeach;
}
}
?>
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
