<?php
include("../../../myDatabase.php");


$ro = new database();

$ro->coconutDesign();

echo "<form method='get' action='pf_ipd.php' target='_blank' >";
$ro->coconutFormStart("get","pf_ipd.php");
$ro->coconutHidden("show","All");
$ro->coconutBoxStart("500","100");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>".$ro->coconutText("From Date")."</td>";
echo "<td>";
$ro->coconutComboBoxStart_short("fromDate_month");
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
echo " - ";
$ro->coconutComboBoxStart_short("fromDate_day");

for($x=1;$x<32;$x++) {

if($x < 9) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}

$ro->coconutComboBoxStop();
echo " - ";
echo "<input type=text name='fromDate_year' class='shortField' value='".date("Y")."'>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>".$ro->coconutText("To Date")."</td>";
echo "<td>";
$ro->coconutComboBoxStart_short("toDate_month");
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
echo " - ";
$ro->coconutComboBoxStart_short("toDate_day");

for($x=1;$x<32;$x++) {

if($x < 9) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}

$ro->coconutComboBoxStop();
echo " - ";
echo "<input type=text name='toDate_year' class='shortField' value='".date("Y")."'>";
echo "</td>";
echo "</tr>";
echo "</table>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
