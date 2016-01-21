<?php
include("../../myDatabase2.php");
$username = $_POST['username'];

$ro = new database2();
$ro->coconutDesign();


echo "<Br><br><br>";
$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/accounting/addAccountTitle1.php");
$ro->coconutHidden("username",$username);
$ro->coconutBoxStart("500","140");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Account No.</td>";
echo "<td>";
$ro->coconutTextBox("accountNo","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Account Name.</td>";
echo "<td>";
$ro->coconutTextBox("accountName","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Bold?.</td>";
echo "<td>";
$ro->coconutComboBoxStart_short("bold");
echo "<option value='no'>no</option>";
echo "<option value='yes'>yes</option>";
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";


echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
