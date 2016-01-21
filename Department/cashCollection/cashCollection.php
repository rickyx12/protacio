<?php
include("../../myDatabase1.php");
$username = $_GET['username'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$dept = $_GET['dept'];

$ro = new database1();


echo "<br>";
echo "<Center>";

$ro->coconutTableStart();
$ro->coconutTableRowStart();
$ro->coconutTableHeader("Patient");
$ro->coconutTableHeader("Description");
$ro->coconutTableHeader("Balance");
$ro->coconutTableHeader("PhilHealth");
$ro->coconutTableHeader("Company");
$ro->coconutTableRowStop();
$ro->getCollectionPerDept($username,$month,$day,$year,$dept);
$ro->getCollectionPerDept1($username,$month,$day,$year,$dept);
$ro->coconutTableRowStart();
$ro->coconutTableData("<b>Total</b>");
$ro->coconutTableData("");
$ro->coconutTableData(number_format($ro->getCollectionPerDept_total,2));
$ro->coconutTableData(number_format($ro->getCollectionPerDept_phic,2));
$ro->coconutTableData(number_format($ro->getCollectionPerDept_company,2));
$ro->coconutTableRowStop();
$ro->coconutTableStop();


?>
