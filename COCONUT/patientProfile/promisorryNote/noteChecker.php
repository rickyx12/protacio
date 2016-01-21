<?php
include("../../../myDatabase1.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$ro = new database1();


if( $ro->selectNow("promisorryNote","registrationNo","registrationNo",$registrationNo) != "" ) {
header("Location: editPromisorry.php?username=$username&registrationNo=$registrationNo");
}else {
header("Location: addPromisorry.php?username=$username&registrationNo=$registrationNo");
}

?>
