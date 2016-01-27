<?php
include("../../myDatabase1.php");
$description = $_GET['description'];
$inventoryCode = $_GET['inventoryCode'];

$ro = new database1();

$ro->coconutDesign();

echo "<Br><Br><Br>";
$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/inventory/viewDispensing.php");
$ro->coconutHidden("description",$description);
$ro->coconutHidden("inventoryCode",$inventoryCode);
echo "<center><font color=red>".$description."</font>";
$ro->coconutBoxStart("500","119");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<Td>Month&nbsp;</tD>";
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
echo "&nbsp;";
$ro->coconutTextBox_short("year",date("Y"));
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
