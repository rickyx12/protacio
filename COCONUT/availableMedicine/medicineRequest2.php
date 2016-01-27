<?php
include("../../myDatabase.php");
$description = $_GET['description'];
$branch = $_GET['branch'];
$requestTo_department = $_GET['requestTo_department'];
$requestingDepartment = $_GET['requestingDepartment'];
$inventoryCode = $_GET['inventoryCode'];
$stockCardNo = $_GET['stockCardNo'];
$username = $_GET['username'];
$requestNo = $_GET['requestNo'];

$ro = new database();
?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php

echo "<br><center><div style='border:1px solid #000000; width:600px; height:180px; border-color:black black black black;'>";
echo "<form method='post' action='medicineRequest_insert.php'>";
echo "<br>";
echo "<table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td><font class='labelz'>Description&nbsp;&nbsp;</font></td>";
echo "<td><input type=text name='description' value='$description' class='txtBox' readonly></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Request To&nbsp;&nbsp;</font></td>";
echo "<td><input type=text name='x' value='$requestTo_department' class='txtBox' readonly></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Quantity&nbsp;&nbsp;</font></td>";
echo "<td><input type=text name='quantity' value='' class='shortField'></td>";
echo "</tr>";
echo "</table>";
echo "<br>";
echo "<input type=submit value='Proceed'>";
echo "</div>";
echo "<input type=hidden name='requestTo_department' value='$requestTo_department'>";
echo "<input type=hidden name='requestingDepartment' value='$requestingDepartment'>";
echo "<input type=hidden name='inventoryCode' value='$inventoryCode'>";
echo "<input type=hidden name='stockCardNo' value='$stockCardNo'>";
echo "<input type=hidden name='branch' value='$branch'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<input type=hidden name='status' value='requesting'>";
echo "<input type=hidden name='requestNo' value='$requestNo'>";
echo "</form>";
?>



