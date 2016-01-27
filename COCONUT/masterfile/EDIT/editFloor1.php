<?php
include("../../../myDatabase.php");
$floor = $_GET['floor'];
$branch = $_GET['branch'];
$floorNo = $_GET['floorNo'];
$username = $_GET['username'];
$show = $_GET['show'];
$desc = $_GET['desc'];

$ro = new database();
$ro->EditNow("floor","floorNo",$floorNo,"description",$floor);
$ro->EditNow("floor","floorNo",$floorNo,"branch",$branch);
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/masterfile/floor.php?username=$username&desc=$desc&show=$show");
?>
