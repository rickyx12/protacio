<?php
include("../myDatabase2.php");
$username = $_GET['username'];
$datez = $_GET['datez'];
$from = $_GET['from'];
$ro = new database2();

//echo "<font size=2>Date&nbsp;</font>&nbsp;<font size=2 color=red>".$datez."</font>";
echo "<form method='get' action='/COCONUT/opdRegistration.php'>";
$ro->coconutHidden("from",$from);
echo "<input type='text' style='border:1px solid #ff0000;' name='datez' value='$datez'>";
echo "</form>";
$ro->getPatientForReg($datez,$username);


?>
