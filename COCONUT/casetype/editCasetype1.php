<?php
include("../../myDatabase.php");
$casetype = $_GET['casetype'];
$medicine = $_GET['medicine'];
$supplies = $_GET['supplies'];
$room = $_GET['room'];
$pf = $_GET['pf'];
$suppliesOnly = $_GET['suppliesOnly'];
$username = $_GET['username'];

$ro = new database();

$ro->editNow("phicLimit","casetype",$casetype,"medicine",$medicine);
$ro->editNow("phicLimit","casetype",$casetype,"supplies",$supplies);
$ro->editNow("phicLimit","casetype",$casetype,"room",$room);
$ro->editNow("phicLimit","casetype",$casetype,"pf",$pf);
$ro->editNow("phicLimit","casetype",$casetype,"suppliesOnly",$suppliesOnly);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/casetype/showCasetype.php?username=$username");

?>
