<?php
include("../../myDatabase1.php");


$ro = new database1();

$ro->coconutDesign();


echo "<Br><br><Br><Br><BR>";

$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/availableMedicine/medicineRequest.php");
$ro->coconutHidden("branch","Pagadian");
$ro->coconutHidden("username","");
$ro->coconutBoxStart("500","150");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Department&nbsp;</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("requestingDepartment");
echo "<option value='LABORATORY'>LABORATORY</option>";
echo "<option value='PHARMACY'>PHARMACY</option>";
echo "<option value='DIALYSIS'>DIALYSIS</option>";
echo "<option value='ER'>ER</option>";
echo "<option value='3A'>3A</option>";
echo "<option value='3B'>3B</option>";
echo "<option value='ICU'>ICU</option>";
echo "<option value='DR'>DR</option>";
echo "<option value='OR'>OR</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Request&nbsp;</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("inventoryType");
echo "<option value='medicine'>Medicine</option>";
echo "<option value='supplies'>Supplies</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Request By:</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("username");
$ro->showOption("registeredUser","completeName");
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
