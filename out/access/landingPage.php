<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php
if (isset($_SESSION['memberlevel']) >= 4)
{
include_once (ebproduct.'/product.php');
}
else
{
include_once (ebproduct.'/product.php');
}
?>
