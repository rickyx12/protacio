<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$casetype = $_GET['casetype'];
$cash = $_GET['cash'];
$case = $_GET['case'];
$type = $_GET['type'];

$ro = new database();

echo "<font size=3>Analyzing your data.....</font>";

$ro->getReadyAllChargesForPHICLimit($registrationNo,$type);


if( $type == "medicine" ) {
//medicine
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/phicLimit/phicFuller.php?registrationNo=$registrationNo&casetype=$casetype&cash=$cash&case=$case");
}else if( $type == "pf" ) {
//pf
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/phicLimit/phicFuller_PF.php?registrationNo=$registrationNo&casetype=$casetype&cash=$cash&case=$case");
}
else  {
//supplies
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/phicLimit/phicFuller_supplies.php?registrationNo=$registrationNo&casetype=$casetype&cash=$cash&case=$case");

}

?>
