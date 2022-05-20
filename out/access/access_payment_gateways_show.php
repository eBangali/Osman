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
<?php include_once (eblogin.'/registration_page.php'); ?>
<?php
$paymentGateWay = new ebapps\login\registration_page();
$paymentGateWay -> payment_gateways_show(); 
if($paymentGateWay->data)
{
$paymentGetways = "<div class='well'>";
$paymentGetways .= "<article>";
$paymentGetways .= "<div class='panel panel-default'>";
$paymentGetways .= "<table class='table'>";
$paymentGetways .= "<thead>";
$paymentGetways .= "<tr>";
$paymentGetways .= "<th>Gatway</th>";
$paymentGetways .= "<th>Username</th>";
$paymentGetways .= "<th>Active</th>";
$paymentGetways .= "<th>OPTION</th>";
$paymentGetways .= "</tr>";
$paymentGetways .= "</thead>";
$paymentGetways .= "<tbody>";
foreach($paymentGateWay->data as $valpaymentGateWay): extract($valpaymentGateWay);
$paymentGetways .= "<tr>";
$paymentGetways .= "<td>$payment_gateways_brand</td>";
$paymentGetways .= "<td>$payment_gateways_username</td>";
if($payment_gateways_status == 'OK')
{
$paymentGetways .= "<td><i class='fa fa-check fa-lg' aria-hidden='true'></i></td>";
}
else
{
$paymentGetways .= "<td><i class='fa fa-ban fa-lg' aria-hidden='true'></i></td>";
}
$paymentGetways .= "<td><form action='access_payment_gateways_edit.php' method='get'><input type='hidden' name='payment_gateways_id' value='$payment_gateways_id' /><div class='buttons-set'><button type='submit' class='button submit' name='option_payment_gateway_edit' value='EDIT' alt='EDIT GATEWAY' title='EDIT GATEWAY'><b>EDIT</b></button></div></form></td>";
$paymentGetways .= "</tr>";
endforeach;
$paymentGetways .= "</tbody>";
$paymentGetways .= "</table>";
$paymentGetways .= "</div>";
$paymentGetways .= "</article>";
$paymentGetways .= "</div>";
echo $paymentGetways;
} 
?>