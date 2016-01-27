<?php
include("../../../myDatabase2.php");
$reconcileNo = $_GET['reconcileNo'];
$registrationNo = $_GET['registrationNo'];

$ro = new database2();

$ro->coconutDesign();

echo "<Br><Br><br><Br>";
$ro->coconutFormStart("get","reconcileDetails_deleteNow.php");
$ro->coconutHidden("reconcileNo",$reconcileNo);
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutBoxStart_red("500","88");
echo "<Br><br>";
echo "DELETE?";
echo "<Br><Br>";
$ro->coconutButton("Yes");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
