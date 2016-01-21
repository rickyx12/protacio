<?php
include("../../../myDatabase2.php");
$batchNo = $_GET['batchNo'];
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$itemNo = $_GET['itemNo'];

$subjective = $_GET['subjective'];
$objective = $_GET['objective'];
$assessment = $_GET['assessment'];

$ro = new database2();

if( $ro->selectNow("SOAP","itemNo","itemNo",$itemNo) != "" ) {
$ro->doubleEditNow("SOAP","itemNo",$itemNo,"registrationNo",$registrationNo,"subjective",$subjective);
$ro->doubleEditNow("SOAP","itemNo",$itemNo,"registrationNo",$registrationNo,"objective",$objective);
$ro->doubleEditNow("SOAP","itemNo",$itemNo,"registrationNo",$registrationNo,"assessment",$assessment);
}else {
$ro->insert_soap($itemNo,$registrationNo,$subjective,$objective,$assessment,"");
}

echo "<div style='background:#47a3da; margin:10px; height:60px; width:350px; border-radius:15px;' >";
echo "<br><center>";
echo "<table border=0>";
echo "<tr>";
echo "<td>";
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/android/doctor/mobileAddCharges_charges_handler.php");
echo "<input type='submit' style='background:#47a3da; border:0px; color:white; font-weight:bold; font-size:20px;' value='Charges'>";
$ro->coconutHidden("batchNo",$batchNo);
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("room",$ro->selectNow("registrationDetails","room","registrationNo",$registrationNo));
$ro->coconutHidden("username",$username);
$ro->coconutFormStop();
echo "</td>";

echo "<td>";
$ro->coconutFormStart("post","#");
echo "<input type='submit' style='background:#47a3da; border:0px; color:#47a3da; font-weight:bold; font-size:20px;' value='Medicine'>";
$ro->coconutFormStop();
echo "</td>";

echo "<td>";
$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/android/doctor/mobileAddCharges_medicine_handler.php");
echo "<input type='submit' style='background:#47a3da; border:0px; color:white; font-weight:bold; font-size:20px;' value='Medicine'>";
$ro->coconutHidden("batchNo",$batchNo);
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("room",$ro->selectNow("registrationDetails","room","registrationNo",$registrationNo));
$ro->coconutHidden("username",$username);
$ro->coconutFormStop();
echo "</td>";

echo "</tr>";
echo "</table>";
echo "</div>";

?>
