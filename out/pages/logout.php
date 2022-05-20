<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php
include_once(ebbd.'/dbconfig.php');
$adMin = new ebapps\dbconnection\dbconfig();
if(isset($adMin->eBAdminUserIsSet))
{
?>
<?php
session_destroy();
unset($_SESSION['ebusername']);
unset($_SESSION['ebpassword']);
?>
<?php include_once (ebaccess.'/landingPage.php'); ?>
<?php
}
else
{
header("Location: ".outLink."/access/admin-register.php");
}
?>