<?php
include("../../../myDatabase.php");
$casetype = $_GET['casetype'];
$registrationNo = $_GET['registrationNo'];

$ro = new database();

echo "<center><br><br>";
//$ro->getPHIClimit($casetype);
$ro->getPHIClimit_setter($casetype);
$ro->getPatientProfile($registrationNo);


$ro->coconutTableStart();
$ro->coconutTableRowStart();
$ro->coconutTableHeader("PHIC Medicine");
$ro->coconutTableHeader("PHIC Supplies");
$ro->coconutTableHeader("PHIC Room");
$ro->coconutTableHeader("PHIC PF");
$ro->coconutTableHeader("HMO");
$ro->coconutTableHeader("Cash");
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$ro->coconutTableData("&nbsp;".$ro->getPHIClimit_medicine());
$ro->coconutTableData("&nbsp;".$ro->getPHIClimit_supplies());
$ro->coconutTableData("&nbsp;".$ro->getPHIClimit_room());
$ro->coconutTableData("&nbsp;".$ro->getPHIClimit_pf());
$ro->coconutTableData("&nbsp;".$ro->getRegistrationDetails_limitHMO());
$ro->coconutTableData("&nbsp;".$ro->getRegistrationDetails_limitCASH());
$ro->coconutTableRowStop();
$ro->coconutTableStop();

echo "<hr>";
$ro->creditCharges($registrationNo,$casetype);

?>
