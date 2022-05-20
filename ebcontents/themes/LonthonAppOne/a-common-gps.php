<?php
if(isset($_POST["uSerlati"]) && !empty($_POST["uSerlati"]) && isset($_POST["uSerlong"]) && !empty($_POST["uSerlong"]))
{
session_start();
$_SESSION["uSerlati"] = $_POST["uSerlati"];
$_SESSION["uSerlong"] = $_POST["uSerlong"];
}
?>