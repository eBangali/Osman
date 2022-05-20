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
<h2 title='Visitor Analytics'>Visitor Analytics</h2>
</div>
<?php
$updateAccount ="<div class='table-responsive'>"; 
$updateAccount .="<table class='table'>";
$updateAccount .="<thead>";
$updateAccount .="<tr>";
$updateAccount .="<th>Date</th>";
$updateAccount .="<th>From.IP</th>";
$updateAccount .="<th>From.Page</th>";
$updateAccount .="<th>Visited.Page</th>";
$updateAccount .="<th>Key.Stauts</th>";
$updateAccount .="</tr>";
$updateAccount .="</thead>";
$updateAccount .="<tbody>";
$visitsAnalytics = new ebapps\login\registration_page();
$visitsAnalytics->all_visitor_visits_analytics();
if($visitsAnalytics->data >= 1)
{
foreach($visitsAnalytics->data as $visitsAnalyticsVal)
{
extract($visitsAnalyticsVal);
$updateAccount .="<tr>";
$updateAccount .="<td>$visiteddate</td>";
$updateAccount .="<td>$requestip</td>";
$updateAccount .="<td>$visited_from_url</td>";
$updateAccount .="<td>$visited_url</td>";
$updateAccount .="<td>$fromkeystatus</td>";
$updateAccount .="</tr>";
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
