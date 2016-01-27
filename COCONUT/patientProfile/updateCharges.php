<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$title = $_GET['title'];

$ro = new database2();

$ro->deleteUnclearCharges($registrationNo,$title);

if( $title == "MEDICINE" ) {
echo "All Medicine which is not dispensed is now deleted.";
}else if( $title == "SUPPLIES" ) {
echo "All Supplies which is not dispensed is now deleted.";
}else if( $title == "LABORATORY" )  {
echo "Laboratory that is no Result is now deleted.";
}else {

}

?>
