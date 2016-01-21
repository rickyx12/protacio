<?php
include("../myDatabase.php");
$ip = $_GET['ip'];

$ro = new database();

$ro->editNow("ipaddress","code","1992","ipaddress",$ip);

$ro->gotoPage("http://".$ro->getMyUrl()."/LOGINPAGE/networkConfiguration.php");

?>
