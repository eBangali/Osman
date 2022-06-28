<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php
include_once(ebbd.'/dbconfig.php');
$adMin = new ebapps\dbconnection\dbconfig();
if(isset($adMin->eBAdminUserIsSet))
{
?>

<?php include_once (eblogin.'/session.inc.php'); ?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<?php include_once (eblayout.'/a-common-header-title-one.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-noindex.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts-graph.php'); ?>
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
<?php include_once (ebaccess.'/access_permission_writer_minimum.php'); ?>
<?php include_once (eblogin.'/registration_page.php'); ?>
<div class='container'>
<div class='row'>
<div class='col-xs-12'>
<div class='well'>
<h2 title='Visitor Analytics'>Visitor Analytics</h2>
</div>
<div id='chart'></div>
<script>
/* Bar, Line, Area,*/
Morris.Area({
 element: 'chart',
 data:[<?php
$graphData = new ebapps\login\registration_page();
$graphData->all_visitor_visits_analytics_graph();
if($graphData->eBData >= 1)
{
foreach($graphData->eBData as $graphDataVal)
{
extract($graphDataVal);
$graphpDataJs  = "{";
$graphpDataJs .= "requestip: '$requestIPCart', ";
$graphpDataJs .= "visiteddate: '$visitedDateCar', ";
$graphpDataJs .= "visited_from_url: '$visitedFromUrlCart', ";
$graphpDataJs .= "visited_url: '$visitedUrlCart'},";
echo $graphpDataJs;
}
}
?>],
 xkey:['visiteddate'],
 ykeys:['requestip', 'visited_from_url', 'visited_url'],
 labels:['IP', 'From', 'URLs'],
 hideHover:'auto',
 //stacked:true
});
</script>
<?php
$updateAccount ="<div class='table-responsive'>"; 
$updateAccount .="<table class='table'>";
$updateAccount .="<thead>";
$updateAccount .="<tr>";
$updateAccount .="<th>Date</th>";
$updateAccount .="<th>From.IP</th>";
$updateAccount .="<th>From.Page</th>";
$updateAccount .="<th>Visited.Page</th>";
$updateAccount .="</tr>";
$updateAccount .="</thead>";
$updateAccount .="<tbody>";
$visitsAnalytics = new ebapps\login\registration_page();
$visitsAnalytics->all_visitor_visits_analytics();
if($visitsAnalytics->eBData >= 1)
{
foreach($visitsAnalytics->eBData as $visitsAnalyticsVal)
{
extract($visitsAnalyticsVal);
$updateAccount .="<tr>";
$updateAccount .="<td>$visiteddate</td>";
$updateAccount .="<td>$requestip</td>";
$updateAccount .="<td>".substr($visited_from_url, 0, 50)."</td>";
$updateAccount .="<td>".substr($visited_url, 0, 80)."</td>";
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
<?php include_once (eblayout.'/a-common-footer-graph.php'); ?>
<?php
}
else
{
header("Location: ".outLink."/access/admin-register.php");
}
?>

