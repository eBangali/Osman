<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php include_once (eblogin.'/session.inc.php'); ?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<?php include_once (eblayout.'/a-common-header-title-one.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-noindex.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts.php'); ?>
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
<?php $obj = new ebapps\login\registration_page(); ?>
<div class='container'>
  <div class='row'>
    <div class='col-xs-12'>
    <div class="well">
<h2 title='User Analytics'>User Analytics</h2>
</div>
      <?php
$obj->all_user_account_info_read();
$updateAccount ="<div class='table-responsive'>"; 
$updateAccount .="<table class='table'>";
$updateAccount .="<thead>";
$updateAccount .="<tr>";
$updateAccount .="<th>Username</th>";
$updateAccount .="<th>Access From IP</th>";
$updateAccount .="<th>Visited URL</th>";
$updateAccount .="</tr>";
$updateAccount .="</thead>";
$updateAccount .="<tbody>";
if($obj->data >= 1)
{
foreach($obj->data as $val)
{
extract($val);
/////////////
$visitsAnalytics = new ebapps\login\registration_page();
$visitsAnalytics->all_user_visits_analytics($ebusername);
if($visitsAnalytics->data >= 1)
{
foreach($visitsAnalytics->data as $visitsAnalyticsVal)
{
extract($visitsAnalyticsVal);
$updateAccount .="<tr>";
$updateAccount .="<td>$ebusername</td>";
$updateAccount .="<td>$visiteddate</td>";
$updateAccount .="<td>$requestip</td>";
$updateAccount .="<td>$visitedurl</td>";
$updateAccount .="</tr>";
}
}
//////////

}
}
$updateAccount .="</tbody>";
$updateAccount .="</table>";
$updateAccount .="</div>";
echo $updateAccount;
?>
    </div>
  </div>
</div>
<?php include_once (eblayout.'/a-common-footer.php'); ?>
