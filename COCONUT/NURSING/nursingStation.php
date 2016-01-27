<?php
include("../../myDatabase.php");
$branch = $_GET['branch'];
$floor = $_GET['floor'];
$ro = new database();
$ro->coconutDesign();
$ro->coconutHeading("NURSING SERVICE (".$branch.")","COCONUT/NURSING/initializeNursing.php");
$ro->coconutUpperMenuStart();
$ro->coconutUpperMenu_headingStart("Floor");
$ro->showFloorAsUpperMenu($branch);
//$ro->coconutUpperMenu_headingMenu("","Search Patient");
$ro->coconutUpperMenu_headingStop();
$ro->coconutUpperMenu_headingStart("Patient");
$ro->coconutUpperMenu_headingMenu_target("http://".$ro->getMyUrl()."/COCONUT/currentPatient/patientInterface.php?username=&completeName=&module=","Search","_blank");
$ro->coconutUpperMenu_headingStop();
$ro->coconutUpperMenuStop();
$ro->coconutFrame_target("nursingStation1.php?branch=$branch&floor=$floor","991","540","nsX");
?>
