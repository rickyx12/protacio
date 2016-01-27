<?php
include("../../myDatabase1.php");
$username = $_GET['username'];
$ro = new database1();


$ro->coconutDesign();

echo "<Br><Br><Br><Br>";


$ro->coconutFormStart("get","receiveRequest1.php");
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart("500","83");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Department&nbsp;</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("module");
echo "<option value='LABORATORY'>LABORATORY</option>";
echo "<option value='PHARMACY'>PHARMACY</option>";
echo "<option value='DIALYSIS'>DIALYSIS</option>";
echo "<option value='ER'>ER</option>";
echo "<option value='OR'>OR</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
