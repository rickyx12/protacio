<?php
include("../../../myDatabase.php");

$patientNo = $_GET['patientNo'];
$username = $_GET['username'];
$lastName = $_GET['lastName'];
$firstName = $_GET['firstName'];
$middleName = $_GET['middleName'];
$completeName = $_GET['completeName'];
$Birthdate = $_GET['Birthdate'];
$Age = $_GET['Age'];
$Gender = $_GET['Gender'];
$Senior = $_GET['Senior'];
$Address = $_GET['Address'];
$contactNo = $_GET['contactNo'];
$PHIC = $_GET['PHIC'];
$civilStatus = $_GET['civilStatus'];
$username = $_GET['username'];
$show = $_GET['show'];
$desc = $_GET['desc'];

$ro = new database();

$ro->coconutDesign();

$ro->coconutBoxStart("500","500");
echo "<Br>";
$ro->coconutFormStart("get","editPatientRecord1.php");
echo "<table border=0>";
echo "<tr>";
echo "<td><font class='labelz'>Last Name</font></td>";
echo "<td><input type=text class='txtBox' name='lastName' value='$lastName'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>First Name</font></td>";
echo "<td><input type=text class='txtBox' name='firstName' value='$firstName'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Middle Name</font></td>";
echo "<td><input type=text class='txtBox' name='middleName' value='$middleName'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Middle Name</font></td>";
echo "<td><input type=text class='txtBox' name='completeName' value='$completeName'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Birth Date</font></td>";
echo "<td><input type=text class='txtBox' name='Birthdate' value='$Birthdate'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Age</font></td>";
echo "<td><input type=text class='shortField' name='Age' value='$Age'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Gender</font></td>";
echo "<td><select name='Gender' class='comboBox'>
<option value='$Gender'>$Gender</option>
<option value='male'>Male</option>
<option value='female'>Female</option>
</select></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Senior</font></td>";
echo "<td>
<select name='Senior' class='comboBoxShort'>
<option value='$Senior'>$Senior</option>
<option value='NO'>No</option>
<option value='YES'>Yes</option>
</select>
</td>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='labelz'>Address</font></td>";
echo "<td><textarea class='txtArea' name='Address'>$Address</textarea></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='labelz'>Contact No#</font></td>";
echo "<td><input type=text class='txtBox' name='contactNo' value='$contactNo'></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='labelz'>PhilHealth</font></td>";
echo "<td><select name='PHIC' class='comboBoxShort'>
<option value='$PHIC'>$PHIC</option>
<option value='YES'>Yes</option>
<option value='NO'>No</option>
</select></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='labelz'>Civil Status</font></td>";
echo "<td><select name='civilStatus' class='comboBox'>
<option value='$civilStatus'>$civilStatus</option>
<option value='Single'>Single</option>
<option value='Married'>Married</option>
<option value='Seperated'>Seperated</option>
<option value='Widow'>Widow</option>
</select></td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutHidden("patientNo",$patientNo);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("show",$show);
$ro->coconutHidden("desc",$desc);
$ro->coconutFormStop();
$ro->coconutBoxStop();


?>
