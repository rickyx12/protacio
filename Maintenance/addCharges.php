<?php
include("../myDatabase.php");
$module = $_GET['module'];
$username = $_GET['username'];

$ro = new database();
$ro->coconutDesign();

$ro->coconutFormStart("get","addCharges1.php");
$ro->coconutHidden("username",$username);
$ro->coconutHidden("category",$module);
$ro->coconutHidden("services","Examination");
echo "<b>$module</b>";
$ro->coconutBoxStart("500","215");
echo "<Br>";
echo "<Table border=0>";
echo "<tr>";
echo "<td>Description</td>";
echo "<td>";
$ro->coconutTextBox("description","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>OPD Price</td>";
echo "<td>";
$ro->coconutTextBox_short("opdprice","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>IPD Price (Ward)</td>";
echo "<td>";
$ro->coconutTextBox_short("ipdprice","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>IPD Price (Private)</td>";
echo "<td>";
$ro->coconutTextBox_short("privateprice","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Special Rates</td>";
echo "<td>";
$ro->coconutTextBox_short("specialRates","");
echo "</td>";
echo "</tr>";

if( $module == "LABORATORY" ) {
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
echo "<option value='bloodchem'>Blood Chemistry</option>";
echo "<option value='hormones'>Hormones</option>";
echo "<option value='bacteriology'>Bacteriology</option>";
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
