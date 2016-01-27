<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$itemNo = $_GET['itemNo'];
$countz = count($itemNo);
$ro = new database2();
$ro->coconutDesign();
$total = 0;
$discount = 0;
echo "<center>";
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/patientProfile/individualPayment/paidItems.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("username",$username);
$ro->coconutTableStart();
$ro->coconutTableRowStart();
$ro->coconutTableHeader("");
$ro->coconutTableHeader("Description");
$ro->coconutTableHeader("QTY;");
$ro->coconutTableHeader("Price");
$ro->coconutTableHeader("Discount");
$ro->coconutTableHeader("Total");
$ro->coconutTableRowStop();
for($x=0;$x<$countz;$x++) {
$ro->coconutTableRowStart();

$ro->coconutTableData("<input type='checkbox' name='itemNo[]' value='".$itemNo[$x]."' checked>");

$ro->coconutTableData($ro->doubleSelectNow("patientCharges","description","itemNo",$itemNo[$x],"registrationNo",$registrationNo));

$ro->coconutTableData($ro->doubleSelectNow("patientCharges","quantity","itemNo",$itemNo[$x],"registrationNo",$registrationNo));

$ro->coconutTableData($ro->doubleSelectNow("patientCharges","sellingPrice","itemNo",$itemNo[$x],"registrationNo",$registrationNo));

$ro->coconutTableData($ro->doubleSelectNow("patientCharges","discount","itemNo",$itemNo[$x],"registrationNo",$registrationNo));

$ro->coconutTableData($ro->doubleSelectNow("patientCharges","cashUnpaid","itemNo",$itemNo[$x],"registrationNo",$registrationNo));

$discount += $ro->doubleSelectNow("patientCharges","discount","itemNo",$itemNo[$x],"registrationNo",$registrationNo);

$total += $ro->doubleSelectNow("patientCharges","cashUnpaid","itemNo",$itemNo[$x],"registrationNo",$registrationNo);

$ro->coconutTableRowStop();
}


$ro->coconutTableRowStart();
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;<b>PHARMACY</b>");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;<font color=red>".$ro->sumFromPharmacy($registrationNo)."</font>");
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;<b>OTHERS</b>");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;<font color=red>".$ro->sumFromNotPharmacy($registrationNo)."</font>");
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;<b>TOTAL</b>");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;");
$ro->coconutTableData("&nbsp;<font color=blue>".$discount."</font>");
$ro->coconutTableData("&nbsp;<font color=red>".$total."</font>");
$ro->coconutTableRowStop();
$ro->coconutTableStop();
echo "<Br>";
 echo "OR No:&nbsp;"; $ro->coconutTextBox("orNO","");
echo "<Br><br>";
echo "Shift:&nbsp;";
$ro->coconutComboBoxStart_long("shift");
//echo "<option value=''></option>";
echo "<option value='3'>4:30PM - 8:30AM</option>";
echo "<option value='1'>8:30AM - 12:30PM</option>";
echo "<option value='2'>12:30PM - 4:30PM</option>";
$ro->coconutComboBoxStop();
echo "<Br><br>";
echo "Date Paid:";
$ro->coconutComboBoxStart_short("month");
echo "<option value='".date("m")."'>".date("M")."</option>";
echo "<option value='01'>Jan</option>";
echo "<option value='02'>Feb</option>";
echo "<option value='03'>Mar</option>";
echo "<option value='04'>Apr</option>";
echo "<option value='05'>May</option>";
echo "<option value='06'>Jun</option>";
echo "<option value='07'>Jul</option>";
echo "<option value='08'>Aug</option>";
echo "<option value='09'>Sep</option>";
echo "<option value='10'>Oct</option>";
echo "<option value='11'>Nov</option>";
echo "<option value='12'>Dec</option>";
$ro->coconutComboBoxStop();
echo "-";
$ro->coconutComboBoxStart_short("day");
echo "<option value='".date("d")."'>".date("d")."</option>";
for( $x=1;$x<32;$x++ ) {

if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}
$ro->coconutComboBoxStop();

echo "-";

$ro->coconutTextBox_short("year",date("Y"));

echo "<Br><br>";
$ro->coconutButton("&nbsp;&nbsp;Paid&nbsp;&nbsp;");
echo "</center>";
$ro->coconutFormStop();

?>
