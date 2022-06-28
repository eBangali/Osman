<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php
include_once(ebbd.'/connection.inc.php');
include_once (ebbay.'/ebcart.php');
$obj = new ebapps\bay\ebcart();
if(isset($_POST['pic_name']) && $_POST['pic_name'] != '')
{
$pic_name = $_POST['pic_name'];
$query = "SELECT bay_category_b_in_bay_category_d FROM ";
$query .= "bay_category_d ";
$query .= "where bay_category_a_in_bay_category_d='".$pic_name."' GROUP BY bay_category_b_in_bay_category_d";

$result = $connectdb -> query($query);
if($result)
{
while($row = $result->fetch_array())
{
echo "<option value='".$row['bay_category_b_in_bay_category_d']."'>".$obj->visulString($row['bay_category_b_in_bay_category_d'])."</option>";
}
$result -> free_result();
}
$connectdb -> close();
}
?>