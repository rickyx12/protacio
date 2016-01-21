<?php
include("../../../myDatabase1.php");
$username = $_GET['username'];
$hospital = $_GET['hospital'];
$address = $_GET['address'];
$headingNo = $_GET['headingNo'];
$ro = new database1();


$ro->coconutDesign();
$ro->coconutFormStart("get","editHospital1.php");
$ro->coconutHidden("username",$username);
$ro->coconutHidden("headingNo",$headingNo);
echo "<br><Br><br>";
$ro->coconutBoxStart("500","120");
echo "<bR>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Hospital Name</td>";
echo "<td>";
$ro->coconutTextBox("hospital",$hospital);
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Address</td>";
echo "<td>";
$ro->coconutTextBox("address",$address);
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
