<?php
include("../../myDatabase2.php");

$ro = new database2();
$ro->coconutDesign();

echo "<br><br><Br><br>";
$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/COCONUT/Company/getRefNo1.php");
$ro->coconutBoxStart("500","80");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Ref#</td>";
echo "<td>";
$ro->coconutTextBox("refNo","");
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();


?>
