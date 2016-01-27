<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$requestNo = $_GET['requestNo'];
$department = $_GET['department'];


$ro = new database();


echo "
<style type='text/css'>
a {
text-decoration:none;
color:white;
}

#rowz:hover {
background-color:black;
}
body {
background-color:#3b5998;
}
</style>

";
echo "<body>";

echo "<table border=0>";
echo "<tr>";



echo "<td id='rowz'>&nbsp;<img src='http://".$ro->getMyUrl()."/COCONUT/myImages/19.gif'><a href='http://".$ro->getMyUrl()."/COCONUT/availableMedicine/medicineRequest.php?branch=&inventoryType=medicine&username=$username&requestingDepartment=$department&requestNo=$requestNo' target='selectedFrame'>Medicine</a>&nbsp;</td>";

echo "<td id='rowz'>&nbsp;<img src='http://".$ro->getMyUrl()."/COCONUT/myImages/19.gif'><a href='http://".$ro->getMyUrl()."/COCONUT/myImages/19.gif'><a href='http://".$ro->getMyUrl()."/COCONUT/availableMedicine/medicineRequest.php?branch=&inventoryType=supplies&username=$username&requestingDepartment=$department&requestNo=$requestNo' target='selectedFrame'>Supplies</a>&nbsp;</td>";



echo "</tr>";
echo "</table>";
echo "</body>";
?>
