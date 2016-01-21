<?php
include("../myDatabase.php");

$ro = new database();

$ro->coconutDesign();

$ro->coconutFormStart("get","networkConfiguration1.php");
echo "<center><br><br><Br><font size=3>Network &nbsp;</font><br>";
$ro->coconutBoxStart("400","130");
echo "<br><br>";
$ro->coconutTextBox("ip",$ro->getMyUrl());
echo "<br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
