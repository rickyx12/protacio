<?php
include("../../myDatabase.php");
$casetype = $_GET['casetype'];
$username = $_GET['username'];

$ro = new database();

$ro->deleteNow("phicLimit","casetype",$casetype);
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/casetype/showCasetype.php?username=$username");


?>
