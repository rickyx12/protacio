<?php
include("../../myDatabase2.php");
$username = $_POST['username'];
$accountNo = $_POST['accountNo'];
$accountName = $_POST['accountName'];
$refNo = $_POST['refNo'];
$bold = $_POST['bold'];
$ro = new database2();
$ro->coconutDesign();


echo "<Br><br><br>";
$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/accounting/editAccountTitle1.php");
$ro->coconutHidden("username",$username);
$ro->coconutHidden("refNo",$refNo);
$ro->coconutBoxStart("500","140");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Account No.</td>";
echo "<td>";
$ro->coconutTextBox("accountNo",$accountNo);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Account Name.</td>";
echo "<td>";
$ro->coconutTextBox("accountName",$accountName);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Bold?.</td>";
echo "<td>";
$ro->coconutComboBoxStart_short("bold");
echo "<option value='$bold'>$bold</option>";
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
