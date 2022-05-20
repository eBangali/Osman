<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php
include_once(ebbd.'/dbconfig.php');
$adMin = new ebapps\dbconnection\dbconfig();
if(isset($adMin->eBAdminUserIsSet))
{
?>
<?php include_once (ebblog.'/blog.php'); ?>
<?php
$obj = new ebapps\blog\blog();
$obj ->blog_control();
?>
<?php
}
else
{
header("Location: ".outLink."/access/admin-register.php");
}
?>