<?php
include("../../../myDatabase.php");
$itemNo = $_GET['itemNo'];
$username = $_GET['username'];

$show = $_GET['show'];
$desc = $_GET['desc'];

$ro = new database();

$ro->getPatientChargesToEdit($itemNo);
?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php
echo "
<style type='text/css'>
.charges {
font-size:13px;
}

.txtBox {
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 320px;
	padding:4px 4px 4px 5px;
}

.shortField {
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 120px;
	padding:4px 4px 4px 5px;
}

</style>


";

echo "<br><br>";
echo "<center>
<font color=red size=2>CHARITY MODE</font>
<Br>
<div style='border:1px solid #000000; width:500px; height:auto;	'>";
echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/patientProfile/charity/editChargesNow.php'>
<br>
<input type=hidden name='itemNo' value='".$ro->patientCharges_itemNo()."'>
<input type=hidden name='registrationNo' value='".$ro->patientCharges_registrationNo()."'>
<input type=hidden name='show' value='$show'>
<input type=hidden name='desc' value='$desc'>
<table border=0 cellpadding=0 cellspacing=0>
<tr>
<td><font class='charges'>Description:</font></td>";

echo "<td><input type=text class='txtBox' name='description' value='".$ro->patientCharges_Description()."' readonly></td>";

echo "</tr>";




if( $ro->patientCharges_title() == "MEDICINE" || $ro->patientCharges_title() == "SUPPLIES" ) {
if( $ro->selectNow("registeredUser","module","username",$username) == "PHILHEALTH" || $ro->selectNow("registeredUser","module","username",$username) == "HMO" || $ro->selectNow("registeredUser","module","username",$username) == "PHARMACY" || $ro->selectNow("registeredUser","module","username",$username) == "CASHIER" || $ro->selectNow("registeredUser","module","username",$username) == "BILLING" ) {
echo "
<tr>";


echo "<td><font class='charges'>Selling Price:</font></td>";
echo "<td><input type=text class='shortField' autocomplete='off' name='sellingPrice' value='".$ro->patientCharges_sellingPrice()."'></td>";
echo "</tr>";


}else { }
}else {
echo "
<tr>
<td><font class='charges'>Selling Price:</font></td>
<td><input type=text class='shortField' autocomplete='off' name='sellingPrice' value='".$ro->patientCharges_sellingPrice()."'></td>
</tr>
";
 }

echo "
<tr>
<td><font class='charges'>Quantity:</font></td>";
$deptStatus = preg_split ("/\_/", $ro->getDepartmentStatus($itemNo)); 
if($deptStatus[0] == "dispensedBy") {
echo "<td><input type=text class='shortField' name='quantity' value='".$ro->patientCharges_quantity()."' readonly></td>";
}else {
echo "<td><input type=text class='shortField' name='quantity' value='".$ro->patientCharges_quantity()."'></td>";
}




if( $ro->patientCharges_title() == "MEDICINE" || $ro->patientCharges_title() == "SUPPLIES" ) {

if( $ro->selectNow("registeredUser","module","username",$username) == "PHILHEALTH" || $ro->selectNow("registeredUser","module","username",$username) == "HMO" || $ro->selectNow("registeredUser","module","username",$username) == "PHARMACY" || $ro->selectNow("registeredUser","module","username",$username) == "CASHIER" || $ro->selectNow("registeredUser","module","username",$username) == "BILLING" ) {
echo "
<tr>
<td><font class='charges'>Total:</font></td>
<td><input type=text class='shortField' name='total' value='".$ro->patientCharges_total()."' readonly></td>
</tr>";
}else {

}
}else {
echo "
<tr>
<td><font class='charges'>Total:</font></td>
<td><input type=text class='shortField' name='total' value='".$ro->patientCharges_total()."' readonly></td>
</tr>";

}





echo "
</tr>
<tr>
<td><font class='charges'>Discount:</font></td>
<td><input type=text class='shortField' name='discount' value='".$ro->patientCharges_discount()."'></td>
</tr>

<tr>
<td><font class='charges'>Time Charge:</font></td>
<td><input type=text class='shortField' name='timeCharge' value='".$ro->patientCharges_timeCharge()."'></td>
</tr>
<tr>
<td><font class='charges'>Date Charge:</font></td>
<td><input type=text class='shortField' name='dateCharge' value='".$ro->patientCharges_dateCharge()."'></td>
</tr>
<tr>
<td><font class='charges'>Charge By:</font></td>
<td><input type=text class='shortField' name='chargeBy' value='".$ro->patientCharges_chargeBy()."' readonly></td>
</tr>
<tr>
<td><font class='charges'>Paid Via:</font></td>
<td>
<select name='paidVia' class='shortField'>";
if($ro->patientCharges_paidVia() == "Cash") {
echo "<option value='".$ro->patientCharges_paidVia()."'>".$ro->patientCharges_paidVia()."</option>";
echo "<option value='Cash'>Cash</option>";
echo "<option value='Company'>Company</option>";
}else {
echo "<option value='".$ro->patientCharges_paidVia()."'>".$ro->patientCharges_paidVia()."</option>";
echo "<option value='Cash'>Cash</option>";
echo "<option value='Cash'>Company</option>";
}
echo "</select>
</td>
</tr>
<tr>
<td><font class='charges'>Title:</font></td>
<td><select name='title' class='txtBox'>"; 
if($ro->patientCharges_title() == "PROFESSIONAL FEE") {
echo "<option value='".$ro->patientCharges_title()."'>".$ro->patientCharges_title()."</option>";
}else {
echo "<option value='".$ro->patientCharges_title()."'>".$ro->patientCharges_title()."</option>";
$ro->getCategory();
}
echo "</select></td>
</tr>
<td><font class='charges'>Service:</font></td>
<td><select name='service' class='txtBox'>"; 
echo "<option value='".$ro->patientCharges_service()."'>".$ro->patientCharges_service()."</option>";
if($ro->patientCharges_title() == "PROFESSIONAL FEE") {
$ro->showOption_group("DoctorService","serviceName");
}else {
$ro->showOption_group("Services","Service");
}
echo "</select></td>
</tr>";



if( $ro->patientCharges_title() == "MEDICINE" || $ro->patientCharges_title() == "SUPPLIES" ) {

if( $ro->selectNow("registeredUser","module","username",$username) == "PHILHEALTH" || $ro->selectNow("registeredUser","module","username",$username) == "HMO" || $ro->selectNow("registeredUser","module","username",$username) == "PHARMACY" || $ro->selectNow("registeredUser","module","username",$username) == "CASHIER" || $ro->selectNow("registeredUser","module","username",$username) == "BILLING" ) {
echo "
<tr>
<td><font class='charges'>Cash (Unpaid)</font></td>
<td><input type=text name='cashCovered' autocomplete='off' class='shortField' value=".$ro->patientCharges_cashUnpaid()."></td>
</tr>
<tr>
<td><font class='charges'>Company</font></td>
<td><input type=text name='companyCovered' autocomplete='off' class='shortField' value='".$ro->patientCharges_company()."'></td>
</tr>
<tr>
<td><font class='charges'>PhilHealth</font></td>
<td><input type=text name='phicCovered' autocomplete='off' class='shortField' value='".$ro->patientCharges_phicCovered()."'></td>
</tr>
";
}else { }
}else {
echo "
<tr>
<td><font class='charges'>Cash (Unpaid)</font></td>
<td><input type=text name='cashCovered' autocomplete='off' class='shortField' value=".$ro->patientCharges_cashUnpaid()."></td>
</tr>
<tr>
<td><font class='charges'>Company</font></td>
<td><input type=text name='companyCovered' autocomplete='off' class='shortField' value='".$ro->patientCharges_company()."'></td>
</tr>
<tr>
<td><font class='charges'>PhilHealth</font></td>
<td><input type=text name='phicCovered' autocomplete='off' class='shortField' value='".$ro->patientCharges_phicCovered()."'></td>
</tr>
";

}





echo "
<tr>
<td><font class='charges'>Branch</font></td>
<td><select name='branch' class='txtBox'>
<option value='".$ro->patientCharges_branch()."'>".$ro->patientCharges_branch()."</option>
";
$ro->showOption("branch","branch");
echo "</select></td>
</tr>
";

if($ro->patientCharges_status() == "PAID") {
$datePaid = preg_split ("/\_/",$ro->patientCharges_datePaid()); 
$timePaid = preg_split ("/\:/",$ro->patientCharges_timePaid()); 
echo "
<tr>
<td><font class='charges' color=red>Date Paid</font></td>
<td><select name='datePaid_month' class='comboBoxShort'>";
echo "<option value='".$datePaid[0]."'>".$datePaid[0]."</option>";
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
echo "</select>&nbsp;";
echo "<select name='datePaid_day' class='comboBoxShort'>";
echo "<option value='".$datePaid[1]."'>".$datePaid[1]."</option>";
for($x=1;$x<32;$x++) {

if($x<10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}
echo "</select>&nbsp;";
echo "<input type=text name='datePaid_year' class='shortField' value='".$datePaid[2]."'>";
echo "</td></tr>";
echo "<tr>";
echo "<td><font class='charges' color=red>Time Paid (H:M:S)</font></td>";
echo "<td>";
echo "<select name='timePaid_hour' class='comboBoxShort'>";
echo "<option value='".$timePaid[0]."'>".$timePaid[0]."</option>";
for($x=1;$x<24;$x++) {

if($x < 10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}
echo "</select>&nbsp;";
echo "<select name='timePaid_minutes' class='comboBoxShort'>";
echo "<option value='".$timePaid[1]."'>".$timePaid[1]."</option>";
for($x=1;$x<60;$x++) {

if($x < 10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}
echo "</select>&nbsp;";
echo "<select name='timePaid_seconds' class='comboBoxShort'>";
echo "<option value='".$timePaid[2]."'>".$timePaid[2]."</option>";
for($x=1;$x<24;$x++) {

if($x < 10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}
echo "</select>";
echo "<td>";
echo "</tr>";
echo "
<tr>
<td><font class='charges' color=red>Paid By</font></td>
<td><input type=text name='paidBy' class='txtBox' value='".$ro->patientCharges_paidBy()."'></td>
</tr>";

}else {
echo "<input type=hidden name='datePaid_month' value=''>";
echo "<input type=hidden name='datePaid_day' value=''>";
echo "<input type=hidden name='datePaid_year' value=''>";
echo "<input type=hidden name='timePaid_hour' value=''>";
echo "<input type=hidden name='timePaid_minutes' value=''>";
echo "<input type=hidden name='timePaid_seconds' value=''>";
echo "<input type=hidden name='paidBy' value=''>";
}

echo "</table>
<Br><Br>
<input type=submit value='Proceed' style='border:1px solid #ff0000; background-color:transparent;'>
<input type=hidden name='username' value='$username'>
</form>
";
echo "</div></center>";



?>




