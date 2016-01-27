<?php
include("../../myDatabase.php");
$function = $_GET['function'];
$description = $_GET['description'];
$value = $_GET['val'];
$id = $_GET['id'];
$username = $_GET['username'];

$ro = new database();

$ro->editNow("reportHeading","headingNo",$id,"description",$description);
$ro->editNow("reportHeading","headingNo",$id,"information",$value);
$ro->gotoPage("misc.php?username=$username");
?>
