<?php
include("../../../storedProcedure.php");
$date = $_POST['date'];

$ro = new storedProcedure();
echo "<center>";
$ro->coconutTableStart();
$ro->coconutTableRowStart();
$ro->coconutTableHeader("Description");
$ro->coconutTableHeader("QTY");
$ro->coconutTableHeader("Price");
$ro->coconutTableHeader("Total");
$ro->coconutTableHeader("Request By");
$ro->coconutTableHeader("Status");
$ro->coconutTableHeader("Released By");
$ro->coconutTableHeader("Released To");
$ro->coconutTableHeader("Amount Released");

$ro->coconutTableRowStart();
$ro->coconutTableData("<font color=red>Approved</font>");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableRowStop();


$ro->requestStatusReport($date,"APPROVED");

$ro->coconutTableRowStart();
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("<font color=red>Cancel</font>");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableRowStop();


$ro->requestStatusReport($date,"CANCEL");


$ro->coconutTableRowStart();
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("<font color=red>Waiting</font>");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableRowStop();


$ro->requestStatusReport($date,"waiting");


$ro->coconutTableStop();

?>
