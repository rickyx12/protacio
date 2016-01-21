<?php
include("../../../myDatabase1.php");

$ro = new database1();
$ro->coconutDesign();
echo "<br><br><br><br><Br>";
$ro->coconutFormStart("get","showTrialBalance.php");
$ro->coconutBoxStart("400","80");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Month&nbsp;</tD>";
echo "<td>";
$ro->coconutComboBoxStart_short("month");
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
echo "&nbsp;";
$ro->coconutComboBoxStart_short("year");
for($x=date("Y");$x>=1990;$x--) {
echo "<option value='$x'>$x</option>";
}
$ro->coconutComboBoxStop();
echo "</tD>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
