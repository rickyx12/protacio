<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];


$ro = new database2();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />


<?php

$ro->getPatientProfile($registrationNo);

echo "<form method='get' action='addPayment1.php'>";
$ro->coconutHidden("receiptType","");
$ro->coconutHidden("collectionFor","IPD");
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<br>";
echo "<font color=reD>".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()." </font>";
echo "<br><br><br><center><div style='border:1px solid #000000; width:600px; height:389px; border-color:black black black black;'>";
echo "<Br>";
echo "<Table border=0>";
echo "<tr>";
echo "<td><font class='labelz'>Payment For&nbsp;</font></tD>";
echo "<tD>";
echo "<select name='paymentFor' class='comboBox'>";
echo "<option value='HOSPITAL BILL'>HOSPITAL BILL</option>";
echo "<option value='DEPOSIT'>DEPOSIT</option>";
echo "<option value='BALANCE PAID'>BALANCE PAID</option>";
echo "<option value='REFUND'>REFUND</option>";
//$ro->showOption("Category","Category");
echo "</select>";
echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<td><font class='labelz'>Paid Via&nbsp;</font></tD>";
echo "<td><select name='paidVia' class='comboBox'>";
echo "<option value='Cash'>Cash</option>";
echo "<option value='Credit Card'>Credit Card</option>";
echo "<option value='Check'>Check</option>";
$ro->getAllCompany();
echo "</select></tD>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='labelz'>OR#:</font></tD>";
echo "<td><input type=text name='orNo' class='shortField' autocomplete='off'></tD>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='labelz'>Hospital Bill</font></tD>";
echo "<td><input type=text name='amountPaid' value='' class='shortField' autocomplete='off'></tD>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='labelz'>PF</font></tD>";
echo "<td><input type=text name='pf' value='0' class='shortField' autocomplete='off' ></tD>";
echo "</tr>";


echo "<tr>";
echo "<td><font class='labelz'>Discount</font></tD>";
echo "<td><input type=text name='discount' value='".$ro->selectNow("registrationDetails","discount","registrationNo",$registrationNo)."' class='shortField' autocomplete='off' ></tD>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='labelz'>Date</font></tD>";
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
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}


}

$ro->coconutComboBoxStop();

echo "-";

$ro->coconutTextBox_short("year",date("Y"));

echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Credit Card#</td>";
echo "<td>";
$ro->coconutTextBox("creditCardNo","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Shift</td>";
echo "<Td>";
$ro->coconutComboBoxStart_long("shift");
echo "<option></option>";
echo "<option>Morning</option>";
echo "<option>Noon</option>";
echo "<option>Afternoon</option>";
echo "<option>Night</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "</table>";
echo "<br>";
echo "<input type=submit value='Proceed' style='border:1px solid #000; background-color:#3b5998; color:white'>";
echo "</div>";
echo "</form>";
?>
