<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];

$ro = new database2();
$ro->getPatientProfile($registrationNo);
$ro->coconutDesign();

echo "<Br><Br><Br>";
$ro->coconutFormStart("get","reconcileDetails_insert.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutBoxStart("500","200");
echo "<Br>";
echo "<table border=0>";
echo "<Tr>";
echo "<Td>Patient&nbsp;</tD>";
echo "<td>";
$ro->coconutTextBox_readonly("patient",$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName());
echo "</td>";
echo "</tr>";


echo "<Tr>";
echo "<Td>Ref No#:&nbsp;</tD>";
echo "<td>";
$ro->coconutTextBox("refno","");
echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<Td>Amount&nbsp;</tD>";
echo "<td>";
$ro->coconutTextBox("amount","");
echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<tD>Date&nbsp;</td>";
echo "<tD>";
$ro->coconutComboBoxStart_short("month");
echo "<option value='".date("M")."'>".date("M")."</option>";
echo "<option value='Jan'>Jan</option>";
echo "<option value='Feb'>Feb</option>";
echo "<option value='Mar'>Mar</option>";
echo "<option value='Apr'>Apr</option>";
echo "<option value='May'>May</option>";
echo "<option value='Jun'>Jun</option>";
echo "<option value='Jul'>Jul</option>";
echo "<option value='Aug'>Aug</option>";
echo "<option value='Sep'>Sep</option>";
echo "<option value='Oct'>Oct</option>";
echo "<option value='Nov'>Nov</option>";
echo "<option value='Dec'>Dec</option>";
$ro->coconutComboBoxStop();
echo "-";
$ro->coconutComboBoxStart_short("day");
echo "<option value=".date("d").">".date("d")."</option>";
for( $x=1;$x<32;$x++ ) {

if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else { echo "<option value='$x'>$x</option>";  }

}

$ro->coconutComboBoxStop();

echo "-";

$ro->coconutTextBox_short("year",date("Y"));

echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<Td>remarks&nbsp;</tD>";
echo "<td>";
$ro->coconutTextBox("remarks","");
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<Br><Br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
