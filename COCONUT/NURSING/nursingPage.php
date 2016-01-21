<?php
include("../../myDatabase.php");
$ro = new database();
$ro->coconutHeading("NURSING SERVICE","COCONUT/NURSING/initializeNursing.php");
$ro->coconutDesign();
echo "<br><br>";
$ro->coconutFormStart("get","nursingStation.php");
$ro->coconutHidden("username","");
$ro->coconutHidden("module","");
$ro->coconutBoxStart("600px","125px");
echo "<Br><br>";
$ro->coconutComboBoxStart_long("branch");
$ro->showOption("branch","branch");
$ro->coconutComboBoxStop();
echo "<br>";
$ro->coconutComboBoxStart_long("floor");
$ro->showFloor();
$ro->coconutComboBoxStop();
echo "<br><Br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();
?>
