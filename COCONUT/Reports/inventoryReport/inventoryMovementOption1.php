<?php
include("../../../myDatabase2.php");
$menu = $_GET['menu'];
$stockCardNo = $_GET['stockCardNo'];
$movementNo = $_GET['movementNo'];
$inventoryType = $_GET['inventoryType'];
$medType = $_GET['medType'];
$control = $_GET['control'];
$username = $_GET['username'];
$year = $_GET['year'];

$ro = new database2();
$ro->coconutDesign();


echo "<br><br><br>";
$ro->coconutFormStart("get","http://".$ro->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovement_insert.php");
$ro->coconutHidden("type",$inventoryType);
$ro->coconutHidden("medType",$medType);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("year",$year);
if( $menu == "firstThreePurchases" ) {
$ro->coconutHidden("menu","firstThreePurchases");
$ro->coconutHidden("stockCardNo",$stockCardNo);
$ro->coconutHidden("movementNo",$movementNo);
$ro->coconutHidden("control",$control);
$ro->coconutBoxStart("500","100");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td align='center'><font size=3 color=red>Ending Inventory (Mar 31, 2015)</font></td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
$ro->coconutTextBox("endingInventory1",$ro->selectNow("inventoryMovement","endingInventory","movementNo",$movementNo));
echo "</td>";
echo "</tr>";

echo "</table>";
echo "<br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();


}else if( $menu == "secondThreePurchases" ) {
$ro->coconutHidden("menu","secondThreePurchases");
$ro->coconutHidden("stockCardNo",$stockCardNo);
$ro->coconutHidden("movementNo",$movementNo);
$ro->coconutHidden("control",$control);
$ro->coconutBoxStart("500","100");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td align='center'><font size=3 color=red>Ending Inventory (Jun 30, 2015)</font></td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
$ro->coconutTextBox("endingInventory2",$ro->selectNow("inventoryMovement","endingInventory1","movementNo",$movementNo));
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();


}else if( $menu == "thirdThreePurchases" ) {
$ro->coconutHidden("menu","thirdThreePurchases");
$ro->coconutHidden("stockCardNo",$stockCardNo);
$ro->coconutHidden("movementNo",$movementNo);
$ro->coconutHidden("control",$control);
$ro->coconutBoxStart("500","100");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td align='center'><font size=3 color=red>Ending Inventory (Sep 30, 2015)</font></td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
$ro->coconutTextBox("endingInventory3",$ro->selectNow("inventoryMovement","endingInventory2","movementNo",$movementNo));
echo "</td>";
echo "</tr>";

echo "</table>";
echo "<br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();


}else if( $menu == "fourthThreePurchases" ) {
$ro->coconutHidden("menu","fourthThreePurchases");
$ro->coconutHidden("stockCardNo",$stockCardNo);
$ro->coconutHidden("movementNo",$movementNo);
$ro->coconutHidden("control",$control);
$ro->coconutBoxStart("500","100");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td align='center'><font size=3 color=red>Ending Inventory (Dec 31, 2015)</font></td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
$ro->coconutTextBox("endingInventory4",$ro->selectNow("inventoryMovement","endingInventory3","movementNo",$movementNo));
echo "</td>";
echo "</tr>";

echo "</table>";
echo "<br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
}else if( $menu == "medicineType" ) {
$ro->coconutHidden("menu","medicineType");
$ro->coconutHidden("stockCardNo",$stockCardNo);
$ro->coconutHidden("movementNo",$movementNo);
$ro->coconutHidden("control",$control);
$ro->coconutBoxStart("500","80");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Type</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("medicineType");
echo "<option value='".$ro->selectNow("inventoryMovement","medicineType","movementNo",$movementNo)."'></option>";
echo "<option value='ORAL'>ORAL</option>";
echo "<option value='AMPULE'>AMPULE</option>";
echo "<option value='IV FLUID'>IV FLUID</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
}else { }
$ro->coconutFormStop();


?>
