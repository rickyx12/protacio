<?php
include("../../myDatabase.php");
$username = $_GET['username'];

$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />
<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS1.css" />


<?php

echo "<Br>";
echo "<form method='get' action='addRoom1.php'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<br><center><div style='border:1px solid #000000; width:600px; height:185px; border-color:black black black black;'>";
echo "<br>";
echo "<Table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td><font class='labelz'>Room Name:&nbsp;</font></td>";
echo "<td><input type=text name='description' class='txtBox'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Type:&nbsp;</font></td>";
echo "<td>";
echo "<select name='type' class='comboBox'>";
echo "<option value='WARD'>WARD</option>";
echo "<option value='SOLOWARD'>SOLOWARD</option>";
echo "<option value='PRIVATE'>PRIVATE</option>";
echo "<option value='SEMIPRIVATE'>SEMIPRIVATE</option>";
echo "<option value='OR'>OR</option>";
echo "</select>";
echo "<td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Rate Per Day:&nbsp;</font></td>";
echo "<td><input type=text name='rate' class='shortField'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Branch</font></td>";
echo "<td>";
echo "<select name='branch' class='comboBox'>";
$ro->showOption("branch","branch");
echo "</select>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>".$ro->coconutText("Floor")."</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("floor");
$ro->showOption("floor","description");
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
echo "<input type=submit value='Proceed' class='coconutButton'>";
echo "</div>";
echo "</form>";

?>
