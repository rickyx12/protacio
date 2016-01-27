<?php
include("../../myDatabase3.php");
$registrationNo = $_GET['registrationNo'];

if( isset($_GET['show']) ) {
$show = $_GET['show'];
}else {
$show = "All";
}

if( isset($_GET['checked']) ) {
$checked = $_GET['checked'];
}else {
$checked = "";
}

$ro = new database3();

if( $ro->selectNow("registrationDetails","type","registrationNo",$registrationNo) == "OPD" ) {
echo "<font color=red>Update to Outpatient Price</font><br><font size=2>Updated price will be in cash column</font>";
}else if( $ro->selectNow("registrationDetails","type","registrationNo",$registrationNo) == "IPD" ) {
echo "<font color=red>Update to Inpatient Price</font><br><font size=2>Updated price will be in cash column</font>";
}else { }

if( $checked == "" ) {
echo "<center><a href='/COCONUT/patientProfile/updatePrice.php?registrationNo=$registrationNo&show=$show&checked=checked' style='text-decoration:none; color:Red;'>Check All</a>";
}else {
echo "<center><a href='/COCONUT/patientProfile/updatePrice.php?registrationNo=$registrationNo&show=$show&checked=' style='text-decoration:none; color:Red;'>Uncheck All</a>";
}

$ro->updatePricez($registrationNo,$show,$checked);

?>
