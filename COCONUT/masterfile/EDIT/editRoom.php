<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$roomNo = $_GET['roomNo'];
$description = $_GET['description'];
$type = $_GET['type'];
$rate = $_GET['rate'];
$username = $_GET['username'];
$show = $_GET['show'];
$desc = $_GET['desc'];
$floor = $_GET['floor'];
$status = $_GET['status'];
$branch = $_GET['branch'];

$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />
<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS1.css" />


<?php

$myRoom = preg_split ("/\_/", $description); 

echo "<Br>";
echo "<form method='get' action='editRoom1.php'>";
echo "<input type=hidden name='roomNo' value='$roomNo'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<input type=hidden name='show' value='$show'>";
echo "<input type=hidden name='desc' value='$desc'>";
echo "<br><center><div style='border:1px solid #000000; width:600px; height:207px; border-color:black black black black;'>";
echo "<br>";
echo "<Table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td><font class='labelz'>Room Name:&nbsp;</font></td>";
echo "<td><input type=text name='description'  value='".$myRoom[0]."' class='txtBox'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Type:&nbsp;</font></td>";
echo "<td>";
echo "<select name='type' class='comboBox'>";
echo "<option value='$type'>$type</option>";
echo "<option value='WARD'>WARD</option>";
echo "<option value='SOLOWARD'>SOLOWARD</option>";
echo "<option value='PRIVATE'>PRIVATE</option>";
echo "<option value='SEMIPRIVATE'>SEMIPRIVATE</option>";
echo "<option value='SUITE'>SUITE</option>";
echo "</select>";
echo "<td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Rate Per Day:&nbsp;</font></td>";
echo "<td><input type=text name='rate' value='$rate' class='shortField'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Branch</font></td>";
echo "<td>";
echo "<select name='branch' class='comboBox'>";
echo "<option value='$branch'>$branch</option>";
$ro->showOption("branch","branch");
echo "</select>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='labelz'>Status</font></td>";
echo "<td>";
echo "<select name='status' class='comboBox'>";
echo "<option value='$tatus'>$status</option>";
echo "<option value='Occupied'>Occupied</option>";
echo "<option value='Vacant'>Vacant</option>";
echo "</select>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>".$ro->coconutText("Floor")."</td>";
echo "<Td>";
$ro->coconutComboBoxStart_long("floor");
echo "<option value='$floor'>$floor</option>";
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
