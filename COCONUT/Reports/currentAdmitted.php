<?php
include("../../myDatabase2.php");

$ro = new database2();

echo "<center><br>";
$ro->coconutTableStart();
$ro->coconutTableRowStart();
$ro->coconutTableHeader("Room");
$ro->coconutTableHeader("Reg#");
$ro->coconutTableHeader("Patient");
$ro->coconutTableHeader("Admitted");
$ro->coconutTableHeader("Company");
$ro->coconutTableHeader("Cash");
$ro->coconutTableHeader("PhilHealth");
$ro->coconutTableHeader("Company");
$ro->coconutTableRowStop();
$ro->currentAdmitted("3rd floor");
$ro->currentAdmitted("2nd floor");
$ro->coconutTableStop();

?>
