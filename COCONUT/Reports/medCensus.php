<?php
include("../../myDatabase.php");

$ro = new database();


echo "<center><br>";
$ro->coconutTableStart();
$ro->coconutTableRowStart();
$ro->coconutTableHeader("Date");
$ro->coconutTableHeader("Dispensed");
$ro->coconutTableRowStop();

for($x=1;$x<32;$x++) {

if($x < 10) {
$x="0".$x;
}

$ro->coconutTableRowStart();
$ro->coconutTableData("Jun $x, 2012");
$ro->coconutTableData("&nbsp;".$ro->getMedCensus("Solmux","Jun",$x,"2012"));
$ro->coconutTableRowStop();
}


$ro->coconutTableStop();



?>
