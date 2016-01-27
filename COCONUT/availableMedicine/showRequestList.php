<?php
include("../../myDatabase.php");
$requestingDepartment = $_GET['requestingDepartment'];
$requestTo_department = $_GET['requestTo_department'];
$requestingUser = $_GET['requestingUser'];
$username = $_GET['username'];
$checkz = $_GET['checkz'];
$ro = new database();


if( $checkz == "yes" ) {
echo "<center><a href='http://".$ro->getMyUrl()."/COCONUT/availableMedicine/showRequestList.php?requestingDepartment=$requestingDepartment&requestTo_department=$requestTo_department&username=$username&checkz=no'><font color=red>Uncheck All</font></a></center>";
}else {
echo "<center><a href='http://".$ro->getMyUrl()."/COCONUT/availableMedicine/showRequestList.php?requestingDepartment=$requestingDepartment&requestTo_department=$requestTo_department&username=$username&checkz=yes'><font color=blue>Check All</font></a></center>";
}


$ro->showRequestList($requestingDepartment,$requestTo_department,$username,$checkz,$requestingUser);

?>
