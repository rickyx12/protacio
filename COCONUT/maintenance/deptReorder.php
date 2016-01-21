<?php
include("../../myDatabase2.php");
$username = $_GET['username'];
$ro = new database2();
$ro->coconutDesign();


echo "<Br><Br>";
$ro->coconutBoxStart("400","100");
echo "<Br>Department";
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/masterfile/criticalLevel.php");
$ro->coconutHidden("username",$username);
$ro->coconutComboBoxStart_long("dept");
$ro->showInventoryLocation();
$ro->coconutComboBoxStop();
echo "<Br><Br>";
$ro->coconutButton("Proceed");
$ro->coconutFormStop();
$ro->coconutComboBoxStop();



?>
