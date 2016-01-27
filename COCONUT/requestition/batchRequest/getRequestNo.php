<?php
include("../../../myDatabase2.php");
$username = $_GET['username'];


$ro = new database2();
$ro->coconutDesign();
$ro->getRequestNo();
$myFile = $ro->getReportInformation("homeRoot")."/COCONUT/trackingNo/requestNo.dat";
$fh = fopen($myFile, 'r');
$requestNo = fread($fh, 100);
fclose($fh);
/*
echo $username;
echo "<br>";
echo $requestNo;
*/

echo "<Br><Br><Br><Br>";
$ro->coconutFormStart("get","requestHandler.php");
$ro->coconutHidden("username",$username);
$ro->coconutHidden("requestNo",$requestNo);
$ro->coconutBoxStart("500","80");
echo "<Br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>My Department:&nbsp;</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("department");
echo "<option value=''></option>";
echo "<option value='OR'>OR</option>";
echo "<option value='ER'>ER</option>";
echo "<option value='PHARMACY'>PHARMACY</option>";

$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<Br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
