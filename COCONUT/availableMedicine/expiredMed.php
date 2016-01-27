<?php
include("../../myDatabase.php");
$username = $_GET['username'];


$ro = new database();
$ro->coconutDesign();
echo "<br><Br><br><br>";
$ro->coconutBoxStart("600","130");
echo "<center><br>";
$ro->coconutFormStart("get","expiredMed1.php");
echo $ro->coconutText("From Date:&nbsp;");
$ro->coconutComboBoxStart_short("month");
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
echo "&nbsp;";
$ro->coconutComboBoxStart_short("day");
for($x=1;$x<=31;$x++) {
if($x<10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}
$ro->coconutComboBoxStop();
echo "&nbsp;";
$ro->coconutComboBoxStart_short("year");

for($year=date("Y");$year>=2000;$year--) {
echo "<option>$year</option>";
}

$ro->coconutComboBoxStop();
echo "<Br><br>";

echo $ro->coconutText("&nbsp;&nbsp;To Date:&nbsp;");
$ro->coconutComboBoxStart_short("month1");
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
echo "&nbsp;";
$ro->coconutComboBoxStart_short("day1");
for($x=1;$x<=31;$x++) {
if($x<10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}
$ro->coconutComboBoxStop();
echo "&nbsp;";
$ro->coconutComboBoxStart_short("year1");

for($year=date("Y");$year>=2000;$year--) {
echo "<option>$year</option>";
}

$ro->coconutComboBoxStop();

echo "<br><br>";
$ro->coconutButton("Proceed");
$ro->coconutHidden("username",$username);
$ro->coconutFormStop();
$ro->coconutBoxStop();

?>
