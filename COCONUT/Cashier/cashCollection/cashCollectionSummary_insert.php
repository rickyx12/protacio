<?php
include("../../../myDatabase2.php");
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];

if( isset($_GET['fromOR']) ) {
$fromOR = $_GET['fromOR'];
}else {
$fromOR = "";
}

if( isset($_GET['toOR']) ) {
$toOR = $_GET['toOR'];
}else {
$toOR = "";
}

$ro = new database2();


$ro->coconutDesign();
$ro->coconutFormStart("get","cashCollectionSummary_insert1.php");
$ro->coconutHidden("month",$month);
$ro->coconutHidden("day",$day);
$ro->coconutHidden("year",$year);

echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<Td>Title</tD>";
echo "<tD>";
$ro->coconutTextBox("title","");
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Amount</td>";
echo "<td>";
$ro->coconutTextBox("amount","");
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Type</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("type");
echo "<option value='Cash_Inpatient'>Cash(Inpatient)</option>";
echo "<option value='Hospital Collection'>Hospital Collection</option>";
echo "<option value='Pharmacy Collection'>Pharmacy Collection</option>";
echo "<option value='Disbursement'>Disbursement</option>";
echo "<option value='Disbursement'>PREPARED BY</option>";
echo "<option value='Disbursement'>NAME OF BILLING</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>From OR#</td>";
echo "<td>";
$ro->coconutTextBox_short("fromOR",$fromOR);
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>to OR#</td>";
echo "<td>";
$ro->coconutTextBox_short("toOR",$toOR);
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='http://".$ro->getMyUrl()."/COCONUT/Cashier/cashCollection/addName.php?month=$month&day=$day&year=$year' style='text-decoration:none; color:red;'>[Add Name]</a>";
$ro->coconutFormStop();
echo "<iframe src='http://".$ro->getMyUrl()."/COCONUT/Cashier/cashCollection/cashCollectionDetails.php?month=$month&day=$day&year=$year' width='100%' height='100%'  name='welcome' border=1 frameborder=no scrolling=yes></iframe>";



?>
