<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database2();
$ro->coconutDesign();

$prePackage = $ro->selectNow("registrationDetails","prePackage","registrationNo",$registrationNo); 
$splitPrePackage = preg_split ("/\_/", $prePackage); 

echo "<br><br><br><br>";
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/patientProfile/SOAoption/isPackageCash1.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart_red("600","120");
echo "<br>";
echo "Is Package <font color=red>".$splitPrePackage[0]."</font> will pay by cash?";
echo "<br><br>";
$ro->coconutComboBoxStart_short("isCash");
echo "<option value='".$ro->selectNow("registrationDetails","isPackageCash","registrationNo",$registrationNo)."'>".$ro->selectNow("registrationDetails","isPackageCash","registrationNo",$registrationNo)."</option>";
echo "<option value='no'>no</option>";
echo "<option value='yes'>yes</option>";
$ro->coconutComboBoxStop();
echo "<br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
