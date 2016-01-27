<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];

$ro = new database2();

$ro->coconutDesign();


echo "<br><br><br>";

$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/rBanny/approximate.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutBoxStart("500","100");
echo "<br>";
echo "Case Rate:&nbsp;";
$ro->coconutComboBoxStart_long("caserate");
echo "<option value=''></option>";
$ro->showOption_with_value("rBanny_caserate","caserate","caseNo");
$ro->coconutComboBoxStop();
echo "<br><Br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
