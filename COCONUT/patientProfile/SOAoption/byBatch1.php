<?php
include("../../../myDatabase1.php");
$registrationNo = $_GET['registrationNo'];
$dispensedNo = $_GET['dispensedNo'];

$ro = new database1();
$ro->getPatientProfile($registrationNo);

echo "<center><b><font size=4>".$ro->getReportInformation("hmoSOA_name")."</font></b></center>";
echo "<center><b><font size=2>".$ro->getReportInformation("hmoSOA_address")."</font></b></center>";
echo "<center><font size=2>Tel No. (062) 2143237</font></center>";
echo "<br>";
echo "Reg#:&nbsp;".$registrationNo."&nbsp;&nbsp;&nbsp;&nbsp;Batch#:&nbsp;".$dispensedNo;
echo "<br>";
echo "Name:&nbsp;".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName();
echo "<br>";
echo "Date Print:&nbsp;".date("M d, Y");
echo "<br>";
echo "PhilHealth:&nbsp;".$ro->getPatientRecord_phic();
echo "<br><br>";
$ro->getBatchMeds($registrationNo,$dispensedNo);


?>
