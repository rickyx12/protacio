<?php
include("../../../myDatabase2.php");
$registrationNo = $_POST['registrationNo'];
$username = $_POST['username'];

$ro = new database2();
$ro->getPatientProfile($registrationNo);
$ro->coconutDesign();


$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/patientProfile/Payments/companyPayment1.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("postBy",$username);
echo "<Br><br><br>";
$ro->coconutBoxStart("500","270");
echo "<br>";
echo "<table>";
echo "<tr>";
echo "<td>Ref#</td>";
echo "<td>";
$ro->coconutTextBox("refNo","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Check#</td>";
echo "<td>";
$ro->coconutTextBox("checkNo","");
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td>Amount</td>";
echo "<td>";
$ro->coconutTextBox_short("amount","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Tax</td>";
echo "<td>";
$ro->coconutTextBox_short("tax","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Discount</td>";
echo "<td>";
$ro->coconutTextBox_short("discount","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Company</td>";
echo "<td>";
$ro->coconutTextBox_readonly("company",$ro->getRegistrationDetails_company());
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Date</td>";
echo "<td>";
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
echo "<option value='0$x'>$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}

$ro->coconutComboBoxStop();

echo "-";

$ro->coconutTextBox_short("year",date("Y"));

echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
