<?php
include("../../../myDatabase.php");
$requestNo = $_GET['requestNo'];

$ro = new database();

$requestNo = mysql_real_escape_string(strip_tags($requestNo));


echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a { text-decoration:none; color:black; }
</style>";


echo "Request#:".$requestNo;
echo "<br>";
$ro->coconutTableStart();
$ro->coconutTableRowStart();
$ro->coconutTableData("<b>Description</b>");
$ro->coconutTableData($ro->selectNow("admin2request","description","requestNo",$requestNo));

$ro->coconutTableRowStart();
$ro->coconutTableData("<b>QTY</b>");
$ro->coconutTableData($ro->selectNow("admin2request","qty","requestNo",$requestNo));
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("<b>Price</b>");
$ro->coconutTableData($ro->selectNow("admin2request","price","requestNo",$requestNo));
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$ro->coconutTableData("<b>Total</b>");
$ro->coconutTableData($ro->selectNow("admin2request","total","requestNo",$requestNo));
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("<b>Request</b>");
$ro->coconutTableData($ro->selectNow("admin2request","time","requestNo",$requestNo)." @ ".$ro->selectNow("admin2request","date","requestNo",$requestNo));
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$ro->coconutTableData("<b>Request By</b>");
$ro->coconutTableData($ro->selectNow("admin2request","requestBy","requestNo",$requestNo));
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$ro->coconutTableData("<b>Released</b>");
$ro->coconutTableData($ro->selectNow("admin2request","releaseTime","requestNo",$requestNo)." @ ".$ro->selectNow("admin2request","date","requestNo",$requestNo));
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("<b>Amount</b>");
$ro->coconutTableData($ro->selectNow("admin2request","releasedAmount","requestNo",$requestNo));
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("<b>Released By</b>");
$ro->coconutTableData($ro->selectNow("admin2request","releasedBy","requestNo",$requestNo)." @ ".$ro->selectNow("admin2request","date","requestNo",$requestNo));
$ro->coconutTableRowStop();

$ro->coconutTableRowStop();


?>
