<?php
include("../../myDatabase.php");
$employeeID = $_POST['employeeID'];
$completeName = $_POST['completeName'];
$position  = $_POST['position'];
$department = $_POST['department'];
$status = $_POST['status'];
$salaryBasic = $_POST['salaryBasic'];
$age = $_POST['age'];
$birthdate = $_POST['birthdate'];
$address = $_POST['address'];
$username = $_POST['username'];
$ro = new database();
$ro->coconutDesign();

echo "<br><br><br>";
echo "<center><font color=red>".$completeName."</font></center>";
$ro->coconutFormStart("post","/COCONUT/payroll/editInfoNow.php");
$ro->coconutHidden("employeeID",$employeeID);
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart("500","283");
echo "<br>";
echo "<table border=0>";
echo "<Tr>";
echo "<td>Position&nbsp;</td>";
echo "<td>";
$ro->coconutTextBox("position",$position);
echo "</td>";
echo "</tr>";


echo "<Tr>";
echo "<td>Salary/Rate&nbsp;</td>";
echo "<td>";
$ro->coconutTextBox("salaryBasic",$salaryBasic);
echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<td>Department&nbsp;</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("department");
echo "<option value='$department'>$department</option>";
echo "<option value='LABORATORY'>LABORATORY</option>";
echo "<option value='RADIOLOGY'>RADIOLOGY</option>";
echo "<option value='PHARMACY'>PHARMACY</option>";
echo "<option value='NURSING'>NURSING</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<td>Status&nbsp;</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("status");
$ro->showOption_group("contribution_withholdingTax","status");
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";


echo "<Tr>";
echo "<td>Age&nbsp;</td>";
echo "<td>";
$ro->coconutTextBox_short("age",$age);
echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<td>BirthDate&nbsp;</td>";
echo "<td>";
$ro->coconutTextBox_short("birthdate",$birthdate);
echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<td>Address&nbsp;</td>";
echo "<td>";
$ro->coconutTextBox("address",$address);
echo "</td>";
echo "</tr>";

echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
