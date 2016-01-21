<?php
include("../../../myDatabase.php");
$chargesCode = $_GET['chargesCode'];
$description = $_GET['description'];
$service = $_GET['service'];
$category = $_GET['category'];
$opd = $_GET['opd'];
$ward = $_GET['ward'];
$soloward = $_GET['soloward'];
$semiprivate = $_GET['semiprivate'];
$private = $_GET['private'];
$hmo = $_GET['hmo'];
$unitCost = $_GET['unitCost'];
$specialRates = $_GET['specialRates'];

$ro = new database();
$ro->coconutDesign();

$ro->coconutFormStart("get","editCharges1.php");
$ro->coconutHidden("chargesCode",$chargesCode);
$ro->coconutBoxStart("500","200");
echo "<Br>";
echo "<Table border=0>";
echo "<tr>";
echo "<td>Description</td>";
echo "<td>";
$ro->coconutTextBox("description",$description);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>OPD Price</td>";
echo "<td>";
$ro->coconutTextBox_short("opdprice",$opd);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>IPD Price (Ward)</td>";
echo "<td>";
$ro->coconutTextBox_short("ipdprice",$ward);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>IPD Price (Private)</td>";
echo "<td>";
$ro->coconutTextBox_short("privateprice",$private);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Special Rates</td>";
echo "<td>";
$ro->coconutTextBox_short("specialRates",$specialRates);
echo "</td>";
echo "</tr>";

if( $category == "LABORATORY" ) {
echo "<Tr>";
echo "<Td>Category</tD>";
echo "<td>";
$ro->coconutComboBoxStart_long("subCategory");
echo "<option value=''></option>";
echo "<option value='hematology'>Hematology</option>";
echo "<option value='clinchem'>Clinical Chemistry</option>";
echo "<option value='urinalysis'>Urinalysis</option>";
echo "<option value='serology'>Serology</option>";
echo "<option value='fecalysis'>Fecalysis</option>";
echo "</td>";
$ro->coconutComboBoxStop();
echo "</tr>";
}else {
$ro->coconutHidden("subCategory","");
}
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();



?>
