<?php
include("../myDatabase.php");
$patientNo = $_GET['patientNo'];
$from = $_GET['from'];

$ro = new database();
$ro->coconutDesign();


echo "<Br><br><br>";
$ro->coconutFormStart("get","deleteRecord1.php");
$ro->coconutBoxStart_red("500","80");
echo "<Br>";
echo "DELETE <font color=red>".$ro->selectNow("patientRecord","completeName","patientNo",$patientNo)."</font>?";
echo "<Br>";
echo "<br>";
echo "<br>"; 
$ro->coconutButton("Proceed");
$ro->coconutHidden("from",$from);
$ro->coconutHidden("patientNo",$patientNo);
$ro->coconutBoxStop();
$ro->coconutFormStop();



?>
