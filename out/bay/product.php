<?php include_once (dirname(dirname(dirname(__FILE__)))."/initialize.php"); ?>
<?php
include_once(ebbd.'/dbconfig.php');
$adMin = new ebapps\dbconnection\dbconfig();
if(isset($adMin->eBAdminUserIsSet))
{
?>
<?php include_once (ebbay."/ebcart.php"); ?>
<?php
$obj= new ebapps\bay\ebcart();
$obj ->ecart();
?>
<?php
}
else
{
header("Location: ".outLink."/access/admin-register.php");
}
?>
