<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$chargesCode = $_GET['chargesCode'];
$username = $_GET['username'];

$ro = new database2();

echo "
<style type='text/css'>
.Arial16RedBold {font-family: Arial;font-size: 16px;color: #FF0000;font-weight: bold;}
</style>
";

echo "<Br><Br><Br>";
$ro->coconutBoxStart_red("500","130");

echo "<br>";
$ro->coconutFormStart("get","deleteRoom1.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("itemNo",$itemNo);
$ro->coconutHidden("chargesCode",$chargesCode);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("control","delete");
$ro->coconutButton("&nbsp;&nbsp;Delete Room&nbsp;&nbsp;");
$ro->coconutFormStop();

$ro->coconutFormStart("get","deleteRoom1.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("itemNo",$itemNo);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("chargesCode",$chargesCode);
$ro->coconutHidden("control","discharge");
$ro->coconutButton("&nbsp;&nbsp;Discharge Room&nbsp;&nbsp;");
$ro->coconutFormStop();


$ro->coconutFormStart("get","computeDays.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("itemNo",$itemNo);
$ro->coconutHidden("username",$username);
$ro->coconutButton("Compute Days");
$ro->coconutFormStop();

$ro->coconutBoxStop();

?>
