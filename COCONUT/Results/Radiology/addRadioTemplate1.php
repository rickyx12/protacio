<?php
include("../../../myDatabase1.php");
$title = $_GET['title'];
$template = $_GET['template'];
$username = $_GET['username'];

$ro = new database1();

$ro->addRadioTemplate($title,$template);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Results/Radiology/addRadioTemplate.php?username=$username");

?>
